<?php
/**
 * Template part for displaying a frontpage section
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

$frontpage        = Portum_Frontpage::get_instance( 'portum_frontpage_sections' );
$fields           = $frontpage->sections[ $section_id ];
$fields['slides'] = $frontpage->get_repeater_field( $fields['slider_repeater_field'], array() );
?>
<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<div class="section-slider">
		<div id="main-slider" class="main-slider owl-carousel owl-theme">
			<?php foreach ( $fields['slides'] as $slide ) { ?>
				<div class="item">
					<div class="item-overlay"></div>
					<img src="<?php echo esc_url( $slide['slides_image'] ) ?>" alt="<?php echo ! empty( $slide['title'] ) ? esc_html( $slide['title'] ) : '' ?>"/>

					<div class="slider-details">
						<h1><?php echo wp_kses_post( $slide['slides_title'] ); ?></h1>
						<span><?php echo wp_kses_post( $slide['slides_description'] ); ?></span>
					</div>
				</div>
			<?php } ?>
		</div>
		<?php if ( is_customize_preview() ) { ?>
			<div class="container">
				<?php echo wp_kses_post( Portum_Helper::generate_pencil() ); ?>
			</div>
		<?php } ?>
		<ul class="pager-slider clearfix pager-items-0<?php echo count( $fields['slides'] ) ?>">
			<?php $i = 1; ?>
			<?php foreach ( $fields['slides'] as $slide ) { ?>

				<li class="pager-item-0<?php echo absint( $i ); ?> <?php echo $i === 1 ? 'active' : '' ?>">
					<h6>
						<a href="#"><strong>0<?php echo absint( $i ); ?></strong> <?php echo esc_html( $slide['slides_title'] ) ?>
						</a>
					</h6>
				</li>

				<?php $i ++; ?>

			<?php } ?>
		</ul>
	</div>
</section>

