<?php
$isEdit = isset($post) && isset($post->id);
?>

<div class="max-w-4xl">
    <div class="mb-4">
        <a href="<?= url('/admin/blog') ?>" class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-primary transition-colors">
            <svg class="w-4 h-4" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Blog Posts
        </a>
    </div>

    <?php if ($msg = flash('success')): ?>
        <div class="mb-4 rounded-lg bg-green-50 border border-green-200 text-green-800 px-4 py-3 text-sm"><?= h($msg) ?></div>
    <?php endif; ?>

    <form method="POST" action="<?= $isEdit ? url('/admin/blog/' . $post->id) : url('/admin/blog') ?>" enctype="multipart/form-data"
        class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

        <?= csrf_field() ?>

        <div class="px-5 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-800"><?= $isEdit ? 'Edit Blog Post' : 'Create Blog Post' ?></h2>
        </div>

        <div class="p-5 space-y-5">

            <!-- Title -->
            <div>
                <label for="blog-title" class="block text-sm font-medium text-gray-700 mb-1">Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="blog-title" value="<?= h($post->title ?? '') ?>" required
                    class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none <?= isset($errors['title']) ? 'border-red-400' : '' ?>"
                    placeholder="Enter blog post title…">
                <?php if (isset($errors['title'])): ?>
                    <p class="mt-1 text-xs text-red-600"><?= h($errors['title']) ?></p>
                <?php endif; ?>
            </div>

            <!-- Slug -->
            <div>
                <label for="blog-slug" class="block text-sm font-medium text-gray-700 mb-1">
                    URL Slug
                    <span class="text-xs font-normal text-gray-400 ml-1">Auto-generated from title. Edit if needed.</span>
                </label>
                <div class="flex items-center gap-0">
                    <span class="px-3 py-2.5 bg-gray-50 border border-r-0 border-gray-300 rounded-l-lg text-sm text-gray-500">/blog/</span>
                    <input type="text" name="slug" id="blog-slug" value="<?= h($post->slug ?? '') ?>"
                        class="flex-1 px-3 py-2.5 border border-gray-300 rounded-r-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none"
                        placeholder="my-blog-post-title">
                </div>
            </div>

            <!-- Excerpt -->
            <div>
                <label for="blog-excerpt" class="block text-sm font-medium text-gray-700 mb-1">
                    Excerpt
                    <span class="text-xs font-normal text-gray-400 ml-1">Short summary for listing cards & SEO meta description</span>
                </label>
                <textarea name="excerpt" id="blog-excerpt" rows="2"
                    class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none resize-y"
                    placeholder="A brief summary of the post…"><?= h($post->excerpt ?? '') ?></textarea>
            </div>

            <!-- Content -->
            <div>
                <label for="blog-content" class="block text-sm font-medium text-gray-700 mb-1">Content <span class="text-red-500">*</span></label>
                <textarea name="content" id="blog-content" rows="16" required
                    class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none resize-y font-mono leading-relaxed <?= isset($errors['content']) ? 'border-red-400' : '' ?>"
                    placeholder="Write your blog post content here…"><?= h($post->content ?? '') ?></textarea>
                <?php if (isset($errors['content'])): ?>
                    <p class="mt-1 text-xs text-red-600"><?= h($errors['content']) ?></p>
                <?php endif; ?>
                <p class="mt-1 text-xs text-gray-400">Plain text. Use blank lines to separate paragraphs.</p>
            </div>

            <!-- Banner Image -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Banner Image</label>

                <?php if ($isEdit && !empty($post->image)): ?>
                    <div class="mb-3 relative inline-block" id="current-image-wrap">
                        <img src="<?= url('uploads/blog/' . h($post->image)) ?>" alt="Current banner"
                            class="w-64 h-40 object-cover rounded-lg border border-gray-200 shadow-sm">
                        <label class="absolute top-2 right-2 flex items-center gap-1 px-2 py-1 bg-red-500 text-white text-xs font-medium rounded-md cursor-pointer hover:bg-red-600 transition-colors">
                            <input type="checkbox" name="remove_image" value="1" class="hidden" id="remove-image-cb"
                                onchange="document.getElementById('current-image-wrap').style.opacity = this.checked ? '0.4' : '1'">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Remove
                        </label>
                    </div>
                <?php endif; ?>

                <input type="file" name="image" accept="image/jpeg,image/png,image/webp" id="blog-image"
                    class="block text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 file:cursor-pointer file:transition-colors">
                <?php if (isset($errors['image'])): ?>
                    <p class="mt-1 text-xs text-red-600"><?= h($errors['image']) ?></p>
                <?php endif; ?>
                <p class="mt-1 text-xs text-gray-400">JPG, PNG, or WebP. Max 5 MB.</p>

                <!-- Image preview -->
                <div id="image-preview-wrap" class="mt-3 hidden">
                    <img id="image-preview" src="" alt="Preview" class="w-64 h-40 object-cover rounded-lg border border-gray-200 shadow-sm">
                </div>
            </div>

        </div>

        <!-- Actions -->
        <div class="px-5 py-4 border-t border-gray-100 bg-gray-50 flex flex-wrap items-center gap-3">
            <?php if ($isEdit && $post->status === 'published'): ?>
                <button type="submit" name="action" value="publish"
                    class="px-5 py-2.5 bg-primary text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition-colors">
                    Update & Publish
                </button>
                <button type="submit" name="action" value="unpublish"
                    class="px-5 py-2.5 bg-amber-500 text-white text-sm font-medium rounded-lg hover:bg-amber-600 transition-colors">
                    Unpublish (Draft)
                </button>
            <?php else: ?>
                <button type="submit" name="action" value="publish"
                    class="px-5 py-2.5 bg-primary text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition-colors">
                    Publish
                </button>
                <button type="submit" name="action" value="draft"
                    class="px-5 py-2.5 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 transition-colors">
                    Save as Draft
                </button>
            <?php endif; ?>

            <?php if ($isEdit): ?>
                <a href="<?= url('/admin/blog/' . $post->id . '/preview') ?>"
                    class="px-5 py-2.5 text-sm font-medium text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-100 transition-colors">
                    Preview
                </a>
            <?php endif; ?>

            <a href="<?= url('/admin/blog') ?>"
                class="px-5 py-2.5 text-sm text-gray-500 hover:text-gray-700 transition-colors ml-auto">Cancel</a>
        </div>
    </form>
</div>

<script>
// Auto-generate slug from title
(function() {
    const titleInput = document.getElementById('blog-title');
    const slugInput  = document.getElementById('blog-slug');
    let slugEdited   = <?= ($isEdit && !empty($post->slug)) ? 'true' : 'false' ?>;

    // Track if user manually edited slug
    slugInput.addEventListener('input', function() {
        slugEdited = true;
    });

    titleInput.addEventListener('input', function() {
        if (!slugEdited || slugInput.value === '') {
            slugInput.value = titleInput.value
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/[\s-]+/g, '-')
                .replace(/^-+|-+$/g, '');
            slugEdited = false;
        }
    });
})();

// Image preview
document.getElementById('blog-image').addEventListener('change', function(e) {
    const wrap = document.getElementById('image-preview-wrap');
    const img  = document.getElementById('image-preview');
    if (e.target.files && e.target.files[0]) {
        const reader = new FileReader();
        reader.onload = function(ev) {
            img.src = ev.target.result;
            wrap.classList.remove('hidden');
        };
        reader.readAsDataURL(e.target.files[0]);
    } else {
        wrap.classList.add('hidden');
    }
});
</script>
