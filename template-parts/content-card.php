<?php
/**
 * Post card in the grid.
 *
 * @package techdevblog
 */
?>
<article <?php post_class( 'bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-md transition-shadow flex flex-col h-full group' ); ?>>
	<a href="<?php the_permalink(); ?>" class="flex flex-col h-full">
		<div class="relative h-48 overflow-hidden card-thumb">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php
				the_post_thumbnail(
					'techdevblog-card',
					array(
						'class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-105',
						'alt'   => the_title_attribute( array( 'echo' => false ) ),
					)
				);
				?>
			<?php else : ?>
				<div class="w-full h-full bg-slate-200"></div>
			<?php endif; ?>

			<?php
			$techdevblog_cats = get_the_category();
			if ( ! empty( $techdevblog_cats ) ) :
				?>
				<div class="absolute top-4 left-4">
					<span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-indigo-700 text-xs font-bold rounded-full shadow-sm">
						<?php echo esc_html( $techdevblog_cats[0]->name ); ?>
					</span>
				</div>
			<?php endif; ?>

			<span class="card-reading-time">
				<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
				<?php echo esc_html( sprintf( __( '%d min de lecture', 'techdevblog' ), techdevblog_reading_time() ) ); ?>
			</span>
		</div>

		<div class="p-6 flex flex-col flex-grow">
			<h3 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-indigo-600 transition-colors line-clamp-2 text-balance">
				<?php the_title(); ?>
			</h3>
			<p class="text-slate-600 text-sm mb-4 line-clamp-3 flex-grow">
				<?php echo esc_html( wp_strip_all_tags( techdevblog_strip_reading_time_badge( get_the_excerpt() ) ) ); ?>
			</p>
			<div class="flex items-center justify-between text-slate-500 text-xs pt-4 border-t border-slate-100 mt-auto">
				<span class="flex items-center gap-1.5">
					<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
					<?php the_author(); ?>
				</span>
				<span class="flex items-center gap-1.5">
					<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
					<?php echo esc_html( get_the_date() ); ?>
				</span>
			</div>
		</div>
	</a>
</article>
