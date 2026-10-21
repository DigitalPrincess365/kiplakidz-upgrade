<?php
/**
 * Front page: News & Newsletters + subscribe form.
 *
 * @package KIPLA
 */

$kipla_assets = get_template_directory_uri();

$kipla_updates = array(
	array(
		'type'  => 'Newsletter',
		'title' => 'KIPLA Sunflower Curriculum',
		'date'  => 'Growing Scholars From Seed To Success',
		'text'  => 'Our Sunflower Curriculum — what scholars learn at KIPLA, from strong academic roots to confident leadership.',
		'img'   => '/assets/images/newsletter-sunflower-curriculum.jpeg',
		'alt'   => 'KIPLA Sunflower Curriculum newsletter — Growing Scholars From Seed To Success',
		'pdf'   => '/assets/docs/newsletter-sunflower-curriculum.pdf',
		'link'  => 'Download Newsletter (PDF)',
	),
	array(
		'type'  => 'Calendar',
		'title' => 'KIPLA Location #1',
		'date'  => 'School year 2026–2027',
		'text'  => 'Calendar &amp; activity schedule for the Austell campus — July 2026 through June 2027.',
		'img'   => '/assets/images/calendar-kipla-1.webp',
		'alt'   => 'KIPLA Location #1 Calendar &amp; Activity Schedule 2026–2027',
		'pdf'   => '/assets/docs/calendar-kipla-1.pdf',
		'link'  => 'Print Calendar (PDF)',
	),
	array(
		'type'  => 'Calendar',
		'title' => 'KIPLA Location #2',
		'date'  => 'School year 2026–2027',
		'text'  => 'Calendar &amp; activity schedule for the Lithia Springs campus — July 2026 through June 2027.',
		'img'   => '/assets/images/calendar-kipla-2.webp',
		'alt'   => 'KIPLA Location #2 Calendar &amp; Activity Schedule 2026–2027',
		'pdf'   => '/assets/docs/calendar-kipla-2.pdf',
		'link'  => 'Print Calendar (PDF)',
	),
);
?>

<section class="section" id="updates">
	<div class="container">
		<div class="section-head">
			<div>
				<span class="eyebrow eyebrow--red">News &amp; Newsletters</span>
				<h2>Announcements, events &amp; classroom highlights</h2>
			</div>
			<a class="link-underline" href="<?php echo esc_url( get_post_type_archive_link( 'kipla_update' ) ); ?>">All updates</a>
		</div>
		<div class="update-grid">
			<?php foreach ( $kipla_updates as $kipla_update ) : ?>
				<article class="update-card">
					<figure class="frame"><img src="<?php echo esc_url( $kipla_assets . $kipla_update['img'] ); ?>" alt="<?php echo esc_attr( $kipla_update['alt'] ); ?>" loading="lazy" style="height:auto;object-fit:contain" /></figure>
					<div class="update-card__body">
						<span class="update-card__type"><?php echo esc_html( $kipla_update['type'] ); ?></span>
						<h3><?php echo esc_html( $kipla_update['title'] ); ?></h3>
						<span class="update-card__date"><?php echo esc_html( $kipla_update['date'] ); ?></span>
						<p><?php echo wp_kses_post( $kipla_update['text'] ); ?></p>
						<a class="update-card__more" href="<?php echo esc_url( $kipla_assets . $kipla_update['pdf'] ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $kipla_update['link'] ); ?></a>
					</div>
				</article>
			<?php endforeach; ?>
		</div>

		<div class="newsletter">
			<div>
				<h3>Never miss a KIPLA update</h3>
				<p>Get newsletters, event invites, and classroom highlights in your inbox.</p>
			</div>
			<!-- Standard HTML form — point it at your newsletter or form plugin. -->
			<form method="post" action="#">
				<input type="email" name="newsletter_email" placeholder="you@email.com" aria-label="Email address" required />
				<button class="btn btn--gold" type="submit">Subscribe</button>
			</form>
		</div>
	</div>
</section>
