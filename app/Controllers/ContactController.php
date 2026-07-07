<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Helpers\Csrf;
use App\Helpers\Validator;
use App\Models\ContactEntry;

class ContactController extends Controller
{
    public function index(): void
    {
        $errors = $_SESSION['cf_errors'] ?? [];
        unset($_SESSION['cf_errors']);

        $this->view('contact', [
            'page'      => 'contact',
            'pageTitle' => 'Contact Us',
            'metaDesc'  => 'Contact Medizinar Care for home healthcare inquiries, support requests, or to book a service. Phone, WhatsApp, or our online contact form.',
            'errors'    => $errors,
        ]);
    }

    public function submit(): void
    {
        $token = $_POST['csrf_token'] ?? '';
        if (!Csrf::verify($token)) {
            $this->redirect(url('/contact'), ['error' => 'Invalid form submission. Please try again.']);
        }

        // reCAPTCHA verification
        $recaptchaToken = $_POST['g-recaptcha-response'] ?? '';
        if (!recaptcha_verify($recaptchaToken)) {
            $_SESSION['old_cf'] = [
                'name'     => sanitize_input($_POST['name']     ?? ''),
                'phone'    => sanitize_input($_POST['phone']    ?? ''),
                'email'    => sanitize_input($_POST['email']    ?? ''),
                'category' => sanitize_input($_POST['category'] ?? ''),
                'subject'  => sanitize_input($_POST['subject']  ?? ''),
                'message'  => sanitize_input($_POST['message']  ?? ''),
            ];
            $this->redirect(url('/contact'), ['error' => 'reCAPTCHA verification failed. Please try again.']);
        }

        $name     = sanitize_input($_POST['name']     ?? '');
        $phone    = sanitize_input($_POST['phone']    ?? '');
        $email    = sanitize_input($_POST['email']    ?? '');
        $category = sanitize_input($_POST['category'] ?? '');
        $subject  = sanitize_input($_POST['subject']  ?? '');
        $message  = sanitize_input($_POST['message']  ?? '');

        $errors = [];

        if ($name === '' || mb_strlen($name) < 2) {
            $errors['name'] = 'Full name must be at least 2 characters.';
        }
        if ($phone === '') {
            $errors['phone'] = 'Phone number is required.';
        } elseif (!validate_phone($phone)) {
            $errors['phone'] = 'Please enter a valid Indian mobile number.';
        }
        if ($email !== '' && !validate_email($email)) {
            $errors['email'] = 'Please enter a valid email address.';
        }
        if ($category === '') {
            $errors['category'] = 'Please select a ticket category.';
        }
        if ($subject === '' || mb_strlen($subject) < 3) {
            $errors['subject'] = 'Subject must be at least 3 characters.';
        }
        if ($message === '' || mb_strlen($message) < 10) {
            $errors['message'] = 'Message must be at least 10 characters.';
        }

        $attachmentPath = null;
        $attachmentName = null;

        if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] !== UPLOAD_ERR_NO_FILE) {
            $file = $_FILES['attachment'];

            if ($file['error'] !== UPLOAD_ERR_OK) {
                $errors[] = 'File upload failed. Please try again without an attachment.';
            } else {
                $maxSize     = 5 * 1024 * 1024;
                $allowedExts = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx'];
                $fileExt     = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

                if ($file['size'] > $maxSize) {
                    $errors[] = 'Attachment must not exceed 5 MB.';
                } elseif (!in_array($fileExt, $allowedExts, true)) {
                    $errors[] = 'Invalid file type. Allowed types: JPG, PNG, GIF, PDF, DOC, DOCX.';
                } else {
                    $uploadDir = \ROOT_PATH . '/uploads/contact/';
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }
                    $safeName       = bin2hex(random_bytes(8)) . '.' . $fileExt;
                    $attachmentPath = $uploadDir . $safeName;
                    $attachmentName = basename($file['name']);
                    $attachmentSafe = $safeName; // stored in DB for later retrieval

                    if (!move_uploaded_file($file['tmp_name'], $attachmentPath)) {
                        $errors[] = 'Could not save attachment. Please try without a file.';
                        $attachmentPath = null;
                    }
                }
            }
        }

        if (!empty($errors)) {
            if ($attachmentPath && file_exists($attachmentPath)) {
                unlink($attachmentPath);
            }
            $_SESSION['old_cf']    = compact('name', 'phone', 'email', 'category', 'subject', 'message');
            $_SESSION['cf_errors'] = $errors;
            $this->redirect(url('/contact'));
        }

        try {
            ContactEntry::create([
                'name'            => $name,
                'phone'           => $phone,
                'email'           => $email ?: null,
                'category'        => $category,
                'subject'         => $subject,
                'message'         => $message,
                'attachment_name' => $attachmentName,
                'attachment_path' => $attachmentSafe ?? null,
                'ip_address'      => $_SERVER['REMOTE_ADDR'] ?? '',
            ]);
        } catch (\Throwable $e) {
            if ($attachmentPath && file_exists($attachmentPath)) {
                unlink($attachmentPath);
            }
            $_SESSION['old_cf'] = compact('name', 'phone', 'email', 'category', 'subject', 'message');
            $this->redirect(url('/contact'), [
                'error' => 'We could not process your request at this time. Please call us at ' . PHONE_DISPLAY . ' or reach us via WhatsApp.',
            ]);
        }

        $categoryLabels = [
            'appointment'  => 'Appointment Inquiry',
            'service-info' => 'Service Information',
            'billing'      => 'Billing & Payment',
            'feedback'     => 'Feedback / Review',
            'complaint'    => 'Complaint / Issue',
            'caregiver'    => 'Caregiver Related',
            'general'      => 'General Query',
            'emergency'    => 'Urgent / Emergency',
        ];
        $categoryLabel = $categoryLabels[$category] ?? $category;

        $mailSubject = '[Medizinar Care Support] [' . $categoryLabel . '] ' . $subject;
        $bodyParts   = [
            'Support Ticket — Medizinar Care',
            str_repeat('-', 50),
            'Category   : ' . $categoryLabel,
            'Subject    : ' . $subject,
            '',
            'Name       : ' . $name,
            'Phone      : ' . $phone,
            'Email      : ' . ($email ?: 'Not provided'),
            '',
            'Message:',
            $message,
            '',
        ];
        if ($attachmentName) {
            $bodyParts[] = 'Attachment  : ' . $attachmentName . ' (saved on server)';
            $bodyParts[] = '';
        }
        $bodyParts[] = str_repeat('-', 50);
        $bodyParts[] = 'Submitted at: ' . date('d-m-Y H:i:s') . ' IST';
        $bodyParts[] = 'IP Address  : ' . ($_SERVER['REMOTE_ADDR'] ?? 'Unknown');

        $body = implode("\r\n", $bodyParts);

        $headers  = 'From: ' . MAIL_FROM_NAME . ' <' . MAIL_FROM . ">\r\n";
        if (!empty($email)) {
            $headers .= 'Reply-To: ' . $email . "\r\n";
        } else {
            $headers .= 'Reply-To: ' . MAIL_FROM . "\r\n";
        }
        $headers .= "X-Mailer: PHP/" . PHP_VERSION . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        @mail(MAIL_TO, $mailSubject, $body, $headers);

        // File is kept on server so admin can download it from the panel.
        // (It was already saved to contact_entries.attachment_path above.)

        unset($_SESSION['old_cf']);

        $this->redirect(url('/contact'), [
            'success' => 'Your message has been sent successfully! We will get back to you as soon as possible.',
        ]);
    }
}
