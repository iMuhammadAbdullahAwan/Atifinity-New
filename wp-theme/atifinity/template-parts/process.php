  <!-- ================= PROCESS =================
       Exact 6-step client copy. A single progress line fills in as the
       section scrolls through view; each step's rule and number pick up
       the accent color a beat after the line reaches it (process.js). -->
  <!-- Vertical, alternating, center-line timeline — the reference site's
       own process layout (numbered nodes down a connecting line), rebuilt
       on our tokens with the client's exact 6-step copy. -->
  <section id="process" class="section bg-panel/40">
    <div class="container-x">
      <div class="max-w-2xl" data-reveal="lift">
        <h2 class="section-title">How We Build &amp; Grow Your Channel</h2>
        <p class="section-lede" data-process-copy="new">A clear six-step system from strategy to consistent growth.</p>
        <p class="section-lede hidden" data-process-copy="existing">Both. We can build a new channel from scratch or work with an existing channel. For existing channels, we review the current content and performance before creating a growth strategy.</p>

        <!-- The switch swaps the intro AND the first three steps. Steps
             01-03 in the client's document are written for a channel that
             does not exist yet ("build your channel foundation"), which is
             wrong for a channel that already has one. The existing-channel
             versions are composed from the client's own service copy
             (services 08 and 10, plus FAQ 4), not from the reference site.
             Steps 04-06 are audience-neutral and identical on both paths. -->
        <div class="mt-6 inline-flex rounded-md border border-ink/10 p-1" role="tablist" aria-label="View the process for">
          <button type="button" class="process-tab is-active" data-process-tab="new" role="tab" aria-selected="true">New Channel</button>
          <button type="button" class="process-tab" data-process-tab="existing" role="tab" aria-selected="false">Existing Channel</button>
        </div>
      </div>

      <ol class="relative mt-16 lg:mt-20" data-reveal="rise" data-reveal-delay="100" data-process-track>
        <div class="pointer-events-none absolute left-6 top-0 bottom-0 w-px bg-ink/10 lg:left-1/2 lg:-translate-x-1/2" aria-hidden="true"></div>
        <div id="processLine" class="pointer-events-none absolute left-6 top-0 h-0 w-px process-line-gradient lg:left-1/2 lg:-translate-x-1/2" aria-hidden="true"></div>

        <li class="process-row" data-reveal="slide">
          <span class="process-node">01</span>
          <div class="process-body">
            <div data-process-copy="new">
              <h3 class="text-h3">Find Your Opportunity</h3>
              <p class="mt-2 text-small text-ink-muted">We research your niche, audience, competition, and market opportunities to identify the right direction for your channel.</p>
            </div>
            <div class="hidden" data-process-copy="existing">
              <h3 class="text-h3">Audit What You Already Have</h3>
              <p class="mt-2 text-small text-ink-muted">We review your current content and performance first — analytics, click-through rate, audience retention and watch time — so the strategy starts from what your channel is actually doing.</p>
            </div>
          </div>
        </li>
        <li class="process-row" data-reveal="slide-right">
          <span class="process-node">02</span>
          <div class="process-body">
            <div data-process-copy="new">
              <h3 class="text-h3">Build Your Channel Foundation</h3>
              <p class="mt-2 text-small text-ink-muted">We set up your channel, branding, positioning, structure, and content direction so everything starts on the right foundation.</p>
            </div>
            <div class="hidden" data-process-copy="existing">
              <h3 class="text-h3">Find What Is Already Working</h3>
              <p class="mt-2 text-small text-ink-muted">We identify your winning topics and benchmark you against competitors to see which formats and subjects are earning attention, and which are quietly costing you views.</p>
            </div>
          </div>
        </li>
        <li class="process-row" data-reveal="slide">
          <span class="process-node">03</span>
          <div class="process-body">
            <div data-process-copy="new">
              <h3 class="text-h3">Plan Content People Want</h3>
              <p class="mt-2 text-small text-ink-muted">We research topics, trends, competitors, and audience interests to create a content plan built around real opportunities.</p>
            </div>
            <div class="hidden" data-process-copy="existing">
              <h3 class="text-h3">Rebuild the Content Plan</h3>
              <p class="mt-2 text-small text-ink-muted">We analyse underperforming videos, adjust the strategy, and set a clear content direction — a plan built around the opportunities your existing audience data has already revealed.</p>
            </div>
          </div>
        </li>
        <li class="process-row" data-reveal="slide-right">
          <span class="process-node">04</span>
          <div class="process-body">
            <h3 class="text-h3">Produce the Complete Video</h3>
            <p class="mt-2 text-small text-ink-muted">Our team handles the entire production process—from research and scripting to voiceover, editing, thumbnail, and optimization.</p>
          </div>
        </li>
        <li class="process-row" data-reveal="slide">
          <span class="process-node">05</span>
          <div class="process-body">
            <h3 class="text-h3">Review, Refine &amp; Publish</h3>
            <p class="mt-2 text-small text-ink-muted">Every video goes through quality control before delivery. We refine the final product based on your feedback and prepare it for publishing.</p>
          </div>
        </li>
        <li class="process-row" data-reveal="slide-right">
          <span class="process-node">06</span>
          <div class="process-body">
            <h3 class="text-h3">Analyze, Improve &amp; Scale</h3>
            <p class="mt-2 text-small text-ink-muted">We study your channel data, identify what is working, find areas for improvement, and continuously refine the strategy.</p>
          </div>
        </li>
      </ol>
    </div>
  </section>
