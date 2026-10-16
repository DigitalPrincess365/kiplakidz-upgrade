<?php
/**
 * Front page: welcome + two campuses.
 *
 * @package KIPLA
 */

$kipla_assets = get_template_directory_uri();
$tour_url     = kipla_opt( 'kipla_tour_url' ) ? kipla_opt( 'kipla_tour_url' ) : home_url( '/schedule-tour/' );
?>

<section class="section section--white" id="welcome">
	<div class="container">
		<div class="split">
			<div>
				<span class="eyebrow">Welcome to KIPLA</span>
				<hr class="rule" />
				<h2>A positive start shapes everything that follows</h2>
				<p>KIPLA is a family-owned early learning community in Austell, Georgia, with two campuses serving scholars from 6 weeks through 12 years. From the first morning, your child is known by name, story, and strength.</p>
				<p><strong>The KIPLA difference:</strong> we pair leadership-centered learning designed to prepare scholars for every next step with genuine warmth — every scholar is taught, trained, motivated, and loved every single day.</p>
				<div class="stat-row">
					<div class="stat"><div class="stat__num">2</div><div class="stat__label">Campuses in West Georgia</div></div>
					<div class="stat"><div class="stat__num">6 wks – 12 yrs</div><div class="stat__label">Ages served</div></div>
				</div>
			</div>
			<div>
				<figure class="frame frame--leaf frame--portrait"><div class="frame__placeholder"><span>Scholars &amp; educators photo</span><small>An authentic photograph of KIPLA scholars learning with their educators.</small></div></figure>
			</div>
		</div>

		<div id="locations" style="margin-top:clamp(2.5rem,6vw,4rem)">
			<div class="section-head">
				<div>
					<span class="eyebrow eyebrow--red">Our two campuses</span>
					<h2>KIPLA #1 &amp; KIPLA #2</h2>
					<p>Same heart, same standards, all programs — two convenient locations.</p>
				</div>
			</div>
			<div class="locations">
				<article class="location-card location-card--one">
					<span class="location-card__badge">KIPLA #1</span>
					<h3>Austell campus</h3>
					<p class="location-card__ages">6 weeks – 12 years · all programs</p>
					<ul class="location-card__meta">
						<li><strong>Address</strong><span>1920 Veterans Memorial Hwy SW, Austell, GA 30168</span></li>
						<li><strong>Hours</strong><span>Mon–Fri, 6:30am – 6:30pm</span></li>
						<li><strong>Phone</strong><span><a href="tel:+17706727800">(770) 672-7800</a></span></li>
					</ul>
					<div class="location-card__actions">
						<a class="btn btn--primary btn--sm" href="<?php echo esc_url( $tour_url ); ?>">Schedule a Tour</a>
						<a class="btn btn--ghost btn--sm" href="https://www.google.com/maps/search/?api=1&amp;query=1920+Veterans+Memorial+Hwy+SW+Austell+GA+30168" target="_blank" rel="noopener noreferrer">Get Directions</a>
					</div>
				</article>
				<article class="location-card location-card--two">
					<span class="location-card__badge">KIPLA #2</span>
					<h3>Lithia Springs campus</h3>
					<p class="location-card__ages">6 weeks – 12 years · all programs</p>
					<ul class="location-card__meta">
						<li><strong>Address</strong><span>2548 Vulcan Dr, Lithia Springs, GA 30122</span></li>
						<li><strong>Hours</strong><span>Mon–Fri, 6:30am – 6:30pm</span></li>
						<li><strong>Phone</strong><span><a href="tel:+16784835160">(678) 483-5160</a></span></li>
					</ul>
					<div class="location-card__actions">
						<a class="btn btn--primary btn--sm" href="<?php echo esc_url( $tour_url ); ?>">Schedule a Tour</a>
						<a class="btn btn--ghost btn--sm" href="https://www.google.com/maps/search/?api=1&amp;query=2548+Vulcan+Dr+Lithia+Springs+GA+30122" target="_blank" rel="noopener noreferrer">Get Directions</a>
					</div>
				</article>
			</div>
		</div>
	</div>
</section>
