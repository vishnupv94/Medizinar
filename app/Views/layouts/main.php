<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? h($pageTitle) . ' — ' . SITE_NAME : SITE_NAME . ' | ' . SITE_TAGLINE ?></title>
    <meta name="description" content="<?= isset($metaDesc) ? h($metaDesc) : 'Medizinar Care provides reliable and compassionate home care services including bedside patient care, elderly care, mother &amp; baby care, and domestic support.' ?>">

    <!-- SEO Meta -->
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <link rel="canonical" href="<?= h(SITE_URL . ($_SERVER['REQUEST_URI'] === '/' ? '' : rtrim($_SERVER['REQUEST_URI'], '/'))) ?>">
    <meta name="author" content="<?= SITE_NAME ?>">
    <meta name="theme-color" content="#186c21">
    <meta name="keywords" content="home healthcare Kerala, bedside patient care, elderly care, mother baby care, housemaid services, NRI parent care, caregiver services, Medizinar Care, Kottarakkara, Kollam">
    <meta name="geo.region" content="IN-KL">
    <meta name="geo.placename" content="Kottarakkara, Kollam, Kerala">

    <!-- Open Graph / Facebook / WhatsApp / LinkedIn -->
    <?php
        $ogTitle = isset($pageTitle) ? h($pageTitle) . ' — ' . SITE_NAME : SITE_NAME . ' | ' . SITE_TAGLINE;
        $ogDesc  = isset($metaDesc) ? h($metaDesc) : 'Medizinar Care provides reliable and compassionate home care services including bedside patient care, elderly care, mother & baby care, and domestic support in Kerala.';
        $ogUrl   = SITE_URL . ($_SERVER['REQUEST_URI'] === '/' ? '' : rtrim($_SERVER['REQUEST_URI'], '/'));
        $ogImage = asset('images/og-image.png');
    ?>
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?= SITE_NAME ?>">
    <meta property="og:title" content="<?= $ogTitle ?>">
    <meta property="og:description" content="<?= $ogDesc ?>">
    <meta property="og:url" content="<?= h($ogUrl) ?>">
    <meta property="og:image" content="<?= h($ogImage) ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
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

    <!-- JSON-LD Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "<?= SITE_NAME ?>",
        "description": "<?= $ogDesc ?>",
        "url": "<?= h(SITE_URL) ?>",
        "logo": "<?= asset('images/favicon-512x512.png') ?>",
        "image": "<?= h($ogImage) ?>",
        "telephone": "+91<?= PHONE ?>",
        "email": "<?= EMAIL ?>",
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
        "openingHoursSpecification": {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
            "opens": "00:00",
            "closes": "23:59"
        },
        "sameAs": [
            "https://www.facebook.com/share/1bADZmQVno/",
            "https://www.instagram.com/medizinarcare",
            "https://www.youtube.com/@MedizinarCare",
            "https://www.linkedin.com/company/medizinar/"
        ],
        "priceRange": "$$",
        "areaServed": {
            "@type": "State",
            "name": "Kerala"
        },
        "serviceType": ["Bedside Patient Care", "Elderly Care", "Mother & Baby Care", "House Maid Services", "NRI Parent Care"]
    }
    </script>
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
</body>

</html>
