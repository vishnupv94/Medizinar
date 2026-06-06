<?php partial('inner-hero', [
    'heroTitle'       => 'Our Team',
    'heroDescription' => 'Dedicated people behind Medizinar Care — bringing experience, compassion, and commitment to every family we serve.',
    'breadcrumb'      => 'Our Team',
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
        <div class="max-w-sm mx-auto mt-8">
            <img src="<?= asset('images/hero-team.svg') ?>" alt="Medizinar Care team network" class="w-full h-auto" width="600" height="400" loading="lazy">
        </div>
    </div>
</section>


<section class="py-12 pb-20" style="background:#f8fbf8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-12 fade-in-up">
            <div class="section-badge">Leadership</div>
            <h2 class="section-title">Leadership &amp; Core Team</h2>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 max-w-4xl mx-auto">
            <?php
            $team = [
                [
                    'name'    => 'Jayhar M.J',
                    'role'    => 'Founder',
                    'initial' => 'J',
                    'color'   => '#176B23',
                    'bio'     => 'Jayhar M.J is the founder of Medizinar Care and the driving force behind the mission to provide dependable home healthcare services. He focuses on building a trusted service that ensures families receive compassionate and responsible caregiving support.',
                ],
                [
                    'name'    => 'Shanimol S.M',
                    'role'    => 'Accountant',
                    'initial' => 'S',
                    'color'   => '#2563eb',
                    'bio'     => 'Shanimol oversees the financial operations of Medizinar Care, ensuring smooth administrative processes and transparent financial management. Her role helps maintain the organisation\'s efficiency and stability.',
                ],
                [
                    'name'    => 'Jaya M',
                    'role'    => 'Client Relations',
                    'initial' => 'J',
                    'color'   => '#7e22ce',
                    'bio'     => 'Jaya manages communication with clients and coordinates caregiving services. She plays an important role in understanding family needs and arranging the right support services for every client.',
                ],
                [
                    'name'    => 'Soumya M',
                    'role'    => 'Digital Marketing',
                    'initial' => 'S',
                    'color'   => '#b45309',
                    'bio'     => 'Soumya handles the digital presence and communication of Medizinar Care, ensuring that families looking for home healthcare support can easily learn about our services and connect with our team.',
                ],
            ];
            foreach ($team as $i => $member): ?>
                <div class="team-card fade-in-up" style="animation-delay:<?= $i * 0.1 ?>s">
                    <div class="pt-8 px-6 pb-6">
                        <div class="team-avatar mb-4" style="background:linear-gradient(135deg, <?= $member['color'] ?>, <?= $member['color'] ?>cc)">
                            <?= $member['initial'] ?>
                        </div>
                        <h3 class="font-bold text-gray-800 text-lg mb-1"><?= h($member['name']) ?></h3>
                        <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full mb-4 text-white"
                            style="background:<?= $member['color'] ?>">
                            <?= h($member['role']) ?>
                        </span>
                        <p class="text-gray-500 text-sm leading-relaxed"><?= h($member['bio']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
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
                    'emoji'   => '🩺',
                    'title'   => 'Senior Patient Care Assistant',
                    'color'   => '#176B23',
                    'bg'      => '#e0f4e2',
                    'desc'    => 'Experienced in bedside patient care and daily patient support. Provides safe and compassionate care for recovering patients.',
                ],
                [
                    'emoji'   => '👴',
                    'title'   => 'Elderly Care Assistant',
                    'color'   => '#2563eb',
                    'bg'      => '#eff6ff',
                    'desc'    => 'Provides mobility support, companionship, and daily living assistance for senior citizens at home.',
                ],
                [
                    'emoji'   => '👶',
                    'title'   => 'Mother & Baby Care Assistant',
                    'color'   => '#7e22ce',
                    'bg'      => '#fdf4ff',
                    'desc'    => 'Experienced in newborn care and postnatal support, ensuring safe and comfortable care for both mother and baby.',
                ],
                [
                    'emoji'   => '🏠',
                    'title'   => 'Domestic Support Assistant',
                    'color'   => '#b45309',
                    'bg'      => '#fffbeb',
                    'desc'    => 'Provides reliable household support, cooking, cleaning, and domestic assistance for families.',
                ],
            ];
            foreach ($caregivers as $i => $c): ?>
                <div class="service-card text-center fade-in-up" style="animation-delay:<?= $i * 0.1 ?>s">
                    <div class="w-20 h-20 rounded-full mx-auto mb-4 flex items-center justify-center text-3xl"
                        style="background:<?= $c['bg'] ?>">
                        <?= $c['emoji'] ?>
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
                        ['emoji' => '🤝', 'title' => 'Compassionate Care',    'desc' => 'Caregivers provide support with kindness, patience, and respect for every individual.'],
                        ['emoji' => '🛡', 'title' => 'Trusted Caregivers',    'desc' => 'Carefully selected caregivers who demonstrate responsibility and dedication.'],
                        ['emoji' => '⏱', 'title' => 'Reliable Service',      'desc' => 'Timely caregiver arrangement and dependable support for families.'],
                        ['emoji' => '❤', 'title' => 'Client-Centered',       'desc' => 'Every family has unique needs and we tailor our care to match those needs.'],
                    ];
                    foreach ($commitments as $com): ?>
                        <div class="flex gap-4 items-start">
                            <div class="w-11 h-11 rounded-xl flex items-center justify-center text-xl shrink-0" style="background:#e0f4e2">
                                <?= $com['emoji'] ?>
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
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
    'ctaPreTitle'   => 'Connect with us',
    'ctaTitle'       => 'Connect With Our Team',
    'ctaDescription' => 'If you would like to learn more about our caregiving services, our team is ready to assist you.',
]) ?>