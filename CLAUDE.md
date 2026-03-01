# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Architecture

This repo contains a **custom WordPress theme** for The Hubb on Main, a community resource organization. The theme lives in `wp-theme/thehubb-theme/` and is designed to be dropped into a WordPress installation's `wp-content/themes/` directory.

### Previous CRA/React app

The original Create React App + Contentful site lives in `src/`. It is being phased out in favor of the WordPress theme but is kept here for reference during migration.

---

## WordPress theme (`wp-theme/thehubb-theme/`)

### Local development

Install [Local by WP Engine](https://localwp.com/) and create a site called `thehubb`. Copy or symlink `wp-theme/thehubb-theme/` into the site's `wp-content/themes/` folder, then activate it in WP Admin → Appearance → Themes.

### Required plugins

- **Advanced Custom Fields (ACF)** — powers Home Page and Program fields (free version works; Site Options use a native WP settings page instead of ACF Pro)
- **Classic Editor** (optional) — simpler editing experience for non-developers

### Template hierarchy

| URL | WordPress template used |
|-----|------------------------|
| `/` | `front-page.php` |
| `/calendar` | `page-calendar.php` |
| `/programming` | `page-programming.php` |
| `/blog` | `home.php` (set as Posts page in Settings → Reading) |
| `/blog/post-slug` | `single.php` |
| Category/tag/date archives | `archive.php` |
| Any other page | `page.php` |
| Fallback | `index.php` |

### Theme structure

```
wp-theme/thehubb-theme/
├── style.css                    # Theme registration header
├── functions.php                # Enqueue assets, register CPT, menus, ACF
├── index.php                    # Fallback
├── front-page.php               # Home page
├── home.php                     # Blog post index (Posts page)
├── page-calendar.php            # Calendar page (Google Calendar embed)
├── page-programming.php         # Programs listing
├── archive.php                  # Category/tag/date/author archives
├── single.php                   # Single blog post
├── page.php                     # Generic page
├── template-parts/
│   ├── header.php               # Logo + nav (Calendar, Programming, Blog)
│   ├── footer.php               # Two-column footer
│   ├── cta.php                  # Sticky CTA banner + Donate button
│   └── program-card.php         # Individual program card
└── assets/
    ├── css/
    │   ├── colors.css           # Utility color classes + bgcolor classes
    │   ├── typography.css       # Named type scales (alpha → echo)
    │   ├── grid.css             # Grid layout utilities
    │   └── theme.css            # CSS variables, resets, all component styles
    ├── js/
    │   └── theme.js             # Placeholder (minimal JS needed)
    └── images/
        ├── logo.svg
        ├── fb.svg
        └── insta.svg
```

### CSS design system

Three design-system stylesheets (mirrored from the original React `src/styles/`):
- **`colors.css`** — utility classes for text (`color--blue8`, `color--orange10`, etc.) and background (`bgcolor--*`) using CSS variables
- **`typography.css`** — named type scales (`typography__alpha` through `typography__echo`) using Rubik and Merriweather fonts
- **`grid.css`** — grid layout utilities (`grid__full`, `grid__half`, `grid__two-thirds`, `grid__fullplus`, `grid__full--subgrid`)
- **`theme.css`** — CSS custom properties (`:root`), base resets, section variants, and all component-specific styles

Apply styling by composing utility class names. Use `section--{modifier}` on `<section class="section">` elements (e.g. `section--CTA`, `section--hero`, `section--footer`).

### ACF field groups (version-controlled in functions.php)

All ACF fields are registered via `acf_add_local_field_group()` in `functions.php` — no need to export JSON.

**Site Options (global — WP Admin → Site Options)**
| Field name | Type | Used in |
|------------|------|---------|
| `cta` | WYSIWYG | CTA banner on every page |
| `footer_left` | WYSIWYG | Footer left column |
| `footer_right` | WYSIWYG | Footer right column |

**Home Page fields (attached to the static front page)**
| Field name | Type | Used in |
|------------|------|---------|
| `hero_header` | WYSIWYG | Hero section large text |
| `hero_quote` | WYSIWYG | Pull-quote below hero |
| `funding_note` | WYSIWYG | Funding/grants note |
| `non_profit_note` | WYSIWYG | Non-profit statement |

**Program CPT fields**
| Field name | Type | Notes |
|------------|------|-------|
| `agency` | Text | Organization name |
| `visible_date` | Text | Human-readable schedule |
| `representative` | Text | Contact person |
| `description` | WYSIWYG | Program description |
| `contact` | Text | Phone/email/website |

### WordPress setup checklist

After activating the theme in a fresh WordPress install:

1. **Install ACF** (Plugins → Add New → search "Advanced Custom Fields")
2. **Settings → Reading** — set "Front page displays" to "A static page", assign a page called "Home" as Front page and a page called "Blog" as Posts page
3. **Create pages**: Home, Calendar, Programming, Blog
4. **WP Admin → Site Options** — fill in CTA text, footer left, footer right
5. **Edit the Home page** — fill in hero_header, hero_quote, funding_note, non_profit_note
6. **Programs → Add New** — re-enter each program from Contentful
7. **Add nav menu** (Appearance → Menus) with links to Calendar, Programming, Blog (the theme hardcodes these links, so this is optional)
8. **Write blog posts** (Posts → Add New)

### Deployment

Copy `wp-theme/thehubb-theme/` to the host's `wp-content/themes/` via SFTP, the host's File Manager, or a git-based deploy if the host supports it. SiteGround GrowBig is the recommended host.
