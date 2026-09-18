<?php
/**
 * Homepage.
 *
 * This template is used for the homepage in both cases (Settings > Reading:
 * "Your latest posts" or "A static page"), so it always enforces the same
 * layout: the first post of the page as a hero, then exactly
 * techdevblog_home_cards() cards (6 by default) in a two-column grid, then
 * pagination. This pattern repeats on every page (page 2's hero is the
 * first post following page 1's, etc.): the grid therefore always holds
 * an even number of cards.
 *
 * The card count doesn't follow Settings > Reading: it's fixed by the
 * theme to match the design (filter 'techdevblog_home_cards').
 *
 * Any content of the static page chosen as the homepage is not displayed
 * here: the post listing is what makes up the homepage.
 *
 * @package techdevblog
 */

get_header();

$techdevblog_paged = max( 1, (int) get_query_var( 'page' ), (int) get_query_var( 'paged' ) );

$techdevblog_home = new WP_Query(
	array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => techdevblog_home_cards() + 1,
		'paged'               => $techdevblog_paged,
		'ignore_sticky_posts' => 1,
	)
);

$techdevblog_items = $techdevblog_home->posts;
$techdevblog_hero  = null;

// The first post of each page becomes the hero, the following
// techdevblog_home_cards() posts form the grid: the grid therefore
// keeps an even number of cards on every page, not just the first.
if ( ! empty( $techdevblog_items ) ) {
	$techdevblog_hero  = $techdevblog_items[0];
	$techdevblog_items = array_slice( $techdevblog_items, 1, techdevblog_home_cards() );
}

global $post;
?>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

	<?php
	if ( $techdevblog_hero ) :
		$post = $techdevblog_hero;
		setup_postdata( $post );
		?>
		<section class="mb-16">
			<?php get_template_part( 'template-parts/content', 'hero' ); ?>
		</section>
		<?php
		wp_reset_postdata();
	endif;
	?>

	<div class="flex flex-col lg:flex-row gap-10">
		<div class="lg:w-2/3">
			<div class="flex items-center justify-between mb-8 border-b border-slate-200 pb-4">
				<h2 class="text-2xl font-bold text-slate-900">
					<?php esc_html_e( 'Derniers articles', 'techdevblog' ); ?>
				</h2>
				<?php if ( 1 === $techdevblog_paged && $techdevblog_home->found_posts ) : ?>
					<span class="text-sm text-slate-500">
						<?php
						echo esc_html(
							sprintf(
								/* translators: %s: number of posts. */
								_n( '%s article', '%s articles', (int) $techdevblog_home->found_posts, 'techdevblog' ),
								number_format_i18n( (int) $techdevblog_home->found_posts )
							)
						);
						?>
					</span>
				<?php endif; ?>
			</div>

			<?php if ( ! empty( $techdevblog_items ) ) : ?>
				<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
					<?php
					foreach ( $techdevblog_items as $post ) :
						setup_postdata( $post );
						get_template_part( 'template-parts/content', 'card' );
					endforeach;
					wp_reset_postdata();
					?>
				</div>
			<?php elseif ( ! $techdevblog_hero ) : ?>
				<p class="text-slate-600"><?php esc_html_e( 'Aucun article publié pour le moment.', 'techdevblog' ); ?></p>
			<?php endif; ?>

			<?php if ( $techdevblog_home->max_num_pages > 1 ) : ?>
				<div class="mt-12 text-center">
					<nav class="pagination inline-flex flex-wrap gap-2 justify-center" aria-label="<?php esc_attr_e( 'Navigation des articles', 'techdevblog' ); ?>">
						<?php
						echo wp_kses_post(
							paginate_links(
								array(
									'base'      => trailingslashit( home_url( '/' ) ) . 'page/%#%/',
									'format'    => '',
									'current'   => $techdevblog_paged,
									'total'     => (int) $techdevblog_home->max_num_pages,
									'mid_size'  => 1,
									'prev_text' => '&laquo; ' . __( 'Précédent', 'techdevblog' ),
									'next_text' => __( 'Suivant', 'techdevblog' ) . ' &raquo;',
								)
							)
						);
						?>
					</nav>
				</div>
			<?php endif; ?>
		</div>

		<?php get_sidebar(); ?>
	</div>
</main>

<?php
get_footer();
