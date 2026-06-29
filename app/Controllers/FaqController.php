<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index(): void
    {
        $this->view('faq', [
            'page'      => 'faq',
            'pageTitle' => 'Frequently Asked Questions',
            'metaDesc'  => 'Frequently asked questions (FAQs) about Medizinar Care - home healthcare, bedside patient care, elderly care, and domestic support services in Kerala.',
            'faqs'      => Faq::getPublished(),
        ]);
    }
}
