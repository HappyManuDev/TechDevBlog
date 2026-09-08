# Changelog

*[Read in English](CHANGELOG.md)*

Toutes les évolutions notables du thème sont documentées dans ce fichier.

Le format s'inspire de [Keep a Changelog](https://keepachangelog.com/fr/1.0.0/),
et le thème suit le [Semantic Versioning](https://semver.org/lang/fr/).

## [1.0.0] - 2026-09-08

Première publication publique du thème.

### Ajouté

- Colonne latérale pilotable depuis Apparence > Widgets : le widget **Catégories TechDevBlog**
  (compteurs dynamiques, style de carte assorti au thème) remplace le contenu autrefois codé en dur,
  aux côtés de blocs HTML personnalisé pour « À propos » et « Ne manquez rien ».
- Étiquettes de catégorie multiples sur l'image des articles (cartes de la grille et article mis en avant)
  pour les articles associés à plusieurs catégories.
- Badge « temps de lecture » repositionné en bas à gauche de l'image sur les cartes d'articles,
  avec dégradé de lisibilité.
- Sommaire d'article automatique et repliable (ancre sur chaque titre H2/H3), affiché sur les articles
  comportant au moins deux titres.

### Corrigé

- Espacement entre les cartes de la colonne latérale, cassé par un conflit de spécificité CSS.
- Alignement du compteur dans la liste des catégories (chiffre collé au texte).
- Mise en page de la pagination incohérente entre la page d'accueil et les pages d'archive de catégorie,
  causée par `sanitize_html_class()` qui supprimait les espaces d'une classe CSS multiple.

[1.0.0]: https://github.com/DonCastor/TechDevBlog/releases/tag/v1.0.0
