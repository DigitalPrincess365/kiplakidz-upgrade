<?php
/**
 * Generic archive / blog index.
 *
 * @package KIPLA
 */

get_header();
?>

<section class="page-hero container">
	<span class="eyebrow"><?php esc_html_e( 'KIPLA', 'kipla' ); ?></span>
	<h1>
		<?php
		if ( is_home() ) {
			esc_html_e( 'News &amp; Updates', 'kipla' );
		} else {
			the_archive_title();
		}
		?>
	</h1>
	<?php the_archive_description( '<p>', '</p>' ); ?>
</section>

<section class="section">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<div class="update-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<article class="update-card reveal">
						<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium_large', array( 'loading' => 'lazy' ) ); ?></a>
						<?php endif; ?>
						<div class="update-card__body">
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<span class="update-card__date"><?php echo esc_html( get_the_date() ); ?></span>
							<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
							<span class="update-card__more"><a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'kipla' ); ?></a></span>
						</div>
					</article>
					<?php
				endwhile;
				?>
			</div>
			<div class="pagination"><?php echo wp_kses_post( paginate_links( array( 'type' => 'plain' ) ) ); ?></div>
		<?php else : ?>
			<p><?php esc_html_e( 'Nothing here yet — check back soon.', 'kipla' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
