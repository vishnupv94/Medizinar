<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\BlogPost;

/**
 * Generates a dynamic XML sitemap for search engines.
 *
 * Static pages use a fixed priority and changefreq.
 * Blog posts are fetched from the database and use slug-based URLs.
 */
class SitemapController extends Controller
{
    /** @var array<array{loc:string, changefreq:string, priority:string, lastmod?:string}> */
    private array $staticPages = [
        ['loc' => '/',           'changefreq' => 'weekly',  'priority' => '1.0'],
        ['loc' => '/services',   'changefreq' => 'monthly', 'priority' => '0.9'],
        ['loc' => '/about',      'changefreq' => 'monthly', 'priority' => '0.8'],
        ['loc' => '/faq',        'changefreq' => 'weekly',  'priority' => '0.8'],
        ['loc' => '/team',       'changefreq' => 'monthly', 'priority' => '0.7'],
        ['loc' => '/blog',       'changefreq' => 'daily',   'priority' => '0.7'],
        ['loc' => '/contact',    'changefreq' => 'monthly', 'priority' => '0.6'],
        ['loc' => '/appointment','changefreq' => 'monthly', 'priority' => '0.6'],
    ];

    public function index(): void
    {
        header('Content-Type: application/xml; charset=UTF-8');
        header('X-Robots-Tag: noindex');
        header('Cache-Control: public, max-age=3600');

        $baseUrl = rtrim(SITE_URL, '/');

        // Fetch all published blog posts
        $posts = [];
        try {
            $posts = BlogPost::getPublished(500, 0);
        } catch (\Throwable $e) {
            // Fail silently — sitemap still renders static pages
        }

        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' . "\n";
        echo '        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">' . "\n";

        // Static pages
        foreach ($this->staticPages as $p) {
            $loc = htmlspecialchars($baseUrl . $p['loc'], ENT_XML1 | ENT_COMPAT, 'UTF-8');
            echo "  <url>\n";
            echo "    <loc>{$loc}</loc>\n";
            echo "    <changefreq>{$p['changefreq']}</changefreq>\n";
            echo "    <priority>{$p['priority']}</priority>\n";
            echo "  </url>\n";
        }

        // Dynamic blog post pages
        foreach ($posts as $post) {
            if (empty($post->slug)) {
                continue;
            }
            $loc     = htmlspecialchars($baseUrl . '/blog/' . $post->slug, ENT_XML1 | ENT_COMPAT, 'UTF-8');
            $lastmod = !empty($post->updated_at) ? date('Y-m-d', strtotime($post->updated_at)) : date('Y-m-d');

            echo "  <url>\n";
            echo "    <loc>{$loc}</loc>\n";
            echo "    <lastmod>{$lastmod}</lastmod>\n";
            echo "    <changefreq>monthly</changefreq>\n";
            echo "    <priority>0.6</priority>\n";

            // Include OG image as sitemap image if available
            if (!empty($post->image)) {
                $imgLoc = htmlspecialchars($baseUrl . '/uploads/blog/' . $post->image, ENT_XML1 | ENT_COMPAT, 'UTF-8');
                $imgCaption = htmlspecialchars($post->title ?? '', ENT_XML1 | ENT_COMPAT, 'UTF-8');
                echo "    <image:image>\n";
                echo "      <image:loc>{$imgLoc}</image:loc>\n";
                echo "      <image:caption>{$imgCaption}</image:caption>\n";
                echo "    </image:image>\n";
            }

            echo "  </url>\n";
        }

        echo '</urlset>';
        exit;
    }
}
