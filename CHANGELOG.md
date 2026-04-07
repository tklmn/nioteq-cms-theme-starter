# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

---

## [1.1.0] - 2026-04-07

### Changed
- **Complete dark redesign** — True black base (`#09090b`) with Zinc surfaces, CSS custom properties for all colors, glassmorphism navigation with `backdrop-filter`, modern card styles with hover animations
- **Navigation** — White text by default, accent color on hover/active, separator divider before icon buttons, wider layout (`max-w-6xl`)
- **Breadcrumbs** — Integrated into page header above the title, slash separators, accent color on hover
- **Footer** — Copyright with year and site name, matching dark surface
- **Layout** — Wider content area (`max-w-6xl`), CSS custom properties (`--accent`, `--surface-*`, `--text-*`) for easy customization
- **Prose** — All Tailwind prose variables overridden for dark mode with accent-colored links and quote borders

### Added
- **`editable: true`** — Theme files can be edited via the CMS admin theme editor
- **Scroll-to-top button** — Appears after 300px scroll, themed with surface colors
- **`@includeFirst`** — Safe fallback for search overlay partial

### Removed
- **`home.blade.php`** — Unused static template, home page now uses `page.blade.php` with full page builder support
- **Subpages section** — Removed automatic child page listing from page template
- **Self-loaded `$menuPages` query** — Navigation now uses the CMS view composer

## [1.0.0] - 2026-03-21

### :tada: Initial Release

#### Added
- Minimal, clean theme with warm stone/amber color palette
- Full dark mode support
- Customizable accent color via theme settings
- Logo upload with fallback to site name
- Optional tagline display
- Configurable footer text
- Toggle for page title visibility
- Toggle for breadcrumb navigation
- Toggle for search icon, profile link, and logout button
- Responsive navigation with animated hamburger menu
- Mobile slide-out menu with page links and user actions
- Skip-to-content accessibility link
- ARIA attributes on all interactive elements
- Support for `container` and `full_width` page templates
- Custom CSS injection via theme customize panel
- Composer package support (`nioteq-theme` type)
- ZIP upload support for manual installation
