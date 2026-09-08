<?php
/**
 * Modele 404.
 *
 * @package techdevblog
 */

get_header();
?>

<main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-center">
	<p class="text-7xl font-extrabold text-indigo-600 mb-4">404</p>
	<h1 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4"><?php esc_html_e( 'Cette page a compilé en erreur', 'techdevblog' ); ?></h1>
	<p class="text-slate-600 text-lg mb-8"><?php esc_html_e( "L'adresse demandée n'existe pas ou plus. Essayez une recherche ou revenez à l'accueil.", 'techdevblog' ); ?></p>

	<div class="max-w-md mx-auto mb-8"><?php get_search_form(); ?></div>

	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-lg font-medium transition-colors">
		<?php esc_html_e( "Retour à l'accueil", 'techdevblog' ); ?>
	</a>
</main>

<?php
get_footer();
