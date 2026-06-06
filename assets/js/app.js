/* Medizinar Care — Main JavaScript */

document.addEventListener('DOMContentLoaded', () => {

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

  // ── Phone number OTP UI toggle ──────────────────────────
  const otpTrigger = document.getElementById('send-otp-btn');
  const otpSection = document.getElementById('otp-section');
  if (otpTrigger && otpSection) {
    otpTrigger.addEventListener('click', () => {
      const phoneInput = document.getElementById('phone');
      if (!phoneInput || !phoneInput.value.trim()) {
        phoneInput && phoneInput.focus();
        return;
      }
      otpSection.classList.remove('hidden');
      otpTrigger.textContent = 'Resend OTP';
      otpTrigger.classList.add('opacity-70');
      // NOTE: Real OTP requires backend SMS integration (Twilio / MSG91)
    });
  }

  // ── Active nav link highlight (current page) ───────────
  const currentPath = window.location.pathname.split('/').pop() || 'index.php';
  document.querySelectorAll('nav a').forEach(link => {
    const href = link.getAttribute('href');
    if (href && (href === currentPath || href.endsWith('/' + currentPath))) {
      link.classList.add('text-primary-700', 'font-semibold');
    }
  });

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

});
