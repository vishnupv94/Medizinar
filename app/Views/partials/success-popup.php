<?php if ($msg = flash('success')): ?>
    <div
        data-success-popup
        data-success-popup-delay="4200"
        class="pointer-events-none fixed inset-x-0 top-4 z-[120] flex justify-center px-4 sm:top-6 sm:justify-end sm:px-6"
        aria-live="polite"
        aria-atomic="true"
        style="opacity:0">
        <div
            data-success-popup-card
            class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-2xl border border-emerald-100 bg-white shadow-2xl ring-1 ring-emerald-100/80"
            style="opacity:0;transform:translateY(-14px) scale(0.96)">
            <div class="h-1.5 bg-gradient-to-r from-emerald-500 via-green-400 to-amber-400"></div>
            <div class="p-4 sm:p-5">
                <div class="flex items-start gap-3">
                    <div class="mt-0.5 flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-emerald-50 text-emerald-600">
                        <svg class="h-5 w-5" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>

                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-semibold text-gray-900">Success</p>
                        <p class="mt-1 text-sm leading-6 text-gray-600"><?= h($msg) ?></p>
                    </div>

                    <button
                        type="button"
                        data-success-popup-close
                        class="shrink-0 rounded-full p-1.5 text-gray-400 transition hover:bg-gray-100 hover:text-gray-600"
                        aria-label="Close success message">
                        <svg class="h-4 w-4" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
