<section class="hero-section min-h-screen flex items-center relative overflow-hidden">
    <div class="hero-pattern absolute inset-0"></div>

    <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full opacity-10"
        style="background:radial-gradient(circle, #4ade80, transparent)"></div>
    <div class="absolute bottom-0 left-0 w-72 h-72 rounded-full opacity-10"
        style="background:radial-gradient(circle, #a5781e, transparent)"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-20 relative z-10 w-full">
        <div class="grid lg:grid-cols-2 gap-12 items-center">

            <div class="text-white">
                <div
                    class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm rounded-full px-4 py-1.5 text-sm font-medium mb-6 border border-white/20">
                    <span class="w-2 h-2 rounded-full bg-green-300 animate-pulse"></span>
                    Trusted Home Healthcare
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight mb-6">
                    Compassionate Home Healthcare
                    <span class="text-accent-light" style="color:#f5c96a"> You Can Trust</span>
                </h1>

                <p class="text-lg text-white/80 mb-8 leading-relaxed max-w-xl">
                    Medizinar Care provides reliable and compassionate home care services including
                    bedside patient care, elderly care, mother &amp; baby care, and domestic support.
                    Our mission is to ensure comfort, safety, and dignity for every individual we serve.
                </p>

                <div class="flex flex-wrap gap-4">
                    <a href="<?= url('/appointment') ?>" class="btn-primary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Make an Appointment
                    </a>
                    <a href="tel:<?= PHONE ?>" class="btn-outline-white">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                        </svg>
                        Call Now
                    </a>
                    <a href="<?= h(whatsapp_link(WHATSAPP_NUM, 'Hi, I need home care assistance.')) ?>" target="_blank"
                        rel="noopener" class="btn-outline-white">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                        </svg>
                        WhatsApp Chat
                    </a>
                </div>
            </div>

            <div class="hidden lg:flex justify-center items-center">
                <div class="w-full max-w-lg relative">
                    <img src="<?= asset('images/medizinar-care-home-hero.webp') ?>"
                        alt="Medizinar Care nurse consulting with elderly patient at home in Kerala"
                        class="w-full h-[420px] object-cover object-right rounded-2xl drop-shadow-2xl" width="800"
                        height="600" loading="eager">
                    <div class="absolute -bottom-2 left-4 bg-white rounded-xl px-4 py-2.5 shadow-lg flex items-center gap-3 border-l-4"
                        style="border-color:#a5781e">
                        <span class="text-2xl font-bold" style="color:#a5781e">100+</span>
                        <span class="text-xs text-gray-500 leading-tight">Happy<br>Families</span>
                    </div>
                    <div class="absolute top-4 -right-2 bg-white rounded-xl px-4 py-2.5 shadow-lg flex items-center gap-3 border-l-4"
                        style="border-color:#176B23">
                        <span class="text-2xl font-bold" style="color:#176B23">24/7</span>
                        <span class="text-xs text-gray-500 leading-tight">Support<br>Available</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 60" xmlns="http://www.w3.org/2000/svg" class="w-full" style="display:block">
            <path fill="white" d="M0,30 C360,60 1080,0 1440,30 L1440,60 L0,60 Z" />
        </svg>
    </div>
</section>


<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">

        <div class="text-center mb-12 fade-in-up">
            <div class="section-badge">What We Offer</div>
            <h2 class="section-title">Our Home Care Services</h2>
            <p class="section-subtitle mx-auto mt-3">
                Compassionate, professional care designed to support patients and families in the comfort of their own
                homes.
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php
            $services = [
                ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#186c21" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/></svg>', 'title' => 'Bedside Patient Care', 'desc' => 'Professional support for patients recovering from illness, surgery, or long-term health conditions at home.', 'href' => url('/services') . '#bedside'],
                ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#186c21" stroke-linecap="round" stroke-linejoin="round"><path d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>', 'title' => 'Elderly Care', 'desc' => 'Dedicated assistance for senior citizens including daily care, mobility support, and compassionate companionship.', 'href' => url('/services') . '#elderly'],
                ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#186c21" stroke-linecap="round" stroke-linejoin="round"><path d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z"/></svg>', 'title' => 'Mother & Baby Care', 'desc' => 'Compassionate care and support for mothers and newborn babies during the important postnatal period.', 'href' => url('/services') . '#mother-baby'],
                ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#186c21" stroke-linecap="round" stroke-linejoin="round"><path d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>', 'title' => 'House Maid Services', 'desc' => 'Reliable domestic assistance including cleaning, cooking, laundry, and general household support.', 'href' => url('/services') . '#housemaid'],
            ];
            foreach ($services as $i => $svc): ?>
                <div class="service-card fade-in-up" style="animation-delay: <?= $i * 0.1 ?>s">
                    <div class="service-icon">
                        <?= $svc['icon'] ?>
                    </div>
                    <h3 class="font-bold text-gray-800 text-lg mb-2"><?= h($svc['title']) ?></h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-4"><?= h($svc['desc']) ?></p>
                    <a href="<?= h($svc['href']) ?>"
                        class="inline-flex items-center gap-1.5 text-sm font-semibold hover:gap-2.5 transition-all"
                        style="color:#a5781e">
                        Learn More
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-10">
            <a href="<?= url('/services') ?>" class="btn-outline-green">View All Services</a>
        </div>
    </div>
</section>


<section class="py-20" style="background:#f8fbf8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="grid lg:grid-cols-2 gap-14 items-center">

            <div class="fade-in-up">
                <div class="section-badge">Why Families Trust Us</div>
                <h2 class="section-title mb-4">Why Choose Medizinar Care</h2>
                <p class="section-subtitle mb-8">
                    We understand that inviting a caregiver into your home requires trust. Our caregivers are carefully
                    selected to provide dependable assistance and respectful support to every family we serve.
                </p>
                <div class="space-y-1">
                    <?php partial('feature-list', [
                        'features' => [
                            'Verified &amp; background-checked caregivers',
                            'Compassionate service approach',
                            'Reliable and responsible staff',
                            'Flexible care options to suit your needs',
                            'Quick caregiver arrangement',
                            'Client-focused and family-friendly support',
                        ]
                    ]) ?>
                </div>
                <a href="<?= url('/about') ?>" class="btn-outline-green mt-8">Learn More About Us</a>
            </div>

            <div class="grid grid-cols-2 gap-4 fade-in-up">
                <?php
                $why_cards = [
                    ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#186c21" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/></svg>', 'title' => 'Verified Caregivers', 'desc' => 'All caregivers are carefully selected and background checked'],
                    ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#186c21" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/></svg>', 'title' => 'Compassionate Support', 'desc' => 'We treat every individual with kindness and respect'],
                    ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#186c21" stroke-linecap="round" stroke-linejoin="round"><path d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>', 'title' => 'Reliable Service', 'desc' => 'Timely caregiver arrangement and dependable daily support'],
                    ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#186c21" stroke-linecap="round" stroke-linejoin="round"><path d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/></svg>', 'title' => 'Client Satisfaction', 'desc' => 'Families across Kerala trust us for quality home care'],
                ];
                foreach ($why_cards as $card): ?>
                    <div class="value-card">
                        <div class="w-12 h-12 rounded-2xl mb-4 flex items-center justify-center"
                            style="background:var(--primary-light)"><?= $card['icon'] ?></div>
                        <h3 class="font-bold mb-2" style="color:var(--text-dark);font-size:0.95rem"><?= h($card['title']) ?>
                        </h3>
                        <p class="text-sm leading-relaxed" style="color:var(--text-muted)"><?= $card['desc'] ?></p>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</section>


<section class="py-20 cta-section text-white relative overflow-hidden">
    <div class="hero-pattern absolute inset-0 opacity-20"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
        <div class="grid lg:grid-cols-2 gap-12 items-center">

            <div class="fade-in-up">
                <div class="section-badge" style="color:white">Trusted Team</div>
                <h2 class="text-3xl sm:text-4xl font-bold mb-5 text-white leading-tight">
                    Trusted &amp; Verified Caregivers
                </h2>
                <p class="text-white/80 leading-relaxed mb-6 text-sm">
                    At Medizinar Care, we understand that inviting someone into your home requires trust.
                    Our caregivers are carefully selected to ensure reliable and compassionate support.
                </p>
                <ul class="space-y-3 mb-8">
                    <?php
                    $trust = ['Background-checked caregivers', 'Experienced patient attendants', 'Compassionate elderly care assistants', 'Responsible and trustworthy staff'];
                    foreach ($trust as $t): ?>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="#4ade80" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-white/90 text-sm"><?= h($t) ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <a href="<?= url('/team') ?>" class="btn-outline-white">Meet Our Team</a>
            </div>

            <div class="grid grid-cols-2 gap-4 fade-in-up">
                <?php
                $stats2 = [
                    ['num' => '100+', 'label' => 'Families Served', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="rgba(255,255,255,0.85)" stroke-linecap="round" stroke-linejoin="round"><path d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/></svg>'],
                    ['num' => '4+', 'label' => 'Core Services', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="rgba(255,255,255,0.85)" stroke-linecap="round" stroke-linejoin="round"><path d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>'],
                    ['num' => '24/7', 'label' => 'Support Available', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="rgba(255,255,255,0.85)" stroke-linecap="round" stroke-linejoin="round"><path d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>'],
                    ['num' => '100%', 'label' => 'Verified Caregivers', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="rgba(255,255,255,0.85)" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z"/></svg>'],
                ];
                foreach ($stats2 as $s): ?>
                    <div class="stat-card">
                        <div class="mb-2"><?= $s['icon'] ?></div>
                        <div class="text-3xl font-extrabold text-white mb-1"><?= $s['num'] ?></div>
                        <div class="text-white/70 text-sm"><?= $s['label'] ?></div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</section>


<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-12 fade-in-up">
            <div class="section-badge">Short-Term & Add-On</div>
            <h2 class="section-title">Quick Support Services</h2>
            <p class="section-subtitle mx-auto mt-3">
                Flexible short-term services ideal for temporary assistance, emergency support, or short visits. Daily
                service charges apply.
            </p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php
            $quick = [
                ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#186c21" stroke-linecap="round" stroke-linejoin="round"><path d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z"/></svg>', 'title' => 'Hospital Visit Companion', 'desc' => 'Caregiver assistance during doctor appointments, hospital procedures, and visits.'],
                ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#186c21" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"/></svg>', 'title' => 'Elderly Day Support', 'desc' => '4–8 hours of short-term daytime care for elderly individuals.'],
                ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#186c21" stroke-linecap="round" stroke-linejoin="round"><path d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z"/></svg>', 'title' => 'Night Care Service', 'desc' => 'Reliable night-time caregiving to ensure patient or elderly safety overnight.'],
                ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#186c21" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5a17.92 17.92 0 0 1-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418"/></svg>', 'title' => 'NRI Parent Care Check', 'desc' => 'Home visits, well-being assessment &amp; status updates for families living abroad.'],
            ];
            foreach ($quick as $i => $q): ?>
                <div class="service-card fade-in-up" style="animation-delay: <?= $i * 0.1 ?>s">
                    <div class="service-icon"><?= $q['icon'] ?></div>
                    <h3 class="font-bold text-gray-800 mb-2"><?= h($q['title']) ?></h3>
                    <p class="text-gray-500 text-sm leading-relaxed"><?= $q['desc'] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-8">
            <a href="<?= url('/services') ?>#quick-support" class="btn-outline-green">View All Services</a>
        </div>
    </div>
</section>


<section class="py-20" style="background:#f8fbf8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-14 fade-in-up">
            <div class="section-badge">Simple Process</div>
            <h2 class="section-title">How Our Service Works</h2>
            <p class="section-subtitle mx-auto mt-3">
                Getting professional home care for your loved ones is simple and straightforward.
            </p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8 relative">
            <div class="hidden lg:block absolute top-6 left-[12.5%] right-[12.5%] h-0.5 z-0"
                style="background:linear-gradient(to right, #176B23, #a5781e, #176B23, #a5781e)"></div>
            <?php
            $steps = [
                ['num' => '1', 'title' => 'Contact Medizinar Care', 'desc' => 'Reach us by phone, WhatsApp, or our website appointment form.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#186c21" stroke-linecap="round" stroke-linejoin="round"><path d="M2.25 6.338c0-1.243.932-2.37 2.162-2.463 1.09-.08 2.186-.15 3.288-.21a.75.75 0 0 1 .727.577l1.054 4.53a.75.75 0 0 1-.44.868l-1.517.659a10.494 10.494 0 0 0 4.66 4.66l.659-1.517a.75.75 0 0 1 .868-.44l4.53 1.054a.75.75 0 0 1 .577.727c-.05 1.102-.13 2.197-.21 3.288-.094 1.23-1.22 2.162-2.463 2.162H17.25C7.845 21 .75 13.905.75 4.5v-.338A2.25 2.25 0 0 1 3 3.912h-.75Z"/></svg>'],
                ['num' => '2', 'title' => 'Share Your Care Needs', 'desc' => 'Tell us about the type of care required and your preferences.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#186c21" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z"/></svg>'],
                ['num' => '3', 'title' => 'Caregiver Arrangement', 'desc' => 'We match and arrange the right caregiver for your specific needs.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#186c21" stroke-linecap="round" stroke-linejoin="round"><path d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"/></svg>'],
                ['num' => '4', 'title' => 'Start Receiving Care', 'desc' => 'Professional, compassionate care begins at your home.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#186c21" stroke-linecap="round" stroke-linejoin="round"><path d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>'],
            ];
            foreach ($steps as $i => $step): ?>
                <div class="step-card relative z-10 fade-in-up" style="animation-delay:<?= $i * 0.12 ?>s">
                    <div class="step-number<?= $i % 2 === 1 ? ' gold' : '' ?>"><?= $step['num'] ?></div>
                    <div class="mb-3"><?= $step['icon'] ?></div>
                    <h3 class="font-bold text-gray-800 mb-2"><?= h($step['title']) ?></h3>
                    <p class="text-gray-500 text-sm leading-relaxed"><?= $step['desc'] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-12 fade-in-up">
            <div class="section-badge">Safety First</div>
            <h2 class="section-title">Your Loved Ones Are Safe With Us</h2>
            <p class="section-subtitle mx-auto mt-3">
                Choosing a caregiver for your family is an important decision. Medizinar Care focuses on safety,
                compassion, and reliability.
            </p>
        </div>
        <div class="grid sm:grid-cols-3 gap-6">
            <?php
            $trust_items = [
                ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#186c21" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/></svg>', 'title' => 'Verified Caregivers', 'desc' => 'Every caregiver passes our thorough background verification and selection process.'],
                ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#186c21" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/></svg>', 'title' => 'Compassionate Support', 'desc' => 'We treat every family with empathy, patience, and the highest personal care standards.'],
                ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#186c21" stroke-linecap="round" stroke-linejoin="round"><path d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/></svg>', 'title' => 'Client Satisfaction', 'desc' => 'We are committed to exceeding family expectations through reliable and quality service.'],
            ];
            foreach ($trust_items as $t): ?>
                <div class="value-card text-center fade-in-up">
                    <div class="mb-4"><?= $t['icon'] ?></div>
                    <h3 class="font-bold text-gray-800 text-lg mb-2"><?= h($t['title']) ?></h3>
                    <p class="text-gray-500 text-sm leading-relaxed"><?= $t['desc'] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<section class="py-20" style="background:#f8fbf8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-12 fade-in-up">
            <div class="section-badge">What Families Say</div>
            <h2 class="section-title">Client Testimonials</h2>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php
            $testimonials = [
                ['stars' => 5, 'text' => '"Medizinar Care arranged a caring and responsible caregiver for our elderly mother. The service was professional and reliable. We are truly grateful."', 'name' => 'A Happy Family', 'location' => 'Kottarakkara, Kerala'],
                ['stars' => 5, 'text' => '"The mother and baby care assistant was wonderful. She was very experienced, caring, and our family felt completely at ease. Highly recommended."', 'name' => 'New Mother', 'location' => 'Kollam, Kerala'],
                ['stars' => 5, 'text' => '"We used the NRI Parent Care service while living abroad. The team provided excellent home visits and kept us informed about our parents\' well-being."', 'name' => 'NRI Family', 'location' => 'Abroad'],
            ];
            foreach ($testimonials as $t): ?>
                <div class="testimonial-card fade-in-up">
                    <div class="flex gap-1 mb-3 mt-6 pl-1">
                        <?php for ($i = 0; $i < $t['stars']; $i++): ?>
                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        <?php endfor; ?>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4 italic"><?= h($t['text']) ?></p>
                    <div class="flex items-center gap-3 border-t border-gray-100 pt-4">
                        <div class="w-9 h-9 rounded-full flex items-center justify-center text-white text-xs font-bold shrink-0"
                            style="background:#a5781e">
                            <?= strtoupper(substr($t['name'], 0, 1)) ?>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-800 text-sm"><?= h($t['name']) ?></div>
                            <div class="text-gray-400 text-xs"><?= h($t['location']) ?></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="rounded-2xl overflow-hidden fade-in-up"
            style="background:#0c2912;position:relative;min-height:220px;">
            <div class="hero-pattern absolute inset-0" style="opacity:0.08"></div>
            <div class="absolute inset-0"
                style="background:radial-gradient(ellipse 55% 100% at 30% 50%, #1a5c26 0%, transparent 80%)"></div>
            <div class="relative z-10 p-8 sm:p-12 flex flex-col sm:flex-row items-center gap-10">

                <div class="flex-1 text-center sm:text-left">
                    <div class="section-badge mb-4" style="color:rgba(255,255,255,0.55)">Coverage</div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white mb-3 leading-tight">Areas We Serve</h2>
                    <p class="text-white/65 text-sm leading-relaxed max-w-md">
                        We currently provide home care services across Kerala, India, with our primary base in
                        Kottarakkara, Kollam District.
                    </p>
                </div>

                <div class="flex-shrink-0 flex items-center justify-center"
                    style="position:relative;width:260px;height:180px;">
                    <img src="<?= asset('images/medizinar-care-caregiver-elderly.webp') ?>"
                        alt="Medizinar Care caregiver assisting elderly patient at home"
                        style="position:absolute;right:0;top:0;width:180px;height:160px;object-fit:cover;border-radius:14px;box-shadow:0 8px 32px rgba(0,0,0,0.45);">
                    <img src="<?= asset('images/medizinar-care-doctor-stethoscope.webp') ?>"
                        alt="Medizinar Care doctor with stethoscope providing home healthcare"
                        style="position:absolute;left:0;bottom:0;width:130px;height:120px;object-fit:cover;border-radius:12px;box-shadow:0 8px 32px rgba(0,0,0,0.5);border:3px solid #0c2912;">
                </div>

            </div>
        </div>
    </div>
</section>


<?php partial('cta', [
    'ctaPreTitle' => 'Get Started Today',
    'ctaTitle' => 'Need Professional Home Care Support?',
    'ctaDescription' => 'Our team is ready to assist you with compassionate caregiving services. Contact us today to arrange the right care for your loved ones.',
]) ?>