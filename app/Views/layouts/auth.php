<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? h($pageTitle) : 'Login' ?> | <?= SITE_NAME ?></title>
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
                            700: '#176B23'
                        },
                        accent: {
                            DEFAULT: '#a5781e',
                            light: '#f8eed8'
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
</head>

<body class="font-sans bg-gray-100 text-gray-800 antialiased min-h-screen flex items-center justify-center">
    <?= $content ?>
</body>

</html>