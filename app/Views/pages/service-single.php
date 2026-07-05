<?php
/**
 * Individual service page view.
 * Variables: $service (object from DB), $features (array), $faqs (array of objects), $slug (string)
 */
$isGreen     = ($service->color ?? 'green') === 'green';
$accentColor = $isGreen ? '#186c21' : '#ab7e22';
$accentLight = $isGreen ? 'rgba(23,107,35,0.10)' : 'rgba(171,126,34,0.10)';
?>

<?php partial('inner-hero', [
    'heroTitle'       => h($service->h1),
    'heroDescription' => h($service->hero_desc),
    'breadcrumb'      => h($service->h1),
]) ?>


<!-- AI-Readable Factual Intro -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="grid lg:grid-cols-2 gap-12 items-start">

            <!-- Left: What + Ideal For -->
            <div class="fade-in-up">
                <div class="section-badge mb-3"><?= h($service->badge) ?></div>
                <h2 class="text-2xl font-bold text-gray-800 mb-4"><?= h($service->intro_what) ?></h2>
                <p class="text-gray-600 leading-relaxed mb-6"><?= h($service->intro_body) ?></p>

                <div class="rounded-xl p-5 border" style="background:<?= $accentLight ?>;border-color:<?= $accentColor ?>22">
                    <h3 class="font-semibold text-gray-800 mb-2 text-sm uppercase tracking-widest" style="color:<?= $accentColor ?>">Ideal For</h3>
                    <p class="text-gray-600 text-sm leading-relaxed"><?= h($service->ideal_for) ?></p>
                </div>
            </div>

            <!-- Right: Feature checklist -->
            <div class="fade-in-up">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
                    <h3 class="font-bold text-gray-800 text-lg mb-5">What's Included</h3>
                    <ul class="space-y-3">
                        <?php foreach ($features as $feature): ?>
                            <li class="flex items-start gap-3">
                                <span class="w-5 h-5 rounded-full flex items-center justify-center shrink-0 mt-0.5"
                                    style="background:<?= $accentLight ?>">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color:<?= $accentColor ?>">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </span>
                                <span class="text-gray-600 text-sm leading-relaxed"><?= h($feature) ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- CTA Banner -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="rounded-2xl overflow-hidden fade-in-up" style="background:#0c2912;position:relative;min-height:160px">
            <div class="hero-pattern absolute inset-0" style="opacity:0.08"></div>
            <div class="relative z-10 p-8 sm:p-10 flex flex-col sm:flex-row items-center justify-between gap-6">
                <div>
                    <p class="text-white/60 text-sm mb-1">Get Started Today</p>
                    <h2 class="text-2xl font-bold text-white">Ready to Arrange <?= h($service->h1) ?>?</h2>
                    <p class="text-white/70 text-sm mt-2 max-w-lg">Contact us or make an appointment and our team will connect you with a verified, compassionate caregiver.</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3 shrink-0">
                    <a href="<?= url('/appointment') ?>?service=<?= h($service->service_param) ?>" class="btn-primary whitespace-nowrap">
                        Book This Service
                    </a>
                    <a href="<?= h(whatsapp_link(WHATSAPP_NUM, 'Hi Medizinar Care, I need ' . $service->h1 . ' services.')) ?>"
                        target="_blank" rel="noopener"
                        class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl font-semibold text-sm text-white border border-white/30 hover:bg-white/10 transition-all whitespace-nowrap">
                        <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        WhatsApp Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- FAQ Accordion -->
<?php if (!empty($faqs)): ?>
<section class="py-16" style="background:#f8fbf8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-10 fade-in-up">
            <div class="section-badge">Common Questions</div>
            <h2 class="section-title">Frequently Asked Questions</h2>
        </div>
        <div class="space-y-4 fade-in-up">
            <?php foreach ($faqs as $i => $faq): ?>
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                    <button class="w-full text-left px-6 py-4 flex items-center justify-between gap-4 font-semibold text-gray-800 hover:bg-gray-50 transition-colors"
                        onclick="toggleFaq(this)" aria-expanded="false" id="faq-btn-<?= $i ?>">
                        <span><?= h($faq->question) ?></span>
                        <svg class="w-4 h-4 shrink-0 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="faq-body px-6 pb-5 text-gray-600 text-sm leading-relaxed hidden">
                        <?= h($faq->answer) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<script>
function toggleFaq(btn) {
    const body = btn.nextElementSibling;
    const icon = btn.querySelector('svg');
    const open = btn.getAttribute('aria-expanded') === 'true';
    btn.setAttribute('aria-expanded', !open);
    body.classList.toggle('hidden', open);
    icon.style.transform = open ? '' : 'rotate(180deg)';
}
</script>
<?php endif; ?>


<!-- Other Services Grid -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-10 fade-in-up">
            <div class="section-badge">More Services</div>
            <h2 class="section-title">Explore Our Other Services</h2>
        </div>
        <?php
        use App\Models\Service as ServiceModel;
        $others = array_filter(ServiceModel::getPublished(), fn($s) => $s->slug !== $slug);
        ?>
        <div class="grid sm:grid-cols-2 lg:grid-cols-<?= min(count($others), 5) ?> gap-4 fade-in-up">
            <?php foreach ($others as $other): ?>
                <a href="<?= url('/services/' . $other->slug) ?>"
                    class="group rounded-xl border border-gray-100 bg-white p-4 text-center hover:border-primary-300 hover:shadow-md transition-all">
                    <span class="text-xs font-semibold uppercase tracking-widest" style="color:#186c21"><?= h($other->badge) ?></span>
                    <p class="text-gray-800 font-semibold text-sm mt-1 group-hover:text-primary-700 transition-colors"><?= h($other->h1) ?></p>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php partial('cta', [
    'ctaPreTitle'    => 'Get Started Today',
    'ctaTitle'       => 'Need ' . h($service->h1) . ' in Kerala?',
    'ctaDescription' => 'Contact Medizinar Care today. Our team will help arrange the right caregiver for your family — quickly and reliably.',
]) ?>
