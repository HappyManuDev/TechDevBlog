<?php
/**
 * Pied de page du site.
 *
 * @package techdevblog
 */
?>
</div><!-- #content -->

<footer class="bg-slate-900 text-slate-400 py-12 mt-12">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8 border-b border-slate-800 pb-8">
			<div class="col-span-1 md:col-span-2">
				<div class="flex items-center gap-2 mb-4">
					<?php if ( has_custom_logo() ) : ?>
						<?php
						echo wp_get_attachment_image(
							(int) get_theme_mod( 'custom_logo' ),
							'full',
							false,
							array(
								'class' => 'site-logo w-8 h-8 rounded-lg object-cover',
								'alt'   => esc_attr( get_bloginfo( 'name' ) ),
							)
						);
						?>
					<?php else : ?>
						<span class="w-8 h-8 bg-indigo-500 rounded-lg flex items-center justify-center">
							<span class="text-white font-bold">{ }</span>
						</span>
					<?php endif; ?>
					<span class="font-bold text-xl text-white"><?php bloginfo( 'name' ); ?></span>
				</div>
				<p class="text-sm max-w-sm mb-4">
					<?php echo esc_html( get_bloginfo( 'description' ) ? get_bloginfo( 'description' ) : __( 'Du café, des configs, et quelques automatisations qui marchent enfin !', 'techdevblog' ) ); ?>
				</p>
				<div class="flex space-x-4">
					<a href="#" class="hover:text-white transition-colors" aria-label="X"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"></path></svg></a>
					<a href="#" class="hover:text-white transition-colors" aria-label="GitHub"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg></a>
					<a href="#" class="hover:text-white transition-colors" aria-label="LinkedIn"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg></a>
				</div>
			</div>

			<div>
				<h4 class="text-white font-semibold mb-4"><?php esc_html_e( 'Navigation', 'techdevblog' ); ?></h4>
				<?php
				if ( has_nav_menu( 'footer' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'container'      => false,
							'menu_class'     => 'space-y-2 text-sm [&_a]:transition-colors [&_a:hover]:text-white',
							'depth'          => 1,
						)
					);
				} else {
					?>
					<ul class="space-y-2 text-sm">
						<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-white transition-colors"><?php esc_html_e( 'Accueil', 'techdevblog' ); ?></a></li>
						<?php foreach ( techdevblog_menu_fallback_items() as $techdevblog_item ) : ?>
							<li><a href="<?php echo esc_url( $techdevblog_item['url'] ); ?>" class="hover:text-white transition-colors"><?php echo esc_html( $techdevblog_item['label'] ); ?></a></li>
						<?php endforeach; ?>
					</ul>
					<?php
				}
				?>
			</div>

			<div>
				<h4 class="text-white font-semibold mb-4"><?php esc_html_e( 'Catégories', 'techdevblog' ); ?></h4>
				<ul class="space-y-2 text-sm">
					<?php
					wp_list_categories(
						array(
							'title_li'   => '',
							'number'     => 4,
							'orderby'    => 'count',
							'order'      => 'DESC',
							'show_count' => false,
						)
					);
					?>
				</ul>
			</div>
		</div>
		<div class="text-sm flex flex-col md:flex-row justify-between items-center gap-2">
			<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'Aucun tracker, aucune publicité.', 'techdevblog' ); ?></p>
			<p><?php esc_html_e( 'Propulsé par WordPress', 'techdevblog' ); ?></p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
