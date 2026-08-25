<?php
/**
 * News, newsletters, events archive.
 *
 * @package KIPLA
 */

get_header();
?>
<main id="main-content">
	<section class="page-hero container">
		<span class="eyebrow"><?php esc_html_e( 'Stay Connected', 'kipla' ); ?></span>
		<h1><?php esc_html_e( 'News &amp; Newsletters', 'kipla' ); ?></h1>
		<p><?php esc_html_e( 'Announcements, events, classroom highlights and monthly newsletters from both campuses.', 'kipla' ); ?></p>
	</section>

	<section class="section">
		<div class="container">
			<?php if ( have_posts() ) : ?>
				<div class="update-grid">
					<?php
					while ( have_posts() ) :
						the_post();
						$file  = get_post_meta( get_the_ID(), '_kipla_newsletter_url', true );
						$types = wp_get_post_terms( get_the_ID(), 'kipla_update_type', array( 'fields' => 'names' ) );
						?>
						<article class="update-card">
							<?php
							kipla_frame( array(
								'post_id'  => get_the_ID(),
								'modifier' => 'frame--square',
								'size'     => 'kipla-square',
								'alt'      => get_the_title(),
								'label'    => __( 'Photo space', 'kipla' ),
								'hint'     => __( 'Optional featured image.', 'kipla' ),
							) );
							?>
							<div class="update-card__body">
								<?php if ( ! is_wp_error( $types ) && $types ) : ?>
									<span class="update-card__type"><?php echo esc_html( $types[0] ); ?></span>
								<?php endif; ?>
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<span class="update-card__date"><?php echo esc_html( get_the_date() ); ?></span>
								<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
								<?php if ( $file ) : ?>
									<a class="update-card__more" href="<?php echo esc_url( $file ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Download newsletter', 'kipla' ); ?></a>
								<?php else : ?>
									<a class="update-card__more" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'kipla' ); ?></a>
								<?php endif; ?>
							</div>
						</article>
					<?php endwhile; ?>
				</div>
				<?php the_posts_pagination( array( 'mid_size' => 1 ) ); ?>
			<?php else : ?>
				<p><?php esc_html_e( 'Newsletters and announcements will appear here once published.', 'kipla' ); ?></p>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php
get_footer();
