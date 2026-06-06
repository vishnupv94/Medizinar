<?php

namespace App\Controllers;

use App\Core\Controller;

class PageController extends Controller
{
    public function home(): void
    {
        $this->view('home', [
            'page'      => 'home',
            'pageTitle' => 'Compassionate Home Healthcare',
            'metaDesc'  => 'Medizinar Care provides reliable and compassionate home care services including bedside patient care, elderly care, mother & baby care, and domestic support in Kerala.',
        ]);
    }

    public function about(): void
    {
        $this->view('about', [
            'page'      => 'about',
            'pageTitle' => 'About Us',
            'metaDesc'  => 'Learn about Medizinar Care — our mission, vision, values, and the compassionate team dedicated to providing reliable home healthcare services in Kerala.',
        ]);
    }

    public function services(): void
    {
        $this->view('services', [
            'page'      => 'services',
            'pageTitle' => 'Our Services',
            'metaDesc'  => 'Medizinar Care offers bedside patient care, elderly care, mother & baby care, house maid services, and quick support services across Kerala.',
        ]);
    }

    public function team(): void
    {
        $this->view('team', [
            'page'      => 'team',
            'pageTitle' => 'Our Team',
            'metaDesc'  => 'Meet the Medizinar Care team — dedicated professionals committed to providing compassionate and reliable home healthcare services in Kerala.',
        ]);
    }
}
