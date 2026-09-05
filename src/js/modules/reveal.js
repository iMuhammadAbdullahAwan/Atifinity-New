/**
 * reveal.js — scroll-triggered entrance for any element marked
 * [data-reveal], with a small vocabulary of mechanisms rather than one
 * repeated effect.
 *
 * Variants (set as the attribute's value, e.g. data-reveal="lift"):
 *   rise   (default)  24px fade-up — the quiet workhorse
 *   lift              38px + slight under-scale — section openings
 *   slide             44px from the left — horizontal layouts
 *   slide-right       44px from the right — the mirror of slide, so two
 *                     horizontal strips on one page can arrive from
 *                     opposite edges instead of both from the same side
 *   drop              22px from above — for content that hangs off the
 *                     top of its own space (a stat row under a heading)
 *   pop               20px + scale(0.9) — the one reveal with real scale
 *                     in it; an element expanding into place rather than
 *                     sliding. Reserved for cards, never full-width blocks
 *   clip              wipes in from a slight over-scale — imagery
 *   stagger           children arrive in sequence — grids and lists.
 *                     data-reveal-child picks the children's mechanism
 *                     (default "rise"), so a grid of cards can stagger
 *                     with "pop" while a list of rows staggers quietly.
 *
 * The point is cadence. Seventeen identical fade-ups train the reader to
 * stop noticing; alternating the mechanism keeps each section's arrival
 * legible as its own event while every variant stays inside one duration
 * family and one curve, so the page still reads as a single system.
 *
 * Two rules hold regardless of variant:
 *   - Anything already on screen at load is shown immediately, never
 *     animated. It is the first thing a visitor sees; hiding it and
 *     fading it back in only delays the page looking finished.
 *   - The hidden state is applied from JS, not CSS, so with JS disabled
 *     or broken every element simply renders visible.
 */
window.Atifinity = window.Atifinity || {};

Atifinity.initReveal = function initReveal() {
  var items = Array.prototype.slice.call(document.querySelectorAll('[data-reveal]'));
  if (!items.length) return;

  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var viewportHeight = window.innerHeight || document.documentElement.clientHeight;

  var DURATION = 700;
  var EASE = 'cubic-bezier(0.16, 1, 0.3, 1)';
  var STAGGER_STEP = 90; // ms between children of a "stagger" group

  /**
   * Hands an element back to the stylesheet once it has finished
   * arriving. This matters: priming writes an inline transition, and an
   * inline transition outranks every transition the component defines
   * for itself. Leaving it in place permanently replaced the hover
   * transitions on everything revealed this way — the service cards
   * animate opacity/transform on reveal, then have to go back to
   * animating their own border and background on hover.
   */
  function release(el, delay) {
    window.setTimeout(function () {
      el.style.transition = '';
      el.style.transitionDelay = '';
    }, DURATION + delay + 60);
  }

  function show(el) {
    el.setAttribute('data-reveal-state', 'shown');
    var delay = parseInt(el.getAttribute('data-reveal-delay'), 10) || 0;
    var kids = el.__revealKids;
    if (kids) {
      kids.forEach(function (kid, i) {
        kid.setAttribute('data-reveal-state', 'shown');
        release(kid, delay + i * STAGGER_STEP);
      });
    }
    release(el, delay);
  }

  function prime(el) {
    var variant = el.getAttribute('data-reveal') || 'rise';
    el.setAttribute('data-reveal-variant', variant);
    el.setAttribute('data-reveal-state', 'hidden');

    var delay = parseInt(el.getAttribute('data-reveal-delay'), 10) || 0;

    if (variant === 'stagger') {
      // The container itself only fades; its children carry the travel,
      // each one a step behind the last.
      var kids = Array.prototype.slice.call(el.children);
      var childVariant = el.getAttribute('data-reveal-child') || 'rise';
      el.__revealKids = kids;
      kids.forEach(function (kid, i) {
        kid.setAttribute('data-reveal-variant', childVariant);
        kid.setAttribute('data-reveal-state', 'hidden');
        kid.style.transition =
          'opacity ' + DURATION + 'ms ' + EASE + ', transform ' + DURATION + 'ms ' + EASE;
        kid.style.transitionDelay = (delay + i * STAGGER_STEP) + 'ms';
      });
      el.style.transition = 'opacity ' + DURATION + 'ms ' + EASE;
      el.style.transitionDelay = delay + 'ms';
      return;
    }

    el.style.transition =
      'opacity ' + DURATION + 'ms ' + EASE +
      ', transform ' + DURATION + 'ms ' + EASE +
      ', clip-path ' + DURATION + 'ms ' + EASE;
    el.style.transitionDelay = delay + 'ms';
  }

  var offscreen = [];
  items.forEach(function (el) {
    var rect = el.getBoundingClientRect();
    var alreadyVisible = rect.top < viewportHeight && rect.bottom > 0;
    if (alreadyVisible || reduceMotion) {
      el.setAttribute('data-reveal-state', 'shown');
      return;
    }
    prime(el);
    offscreen.push(el);
  });

  if (!offscreen.length) return;

  if (!('IntersectionObserver' in window)) {
    offscreen.forEach(show);
    return;
  }

  var pending = offscreen.slice();

  function settle(el) {
    var i = pending.indexOf(el);
    if (i === -1) return; // already shown
    pending.splice(i, 1);
    show(el);
    observer.unobserve(el);
    if (!pending.length) window.removeEventListener('scroll', sweep);
  }

  var observer = new IntersectionObserver(
    function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) settle(entry.target);
      });
    },
    { threshold: 0.15, rootMargin: '0px 0px -60px 0px' }
  );

  offscreen.forEach(function (el) { observer.observe(el); });

  /**
   * Safety net. Priming parks an element at opacity 0, so anything the
   * observer fails to report stays invisible — a blank section is a far
   * worse outcome than a missed animation. Observer callbacks can be
   * deferred or dropped (background/throttled tabs are the common case),
   * so a cheap rect check on scroll shows anything that is demonstrably
   * on screen. It unsubscribes itself once every element has arrived,
   * and settle() is idempotent so the two paths can never double-fire.
   */
  var lastSweep = 0;
  function sweep() {
    // Throttled on the clock rather than on an animation frame. The
    // whole point of this path is to cover the case where the frame
    // pipeline is not running (a throttled or background tab starves
    // rAF exactly as it starves the observer), so a rAF-based throttle
    // would fail in precisely the situation it exists to rescue.
    var now = Date.now();
    if (now - lastSweep < 120) return;
    lastSweep = now;
    var vh = window.innerHeight || document.documentElement.clientHeight;
    pending.slice().forEach(function (el) {
      var r = el.getBoundingClientRect();
      if (r.top < vh && r.bottom > 0) settle(el);
    });
  }
  window.addEventListener('scroll', sweep, { passive: true });
};
