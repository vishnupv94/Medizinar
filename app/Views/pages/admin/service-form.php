<?php
$isEdit       = isset($service) && isset($service->id);
$featuresText = '';
if ($isEdit && !empty($service->features)) {
    $decoded = json_decode($service->features, true);
    if (is_array($decoded)) {
        $featuresText = implode("\n", $decoded);
    }
}
?>

<div class="max-w-5xl">
    <div class="mb-4">
        <a href="<?= url('/admin/services') ?>" class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-primary transition-colors">
            <svg class="w-4 h-4" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Services
        </a>
    </div>

    <?php if ($msg = flash('success')): ?>
        <div class="mb-4 rounded-lg bg-green-50 border border-green-200 text-green-800 px-4 py-3 text-sm"><?= h($msg) ?></div>
    <?php endif; ?>

    <form method="POST" action="<?= $isEdit ? url('/admin/services/' . $service->id) : url('/admin/services') ?>">
        <?= csrf_field() ?>

        <!-- ===== Grid layout: left column (2/3) + right sidebar (1/3) ===== -->
        <div class="grid lg:grid-cols-3 gap-6">

            <!-- Left column -->
            <div class="lg:col-span-2 space-y-5">

                <!-- Page Meta -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-800">Page Metadata (SEO)</h2>
                    </div>
                    <div class="p-5 space-y-4">

                        <div>
                            <label for="svc-title" class="block text-sm font-medium text-gray-700 mb-1">Page Title <span class="text-red-500">*</span></label>
                            <input type="text" name="title" id="svc-title" value="<?= h($service->title ?? '') ?>" required maxlength="255"
                                class="w-full px-3 py-2.5 border rounded-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none <?= isset($errors['title']) ? 'border-red-400' : 'border-gray-300' ?>"
                                placeholder="Bedside Patient Care at Home in Kerala">
                            <?php if (isset($errors['title'])): ?><p class="mt-1 text-xs text-red-600"><?= h($errors['title']) ?></p><?php endif; ?>
                            <p class="mt-1 text-xs text-gray-400">Shown in browser tab and search results. Keep under 60 characters.</p>
                        </div>

                        <div>
                            <label for="svc-meta-desc" class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
                            <textarea name="meta_desc" id="svc-meta-desc" rows="3" maxlength="320"
                                class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none resize-none"
                                placeholder="Short description shown in Google search results. Keep under 160 characters."><?= h($service->meta_desc ?? '') ?></textarea>
                        </div>

                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label for="svc-slug" class="block text-sm font-medium text-gray-700 mb-1">URL Slug <span class="text-red-500">*</span></label>
                                <div class="flex items-center gap-2">
                                    <span class="text-gray-400 text-xs whitespace-nowrap">/services/</span>
                                    <input type="text" name="slug" id="svc-slug" value="<?= h($service->slug ?? '') ?>"
                                        class="flex-1 px-3 py-2.5 border rounded-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none <?= isset($errors['slug']) ? 'border-red-400' : 'border-gray-300' ?>"
                                        placeholder="bedside-patient-care">
                                </div>
                                <?php if (isset($errors['slug'])): ?><p class="mt-1 text-xs text-red-600"><?= h($errors['slug']) ?></p><?php endif; ?>
                                <p class="mt-1 text-xs text-gray-400">Leave blank to auto-generate from H1.</p>
                            </div>
                            <div>
                                <label for="svc-schema-name" class="block text-sm font-medium text-gray-700 mb-1">Schema Name</label>
                                <input type="text" name="schema_name" id="svc-schema-name" value="<?= h($service->schema_name ?? '') ?>"
                                    class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none"
                                    placeholder="Bedside Patient Care">
                            </div>
                        </div>

                        <div>
                            <label for="svc-schema-desc" class="block text-sm font-medium text-gray-700 mb-1">Schema Description</label>
                            <textarea name="schema_desc" id="svc-schema-desc" rows="2"
                                class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none resize-none"
                                placeholder="Short sentence for JSON-LD schema.org description."><?= h($service->schema_desc ?? '') ?></textarea>
                        </div>

                    </div>
                </div>

                <!-- Page Content -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-800">Page Content</h2>
                    </div>
                    <div class="p-5 space-y-4">

                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label for="svc-h1" class="block text-sm font-medium text-gray-700 mb-1">Service Heading (H1) <span class="text-red-500">*</span></label>
                                <input type="text" name="h1" id="svc-h1" value="<?= h($service->h1 ?? '') ?>" required
                                    class="w-full px-3 py-2.5 border rounded-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none <?= isset($errors['h1']) ? 'border-red-400' : 'border-gray-300' ?>"
                                    placeholder="Bedside Patient Care">
                                <?php if (isset($errors['h1'])): ?><p class="mt-1 text-xs text-red-600"><?= h($errors['h1']) ?></p><?php endif; ?>
                            </div>
                            <div>
                                <label for="svc-badge" class="block text-sm font-medium text-gray-700 mb-1">Badge Label</label>
                                <input type="text" name="badge" id="svc-badge" value="<?= h($service->badge ?? '') ?>"
                                    class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none"
                                    placeholder="Home Healthcare">
                            </div>
                        </div>

                        <div>
                            <label for="svc-hero-desc" class="block text-sm font-medium text-gray-700 mb-1">Hero Description</label>
                            <textarea name="hero_desc" id="svc-hero-desc" rows="2"
                                class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none resize-none"
                                placeholder="Short paragraph shown in the hero/banner area."><?= h($service->hero_desc ?? '') ?></textarea>
                        </div>

                        <div>
                            <label for="svc-intro-what" class="block text-sm font-medium text-gray-700 mb-1">Intro Heading</label>
                            <input type="text" name="intro_what" id="svc-intro-what" value="<?= h($service->intro_what ?? '') ?>"
                                class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none"
                                placeholder="What is Bedside Patient Care?">
                        </div>

                        <div>
                            <label for="svc-intro-body" class="block text-sm font-medium text-gray-700 mb-1">Intro Body Paragraph</label>
                            <textarea name="intro_body" id="svc-intro-body" rows="4"
                                class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none resize-y"
                                placeholder="Factual paragraph explaining what this service is (used for AI citations and featured snippets)."><?= h($service->intro_body ?? '') ?></textarea>
                        </div>

                        <div>
                            <label for="svc-ideal-for" class="block text-sm font-medium text-gray-700 mb-1">Ideal For</label>
                            <input type="text" name="ideal_for" id="svc-ideal-for" value="<?= h($service->ideal_for ?? '') ?>"
                                class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none"
                                placeholder="Post-surgical patients, stroke recovery, bedridden patients…">
                        </div>

                        <div>
                            <label for="svc-features" class="block text-sm font-medium text-gray-700 mb-1">
                                Features / What's Included <span class="text-red-500">*</span>
                                <span class="font-normal text-gray-400 ml-1">(one per line)</span>
                            </label>
                            <textarea name="features" id="svc-features" rows="8" required
                                class="w-full px-3 py-2.5 border rounded-lg text-sm font-mono focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none resize-y <?= isset($errors['features']) ? 'border-red-400' : 'border-gray-300' ?>"
                                placeholder="Personal hygiene assistance&#10;Medication reminders&#10;Mobility support"><?= h($featuresText) ?></textarea>
                            <?php if (isset($errors['features'])): ?><p class="mt-1 text-xs text-red-600"><?= h($errors['features']) ?></p><?php endif; ?>
                        </div>

                    </div>
                </div>

                <!-- FAQs -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                        <h2 class="font-semibold text-gray-800">FAQs</h2>
                        <button type="button" onclick="addFaqRow()"
                            class="inline-flex items-center gap-1 text-sm font-medium text-primary hover:text-primary-700 transition-colors">
                            <svg class="w-4 h-4" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Add FAQ
                        </button>
                    </div>
                    <div class="p-5">
                        <div id="faq-list" class="space-y-4">
                            <?php foreach ($faqs as $i => $faq): ?>
                                <div class="faq-row border border-gray-200 rounded-lg p-4 space-y-3 relative">
                                    <button type="button" onclick="removeFaqRow(this)"
                                        class="absolute top-3 right-3 text-gray-300 hover:text-red-500 transition-colors" title="Remove">
                                        <svg class="w-4 h-4" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">Question</label>
                                        <input type="text" name="faq_question[]" value="<?= h($faq->question ?? $faq['question'] ?? '') ?>"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none"
                                            placeholder="Type question here…">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">Answer</label>
                                        <textarea name="faq_answer[]" rows="3"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none resize-none"
                                            placeholder="Type answer here…"><?= h($faq->answer ?? $faq['answer'] ?? '') ?></textarea>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <p id="faq-empty" class="text-sm text-gray-400 text-center py-4 <?= !empty($faqs) ? 'hidden' : '' ?>">
                            No FAQs yet. Click "Add FAQ" to add one.
                        </p>
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
                            <?= $isEdit && ($service->status ?? '') === 'published' ? 'Update & Keep Published' : 'Publish' ?>
                        </button>
                        <?php if (!$isEdit || ($service->status ?? '') === 'draft'): ?>
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
                            <a href="<?= url('/services/' . $service->slug) ?>" target="_blank"
                                class="flex items-center justify-center gap-1.5 w-full px-4 py-2 text-sm text-gray-500 hover:text-primary transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                                View Live Page
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Appearance & Settings -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-800">Settings</h2>
                    </div>
                    <div class="p-5 space-y-4">

                        <div>
                            <label for="svc-service-param" class="block text-sm font-medium text-gray-700 mb-1">Appointment URL Param</label>
                            <input type="text" name="service_param" id="svc-service-param" value="<?= h($service->service_param ?? '') ?>"
                                class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none"
                                placeholder="bedside">
                            <p class="mt-1 text-xs text-gray-400">Used in: /appointment?service=<strong>this</strong></p>
                        </div>

                        <div>
                            <label for="svc-color" class="block text-sm font-medium text-gray-700 mb-1">Accent Colour</label>
                            <select name="color" id="svc-color"
                                class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none bg-white">
                                <option value="green" <?= ($service->color ?? 'green') === 'green' ? 'selected' : '' ?>>Green (Primary)</option>
                                <option value="gold"  <?= ($service->color ?? '') === 'gold' ? 'selected' : '' ?>>Gold (Accent)</option>
                            </select>
                        </div>

                        <div>
                            <label for="svc-sort-order" class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
                            <input type="number" name="sort_order" id="svc-sort-order" value="<?= (int) ($service->sort_order ?? 0) ?>"
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
                        <form action="<?= url('/admin/services/' . $service->id . '/delete') ?>" method="POST"
                            data-confirm="Permanently delete '<?= h($service->h1) ?>'? This cannot be undone.">
                            <?= csrf_field() ?>
                            <button type="submit"
                                class="w-full px-4 py-2.5 text-sm font-semibold text-red-600 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 transition-colors">
                                Delete This Service
                            </button>
                        </form>
                    </div>
                </div>
                <?php endif; ?>

            </div><!-- /right sidebar -->

        </div><!-- /grid -->

    </form>
</div>

<script>
const faqList  = document.getElementById('faq-list');
const faqEmpty = document.getElementById('faq-empty');

function updateEmpty() {
    faqEmpty.classList.toggle('hidden', faqList.querySelectorAll('.faq-row').length > 0);
}

function addFaqRow(q = '', a = '') {
    const row = document.createElement('div');
    row.className = 'faq-row border border-gray-200 rounded-lg p-4 space-y-3 relative';
    row.innerHTML = `
        <button type="button" onclick="removeFaqRow(this)"
            class="absolute top-3 right-3 text-gray-300 hover:text-red-500 transition-colors" title="Remove">
            <svg class="w-4 h-4" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        <div>
            <label class="block text-xs font-medium text-gray-600 mb-1">Question</label>
            <input type="text" name="faq_question[]" value="${q}"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none"
                placeholder="Type question here…">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-600 mb-1">Answer</label>
            <textarea name="faq_answer[]" rows="3"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none resize-none"
                placeholder="Type answer here…">${a}</textarea>
        </div>`;
    faqList.appendChild(row);
    updateEmpty();
    row.querySelector('input').focus();
}

function removeFaqRow(btn) {
    btn.closest('.faq-row').remove();
    updateEmpty();
}

updateEmpty();
</script>
