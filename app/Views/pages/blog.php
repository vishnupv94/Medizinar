<?php partial('inner-hero', [
    'breadcrumb'      => 'Blog',
    'heroTitle'       => 'Our Blog',
    'heroDescription' => 'Health tips, home care insights, and wellness articles from our team.',
]) ?>

<section class="py-16 sm:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">

        <?php if (empty($posts)): ?>
            <div class="text-center py-16">
                <svg class="w-16 h-16 text-gray-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
                <h2 class="text-xl font-semibold text-gray-400 mb-2">No posts yet</h2>
                <p class="text-gray-400">Check back soon for new articles and health tips.</p>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($posts as $post): ?>
                    <article class="blog-card fade-in-up">
                        <a href="<?= url('/blog/' . h($post->slug)) ?>" class="block">
                            <?php if (!empty($post->image)): ?>
                                <?php $cardScale = (float)($post->banner_scale ?? 1.00); ?>
                                <div class="blog-card-image-wrap">
                                    <img src="<?= url('uploads/blog/' . h($post->image)) ?>"
                                        alt="<?= h($post->title) ?>"
                                        class="blog-card-image"
                                        style="object-position:<?= h($post->banner_pos ?? 'center center') ?>; transform-origin:<?= h($post->banner_pos ?? 'center center') ?>; --banner-scale:<?= $cardScale ?>; transform: scale(<?= $cardScale ?>);"
                                        loading="lazy">
                                </div>
                            <?php else: ?>
                                <div class="blog-card-image-wrap bg-gradient-to-br from-primary-100 to-primary-50 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-primary-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                    </svg>
                                </div>
                            <?php endif; ?>
                        </a>
                        <div class="p-5">
                            <div class="flex items-center gap-2 text-xs text-gray-400 mb-2">
                                <time datetime="<?= date('Y-m-d', strtotime($post->published_at)) ?>">
                                    <?= date('M j, Y', strtotime($post->published_at)) ?>
                                </time>
                                <?php
                                    $wordCount = str_word_count(strip_tags($post->content));
                                    $readTime = max(1, (int) ceil($wordCount / 200));
                                ?>
                                <span>&middot;</span>
                                <span><?= $readTime ?> min read</span>
                            </div>
                            <h2 class="text-lg font-bold text-gray-800 mb-2 line-clamp-2 group-hover:text-primary transition-colors">
                                <a href="<?= url('/blog/' . h($post->slug)) ?>" class="hover:text-primary transition-colors">
                                    <?= h($post->title) ?>
                                </a>
                            </h2>
                            <?php if (!empty($post->excerpt)): ?>
                                <p class="text-sm text-gray-500 mb-4 line-clamp-3"><?= h($post->excerpt) ?></p>
                            <?php else: ?>
                                <p class="text-sm text-gray-500 mb-4 line-clamp-3"><?= h(mb_substr(strip_tags($post->content), 0, 160)) ?>…</p>
                            <?php endif; ?>
                            <a href="<?= url('/blog/' . h($post->slug)) ?>"
                                class="inline-flex items-center gap-1 text-sm font-semibold text-primary hover:text-primary-800 transition-colors">
                                Read More
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <?php if ($totalPages > 1): ?>
                <div class="flex items-center justify-center gap-3 mt-12">
                    <?php if ($currentPage > 1): ?>
                        <a href="<?= url('/blog?page=' . ($currentPage - 1)) ?>"
                            class="px-5 py-2.5 rounded-lg text-sm font-medium border border-gray-300 text-gray-600 hover:bg-gray-50 transition-colors">&laquo; Previous</a>
                    <?php endif; ?>
                    <span class="text-sm text-gray-500">Page <?= $currentPage ?> of <?= $totalPages ?></span>
                    <?php if ($currentPage < $totalPages): ?>
                        <a href="<?= url('/blog?page=' . ($currentPage + 1)) ?>"
                            class="px-5 py-2.5 rounded-lg text-sm font-medium border border-gray-300 text-gray-600 hover:bg-gray-50 transition-colors">Next &raquo;</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>

    </div>
</section>

<?php partial('cta') ?>
