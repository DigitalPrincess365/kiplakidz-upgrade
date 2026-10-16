<?php
/**
 * Front page: What KIPLA Families Say.
 *
 * @package KIPLA
 */

$kipla_testimonials = array(
	array(
		'quote'  => 'My son went to the program from 8 months until he finished Pre-K, and we felt like family the entire time. I HIGHLY recommend this location and the Vulcan Drive location to all parents. They are absolutely amazing.',
		'author' => 'KIPLA Parent',
		'rel'    => 'Mom of a Pre-K graduate',
	),
	array(
		'quote'  => 'Ms. Eubanks and Ms. Becky made my tour unforgettable! Their passion, warmth, and dedication to student success shine in every detail. The facility is welcoming and designed to support learning, growth, and development. Definitely a positive and welcoming atmosphere!',
		'author' => 'KIPLA Parent',
		'rel'    => 'Campus tour visitor',
	),
	array(
		'quote'  => 'My twins started in August, and they absolutely love it. They have not been this comfortable at any other school. I love how interactive the teachers are. The staff is all around great, and Ms. Eubanks is always a great help when needed as well.',
		'author' => 'KIPLA Parent',
		'rel'    => 'Mom of twins',
	),
);
?>

<section class="section" id="testimonials">
	<div class="container">
		<div class="section-head">
			<div>
				<span class="eyebrow eyebrow--red">What KIPLA Families Say</span>
				<h2>Trusted by parents across our community</h2>
			</div>
		</div>
		<div class="gallery-grid" style="margin-top:2rem">
			<figure class="frame frame--square"><div class="frame__placeholder"><span>Video testimonial</span><small>Drop in a short parent video when you're ready.</small></div></figure>
			<figure class="frame frame--square"><div class="frame__placeholder"><span>Video testimonial</span><small>Drop in a short parent video when you're ready.</small></div></figure>
			<figure class="frame frame--square"><div class="frame__placeholder"><span>Video testimonial</span><small>Drop in a short parent video when you're ready.</small></div></figure>
			<figure class="frame frame--square"><div class="frame__placeholder"><span>Video testimonial</span><small>Drop in a short parent video when you're ready.</small></div></figure>
		</div>
		<div class="testimonial-grid">
			<?php foreach ( $kipla_testimonials as $kipla_testimonial ) : ?>
				<figure class="testimonial">
					<div class="testimonial__stars" aria-hidden="true">★★★★★</div>
					<blockquote class="testimonial__quote"><?php echo esc_html( $kipla_testimonial['quote'] ); ?></blockquote>
					<figcaption>
						<div class="testimonial__author"><?php echo esc_html( $kipla_testimonial['author'] ); ?></div>
						<span class="testimonial__rel"><?php echo esc_html( $kipla_testimonial['rel'] ); ?></span>
					</figcaption>
				</figure>
			<?php endforeach; ?>
		</div>
		<div class="credibility">
			<div class="credibility__item"><strong>Licensed</strong><span>State of Georgia</span></div>
			<div class="credibility__item"><strong>CPR</strong><span>Certified staff</span></div>
			<div class="credibility__item"><strong>Secure</strong><span>Keypad entry</span></div>
			<div class="credibility__item"><strong>Family</strong><span>Owned &amp; operated</span></div>
		</div>
	</div>
</section>
