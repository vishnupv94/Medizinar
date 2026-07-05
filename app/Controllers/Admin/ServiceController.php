<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Helpers\Csrf;
use App\Models\Service;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->layout = 'admin';
        $this->guardAdmin();
    }

    // -------------------------------------------------------
    // List
    // -------------------------------------------------------
    public function index(): void
    {
        $q      = sanitize_input($_GET['q'] ?? '');
        $page   = max(1, (int) ($_GET['page'] ?? 1));
        $limit  = 20;
        $offset = ($page - 1) * $limit;
        $total  = Service::countFiltered($q);
        $pages  = max(1, (int) ceil($total / $limit));

        $this->view('admin/service-list', [
            'pageTitle'  => 'Services',
            'adminPage'  => 'services',
            'services'   => Service::getFiltered($q, $limit, $offset),
            'page'       => $page,
            'totalPages' => $pages,
            'total'      => $total,
            'q'          => $q,
        ]);
    }

    // -------------------------------------------------------
    // Create
    // -------------------------------------------------------
    public function create(): void
    {
        $this->view('admin/service-form', [
            'pageTitle' => 'New Service',
            'adminPage' => 'services',
            'service'   => null,
            'faqs'      => [],
            'errors'    => [],
        ]);
    }

    public function store(): void
    {
        if (!Csrf::verify($_POST['csrf_token'] ?? '')) {
            $this->redirect(url('/admin/services'));
        }

        $data   = $this->validateService();
        $errors = $data['errors'];

        if (!empty($errors)) {
            $this->view('admin/service-form', [
                'pageTitle' => 'New Service',
                'adminPage' => 'services',
                'service'   => (object) $data['fields'],
                'faqs'      => $this->parseFaqsFromPost(),
                'errors'    => $errors,
            ]);
            return;
        }

        $fields           = $data['fields'];
        $fields['status'] = (sanitize_input($_POST['action'] ?? '') === 'publish') ? 'published' : 'draft';

        $id = Service::create($fields);
        Service::replaceFaqs($id, $this->parseFaqsFromPost());

        $msg = $fields['status'] === 'published' ? 'Service published.' : 'Service saved as draft.';
        $this->redirect(url('/admin/services/' . $id . '/edit'), ['success' => $msg]);
    }

    // -------------------------------------------------------
    // Edit / Update
    // -------------------------------------------------------
    public function edit(string $id): void
    {
        $service = Service::findById((int) $id);
        if (!$service) {
            $this->redirect(url('/admin/services'), ['error' => 'Service not found.']);
        }

        $this->view('admin/service-form', [
            'pageTitle' => 'Edit: ' . $service->h1,
            'adminPage' => 'services',
            'service'   => $service,
            'faqs'      => Service::getFaqs((int) $id),
            'errors'    => [],
        ]);
    }

    public function update(string $id): void
    {
        if (!Csrf::verify($_POST['csrf_token'] ?? '')) {
            $this->redirect(url('/admin/services'));
        }

        $service = Service::findById((int) $id);
        if (!$service) {
            $this->redirect(url('/admin/services'), ['error' => 'Service not found.']);
        }

        $data   = $this->validateService((int) $id);
        $errors = $data['errors'];

        if (!empty($errors)) {
            $formService = (object) array_merge((array) $service, $data['fields']);
            $this->view('admin/service-form', [
                'pageTitle' => 'Edit: ' . $service->h1,
                'adminPage' => 'services',
                'service'   => $formService,
                'faqs'      => $this->parseFaqsFromPost(),
                'errors'    => $errors,
            ]);
            return;
        }

        $fields = $data['fields'];
        $action = sanitize_input($_POST['action'] ?? '');

        if ($action === 'publish') {
            $fields['status'] = 'published';
        } elseif ($action === 'unpublish') {
            $fields['status'] = 'draft';
        } else {
            $fields['status'] = $service->status;
        }

        Service::update((int) $id, $fields);
        Service::replaceFaqs((int) $id, $this->parseFaqsFromPost());

        $msg = $fields['status'] === 'published' ? 'Service updated and published.' : 'Service updated.';
        $this->redirect(url('/admin/services/' . $id . '/edit'), ['success' => $msg]);
    }

    // -------------------------------------------------------
    // Delete
    // -------------------------------------------------------
    public function delete(string $id): void
    {
        if (!Csrf::verify($_POST['csrf_token'] ?? '')) {
            $this->redirect(url('/admin/services'));
        }

        Service::delete((int) $id);
        $this->redirect(url('/admin/services'), ['success' => 'Service deleted.']);
    }

    // -------------------------------------------------------
    // Helpers
    // -------------------------------------------------------

    private function validateService(?int $editId = null): array
    {
        $slug        = sanitize_input($_POST['slug'] ?? '');
        $title       = sanitize_input($_POST['title'] ?? '');
        $h1          = sanitize_input($_POST['h1'] ?? '');
        $metaDesc    = sanitize_input($_POST['meta_desc'] ?? '');
        $badge       = sanitize_input($_POST['badge'] ?? '');
        $heroDesc    = trim($_POST['hero_desc'] ?? '');
        $schemaName  = sanitize_input($_POST['schema_name'] ?? '');
        $schemaDesc  = trim($_POST['schema_desc'] ?? '');
        $introWhat   = sanitize_input($_POST['intro_what'] ?? '');
        $introBody   = trim($_POST['intro_body'] ?? '');
        $idealFor    = trim($_POST['ideal_for'] ?? '');
        $serviceParam = sanitize_input($_POST['service_param'] ?? '');
        $color       = in_array($_POST['color'] ?? '', ['green', 'gold'], true) ? $_POST['color'] : 'green';
        $sortOrder   = (int) ($_POST['sort_order'] ?? 0);

        // Features: newline-separated textarea → JSON
        $rawFeatures = trim($_POST['features'] ?? '');
        $features    = array_values(array_filter(
            array_map('trim', explode("\n", $rawFeatures)),
            fn($f) => $f !== ''
        ));
        $featuresJson = json_encode($features, JSON_UNESCAPED_UNICODE);

        // Slug: auto-generate if empty
        if ($slug === '') {
            $slug = strtolower(trim(preg_replace('/[^a-z0-9]+/i', '-', $h1), '-'));
        }

        $errors = [];
        if ($title === '') {
            $errors['title'] = 'Page title is required.';
        }
        if ($h1 === '') {
            $errors['h1'] = 'Service heading (H1) is required.';
        }
        if ($slug === '') {
            $errors['slug'] = 'Slug is required.';
        } elseif (Service::slugExists($slug, $editId)) {
            $errors['slug'] = 'This slug is already in use by another service.';
        }
        if (empty($features)) {
            $errors['features'] = 'At least one feature is required.';
        }

        return [
            'fields' => [
                'slug'          => $slug,
                'title'         => $title,
                'h1'            => $h1,
                'meta_desc'     => $metaDesc,
                'badge'         => $badge,
                'hero_desc'     => $heroDesc,
                'schema_name'   => $schemaName,
                'schema_desc'   => $schemaDesc,
                'intro_what'    => $introWhat,
                'intro_body'    => $introBody,
                'ideal_for'     => $idealFor,
                'features'      => $featuresJson,
                'service_param' => $serviceParam,
                'color'         => $color,
                'sort_order'    => $sortOrder,
            ],
            'errors' => $errors,
        ];
    }

    /**
     * Reads FAQ rows from POST arrays:
     *   faq_question[], faq_answer[]
     * Returns [ ['question' => ..., 'answer' => ...], ... ]
     */
    private function parseFaqsFromPost(): array
    {
        $questions = $_POST['faq_question'] ?? [];
        $answers   = $_POST['faq_answer']   ?? [];
        $faqs      = [];
        foreach ($questions as $i => $q) {
            $q = trim($q);
            $a = trim($answers[$i] ?? '');
            if ($q !== '' && $a !== '') {
                $faqs[] = ['question' => $q, 'answer' => $a];
            }
        }
        return $faqs;
    }
}
