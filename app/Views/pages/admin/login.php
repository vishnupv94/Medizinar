<div class="w-full max-w-md mx-auto">
    <div class="text-center mb-8">
        <div class="w-14 h-14 rounded-2xl bg-primary mx-auto flex items-center justify-center mb-4">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
        </div>
        <h1 class="text-2xl font-bold text-gray-800"><?= SITE_NAME ?></h1>
        <p class="text-sm text-gray-500 mt-1">Admin Panel</p>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-8">
        <?php if ($msg = flash('error')): ?>
            <div class="mb-4 rounded-lg bg-red-50 border border-red-200 text-red-700 px-4 py-3 text-sm"><?= h($msg) ?></div>
        <?php endif; ?>
        <?php if ($msg = flash('success')): ?>
            <div class="mb-4 rounded-lg bg-green-50 border border-green-200 text-green-700 px-4 py-3 text-sm"><?= h($msg) ?></div>
        <?php endif; ?>

        <form method="POST" action="<?= url('/admin/login') ?>" class="space-y-5">
            <?= csrf_field() ?>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                <input type="email" id="email" name="email" required autofocus
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none transition">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                <input type="password" id="password" name="password" required
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none transition">
            </div>

            <button type="submit"
                class="w-full bg-primary hover:bg-primary-600 text-white font-semibold py-2.5 rounded-lg text-sm transition-colors">
                Sign In
            </button>
        </form>
    </div>

    <p class="text-center text-xs text-gray-400 mt-6">&copy; <?= date('Y') ?> <?= SITE_NAME ?>. All rights reserved.</p>
</div>