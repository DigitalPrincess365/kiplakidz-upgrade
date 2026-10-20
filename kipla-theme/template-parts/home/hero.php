<?php
/**
 * Front page: hero, badges & affirmations marquee.
 *
 * @package KIPLA
 */

$kipla_assets = get_template_directory_uri();
$tour_url     = kipla_opt( 'kipla_tour_url' ) ? kipla_opt( 'kipla_tour_url' ) : home_url( '/schedule-tour/' );
$enroll_url   = kipla_opt( 'kipla_enroll_url' ) ? kipla_opt( 'kipla_enroll_url' ) : home_url( '/enroll/' );
?>

<section class="hero hero--split container" id="hero">
	<div class="hero__inner">
		<span class="eyebrow">Teach · Train · Motivate · Love</span>
		<h1>Where We Teach, Train, Motivate, &amp; <span class="accent">L<svg class="heart-o" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>ve</span></h1>
		<p class="hero__tagline">A <span class="accent-gold">Positive</span> Start Shapes Everything That Follows.</p>
		<p class="hero__lead">At Keeping It Positive Learning Academy we teach with purpose, train future leaders, motivate every scholar, and love them like family — across two campuses in Austell and Lithia Springs, from 6 weeks through 12 years.</p>
		<div class="hero__actions">
			<a class="btn btn--primary" href="<?php echo esc_url( $tour_url ); ?>">Schedule a Tour</a>
			<a class="btn btn--gold" href="<?php echo esc_url( $enroll_url ); ?>">Enroll / Learn More</a>
			<a class="btn btn--ghost" href="#programs">Explore Programs</a>
		</div>
	</div>
	<div class="hero__media">
		<div class="hero__photo">
			<img src="<?php echo esc_url( $kipla_assets ); ?>/assets/images/classroom-hero-group.jpeg" alt="KIPLA teacher and scholars together in a bright classroom" loading="eager" />
			<span class="hero__photo-mask" aria-hidden="true"></span>
			<span class="hero__overlay-top"><span class="hero__overlay-hl">A Positive Start Shapes<br>Everything That Follows</span> <span class="hero__overlay-heart">&#9829;</span></span>
			<span class="hero__overlay-bottom">
				<svg class="hero__overlay-brush" viewBox="0 0 340 92" preserveAspectRatio="none" aria-hidden="true"><defs><filter id="brushGrain" x="-10%" y="-40%" width="120%" height="180%"><feGaussianBlur stdDeviation="0.5"/></filter></defs><g filter="url(#brushGrain)" transform="rotate(-0.8 170 46)"><path d="M12,49 C15,34 24,26 42,23 C74,18 112,16 152,16 C202,16 252,18 294,22 C314,24 327,30 327,39 C327,48 316,54 298,56 C276,58 262,64 232,66 C192,69 142,70 98,68 C64,66 32,62 20,55 C13,52 12,51 12,49 Z" fill="#f0d67a" fill-opacity="0.9"/></g></svg>
				Building Future Leaders<br>One Experience At A Time
			</span>
		</div>
	</div>
</section>

<section class="hero__badges container" aria-label="Why families choose KIPLA">
	<div class="hero__badges-row">
		<span class="hero__badge">
			<span class="hero__badge-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="8" r="3.2"/><path d="M3 20c0-3.3 3-6 6-6s6 2.7 6 6"/><path d="M16 7.5a3 3 0 0 1 0 6"/><path d="M21.5 20c0-2.5-2-4.5-5-5"/></svg></span>
			<span class="hero__badge-text">Leadership-Based Learning</span>
		</span>
		<span class="hero__badge">
			<span class="hero__badge-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20.5l-1.45-1.32C5.4 14.86 2 11.78 2 8 2 5.2 4.2 3 7 3c1.7 0 3.3.8 4.4 2 1-1.2 2.6-2 4.3-2C18.8 3 21 5.2 21 8c0 3.78-3.4 6.86-8.55 11.18L12 20.5z"/></svg></span>
			<span class="hero__badge-text">Safe &amp; Nurturing Environment</span>
		</span>
		<span class="hero__badge">
			<span class="hero__badge-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 21V12"/><path d="M10 21V8"/><path d="M15 21V5"/><path d="M3 8l5-4 4 3 6-5"/></svg></span>
			<span class="hero__badge-text">Age-Appropriate Growth</span>
		</span>
		<span class="hero__badge">
			<span class="hero__badge-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 4L2 9l10 5 10-5-10-5z"/><path d="M6 11v5c0 1 2.7 3 6 3s6-2 6-3v-5"/><path d="M22 9v5"/></svg></span>
			<span class="hero__badge-text">Caring &amp; Qualified Educators</span>
		</span>
		<span class="hero__badge">
			<span class="hero__badge-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 11l9-7 9 7"/><path d="M5 10v10h14V10"/><path d="M10 20v-5h4v5"/></svg></span>
			<span class="hero__badge-text">Two Convenient Locations</span>
		</span>
	</div>
</section>

<div class="affirmations" aria-hidden="true">
	<div class="affirmations__track">
		<span>Teach</span><span class="affirmations__sep" aria-hidden="true">🌻</span><span>Train</span><span class="affirmations__sep" aria-hidden="true">🌻</span><span>Motivate</span><span class="affirmations__sep" aria-hidden="true">🌻</span><span>Love</span><span class="affirmations__sep" aria-hidden="true">🌻</span>
		<span>Teach</span><span class="affirmations__sep" aria-hidden="true">🌻</span><span>Train</span><span class="affirmations__sep" aria-hidden="true">🌻</span><span>Motivate</span><span class="affirmations__sep" aria-hidden="true">🌻</span><span>Love</span><span class="affirmations__sep" aria-hidden="true">🌻</span>
	</div>
</div>
