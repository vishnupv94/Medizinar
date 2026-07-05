<?php
$isEdit         = isset($location) && isset($location->id);
$localitiesText = '';
if ($isEdit && !empty($location->localities)) {
    $decoded = json_decode($location->localities, true);
    if (is_array($decoded)) {
        $localitiesText = implode("\n", $decoded);
    }
}
?>

<div class="max-w-5xl">
    <div class="mb-4">
        <a href="<?= url('/admin/locations') ?>" class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-primary transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Locations
        </a>
    </div>

    <?php if ($msg = flash('success')): ?>
        <div class="mb-4 rounded-lg bg-green-50 border border-green-200 text-green-800 px-4 py-3 text-sm"><?= h($msg) ?></div>
    <?php endif; ?>

    <form method="POST" action="<?= $isEdit ? url('/admin/locations/' . $location->id) : url('/admin/locations') ?>">
        <?= csrf_field() ?>

        <div class="grid lg:grid-cols-3 gap-6">

            <!-- Left column -->
            <div class="lg:col-span-2 space-y-5">

                <!-- SEO / Meta -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-800">Page Metadata (SEO)</h2>
                    </div>
                    <div class="p-5 space-y-4">

                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label for="loc-name" class="block text-sm font-medium text-gray-700 mb-1">District Name <span class="text-red-500">*</span></label>
                                <input type="text" name="name" id="loc-name" value="<?= h($location->name ?? '') ?>" required
                                    class="w-full px-3 py-2.5 border rounded-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none <?= isset($errors['name']) ? 'border-red-400' : 'border-gray-300' ?>"
                                    placeholder="Kollam">
                                <?php if (isset($errors['name'])): ?><p class="mt-1 text-xs text-red-600"><?= h($errors['name']) ?></p><?php endif; ?>
                            </div>
                            <div>
                                <label for="loc-slug" class="block text-sm font-medium text-gray-700 mb-1">URL Slug <span class="text-red-500">*</span></label>
                                <div class="flex items-center gap-1">
                                    <span class="text-gray-400 text-xs whitespace-nowrap">/location/</span>
                                    <input type="text" name="slug" id="loc-slug" value="<?= h($location->slug ?? '') ?>"
                                        class="flex-1 px-3 py-2.5 border rounded-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none <?= isset($errors['slug']) ? 'border-red-400' : 'border-gray-300' ?>"
                                        placeholder="kollam">
                                </div>
                                <?php if (isset($errors['slug'])): ?><p class="mt-1 text-xs text-red-600"><?= h($errors['slug']) ?></p><?php endif; ?>
                                <p class="mt-1 text-xs text-gray-400">Leave blank to auto-generate from name.</p>
                            </div>
                        </div>

                        <div>
                            <label for="loc-title" class="block text-sm font-medium text-gray-700 mb-1">Page Title <span class="text-red-500">*</span></label>
                            <input type="text" name="title" id="loc-title" value="<?= h($location->title ?? '') ?>" required maxlength="255"
                                class="w-full px-3 py-2.5 border rounded-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none <?= isset($errors['title']) ? 'border-red-400' : 'border-gray-300' ?>"
                                placeholder="Home Care Services in Kollam, Kerala — Medizinar Care">
                            <?php if (isset($errors['title'])): ?><p class="mt-1 text-xs text-red-600"><?= h($errors['title']) ?></p><?php endif; ?>
                        </div>

                        <div>
                            <label for="loc-meta-desc" class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
                            <textarea name="meta_desc" id="loc-meta-desc" rows="3" maxlength="320"
                                class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none resize-none"
                                placeholder="Keep under 160 characters."><?= h($location->meta_desc ?? '') ?></textarea>
                        </div>

                    </div>
                </div>

                <!-- Content -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-800">Page Content</h2>
                    </div>
                    <div class="p-5 space-y-4">

                        <div>
                            <label for="loc-hero-title" class="block text-sm font-medium text-gray-700 mb-1">Hero Heading</label>
                            <input type="text" name="hero_title" id="loc-hero-title" value="<?= h($location->hero_title ?? '') ?>"
                                class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none"
                                placeholder="Home Care Services in Kollam">
                        </div>

                        <div>
                            <label for="loc-hero-desc" class="block text-sm font-medium text-gray-700 mb-1">Hero Description</label>
                            <textarea name="hero_desc" id="loc-hero-desc" rows="2"
                                class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none resize-none"
                                placeholder="Short sentence shown in the hero/banner area."><?= h($location->hero_desc ?? '') ?></textarea>
                        </div>

                        <div>
                            <label for="loc-intro" class="block text-sm font-medium text-gray-700 mb-1">Intro Paragraph</label>
                            <textarea name="intro" id="loc-intro" rows="4"
                                class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none resize-y"
                                placeholder="Factual intro describing this location's coverage."><?= h($location->intro ?? '') ?></textarea>
                        </div>

                        <div>
                            <label for="loc-localities" class="block text-sm font-medium text-gray-700 mb-1">
                                Localities / Towns <span class="text-red-500">*</span>
                                <span class="font-normal text-gray-400 ml-1">(one per line)</span>
                            </label>
                            <textarea name="localities" id="loc-localities" rows="8"
                                class="w-full px-3 py-2.5 border rounded-lg text-sm font-mono focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none resize-y <?= isset($errors['localities']) ? 'border-red-400' : 'border-gray-300' ?>"
                                placeholder="Kottarakkara&#10;Punalur&#10;Kundara"><?= h($localitiesText) ?></textarea>
                            <?php if (isset($errors['localities'])): ?><p class="mt-1 text-xs text-red-600"><?= h($errors['localities']) ?></p><?php endif; ?>
                        </div>

                    </div>
                </div>

            </div><!-- /left column -->

            <!-- Right sidebar -->
            <div class="space-y-5">

                <!-- Publish -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-800">Publish</h2>
                    </div>
                    <div class="p-5 space-y-3">
                        <button type="submit" name="action" value="publish"
                            class="w-full px-4 py-2.5 bg-primary text-white text-sm font-semibold rounded-lg hover:bg-primary-700 transition-colors shadow-sm">
                            <?= $isEdit && ($location->status ?? '') === 'published' ? 'Update & Keep Published' : 'Publish' ?>
                        </button>
                        <?php if (!$isEdit || ($location->status ?? '') === 'draft'): ?>
                            <button type="submit" name="action" value="draft"
                                class="w-full px-4 py-2.5 text-sm font-semibold text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                                <?= $isEdit ? 'Save Changes' : 'Save as Draft' ?>
                            </button>
                        <?php else: ?>
                            <button type="submit" name="action" value="unpublish"
                                class="w-full px-4 py-2.5 text-sm font-semibold text-amber-700 bg-amber-50 border border-amber-200 rounded-lg hover:bg-amber-100 transition-colors">
                                Revert to Draft
                            </button>
                        <?php endif; ?>
                        <?php if ($isEdit): ?>
                            <a href="<?= url('/location/' . $location->slug) ?>" target="_blank"
                                class="flex items-center justify-center gap-1.5 w-full px-4 py-2 text-sm text-gray-500 hover:text-primary transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                                View Live Page
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Settings -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-800">Settings</h2>
                    </div>
                    <div class="p-5 space-y-4">

                        <div>
                            <label for="loc-distance" class="block text-sm font-medium text-gray-700 mb-1">Distance from Base</label>
                            <input type="text" name="distance" id="loc-distance" value="<?= h($location->distance ?? '') ?>"
                                class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none"
                                placeholder="Approx. 60–80 km from base">
                        </div>

                        <div>
                            <label for="loc-sitemap-priority" class="block text-sm font-medium text-gray-700 mb-1">Sitemap Priority</label>
                            <input type="number" name="sitemap_priority" id="loc-sitemap-priority"
                                value="<?= number_format((float)($location->sitemap_priority ?? 0.7), 1) ?>"
                                step="0.1" min="0.1" max="1.0"
                                class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none">
                            <p class="mt-1 text-xs text-gray-400">0.1 (lowest) to 1.0 (highest). Base city = 1.0</p>
                        </div>

                        <div>
                            <label for="loc-sort-order" class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
                            <input type="number" name="sort_order" id="loc-sort-order" value="<?= (int) ($location->sort_order ?? 0) ?>"
                                class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none"
                                min="0">
                            <p class="mt-1 text-xs text-gray-400">Lower numbers appear first.</p>
                        </div>

                    </div>
                </div>

                <?php if ($isEdit): ?>
                <!-- Danger Zone -->
                <div class="bg-white rounded-xl shadow-sm border border-red-100 overflow-hidden">
                    <div class="px-5 py-4 border-b border-red-100">
                        <h2 class="font-semibold text-red-700">Danger Zone</h2>
                    </div>
                    <div class="p-5">
                        <form action="<?= url('/admin/locations/' . $location->id . '/delete') ?>" method="POST"
                            data-confirm="Permanently delete '<?= h($location->name) ?>'? This cannot be undone.">
                            <?= csrf_field() ?>
                            <button type="submit"
                                class="w-full px-4 py-2.5 text-sm font-semibold text-red-600 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 transition-colors">
                                Delete This Location
                            </button>
                        </form>
                    </div>
                </div>
                <?php endif; ?>

            </div><!-- /sidebar -->

        </div>
    </form>
</div>
