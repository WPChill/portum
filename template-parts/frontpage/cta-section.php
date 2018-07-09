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

$attr_helper = new Epsilon_Section_Attr_Helper( $fields, 'cta', Portum_Repeatable_Sections::get_instance() );
$parent_attr = array(
	'id'    => ! empty( $fields['cta_section_unique_id'] ) ? array( $fields['cta_section_unique_id'] ) : array(),
	'class' => array( 'section-cta', 'section', 'ewf-section', 'ewf-section-' . $fields['cta_section_visibility'] ),
	'style' => array( 'background-image', 'background-position', 'background-size', 'background-repeat' ),
);


?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<?php Portum_Helper::generate_css_color_tabs( $section_id, 'cta', $fields ); ?>
	<?php echo wp_kses( Portum_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'cta' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>

		<?php
		$attr_helper->generate_color_overlay();
		$attr_helper->generate_video_overlay();

		$button_primary   = $fields['cta_button_primary_label'] . $fields['cta_button_primary_url'];
		$button_secondary = $fields['cta_button_secondary_label'] . $fields['cta_button_secondary_url'];
		?>
		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'cta', $fields ) ); ?>">

				<div class="row">

					<?php if ( $button_primary . $button_secondary ) { ?>

						<?php if ( 'right' === $fields['cta_row_title_align'] ) { ?>

							<div class="col-sm-5 ewf-text-align--left">
								<?php if ( $button_primary ) { ?>
									<a class="ewf-btn ewf-btn--huge" href="<?php echo esc_url( $fields['cta_button_primary_url'] ); ?>"><?php echo wp_kses_post( $fields['cta_button_primary_label'] ); ?></a>
								<?php }; ?>

								<?php if ( $button_secondary ) { ?>
									&nbsp;
									<a class="ewf-btn ewf-btn--huge ewf-btn--secondary" href="<?php echo esc_url( $fields['cta_button_secondary_url'] ); ?>"><?php echo wp_kses_post( $fields['cta_button_secondary_label'] ); ?></a>
								<?php }; ?>
							</div>
							<div class="col-sm-7">
								<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['cta_title'], $fields['cta_description'] ) ); ?>
							</div>

						<?php } elseif ( 'top' === $fields['cta_row_title_align'] ) { ?>

							<div class="col-sm-12">

								<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['cta_title'], $fields['cta_description'] ) ); ?>

								<?php if ( $button_primary ) { ?>
									<a class="ewf-btn ewf-btn--huge <?php echo esc_attr( isset( $fields['cta_button_primary_color'] ) ? $fields['cta_button_primary_color'] : '' ); ?>" href="<?php echo esc_url( $fields['cta_button_primary_url'] ); ?>"><?php echo wp_kses_post( $fields['cta_button_primary_label'] ); ?></a>
								<?php }; ?>

								<?php if ( $button_secondary ) { ?>
									&nbsp;
									<a class="ewf-btn ewf-btn--huge ewf-btn--secondary <?php echo esc_attr( isset( $fields['cta_button_secondary_color'] ) ? $fields['cta_button_secondary_color'] : '' ); ?>" href="<?php echo esc_url( $fields['cta_button_secondary_url'] ); ?>"><?php echo wp_kses_post( $fields['cta_button_secondary_label'] ); ?></a>
								<?php }; ?>

							</div>

						<?php } else { ?>

							<div class="col-sm-7">
								<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['cta_title'], $fields['cta_description'] ) ); ?>
							</div>
							<div class="col-sm-5 ewf-text-align--right">
								<?php if ( $button_primary ) { ?>
									<a class="ewf-btn ewf-btn--huge" href="<?php echo esc_url( $fields['cta_button_primary_url'] ); ?>"><?php echo wp_kses_post( $fields['cta_button_primary_label'] ); ?></a>
								<?php }; ?>

								<?php if ( $button_secondary ) { ?>
									&nbsp;
									<a class="ewf-btn ewf-btn--huge ewf-btn--secondary" href="<?php echo esc_url( $fields['cta_button_secondary_url'] ); ?>"><?php echo wp_kses_post( $fields['cta_button_secondary_label'] ); ?></a>
								<?php }; ?>
							</div>

						<?php } ?>

					<?php } else { ?>

						<div class="col-sm-12">
							<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['cta_title'], $fields['cta_description'] ) ); ?>
						</div>

					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>
