<?php
/**
 * Zone de commentaires.
 *
 * @package techdevblog
 */

if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<h2 class="text-2xl font-bold text-slate-900 mb-8">
			<?php
			$techdevblog_count = get_comments_number();
			printf(
				esc_html( _n( '%s commentaire', '%s commentaires', (int) $techdevblog_count, 'techdevblog' ) ),
				esc_html( number_format_i18n( $techdevblog_count ) )
			);
			?>
		</h2>

		<ol class="comment-list mb-8">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 40,
					'callback'    => 'techdevblog_comment',
				)
			);
			?>
		</ol>

		<?php
		the_comments_pagination(
			array(
				'prev_text' => '&laquo;',
				'next_text' => '&raquo;',
				'class'     => 'pagination inline-flex flex-wrap gap-2 mb-8',
			)
		);
		?>

		<?php if ( ! comments_open() ) : ?>
			<p class="text-slate-500 text-sm"><?php esc_html_e( 'Les commentaires sont fermés.', 'techdevblog' ); ?></p>
		<?php endif; ?>
	<?php endif; ?>

	<?php
	comment_form(
		array(
			'title_reply'        => __( 'Laisser un commentaire', 'techdevblog' ),
			'title_reply_before' => '<h3 class="text-xl font-bold text-slate-900 mb-4">',
			'title_reply_after'  => '</h3>',
			'class_submit'       => 'submit',
			'comment_field'      => '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Commentaire', 'techdevblog' ) . '</label><textarea id="comment" name="comment" rows="5" required></textarea></p>',
		)
	);
	?>
</div>
