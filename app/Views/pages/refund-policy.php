<?php partial('inner-hero', [
    'breadcrumb'      => 'Refund Policy',
    'heroTitle'       => 'Refund Policy',
    'heroDescription' => 'Our guidelines for cancellations, refunds, and service adjustments.',
]) ?>

<section class="py-16 sm:py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 sm:p-10">

            <div class="flex items-start justify-between flex-wrap gap-4 pb-6 border-b border-gray-100 mb-8">
                <div>
                    <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-accent bg-accent/10 px-3 py-1 rounded-full mb-3">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                        Last Updated: July 2026
                    </span>
                    <h2 class="text-2xl font-bold text-gray-900">Refund Policy</h2>
                    <p class="text-gray-500 text-sm mt-1"><?= SITE_NAME ?> &mdash; Medizinar Care LLP</p>
                </div>
                <a href="<?= url('docs/legal/Refund Policy.pdf') ?>" download
                   class="inline-flex items-center gap-2 bg-primary hover:bg-primary-800 text-white font-semibold text-sm px-4 py-2.5 rounded-xl transition-colors shadow-sm shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Download PDF
                </a>
            </div>

            <div class="legal-prose">
                <p>At Medizinar Care LLP, we strive to provide reliable, compassionate, and professional home healthcare services. This Refund Policy explains the conditions under which refunds may or may not be granted.</p>
                <p>By registering for or using our services, you agree to the terms outlined below.</p>
            </div>

            <!-- Section 1 -->
            <div class="legal-section">
                <div class="legal-section-num">1</div>
                <div class="legal-section-body">
                    <h3>Registration Fees</h3>
                    <p>Registration fees paid under any package are strictly non-refundable.</p>
                    <div class="legal-table-wrap">
                        <table class="legal-table">
                            <thead>
                                <tr>
                                    <th>Package</th>
                                    <th>Registration Fee</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td>Basic Package (3 Months)</td><td>₹4,000</td></tr>
                                <tr><td>Standard Package (6 Months)</td><td>₹7,000</td></tr>
                                <tr><td>Premium Package (12 Months)</td><td>₹12,000</td></tr>
                                <tr><td>Registered Nurse Package (3 Months)</td><td>₹5,000</td></tr>
                            </tbody>
                        </table>
                    </div>
                    <p class="mt-3">Once registration is completed and processing has commenced, the registration fee cannot be refunded.</p>
                </div>
            </div>

            <!-- Section 2 -->
            <div class="legal-section">
                <div class="legal-section-num">2</div>
                <div class="legal-section-body">
                    <h3>Service Charges</h3>
                    <p>Monthly service charges are generally non-refundable after services have commenced. Refund requests may be considered only under exceptional circumstances and shall be subject to management review and approval.</p>
                </div>
            </div>

            <!-- Section 3 -->
            <div class="legal-section">
                <div class="legal-section-num">3</div>
                <div class="legal-section-body">
                    <h3>Before Service Commencement</h3>
                    <p>If a client cancels a service request before caregiver or nurse assignment and before service commencement:</p>
                    <ul>
                        <li>Service charges paid in advance may be refunded after applicable administrative deductions.</li>
                        <li>Registration fees remain non-refundable.</li>
                    </ul>
                </div>
            </div>

            <!-- Section 4 -->
            <div class="legal-section">
                <div class="legal-section-num">4</div>
                <div class="legal-section-body">
                    <h3>After Service Commencement</h3>
                    <p>Once services have started:</p>
                    <ul>
                        <li>Registration fees are non-refundable.</li>
                        <li>Service charges already utilized are non-refundable.</li>
                        <li>Refunds will not be issued for partially used service periods except where required by applicable law.</li>
                    </ul>
                </div>
            </div>

            <!-- Section 5 -->
            <div class="legal-section">
                <div class="legal-section-num">5</div>
                <div class="legal-section-body">
                    <h3>Caregiver Replacement</h3>
                    <p>Medizinar Care LLP provides replacement support instead of refunds whenever reasonably possible.</p>
                    <ul>
                        <li>1st Replacement &ndash; Free</li>
                        <li>2nd Replacement &ndash; Free</li>
                        <li>3rd Replacement &ndash; Free</li>
                        <li>4th Replacement onwards &ndash; ₹3,000 per replacement</li>
                    </ul>
                    <p>Clients are encouraged to use the replacement facility before requesting service cancellation.</p>
                </div>
            </div>

            <!-- Section 6 -->
            <div class="legal-section">
                <div class="legal-section-num">6</div>
                <div class="legal-section-body">
                    <h3>No Refund Situations</h3>
                    <p>Refunds will not be provided in the following circumstances:</p>
                    <ul>
                        <li>Change of mind after service registration.</li>
                        <li>Dissatisfaction arising from factors beyond the caregiver's control.</li>
                        <li>Service interruption caused by client or family members.</li>
                        <li>Failure to provide accurate information during registration.</li>
                        <li>Client relocation or personal circumstances unrelated to service quality.</li>
                        <li>Non-utilization of services during the active validity period.</li>
                    </ul>
                </div>
            </div>

            <!-- Section 7 -->
            <div class="legal-section">
                <div class="legal-section-num">7</div>
                <div class="legal-section-body">
                    <h3>Gift Voucher Policy</h3>
                    <p>Gift vouchers issued under promotional offers:</p>
                    <ul>
                        <li>Are non-refundable.</li>
                        <li>Cannot be exchanged for cash.</li>
                        <li>Are non-transferable.</li>
                        <li>Remain valid for one year from the date of issue.</li>
                    </ul>
                    <div class="legal-highlight-box">
                        <p class="font-semibold text-primary-900 text-sm mb-2">Promotional Offers</p>
                        <div class="flex flex-wrap gap-3">
                            <div class="flex items-center gap-2 bg-white rounded-lg px-4 py-2 border border-primary-100 text-sm">
                                <span class="text-primary-700 font-medium">6-Month Package</span>
                                <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                                <span class="font-bold text-accent">₹500 Gift Voucher</span>
                            </div>
                            <div class="flex items-center gap-2 bg-white rounded-lg px-4 py-2 border border-primary-100 text-sm">
                                <span class="text-primary-700 font-medium">12-Month Package</span>
                                <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                                <span class="font-bold text-accent">₹1,000 Gift Voucher</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 8 -->
            <div class="legal-section">
                <div class="legal-section-num">8</div>
                <div class="legal-section-body">
                    <h3>Approved Refunds</h3>
                    <p>Where a refund is approved by management:</p>
                    <ul>
                        <li>Processing may take 7&ndash;15 business days.</li>
                        <li>Refunds will be made through the original payment method whenever possible.</li>
                        <li>Bank processing times may vary.</li>
                    </ul>
                </div>
            </div>

            <!-- Section 9 -->
            <div class="legal-section">
                <div class="legal-section-num">9</div>
                <div class="legal-section-body">
                    <h3>Service Availability</h3>
                    <p>Medizinar Care LLP reserves the right to decline or discontinue services where:</p>
                    <ul>
                        <li>Safety concerns exist.</li>
                        <li>Inaccurate information has been provided.</li>
                        <li>Required care exceeds available service capabilities.</li>
                    </ul>
                    <p>In such situations, any refund decision shall be determined on a case-by-case basis.</p>
                </div>
            </div>

            <!-- Section 10 -->
            <div class="legal-section">
                <div class="legal-section-num">10</div>
                <div class="legal-section-body">
                    <h3>Management Discretion</h3>
                    <p>All refund requests are subject to review by Medizinar Care LLP management. The company's decision regarding refunds shall be final, subject to applicable consumer protection laws.</p>
                </div>
            </div>

            <!-- Section 11 -->
            <div class="legal-section">
                <div class="legal-section-num">11</div>
                <div class="legal-section-body">
                    <h3>Contact Information</h3>
                    <div class="legal-contact-box">
                        <p class="font-semibold text-primary-900"><?= SITE_NAME ?></p>
                        <p>Melkulangara, Vayakal Post Office<br>Kottarakkara, Kollam District &ndash; 691532<br>Kerala, India</p>
                        <p>Phone &amp; WhatsApp: <a href="tel:+919745782716" class="text-primary hover:underline">+91 97457 82716</a></p>
                        <p>Email: <a href="mailto:care@medizinarcare.com" class="text-primary hover:underline">care@medizinarcare.com</a></p>
                        <p>Website: <a href="<?= url('/') ?>" class="text-primary hover:underline">www.medizinarcare.com</a></p>
                    </div>
                </div>
            </div>

        </div><!-- /card -->

    </div>
</section>

<style>
.legal-prose { color: #4b5563; font-size: 0.9375rem; line-height: 1.75; margin-bottom: 2rem; }
.legal-prose p + p { margin-top: 0.75rem; }

.legal-section { display: flex; gap: 1.25rem; padding: 1.75rem 0; border-top: 1px solid #f3f4f6; }
.legal-section:last-child { border-bottom: none; }

.legal-section-num {
    flex-shrink: 0;
    width: 2.25rem; height: 2.25rem;
    background: #f0faf1;
    color: #186c21;
    font-weight: 700; font-size: 0.8125rem;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin-top: 0.125rem;
}

.legal-section-body { flex: 1; }
.legal-section-body h3 { font-size: 1.0625rem; font-weight: 700; color: #111827; margin-bottom: 0.65rem; }
.legal-section-body p { color: #4b5563; font-size: 0.9rem; line-height: 1.75; margin-bottom: 0.5rem; }
.legal-section-body ul { margin: 0.5rem 0; padding: 0; list-style: none; display: flex; flex-direction: column; gap: 0.35rem; }
.legal-section-body ul li { position: relative; padding-left: 1.25rem; color: #4b5563; font-size: 0.9rem; line-height: 1.6; }
.legal-section-body ul li::before { content: ''; position: absolute; left: 0; top: 0.55em; width: 6px; height: 6px; background: #ab7e22; border-radius: 50%; }

.legal-table-wrap { overflow-x: auto; margin-top: 0.75rem; border-radius: 0.75rem; border: 1px solid #e5e7eb; }
.legal-table { width: 100%; border-collapse: collapse; font-size: 0.875rem; }
.legal-table thead { background: #f0faf1; }
.legal-table th { padding: 0.75rem 1rem; text-align: left; font-weight: 600; color: #186c21; border-bottom: 1px solid #e5e7eb; }
.legal-table td { padding: 0.7rem 1rem; color: #374151; border-bottom: 1px solid #f3f4f6; }
.legal-table tbody tr:last-child td { border-bottom: none; }
.legal-table tbody tr:nth-child(even) { background: #f9fafb; }

.legal-highlight-box { background: #f0faf1; border: 1px solid #b8e6bc; border-radius: 0.875rem; padding: 1.25rem 1.5rem; margin-top: 1rem; }

.legal-contact-box { background: #f0faf1; border: 1px solid #b8e6bc; border-radius: 0.875rem; padding: 1.25rem 1.5rem; margin-top: 0.75rem; display: flex; flex-direction: column; gap: 0.4rem; }
.legal-contact-box p { color: #374151; font-size: 0.875rem; line-height: 1.6; margin: 0; }
</style>

<?php partial('cta') ?>
