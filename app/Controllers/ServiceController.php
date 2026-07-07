<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Service;

/**
 * Handles individual service landing pages at /services/{slug}
 * Data is read from the `services` and `service_faqs` database tables.
 */
class ServiceController extends Controller
{
    public function show(string $slug): void
    {
        $service = Service::findBySlug($slug);

        if (!$service) {
            http_response_code(404);
            $this->view('404', ['pageTitle' => 'Page Not Found']);
            return;
        }

        $features = Service::decodeFeatures($service);
        $faqs     = Service::getFaqs((int) $service->id);

        // MedicalTherapy JSON-LD
        $jsonLd = [
            '@context'    => 'https://schema.org',
            '@type'       => 'MedicalTherapy',
            'name'        => $service->schema_name,
            'description' => $service->schema_desc,
            'url'         => SITE_URL . '/services/' . $service->slug,
            'provider'    => [
                '@type'     => 'MedicalBusiness',
                'name'      => SITE_NAME,
                'url'       => SITE_URL,
                'telephone' => '+91' . PHONE,
                'address'   => [
                    '@type'           => 'PostalAddress',
                    'addressLocality' => 'Kottarakkara',
                    'addressRegion'   => 'Kerala',
                    'addressCountry'  => 'IN',
                ],
                'areaServed' => [
                    ['@type' => 'State', 'name' => 'Kerala'],
                    ['@type' => 'City',  'name' => 'Kottarakkara'],
                    ['@type' => 'City',  'name' => 'Kollam'],
                ],
            ],
        ];

        // FAQPage JSON-LD (only if FAQs exist)
        $faqJsonLd = null;
        if (!empty($faqs)) {
            $faqJsonLd = [
                '@context'   => 'https://schema.org',
                '@type'      => 'FAQPage',
                'mainEntity' => array_map(fn($f) => [
                    '@type'          => 'Question',
                    'name'           => $f->question,
                    'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f->answer],
                ], $faqs),
            ];
        }

        $this->view('service-single', [
            'page'      => 'services',
            'pageTitle' => $service->title,
            'metaDesc'  => $service->meta_desc,
            'jsonLd'    => $jsonLd,
            'faqJsonLd' => $faqJsonLd,
            'service'   => $service,
            'features'  => $features,
            'faqs'      => $faqs,
            'slug'      => $service->slug,
        ]);
    }
}
