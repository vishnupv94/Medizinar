<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    private const PER_PAGE = 20;

    public function __construct()
    {
        $this->layout = 'admin';
        $this->guardAdmin();
    }
    public function index(): void
    {
        $q      = trim($_GET['q'] ?? '');
        $page   = max(1, (int) ($_GET['page'] ?? 1));
        $offset = ($page - 1) * self::PER_PAGE;

        $items = Testimonial::getFiltered($q, self::PER_PAGE, $offset);
        $total = Testimonial::countFiltered($q);
        $pages = max(1, (int) ceil($total / self::PER_PAGE));

        $this->view('admin/testimonial-list', compact('items', 'q', 'page', 'pages', 'total') + ['pageTitle' => 'Testimonials']);
    }

    public function create(): void
    {
        $this->view('admin/testimonial-form', ['testimonial' => null, 'errors' => [], 'old' => [], 'pageTitle' => 'New Testimonial']);
    }

    public function store(): void
    {
        $data   = $this->sanitize($_POST);
        $errors = $this->validate($data);

        if ($errors) {
            $this->view('admin/testimonial-form', ['testimonial' => null, 'errors' => $errors, 'old' => $data, 'pageTitle' => 'New Testimonial']);
            return;
        }

        Testimonial::create($data);
        $this->redirect('/admin/testimonials?success=created');
    }

    public function edit(int $id): void
    {
        $testimonial = Testimonial::findById($id);
        if (!$testimonial) {
            $this->redirect('/admin/testimonials', ['error' => 'Testimonial not found.']);
            return;
        }
        $this->view('admin/testimonial-form', ['testimonial' => $testimonial, 'errors' => [], 'old' => (array) $testimonial, 'pageTitle' => 'Edit Testimonial']);
    }

    public function update(int $id): void
    {
        $testimonial = Testimonial::findById($id);
        if (!$testimonial) {
            $this->redirect('/admin/testimonials', ['error' => 'Testimonial not found.']);
            return;
        }

        $data   = $this->sanitize($_POST);
        $errors = $this->validate($data);

        if ($errors) {
            $this->view('admin/testimonial-form', ['testimonial' => $testimonial, 'errors' => $errors, 'old' => $data, 'pageTitle' => 'Edit Testimonial']);
            return;
        }

        Testimonial::update($id, $data);
        $this->redirect('/admin/testimonials?success=updated');
    }

    public function delete(int $id): void
    {
        Testimonial::delete($id);
        $this->redirect('/admin/testimonials?success=deleted');
    }

    // ----------------------------------------------------------------
    private function sanitize(array $p): array
    {
        return [
            'name'           => trim($p['name']           ?? ''),
            'location_label' => trim($p['location_label'] ?? ''),
            'text'           => trim($p['text']           ?? ''),
            'stars'          => min(5, max(1, (int) ($p['stars'] ?? 5))),
            'status'         => in_array($p['status'] ?? '', ['draft', 'published']) ? $p['status'] : 'published',
            'sort_order'     => (int) ($p['sort_order'] ?? 0),
        ];
    }

    private function validate(array $d): array
    {
        $e = [];
        if ($d['name'] === '')  $e['name'] = 'Name is required.';
        if ($d['text'] === '')  $e['text'] = 'Review text is required.';
        return $e;
    }
}
