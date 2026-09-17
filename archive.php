<?php
/**
 * Modele d'archive (categorie, etiquette, auteur, date).
 *
 * @package techdevblog
 */

get_header();

// Image de la categorie consultee (plugin "Categories Images"), affichee en
// fond du bandeau d'archive uniquement si elle est definie pour cette
// categorie ; sinon le bandeau garde son fond blanc habituel.
$techdevblog_archive_image = '';
if ( is_category() && function_exists( 'z_taxonomy_image_url' ) ) {
	$techdevblog_archive_image = z_taxonomy_image_url( get_queried_object_id(), 'full' );
}
?>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
	<header
		class="archive-header<?php echo $techdevblog_archive_image ? ' has-image' : ''; ?>"
		<?php if ( $techdevblog_archive_image ) : ?>
			style="background-image:url('<?php echo esc_url( $techdevblog_archive_image ); ?>');"
		<?php endif; ?>
	>
		<p class="text-sm font-bold uppercase tracking-wider text-indigo-600 mb-2">
			<?php
			if ( is_category() ) {
				esc_html_e( 'Catégorie', 'techdevblog' );
			} elseif ( is_tag() ) {
				esc_html_e( 'Étiquette', 'techdevblog' );
			} elseif ( is_author() ) {
				esc_html_e( 'Auteur', 'techdevblog' );
			} else {
				esc_html_e( 'Archives', 'techdevblog' );
			}
			?>
		</p>
		<h1 class="text-3xl md:text-4xl font-bold text-slate-900"><?php the_archive_title(); ?></h1>
		<?php the_archive_description( '<div class="mt-4 text-slate-600 max-w-3xl">', '</div>' ); ?>
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
				<p class="text-slate-600"><?php esc_html_e( 'Aucun article dans cette archive.', 'techdevblog' ); ?></p>
			<?php endif; ?>
		</div>

		<?php get_sidebar(); ?>
	</div>
</main>

<?php
get_footer();
