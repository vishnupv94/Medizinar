<?php partial('inner-hero', [
    'breadcrumb'      => 'FAQ',
    'heroTitle'       => 'Frequently Asked Questions',
    'heroDescription' => 'Find clear answers to common questions about our home healthcare, nursing, and elderly care services.',
]) ?>

<section class="py-16 sm:py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">

        <?php if (empty($faqs)): ?>
            <div class="text-center py-16 bg-white rounded-2xl border border-gray-100 shadow-sm">
                <svg class="w-16 h-16 text-gray-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h2 class="text-xl font-semibold text-gray-400 mb-2">No FAQs yet</h2>
                <p class="text-gray-400">Please check back later or contact us directly with your questions.</p>
                <a href="<?= url('/contact') ?>" class="inline-flex items-center gap-2 mt-6 bg-primary hover:bg-primary-800 text-white font-semibold text-sm px-5 py-2.5 rounded-lg transition-colors shadow-sm">
                    Contact Us
                </a>
            </div>
        <?php else: ?>
            <div class="space-y-4">
                <?php foreach ($faqs as $faq): ?>
                    <div class="faq-item border border-gray-200/80 rounded-xl bg-white overflow-hidden transition-all duration-300 hover:shadow-sm">
                        <button class="faq-toggle w-full flex items-center justify-between p-5 text-left text-gray-800 hover:text-primary transition-colors focus:outline-none" aria-expanded="false">
                            <span class="font-semibold text-base sm:text-lg pr-4"><?= h(strip_tags($faq->question)) ?></span>
                            <span class="faq-icon-wrapper flex-shrink-0 text-gray-400 bg-gray-50 rounded-lg p-1.5 transition-colors duration-300">
                                <svg class="w-5 h-5 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </button>
                        <div class="faq-content max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                            <div class="p-5 pt-0 border-t border-gray-100/50 text-gray-600 leading-relaxed text-sm sm:text-base">
                                <?= nl2br(h(strip_tags($faq->answer))) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Still have questions helper -->
            <div class="mt-16 text-center bg-primary-50 rounded-2xl p-8 border border-primary-100">
                <h3 class="text-lg font-bold text-primary-900 mb-2">Still have questions?</h3>
                <p class="text-primary-700 text-sm max-w-lg mx-auto mb-6">
                    If you couldn't find the answers you were looking for, our friendly support team is always ready to assist you.
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="tel:<?= PHONE ?>" class="inline-flex items-center gap-2 bg-primary hover:bg-primary-800 text-white font-semibold text-sm px-5 py-2.5 rounded-lg transition-colors shadow-sm">
                        Call <?= PHONE_DISPLAY ?>
                    </a>
                    <a href="<?= url('/contact') ?>" class="inline-flex items-center gap-2 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-semibold text-sm px-5 py-2.5 rounded-lg transition-colors">
                        Write to Us
                    </a>
                </div>
            </div>
        <?php endif; ?>

    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.faq-toggle').forEach(button => {
        button.addEventListener('click', () => {
            const item = button.closest('.faq-item');
            const content = item.querySelector('.faq-content');
            const icon = item.querySelector('svg');
            const iconWrapper = item.querySelector('.faq-icon-wrapper');
            const isExpanded = button.getAttribute('aria-expanded') === 'true';
            
            // Close other items
            document.querySelectorAll('.faq-item').forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.querySelector('.faq-toggle').setAttribute('aria-expanded', 'false');
                    otherItem.querySelector('.faq-content').style.maxHeight = null;
                    otherItem.querySelector('svg').classList.remove('rotate-180');
                    otherItem.querySelector('.faq-icon-wrapper').classList.remove('bg-primary-100', 'text-primary-700');
                    otherItem.querySelector('.faq-icon-wrapper').classList.add('bg-gray-50', 'text-gray-400');
                }
            });

            if (isExpanded) {
                button.setAttribute('aria-expanded', 'false');
                content.style.maxHeight = null;
                icon.classList.remove('rotate-180');
                iconWrapper.classList.remove('bg-primary-100', 'text-primary-700');
                iconWrapper.classList.add('bg-gray-50', 'text-gray-400');
            } else {
                button.setAttribute('aria-expanded', 'true');
                content.style.maxHeight = content.scrollHeight + 'px';
                icon.classList.add('rotate-180');
                iconWrapper.classList.remove('bg-gray-50', 'text-gray-400');
                iconWrapper.classList.add('bg-primary-100', 'text-primary-700');
            }
        });
    });
});
</script>

<?php partial('cta') ?>
