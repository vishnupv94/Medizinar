<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index(): void
    {
        $faqs = Faq::getPublished();

        // Build FAQPage JSON-LD from live DB entries (eligible for Google FAQ rich results)
        $faqItems = [];
        foreach ($faqs as $faq) {
            $faqItems[] = [
                '@type'          => 'Question',
                'name'           => $faq->question,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text'  => $faq->answer,
                ],
            ];
        }

        $jsonLd = !empty($faqItems) ? [
            '@context'   => 'https://schema.org',
            '@type'      => 'FAQPage',
            'name'       => 'Frequently Asked Questions — Medizinar Care Kerala',
            'url'        => SITE_URL . '/faq',
            'mainEntity' => $faqItems,
        ] : null;

        $this->view('faq', [
            'page'      => 'faq',
            'pageTitle' => 'FAQ — Home Healthcare Questions Answered | Kerala',
            'metaDesc'  => 'Answers to common questions about Medizinar Care home healthcare services — bedside care, elderly care, mother & baby care and domestic support in Kerala.',
            'faqs'      => $faqs,
            'jsonLd'    => $jsonLd,
        ]);
    }
}
