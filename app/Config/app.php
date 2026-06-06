<?php

define('SITE_NAME', 'Medizinar Care');
define('SITE_TAGLINE', 'Compassionate Home Healthcare');
define('SITE_URL', rtrim(env('SITE_URL', 'http://localhost:8000'), '/'));

define('PHONE', '9745782716');
define('PHONE_DISPLAY', '+91 97457 82716');
define('WHATSAPP_NUM', '919745782716');
define('EMAIL', 'Care@medizinarcare.com');

define('ADDRESS_LINE1', 'Melkulangara, Vayakal B.O');
define('ADDRESS_LINE2', 'Kottarakkara, Kollam District – 691532');
define('ADDRESS_LINE3', 'Kerala, India');

define('MAIL_TO', env('MAIL_TO', 'Care@medizinarcare.com'));
define('MAIL_FROM', env('MAIL_FROM', 'noreply@medizinarcare.com'));
define('MAIL_FROM_NAME', env('MAIL_FROM_NAME', 'Medizinar Care Website'));

define('NAV_LINKS', [
    ['label' => 'Home',       'href' => '/',           'key' => 'home'],
    ['label' => 'About Us',   'href' => '/about',      'key' => 'about'],
    ['label' => 'Services',   'href' => '/services',   'key' => 'services'],
    ['label' => 'Our Team',   'href' => '/team',       'key' => 'team'],
    ['label' => 'Contact Us', 'href' => '/contact',    'key' => 'contact'],
]);
