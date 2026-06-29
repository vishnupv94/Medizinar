<div class="space-y-4">

    <!-- Preview banner -->
    <div class="rounded-xl bg-amber-50 border border-amber-200 p-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div class="flex items-center gap-2">
            <svg class="w-5 h-5 text-amber-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            </svg>
            <div>
                <p class="text-sm font-semibold text-amber-800">Preview Mode</p>
                <p class="text-xs text-amber-600">This is how the post will appear to visitors.
                    <?php if ($post->status === 'draft'): ?>
                        This post is <strong>not published</strong> yet.
                    <?php else: ?>
                        This post is <strong>published</strong>.
                    <?php endif; ?>
                </p>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <a href="<?= url('/admin/blog/' . $post->id . '/edit') ?>"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                Edit Post
            </a>
            <?php if ($post->status === 'draft'): ?>
                <form method="POST" action="<?= url('/admin/blog/' . $post->id) ?>" class="inline">
                    <?= csrf_field() ?>
                    <input type="hidden" name="title" value="<?= h($post->title) ?>">
                    <input type="hidden" name="slug" value="<?= h($post->slug) ?>">
                    <input type="hidden" name="content" value="<?= h($post->content) ?>">
                    <input type="hidden" name="excerpt" value="<?= h($post->excerpt ?? '') ?>">
                    <button type="submit" name="action" value="publish"
                        class="px-4 py-2 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary-700 transition-colors">
                        Publish Now
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <!-- Blog post preview -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

        <?php if (!empty($post->image)): ?>
            <div class="w-full h-64 sm:h-80 overflow-hidden">
                <img src="<?= url('uploads/blog/' . h($post->image)) ?>" alt="<?= h($post->title) ?>"
                    class="w-full h-full object-cover">
            </div>
        <?php endif; ?>

        <div class="p-6 sm:p-8 max-w-3xl">
            <div class="flex items-center gap-3 text-xs text-gray-400 mb-3">
                <span><?= date('F j, Y', strtotime($post->published_at ?? $post->created_at)) ?></span>
                <?php
                    $wordCount = str_word_count(strip_tags($post->content));
                    $readTime = max(1, (int) ceil($wordCount / 200));
                ?>
                <span>&middot;</span>
                <span><?= $readTime ?> min read</span>
            </div>

            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-6"><?= h($post->title) ?></h1>

            <?php if (!empty($post->excerpt)): ?>
                <p class="text-gray-500 text-base italic mb-6 pb-6 border-b border-gray-100"><?= h($post->excerpt) ?></p>
            <?php endif; ?>

            <div class="prose prose-gray max-w-none text-gray-700 leading-relaxed whitespace-pre-line"><?= nl2br(h($post->content)) ?></div>
        </div>
    </div>

</div>
