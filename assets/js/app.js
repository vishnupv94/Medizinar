/* Medizinar Care — Main JavaScript */

// ── Team member modal ────────────────────────────────────
function openTeamModal(btn) {
  const modal   = document.getElementById('team-modal');
  const photo   = document.getElementById('modal-photo');
  const name    = document.getElementById('modal-name');
  const role    = document.getElementById('modal-role');
  const bio     = document.getElementById('modal-bio');
  const color   = btn.dataset.color;

  photo.src           = btn.dataset.photo;
  photo.alt           = btn.dataset.name;
  name.textContent    = btn.dataset.name;
  role.textContent    = btn.dataset.role;
  role.style.background = color;
  bio.textContent     = btn.dataset.bio;

  modal.classList.remove('hidden');
  document.body.style.overflow = 'hidden';
}

function closeTeamModal() {
  const modal = document.getElementById('team-modal');
  if (!modal) return;
  modal.classList.add('hidden');
  document.body.style.overflow = '';
}

function prefersReducedMotion() {
  return typeof window.matchMedia === 'function'
    && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
}

function launchSuccessConfetti(sourceEl) {
  if (!sourceEl || prefersReducedMotion()) return;

  const testPiece = document.createElement('span');
  if (typeof testPiece.animate !== 'function') return;

  const rect = sourceEl.getBoundingClientRect();
  const originX = rect.left + (rect.width / 2);
  const originY = rect.top + Math.min(rect.height * 0.28, 28);
  const colors = ['#16a34a', '#22c55e', '#86efac', '#ab7e22', '#f59e0b', '#fde68a'];
  const totalPieces = window.innerWidth < 640 ? 18 : 26;

  for (let i = 0; i < totalPieces; i += 1) {
    const piece = document.createElement('span');
    const size = 6 + Math.random() * 8;
    const spreadX = (Math.random() - 0.5) * Math.min(window.innerWidth * 0.42, 320);
    const endY = 120 + Math.random() * 150;
    const rotation = (Math.random() - 0.5) * 720;
    const drift = (Math.random() - 0.5) * 40;

    piece.setAttribute('aria-hidden', 'true');
    piece.style.position = 'fixed';
    piece.style.left = '0';
    piece.style.top = '0';
    piece.style.width = `${size}px`;
    piece.style.height = `${Math.random() > 0.55 ? size : size * 0.55}px`;
    piece.style.borderRadius = Math.random() > 0.45 ? '999px' : '3px';
    piece.style.background = colors[Math.floor(Math.random() * colors.length)];
    piece.style.pointerEvents = 'none';
    piece.style.opacity = '0';
    piece.style.zIndex = '130';
    piece.style.willChange = 'transform, opacity';

    document.body.appendChild(piece);

    const animation = piece.animate([
      {
        transform: `translate3d(${originX}px, ${originY}px, 0) rotate(0deg) scale(0.85)`,
        opacity: 0,
      },
      {
        transform: `translate3d(${originX + (spreadX * 0.3)}px, ${originY + 28}px, 0) rotate(${rotation * 0.3}deg) scale(1)`,
        opacity: 1,
        offset: 0.18,
      },
      {
        transform: `translate3d(${originX + spreadX + drift}px, ${originY + endY}px, 0) rotate(${rotation}deg) scale(0.92)`,
        opacity: 0,
      },
    ], {
      duration: 1100 + Math.random() * 500,
      easing: 'cubic-bezier(0.12, 0.8, 0.24, 1)',
      fill: 'forwards',
      delay: Math.random() * 120,
    });

    animation.onfinish = () => piece.remove();
  }
}

function initSuccessPopups() {
  const popups = document.querySelectorAll('[data-success-popup]');
  if (!popups.length) return;

  const reducedMotion = prefersReducedMotion();

  popups.forEach((popup) => {
    const card = popup.querySelector('[data-success-popup-card]');
    const closeButton = popup.querySelector('[data-success-popup-close]');
    let dismissTimer = null;
    let isDismissed = false;

    if (!card) return;

    const dismissPopup = () => {
      if (isDismissed) return;

      isDismissed = true;
      window.clearTimeout(dismissTimer);

      popup.style.opacity = '0';
      card.style.opacity = '0';
      card.style.transform = reducedMotion
        ? 'translateY(-4px)'
        : 'translateY(-12px) scale(0.98)';

      window.setTimeout(() => popup.remove(), 320);
    };

    const scheduleDismiss = () => {
      window.clearTimeout(dismissTimer);
      const delay = parseInt(popup.getAttribute('data-success-popup-delay'), 10) || 4200;
      dismissTimer = window.setTimeout(dismissPopup, delay);
    };

    if (closeButton) {
      closeButton.addEventListener('click', dismissPopup);
    }

    card.addEventListener('mouseenter', () => {
      window.clearTimeout(dismissTimer);
    });

    card.addEventListener('mouseleave', () => {
      if (!isDismissed) scheduleDismiss();
    });

    requestAnimationFrame(() => {
      popup.style.transition = 'opacity 0.28s ease';
      card.style.transition = reducedMotion
        ? 'opacity 0.18s ease'
        : 'transform 0.34s cubic-bezier(0.22, 1, 0.36, 1), opacity 0.28s ease';
      popup.style.opacity = '1';
      card.style.opacity = '1';
      card.style.transform = 'translateY(0) scale(1)';
    });

    if (!reducedMotion) {
      window.setTimeout(() => launchSuccessConfetti(card), 120);
    }

    scheduleDismiss();
  });
}

document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') closeTeamModal();
});

document.addEventListener('DOMContentLoaded', () => {
  initSuccessPopups();

  // ── Mobile menu toggle ──────────────────────────────────
  const btn   = document.getElementById('mobile-menu-btn');
  const menu  = document.getElementById('mobile-menu');
  const open  = document.getElementById('menu-icon-open');
  const close = document.getElementById('menu-icon-close');

  if (btn && menu) {
    btn.addEventListener('click', () => {
      const expanded = btn.getAttribute('aria-expanded') === 'true';
      btn.setAttribute('aria-expanded', String(!expanded));
      menu.classList.toggle('hidden');
      open.classList.toggle('hidden');
      close.classList.toggle('hidden');
    });

    // Close on outside click
    document.addEventListener('click', (e) => {
      if (!btn.contains(e.target) && !menu.contains(e.target)) {
        menu.classList.add('hidden');
        open.classList.remove('hidden');
        close.classList.add('hidden');
        btn.setAttribute('aria-expanded', 'false');
      }
    });
  }

  // ── Sticky header shadow on scroll ─────────────────────
  const header = document.getElementById('main-header');
  if (header) {
    const observer = new IntersectionObserver(
      ([entry]) => header.classList.toggle('scrolled', !entry.isIntersecting),
      { rootMargin: '-1px 0px 0px 0px', threshold: 0 }
    );
    const sentinel = document.createElement('div');
    sentinel.style.cssText = 'position:absolute;top:0;left:0;width:1px;height:1px;pointer-events:none';
    document.body.prepend(sentinel);
    observer.observe(sentinel);
  }

  // ── Scroll-triggered fade-in animations ────────────────
  const fadeEls = document.querySelectorAll('.fade-in-up');
  if (fadeEls.length && 'IntersectionObserver' in window) {
    const fadeObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          fadeObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12 });
    fadeEls.forEach(el => fadeObserver.observe(el));
  } else {
    // Fallback: show all immediately
    fadeEls.forEach(el => el.classList.add('visible'));
  }

  // ── Copy phone number ───────────────────────────────────
  document.querySelectorAll('[data-copy-phone]').forEach(el => {
    el.addEventListener('click', async () => {
      const phone = el.getAttribute('data-copy-phone');
      try {
        await navigator.clipboard.writeText(phone);
        const orig = el.textContent;
        el.textContent = '✓ Copied!';
        setTimeout(() => { el.textContent = orig; }, 1800);
      } catch (_) {
        // clipboard API not available — silent fail
      }
    });
  });

  // ── Auto-close flash alerts ─────────────────────────────
  const alerts = document.querySelectorAll('[data-auto-close]');
  alerts.forEach(alert => {
    const delay = parseInt(alert.getAttribute('data-auto-close')) || 5000;
    setTimeout(() => {
      alert.style.transition = 'opacity 0.4s ease';
      alert.style.opacity = '0';
      setTimeout(() => alert.remove(), 450);
    }, delay);
  });

  // ── Active nav link highlight (current page) ───────────
  const currentPath = window.location.pathname.split('/').pop() || 'index.php';
  const mainHeaderNav = document.getElementById('main-header');
  if (mainHeaderNav) {
    mainHeaderNav.querySelectorAll('nav a').forEach(link => {
      const href = link.getAttribute('href');
      if (href && (href === currentPath || href.endsWith('/' + currentPath))) {
        link.classList.add('text-primary-700', 'font-semibold');
      }
    });
  }

  // ── Smooth anchor scroll ────────────────────────────────
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', (e) => {
      const target = document.querySelector(anchor.getAttribute('href'));
      if (target) {
        e.preventDefault();
        const offset = 80; // sticky header height
        const top = target.getBoundingClientRect().top + window.scrollY - offset;
        window.scrollTo({ top, behavior: 'smooth' });
      }
    });
  });

  // ── reCAPTCHA v3 invisible form protection ──────────────
  document.querySelectorAll('input[name="g-recaptcha-response"]').forEach(hiddenInput => {
    const form = hiddenInput.closest('form');
    if (!form) return;

    form.addEventListener('submit', function (e) {
      // If token already filled (re-submit after grecaptcha resolved) — allow through
      if (hiddenInput.value) return;

      e.preventDefault();

      const scriptTag = document.querySelector('script[src*="recaptcha/api.js?render="]');
      const siteKey   = scriptTag ? new URL(scriptTag.src).searchParams.get('render') : '';

      if (!siteKey || typeof grecaptcha === 'undefined') {
        // reCAPTCHA not loaded — submit anyway (server-side fail-open matches this)
        form.submit();
        return;
      }

      grecaptcha.ready(() => {
        grecaptcha.execute(siteKey, { action: 'submit' }).then(token => {
          hiddenInput.value = token;
          form.submit();
        }).catch(() => {
          form.submit();
        });
      });
    });
  });

  // ── Cookie Consent ─────────────────────────────────────
  initCookieConsent();

});

// ── Cookie Consent Logic ────────────────────────────────────────────────────
function initCookieConsent() {
  const STORAGE_KEY = 'mc_cookie_consent'; // mc = medizinar care
  const banner      = document.getElementById('cookie-banner');
  const acceptBtn   = document.getElementById('cookie-accept');
  const declineBtn  = document.getElementById('cookie-decline');

  if (!banner) return;

  // Already decided — keep banner hidden
  if (localStorage.getItem(STORAGE_KEY)) return;

  // Show banner after a brief delay so it doesn't clash with page load
  setTimeout(() => {
    banner.removeAttribute('hidden');
  }, 800);

  function dismiss(choice) {
    localStorage.setItem(STORAGE_KEY, choice); // 'accepted' | 'declined'

    // Slide banner back down
    banner.style.transition = 'transform 0.35s cubic-bezier(0.4, 0, 1, 1), opacity 0.3s ease';
    banner.style.transform  = 'translateY(110%)';
    banner.style.opacity    = '0';

    setTimeout(() => banner.setAttribute('hidden', ''), 380);
  }

  if (acceptBtn)  acceptBtn.addEventListener('click',  () => dismiss('accepted'));
  if (declineBtn) declineBtn.addEventListener('click', () => dismiss('declined'));
}

