<?php
/**
 * Template Name: Schedule a Tour
 *
 * Standard plugin-ready HTML tour request form.
 *
 * @package KIPLA
 */

get_header();
?>

<section class="section section--white" id="tour">
	<div class="container">
		<div class="section-head">
			<div>
				<span class="eyebrow">Schedule a Tour</span>
				<h2>Come see the positivity for yourself</h2>
				<p>Tour either campus, meet the teachers, and see how your child would spend the day at KIPLA. We can't wait to meet your family.</p>
			</div>
		</div>

		<!--
			Standard HTML form — no external backend processing.
			Handle submissions locally with your form plugin of choice
			(e.g. Contact Form 7, WPForms, Gravity Forms): replace the
			form below with the plugin shortcode, e.g.
			echo do_shortcode( '[contact-form-7 id="123" title="Schedule a Tour"]' );
		-->
		<form class="form-grid" method="post" action="#">
			<div class="form-field">
				<label for="parentName">Parent/Family Name</label>
				<input type="text" id="parentName" name="parentName" required />
			</div>
			<div class="form-field">
				<label for="email">Email Address</label>
				<input type="email" id="email" name="email" required />
			</div>
			<div class="form-field">
				<label for="phone">Phone Number</label>
				<input type="tel" id="phone" name="phone" required />
			</div>
			<div class="form-field">
				<label for="campus">Campus</label>
				<select id="campus" name="campus" required>
					<option value="">Select a campus…</option>
					<option value="KIPLA #1 — Austell">KIPLA #1 — Austell</option>
					<option value="KIPLA #2 — Lithia Springs">KIPLA #2 — Lithia Springs</option>
					<option value="Either campus">Either campus</option>
				</select>
			</div>
			<div class="form-field form-field--full">
				<label>Preferred tour day</label>
				<div class="form-checks">
					<label><input type="checkbox" name="preferredDay" value="Tuesday - Designated Tour Day" /> Tuesday – Designated Tour Day</label>
				</div>
			</div>
			<div class="form-field form-field--full">
				<label>Preferred tour time</label>
				<div class="form-checks">
					<label><input type="checkbox" name="tourTime" value="Morning" /> Morning</label>
					<label><input type="checkbox" name="tourTime" value="Midday" /> Midday</label>
					<label><input type="checkbox" name="tourTime" value="Afternoon" /> Afternoon</label>
				</div>
			</div>
			<div class="form-field">
				<label for="preferredTime">Preferred Time</label>
				<input type="text" id="preferredTime" name="preferredTime" placeholder="e.g. 10:00 AM" />
			</div>
			<div class="form-field">
				<label for="alternateDay">Alternate Day</label>
				<input type="text" id="alternateDay" name="alternateDay" placeholder="e.g. Thursday" />
			</div>
			<div class="form-field form-field--full">
				<label for="message">Questions or anything you'd like us to know</label>
				<textarea id="message" name="message" rows="5" placeholder="Child's age, program of interest, or any questions…"></textarea>
			</div>
			<div class="form-submit form-field--full">
				<button class="btn btn--primary" type="submit">Request a Tour</button>
				<p class="form-note">We'll confirm your tour by phone or email within one business day.</p>
			</div>
		</form>
	</div>
</section>

<?php
get_footer();
