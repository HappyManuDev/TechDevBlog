<?php
/**
 * Sidebar.
 *
 * The sidebar's content (About, Categories, Newsletter, and any widget
 * added) is entirely managed from Appearance > Widgets, "Sidebar" area.
 * See functions.php for the "TechDevBlog Categories" widget and the
 * default card styling it provides.
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
