<section class="inner-hero py-16 relative overflow-hidden">
    <div class="hero-pattern absolute inset-0 opacity-20"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10 text-center">
        <nav class="flex justify-center items-center gap-2 text-white/60 text-sm mb-4" aria-label="Breadcrumb">
            <a href="<?= url('/') ?>" class="hover:text-white transition-colors">Home</a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="text-white"><?= h($breadcrumb) ?></span>
        </nav>
        <h1 class="text-4xl sm:text-5xl font-bold text-white mb-4"><?= h($heroTitle) ?></h1>
        <p class="text-white/80 text-lg max-w-2xl mx-auto">
            <?= h($heroDescription) ?>
        </p>
    </div>
</section>