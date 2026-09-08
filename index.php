<?php
/**
 * Modele principal : liste des articles.
 *
 * Le premier article de la premiere page est mis en avant en "hero",
 * les suivants sont affiches en grille. On travaille sur la requete
 * principale, ce qui garde la pagination fonctionnelle.
 *
 * @package techdevblog
 */

get_header();

global $wp_query, $post;

$queried = $wp_query->posts;
$hero    = null;

if ( ! is_paged() && ! empty( $queried ) ) {
	$hero    = $queried[0];
	$queried = array_slice( $queried, 1 );
}
?>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

	<?php
	if ( $hero ) :
		$post = $hero;
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
				<?php if ( ! is_paged() ) : ?>
					<span class="text-sm text-slate-500"><?php echo esc_html( sprintf( _n( '%s article', '%s articles', (int) $wp_query->found_posts, 'techdevblog' ), number_format_i18n( (int) $wp_query->found_posts ) ) ); ?></span>
				<?php endif; ?>
			</div>

			<?php if ( ! empty( $queried ) ) : ?>
				<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
					<?php
					foreach ( $queried as $post ) :
						setup_postdata( $post );
						get_template_part( 'template-parts/content', 'card' );
					endforeach;
					wp_reset_postdata();
					?>
				</div>
			<?php elseif ( ! $hero ) : ?>
				<p class="text-slate-600"><?php esc_html_e( 'Aucun article trouvé.', 'techdevblog' ); ?></p>
			<?php endif; ?>

			<div class="mt-12 text-center">
				<?php techdevblog_the_posts_pagination(); ?>
			</div>
		</div>

		<?php get_sidebar(); ?>
	</div>
</main>

<?php
get_footer();
