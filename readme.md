# TechDevBlog

*[Lire en français](readme.fr.md)*

![TechDevBlog theme preview](screenshot.png)

A modern, responsive, reading-focused WordPress theme for a tech blog, powered by Tailwind CSS.

## Features

- **Homepage**: latest post as a hero, followed by a card grid (4 by default, filterable via `techdevblog_home_cards`), with pagination.
- **Single post**: automatic, collapsible table of contents generated from H2/H3 headings, estimated reading time, category breadcrumbs, tags, previous/next post navigation, threaded comments.
- **Sidebar managed from Appearance > Widgets**: built-in **TechDevBlog Categories** widget (dynamic counts) to combine with custom HTML blocks (e.g. "About", "Don't miss out").
- **Header**: custom logo, responsive primary menu with a mobile menu, dropdown search panel.
- **Footer**: dedicated menu, category list, social links, credits.
- **Search, archive, and 404** templates, plus a generic page template.
- Support for custom logo, featured images, automatic RSS feeds, and block editor features (responsive embeds, wide alignment).
- Translation-ready theme (`Text Domain: techdevblog`).

## Theme structure

```
techdevblog/
├── assets/            Compiled styles (theme.css) and scripts (navigation.js)
├── template-parts/    Card (content-card.php) and hero (content-hero.php) templates
├── functions.php      Theme setup, Categories widget, helpers (table of contents, reading time...)
├── header.php / footer.php / sidebar.php
├── front-page.php / single.php / page.php / archive.php / search.php / 404.php
└── style.css           Theme header (WordPress metadata)
```

## Installation

1. Copy the `techdevblog` folder into `wp-content/themes/`.
2. Activate the theme from Appearance > Themes.
3. In Appearance > Widgets, add the **TechDevBlog Categories** widget to the sidebar, along with custom HTML blocks for "About" and "Don't miss out".
4. (Optional) Create the **Primary Menu** and **Footer Menu** in Appearance > Menus.

## Requirements

- WordPress 6.0 or higher
- PHP 7.4 or higher

## Development

By default, Tailwind is loaded via CDN in production (see `functions.php`). For a production build, compile Tailwind to `assets/tailwind.css` and replace the CDN enqueue with that file (see the comment at the top of `style.css`).

## Changelog

See [CHANGELOG.md](CHANGELOG.md) (*[version française](CHANGELOG.fr.md)*).

## Code of Conduct

See [CODE_OF_CONDUCT.md](CODE_OF_CONDUCT.md) (*[version française](CODE_OF_CONDUCT.fr.md)*).

## License

GNU General Public License v2 or later. See [LICENSE](LICENSE).
