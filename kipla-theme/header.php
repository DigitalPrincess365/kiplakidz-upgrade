<?php
/**
 * Header.
 *
 * @package KIPLA
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<link rel="icon" type="image/png" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.png' ); ?>" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'kipla' ); ?></a>

<header class="site-header">
	<div class="container header-inner">
		<div class="brand">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.png' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" loading="eager" />
				</a>
			<?php endif; ?>
		</div>

		<nav class="main-nav" id="primary-nav" aria-label="<?php esc_attr_e( 'Primary menu', 'kipla' ); ?>">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => 'div',
				'depth'          => 2,
				'fallback_cb'    => 'kipla_fallback_menu',
			) );
			?>
		</nav>

		<div class="header-cta">
			<?php kipla_social_links( 'social-links--header' ); ?>
			<a class="btn btn--gold btn--sm" href="<?php echo esc_url( kipla_opt( 'kipla_tour_url' ) ); ?>"><?php esc_html_e( 'Schedule a Tour', 'kipla' ); ?></a>
			<button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-nav">
				<span></span><span></span><span></span>
				<span class="screen-reader-text"><?php esc_html_e( 'Toggle menu', 'kipla' ); ?></span>
			</button>
		</div>
	</div>
</header>

<main id="main">
