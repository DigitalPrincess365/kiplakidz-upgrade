<?php
/**
 * "How to edit KIPLA" admin help screen.
 *
 * @package KIPLA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the help page under Appearance.
 */
function kipla_admin_help_menu() {
	add_theme_page(
		__( 'How to edit KIPLA', 'kipla' ),
		__( 'How to edit KIPLA', 'kipla' ),
		'edit_theme_options',
		'kipla-help',
		'kipla_admin_help_page'
	);
}
add_action( 'admin_menu', 'kipla_admin_help_menu' );

/**
 * Render the help page.
 */
function kipla_admin_help_page() {
	$customize = admin_url( 'customize.php' );
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'How to edit KIPLA', 'kipla' ); ?></h1>
		<p><?php esc_html_e( 'Everything below can be changed from the WordPress dashboard. You never need to edit code — if a photo or text field is left empty, the site simply shows a safe placeholder instead of breaking.', 'kipla' ); ?></p>

		<h2><?php esc_html_e( 'Photos & videos', 'kipla' ); ?></h2>
		<ul style="list-style:disc;padding-left:1.4em">
			<li><strong><?php esc_html_e( 'Hero photo, Welcome photo:', 'kipla' ); ?></strong> <a href="<?php echo esc_url( $customize ); ?>"><?php esc_html_e( 'Appearance → Customize → KIPLA: Hero & Welcome', 'kipla' ); ?></a></li>
			<li><strong><?php esc_html_e( 'Founder photo:', 'kipla' ); ?></strong> <?php esc_html_e( 'Appearance → Customize → KIPLA: Meet Our Founder', 'kipla' ); ?></li>
			<li><strong><?php esc_html_e( 'Program photos:', 'kipla' ); ?></strong> <?php esc_html_e( 'Programs → open a program → Featured image', 'kipla' ); ?></li>
			<li><strong><?php esc_html_e( 'Gallery photos & videos:', 'kipla' ); ?></strong> <?php esc_html_e( 'Photos & Videos → Add New (set a featured image, or paste a YouTube/Vimeo link in the Video URL box)', 'kipla' ); ?></li>
			<li><strong><?php esc_html_e( 'Site logo:', 'kipla' ); ?></strong> <?php esc_html_e( 'Appearance → Customize → Site Identity → Logo', 'kipla' ); ?></li>
		</ul>

		<h2><?php esc_html_e( 'Words on the homepage', 'kipla' ); ?></h2>
		<ul style="list-style:disc;padding-left:1.4em">
			<li><?php esc_html_e( 'Headline, eyebrow, hero paragraph, welcome heading and paragraph: Customize → KIPLA: Hero & Welcome. Wrap a word in *stars* to highlight it in gold.', 'kipla' ); ?></li>
			<li><?php esc_html_e( 'Founder photo, name, role, quote, bio and Read Our Story link: Customize → KIPLA: Meet Our Founder. A default founder photo and text are shown until you add your own.', 'kipla' ); ?></li>
			<li><?php esc_html_e( 'Campus addresses, hours, phone, ages, map links: Customize → KIPLA #1 Location and KIPLA #2 Location.', 'kipla' ); ?></li>
			<li><?php esc_html_e( 'Schedule a Tour / Enroll button links, main phone and email: Customize → KIPLA: Calls to Action.', 'kipla' ); ?></li>
			<li><?php esc_html_e( 'Instagram, TikTok, YouTube, Facebook links: Customize → KIPLA: Social Media. Leave one blank to hide that icon.', 'kipla' ); ?></li>
		</ul>

		<h2><?php esc_html_e( 'Program pages', 'kipla' ); ?></h2>
		<p><?php esc_html_e( 'Each program (Infants, Toddlers, Preschool, Georgia Pre-K, Before & After School, Summer Camp) is a real page under Programs. Open one to edit the description, age range, highlights, daily rhythm and what is included. Both campuses are selected by default.', 'kipla' ); ?></p>

		<h2><?php esc_html_e( 'Testimonials & updates', 'kipla' ); ?></h2>
		<ul style="list-style:disc;padding-left:1.4em">
			<li><?php esc_html_e( 'Parent reviews: Testimonials → Add New.', 'kipla' ); ?></li>
			<li><?php esc_html_e( 'Newsletters, announcements, events, classroom highlights: News & Newsletters → Add New (attach a PDF in the newsletter link box).', 'kipla' ); ?></li>
		</ul>

		<h2><?php esc_html_e( 'Safety tips', 'kipla' ); ?></h2>
		<ul style="list-style:disc;padding-left:1.4em">
			<li><?php esc_html_e( 'Use Customize → Publish only when the live preview looks right; nothing changes until you publish.', 'kipla' ); ?></li>
			<li><?php esc_html_e( 'Emptying a field is always safe — the section falls back to its built-in text or a photo placeholder.', 'kipla' ); ?></li>
			<li><?php esc_html_e( 'Upload photos under about 2 MB so pages stay fast. WordPress resizes them for you.', 'kipla' ); ?></li>
			<li><?php esc_html_e( 'Do not edit theme files under Appearance → Theme File Editor; that is the only place a change can break the site.', 'kipla' ); ?></li>
		</ul>
	</div>
	<?php
}

/**
 * Point new users to the help page after activation.
 */
function kipla_admin_help_notice() {
	if ( ! current_user_can( 'edit_theme_options' ) || get_user_meta( get_current_user_id(), 'kipla_help_dismissed', true ) ) {
		return;
	}
	printf(
		'<div class="notice notice-info"><p>%s <a href="%s">%s</a></p></div>',
		esc_html__( 'KIPLA theme is active.', 'kipla' ),
		esc_url( admin_url( 'themes.php?page=kipla-help' ) ),
		esc_html__( 'See how to edit photos and text safely', 'kipla' )
	);
}
add_action( 'admin_notices', 'kipla_admin_help_notice' );
