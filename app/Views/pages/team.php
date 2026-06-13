<?php partial('inner-hero', [
    'heroTitle' => 'Our Team',
    'heroDescription' => 'Dedicated people behind Medizinar Care — bringing experience, compassion, and commitment to every family we serve.',
    'breadcrumb' => 'Our Team',
]) ?>


<section class="py-16 bg-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 text-center fade-in-up">
        <div class="section-badge">Our People</div>
        <h2 class="section-title mb-5">Dedicated People Behind Medizinar Care</h2>
        <p class="text-gray-600 leading-relaxed mb-3">
            At Medizinar Care, our team is committed to delivering compassionate, reliable, and professional
            home healthcare services.
        </p>
        <p class="text-gray-600 leading-relaxed">
            We believe that quality care begins with a dedicated and responsible team working together to support
            families and their loved ones. Our team members bring experience, compassion, and commitment to
            ensure every client receives the highest level of care and support.
        </p>
        <div class="max-w-2xl mx-auto mt-8">
            <img src="<?= asset('images/medizinar-care-team-group.webp') ?>"
                alt="Medizinar Care home healthcare team Kerala" class="w-full h-72 object-cover rounded-2xl"
                style="object-position:center 30%" width="800" height="288" loading="lazy">
        </div>
    </div>
</section>


<section class="py-12 pb-20" style="background:#f8fbf8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-12 fade-in-up">
            <div class="section-badge">Leadership</div>
            <h2 class="section-title">Leadership &amp; Core Team</h2>
            <p class="section-subtitle mx-auto mt-4">
                Meet the dedicated professionals behind Medizinar Care LLP, committed to delivering compassionate,
                reliable, and professional home healthcare services across India.
            </p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <?php
            $team = [
                [
                    'name' => 'Jayhar M.J.',
                    'role' => 'Founder & Managing Partner',
                    'initial' => 'J',
                    'color' => '#176B23',
                    'photo' => asset('images/team/medizinar-jayahar-caregiver.webp'),
                    'bio' => 'Visionary leader driving Medizinar Care LLP\'s mission to provide trusted, compassionate, and professional home nursing services across India. Focused on operational excellence, service quality, and client satisfaction.',
                    'obj_pos' => 'left',
                ],
                [
                    'name' => 'Shanimol S.M.',
                    'role' => 'Accounts & Finance Manager',
                    'initial' => 'S',
                    'color' => '#ab7e22',
                    'photo' => asset('images/team/medizinar-shani-caregiver.webp'),
                    'bio' => 'Responsible for financial planning, accounting operations, compliance management, budgeting, and maintaining the organization\'s financial integrity and transparency.',
                ],
                [
                    'name' => 'Jaya M.',
                    'role' => 'Client Relationship Manager',
                    'initial' => 'J',
                    'color' => '#176B23',
                    'photo' => asset('images/team/medizinar-jaya-caregiver.webp'),
                    'bio' => 'Dedicated to ensuring exceptional client satisfaction through seamless communication, personalized support, service coordination, and long-term relationship management.',
                    'obj_pos' => 'bottom',
                ],
                [
                    'name' => 'Soumya M.',
                    'role' => 'Brand & Digital Communications Manager',
                    'initial' => 'S',
                    'color' => '#ab7e22',
                    'photo' => asset('images/team/medizinar-soumya-caregiver.webp'),
                    'bio' => 'Responsible for strengthening Medizinar Care LLP\'s brand presence through strategic digital communication, social media management, online engagement, and marketing initiatives. Focused on building trust, increasing visibility, and connecting families with quality home healthcare services.',
                ],
            ];
            foreach ($team as $i => $member): ?>
                <button type="button"
                    class="team-card group relative text-center w-full fade-in-up cursor-pointer focus:outline-none"
                    style="animation-delay:<?= $i * 0.1 ?>s" data-name="<?= h($member['name']) ?>"
                    data-role="<?= h($member['role']) ?>" data-initial="<?= h($member['initial']) ?>"
                    data-color="<?= h($member['color']) ?>" data-photo="<?= h($member['photo']) ?>"
                    data-bio="<?= h($member['bio']) ?>" onclick="openTeamModal(this)">
                    <div class="pt-8 px-5 pb-6">
                        <!-- full-bleed photo -->
                        <img src="<?= h($member['photo']) ?>" alt="<?= h($member['name']) ?>" class="team-card-photo"
                            style="object-position:<?= h($member['obj_pos'] ?? 'center top') ?>" loading="lazy">

                        <!-- default: bottom nameplate -->
                        <div class="absolute bottom-0 left-0 right-0 px-4 py-4 transition-opacity duration-300 group-hover:opacity-0"
                            style="background:linear-gradient(to top, rgba(0,0,0,0.68) 0%, transparent 100%)">
                            <h3 class="font-bold text-white text-sm leading-snug mb-1"><?= h($member['name']) ?></h3>
                            <span class="inline-block text-xs font-semibold px-2.5 py-0.5 rounded-full text-white"
                                style="background:<?= $member['color'] ?>88">
                                <?= h($member['role']) ?>
                            </span>
                        </div>

                        <!-- hover: brand gradient mask + centered text -->
                        <div class="absolute inset-0 flex flex-col items-center justify-center px-5
                                    opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                            style="background:linear-gradient(135deg,<?= $member['color'] ?>e0 0%,<?= $member['color'] ?>80 100%)">
                            <h3 class="font-extrabold text-white text-lg leading-tight mb-2 tracking-wide uppercase">
                                <?= h($member['name']) ?>
                            </h3>
                            <p class="text-white/90 text-xs font-semibold tracking-widest uppercase mb-5">
                                <?= h($member['role']) ?>
                            </p>
                            <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-full"
                                style="background:rgba(255,255,255,0.22); backdrop-filter:blur(6px); color:#fff; border:1px solid rgba(255,255,255,0.35)">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                View Details
                            </span>
                        </div>
                    </div>
                </button>
            <?php endforeach; ?>
        </div>

        <!-- Team member modal -->
        <div id="team-modal" role="dialog" aria-modal="true" aria-labelledby="modal-name"
            class="fixed inset-0 z-50 flex items-center justify-center px-4 hidden">
            <!-- backdrop -->
            <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeTeamModal()"></div>
            <!-- panel -->
            <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md sm:max-w-lg p-8 sm:p-10 text-center z-10">
                <button onclick="closeTeamModal()"
                    class="absolute top-4 right-4 w-8 h-8 flex items-center justify-center rounded-full text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition"
                    aria-label="Close">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <img id="modal-photo" src="" alt="" class="team-photo mb-5 mx-auto"
                    style="width:140px;height:140px;border-radius:20px">
                <h3 id="modal-name" class="text-2xl font-bold text-gray-800 mb-2"></h3>
                <span id="modal-role"
                    class="inline-block text-sm font-semibold px-4 py-1.5 rounded-full text-white mb-5"></span>
                <p id="modal-bio" class="text-gray-500 text-base leading-relaxed"></p>
            </div>
        </div>
    </div>
</section>


<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-12 fade-in-up">
            <div class="section-badge">Care Team</div>
            <h2 class="section-title">Meet Our Professional Caregivers</h2>
            <p class="section-subtitle mx-auto mt-3">
                Our caregiving team consists of compassionate and dedicated professionals who provide reliable
                home care services for patients, elderly individuals, and families. Every caregiver is selected
                based on experience, responsibility, and commitment to compassionate care.
            </p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php
            $caregivers = [
                [
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-9 h-9" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="#176B23"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z"/></svg>',
                    'bg' => '#e0f4e2',
                    'title' => 'Senior Patient Care Assistant',
                    'color' => '#176B23',
                    'desc' => 'Experienced in bedside patient care and daily patient support. Provides safe and compassionate care for recovering patients.',
                ],
                [
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-9 h-9" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="#ab7e22"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>',
                    'bg' => '#fef9ee',
                    'title' => 'Elderly Care Assistant',
                    'color' => '#ab7e22',
                    'desc' => 'Provides mobility support, companionship, and daily living assistance for senior citizens at home.',
                ],
                [
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-9 h-9" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="#176B23"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/></svg>',
                    'bg' => '#e8f5ea',
                    'title' => 'Mother &amp; Baby Care Assistant',
                    'color' => '#176B23',
                    'desc' => 'Experienced in newborn care and postnatal support, ensuring safe and comfortable care for both mother and baby.',
                ],
                [
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-9 h-9" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="#ab7e22"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>',
                    'bg' => '#fef4d8',
                    'title' => 'Domestic Support Assistant',
                    'color' => '#ab7e22',
                    'desc' => 'Provides reliable household support, cooking, cleaning, and domestic assistance for families.',
                ],
            ];
            foreach ($caregivers as $i => $c): ?>
                <div class="service-card text-center fade-in-up" style="animation-delay:<?= $i * 0.1 ?>s">
                    <div class="w-20 h-20 rounded-full mx-auto mb-4 flex items-center justify-center"
                        style="background:<?= $c['bg'] ?>">
                        <?= $c['icon'] ?>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-3"><?= h($c['title']) ?></h3>
                    <p class="text-gray-500 text-sm leading-relaxed"><?= h($c['desc']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<section class="py-20" style="background:#f8fbf8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="grid lg:grid-cols-2 gap-14 items-center">
            <div class="fade-in-up">
                <div class="section-badge">Our Promise</div>
                <h2 class="section-title mb-5">Our Commitment to Families</h2>
                <p class="text-gray-600 leading-relaxed mb-5">
                    At Medizinar Care, we understand that inviting a caregiver into your home requires trust and
                    confidence. Our team is dedicated to ensuring that every family receives compassionate,
                    respectful, and reliable caregiving support.
                </p>
                <p class="text-gray-600 leading-relaxed mb-8">
                    We strive to create a care environment where patients and elderly individuals feel safe,
                    comfortable, and valued.
                </p>
                <div class="space-y-4">
                    <?php
                    $commitments = [
                        ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#176B23"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/></svg>', 'title' => 'Compassionate Care', 'desc' => 'Caregivers provide support with kindness, patience, and respect for every individual.'],
                        ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#176B23"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/></svg>', 'title' => 'Trusted Caregivers', 'desc' => 'Carefully selected caregivers who demonstrate responsibility and dedication.'],
                        ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#176B23"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>', 'title' => 'Reliable Service', 'desc' => 'Timely caregiver arrangement and dependable support for families.'],
                        ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="#176B23"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/></svg>', 'title' => 'Client-Centered', 'desc' => 'Every family has unique needs and we tailor our care to match those needs.'],
                    ];
                    foreach ($commitments as $com): ?>
                        <div class="flex gap-4 items-start">
                            <div class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0"
                                style="background:#e0f4e2">
                                <?= $com['icon'] ?>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1"><?= h($com['title']) ?></h4>
                                <p class="text-gray-500 text-sm"><?= $com['desc'] ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="fade-in-up">
                <div class="rounded-2xl p-10 relative overflow-hidden text-white h-full"
                    style="background:linear-gradient(135deg,#0f5219,#176B23,#1e8a2d)">
                    <div class="hero-pattern absolute inset-0 opacity-20"></div>
                    <div class="relative z-10">
                        <h3 class="text-2xl font-bold mb-4">Our Promise</h3>
                        <p class="text-white/85 leading-relaxed mb-6 text-sm">
                            Our goal is to support families by delivering professional home care services that improve
                            comfort, dignity, and quality of life for patients and elderly individuals.
                        </p>
                        <p class="text-white/85 leading-relaxed text-sm mb-8">
                            At Medizinar Care, caregiving is not just a service — it is a commitment to supporting
                            families when they need it most.
                        </p>
                        <div class="space-y-3">
                            <?php
                            $promises = ['Background-checked caregivers', 'Experienced and dedicated staff', 'Compassionate and respectful approach', 'Reliable and consistent support'];
                            foreach ($promises as $p): ?>
                                <div class="flex items-center gap-2.5">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="#4ade80" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-white/85 text-sm"><?= h($p) ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php partial('cta', [
    'ctaPreTitle' => 'Connect with us',
    'ctaTitle' => 'Connect With Our Team',
    'ctaDescription' => 'If you would like to learn more about our caregiving services, our team is ready to assist you.',
]) ?>