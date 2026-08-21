<?php
/**
 * Customizer settings: locations, calls to action, social links, founder.
 *
 * @package KIPLA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Default option values.
 *
 * @return array
 */
function kipla_defaults() {
	return array(
		'kipla_tour_url'        => '#tour',
		'kipla_enroll_url'      => '#enroll',
		'kipla_phone'           => '',
		'kipla_email'           => '',

		'kipla_loc1_name'       => 'KIPLA #1',
		'kipla_loc1_address'    => '',
		'kipla_loc1_phone'      => '',
		'kipla_loc1_hours'      => 'Mon – Fri, 6:30am – 6:30pm',
		'kipla_loc1_ages'       => '',
		'kipla_loc1_map'        => '',

		'kipla_loc2_name'       => 'KIPLA #2',
		'kipla_loc2_address'    => '',
		'kipla_loc2_phone'      => '',
		'kipla_loc2_hours'      => 'Mon – Fri, 6:30am – 6:30pm',
		'kipla_loc2_ages'       => '',
		'kipla_loc2_map'        => '',

		'kipla_founder_name'    => '',
		'kipla_founder_role'    => 'Founder & Director',
		'kipla_founder_quote'   => '',
		'kipla_founder_bio'     => '',

		'kipla_instagram'       => '',
		'kipla_tiktok'          => '',
		'kipla_youtube'         => '',
		'kipla_facebook'        => '',
	);
}

/**
 * Get a theme option with fallback.
 *
 * @param string $key Option key.
 * @return string
 */
function kipla_opt( $key ) {
	$defaults = kipla_defaults();
	$default  = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
	return get_theme_mod( $key, $default );
}

/**
 * Register customizer panels.
 *
 * @param WP_Customize_Manager $wp_customize Customizer.
 */
function kipla_customize_register( $wp_customize ) {
	$defaults = kipla_defaults();

	$sections = array(
		'kipla_cta'      => __( 'KIPLA: Calls to Action', 'kipla' ),
		'kipla_loc1'     => __( 'KIPLA #1 Location', 'kipla' ),
		'kipla_loc2'     => __( 'KIPLA #2 Location', 'kipla' ),
		'kipla_founder'  => __( 'KIPLA: Meet Our Founder', 'kipla' ),
		'kipla_social'   => __( 'KIPLA: Social Media', 'kipla' ),
	);

	$i = 160;
	foreach ( $sections as $id => $title ) {
		$wp_customize->add_section( $id, array(
			'title'    => $title,
			'priority' => $i++,
		) );
	}

	$fields = array(
		'kipla_cta' => array(
			'kipla_tour_url'   => array( __( 'Schedule a Tour link', 'kipla' ), 'url' ),
			'kipla_enroll_url' => array( __( 'Enroll Now link', 'kipla' ), 'url' ),
			'kipla_phone'      => array( __( 'Main phone number', 'kipla' ), 'text' ),
			'kipla_email'      => array( __( 'Main email address', 'kipla' ), 'text' ),
		),
		'kipla_loc1' => array(
			'kipla_loc1_name'    => array( __( 'Label', 'kipla' ), 'text' ),
			'kipla_loc1_address' => array( __( 'Address', 'kipla' ), 'text' ),
			'kipla_loc1_phone'   => array( __( 'Phone', 'kipla' ), 'text' ),
			'kipla_loc1_hours'   => array( __( 'Hours', 'kipla' ), 'text' ),
			'kipla_loc1_ages'    => array( __( 'Ages served', 'kipla' ), 'text' ),
			'kipla_loc1_map'     => array( __( 'Google Maps link', 'kipla' ), 'url' ),
		),
		'kipla_loc2' => array(
			'kipla_loc2_name'    => array( __( 'Label', 'kipla' ), 'text' ),
			'kipla_loc2_address' => array( __( 'Address', 'kipla' ), 'text' ),
			'kipla_loc2_phone'   => array( __( 'Phone', 'kipla' ), 'text' ),
			'kipla_loc2_hours'   => array( __( 'Hours', 'kipla' ), 'text' ),
			'kipla_loc2_ages'    => array( __( 'Ages served', 'kipla' ), 'text' ),
			'kipla_loc2_map'     => array( __( 'Google Maps link', 'kipla' ), 'url' ),
		),
		'kipla_founder' => array(
			'kipla_founder_name'  => array( __( 'Founder name', 'kipla' ), 'text' ),
			'kipla_founder_role'  => array( __( 'Role', 'kipla' ), 'text' ),
			'kipla_founder_quote' => array( __( 'Pull quote', 'kipla' ), 'textarea' ),
			'kipla_founder_bio'   => array( __( 'Short bio', 'kipla' ), 'textarea' ),
		),
		'kipla_social' => array(
			'kipla_instagram' => array( __( 'Instagram URL', 'kipla' ), 'url' ),
			'kipla_tiktok'    => array( __( 'TikTok URL', 'kipla' ), 'url' ),
			'kipla_youtube'   => array( __( 'YouTube URL', 'kipla' ), 'url' ),
			'kipla_facebook'  => array( __( 'Facebook URL', 'kipla' ), 'url' ),
		),
	);

	foreach ( $fields as $section => $controls ) {
		foreach ( $controls as $key => $args ) {
			list( $label, $type ) = $args;

			$wp_customize->add_setting( $key, array(
				'default'           => isset( $defaults[ $key ] ) ? $defaults[ $key ] : '',
				'sanitize_callback' => 'url' === $type ? 'esc_url_raw' : ( 'textarea' === $type ? 'wp_kses_post' : 'sanitize_text_field' ),
				'transport'         => 'refresh',
			) );

			$wp_customize->add_control( $key, array(
				'label'   => $label,
				'section' => $section,
				'type'    => 'textarea' === $type ? 'textarea' : ( 'url' === $type ? 'url' : 'text' ),
			) );
		}
	}

	// Founder photo.
	$wp_customize->add_setting( 'kipla_founder_photo', array(
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'kipla_founder_photo', array(
		'label'     => __( 'Founder photo', 'kipla' ),
		'section'   => 'kipla_founder',
		'mime_type' => 'image',
	) ) );

	// Hero / welcome imagery.
	$wp_customize->add_section( 'kipla_hero', array(
		'title'    => __( 'KIPLA: Hero & Welcome', 'kipla' ),
		'priority' => 155,
	) );

	foreach ( array(
		'kipla_hero_eyebrow'  => __( 'Hero eyebrow', 'kipla' ),
		'kipla_hero_heading'  => __( 'Hero heading (wrap words in *stars* to highlight)', 'kipla' ),
		'kipla_hero_lead'     => __( 'Hero paragraph', 'kipla' ),
		'kipla_welcome_head'  => __( 'Welcome heading', 'kipla' ),
		'kipla_welcome_text'  => __( 'Welcome paragraph', 'kipla' ),
	) as $key => $label ) {
		$wp_customize->add_setting( $key, array(
			'default'           => '',
			'sanitize_callback' => 'wp_kses_post',
		) );
		$wp_customize->add_control( $key, array(
			'label'   => $label,
			'section' => 'kipla_hero',
			'type'    => 'textarea',
		) );
	}

	foreach ( array(
		'kipla_hero_image'    => __( 'Hero image', 'kipla' ),
		'kipla_welcome_image' => __( 'Welcome image', 'kipla' ),
	) as $key => $label ) {
		$wp_customize->add_setting( $key, array( 'sanitize_callback' => 'absint' ) );
		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, $key, array(
			'label'     => $label,
			'section'   => 'kipla_hero',
			'mime_type' => 'image',
		) ) );
	}
}
add_action( 'customize_register', 'kipla_customize_register' );
