<?php partial('inner-hero', [
    'heroTitle'       => 'About Medizinar Care',
    'heroDescription' => 'Our story, mission, and the values that guide every caregiver and team member.',
    'breadcrumb'      => 'About Us',
]) ?>


<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="grid lg:grid-cols-2 gap-14 items-center">

            <div class="fade-in-up">
                <div class="rounded-2xl relative overflow-hidden" style="background:linear-gradient(135deg,#f0faf1,#f8eed8)">
                    <img src="<?= asset('images/hero-about.svg') ?>" alt="Medizinar Care team and values" class="w-full h-auto" width="600" height="500" loading="lazy">
                    <div class="absolute bottom-0 left-0 right-0 p-5">
                        <div class="grid grid-cols-4 gap-2">
                            <?php $stats = [['100+', 'Families Served'], ['4+', 'Core Services'], ['Kerala', 'Based In'], ['24/7', 'Available']];
                            foreach ($stats as $s): ?>
                                <div class="bg-white/90 backdrop-blur-sm rounded-xl p-2.5 text-center shadow-sm">
                                    <div class="text-sm font-bold" style="color:#176B23"><?= $s[0] ?></div>
                                    <div class="text-gray-500 text-[10px] mt-0.5"><?= $s[1] ?></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
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

            <div class="value-card fade-in-up relative overflow-hidden">
                <div class="absolute top-0 left-0 w-1.5 h-full rounded-l-lg" style="background:#176B23"></div>
                <div class="pl-4">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0" style="background:#e0f4e2">
                            <span class="text-xl">🌟</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Our Mission</h3>
                    </div>
                    <p class="text-gray-600 leading-relaxed">
                        Our mission is to deliver compassionate, reliable, and professional home care services that enhance
                        the comfort, safety, and well-being of individuals and families.
                        We aim to make quality caregiving support accessible to those who need assistance at home.
                    </p>
                </div>
            </div>

            <div class="value-card fade-in-up relative overflow-hidden">
                <div class="absolute top-0 left-0 w-1.5 h-full rounded-l-lg" style="background:#a5781e"></div>
                <div class="pl-4">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0" style="background:#f8eed8">
                            <span class="text-xl">👁</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Our Vision</h3>
                    </div>
                    <p class="text-gray-600 leading-relaxed">
                        Our vision is to become a trusted and recognized home healthcare service provider, known for
                        compassionate caregiving, professional service, and commitment to client satisfaction.
                        We strive to build long-term relationships with families by providing dependable care solutions.
                    </p>
                </div>
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
                ['emoji' => '❤', 'title' => 'Compassion', 'color' => '#fef2f2', 'desc' => 'We treat every individual with kindness, empathy, and deep respect regardless of their condition.'],
                ['emoji' => '🛡', 'title' => 'Trust',      'color' => '#eff6ff', 'desc' => 'We understand the importance of trust when families invite caregivers into their homes.'],
                ['emoji' => '✅', 'title' => 'Responsibility', 'color' => '#f0faf1', 'desc' => 'Our caregivers are committed to providing responsible, dependable, and consistent support.'],
                ['emoji' => '⭐', 'title' => 'Quality Care', 'color' => '#fffbeb', 'desc' => 'We focus on maintaining high standards in every service we provide to every family.'],
            ];
            foreach ($values as $i => $v): ?>
                <div class="value-card text-center fade-in-up" style="animation-delay:<?= $i * 0.1 ?>s">
                    <div class="w-14 h-14 rounded-full mx-auto mb-4 flex items-center justify-center text-2xl"
                        style="background:<?= $v['color'] ?>">
                        <?= $v['emoji'] ?>
                    </div>
                    <h3 class="font-bold text-gray-800 text-lg mb-2"><?= h($v['title']) ?></h3>
                    <p class="text-gray-500 text-sm leading-relaxed"><?= $v['desc'] ?></p>
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
                        '👩 Patient care assistants',
                        '👴 Elderly care supporters',
                        '👶 Mother &amp; baby care assistants',
                        '🏠 Domestic support staff',
                    ];
                    foreach ($roles as $r): ?>
                        <div class="feature-item">
                            <div class="feature-check">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color:#a5781e">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span class="text-gray-700 text-sm"><?= $r ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a href="<?= url('/team') ?>" class="btn-outline-green">Meet Our Team</a>
            </div>

            <div class="grid grid-cols-2 gap-4 fade-in-up">
                <?php
                $caregiver_types = [
                    ['emoji' => '🩺', 'title' => 'Patient Care Assistant',   'bg' => '#e0f4e2', 'desc' => 'Experienced in bedside care and patient daily support.'],
                    ['emoji' => '👴', 'title' => 'Elderly Care Assistant',   'bg' => '#eff6ff', 'desc' => 'Provides mobility support, companionship and daily living assistance.'],
                    ['emoji' => '👶', 'title' => 'Mother &amp; Baby Care',   'bg' => '#fdf2f8', 'desc' => 'Experienced in newborn care and postnatal recovery support.'],
                    ['emoji' => '🏠', 'title' => 'Domestic Support',         'bg' => '#fffbeb', 'desc' => 'Provides reliable household assistance and domestic tasks.'],
                ];
                foreach ($caregiver_types as $c): ?>
                    <div class="value-card text-center" style="background:<?= $c['bg'] ?>;border-color:transparent">
                        <div class="text-3xl mb-3"><?= $c['emoji'] ?></div>
                        <h4 class="font-semibold text-gray-800 text-sm mb-1.5"><?= $c['title'] ?></h4>
                        <p class="text-gray-500 text-xs leading-relaxed"><?= $c['desc'] ?></p>
                    </div>
                <?php endforeach; ?>
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
        <div class="grid sm:grid-cols-2 lg:grid-cols-5 gap-6 max-w-5xl mx-auto">
            <?php
            $reasons = [
                ['emoji' => '🤝', 'title' => 'Compassionate Caregivers'],
                ['emoji' => '🕒', 'title' => 'Reliable Service Support'],
                ['emoji' => '🔄', 'title' => 'Flexible Care Options'],
                ['emoji' => '⭐', 'title' => 'Client Satisfaction'],
                ['emoji' => '🏥', 'title' => 'Professional Assistance'],
            ];
            foreach ($reasons as $i => $r): ?>
                <div class="value-card text-center fade-in-up" style="animation-delay:<?= $i * 0.08 ?>s">
                    <div class="text-3xl mb-3"><?= $r['emoji'] ?></div>
                    <p class="font-semibold text-gray-700 text-sm"><?= h($r['title']) ?></p>
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