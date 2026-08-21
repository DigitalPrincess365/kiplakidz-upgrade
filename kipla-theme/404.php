<?php
/**
 * 404 template.
 *
 * @package KIPLA
 */

get_header();
?>

<section class="page-hero container">
	<span class="eyebrow eyebrow--red"><?php esc_html_e( 'Page not found', 'kipla' ); ?></span>
	<h1><?php esc_html_e( 'Let’s get you back on track', 'kipla' ); ?></h1>
	<p><?php esc_html_e( 'That page has wandered off. Try our programs, or reach out and we will point you the right way.', 'kipla' ); ?></p>
</section>

<section class="section">
	<div class="container" style="text-align:center">
		<a class="btn btn--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back home', 'kipla' ); ?></a>
		<a class="btn btn--ghost" href="<?php echo esc_url( kipla_opt( 'kipla_tour_url' ) ); ?>"><?php esc_html_e( 'Schedule a Tour', 'kipla' ); ?></a>
	</div>
</section>

<?php
get_footer();
