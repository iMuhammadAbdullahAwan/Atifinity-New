<!-- ================= FOOTER ================= -->
<footer class="relative border-t border-ink/10">
  <div class="container-x py-14">
    <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-[1.5fr_1fr_1fr_1.2fr]">
      <div>
        <a href="<?php echo home_url(); ?>" class="inline-flex text-ink" aria-label="Atifinity home">
          <svg viewBox="0 0 172 40" width="150" height="34" class="h-7 w-auto" role="img" aria-hidden="true">
            <path d="M20,4 L4,35 L12,35 L25,14 Z" fill="#E32227"/>
            <path d="M27.5,16 L36,35 L28.5,35 L22,22 Z" fill="#1E3CFF"/>
            <path d="M18,28 L25,28 L27,35 L13.5,35 Z" fill="#1E3CFF"/>
            <text x="48" y="27" font-family="Archivo, sans-serif" font-size="19" font-weight="700" letter-spacing="0.01em" fill="currentColor">atifinity</text>
          </svg>
        </a>
        <p class="mt-4 max-w-xs text-small text-ink-muted">Creative. Connected. Limitless.</p>
        <p class="mt-6 font-mono text-[10px] uppercase tracking-[0.18em] text-ink-muted/70">YouTube Growth &amp; Automation</p>
      </div>

      <nav aria-label="Quick links">
        <h3 class="font-mono text-[11px] font-semibold uppercase tracking-wider text-ink">Quick Links</h3>
        <ul class="mt-4 space-y-2.5 text-small text-ink-muted">
          <li><a href="<?php echo is_front_page() ? '#services' : home_url('#services'); ?>" class="hover:text-ink">Services</a></li>
          <li><a href="<?php echo is_front_page() ? '#work' : home_url('#work'); ?>" class="hover:text-ink">Work</a></li>
          <li><a href="<?php echo is_front_page() ? '#process' : home_url('#process'); ?>" class="hover:text-ink">Process</a></li>
          <li><a href="<?php echo is_front_page() ? '#pricing' : home_url('#pricing'); ?>" class="hover:text-ink">Pricing</a></li>
          <li><a href="<?php echo is_front_page() ? '#faq' : home_url('#faq'); ?>" class="hover:text-ink">FAQ</a></li>
          <li><a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="hover:text-ink">Blog</a></li>
        </ul>
      </nav>

      <nav aria-label="Services">
        <h3 class="font-mono text-[11px] font-semibold uppercase tracking-wider text-ink">Services</h3>
        <ul class="mt-4 space-y-2.5 text-small text-ink-muted">
          <li><a href="<?php echo is_front_page() ? '#services' : home_url('#services'); ?>" class="hover:text-ink">Niche Strategy &amp; Research</a></li>
          <li><a href="<?php echo is_front_page() ? '#services' : home_url('#services'); ?>" class="hover:text-ink">Scriptwriting &amp; Voiceover</a></li>
          <li><a href="<?php echo is_front_page() ? '#services' : home_url('#services'); ?>" class="hover:text-ink">Video Production</a></li>
          <li><a href="<?php echo is_front_page() ? '#services' : home_url('#services'); ?>" class="hover:text-ink">Thumbnails &amp; SEO</a></li>
          <li><a href="<?php echo is_front_page() ? '#services' : home_url('#services'); ?>" class="hover:text-ink">Channel Management</a></li>
        </ul>
      </nav>

      <div>
        <h3 class="font-mono text-[11px] font-semibold uppercase tracking-wider text-ink">Let's Connect</h3>
        <a href="mailto:hello@atifinity.studio" class="mt-4 block text-small text-ink-muted hover:text-ink">hello@atifinity.studio</a>
        <a href="https://wa.me/923488164928" data-wa-text="Hi Atifinity, I have a question about your services." class="btn-primary btn-sm mt-4 w-fit">
          <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 00-8.6 15L2 22l5.2-1.4A10 10 0 1012 2zm0 18a8 8 0 01-4.1-1.1l-.3-.2-3 .8.8-2.9-.2-.3A8 8 0 1112 20zm4.4-6c-.2-.1-1.4-.7-1.6-.8-.2-.1-.4-.1-.6.1s-.7.8-.9 1c-.2.2-.3.2-.6.1a6.6 6.6 0 01-1.9-1.2 7.3 7.3 0 01-1.3-1.7c-.1-.2 0-.4.1-.5l.4-.4c.1-.1.2-.3.2-.4a.5.5 0 000-.5c-.1-.1-.6-1.4-.8-1.9-.2-.5-.4-.4-.6-.4h-.5a1 1 0 00-.7.3 2.9 2.9 0 00-.9 2.2c0 1.3.9 2.5 1.1 2.7.1.2 1.9 2.9 4.6 4 .6.3 1.1.4 1.5.6.6.2 1.2.1 1.6.1.5-.1 1.4-.6 1.6-1.1.2-.5.2-1 .2-1.1-.1-.1-.2-.2-.5-.3z"/></svg>
          Message Us
        </a>
      </div>
    </div>

    <div class="mt-12 flex flex-col items-center justify-between gap-4 border-t border-ink/10 pt-6 text-small text-ink-muted sm:flex-row">
      <p>&copy; <?php echo date('Y'); ?> Atifinity. All rights reserved.</p>
      <p class="flex items-center gap-1.5">Built with <span class="text-ink-muted">&hearts;</span> for creators.</p>
    </div>
  </div>
</footer>

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

<?php wp_footer(); ?>
</body>
</html>
