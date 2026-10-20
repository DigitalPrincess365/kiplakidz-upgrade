<?php
/**
 * Front page: See KIPLA in Action — 12 featured photos + link to the full gallery.
 *
 * @package KIPLA
 */

$kipla_featured = new WP_Query( array(
	'post_type'           => 'kipla_media',
	'posts_per_page'      => 12,
	'no_found_rows'       => true,
	'ignore_sticky_posts' => true,
) );
?>

<section class="section section--white" id="in-action">
	<div class="container">
		<div class="section-head">
			<div>
				<span class="eyebrow">See KIPLA in Action</span>
				<h2>Photos, videos, and everyday moments</h2>
				<p>Follow along on Instagram, TikTok, and YouTube for daily peeks into our classrooms.</p>
			</div>
			<?php kipla_social_links( 'social-links--inline' ); ?>
		</div>

		<?php if ( $kipla_featured->have_posts() ) : ?>
			<div class="gallery-grid">
				<?php
				while ( $kipla_featured->have_posts() ) :
					$kipla_featured->the_post();
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
				endwhile;
				wp_reset_postdata();
				?>
			</div>
			<p class="gallery-cta">
				<a class="btn btn--primary" href="<?php echo esc_url( get_post_type_archive_link( 'kipla_media' ) ); ?>"><?php esc_html_e( 'See Full Gallery', 'kipla' ); ?></a>
			</p>
		<?php else : ?>
			<p class="gallery-empty"><?php esc_html_e( 'Photos coming soon — check back for classroom highlights!', 'kipla' ); ?></p>
		<?php endif; ?>
	</div>
</section>
