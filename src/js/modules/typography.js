/**
 * typography.js — runtime typography theme engine + picker.
 *
 * Ships 8 curated heading/body/UI font combinations on top of the site's
 * default self-hosted Geist. Selecting one loads its Google Fonts (v2 CSS
 * API) and writes --font-heading/--font-body/--font-ui (plus --font-sans
 * and --font-display, so Tailwind's font-sans/font-display utilities stay
 * in sync) onto the root element. The choice persists in localStorage.
 *
 * Fully removable: dropping the Atifinity.initTypography() call in main.js
 * removes the picker entirely — the CSS variables fall back to their Geist
 * defaults declared in input.css, so the site renders identically without
 * this module or without JS at all.
 */
window.Atifinity = window.Atifinity || {};

(function () {
  var STORAGE_KEY = 'atifinity.typography';
  var FONTS_LINK_ID = 'atifinity-typo-fonts';
  var PREVIEW_LINK_ID = 'atifinity-typo-preview-fonts';

  var GEIST_STACK = '"Geist", ui-sans-serif, system-ui, sans-serif';

  var THEMES = [
    { id: 'geist', name: 'Default (Geist)', heading: GEIST_STACK, body: GEIST_STACK, ui: GEIST_STACK, tag: 'Self-hosted · No external font', families: [] },
    { id: 'modern-tech', name: 'Modern Tech', heading: '"Space Grotesk"', body: '"Inter"', ui: '"Inter"', tag: 'Technical · Modern · Clean', families: ['Space Grotesk:wght@500;700', 'Inter:wght@400;500;600'] },
    { id: 'geometric', name: 'Geometric', heading: '"Plus Jakarta Sans"', body: '"DM Sans"', ui: '"DM Sans"', tag: 'Geometric · Polished · Friendly', families: ['Plus Jakarta Sans:wght@500;700', 'DM Sans:wght@400;500;600'] },
    { id: 'premium-editorial', name: 'Premium Editorial', heading: '"Playfair Display"', body: '"Inter"', ui: '"Inter"', tag: 'Premium · Elegant · Sophisticated', families: ['Playfair Display:wght@600;700', 'Inter:wght@400;500;600'] },
    { id: 'clean-professional', name: 'Clean Professional', heading: '"Manrope"', body: '"Source Sans 3"', ui: '"Source Sans 3"', tag: 'Professional · Corporate · Readable', families: ['Manrope:wght@500;700', 'Source Sans 3:wght@400;500;600'] },
    { id: 'humanist', name: 'Humanist', heading: '"Outfit"', body: '"Open Sans"', ui: '"Open Sans"', tag: 'Approachable · Human · Comfortable', families: ['Outfit:wght@500;700', 'Open Sans:wght@400;500;600'] },
    { id: 'minimal', name: 'Minimal', heading: '"Inter"', body: '"Inter"', ui: '"Inter"', tag: 'Minimal · Neutral · Product-focused', families: ['Inter:wght@400;500;600;700'] },
    { id: 'distinctive', name: 'Distinctive', heading: '"Syne"', body: '"DM Sans"', ui: '"DM Sans"', tag: 'Expressive · Creative · Design-oriented', families: ['Syne:wght@600;700', 'DM Sans:wght@400;500;600'] },
    { id: 'classic-modern', name: 'Classic Modern', heading: '"Merriweather"', body: '"Source Sans 3"', ui: '"Source Sans 3"', tag: 'Classic · Trustworthy · Refined', families: ['Merriweather:wght@600;700', 'Source Sans 3:wght@400;500;600'] },
  ];

  var DEFAULT_THEME = THEMES[0];

  function themeById(id) {
    for (var i = 0; i < THEMES.length; i++) {
      if (THEMES[i].id === id) return THEMES[i];
    }
    return null;
  }

  function googleFontsUrl(families) {
    if (!families.length) return null;
    var params = families.map(function (f) {
      return 'family=' + f.replace(/ /g, '+');
    }).join('&');
    return 'https://fonts.googleapis.com/css2?' + params + '&display=swap';
  }

  function loadFontLink(id, href) {
    if (!href) return;
    var existing = document.getElementById(id);
    if (existing && existing.href === href) return;
    var link = document.createElement('link');
    link.id = id;
    link.rel = 'stylesheet';
    link.href = href;
    document.head.appendChild(link);
  }

  function apply(theme) {
    var root = document.documentElement.style;
    root.setProperty('--font-heading', theme.heading);
    root.setProperty('--font-body', theme.body);
    root.setProperty('--font-ui', theme.ui);
    root.setProperty('--font-sans', theme.body);
    root.setProperty('--font-display', theme.heading);
    loadFontLink(FONTS_LINK_ID, googleFontsUrl(theme.families));
  }

  function persist(theme) {
    try {
      localStorage.setItem(STORAGE_KEY, JSON.stringify({
        id: theme.id,
        h: theme.heading,
        b: theme.body,
        u: theme.ui,
        url: googleFontsUrl(theme.families),
      }));
    } catch (e) { /* storage unavailable — theme still applies for this load */ }
  }

  function readSaved() {
    var raw;
    try {
      raw = localStorage.getItem(STORAGE_KEY);
    } catch (e) {
      return null;
    }
    if (!raw) return null;
    try {
      var data = JSON.parse(raw);
      return themeById(data.id);
    } catch (e) {
      return null;
    }
  }

  function selectTheme(theme, panel) {
    apply(theme);
    persist(theme);
    if (panel) markSelected(panel, theme.id);
  }

  function markSelected(panel, id) {
    panel.querySelectorAll('[data-typo-option]').forEach(function (el) {
      var isSelected = el.getAttribute('data-typo-option') === id;
      el.classList.toggle('is-selected', isSelected);
      el.setAttribute('aria-pressed', isSelected ? 'true' : 'false');
    });
  }

  function loadAllPreviewFonts() {
    var families = [];
    THEMES.forEach(function (t) { families = families.concat(t.families); });
    loadFontLink(PREVIEW_LINK_ID, googleFontsUrl(families));
  }

  function buildPanel(activeId) {
    var panel = document.createElement('div');
    panel.className = 'typo-panel';
    panel.setAttribute('role', 'listbox');
    panel.setAttribute('aria-label', 'Typography theme');
    panel.hidden = true;

    THEMES.forEach(function (theme) {
      var option = document.createElement('button');
      option.type = 'button';
      option.className = 'typo-option';
      option.setAttribute('data-typo-option', theme.id);
      option.setAttribute('role', 'option');
      option.setAttribute('aria-pressed', theme.id === activeId ? 'true' : 'false');
      if (theme.id === activeId) option.classList.add('is-selected');

      var heading = document.createElement('span');
      heading.className = 'typo-option-heading';
      heading.style.fontFamily = theme.heading;
      heading.textContent = theme.name;

      var body = document.createElement('span');
      body.className = 'typo-option-body';
      body.style.fontFamily = theme.body;
      body.textContent = 'The quick brown fox jumps over the lazy dog.';

      var tag = document.createElement('span');
      tag.className = 'typo-option-tag';
      tag.textContent = theme.tag;

      option.appendChild(heading);
      option.appendChild(body);
      option.appendChild(tag);

      option.addEventListener('click', function () {
        selectTheme(theme, panel);
      });

      panel.appendChild(option);
    });

    return panel;
  }

  function injectStyles() {
    if (document.getElementById('atifinity-typo-styles')) return;
    var style = document.createElement('style');
    style.id = 'atifinity-typo-styles';
    style.textContent = [
      '.typo-toggle{position:fixed;left:1.25rem;bottom:1.25rem;z-index:50;display:flex;',
      'height:48px;width:48px;align-items:center;justify-content:center;border-radius:9999px;',
      'border:1px solid rgb(var(--raw-ink)/0.15);background:rgb(var(--color-surface)/0.85);',
      'color:rgb(var(--raw-ink));font-family:"Geist",ui-sans-serif,system-ui,sans-serif;',
      'font-size:0.8125rem;font-weight:700;backdrop-filter:blur(8px);cursor:pointer;',
      'transition:transform 220ms cubic-bezier(0.16,1,0.3,1),border-color 220ms;}',
      '.typo-toggle:hover{border-color:rgb(var(--raw-primary)/0.5);transform:translateY(-2px);}',
      '.typo-panel{position:fixed;left:1.25rem;bottom:5rem;z-index:50;display:grid;gap:0.5rem;',
      'width:min(320px,calc(100vw - 2.5rem));max-height:min(70vh,560px);overflow-y:auto;',
      'padding:0.75rem;border-radius:12px;border:1px solid rgb(var(--raw-ink)/0.12);',
      'background:rgb(var(--color-surface)/0.97);backdrop-filter:blur(12px);',
      'box-shadow:0 24px 48px -20px rgba(0,0,0,0.6);}',
      '.typo-option{display:flex;flex-direction:column;gap:0.25rem;padding:0.65rem 0.75rem;',
      'border-radius:8px;border:1px solid transparent;background:transparent;text-align:left;',
      'cursor:pointer;color:rgb(var(--raw-ink));}',
      '.typo-option:hover{background:rgb(var(--raw-ink)/0.05);}',
      '.typo-option.is-selected{border-color:rgb(var(--raw-accent)/0.5);background:rgb(var(--raw-accent)/0.08);}',
      '.typo-option-heading{font-size:1rem;font-weight:700;}',
      '.typo-option-body{font-size:0.8125rem;color:rgb(var(--raw-ink-muted));}',
      '.typo-option-tag{font-family:"Geist Mono",ui-monospace,monospace;font-size:0.6875rem;',
      'text-transform:uppercase;letter-spacing:0.08em;color:rgb(var(--raw-ink-muted));}',
    ].join('');
    document.head.appendChild(style);
  }

  Atifinity.initTypography = function initTypography() {
    var saved = readSaved();
    apply(saved || DEFAULT_THEME);

    injectStyles();

    var toggle = document.createElement('button');
    toggle.type = 'button';
    toggle.className = 'typo-toggle';
    toggle.setAttribute('aria-label', 'Change site typography');
    toggle.setAttribute('aria-expanded', 'false');
    toggle.textContent = 'Aa';

    var panel = buildPanel(saved ? saved.id : DEFAULT_THEME.id);

    toggle.addEventListener('click', function () {
      var opening = panel.hidden;
      panel.hidden = !opening;
      toggle.setAttribute('aria-expanded', opening ? 'true' : 'false');
      if (opening) loadAllPreviewFonts();
    });

    document.addEventListener('click', function (e) {
      if (!panel.hidden && !panel.contains(e.target) && e.target !== toggle) {
        panel.hidden = true;
        toggle.setAttribute('aria-expanded', 'false');
      }
    });

    document.body.appendChild(toggle);
    document.body.appendChild(panel);
  };
})();
