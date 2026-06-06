<header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-6 flex-shrink-0">
    <h1 class="text-lg font-semibold text-gray-800"><?= h($pageTitle ?? 'Admin') ?></h1>

    <div class="flex items-center gap-4">
        <span class="text-sm text-gray-600"><?= h($_SESSION['admin_name'] ?? 'Admin') ?></span>
        <form method="POST" action="<?= url('/admin/logout') ?>">
            <?= csrf_field() ?>
            <button type="submit"
                class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-red-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Logout
            </button>
        </form>
    </div>
</header>