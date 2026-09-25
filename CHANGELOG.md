# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

---

## [2.0.0] - 2026-09-25

### Changed
- **Breaking:** the layout now loads the core's Tailwind v4 frontend stylesheet (`resources/css/frontend/app.css`) instead of `resources/scss/frontend/app.scss`. The CMS removed its SCSS pipeline, so with 1.x every page returned a 500 ("Unable to locate file in Vite manifest"). Requires a Nioteq CMS release with the Tailwind v4 frontend; for older versions stay on 1.x.

### Fixed
- The mobile menu button no longer shows on desktop: the unlayered `.s-icon-btn` rule overrode Tailwind's `md:hidden`.
- The menu button's `aria-label` is now translatable (`translation.frontend.toggle_navigation`) instead of the hard-coded English "Toggle navigation".

---

## [1.1.3] - 2026-07-10

### Added
- Security policy (`SECURITY.md`) with coordinated vulnerability reporting, and a CycloneDX SBOM under `sbom/` (this theme has no third-party runtime dependencies). Brings the theme to supply-chain/CRA parity with the CMS core.

---

## [1.1.2] - 2026-07-08

### Changed
- CSP compatibility: inline `<script>` tags (navigation, scroll-to-top) now carry `@cspNonce`, and the inline event handlers (search, mobile toggle, hover backgrounds) were switched to `addEventListener`. This makes it work under the CMS's strict, nonce-based Content Security Policy.

---

## [1.1.1] - 2026-07-08

### Fixed
- Logout button in the desktop navigation: `<@csrf>` → `@csrf`. The stray characters `<`/`>` around the Blade directive were rendered visibly and produced broken markup around the CSRF field.

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
