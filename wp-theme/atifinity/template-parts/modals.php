<!-- ================= VIDEO PLAYER LIGHTBOX MODAL ================= -->
<div id="videoModal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 sm:p-6 lg:p-8" role="dialog" aria-modal="true" aria-label="Video player">
  <div id="modalBackdrop" class="modal-backdrop fixed inset-0 bg-black/30 backdrop-blur-xl transition-opacity cursor-pointer"></div>

  <div class="modal-panel relative z-10 flex w-full max-w-5xl items-center justify-center group">
    <button id="closeVideoModal" type="button" class="absolute right-4 top-4 z-20 inline-flex h-10 w-10 items-center justify-center rounded-full bg-black/60 text-white transition-colors hover:bg-primary focus:outline-none focus:ring-2 focus:ring-primary opacity-0 group-hover:opacity-100" aria-label="Close video player">
      <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>
    <div class="relative aspect-video w-full overflow-hidden rounded-xl bg-black shadow-2xl">
      <video id="modalVideo" class="h-full w-full object-contain" controls preload="auto" playsinline></video>
    </div>
  </div>
</div>

<!-- ================= CASE-STUDY IMAGE LIGHTBOX MODAL =================
     Opens a case-study screenshot at full size so the real numbers on it
     are readable. #modalImage carries no src until image-modal.js sets
     one on open, so the full-size files never download for a visitor who
     doesn't open one. -->
<div id="imageModal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 sm:p-6 lg:p-8" role="dialog" aria-modal="true" aria-label="Image viewer">
  <div id="imageModalBackdrop" class="modal-backdrop fixed inset-0 bg-black/30 backdrop-blur-xl transition-opacity cursor-pointer"></div>
  
  <div class="modal-panel relative z-10 flex max-h-full max-w-full items-center justify-center group">
    <button id="closeImageModal" type="button" class="absolute right-4 top-4 z-20 inline-flex h-10 w-10 items-center justify-center rounded-full bg-black/60 text-white transition-colors hover:bg-primary focus:outline-none focus:ring-2 focus:ring-primary opacity-0 group-hover:opacity-100" aria-label="Close image viewer">
      <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>
    <img id="modalImage" class="max-h-[90vh] w-auto max-w-full rounded-md shadow-2xl object-contain" alt="" />
  </div>
</div>
