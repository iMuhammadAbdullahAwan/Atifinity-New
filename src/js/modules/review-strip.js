/**
 * review-strip.js
 */
window.Atifinity = window.Atifinity || {};

Atifinity.cloneReviewStripForLoop = function cloneReviewStripForLoop() {
  Atifinity.cloneStripForLoop(document.querySelector('[data-review-strip]'));
};

Atifinity.initReviewLoop = function initReviewLoop() {
  Atifinity.driveStripLoop(document.querySelector('[data-review-strip]'), { speed: 0.8, direction: 'ltr' });
};
