<?php $isEdit = $member !== null; ?>
<div class="max-w-2xl">

    <div class="flex items-center gap-3 mb-6">
        <a href="<?= url('/admin/team') ?>" class="text-gray-400 hover:text-gray-600 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <h2 class="text-lg font-semibold text-gray-800"><?= $isEdit ? 'Edit Team Member' : 'New Team Member' ?></h2>
    </div>

    <?php if ($errors): ?>
        <div class="mb-5 px-4 py-3 rounded-lg bg-red-50 border border-red-200 text-sm text-red-700 space-y-1">
            <?php foreach ($errors as $e): ?><p>• <?= h($e) ?></p><?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data"
        action="<?= $isEdit ? url('/admin/team/' . $member->id . '/update') : url('/admin/team') ?>"
        class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-5">
        <?= csrf_field() ?>

        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="<?= h($old['name'] ?? '') ?>" required
                    class="w-full px-3 py-2 text-sm border <?= isset($errors['name']) ? 'border-red-400' : 'border-gray-300' ?> rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Role <span class="text-red-500">*</span></label>
                <input type="text" name="role" value="<?= h($old['role'] ?? '') ?>" required
                    class="w-full px-3 py-2 text-sm border <?= isset($errors['role']) ? 'border-red-400' : 'border-gray-300' ?> rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
            <textarea name="bio" rows="3"
                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none resize-y"><?= h($old['bio'] ?? '') ?></textarea>
        </div>

        <!-- Photo -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Photo</label>
            <?php
            $existingPhoto = $old['photo'] ?? ($member->photo ?? '');
            $photoUrl = $existingPhoto
                ? (str_starts_with($existingPhoto, 'http')
                    ? $existingPhoto
                    : (str_starts_with($existingPhoto, 'uploads/')
                        ? url($existingPhoto)
                        : asset($existingPhoto)))
                : '';
            ?>
            <?php if ($photoUrl): ?>
                <div class="mb-3 flex items-center gap-4">
                    <img src="<?= h($photoUrl) ?>" alt="Current photo" class="w-20 h-20 object-cover rounded-xl border border-gray-200">
                    <div class="text-xs text-gray-500">
                        <p class="font-medium mb-1">Current photo</p>
                        <p class="text-gray-400"><?= h($existingPhoto) ?></p>
                    </div>
                </div>
            <?php endif; ?>
            <input type="file" name="photo" accept="image/jpeg,image/png,image/webp,image/gif"
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary/10 file:text-primary hover:file:bg-primary/20 cursor-pointer">
            <p class="text-xs text-gray-400 mt-1">JPEG, PNG, WebP, GIF · max 3 MB. Leave blank to keep current photo.</p>
            <?php if (isset($errors['photo'])): ?><p class="text-xs text-red-500 mt-1"><?= h($errors['photo']) ?></p><?php endif; ?>
            <!-- Fallback: manual path -->
            <div class="mt-3">
                <label class="block text-xs text-gray-400 mb-1">Or enter existing path (e.g. images/team/file.webp)</label>
                <input type="text" name="photo_path" value="<?= h($existingPhoto) ?>" placeholder="images/team/…"
                    class="w-full px-3 py-1.5 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none">
            </div>
        </div>

        <div class="grid sm:grid-cols-3 gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Initial (avatar fallback)</label>
                <input type="text" name="initial" maxlength="2" value="<?= h($old['initial'] ?? '') ?>" placeholder="e.g. J"
                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Accent Colour</label>
                <div class="flex items-center gap-2">
                    <input type="color" name="color" value="<?= h($old['color'] ?? '#176B23') ?>"
                        class="w-10 h-9 rounded cursor-pointer border border-gray-300 p-0.5">
                    <input type="text" id="colorText" value="<?= h($old['color'] ?? '#176B23') ?>"
                        class="flex-1 px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none"
                        oninput="document.querySelector('[name=color]').value=this.value">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Photo object-position</label>
                <select name="obj_pos" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none">
                    <?php foreach (['center top','center','center bottom','left','right','top','bottom'] as $pos): ?>
                        <option value="<?= $pos ?>" <?= ($old['obj_pos'] ?? 'center top') === $pos ? 'selected' : '' ?>><?= $pos ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

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
                <?= $isEdit ? 'Save Changes' : 'Create Member' ?>
            </button>
            <a href="<?= url('/admin/team') ?>" class="px-5 py-2 text-sm text-gray-500 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">Cancel</a>
        </div>
    </form>
</div>

<script>
document.querySelector('[name=color]').addEventListener('input', function() {
    document.getElementById('colorText').value = this.value;
});
</script>
