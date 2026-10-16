<?php
/**
 * Front page — the KIPLA homepage sections.
 *
 * @package KIPLA
 */

get_header();

get_template_part( 'template-parts/home/hero' );
get_template_part( 'template-parts/home/welcome' );
get_template_part( 'template-parts/home/programs' );
get_template_part( 'template-parts/home/difference' );
get_template_part( 'template-parts/home/culture' );
get_template_part( 'template-parts/home/founder' );
get_template_part( 'template-parts/home/testimonials' );
get_template_part( 'template-parts/home/in-action' );
get_template_part( 'template-parts/home/news' );
get_template_part( 'template-parts/home/cta' );

get_footer();
