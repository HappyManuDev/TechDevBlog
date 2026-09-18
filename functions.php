<?php
/**
 * TechDevBlog - theme functions and definitions.
 *
 * @package techdevblog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'TECHDEVBLOG_VERSION' ) ) {
	define( 'TECHDEVBLOG_VERSION', '1.0.0' );
}

/**
 * Basic theme setup.
 */
function techdevblog_setup() {
	// Translations.
	load_theme_textdomain( 'techdevblog', get_template_directory() . '/languages' );

	// <title> tag handled by WordPress.
	add_theme_support( 'title-tag' );

	// Featured images.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 630, true );
	add_image_size( 'techdevblog-card', 720, 420, true );

	// Automatic RSS feeds.
	add_theme_support( 'automatic-feed-links' );

	// HTML5 markup for core-generated elements.
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);

	// Custom logo.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 32,
			'width'       => 32,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	// Block editor support.
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );

	// Menu locations.
	register_nav_menus(
		array(
			'primary' => __( 'Menu Principal', 'techdevblog' ),
			'footer'  => __( 'Menu Pied de Page', 'techdevblog' ),
		)
	);
}
add_action( 'after_setup_theme', 'techdevblog_setup' );

/**
 * Content width used by embeds.
 */
function techdevblog_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'techdevblog_content_width', 800 );
}
add_action( 'after_setup_theme', 'techdevblog_content_width', 0 );

/**
 * Sidebar widget area.
 *
 * Each widget carries its own card styling (see the "TechDevBlog
 * Categories" widget below and the custom HTML blocks provided for
 * "About" and "Don't miss out"): the area's wrapper stays deliberately
 * neutral so it doesn't force a single style (e.g. the newsletter card
 * is indigo, not white).
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
 * "TechDevBlog Categories" widget.
 *
 * Reproduces the rendering (icon, counts, card styling) that used to be
 * hardcoded in sidebar.php, while staying manageable from Appearance >
 * Widgets: the list stays dynamic (up-to-date category counts), but the
 * widget can be added, removed or reordered without touching the code.
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
 * Registers the "TechDevBlog Categories" widget.
 */
function techdevblog_register_widgets() {
	register_widget( 'TechDevBlog_Categories_Widget' );
}
add_action( 'widgets_init', 'techdevblog_register_widgets' );

/**
 * Styles and scripts.
 */
function techdevblog_scripts() {
	// Compiled theme stylesheet: reset + utilities actually used by the
	// templates. No runtime external dependency (no Tailwind CDN).
	wp_enqueue_style( 'techdevblog-theme', get_theme_file_uri( '/assets/theme.css' ), array(), TECHDEVBLOG_VERSION );

	// Font.
	wp_enqueue_style( 'techdevblog-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap', array(), null );

	// Theme stylesheet (metadata + WordPress core classes).
	wp_enqueue_style( 'techdevblog-style', get_stylesheet_uri(), array(), TECHDEVBLOG_VERSION );

	// Mobile menu.
	wp_enqueue_script( 'techdevblog-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), array(), TECHDEVBLOG_VERSION, true );

	// Threaded comment replies.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'techdevblog_scripts' );

/**
 * Allows /page/N/ pagination when the homepage is a static page.
 *
 * Without this, WordPress interprets /page/2/ as page content pagination
 * (nextpage) instead of post listing pagination.
 *
 * @param WP_Query $query The query.
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
 * Number of post cards shown below the hero on the homepage.
 *
 * @return int
 */
function techdevblog_home_cards() {
	return (int) apply_filters( 'techdevblog_home_cards', 6 );
}

/**
 * Menu links used when no menu is assigned to a location.
 *
 * Only real links are shown: the site's existing categories. As soon as
 * a menu is created in Appearance > Menus, it replaces this list.
 *
 * @return array Array of { label, url } arrays.
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
 * Excerpt length.
 */
function techdevblog_excerpt_length( $length ) {
	return 28;
}
add_filter( 'excerpt_length', 'techdevblog_excerpt_length' );

/**
 * Excerpt suffix.
 */
function techdevblog_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'techdevblog_excerpt_more' );

/**
 * Utility classes added to pagination links.
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
 * Estimated reading time for a post.
 *
 * @param int|null $post_id Post ID.
 * @return int Number of minutes (minimum 1).
 */
function techdevblog_reading_time( $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$words   = str_word_count( wp_strip_all_tags( get_post_field( 'post_content', $post_id ) ) );

	return max( 1, (int) ceil( $words / 200 ) );
}

/**
 * Strips the "reading time" badge inserted by the reading-time plugin
 * (elements carrying a class containing "reading-time") from an excerpt
 * or HTML content.
 *
 * Used to display a clean excerpt on cards and the hero: reading time is
 * already shown separately there via techdevblog_reading_time().
 *
 * @param string $html Excerpt or HTML content (before any tag stripping).
 * @return string The HTML with the badge removed, or unchanged if there was nothing to clean.
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
 * Extracts the headings (H2/H3) from already-filtered post content and
 * gives each one an anchor, to build a clickable table of contents at
 * the top of a post (see single.php).
 *
 * Expects content already passed through the 'the_content' filter
 * (blocks rendered, shortcodes executed, etc. -- typically the result of
 * apply_filters( 'the_content', get_the_content() )), and returns that
 * same content with an id="..." added to each H2/H3 heading, along with
 * the table-of-contents structure (H3s nested under their preceding H2).
 *
 * @param string $content Already-filtered HTML content.
 * @return array {
 *     @type string $content  HTML content with anchors added to headings.
 *     @type array  $headings Table-of-contents structure: list of
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

	// Pre-fills anchors already present in the content (e.g. a footnote)
	// so we never collide with them.
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
 * Renders a single comment.
 *
 * @param WP_Comment $comment The comment.
 * @param array      $args    Arguments.
 * @param int        $depth   Depth.
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
	// The closing tag is added by wp_list_comments().
}
