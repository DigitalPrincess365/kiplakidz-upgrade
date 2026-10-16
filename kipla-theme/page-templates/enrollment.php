<?php
/**
 * Template Name: Enrollment
 *
 * Standard plugin-ready HTML enrollment inquiry form + printable application PDF.
 *
 * @package KIPLA
 */

$kipla_assets = get_template_directory_uri();
get_header();
?>

<section class="section section--white" id="enroll">
	<div class="container">
		<div class="section-head">
			<div>
				<span class="eyebrow">Enroll at KIPLA</span>
				<h2>Start your scholar's positive start</h2>
				<p>Send us your information and we'll walk you through availability, next steps, and the enrollment process.</p>
			</div>
		</div>

		<!--
			Standard HTML form — no external backend processing.
			Handle submissions locally with your form plugin of choice
			(e.g. Contact Form 7, WPForms, Gravity Forms): replace the
			form below with the plugin shortcode, e.g.
			echo do_shortcode( '[contact-form-7 id="123" title="Enrollment Inquiry"]' );
		-->
		<form class="form-grid" method="post" action="#">
			<div class="form-field">
				<label for="parentName">Parent/Guardian Name</label>
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
				<label for="campus">Preferred Campus</label>
				<select id="campus" name="campus" required>
					<option value="">Select a campus…</option>
					<option value="KIPLA #1 — Austell">KIPLA #1 — Austell</option>
					<option value="KIPLA #2 — Lithia Springs">KIPLA #2 — Lithia Springs</option>
					<option value="Either campus">Either campus</option>
				</select>
			</div>
			<div class="form-field">
				<label for="scholarName">Scholar's Name</label>
				<input type="text" id="scholarName" name="scholarName" required />
			</div>
			<div class="form-field">
				<label for="scholarDob">Scholar's Date of Birth</label>
				<input type="date" id="scholarDob" name="scholarDob" required />
			</div>
			<div class="form-field form-field--full">
				<label for="program">Program of Interest</label>
				<select id="program" name="program" required>
					<option value="">Select a program…</option>
					<option value="Infants">Infants (6 weeks – 12 months)</option>
					<option value="One's">One's (12 – 24 months)</option>
					<option value="Toddlers">Toddlers (1 – 2 years)</option>
					<option value="Pre-School">Pre-School (3 – 4 years)</option>
					<option value="Georgia Pre-K 1">Georgia Pre-K 1</option>
					<option value="Georgia Pre-K 2">Georgia Pre-K 2</option>
					<option value="After School">After School (5 – 12 years)</option>
					<option value="Summer Camp">Summer Camp (5 – 12 years)</option>
				</select>
			</div>
			<div class="form-field">
				<label for="startDate">Desired Start Date</label>
				<input type="date" id="startDate" name="startDate" />
			</div>
			<div class="form-field">
				<label for="hearAbout">How did you hear about us?</label>
				<input type="text" id="hearAbout" name="hearAbout" placeholder="Referral, Google, social media…" />
			</div>
			<div class="form-field form-field--full">
				<label for="message">Questions or anything you'd like us to know</label>
				<textarea id="message" name="message" rows="4" placeholder="Schedule needs, allergies, anything at all…"></textarea>
			</div>
			<div class="form-submit form-field--full">
				<button class="btn btn--primary" type="submit">Submit Inquiry</button>
				<p class="form-note">Submitting this inquiry does not guarantee placement — we'll contact you to confirm availability and next steps.</p>
			</div>
		</form>

		<p class="gallery-cta">
			<a class="btn btn--gold" href="<?php echo esc_url( $kipla_assets ); ?>/assets/docs/KIPLA_Standard_Enrollment_Application_Fillable.pdf" target="_blank" rel="noopener noreferrer">Download the Enrollment Application (PDF)</a>
		</p>
	</div>
</section>

<?php
get_footer();
