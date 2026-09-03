<?php
/**
 * Template helpers: social icons, image frames, program cards.
 *
 * @package KIPLA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Inline SVG icons.
 *
 * @param string $name Icon name.
 * @return string
 */
function kipla_icon( $name ) {
	$icons = array(
		'instagram' => '<rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1.2" fill="currentColor" stroke="none"/>',
		'tiktok'    => '<path d="M14 3v10.5a3.5 3.5 0 1 1-3.5-3.5"/><path d="M14 3c.4 2.6 2 4.2 4.6 4.4"/>',
		'youtube'   => '<rect x="2" y="5" width="20" height="14" rx="4"/><path d="M11 9.5l4 2.5-4 2.5z" fill="currentColor" stroke="none"/>',
		'facebook'  => '<path d="M14 8h2V5h-2a3 3 0 0 0-3 3v2H9v3h2v6h3v-6h2l1-3h-3V9a1 1 0 0 1 1-1z"/>',
		'play'      => '<circle cx="12" cy="12" r="9"/><path d="M10 8.5l6 3.5-6 3.5z" fill="currentColor" stroke="none"/>',
		'image'     => '<rect x="3" y="4" width="18" height="16" rx="3"/><circle cx="9" cy="10" r="1.6"/><path d="M4 18l5-5 4 4 3-3 4 4"/>',
		'pin'       => '<path d="M12 21s7-6 7-11a7 7 0 1 0-14 0c0 5 7 11 7 11z"/><circle cx="12" cy="10" r="2.5"/>',
		'clock'     => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
		'phone'     => '<path d="M5 3h4l2 5-2.5 1.5a11 11 0 0 0 6 6L16 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 5a2 2 0 0 1 2-2z"/>',
		'star'      => '<path d="M12 3l2.8 5.7 6.2.9-4.5 4.4 1.1 6.2L12 17.3 6.4 20.2l1.1-6.2L3 9.6l6.2-.9z"/>',
		'heart'     => '<path d="M12 20s-7-4.4-7-9.4A3.9 3.9 0 0 1 12 8a3.9 3.9 0 0 1 7 2.6c0 5-7 9.4-7 9.4z"/>',
		'book'      => '<path d="M4 5a2 2 0 0 1 2-2h12v18H6a2 2 0 0 1-2-2z"/><path d="M8 3v18"/>',
		'sun'       => '<circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M2 12h2M20 12h2M5 5l1.5 1.5M17.5 17.5L19 19M19 5l-1.5 1.5M6.5 17.5L5 19"/>',
		'sprout'    => '<path d="M12 21v-8"/><path d="M12 13c0-4 3-6 7-6 0 4-3 6-7 6z"/><path d="M12 13c0-3-2.5-5-6-5 0 3 2.5 5 6 5z"/>',
		'arrow'     => '<path d="M5 12h14M13 6l6 6-6 6"/>',
	);

	if ( ! isset( $icons[ $name ] ) ) {
		return '';
	}

	return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">' . $icons[ $name ] . '</svg>';
}

/**
 * Render social media icon links.
 *
 * @param string $class Extra class.
 */
function kipla_social_links( $class = '' ) {
	$networks = array(
		'instagram' => array( kipla_opt( 'kipla_instagram' ), __( 'Instagram', 'kipla' ) ),
		'tiktok'    => array( kipla_opt( 'kipla_tiktok' ), __( 'TikTok', 'kipla' ) ),
		'youtube'   => array( kipla_opt( 'kipla_youtube' ), __( 'YouTube', 'kipla' ) ),
		'facebook'  => array( kipla_opt( 'kipla_facebook' ), __( 'Facebook', 'kipla' ) ),
	);

	$links = array_filter( $networks, function ( $n ) {
		return ! empty( $n[0] );
	} );

	if ( empty( $links ) ) {
		return;
	}

	echo '<ul class="social-links ' . esc_attr( $class ) . '">';
	foreach ( $links as $key => $data ) {
		printf(
			'<li><a class="social-links__item social-links__item--%1$s" href="%2$s" target="_blank" rel="noopener noreferrer"><span class="screen-reader-text">%3$s</span>%4$s</a></li>',
			esc_attr( $key ),
			esc_url( $data[0] ),
			esc_html( $data[1] ),
			kipla_icon( $key ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		);
	}
	echo '</ul>';
}

/**
 * Render an image frame — real image when available, tasteful placeholder when not.
 *
 * @param array $args Arguments.
 */
function kipla_frame( $args = array() ) {
	$args = wp_parse_args( $args, array(
		'image_id' => 0,
		'post_id'  => 0,
		'size'     => 'large',
		'modifier' => 'frame--wide',
		'label'    => __( 'Photo space', 'kipla' ),
		'hint'     => __( 'Add your own KIPLA photo here.', 'kipla' ),
		'alt'      => '',
	) );

	$image_id = $args['image_id'];
	if ( ! $image_id && $args['post_id'] ) {
		$image_id = get_post_thumbnail_id( $args['post_id'] );
	}

	echo '<figure class="frame ' . esc_attr( $args['modifier'] ) . '">';
	if ( $image_id ) {
		echo wp_get_attachment_image( $image_id, $args['size'], false, array(
			'alt'     => esc_attr( $args['alt'] ),
			'loading' => 'lazy',
		) );
	} else {
		echo '<div class="frame__placeholder">' . kipla_icon( 'image' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo '<span>' . esc_html( $args['label'] ) . '</span>';
		echo '<small>' . esc_html( $args['hint'] ) . '</small></div>';
	}
	echo '</figure>';
}

/**
 * Location card markup for KIPLA #1 / #2.
 *
 * @param int $number 1 or 2.
 */
function kipla_location_card( $number ) {
	$p       = 'kipla_loc' . absint( $number ) . '_';
	$name    = kipla_opt( $p . 'name' );
	$address = kipla_opt( $p . 'address' );
	$phone   = kipla_opt( $p . 'phone' );
	$hours   = kipla_opt( $p . 'hours' );
	$ages    = kipla_opt( $p . 'ages' );
	$map     = kipla_opt( $p . 'map' );
	?>
	<article class="location-card location-card--<?php echo 1 === (int) $number ? 'one' : 'two'; ?> reveal">
		<span class="location-card__badge"><?php echo esc_html( $name ); ?></span>
		<h3><?php echo esc_html( $address ? $address : __( 'Add this campus address in the Customizer', 'kipla' ) ); ?></h3>
		<?php if ( $ages ) : ?>
			<p class="location-card__ages"><?php echo esc_html( $ages ); ?></p>
		<?php endif; ?>
		<ul class="location-card__meta">
			<?php if ( $address ) : ?>
				<li><strong><?php esc_html_e( 'Address', 'kipla' ); ?></strong><span><?php echo esc_html( $address ); ?></span></li>
			<?php endif; ?>
			<?php if ( $hours ) : ?>
				<li><strong><?php esc_html_e( 'Hours', 'kipla' ); ?></strong><span><?php echo esc_html( $hours ); ?></span></li>
			<?php endif; ?>
			<?php if ( $phone ) : ?>
				<li><strong><?php esc_html_e( 'Phone', 'kipla' ); ?></strong><span><a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></span></li>
			<?php endif; ?>
		</ul>
		<div class="location-card__actions">
			<a class="btn btn--primary btn--sm" href="<?php echo esc_url( kipla_opt( 'kipla_tour_url' ) ); ?>"><?php esc_html_e( 'Schedule a Tour', 'kipla' ); ?></a>
			<?php if ( $map ) : ?>
				<a class="btn btn--ghost btn--sm" href="<?php echo esc_url( $map ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Get Directions', 'kipla' ); ?></a>
			<?php endif; ?>
		</div>
	</article>
	<?php
}

/**
 * Fallback menu when no menu is assigned.
 */
function kipla_fallback_menu() {
	echo '<ul class="menu">';
	foreach ( array(
		'#hero'         => __( 'Hero / First Impression', 'kipla' ),
		'#welcome'      => __( 'Welcome to KIPLA', 'kipla' ),
		'#programs'     => __( 'Our Programs', 'kipla' ),
		'#difference'   => __( 'The KIPLA Difference', 'kipla' ),
		'#culture'      => __( 'Culture in Action', 'kipla' ),
		'#founder'      => __( 'Meet Our Founder', 'kipla' ),
		'#testimonials' => __( 'What KIPLA Families Say', 'kipla' ),
		'#in-action'    => __( 'See KIPLA in Action', 'kipla' ),
	) as $url => $label ) {
		printf( '<li><a href="%s">%s</a></li>', esc_url( $url ), esc_html( $label ) );
	}
	echo '</ul>';
}

/**
 * Highlight *starred* words in a heading.
 *
 * @param string $text Text.
 * @return string
 */
function kipla_accent_text( $text ) {
	return preg_replace( '/\*(.+?)\*/', '<span class="accent">$1</span>', esc_html( $text ) );
}

/**
 * Render a video embed from a URL.
 *
 * @param string $url Video URL.
 */
function kipla_video_embed( $url ) {
	if ( ! $url ) {
		return;
	}
	$embed = wp_oembed_get( $url );
	echo '<div class="video-embed">';
	if ( $embed ) {
		echo $embed; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	} else {
		printf( '<video controls preload="metadata" src="%s"></video>', esc_url( $url ) );
	}
	echo '</div>';
}
