<?php
/**
 * KIPLA theme functions.
 *
 * @package KIPLA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'KIPLA_VERSION', '1.1.0' );

/**
 * Theme supports.
 */
function kipla_setup() {
	load_theme_textdomain( 'kipla', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 260,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'kipla' ),
		'footer'  => __( 'Footer Quick Links', 'kipla' ),
	) );

	add_image_size( 'kipla-wide', 1920, 820, true );
	add_image_size( 'kipla-portrait', 800, 1000, true );
	add_image_size( 'kipla-square', 800, 800, true );
}
add_action( 'after_setup_theme', 'kipla_setup' );

/**
 * Assets.
 */
function kipla_assets() {
	wp_enqueue_style( 'kipla-fonts', 'https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,600;9..144,700&family=Outfit:wght@400;500;600;700&family=Dancing+Script:wght@600;700&family=Playfair+Display:wght@400;600;700;800&family=DM+Serif+Display&display=swap', array(), null );
	wp_enqueue_style( 'kipla-style', get_stylesheet_uri(), array(), KIPLA_VERSION );
	wp_enqueue_script( 'kipla-main', get_template_directory_uri() . '/assets/js/main.js', array(), KIPLA_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'kipla_assets' );

/**
 * Widget areas.
 */
function kipla_widgets() {
	register_sidebar( array(
		'name'          => __( 'Footer Extra', 'kipla' ),
		'id'            => 'footer-extra',
		'description'   => __( 'Optional widgets shown in the footer.', 'kipla' ),
		'before_widget' => '<div class="footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'kipla_widgets' );

/**
 * Full Gallery archive: 48 items per page (front page shows 12 featured).
 *
 * @param WP_Query $query Main query.
 */
function kipla_media_archive_page_size( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}
	if ( $query->is_post_type_archive( 'kipla_media' ) ) {
		$query->set( 'posts_per_page', 48 );
	}
}
add_action( 'pre_get_posts', 'kipla_media_archive_page_size' );

require_once get_template_directory() . '/inc/post-types.php';
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/template-helpers.php';
require_once get_template_directory() . '/inc/programs-data.php';

if ( is_admin() ) {
	require_once get_template_directory() . '/inc/admin-help.php';
}

