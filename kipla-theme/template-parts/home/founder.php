<?php
/**
 * Front page: Meet Our Founder.
 *
 * @package KIPLA
 */

$kipla_assets = get_template_directory_uri();
$kipla_sun     = '<svg class="sun" viewBox="0 0 32 32"><g fill="currentColor"><ellipse cx="16" cy="7" rx="2.7" ry="5.6"/><ellipse cx="16" cy="7" rx="2.7" ry="5.6" transform="rotate(45 16 16)"/><ellipse cx="16" cy="7" rx="2.7" ry="5.6" transform="rotate(90 16 16)"/><ellipse cx="16" cy="7" rx="2.7" ry="5.6" transform="rotate(135 16 16)"/><ellipse cx="16" cy="7" rx="2.7" ry="5.6" transform="rotate(180 16 16)"/><ellipse cx="16" cy="7" rx="2.7" ry="5.6" transform="rotate(225 16 16)"/><ellipse cx="16" cy="7" rx="2.7" ry="5.6" transform="rotate(270 16 16)"/><ellipse cx="16" cy="7" rx="2.7" ry="5.6" transform="rotate(315 16 16)"/></g><circle cx="16" cy="16" r="4.8" fill="#6b4423"/><circle cx="16" cy="16" r="2.4" fill="#8a5a2b"/></svg>';
?>

<section class="section section--cream" id="founder">
	<div class="container">
		<div class="founder-card">
			<div class="founder-media">
				<span class="founder-media__halo" aria-hidden="true"></span>
				<figure class="frame frame--arch frame--portrait founder-media__frame"><img src="<?php echo esc_url( $kipla_assets ); ?>/assets/images/founder.jpg" alt="Ms. Wanda, founder of Keeping It Positive Learning Academy" loading="lazy" /></figure>
				<span class="founder-badge"><?php echo wp_kses( $kipla_sun, array( 'svg' => array( 'class' => true, 'viewbox' => true ), 'g' => array( 'fill' => true ), 'ellipse' => array( 'cx' => true, 'cy' => true, 'rx' => true, 'ry' => true, 'transform' => true ), 'circle' => array( 'cx' => true, 'cy' => true, 'r' => true, 'fill' => true ) ) ); ?><span>Founder &amp; Visionary</span></span>
			</div>
			<div class="founder-body">
				<span class="eyebrow">Meet Our Founder</span>
				<h2 class="founder-heading">Meet Ms. Wanda</h2>
				<span class="founder-role">Founder &amp; Visionary • Educator • Mentor • Community Leader</span>
				<p class="founder-text">For more than 20 years, Ms. Wanda has dedicated her life to educating children, strengthening families, and developing future leaders. What began as a passion for helping children learn grew from tutoring students at home into what is now Keeping It Positive Learning Academy (KIPLA).</p>
				<p class="founder-text">With a master&rsquo;s degree in Human Services and decades of hands-on experience in education and leadership, Ms. Wanda built KIPLA on a philosophy that reaches beyond academics. She believes children should be taught with excellence, trained with intention, motivated with purpose, and loved through every stage of their development.</p>
				<p class="founder-belief">That belief became the heart of KIPLA:</p>
				<p class="founder-ttml"><span class="founder-ttml__word">TEACH</span><span class="founder-ttml__sep" aria-hidden="true"><?php echo str_repeat( $kipla_sun, 1 ); ?></span><span class="founder-ttml__word">TRAIN</span><span class="founder-ttml__sep" aria-hidden="true"><?php echo str_repeat( $kipla_sun, 1 ); ?></span><span class="founder-ttml__word">MOTIVATE</span><span class="founder-ttml__sep" aria-hidden="true"><?php echo str_repeat( $kipla_sun, 1 ); ?></span><span class="founder-ttml__word">LOVE</span></p>
				<p class="founder-text">Today, her vision continues to grow through KIPLA&rsquo;s programs, educators, families, and commitment to developing confident, capable young leaders.</p>
				<p class="founder-text">For Ms. Wanda, KIPLA is more than a learning academy&mdash;it is the continuation of a vision planted years ago: to pour something positive into a child today that will remain with them for a lifetime.</p>
				<p class="founder-mission">Her mission remains simple:<br>Plant the seed. Nurture the potential. Grow the leader. 🌻</p>
				<p class="founder-signature">— Ms. Wanda</p>
				<p class="founder-cta"><a class="btn btn--primary" href="#welcome">Read Our Story</a></p>
			</div>
		</div>
	</div>
</section>
