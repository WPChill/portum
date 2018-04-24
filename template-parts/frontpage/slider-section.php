<?php
/**
 * Template part for displaying a frontpage section
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

$frontpage = Epsilon_Page_Generator::get_instance( 'portum_frontpage_sections_' . get_the_ID(), get_the_ID() );
$fields    = $frontpage->sections[ $section_id ];

$grouping = array(
	'values'   => empty( $fields['slider_grouping'] ) ? array( 'all' ) : $fields['slider_grouping'],
	'group_by' => 'slides_title',
);

$fields['slides'] = $frontpage->get_repeater_field( $fields['slider_repeater_field'], array(), $grouping );

wp_enqueue_script( 'owl-carousel' );
wp_enqueue_script( 'slick' );
wp_enqueue_style( 'owl-carousel' );
wp_enqueue_style( 'slick' );
?>
<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<div class="section-slider" <?php echo ! empty( $fields['slider_section_unique_id'] ) ? 'id="' . $fields['slider_section_unique_id'] . '"' : ''; ?>>
		<div class="main-slider owl-carousel owl-theme">
			<?php foreach ( $fields['slides'] as $slide ) { ?>
				<div class="item">
					<?php if ( ! empty( $slide['slides_image'] ) ) { ?>
						<img src="<?php echo esc_url( $slide['slides_image'] ); ?>" alt="<?php echo ! empty( $slide['title'] ) ? esc_html( $slide['title'] ) : ''; ?>"/>
					<?php } ?>
					<div class="slider-details">
						<?php if ( ! empty( $slide['slides_title'] ) ) { ?>
							<h1><?php echo wp_kses_post( $slide['slides_title'] ); ?></h1>
						<?php } ?>
						<?php if ( ! empty( $slide['slides_description'] ) ) { ?>
							<span><?php echo wp_kses_post( $slide['slides_description'] ); ?></span>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
		</div>
		<?php if ( is_customize_preview() ) { ?>
			<div class="container">
				<?php echo wp_kses( Portum_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'slider' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
			</div>
		<?php } ?>
		<ul class="pager-slider clearfix pager-items-0<?php echo count( $fields['slides'] ); ?>">
			<?php $i = 1; ?>
			<?php foreach ( $fields['slides'] as $slide ) { ?>

				<li class="pager-item-0<?php echo absint( $i ); ?> <?php echo 1 === $i ? 'active' : ''; ?>">
					<strong>
						<a href="#"><span>0<?php echo absint( $i ); ?></span> <?php echo esc_html( $slide['slides_title'] ); ?>
						</a>
					</strong>
				</li>

				<?php $i ++; ?>

			<?php } ?>
		</ul>
	</div>
</section>
