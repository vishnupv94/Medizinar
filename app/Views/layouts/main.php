<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? h($pageTitle) . ' — ' . SITE_NAME : SITE_NAME . ' | ' . SITE_TAGLINE ?></title>
    <meta name="description" content="<?= isset($metaDesc) ? h($metaDesc) : 'Medizinar Care provides reliable and compassionate home care services including bedside patient care, elderly care, mother &amp; baby care, and domestic support.' ?>">

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

    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Ccircle cx='16' cy='16' r='15' fill='%23176B23'/%3E%3Crect x='13' y='8' width='6' height='16' rx='2' fill='white'/%3E%3Crect x='8' y='13' width='16' height='6' rx='2' fill='white'/%3E%3Ccircle cx='16' cy='16' r='3' fill='%23a5781e'/%3E%3C/svg%3E">
</head>

<body class="font-sans text-gray-800 bg-white antialiased">

    <?php partial('topbar') ?>

    <?php partial('nav', ['page' => $page ?? '']) ?>

    <?= $content ?>

    <?php partial('floating-buttons') ?>

    <?php partial('footer') ?>

    <script src="<?= asset('js/app.js') ?>"></script>
</body>

</html>