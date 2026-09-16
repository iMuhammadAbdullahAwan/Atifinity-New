  <!-- ================= WORK =================
       The strongest, most credible section on the site: 17 real, playable
       productions. Large-format editorial rows (not a 3-up card grid),
       alternating layout, hover-preview on desktop / viewport-triggered
       preview on mobile, click opens the full video with sound. First 6
       render eagerly; the rest reveal via "Load More Work" so the page
       never has to lazy-decode 17 previews at once. -->
  <section id="work" class="section">
    <div class="container-x">
      <div class="max-w-2xl" data-reveal="lift">
        <h2 class="section-title">Content That Gets Attention. Strategy That Builds Channels.</h2>
        <p class="section-lede">Explore our video productions, thumbnails, and channel work created to help creators build a stronger YouTube presence.</p>
      </div>

      <div class="mt-16 flex flex-col gap-20 lg:gap-28" data-work-list>

        <!-- 01 — America Bridge -->
        <article class="flex flex-col gap-8 lg:flex-row lg:items-center lg:gap-14 odd:lg:flex-row even:lg:flex-row-reverse" data-work-item>
          <button type="button" data-cursor="Play" class="work-preview group relative block w-full shrink-0 overflow-hidden rounded-md border border-ink/10 bg-panel lg:w-3/5" data-video-modal="<?php echo get_template_directory_uri(); ?>/assets/portfolio/full/america-bridge.mp4" data-video-title="America Bridge">
            <span class="relative block aspect-video">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/portfolio/posters/america-bridge.jpg" alt="America Bridge — project preview frame" class="absolute inset-0 h-full w-full object-cover" loading="eager" width="1280" height="720" />
              <video class="absolute inset-0 h-full w-full object-cover" muted loop playsinline preload="none" data-src="<?php echo get_template_directory_uri(); ?>/assets/portfolio/previews/america-bridge.mp4" poster="<?php echo get_template_directory_uri(); ?>/assets/portfolio/posters/america-bridge.jpg" aria-hidden="true"></video>
              <span class="absolute inset-0 flex items-center justify-center bg-black/35 transition-colors group-hover:bg-black/20">
                <span class="play-badge h-14 w-14 shadow-md">
                  <svg class="ml-0.5 h-6 w-6" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                </span>
              </span>
            </span>
          </button>
          <div class="lg:w-2/5">
            <h3 class="work-title text-h1">America Bridge</h3>
            <p class="mt-3 max-w-md text-small text-ink-muted">An aerial look at the engineering and history behind an iconic bridge.</p>
            <p class="work-cue mt-4" aria-hidden="true">Play full video <svg class="motion-arrow h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></p>
          </div>
        </article>

        <!-- 02 — CIA -->
        <article class="flex flex-col gap-8 lg:flex-row lg:items-center lg:gap-14 odd:lg:flex-row even:lg:flex-row-reverse" data-work-item>
          <button type="button" data-cursor="Play" class="work-preview group relative block w-full shrink-0 overflow-hidden rounded-md border border-ink/10 bg-panel lg:w-3/5" data-video-modal="<?php echo get_template_directory_uri(); ?>/assets/portfolio/full/cia.mp4" data-video-title="CIA">
            <span class="relative block aspect-video">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/portfolio/posters/cia.jpg" alt="CIA — project preview frame" class="absolute inset-0 h-full w-full object-cover" loading="lazy" width="1280" height="720" />
              <video class="absolute inset-0 h-full w-full object-cover" muted loop playsinline preload="none" data-src="<?php echo get_template_directory_uri(); ?>/assets/portfolio/previews/cia.mp4" poster="<?php echo get_template_directory_uri(); ?>/assets/portfolio/posters/cia.jpg" aria-hidden="true"></video>
              <span class="absolute inset-0 flex items-center justify-center bg-black/35 transition-colors group-hover:bg-black/20">
                <span class="play-badge h-14 w-14 shadow-md">
                  <svg class="ml-0.5 h-6 w-6" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                </span>
              </span>
            </span>
          </button>
          <div class="lg:w-2/5">
            <h3 class="work-title text-h1">CIA</h3>
            <p class="mt-3 max-w-md text-small text-ink-muted">What it's really like to apply for a job at the CIA.</p>
            <p class="work-cue mt-4" aria-hidden="true">Play full video <svg class="motion-arrow h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></p>
          </div>
        </article>

        <!-- 03 — Debt -->
        <article class="flex flex-col gap-8 lg:flex-row lg:items-center lg:gap-14 odd:lg:flex-row even:lg:flex-row-reverse" data-work-item>
          <button type="button" data-cursor="Play" class="work-preview group relative block w-full shrink-0 overflow-hidden rounded-md border border-ink/10 bg-panel lg:w-3/5" data-video-modal="<?php echo get_template_directory_uri(); ?>/assets/portfolio/full/debt.mp4" data-video-title="Debt">
            <span class="relative block aspect-video">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/portfolio/posters/debt.jpg" alt="Debt — project preview frame" class="absolute inset-0 h-full w-full object-cover" loading="lazy" width="1280" height="720" />
              <video class="absolute inset-0 h-full w-full object-cover" muted loop playsinline preload="none" data-src="<?php echo get_template_directory_uri(); ?>/assets/portfolio/previews/debt.mp4" poster="<?php echo get_template_directory_uri(); ?>/assets/portfolio/posters/debt.jpg" aria-hidden="true"></video>
              <span class="absolute inset-0 flex items-center justify-center bg-black/35 transition-colors group-hover:bg-black/20">
                <span class="play-badge h-14 w-14 shadow-md">
                  <svg class="ml-0.5 h-6 w-6" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                </span>
              </span>
            </span>
          </button>
          <div class="lg:w-2/5">
            <h3 class="work-title text-h1">Debt</h3>
            <p class="mt-3 max-w-md text-small text-ink-muted">A clear breakdown of how national debt actually works.</p>
            <p class="work-cue mt-4" aria-hidden="true">Play full video <svg class="motion-arrow h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></p>
          </div>
        </article>

        <!-- 04 — Different Eye Colour Advantages -->
        <article class="flex flex-col gap-8 lg:flex-row lg:items-center lg:gap-14 odd:lg:flex-row even:lg:flex-row-reverse" data-work-item>
          <button type="button" data-cursor="Play" class="work-preview group relative block w-full shrink-0 overflow-hidden rounded-md border border-ink/10 bg-panel lg:w-3/5" data-video-modal="<?php echo get_template_directory_uri(); ?>/assets/portfolio/full/different-eye-colour-advantages.mp4" data-video-title="Different Eye Colour Advantages">
            <span class="relative block aspect-video">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/portfolio/posters/different-eye-colour-advantages.jpg" alt="Different Eye Colour Advantages — project preview frame" class="absolute inset-0 h-full w-full object-cover" loading="lazy" width="1280" height="720" />
              <video class="absolute inset-0 h-full w-full object-cover" muted loop playsinline preload="none" data-src="<?php echo get_template_directory_uri(); ?>/assets/portfolio/previews/different-eye-colour-advantages.mp4" poster="<?php echo get_template_directory_uri(); ?>/assets/portfolio/posters/different-eye-colour-advantages.jpg" aria-hidden="true"></video>
              <span class="absolute inset-0 flex items-center justify-center bg-black/35 transition-colors group-hover:bg-black/20">
                <span class="play-badge h-14 w-14 shadow-md">
                  <svg class="ml-0.5 h-6 w-6" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                </span>
              </span>
            </span>
          </button>
          <div class="lg:w-2/5">
            <h3 class="work-title text-h1">Different Eye Colour Advantages</h3>
            <p class="mt-3 max-w-md text-small text-ink-muted">The surprising science behind why eye colour matters.</p>
            <p class="work-cue mt-4" aria-hidden="true">Play full video <svg class="motion-arrow h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></p>
          </div>
        </article>

        <!-- 05 — Drug Cartel -->
        <article class="flex flex-col gap-8 lg:flex-row lg:items-center lg:gap-14 odd:lg:flex-row even:lg:flex-row-reverse" data-work-item>
          <button type="button" data-cursor="Play" class="work-preview group relative block w-full shrink-0 overflow-hidden rounded-md border border-ink/10 bg-panel lg:w-3/5" data-video-modal="<?php echo get_template_directory_uri(); ?>/assets/portfolio/full/drug-cartel.mp4" data-video-title="Drug Cartel">
            <span class="relative block aspect-video">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/portfolio/posters/drug-cartel.jpg" alt="Drug Cartel — project preview frame" class="absolute inset-0 h-full w-full object-cover" loading="lazy" width="1280" height="720" />
              <video class="absolute inset-0 h-full w-full object-cover" muted loop playsinline preload="none" data-src="<?php echo get_template_directory_uri(); ?>/assets/portfolio/previews/drug-cartel.mp4" poster="<?php echo get_template_directory_uri(); ?>/assets/portfolio/posters/drug-cartel.jpg" aria-hidden="true"></video>
              <span class="absolute inset-0 flex items-center justify-center bg-black/35 transition-colors group-hover:bg-black/20">
                <span class="play-badge h-14 w-14 shadow-md">
                  <svg class="ml-0.5 h-6 w-6" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                </span>
              </span>
            </span>
          </button>
          <div class="lg:w-2/5">
            <h3 class="work-title text-h1">Drug Cartel</h3>
            <p class="mt-3 max-w-md text-small text-ink-muted">Inside the rise and reach of a global drug cartel.</p>
            <p class="work-cue mt-4" aria-hidden="true">Play full video <svg class="motion-arrow h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></p>
          </div>
        </article>

        <!-- 06 — Eurodollars -->
        <article class="flex flex-col gap-8 lg:flex-row lg:items-center lg:gap-14 odd:lg:flex-row even:lg:flex-row-reverse" data-work-item>
          <button type="button" data-cursor="Play" class="work-preview group relative block w-full shrink-0 overflow-hidden rounded-md border border-ink/10 bg-panel lg:w-3/5" data-video-modal="<?php echo get_template_directory_uri(); ?>/assets/portfolio/full/eurodollars.mp4" data-video-title="Eurodollars">
            <span class="relative block aspect-video">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/portfolio/posters/eurodollars.jpg" alt="Eurodollars — project preview frame" class="absolute inset-0 h-full w-full object-cover" loading="lazy" width="1280" height="720" />
              <video class="absolute inset-0 h-full w-full object-cover" muted loop playsinline preload="none" data-src="<?php echo get_template_directory_uri(); ?>/assets/portfolio/previews/eurodollars.mp4" poster="<?php echo get_template_directory_uri(); ?>/assets/portfolio/posters/eurodollars.jpg" aria-hidden="true"></video>
              <span class="absolute inset-0 flex items-center justify-center bg-black/35 transition-colors group-hover:bg-black/20">
                <span class="play-badge h-14 w-14 shadow-md">
                  <svg class="ml-0.5 h-6 w-6" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                </span>
              </span>
            </span>
          </button>
          <div class="lg:w-2/5">
            <h3 class="work-title text-h1">Eurodollars</h3>
            <p class="mt-3 max-w-md text-small text-ink-muted">Unpacking the hidden financial system behind the Eurodollar.</p>
            <p class="work-cue mt-4" aria-hidden="true">Play full video <svg class="motion-arrow h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></p>
          </div>
        </article>

      </div>

      <!-- The remaining 11 productions: a horizontally-scrolling strip —
           the reference site's own "flowing row of thumbnails" browsing
           pattern, rebuilt as something you actually control (drag/swipe/
           scroll, not an unstoppable marquee) with real playable previews
           instead of static images. -->
      <div class="mt-6" data-reveal="slide" data-reveal-delay="150">
        <p class="tag !text-ink mb-4">More From Our Work</p>
        <div class="work-strip flex gap-4 overflow-x-auto snap-x snap-mandatory scrollbar-none pb-2" role="region" aria-label="More portfolio videos" tabindex="0">

          <button type="button" data-cursor="Play" class="work-preview work-chip group relative shrink-0 snap-start overflow-hidden rounded-md border border-ink/10 bg-panel" data-video-modal="<?php echo get_template_directory_uri(); ?>/assets/portfolio/full/honda.mp4" data-video-title="Honda">
            <span class="relative block aspect-video">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/portfolio/posters/honda.jpg" alt="Honda — project preview frame" class="absolute inset-0 h-full w-full object-cover" loading="lazy" width="480" height="270" />
              <video class="absolute inset-0 h-full w-full object-cover" muted loop playsinline preload="none" data-src="<?php echo get_template_directory_uri(); ?>/assets/portfolio/previews/honda.mp4" poster="<?php echo get_template_directory_uri(); ?>/assets/portfolio/posters/honda.jpg" aria-hidden="true"></video>
              <span class="absolute inset-0 flex items-center justify-center bg-black/35 transition-colors group-hover:bg-black/15">
                <span class="play-badge h-10 w-10"><svg class="ml-0.5 h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
              </span>
            </span>
            <span class="block px-3 py-2.5">
              <span class="block text-small font-medium text-ink">Honda</span>
              <span class="mt-0.5 block text-[12px] text-ink-muted">The story behind one of the world's most iconic automotive brands.</span>
            </span>
          </button>

          <button type="button" data-cursor="Play" class="work-preview work-chip group relative shrink-0 snap-start overflow-hidden rounded-md border border-ink/10 bg-panel" data-video-modal="<?php echo get_template_directory_uri(); ?>/assets/portfolio/full/mcintosh.mp4" data-video-title="McIntosh">
            <span class="relative block aspect-video">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/portfolio/posters/mcintosh.jpg" alt="McIntosh — project preview frame" class="absolute inset-0 h-full w-full object-cover" loading="lazy" width="480" height="270" />
              <video class="absolute inset-0 h-full w-full object-cover" muted loop playsinline preload="none" data-src="<?php echo get_template_directory_uri(); ?>/assets/portfolio/previews/mcintosh.mp4" poster="<?php echo get_template_directory_uri(); ?>/assets/portfolio/posters/mcintosh.jpg" aria-hidden="true"></video>
              <span class="absolute inset-0 flex items-center justify-center bg-black/35 transition-colors group-hover:bg-black/15">
                <span class="play-badge h-10 w-10"><svg class="ml-0.5 h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
              </span>
            </span>
            <span class="block px-3 py-2.5">
              <span class="block text-small font-medium text-ink">McIntosh</span>
              <span class="mt-0.5 block text-[12px] text-ink-muted">How a legendary audio brand built its high-end reputation.</span>
            </span>
          </button>

          <button type="button" data-cursor="Play" class="work-preview work-chip group relative shrink-0 snap-start overflow-hidden rounded-md border border-ink/10 bg-panel" data-video-modal="<?php echo get_template_directory_uri(); ?>/assets/portfolio/full/melbourne.mp4" data-video-title="Melbourne">
            <span class="relative block aspect-video">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/portfolio/posters/melbourne.jpg" alt="Melbourne — project preview frame" class="absolute inset-0 h-full w-full object-cover" loading="lazy" width="480" height="270" />
              <video class="absolute inset-0 h-full w-full object-cover" muted loop playsinline preload="none" data-src="<?php echo get_template_directory_uri(); ?>/assets/portfolio/previews/melbourne.mp4" poster="<?php echo get_template_directory_uri(); ?>/assets/portfolio/posters/melbourne.jpg" aria-hidden="true"></video>
              <span class="absolute inset-0 flex items-center justify-center bg-black/35 transition-colors group-hover:bg-black/15">
                <span class="play-badge h-10 w-10"><svg class="ml-0.5 h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
              </span>
            </span>
            <span class="block px-3 py-2.5">
              <span class="block text-small font-medium text-ink">Melbourne</span>
              <span class="mt-0.5 block text-[12px] text-ink-muted">A look inside large-scale industrial manufacturing.</span>
            </span>
          </button>

          <button type="button" data-cursor="Play" class="work-preview work-chip group relative shrink-0 snap-start overflow-hidden rounded-md border border-ink/10 bg-panel" data-video-modal="<?php echo get_template_directory_uri(); ?>/assets/portfolio/full/mexico.mp4" data-video-title="Mexico">
            <span class="relative block aspect-video">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/portfolio/posters/mexico.jpg" alt="Mexico — project preview frame" class="absolute inset-0 h-full w-full object-cover" loading="lazy" width="480" height="270" />
              <video class="absolute inset-0 h-full w-full object-cover" muted loop playsinline preload="none" data-src="<?php echo get_template_directory_uri(); ?>/assets/portfolio/previews/mexico.mp4" poster="<?php echo get_template_directory_uri(); ?>/assets/portfolio/posters/mexico.jpg" aria-hidden="true"></video>
              <span class="absolute inset-0 flex items-center justify-center bg-black/35 transition-colors group-hover:bg-black/15">
                <span class="play-badge h-10 w-10"><svg class="ml-0.5 h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
              </span>
            </span>
            <span class="block px-3 py-2.5">
              <span class="block text-small font-medium text-ink">Mexico</span>
              <span class="mt-0.5 block text-[12px] text-ink-muted">Exploring the culture, economy, and history shaping modern Mexico.</span>
            </span>
          </button>

          <button type="button" data-cursor="Play" class="work-preview work-chip group relative shrink-0 snap-start overflow-hidden rounded-md border border-ink/10 bg-panel" data-video-modal="<?php echo get_template_directory_uri(); ?>/assets/portfolio/full/neom.mp4" data-video-title="Neom">
            <span class="relative block aspect-video">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/portfolio/posters/neom.jpg" alt="Neom — project preview frame" class="absolute inset-0 h-full w-full object-cover" loading="lazy" width="480" height="270" />
              <video class="absolute inset-0 h-full w-full object-cover" muted loop playsinline preload="none" data-src="<?php echo get_template_directory_uri(); ?>/assets/portfolio/previews/neom.mp4" poster="<?php echo get_template_directory_uri(); ?>/assets/portfolio/posters/neom.jpg" aria-hidden="true"></video>
              <span class="absolute inset-0 flex items-center justify-center bg-black/35 transition-colors group-hover:bg-black/15">
                <span class="play-badge h-10 w-10"><svg class="ml-0.5 h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
              </span>
            </span>
            <span class="block px-3 py-2.5">
              <span class="block text-small font-medium text-ink">Neom</span>
              <span class="mt-0.5 block text-[12px] text-ink-muted">Inside NEOM — Saudi Arabia's ambitious vision for the future.</span>
            </span>
          </button>

          <button type="button" data-cursor="Play" class="work-preview work-chip group relative shrink-0 snap-start overflow-hidden rounded-md border border-ink/10 bg-panel" data-video-modal="<?php echo get_template_directory_uri(); ?>/assets/portfolio/full/petrodollar.mp4" data-video-title="Petrodollar">
            <span class="relative block aspect-video">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/portfolio/posters/petrodollar.jpg" alt="Petrodollar — project preview frame" class="absolute inset-0 h-full w-full object-cover" loading="lazy" width="480" height="270" />
              <video class="absolute inset-0 h-full w-full object-cover" muted loop playsinline preload="none" data-src="<?php echo get_template_directory_uri(); ?>/assets/portfolio/previews/petrodollar.mp4" poster="<?php echo get_template_directory_uri(); ?>/assets/portfolio/posters/petrodollar.jpg" aria-hidden="true"></video>
              <span class="absolute inset-0 flex items-center justify-center bg-black/35 transition-colors group-hover:bg-black/15">
                <span class="play-badge h-10 w-10"><svg class="ml-0.5 h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
              </span>
            </span>
            <span class="block px-3 py-2.5">
              <span class="block text-small font-medium text-ink">Petrodollar</span>
              <span class="mt-0.5 block text-[12px] text-ink-muted">How the petrodollar reshaped the global economy.</span>
            </span>
          </button>

          <button type="button" data-cursor="Play" class="work-preview work-chip group relative shrink-0 snap-start overflow-hidden rounded-md border border-ink/10 bg-panel" data-video-modal="<?php echo get_template_directory_uri(); ?>/assets/portfolio/full/pied-piper.mp4" data-video-title="Pied Piper">
            <span class="relative block aspect-video">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/portfolio/posters/pied-piper.jpg" alt="Pied Piper — project preview frame" class="absolute inset-0 h-full w-full object-cover" loading="lazy" width="480" height="270" />
              <video class="absolute inset-0 h-full w-full object-cover" muted loop playsinline preload="none" data-src="<?php echo get_template_directory_uri(); ?>/assets/portfolio/previews/pied-piper.mp4" poster="<?php echo get_template_directory_uri(); ?>/assets/portfolio/posters/pied-piper.jpg" aria-hidden="true"></video>
              <span class="absolute inset-0 flex items-center justify-center bg-black/35 transition-colors group-hover:bg-black/15">
                <span class="play-badge h-10 w-10"><svg class="ml-0.5 h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
              </span>
            </span>
            <span class="block px-3 py-2.5">
              <span class="block text-small font-medium text-ink">Pied Piper</span>
              <span class="mt-0.5 block text-[12px] text-ink-muted">A modern retelling of the classic Pied Piper legend.</span>
            </span>
          </button>

          <button type="button" data-cursor="Play" class="work-preview work-chip group relative shrink-0 snap-start overflow-hidden rounded-md border border-ink/10 bg-panel" data-video-modal="<?php echo get_template_directory_uri(); ?>/assets/portfolio/full/the-promise.mp4" data-video-title="The Promise">
            <span class="relative block aspect-video">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/portfolio/posters/the-promise.jpg" alt="The Promise — project preview frame" class="absolute inset-0 h-full w-full object-cover" loading="lazy" width="480" height="270" />
              <video class="absolute inset-0 h-full w-full object-cover" muted loop playsinline preload="none" data-src="<?php echo get_template_directory_uri(); ?>/assets/portfolio/previews/the-promise.mp4" poster="<?php echo get_template_directory_uri(); ?>/assets/portfolio/posters/the-promise.jpg" aria-hidden="true"></video>
              <span class="absolute inset-0 flex items-center justify-center bg-black/35 transition-colors group-hover:bg-black/15">
                <span class="play-badge h-10 w-10"><svg class="ml-0.5 h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
              </span>
            </span>
            <span class="block px-3 py-2.5">
              <span class="block text-small font-medium text-ink">The Promise</span>
              <span class="mt-0.5 block text-[12px] text-ink-muted">A story about commitment, sacrifice, and keeping your word.</span>
            </span>
          </button>

          <button type="button" data-cursor="Play" class="work-preview work-chip group relative shrink-0 snap-start overflow-hidden rounded-md border border-ink/10 bg-panel" data-video-modal="<?php echo get_template_directory_uri(); ?>/assets/portfolio/full/us-navy-destroyer.mp4" data-video-title="US Navy Destroyer">
            <span class="relative block aspect-video">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/portfolio/posters/us-navy-destroyer.jpg" alt="US Navy Destroyer — project preview frame" class="absolute inset-0 h-full w-full object-cover" loading="lazy" width="480" height="270" />
              <video class="absolute inset-0 h-full w-full object-cover" muted loop playsinline preload="none" data-src="<?php echo get_template_directory_uri(); ?>/assets/portfolio/previews/us-navy-destroyer.mp4" poster="<?php echo get_template_directory_uri(); ?>/assets/portfolio/posters/us-navy-destroyer.jpg" aria-hidden="true"></video>
              <span class="absolute inset-0 flex items-center justify-center bg-black/35 transition-colors group-hover:bg-black/15">
                <span class="play-badge h-10 w-10"><svg class="ml-0.5 h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
              </span>
            </span>
            <span class="block px-3 py-2.5">
              <span class="block text-small font-medium text-ink">US Navy Destroyer</span>
              <span class="mt-0.5 block text-[12px] text-ink-muted">Inside the power and engineering of a US Navy destroyer.</span>
            </span>
          </button>

          <button type="button" data-cursor="Play" class="work-preview work-chip group relative shrink-0 snap-start overflow-hidden rounded-md border border-ink/10 bg-panel" data-video-modal="<?php echo get_template_directory_uri(); ?>/assets/portfolio/full/wildling.mp4" data-video-title="Wildling">
            <span class="relative block aspect-video">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/portfolio/posters/wildling.jpg" alt="Wildling — project preview frame" class="absolute inset-0 h-full w-full object-cover" loading="lazy" width="480" height="270" />
              <video class="absolute inset-0 h-full w-full object-cover" muted loop playsinline preload="none" data-src="<?php echo get_template_directory_uri(); ?>/assets/portfolio/previews/wildling.mp4" poster="<?php echo get_template_directory_uri(); ?>/assets/portfolio/posters/wildling.jpg" aria-hidden="true"></video>
              <span class="absolute inset-0 flex items-center justify-center bg-black/35 transition-colors group-hover:bg-black/15">
                <span class="play-badge h-10 w-10"><svg class="ml-0.5 h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
              </span>
            </span>
            <span class="block px-3 py-2.5">
              <span class="block text-small font-medium text-ink">Wildling</span>
              <span class="mt-0.5 block text-[12px] text-ink-muted">A wild, untamed story of survival and instinct.</span>
            </span>
          </button>

          <button type="button" data-cursor="Play" class="work-preview work-chip group relative shrink-0 snap-start overflow-hidden rounded-md border border-ink/10 bg-panel" data-video-modal="<?php echo get_template_directory_uri(); ?>/assets/portfolio/full/wizard-of-oz.mp4" data-video-title="Wizard of Oz">
            <span class="relative block aspect-video">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/portfolio/posters/wizard-of-oz.jpg" alt="Wizard of Oz — project preview frame" class="absolute inset-0 h-full w-full object-cover" loading="lazy" width="480" height="270" />
              <video class="absolute inset-0 h-full w-full object-cover" muted loop playsinline preload="none" data-src="<?php echo get_template_directory_uri(); ?>/assets/portfolio/previews/wizard-of-oz.mp4" poster="<?php echo get_template_directory_uri(); ?>/assets/portfolio/posters/wizard-of-oz.jpg" aria-hidden="true"></video>
              <span class="absolute inset-0 flex items-center justify-center bg-black/35 transition-colors group-hover:bg-black/15">
                <span class="play-badge h-10 w-10"><svg class="ml-0.5 h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
              </span>
            </span>
            <span class="block px-3 py-2.5">
              <span class="block text-small font-medium text-ink">Wizard of Oz</span>
              <span class="mt-0.5 block text-[12px] text-ink-muted">A fresh look at the timeless tale of Oz.</span>
            </span>
          </button>

        </div>
      </div>

      <!-- Case studies: the client's exact framing copy, backed by real
           YouTube Studio screenshots the client supplied (not invented
           metrics) — every number in the highlight row and every caption
           below is read directly off these screenshots. Shown at real
           legible size (the reference site's own version of this section
           shrank its proof to illegible thumbnails); revenue the client
           blurred in their own screenshots stays blurred here too. -->
      <div id="case-studies" class="mt-24 scroll-mt-28 border-t border-ink/10 pt-14 lg:mt-32 lg:pt-16" data-reveal="lift">
        <div class="mx-auto max-w-2xl text-center">
          <h2 class="section-title">Real Strategy. Real Execution. Measurable Growth.</h2>
          <p class="section-lede mx-auto">See how we approach different channels, identify opportunities, improve content performance, and build systems designed for long-term growth.</p>
        </div>

        <div data-reveal="drop" class="stat-row mt-12 justify-center gap-x-12 border-t border-ink/10 pt-8 text-center sm:gap-x-16">
          <div><span class="stat-num">433%</span><span class="stat-label">Revenue Growth, Month Over Month</span></div>
          <div><span class="stat-num">1.0M+</span><span class="stat-label">Views In A 30-Day Window</span></div>
          <div><span class="stat-num">$10K+</span><span class="stat-label">Estimated Revenue, Best Month</span></div>
        </div>

        <div data-reveal="slide-right" data-reveal-delay="120" class="case-strip mt-12 flex gap-5 overflow-x-auto snap-x snap-mandatory scrollbar-none pb-2">
          <figure class="case-shot shrink-0 snap-start">
            <button type="button" data-cursor="View" class="case-shot-trigger" data-image-modal="<?php echo get_template_directory_uri(); ?>/assets/result-and-growth/result-revenue-growth-433.jpg" data-image-alt="YouTube Studio revenue dashboard showing $11,241.07 estimated revenue for the month — 433% more than the prior period" data-image-caption="$11,241.07 estimated revenue in one month — 433% more than the period before." aria-label="View full size: $11,241.07 estimated revenue in one month">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/result-and-growth/result-revenue-growth-433.jpg" alt="YouTube Studio revenue dashboard showing $11,241.07 estimated revenue for the month — 433% more than the prior period" class="rounded-md border border-ink/10" loading="lazy" />
            </button>
            <figcaption class="mt-3 max-w-[22rem] text-small text-ink-muted">$11,241.07 estimated revenue in one month — 433% more than the period before.</figcaption>
          </figure>
          <figure class="case-shot shrink-0 snap-start">
            <button type="button" data-cursor="View" class="case-shot-trigger" data-image-modal="<?php echo get_template_directory_uri(); ?>/assets/result-and-growth/result-channel-views-1m.jpg" data-image-alt="YouTube Studio dashboard showing 1.0M views and +3.0K subscribers over 30 days" data-image-caption="1.0M+ views and +3.0K subscribers gained in a 30-day window." aria-label="View full size: 1.0M+ views and +3.0K subscribers in a 30-day window">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/result-and-growth/result-channel-views-1m.jpg" alt="YouTube Studio dashboard showing 1.0M views and +3.0K subscribers over 30 days" class="rounded-md border border-ink/10" loading="lazy" />
            </button>
            <figcaption class="mt-3 max-w-[22rem] text-small text-ink-muted">1.0M+ views and +3.0K subscribers gained in a 30-day window.</figcaption>
          </figure>
          <figure class="case-shot shrink-0 snap-start">
            <button type="button" data-cursor="View" class="case-shot-trigger" data-image-modal="<?php echo get_template_directory_uri(); ?>/assets/result-and-growth/result-monthly-earnings.jpg" data-image-alt="YouTube Studio monthly earnings breakdown climbing from $101.64 in February to over $10,000 in May" data-image-caption="Monthly revenue climbing from $101 to over $10,000 in under six months." aria-label="View full size: monthly revenue climbing from $101 to over $10,000">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/result-and-growth/result-monthly-earnings.jpg" alt="YouTube Studio monthly earnings breakdown climbing from $101.64 in February to over $10,000 in May" class="rounded-md border border-ink/10" loading="lazy" />
            </button>
            <figcaption class="mt-3 max-w-[22rem] text-small text-ink-muted">Monthly revenue climbing from $101 to over $10,000 in under six months.</figcaption>
          </figure>
          <figure class="case-shot shrink-0 snap-start">
            <button type="button" data-cursor="View" class="case-shot-trigger" data-image-modal="<?php echo get_template_directory_uri(); ?>/assets/result-and-growth/result-channel-views-775k.jpg" data-image-alt="YouTube Studio dashboard showing 775.2K views and +2.3K subscribers over 30 days" data-image-caption="775.2K views and +2.3K subscribers — another 30-day snapshot." aria-label="View full size: 775.2K views and +2.3K subscribers in 30 days">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/result-and-growth/result-channel-views-775k.jpg" alt="YouTube Studio dashboard showing 775.2K views and +2.3K subscribers over 30 days" class="rounded-md border border-ink/10" loading="lazy" />
            </button>
            <figcaption class="mt-3 max-w-[22rem] text-small text-ink-muted">775.2K views and +2.3K subscribers — another 30-day snapshot.</figcaption>
          </figure>
          <figure class="case-shot shrink-0 snap-start">
            <button type="button" data-cursor="View" class="case-shot-trigger" data-image-modal="<?php echo get_template_directory_uri(); ?>/assets/result-and-growth/result-video-revenue-1.jpg" data-image-alt="YouTube Studio single-video performance showing $1,246.78 estimated revenue, 56.4K views, and a 7.6% click-through rate" data-image-caption="$1,246.78 estimated revenue from a single video — 7.6% click-through rate, 6:12 average view duration." aria-label="View full size: $1,246.78 estimated revenue from a single video">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/result-and-growth/result-video-revenue-1.jpg" alt="YouTube Studio single-video performance showing $1,246.78 estimated revenue, 56.4K views, and a 7.6% click-through rate" class="rounded-md border border-ink/10" loading="lazy" />
            </button>
            <figcaption class="mt-3 max-w-[22rem] text-small text-ink-muted">$1,246.78 estimated revenue from a single video — 7.6% click-through rate, 6:12 average view duration.</figcaption>
          </figure>
          <figure class="case-shot shrink-0 snap-start">
            <button type="button" data-cursor="View" class="case-shot-trigger" data-image-modal="<?php echo get_template_directory_uri(); ?>/assets/result-and-growth/result-video-revenue-2.jpg" data-image-alt="YouTube Studio single-video performance showing $411.60 estimated revenue and a $21.22 RPM" data-image-caption="$411.60 estimated revenue from a single video at a $21.22 RPM." aria-label="View full size: $411.60 estimated revenue from a single video">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/result-and-growth/result-video-revenue-2.jpg" alt="YouTube Studio single-video performance showing $411.60 estimated revenue and a $21.22 RPM" class="rounded-md border border-ink/10" loading="lazy" />
            </button>
            <figcaption class="mt-3 max-w-[22rem] text-small text-ink-muted">$411.60 estimated revenue from a single video at a $21.22 RPM.</figcaption>
          </figure>
          <figure class="case-shot shrink-0 snap-start">
            <button type="button" data-cursor="View" class="case-shot-trigger" data-image-modal="<?php echo get_template_directory_uri(); ?>/assets/result-and-growth/result-video-revenue-3.jpg" data-image-alt="YouTube Studio single-video performance" data-image-caption="High-performing video analytics and steady growth." aria-label="View full size: video analytics">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/result-and-growth/result-video-revenue-3.jpg" alt="YouTube Studio single-video performance" class="rounded-md border border-ink/10" loading="lazy" />
            </button>
            <figcaption class="mt-3 max-w-[22rem] text-small text-ink-muted">Consistent video views and steady engagement.</figcaption>
          </figure>
          <figure class="case-shot shrink-0 snap-start">
            <button type="button" data-cursor="View" class="case-shot-trigger" data-image-modal="<?php echo get_template_directory_uri(); ?>/assets/result-and-growth/result-video-revenue-4.jpg" data-image-alt="YouTube Studio single-video performance" data-image-caption="Steady growth and solid engagement across multiple videos." aria-label="View full size: video analytics">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/result-and-growth/result-video-revenue-4.jpg" alt="YouTube Studio single-video performance" class="rounded-md border border-ink/10" loading="lazy" />
            </button>
            <figcaption class="mt-3 max-w-[22rem] text-small text-ink-muted">Steady growth and solid engagement across multiple videos.</figcaption>
          </figure>
          <figure class="case-shot shrink-0 snap-start">
            <button type="button" data-cursor="View" class="case-shot-trigger" data-image-modal="<?php echo get_template_directory_uri(); ?>/assets/result-and-growth/result-monthly-earnings-1.jpg" data-image-alt="YouTube Studio monthly earnings" data-image-caption="Consistent monthly revenue growth." aria-label="View full size: monthly earnings">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/result-and-growth/result-monthly-earnings-1.jpg" alt="YouTube Studio monthly earnings" class="rounded-md border border-ink/10" loading="lazy" />
            </button>
            <figcaption class="mt-3 max-w-[22rem] text-small text-ink-muted">Consistent monthly revenue growth over time.</figcaption>
          </figure>
        </div>

        <div class="mt-12 text-center">
          <a href="https://wa.me/923488164928" data-wa-text="Hi Atifinity, I'd like to explore case studies for a channel like mine." class="btn-ghost inline-flex">
            Explore Case Studies
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
          </a>
        </div>
      </div>
    </div>
  </section>
