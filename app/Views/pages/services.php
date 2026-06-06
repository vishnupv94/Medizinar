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
                    'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#186c21" stroke-linecap="round" stroke-linejoin="round"><path d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z"/></svg>',
                    'title' => 'Hospital Visit Companion',
                    'items' => ['Assistance during doctor appointments', 'Support during hospital procedures', 'Patient assistance during hospital visits'],
                ],
                [
                    'id'    => 'day-support',
                    'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#186c21" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"/></svg>',
                    'title' => 'Elderly Day Support',
                    'items' => ['4–8 hours daytime support', 'Daily living assistance', 'Ideal for temporary daytime care'],
                ],
                [
                    'id'    => 'night-care',
                    'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#186c21" stroke-linecap="round" stroke-linejoin="round"><path d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z"/></svg>',
                    'title' => 'Night Care Service',
                    'items' => ['Night-time patient monitoring', 'Elderly safety assurance', 'Overnight caregiving support'],
                ],
                [
                    'id'    => 'nri',
                    'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#186c21" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5a17.92 17.92 0 0 1-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418"/></svg>',
                    'title' => 'NRI Parent Care',
                    'items' => ['Home visit check', 'Parent well-being assessment', 'Status update to family members'],
                ],
            ];
            foreach ($quick as $i => $q): ?>
                <div id="<?= $q['id'] ?>" class="service-card fade-in-up scroll-mt-24" style="animation-delay:<?= $i * 0.1 ?>s">
                    <div class="service-icon"><?= $q['icon'] ?></div>
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
                ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#ab7e22" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/></svg>', 'label' => 'Compassionate caregivers'],
                ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#ab7e22" stroke-linecap="round" stroke-linejoin="round"><path d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>', 'label' => 'Reliable service support'],
                ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#ab7e22" stroke-linecap="round" stroke-linejoin="round"><path d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/></svg>', 'label' => 'Flexible care solutions'],
                ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#ab7e22" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/></svg>', 'label' => 'Responsible &amp; trustworthy staff'],
                ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#ab7e22" stroke-linecap="round" stroke-linejoin="round"><path d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/></svg>', 'label' => 'Commitment to client satisfaction'],
                ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#ab7e22" stroke-linecap="round" stroke-linejoin="round"><path d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 3.741-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"/></svg>', 'label' => 'Professional caregiving assistance'],
            ];
            foreach ($why as $w): ?>
                <div class="flex items-center gap-3 bg-white/10 rounded-xl p-4 border border-white/15 backdrop-blur-sm">
                    <?= $w['icon'] ?>
                    <span class="text-white/90 text-sm font-medium"><?= $w['label'] ?></span>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center">
            <a href="<?= url('/appointment') ?>" class="btn-primary">Request a Service</a>
        </div>
    </div>
</section>