<?php
$isEdit = isset($faq) && isset($faq->id);
?>

<div class="max-w-4xl">
    <div class="mb-4">
        <a href="<?= url('/admin/faqs') ?>" class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-primary transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to FAQs
        </a>
    </div>

    <?php if ($msg = flash('success')): ?>
        <div class="mb-4 rounded-lg bg-green-50 border border-green-200 text-green-800 px-4 py-3 text-sm"><?= h($msg) ?></div>
    <?php endif; ?>

    <form method="POST" action="<?= $isEdit ? url('/admin/faqs/' . $faq->id) : url('/admin/faqs') ?>"
        class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

        <?= csrf_field() ?>

        <div class="px-5 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-800"><?= $isEdit ? 'Edit FAQ' : 'Create FAQ' ?></h2>
        </div>

        <div class="p-5 space-y-5">

            <!-- Question -->
            <div>
                <label for="faq-question" class="block text-sm font-medium text-gray-700 mb-1">Question <span class="text-red-500">*</span></label>
                <input type="text" name="question" id="faq-question" value="<?= h($faq->question ?? '') ?>" required
                    class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none <?= isset($errors['question']) ? 'border-red-400' : '' ?>"
                    placeholder="Enter the FAQ question…">
                <?php if (isset($errors['question'])): ?>
                    <p class="mt-1 text-xs text-red-600"><?= h($errors['question']) ?></p>
                <?php endif; ?>
            </div>

            <!-- Answer -->
            <div>
                <label for="faq-answer" class="block text-sm font-medium text-gray-700 mb-1">Answer <span class="text-red-500">*</span></label>
                <textarea name="answer" id="faq-answer" rows="10" required
                    class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none resize-y leading-relaxed <?= isset($errors['answer']) ? 'border-red-400' : '' ?>"
                    placeholder="Write the answer here…"><?= h($faq->answer ?? '') ?></textarea>
                <?php if (isset($errors['answer'])): ?>
                    <p class="mt-1 text-xs text-red-600"><?= h($errors['answer']) ?></p>
                <?php endif; ?>
            </div>

            <!-- Sort Order -->
            <div>
                <label for="faq-sort-order" class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
                <input type="number" name="sort_order" id="faq-sort-order" value="<?= (int)($faq->sort_order ?? 0) ?>"
                    class="w-48 px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none"
                    placeholder="0">
                <p class="mt-1 text-xs text-gray-400">Lower numbers appear first. Default is 0.</p>
            </div>

        </div>

        <div class="px-5 py-4 bg-gray-50 border-t border-gray-100 flex items-center gap-3">
            <button type="submit" name="action" value="publish"
                class="px-5 py-2.5 bg-primary text-white text-sm font-semibold rounded-lg hover:bg-primary-700 transition-colors shadow-sm">
                <?= $isEdit && $faq->status === 'published' ? 'Update & Keep Published' : 'Publish' ?>
            </button>

            <?php if (!$isEdit || $faq->status === 'draft'): ?>
                <button type="submit" name="action" value="draft"
                    class="px-5 py-2.5 text-sm font-semibold text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                    <?= $isEdit ? 'Save Changes' : 'Save as Draft' ?>
                </button>
            <?php else: ?>
                <button type="submit" name="action" value="unpublish"
                    class="px-5 py-2.5 text-sm font-semibold text-amber-700 bg-amber-50 border border-amber-200 rounded-lg hover:bg-amber-100 transition-colors">
                    Revert to Draft
                </button>
            <?php endif; ?>

            <a href="<?= url('/admin/faqs') ?>"
                class="px-5 py-2.5 text-sm text-gray-500 hover:text-gray-700 transition-colors ml-auto">Cancel</a>
        </div>
    </form>
</div>
