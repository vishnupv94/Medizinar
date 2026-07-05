<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Helpers\Csrf;
use App\Models\Location;

class LocationController extends Controller
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
        $total  = Location::countFiltered($q);
        $pages  = max(1, (int) ceil($total / $limit));

        $this->view('admin/location-list', [
            'pageTitle'   => 'Locations',
            'adminPage'   => 'locations',
            'locations'   => Location::getFiltered($q, $limit, $offset),
            'page'        => $page,
            'totalPages'  => $pages,
            'total'       => $total,
            'q'           => $q,
        ]);
    }

    // -------------------------------------------------------
    // Create
    // -------------------------------------------------------
    public function create(): void
    {
        $this->view('admin/location-form', [
            'pageTitle' => 'New Location',
            'adminPage' => 'locations',
            'location'  => null,
            'errors'    => [],
        ]);
    }

    public function store(): void
    {
        if (!Csrf::verify($_POST['csrf_token'] ?? '')) {
            $this->redirect(url('/admin/locations'));
        }

        $data   = $this->validateLocation();
        $errors = $data['errors'];

        if (!empty($errors)) {
            $this->view('admin/location-form', [
                'pageTitle' => 'New Location',
                'adminPage' => 'locations',
                'location'  => (object) $data['fields'],
                'errors'    => $errors,
            ]);
            return;
        }

        $fields           = $data['fields'];
        $fields['status'] = (sanitize_input($_POST['action'] ?? '') === 'publish') ? 'published' : 'draft';

        $id = Location::create($fields);

        $msg = $fields['status'] === 'published' ? 'Location published.' : 'Location saved as draft.';
        $this->redirect(url('/admin/locations/' . $id . '/edit'), ['success' => $msg]);
    }

    // -------------------------------------------------------
    // Edit / Update
    // -------------------------------------------------------
    public function edit(string $id): void
    {
        $location = Location::findById((int) $id);
        if (!$location) {
            $this->redirect(url('/admin/locations'), ['error' => 'Location not found.']);
        }

        $this->view('admin/location-form', [
            'pageTitle' => 'Edit: ' . $location->name,
            'adminPage' => 'locations',
            'location'  => $location,
            'errors'    => [],
        ]);
    }

    public function update(string $id): void
    {
        if (!Csrf::verify($_POST['csrf_token'] ?? '')) {
            $this->redirect(url('/admin/locations'));
        }

        $location = Location::findById((int) $id);
        if (!$location) {
            $this->redirect(url('/admin/locations'), ['error' => 'Location not found.']);
        }

        $data   = $this->validateLocation((int) $id);
        $errors = $data['errors'];

        if (!empty($errors)) {
            $formLoc = (object) array_merge((array) $location, $data['fields']);
            $this->view('admin/location-form', [
                'pageTitle' => 'Edit: ' . $location->name,
                'adminPage' => 'locations',
                'location'  => $formLoc,
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
            $fields['status'] = $location->status;
        }

        Location::update((int) $id, $fields);

        $msg = $fields['status'] === 'published' ? 'Location updated and published.' : 'Location updated.';
        $this->redirect(url('/admin/locations/' . $id . '/edit'), ['success' => $msg]);
    }

    // -------------------------------------------------------
    // Delete
    // -------------------------------------------------------
    public function delete(string $id): void
    {
        if (!Csrf::verify($_POST['csrf_token'] ?? '')) {
            $this->redirect(url('/admin/locations'));
        }

        Location::delete((int) $id);
        $this->redirect(url('/admin/locations'), ['success' => 'Location deleted.']);
    }

    // -------------------------------------------------------
    // Helpers
    // -------------------------------------------------------

    private function validateLocation(?int $editId = null): array
    {
        $slug             = sanitize_input($_POST['slug'] ?? '');
        $name             = sanitize_input($_POST['name'] ?? '');
        $title            = sanitize_input($_POST['title'] ?? '');
        $metaDesc         = sanitize_input($_POST['meta_desc'] ?? '');
        $heroTitle        = sanitize_input($_POST['hero_title'] ?? '');
        $heroDesc         = trim($_POST['hero_desc'] ?? '');
        $intro            = trim($_POST['intro'] ?? '');
        $distance         = sanitize_input($_POST['distance'] ?? '');
        $sitemapPriority  = min(1.0, max(0.1, (float) ($_POST['sitemap_priority'] ?? 0.7)));
        $sortOrder        = (int) ($_POST['sort_order'] ?? 0);

        // Localities: newline-separated → JSON
        $rawLocalities = trim($_POST['localities'] ?? '');
        $localities    = array_values(array_filter(
            array_map('trim', explode("\n", $rawLocalities)),
            fn($l) => $l !== ''
        ));
        $localitiesJson = json_encode($localities, JSON_UNESCAPED_UNICODE);

        // Auto slug from name
        if ($slug === '' && $name !== '') {
            $slug = strtolower(trim(preg_replace('/[^a-z0-9]+/i', '-', $name), '-'));
        }

        $errors = [];
        if ($name === '') {
            $errors['name'] = 'District name is required.';
        }
        if ($title === '') {
            $errors['title'] = 'Page title is required.';
        }
        if ($slug === '') {
            $errors['slug'] = 'Slug is required.';
        } elseif (Location::slugExists($slug, $editId)) {
            $errors['slug'] = 'This slug is already in use by another location.';
        }
        if (empty($localities)) {
            $errors['localities'] = 'At least one locality/town is required.';
        }

        return [
            'fields' => [
                'slug'             => $slug,
                'name'             => $name,
                'title'            => $title,
                'meta_desc'        => $metaDesc,
                'hero_title'       => $heroTitle,
                'hero_desc'        => $heroDesc,
                'intro'            => $intro,
                'distance'         => $distance,
                'sitemap_priority' => $sitemapPriority,
                'localities'       => $localitiesJson,
                'sort_order'       => $sortOrder,
            ],
            'errors' => $errors,
        ];
    }
}
