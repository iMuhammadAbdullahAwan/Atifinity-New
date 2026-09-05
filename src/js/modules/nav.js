/**
 * nav.js — sticky header scroll-state, an accessible mobile menu (body
 * scroll lock, ESC to close, focus trapped inside while open, focus
 * returned to the toggle button on close), and a scrollspy that keeps the
 * active nav link in sync with whichever section is in view.
 */
window.Atifinity = window.Atifinity || {};

Atifinity.initNav = function initNav() {
  var header = document.getElementById('siteHeader');
  var toggle = document.getElementById('navToggle');
  var menu = document.getElementById('mobileMenu');
  var iconBurger = document.getElementById('iconBurger');
  var iconClose = document.getElementById('iconClose');

  if (toggle && menu) {
    var focusables = function () {
      return Array.prototype.slice.call(
        menu.querySelectorAll('a[href], button:not([disabled])')
      );
    };

    var openMenu = function () {
      menu.classList.remove('hidden');
      toggle.setAttribute('aria-expanded', 'true');
      iconBurger.classList.add('hidden');
      iconClose.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
      var first = focusables()[0];
      if (first) first.focus();
    };

    var closeMenu = function (returnFocus) {
      menu.classList.add('hidden');
      toggle.setAttribute('aria-expanded', 'false');
      iconBurger.classList.remove('hidden');
      iconClose.classList.add('hidden');
      document.body.style.overflow = '';
      if (returnFocus) toggle.focus();
    };

    toggle.addEventListener('click', function () {
      var isOpen = toggle.getAttribute('aria-expanded') === 'true';
      if (isOpen) closeMenu(true); else openMenu();
    });

    menu.querySelectorAll('a[data-nav]').forEach(function (link) {
      link.addEventListener('click', function () { closeMenu(false); });
    });

    document.addEventListener('keydown', function (e) {
      if (toggle.getAttribute('aria-expanded') !== 'true') return;

      if (e.key === 'Escape') {
        closeMenu(true);
        return;
      }

      // Basic focus trap while the mobile menu is open.
      if (e.key === 'Tab') {
        var items = focusables();
        if (!items.length) return;
        var firstEl = items[0];
        var lastEl = items[items.length - 1];
        if (e.shiftKey && document.activeElement === firstEl) {
          e.preventDefault();
          lastEl.focus();
        } else if (!e.shiftKey && document.activeElement === lastEl) {
          e.preventDefault();
          firstEl.focus();
        }
      }
    });
  }

  // Sticky header: condense/solidify once the page scrolls a little.
  if (header) {
    var onScroll = function () {
      header.classList.toggle('is-scrolled', window.scrollY > 8);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  // Scrollspy: highlight the nav link for whichever section is centered
  // in the viewport.
  var navLinks = Array.prototype.slice.call(document.querySelectorAll('a[data-nav]'));
  var sections = navLinks
    .map(function (link) {
      var id = link.getAttribute('href');
      return id && id.charAt(0) === '#' ? document.querySelector(id) : null;
    })
    .filter(Boolean);

  if ('IntersectionObserver' in window && sections.length) {
    var setActive = function (id) {
      navLinks.forEach(function (link) {
        link.classList.toggle('is-active', link.getAttribute('href') === '#' + id);
      });
    };

    var observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) setActive(entry.target.id);
        });
      },
      { rootMargin: '-45% 0px -50% 0px', threshold: 0 }
    );

    sections.forEach(function (section) {
      if (section.id) observer.observe(section);
    });
  }
};
