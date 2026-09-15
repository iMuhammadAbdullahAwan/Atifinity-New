/**
 * main.js — entry point. Waits for the DOM, then boots every module
 * registered on the shared `Atifinity` namespace (see src/js/modules/).
 * Plain <script> includes (not ES modules) are used deliberately so the
 * page still runs when opened directly from disk via file://, where
 * module imports are blocked by CORS.
 *
 * Progressive enhancement: every `Atifinity.init*` call is guarded, and
 * every module itself no-ops safely if its markup isn't present or JS
 * fails partway through — content, navigation, the services/FAQ
 * accordions, the portfolio, and every CTA are plain working HTML first,
 * with these modules layered on top rather than required underneath.
 */
(function () {
  function boot() {
    var yearEl = document.getElementById('year');
    if (yearEl) yearEl.textContent = new Date().getFullYear();

    Atifinity.initTypography && Atifinity.initTypography();
    Atifinity.initWhatsApp && Atifinity.initWhatsApp();
    Atifinity.initNav && Atifinity.initNav();
    Atifinity.initReveal && Atifinity.initReveal();
    Atifinity.initMagneticButtons && Atifinity.initMagneticButtons();
    Atifinity.initCursorGlow && Atifinity.initCursorGlow();
    Atifinity.initBackgroundMotion && Atifinity.initBackgroundMotion();
    Atifinity.initHero && Atifinity.initHero();
    Atifinity.initProcess && Atifinity.initProcess();
    Atifinity.initProcessTabs && Atifinity.initProcessTabs();
    // Both clone steps must run before the modules below query the DOM,
    // so the cloned "endless loop" items pick up the same hover-preview
    // and click-to-open behavior as the real ones.
    Atifinity.cloneWorkStripForLoop && Atifinity.cloneWorkStripForLoop();
    Atifinity.cloneCaseStripForLoop && Atifinity.cloneCaseStripForLoop();
    Atifinity.cloneReviewStripForLoop && Atifinity.cloneReviewStripForLoop();
    Atifinity.initPortfolio && Atifinity.initPortfolio();
    Atifinity.initWorkStrip && Atifinity.initWorkStrip();
    Atifinity.initCaseStrip && Atifinity.initCaseStrip();
    Atifinity.initReviewLoop && Atifinity.initReviewLoop();
    Atifinity.initVideoModal && Atifinity.initVideoModal();
    Atifinity.initImageModal && Atifinity.initImageModal();
    // Also after the clone steps: the context cursor labels every
    // [data-cursor] element it finds, and the cloned strip cards are
    // real, hoverable cards that must carry the same label as the
    // originals they duplicate.
    Atifinity.initContextCursor && Atifinity.initContextCursor();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
  } else {
    boot();
  }
})();
