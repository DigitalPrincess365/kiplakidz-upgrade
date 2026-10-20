<?php
/**
 * Custom content types: programs, testimonials, media (photos + videos), updates & newsletters.
 *
 * @package KIPLA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register content types.
 */
function kipla_register_post_types() {

	register_post_type( 'kipla_program', array(
		'labels' => array(
			'name'               => __( 'Programs', 'kipla' ),
			'singular_name'      => __( 'Program', 'kipla' ),
			'add_new_item'       => __( 'Add New Program', 'kipla' ),
			'edit_item'          => __( 'Edit Program', 'kipla' ),
			'menu_name'          => __( 'Programs', 'kipla' ),
		),
		'public'       => true,
		'has_archive'  => true,
		'menu_icon'    => 'dashicons-welcome-learn-more',
		'menu_position'=> 21,
		'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
		'rewrite'      => array( 'slug' => 'programs' ),
		'show_in_rest' => true,
	) );

	register_post_type( 'kipla_testimonial', array(
		'labels' => array(
			'name'          => __( 'Testimonials', 'kipla' ),
			'singular_name' => __( 'Testimonial', 'kipla' ),
			'add_new_item'  => __( 'Add New Testimonial', 'kipla' ),
			'menu_name'     => __( 'Testimonials', 'kipla' ),
		),
		'public'       => false,
		'show_ui'      => true,
		'menu_icon'    => 'dashicons-format-quote',
		'menu_position'=> 22,
		'supports'     => array( 'title', 'editor', 'page-attributes' ),
		'show_in_rest' => true,
	) );

	// Photos AND videos live here.
	register_post_type( 'kipla_media', array(
		'labels' => array(
			'name'          => __( 'Photos & Videos', 'kipla' ),
			'singular_name' => __( 'Media Item', 'kipla' ),
			'add_new_item'  => __( 'Add Photo or Video', 'kipla' ),
			'edit_item'     => __( 'Edit Photo or Video', 'kipla' ),
			'menu_name'     => __( 'Photos & Videos', 'kipla' ),
		),
		'public'       => true,
		'has_archive'  => true,
		'menu_icon'    => 'dashicons-format-gallery',
		'menu_position'=> 23,
		'supports'     => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
		'rewrite'      => array( 'slug' => 'gallery' ),
		'show_in_rest' => true,
	) );

	// Newsletters, announcements, events, classroom highlights.
	register_post_type( 'kipla_update', array(
		'labels' => array(
			'name'          => __( 'News & Newsletters', 'kipla' ),
			'singular_name' => __( 'Update', 'kipla' ),
			'add_new_item'  => __( 'Add News, Newsletter or Event', 'kipla' ),
			'edit_item'     => __( 'Edit Update', 'kipla' ),
			'menu_name'     => __( 'News & Newsletters', 'kipla' ),
		),
		'public'       => true,
		'has_archive'  => true,
		'menu_icon'    => 'dashicons-megaphone',
		'menu_position'=> 24,
		'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'rewrite'      => array( 'slug' => 'news' ),
		'show_in_rest' => true,
	) );

	register_taxonomy( 'kipla_location', array( 'kipla_program', 'kipla_media', 'kipla_update' ), array(
		'labels' => array(
			'name'          => __( 'Locations', 'kipla' ),
			'singular_name' => __( 'Location', 'kipla' ),
		),
		'hierarchical' => true,
		'public'       => true,
		'show_in_rest' => true,
		'rewrite'      => array( 'slug' => 'location' ),
	) );

	register_taxonomy( 'kipla_update_type', 'kipla_update', array(
		'labels' => array(
			'name'          => __( 'Update Types', 'kipla' ),
			'singular_name' => __( 'Update Type', 'kipla' ),
		),
		'hierarchical' => true,
		'public'       => true,
		'show_in_rest' => true,
		'rewrite'      => array( 'slug' => 'update-type' ),
	) );
}
add_action( 'init', 'kipla_register_post_types' );

/**
 * Seed default terms once.
 */
function kipla_seed_terms() {
	if ( get_option( 'kipla_terms_seeded' ) ) {
		return;
	}

	foreach ( array( 'KIPLA #1', 'KIPLA #2' ) as $location ) {
		if ( ! term_exists( $location, 'kipla_location' ) ) {
			wp_insert_term( $location, 'kipla_location' );
		}
	}

	foreach ( array( 'Newsletter', 'Announcement', 'Event', 'Classroom Highlight' ) as $type ) {
		if ( ! term_exists( $type, 'kipla_update_type' ) ) {
			wp_insert_term( $type, 'kipla_update_type' );
		}
	}

	update_option( 'kipla_terms_seeded', 1 );
}
add_action( 'init', 'kipla_seed_terms', 20 );

/**
 * Meta boxes.
 */
function kipla_meta_boxes() {
	add_meta_box( 'kipla_media_meta', __( 'Media Details', 'kipla' ), 'kipla_media_meta_box', 'kipla_media', 'normal', 'high' );
	add_meta_box( 'kipla_update_meta', __( 'Newsletter / Event Details', 'kipla' ), 'kipla_update_meta_box', 'kipla_update', 'normal', 'high' );
	add_meta_box( 'kipla_program_meta', __( 'Program Details', 'kipla' ), 'kipla_program_meta_box', 'kipla_program', 'normal', 'high' );
	add_meta_box( 'kipla_testimonial_meta', __( 'Parent Details', 'kipla' ), 'kipla_testimonial_meta_box', 'kipla_testimonial', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'kipla_meta_boxes' );

/**
 * Small helper to print a text field.
 *
 * @param string $key   Meta key.
 * @param int    $id    Post ID.
 * @param string $label Field label.
 * @param string $help  Help text.
 * @param string $type  Input type.
 */
function kipla_meta_field( $key, $id, $label, $help = '', $type = 'text' ) {
	$value = get_post_meta( $id, $key, true );
	echo '<p><label for="' . esc_attr( $key ) . '"><strong>' . esc_html( $label ) . '</strong></label><br />';
	echo '<input type="' . esc_attr( $type ) . '" style="width:100%;max-width:640px" id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" value="' . esc_attr( $value ) . '" />';
	if ( $help ) {
		echo '<br /><span class="description">' . esc_html( $help ) . '</span>';
	}
	echo '</p>';
}

/**
 * Media meta box (photo or video).
 *
 * @param WP_Post $post Post.
 */
function kipla_media_meta_box( $post ) {
	wp_nonce_field( 'kipla_save_meta', 'kipla_meta_nonce' );
	$type = get_post_meta( $post->ID, '_kipla_media_type', true );
	$type = $type ? $type : 'photo';
	echo '<p><strong>' . esc_html__( 'Type', 'kipla' ) . '</strong><br />';
	echo '<label><input type="radio" name="_kipla_media_type" value="photo" ' . checked( $type, 'photo', false ) . ' /> ' . esc_html__( 'Photo (uses the Featured Image)', 'kipla' ) . '</label><br />';
	echo '<label><input type="radio" name="_kipla_media_type" value="video" ' . checked( $type, 'video', false ) . ' /> ' . esc_html__( 'Video (paste a YouTube, Vimeo or uploaded video URL below)', 'kipla' ) . '</label></p>';
	kipla_meta_field( '_kipla_video_url', $post->ID, __( 'Video URL', 'kipla' ), __( 'YouTube, Vimeo, or a video file uploaded to your Media Library.', 'kipla' ), 'url' );
}

/**
 * Update meta box.
 *
 * @param WP_Post $post Post.
 */
function kipla_update_meta_box( $post ) {
	wp_nonce_field( 'kipla_save_meta', 'kipla_meta_nonce' );
	kipla_meta_field( '_kipla_event_date', $post->ID, __( 'Event date (optional)', 'kipla' ), __( 'Only for events.', 'kipla' ), 'date' );
	kipla_meta_field( '_kipla_file_url', $post->ID, __( 'Newsletter PDF / file URL (optional)', 'kipla' ), __( 'Upload the newsletter to the Media Library and paste its URL here to add a download button.', 'kipla' ), 'url' );
}

/**
 * Program meta box.
 *
 * @param WP_Post $post Post.
 */
function kipla_program_meta_box( $post ) {
	wp_nonce_field( 'kipla_save_meta', 'kipla_meta_nonce' );
	kipla_meta_field( '_kipla_age_range', $post->ID, __( 'Age range', 'kipla' ), __( 'e.g. 6 weeks — 12 months', 'kipla' ) );
	kipla_meta_field( '_kipla_highlights', $post->ID, __( 'Highlights', 'kipla' ), __( 'Separate with a pipe: Sensory play | Motor skills | Nurturing care', 'kipla' ) );
}

/**
 * Testimonial meta box.
 *
 * @param WP_Post $post Post.
 */
function kipla_testimonial_meta_box( $post ) {
	wp_nonce_field( 'kipla_save_meta', 'kipla_meta_nonce' );
	kipla_meta_field( '_kipla_parent_name', $post->ID, __( 'Parent name', 'kipla' ) );
	kipla_meta_field( '_kipla_parent_rel', $post->ID, __( 'Relationship', 'kipla' ), __( 'e.g. Pre-K parent, KIPLA #2', 'kipla' ) );
}

/**
 * Save meta.
 *
 * @param int $post_id Post ID.
 */
function kipla_save_meta( $post_id ) {
	if ( ! isset( $_POST['kipla_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['kipla_meta_nonce'] ) ), 'kipla_save_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$urls = array( '_kipla_video_url', '_kipla_file_url' );
	$text = array( '_kipla_media_type', '_kipla_event_date', '_kipla_age_range', '_kipla_highlights', '_kipla_parent_name', '_kipla_parent_rel' );

	foreach ( $urls as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			update_post_meta( $post_id, $key, esc_url_raw( wp_unslash( $_POST[ $key ] ) ) );
		}
	}
	foreach ( $text as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			update_post_meta( $post_id, $key, sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) );
		}
	}
}
add_action( 'save_post', 'kipla_save_meta' );

/**
 * Front-end delete URL for a gallery item — empty unless the current user may edit it.
 *
 * @param int $post_id Media post ID.
 * @return string
 */
function kipla_media_delete_url( $post_id ) {
	if ( ! $post_id || ! current_user_can( 'edit_post', $post_id ) ) {
		return '';
	}
	return wp_nonce_url(
		admin_url( 'admin-post.php?action=kipla_delete_media&post=' . (int) $post_id ),
		'kipla_delete_media_' . $post_id
	);
}

/**
 * Handle the front-end gallery delete (admins only): trash the item, then return.
 */
function kipla_handle_media_delete() {
	$post_id = isset( $_GET['post'] ) ? absint( $_GET['post'] ) : 0;
	if ( ! $post_id || ! current_user_can( 'edit_post', $post_id ) ) {
		wp_die( esc_html__( 'You are not allowed to do that.', 'kipla' ), 403 );
	}
	check_admin_referer( 'kipla_delete_media_' . $post_id );
	if ( 'kipla_media' === get_post_type( $post_id ) ) {
		wp_trash_post( $post_id );
	}
	wp_safe_redirect( wp_get_referer() ? wp_get_referer() : get_post_type_archive_link( 'kipla_media' ) );
	exit;
}
add_action( 'admin_post_kipla_delete_media', 'kipla_handle_media_delete' );
