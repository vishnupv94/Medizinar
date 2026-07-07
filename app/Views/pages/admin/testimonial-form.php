<?php $isEdit = $testimonial !== null; ?>
<div class="max-w-2xl">

    <div class="flex items-center gap-3 mb-6">
        <a href="<?= url('/admin/testimonials') ?>" class="text-gray-400 hover:text-gray-600 transition-colors">
            <svg class="w-5 h-5" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <h2 class="text-lg font-semibold text-gray-800"><?= $isEdit ? 'Edit Testimonial' : 'New Testimonial' ?></h2>
    </div>

    <?php if ($errors): ?>
        <div class="mb-5 px-4 py-3 rounded-lg bg-red-50 border border-red-200 text-sm text-red-700 space-y-1">
            <?php foreach ($errors as $e): ?><p>• <?= h($e) ?></p><?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?= $isEdit ? url('/admin/testimonials/' . $testimonial->id . '/update') : url('/admin/testimonials') ?>"
        class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-5">
        <?= csrf_field() ?>

        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="<?= h($old['name'] ?? '') ?>" required
                    class="w-full px-3 py-2 text-sm border <?= isset($errors['name']) ? 'border-red-400' : 'border-gray-300' ?> rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none">
                <?php if (isset($errors['name'])): ?><p class="text-xs text-red-500 mt-1"><?= h($errors['name']) ?></p><?php endif; ?>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                <input type="text" name="location_label" value="<?= h($old['location_label'] ?? '') ?>" placeholder="e.g. Kollam, Kerala"
                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Review Text <span class="text-red-500">*</span></label>
            <textarea name="text" rows="4" required
                class="w-full px-3 py-2 text-sm border <?= isset($errors['text']) ? 'border-red-400' : 'border-gray-300' ?> rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none resize-y"><?= h($old['text'] ?? '') ?></textarea>
            <?php if (isset($errors['text'])): ?><p class="text-xs text-red-500 mt-1"><?= h($errors['text']) ?></p><?php endif; ?>
        </div>

        <div class="grid sm:grid-cols-3 gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Stars</label>
                <select name="stars" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none">
                    <?php for ($i = 5; $i >= 1; $i--): ?>
                        <option value="<?= $i ?>" <?= (int)($old['stars'] ?? 5) === $i ? 'selected' : '' ?>><?= str_repeat('★', $i) ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none">
                    <option value="published" <?= ($old['status'] ?? 'published') === 'published' ? 'selected' : '' ?>>Published</option>
                    <option value="draft"     <?= ($old['status'] ?? '') === 'draft'               ? 'selected' : '' ?>>Draft</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
                <input type="number" name="sort_order" value="<?= (int)($old['sort_order'] ?? 0) ?>" min="0"
                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none">
            </div>
        </div>

        <div class="flex items-center gap-3 pt-2 border-t border-gray-100">
            <button type="submit" class="px-5 py-2 bg-primary text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition-colors">
                <?= $isEdit ? 'Save Changes' : 'Create Testimonial' ?>
            </button>
            <a href="<?= url('/admin/testimonials') ?>" class="px-5 py-2 text-sm text-gray-500 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">Cancel</a>
        </div>
    </form>
</div>
