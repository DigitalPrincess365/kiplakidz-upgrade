<?php
/**
 * Front page: programs grid with location filters.
 *
 * @package KIPLA
 */

$kipla_assets = get_template_directory_uri();

$kipla_programs = array(
	array(
		'title'  => 'Infants',
		'age'    => '6 weeks – 12 months',
		'points' => array( 'Responsive one-on-one care and daily bottle, nap &amp; diaper logs' ),
		'where'  => 'KIPLA #2 only',
		'img'    => '/assets/images/programs-infants.webp',
		'alt'    => 'KIPLA infants playing on a foam mat',
		'locs'   => 'kipla-2',
	),
	array(
		'title'  => 'One\'s',
		'age'    => '12 – 24 months',
		'points' => array( 'Mobile infants exploring language, movement, and sensory play in a nurturing space' ),
		'where'  => 'KIPLA #2 only',
		'img'    => '/assets/images/programs-ones.webp',
		'alt'    => 'KIPLA One\'s classroom — toddlers sitting on a learning rug',
		'locs'   => 'kipla-2',
	),
	array(
		'title'  => 'Toddlers',
		'age'    => '1 – 2 years',
		'points' => array( 'Language-rich routines, potty-training support, music &amp; movement' ),
		'where'  => 'KIPLA #1 + KIPLA #2',
		'img'    => '/assets/images/programs-toddlers.jpeg',
		'alt'    => 'KIPLA toddlers riding tricycles on the playground',
		'locs'   => 'kipla-1 kipla-2',
	),
	array(
		'title'  => 'Pre-School',
		'age'    => '3 – 4 years',
		'points' => array( 'Hands-on learning centers, early literacy &amp; math readiness, and growing independence' ),
		'where'  => 'KIPLA #1 + KIPLA #2',
		'img'    => '/assets/images/programs-preschool.jpeg',
		'alt'    => 'KIPLA pre-school scholars building with colorful foam blocks on a learning rug',
		'locs'   => 'kipla-1 kipla-2',
	),
	array(
		'title'  => 'Georgia Pre-K 1',
		'age'    => '4 years after Sept. 1',
		'points' => array( 'State-funded Pre-K led by certified educators — leadership-centered learning for every next step' ),
		'where'  => 'KIPLA #1 + KIPLA #2',
		'img'    => '/assets/images/programs-pre-k-1.webp',
		'alt'    => 'KIPLA Pre-K 1 class with their teacher',
		'locs'   => 'kipla-1 kipla-2',
	),
	array(
		'title'  => 'Georgia Pre-K 2',
		'age'    => '4 years after Sept. 1',
		'points' => array( 'State-funded Pre-K led by certified educators — leadership-centered learning for every next step' ),
		'where'  => 'KIPLA #1 + KIPLA #2',
		'img'    => '/assets/images/programs-georgia-pre-k-2.webp',
		'alt'    => 'Georgia Pre-K 2 class group photo outdoors',
		'locs'   => 'kipla-1 kipla-2',
	),
	array(
		'title'  => 'After School',
		'age'    => '5 – 12 years',
		'points' => array( 'Transportation, homework help, and leadership-building enrichment' ),
		'where'  => 'KIPLA #1 + KIPLA #2',
		'img'    => '/assets/images/programs-after-school-new.jpeg',
		'alt'    => 'KIPLA after-school scholars working on worksheets at a table',
		'locs'   => 'kipla-1 kipla-2',
	),
	array(
		'title'  => 'Summer Camp',
		'age'    => '5 – 12 years',
		'points' => array( 'Field trips, STEAM projects, water days and community service' ),
		'where'  => 'KIPLA #1 + KIPLA #2',
		'img'    => '/assets/images/programs-summer-camp.webp',
		'alt'    => 'KIPLA summer camp water day fun',
		'locs'   => 'kipla-1 kipla-2',
	),
);
?>

<section class="section section--hunter" id="programs">
	<div class="container">
		<div style="text-align:center;max-width:44rem;margin:0 auto 2.5rem">
			<span class="eyebrow">Our Programs</span>
			<h2>Find the right room for your child</h2>
			<p style="color:rgba(254,250,240,.78)">Age-based classrooms with intentional curriculum, warm routines, and daily communication.</p>
		</div>
		<div class="program-filters">
			<button class="program-filter is-active" data-filter="all">All programs</button>
			<button class="program-filter" data-filter="kipla-1">KIPLA #1</button>
			<button class="program-filter" data-filter="kipla-2">KIPLA #2</button>
		</div>
		<div class="program-grid">
			<?php foreach ( $kipla_programs as $kipla_program ) : ?>
				<article class="program-card" data-locations="<?php echo esc_attr( $kipla_program['locs'] ); ?>">
					<figure class="frame frame--wide program-card__media"><img src="<?php echo esc_url( $kipla_assets . $kipla_program['img'] ); ?>" alt="<?php echo esc_attr( $kipla_program['alt'] ); ?>" loading="lazy" /></figure>
					<h3><?php echo esc_html( $kipla_program['title'] ); ?></h3>
					<p class="program-card__age"><?php echo esc_html( $kipla_program['age'] ); ?></p>
					<ul><li><?php echo wp_kses_post( implode( '</li><li>', $kipla_program['points'] ) ); ?></li></ul>
					<p class="program-card__where"><?php echo esc_html( $kipla_program['where'] ); ?></p>
					<a class="link-underline program-card__link" href="#updates">Learn More</a>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
