<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? h($pageTitle) . ' — Admin' : 'Admin' ?> | <?= SITE_NAME ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#176B23',
                            50: '#f0faf1',
                            100: '#e0f4e2',
                            500: '#2fa038',
                            600: '#218328',
                            700: '#176B23',
                            800: '#0f5219'
                        },
                        accent: {
                            DEFAULT: '#a5781e',
                            light: '#f8eed8',
                            hover: '#bf8b21'
                        },
                        sidebar: {
                            DEFAULT: '#111827',
                            hover: '#1f2937',
                            active: '#164a1c'
                        }
                    },
                    fontFamily: {
                        sans: ['"DM Sans"', 'system-ui', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Ccircle cx='16' cy='16' r='15' fill='%23176B23'/%3E%3Crect x='13' y='8' width='6' height='16' rx='2' fill='white'/%3E%3Crect x='8' y='13' width='16' height='6' rx='2' fill='white'/%3E%3Ccircle cx='16' cy='16' r='3' fill='%23a5781e'/%3E%3C/svg%3E">
    <style>
        [x-cloak] { display: none !important; }

        .admin-scrollbar::-webkit-scrollbar { width: 6px; }
        .admin-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .admin-scrollbar::-webkit-scrollbar-thumb { background: #4b5563; border-radius: 3px; }
    </style>
</head>

<body class="font-sans bg-gray-100 text-gray-800 antialiased overflow-x-hidden">
    <?php partial('success-popup') ?>
    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar: fixed/off-canvas on mobile, static on lg+ -->
        <?php partial('admin/sidebar', ['adminPage' => $adminPage ?? '']) ?>

        <!-- Content: takes full width (sidebar is out of flow on mobile) -->
        <div class="flex-1 flex flex-col overflow-hidden min-w-0">

            <?php partial('admin/topbar') ?>

            <main class="flex-1 overflow-y-auto p-4 sm:p-6 admin-scrollbar">
                <?php if ($msg = flash('error')): ?>
                    <div class="mb-4 rounded-lg bg-red-50 border border-red-200 text-red-800 px-4 py-3 text-sm"><?= h($msg) ?></div>
                <?php endif; ?>

                <?= $content ?>
            </main>
        </div>
    </div>

    <script>
        document.querySelectorAll('[data-confirm]').forEach(function(el) {
            el.addEventListener('submit', function(e) {
                if (!confirm(el.dataset.confirm)) e.preventDefault();
            });
        });
    </script>
    <script src="<?= asset('js/app.js') ?>?v=<?= filemtime(ROOT_PATH . '/assets/js/app.js') ?>"></script>
</body>

</html>
