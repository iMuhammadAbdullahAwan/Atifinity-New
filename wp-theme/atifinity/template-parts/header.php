<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="Atifinity — Creative. Connected. Limitless. From the first idea to the final upload, we handle everything your channel needs to grow." />
<meta name="robots" content="index, follow" />
<meta name="theme-color" content="#08090F" />

<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/brand/favicon.svg" type="image/svg+xml" />
<meta property="og:title" content="Atifinity — YouTube Growth, Built End-to-End." />
<meta property="og:description" content="Research. Strategy. Content. Production. Optimization. Growth." />
<meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/assets/brand/og-cover.svg" />
<meta property="og:type" content="website" />
<meta name="twitter:card" content="summary_large_image" />

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Atifinity",
  "logo": "<?php echo get_template_directory_uri(); ?>/assets/brand/logo.svg",
  "description": "Atifinity plans, researches, scripts, produces, and manages YouTube content for creators and brands — end to end.",
  "contactPoint": { "@type": "ContactPoint", "email": "hello@atifinity.studio", "contactType": "sales" }
}
</script>

<!-- Geist / Geist Mono — self-hosted (same family the reference site
     uses), so there's no Google Fonts round-trip at all. -->
<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/geist-latin.woff2" as="font" type="font/woff2" crossorigin />
<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/geist-mono-latin.woff2" as="font" type="font/woff2" crossorigin />

<link rel="preload" as="image" href="<?php echo get_template_directory_uri(); ?>/assets/portfolio/posters/america-bridge.jpg" fetchpriority="high" />

<!-- Applies a saved typography theme (see src/js/modules/typography.js)
     before the stylesheet loads, so there's no flash of Geist swapping to
     the chosen font on repeat visits. No-ops if nothing is saved. -->
<script>
(function(){var t=localStorage.getItem('atifinity.typography');if(!t)return;try{var d=JSON.parse(t);var r=document.documentElement.style;if(d.h)r.setProperty('--font-heading',d.h);if(d.b){r.setProperty('--font-body',d.b);r.setProperty('--font-sans',d.b);r.setProperty('--font-display',d.b);}if(d.u)r.setProperty('--font-ui',d.u);if(d.url){var l=document.createElement('link');l.rel='stylesheet';l.href=d.url;l.id='atifinity-typo-fonts';document.head.appendChild(l);}}catch(e){}})();
</script>

<?php wp_head(); ?>
</head>
<body <?php body_class('bg-base text-ink overflow-x-hidden'); ?>>

<a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:top-2 focus:left-2 focus:z-[100] focus:rounded-sm focus:bg-panel focus:px-4 focus:py-2 focus:text-small">Skip to content</a>

<!-- ================= BRAND PARTICLE FIELD =================
     The reference site's own background: a full-bleed canvas of small
     glowing nodes connected by faint lines, always present behind every
     section — rebuilt in Atifinity's red/blue system instead of the
     reference's purple/pink, on a plain <canvas> (no particle library —
     see background-motion.js for the ~80-line vanilla implementation).
     Fixed + pointer-events-none + aria-hidden; density and opacity are
     tuned so it reads as clearly alive without ever competing with
     foreground text. -->
<div id="brandAtmosphere" aria-hidden="true"></div>
<canvas id="brandField" aria-hidden="true"></canvas>
<div id="contextCursor" aria-hidden="true"></div>

<div id="cursorGlow" class="pointer-events-none fixed left-0 top-0 z-30 h-80 w-80 rounded-full opacity-0 mix-blend-screen" style="transition: opacity 0.4s ease; background: radial-gradient(circle, rgba(30,60,255,0.14), transparent 70%);" aria-hidden="true"></div>

<!-- ================= HEADER ================= -->
<header id="siteHeader" class="fixed inset-x-0 top-0 z-50 border-b border-transparent transition-all duration-300">
  <div class="container-x">
    <nav class="flex items-center justify-between py-5" aria-label="Primary">
      <a href="<?php echo home_url(); ?>" class="flex items-center shrink-0 text-ink" aria-label="Atifinity home">
        <svg viewBox="0 0 172 40" width="150" height="34" class="header-mark h-7 w-auto sm:h-8" role="img" aria-hidden="true">
          <path d="M20,4 L4,35 L12,35 L25,14 Z" fill="#E32227"/>
          <path d="M27.5,16 L36,35 L28.5,35 L22,22 Z" fill="#1E3CFF"/>
          <path d="M18,28 L25,28 L27,35 L13.5,35 Z" fill="#1E3CFF"/>
          <text x="48" y="27" font-family="Archivo, sans-serif" font-size="19" font-weight="700" letter-spacing="0.01em" fill="currentColor">atifinity</text>
        </svg>
      </a>

      <ul id="navLinks" class="hidden items-center gap-8 lg:flex">
        <li><a href="<?php echo is_front_page() ? '#services' : home_url('#services'); ?>" class="nav-link" data-nav>Services</a></li>
        <li><a href="<?php echo is_front_page() ? '#work' : home_url('#work'); ?>" class="nav-link" data-nav>Work</a></li>
        <li><a href="<?php echo is_front_page() ? '#process' : home_url('#process'); ?>" class="nav-link" data-nav>Process</a></li>
        <li><a href="<?php echo is_front_page() ? '#pricing' : home_url('#pricing'); ?>" class="nav-link" data-nav>Pricing</a></li>
        <li><a href="<?php echo is_front_page() ? '#faq' : home_url('#faq'); ?>" class="nav-link" data-nav>FAQ</a></li>
        <li><a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="nav-link <?php echo (is_home() || is_single() || is_archive() || is_search()) ? 'is-active' : ''; ?>">Blog</a></li>
      </ul>

      <div class="flex items-center gap-3">
        <a href="https://wa.me/923488164928" data-wa-text="Hi Atifinity, I'd like to book a strategy call." class="btn-primary btn-sm hidden sm:inline-flex">Book a Strategy Call</a>
        <button id="navToggle" type="button" class="inline-flex h-10 w-10 items-center justify-center rounded-md border border-ink/10 text-ink lg:hidden" aria-expanded="false" aria-controls="mobileMenu" aria-label="Toggle menu">
          <svg id="iconBurger" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="4" y1="7" x2="20" y2="7"/><line x1="4" y1="12" x2="20" y2="12"/><line x1="4" y1="17" x2="20" y2="17"/></svg>
          <svg id="iconClose" class="hidden h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="6" y1="6" x2="18" y2="18"/><line x1="18" y1="6" x2="6" y2="18"/></svg>
        </button>
      </div>
    </nav>

    <div id="mobileMenu" class="mx-0 mt-2 hidden origin-top rounded-md border border-ink/10 bg-panel p-5 lg:hidden">
      <ul class="flex flex-col gap-1">
        <li><a href="<?php echo is_front_page() ? '#services' : home_url('#services'); ?>" class="block rounded-sm px-3 py-2.5 text-body font-medium text-ink-muted hover:bg-ink/5" data-nav>Services</a></li>
        <li><a href="<?php echo is_front_page() ? '#work' : home_url('#work'); ?>" class="block rounded-sm px-3 py-2.5 text-body font-medium text-ink-muted hover:bg-ink/5" data-nav>Work</a></li>
        <li><a href="<?php echo is_front_page() ? '#process' : home_url('#process'); ?>" class="block rounded-sm px-3 py-2.5 text-body font-medium text-ink-muted hover:bg-ink/5" data-nav>Process</a></li>
        <li><a href="<?php echo is_front_page() ? '#pricing' : home_url('#pricing'); ?>" class="block rounded-sm px-3 py-2.5 text-body font-medium text-ink-muted hover:bg-ink/5" data-nav>Pricing</a></li>
        <li><a href="<?php echo is_front_page() ? '#faq' : home_url('#faq'); ?>" class="block rounded-sm px-3 py-2.5 text-body font-medium text-ink-muted hover:bg-ink/5" data-nav>FAQ</a></li>
        <li><a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="block rounded-sm px-3 py-2.5 text-body font-medium <?php echo (is_home() || is_single() || is_archive() || is_search()) ? 'text-ink' : 'text-ink-muted'; ?> hover:bg-ink/5">Blog</a></li>
        <li class="pt-2"><a href="https://wa.me/923488164928" data-wa-text="Hi Atifinity, I'd like to book a strategy call." class="btn-primary w-full">Book a Strategy Call</a></li>
      </ul>
    </div>
  </div>
</header>
