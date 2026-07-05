<?php $isEdit = $item !== null; ?>
<div class="max-w-2xl">

    <div class="flex items-center gap-3 mb-6">
        <a href="<?= url('/admin/content') ?>" class="text-gray-400 hover:text-gray-600 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <h2 class="text-lg font-semibold text-gray-800"><?= $isEdit ? 'Edit Content Item' : 'New Content Item' ?></h2>
    </div>

    <?php if ($errors): ?>
        <div class="mb-5 px-4 py-3 rounded-lg bg-red-50 border border-red-200 text-sm text-red-700 space-y-1">
            <?php foreach ($errors as $e): ?><p>• <?= h($e) ?></p><?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?= $isEdit ? url('/admin/content/' . $item->id . '/update') : url('/admin/content') ?>"
        class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-5">
        <?= csrf_field() ?>

        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Group <span class="text-red-500">*</span></label>
                <select name="group_key" class="w-full px-3 py-2 text-sm border <?= isset($errors['group_key']) ? 'border-red-400' : 'border-gray-300' ?> rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none">
                    <option value="">— Select group —</option>
                    <?php foreach ($groups as $gk => $gLabel): ?>
                        <option value="<?= h($gk) ?>" <?= ($old['group_key'] ?? '') === $gk ? 'selected' : '' ?>><?= h($gLabel ?: $gk) ?></option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['group_key'])): ?><p class="text-xs text-red-500 mt-1"><?= h($errors['group_key']) ?></p><?php endif; ?>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Item Key <span class="text-gray-400 font-normal">(optional slug)</span></label>
                <input type="text" name="item_key" value="<?= h($old['item_key'] ?? '') ?>" placeholder="e.g. verified_caregivers"
                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Label / Title <span class="text-red-500">*</span></label>
            <input type="text" name="label" value="<?= h($old['label'] ?? '') ?>" required
                class="w-full px-3 py-2 text-sm border <?= isset($errors['label']) ? 'border-red-400' : 'border-gray-300' ?> rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none">
            <?php if (isset($errors['label'])): ?><p class="text-xs text-red-500 mt-1"><?= h($errors['label']) ?></p><?php endif; ?>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Value / Description <span class="text-gray-400 font-normal">(for stats: the number; for cards: the subtitle text)</span></label>
            <textarea name="value" rows="2"
                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none resize-y"><?= h($old['value'] ?? '') ?></textarea>
        </div>

        <!-- Icon -->
        <fieldset class="border border-gray-200 rounded-lg p-4 space-y-3">
            <legend class="text-sm font-medium text-gray-700 px-1">Icon</legend>

            <div>
                <label class="block text-xs text-gray-500 mb-1">Icon Type</label>
                <select name="icon_type" id="icon_type" onchange="updateIconHint()"
                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none">
                    <option value=""     <?= ($old['icon_type'] ?? '') === ''      ? 'selected' : '' ?>>None</option>
                    <option value="svg"  <?= ($old['icon_type'] ?? '') === 'svg'   ? 'selected' : '' ?>>SVG (inline HTML)</option>
                    <option value="path" <?= ($old['icon_type'] ?? '') === 'path'  ? 'selected' : '' ?>>Path (relative asset path)</option>
                    <option value="url"  <?= ($old['icon_type'] ?? '') === 'url'   ? 'selected' : '' ?>>URL (https://…)</option>
                    <option value="emoji"<?= ($old['icon_type'] ?? '') === 'emoji' ? 'selected' : '' ?>>Emoji</option>
                </select>
            </div>

            <div>
                <label class="block text-xs text-gray-500 mb-1">Icon Value <span id="icon_hint" class="text-gray-400"></span></label>
                <textarea name="icon_value" id="icon_value" rows="3" placeholder="Paste SVG, path, URL, or emoji here…"
                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none font-mono resize-y"><?= h($old['icon_value'] ?? '') ?></textarea>
            </div>
        </fieldset>

        <div class="grid sm:grid-cols-2 gap-5">
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
                <?= $isEdit ? 'Save Changes' : 'Create Item' ?>
            </button>
            <a href="<?= url('/admin/content') ?>" class="px-5 py-2 text-sm text-gray-500 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">Cancel</a>
        </div>
    </form>
</div>

<script>
const hints = {svg:'Paste full <svg>…</svg> markup',path:'Relative asset path e.g. images/icon-name.webp',url:'Full URL starting with https://',emoji:'Single emoji character e.g. ✅',''};
function updateIconHint() {
    document.getElementById('icon_hint').textContent = '— ' + (hints[document.getElementById('icon_type').value] || '');
}
updateIconHint();
</script>
