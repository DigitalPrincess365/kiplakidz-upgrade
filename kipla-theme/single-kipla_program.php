<?php
/**
 * Single program page with enrollment CTA.
 *
 * @package KIPLA
 */

get_header();

while ( have_posts() ) :
	the_post();

	$age        = get_post_meta( get_the_ID(), '_kipla_age_range', true );
	$highlights = array_filter( array_map( 'trim', explode( '|', (string) get_post_meta( get_the_ID(), '_kipla_highlights', true ) ) ) );
	$day        = array_filter( array_map( 'trim', explode( '|', (string) get_post_meta( get_the_ID(), '_kipla_day', true ) ) ) );
	$included   = array_filter( array_map( 'trim', explode( '|', (string) get_post_meta( get_the_ID(), '_kipla_included', true ) ) ) );
	$terms      = get_the_terms( get_the_ID(), 'kipla_location' );
	$names      = ( $terms && ! is_wp_error( $terms ) ) ? wp_list_pluck( $terms, 'name' ) : array();
	$enroll     = kipla_opt( 'kipla_enroll_url' );
	$tour       = kipla_opt( 'kipla_tour_url' );
	?>
	<article class="entry program-single">
		<section class="page-hero container">
			<span class="eyebrow"><?php esc_html_e( 'Our Programs', 'kipla' ); ?></span>
			<h1><?php the_title(); ?></h1>
			<?php if ( $age ) : ?>
				<p class="program-single__age"><?php echo esc_html( $age ); ?></p>
			<?php endif; ?>
			<?php if ( $names ) : ?>
				<p class="program-card__where"><?php echo esc_html( implode( ' + ', $names ) ); ?></p>
			<?php endif; ?>
			<div class="program-single__cta">
				<a class="btn btn--gold" href="<?php echo esc_url( $enroll ); ?>"><?php esc_html_e( 'Enroll in this program', 'kipla' ); ?></a>
				<a class="btn btn--ghost" href="<?php echo esc_url( $tour ); ?>"><?php esc_html_e( 'Schedule a Tour', 'kipla' ); ?></a>
			</div>
		</section>

		<section class="section">
			<div class="container">
				<div style="max-width:60rem;margin:0 auto 2.5rem">
					<?php
					kipla_frame( array(
						'post_id'  => get_the_ID(),
						'size'     => 'kipla-wide',
						'modifier' => 'frame--wide',
						'label'    => get_the_title() . __( ' photo', 'kipla' ),
						'hint'     => __( 'Set a featured image for this program.', 'kipla' ),
						'alt'      => get_the_title(),
					) );
					?>
				</div>

				<div class="entry-content"><?php the_content(); ?></div>

				<div class="program-detail">
					<?php if ( $highlights ) : ?>
						<div class="program-detail__card">
							<h2><?php esc_html_e( 'What makes it special', 'kipla' ); ?></h2>
							<ul>
								<?php foreach ( $highlights as $item ) : ?>
									<li><span><?php echo esc_html( $item ); ?></span></li>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>

					<?php if ( $day ) : ?>
						<div class="program-detail__card">
							<h2><?php esc_html_e( 'A day in this room', 'kipla' ); ?></h2>
							<ul>
								<?php foreach ( $day as $item ) : ?>
									<li><span><?php echo esc_html( $item ); ?></span></li>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>

					<?php if ( $included ) : ?>
						<div class="program-detail__card">
							<h2><?php esc_html_e( "What's included", 'kipla' ); ?></h2>
							<ul>
								<?php foreach ( $included as $item ) : ?>
									<li><span><?php echo esc_html( $item ); ?></span></li>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>
				</div>

				<div class="program-enroll">
					<h2><?php esc_html_e( 'Ready to enroll?', 'kipla' ); ?></h2>
					<p><?php esc_html_e( 'Seats are limited in every classroom. Start your enrollment or come see the room in person.', 'kipla' ); ?></p>
					<div class="program-single__cta">
						<a class="btn btn--gold" href="<?php echo esc_url( $enroll ); ?>"><?php esc_html_e( 'Enroll Now', 'kipla' ); ?></a>
						<a class="btn btn--ghost" href="<?php echo esc_url( $tour ); ?>"><?php esc_html_e( 'Schedule a Tour', 'kipla' ); ?></a>
					</div>
				</div>

				<p style="text-align:center;margin-top:2.5rem">
					<a class="link-underline" href="<?php echo esc_url( get_post_type_archive_link( 'kipla_program' ) ); ?>"><?php esc_html_e( 'View all programs', 'kipla' ); ?></a>
				</p>
			</div>
		</section>
	</article>
	<?php
endwhile;

get_footer();
