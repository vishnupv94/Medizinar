<!-- ── Cookie Consent Banner ───────────────────────────────────────────────
     Hidden by default. JS in app.js reads localStorage and shows/hides it.
     id="cookie-banner" is the hook JS targets.
──────────────────────────────────────────────────────────────────────── -->
<div id="cookie-banner"
     role="dialog"
     aria-live="polite"
     aria-label="Cookie consent"
     aria-describedby="cookie-banner-desc"
     class="cookie-banner"
     hidden>

    <div class="cookie-banner-inner">

        <!-- Icon -->
        <div class="cookie-banner-icon" aria-hidden="true">
            <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="18" cy="18" r="17" fill="#f0faf1" stroke="#186c21" stroke-width="1.5"/>
                <!-- cookie body -->
                <ellipse cx="18" cy="19" rx="10" ry="9.5" fill="#ab7e22" opacity=".18"/>
                <path d="M8.5 19c0-5.247 4.253-9.5 9.5-9.5s9.5 4.253 9.5 9.5-4.253 9.5-9.5 9.5S8.5 24.247 8.5 19z"
                      fill="#c4922a" opacity=".55"/>
                <!-- chips -->
                <circle cx="14" cy="17" r="2" fill="#7a5514"/>
                <circle cx="20" cy="21" r="1.5" fill="#7a5514"/>
                <circle cx="21" cy="14.5" r="1.2" fill="#7a5514"/>
                <!-- bite -->
                <path d="M27.5 9.5 Q29 7 31 9 Q29 11 27.5 9.5z" fill="#f0faf1" stroke="#186c21" stroke-width="1"/>
            </svg>
        </div>

        <!-- Text -->
        <div class="cookie-banner-text">
            <p class="cookie-banner-title">We use cookies</p>
            <p class="cookie-banner-desc" id="cookie-banner-desc">
                We use cookies to improve your browsing experience. By continuing, you agree to our
                <a href="<?= url('/privacy-policy') ?>" class="cookie-banner-link">Privacy Policy</a>.
            </p>
        </div>

        <!-- Actions -->
        <div class="cookie-banner-actions">
            <button id="cookie-accept" type="button" class="cookie-btn cookie-btn-accept">
                Accept All
            </button>
            <button id="cookie-decline" type="button" class="cookie-btn cookie-btn-decline">
                Decline
            </button>
        </div>

    </div>

</div>
