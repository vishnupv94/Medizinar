<!DOCTYPE html>
<html lang="en-IN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php if (defined('GA_MEASUREMENT_ID') && GA_MEASUREMENT_ID): ?>
    <!-- Google Analytics — Consent Mode v2 -->
    <!-- Step 1: Set consent defaults BEFORE loading gtag so no hits fire without consent -->
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      // Default: deny analytics until user accepts cookie consent
      gtag('consent', 'default', {
        analytics_storage:    'denied',
        ad_storage:           'denied',
        ad_user_data:         'denied',
        ad_personalization:   'denied',
        wait_for_update:      500,
      });
    </script>
    <!-- Step 2: Load the gtag.js library -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= h(GA_MEASUREMENT_ID) ?>"></script>
    <!-- Step 3: Configure GA -->
    <script>
      gtag('js', new Date());
      gtag('config', '<?= h(GA_MEASUREMENT_ID) ?>', { send_page_view: true });
    </script>
    <?php endif; ?>


    <title><?= isset($pageTitle) ? h($pageTitle) . ' — ' . SITE_NAME : SITE_NAME . ' | ' . SITE_TAGLINE ?></title>
    <meta name="description" content="<?= isset($metaDesc) ? h($metaDesc) : 'Medizinar Care provides reliable and compassionate home care services including bedside patient care, elderly care, mother &amp; baby care, and domestic support.' ?>">

    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <?php
        // Strip query-string from canonical to avoid duplicate content issues
        $canonicalPath = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
        $canonicalUrl  = rtrim(SITE_URL, '/') . ($canonicalPath === '/' ? '' : rtrim($canonicalPath, '/'));
    ?>
    <link rel="canonical" href="<?= h($canonicalUrl) ?>">
    <link rel="alternate" hreflang="en-IN" href="<?= h($canonicalUrl) ?>">
    <link rel="alternate" hreflang="x-default" href="<?= h($canonicalUrl) ?>">
    <meta name="author" content="<?= SITE_NAME ?>">
    <meta name="theme-color" content="#186c21">
    <meta name="keywords" content="home healthcare Kerala, home nursing Kerala, bedside patient care Kottarakkara, elderly care Kollam, mother baby care Kerala, housemaid services Kerala, NRI parent care India, caregiver Kerala, Medizinar Care">
    <meta name="geo.region" content="IN-KL">
    <meta name="geo.placename" content="Kottarakkara, Kollam, Kerala, India">
    <meta name="geo.position" content="8.9905;76.7795">
    <meta name="ICBM" content="8.9905, 76.7795">
    <meta name="format-detection" content="telephone=no">

    <!-- Open Graph / Facebook / WhatsApp / LinkedIn -->
    <?php
        $ogTitle = isset($pageTitle) ? h($pageTitle) . ' — ' . SITE_NAME : SITE_NAME . ' | ' . SITE_TAGLINE;
        $ogDesc  = isset($metaDesc) ? h($metaDesc) : 'Medizinar Care provides reliable and compassionate home care services including bedside patient care, elderly care, mother & baby care, and domestic support in Kerala.';
        $ogUrl   = $canonicalUrl;
        $ogImage = isset($ogImage) && $ogImage ? $ogImage : asset('images/og-image.png');
    ?>
    <meta property="og:type" content="<?= isset($ogType) ? h($ogType) : 'website' ?>">
    <meta property="og:site_name" content="<?= SITE_NAME ?>">
    <meta property="og:title" content="<?= $ogTitle ?>">
    <meta property="og:description" content="<?= $ogDesc ?>">
    <meta property="og:url" content="<?= h($ogUrl) ?>">
    <meta property="og:image" content="<?= h($ogImage) ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="675">
    <meta property="og:image:alt" content="Medizinar Care – Compassionate Home Healthcare Services in Kerala">
    <meta property="og:locale" content="en_IN">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= $ogTitle ?>">
    <meta name="twitter:description" content="<?= $ogDesc ?>">
    <meta name="twitter:image" content="<?= h($ogImage) ?>">
    <meta name="twitter:image:alt" content="Medizinar Care – Compassionate Home Healthcare Services in Kerala">

    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?= asset('images/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= asset('images/favicon-192x192.png') ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= asset('images/apple-touch-icon.png') ?>">
    <link rel="manifest" href="<?= asset('site.webmanifest') ?>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;0,9..40,800;1,9..40,400&display=swap" rel="stylesheet">

    <?php if (($page ?? '') === 'home'): ?>
    <!-- Preload LCP hero image for faster Largest Contentful Paint -->
    <link rel="preload" as="image" href="<?= asset('images/medizinar-care-home-hero.webp') ?>" type="image/webp">
    <?php endif; ?>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#186c21',
                            50: '#f0faf1',
                            100: '#e0f4e2',
                            200: '#b8e6bc',
                            300: '#8dd493',
                            400: '#55ba5d',
                            500: '#2fa038',
                            600: '#218328',
                            700: '#186c21',
                            800: '#0f5219',
                            900: '#0a3d12',
                        },
                        accent: {
                            DEFAULT: '#ab7e22',
                            light: '#f8eed8',
                            hover: '#c4922a',
                            dark: '#7a5514',
                        }
                    },
                    fontFamily: {
                        sans: ['"DM Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                    boxShadow: {
                        card: '0 2px 16px 0 rgba(23,107,35,0.09)',
                    }
                }
            }
        }
    </script>

    <link rel="stylesheet" href="<?= asset('css/app.css') ?>?v=<?= filemtime(ROOT_PATH . '/assets/css/app.css') ?>">

    <?php if (recaptcha_enabled()): ?>
    <script src="https://www.google.com/recaptcha/api.js?render=<?= h(recaptcha_site_key()) ?>" async defer></script>
    <?php endif; ?>

    <!-- JSON-LD: Organisation / MedicalBusiness (sitewide) -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": ["MedicalBusiness", "LocalBusiness"],
        "name": "<?= SITE_NAME ?>",
        "alternateName": "Medizinar Care Kerala",
        "description": "<?= $ogDesc ?>",
        "url": "<?= h(SITE_URL) ?>",
        "logo": "<?= asset('images/favicon-512x512.png') ?>",
        "image": "<?= h($ogImage) ?>",
        "telephone": "+91<?= PHONE ?>",
        "email": "<?= EMAIL ?>",
        "hasMap": "https://maps.google.com/?q=Medizinar+Care+Kottarakkara+Kerala",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "<?= ADDRESS_LINE1 ?>",
            "addressLocality": "Kottarakkara",
            "addressRegion": "Kerala",
            "postalCode": "691532",
            "addressCountry": "IN"
        },
        "geo": {
            "@type": "GeoCoordinates",
            "latitude": "8.9905",
            "longitude": "76.7795"
        },
        "openingHoursSpecification": [{
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],
            "opens": "00:00",
            "closes": "23:59"
        }],
        "sameAs": [
            "https://www.facebook.com/share/1bADZmQVno/",
            "https://www.instagram.com/medizinarcare",
            "https://www.youtube.com/@MedizinarCare",
            "https://www.linkedin.com/company/medizinar/"
        ],
        "priceRange": "$$",
        "currenciesAccepted": "INR",
        "paymentAccepted": "Cash, Bank Transfer, UPI",
        "areaServed": [
            {"@type": "State",   "name": "Kerala"},
            {"@type": "City",    "name": "Kottarakkara"},
            {"@type": "City",    "name": "Kollam"},
            {"@type": "Country", "name": "India"}
        ],
        "availableService": [
            {"@type": "MedicalTherapy", "name": "Bedside Patient Care"},
            {"@type": "MedicalTherapy", "name": "Elderly Care"},
            {"@type": "MedicalTherapy", "name": "Mother & Baby Care"},
            {"@type": "Service",        "name": "House Maid Services"},
            {"@type": "MedicalTherapy", "name": "NRI Parent Care"},
            {"@type": "Service",        "name": "Quick Support"}
        ]
    }
    </script>

    <?php if (!empty($jsonLd)): ?>
    <!-- JSON-LD: Page-specific structured data -->
    <script type="application/ld+json">
    <?= json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
    </script>
    <?php endif; ?>

    <?php if (!empty($aggregateRatingJsonLd)): ?>
    <!-- JSON-LD: AggregateRating -->
    <script type="application/ld+json">
    <?= json_encode($aggregateRatingJsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
    </script>
    <?php endif; ?>

    <?php
    // BreadcrumbList schema — inject on all inner pages (not home)
    $breadcrumbMap = [
        'about'    => ['name' => 'About Us',      'url' => '/about'],
        'services' => ['name' => 'Services',       'url' => '/services'],
        'blog'     => ['name' => 'Blog',           'url' => '/blog'],
        'faq'      => ['name' => 'FAQ',            'url' => '/faq'],
        'team'     => ['name' => 'Our Team',       'url' => '/team'],
        'contact'  => ['name' => 'Contact Us',     'url' => '/contact'],
        'appointment' => ['name' => 'Make an Appointment', 'url' => '/appointment'],
    ];
    $currentPage = $page ?? '';
    $bcItems = [];
    if ($currentPage && isset($breadcrumbMap[$currentPage])) {
        $bcItems = [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',   'item' => SITE_URL . '/'],
            ['@type' => 'ListItem', 'position' => 2,
             'name' => $breadcrumbMap[$currentPage]['name'],
             'item' => SITE_URL . $breadcrumbMap[$currentPage]['url']],
        ];
    } elseif ($currentPage === 'blog-single' && !empty($pageTitle)) {
        $bcItems = [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',  'item' => SITE_URL . '/'],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Blog',  'item' => SITE_URL . '/blog'],
            ['@type' => 'ListItem', 'position' => 3, 'name' => h($pageTitle), 'item' => $canonicalUrl],
        ];
    }
    if (!empty($bcItems)):
    ?>
    <!-- JSON-LD: BreadcrumbList -->
    <script type="application/ld+json">
    <?= json_encode([
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => $bcItems,
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
    </script>
    <?php endif; ?>
</head>

<body class="font-sans text-gray-800 bg-white antialiased">

    <?php partial('topbar') ?>

    <?php partial('nav', ['page' => $page ?? '']) ?>

    <?php partial('success-popup') ?>

    <?php if ($msg = flash('error')): ?>
        <div class="bg-red-50 border-b border-red-200 px-4 py-3 text-sm text-red-700 text-center"><?= h($msg) ?></div>
    <?php endif; ?>

    <?= $content ?>

    <?php partial('floating-buttons') ?>

    <?php partial('footer') ?>

    <script src="<?= asset('js/app.js') ?>?v=<?= filemtime(ROOT_PATH . '/assets/js/app.js') ?>"></script>

    <?php if (defined('GA_MEASUREMENT_ID') && GA_MEASUREMENT_ID): ?>
    <!-- GA4 Conversion Events -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        function safeGtag() {
            if (typeof gtag === 'function') gtag.apply(null, arguments);
        }
        // Track all phone link clicks
        document.querySelectorAll('a[href^="tel:"]').forEach(function (el) {
            el.addEventListener('click', function () {
                safeGtag('event', 'phone_call_click', {
                    event_category: 'Lead',
                    event_label: el.href,
                });
            });
        });
        // Track all WhatsApp link clicks
        document.querySelectorAll('a[href*="wa.me"], a[href*="api.whatsapp.com"]').forEach(function (el) {
            el.addEventListener('click', function () {
                safeGtag('event', 'whatsapp_click', {
                    event_category: 'Lead',
                    event_label: 'WhatsApp CTA',
                });
            });
        });
        // Track form submissions (contact & appointment)
        document.querySelectorAll('form').forEach(function (form) {
            form.addEventListener('submit', function () {
                var formName = form.getAttribute('action') || window.location.pathname;
                safeGtag('event', 'form_submit', {
                    event_category: 'Lead',
                    event_label: formName,
                });
            });
        });
    });
    </script>
    <?php endif; ?>

    <?php partial('cookie-consent') ?>

</body>


</html>
