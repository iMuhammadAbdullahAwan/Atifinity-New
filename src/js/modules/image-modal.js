/**
 * image-modal.js — the case-study lightbox.
 *
 * The screenshots are the proof on this page, and in the drifting strip
 * they are capped to a height that fits the layout; opening one full size
 * is how a visitor actually reads the numbers on it.
 *
 * Signature behaviour: the picture EXPANDS from the thumbnail that was
 * clicked rather than cutting in at full size. That is a FLIP — measure
 * the thumbnail (First), open the modal and measure the final image
 * (Last), apply the difference as an Invert transform, then Play it back
 * to identity. The reader's eye stays on the same object the whole way,
 * which is the difference between "a dialog appeared" and "the thing I
 * clicked got bigger".
 *
 * Interaction contract, unchanged from the video lightbox: closes via the
 * close button, a backdrop click, or Escape; focus moves into the dialog,
 * is trapped there, and returns to the trigger; page scroll locks while
 * open. The image is only pointed at its source on open and released on
 * close, so full-size copies never load for someone who doesn't open one.
 */
window.Atifinity = window.Atifinity || {};

Atifinity.initImageModal = function initImageModal() {
  var modal = document.getElementById('imageModal');
  if (!modal) return;

  var modalImage = document.getElementById('modalImage');
  var modalCaption = document.getElementById('modalImageCaption');
  var closeBtn = document.getElementById('closeImageModal');
  var backdrop = document.getElementById('imageModalBackdrop');
  var triggers = document.querySelectorAll('[data-image-modal]');
  var lastTrigger = null;

  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  function focusables() {
    return Array.prototype.slice.call(
      modal.querySelectorAll('a[href], button:not([disabled])')
    );
  }

  /**
   * Runs the FLIP once the modal image has real layout. Bails silently if
   * anything is missing or degenerate — a missed expansion is invisible,
   * a divide-by-zero is not.
   */
  function expandFrom(fromRect) {
    if (!fromRect || reduceMotion) return;
    var to = modalImage.getBoundingClientRect();
    if (!to.width || !to.height || !fromRect.width || !fromRect.height) return;

    var scaleX = fromRect.width / to.width;
    var scaleY = fromRect.height / to.height;
    var dx = (fromRect.left + fromRect.width / 2) - (to.left + to.width / 2);
    var dy = (fromRect.top + fromRect.height / 2) - (to.top + to.height / 2);

    modalImage.style.transformOrigin = 'center center';
    modalImage.style.transition = 'none';
    modalImage.style.transform =
      'translate(' + dx + 'px,' + dy + 'px) scale(' + scaleX + ',' + scaleY + ')';

    // One frame at the inverted position, then release to identity.
    window.requestAnimationFrame(function () {
      window.requestAnimationFrame(function () {
        modalImage.style.transition = 'transform 520ms cubic-bezier(0.16, 1, 0.3, 1)';
        modalImage.style.transform = 'none';
      });
    });
  }

  function clearFlip() {
    modalImage.style.transition = '';
    modalImage.style.transform = '';
    modalImage.style.transformOrigin = '';
  }

  function openModal(src, alt, caption, trigger) {
    if (!modalImage) return;
    lastTrigger = trigger || null;

    // Measured BEFORE the modal takes over the screen.
    var sourceImg = trigger ? trigger.querySelector('img') : null;
    var fromRect = sourceImg ? sourceImg.getBoundingClientRect() : null;

    modalImage.setAttribute('src', src);
    modalImage.setAttribute('alt', alt || '');
    if (modalCaption) modalCaption.textContent = caption || '';

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
    // Drives the panel/backdrop entrance in CSS.
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

    if (modalImage.complete && modalImage.naturalWidth) {
      window.requestAnimationFrame(function () { expandFrom(fromRect); });
    } else {
      modalImage.addEventListener('load', function onLoad() {
        modalImage.removeEventListener('load', onLoad);
        expandFrom(fromRect);
      });
    }

    if (closeBtn) closeBtn.focus();
  }

  function closeModal() {
    if (modal.classList.contains('hidden')) return;
    modal.removeAttribute('data-modal-open');
    clearFlip();
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = '';
    if (modalImage) {
      modalImage.removeAttribute('src');
      modalImage.setAttribute('alt', '');
    }
    if (lastTrigger) lastTrigger.focus();
    lastTrigger = null;
  }

  triggers.forEach(function (trigger) {
    trigger.addEventListener('click', function (e) {
      e.preventDefault();
      var src = trigger.getAttribute('data-image-modal');
      var alt = trigger.getAttribute('data-image-alt') || '';
      var caption = trigger.getAttribute('data-image-caption') || '';
      if (src) openModal(src, alt, caption, trigger);
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
