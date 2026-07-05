<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\BlogPost;
use App\Models\Service;
use App\Models\Location;

/**
 * Generates a fully dynamic XML sitemap for search engines.
 *
 * Static pages use a fixed priority and changefreq.
 * Service pages, location pages, and blog posts are all fetched from the DB —
 * so adding/removing content in admin automatically updates the sitemap.
 */
class SitemapController extends Controller
{
    /** @var array<array{loc:string, changefreq:string, priority:string, lastmod?:string|null}> */
    private array $staticPages = [
        ['loc' => '/',            'changefreq' => 'weekly',  'priority' => '1.0', 'lastmod' => '2025-06-01'],
        ['loc' => '/services',    'changefreq' => 'monthly', 'priority' => '0.9', 'lastmod' => '2025-06-01'],
        ['loc' => '/about',       'changefreq' => 'monthly', 'priority' => '0.8', 'lastmod' => '2025-05-01'],
        ['loc' => '/faq',         'changefreq' => 'weekly',  'priority' => '0.8', 'lastmod' => '2025-06-15'],
        ['loc' => '/team',        'changefreq' => 'monthly', 'priority' => '0.7', 'lastmod' => '2025-05-01'],
        ['loc' => '/blog',        'changefreq' => 'daily',   'priority' => '0.7', 'lastmod' => null],
        ['loc' => '/contact',     'changefreq' => 'monthly', 'priority' => '0.6', 'lastmod' => '2025-04-01'],
        ['loc' => '/appointment', 'changefreq' => 'monthly', 'priority' => '0.6', 'lastmod' => '2025-04-01'],
    ];

    public function index(): void
    {
        header('Content-Type: application/xml; charset=UTF-8');
        header('X-Robots-Tag: noindex');
        header('Cache-Control: public, max-age=3600');

        $baseUrl = rtrim(SITE_URL, '/');

        // Set /blog lastmod dynamically
        foreach ($this->staticPages as &$p) {
            if ($p['loc'] === '/blog' && $p['lastmod'] === null) {
                $p['lastmod'] = date('Y-m-d');
            }
        }
        unset($p);

        // --- Fetch dynamic content from DB ----------------------------------
        $posts     = [];
        $services  = [];
        $locations = [];

        try {
            $posts = BlogPost::getPublished(500, 0);
        } catch (\Throwable $e) {
            // Fail silently — sitemap still renders remaining pages
        }
        try {
            $services = Service::getPublished();
        } catch (\Throwable $e) {
            // Fail silently
        }
        try {
            $locations = Location::getPublished();
        } catch (\Throwable $e) {
            // Fail silently
        }
        // --------------------------------------------------------------------

        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' . "\n";
        echo '        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">' . "\n";

        // ---- Static pages --------------------------------------------------
        foreach ($this->staticPages as $p) {
            $loc = htmlspecialchars($baseUrl . $p['loc'], ENT_XML1 | ENT_COMPAT, 'UTF-8');
            echo "  <url>\n";
            echo "    <loc>{$loc}</loc>\n";
            if (!empty($p['lastmod'])) {
                echo "    <lastmod>{$p['lastmod']}</lastmod>\n";
            }
            echo "    <changefreq>{$p['changefreq']}</changefreq>\n";
            echo "    <priority>{$p['priority']}</priority>\n";
            echo "  </url>\n";
        }

        // ---- Service pages (from DB) ----------------------------------------
        foreach ($services as $svc) {
            if (empty($svc->slug)) {
                continue;
            }
            $loc     = htmlspecialchars($baseUrl . '/services/' . $svc->slug, ENT_XML1 | ENT_COMPAT, 'UTF-8');
            $lastmod = !empty($svc->updated_at) ? date('Y-m-d', strtotime($svc->updated_at)) : date('Y-m-d');
            echo "  <url>\n";
            echo "    <loc>{$loc}</loc>\n";
            echo "    <lastmod>{$lastmod}</lastmod>\n";
            echo "    <changefreq>monthly</changefreq>\n";
            echo "    <priority>0.9</priority>\n";
            echo "  </url>\n";
        }

        // ---- Location pages (from DB) ----------------------------------------
        foreach ($locations as $loc_row) {
            if (empty($loc_row->slug)) {
                continue;
            }
            $loc      = htmlspecialchars($baseUrl . '/location/' . $loc_row->slug, ENT_XML1 | ENT_COMPAT, 'UTF-8');
            $lastmod  = !empty($loc_row->updated_at) ? date('Y-m-d', strtotime($loc_row->updated_at)) : date('Y-m-d');
            $priority = number_format((float) ($loc_row->sitemap_priority ?? 0.7), 1);
            echo "  <url>\n";
            echo "    <loc>{$loc}</loc>\n";
            echo "    <lastmod>{$lastmod}</lastmod>\n";
            echo "    <changefreq>monthly</changefreq>\n";
            echo "    <priority>{$priority}</priority>\n";
            echo "  </url>\n";
        }

        // ---- Blog posts (from DB) ------------------------------------------
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

            if (!empty($post->image)) {
                $imgLoc     = htmlspecialchars($baseUrl . '/uploads/blog/' . $post->image, ENT_XML1 | ENT_COMPAT, 'UTF-8');
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
