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
            'page'        => 'blog',
            'pageTitle'   => 'Health Tips & Home Care Insights Blog | Kerala',
            'metaDesc'    => 'Health tips, home nursing guides, and wellness articles from Medizinar Care — your trusted home healthcare partner in Kerala. Read our latest posts.',
            'posts'       => BlogPost::getPublished($limit, $offset),
            'currentPage' => $page,
            'totalPages'  => $pages,
            'total'       => $total,
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

        $metaDesc = $post->excerpt ?: mb_substr(strip_tags($post->content ?? ''), 0, 155);
        $postUrl  = SITE_URL . '/blog/' . $post->slug;
        $postImg  = $post->image ? SITE_URL . '/uploads/blog/' . $post->image : null;

        $this->view('blog-single', [
            'page'      => 'blog',
            'pageTitle' => $post->title,
            'metaDesc'  => $metaDesc,
            'ogImage'   => $postImg,
            'post'      => $post,
            'jsonLd'    => [
                '@context'         => 'https://schema.org',
                '@type'            => 'Article',
                'headline'         => $post->title,
                'description'      => $metaDesc,
                'url'              => $postUrl,
                'datePublished'    => date('c', strtotime($post->created_at ?? 'now')),
                'dateModified'     => date('c', strtotime($post->updated_at ?? $post->created_at ?? 'now')),
                'author'           => [
                    '@type' => 'Organization',
                    'name'  => SITE_NAME,
                    'url'   => SITE_URL,
                ],
                'publisher' => [
                    '@type' => 'Organization',
                    'name'  => SITE_NAME,
                    'url'   => SITE_URL,
                    'logo'  => [
                        '@type' => 'ImageObject',
                        'url'   => SITE_URL . '/assets/images/favicon-512x512.png',
                    ],
                ],
                'image'       => $postImg ?: (SITE_URL . '/assets/images/og-image.png'),
                'mainEntityOfPage' => [
                    '@type' => 'WebPage',
                    '@id'   => $postUrl,
                ],
                'inLanguage'  => 'en-IN',
                'about'       => [
                    '@type' => 'MedicalBusiness',
                    'name'  => SITE_NAME,
                    'url'   => SITE_URL,
                ],
            ],
        ]);
    }
}
