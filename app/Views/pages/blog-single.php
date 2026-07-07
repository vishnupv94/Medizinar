<?php
$publishedDate = date('F j, Y', strtotime($post->published_at ?? $post->created_at));
$isoDate       = date('c', strtotime($post->published_at ?? $post->created_at));
$wordCount     = str_word_count(strip_tags($post->content));
$readTime      = max(1, (int) ceil($wordCount / 200));
$postUrl       = url('/blog/' . $post->slug);
$imageUrl      = !empty($post->image) ? url('uploads/blog/' . $post->image) : '';
?>

<!-- JSON-LD BlogPosting structured data for SEO -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BlogPosting",
    "headline": "<?= h($post->title) ?>",
    "description": "<?= h($post->excerpt ?: mb_substr(strip_tags($post->content), 0, 160)) ?>",
    "url": "<?= h($postUrl) ?>",
    <?php if ($imageUrl): ?>
    "image": "<?= h($imageUrl) ?>",
    <?php endif; ?>
    "datePublished": "<?= $isoDate ?>",
    "dateModified": "<?= date('c', strtotime($post->updated_at)) ?>",
    "author": {
        "@type": "Organization",
        "name": "<?= SITE_NAME ?>"
    },
    "publisher": {
        "@type": "Organization",
        "name": "<?= SITE_NAME ?>",
        "logo": {
            "@type": "ImageObject",
            "url": "<?= asset('images/favicon-512x512.png') ?>"
        }
    },
    "wordCount": <?= $wordCount ?>,
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "<?= h($postUrl) ?>"
    }
}
</script>

<!-- Banner image -->
<?php if ($imageUrl): ?>
<?php
$bPos   = $post->banner_pos ?? 'center center';
$bScale = (float)($post->banner_scale ?? 1.00);
?>
<div class="blog-banner">
    <img src="<?= h($imageUrl) ?>" alt="<?= h($post->title) ?>" class="blog-banner-img"
         style="object-position:<?= h($bPos) ?>; transform-origin:<?= h($bPos) ?>; transform: scale(<?= $bScale ?>);">
    <div class="blog-banner-overlay"></div>
</div>
<?php else: ?>
<?php partial('inner-hero', [
    'breadcrumb'      => 'Blog',
    'heroTitle'       => $post->title,
    'heroDescription' => $post->excerpt ?? '',
]) ?>
<?php endif; ?>

<article class="py-12 sm:py-16">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">

        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-sm text-gray-400 mb-6" aria-label="Breadcrumb">
            <a href="<?= url('/') ?>" class="hover:text-primary transition-colors">Home</a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <a href="<?= url('/blog') ?>" class="hover:text-primary transition-colors">Blog</a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-gray-600 truncate max-w-[200px]"><?= h($post->title) ?></span>
        </nav>

        <!-- Title (shown when banner image exists, since inner-hero won't show) -->
        <?php if ($imageUrl): ?>
        <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4 leading-tight"><?= h($post->title) ?></h1>
        <?php endif; ?>

        <!-- Meta -->
        <div class="flex flex-wrap items-center gap-3 text-sm text-gray-400 mb-8 pb-8 border-b border-gray-100">
            <div class="flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <time datetime="<?= $isoDate ?>"><?= $publishedDate ?></time>
            </div>
            <span>&middot;</span>
            <div class="flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span><?= $readTime ?> min read</span>
            </div>
        </div>

        <!-- Excerpt -->
        <?php if (!empty($post->excerpt)): ?>
            <p class="text-lg text-gray-500 italic mb-8 leading-relaxed"><?= h($post->excerpt) ?></p>
        <?php endif; ?>

        <!-- Content -->
        <div class="blog-content">
            <?= nl2br(h($post->content)) ?>
        </div>

        <!-- Back link -->
        <div class="mt-12 pt-8 border-t border-gray-100">
            <a href="<?= url('/blog') ?>"
                class="inline-flex items-center gap-2 text-sm font-semibold text-primary hover:text-primary-800 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                </svg>
                Back to All Posts
            </a>
        </div>

    </div>
</article>

<?php partial('cta') ?>
