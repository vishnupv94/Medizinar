<?php partial('inner-hero', [
    'heroTitle'       => 'Our Services',
    'heroDescription' => 'Compassionate home care services designed for patients, elderly individuals, and families — in the comfort of their homes.',
    'breadcrumb'      => 'Services',
]) ?>


<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="max-w-3xl mx-auto text-center fade-in-up">
            <div class="section-badge">What We Provide</div>
            <h2 class="section-title mb-4">Home Care Services for Every Need</h2>
            <p class="text-gray-600 leading-relaxed mb-4">
                At Medizinar Care, we provide compassionate and reliable home care services designed to support
                patients, elderly individuals, and families in the comfort of their homes.
            </p>
            <p class="text-gray-600 leading-relaxed">
                To make it easier for clients to understand our offerings, services are divided into two categories:
            </p>
        </div>
        <div class="grid md:grid-cols-2 gap-6 max-w-2xl mx-auto mt-8">
            <div class="value-card text-center fade-in-up">
                <div class="text-3xl mb-3">🏥</div>
                <h3 class="font-bold text-gray-800 mb-2">Main Home Care Services</h3>
                <p class="text-gray-500 text-sm">Long-term caregiving support with a dedicated caregiver paid monthly.</p>
            </div>
            <div class="value-card text-center fade-in-up">
                <div class="text-3xl mb-3">⚡</div>
                <h3 class="font-bold text-gray-800 mb-2">Quick Support Services</h3>
                <p class="text-gray-500 text-sm">Short-term / add-on services on a daily service charge basis.</p>
            </div>
        </div>
        <div class="max-w-md mx-auto mt-10 fade-in-up">
            <img src="<?= asset('images/hero-services.svg') ?>" alt="Medizinar Care services overview" class="w-full h-auto" width="600" height="500" loading="lazy">
        </div>
    </div>
</section>


<section class="py-16" style="background:#f8fbf8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-14 fade-in-up">
            <div class="section-badge">Long-Term Care</div>
            <h2 class="section-title">Main Home Care Services</h2>
            <p class="section-subtitle mx-auto mt-3">
                Regular caregiving assistance where the caregiver works with the family and receives a monthly salary directly from the client.
            </p>
        </div>

        <!-- Bedside Patient Care -->
        <div id="bedside" class="scroll-mt-24 mb-14">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="fade-in-up">
                    <div class="rounded-2xl p-10 relative overflow-hidden text-white"
                        style="background:linear-gradient(135deg,#0f5219,#176B23)">
                        <div class="hero-pattern absolute inset-0 opacity-20"></div>
                        <div class="relative z-10">
                            <div class="text-5xl mb-4">🛏</div>
                            <h3 class="text-2xl font-bold mb-3">Bedside Patient Care</h3>
                            <p class="text-white/80 text-sm leading-relaxed">
                                Professional support for patients recovering at home from illness, surgery, or long-term health conditions.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="fade-in-up">
                    <div class="section-badge">Service 01</div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Bedside Patient Care</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Our caregivers provide professional and compassionate bedside support to patients at home,
                        focusing on ensuring safe, dignified, and comfortable recovery.
                    </p>
                    <h4 class="font-semibold text-gray-800 mb-3">Services Include</h4>
                    <?php partial('feature-list', ['features' => [
                        'Personal hygiene assistance',
                        'Patient mobility support',
                        'Medication reminders',
                        'Assistance with daily activities',
                        'Comfort and monitoring support',
                    ]]) ?>
                    <a href="<?= url('/appointment') ?>?service=bedside" class="btn-primary mt-6">Book This Service</a>
                </div>
            </div>
        </div>

        <hr class="border-primary-100 my-12" style="border-color:#d4e8d5">

        <!-- Elderly Care -->
        <div id="elderly" class="scroll-mt-24 mb-14">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="fade-in-up order-2 lg:order-1">
                    <div class="section-badge">Service 02</div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Elderly Care</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Dedicated care services for senior citizens who require assistance with daily activities and
                        meaningful companionship within the comfort of their home.
                    </p>
                    <h4 class="font-semibold text-gray-800 mb-3">Services Include</h4>
                    <?php partial('feature-list', ['features' => [
                        'Assistance with daily living activities',
                        'Walking and mobility support',
                        'Personal hygiene assistance',
                        'Meal support and feeding assistance',
                        'Emotional companionship',
                    ]]) ?>
                    <a href="<?= url('/appointment') ?>?service=elderly" class="btn-primary mt-6">Book This Service</a>
                </div>
                <div class="fade-in-up order-1 lg:order-2">
                    <div class="rounded-2xl p-10 relative overflow-hidden text-white"
                        style="background:linear-gradient(135deg,#1a4a7a,#2563eb)">
                        <div class="hero-pattern absolute inset-0 opacity-20"></div>
                        <div class="relative z-10">
                            <div class="text-5xl mb-4">👴</div>
                            <h3 class="text-2xl font-bold mb-3">Elderly Care</h3>
                            <p class="text-white/80 text-sm leading-relaxed">
                                Respectful and supportive care for senior citizens ensuring dignity and comfort in a familiar environment.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr class="border-primary-100 my-12" style="border-color:#d4e8d5">

        <!-- Mother & Baby Care -->
        <div id="mother-baby" class="scroll-mt-24 mb-14">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="fade-in-up">
                    <div class="rounded-2xl p-10 relative overflow-hidden text-white"
                        style="background:linear-gradient(135deg,#7e22ce,#9333ea)">
                        <div class="hero-pattern absolute inset-0 opacity-20"></div>
                        <div class="relative z-10">
                            <div class="text-5xl mb-4">👶</div>
                            <h3 class="text-2xl font-bold mb-3">Mother &amp; Baby Care</h3>
                            <p class="text-white/80 text-sm leading-relaxed">
                                Compassionate support for mothers and newborns during the important postnatal recovery period.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="fade-in-up">
                    <div class="section-badge">Service 03</div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Mother &amp; Baby Care</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Care support for mothers and newborn babies during the postnatal recovery period. Our assistants
                        ensure safe and comfortable care for both mother and baby.
                    </p>
                    <h4 class="font-semibold text-gray-800 mb-3">Services Include</h4>
                    <?php partial('feature-list', ['features' => [
                        'Newborn care assistance',
                        'Mother recovery support',
                        'Baby hygiene care',
                        'Feeding assistance',
                        'Newborn routine care guidance',
                    ]]) ?>
                    <a href="<?= url('/appointment') ?>?service=mother-baby" class="btn-primary mt-6">Book This Service</a>
                </div>
            </div>
        </div>

        <hr class="border-primary-100 my-12" style="border-color:#d4e8d5">

        <!-- House Maid Services -->
        <div id="housemaid" class="scroll-mt-24">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="fade-in-up order-2 lg:order-1">
                    <div class="section-badge">Service 04</div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">House Maid Services</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Reliable domestic support for households needing assistance with daily tasks. Our assistants
                        help maintain a clean, comfortable, and organised home environment.
                    </p>
                    <h4 class="font-semibold text-gray-800 mb-3">Services Include</h4>
                    <?php partial('feature-list', ['features' => [
                        'House cleaning',
                        'Cooking assistance',
                        'Laundry support',
                        'Household organisation',
                    ]]) ?>
                    <a href="<?= url('/appointment') ?>?service=housemaid" class="btn-primary mt-6">Book This Service</a>
                </div>
                <div class="fade-in-up order-1 lg:order-2">
                    <div class="rounded-2xl p-10 relative overflow-hidden text-white"
                        style="background:linear-gradient(135deg,#92400e,#b45309)">
                        <div class="hero-pattern absolute inset-0 opacity-20"></div>
                        <div class="relative z-10">
                            <div class="text-5xl mb-4">🏠</div>
                            <h3 class="text-2xl font-bold mb-3">House Maid Services</h3>
                            <p class="text-white/80 text-sm leading-relaxed">
                                Trusted domestic staff providing daily household support and a clean, organised home environment.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


<section id="quick-support" class="py-20 bg-white scroll-mt-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-14 fade-in-up">
            <div class="section-badge">Add-On / Short-Term</div>
            <h2 class="section-title">Quick Support Services</h2>
            <p class="section-subtitle mx-auto mt-3">
                Designed for short-duration support, temporary assistance, emergency help, or short visits. These services
                are provided on a daily service charge basis paid directly to Medizinar Care.
            </p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php
            $quick = [
                [
                    'id'    => 'hospital-companion',
                    'emoji' => '🚶',
                    'title' => 'Hospital Visit Companion',
                    'items' => ['Assistance during doctor appointments', 'Support during hospital procedures', 'Patient assistance during hospital visits'],
                ],
                [
                    'id'    => 'day-support',
                    'emoji' => '⏰',
                    'title' => 'Elderly Day Support',
                    'items' => ['4–8 hours daytime support', 'Daily living assistance', 'Ideal for temporary daytime care'],
                ],
                [
                    'id'    => 'night-care',
                    'emoji' => '🌙',
                    'title' => 'Night Care Service',
                    'items' => ['Night-time patient monitoring', 'Elderly safety assurance', 'Overnight caregiving support'],
                ],
                [
                    'id'    => 'nri',
                    'emoji' => '🌍',
                    'title' => 'NRI Parent Care',
                    'items' => ['Home visit check', 'Parent well-being assessment', 'Status update to family members'],
                ],
            ];
            foreach ($quick as $i => $q): ?>
                <div id="<?= $q['id'] ?>" class="service-card fade-in-up scroll-mt-24" style="animation-delay:<?= $i * 0.1 ?>s">
                    <div class="service-icon"><span class="text-2xl"><?= $q['emoji'] ?></span></div>
                    <h3 class="font-bold text-gray-800 mb-3"><?= h($q['title']) ?></h3>
                    <ul class="space-y-2 mb-4">
                        <?php foreach ($q['items'] as $item): ?>
                            <li class="flex items-start gap-2 text-gray-500 text-sm">
                                <svg class="w-3.5 h-3.5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color:#a5781e">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                </svg>
                                <?= h($item) ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <a href="<?= url('/appointment') ?>?service=<?= $q['id'] ?>" class="inline-flex items-center gap-1 text-sm font-semibold transition-all hover:gap-2" style="color:#a5781e">
                        Book Now
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<section class="py-16 cta-section text-white relative overflow-hidden">
    <div class="hero-pattern absolute inset-0 opacity-20"></div>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 relative z-10 fade-in-up">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-white mb-3">Why Choose Medizinar Care</h2>
            <p class="text-white/80">Families trust Medizinar Care for dependable and compassionate caregiving services.</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-10">
            <?php
            $why = [
                ['emoji' => '❤', 'label' => 'Compassionate caregivers'],
                ['emoji' => '🕒', 'label' => 'Reliable service support'],
                ['emoji' => '🔄', 'label' => 'Flexible care solutions'],
                ['emoji' => '🛡', 'label' => 'Responsible &amp; trustworthy staff'],
                ['emoji' => '⭐', 'label' => 'Commitment to client satisfaction'],
                ['emoji' => '🏅', 'label' => 'Professional caregiving assistance'],
            ];
            foreach ($why as $w): ?>
                <div class="flex items-center gap-3 bg-white/10 rounded-xl p-4 border border-white/15 backdrop-blur-sm">
                    <span class="text-xl"><?= $w['emoji'] ?></span>
                    <span class="text-white/90 text-sm font-medium"><?= $w['label'] ?></span>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center">
            <a href="<?= url('/appointment') ?>" class="btn-primary">Request a Service</a>
        </div>
    </div>
</section>