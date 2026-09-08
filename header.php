<?php
/**
 * En-tete du site.
 *
 * @package techdevblog
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'min-h-screen bg-slate-50 font-sans text-slate-900' ); ?>>
<?php wp_body_open(); ?>

<a class="screen-reader-text" href="#content"><?php esc_html_e( 'Aller au contenu', 'techdevblog' ); ?></a>

<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-200" aria-label="<?php esc_attr_e( 'Navigation principale', 'techdevblog' ); ?>">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<div class="flex justify-between items-center h-16">

			<div class="flex-shrink-0 flex items-center gap-2">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-2">
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
						<span class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
							<span class="text-white font-bold text-lg">{ }</span>
						</span>
					<?php endif; ?>
					<span class="font-bold text-xl tracking-tight text-slate-900">
						<?php bloginfo( 'name' ); ?>
					</span>
				</a>
			</div>

			<div class="hidden md:flex items-center space-x-8">
				<?php
				if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'container'      => false,
							'menu_class'     => 'flex items-center gap-8 text-slate-600 font-medium [&_a]:transition-colors [&_a:hover]:text-indigo-600 [&_.current-menu-item>a]:text-indigo-600',
							'depth'          => 1,
						)
					);
				} else {
					?>
					<span class="flex items-center gap-8 text-slate-600 font-medium">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="<?php echo is_front_page() ? 'text-indigo-600' : 'hover:text-indigo-600 transition-colors'; ?>"><?php esc_html_e( 'Accueil', 'techdevblog' ); ?></a>
						<?php foreach ( techdevblog_menu_fallback_items() as $techdevblog_item ) : ?>
							<a href="<?php echo esc_url( $techdevblog_item['url'] ); ?>" class="hover:text-indigo-600 transition-colors"><?php echo esc_html( $techdevblog_item['label'] ); ?></a>
						<?php endforeach; ?>
					</span>
					<?php
				}
				?>

				<div class="flex items-center gap-4 border-l border-slate-200 pl-6">
					<button type="button" id="search-toggle" aria-expanded="false" aria-controls="search-panel" class="text-slate-500 hover:text-indigo-600 transition-colors" aria-label="<?php esc_attr_e( 'Rechercher', 'techdevblog' ); ?>">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
					</button>
					<a href="<?php echo esc_url( home_url( '/newsletter/' ) ); ?>" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
						<?php esc_html_e( "S'abonner", 'techdevblog' ); ?>
					</a>
				</div>
			</div>

			<div class="md:hidden flex items-center">
				<button type="button" id="mobile-menu-btn" aria-expanded="false" aria-controls="mobile-menu" class="text-slate-500 hover:text-indigo-600" aria-label="<?php esc_attr_e( 'Ouvrir le menu', 'techdevblog' ); ?>">
					<svg id="icon-menu" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="block" aria-hidden="true"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
					<svg id="icon-close" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="hidden" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
				</button>
			</div>
		</div>
	</div>

	<div id="search-panel" class="hidden border-t border-slate-200 bg-white">
		<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
			<?php get_search_form(); ?>
		</div>
	</div>

	<div id="mobile-menu" class="hidden md:hidden bg-white border-b border-slate-200">
		<div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'space-y-1 [&_a]:block [&_a]:px-3 [&_a]:py-2 [&_a]:rounded-md [&_a]:text-slate-600 [&_a:hover]:bg-slate-50 [&_.current-menu-item>a]:text-indigo-600 [&_.current-menu-item>a]:bg-indigo-50',
						'depth'          => 1,
					)
				);
			} else {
				?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="block px-3 py-2 text-indigo-600 font-medium bg-indigo-50 rounded-md"><?php esc_html_e( 'Accueil', 'techdevblog' ); ?></a>
				<?php foreach ( techdevblog_menu_fallback_items() as $techdevblog_item ) : ?>
					<a href="<?php echo esc_url( $techdevblog_item['url'] ); ?>" class="block px-3 py-2 text-slate-600 rounded-md"><?php echo esc_html( $techdevblog_item['label'] ); ?></a>
				<?php endforeach; ?>
				<?php
			}
			?>
			<div class="px-3 pt-3">
				<?php get_search_form(); ?>
			</div>
		</div>
	</div>
</nav>

<div id="content">
