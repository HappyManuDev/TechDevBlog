<?php
/**
 * Modele d'article.
 *
 * @package techdevblog
 */

get_header();
?>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
	<div class="flex flex-col lg:flex-row gap-10">
		<div class="lg:w-2/3">
			<?php
			while ( have_posts() ) :
				the_post();

					// Contenu passe par les memes filtres que the_content() (blocs,
					// shortcodes, embeds...), puis enrichi d'ancres sur les titres
					// H2/H3 pour alimenter le sommaire ci-dessous.
					$techdevblog_content = get_the_content();
					$techdevblog_content = apply_filters( 'the_content', $techdevblog_content );
					$techdevblog_content = str_replace( ']]>', ']]&gt;', $techdevblog_content );
					$techdevblog_toc     = techdevblog_prepare_content_with_toc( $techdevblog_content );
				?>
				<article <?php post_class( 'bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden' ); ?>>
					<div class="p-8 md:p-10">
						<header class="mb-8">
							<?php
							$techdevblog_cats = get_the_category();
							if ( ! empty( $techdevblog_cats ) ) :
								?>
								<div class="flex flex-wrap gap-2 mb-6">
									<?php foreach ( $techdevblog_cats as $techdevblog_cat ) : ?>
										<a href="<?php echo esc_url( get_category_link( $techdevblog_cat->term_id ) ); ?>" class="inline-block px-4 py-1.5 bg-indigo-100 text-indigo-700 hover:bg-indigo-600 hover:text-white transition-colors text-sm font-bold rounded-full">
											<?php echo esc_html( $techdevblog_cat->name ); ?>
										</a>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>

							<h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-900 mb-6 leading-tight text-balance">
								<?php the_title(); ?>
							</h1>

							<div class="flex flex-wrap items-center text-slate-500 text-sm gap-x-6 gap-y-3 pb-6 border-b border-slate-100">
								<div class="flex items-center gap-3">
									<?php echo get_avatar( get_the_author_meta( 'ID' ), 40, '', '', array( 'class' => 'rounded-full' ) ); ?>
									<span>
										<span class="block font-medium text-slate-700"><?php the_author(); ?></span>
										<span class="block text-xs"><?php echo esc_html( get_the_author_meta( 'description' ) ? wp_trim_words( get_the_author_meta( 'description' ), 8 ) : __( 'Auteur', 'techdevblog' ) ); ?></span>
									</span>
								</div>
								<span class="flex items-center gap-1.5 md:border-l md:border-slate-200 md:pl-6">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
									<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
								</span>
								<span class="flex items-center gap-1.5">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
									<?php echo esc_html( sprintf( __( '%d min de lecture', 'techdevblog' ), techdevblog_reading_time() ) ); ?>
								</span>
							</div>
						</header>

						<?php if ( has_post_thumbnail() ) : ?>
							<figure class="mb-10 rounded-xl overflow-hidden">
								<?php the_post_thumbnail( 'full', array( 'class' => 'w-full h-auto object-cover max-h-[500px]' ) ); ?>
							</figure>
						<?php endif; ?>

						<?php if ( count( $techdevblog_toc['headings'] ) >= 2 ) : ?>
							<details class="toc" open>
								<summary class="toc-header">
									<span class="toc-icon">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>
									</span>
									<span class="toc-title"><?php esc_html_e( 'Sommaire', 'techdevblog' ); ?></span>
									<span class="toc-count">
										<?php
										echo esc_html(
											sprintf(
												/* translators: %d: nombre de sections du sommaire. */
												_n( '%d section', '%d sections', count( $techdevblog_toc['headings'] ), 'techdevblog' ),
												count( $techdevblog_toc['headings'] )
											)
										);
										?>
									</span>
									<span class="toc-chevron">
										<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"></polyline></svg>
									</span>
								</summary>
								<div class="toc-body">
									<ol class="toc-list">
										<?php foreach ( $techdevblog_toc['headings'] as $techdevblog_heading ) : ?>
											<li>
												<a href="#<?php echo esc_attr( $techdevblog_heading['id'] ); ?>"><?php echo esc_html( $techdevblog_heading['text'] ); ?></a>
												<?php if ( ! empty( $techdevblog_heading['children'] ) ) : ?>
													<ul class="toc-sublist">
														<?php foreach ( $techdevblog_heading['children'] as $techdevblog_subheading ) : ?>
															<li><a href="#<?php echo esc_attr( $techdevblog_subheading['id'] ); ?>"><?php echo esc_html( $techdevblog_subheading['text'] ); ?></a></li>
														<?php endforeach; ?>
													</ul>
												<?php endif; ?>
											</li>
										<?php endforeach; ?>
									</ol>
								</div>
							</details>
						<?php endif; ?>

						<div class="entry-content text-slate-700 text-lg leading-relaxed
							[&>p]:mb-6
							[&>h2]:text-2xl [&>h2]:font-bold [&>h2]:mb-4 [&>h2]:mt-10 [&>h2]:text-slate-900
							[&>h3]:text-xl [&>h3]:font-bold [&>h3]:mb-3 [&>h3]:mt-8 [&>h3]:text-slate-900
							[&>ul]:list-disc [&>ul]:pl-5 [&>ul]:mb-6 [&>ol]:list-decimal [&>ol]:pl-5 [&>ol]:mb-6 [&_li]:mb-2
							[&>blockquote]:border-l-4 [&>blockquote]:border-indigo-500 [&>blockquote]:pl-4 [&>blockquote]:italic [&>blockquote]:bg-slate-50 [&>blockquote]:py-2 [&>blockquote]:my-6
							[&_a]:text-indigo-600 [&_a]:underline [&_a:hover]:text-indigo-800
							[&_img]:rounded-xl">
							<?php
							echo $techdevblog_toc['content']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- contenu deja passe par le filtre the_content().

							wp_link_pages(
								array(
									'before' => '<nav class="pagination inline-flex flex-wrap gap-2 mt-8">',
									'after'  => '</nav>',
								)
							);
							?>
						</div>

						<?php
						$techdevblog_tags = get_the_tags();
						if ( ! empty( $techdevblog_tags ) ) :
							?>
							<div class="mt-10 flex flex-wrap gap-2">
								<?php foreach ( $techdevblog_tags as $techdevblog_tag ) : ?>
									<a href="<?php echo esc_url( get_tag_link( $techdevblog_tag->term_id ) ); ?>" class="text-xs font-medium text-slate-600 bg-slate-100 hover:bg-indigo-100 hover:text-indigo-700 transition-colors px-3 py-1.5 rounded-md">
										#<?php echo esc_html( $techdevblog_tag->name ); ?>
									</a>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>

						<nav class="mt-14 pt-8 border-t border-slate-100 flex flex-col sm:flex-row justify-between items-start gap-4" aria-label="<?php esc_attr_e( 'Navigation entre articles', 'techdevblog' ); ?>">
							<div class="w-full sm:w-1/2 sm:pr-4 sm:border-r border-slate-100">
								<span class="block text-xs uppercase tracking-wider text-slate-400 font-bold mb-1"><?php esc_html_e( 'Article précédent', 'techdevblog' ); ?></span>
								<?php previous_post_link( '%link', '<span class="font-medium text-indigo-600 hover:text-indigo-800 transition-colors line-clamp-2">&larr; %title</span>' ); ?>
							</div>
							<div class="w-full sm:w-1/2 sm:pl-4 text-left sm:text-right">
								<span class="block text-xs uppercase tracking-wider text-slate-400 font-bold mb-1"><?php esc_html_e( 'Article suivant', 'techdevblog' ); ?></span>
								<?php next_post_link( '%link', '<span class="font-medium text-indigo-600 hover:text-indigo-800 transition-colors line-clamp-2">%title &rarr;</span>' ); ?>
							</div>
						</nav>
					</div>
				</article>

				<?php
				if ( comments_open() || get_comments_number() ) {
					echo '<div class="mt-8 bg-white p-8 rounded-2xl shadow-sm border border-slate-100">';
					comments_template();
					echo '</div>';
				}
				?>
			<?php endwhile; ?>
		</div>

		<?php get_sidebar(); ?>
	</div>
</main>

<?php
get_footer();
