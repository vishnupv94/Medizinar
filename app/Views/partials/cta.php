<section class="py-16 cta-section text-white relative overflow-hidden">
    <div class="hero-pattern absolute inset-0 opacity-20"></div>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 text-center relative z-10 fade-in-up">
        <p class="text-white/80 mb-3 text-base font-medium"><?= h($ctaPreTitle ?? 'Ready to get started?') ?></p>
        <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">
            <?= h($ctaTitle ?? 'Need Professional Home Care Support?') ?>
        </h2>
        <p class="text-white/75 mb-8"><?= h($ctaDescription ?? 'Our team is ready to help you find the right caregiving service for your needs.') ?></p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="<?= url('/appointment') ?>" class="btn-primary">Make an Appointment</a>
            <a href="tel:<?= PHONE ?>" class="btn-outline-white">Call Now: <?= PHONE_DISPLAY ?></a>
            <a href="<?= h(whatsapp_link(WHATSAPP_NUM)) ?>" target="_blank" rel="noopener" class="btn-outline-white">WhatsApp Chat</a>
        </div>
    </div>
</section>