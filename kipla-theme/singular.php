<?php
/**
 * Single post / page template.
 *
 * @package KIPLA
 */

get_header();

while ( have_posts() ) :
	the_post();
	$video = get_post_meta( get_the_ID(), '_kipla_video_url', true );
	$file  = get_post_meta( get_the_ID(), '_kipla_file_url', true );
	?>
	<article class="entry">
		<div class="page-hero container">
			<?php
			$types = get_the_terms( get_the_ID(), 'kipla_update_type' );
			if ( $types && ! is_wp_error( $types ) ) :
				?>
				<span class="eyebrow eyebrow--red"><?php echo esc_html( $types[0]->name ); ?></span>
			<?php endif; ?>
			<h1><?php the_title(); ?></h1>
			<?php if ( ! is_page() ) : ?>
				<p class="entry-meta"><?php echo esc_html( get_the_date() ); ?></p>
			<?php endif; ?>
		</div>

		<div class="section">
			<div class="container">
				<?php if ( $video ) : ?>
					<div style="max-width:56rem;margin:0 auto 2.5rem"><?php kipla_video_embed( $video ); ?></div>
				<?php elseif ( has_post_thumbnail() ) : ?>
					<div style="max-width:60rem;margin:0 auto 2.5rem">
						<?php kipla_frame( array( 'post_id' => get_the_ID(), 'size' => 'kipla-wide', 'modifier' => 'frame--wide', 'alt' => get_the_title() ) ); ?>
					</div>
				<?php endif; ?>

				<div class="entry-content">
					<?php the_content(); ?>
					<?php if ( $file ) : ?>
						<p><a class="btn btn--gold" href="<?php echo esc_url( $file ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Download newsletter (PDF)', 'kipla' ); ?></a></p>
					<?php endif; ?>
				</div>

				<?php if ( comments_open() || get_comments_number() ) : ?>
					<div class="entry-content" style="margin-top:3rem"><?php comments_template(); ?></div>
				<?php endif; ?>
			</div>
		</div>
	</article>
	<?php
endwhile;

get_footer();
