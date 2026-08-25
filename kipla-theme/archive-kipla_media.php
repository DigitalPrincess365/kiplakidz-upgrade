<?php
/**
 * Photos & Videos archive.
 *
 * @package KIPLA
 */

get_header();
?>
<main id="main-content">
	<section class="page-hero container">
		<span class="eyebrow"><?php esc_html_e( 'See KIPLA in Action', 'kipla' ); ?></span>
		<h1><?php esc_html_e( 'Photos &amp; Videos', 'kipla' ); ?></h1>
		<p><?php esc_html_e( 'Real moments from our classrooms, playgrounds and celebrations.', 'kipla' ); ?></p>
	</section>

	<section class="section">
		<div class="container">
			<?php if ( have_posts() ) : ?>
				<div class="gallery-grid">
					<?php
					while ( have_posts() ) :
						the_post();
						$video = get_post_meta( get_the_ID(), '_kipla_video_url', true );
						if ( $video ) {
							kipla_video_embed( $video );
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
					?>
				</div>
				<?php the_posts_pagination( array( 'mid_size' => 1 ) ); ?>
			<?php else : ?>
				<p><?php esc_html_e( 'Add photos and videos from the dashboard to fill this gallery.', 'kipla' ); ?></p>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php
get_footer();
