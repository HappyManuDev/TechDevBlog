<?php
/**
 * Article mis en avant.
 *
 * @package techdevblog
 */
?>
<a href="<?php the_permalink(); ?>" class="block relative rounded-2xl overflow-hidden shadow-xl group">
	<div class="absolute inset-0 bg-slate-900/60 transition-opacity group-hover:bg-slate-900/50 z-10"></div>

	<?php if ( has_post_thumbnail() ) : ?>
		<?php
		the_post_thumbnail(
			'full',
			array(
				'class' => 'w-full h-[500px] object-cover transition-transform duration-700 group-hover:scale-105',
				'alt'   => the_title_attribute( array( 'echo' => false ) ),
			)
		);
		?>
	<?php else : ?>
		<div class="w-full h-[500px] bg-slate-800"></div>
	<?php endif; ?>

	<div class="absolute bottom-0 left-0 right-0 p-6 md:p-10 z-20">
		<?php
		$techdevblog_cats       = get_the_category();
		$techdevblog_cats_shown = array_slice( $techdevblog_cats, 0, 2 );
		$techdevblog_cats_more  = count( $techdevblog_cats ) - count( $techdevblog_cats_shown );
		if ( ! empty( $techdevblog_cats_shown ) ) :
			?>
			<div class="flex flex-wrap gap-2 mb-4">
				<?php foreach ( $techdevblog_cats_shown as $techdevblog_cat ) : ?>
					<span class="inline-block px-3 py-1 bg-indigo-500 text-white text-sm font-semibold rounded-full">
						<?php echo esc_html( $techdevblog_cat->name ); ?>
					</span>
				<?php endforeach; ?>
				<?php if ( $techdevblog_cats_more > 0 ) : ?>
					<span class="inline-block px-3 py-1 bg-white/20 text-white text-sm font-semibold rounded-full">
						+<?php echo esc_html( $techdevblog_cats_more ); ?>
					</span>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4 leading-tight text-balance">
			<?php the_title(); ?>
		</h2>

		<p class="text-slate-200 text-lg mb-6 max-w-3xl line-clamp-2">
			<?php echo esc_html( wp_strip_all_tags( techdevblog_strip_reading_time_badge( get_the_excerpt() ) ) ); ?>
		</p>

		<div class="flex flex-wrap items-center text-slate-300 text-sm gap-4">
			<span class="flex items-center gap-1.5">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
				<?php the_author(); ?>
			</span>
			<span class="flex items-center gap-1.5">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
				<?php echo esc_html( get_the_date() ); ?>
			</span>
			<span class="flex items-center gap-1.5">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
				<?php echo esc_html( sprintf( __( '%d min de lecture', 'techdevblog' ), techdevblog_reading_time() ) ); ?>
			</span>
		</div>
	</div>
</a>
