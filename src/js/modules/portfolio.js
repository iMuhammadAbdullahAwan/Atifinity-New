/**
 * portfolio.js — playback management for the editorial portfolio previews.
 *
 * Performance contract: every preview <video> ships with preload="none"
 * and its real file parked in [data-src] instead of [src], so nothing
 * downloads until a visitor actually shows intent — hovering it (desktop)
 * or scrolling it into a "focus" zone (mobile/touch, where there's no
 * hover to depend on). Only one preview ever plays at a time; every other
 * one already playing is paused first. Previews are also paused the
 * moment they leave the viewport entirely, so a long scroll never leaves
 * a dozen silent decoders running.
 *
 * The visible opacity crossfade (poster → video) is handled by CSS
 * (.work-preview:hover video / :focus-within / [data-playing] in
 * input.css) — this module's job is only to (a) lazily attach the real
 * src, (b) call play()/pause(), and (c) toggle [data-playing] so the CSS
 * and the play state never disagree.
 */
window.Atifinity = window.Atifinity || {};

Atifinity.initPortfolio = function initPortfolio() {
  var items = Array.prototype.slice.call(document.querySelectorAll('.work-preview'));
  if (!items.length) return;

  var isCoarsePointer = window.matchMedia('(pointer: coarse)').matches;
  var current = null;

  function ensureSrc(video) {
    if (video.dataset.src && !video.getAttribute('src')) {
      video.setAttribute('src', video.dataset.src);
      video.load();
    }
  }

  function stop(item) {
    var video = item.querySelector('video');
    if (!video) return;
    video.pause();
    item.removeAttribute('data-playing');
  }

  function start(item) {
    var video = item.querySelector('video');
    if (!video) return;
    if (current && current !== item) stop(current);
    ensureSrc(video);
    item.setAttribute('data-playing', '');
    var playPromise = video.play();
    if (playPromise && playPromise.catch) playPromise.catch(function () { /* autoplay blocked — poster stays visible */ });
    current = item;
  }

  items.forEach(function (item) {
    var video = item.querySelector('video');
    if (!video) return;

    if (!isCoarsePointer) {
      item.addEventListener('mouseenter', function () { start(item); });
      item.addEventListener('mouseleave', function () {
        stop(item);
        if (current === item) current = null;
        video.currentTime = 0;
      });
      item.addEventListener('focus', function () { start(item); }, true);
    }
  });

  // Mobile/touch: play whichever preview is most centered in the viewport,
  // pause everything else. Also doubles as the "pause when offscreen" rule
  // for desktop (a hover that scrolled away without a mouseleave, e.g. via
  // keyboard scroll, still gets cleaned up here).
  if ('IntersectionObserver' in window) {
    var observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          var item = entry.target;
          if (!entry.isIntersecting) {
            stop(item);
            if (current === item) current = null;
            return;
          }
          if (isCoarsePointer && entry.intersectionRatio > 0.6) {
            start(item);
          }
        });
      },
      { threshold: [0, 0.6] }
    );
    items.forEach(function (item) { observer.observe(item); });
  }
};

/**
 * cloneWorkStripForLoop / initWorkStrip — the "More From Our Work" row's
 * endless left-to-right drift. Both steps are the generic strip behaviour
 * in strip-loop.js, which the case-study screenshot row uses too; only
 * the element and the drift speed differ. The clone step must still run
 * before initPortfolio/initVideoModal query the DOM, so the duplicated
 * cards pick up the same hover-preview and click-to-open behaviour as the
 * originals — see the boot order in main.js.
 */
Atifinity.cloneWorkStripForLoop = function cloneWorkStripForLoop() {
  Atifinity.cloneStripForLoop(document.querySelector('.work-strip'));
};

Atifinity.initWorkStrip = function initWorkStrip() {
  Atifinity.driveStripLoop(document.querySelector('.work-strip'), { speed: 1.0, direction: 'ltr' });
};
