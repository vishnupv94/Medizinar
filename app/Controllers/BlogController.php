<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\BlogPost;

class BlogController extends Controller
{
    /**
     * Blog listing page — shows published posts, paginated.
     */
    public function index(): void
    {
        $page   = max(1, (int) ($_GET['page'] ?? 1));
        $limit  = 9;
        $offset = ($page - 1) * $limit;
        $total  = BlogPost::countPublished();
        $pages  = max(1, (int) ceil($total / $limit));

        $this->view('blog', [
            'page'       => 'blog',
            'pageTitle'  => 'Blog',
            'metaDesc'   => 'Read the latest health tips, home care insights, and wellness articles from Medizinar Care — your trusted home healthcare partner in Kerala.',
            'posts'      => BlogPost::getPublished($limit, $offset),
            'currentPage' => $page,
            'totalPages' => $pages,
            'total'      => $total,
        ]);
    }

    /**
     * Single blog post page — SEO-friendly slug URL.
     */
    public function show(string $slug): void
    {
        $post = BlogPost::findBySlug($slug);

        if (!$post) {
            http_response_code(404);
            if (file_exists(APP_PATH . '/Views/pages/404.php')) {
                require APP_PATH . '/Views/pages/404.php';
                return;
            }
            echo '<h1>404 — Post Not Found</h1>';
            return;
        }

        $this->view('blog-single', [
            'page'      => 'blog',
            'pageTitle' => $post->title,
            'metaDesc'  => $post->excerpt ?: mb_substr(strip_tags($post->content), 0, 160),
            'ogImage'   => $post->image ? url('uploads/blog/' . $post->image) : null,
            'post'      => $post,
        ]);
    }
}
