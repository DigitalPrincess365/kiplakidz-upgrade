<?php
/**
 * Footer.
 *
 * @package KIPLA
 */

?>
</main>

<footer class="site-footer">
	<div class="container">
		<div class="footer-grid">
			<div>
				<div class="footer-brand">
					<span class="brand__mark" aria-hidden="true">K</span>
					<span><?php bloginfo( 'name' ); ?></span>
				</div>
				<p><?php echo esc_html( get_bloginfo( 'description' ) ); ?></p>
				<?php kipla_social_links( 'social-links--footer' ); ?>
			</div>

			<div>
				<h4><?php echo esc_html( kipla_opt( 'kipla_loc1_name' ) ); ?></h4>
				<ul>
					<?php if ( kipla_opt( 'kipla_loc1_address' ) ) : ?><li><?php echo esc_html( kipla_opt( 'kipla_loc1_address' ) ); ?></li><?php endif; ?>
					<?php if ( kipla_opt( 'kipla_loc1_phone' ) ) : ?><li><?php echo esc_html( kipla_opt( 'kipla_loc1_phone' ) ); ?></li><?php endif; ?>
					<?php if ( kipla_opt( 'kipla_loc1_hours' ) ) : ?><li><?php echo esc_html( kipla_opt( 'kipla_loc1_hours' ) ); ?></li><?php endif; ?>
				</ul>
				<h4 style="margin-top:1.5rem"><?php echo esc_html( kipla_opt( 'kipla_loc2_name' ) ); ?></h4>
				<ul>
					<?php if ( kipla_opt( 'kipla_loc2_address' ) ) : ?><li><?php echo esc_html( kipla_opt( 'kipla_loc2_address' ) ); ?></li><?php endif; ?>
					<?php if ( kipla_opt( 'kipla_loc2_phone' ) ) : ?><li><?php echo esc_html( kipla_opt( 'kipla_loc2_phone' ) ); ?></li><?php endif; ?>
					<?php if ( kipla_opt( 'kipla_loc2_hours' ) ) : ?><li><?php echo esc_html( kipla_opt( 'kipla_loc2_hours' ) ); ?></li><?php endif; ?>
				</ul>
			</div>

			<div>
				<h4><?php esc_html_e( 'Quick Links', 'kipla' ); ?></h4>
				<?php
				if ( has_nav_menu( 'footer' ) ) {
					wp_nav_menu( array(
						'theme_location' => 'footer',
						'container'      => '',
						'depth'          => 1,
					) );
				} else {
					kipla_fallback_menu();
				}
				?>
			</div>

			<div>
				<h4><?php esc_html_e( 'Ready to Visit?', 'kipla' ); ?></h4>
				<ul>
					<?php if ( kipla_opt( 'kipla_phone' ) ) : ?>
						<li><a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', kipla_opt( 'kipla_phone' ) ) ); ?>"><?php echo esc_html( kipla_opt( 'kipla_phone' ) ); ?></a></li>
					<?php endif; ?>
					<?php if ( kipla_opt( 'kipla_email' ) ) : ?>
						<li><a href="mailto:<?php echo esc_attr( kipla_opt( 'kipla_email' ) ); ?>"><?php echo esc_html( kipla_opt( 'kipla_email' ) ); ?></a></li>
					<?php endif; ?>
				</ul>
				<p style="margin-top:1rem">
					<a class="btn btn--gold btn--sm" href="<?php echo esc_url( kipla_opt( 'kipla_enroll_url' ) ); ?>"><?php esc_html_e( 'Enroll Now', 'kipla' ); ?></a>
				</p>
				<?php if ( is_active_sidebar( 'footer-extra' ) ) : ?>
					<div class="footer-widgets"><?php dynamic_sidebar( 'footer-extra' ); ?></div>
				<?php endif; ?>
			</div>
		</div>

		<div class="footer-bottom">
			<span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></span>
			<span><?php esc_html_e( 'Keeping It Positive, every single day', 'kipla' ); ?></span>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
