# TechDevBlog

*[Read in English](readme.md)*

![Aperçu du thème TechDevBlog](screenshot.png)

Un thème WordPress moderne, responsive et orienté lecture pour un blog technologique, propulsé par Tailwind CSS.

## Fonctionnalités

- **Page d'accueil** : dernier article en hero, puis une grille de cartes (4 par défaut, filtrable via `techdevblog_home_cards`), avec pagination.
- **Article** : sommaire automatique et repliable généré à partir des titres H2/H3, temps de lecture estimé, fil d'Ariane par catégories, étiquettes, navigation article précédent/suivant, commentaires imbriqués.
- **Colonne latérale pilotable depuis Apparence > Widgets** : widget natif **Catégories TechDevBlog** (compteurs dynamiques) à combiner avec des blocs HTML personnalisé (ex. « À propos », « Ne manquez rien »).
- **En-tête** : logo personnalisé, menu principal responsive avec menu mobile, recherche en volet déroulant.
- **Pied de page** : menu dédié, liste des catégories, liens réseaux sociaux, mentions.
- **Recherche, archives, 404** et gabarit de page génériques inclus.
- Support du logo personnalisé, des images mises en avant, des flux RSS automatiques et de l'éditeur de blocs (embeds responsives, largeur alignée).
- Thème traduisible (`Text Domain: techdevblog`).

## Structure du thème

```
techdevblog/
├── assets/            Styles compilés (theme.css) et scripts (navigation.js)
├── template-parts/    Gabarits de carte (content-card.php) et de hero (content-hero.php)
├── functions.php      Réglages du thème, widget Catégories, helpers (sommaire, temps de lecture...)
├── header.php / footer.php / sidebar.php
├── front-page.php / single.php / page.php / archive.php / search.php / 404.php
└── style.css           En-tête du thème (métadonnées WordPress)
```

## Installation

1. Copier le dossier `techdevblog` dans `wp-content/themes/`.
2. Activer le thème depuis Apparence > Thèmes.
3. Dans Apparence > Widgets, ajouter à la colonne latérale le widget **Catégories TechDevBlog** ainsi que des blocs HTML personnalisé pour « À propos » et « Ne manquez rien ».
4. (Optionnel) Créer les menus **Menu Principal** et **Menu Pied de Page** dans Apparence > Menus.

## Prérequis

- WordPress 6.0 ou supérieur
- PHP 7.4 ou supérieur

## Développement

Tailwind n'est pas chargé à l'exécution : `assets/theme.css` est une feuille de style maintenue à la main, qui ne contient que les classes utilitaires réellement utilisées par les templates (voir le commentaire en tête de `style.css`). Quand une nouvelle classe utilitaire Tailwind est ajoutée dans un template, il faut ajouter la règle correspondante dans `assets/theme.css`, sinon elle n'a aucun effet.

## Changelog

Voir [CHANGELOG.fr.md](CHANGELOG.fr.md) (*[English version](CHANGELOG.md)*).

## Code de conduite

Voir [CODE_OF_CONDUCT.fr.md](CODE_OF_CONDUCT.fr.md) (*[English version](CODE_OF_CONDUCT.md)*).

## Licence

GNU General Public License v2 ou ultérieure. Voir [LICENSE](LICENSE).
