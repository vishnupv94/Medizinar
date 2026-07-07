<?php partial('inner-hero', [
    'heroTitle'       => 'Make an Appointment',
    'heroDescription' => "Tell us about your care needs and we'll connect you with a verified, compassionate caregiver — quickly and reliably.",
    'breadcrumb'      => 'Make an Appointment',
]) ?>


<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">

        <div class="grid lg:grid-cols-3 gap-10">

            <div class="lg:col-span-2 fade-in-up">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 sm:p-10">
                    <div class="mb-8">
                        <div class="section-badge mb-2">Book Now</div>
                        <h2 class="text-2xl font-bold text-gray-800">Schedule Your Care Service</h2>
                        <p class="text-gray-500 mt-2 text-sm leading-relaxed">
                            Fill in the details below. Our team will confirm your appointment and reach you at the earliest.
                        </p>
                    </div>

                    <form action="<?= url('/appointment') ?>" method="POST" novalidate>
                        <?= csrf_field() ?>

                        <fieldset class="mb-8">
                            <legend class="text-sm font-semibold text-gray-500 uppercase tracking-widest mb-4 pb-2 border-b border-gray-100 w-full">Personal Details</legend>
                            <div class="grid sm:grid-cols-2 gap-5">

                                <div class="sm:col-span-2">
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">
                                        Full Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="name" name="name" required
                                        class="form-input <?= !empty($errors['name']) ? 'is-invalid' : '' ?>"
                                        placeholder="Enter your full name"
                                        value="<?= h($old['name'] ?? '') ?>">
                                    <?php if (!empty($errors['name'])): ?>
                                        <p class="form-error"><?= h($errors['name']) ?></p>
                                    <?php endif; ?>
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1.5">
                                        Phone Number <span class="text-red-500">*</span>
                                    </label>
                                    <input type="tel" id="phone" name="phone" required
                                        class="form-input <?= !empty($errors['phone']) ? 'is-invalid' : '' ?>"
                                        placeholder="+91 XXXXX XXXXX"
                                        value="<?= h($old['phone'] ?? '') ?>">
                                    <?php if (!empty($errors['phone'])): ?>
                                        <p class="form-error"><?= h($errors['phone']) ?></p>
                                    <?php endif; ?>
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">
                                        Email Address <span class="text-gray-400 font-normal">(optional)</span>
                                    </label>
                                    <input type="email" id="email" name="email"
                                        class="form-input <?= !empty($errors['email']) ? 'is-invalid' : '' ?>"
                                        placeholder="your@email.com"
                                        value="<?= h($old['email'] ?? '') ?>">
                                    <?php if (!empty($errors['email'])): ?>
                                        <p class="form-error"><?= h($errors['email']) ?></p>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </fieldset>

                        <fieldset class="mb-8">
                            <legend class="text-sm font-semibold text-gray-500 uppercase tracking-widest mb-4 pb-2 border-b border-gray-100 w-full">Service Details</legend>
                            <div class="grid sm:grid-cols-2 gap-5">

                                <?php
                                $services = [
                                    ''                       => '— Select a service —',
                                    'bedside'                => 'Bedside Patient Care',
                                    'elderly'                => 'Elderly Care',
                                    'mother-baby'            => 'Mother & Baby Care',
                                    'housemaid'              => 'House Maid Services',
                                    'hospital-companion'     => 'Hospital Visit Companion',
                                    'day-support'            => 'Elderly Day Support',
                                    'night-care'             => 'Night Care Service',
                                    'nri'                    => 'NRI Parent Care Check',
                                ];
                                $selService = $old['service'] ?? '';
                                ?>
                                <div class="sm:col-span-2">
                                    <label for="service" class="block text-sm font-medium text-gray-700 mb-1.5">
                                        Service Required <span class="text-red-500">*</span>
                                    </label>
                                    <select id="service" name="service" required class="form-select <?= !empty($errors['service']) ? 'is-invalid' : '' ?>">
                                        <?php foreach ($services as $val => $label): ?>
                                            <option value="<?= h($val) ?>" <?= ($selService === $val) ? 'selected' : '' ?>>
                                                <?= h($label) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php if (!empty($errors['service'])): ?>
                                        <p class="form-error"><?= h($errors['service']) ?></p>
                                    <?php endif; ?>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="location" class="block text-sm font-medium text-gray-700 mb-1.5">
                                        Location / Full Address <span class="text-red-500">*</span>
                                    </label>
                                    <textarea id="location" name="location" required rows="2"
                                        class="form-textarea <?= !empty($errors['location']) ? 'is-invalid' : '' ?>"
                                        placeholder="House / Flat No., Street, City, District, PIN"><?= h($old['location'] ?? '') ?></textarea>
                                    <?php if (!empty($errors['location'])): ?>
                                        <p class="form-error"><?= h($errors['location']) ?></p>
                                    <?php endif; ?>
                                </div>

                                <div>
                                    <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1.5">
                                        Preferred Start Date <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" id="start_date" name="start_date" required
                                        class="form-input <?= !empty($errors['start_date']) ? 'is-invalid' : '' ?>"
                                        min="<?= date('Y-m-d') ?>"
                                        value="<?= h($old['start_date'] ?? '') ?>">
                                    <?php if (!empty($errors['start_date'])): ?>
                                        <p class="form-error"><?= h($errors['start_date']) ?></p>
                                    <?php endif; ?>
                                </div>

                                <div>
                                    <label for="duration" class="block text-sm font-medium text-gray-700 mb-1.5">
                                        Duration / Period <span class="text-red-500">*</span>
                                    </label>
                                    <select id="duration" name="duration" required class="form-select <?= !empty($errors['duration']) ? 'is-invalid' : '' ?>">
                                        <?php
                                        $durations = [
                                            ''          => '— Select duration —',
                                            '1-day'     => '1 Day (Trial)',
                                            '1-week'    => '1 Week',
                                            '2-weeks'   => '2 Weeks',
                                            '1-month'   => '1 Month',
                                            '3-months'  => '3 Months',
                                            '6-months'  => '6 Months',
                                            'long-term' => 'Long-term (6+ months)',
                                            'ongoing'   => 'Ongoing / As needed',
                                        ];
                                        $selDur = $old['duration'] ?? '';
                                        ?>
                                        <?php foreach ($durations as $val => $label): ?>
                                            <option value="<?= h($val) ?>" <?= ($selDur === $val) ? 'selected' : '' ?>>
                                                <?= h($label) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php if (!empty($errors['duration'])): ?>
                                        <p class="form-error"><?= h($errors['duration']) ?></p>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </fieldset>

                        <fieldset class="mb-8">
                            <legend class="text-sm font-semibold text-gray-500 uppercase tracking-widest mb-4 pb-2 border-b border-gray-100 w-full">Additional Information</legend>

                            <label for="message" class="block text-sm font-medium text-gray-700 mb-1.5">
                                Message / Special Requirements <span class="text-gray-400 font-normal">(optional)</span>
                            </label>
                            <textarea id="message" name="message" rows="4"
                                class="form-textarea"
                                placeholder="Describe any special requirements, medical conditions, budget preferences, or questions you may have..."><?= h($old['message'] ?? '') ?></textarea>
                        </fieldset>

                        <?php if (recaptcha_enabled()): ?>
                        <input type="hidden" name="g-recaptcha-response" id="appt_recaptcha_token">
                        <?php endif; ?>

                        <div class="flex flex-col sm:flex-row gap-3 items-start sm:items-center">
                            <button type="submit" class="btn-primary w-full sm:w-auto">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Book Appointment
                            </button>
                            <p class="text-xs text-gray-400">
                                <svg class="w-3.5 h-3.5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                Your data is secure and private.
                            </p>
                        </div>
                        <?php if (recaptcha_enabled()): ?>
                        <p class="text-gray-400 text-xs mt-2">
                            Protected by reCAPTCHA &mdash;
                            <a href="https://policies.google.com/privacy" target="_blank" rel="noopener" class="underline hover:text-gray-500">Privacy</a> &amp;
                            <a href="https://policies.google.com/terms" target="_blank" rel="noopener" class="underline hover:text-gray-500">Terms</a> apply.
                        </p>
                        <?php endif; ?>

                        <?php unset($_SESSION['old_appt']); ?>
                    </form>
                </div>
            </div>

            <div class="space-y-6 fade-in-up">

                <div class="bg-primary-50 rounded-2xl p-6 border border-primary-100">
                    <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <span class="w-7 h-7 rounded-full flex items-center justify-center shrink-0" style="background:#a5781e">
                            <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                            </svg>
                        </span>
                        Why Book With Us?
                    </h3>
                    <ul class="space-y-3">
                        <?php
                        $benefits = [
                            'Verified & background-checked caregivers',
                            'Prompt response within 24 hours',
                            'Flexible plans — hourly, daily, or long-term',
                            'Available 24 × 7, including weekends',
                            'Caregiver–patient compatibility matching',
                            'Fully transparent pricing, no hidden fees',
                            'Dedicated support from assignment to completion',
                        ];
                        foreach ($benefits as $benefit): ?>
                            <li class="flex items-start gap-2.5 text-sm text-gray-700">
                                <svg class="w-4 h-4 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color:#a5781e">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                </svg>
                                <?= h($benefit) ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <h3 class="font-bold text-gray-800 mb-4">Need Immediate Help?</h3>
                    <div class="space-y-3">
                        <a href="tel:<?= PHONE ?>"
                            class="flex items-center gap-3 p-3 rounded-xl transition-colors hover:bg-primary-50 group">
                            <span class="w-9 h-9 rounded-lg flex items-center justify-center shrink-0" style="background:#e0f4e2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color:#a5781e">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </span>
                            <div>
                                <p class="text-xs text-gray-400 font-medium">Call Directly</p>
                                <p class="font-semibold text-sm" style="color:#a5781e"><?= PHONE_DISPLAY ?></p>
                            </div>
                        </a>

                        <a href="<?= h(whatsapp_link(WHATSAPP_NUM, 'Hi Medizinar Care, I want to book an appointment.')) ?>"
                            target="_blank" rel="noopener"
                            class="flex items-center gap-3 p-3 rounded-xl transition-colors hover:bg-green-50 group">
                            <span class="w-9 h-9 rounded-lg flex items-center justify-center shrink-0" style="background:#e8faf0">
                                <svg class="w-4 h-4" fill="#25D366" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                </svg>
                            </span>
                            <div>
                                <p class="text-xs text-gray-400 font-medium">WhatsApp Chat</p>
                                <p class="font-semibold text-sm text-green-600"><?= PHONE_DISPLAY ?></p>
                            </div>
                        </a>

                        <a href="<?= url('/contact') ?>"
                            class="flex items-center gap-3 p-3 rounded-xl transition-colors hover:bg-amber-50 group">
                            <span class="w-9 h-9 rounded-lg flex items-center justify-center shrink-0" style="background:#fef3e0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color:#a5781e">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </span>
                            <div>
                                <p class="text-xs text-gray-400 font-medium">Send a Message</p>
                                <p class="font-semibold text-sm" style="color:#a5781e">Contact Form</p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="rounded-2xl p-6 text-white" style="background:linear-gradient(135deg,#0f5a10,#176B23)">
                    <h3 class="font-bold mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Service Hours
                    </h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between items-center py-1.5 border-b border-white/20">
                            <span class="text-white/80">Monday – Saturday</span>
                            <span class="font-semibold">7:00 AM – 9:00 PM</span>
                        </div>
                        <div class="flex justify-between items-center py-1.5 border-b border-white/20">
                            <span class="text-white/80">Sunday</span>
                            <span class="font-semibold">8:00 AM – 6:00 PM</span>
                        </div>
                        <div class="flex justify-between items-center py-1.5">
                            <span class="text-white/80">Emergency</span>
                            <span class="font-bold text-yellow-300">24 × 7</span>
                        </div>
                    </div>
                    <p class="text-xs text-white/60 mt-4">
                        For urgent situations, call or WhatsApp us at any hour — we respond within minutes.
                    </p>
                </div>

            </div>
        </div>
    </div>
</section>


<section class="py-12 bg-gray-50 border-t border-gray-100">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 text-center">
            <?php
            $trustItems = [
                ['icon' => '🔒', 'label' => 'Verified Caregivers',   'sub' => 'Background-checked'],
                ['icon' => '⚡', 'label' => '24-Hour Response',      'sub' => 'Fast confirmation'],
                ['icon' => '❤️', 'label' => 'Compassionate Care',    'sub' => 'Patient-first approach'],
                ['icon' => '📋', 'label' => 'Customised Plans',      'sub' => 'Fits your schedule'],
            ];
            foreach ($trustItems as $item): ?>
                <div class="fade-in-up">
                    <div class="text-3xl mb-2"><?= $item['icon'] ?></div>
                    <p class="font-bold text-gray-800 text-sm"><?= h($item['label']) ?></p>
                    <p class="text-gray-400 text-xs mt-0.5"><?= h($item['sub']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
