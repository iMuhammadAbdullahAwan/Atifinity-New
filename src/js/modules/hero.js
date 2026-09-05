/**
 * hero.js — the hero's signature entrance and its stat count-up.
 *
 * Entrance: adds [data-hero-ready] to #hero on the next animation frame
 * after load, which is the single switch every hero CSS transition in
 * input.css keys off — each [data-hero-in] element's staggered fade-up,
 * with stagger order/timing controlled per-element via inline
 * transition-delay set below, keeping all the timing numbers in one place
 * instead of scattered across the CSS. One rAF tick is enough to guarantee
 * the browser has painted the pre-animation state first, so the transition
 * actually runs instead of snapping straight to the end state.
 *
 * Respects prefers-reduced-motion: the entrance CSS collapses to an
 * instant, fully-visible state (see the reduced-motion block in
 * input.css), and the count-up jumps straight to its final value.
 */
window.Atifinity = window.Atifinity || {};

/**
 * splitHeadlineIntoLines — wraps each *rendered* line of an element in a
 * clipping box so the lines can rise out independently.
 *
 * Lines are measured, not guessed: every word is wrapped, its top offset
 * read, and words sharing a top belong to the same visual line. That
 * matters because the headline is fluid (clamp), so where it breaks
 * depends entirely on the viewport — hard-coding the line breaks would be
 * wrong at almost every width.
 *
 * Each word carries its source element's class through the rebuild, so
 * styled fragments inside the headline keep their styling.
 *
 * Returns the number of lines, or 0 if it declined to split (no support,
 * nothing to measure). On 0 the caller simply keeps the plain fade-up —
 * the headline is never left in a broken half-state.
 */
function splitHeadlineIntoLines(el) {
  if (!el || !window.getComputedStyle) return 0;

  // Collect [word, ownerClassName] in document order.
  var words = [];
  var walker = document.createTreeWalker(el, NodeFilter.SHOW_TEXT, null);
  var node;
  while ((node = walker.nextNode())) {
    var owner = node.parentElement === el ? null : node.parentElement;
    var cls = owner ? owner.getAttribute('class') || '' : '';
    node.nodeValue.split(/(\s+)/).forEach(function (chunk) {
      if (chunk.trim()) words.push({ text: chunk, cls: cls });
    });
  }
  if (words.length < 2) return 0;

  // Rebuild as individually measurable spans.
  var probe = document.createDocumentFragment();
  var spans = [];
  words.forEach(function (w, i) {
    var s = document.createElement('span');
    s.textContent = w.text;
    if (w.cls) s.setAttribute('class', w.cls);
    probe.appendChild(s);
    spans.push(s);
    if (i < words.length - 1) probe.appendChild(document.createTextNode(' '));
  });

  var original = el.innerHTML;
  el.innerHTML = '';
  el.appendChild(probe);

  // Group by rendered top edge. Rounding absorbs sub-pixel differences
  // between glyphs on the same line.
  var lines = [];
  var lastTop = null;
  spans.forEach(function (s, i) {
    var top = Math.round(s.getBoundingClientRect().top);
    if (lastTop === null || Math.abs(top - lastTop) > 2) {
      lines.push([]);
      lastTop = top;
    }
    lines[lines.length - 1].push(words[i]);
  });

  if (!lines.length) {
    el.innerHTML = original;
    return 0;
  }

  // Emit the final masked structure.
  el.innerHTML = '';
  lines.forEach(function (line, lineIndex) {
    var mask = document.createElement('span');
    mask.className = 'line-mask';
    var inner = document.createElement('span');
    inner.className = 'line-inner';
    line.forEach(function (w, i) {
      if (w.cls) {
        var s = document.createElement('span');
        s.setAttribute('class', w.cls);
        s.textContent = w.text;
        inner.appendChild(s);
      } else {
        inner.appendChild(document.createTextNode(w.text));
      }
      if (i < line.length - 1) inner.appendChild(document.createTextNode(' '));
    });
    // Keep a word gap between lines. The masks are block-level so the
    // break is visual, but without this the serialised text runs the
    // last word of one line into the first of the next, and a screen
    // reader announces "YouTubeGrowth".
    if (lineIndex < lines.length - 1) inner.appendChild(document.createTextNode(' '));
    mask.appendChild(inner);
    el.appendChild(mask);
  });

  return lines.length;
}

Atifinity.initHero = function initHero() {
  var hero = document.getElementById('hero');
  if (!hero) return;

  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // ---- Headline line-mask reveal ----------------------------------------
  // Runs before the stagger delays are assigned below, so the line
  // delays can be woven into the same timeline rather than running as a
  // separate animation on top of it.
  var headline = hero.querySelector('[data-hero-headline]');
  if (headline && !reduceMotion) {
    var baseDelay = parseInt(headline.getAttribute('data-hero-in'), 10) || 0;
    var lineCount = splitHeadlineIntoLines(headline);
    if (lineCount) {
      // The headline no longer fades as one block — its lines do the
      // work, so the wrapper's own entrance is switched off to avoid
      // animating the same thing twice.
      headline.removeAttribute('data-hero-in');
      headline.style.opacity = '1';
      headline.style.transform = 'none';
      Array.prototype.slice.call(headline.querySelectorAll('.line-inner')).forEach(function (inner, i) {
        inner.style.transitionDelay = (baseDelay + i * 90) + 'ms';
      });
    }
  }

  // ---- Entrance stagger -------------------------------------------------
  var staggerItems = Array.prototype.slice.call(hero.querySelectorAll('[data-hero-in]'));
  staggerItems.forEach(function (el, i) {
    if (reduceMotion) return;
    var step = parseInt(el.getAttribute('data-hero-in'), 10);
    var delay = Number.isFinite(step) ? step : i * 120;
    el.style.transitionDelay = delay + 'ms';
  });

  function markReady() { hero.setAttribute('data-hero-ready', ''); }

  window.requestAnimationFrame(function () {
    window.requestAnimationFrame(markReady);
  });
  // Safety net: a page opened in a BACKGROUND tab gets its animation
  // frames throttled or withheld entirely, and every hero element is
  // parked at opacity 0 waiting on this one attribute. Without a
  // timer fallback the hero can sit blank until the tab is focused.
  // Setting the attribute twice is harmless.
  window.setTimeout(markReady, 400);

  // ---- Stat count-up -----------------------------------------------------
  // The reference site's own stat row is static text. This counts each
  // number up from 0 once the row has faded in (matching its own
  // [data-hero-in] stagger delay so the motion reads as one continuous
  // entrance, not two unrelated animations), eased out so it settles
  // rather than ticking at a constant rate.
  var counters = Array.prototype.slice.call(hero.querySelectorAll('[data-count-to]'));
  if (!counters.length) return;

  if (reduceMotion) {
    counters.forEach(function (el) {
      el.textContent = el.getAttribute('data-count-to');
    });
    return;
  }

  var statRow = hero.querySelector('.stat-row');
  var startDelay = statRow ? parseInt(statRow.getAttribute('data-hero-in'), 10) || 0 : 0;
  var DURATION = 900;

  window.setTimeout(function () {
    counters.forEach(function (el) {
      var target = parseInt(el.getAttribute('data-count-to'), 10) || 0;
      var start = null;

      function tick(timestamp) {
        if (start === null) start = timestamp;
        var progress = Math.min((timestamp - start) / DURATION, 1);
        var eased = 1 - Math.pow(1 - progress, 3); // ease-out-cubic
        el.textContent = String(Math.round(eased * target));
        if (progress < 1) window.requestAnimationFrame(tick);
      }

      window.requestAnimationFrame(tick);
    });
  }, startDelay);
};
