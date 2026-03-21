<p align="center">
  <img src="https://img.shields.io/badge/Nioteq_CMS-Theme-d97706?style=for-the-badge" alt="Nioteq CMS Theme">
  <img src="https://img.shields.io/badge/Version-1.0.0-22c55e?style=for-the-badge" alt="Version 1.0.0">
  <img src="https://img.shields.io/badge/License-MIT-blue?style=for-the-badge" alt="MIT License">
  <img src="https://img.shields.io/badge/Dark_Mode-Supported-1e293b?style=for-the-badge" alt="Dark Mode">
</p>

# :art: Starter Theme

A minimal, clean theme for [Nioteq CMS](https://github.com/tklmn/nioteq-cms) with a warm stone/amber color palette. Designed as a lightweight starting point for building custom themes.

---

## :sparkles: Features

| | Feature | Description |
|---|---|---|
| :crescent_moon: | **Dark Mode** | Full dark mode support out of the box |
| :paintbrush: | **Accent Color** | Customizable accent color via theme settings |
| :framed_picture: | **Logo Upload** | Upload a custom logo or display the site name |
| :label: | **Tagline** | Optional tagline next to the logo |
| :mag: | **Search Toggle** | Show/hide the search icon in navigation |
| :bust_in_silhouette: | **Profile Toggle** | Show/hide the profile link for logged-in users |
| :door: | **Logout Toggle** | Show/hide the logout button for logged-in users |
| :bread: | **Breadcrumbs** | Optional breadcrumb navigation |
| :iphone: | **Responsive** | Mobile-first with hamburger menu and smooth slide animation |
| :wheelchair: | **Accessible** | ARIA labels, skip-to-content link, semantic HTML |

---

## :zap: Quick Start

### Option A: ZIP Upload

1. Download the latest release as ZIP
2. Go to **Backend > Themes > Upload Package**
3. Select the ZIP file and click **Install**
4. Activate the theme in **Backend > Themes**

### Option B: Composer

```bash
composer require nioteq/starter-theme
```

The CMS auto-discovers Composer packages with type `nioteq-theme`. Activate the theme in **Backend > Themes**.

---

## :wrench: Theme Settings

Customize in **Backend > Themes > Customize**:

### :art: Colors

| Setting | Description | Default |
|---------|-------------|---------|
| **Accent Color** | Primary accent color for links and active states | `#d97706` (amber) |

### :star2: Branding

| Setting | Description | Default |
|---------|-------------|---------|
| **Logo** | Upload a custom logo image | Site name as text |
| **Tagline** | Short text next to the logo | `Built with Nioteq CMS` |
| **Footer Text** | Custom footer text | - |

### :jigsaw: Layout

| Setting | Description | Default |
|---------|-------------|---------|
| **Show Page Title** | Display the page title header | Enabled |
| **Show Breadcrumbs** | Display breadcrumb navigation | Enabled |

### :compass: Navigation

| Setting | Description | Default |
|---------|-------------|---------|
| **Show Search** | Search icon in the navigation bar | Enabled |
| **Show Profile Link** | Profile icon for logged-in users | Enabled |
| **Show Logout Button** | Logout icon for logged-in users | Enabled |

---

## :open_file_folder: File Structure

```
starter-theme/
├── theme.json               # Theme manifest with settings schema
├── composer.json             # Composer package definition
└── views/
    ├── home.blade.php        # Homepage template
    ├── page.blade.php        # Default page template
    └── layouts/
        ├── app.blade.php         # Base layout (head, body, scripts)
        ├── navigation.blade.php  # Navigation bar (desktop + mobile)
        └── footer.blade.php      # Footer
```

---

## :hammer_and_wrench: Customization

### Custom CSS

Add custom CSS via **Backend > Themes > Customize > Custom CSS**. Styles are injected after the theme's base styles.

### Available CSS Hooks

```css
.starter-accent       { /* accent text color */ }
.starter-accent-bg    { /* accent background */ }
.starter-accent-border { /* accent border */ }
.starter-nav a.active { /* active nav link underline */ }
```

### Template Support

The theme supports both `container` and `full_width` page templates. Full-width pages remove the max-width constraint for edge-to-edge layouts.

---

## :page_facing_up: Requirements

- **Nioteq CMS** >= 2.0

## :handshake: Author

**Tom Kilimann** — [tkilimann@icloud.com](mailto:tkilimann@icloud.com)

## :scroll: License

MIT
