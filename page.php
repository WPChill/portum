<?php
/**
 * The template for displaying pages
 *
 * @package Portum
 */


get_header();

$portum_fp = Epsilon_Page_Generator::get_instance( 'portum_frontpage_sections_' . get_the_ID(), get_the_ID() );
$portum_fp->generate_output();

get_footer();
