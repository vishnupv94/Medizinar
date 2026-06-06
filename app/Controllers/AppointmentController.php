<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Helpers\Csrf;
use App\Models\AppointmentEntry;

class AppointmentController extends Controller
{
    public function index(): void
    {
        $old        = $_SESSION['old_appt'] ?? [];
        $preService = sanitize_input($_GET['service'] ?? '');
        if (empty($old['service']) && !empty($preService)) {
            $old['service'] = $preService;
        }

        $this->view('appointment', [
            'page'      => 'contact',
            'pageTitle' => 'Make an Appointment',
            'metaDesc'  => 'Book a home healthcare appointment with Medizinar Care. Choose your service, share your requirements, and our team will reach you promptly.',
            'old'       => $old,
        ]);
    }

    public function submit(): void
    {
        $token = $_POST['csrf_token'] ?? '';
        if (!Csrf::verify($token)) {
            $this->redirect('/appointment', ['error' => 'Invalid form submission. Please try again.']);
        }

        $name       = sanitize_input($_POST['name']       ?? '');
        $phone      = sanitize_input($_POST['phone']      ?? '');
        $email      = sanitize_input($_POST['email']      ?? '');
        $service    = sanitize_input($_POST['service']    ?? '');
        $location   = sanitize_input($_POST['location']   ?? '');
        $start_date = sanitize_input($_POST['start_date'] ?? '');
        $duration   = sanitize_input($_POST['duration']   ?? '');
        $message    = sanitize_input($_POST['message']    ?? '');

        $errors = [];

        if ($name === '' || mb_strlen($name) < 2) {
            $errors[] = 'Full name must be at least 2 characters.';
        }
        if ($phone === '') {
            $errors[] = 'Phone number is required.';
        } elseif (!validate_phone($phone)) {
            $errors[] = 'Please enter a valid Indian mobile number.';
        }
        if ($email !== '' && !validate_email($email)) {
            $errors[] = 'Please enter a valid email address.';
        }
        if ($service === '') {
            $errors[] = 'Please select the service you need.';
        }
        if ($location === '' || mb_strlen($location) < 10) {
            $errors[] = 'Please enter a complete location/address (min 10 characters).';
        }
        if ($start_date === '') {
            $errors[] = 'Please select a preferred start date.';
        } else {
            $parsedDate = \DateTime::createFromFormat('Y-m-d', $start_date);
            $today      = new \DateTime('today');
            if ($parsedDate === false || $parsedDate < $today) {
                $errors[] = 'Preferred start date must be today or a future date.';
            }
        }
        if ($duration === '') {
            $errors[] = 'Please select a duration.';
        }

        if (!empty($errors)) {
            $_SESSION['old_appt'] = compact('name', 'phone', 'email', 'service', 'location', 'start_date', 'duration', 'message');
            $this->redirect('/appointment', ['error' => implode(' ', $errors)]);
        }

        try {
            AppointmentEntry::create([
                'name'       => $name,
                'phone'      => $phone,
                'email'      => $email ?: null,
                'service'    => $service,
                'location'   => $location,
                'start_date' => $start_date,
                'duration'   => $duration,
                'message'    => $message ?: null,
                'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '',
            ]);
        } catch (\Throwable $ignored) {
        }

        $serviceLabels = [
            'bedside'            => 'Bedside Patient Care',
            'elderly'            => 'Elderly Care',
            'mother-baby'        => 'Mother & Baby Care',
            'housemaid'          => 'House Maid Services',
            'hospital-companion' => 'Hospital Visit Companion',
            'day-support'        => 'Elderly Day Support',
            'night-care'         => 'Night Care Service',
            'nri'                => 'NRI Parent Care Check',
        ];
        $serviceLabel = $serviceLabels[$service] ?? $service;

        $durationLabels = [
            '1-day'     => '1 Day (Trial)',
            '1-week'    => '1 Week',
            '2-weeks'   => '2 Weeks',
            '1-month'   => '1 Month',
            '3-months'  => '3 Months',
            '6-months'  => '6 Months',
            'long-term' => 'Long-term (6+ months)',
            'ongoing'   => 'Ongoing / As needed',
        ];
        $durationLabel = $durationLabels[$duration] ?? $duration;

        $subject   = 'New Appointment Request – ' . $serviceLabel . ' – ' . $name;
        $bodyParts = [
            'Appointment Request — Medizinar Care',
            str_repeat('-', 50),
            'Name       : ' . $name,
            'Phone      : ' . $phone,
            'Email      : ' . ($email ?: 'Not provided'),
            '',
            'Service    : ' . $serviceLabel,
            'Location   : ' . $location,
            'Start Date : ' . $start_date,
            'Duration   : ' . $durationLabel,
            '',
            'Message / Special Requirements:',
            ($message ?: 'None'),
            '',
            str_repeat('-', 50),
            'Submitted at: ' . date('d-m-Y H:i:s') . ' IST',
            'IP Address  : ' . ($_SERVER['REMOTE_ADDR'] ?? 'Unknown'),
        ];
        $body = implode("\r\n", $bodyParts);

        $headers  = 'From: ' . MAIL_FROM_NAME . ' <' . MAIL_FROM . ">\r\n";
        $headers .= 'Reply-To: ' . ($email ?: $phone) . "\r\n";
        $headers .= "X-Mailer: PHP/" . PHP_VERSION . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        $sent = mail(MAIL_TO, $subject, $body, $headers);

        if ($sent) {
            $this->redirect('/appointment', [
                'success' => 'Your appointment request has been received! Our team will contact you within 24 hours to confirm the details.',
            ]);
        } else {
            $_SESSION['old_appt'] = compact('name', 'phone', 'email', 'service', 'location', 'start_date', 'duration', 'message');
            $this->redirect('/appointment', [
                'error' => 'We could not send your request at this time. Please try calling us directly at ' . PHONE_DISPLAY . ' or reach us via WhatsApp.',
            ]);
        }
    }
}
