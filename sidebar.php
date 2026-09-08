<?php
/**
 * Colonne laterale.
 *
 * Le contenu de la colonne (A propos, Categories, Newsletter, et tout
 * widget ajoute) est entierement pilote depuis Apparence > Widgets, zone
 * "Colonne laterale". Voir functions.php pour le widget "Categories
 * TechDevBlog" et les habillages de carte fournis par defaut.
 *
 * @package techdevblog
 */
?>
<aside class="lg:w-1/3 space-y-8">
	<?php
	if ( is_active_sidebar( 'techdevblog-aside' ) ) {
		dynamic_sidebar( 'techdevblog-aside' );
	}
	?>
</aside>
