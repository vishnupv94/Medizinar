<?php
/**
 * Location page view — /location/{district}
 * Variables: $district (object from DB), $localities (array), $allLocations (array), $slug (string)
 */
?>

<?php partial('inner-hero', [
    'heroTitle'       => h($district->hero_title),
    'heroDescription' => h($district->hero_desc),
    'breadcrumb'      => h($district->name),
]) ?>


<!-- Intro Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="grid lg:grid-cols-3 gap-10">

            <!-- Main Content -->
            <div class="lg:col-span-2 fade-in-up">
                <div class="section-badge mb-3">Kerala Home Care</div>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">
                    Professional Home Care in <?= h($district->name) ?>, Kerala
                </h2>
                <p class="text-gray-600 leading-relaxed mb-6"><?= h($district->intro) ?></p>

                <!-- Localities covered -->
                <div class="mb-8">
                    <h3 class="font-semibold text-gray-800 mb-3">Areas Covered in <?= h($district->name) ?></h3>
                    <div class="flex flex-wrap gap-2">
                        <?php foreach ($localities as $loc): ?>
                            <span class="px-3 py-1.5 rounded-full text-sm font-medium border"
                                style="background:#f0faf1;border-color:#b8e6bc;color:#186c21">
                                <?= h($loc) ?>
                            </span>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Services available -->
                <h3 class="font-semibold text-gray-800 mb-4">Services Available in <?= h($district->name) ?></h3>
                <?php
                use App\Models\Service as ServiceModel;
                $services = ServiceModel::getPublished();
                ?>
                <div class="grid sm:grid-cols-2 gap-4">
                    <?php foreach ($services as $svc): ?>
                        <a href="<?= url('/services/' . $svc->slug) ?>"
                            class="group rounded-xl border border-gray-100 bg-white p-4 hover:border-primary-300 hover:shadow-md transition-all">
                            <p class="font-semibold text-gray-800 text-sm group-hover:text-primary-700 transition-colors"><?= h($svc->h1) ?></p>
                            <p class="text-gray-500 text-xs mt-1 leading-relaxed"><?= h(mb_substr($svc->intro_body, 0, 90)) ?>…</p>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Sidebar CTA -->
            <div class="fade-in-up">
                <div class="sticky top-24 rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="p-6" style="background:#0c2912">
                        <p class="text-white/60 text-xs uppercase tracking-widest mb-1">Get Care in <?= h($district->name) ?></p>
                        <h3 class="text-white font-bold text-lg leading-tight">Request a Caregiver Now</h3>
                        <p class="text-white/60 text-sm mt-2">Contact us today and we will arrange a verified caregiver in <?= h($district->name) ?> for your family.</p>
                    </div>
                    <div class="bg-white p-6 space-y-3">
                        <a href="<?= url('/appointment') ?>" class="btn-primary w-full text-center block">
                            Make an Appointment
                        </a>
                        <a href="tel:<?= PHONE ?>"
                            class="flex items-center justify-center gap-2 w-full px-4 py-3 rounded-xl border border-gray-200 text-gray-700 text-sm font-semibold hover:border-primary-300 hover:text-primary-700 transition-all">
                            <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                            </svg>
                            Call <?= PHONE_DISPLAY ?>
                        </a>
                        <a href="<?= h(whatsapp_link(WHATSAPP_NUM, 'Hi Medizinar Care, I need home care in ' . $district->name . ', Kerala.')) ?>"
                            target="_blank" rel="noopener"
                            class="flex items-center justify-center gap-2 w-full px-4 py-3 rounded-xl border border-gray-200 text-gray-700 text-sm font-semibold hover:border-green-300 hover:text-green-700 transition-all">
                            <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            WhatsApp Us
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- Trust Reasons -->
<section class="py-16" style="background:#f8fbf8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-10 fade-in-up">
            <div class="section-badge">Why Choose Us</div>
            <h2 class="section-title">Why Families in <?= h($district->name) ?> Trust Medizinar Care</h2>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 fade-in-up">
            <?php
            $reasons = [
                ['title' => 'Verified Caregivers',      'desc' => 'Every caregiver is background-checked and selected before placement.'],
                ['title' => 'Compassionate Care',       'desc' => 'We treat every family with empathy, patience, and the highest personal care standards.'],
                ['title' => 'Flexible Service Plans',   'desc' => 'Full-time, part-time, daily, or short-term — we match your exact requirement.'],
                ['title' => 'NRI-Friendly Service',     'desc' => 'We provide status updates to families abroad, so you stay informed wherever you are.'],
                ['title' => 'Fast Caregiver Placement', 'desc' => 'We typically arrange a caregiver within 24–48 hours of your enquiry.'],
                ['title' => 'Kerala-Wide Coverage',     'desc' => 'Based in Kottarakkara, we serve all 14 Kerala districts including ' . h($district->name) . '.'],
            ];
            foreach ($reasons as $r): ?>
                <div class="value-card fade-in-up">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center mb-4" style="background:#e0f4e2">
                        <svg class="w-4 h-4" fill="none" stroke="#186c21" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-2"><?= h($r['title']) ?></h3>
                    <p class="text-gray-500 text-sm leading-relaxed"><?= h($r['desc']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- Other Locations from DB -->
<?php $others = array_filter($allLocations, fn($l) => $l->slug !== $slug); ?>
<?php if (!empty($others)): ?>
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-8 fade-in-up">
            <h2 class="text-xl font-bold text-gray-800">We Also Serve Across Kerala</h2>
        </div>
        <div class="flex flex-wrap justify-center gap-2 fade-in-up">
            <?php foreach ($others as $loc): ?>
                <a href="<?= url('/location/' . $loc->slug) ?>"
                    class="px-4 py-2 rounded-full border text-sm font-medium transition-all hover:border-primary-400 hover:text-primary-700"
                    style="border-color:#d4e8d5;color:#186c21;background:#f0faf1">
                    <?= h($loc->name) ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>


<?php partial('cta', [
    'ctaPreTitle'    => 'Get Started Today',
    'ctaTitle'       => 'Need Home Care in ' . h($district->name) . '?',
    'ctaDescription' => 'Our team is ready to arrange a verified, compassionate caregiver in ' . h($district->name) . '. Contact us today.',
]) ?>
