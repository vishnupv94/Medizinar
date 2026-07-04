<?php

namespace App\Controllers;

use App\Core\Controller;

class PageController extends Controller
{
    public function home(): void
    {
        $this->view('home', [
            'page'      => 'home',
            'pageTitle' => 'Compassionate Home Healthcare in Kerala',
            'metaDesc'  => 'Medizinar Care offers trusted home healthcare in Kerala — bedside patient care, elderly care, mother & baby care, and domestic support in Kottarakkara, Kollam and across Kerala.',
            'jsonLd'    => [
                '@context'        => 'https://schema.org',
                '@type'           => 'WebSite',
                'name'            => SITE_NAME,
                'url'             => SITE_URL,
                'description'     => 'Compassionate home healthcare services in Kerala — bedside patient care, elderly care, mother & baby care, housemaid services, and NRI parent care.',
                'potentialAction' => [
                    '@type'       => 'SearchAction',
                    'target'      => [
                        '@type'       => 'EntryPoint',
                        'urlTemplate' => SITE_URL . '/blog?q={search_term_string}',
                    ],
                    'query-input' => 'required name=search_term_string',
                ],
            ],
        ]);
    }

    public function about(): void
    {
        $this->view('about', [
            'page'      => 'about',
            'pageTitle' => 'About Us — Trusted Home Care Providers in Kerala',
            'metaDesc'  => 'Learn about Medizinar Care — our mission, vision, and the compassionate team dedicated to providing reliable home healthcare services in Kottarakkara, Kollam and across Kerala.',
        ]);
    }

    public function services(): void
    {
        $this->view('services', [
            'page'      => 'services',
            'pageTitle' => 'Home Care Services in Kerala — Elderly, Nursing & Patient Care',
            'metaDesc'  => 'Medizinar Care provides home nursing in Kerala — bedside patient care, elderly care, mother & baby care, housemaid services, NRI parent care and quick support in Kottarakkara, Kollam.',
            'jsonLd'    => [
                '@context'    => 'https://schema.org',
                '@type'       => 'ItemList',
                'name'        => 'Home Healthcare Services — Medizinar Care Kerala',
                'description' => 'Compassionate home care services across Kerala for patients, elderly individuals, and families.',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Bedside Patient Care', 'url' => SITE_URL . '/services'],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'Elderly Care',         'url' => SITE_URL . '/services'],
                    ['@type' => 'ListItem', 'position' => 3, 'name' => 'Mother & Baby Care',   'url' => SITE_URL . '/services'],
                    ['@type' => 'ListItem', 'position' => 4, 'name' => 'House Maid Services',  'url' => SITE_URL . '/services'],
                    ['@type' => 'ListItem', 'position' => 5, 'name' => 'NRI Parent Care',      'url' => SITE_URL . '/services'],
                    ['@type' => 'ListItem', 'position' => 6, 'name' => 'Quick Support',        'url' => SITE_URL . '/services'],
                ],
            ],
        ]);
    }

    public function team(): void
    {
        $this->view('team', [
            'page'      => 'team',
            'pageTitle' => 'Our Caregiving Team in Kerala — Medizinar Care',
            'metaDesc'  => 'Meet the Medizinar Care team — certified nurses, caregivers and support staff dedicated to compassionate home healthcare across Kottarakkara, Kollam and Kerala.',
        ]);
    }
}
