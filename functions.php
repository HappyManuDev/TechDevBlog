<?php
/**
 * TechDevBlog - fonctions et definitions du theme.
 *
 * @package techdevblog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'TECHDEVBLOG_VERSION' ) ) {
	define( 'TECHDEVBLOG_VERSION', '1.4' );
}

/**
 * Reglages de base du theme.
 */
function techdevblog_setup() {
	// Traductions.
	load_theme_textdomain( 'techdevblog', get_template_directory() . '/languages' );

	// Balise <title> geree par WordPress.
	add_theme_support( 'title-tag' );

	// Images mises en avant.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 630, true );
	add_image_size( 'techdevblog-card', 720, 420, true );

	// Flux RSS automatiques.
	add_theme_support( 'automatic-feed-links' );

	// Balisage HTML5 pour les elements generes par le coeur.
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);

	// Logo personnalise.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 32,
			'width'       => 32,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	// Support editeur de blocs.
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );

	// Emplacements de menus.
	register_nav_menus(
		array(
			'primary' => __( 'Menu Principal', 'techdevblog' ),
			'footer'  => __( 'Menu Pied de Page', 'techdevblog' ),
		)
	);
}
add_action( 'after_setup_theme', 'techdevblog_setup' );

/**
 * Largeur de contenu utilisee par les embeds.
 */
function techdevblog_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'techdevblog_content_width', 800 );
}
add_action( 'after_setup_theme', 'techdevblog_content_width', 0 );

/**
 * Zone de widgets de la colonne laterale.
 *
 * Chaque widget porte son propre habillage de carte (voir le widget
 * "Categories TechDevBlog" ci-dessous et les blocs HTML personnalise
 * fournis pour "A propos" et "Ne manquez rien") : le wrapper de la zone
 * reste volontairement neutre pour ne pas imposer un style unique
 * (ex. la carte newsletter est indigo, pas blanche).
 */
function techdevblog_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Colonne latérale', 'techdevblog' ),
			'id'            => 'techdevblog-aside',
			'description'   => __( 'Contenu affiché dans la colonne de droite : ajoutez le widget « Catégories TechDevBlog » et des blocs HTML personnalisé pour « À propos » et « Ne manquez rien ».', 'techdevblog' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'techdevblog_widgets_init' );

/**
 * Widget "Catégories TechDevBlog".
 *
 * Reproduit le rendu (icone, compteurs, style de carte) qui etait code en
 * dur dans sidebar.php, tout en restant pilotable depuis Apparence >
 * Widgets : la liste reste dynamique (comptes de categories a jour), mais
 * le widget peut etre ajoute, retire ou reordonne sans toucher au code.
 */
class TechDevBlog_Categories_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'techdevblog_categories',
			__( 'Catégories TechDevBlog', 'techdevblog' ),
			array(
				'description' => __( 'Liste des catégories les plus actives, avec le style de la colonne latérale.', 'techdevblog' ),
			)
		);
	}

	public function widget( $args, $instance ) {
		$title  = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Catégories', 'techdevblog' );
		$number = ! empty( $instance['number'] ) ? (int) $instance['number'] : 5;

		echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		?>
		<section class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
			<h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
				<span class="w-8 h-8 rounded bg-indigo-100 text-indigo-600 flex items-center justify-center">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
				</span>
				<?php echo esc_html( $title ); ?>
			</h3>
			<ul class="space-y-3">
				<?php
				$categories = get_categories(
					array(
						'orderby' => 'count',
						'order'   => 'DESC',
						'number'  => $number,
					)
				);

				if ( empty( $categories ) ) {
					echo '<li class="text-slate-500 text-sm">' . esc_html__( 'Aucune catégorie.', 'techdevblog' ) . '</li>';
				}

				foreach ( $categories as $category ) :
					?>
					<li>
						<a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" class="flex items-center justify-between group w-full">
							<span class="text-slate-600 group-hover:text-indigo-600 transition-colors flex items-center gap-2">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400 group-hover:text-indigo-600" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
								<?php echo esc_html( $category->name ); ?>
							</span>
							<span class="bg-slate-100 text-slate-500 text-xs px-2 py-1 rounded-md group-hover:bg-indigo-100 group-hover:text-indigo-700 transition-colors">
								<?php echo esc_html( number_format_i18n( $category->count ) ); ?>
							</span>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</section>
		<?php
		echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	public function form( $instance ) {
		$title  = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Catégories', 'techdevblog' );
		$number = ! empty( $instance['number'] ) ? (int) $instance['number'] : 5;
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Titre :', 'techdevblog' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Nombre de catégories à afficher :', 'techdevblog' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" min="1" max="20" value="<?php echo esc_attr( $number ); ?>">
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance           = array();
		$instance['title']  = sanitize_text_field( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		return $instance;
	}
}

/**
 * Enregistrement du widget "Catégories TechDevBlog".
 */
function techdevblog_register_widgets() {
	register_widget( 'TechDevBlog_Categories_Widget' );
}
add_action( 'widgets_init', 'techdevblog_register_widgets' );

/**
 * Feuilles de style et scripts.
 */
function techdevblog_scripts() {
	// Feuille compilee du theme : reset + utilitaires reellement utilises par les
	// modeles. Aucune dependance externe a l'execution (pas de CDN Tailwind).
	wp_enqueue_style( 'techdevblog-theme', get_theme_file_uri( '/assets/theme.css' ), array(), TECHDEVBLOG_VERSION );

	// Police.
	wp_enqueue_style( 'techdevblog-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap', array(), null );

	// Feuille du theme (metadonnees + classes du coeur WordPress).
	wp_enqueue_style( 'techdevblog-style', get_stylesheet_uri(), array(), TECHDEVBLOG_VERSION );

	// Menu mobile.
	wp_enqueue_script( 'techdevblog-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), array(), TECHDEVBLOG_VERSION, true );

	// Reponses aux commentaires imbriquees.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'techdevblog_scripts' );

/**
 * Autorise la pagination /page/N/ quand la page d'accueil est une page statique.
 *
 * Sans cela, WordPress interprete /page/2/ comme une pagination de contenu de
 * page (nextpage) au lieu d'une pagination de la liste d'articles.
 *
 * @param WP_Query $query Requete.
 */
function techdevblog_front_page_paging( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if ( $query->is_front_page() && 'page' === get_option( 'show_on_front' ) ) {
		$page = (int) $query->get( 'page' );
		if ( $page > 1 ) {
			$query->set( 'paged', $page );
		}
	}
}
add_action( 'pre_get_posts', 'techdevblog_front_page_paging' );

/**
 * Nombre de cartes d'articles affichees sous le hero sur la page d'accueil.
 *
 * @return int
 */
function techdevblog_home_cards() {
	return (int) apply_filters( 'techdevblog_home_cards', 4 );
}

/**
 * Liens de menu utilises quand aucun menu n'est affecte a un emplacement.
 *
 * On n'affiche que des liens reels : les categories existantes du site.
 * Des qu'un menu est cree dans Apparence > Menus, il remplace cette liste.
 *
 * @return array Tableau de tableaux { label, url }.
 */
function techdevblog_menu_fallback_items() {
	$items      = array();
	$categories = get_categories(
		array(
			'orderby'    => 'count',
			'order'      => 'DESC',
			'number'     => 3,
			'hide_empty' => true,
		)
	);

	foreach ( $categories as $category ) {
		$items[] = array(
			'label' => $category->name,
			'url'   => get_category_link( $category->term_id ),
		);
	}

	return $items;
}

/**
 * Longueur des extraits.
 */
function techdevblog_excerpt_length( $length ) {
	return 28;
}
add_filter( 'excerpt_length', 'techdevblog_excerpt_length' );

/**
 * Suffixe des extraits.
 */
function techdevblog_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'techdevblog_excerpt_more' );

/**
 * Classes utilitaires ajoutees aux liens de pagination.
 */
function techdevblog_the_posts_pagination() {
	the_posts_pagination(
		array(
			'mid_size'           => 1,
			'prev_text'          => '&laquo; ' . __( 'Précédent', 'techdevblog' ),
			'next_text'          => __( 'Suivant', 'techdevblog' ) . ' &raquo;',
			'screen_reader_text' => __( 'Navigation des articles', 'techdevblog' ),
			'class'              => 'pagination',
		)
	);
}

/**
 * Temps de lecture estime d'un article.
 *
 * @param int|null $post_id Identifiant de l'article.
 * @return int Nombre de minutes (minimum 1).
 */
function techdevblog_reading_time( $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$words   = str_word_count( wp_strip_all_tags( get_post_field( 'post_content', $post_id ) ) );

	return max( 1, (int) ceil( $words / 200 ) );
}

/**
 * Retire le badge "temps de lecture" insere par le plugin de lecture (les
 * elements portant une classe contenant "reading-time") d'un extrait ou
 * d'un contenu HTML.
 *
 * Sert a afficher un extrait propre dans les cartes et le hero : le temps
 * de lecture y est deja affiche separement via techdevblog_reading_time().
 *
 * @param string $html Extrait ou contenu HTML (avant tout strip de balises).
 * @return string Le HTML nettoye du badge, ou tel quel si rien a nettoyer.
 */
function techdevblog_strip_reading_time_badge( $html ) {
	if ( false === strpos( $html, 'reading-time' ) ) {
		return $html;
	}

	$dom      = new DOMDocument();
	$previous = libxml_use_internal_errors( true );
	$dom->loadHTML(
		'<?xml encoding="utf-8"?><div>' . $html . '</div>',
		LIBXML_HTML_NODEFDTD | LIBXML_HTML_NOIMPLIED
	);
	libxml_clear_errors();
	libxml_use_internal_errors( $previous );

	$xpath = new DOMXPath( $dom );
	$nodes = $xpath->query( '//*[contains(@class, "reading-time")]' );

	if ( $nodes ) {
		foreach ( $nodes as $node ) {
			if ( $node->parentNode ) {
				$node->parentNode->removeChild( $node );
			}
		}
	}

	$wrapper = $dom->getElementsByTagName( 'div' )->item( 0 );
	if ( ! $wrapper ) {
		return $html;
	}

	$cleaned = '';
	foreach ( $wrapper->childNodes as $child ) {
		$cleaned .= $dom->saveHTML( $child );
	}

	return $cleaned;
}

/**
 * Extrait les titres (H2/H3) d'un contenu d'article deja filtre et leur
 * associe une ancre, pour construire un sommaire cliquable en tete
 * d'article (voir single.php).
 *
 * Attend du contenu deja passe par le filtre 'the_content' (blocs rendus,
 * shortcodes executes, etc. -- typiquement le resultat de
 * apply_filters( 'the_content', get_the_content() )), et renvoie ce meme
 * contenu avec un id="..." ajoute sur chaque titre H2/H3, accompagne de la
 * structure du sommaire (H3 imbriques sous leur H2 precedent).
 *
 * @param string $content Contenu HTML deja filtre.
 * @return array {
 *     @type string $content  Contenu HTML avec ancres ajoutees sur les titres.
 *     @type array  $headings Structure du sommaire : liste de
 *                             { level, id, text, children }.
 * }
 */
function techdevblog_prepare_content_with_toc( $content ) {
	if ( false === strpos( $content, '<h2' ) && false === strpos( $content, '<h3' ) ) {
		return array(
			'content'  => $content,
			'headings' => array(),
		);
	}

	$dom      = new DOMDocument();
	$previous = libxml_use_internal_errors( true );
	$dom->loadHTML(
		'<?xml encoding="utf-8"?><div>' . $content . '</div>',
		LIBXML_HTML_NODEFDTD | LIBXML_HTML_NOIMPLIED
	);
	libxml_clear_errors();
	libxml_use_internal_errors( $previous );

	$xpath = new DOMXPath( $dom );

	// Pre-remplit les ancres deja presentes dans le contenu (ex : une note de
	// bas de page) pour ne jamais entrer en collision avec elles.
	$used_slugs = array();
	foreach ( $xpath->query( '//*[@id]' ) as $existing ) {
		$used_slugs[ $existing->getAttribute( 'id' ) ] = true;
	}

	$nodes      = $xpath->query( '//h2 | //h3' );
	$headings   = array();
	$current_h2 = null;

	foreach ( $nodes as $node ) {
		$text = trim( $node->textContent );
		if ( '' === $text ) {
			continue;
		}

		$slug = sanitize_title( $text );
		if ( '' === $slug ) {
			$slug = 'section';
		}
		$base_slug = $slug;
		$i         = 2;
		while ( isset( $used_slugs[ $slug ] ) ) {
			$slug = $base_slug . '-' . $i;
			++$i;
		}
		$used_slugs[ $slug ] = true;

		$node->setAttribute( 'id', $slug );

		$level = ( 'h2' === strtolower( $node->nodeName ) ) ? 2 : 3;
		$entry = array(
			'level'    => $level,
			'id'       => $slug,
			'text'     => $text,
			'children' => array(),
		);

		if ( 2 === $level ) {
			$headings[] = $entry;
			$current_h2 = count( $headings ) - 1;
		} elseif ( null !== $current_h2 ) {
			$headings[ $current_h2 ]['children'][] = $entry;
		} else {
			$headings[] = $entry;
		}
	}

	$wrapper = $dom->getElementsByTagName( 'div' )->item( 0 );
	$html    = $content;
	if ( $wrapper ) {
		$html = '';
		foreach ( $wrapper->childNodes as $child ) {
			$html .= $dom->saveHTML( $child );
		}
	}

	return array(
		'content'  => $html,
		'headings' => $headings,
	);
}

/**
 * Rendu d'un commentaire.
 *
 * @param WP_Comment $comment Commentaire.
 * @param array      $args    Arguments.
 * @param int        $depth   Profondeur.
 */
function techdevblog_comment( $comment, $args, $depth ) {
	$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
	?>
	<<?php echo esc_attr( $tag ); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( 'comment-item' ); ?>>
		<article class="comment-body flex gap-4">
			<div class="flex-shrink-0">
				<?php echo get_avatar( $comment, 40, '', '', array( 'class' => 'rounded-full' ) ); ?>
			</div>
			<div class="flex-grow">
				<div class="flex flex-wrap items-baseline gap-x-2 mb-1">
					<span class="font-semibold text-slate-900 text-sm"><?php echo esc_html( get_comment_author( $comment ) ); ?></span>
					<span class="text-xs text-slate-400"><?php echo esc_html( get_comment_date( '', $comment ) ); ?></span>
				</div>
				<?php if ( '0' === $comment->comment_approved ) : ?>
					<p class="text-xs text-amber-600 mb-2"><?php esc_html_e( 'Votre commentaire est en attente de modération.', 'techdevblog' ); ?></p>
				<?php endif; ?>
				<div class="text-slate-600 text-sm leading-relaxed mb-2 [&>p]:mb-2">
					<?php comment_text(); ?>
				</div>
				<?php
				comment_reply_link(
					array_merge(
						$args,
						array(
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
							'reply_text' => __( 'Répondre', 'techdevblog' ),
						)
					)
				);
				?>
			</div>
		</article>
	<?php
	// La balise fermante est ajoutee par wp_list_comments().
}
