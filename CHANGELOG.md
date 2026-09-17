# Changelog

*[Lire en français](CHANGELOG.fr.md)*

All notable changes to the theme are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this theme adheres to [Semantic Versioning](https://semver.org/).

## [Unreleased]

### Added

- Category archive banner now displays that category's image as a background when one is
  set via the optional [Categories Images](https://wordpress.org/plugins/categories-images/)
  plugin, with a dark gradient overlay for text contrast. Without the plugin (or without an
  image set for the category), the banner falls back to its plain card look — no hard
  dependency on the plugin.

## [1.1.0] - 2026-09-15

### Added

- Featured post (hero) now shown on every page of the homepage, not just the first,
  so pagination no longer breaks into an uneven, hero-less grid.
- Number of articles per page increased from 4 to 6, applied uniformly across all pages.
- Hero category badges capped at 2, with a "+N" indicator for posts assigned to more.
- "Back to top" button on single posts, appearing after scrolling and smooth-scrolling
  back to the top of the article (respects reduced-motion preference).

### Fixed

- Newsletter sidebar widget ("Don't miss out"): text and button contrast against its
  indigo background, and spacing between the submit button and the fine print below it,
  both broken by `.widget` default styles overriding the widget's utility classes.

## [1.0.0] - 2026-09-08

First public release of the theme.

### Added

- Sidebar managed from Appearance > Widgets: the **TechDevBlog Categories** widget
  (dynamic counts, card style matching the theme) replaces the previously hardcoded content,
  alongside custom HTML blocks for "About" and "Don't miss out".
- Multiple category badges on post images (grid cards and featured post)
  for posts assigned to several categories.
- "Reading time" badge repositioned to the bottom-left of the image on post cards,
  with a readability gradient.
- Automatic, collapsible table of contents (anchored on each H2/H3 heading), shown on posts
  with at least two headings.

### Fixed

- Spacing between sidebar cards, broken by a CSS specificity conflict.
- Counter alignment in the category list (digit stuck to the text).
- Inconsistent pagination layout between the homepage and category archive pages,
  caused by `sanitize_html_class()` stripping spaces from a multi-class CSS attribute.

[1.1.0]: https://github.com/HappyManuDev/TechDevBlog/releases/tag/v1.1.0
[1.0.0]: https://github.com/DonCastor/TechDevBlog/releases/tag/v1.0.0
