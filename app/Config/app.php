<?php

define('SITE_NAME', 'Medizinar Care');
define('SITE_TAGLINE', 'Compassionate Home Healthcare');
define('SITE_URL', rtrim(env('SITE_URL', 'http://localhost:8000'), '/'));

define('PHONE', '9745782716');
define('PHONE_DISPLAY', '+91 97457 82716');
define('WHATSAPP_NUM', '919745782716');
define('EMAIL', 'Care@medizinarcare.com');

define('ADDRESS_LINE1', 'Melkulangara, Vayakal Post Office');
define('ADDRESS_LINE2', 'Kottarakkara, Kollam District – 691532');
define('ADDRESS_LINE3', 'Kerala, India');

define('MAIL_TO', env('MAIL_TO', 'Care@medizinarcare.com'));
define('MAIL_FROM', env('MAIL_FROM', 'noreply@medizinarcare.com'));
define('MAIL_FROM_NAME', env('MAIL_FROM_NAME', 'Medizinar Care Website'));

define('RECAPTCHA_SITE_KEY', env('RECAPTCHA_SITE_KEY', ''));
define('RECAPTCHA_SECRET_KEY', env('RECAPTCHA_SECRET_KEY', ''));

define('GOOGLE_MAPS_EMBED_URL', env('GOOGLE_MAPS_EMBED_URL', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3942.5!2d76.7795!3d8.9905!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b05f82a4b3e9e9b%3A0x0!2sKottarakkara%2C+Kollam%2C+Kerala!5e0!3m2!1sen!2sin!4v1'));


define('NAV_LINKS', [
    ['label' => 'Home',       'href' => '/',           'key' => 'home'],
    ['label' => 'About Us',   'href' => '/about',      'key' => 'about'],
    ['label' => 'Services',   'href' => '/services',   'key' => 'services'],
    ['label' => 'Our Team',   'href' => '/team',       'key' => 'team'],
    ['label' => 'Blog',       'href' => '/blog',       'key' => 'blog'],
    ['label' => 'Contact Us', 'href' => '/contact',    'key' => 'contact'],
]);
