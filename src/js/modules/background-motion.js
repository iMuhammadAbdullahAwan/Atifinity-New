/**
 * background-motion.js — the full-bleed particle-network background.
 *
 * This is the reference site's own background idea (a canvas of small
 * glowing nodes connected by faint lines, always present behind every
 * section) rebuilt from scratch in Atifinity's red/blue palette instead
 * of the reference's purple/pink — a plain 2D canvas with no particle
 * library, since nothing here needs more than "move some dots, draw lines
 * between the close ones."
 *
 * Two independent layers share the canvas:
 *
 *   1. The dot network — small red/blue dots that link to each other
 *      with faint lines whenever they drift close together.
 *   2. The brand marks — the red/blue triangular "A" from the logo,
 *      traced as canvas paths, replacing the reference site's own moving
 *      background logo with Atifinity's shape and colors.
 *
 * The two never touch. A mark is deliberately NOT a node: it draws no
 * link lines to the dots or to the other marks, and takes no part in the
 * proximity linking at all. It just wanders the field on its own — the
 * network is one thing, the marks floating over it are another.
 *
 * Performance: node count scales down with viewport width (fewer on
 * phones), the canvas is sized at a capped device-pixel-ratio so a 3x
 * phone screen doesn't triple the pixel-fill cost, the animation loop
 * stops entirely while the tab is hidden (visibilitychange), and the
 * whole thing never starts under prefers-reduced-motion — a single
 * static, motionless frame is drawn instead so the background still has
 * texture without any movement.
 */
window.Atifinity = window.Atifinity || {};

Atifinity.initBackgroundMotion = function initBackgroundMotion() {
  var canvas = document.getElementById('brandField');
  if (!canvas) return;
  var ctx = canvas.getContext('2d');
  if (!ctx) return;

  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // Atifinity's two brand hues — every node is one or the other, never a
  // third color, matching the "two hues, one job each" rule everywhere
  // else on the site.
  var COLORS = ['227,34,39', '30,60,255']; // red, blue — as r,g,b for rgba()
  var LINK_DISTANCE = 150;
  var LINK_DISTANCE_SQ = LINK_DISTANCE * LINK_DISTANCE;

  // Marks move faster than the dots and wander instead of tracking a
  // straight line: every frame nudges the heading slightly at random,
  // then the speed is clamped back into this band — so they never stall
  // and never accelerate away, they just keep roaming.
  var LOGO_MIN_SPEED = 0.22;
  var LOGO_MAX_SPEED = 0.55;
  var LOGO_WANDER = 0.014;
  var LOGO_REPEL_DIST = 120;
  var LOGO_REPEL_STRENGTH = 0.008;
  var LOGO_NODE_BUFFER = 80;
  var LOGO_NODE_PUSH = 0.012;

  var dpr = Math.min(window.devicePixelRatio || 1, 2);
  var width = 0;
  var height = 0;
  var particles = []; // dots only — the linked network
  var logos = []; // free-floating marks — never linked to anything
  var raf = null;
  // Scroll-linked parallax: the canvas itself is position:fixed (so the
  // field never scrolls away), but the reference site's own background
  // visibly drifts as the page scrolls — approximated here by nudging
  // every node's *drawn* y-position (never its simulated position) by a
  // fraction of scrollY, wrapped with the same modulo trick the work-strip
  // loop uses, so nodes continuously recycle in from one edge as you
  // scroll instead of the field ever visibly running out or jumping.
  var scrollY = window.scrollY || 0;
  var PARALLAX = 0.12;
  var MAX_PARTICLE_DEGREE = 2;
  var MIN_EDGE_LEN = 40;
  var MAX_EDGE_LEN = 130;
  var MIN_EDGE_LEN_SQ = MIN_EDGE_LEN * MIN_EDGE_LEN;
  var MAX_EDGE_LEN_SQ = MAX_EDGE_LEN * MAX_EDGE_LEN;
  var MIN_COMPACTNESS = 0.45;    // min(side) / max(side) — rejects skinny triangles

  // Reusable per-frame buffers for the triangle-cluster builder — sized
  // once in seed(), cleared and filled every frame in drawFrame().
  var _deg = [];   // per-particle connection count
  var _adj = [];   // flat n×n pair-distance map (0 = no valid pair)

  function particleCount(w) {
    if (w < 640) return 18;
    if (w < 1024) return 34;
    return 52;
  }

  // Enough marks that several are in view at any scroll position — the
  // canvas is only one viewport tall, so a sparse handful meant whole
  // sections could scroll by without a single mark on screen.
  function logoCount(w) {
    if (w < 640) return 3;
    if (w < 1024) return 6;
    return 10;
  }

  function logoBaseScale(w) {
    if (w < 640) return 0.85;
    if (w < 1024) return 1.1;
    return 1.35;
  }

  function seed() {
    var count = particleCount(width);
    particles = [];
    for (var i = 0; i < count; i++) {
      particles.push({
        x: Math.random() * width,
        y: Math.random() * height,
        vx: (Math.random() - 0.5) * 0.18,
        vy: (Math.random() - 0.5) * 0.18,
        r: Math.random() * 1.4 + 1.1,
        color: COLORS[i % 2],
        // Per-particle pulse: a random starting phase + a per-dot speed
        // (~20-40s per cycle) keeps the field from ever blinking in
        // lockstep, so each red/blue dot glows on its own rhythm.
        pulse: Math.random() * Math.PI * 2,
        pulseSpeed: 0.015 + Math.random() * 0.015
      });
    }

    // Size the triangle-cluster bookkeeping for the current particle count.
    _deg = new Array(count);
    _adj = new Array(count * count);

    // Marks live in their own array, so the link loop below can't see
    // them at all — that's what keeps each one independent of the
    // network and of the other marks. Each starts on a random heading
    // at a random speed inside the band.
    //
    // Stratified sampling: divide the viewport into a grid of cells and
    // place one mark per cell with random jitter — this guarantees an
    // even spatial spread on every seed while still looking organic.
    var lCount = logoCount(width);
    var baseScale = logoBaseScale(width);
    logos = [];
    var cols = Math.max(1, Math.ceil(Math.sqrt(lCount * (width / height))));
    var rows = Math.max(1, Math.ceil(lCount / cols));
    var cellW = width / cols;
    var cellH = height / rows;
    for (var j = 0; j < lCount; j++) {
      var col = j % cols;
      var row = Math.floor(j / cols);
      var angle = Math.random() * Math.PI * 2;
      var speed = LOGO_MIN_SPEED + Math.random() * (LOGO_MAX_SPEED - LOGO_MIN_SPEED);
      logos.push({
        x: (col + 0.15 + Math.random() * 0.7) * cellW,
        y: (row + 0.15 + Math.random() * 0.7) * cellH,
        vx: Math.cos(angle) * speed,
        vy: Math.sin(angle) * speed,
        rotation: Math.random() * Math.PI * 2,
        rotationSpeed: (Math.random() - 0.5) * 0.004,
        scale: baseScale * (0.85 + Math.random() * 0.3),
        // Breathing cycle: a random starting phase plus a per-mark speed
        // (~13-26s per full swell) keeps the field from ever pulsing in
        // lockstep, which is what would make it look mechanical.
        pulse: Math.random() * Math.PI * 2,
        pulseSpeed: 0.004 + Math.random() * 0.004
      });
    }
  }

  // Traces the same two-tone "A" as assets/brand/logo.svg — red left
  // stroke, blue right stroke + crossbar — as canvas paths centered on
  // their own origin so they can be positioned/rotated/scaled like any
  // other node. Coordinates are the logo's own path points shifted so
  // (20, 19.5), the mark's bounding-box center, sits at (0, 0).
  function drawLogoMark(x, y, scale, rotation, alpha) {
    ctx.save();
    ctx.translate(x, y);
    ctx.rotate(rotation);
    ctx.scale(scale, scale);
    ctx.globalAlpha = alpha;

    ctx.fillStyle = 'rgb(227,34,39)';
    ctx.beginPath();
    ctx.moveTo(0, -15.5);
    ctx.lineTo(-16, 15.5);
    ctx.lineTo(-8, 15.5);
    ctx.lineTo(5, -5.5);
    ctx.closePath();
    ctx.fill();

    ctx.fillStyle = 'rgb(30,60,255)';
    ctx.beginPath();
    ctx.moveTo(7.5, -3.5);
    ctx.lineTo(16, 15.5);
    ctx.lineTo(8.5, 15.5);
    ctx.lineTo(2, 2.5);
    ctx.closePath();
    ctx.fill();

    ctx.beginPath();
    ctx.moveTo(-2, 8.5);
    ctx.lineTo(5, 8.5);
    ctx.lineTo(7, 15.5);
    ctx.lineTo(-6.5, 15.5);
    ctx.closePath();
    ctx.fill();

    ctx.restore();
  }

  // A node's on-screen y: its simulated y shifted by the scroll parallax
  // and wrapped back into [0, height). Simulation coordinates are never
  // touched by this, so the field can appear to drift with the page
  // while the underlying motion stays stable.
  //
  // Every frame this is resolved once per node into `.sy`, and both the
  // link test AND the link drawing then use `.sy` — they have to agree.
  // Measuring proximity on the simulated y while drawing at the wrapped
  // y meant a pair straddling the wrap seam measured as neighbours but
  // drew as a line stretched the full height of the screen, which is
  // what made lines visibly grow while scrolling.
  function screenY(y) {
    var sy = (y + scrollY * PARALLAX) % height;
    return sy < 0 ? sy + height : sy;
  }

  // Fades a mark out as it approaches any edge of the field, so it
  // dissolves instead of popping when it wraps — including the wrap the
  // scroll parallax drags it through.
  function edgeFade(x, y) {
    var margin = 150;
    var nearest = Math.min(x, width - x, y, height - y);
    if (nearest <= 0) return 0;
    return nearest >= margin ? 1 : nearest / margin;
  }

  function resize() {
    width = window.innerWidth;
    height = window.innerHeight;
    canvas.width = width * dpr;
    canvas.height = height * dpr;
    canvas.style.width = width + 'px';
    canvas.style.height = height + 'px';
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    seed();
  }

  function drawFrame(move) {
    ctx.clearRect(0, 0, width, height);

    if (move) {
      particles.forEach(function (p) {
        p.x += p.vx;
        p.y += p.vy;
        if (p.x < 0) p.x = width;
        else if (p.x > width) p.x = 0;
        if (p.y < 0) p.y = height;
        else if (p.y > height) p.y = 0;
        p.pulse += p.pulseSpeed;
      });

      for (var li = 0; li < logos.length; li++) {
        var l = logos[li];
        // Random walk: nudge the heading, then pull the speed back into
        // the band so it neither stalls nor runs away.
        l.vx += (Math.random() - 0.5) * LOGO_WANDER;
        l.vy += (Math.random() - 0.5) * LOGO_WANDER;

        // Soft logo-to-logo repulsion — keeps marks from clustering
        // during random-walk drift. The push is proportional to how
        // far inside the threshold the pair is, so it fades to zero
        // at the edge and never causes a visible bounce.
        for (var lj = 0; lj < logos.length; lj++) {
          if (lj === li) continue;
          var other = logos[lj];
          var rdx = l.x - other.x;
          var rdy = l.y - other.y;
          if (Math.abs(rdy) > height / 2) continue;
          var rd2 = rdx * rdx + rdy * rdy;
          if (rd2 < LOGO_REPEL_DIST * LOGO_REPEL_DIST && rd2 > 0.001) {
            var rd = Math.sqrt(rd2);
            var pushFactor = (1 - rd / LOGO_REPEL_DIST) * LOGO_REPEL_STRENGTH;
            l.vx += (rdx / rd) * pushFactor;
            l.vy += (rdy / rd) * pushFactor;
          }
        }

        // Soft logo-to-particle avoidance — steers marks away from
        // the network's nodes so they don't sit on top of dots/lines.
        for (var pi = 0; pi < particles.length; pi++) {
          var pt = particles[pi];
          var ndx = l.x - pt.x;
          var ndy = l.y - pt.y;
          if (Math.abs(ndy) > height / 2) continue;
          var nd2 = ndx * ndx + ndy * ndy;
          if (nd2 < LOGO_NODE_BUFFER * LOGO_NODE_BUFFER && nd2 > 0.001) {
            var nd = Math.sqrt(nd2);
            var nodePush = (1 - nd / LOGO_NODE_BUFFER) * LOGO_NODE_PUSH;
            l.vx += (ndx / nd) * nodePush;
            l.vy += (ndy / nd) * nodePush;
          }
        }

        var speed = Math.sqrt(l.vx * l.vx + l.vy * l.vy);
        if (speed > LOGO_MAX_SPEED) {
          l.vx = (l.vx / speed) * LOGO_MAX_SPEED;
          l.vy = (l.vy / speed) * LOGO_MAX_SPEED;
        } else if (speed < LOGO_MIN_SPEED) {
          // speed can only be 0 if both components are, which the nudge
          // above makes vanishingly unlikely — but guard the divide.
          if (speed > 0.0001) {
            l.vx = (l.vx / speed) * LOGO_MIN_SPEED;
            l.vy = (l.vy / speed) * LOGO_MIN_SPEED;
          } else {
            l.vx = LOGO_MIN_SPEED;
            l.vy = 0;
          }
        }

        l.x += l.vx;
        l.y += l.vy;
        if (l.x < 0) l.x = width;
        else if (l.x > width) l.x = 0;
        if (l.y < 0) l.y = height;
        else if (l.y > height) l.y = 0;
        l.rotation += l.rotationSpeed;
        l.pulse += l.pulseSpeed;
      }
    }

    // Resolve every on-screen y once per frame. Both the link test and
    // the link drawing below read these, so a line can never be drawn
    // between two points further apart than the test allowed.
    particles.forEach(function (p) { p.sy = screenY(p.y); });
    logos.forEach(function (l) { l.sy = screenY(l.y); });

    // --- Sparse triangle clusters ---------------------------------------
    // Build small independent triangular groups rather than one globally
    // connected network.  Stage 1 populates a pair-distance map inside
    // the pre-allocated _adj buffer, Stage 2 enumerates compact triangle
    // candidates, Stage 3 greedily selects the best ones under a strict
    // per-particle degree cap, and Stage 4 draws their edges.
    //
    // Links first (so dots draw on top of their own connecting lines).
    // Only ever dot-to-dot — the marks aren't in this array.
    var n = particles.length;
    var nSq = n * n;

    // Stage 1 — pair-distance map.
    for (var i = 0; i < nSq; i++) _adj[i] = 0;
    for (var i = 0; i < n; i++) {
      for (var j = i + 1; j < n; j++) {
        var dx = particles[i].x - particles[j].x;
        var dy = particles[i].sy - particles[j].sy;
        // Existing wrap-seam protection.
        if (Math.abs(dy) > height / 2) continue;
        var dSq = dx * dx + dy * dy;
        if (dSq < MIN_EDGE_LEN_SQ || dSq > MAX_EDGE_LEN_SQ) continue;
        var dist = Math.sqrt(dSq);
        _adj[i * n + j] = dist;
        _adj[j * n + i] = dist;
      }
    }

    // Stage 2 — enumerate compact triangle candidates.
    var tris = [];
    for (var i = 0; i < n; i++) {
      for (var j = i + 1; j < n; j++) {
        var dij = _adj[i * n + j];
        if (dij === 0) continue;
        for (var k = j + 1; k < n; k++) {
          var dik = _adj[i * n + k];
          if (dik === 0) continue;
          var djk = _adj[j * n + k];
          if (djk === 0) continue;
          // All three sides valid — check compactness.
          var mn = Math.min(dij, dik, djk);
          var mx = Math.max(dij, dik, djk);
          var compact = mn / mx;
          if (compact < MIN_COMPACTNESS) continue;
          // Score: compactness first, shorter perimeter as tiebreaker.
          tris.push({ a: i, b: j, c: k, s: compact - (dij + dik + djk) * 0.0001 });
        }
      }
    }

    // Stage 3 — greedy selection (best compact triangles first).
    tris.sort(function (x, y) { return y.s - x.s; });
    for (var i = 0; i < n; i++) _deg[i] = 0;

    for (var t = 0; t < tris.length; t++) {
      var ta = tris[t].a, tb = tris[t].b, tc = tris[t].c;
      if (_deg[ta] >= MAX_PARTICLE_DEGREE ||
          _deg[tb] >= MAX_PARTICLE_DEGREE ||
          _deg[tc] >= MAX_PARTICLE_DEGREE) continue;
      // Accept — each vertex gains exactly 2 connections (the other two
      // corners), which is the natural degree of a triangle vertex.
      _deg[ta] += 2; _deg[tb] += 2; _deg[tc] += 2;

      // Stage 4 — draw the three edges of this triangle.
      var pa = particles[ta], pb = particles[tb], pc = particles[tc];
      var d1 = _adj[ta * n + tb], d2 = _adj[tb * n + tc], d3 = _adj[ta * n + tc];
      var t1 = 1 - (d1 * d1) / LINK_DISTANCE_SQ;
      var t2 = 1 - (d2 * d2) / LINK_DISTANCE_SQ;
      var t3 = 1 - (d3 * d3) / LINK_DISTANCE_SQ;

      ctx.lineWidth = 1;
      ctx.strokeStyle = 'rgba(122,150,255,' + (t1 * 0.14).toFixed(3) + ')';
      ctx.beginPath(); ctx.moveTo(pa.x, pa.sy); ctx.lineTo(pb.x, pb.sy); ctx.stroke();
      ctx.strokeStyle = 'rgba(122,150,255,' + (t2 * 0.14).toFixed(3) + ')';
      ctx.beginPath(); ctx.moveTo(pb.x, pb.sy); ctx.lineTo(pc.x, pc.sy); ctx.stroke();
      ctx.strokeStyle = 'rgba(122,150,255,' + (t3 * 0.14).toFixed(3) + ')';
      ctx.beginPath(); ctx.moveTo(pa.x, pa.sy); ctx.lineTo(pc.x, pc.sy); ctx.stroke();
    }

    // Particle rendering — each dot pulses/glows in its OWN color (red
    // stays red, blue stays blue).  The pulse modulates intensity and
    // adds a subtle outer glow ring; desynchronised phases ensure the
    // field never strobes.
    particles.forEach(function (p) {
      var breath = Math.sin(p.pulse) * 0.5 + 0.5; // 0 … 1
      var alpha = 0.40 + breath * 0.40;            // 0.40 … 0.80

      // Subtle outer glow (same color, lower alpha, larger radius).
      if (breath > 0.25) {
        ctx.beginPath();
        ctx.fillStyle = 'rgba(' + p.color + ',' + (breath * 0.10).toFixed(3) + ')';
        ctx.arc(p.x, p.sy, p.r + 2.5 + breath * 2, 0, Math.PI * 2);
        ctx.fill();
      }

      // Core dot.
      ctx.beginPath();
      ctx.fillStyle = 'rgba(' + p.color + ',' + alpha.toFixed(3) + ')';
      ctx.arc(p.x, p.sy, p.r + breath * 0.3, 0, Math.PI * 2);
      ctx.fill();
    });

    // Marks last, so they float over the network rather than inside it.
    // Each one breathes on its own slow sine cycle: it swells and
    // brightens together, then settles back — the two moving as one is
    // what reads as depth (something drifting nearer, then away) rather
    // than a shape being resized. Phase and period differ per mark, so
    // they never pulse in unison, and the edge fade dissolves them at
    // the boundaries instead of letting them pop.
    logos.forEach(function (l) {
      var breath = Math.sin(l.pulse); // -1 .. 1
      var scale = l.scale * (1 + 0.14 * breath);
      var alpha = 0.2 * (0.72 + 0.28 * (breath * 0.5 + 0.5)) * edgeFade(l.x, l.sy);
      if (alpha <= 0.002) return;
      drawLogoMark(l.x, l.sy, scale, l.rotation, alpha);
    });
  }

  function tick() {
    drawFrame(true);
    raf = window.requestAnimationFrame(tick);
  }

  resize();
  window.addEventListener('resize', resize, { passive: true });

  if (reduceMotion) {
    drawFrame(false);
    return;
  }

  // Only records the position — the running rAF loop picks it up on its
  // next frame, so a fast scroll never queues a burst of extra draws.
  window.addEventListener('scroll', function () {
    scrollY = window.scrollY;
  }, { passive: true });

  document.addEventListener('visibilitychange', function () {
    if (document.hidden) {
      if (raf) window.cancelAnimationFrame(raf);
      raf = null;
    } else if (!raf) {
      raf = window.requestAnimationFrame(tick);
    }
  });

  raf = window.requestAnimationFrame(tick);
};
