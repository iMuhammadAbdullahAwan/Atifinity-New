// bundle-js.mjs — concatenates the already-minified per-module output from
// esbuild into a single dist/js/app.js, so the page ships one script
// request instead of eleven (see the original Atifinity project's version
// of this file for the bandwidth-constrained-connection rationale — it
// applies unchanged here).
//
// Order matters only in that main.js's boot() must run after every
// Atifinity.init* function has been assigned, so it's concatenated last;
// the modules before it just assign functions onto the shared `Atifinity`
// namespace and don't depend on each other's order.
import { readFileSync, writeFileSync, mkdirSync } from 'node:fs';
import { dirname } from 'node:path';

const files = [
  'dist/js/modules/whatsapp.js',
  'dist/js/modules/nav.js',
  'dist/js/modules/reveal.js',
  'dist/js/modules/magnetic-button.js',
  'dist/js/modules/cursor-glow.js',
  'dist/js/modules/context-cursor.js',
  'dist/js/modules/background-motion.js',
  'dist/js/modules/hero.js',
  'dist/js/modules/process.js',
  'dist/js/modules/strip-loop.js',
  'dist/js/modules/portfolio.js',
  'dist/js/modules/case-studies.js',
  'dist/js/modules/review-strip.js',
  'dist/js/modules/video-modal.js',
  'dist/js/modules/image-modal.js',
  'dist/js/main.js',
];

const outFile = 'dist/js/app.js';

const bundle = files
  .map((f) => readFileSync(f, 'utf8').trim())
  .join('\n');

mkdirSync(dirname(outFile), { recursive: true });
writeFileSync(outFile, bundle + '\n');

console.log(`Bundled ${files.length} files into ${outFile}`);
