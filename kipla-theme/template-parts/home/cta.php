<?php
/**
 * Front page: closing CTA band.
 *
 * @package KIPLA
 */

$tour_url   = kipla_opt( 'kipla_tour_url' ) ? kipla_opt( 'kipla_tour_url' ) : home_url( '/schedule-tour/' );
$enroll_url = kipla_opt( 'kipla_enroll_url' ) ? kipla_opt( 'kipla_enroll_url' ) : home_url( '/enroll/' );
?>

<section class="section section--white">
	<div class="container">
		<div class="cta-band">
			<span class="eyebrow">Ready when you are</span>
			<h2>Come see the positivity for yourself</h2>
			<p>Tour either campus, meet the teachers, and see how your child would spend the day at KIPLA.</p>
			<div class="cta-band__actions">
				<a class="btn btn--primary" href="<?php echo esc_url( $tour_url ); ?>">Schedule a Tour</a>
				<a class="btn btn--gold" href="<?php echo esc_url( $enroll_url ); ?>">Enroll Now</a>
			</div>
		</div>
	</div>
</section>
