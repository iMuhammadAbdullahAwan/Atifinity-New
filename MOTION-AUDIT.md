# Atifinity — Motion Audit (Phase 0)

Baseline audit of the shipped implementation, taken before any Phase 1+ change.
No files were modified while producing this document.

Scope: `index.html`, `src/css/input.css` (498 lines), 13 JS modules + `main.js`.

---

## 1. What the current system gets right

These are deliberate decisions and are **preserved, not replaced**, by the transformation.

| Decision | Where | Why it stays |
|---|---|---|
| Timing family 200 / 300 / 500 / 700 / 900ms | `input.css` throughout | Already a real scale with role separation |
| Signature easing `cubic-bezier(0.16, 1, 0.3, 1)` | hero + reveal + cards | Distinctive, consistent, well-chosen |
| Red = attention, Blue = commitment | palette comments + usage | A genuine semantic language, rare in template work |
| Only `transform` / `opacity` animated | everywhere | Compositor-friendly; no layout thrash |
| Service cards deliberately do **not** lift | `.service-card` | Ten simultaneous lifts would be noise — correct restraint |
| Native `<details>` for FAQ | `.faq-item` | Free keyboard + SR semantics, zero JS |
| Portfolio video `preload="none"` + `[data-src]` | `portfolio.js` | Nothing downloads until intent |
| Modal focus trap + restore + scroll lock | `video-modal.js`, `image-modal.js` | Correct dialog contract |
| Per-module reduced-motion guards | 8 modules | Not just the global CSS override |
| Canvas DPR capped at 2, paused when hidden | `background-motion.js` | Real performance discipline |
| Zero animation libraries | — | Bundle stays tiny |

---

## 2. Weaknesses found

### 2.1 Reveal monotony — highest-impact issue
17 `[data-reveal]` elements all use the **same** fade-up (24px, 700ms). Scrolling the page is
17 identical events. There is no rhythm, no variation of intensity, and no relationship between
the reveal mechanism and the content being revealed.

### 2.2 The hero entrance is a block fade
Seven elements stagger, but each moves as one rigid block. The headline — the single most
important element on the site — simply slides up. No masking, no line articulation, nothing that
reads as *composed*.

### 2.3 Portfolio images do not respond
Confirmed by inspection: the large portfolio `<img>` elements carry **no** hover transform. Only
the play badge scales (17 instances of `group-hover:scale-110`) and the scrim lightens. The
headline image — the actual content — is inert on hover.

### 2.4 Uncoordinated hover on work items
The project title and description live in a **sibling** `<div>`, outside the `.group` button, so
they cannot respond to hover at all. The result is a hover that affects the image box only, rather
than one coordinated interaction across the whole work item.

### 2.5 Hover states are not gated for touch
Component hovers (`hover:-translate-y-1`, scrim, badge scale) are unguarded. On touch devices
these can latch after a tap and stay applied, which reads as a stuck UI.

### 2.6 Nav underline is a hard swap
`.nav-link.is-active::after` appears at a fixed 16px width with no transition — the indicator
pops between sections rather than interpolating.

### 2.7 No link underline system
Inline links change colour only. There is no growing-underline affordance anywhere.

### 2.8 Buttons have position but no material
Hover is a 2px lift plus a fill change. There is no sheen, no press scale — no sense of a
physical surface being pressed.

### 2.9 Motion values are literals, not tokens
Durations and easings are typed inline at ~40 call sites. Changing the system's tempo means a
find-and-replace, and drift between values is invisible until it looks wrong.

### 2.10 Process node activation is understated
The node changes colour over 500ms. There is no moment of *confirmation* — nothing that reads as
"this step has been reached".

### 2.11 Case-study lightbox opens with a hard cut
The screenshot appears at full size instantly. The relationship between the thumbnail clicked and
the image shown is lost.

### 2.12 Flat motion intensity
Every section is animated at roughly the same level. There are no quiet passages and therefore no
peaks — the page never builds.

---

## 3. Performance risks

| Risk | Detail | Severity |
|---|---|---|
| Canvas O(n²) linking | 52 dots → 1,326 pair tests per frame | Low — measured cheap, capped by node count |
| Full-viewport `backdrop-blur` | Header + cards + modals | Low–medium on weak GPUs; blur reduced to `sm` already |
| Two rAF loops always running | background + strip drift | Acceptable; background pauses when hidden |
| Strip loops never pause when offscreen | `strip-loop.js` runs regardless of viewport | **Worth fixing** |

## 4. Accessibility findings

- Reduced-motion coverage is genuinely thorough — 8 modules guard themselves.
- Focus-visible styling exists on buttons and case-shot triggers, but **not** on nav links.
- Marquee clones are correctly `aria-hidden` and removed from the tab order.
- No hover-only information exists today (nothing is revealed only on hover), so adding
  hover-revealed metadata must keep that content reachable by keyboard focus.

## 5. Duplication

- `strip-loop.js` already de-duplicated the two marquees (done in a prior pass).
- Card surface treatment is repeated across `.card` / `.service-card` / `.pricing-tier` /
  `.pillar-card` — four near-identical declarations of border + glass + blur.

---

## 6. Opportunities, ranked by impact

1. **Diversify the reveal system** — the single biggest perceived-quality win.
2. **Line-masked hero headline** — makes the first impression feel composed.
3. **Coordinated portfolio hover** — one timeline across image, title, arrow, scrim.
4. **Context-aware cursor** over media — the signature agency detail.
5. **Thumbnail→modal expansion** for case studies.
6. **Motion tokens** — makes every later change one-line.
7. **Touch gating** — removes stuck hover states on mobile.
8. **Atmospheric background depth** — subtle red/blue wash behind the node field.

---

## 7. Intensity map (target)

| Section | Now | Target |
|---|---|---|
| Hero | ★★★ | ★★★★★ |
| Services | ★★★ | ★★★ |
| Portfolio | ★★★ | ★★★★★ |
| Process | ★★★ | ★★★★ |
| Case studies | ★★★ | ★★★★ |
| Pricing | ★★★ | ★★ |
| FAQ | ★★★ | ★ |
| Final CTA | ★★★ | ★★★★ |
| Footer | ★★★ | ★ |

The current profile is flat at ★★★. The target deliberately spends motion where the story needs
it and withdraws it where people are reading and comparing.

---

# Reference parity pass — what `ytagency.pro` actually does, and what we took

Audited by reading the reference's own compiled stylesheet and server-rendered
markup (its `_next/static/chunks/*.css` and initial HTML), not from screenshots —
so every number below is the reference's real value, not an estimate.

## What the reference's motion system is, measured

**Durations.** It is a fast site. Class usage across the page:
`duration-200` ×249, `duration-300` ×92, `duration-500` ×21, `duration-1000` ×9.
Hover response is 200ms almost everywhere; 500ms and 1000ms are reserved for
overlays and the light sweep. Our system's card hovers were running at 300ms.

**The signature gesture.** `hover:border-purple-500/50` (×130) paired with
`hover:shadow-[0_0_30px_rgba(147,51,234,0.3)]` (×82): a hovered surface tints
its border to the brand hue and blooms a same-hue halo. Nothing else on that
site repeats anywhere near as often. We had the border tint and no halo.

**Supporting vocabulary.**

| Gesture | Reference | Count |
|---|---|---|
| Surface scale on hover | `hover:scale-105` | 95 |
| Overlay/wash fading in under `.group` | `group-hover:opacity-100` | 186 |
| Light sweep | `-translate-x-full` → `group-hover:translate-x-full`, `duration-1000` | 9 |
| Icon tile tilt | `group-hover:scale-110 group-hover:rotate-3`, 300ms | 9 |
| Arrow nudge | `group-hover:translate-x-2` (8px) | 6 |
| Card lift | `hover:-translate-y-1` | 5 |

**Scroll reveals.** Seven mechanisms, not one — read off the initial inline
styles its animation library server-renders:

| Initial state | Count | Role |
|---|---|---|
| `translateY(20px) scale(0.8)` | 26 | cards expanding into place |
| `translateY(30px)` | 17 | standard rise |
| `translateY(20px)` | 9 | shorter rise |
| `translateY(-20px)` | 6 | arriving from above |
| `translateX(50px)` | 4 | from the right |
| `translateX(-50px)` | 3 | from the left |
| `opacity: 0` | 2 | pure fade |

**Ambient.** `liquid-shift` (15s background-position loop on gradient
surfaces), `blob` (20s translate+scale on background orbs), `ping` and `pulse`
on live indicators, `scroll-behavior: smooth` on `html`, and a header that
enters from `translateY(-100px)` on mount.

## What changed here, and why

Taken, reskinned to Atifinity's red/blue rather than the reference's single
purple, so the existing semantic (red = attention, blue = commitment) survives:

1. **Hover halo** — `--glow-primary` / `--glow-accent` (+ `-lg` variants) and a
   reusable `.glow-edge` modifier. Applied to service cards (small halo, still
   no lift — ten at once), hero pillars, portfolio frames, case-study shots,
   quote cards, and pricing. Alphas are 0.18–0.26 rather than the reference's
   0.3–0.6: our ground is darker and red blooms harder than purple, so the
   values were matched by eye at equal perceived intensity, not copied.
2. **`.sheen`** — the light sweep, as one class and a pseudo-element rather
   than the reference's two nested divs per card. On service and pillar cards.
   Runs on the way in only; a sweep that reverses on mouse-out reads as a bug.
3. **Snappier surface response** — card border/background/halo moved from
   `--motion-standard` (300ms) to `--motion-ui` (220ms), matching the
   reference's 200ms. Larger transforms stay at 300ms.
4. **Icon tilt** — `--tilt-icon: 3deg` on hero pillar badges and the portfolio
   play badge, driven from the card's hover so the card is one interaction.
5. **Three new reveal variants** — `pop` (the reference's scale reveal, at 0.9
   not 0.8: 0.8 on a full-width block reads as the page zooming), `drop`, and
   `slide-right`. `slide` widened to 44px; lateral travel needs distance to
   read as direction.
6. **`data-reveal-child`** — a stagger group can now pick its children's
   mechanism, so the pricing grid staggers with `pop` while lists stay quiet.
   This also fixed a latent bug: the variant rules were scoped
   `[data-reveal][data-reveal-variant=…]`, and staggered children never carry
   `data-reveal`, so until now they faded without travel.
7. **Per-row process reveals** — the six timeline rows alternate `slide` /
   `slide-right` matching their own left/right placement, instead of the whole
   2,000px timeline revealing as one block and leaving the screen blank.
8. **Header entrance** — slides down from off-screen, in CSS with fill-mode
   `both` so it does not wait on a script.
9. **Ping on the trust dot** — the reference's live indicator, slowed from its
   1s pulse to a 3.4s breath. At 1s a marketing badge nags.
10. **`overflow-x: clip` on body** — right-entering reveals park past the
    viewport edge; without this the browser flashes a horizontal scrollbar on
    every one. `clip`, not `hidden`, so `position: sticky` keeps working.

## What was deliberately not taken

- **`hover:scale-105` on pricing cards.** Four tiers side by side is the one
  place on the page where a card growing under the pointer moves the number
  the reader is mid-comparison on. Pricing gets the reference's *widest* halo
  (50px) and none of its scale.
- **`hover:scale-105` on service cards.** Ten simultaneous scaling cards is
  noise; this was already the shipped decision and the audit above still holds.
- **`scale(0.8)` reveals.** Correct on the reference's small floating cards,
  wrong on our full-width blocks — kept the mechanism, pulled the value to 0.9.
