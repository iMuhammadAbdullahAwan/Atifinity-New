/**
 * strip-loop.js — the shared "endless horizontal drift" behaviour behind
 * every looping strip on the page (the portfolio's "More From Our Work"
 * row and the case-study screenshot row). Both want exactly the same
 * thing, and the wrap math is subtle enough that keeping two copies of it
 * would mean fixing every future bug twice, so it lives here once and
 * each strip supplies only its own element and speed.
 *
 * Two steps, in this order:
 *
 *   cloneStripForLoop(strip)  duplicates the strip's content so there is
 *                             always a second, identical set to slide in
 *                             behind the first.
 *   driveStripLoop(strip)     drives the actual scroll every frame.
 *
 * The clone step has to run before anything else queries the strip's
 * contents (hover previews, modal triggers), so the duplicated items pick
 * up the same behaviour as the originals — see the boot order in main.js.
 */
window.Atifinity = window.Atifinity || {};

/**
 * Appends an accessibility-hidden copy of every child, and records the
 * width of one full set on the element as [data-loop-width] — that width
 * is exactly the distance a seamless wrap needs to jump.
 *
 * The clones are marked aria-hidden and pulled out of the tab order (the
 * clone itself *and* any focusable control inside it): a keyboard or
 * screen-reader user gets exactly one clean pass through the real items,
 * always first in the DOM. Only sighted mouse users ever see the
 * duplicate, and only as part of the looping motion.
 *
 * Returns false when looping isn't possible or wanted (no element, too
 * few items, reduced motion), so callers can skip driving it.
 */
Atifinity.cloneStripForLoop = function cloneStripForLoop(strip) {
  if (!strip) return false;
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return false;

  var originals = Array.prototype.slice.call(strip.children);
  if (originals.length < 2) return false;

  var firstRect = originals[0].getBoundingClientRect();
  var lastRect = originals[originals.length - 1].getBoundingClientRect();
  var gap = parseFloat(getComputedStyle(strip).columnGap) || 0;
  // Width of one full set, including the trailing gap to what comes next.
  var setWidth = (lastRect.right - firstRect.left) + gap;
  if (!setWidth) return false;

  for (var setIdx = 0; setIdx < 4; setIdx++) {
    originals.forEach(function (item) {
      var clone = item.cloneNode(true);
      clone.setAttribute('aria-hidden', 'true');
      clone.setAttribute('tabindex', '-1');
      clone.querySelectorAll('a[href], button, [tabindex]').forEach(function (el) {
        el.setAttribute('tabindex', '-1');
      });
      strip.appendChild(clone);
    });
  }

  strip.dataset.loopWidth = String(setWidth);
  return true;
};

/**
 * Drifts the strip left-to-right (content slides rightward; new items
 * enter from the left edge) at a slow constant speed, endlessly.
 * cloneStripForLoop above doubled the content, so wrapping means jumping
 * scrollLeft forward by exactly one set's width, landing on pixel-
 * identical content - it reads as no jump at all, rather than a visible
 * snap back to the start.
 *
 * Unlike a CSS keyframe marquee this drives the strip's real scrollLeft,
 * so it stays a genuine, resumable scroll position rather than a looping
 * transform - that's what lets it coexist with manual drag/swipe/scroll
 * instead of fighting it (the reference site's own marquee could not be
 * paused or usefully interacted with; this one always can). Auto-scroll
 * pauses on hover, focus-within, or touch, and resumes after a short idle.
 *
 * options.speed        px per frame (default 0.6 - roughly 36px/s at 60fps)
 * options.resumeDelay  ms of no interaction before drifting resumes
 */
Atifinity.driveStripLoop = function driveStripLoop(strip, options) {
  if (!strip) return;
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  var loopWidth = parseFloat(strip.dataset.loopWidth || '0');
  if (!loopWidth) return;

  var opts = options || {};
  var SPEED = opts.speed || 0.6;
  var RESUME_DELAY = opts.resumeDelay || 1600;
  var DIRECTION = opts.direction || 'ltr';

  var paused = false;
  var resumeTimer = null;
  var raf = null;
  // scrollLeft is an integer pixel property - accumulating a sub-pixel
  // SPEED directly into it rounds back to the same value every frame and
  // never actually moves. Tracking the true (fractional) position
  // separately and only writing the rounded result to scrollLeft is what
  // makes a sub-1px-per-frame drift work at all.
  // We have 5 sets total. Start in the exact middle set (Set 3, index 2)
  var position = loopWidth * 2;
  strip.scrollLeft = position;
  var scriptScrollPos = position;

  strip.style.scrollBehavior = 'auto';

  function tick() {
    if (!paused) {
      strip.style.scrollSnapType = 'none';
      
      // When auto-drift resumes, ensure we fold back into the middle sets
      // invisibly, so the user always has massive manual scroll room.
      while (position < loopWidth * 1.5) position += loopWidth;
      while (position > loopWidth * 3.5) position -= loopWidth;

      if (DIRECTION === 'rtl') {
        position += SPEED;
      } else {
        position -= SPEED;
      }
      
      strip.scrollLeft = position;
      scriptScrollPos = strip.scrollLeft;
    } else {
      strip.style.scrollSnapType = 'x mandatory';
      position = strip.scrollLeft;
    }
    raf = window.requestAnimationFrame(tick);
  }

  function pause() {
    paused = true;
    if (resumeTimer) window.clearTimeout(resumeTimer);
  }

  function scheduleResume() {
    if (resumeTimer) window.clearTimeout(resumeTimer);
    resumeTimer = window.setTimeout(function () { paused = false; }, RESUME_DELAY);
  }

  // Don't drift a strip nobody can see. Both strips previously ran their
  // rAF loop for the whole life of the page regardless of scroll
  // position, which is two continuous animation loops burning frames for
  // sections that are often thousands of pixels away.
  if ('IntersectionObserver' in window) {
    var offscreen = false;
    new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        offscreen = !entry.isIntersecting;
        if (offscreen) {
          if (raf) window.cancelAnimationFrame(raf);
          raf = null;
        } else if (!raf) {
          raf = window.requestAnimationFrame(tick);
        }
      });
    }, { threshold: 0 }).observe(strip);
  }

  ['mouseenter', 'focusin', 'touchstart', 'pointerdown'].forEach(function (evt) {
    strip.addEventListener(evt, pause, { passive: true });
  });
  ['mouseleave', 'focusout', 'touchend', 'wheel'].forEach(function (evt) {
    strip.addEventListener(evt, scheduleResume, { passive: true });
  });
  // A manual scroll (wheel, drag, keyboard) also counts as interaction -
  // keep pausing/rescheduling for as long as scrollLeft keeps changing.
  strip.addEventListener('scroll', function () { 
    if (strip.scrollLeft !== scriptScrollPos) {
      pause(); 
      scheduleResume(); 
    }
  }, { passive: true });

  raf = window.requestAnimationFrame(tick);
};
