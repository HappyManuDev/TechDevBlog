# Changelog

*[Read in English](CHANGELOG.md)*

Toutes les évolutions notables du thème sont documentées dans ce fichier.

Le format s'inspire de [Keep a Changelog](https://keepachangelog.com/fr/1.0.0/),
et le thème suit le [Semantic Versioning](https://semver.org/lang/fr/).

## [Non publié]

### Ajouté

- Le bandeau d'archive de catégorie affiche désormais l'image de la catégorie en fond
  lorsqu'elle est définie via le plugin optionnel
  [Categories Images](https://wordpress.org/plugins/categories-images/), avec un voile sombre
  en dégradé pour garder le texte lisible. Sans le plugin (ou sans image définie pour la
  catégorie), le bandeau garde son allure de carte simple — aucune dépendance obligatoire
  au plugin.

## [1.1.0] - 2026-09-15

### Ajouté

- L'article mis en avant (hero) s'affiche désormais sur toutes les pages de l'accueil,
  et plus seulement la première, pour éviter une grille déséquilibrée et sans hero
  à partir de la pagination.
- Nombre d'articles par page passé de 4 à 6, de façon uniforme sur toutes les pages.
- Étiquettes de catégorie du hero limitées à 2, avec un indicateur « +N » pour les
  articles associés à davantage de catégories.
- Bouton « Retour en haut » sur la page d'un article, qui apparaît après un certain
  défilement et remonte en douceur vers le début (respecte la préférence de mouvement réduit).

### Corrigé

- Widget « Ne manquez rien » de la colonne latérale : contraste du texte et du bouton
  sur son fond indigo, et espacement entre le bouton d'inscription et la mention en
  petits caractères en dessous, tous deux cassés par les styles par défaut de `.widget`
  qui écrasaient les classes utilitaires du widget.

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

[1.1.0]: https://github.com/HappyManuDev/TechDevBlog/releases/tag/v1.1.0
[1.0.0]: https://github.com/HappyManuDev/TechDevBlog/releases/tag/v1.0.0
