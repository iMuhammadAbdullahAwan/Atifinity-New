# Atifinity — v2 Design

A ground-up rebuild of the Atifinity marketing site, built as a fresh, self-contained project — it does not modify or depend on the earlier `Atifinity/` or `yt-landing-template/` folders at runtime. Those two remain the source of truth for real brand/portfolio assets and were used as reference only. Layout and pacing take direct inspiration from `ytagency.pro` (the client's reference site) where asked, rebuilt on Atifinity's own red/blue system and real content rather than copied wholesale.

## Running it

```bash
npm install
npm run build   # compiles src/css + src/js into dist/
```

Then open `index.html` directly, or serve the folder with any static file server (the JS is written as plain `<script>` tags, not ES modules, specifically so the page also works opened straight from disk via `file://`).

`npm run build` runs three steps (see `package.json`):
1. `build:css` — Tailwind v4 CLI compiles `src/css/input.css` → `dist/css/output.css`
2. `build:js` — esbuild minifies each `src/js/**/*.js` module individually into `dist/js/`
3. `build:bundle` — `scripts/bundle-js.mjs` concatenates those into one `dist/js/app.js`

## Content

Copy comes from two places:
- **`../YouTube_Growth_Automation_Website_Master_Copy.docx`** (hero, 10 services, 6-step process, 4 pricing tiers, 6 FAQs, final CTA) — used verbatim, not rewritten or shortened.
- **Portfolio one-line captions** and the **Services/hero card taglines reused as teasers** — the source document has no per-video descriptions and neither does the reference site, so these are original short descriptive captions written for this build (topic-based, e.g. "Inside the rise and reach of a global drug cartel." for *Drug Cartel*) rather than claims of fact. Flag any that don't match the actual video for a quick edit.

Nothing else is invented — see "Known gaps" below for what's still missing on purpose.

## Assets

- **Brand mark, favicon, hero graphic, OG cover** — copied unmodified from `../../Atifinity/assets/img/` into `assets/brand/`.
- **Fonts** — Geist + Geist Mono, self-hosted (`assets/fonts/`), copied from `../../yt-landing-template/assets/fonts/`. This is the exact family the reference site (`ytagency.pro`) itself uses — confirmed from its own `@font-face` rules and computed styles, not guessed. Replaces the earlier Archivo / Archivo Expanded / JetBrains Mono stack.
- **Portfolio** — the real 17 videos from `../../Atifinity/assets/portfolio/` (1.2GB of source `.mp4`s) were transcoded, not copied as-is, into three tiers under `assets/portfolio/`:
  - `posters/` — one JPG frame per video (poster image, ~110KB avg)
  - `previews/` — silent, 7-second, 640px-wide clips for the hover/viewport preview (~220KB avg, 3.8MB total for all 17)
  - `full/` — 1280px-wide, audio-kept, `crf 25` compressed versions for the modal player (244MB total, down from 1.2GB — still loaded only on click, never eagerly)

  Source videos were left untouched in the original `Atifinity/` project; this is a one-way, one-time transcode (ffmpeg), not a build step, so re-run it by hand if the source videos ever change.
- **`assets/result-and-growth/`** — six real YouTube Studio screenshots the client supplied directly (revenue, views, subscriber growth, month-over-month trend). Renamed from their original `WhatsApp Image ….jpeg` filenames to descriptive slugs; otherwise unedited — any numbers the client had already blurred in their own screenshot stay blurred here. These back the Case Studies section's stat row and captions; every number shown is read directly off one of these images, not invented.

## Structure

```
index.html            All markup, one file, exact section order: nav → hero →
                       services → work (+ case studies) → process → pricing →
                       faq → final CTA → footer → video modal
src/css/input.css      Single-mode (no light/dark) design system — tokens,
                       components, the layered SVG-background keyframes,
                       and the hero entrance CSS
src/js/main.js          Boot sequence
src/js/modules/*.js     One focused module per behavior (nav, reveal,
                       magnetic-button, cursor-glow, background-motion,
                       hero, process, portfolio, video-modal, whatsapp)
                       — see DESIGN-SYSTEM.md in the parent folder for the
                       motion principles these follow
assets/brand/           Logo, favicon, hero graphic, OG image
assets/portfolio/       posters/ previews/ full/ (see above)
assets/result-and-growth/  Real client analytics screenshots (Case Studies)
scripts/bundle-js.mjs    JS concatenation step
```

## Known gaps (need client input, not filled with placeholders)

- **Testimonials** — no section exists; the client document supplied none and none should be invented. Add one once real quotes exist.
- **Pricing figures** — all four tiers resolve to "Custom quote — scoped on a call" since the source document named the tiers but not the prices.
- **"Why Atifinity" positioning** (direct WhatsApp access, one-team model) from the previous build was intentionally left out of this version — it wasn't in the client's approved document, so it needs an explicit yes/no from the client before it's added back in.
- **Portfolio captions** — see "Content" above; these are original descriptive copy, not client-supplied, and should be spot-checked against the actual videos.
- **Case-studies screenshot attribution** — the six real Studio screenshots aren't labeled with a channel name or client name (none was supplied); captions describe only what's visibly on screen.

## What Creators Say — DUMMY CONTENT, must be replaced before launch

The eight quotes in the `#creators` section are **dummy placeholders**, written
to exercise the layout. They are realistic on purpose: placeholder text that
reads as placeholder cannot show whether the card design survives real sentence
lengths. **They are not real client feedback and must not go live as-is.**

Every card carries a `data-placeholder` attribute. Before launch:

    grep -c 'data-placeholder' index.html

If that returns anything above zero, real quotes have not been supplied yet.
For each card, replace the quote, name, niche, channel and subscriber count
with the real ones, then remove that card's `data-placeholder` attribute.

### Design notes

Card anatomy follows the reference site's own testimonial card — quote glyph
top-right, large relaxed quote, 48px initials avatar, name / niche · channel /
subscriber count, colour wash and blurred corner orb on hover — reskinned onto
the red-blue system. The reference's own testimonial is itself a placeholder
persona ("Alex Rivera / TechGenius / 150K"), so nothing real was carried across.

One deliberate departure: the reference drops a coloured 50px glow behind the
card on hover. This system has held a "neutral shadows only" rule from the
start, and a red halo behind a red border reads as a warning state rather than
depth, so the corner orb carries that job instead.

The rail is a snap-aligned horizontal scroller. Its controls sit centred
BELOW the cards in one row — previous, a dot per quote, next — following the
reference layout. The active dot stretches into a short pill rather than only
changing colour, because a width change is what makes position readable at a
glance; colour alone on an 8px dot is close to invisible on a dark ground.

Dots are generated in review-strip.js from the card count, so adding or
removing a quote never leaves a stale indicator behind, and each is a real
button with a real label rather than a decorative span.

The rail deliberately does NOT auto-scroll, unlike the portfolio and
case-study rails: those show images that read at a glance, these are
sentences, and text that slides away mid-sentence is the worst habit of a
testimonial carousel. The controls are progressive enhancement — hidden until
JS wires them, and the rail is a native scroll container that works with
trackpad, touch, drag and keyboard regardless.

## Assets

- **Brand mark, favicon, hero graphic, OG cover** — copied unmodified from `../../Atifinity/assets/img/` into `assets/brand/`.
- **Fonts** — Geist + Geist Mono, self-hosted (`assets/fonts/`), copied from `../../yt-landing-template/assets/fonts/`. This is the exact family the reference site (`ytagency.pro`) itself uses — confirmed from its own `@font-face` rules and computed styles, not guessed. Replaces the earlier Archivo / Archivo Expanded / JetBrains Mono stack.
- **Portfolio** — the real 17 videos from `../../Atifinity/assets/portfolio/` (1.2GB of source `.mp4`s) were transcoded, not copied as-is, into three tiers under `assets/portfolio/`:
  - `posters/` — one JPG frame per video (poster image, ~110KB avg)
  - `previews/` — silent, 7-second, 640px-wide clips for the hover/viewport preview (~220KB avg, 3.8MB total for all 17)
  - `full/` — 1280px-wide, audio-kept, `crf 25` compressed versions for the modal player (244MB total, down from 1.2GB — still loaded only on click, never eagerly)

  Source videos were left untouched in the original `Atifinity/` project; this is a one-way, one-time transcode (ffmpeg), not a build step, so re-run it by hand if the source videos ever change.
- **`assets/result-and-growth/`** — six real YouTube Studio screenshots the client supplied directly (revenue, views, subscriber growth, month-over-month trend). Renamed from their original `WhatsApp Image ….jpeg` filenames to descriptive slugs; otherwise unedited — any numbers the client had already blurred in their own screenshot stay blurred here. These back the Case Studies section's stat row and captions; every number shown is read directly off one of these images, not invented.

## Structure

```
index.html            All markup, one file, exact section order: nav → hero →
                       services → work (+ case studies) → process → pricing →
                       faq → final CTA → footer → video modal
src/css/input.css      Single-mode (no light/dark) design system — tokens,
                       components, the layered SVG-background keyframes,
                       and the hero entrance CSS
src/js/main.js          Boot sequence
src/js/modules/*.js     One focused module per behavior (nav, reveal,
                       magnetic-button, cursor-glow, background-motion,
                       hero, process, portfolio, video-modal, whatsapp)
                       — see DESIGN-SYSTEM.md in the parent folder for the
                       motion principles these follow
assets/brand/           Logo, favicon, hero graphic, OG image
assets/portfolio/       posters/ previews/ full/ (see above)
assets/result-and-growth/  Real client analytics screenshots (Case Studies)
scripts/bundle-js.mjs    JS concatenation step
```

## Known gaps (need client input, not filled with placeholders)

- **Testimonials** — no section exists; the client document supplied none and none should be invented. Add one once real quotes exist.
- **Pricing figures** — all four tiers resolve to "Custom quote — scoped on a call" since the source document named the tiers but not the prices.
- **"Why Atifinity" positioning** (direct WhatsApp access, one-team model) from the previous build was intentionally left out of this version — it wasn't in the client's approved document, so it needs an explicit yes/no from the client before it's added back in.
- **Portfolio captions** — see "Content" above; these are original descriptive copy, not client-supplied, and should be spot-checked against the actual videos.
- **Case-studies screenshot attribution** — the six real Studio screenshots aren't labeled with a channel name or client name (none was supplied); captions describe only what's visibly on screen.

## What Creators Say — DUMMY CONTENT, must be replaced before launch

The eight quotes in the `#creators` section are **dummy placeholders**, written
to exercise the layout. They are realistic on purpose: placeholder text that
reads as placeholder cannot show whether the card design survives real sentence
lengths. **They are not real client feedback and must not go live as-is.**

Every card carries a `data-placeholder` attribute. Before launch:

    grep -c 'data-placeholder' index.html

If that returns anything above zero, real quotes have not been supplied yet.
For each card, replace the quote, name, niche, channel and subscriber count
with the real ones, then remove that card's `data-placeholder` attribute.

### Design notes

Card anatomy follows the reference site's own testimonial card — quote glyph
top-right, large relaxed quote, 48px initials avatar, name / niche · channel /
subscriber count, colour wash and blurred corner orb on hover — reskinned onto
the red-blue system. The reference's own testimonial is itself a placeholder
persona ("Alex Rivera / TechGenius / 150K"), so nothing real was carried across.

One deliberate departure: the reference drops a coloured 50px glow behind the
card on hover. This system has held a "neutral shadows only" rule from the
start, and a red halo behind a red border reads as a warning state rather than
depth, so the corner orb carries that job instead.

The rail is a snap-aligned horizontal scroller with prev/next buttons
(`review-strip.js`). It deliberately does **not** auto-scroll, unlike the
portfolio and case-study rails: those show images that read at a glance, these
are sentences, and text that slides away mid-sentence is the worst habit of a
testimonial carousel. The buttons are progressive enhancement — they stay
hidden until JS wires them, and the rail is a native scroll container that
works with trackpad, touch, drag and keyboard regardless.

## Assets — nothing copied from the reference site

No image was taken from ytagency.pro. Checked directly: the testimonial section
there contains **zero** images — the avatar is initials in a CSS gradient circle
and the quote mark is an inline SVG icon, both rebuilt here from scratch. The
"Trusted by 100+ YouTubers" pill is text plus a CSS dot, no image.

The ~104 images elsewhere on that page are its own portfolio thumbnails and
client work — another agency's copyrighted assets, not reused here. Atifinity's
portfolio already runs on its own 17 real productions.

The hero trust pill deliberately does NOT copy "Trusted by 100+ YouTubers" — no
client count has been supplied, so inventing one would put an unverifiable
business claim on a live page. It links to the real YouTube Studio screenshots
instead of asserting a number.
