/**
 * process.js — the 6-step process's connecting line fills in TOP-TO-BOTTOM
 * as the vertical timeline scrolls through view (so the journey reads as
 * continuous, not six statically-drawn rules), and each row gains
 * `.is-active` once the line has reached it — the node picks up the accent
 * fill a beat after the line passes, which is what actually sells
 * "progress" rather than the line alone.
 *
 * The line's height is set in pixels (not a CSS percentage) because its
 * container's height is content-driven ("auto") — a percentage height on
 * an absolutely positioned child doesn't resolve against an auto-height
 * containing block, so this reads the container's real rendered height
 * from getBoundingClientRect() and computes pixels directly.
 */
window.Atifinity = window.Atifinity || {};

Atifinity.initProcess = function initProcess() {
  var line = document.getElementById('processLine');
  var steps = Array.prototype.slice.call(document.querySelectorAll('.process-row'));
  if (!line || !steps.length) return;

  var track = line.closest('[data-process-track]') || line.closest('ol');
  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  if (reduceMotion) {
    line.style.height = '100%';
    steps.forEach(function (s) { s.classList.add('is-active'); });
    return;
  }

  var ticking = false;

  function update() {
    var rect = track.getBoundingClientRect();
    var vh = window.innerHeight;
    var progress = (vh - rect.top) / (rect.height + vh * 0.5);
    progress = Math.max(0, Math.min(1, progress));
    line.style.height = (progress * rect.height).toFixed(1) + 'px';

    var activeCount = Math.round(progress * steps.length);
    steps.forEach(function (step, i) {
      step.classList.toggle('is-active', i < activeCount);
    });

    ticking = false;
  }

  function onScroll() {
    if (ticking) return;
    ticking = true;
    window.requestAnimationFrame(update);
  }

  window.addEventListener('scroll', onScroll, { passive: true });
  window.addEventListener('resize', onScroll, { passive: true });
  update();
};

/**
 * initProcessTabs — the "New Channel / Existing Channel" switch above the
 * timeline. The six steps underneath are identical either way (the
 * client's process is one real system, not two) — the toggle only swaps
 * which intro sentence is shown, using the client's own FAQ wording for
 * "existing channel" rather than inventing separate copy.
 */
Atifinity.initProcessTabs = function initProcessTabs() {
  var tabs = Array.prototype.slice.call(document.querySelectorAll('[data-process-tab]'));
  if (!tabs.length) return;

  var copies = Array.prototype.slice.call(document.querySelectorAll('[data-process-copy]'));

  tabs.forEach(function (tab) {
    tab.addEventListener('click', function () {
      var target = tab.getAttribute('data-process-tab');

      tabs.forEach(function (t) {
        var active = t === tab;
        t.classList.toggle('is-active', active);
        t.setAttribute('aria-selected', String(active));
      });

      var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
      copies.forEach(function (copy) {
        var isTarget = copy.getAttribute('data-process-copy') === target;
        copy.classList.toggle('hidden', !isTarget);
        if (!isTarget || reduceMotion) return;
        // Ease the incoming sentence in from its 'from' state. The
        // reflow read is what forces that state to be painted before
        // it is released, otherwise the browser coalesces both class
        // changes into one frame and no transition runs at all.
        copy.classList.add('is-entering');
        void copy.offsetWidth;
        copy.classList.remove('is-entering');
      });
    });
  });
};
