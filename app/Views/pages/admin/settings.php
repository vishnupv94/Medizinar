<div class="space-y-5 max-w-6xl">

    <div>
        <h1 class="text-xl font-bold text-gray-800">Site Settings</h1>
        <p class="text-sm text-gray-500 mt-1">Manage API keys, integrations, and your admin password.</p>
    </div>

    <!-- 2-column grid: stacks on mobile, side-by-side on lg+ -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

        <!-- ── LEFT: API Settings (takes 2/3 width) ─────────── -->
        <div class="lg:col-span-2">
            <form action="<?= url('/admin/settings') ?>" method="POST" class="space-y-5">
                <?= csrf_field() ?>

                <!-- reCAPTCHA Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="font-semibold text-gray-800 text-sm">Google reCAPTCHA v3</h2>
                            <p class="text-xs text-gray-500">Protects your contact and appointment forms from spam bots.</p>
                        </div>
                        <div class="ml-auto">
                            <?php if (($settings['RECAPTCHA_SITE_KEY'] ?? '') !== ''): ?>
                                <span class="inline-flex items-center gap-1.5 text-xs font-medium text-green-700 bg-green-100 px-2.5 py-1 rounded-full">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Active
                                </span>
                            <?php else: ?>
                                <span class="inline-flex items-center gap-1.5 text-xs font-medium text-amber-700 bg-amber-100 px-2.5 py-1 rounded-full">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Not configured
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="p-6 space-y-5">
                        <div>
                            <label for="RECAPTCHA_SITE_KEY" class="block text-sm font-medium text-gray-700 mb-1.5">
                                Site Key <span class="text-gray-400 font-normal text-xs">(Public — used in the browser widget)</span>
                            </label>
                            <input type="text" id="RECAPTCHA_SITE_KEY" name="RECAPTCHA_SITE_KEY"
                                class="w-full rounded-lg border border-gray-200 px-3 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary font-mono"
                                placeholder="6Le…"
                                value="<?= h($settings['RECAPTCHA_SITE_KEY'] ?? '') ?>">
                        </div>

                        <div>
                            <label for="RECAPTCHA_SECRET_KEY" class="block text-sm font-medium text-gray-700 mb-1.5">
                                Secret Key <span class="text-gray-400 font-normal text-xs">(Private — used for server-side verification)</span>
                            </label>
                            <input type="password" id="RECAPTCHA_SECRET_KEY" name="RECAPTCHA_SECRET_KEY"
                                class="w-full rounded-lg border border-gray-200 px-3 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary font-mono"
                                placeholder="6Le…"
                                value="<?= h($settings['RECAPTCHA_SECRET_KEY'] ?? '') ?>">
                            <button type="button" onclick="toggleSecret()" class="mt-1.5 text-xs text-primary hover:underline">Show / Hide key</button>
                        </div>

                        <div class="rounded-lg bg-blue-50 border border-blue-100 px-4 py-3 text-xs text-blue-700 flex gap-2">
                            <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>
                                Get your free reCAPTCHA v3 keys from
                                <a href="https://www.google.com/recaptcha/admin/create" target="_blank" rel="noopener"
                                    class="underline font-medium">Google reCAPTCHA Admin</a>.
                                Choose <strong>reCAPTCHA v3</strong>.
                                Leave both fields empty to disable reCAPTCHA.
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Google Maps Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-red-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="font-semibold text-gray-800 text-sm">Google Maps Embed</h2>
                            <p class="text-xs text-gray-500">The map embed URL shown on the Contact page.</p>
                        </div>
                    </div>

                    <div class="p-6 space-y-5">
                        <div>
                            <label for="GOOGLE_MAPS_EMBED_URL" class="block text-sm font-medium text-gray-700 mb-1.5">
                                Maps Embed URL
                            </label>
                            <textarea id="GOOGLE_MAPS_EMBED_URL" name="GOOGLE_MAPS_EMBED_URL" rows="4"
                                class="w-full rounded-lg border border-gray-200 px-3 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary font-mono resize-y"
                                placeholder="https://www.google.com/maps/embed?pb=..."><?= h($settings['GOOGLE_MAPS_EMBED_URL'] ?? '') ?></textarea>
                            <p class="text-xs text-gray-400 mt-1.5">
                                Open Google Maps → find your location → Share → Embed a map → copy the <code>src="..."</code> URL.
                            </p>
                        </div>

                        <?php if (($settings['GOOGLE_MAPS_EMBED_URL'] ?? '') !== ''): ?>
                        <div class="rounded-lg overflow-hidden border border-gray-200" style="height:220px">
                            <iframe src="<?= h($settings['GOOGLE_MAPS_EMBED_URL'] ?? '') ?>" width="100%" height="100%" style="border:0"
                                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Save Button -->
                <div class="flex items-center gap-4">
                    <button type="submit"
                        class="inline-flex items-center gap-2 bg-primary hover:bg-primary-700 text-white font-semibold text-sm px-5 py-2.5 rounded-lg transition-colors shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Save Settings
                    </button>
                    <p class="text-xs text-gray-400">Changes are applied immediately.</p>
                </div>
            </form>
        </div>

        <!-- ── RIGHT: Change Password (takes 1/3 width) ──────── -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden sticky top-6">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-amber-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-semibold text-gray-800 text-sm">Change Password</h2>
                        <p class="text-xs text-gray-500">Update your admin login password.</p>
                    </div>
                </div>

                <form action="<?= url('/admin/settings/password') ?>" method="POST" class="p-6 space-y-4">
                    <?= csrf_field() ?>

                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Current Password
                        </label>
                        <div class="relative">
                            <input type="password" id="current_password" name="current_password"
                                class="w-full rounded-lg border border-gray-200 px-3 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-amber-200 focus:border-amber-400 pr-16"
                                placeholder="Current password" autocomplete="current-password">
                            <button type="button" onclick="togglePwField('current_password')"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-400 hover:text-gray-600 font-medium">Show</button>
                        </div>
                    </div>

                    <div>
                        <label for="new_password" class="block text-sm font-medium text-gray-700 mb-1.5">
                            New Password <span class="text-gray-400 font-normal text-xs">(min. 8 chars)</span>
                        </label>
                        <div class="relative">
                            <input type="password" id="new_password" name="new_password"
                                class="w-full rounded-lg border border-gray-200 px-3 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-amber-200 focus:border-amber-400 pr-16"
                                placeholder="New password" autocomplete="new-password" minlength="8">
                            <button type="button" onclick="togglePwField('new_password')"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-400 hover:text-gray-600 font-medium">Show</button>
                        </div>
                    </div>

                    <div>
                        <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Confirm Password
                        </label>
                        <div class="relative">
                            <input type="password" id="confirm_password" name="confirm_password"
                                class="w-full rounded-lg border border-gray-200 px-3 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-amber-200 focus:border-amber-400 pr-16"
                                placeholder="Repeat new password" autocomplete="new-password" minlength="8">
                            <button type="button" onclick="togglePwField('confirm_password')"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-400 hover:text-gray-600 font-medium">Show</button>
                        </div>
                    </div>

                    <div class="pt-1">
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 bg-amber-600 hover:bg-amber-700 text-white font-semibold text-sm px-5 py-2.5 rounded-lg transition-colors shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                            </svg>
                            Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div><!-- end 2-col grid -->
</div>

<script>
function toggleSecret() {
    const field = document.getElementById('RECAPTCHA_SECRET_KEY');
    field.type = field.type === 'password' ? 'text' : 'password';
}
function togglePwField(id) {
    const field = document.getElementById(id);
    const btn   = field.nextElementSibling;
    if (field.type === 'password') {
        field.type = 'text';
        btn.textContent = 'Hide';
    } else {
        field.type = 'password';
        btn.textContent = 'Show';
    }
}
</script>
