<?php partial('inner-hero', [
    'heroTitle'       => 'Contact Us',
    'heroDescription' => "We're here to support you. Reach us by phone, WhatsApp, email, or submit a support request below.",
    'breadcrumb'      => 'Contact Us',
]) ?>


<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-12 fade-in-up">
            <div class="section-badge">Get in Touch</div>
            <h2 class="section-title">We're Here to Support You</h2>
            <p class="section-subtitle mx-auto mt-3">
                At Medizinar Care, our team is always ready to respond to your inquiries and provide reliable assistance.
            </p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-16">

            <div class="contact-info-card fade-in-up flex-col text-center items-center">
                <div class="contact-icon mb-3 mx-auto">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color:#a5781e">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                </div>
                <h3 class="font-bold text-gray-800 mb-1">Phone</h3>
                <a href="tel:<?= PHONE ?>" class="font-semibold block mb-1" style="color:#a5781e"><?= PHONE_DISPLAY ?></a>
                <p class="text-gray-400 text-xs">Call us for immediate assistance</p>
            </div>

            <div class="contact-info-card fade-in-up flex-col text-center items-center">
                <div class="contact-icon mb-3 mx-auto">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color:#a5781e">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="font-bold text-gray-800 mb-1">Email</h3>
                <a href="mailto:<?= EMAIL ?>" class="font-semibold block mb-1 break-all text-sm" style="color:#a5781e"><?= EMAIL ?></a>
                <p class="text-gray-400 text-xs">Send us your inquiries</p>
            </div>

            <div class="contact-info-card fade-in-up flex-col text-center items-center">
                <div class="contact-icon mb-3 mx-auto">
                    <svg class="w-5 h-5" fill="white" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                    </svg>
                </div>
                <h3 class="font-bold text-gray-800 mb-1">WhatsApp</h3>
                <a href="<?= h(whatsapp_link(WHATSAPP_NUM, 'Hi Medizinar Care, I have an inquiry.')) ?>"
                    target="_blank" rel="noopener"
                    class="font-semibold block mb-1 text-sm" style="color:#25D366"><?= PHONE_DISPLAY ?></a>
                <p class="text-gray-400 text-xs">Quick messaging support</p>
            </div>

            <div class="contact-info-card fade-in-up flex-col text-center items-center">
                <div class="contact-icon mb-3 mx-auto">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color:#a5781e">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <h3 class="font-bold text-gray-800 mb-1">Office Address</h3>
                <address class="not-italic text-gray-500 text-xs leading-relaxed">
                    <?= ADDRESS_LINE1 ?><br>
                    <?= ADDRESS_LINE2 ?><br>
                    <?= ADDRESS_LINE3 ?>
                </address>
            </div>

        </div>
    </div>
</section>


<section class="py-16 pb-20" style="background:#f8fbf8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="grid lg:grid-cols-2 gap-12">

            <div class="fade-in-up">
                <div class="section-badge">Support Ticket</div>
                <h2 class="section-title mb-2">Send Us a Message</h2>
                <p class="text-gray-500 text-sm mb-7">
                    Submit a support request, inquiry, or feedback. Our team will review and respond promptly.
                </p>

                <form action="<?= url('/contact') ?>" method="POST" enctype="multipart/form-data" novalidate>
                    <?= csrf_field() ?>

                    <div class="grid sm:grid-cols-2 gap-5 mb-5">
                        <div>
                            <label class="form-label" for="cf_name">Full Name <span class="text-red-500">*</span></label>
                            <input type="text" id="cf_name" name="name" class="form-input <?= !empty($errors['name']) ? 'is-invalid' : '' ?>"
                                placeholder="Your full name" required maxlength="120"
                                value="<?= h($_SESSION['old_cf']['name'] ?? '') ?>">
                            <?php if (!empty($errors['name'])): ?>
                                <p class="form-error"><?= h($errors['name']) ?></p>
                            <?php endif; ?>
                        </div>
                        <div>
                            <label class="form-label" for="cf_phone">Phone Number <span class="text-red-500">*</span></label>
                            <input type="tel" id="cf_phone" name="phone" class="form-input <?= !empty($errors['phone']) ? 'is-invalid' : '' ?>"
                                placeholder="e.g. 9745782716" required maxlength="15"
                                value="<?= h($_SESSION['old_cf']['phone'] ?? '') ?>">
                            <?php if (!empty($errors['phone'])): ?>
                                <p class="form-error"><?= h($errors['phone']) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="form-label" for="cf_email">Email Address</label>
                        <input type="email" id="cf_email" name="email" class="form-input <?= !empty($errors['email']) ? 'is-invalid' : '' ?>"
                            placeholder="your@email.com" maxlength="200"
                            value="<?= h($_SESSION['old_cf']['email'] ?? '') ?>">
                        <?php if (!empty($errors['email'])): ?>
                            <p class="form-error"><?= h($errors['email']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="mb-5">
                        <label class="form-label" for="cf_category">Ticket Category <span class="text-red-500">*</span></label>
                        <select id="cf_category" name="category" class="form-select <?= !empty($errors['category']) ? 'is-invalid' : '' ?>" required>
                            <option value="">Select a category</option>
                            <?php
                            $cats = ['General Inquiry', 'Complaint / Issue', 'Service Feedback', 'Caregiver Support Request'];
                            $oldCat = $_SESSION['old_cf']['category'] ?? '';
                            foreach ($cats as $cat): ?>
                                <option value="<?= h($cat) ?>" <?= $oldCat === $cat ? 'selected' : '' ?>>
                                    <?= h($cat) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (!empty($errors['category'])): ?>
                            <p class="form-error"><?= h($errors['category']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="mb-5">
                        <label class="form-label" for="cf_subject">Subject <span class="text-red-500">*</span></label>
                        <input type="text" id="cf_subject" name="subject" class="form-input <?= !empty($errors['subject']) ? 'is-invalid' : '' ?>"
                            placeholder="Brief subject of your inquiry" required maxlength="200"
                            value="<?= h($_SESSION['old_cf']['subject'] ?? '') ?>">
                        <?php if (!empty($errors['subject'])): ?>
                            <p class="form-error"><?= h($errors['subject']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="mb-5">
                        <label class="form-label" for="cf_message">Message / Description <span class="text-red-500">*</span></label>
                        <textarea id="cf_message" name="message" class="form-textarea <?= !empty($errors['message']) ? 'is-invalid' : '' ?>" rows="5"
                            placeholder="Describe your inquiry, issue, or feedback in detail..." required maxlength="3000"><?= h($_SESSION['old_cf']['message'] ?? '') ?></textarea>
                        <?php if (!empty($errors['message'])): ?>
                            <p class="form-error"><?= h($errors['message']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="mb-7">
                        <label class="form-label" for="cf_attachment">Attachment (Optional)</label>
                        <input type="file" id="cf_attachment" name="attachment"
                            accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx"
                            class="form-input pt-2 text-sm text-gray-500 cursor-pointer file:mr-4 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:cursor-pointer"
                            style="file-selector-button-background:#e0f4e2;file-selector-button-color:#176B23">
                        <p class="text-gray-400 text-xs mt-1.5">Upload a photo or document if needed (max 5 MB). Supported: JPG, PNG, PDF, DOC.</p>
                    </div>

                    <?php if (recaptcha_enabled()): ?>
                    <div class="mb-5">
                        <div class="g-recaptcha" data-sitekey="<?= h(recaptcha_site_key()) ?>" data-theme="light"></div>
                    </div>
                    <?php endif; ?>

                    <button type="submit" class="btn-primary w-full justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                        Submit Request
                    </button>
                    <?php unset($_SESSION['old_cf']); ?>
                </form>
            </div>

            <div class="fade-in-up space-y-6">
                <div>
                    <h3 class="font-bold text-gray-800 text-lg mb-4">Find Us on the Map</h3>
                    <div class="rounded-2xl overflow-hidden shadow-card border border-primary-100" style="height:350px;border-color:#d4e8d5">
                        <iframe
                            title="Medizinar Care Office Location"
                            src="<?= h(\App\Models\SiteSetting::get('GOOGLE_MAPS_EMBED_URL', GOOGLE_MAPS_EMBED_URL)) ?>"
                            width="100%" height="100%" style="border:0" allowfullscreen=""
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                    <p class="text-gray-400 text-xs mt-2 text-center">
                        Melkulangara, Vayakal Post Office, Kottarakkara, Kollam, Kerala
                    </p>
                </div>

                <div class="rounded-2xl p-6 space-y-4" style="background:#e0f4e2">
                    <h3 class="font-bold text-gray-800 mb-2">⚡ Quick Contact Options</h3>
                    <p class="text-gray-600 text-sm mb-4">For immediate assistance, you may also use:</p>
                    <a href="tel:<?= PHONE ?>"
                        class="flex items-center gap-3 bg-white rounded-xl px-4 py-3 shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-9 h-9 rounded-lg flex items-center justify-center shrink-0" style="background:#e0f4e2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" style="color:#a5781e">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-800 text-sm">Call Now</div>
                            <div class="text-xs" style="color:#a5781e"><?= PHONE_DISPLAY ?></div>
                        </div>
                    </a>
                    <a href="<?= h(whatsapp_link(WHATSAPP_NUM, 'Hi, I need home care support.')) ?>"
                        target="_blank" rel="noopener"
                        class="flex items-center gap-3 bg-white rounded-xl px-4 py-3 shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-9 h-9 rounded-lg flex items-center justify-center shrink-0" style="background:#e8faf0">
                            <svg class="w-4 h-4" fill="#25D366" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-800 text-sm">WhatsApp Chat</div>
                            <div class="text-xs" style="color:#25D366">Instant messaging support</div>
                        </div>
                    </a>
                    <a href="<?= url('/appointment') ?>"
                        class="flex items-center gap-3 bg-accent text-white rounded-xl px-4 py-3 shadow-sm hover:bg-accent-hover transition-colors">
                        <div class="w-9 h-9 rounded-lg bg-white/20 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-sm">Make an Appointment</div>
                            <div class="text-white/80 text-xs">Schedule a consultation</div>
                        </div>
                    </a>
                </div>

                <div class="rounded-2xl p-6 border" style="background:white;border-color:#d4e8d5">
                    <h3 class="font-bold text-gray-800 mb-3">⭐ Our Client Support Commitment</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        At Medizinar Care, client satisfaction is our priority. Every inquiry, feedback, or complaint is
                        handled with attention and care to ensure that our services meet the expectations of the families we serve.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>