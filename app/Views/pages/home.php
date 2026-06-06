<section class="hero-section min-h-screen flex items-center relative overflow-hidden">
    <div class="hero-pattern absolute inset-0"></div>

    <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full opacity-10"
        style="background:radial-gradient(circle, #4ade80, transparent)"></div>
    <div class="absolute bottom-0 left-0 w-72 h-72 rounded-full opacity-10"
        style="background:radial-gradient(circle, #a5781e, transparent)"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-20 relative z-10 w-full">
        <div class="grid lg:grid-cols-2 gap-12 items-center">

            <div class="text-white">
                <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm rounded-full px-4 py-1.5 text-sm font-medium mb-6 border border-white/20">
                    <span class="w-2 h-2 rounded-full bg-green-300 animate-pulse"></span>
                    Trusted Home Healthcare — Kerala
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
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                        </svg>
                        Call Now
                    </a>
                    <a href="<?= h(whatsapp_link(WHATSAPP_NUM, 'Hi, I need home care assistance.')) ?>"
                        target="_blank" rel="noopener" class="btn-outline-white">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                        </svg>
                        WhatsApp Chat
                    </a>
                </div>
            </div>

            <div class="hidden lg:flex justify-center items-center">
                <div class="w-full max-w-lg relative">
                    <img src="<?= asset('images/hero-home.svg') ?>" alt="Compassionate home healthcare illustration" class="w-full h-auto drop-shadow-2xl" width="600" height="500" loading="eager">
                    <div class="absolute -bottom-2 left-4 bg-white rounded-xl px-4 py-2.5 shadow-lg flex items-center gap-3 border-l-4" style="border-color:#a5781e">
                        <span class="text-2xl font-bold" style="color:#a5781e">100+</span>
                        <span class="text-xs text-gray-500 leading-tight">Happy<br>Families</span>
                    </div>
                    <div class="absolute top-4 -right-2 bg-white rounded-xl px-4 py-2.5 shadow-lg flex items-center gap-3 border-l-4" style="border-color:#176B23">
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
                Compassionate, professional care designed to support patients and families in the comfort of their own homes.
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php
            $services = [
                ['emoji' => '🛏', 'title' => 'Bedside Patient Care', 'desc' => 'Professional support for patients recovering from illness, surgery, or long-term health conditions at home.', 'href' => url('/services') . '#bedside'],
                ['emoji' => '👴', 'title' => 'Elderly Care', 'desc' => 'Dedicated assistance for senior citizens including daily care, mobility support, and compassionate companionship.', 'href' => url('/services') . '#elderly'],
                ['emoji' => '👶', 'title' => 'Mother & Baby Care', 'desc' => 'Compassionate care and support for mothers and newborn babies during the important postnatal period.', 'href' => url('/services') . '#mother-baby'],
                ['emoji' => '🏠', 'title' => 'House Maid Services', 'desc' => 'Reliable domestic assistance including cleaning, cooking, laundry, and general household support.', 'href' => url('/services') . '#housemaid'],
            ];
            foreach ($services as $i => $svc): ?>
                <div class="service-card fade-in-up" style="animation-delay: <?= $i * 0.1 ?>s">
                    <div class="service-icon">
                        <span class="text-2xl" role="img" aria-label="<?= h($svc['title']) ?>"><?= $svc['emoji'] ?></span>
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
                    <?php partial('feature-list', ['features' => [
                        'Verified &amp; background-checked caregivers',
                        'Compassionate service approach',
                        'Reliable and responsible staff',
                        'Flexible care options to suit your needs',
                        'Quick caregiver arrangement',
                        'Client-focused and family-friendly support',
                    ]]) ?>
                </div>
                <a href="<?= url('/about') ?>" class="btn-outline-green mt-8">Learn More About Us</a>
            </div>

            <div class="grid grid-cols-2 gap-4 fade-in-up">
                <?php
                $why_cards = [
                    ['emoji' => '🛡', 'title' => 'Verified Caregivers', 'desc' => 'All caregivers are carefully selected and background checked'],
                    ['emoji' => '❤', 'title' => 'Compassionate Support', 'desc' => 'We treat every individual with kindness and respect'],
                    ['emoji' => '🕒', 'title' => 'Reliable Service', 'desc' => 'Timely caregiver arrangement and dependable daily support'],
                    ['emoji' => '😊', 'title' => 'Client Satisfaction', 'desc' => 'Families across Kerala trust us for quality home care'],
                ];
                foreach ($why_cards as $card): ?>
                    <div class="value-card">
                        <div class="text-3xl mb-3"><?= $card['emoji'] ?></div>
                        <h3 class="font-bold text-gray-800 mb-1.5"><?= h($card['title']) ?></h3>
                        <p class="text-gray-500 text-sm leading-relaxed"><?= $card['desc'] ?></p>
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
                <div class="section-badge" style="background:rgba(255,255,255,0.15);color:white">Trusted Team</div>
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
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
                    ['num' => '100+',  'label' => 'Families Served',    'emoji' => '👨‍👩‍👧'],
                    ['num' => '4+',    'label' => 'Core Services',       'emoji' => '🏥'],
                    ['num' => '24/7',  'label' => 'Support Available',   'emoji' => '🕒'],
                    ['num' => '100%',  'label' => 'Verified Caregivers', 'emoji' => '✅'],
                ];
                foreach ($stats2 as $s): ?>
                    <div class="stat-card">
                        <div class="text-3xl mb-2"><?= $s['emoji'] ?></div>
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
                Flexible short-term services ideal for temporary assistance, emergency support, or short visits. Daily service charges apply.
            </p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php
            $quick = [
                ['emoji' => '🚶', 'title' => 'Hospital Visit Companion', 'desc' => 'Caregiver assistance during doctor appointments, hospital procedures, and visits.'],
                ['emoji' => '⏰', 'title' => 'Elderly Day Support', 'desc' => '4–8 hours of short-term daytime care for elderly individuals.'],
                ['emoji' => '🌙', 'title' => 'Night Care Service', 'desc' => 'Reliable night-time caregiving to ensure patient or elderly safety overnight.'],
                ['emoji' => '🌍', 'title' => 'NRI Parent Care Check', 'desc' => 'Home visits, well-being assessment &amp; status updates for families living abroad.'],
            ];
            foreach ($quick as $i => $q): ?>
                <div class="service-card fade-in-up" style="animation-delay: <?= $i * 0.1 ?>s">
                    <div class="service-icon"><span class="text-2xl"><?= $q['emoji'] ?></span></div>
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
                ['num' => '1', 'title' => 'Contact Medizinar Care', 'desc' => 'Reach us by phone, WhatsApp, or our website appointment form.', 'emoji' => '📞'],
                ['num' => '2', 'title' => 'Share Your Care Needs', 'desc' => 'Tell us about the type of care required and your preferences.', 'emoji' => '📋'],
                ['num' => '3', 'title' => 'Caregiver Arrangement', 'desc' => 'We match and arrange the right caregiver for your specific needs.', 'emoji' => '🤝'],
                ['num' => '4', 'title' => 'Start Receiving Care', 'desc' => 'Professional, compassionate care begins at your home.', 'emoji' => '🏠'],
            ];
            foreach ($steps as $i => $step): ?>
                <div class="step-card relative z-10 fade-in-up" style="animation-delay:<?= $i * 0.12 ?>s">
                    <div class="step-number<?= $i % 2 === 1 ? ' gold' : '' ?>"><?= $step['num'] ?></div>
                    <div class="text-3xl mb-3"><?= $step['emoji'] ?></div>
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
                Choosing a caregiver for your family is an important decision. Medizinar Care focuses on safety, compassion, and reliability.
            </p>
        </div>
        <div class="grid sm:grid-cols-3 gap-6">
            <?php
            $trust_items = [
                ['emoji' => '🛡', 'title' => 'Verified Caregivers',      'desc' => 'Every caregiver passes our thorough background verification and selection process.'],
                ['emoji' => '❤', 'title' => 'Compassionate Support',    'desc' => 'We treat every family with empathy, patience, and the highest personal care standards.'],
                ['emoji' => '⭐', 'title' => 'Client Satisfaction',      'desc' => 'We are committed to exceeding family expectations through reliable and quality service.'],
            ];
            foreach ($trust_items as $t): ?>
                <div class="value-card text-center fade-in-up">
                    <div class="text-4xl mb-4"><?= $t['emoji'] ?></div>
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
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        <?php endfor; ?>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4 italic"><?= h($t['text']) ?></p>
                    <div class="flex items-center gap-3 border-t border-gray-100 pt-4">
                        <div class="w-9 h-9 rounded-full flex items-center justify-center text-white text-xs font-bold shrink-0" style="background:#a5781e">
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
        <div class="rounded-2xl p-8 sm:p-12 text-center fade-in-up" style="background:#f8eed8">
            <div class="section-badge">Coverage</div>
            <h2 class="section-title mb-3">Areas We Serve</h2>
            <p class="section-subtitle mx-auto mb-6">
                We currently provide home care services across Kerala, India, with our primary base in
                Kottarakkara, Kollam District.
            </p>
            <div class="flex flex-wrap justify-center gap-3">
                <?php
                $areas = ['Kottarakkara', 'Kollam District', 'Kerala', 'India'];
                foreach ($areas as $a): ?>
                    <span class="inline-flex items-center gap-1.5 bg-white text-primary-700 text-sm font-medium px-4 py-2 rounded-full border border-primary-200 shadow-sm" style="color:#176B23;border-color:#a5d4a8">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20" style="color:#176B23">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                        <?= h($a) ?>
                    </span>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>


<?php partial('cta', [
    'ctaPreTitle'   => 'Get Started Today',
    'ctaTitle'       => 'Need Professional Home Care Support?',
    'ctaDescription' => 'Our team is ready to assist you with compassionate caregiving services. Contact us today to arrange the right care for your loved ones.',
]) ?>