<?php
/**
 * Front page — the eight core KIPLA sections.
 *
 * 1. Hero / First Impression
 * 2. Welcome to KIPLA
 * 3. Our Programs
 * 4. The KIPLA Difference
 * 5. Culture in Action
 * 6. Meet Our Founder
 * 7. What KIPLA Families Say
 * 8. See KIPLA in Action
 *
 * @package KIPLA
 */

get_header();

$tour   = kipla_opt( 'kipla_tour_url' );
$enroll = kipla_opt( 'kipla_enroll_url' );
?>

<!-- 1. HERO / FIRST IMPRESSION -->
<section class="hero container" id="hero">
	<div class="hero__inner">
		<span class="eyebrow"><?php echo esc_html( kipla_opt( 'kipla_hero_eyebrow' ) ? kipla_opt( 'kipla_hero_eyebrow' ) : __( 'Teach · Train · Motivate · Love', 'kipla' ) ); ?></span>
		<h1>
			<?php
			$heading = kipla_opt( 'kipla_hero_heading' );
			echo $heading
				? kipla_accent_text( $heading ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				: wp_kses_post( __( 'Where We Teach, Train, Motivate, &amp; <span class="accent">Love</span>', 'kipla' ) );
			?>
		</h1>
		<p class="hero__tagline"><?php echo wp_kses_post( __( 'A <span class="accent-gold">Positive</span> Start Shapes Everything That Follows.', 'kipla' ) ); ?></p>
		<p class="hero__lead">
			<?php
			echo esc_html( kipla_opt( 'kipla_hero_lead' ) ? kipla_opt( 'kipla_hero_lead' ) : __( 'At Keeping It Positive Learning Academy we teach with purpose, train future leaders, motivate every scholar, and love them like family — across two campuses in Austell and Lithia Springs, from 6 weeks through 12 years.', 'kipla' ) );
			?>
		</p>
		<div class="hero__actions">
			<a class="btn btn--primary" href="<?php echo esc_url( $tour ); ?>"><?php esc_html_e( 'Schedule a Tour', 'kipla' ); ?></a>
			<a class="btn btn--gold" href="<?php echo esc_url( $enroll ); ?>"><?php esc_html_e( 'Enroll / Learn More', 'kipla' ); ?></a>
			<a class="btn btn--ghost" href="#programs"><?php esc_html_e( 'Explore Programs', 'kipla' ); ?></a>
		</div>
	</div>
	<div class="hero__media reveal">
		<?php
		kipla_frame( array(
			'image_id' => absint( get_theme_mod( 'kipla_hero_image' ) ),
			'size'     => 'kipla-wide',
			'modifier' => 'frame--wide',
			'label'    => __( 'Hero photo or short video', 'kipla' ),
			'hint'     => __( 'Add a large authentic KIPLA photo or short welcome video in Customize → KIPLA: Hero & Welcome.', 'kipla' ),
			'alt'      => get_bloginfo( 'name' ),
		) );
		?>

	</div>
</section>

<div class="affirmations" aria-hidden="true">
	<div class="affirmations__track">
		<?php
		$affirmations = array( __( 'Teach', 'kipla' ), __( 'Train', 'kipla' ), __( 'Motivate', 'kipla' ), __( 'Love', 'kipla' ) );
		for ( $pass = 0; $pass < 2; $pass++ ) {
		foreach ( $affirmations as $line ) {
			echo '<span>' . esc_html( $line ) . '</span><span class="affirmations__sep" aria-hidden="true">🌻</span>';
		}
		}
		?>
	</div>
</div>

<!-- 2. WELCOME TO KIPLA (+ clear KIPLA #1 / #2 distinction) -->
<section class="section section--white" id="welcome">
	<div class="container">
		<div class="split">
			<div class="reveal">
				<span class="eyebrow"><?php esc_html_e( 'Welcome to KIPLA', 'kipla' ); ?></span>
				<hr class="rule" />
				<h2><?php echo esc_html( kipla_opt( 'kipla_welcome_head' ) ? kipla_opt( 'kipla_welcome_head' ) : __( 'A positive start shapes everything that follows', 'kipla' ) ); ?></h2>
				<p>
					<?php
					echo esc_html( kipla_opt( 'kipla_welcome_text' ) ? kipla_opt( 'kipla_welcome_text' ) : __( 'KIPLA is a family-owned early learning community in Austell, Georgia, with two campuses serving scholars from 6 weeks through 12 years. From the first morning, your child is known by name, story, and strength.', 'kipla' ) );
					?>
				</p>
				<p><strong><?php esc_html_e( 'The KIPLA difference:', 'kipla' ); ?></strong> <?php esc_html_e( 'we pair leadership-centered learning designed to prepare scholars for every next step with genuine warmth — every scholar is taught, trained, motivated, and loved every single day.', 'kipla' ); ?></p>
				<div class="stat-row">
					<div class="stat"><div class="stat__num">2</div><div class="stat__label"><?php esc_html_e( 'Campuses in West Georgia', 'kipla' ); ?></div></div>
					<div class="stat"><div class="stat__num"><?php esc_html_e( '6 wks – 12 yrs', 'kipla' ); ?></div><div class="stat__label"><?php esc_html_e( 'Ages served', 'kipla' ); ?></div></div>
				</div>
			</div>
			<div class="reveal">
				<?php
				kipla_frame( array(
					'image_id' => absint( get_theme_mod( 'kipla_welcome_image' ) ),
					'size'     => 'kipla-portrait',
					'modifier' => 'frame--leaf frame--portrait',
					'label'    => __( 'Scholars & educators photo', 'kipla' ),
					'hint'     => __( 'An authentic photograph of KIPLA scholars learning with their educators.', 'kipla' ),
				) );
				?>

			</div>
		</div>

		<div id="locations" style="margin-top:clamp(2.5rem,6vw,4rem)">
			<div class="section-head">
				<div>
					<span class="eyebrow eyebrow--red"><?php esc_html_e( 'Our two campuses', 'kipla' ); ?></span>
					<h2><?php esc_html_e( 'KIPLA #1 &amp; KIPLA #2', 'kipla' ); ?></h2>
					<p><?php esc_html_e( 'Same heart, same standards, all programs — two convenient locations.', 'kipla' ); ?></p>
				</div>
			</div>
			<div class="locations">
				<?php kipla_location_card( 1 ); ?>
				<?php kipla_location_card( 2 ); ?>
			</div>
		</div>
	</div>
</section>

<!-- 3. OUR PROGRAMS -->
<section class="section section--hunter" id="programs">
	<div class="container">
		<div style="text-align:center;max-width:44rem;margin:0 auto 2.5rem">
			<span class="eyebrow"><?php esc_html_e( 'Our Programs', 'kipla' ); ?></span>
			<h2><?php esc_html_e( 'Find the right room for your child', 'kipla' ); ?></h2>
			<p style="color:rgba(254,250,240,.78)"><?php esc_html_e( 'Age-based classrooms with intentional curriculum, warm routines, and daily communication home.', 'kipla' ); ?></p>
		</div>

		<?php
		$locations = get_terms( array(
			'taxonomy'   => 'kipla_location',
			'hide_empty' => true,
		) );

		if ( ! is_wp_error( $locations ) && count( $locations ) > 1 ) :
			?>
			<div class="program-filters">
				<button class="program-filter is-active" type="button" data-filter="all"><?php esc_html_e( 'All programs', 'kipla' ); ?></button>
				<?php foreach ( $locations as $term ) : ?>
					<button class="program-filter" type="button" data-filter="<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></button>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php
		$programs = new WP_Query( array(
			'post_type'      => 'kipla_program',
			'posts_per_page' => 12,
			'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'ASC' ),
		) );

		if ( $programs->have_posts() ) :
			?>
			<div class="program-grid">
				<?php
				while ( $programs->have_posts() ) :
					$programs->the_post();
					$terms      = get_the_terms( get_the_ID(), 'kipla_location' );
					$slugs      = ( $terms && ! is_wp_error( $terms ) ) ? wp_list_pluck( $terms, 'slug' ) : array();
					$names      = ( $terms && ! is_wp_error( $terms ) ) ? wp_list_pluck( $terms, 'name' ) : array();
					$age        = get_post_meta( get_the_ID(), '_kipla_age_range', true );
					$highlights = array_filter( array_map( 'trim', explode( '|', (string) get_post_meta( get_the_ID(), '_kipla_highlights', true ) ) ) );
					?>
					<article class="program-card reveal" data-locations="<?php echo esc_attr( implode( ' ', $slugs ) ); ?>">
						<?php
						kipla_frame( array(
							'post_id'  => get_the_ID(),
							'size'     => 'kipla-wide',
							'modifier' => 'frame--wide program-card__media',
							'label'    => get_the_title() . __( ' photo', 'kipla' ),
							'hint'     => __( 'Set a featured image for this program.', 'kipla' ),
							'alt'      => get_the_title(),
						) );
						?>
						<h3><?php the_title(); ?></h3>
						<?php if ( $age ) : ?>
							<p class="program-card__age"><?php echo esc_html( $age ); ?></p>
						<?php endif; ?>
						<?php if ( $highlights ) : ?>
							<ul>
								<?php foreach ( $highlights as $item ) : ?>
									<li><span><?php echo esc_html( $item ); ?></span></li>
								<?php endforeach; ?>
							</ul>
						<?php else : ?>
							<ul><li><span><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></span></li></ul>
						<?php endif; ?>
						<?php if ( $names ) : ?>
							<span class="program-card__where"><?php echo esc_html( implode( ' · ', $names ) ); ?></span>
						<?php endif; ?>
						<a class="link-underline program-card__link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Learn More', 'kipla' ); ?></a>
					</article>
					<?php
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		<?php else : ?>
			<div class="program-grid">
				<?php
				$default_programs = array();
				foreach ( kipla_program_data() as $p ) {
					$default_programs[] = array( $p['title'], $p['age'], $p['summary'], kipla_program_link( $p['slug'] ) );
				}
				foreach ( $default_programs as $item ) :
					?>
					<article class="program-card reveal">
						<?php
						kipla_frame( array(
							'modifier' => 'frame--wide program-card__media',
							'label'    => $item[0] . __( ' photo', 'kipla' ),
							'hint'     => __( 'Add this program under Programs and set a featured image.', 'kipla' ),
						) );
						?>
						<h3><?php echo esc_html( $item[0] ); ?></h3>
						<p class="program-card__age"><?php echo esc_html( $item[1] ); ?></p>
						<ul><li><span><?php echo esc_html( $item[2] ); ?></span></li></ul>
						<a class="link-underline program-card__link" href="<?php echo esc_url( $item[3] ); ?>"><?php esc_html_e( 'Learn More', 'kipla' ); ?></a>
					</article>
					<?php
				endforeach;
				?>
			</div>
		<?php endif; ?>


		<div style="text-align:center;margin-top:2.5rem">
			<a class="btn btn--gold" href="<?php echo esc_url( $tour ); ?>"><?php esc_html_e( 'Schedule a Tour', 'kipla' ); ?></a>
		</div>
	</div>
</section>

<!-- 4. THE KIPLA DIFFERENCE -->
<section class="section section--hunter" id="difference" style="padding-top:0">
	<div class="container">
		<div class="difference">
			<div class="reveal">
				<span class="eyebrow"><?php esc_html_e( 'The KIPLA Difference', 'kipla' ); ?></span>
				<h2><?php esc_html_e( 'Why families choose us', 'kipla' ); ?></h2>
			</div>
			<div class="difference__grid">
				<?php
				$difference = array(
					array( __( 'Positive language, always', 'kipla' ), __( 'Children learn to speak kindly to themselves and each other — it starts with how we speak to them.', 'kipla' ) ),
					array( __( 'Teachers who stay', 'kipla' ), __( 'Low turnover and real relationships mean your child sees the same trusted faces every day.', 'kipla' ) ),
					array( __( 'Kindergarten-ready', 'kipla' ), __( 'Literacy, math, and social skills woven into play so children leave us confident and prepared.', 'kipla' ) ),
					array( __( 'Parents in the loop', 'kipla' ), __( 'Daily updates, photos, and open conversation — no wondering how the day went.', 'kipla' ) ),
				);
				foreach ( $difference as $item ) :
					?>
					<div class="difference__item reveal">
						<h3><?php echo esc_html( $item[0] ); ?></h3>
						<p><?php echo esc_html( $item[1] ); ?></p>
					</div>
					<?php
				endforeach;
				?>
			</div>
		</div>
	</div>
</section>

<!-- 5. CULTURE IN ACTION -->
<section class="section" id="culture">
	<div class="container">
		<div class="section-head">
			<div>
				<span class="eyebrow eyebrow--red"><?php esc_html_e( 'Culture in Action', 'kipla' ); ?></span>
				<h2><?php esc_html_e( 'What positivity looks like on a Tuesday', 'kipla' ); ?></h2>
				<p><?php esc_html_e( 'Our values are not on a poster — they are in the routines, the rituals, and the small moments.', 'kipla' ); ?></p>
			</div>
		</div>
		<div class="culture-grid">
			<?php
			$culture = array(
				array( 'sun', __( 'Morning affirmations', 'kipla' ), __( 'Every classroom opens the day standing tall together: I am kind, I am capable, I am loved.', 'kipla' ) ),
				array( 'heart', __( 'Kindness in practice', 'kipla' ), __( 'Conflict becomes coaching. Children learn words for big feelings and how to make things right.', 'kipla' ) ),
				array( 'book', __( 'Celebrating growth', 'kipla' ), __( 'First words, first letters, first friendships — milestones get noticed and cheered here.', 'kipla' ) ),
			);
			foreach ( $culture as $card ) :
				?>
				<article class="culture-card reveal">
					<span class="program-card__icon" aria-hidden="true"><?php echo kipla_icon( $card[0] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<h3><?php echo esc_html( $card[1] ); ?></h3>
					<p><?php echo esc_html( $card[2] ); ?></p>
				</article>
				<?php
			endforeach;
			?>
		</div>
	</div>
</section>

<!-- 6. MEET OUR FOUNDER -->
<section class="section section--cream" id="founder">
	<div class="container">
		<div class="founder-card reveal">
			<span class="founder-corner founder-corner--tl" aria-hidden="true"><?php echo kipla_sunflower(); // phpcs:ignore ?></span>
			<span class="founder-corner founder-corner--br" aria-hidden="true"><?php echo kipla_sunflower(); // phpcs:ignore ?></span>
			<div class="founder-media">
				<span class="founder-media__halo" aria-hidden="true"></span>
				<?php
				kipla_frame( array(
					'image_id'    => absint( get_theme_mod( 'kipla_founder_photo' ) ),
					'size'        => 'kipla-portrait',
					'modifier'    => 'frame--arch frame--portrait founder-media__frame',
					'label'       => __( 'Founder photo space', 'kipla' ),
					'hint'        => __( 'Replace this photo in Customize → KIPLA: Meet Our Founder.', 'kipla' ),
					'alt'         => kipla_opt( 'kipla_founder_name' ),
					'default_src' => get_template_directory_uri() . '/assets/images/founder.jpg',
				) );
				?>
				<span class="founder-badge"><?php echo kipla_sunflower(); // phpcs:ignore ?><span><?php esc_html_e( 'Founder & Visionary', 'kipla' ); ?></span></span>
			</div>
			<div class="founder-body">
				<span class="eyebrow"><?php esc_html_e( 'Meet Our Founder', 'kipla' ); ?></span>
				<h2 class="founder-heading"><?php echo esc_html( sprintf( __( 'Meet %s', 'kipla' ), kipla_opt( 'kipla_founder_name' ) ) ); ?></h2>
				<span class="founder-role"><?php echo esc_html( kipla_opt( 'kipla_founder_role' ) ); ?></span>

				<p class="founder-text"><?php echo esc_html( kipla_opt( 'kipla_founder_intro' ) ); ?></p>
				<p class="founder-text"><?php echo esc_html( kipla_opt( 'kipla_founder_creds' ) ); ?></p>

				<p class="founder-belief"><?php esc_html_e( 'That belief became the heart of KIPLA:', 'kipla' ); ?></p>
				<?php
				$ttml_parts = array_filter( array_map( 'trim', explode( '•', kipla_opt( 'kipla_founder_ttml' ) ) ) );
				if ( empty( $ttml_parts ) ) {
					$ttml_parts = array( kipla_opt( 'kipla_founder_ttml' ) );
				}
				?>
				<p class="founder-ttml">
					<?php foreach ( $ttml_parts as $ttml_i => $ttml_word ) : ?>
						<?php if ( $ttml_i > 0 ) : ?>
							<span class="founder-ttml__sep" aria-hidden="true"><?php echo kipla_sunflower(); // phpcs:ignore ?></span>
						<?php endif; ?>
						<span class="founder-ttml__word"><?php echo esc_html( $ttml_word ); ?></span>
					<?php endforeach; ?>
				</p>

				<p class="founder-text"><?php echo esc_html( kipla_opt( 'kipla_founder_vision' ) ); ?></p>
				<p class="founder-text"><?php echo esc_html( kipla_opt( 'kipla_founder_closing' ) ); ?></p>

				<p class="founder-mission"><?php echo esc_html( kipla_opt( 'kipla_founder_mission' ) ); ?></p>
				<p class="founder-signature">— <?php echo esc_html( kipla_opt( 'kipla_founder_signature' ) ); ?></p>

				<p class="founder-cta"><a class="btn btn--primary" href="<?php echo esc_url( kipla_opt( 'kipla_founder_story_url' ) ); ?>"><?php esc_html_e( 'Read Our Story', 'kipla' ); ?></a></p>
			</div>
		</div>
	</div>
</section>

<!-- 7. WHAT KIPLA FAMILIES SAY -->
<section class="section" id="testimonials">
	<div class="container">
		<div class="section-head">
			<div>
				<span class="eyebrow eyebrow--red"><?php esc_html_e( 'What KIPLA Families Say', 'kipla' ); ?></span>
				<h2><?php esc_html_e( 'Trusted by parents across our community', 'kipla' ); ?></h2>
			</div>
		</div>

		<?php
		$testimonials = new WP_Query( array(
			'post_type'      => 'kipla_testimonial',
			'posts_per_page' => 3,
			'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
		) );

		if ( $testimonials->have_posts() ) :
			?>
			<div class="testimonial-grid">
				<?php
				while ( $testimonials->have_posts() ) :
					$testimonials->the_post();
					?>
					<figure class="testimonial reveal">
						<div class="testimonial__stars" aria-hidden="true">★★★★★</div>
						<blockquote class="testimonial__quote"><?php echo esc_html( wp_strip_all_tags( get_the_content() ) ); ?></blockquote>
						<figcaption>
							<div class="testimonial__author"><?php echo esc_html( get_post_meta( get_the_ID(), '_kipla_parent_name', true ) ? get_post_meta( get_the_ID(), '_kipla_parent_name', true ) : get_the_title() ); ?></div>
							<span class="testimonial__rel"><?php echo esc_html( get_post_meta( get_the_ID(), '_kipla_parent_rel', true ) ); ?></span>
						</figcaption>
					</figure>
					<?php
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		<?php else : ?>
			<p><?php esc_html_e( 'Add parent reviews under Testimonials in the WordPress admin and they will appear here.', 'kipla' ); ?></p>
		<?php endif; ?>

		<div class="credibility">
			<?php
			$credibility = array(
				array( __( 'Licensed', 'kipla' ), __( 'State of Georgia', 'kipla' ) ),
				array( __( 'CPR', 'kipla' ), __( 'Certified staff', 'kipla' ) ),
				array( __( 'Secure', 'kipla' ), __( 'Keypad entry', 'kipla' ) ),
				array( __( 'Family', 'kipla' ), __( 'Owned & operated', 'kipla' ) ),
			);
			foreach ( $credibility as $item ) :
				?>
				<div class="credibility__item reveal">
					<strong><?php echo esc_html( $item[0] ); ?></strong>
					<span><?php echo esc_html( $item[1] ); ?></span>
				</div>
				<?php
			endforeach;
			?>
		</div>
	</div>
</section>

<!-- 8. SEE KIPLA IN ACTION -->
<section class="section section--white" id="in-action">
	<div class="container">
		<div class="section-head">
			<div>
				<span class="eyebrow"><?php esc_html_e( 'See KIPLA in Action', 'kipla' ); ?></span>
				<h2><?php esc_html_e( 'Photos, videos, and everyday moments', 'kipla' ); ?></h2>
				<p><?php esc_html_e( 'Follow along on Instagram, TikTok, and YouTube for daily peeks into our classrooms.', 'kipla' ); ?></p>
			</div>
			<?php kipla_social_links( 'social-links--dark' ); ?>
		</div>

		<?php
		$videos = new WP_Query( array(
			'post_type'      => 'kipla_media',
			'posts_per_page' => 1,
			'meta_query'     => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
				array(
					'key'   => '_kipla_media_type',
					'value' => 'video',
				),
			),
		) );

		if ( $videos->have_posts() ) :
			while ( $videos->have_posts() ) :
				$videos->the_post();
				echo '<div class="reveal" style="margin-bottom:2rem">';
				kipla_video_embed( get_post_meta( get_the_ID(), '_kipla_video_url', true ) );
				echo '</div>';
			endwhile;
			wp_reset_postdata();
		endif;

		$photos = new WP_Query( array(
			'post_type'      => 'kipla_media',
			'posts_per_page' => 8,
			'meta_query'     => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
				'relation' => 'OR',
				array(
					'key'   => '_kipla_media_type',
					'value' => 'photo',
				),
				array(
					'key'     => '_kipla_media_type',
					'compare' => 'NOT EXISTS',
				),
			),
		) );
		?>

		<div class="gallery-grid">
			<?php
			if ( $photos->have_posts() ) :
				while ( $photos->have_posts() ) :
					$photos->the_post();
					kipla_frame( array(
						'post_id'  => get_the_ID(),
						'size'     => 'kipla-square',
						'modifier' => 'frame--square',
						'label'    => __( 'Photo space', 'kipla' ),
						'hint'     => get_the_title(),
						'alt'      => get_the_title(),
					) );
				endwhile;
				wp_reset_postdata();
			else :
				for ( $i = 0; $i < 4; $i++ ) {
					kipla_frame( array(
						'modifier' => 'frame--square',
						'label'    => __( 'Photo space', 'kipla' ),
						'hint'     => __( 'Add photos and videos under Photos & Videos.', 'kipla' ),
					) );
				}
			endif;
			?>
		</div>

		<p style="text-align:center;margin-top:2rem">
			<a class="link-underline" href="<?php echo esc_url( get_post_type_archive_link( 'kipla_media' ) ); ?>"><?php esc_html_e( 'View the full gallery', 'kipla' ); ?></a>
		</p>
	</div>
</section>

<!-- NEWS, NEWSLETTERS, EVENTS & CLASSROOM HIGHLIGHTS -->
<section class="section" id="updates">
	<div class="container">
		<div class="section-head">
			<div>
				<span class="eyebrow eyebrow--red"><?php esc_html_e( 'News &amp; Newsletters', 'kipla' ); ?></span>
				<h2><?php esc_html_e( 'Announcements, events &amp; classroom highlights', 'kipla' ); ?></h2>
			</div>
			<a class="link-underline" href="<?php echo esc_url( get_post_type_archive_link( 'kipla_update' ) ); ?>"><?php esc_html_e( 'All updates', 'kipla' ); ?></a>
		</div>

		<?php
		$updates = new WP_Query( array(
			'post_type'      => 'kipla_update',
			'posts_per_page' => 3,
		) );

		if ( $updates->have_posts() ) :
			?>
			<div class="update-grid">
				<?php
				while ( $updates->have_posts() ) :
					$updates->the_post();
					$types = get_the_terms( get_the_ID(), 'kipla_update_type' );
					$file  = get_post_meta( get_the_ID(), '_kipla_file_url', true );
					?>
					<article class="update-card reveal">
						<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium_large', array( 'loading' => 'lazy' ) ); ?></a>
						<?php endif; ?>
						<div class="update-card__body">
							<?php if ( $types && ! is_wp_error( $types ) ) : ?>
								<span class="update-card__type"><?php echo esc_html( $types[0]->name ); ?></span>
							<?php endif; ?>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<span class="update-card__date"><?php echo esc_html( get_the_date() ); ?></span>
							<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
							<span class="update-card__more">
								<a href="<?php echo esc_url( $file ? $file : get_permalink() ); ?>"<?php echo $file ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>>
									<?php echo esc_html( $file ? __( 'Download newsletter', 'kipla' ) : __( 'Read more', 'kipla' ) ); ?>
								</a>
							</span>
						</div>
					</article>
					<?php
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		<?php else : ?>
			<p><?php esc_html_e( 'Post newsletters, announcements, events, and classroom highlights under News & Newsletters.', 'kipla' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<!-- FINAL CTA -->
<section class="section section--white" id="tour">
	<div class="container">
		<div class="cta-band reveal">
			<span class="eyebrow"><?php esc_html_e( 'Come see us', 'kipla' ); ?></span>
			<h2><?php esc_html_e( 'Ready to visit KIPLA?', 'kipla' ); ?></h2>
			<p><?php esc_html_e( 'Tour either campus, meet the teachers, and see the positivity for yourself. We would love to meet your family.', 'kipla' ); ?></p>
			<div class="cta-band__actions">
				<a class="btn btn--primary" href="<?php echo esc_url( $tour ); ?>"><?php esc_html_e( 'Schedule a Tour', 'kipla' ); ?></a>
				<a class="btn btn--gold" href="<?php echo esc_url( $enroll ); ?>"><?php esc_html_e( 'Enroll Now', 'kipla' ); ?></a>
				<?php if ( kipla_opt( 'kipla_phone' ) ) : ?>
					<a class="btn btn--ghost" href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', kipla_opt( 'kipla_phone' ) ) ); ?>"><?php echo esc_html( kipla_opt( 'kipla_phone' ) ); ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
