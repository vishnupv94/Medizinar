<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Helpers\Csrf;
use App\Models\Faq;

class FaqController extends Controller
{
    public function __construct()
    {
        $this->layout = 'admin';
        $this->guardAdmin();
    }

    /**
     * List all FAQs with search + pagination.
     */
    public function index(): void
    {
        $q      = sanitize_input($_GET['q'] ?? '');
        $page   = max(1, (int) ($_GET['page'] ?? 1));
        $limit  = 20;
        $offset = ($page - 1) * $limit;
        $total  = Faq::countFiltered($q);
        $pages  = max(1, (int) ceil($total / $limit));

        $this->view('admin/faq-list', [
            'pageTitle'  => 'FAQs',
            'adminPage'  => 'faqs',
            'faqs'       => Faq::getFiltered($q, $limit, $offset),
            'page'       => $page,
            'totalPages' => $pages,
            'total'      => $total,
            'q'          => $q,
        ]);
    }

    /**
     * Show create form.
     */
    public function create(): void
    {
        $this->view('admin/faq-form', [
            'pageTitle' => 'New FAQ',
            'adminPage' => 'faqs',
            'faq'       => null,
            'errors'    => [],
        ]);
    }

    /**
     * Store a new FAQ.
     */
    public function store(): void
    {
        if (!Csrf::verify($_POST['csrf_token'] ?? '')) {
            $this->redirect(url('/admin/faqs'));
        }

        $data   = $this->validateFaq();
        $errors = $data['errors'];

        if (!empty($errors)) {
            $this->view('admin/faq-form', [
                'pageTitle' => 'New FAQ',
                'adminPage' => 'faqs',
                'faq'       => (object) $data['fields'],
                'errors'    => $errors,
            ]);
            return;
        }

        $fields = $data['fields'];

        // Determine status
        $action = sanitize_input($_POST['action'] ?? 'draft');
        $fields['status'] = ($action === 'publish') ? 'published' : 'draft';

        $id = Faq::create($fields);

        $msg = $fields['status'] === 'published' ? 'FAQ published.' : 'FAQ saved as draft.';
        $this->redirect(url('/admin/faqs/' . $id . '/edit'), ['success' => $msg]);
    }

    /**
     * Show edit form.
     */
    public function edit(string $id): void
    {
        $faq = Faq::findById((int) $id);
        if (!$faq) {
            $this->redirect(url('/admin/faqs'), ['error' => 'FAQ not found.']);
        }

        $this->view('admin/faq-form', [
            'pageTitle' => 'Edit FAQ',
            'adminPage' => 'faqs',
            'faq'       => $faq,
            'errors'    => [],
        ]);
    }

    /**
     * Update an existing FAQ.
     */
    public function update(string $id): void
    {
        if (!Csrf::verify($_POST['csrf_token'] ?? '')) {
            $this->redirect(url('/admin/faqs'));
        }

        $faq = Faq::findById((int) $id);
        if (!$faq) {
            $this->redirect(url('/admin/faqs'), ['error' => 'FAQ not found.']);
        }

        $data   = $this->validateFaq();
        $errors = $data['errors'];

        if (!empty($errors)) {
            $formFaq = (object) array_merge((array) $faq, $data['fields']);
            $this->view('admin/faq-form', [
                'pageTitle' => 'Edit FAQ',
                'adminPage' => 'faqs',
                'faq'       => $formFaq,
                'errors'    => $errors,
            ]);
            return;
        }

        $fields = $data['fields'];

        // Determine status
        $action = sanitize_input($_POST['action'] ?? 'draft');
        if ($action === 'publish') {
            $fields['status'] = 'published';
        } elseif ($action === 'unpublish') {
            $fields['status'] = 'draft';
        } else {
            $fields['status'] = $faq->status;
        }

        Faq::update((int) $id, $fields);

        $msg = ($fields['status'] === 'published') ? 'FAQ updated and published.' : 'FAQ updated.';
        $this->redirect(url('/admin/faqs/' . $id . '/edit'), ['success' => $msg]);
    }

    /**
     * Delete an FAQ.
     */
    public function delete(string $id): void
    {
        if (!Csrf::verify($_POST['csrf_token'] ?? '')) {
            $this->redirect(url('/admin/faqs'));
        }

        Faq::delete((int) $id);
        $this->redirect(url('/admin/faqs'), ['success' => 'FAQ deleted.']);
    }

    /**
     * Validate POST input.
     */
    private function validateFaq(): array
    {
        $question  = trim($_POST['question'] ?? '');
        $answer    = trim($_POST['answer'] ?? '');
        $sortOrder = (int) ($_POST['sort_order'] ?? 0);

        $errors = [];
        if ($question === '') {
            $errors['question'] = 'Question is required.';
        }
        if ($answer === '') {
            $errors['answer'] = 'Answer is required.';
        }

        return [
            'fields' => [
                'question'   => $question,
                'answer'     => $answer,
                'sort_order' => $sortOrder,
            ],
            'errors' => $errors,
        ];
    }
}
