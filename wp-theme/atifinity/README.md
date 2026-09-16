# Atifinity — WordPress Theme

Custom WordPress theme for Atifinity, converted from the static HTML/Tailwind/JS landing page.

## Installation

### Prerequisites
- WordPress 6.0+ installed on XAMPP (or any hosting)
- PHP 8.0+

### Step-by-Step Setup

1. **Copy the theme folder** into your WordPress installation:
   ```
   Copy: wp-theme/atifinity/
   To:   c:\xampp\htdocs\wordpress\wp-content\themes\atifinity\
   ```

2. **Copy the assets** from the static site into the theme:
   ```
   Copy: assets/    → wp-content/themes/atifinity/assets/
   Copy: dist/      → wp-content/themes/atifinity/dist/
   ```

3. **Activate the theme** in WordPress admin:
   - Go to **Appearance → Themes**
   - Find "Atifinity" and click **Activate**

4. **Configure WordPress Settings**:
   - **Settings → Reading**: Set "Your homepage displays" to **A static page**
   - Create a page called "Home" → set as **Homepage**
   - Create a page called "Blog" → set as **Posts page**
   - **Settings → Permalinks**: Select **Post name** (`/%postname%/`)

5. **Set up Navigation Menu**:
   - Go to **Appearance → Menus**
   - Create a menu and assign to "Primary Navigation"

### Tailwind CSS Development

When adding new Tailwind classes in PHP files, update the content scan paths in your Tailwind config:

```js
// tailwind.config.js (or in input.css for v4)
content: [
  './wp-theme/atifinity/**/*.php',
  // ...existing paths
]
```

Then rebuild: `npm run build`

## Theme Structure

```
atifinity/
├── style.css                  # Theme metadata (required by WP)
├── functions.php              # Enqueue assets, CPTs, menus, widgets
├── front-page.php             # Homepage (assembles all sections)
├── index.php                  # Blog listing
├── single.php                 # Blog post
├── page.php                   # Generic page
├── archive.php                # Category/tag archives
├── search.php                 # Search results
├── 404.php                    # Not found
├── comments.php               # Comments
├── template-parts/
│   ├── header.php             # <head> + navigation
│   ├── footer.php             # Footer + wp_footer
│   ├── hero.php               # Hero section
│   ├── services.php           # 10 service cards
│   ├── work.php               # Portfolio + case studies
│   ├── process.php            # 6-step process
│   ├── creators.php           # Reviews strip
│   ├── pricing.php            # 4 pricing tiers
│   ├── faq.php                # 6 FAQ items
│   ├── cta.php                # Final CTA
│   ├── modals.php             # Video + image lightbox modals
│   └── blog-card.php          # Blog post card component
├── assets/                    # (copy from static site)
└── dist/                      # (copy from static site)
```

## Recommended Plugins

| Plugin | Purpose |
|--------|---------|
| ACF (Advanced Custom Fields) | Make sections editable from admin |
| Yoast SEO | Blog SEO, sitemaps, meta tags |
| WP Super Cache | Performance caching |
| Smush / ShortPixel | Image optimization |
