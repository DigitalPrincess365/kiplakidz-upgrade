<?php
/**
 * The Full Gallery — every photo & video (See KIPLA in Action).
 *
 * @package KIPLA
 */

get_header();
?>

<section class="section section--white" id="gallery-page">
	<div class="container">
		<div class="section-head">
			<div>
				<span class="eyebrow">See KIPLA in Action</span>
				<h2>The Full Gallery</h2>
				<p>Every classroom photo and video from our two campuses — browse them all right here.</p>
			</div>
		</div>

		<?php if ( have_posts() ) : ?>
			<div class="gallery-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					$kipla_delete = kipla_media_delete_url( get_the_ID() );
					if ( $kipla_delete ) {
						echo '<div class="gallery-item">'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					}
					$kipla_video = get_post_meta( get_the_ID(), '_kipla_video_url', true );
					if ( $kipla_video ) {
						kipla_video_embed( $kipla_video );
					} else {
						kipla_frame( array(
							'post_id'  => get_the_ID(),
							'modifier' => 'frame--square',
							'size'     => 'kipla-square',
							'alt'      => get_the_title(),
							'label'    => get_the_title(),
							'hint'     => __( 'Set a featured image for this item.', 'kipla' ),
						) );
					}
					if ( $kipla_delete ) {
						printf(
							'<a class="gallery-delete" href="%1$s" onclick="return confirm(%2$s);">%3$s</a>',
							esc_url( $kipla_delete ),
							esc_attr( __( 'Delete this photo from the gallery? This cannot be undone.', 'kipla' ) ),
							esc_html__( 'Delete', 'kipla' )
						);
						echo '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					}
				endwhile;
				?>
			</div>
			<nav class="gallery-pager">
				<?php the_posts_pagination( array( 'mid_size' => 1, 'prev_text' => 'Previous', 'next_text' => 'Next' ) ); ?>
			</nav>
		<?php else : ?>
			<p class="gallery-empty"><?php esc_html_e( 'No photos yet — add photos and videos from the dashboard to fill this gallery.', 'kipla' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
