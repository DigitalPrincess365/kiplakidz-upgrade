<?php
/**
 * Canonical KIPLA program content, used to seed real program pages
 * and to power fallback cards before the site owner edits them.
 *
 * @package KIPLA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The six core KIPLA programs.
 *
 * @return array
 */
function kipla_program_data() {
	return array(
		array(
			'slug'      => 'infants',
			'title'     => __( 'Infants', 'kipla' ),
			'age'       => __( '6 weeks – 12 months', 'kipla' ),
			'summary'   => __( 'Responsive one-on-one care with daily bottle, nap, and diaper logs.', 'kipla' ),
			'intro'     => __( 'Our infant room is quiet, clean, and full of warmth. Every baby follows their own schedule for feeding and sleeping, and our educators hold, rock, talk, and sing all day long so your child feels safe and loved from the very first drop-off.', 'kipla' ),
			'locations' => array( 'kipla-1', 'kipla-2' ),
			'highlights'=> array(
				__( 'Individual feeding, nap, and diapering schedules', 'kipla' ),
				__( 'Daily digital log sent to parents', 'kipla' ),
				__( 'Tummy time, sensory play, and language-rich talk', 'kipla' ),
				__( 'Safe-sleep certified classroom', 'kipla' ),
			),
			'day'       => array(
				__( 'Warm greeting, bottle and diaper check-in', 'kipla' ),
				__( 'Tummy time, mirrors, and sensory baskets', 'kipla' ),
				__( 'Songs, books, and one-on-one cuddle time', 'kipla' ),
				__( 'Naps on baby\'s own schedule', 'kipla' ),
				__( 'Stroller walk or outdoor fresh air', 'kipla' ),
			),
			'included'  => array(
				__( 'Cribs, sheets, and safe-sleep setup', 'kipla' ),
				__( 'Parent app updates with photos', 'kipla' ),
				__( 'Developmental milestone tracking', 'kipla' ),
			),
		),
		array(
			'slug'      => 'toddlers',
			'title'     => __( 'Toddlers', 'kipla' ),
			'age'       => __( '1 – 2 years', 'kipla' ),
			'summary'   => __( 'Language-rich routines, potty-training support, music and movement.', 'kipla' ),
			'intro'     => __( 'Toddlers are busy, curious, and learning words by the hour. Our toddler classroom channels all that energy into routines, songs, and hands-on centers that build vocabulary, independence, and confident little bodies.', 'kipla' ),
			'locations' => array( 'kipla-1', 'kipla-2' ),
			'highlights'=> array(
				__( 'Potty-training partnership with families', 'kipla' ),
				__( 'Daily music, movement, and outdoor play', 'kipla' ),
				__( 'Self-feeding and independence skills', 'kipla' ),
				__( 'Gentle guidance and social-emotional coaching', 'kipla' ),
			),
			'day'       => array(
				__( 'Morning greeting and free-choice centers', 'kipla' ),
				__( 'Circle time: songs, names, weather, colors', 'kipla' ),
				__( 'Art, sensory, and building exploration', 'kipla' ),
				__( 'Outdoor play and gross-motor time', 'kipla' ),
				__( 'Family-style meals, nap, and afternoon stories', 'kipla' ),
			),
			'included'  => array(
				__( 'Cots and bedding for nap time', 'kipla' ),
				__( 'Potty-training supplies and support', 'kipla' ),
				__( 'Daily report with meals, naps, and moments', 'kipla' ),
			),
		),
		array(
			'slug'      => 'preschool',
			'title'     => __( 'Preschool', 'kipla' ),
			'age'       => __( '3 – 4 years', 'kipla' ),
			'summary'   => __( 'Letters, numbers, STEM centers, and social-emotional coaching.', 'kipla' ),
			'intro'     => __( 'Preschool at KIPLA is where scholars start to see themselves as learners and leaders. Days are built around letters and sounds, numbers and patterns, STEM discovery, and the friendship skills that make the rest of school easier.', 'kipla' ),
			'locations' => array( 'kipla-1', 'kipla-2' ),
			'highlights'=> array(
				__( 'Letter, sound, and early-writing practice', 'kipla' ),
				__( 'Math, patterns, and STEM discovery centers', 'kipla' ),
				__( 'Classroom jobs that build leadership', 'kipla' ),
				__( 'Learning walls that show scholar work', 'kipla' ),
			),
			'day'       => array(
				__( 'Arrival, morning work, and greetings', 'kipla' ),
				__( 'Circle time and small-group instruction', 'kipla' ),
				__( 'Learning centers: literacy, math, STEM, art', 'kipla' ),
				__( 'Outdoor play and movement', 'kipla' ),
				__( 'Rest, enrichment, and closing reflection', 'kipla' ),
			),
			'included'  => array(
				__( 'Curriculum materials and take-home work', 'kipla' ),
				__( 'Progress updates and parent conferences', 'kipla' ),
				__( 'Enrichment and celebration days', 'kipla' ),
			),
		),
		array(
			'slug'      => 'georgia-pre-k',
			'title'     => __( 'Georgia Pre-K', 'kipla' ),
			'age'       => __( '4 years old by Sept. 1', 'kipla' ),
			'summary'   => __( 'State-funded Pre-K led by certified educators — leadership-centered learning for every next step.', 'kipla' ),
			'intro'     => __( 'KIPLA offers Georgia\'s Pre-K Program with certified lead teachers and the state-approved curriculum, delivered the KIPLA way: leadership-centered learning designed to prepare scholars for every next step. Seats are limited and fill quickly each year.', 'kipla' ),
			'locations' => array( 'kipla-1', 'kipla-2' ),
			'highlights'=> array(
				__( 'State-funded, no tuition for the Pre-K day', 'kipla' ),
				__( 'Georgia-certified lead teachers', 'kipla' ),
				__( 'Standards-aligned literacy and math', 'kipla' ),
				__( 'Wrap-around before & after care available', 'kipla' ),
			),
			'day'       => array(
				__( 'Morning meeting and shared reading', 'kipla' ),
				__( 'Small-group literacy and math instruction', 'kipla' ),
				__( 'Center rotations and project work', 'kipla' ),
				__( 'Outdoor learning and movement', 'kipla' ),
				__( 'Rest, enrichment, and leadership circle', 'kipla' ),
			),
			'included'  => array(
				__( 'All Georgia Pre-K instructional materials', 'kipla' ),
				__( 'Work Sampling progress reports', 'kipla' ),
				__( 'Transition-to-kindergarten support', 'kipla' ),
			),
		),
		array(
			'slug'      => 'before-after-school',
			'title'     => __( 'Before & After School', 'kipla' ),
			'age'       => __( '5 – 12 years', 'kipla' ),
			'summary'   => __( 'Transportation, homework help, and leadership-building enrichment.', 'kipla' ),
			'intro'     => __( 'School-age scholars get a calm landing spot before the bell and a productive, joyful afternoon after it — homework first, then enrichment, games, and leadership activities with educators who know them by name.', 'kipla' ),
			'locations' => array( 'kipla-1', 'kipla-2' ),
			'highlights'=> array(
				__( 'Transportation to and from partner schools', 'kipla' ),
				__( 'Daily homework help and quiet study time', 'kipla' ),
				__( 'Snack, games, and enrichment clubs', 'kipla' ),
				__( 'Full-day care on school holidays', 'kipla' ),
			),
			'day'       => array(
				__( 'Early-morning drop-off, breakfast, and calm start', 'kipla' ),
				__( 'Transport to school', 'kipla' ),
				__( 'Afternoon pickup and snack', 'kipla' ),
				__( 'Homework help and reading time', 'kipla' ),
				__( 'Enrichment clubs, outdoor play, and free choice', 'kipla' ),
			),
			'included'  => array(
				__( 'Morning and afternoon snack', 'kipla' ),
				__( 'School transportation (partner schools)', 'kipla' ),
				__( 'Holiday and teacher-workday coverage', 'kipla' ),
			),
		),
		array(
			'slug'      => 'summer-camp',
			'title'     => __( 'Summer Camp', 'kipla' ),
			'age'       => __( '5 – 12 years', 'kipla' ),
			'summary'   => __( 'Field trips, STEAM projects, water days, and community service.', 'kipla' ),
			'intro'     => __( 'KIPLA Summer Camp keeps scholars learning while they play. Every week has a theme, a project, and something to look forward to — field trips, water days, STEAM builds, talent shows, and service projects around our community.', 'kipla' ),
			'locations' => array( 'kipla-1', 'kipla-2' ),
			'highlights'=> array(
				__( 'Weekly themes and field trips', 'kipla' ),
				__( 'STEAM projects and hands-on builds', 'kipla' ),
				__( 'Water days, talent shows, and celebrations', 'kipla' ),
				__( 'Community service and leadership projects', 'kipla' ),
			),
			'day'       => array(
				__( 'Camp check-in and breakfast', 'kipla' ),
				__( 'Morning theme activity or field trip', 'kipla' ),
				__( 'Lunch and quiet reading', 'kipla' ),
				__( 'STEAM project or water play', 'kipla' ),
				__( 'Team games and end-of-day share-out', 'kipla' ),
			),
			'included'  => array(
				__( 'Field-trip admission and transportation', 'kipla' ),
				__( 'Camp T-shirt and weekly supplies', 'kipla' ),
				__( 'Breakfast, lunch, and snack', 'kipla' ),
			),
		),
	);
}

/**
 * Location term data used when seeding.
 *
 * @return array
 */
function kipla_location_seed() {
	return array(
		'kipla-1' => kipla_opt( 'kipla_loc1_name' ) ? kipla_opt( 'kipla_loc1_name' ) : 'KIPLA #1',
		'kipla-2' => kipla_opt( 'kipla_loc2_name' ) ? kipla_opt( 'kipla_loc2_name' ) : 'KIPLA #2',
	);
}

/**
 * Build the page body for a seeded program.
 *
 * @param array $program Program definition.
 * @return string
 */
function kipla_program_body( $program ) {
	$body  = '<!-- wp:paragraph --><p>' . $program['intro'] . '</p><!-- /wp:paragraph -->';
	$body .= '<!-- wp:heading {"level":2} --><h2>' . esc_html__( 'What makes this program special', 'kipla' ) . '</h2><!-- /wp:heading -->';
	$body .= '<!-- wp:list --><ul>';
	foreach ( $program['highlights'] as $item ) {
		$body .= '<li>' . $item . '</li>';
	}
	$body .= '</ul><!-- /wp:list -->';
	return $body;
}

/**
 * Create the six program pages the first time the theme is activated.
 */
function kipla_seed_programs() {
	if ( get_option( 'kipla_programs_seeded' ) ) {
		return;
	}

	kipla_register_post_types();

	$terms = array();
	foreach ( kipla_location_seed() as $slug => $name ) {
		$existing = get_term_by( 'slug', $slug, 'kipla_location' );
		if ( $existing ) {
			$terms[ $slug ] = (int) $existing->term_id;
			continue;
		}
		$created = wp_insert_term( $name, 'kipla_location', array( 'slug' => $slug ) );
		if ( ! is_wp_error( $created ) ) {
			$terms[ $slug ] = (int) $created['term_id'];
		}
	}

	$order = 0;
	foreach ( kipla_program_data() as $program ) {
		$order += 10;

		$existing = get_page_by_path( $program['slug'], OBJECT, 'kipla_program' );
		if ( $existing ) {
			continue;
		}

		$post_id = wp_insert_post( array(
			'post_type'    => 'kipla_program',
			'post_status'  => 'publish',
			'post_title'   => $program['title'],
			'post_name'    => $program['slug'],
			'post_excerpt' => $program['summary'],
			'post_content' => kipla_program_body( $program ),
			'menu_order'   => $order,
		) );

		if ( is_wp_error( $post_id ) || ! $post_id ) {
			continue;
		}

		update_post_meta( $post_id, '_kipla_age_range', $program['age'] );
		update_post_meta( $post_id, '_kipla_highlights', implode( ' | ', $program['highlights'] ) );
		update_post_meta( $post_id, '_kipla_day', implode( ' | ', $program['day'] ) );
		update_post_meta( $post_id, '_kipla_included', implode( ' | ', $program['included'] ) );

		$term_ids = array();
		foreach ( $program['locations'] as $slug ) {
			if ( isset( $terms[ $slug ] ) ) {
				$term_ids[] = $terms[ $slug ];
			}
		}
		if ( $term_ids ) {
			wp_set_object_terms( $post_id, $term_ids, 'kipla_location' );
		}
	}

	update_option( 'kipla_programs_seeded', 1 );
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'kipla_seed_programs' );

/**
 * Permalink for a core program, falling back to the archive.
 *
 * @param string $slug Program slug.
 * @return string
 */
function kipla_program_link( $slug ) {
	$post = get_page_by_path( $slug, OBJECT, 'kipla_program' );
	if ( $post ) {
		return get_permalink( $post );
	}
	return get_post_type_archive_link( 'kipla_program' );
}
