/**
 * context-cursor.js — a small label that follows the pointer over media
 * and names what a click will do: PLAY over a film, VIEW over a
 * case-study screenshot.
 *
 * This is the one place the site talks back to the pointer directly, and
 * it is deliberately narrow in scope: it appears only over elements that
 * declare [data-cursor], it never replaces the real cursor anywhere else,
 * and it stays small. A large custom cursor following every movement is
 * the fastest way to make a site feel like a template demo.
 *
 * It is strictly additive. Every element it labels is already a real
 * <button> with its own accessible name, so a keyboard or screen-reader
 * user loses nothing by never seeing it. Skipped entirely on coarse
 * pointers (there is no cursor to decorate) and under reduced motion.
 *
 * Position writes are collapsed into one animation frame, and the label
 * is moved with translate3d only — no layout property is ever touched.
 */
window.Atifinity = window.Atifinity || {};

Atifinity.initContextCursor = function initContextCursor() {
  var cursor = document.getElementById('contextCursor');
  if (!cursor) return;

  var isCoarsePointer = window.matchMedia('(pointer: coarse)').matches;
  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (isCoarsePointer || reduceMotion) return;

  var targets = Array.prototype.slice.call(document.querySelectorAll('[data-cursor]'));
  if (!targets.length) return;

  var raf = null;
  var x = 0;
  var y = 0;
  var active = false;

  function render() {
    cursor.style.transform =
      'translate3d(' + x + 'px,' + y + 'px,0) translate(-50%,-50%) scale(' + (active ? 1 : 0.72) + ')';
    raf = null;
  }

  function queue() {
    if (!raf) raf = window.requestAnimationFrame(render);
  }

  window.addEventListener('pointermove', function (e) {
    x = e.clientX;
    y = e.clientY;
    if (active) queue();
  }, { passive: true });

  targets.forEach(function (target) {
    target.addEventListener('pointerenter', function (e) {
      var label = target.getAttribute('data-cursor') || 'View';
      cursor.textContent = label;
      cursor.setAttribute('data-label', label);
      cursor.setAttribute('data-active', '');
      active = true;
      x = e.clientX;
      y = e.clientY;
      queue();
    });

    target.addEventListener('pointerleave', function () {
      cursor.removeAttribute('data-active');
      active = false;
      queue();
    });
  });

  // A click that navigates or opens a dialog leaves the pointer over an
  // element that no longer exists under it; clear rather than strand the
  // label on screen.
  window.addEventListener('blur', function () {
    cursor.removeAttribute('data-active');
    active = false;
  });
};
