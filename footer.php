<?php
/**
 * The template for displaying footer part
 *
 * @package Portum
 */

$front = get_option( 'show_on_front' );
if ( 'page' === $front && is_front_page() ) {
	get_template_part( 'template-parts/footer/contact-section' );
}

get_sidebar( 'footer' );
?>
</div>

<?php if ( get_theme_mod( 'portum_enable_go_top', true ) ) : ?>
	<a id="back-to-top" href="#"><i class="fa fa-angle-up"></i></a>
<?php endif; ?>

<?php wp_footer(); ?>
</body></html>
