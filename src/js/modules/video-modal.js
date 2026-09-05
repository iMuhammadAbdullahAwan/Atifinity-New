/**
 * video-modal.js — accessible lightbox player for the full-length portfolio
 * videos. Opens with sound and full controls; closes via the close button,
 * a backdrop click, or Escape. Focus is moved into the modal on open and
 * trapped there, and returned to whichever trigger opened it on close, so
 * keyboard users never lose their place on the page.
 */
window.Atifinity = window.Atifinity || {};

Atifinity.initVideoModal = function initVideoModal() {
  var modal = document.getElementById('videoModal');
  if (!modal) return;

  var modalVideo = document.getElementById('modalVideo');
  var modalTitle = document.getElementById('modalVideoTitle');
  var closeBtn = document.getElementById('closeVideoModal');
  var backdrop = document.getElementById('modalBackdrop');
  var triggers = document.querySelectorAll('[data-video-modal]');
  var lastTrigger = null;

  function focusables() {
    return Array.prototype.slice.call(
      modal.querySelectorAll('a[href], button:not([disabled]), video[controls]')
    );
  }

  function openModal(src, title, trigger) {
    if (!modalVideo) return;
    lastTrigger = trigger || null;

    // Pause every portfolio preview so nothing plays behind the modal.
    document.querySelectorAll('.work-preview video').forEach(function (v) { v.pause(); });

    modalVideo.src = src;
    if (modalTitle) modalTitle.textContent = title || 'Project Video';

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
    // Drives the panel/backdrop entrance in CSS — the panel settles up
    // out of a slight under-scale as the backdrop fades in.
    // Fallback alongside the frame callback: the panel is parked at
    // opacity 0 until this attribute lands, so if frames are being
    // withheld the dialog would trap focus in something invisible.
    // Setting it twice is harmless.
    window.requestAnimationFrame(function () {
      modal.setAttribute('data-modal-open', '');
    });
    window.setTimeout(function () {
      modal.setAttribute('data-modal-open', '');
    }, 120);

    window.setTimeout(function () {
      var playPromise = modalVideo.play();
      if (playPromise && playPromise.catch) playPromise.catch(function () { /* controls remain available */ });
      if (closeBtn) closeBtn.focus();
    }, 50);
  }

  function closeModal() {
    if (modal.classList.contains('hidden')) return;
    modal.removeAttribute('data-modal-open');
    if (modalVideo) {
      modalVideo.pause();
      modalVideo.currentTime = 0;
      modalVideo.removeAttribute('src');
      modalVideo.load();
    }
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = '';
    if (lastTrigger) lastTrigger.focus();
    lastTrigger = null;
  }

  triggers.forEach(function (trigger) {
    trigger.addEventListener('click', function (e) {
      e.preventDefault();
      var src = trigger.getAttribute('data-video-modal');
      var title = trigger.getAttribute('data-video-title') || 'Project Video';
      if (src) openModal(src, title, trigger);
    });
  });

  if (closeBtn) closeBtn.addEventListener('click', closeModal);
  if (backdrop) backdrop.addEventListener('click', closeModal);

  window.addEventListener('keydown', function (e) {
    if (modal.classList.contains('hidden')) return;

    if (e.key === 'Escape') {
      closeModal();
      return;
    }

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
};
