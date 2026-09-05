/**
 * case-studies.js — the "Real Strategy. Real Execution. Measurable
 * Growth." proof row. The real client screenshots drift past endlessly
 * on their own, and any of them can be clicked to open full-size.
 *
 * The drift is the shared behaviour from strip-loop.js, run slower than
 * the portfolio row: these are dense dashboard screenshots with real
 * numbers on them, so they need longer in front of the eye to be read at
 * all. The row still stops the moment it's hovered, focused or touched,
 * so nothing ever slides away from someone actually reading it.
 *
 * cloneCaseStripForLoop must run before initImageModal binds its click
 * handlers, so the duplicated figures open the lightbox exactly like the
 * originals — see the boot order in main.js.
 */
window.Atifinity = window.Atifinity || {};

Atifinity.cloneCaseStripForLoop = function cloneCaseStripForLoop() {
  Atifinity.cloneStripForLoop(document.querySelector('.case-strip'));
};

Atifinity.initCaseStrip = function initCaseStrip() {
  Atifinity.driveStripLoop(document.querySelector('.case-strip'), { speed: 0.7, direction: 'rtl' });
};
