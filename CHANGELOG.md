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
  image set for the category), the banner falls back to a plain white card — no hard
  dependency on the plugin.
- Share links on single posts (X, LinkedIn, WhatsApp, Mastodon, email, copy link), shown
  below the tags. Mastodon has no universal share URL (federated instances), so it asks for
  the reader's instance, pre-filled with the last one used so a single "OK" confirms it or
  it can be changed. The copy button is hidden on browsers without clipboard access.
- Footer tagline and single-post share prompt are now editable from
  **Appearance > Customize > Theme Text**, instead of requiring a template edit. Both keep
  their current wording by default.

### Changed

- Archive pages (category, tag, author, date) now open with a white rounded card header
  instead of a plain bottom border.
- Archive titles no longer repeat WordPress's "Category:" / "Tag:" / "Author:" prefix, since
  the small label above the title already says it.
- The header's "S'abonner" button now jumps to the Jetpack subscribe form in the sidebar,
  instead of linking to a placeholder `/newsletter/` page.
- Mobile reading comfort on posts and pages: tighter card padding and 17px body text on
  phones (18px from 640px up), widening lines from ~30 to ~40 characters on a 375px screen.
  Post/page titles and the homepage featured post title drop to 26px on phones.
- Tables inside posts use smaller text and cell padding on phones, so cells no longer break
  over 2–3 lines. A text size picked for a Table block in the editor still takes precedence.
- Homepage featured post (hero) is 380px tall on phones instead of 500px, so the post grid
  starts closer to the top of the screen. To keep its caption inside that height, the title
  is capped at 3 lines and the excerpt drops to 16px on phones.

### Fixed

- Links inside comments looking like plain text (same gray color, no underline); they now
  use the same link style as post content.
- Comment form checkbox labels (cookie consent, comment/blog subscription) landing on their
  own line below the checkbox instead of next to it, caused by a generic label style meant
  for text fields.
- `leading-relaxed` / `leading-tight` having no effect when combined with a text size class
  (post body, titles, comment text), because their rules came before the text size rules in
  `assets/theme.css` — the opposite of Tailwind's order. Post body and titles now also keep
  that line height at every screen width, instead of each responsive text size resetting it.

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
[1.0.0]: https://github.com/HappyManuDev/TechDevBlog/releases/tag/v1.0.0
