<?php
/**
 * Programs archive.
 *
 * @package KIPLA
 */

get_header();
?>
<main id="main-content">
	<section class="page-hero container">
		<span class="eyebrow"><?php esc_html_e( 'Our Programs', 'kipla' ); ?></span>
		<h1><?php esc_html_e( 'Programs at KIPLA', 'kipla' ); ?></h1>
		<p><?php esc_html_e( 'Age-appropriate learning across both KIPLA campuses, from infants through school-age enrichment.', 'kipla' ); ?></p>
	</section>

	<section class="section section--hunter">
		<div class="container">
			<?php if ( have_posts() ) : ?>
				<div class="program-grid">
					<?php
					while ( have_posts() ) :
						the_post();
						$ages      = get_post_meta( get_the_ID(), '_kipla_ages', true );
						$locations = wp_get_post_terms( get_the_ID(), 'kipla_location', array( 'fields' => 'names' ) );
						?>
						<article class="program-card">
							<div class="program-card__icon"><?php echo kipla_icon( 'sun' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<?php if ( $ages ) : ?>
								<p class="program-card__age"><?php echo esc_html( $ages ); ?></p>
							<?php endif; ?>
							<div class="program-card__age"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></div>
							<?php if ( ! is_wp_error( $locations ) && $locations ) : ?>
								<p class="program-card__where"><?php echo esc_html( implode( ' + ', $locations ) ); ?></p>
							<?php endif; ?>
						</article>
					<?php endwhile; ?>
				</div>
				<?php the_posts_pagination( array( 'mid_size' => 1 ) ); ?>
			<?php else : ?>
				<p><?php esc_html_e( 'Programs will appear here once they are added in the WordPress dashboard.', 'kipla' ); ?></p>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php
get_footer();
