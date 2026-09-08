<?php
/**
 * Modele de resultats de recherche.
 *
 * @package techdevblog
 */

get_header();
?>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
	<header class="mb-10 pb-6 border-b border-slate-200">
		<p class="text-sm font-bold uppercase tracking-wider text-indigo-600 mb-2"><?php esc_html_e( 'Recherche', 'techdevblog' ); ?></p>
		<h1 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6">
			<?php
			printf(
				/* translators: %s: terme recherche. */
				esc_html__( 'Résultats pour « %s »', 'techdevblog' ),
				esc_html( get_search_query() )
			);
			?>
		</h1>
		<div class="max-w-md"><?php get_search_form(); ?></div>
	</header>

	<div class="flex flex-col lg:flex-row gap-10">
		<div class="lg:w-2/3">
			<?php if ( have_posts() ) : ?>
				<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content', 'card' );
					endwhile;
					?>
				</div>
				<div class="mt-12 text-center">
					<?php techdevblog_the_posts_pagination(); ?>
				</div>
			<?php else : ?>
				<p class="text-slate-600"><?php esc_html_e( 'Aucun résultat. Essayez avec d\'autres mots-clés.', 'techdevblog' ); ?></p>
			<?php endif; ?>
		</div>

		<?php get_sidebar(); ?>
	</div>
</main>

<?php
get_footer();
