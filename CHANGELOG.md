# Changelog

*[Lire en français](CHANGELOG.fr.md)*

All notable changes to the theme are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this theme adheres to [Semantic Versioning](https://semver.org/).

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

[1.0.0]: https://github.com/DonCastor/TechDevBlog/releases/tag/v1.0.0
