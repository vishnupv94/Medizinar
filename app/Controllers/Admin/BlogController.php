<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Helpers\Csrf;
use App\Models\BlogPost;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->layout = 'admin';
        $this->guardAdmin();
    }

    /**
     * List all blog posts with search + pagination.
     */
    public function index(): void
    {
        $q      = sanitize_input($_GET['q'] ?? '');
        $page   = max(1, (int) ($_GET['page'] ?? 1));
        $limit  = 20;
        $offset = ($page - 1) * $limit;
        $total  = BlogPost::countFiltered($q);
        $pages  = max(1, (int) ceil($total / $limit));

        $this->view('admin/blog-list', [
            'pageTitle'  => 'Blog Posts',
            'adminPage'  => 'blog',
            'posts'      => BlogPost::getFiltered($q, $limit, $offset),
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
        $this->view('admin/blog-form', [
            'pageTitle' => 'New Blog Post',
            'adminPage' => 'blog',
            'post'      => null,
            'errors'    => [],
        ]);
    }

    /**
     * Store a new blog post.
     */
    public function store(): void
    {
        if (!Csrf::verify($_POST['csrf_token'] ?? '')) {
            $this->redirect(url('/admin/blog'));
        }

        $data   = $this->validatePost();
        $errors = $data['errors'];

        if (!empty($errors)) {
            $this->view('admin/blog-form', [
                'pageTitle' => 'New Blog Post',
                'adminPage' => 'blog',
                'post'      => (object) $data['fields'],
                'errors'    => $errors,
            ]);
            return;
        }

        $fields = $data['fields'];

        // Handle image upload
        $imageName = $this->handleImageUpload();
        if ($imageName) {
            $fields['image'] = $imageName;
        }

        // Generate slug
        $fields['slug'] = BlogPost::generateSlug($fields['slug'] ?: $fields['title']);

        // Determine status
        $action = sanitize_input($_POST['action'] ?? 'draft');
        $fields['status'] = ($action === 'publish') ? 'published' : 'draft';
        if ($fields['status'] === 'published') {
            $fields['published_at'] = date('Y-m-d H:i:s');
        }

        $id = BlogPost::create($fields);

        $msg = $fields['status'] === 'published' ? 'Blog post published.' : 'Blog post saved as draft.';
        $this->redirect(url('/admin/blog/' . $id . '/edit'), ['success' => $msg]);
    }

    /**
     * Show edit form.
     */
    public function edit(string $id): void
    {
        $post = BlogPost::findById((int) $id);
        if (!$post) {
            $this->redirect(url('/admin/blog'), ['error' => 'Post not found.']);
        }

        $this->view('admin/blog-form', [
            'pageTitle' => 'Edit: ' . $post->title,
            'adminPage' => 'blog',
            'post'      => $post,
            'errors'    => [],
        ]);
    }

    /**
     * Update an existing blog post.
     */
    public function update(string $id): void
    {
        if (!Csrf::verify($_POST['csrf_token'] ?? '')) {
            $this->redirect(url('/admin/blog'));
        }

        $post = BlogPost::findById((int) $id);
        if (!$post) {
            $this->redirect(url('/admin/blog'), ['error' => 'Post not found.']);
        }

        $data   = $this->validatePost();
        $errors = $data['errors'];

        if (!empty($errors)) {
            // Preserve existing image and id for the form
            $formPost = (object) array_merge((array) $post, $data['fields']);
            $this->view('admin/blog-form', [
                'pageTitle' => 'Edit: ' . $post->title,
                'adminPage' => 'blog',
                'post'      => $formPost,
                'errors'    => $errors,
            ]);
            return;
        }

        $fields = $data['fields'];

        // Handle image upload
        $imageName = $this->handleImageUpload();
        if ($imageName) {
            // Delete old image
            if (!empty($post->image)) {
                $oldPath = ROOT_PATH . '/uploads/blog/' . basename($post->image);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }
            $fields['image'] = $imageName;
        }

        // Handle image removal
        if (isset($_POST['remove_image']) && $_POST['remove_image'] === '1' && !$imageName) {
            if (!empty($post->image)) {
                $oldPath = ROOT_PATH . '/uploads/blog/' . basename($post->image);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }
            $fields['image'] = null;
        }

        // Regenerate slug if changed
        $fields['slug'] = BlogPost::generateSlug($fields['slug'] ?: $fields['title'], (int) $id);

        // Determine status
        $action = sanitize_input($_POST['action'] ?? 'draft');
        if ($action === 'publish') {
            $fields['status'] = 'published';
            if (empty($post->published_at)) {
                $fields['published_at'] = date('Y-m-d H:i:s');
            }
        } elseif ($action === 'unpublish') {
            $fields['status'] = 'draft';
            $fields['published_at'] = null;
        } else {
            // Keep current status
            $fields['status'] = $post->status;
        }

        BlogPost::update((int) $id, $fields);

        $msg = ($fields['status'] === 'published') ? 'Blog post updated and published.' : 'Blog post updated.';
        $this->redirect(url('/admin/blog/' . $id . '/edit'), ['success' => $msg]);
    }

    /**
     * Preview a blog post (renders as it would appear publicly, inside admin chrome).
     */
    public function preview(string $id): void
    {
        $post = BlogPost::findById((int) $id);
        if (!$post) {
            $this->redirect(url('/admin/blog'), ['error' => 'Post not found.']);
        }

        $this->view('admin/blog-preview', [
            'pageTitle' => 'Preview: ' . $post->title,
            'adminPage' => 'blog',
            'post'      => $post,
        ]);
    }

    /**
     * Delete a blog post.
     */
    public function delete(string $id): void
    {
        if (!Csrf::verify($_POST['csrf_token'] ?? '')) {
            $this->redirect(url('/admin/blog'));
        }

        $post = BlogPost::findById((int) $id);
        if ($post && !empty($post->image)) {
            $imgPath = ROOT_PATH . '/uploads/blog/' . basename($post->image);
            if (file_exists($imgPath)) {
                @unlink($imgPath);
            }
        }

        BlogPost::delete((int) $id);
        $this->redirect(url('/admin/blog'), ['success' => 'Blog post deleted.']);
    }

    /**
     * Validate POST input and return fields + errors.
     */
    private function validatePost(): array
    {
        $title      = sanitize_input($_POST['title'] ?? '');
        $slug       = sanitize_input($_POST['slug'] ?? '');
        $content    = trim($_POST['content'] ?? '');
        $excerpt    = sanitize_input($_POST['excerpt'] ?? '');
        $bannerPos  = sanitize_input($_POST['banner_pos'] ?? 'center center');
        $bannerScale = (float) ($_POST['banner_scale'] ?? 1.00);

        $errors = [];
        if ($title === '') {
            $errors['title'] = 'Title is required.';
        }
        if ($content === '') {
            $errors['content'] = 'Content is required.';
        }

        // Validate image if uploaded
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $allowed = ['image/jpeg', 'image/png', 'image/webp'];
            $finfo   = finfo_open(FILEINFO_MIME_TYPE);
            $mime    = finfo_file($finfo, $_FILES['image']['tmp_name']);
            finfo_close($finfo);

            if (!in_array($mime, $allowed, true)) {
                $errors['image'] = 'Only JPG, PNG, and WebP images are allowed.';
            }

            if ($_FILES['image']['size'] > 5 * 1024 * 1024) {
                $errors['image'] = 'Image must be under 5 MB.';
            }
        }

        // Clamp banner_scale to reasonable range
        $bannerScale = max(0.1, min(3.0, $bannerScale));

        return [
            'fields' => [
                'title'        => $title,
                'slug'         => $slug,
                'content'      => $content,
                'excerpt'      => $excerpt,
                'banner_pos'   => $bannerPos,
                'banner_scale' => $bannerScale,
            ],
            'errors' => $errors,
        ];
    }

    /**
     * Handle image file upload. Returns the saved filename or null.
     */
    private function handleImageUpload(): ?string
    {
        if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $uploadDir = ROOT_PATH . '/uploads/blog/';
        if (!is_dir($uploadDir)) {
            @mkdir($uploadDir, 0755, true);
        }

        $ext  = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $safe = preg_replace('/[^a-z0-9]/', '-', strtolower(pathinfo($_FILES['image']['name'], PATHINFO_FILENAME)));
        $name = $safe . '-' . time() . '.' . $ext;

        move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $name);

        return $name;
    }
}
