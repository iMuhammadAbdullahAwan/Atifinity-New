  <!-- ================= HERO =================
       Signature entrance: background settles → the brand mark's infinity
       loop draws itself in → the mark resolves → headline, supporting
       copy, and CTAs stagger up (see hero.js + the [data-hero-*] rules in
       input.css). Cursor-tilt on the mark is desktop/fine-pointer only. -->
  <!-- Composition follows the reference site's own hero pattern — headline
       + CTA pair + trust row on one side, a numbered value-teaser grid on
       the other, over a full-bleed animated field — rebuilt entirely on
       Atifinity's red/blue system and real content: the "trust row" here
       is three verifiable counts of what the studio actually has (not an
       unverifiable outcome metric), and the four grid cards are exact
       one-line quotes from the Services section below, not invented value
       propositions. -->
  <section id="top" data-hero class="section relative overflow-hidden pt-36 sm:pt-40 lg:pt-44">
    <div id="hero" class="container-x grid items-center gap-16 lg:grid-cols-[1.1fr_0.9fr] lg:gap-12">
      <div>
        <a href="#case-studies" class="trust-pill mt-6" data-hero-in="60">
          <span class="trust-dot" aria-hidden="true"></span>
          Verified Channel Results
          <svg class="trust-arrow h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </a>
        <h1 class="mt-6 text-hero" data-hero-in="120" data-hero-headline>
          YouTube Growth, <span class="text-ink">Built End-to-End.</span>
        </h1>
        <p class="mt-7 max-w-lg text-body text-ink-muted" data-hero-in="240">
          From the first idea to the final upload, we handle everything your channel needs to grow.
        </p>

        <p class="mt-6 flex flex-wrap items-center gap-x-2 gap-y-1 font-mono text-[11px] uppercase tracking-[0.16em] text-ink-muted" data-hero-in="320">
          <span class="text-ink">Research.</span>
          <span>Strategy.</span>
          <span>Content.</span>
          <span>Production.</span>
          <span>Optimization.</span>
          <span class="text-ink">Growth.</span>
        </p>

        <div class="mt-9 flex flex-wrap items-center gap-5 sm:gap-6" data-hero-in="420">
          <a href="https://wa.me/923488164928" data-wa-text="Hi Atifinity, I'd like to book a strategy call." class="btn-primary group" data-magnetic>
            Book a Strategy Call
            <svg class="motion-arrow h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
          </a>
          <a href="#work" class="group inline-flex items-center gap-3 text-small font-semibold text-ink">
            <span class="flex h-11 w-11 items-center justify-center rounded-md border border-ink/15 bg-ink/5 transition-all duration-300 ease-out group-hover:-translate-y-0.5 group-hover:border-ink/40">
              <svg class="motion-arrow-down h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><polyline points="19 12 12 19 5 12"/></svg>
            </span>
            View Our Work
          </a>
        </div>

        <div class="stat-row mt-12 border-t border-ink/10 pt-8" data-hero-in="500">
          <div><span class="stat-num" data-count-to="500">0</span>+<span class="stat-label">Productions</span></div>
          <div><span class="stat-num" data-count-to="10">0</span><span class="stat-label">Core Services</span></div>
          <div><span class="stat-num" data-count-to="6">0</span><span class="stat-label">Step Growth System</span></div>
        </div>
      </div>

      <div data-hero-in="180">
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 sm:gap-6">
          <div class="pillar-card sheen">
            <span class="pillar-badge">01</span>
            <h3 class="mt-1 text-h3">Niche Strategy &amp; Market Research</h3>
            <p class="text-small text-ink-muted">Find the right niche before you invest your time and money.</p>
          </div>
          <div class="pillar-card sheen">
            <span class="pillar-badge is-accent">02</span>
            <h3 class="mt-1 text-h3">High-Retention Scriptwriting</h3>
            <p class="text-small text-ink-muted">Build scripts that hook viewers early and keep them watching.</p>
          </div>
          <div class="pillar-card sheen">
            <span class="pillar-badge">03</span>
            <h3 class="mt-1 text-h3">Premium Video Production</h3>
            <p class="text-small text-ink-muted">Turn your script into a polished, engaging YouTube video.</p>
          </div>
          <div class="pillar-card sheen">
            <span class="pillar-badge is-accent">04</span>
            <h3 class="mt-1 text-h3">Analytics &amp; Growth Optimization</h3>
            <p class="text-small text-ink-muted">Use channel data to understand what is working and what needs to change.</p>
          </div>
        </div>
      </div>
    </div>

    <a href="#services" class="absolute bottom-8 left-1/2 hidden -translate-x-1/2 flex-col items-center gap-2 font-mono text-[10px] uppercase tracking-[0.22em] text-ink-muted sm:flex">
      <span>Scroll</span>
      <span class="flex h-8 w-5 items-start justify-center rounded-full border border-ink/20 p-1">
        <span class="h-1.5 w-1.5 animate-bounce rounded-full bg-primary"></span>
      </span>
    </a>
  </section>
