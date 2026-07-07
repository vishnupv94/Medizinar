<?php http_response_code(404); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found — <?= SITE_NAME ?></title>
    <meta name="robots" content="noindex, nofollow">

    <link rel="icon" type="image/png" sizes="32x32" href="<?= asset('images/favicon-32x32.png') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #186c21;
            --primary-dark: #0f5219;
            --accent: #ab7e22;
            --accent-hover: #c4922a;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DM Sans', system-ui, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: linear-gradient(160deg, #f0faf1 0%, #ffffff 40%, #f8eed8 100%);
            color: #1a2e1a;
            overflow: hidden;
            position: relative;
        }

        /* Dot pattern background */
        body::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle at 1px 1px, rgba(24,108,33,0.04) 1px, transparent 0);
            background-size: 32px 32px;
            pointer-events: none;
        }

        .container {
            text-align: center;
            padding: 2rem 1.5rem;
            position: relative;
            z-index: 1;
            max-width: 600px;
        }

        /* Animated illustration */
        .illustration {
            position: relative;
            width: 280px;
            height: 220px;
            margin: 0 auto 2.5rem;
        }

        .big-404 {
            font-size: 8rem;
            font-weight: 800;
            line-height: 1;
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
            animation: float 4s ease-in-out infinite;
            user-select: none;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-12px); }
        }

        /* Decorative cross/plus */
        .cross {
            position: absolute;
            width: 36px;
            height: 36px;
            opacity: 0.15;
        }
        .cross::before, .cross::after {
            content: '';
            position: absolute;
            background: var(--primary);
            border-radius: 3px;
        }
        .cross::before {
            width: 100%;
            height: 8px;
            top: 50%;
            transform: translateY(-50%);
        }
        .cross::after {
            width: 8px;
            height: 100%;
            left: 50%;
            transform: translateX(-50%);
        }
        .cross-1 { top: 10px; left: 15px; animation: spin-slow 12s linear infinite; }
        .cross-2 { top: 20px; right: 10px; width: 24px; height: 24px; animation: spin-slow 16s linear infinite reverse; }
        .cross-3 { bottom: 15px; left: 40px; width: 20px; height: 20px; animation: spin-slow 10s linear infinite; }
        .cross-4 { bottom: 30px; right: 35px; width: 28px; height: 28px; opacity: 0.1; animation: spin-slow 14s linear infinite reverse; }

        @keyframes spin-slow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* Pulsing circle behind 404 */
        .pulse-ring {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            border: 2px solid rgba(24,108,33,0.08);
            transform: translate(-50%, -50%);
            animation: pulse-ring 3s ease-out infinite;
        }
        .pulse-ring:nth-child(2) { animation-delay: 1s; }
        .pulse-ring:nth-child(3) { animation-delay: 2s; }

        @keyframes pulse-ring {
            0% { transform: translate(-50%, -50%) scale(0.8); opacity: 1; }
            100% { transform: translate(-50%, -50%) scale(1.8); opacity: 0; }
        }

        /* Badge */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(24,108,33,0.08);
            color: var(--primary);
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 6px 14px;
            border-radius: 99px;
            margin-bottom: 1rem;
        }
        .badge::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--accent);
        }

        h1 {
            font-size: clamp(1.5rem, 4vw, 2rem);
            font-weight: 800;
            color: #1a2e1a;
            margin-bottom: 0.75rem;
            line-height: 1.2;
        }

        .description {
            color: #4d7055;
            font-size: 1rem;
            line-height: 1.7;
            margin-bottom: 2rem;
            max-width: 440px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Buttons */
        .actions {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 12px;
            margin-bottom: 2.5rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: inherit;
            font-weight: 700;
            font-size: 0.9rem;
            padding: 13px 28px;
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background: var(--accent);
            color: white;
            box-shadow: 0 2px 8px rgba(165,120,30,0.3);
        }
        .btn-primary:hover {
            background: var(--accent-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(165,120,30,0.35);
        }

        .btn-outline {
            background: white;
            color: var(--primary);
            border: 1.5px solid #d4e8d5;
            box-shadow: 0 1px 4px rgba(0,0,0,0.04);
        }
        .btn-outline:hover {
            background: #f0faf1;
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(24,108,33,0.1);
        }

        .btn svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }

        /* Quick links */
        .quick-links {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 6px 20px;
        }
        .quick-links a {
            font-size: 0.85rem;
            color: #4d7055;
            text-decoration: none;
            padding: 4px 0;
            transition: color 0.2s ease;
            position: relative;
        }
        .quick-links a::after {
            content: '';
            position: absolute;
            bottom: 2px;
            left: 0;
            width: 0;
            height: 1.5px;
            background: var(--accent);
            transition: width 0.25s ease;
        }
        .quick-links a:hover {
            color: var(--primary);
        }
        .quick-links a:hover::after {
            width: 100%;
        }

        /* Accent bar at top */
        .top-accent {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--accent), var(--primary), var(--accent));
            z-index: 10;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .big-404 { font-size: 6rem; }
            .illustration { width: 220px; height: 180px; }
            .actions { flex-direction: column; align-items: center; }
            .btn { width: 100%; justify-content: center; max-width: 280px; }
        }

        /* Entrance animation */
        .container { animation: fade-up 0.6s ease both; }
        @keyframes fade-up {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body>
    <div class="top-accent"></div>

    <div class="container">
        <div class="illustration">
            <div class="pulse-ring"></div>
            <div class="pulse-ring"></div>
            <div class="pulse-ring"></div>
            <div class="cross cross-1"></div>
            <div class="cross cross-2"></div>
            <div class="cross cross-3"></div>
            <div class="cross cross-4"></div>
            <div class="big-404">404</div>
        </div>

        <span class="badge">Page Not Found</span>

        <h1>Oops! This page doesn't exist</h1>

        <p class="description">
            The page you're looking for might have been moved, deleted, or perhaps the URL was mistyped. Let's get you back on track.
        </p>

        <div class="actions">
            <a href="<?= url('/') ?>" class="btn btn-primary">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1h-2z"/>
                </svg>
                Go to Home
            </a>
            <a href="<?= url('/contact') ?>" class="btn btn-outline">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Contact Us
            </a>
        </div>

        <nav class="quick-links">
            <?php foreach (NAV_LINKS as $link): ?>
                <a href="<?= url($link['href']) ?>"><?= h($link['label']) ?></a>
            <?php endforeach; ?>
        </nav>
    </div>
</body>

</html>
