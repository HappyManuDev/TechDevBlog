<?php
/**
 * Formulaire de recherche.
 *
 * @package techdevblog
 */
?>
<form role="search" method="get" class="flex gap-2" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="search-field-<?php echo esc_attr( wp_unique_id() ); ?>" class="screen-reader-text"><?php esc_html_e( 'Rechercher', 'techdevblog' ); ?></label>
	<input type="search" class="search-field flex-grow border border-slate-200 rounded-lg px-4 py-2 bg-white text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-400" placeholder="<?php esc_attr_e( 'Rechercher un article...', 'techdevblog' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
	<button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
		<?php esc_html_e( 'Rechercher', 'techdevblog' ); ?>
	</button>
</form>
