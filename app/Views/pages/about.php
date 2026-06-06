<?php partial('inner-hero', [
    'heroTitle'       => 'About Medizinar Care',
    'heroDescription' => 'Our story, mission, and the values that guide every caregiver and team member.',
    'breadcrumb'      => 'About Us',
]) ?>


<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="grid lg:grid-cols-2 gap-14 items-center">

            <div class="fade-in-up">
                <div class="relative">
                    <div class="rounded-2xl overflow-hidden" style="height:420px">
                        <img src="<?= asset('images/homecare.jpg') ?>" alt="Medizinar Care caregiver" class="w-full h-full object-cover" loading="lazy">
                        <div class="absolute inset-0 rounded-2xl" style="background:linear-gradient(to top,rgba(12,41,18,0.6) 0%,transparent 55%)"></div>
                    </div>
                    <!-- Stats bar -->
                    <div class="absolute bottom-5 left-5 right-5">
                        <div class="grid grid-cols-4 gap-2">
                            <?php $stats = [['100+', 'Families'], ['4+', 'Services'], ['Kerala', 'Based In'], ['24/7', 'Available']];
                            foreach ($stats as $s): ?>
                                <div class="rounded-xl p-3 text-center" style="background:rgba(255,255,255,0.12);backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,0.2)">
                                    <div class="text-sm font-bold text-white"><?= $s[0] ?></div>
                                    <div class="text-white/65 text-[10px] mt-0.5"><?= $s[1] ?></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- Accent corner -->
                    <div class="absolute -bottom-3 -right-3 w-24 h-24 rounded-2xl -z-10" style="background:var(--accent-light)"></div>
                    <div class="absolute -top-3 -left-3 w-16 h-16 rounded-xl -z-10" style="background:var(--primary-light)"></div>
                </div>
            </div>

            <div class="fade-in-up">
                <div class="section-badge">Who We Are</div>
                <h2 class="section-title mb-5">Compassionate Home Healthcare</h2>
                <p class="text-gray-600 leading-relaxed mb-4">
                    Medizinar Care is dedicated to providing compassionate and reliable home healthcare services that support
                    patients, elderly individuals, and families in the comfort of their homes.
                </p>
                <p class="text-gray-600 leading-relaxed mb-4">
                    Our services are designed to ensure that every individual receives dignified, safe, and supportive care
                    while maintaining the comfort of familiar surroundings.
                </p>
                <p class="text-gray-600 leading-relaxed">
                    At Medizinar Care, we understand that caring for a loved one requires trust, responsibility, and
                    compassion. Our caregivers are carefully selected to provide dependable assistance and respectful
                    support to every family we serve.
                </p>
            </div>

        </div>
    </div>
</section>


<section class="py-20" style="background:#f8fbf8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-12 fade-in-up">
            <div class="section-badge">Direction &amp; Purpose</div>
            <h2 class="section-title">Our Mission &amp; Vision</h2>
        </div>
        <div class="grid md:grid-cols-2 gap-8">

            <div class="value-card fade-in-up">
                <div class="flex items-center gap-3 mb-4">
                    <img src="<?= asset('images/icon-mission.png') ?>" alt="Mission" class="w-12 h-12 shrink-0" loading="lazy">
                    <h3 class="text-xl font-bold" style="color:var(--text-dark)">Our Mission</h3>
                </div>
                <p class="text-sm leading-relaxed" style="color:var(--text-muted)">
                    Our mission is to deliver compassionate, reliable, and professional home care services that enhance
                    the comfort, safety, and well-being of individuals and families.
                    We aim to make quality caregiving support accessible to those who need assistance at home.
                </p>
            </div>

            <div class="value-card fade-in-up">
                <div class="flex items-center gap-3 mb-4">
                    <img src="<?= asset('images/icon-vision.png') ?>" alt="Vision" class="w-12 h-12 shrink-0" loading="lazy">
                    <h3 class="text-xl font-bold" style="color:var(--text-dark)">Our Vision</h3>
                </div>
                <p class="text-sm leading-relaxed" style="color:var(--text-muted)">
                    Our vision is to become a trusted and recognized home healthcare service provider, known for
                    compassionate caregiving, professional service, and commitment to client satisfaction.
                    We strive to build long-term relationships with families by providing dependable care solutions.
                </p>
            </div>

        </div>
    </div>
</section>


<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-12 fade-in-up">
            <div class="section-badge">What We Stand For</div>
            <h2 class="section-title">Our Core Values</h2>
            <p class="section-subtitle mx-auto mt-3">
                These values guide every decision we make and every service we deliver.
            </p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php
            $values = [
                ['img' => 'icon-compassion.png', 'title' => 'Compassion',      'desc' => 'We treat every individual with kindness, empathy, and deep respect regardless of their condition.'],
                ['img' => 'icon-trust.png',       'title' => 'Trust',           'desc' => 'We understand the importance of trust when families invite caregivers into their homes.'],
                ['img' => 'icon-responsibility.png', 'title' => 'Responsibility', 'desc' => 'Our caregivers are committed to providing responsible, dependable, and consistent support.'],
                ['img' => 'icon-quality.png',     'title' => 'Quality Care',    'desc' => 'We focus on maintaining high standards in every service we provide to every family.'],
            ];
            foreach ($values as $i => $v): ?>
                <div class="value-card text-center fade-in-up" style="animation-delay:<?= $i * 0.1 ?>s">
                    <img src="<?= asset('images/' . $v['img']) ?>" alt="<?= h($v['title']) ?>" class="w-14 h-14 mx-auto mb-4" loading="lazy">
                    <h3 class="font-bold text-lg mb-2" style="color:var(--text-dark)"><?= h($v['title']) ?></h3>
                    <p class="text-sm leading-relaxed" style="color:var(--text-muted)"><?= $v['desc'] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<section class="py-20" style="background:#f8fbf8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="grid lg:grid-cols-2 gap-14 items-center">

            <div class="fade-in-up">
                <div class="section-badge">Our People</div>
                <h2 class="section-title mb-5">Our Caregivers</h2>
                <p class="text-gray-600 leading-relaxed mb-5">
                    At Medizinar Care, caregivers play an essential role in delivering quality care services.
                    Each caregiver is selected based on experience, dedication, and commitment to compassionate service.
                </p>
                <div class="space-y-3 mb-8">
                    <?php
                    $roles = [
                        ['label' => 'Patient care assistants',       'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#ab7e22" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/></svg>'],
                        ['label' => 'Elderly care supporters',       'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#ab7e22" stroke-linecap="round" stroke-linejoin="round"><path d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>'],
                        ['label' => 'Mother &amp; baby care assistants', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#ab7e22" stroke-linecap="round" stroke-linejoin="round"><path d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z"/></svg>'],
                        ['label' => 'Domestic support staff',        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#ab7e22" stroke-linecap="round" stroke-linejoin="round"><path d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>'],
                    ];
                    foreach ($roles as $r): ?>
                        <div class="feature-item">
                            <div class="feature-check" style="background:var(--accent-light)"><?= $r['icon'] ?></div>
                            <span class="text-sm" style="color:var(--text-dark)"><?= $r['label'] ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a href="<?= url('/team') ?>" class="btn-outline-green">Meet Our Team</a>
            </div>

            <div class="fade-in-up relative">
                <div class="rounded-2xl overflow-hidden" style="height:420px">
                    <img src="<?= asset('images/about-care.jpg') ?>" alt="Medizinar Care professional caregiver" class="w-full h-full object-cover" loading="lazy">
                    <div class="absolute inset-0 rounded-2xl" style="background:linear-gradient(to top,rgba(12,41,18,0.55) 0%,transparent 50%)"></div>
                </div>
                <div class="absolute bottom-5 left-5 right-5">
                    <div class="grid grid-cols-2 gap-3">
                        <?php
                        $caregiver_types = [
                            ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#186c21" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/></svg>', 'title' => 'Patient Care'],
                            ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#186c21" stroke-linecap="round" stroke-linejoin="round"><path d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>', 'title' => 'Elderly Care'],
                            ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#186c21" stroke-linecap="round" stroke-linejoin="round"><path d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z"/></svg>', 'title' => 'Mother &amp; Baby'],
                            ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#186c21" stroke-linecap="round" stroke-linejoin="round"><path d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>', 'title' => 'Domestic Support'],
                        ];
                        foreach ($caregiver_types as $c): ?>
                            <div class="flex items-center gap-2.5 rounded-xl px-3 py-2.5" style="background:rgba(255,255,255,0.12);backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,0.18)">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0" style="background:rgba(255,255,255,0.9)"><?= $c['icon'] ?></div>
                                <span class="text-white text-xs font-semibold leading-tight"><?= $c['title'] ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="absolute -bottom-3 -left-3 w-20 h-20 rounded-2xl -z-10" style="background:var(--primary-light)"></div>
            </div>

        </div>
    </div>
</section>


<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-12 fade-in-up">
            <div class="section-badge">Our Commitment</div>
            <h2 class="section-title">Why Families Trust Medizinar Care</h2>
            <p class="section-subtitle mx-auto mt-3">
                What families can expect from us every single day.
            </p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-5 gap-5 max-w-5xl mx-auto">
            <?php
            $reasons = [
                ['img' => 'icon-caregivers.png',   'title' => 'Compassionate Caregivers'],
                ['img' => 'icon-reliable.png',      'title' => 'Reliable Service Support'],
                ['img' => 'icon-flexible.png',      'title' => 'Flexible Care Options'],
                ['img' => 'icon-quality.png',       'title' => 'Client Satisfaction'],
                ['img' => 'icon-professional.png',  'title' => 'Professional Assistance'],
            ];
            foreach ($reasons as $i => $r): ?>
                <div class="value-card text-center fade-in-up" style="animation-delay:<?= $i * 0.08 ?>s">
                    <img src="<?= asset('images/' . $r['img']) ?>" alt="<?= h($r['title']) ?>" class="w-14 h-14 mx-auto mb-3" loading="lazy">
                    <p class="font-semibold text-sm" style="color:var(--text-dark)"><?= h($r['title']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<?php partial('cta', [
    'ctaPreTitle'   => 'Ready to get started?',
    'ctaTitle'       => 'Need Care Support?',
    'ctaDescription' => 'Our team is ready to help you find the right caregiving service for your needs.',
]) ?>