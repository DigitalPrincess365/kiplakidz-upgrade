<?php
/**
 * Front page: Culture in Action photo gallery.
 *
 * @package KIPLA
 */

$kipla_assets = get_template_directory_uri();
?>

<section class="section" id="culture">
	<div class="container">
		<div class="section-head">
			<div>
				<span class="eyebrow eyebrow--red">Culture in Action</span>
				<h2>Real classrooms, real learning</h2>
				<p>Photographs straight from our rooms — learning walls, centers, educators teaching, and scholars leading.</p>
			</div>
			<a class="link-underline" href="#in-action">See Full Gallery</a>
		</div>
		<div class="gallery-grid">
			<figure class="frame frame--square"><img src="<?php echo esc_url( $kipla_assets ); ?>/assets/images/culture-circle-time.jpeg" alt="KIPLA teacher leading circle time in front of the Classroom Community board" loading="lazy" /></figure>
			<figure class="frame frame--square"><img src="<?php echo esc_url( $kipla_assets ); ?>/assets/images/culture-slides.jpeg" alt="KIPLA toddlers playing on the slides outdoors" loading="lazy" /></figure>
			<figure class="frame frame--square"><img src="<?php echo esc_url( $kipla_assets ); ?>/assets/images/culture-blocks.jpeg" alt="KIPLA scholars building together with wooden blocks on the alphabet rug" loading="lazy" /></figure>
			<figure class="frame frame--square"><img src="<?php echo esc_url( $kipla_assets ); ?>/assets/images/culture-community-helper.jpeg" alt="KIPLA scholars meeting a community helper and police vehicle" loading="lazy" /></figure>
			<figure class="frame frame--square"><img src="<?php echo esc_url( $kipla_assets ); ?>/assets/images/culture-lunch.jpeg" alt="KIPLA scholars enjoying lunch together in the classroom" loading="lazy" /></figure>
			<figure class="frame frame--square"><img src="<?php echo esc_url( $kipla_assets ); ?>/assets/images/culture-learning-cards.jpeg" alt="KIPLA scholars working on flashcards with pencils at the activity table" loading="lazy" /></figure>
			<figure class="frame frame--square"><img src="<?php echo esc_url( $kipla_assets ); ?>/assets/images/culture-puzzle.jpeg" alt="Two KIPLA scholars working together on a Dr. Seuss floor puzzle" loading="lazy" /></figure>
			<figure class="frame frame--square"><video src="<?php echo esc_url( $kipla_assets ); ?>/assets/media/culture-classroom.mp4" controls muted loop playsinline preload="metadata" style="width:100%;height:100%;object-fit:cover;display:block" aria-label="Video of KIPLA scholars learning in the classroom"></video></figure>
		</div>
	</div>
</section>
