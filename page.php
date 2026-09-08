<?php
/**
 * Modele de page.
 *
 * @package techdevblog
 */

get_header();
?>

<main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article <?php post_class( 'bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden' ); ?>>
			<div class="p-8 md:p-10">
				<h1 class="text-3xl md:text-4xl font-bold text-slate-900 mb-8 leading-tight text-balance"><?php the_title(); ?></h1>

				<?php if ( has_post_thumbnail() ) : ?>
					<figure class="mb-10 rounded-xl overflow-hidden">
						<?php the_post_thumbnail( 'full', array( 'class' => 'w-full h-auto object-cover' ) ); ?>
					</figure>
				<?php endif; ?>

				<div class="entry-content text-slate-700 text-lg leading-relaxed
					[&>p]:mb-6
					[&>h2]:text-2xl [&>h2]:font-bold [&>h2]:mb-4 [&>h2]:mt-10 [&>h2]:text-slate-900
					[&>h3]:text-xl [&>h3]:font-bold [&>h3]:mb-3 [&>h3]:mt-8 [&>h3]:text-slate-900
					[&>ul]:list-disc [&>ul]:pl-5 [&>ul]:mb-6 [&>ol]:list-decimal [&>ol]:pl-5 [&>ol]:mb-6 [&_li]:mb-2
					[&_a]:text-indigo-600 [&_a]:underline [&_a:hover]:text-indigo-800
					[&_img]:rounded-xl">
					<?php
					the_content();
					wp_link_pages(
						array(
							'before' => '<nav class="pagination inline-flex flex-wrap gap-2 mt-8">',
							'after'  => '</nav>',
						)
					);
					?>
				</div>
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
</main>

<?php
get_footer();
