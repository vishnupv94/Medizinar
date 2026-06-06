<header id="main-header" class="bg-white shadow-sm sticky top-0 z-50 transition-shadow duration-300">
<div class="max-w-7xl mx-auto px-4 sm:px-6 py-2 flex items-center justify-between">

        <a href="<?= url('/') ?>" class="flex items-center gap-2.5 shrink-0" aria-label="Medizinar Care - Home">
            <img src="<?= asset('images/logo.jpeg') ?>" alt="Medizinar Care" class="h-20 w-auto">
        </a>

        <nav class="hidden lg:flex items-center gap-1" aria-label="Main navigation">
            <?php foreach (NAV_LINKS as $link): ?>
                <a href="<?= h($link['href']) ?>"
                    class="px-4 py-2 text-sm font-medium rounded-md transition-colors duration-200
                  <?= (isset($page) && $page === $link['key'])
                        ? 'text-primary-700 bg-primary-50 font-semibold'
                        : 'text-gray-700 hover:text-primary-700 hover:bg-primary-50' ?>">
                    <?= h($link['label']) ?>
                </a>
            <?php endforeach; ?>
        </nav>

        <a href="<?= url('/appointment') ?>"
            class="hidden lg:inline-flex items-center gap-2 bg-accent hover:bg-accent-hover text-white font-semibold text-sm px-5 py-2.5 rounded-lg transition-colors shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Make an Appointment
        </a>

        <button id="mobile-menu-btn"
            class="lg:hidden flex items-center justify-center w-10 h-10 rounded-md text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-300"
            aria-label="Toggle menu" aria-expanded="false" aria-controls="mobile-menu">
            <svg id="menu-icon-open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg id="menu-icon-close" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <div id="mobile-menu" class="hidden lg:hidden border-t border-gray-100 bg-white" aria-label="Mobile navigation">
        <nav class="max-w-7xl mx-auto px-4 py-3 flex flex-col gap-1">
            <?php foreach (NAV_LINKS as $link): ?>
                <a href="<?= h($link['href']) ?>"
                    class="px-4 py-2.5 text-sm font-medium rounded-md transition-colors
                  <?= (isset($page) && $page === $link['key'])
                        ? 'text-primary-700 bg-primary-50 font-semibold'
                        : 'text-gray-700 hover:text-primary-700 hover:bg-primary-50' ?>">
                    <?= h($link['label']) ?>
                </a>
            <?php endforeach; ?>
            <a href="<?= url('/appointment') ?>" class="mt-2 flex items-center justify-center gap-2 bg-accent hover:bg-accent-hover text-white font-semibold text-sm px-5 py-3 rounded-lg transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Make an Appointment
            </a>
        </nav>
    </div>
</header>