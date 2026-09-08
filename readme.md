# TechDevBlog - theme WordPress

Theme classique (PHP), responsive, oriente lecture. Tailwind est charge via CDN
pour l'instant ; la feuille `style.css` du theme ne porte que les metadonnees et
les classes generees par le coeur de WordPress.

## Installation

Le titre du blog (**YAML & Cafe**) se regle dans Reglages > General : le theme
l'affiche partout via `bloginfo('name')` (en-tete, pied de page, titre des pages).
Aucun fichier du theme n'est a modifier pour le changer.

1. Copier le dossier `techdevblog/` dans `wp-content/themes/`.
2. Apparence > Themes > activer **TechDevBlog**.
3. Apparence > Menus : creer un menu et l'affecter a *Menu Principal* (et *Menu Pied de Page*).
4. Apparence > Widgets : la zone *Colonne laterale* remplace les blocs par defaut si elle est remplie.
5. Reglages > Lecture : nombre d'articles par page (le premier article de la page 1 est mis en avant).

`front-page.php` impose la mise en page de la maquette sur l'accueil dans les deux
cas de figure. Si l'accueil est une page statique, son contenu n'est pas affiche :
c'est la liste des articles qui fait la page d'accueil. La pagination suit
`/page/2/`, `/page/3/`, etc.

## Fichiers

| Fichier | Role |
| --- | --- |
| `style.css` | En-tete de theme + classes du coeur WordPress (alignements, legendes, pagination, commentaires, widgets) |
| `functions.php` | Supports du theme, menus, zone de widgets, enqueue des assets, temps de lecture, rendu des commentaires |
| `header.php` / `footer.php` | En-tete avec navigation + recherche, pied de page |
| `front-page.php` | Page d'accueil : dernier article en hero + grille 2 colonnes + pagination. Utilise que l'accueil soit une page statique ou la liste des articles |
| `index.php` | Liste des articles : hero + grille, pagination sur la requete principale |
| `single.php` | Article : meta, etiquettes, navigation precedent/suivant, commentaires |
| `page.php` | Page statique |
| `archive.php` | Categorie, etiquette, auteur, date |
| `search.php` / `searchform.php` | Recherche |
| `404.php` | Page introuvable |
| `comments.php` | Liste et formulaire de commentaires |
| `sidebar.php` | Colonne laterale (widgets ou blocs par defaut) |
| `template-parts/content-hero.php` | Bloc de l'article mis en avant |
| `template-parts/content-card.php` | Carte d'article reutilisee par index, archive, search |
| `assets/js/navigation.js` | Menu mobile et panneau de recherche |
| `assets/theme.css` | Feuille compilee du theme : reset + utilitaires utilises par les modeles |

## Corrections apportees a la version initiale

- `functions.php` : les deux fonctions etaient commentees (`//function`), ce qui laissait
  des accolades orphelines et des `add_action` pointant vers des fonctions inexistantes
  (erreur fatale PHP). Fonctions retablies et completees.
- `style.css` : en-tete de theme invalide (commentaire mal ouvert). Reecrit, plus les
  styles des classes du coeur WordPress que Tailwind ne couvre pas.
- `index.php` : deux `WP_Query` custom rendaient `paginate_links()` inoperant et
  pouvaient dupliquer des articles. Le modele lit desormais la requete principale.
- `single.php` : `comments_template()` sans `comments.php` - fichier ajoute.
- Modeles manquants ajoutes : `page.php`, `archive.php`, `search.php`, `404.php`, `searchform.php`.
- `wp_body_open()`, `title-tag`, `html5`, `automatic-feed-links`, `custom-logo`, lien d'evitement.
- Scripts et polices passes par `wp_enqueue_*` au lieu de balises codees en dur.
- `the_excerpt()` remplace par `get_the_excerpt()` echappe, pour que `line-clamp` fonctionne
  (l'extrait etait enveloppe dans un `<p>`).
- Sortie echappee (`esc_html`, `esc_url`, `esc_attr`), chaines traduisibles, zone de widgets.

## Menus et colonne laterale

- **Menus** (Apparence > Menus) : deux emplacements, *Menu Principal* et
  *Menu Pied de Page*. Tant qu'aucun menu n'est affecte, le theme affiche
  *Accueil* suivi des trois categories les plus fournies du site - uniquement
  des liens reels, jamais de lien mort. Des qu'un menu est cree, il remplace
  cette liste.
- **Nombre d'articles en accueil** : le hero + 4 cartes, fixe par le theme
  (filtre `techdevblog_home_cards`), independamment de Reglages > Lecture.
- **Colonne laterale** : les trois blocs de la maquette (A propos, Categories,
  Newsletter) sont toujours affiches et definissent la charte. Les widgets
  ajoutes dans Apparence > Widgets s'ajoutent en dessous, dans le meme
  habillage de carte.
  La zone de widgets s'appelle `techdevblog-aside` et non `sidebar-1` : c'est
  volontaire. WordPress affecte automatiquement ses widgets par defaut
  (Articles recents, Commentaires recents, Archives, Meta) a toute zone
  nommee `sidebar-1`, ce qui polluait la colonne. Avec cet identifiant, la
  zone demarre vide.

## Feuille de style

Le theme ne depend d'aucun CDN. `assets/theme.css` contient le reset et les
utilitaires reellement utilises par les modeles (memes noms de classes que
Tailwind), et `style.css` porte les metadonnees du theme plus les classes
generees par le coeur de WordPress.

Si vous ajoutez des classes utilitaires dans les modeles, ajoutez la regle
correspondante dans `assets/theme.css` (ou recompilez Tailwind vers ce fichier).

## Apercu du theme

`screenshot.png` (1200x900) est fourni : c'est l'apercu affiche dans Apparence > Themes.
C'est un rendu a plat de la mise en page ; remplacez-le par une vraie capture du site
en ligne quand il aura du contenu.
