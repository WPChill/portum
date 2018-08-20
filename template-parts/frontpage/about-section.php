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

$attr_helper = new Epsilon_Section_Attr_Helper( $fields, 'about', Portum_Repeatable_Sections::get_instance() );

$button_primary = $fields['about_button_primary_label'] . $fields['about_button_primary_url'];
$parent_attr    = array(
	'id'    => ! empty( $fields['about_section_unique_id'] ) ? array( $fields['about_section_unique_id'] ) : array(),
	'class' => array( 'section-about', 'section', 'ewf-section', 'ewf-section-' . $fields['about_section_visibility'] ),
	'style' => array( 'background-image', 'background-position', 'background-size', 'background-repeat' ),
);


?>
<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<?php Portum_Helper::generate_css_color_tabs( $section_id, 'about', $fields ); ?>
	<?php echo wp_kses( Portum_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'about' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php

		$attr_helper->generate_color_overlay();
		$section_content_cols = ( $fields['about_image'] ? '6' : '12' );
		?>

		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'about', $fields ) ); ?>">

				<?php if ( 'right' === $fields['about_row_title_align'] ) { ?>
					<div class="row">

						<?php if ( ! empty( $fields['about_image'] ) ) { ?>
							<div class="col-md-6">
								<img src="<?php echo esc_url( $fields['about_image'] ); ?>" />
							</div><!--/.col-md--6-->
						<?php } ?>

						<div class="col-md-<?php echo esc_attr( $section_content_cols ); ?>">
							<div class="ewf-section-text">
								<?php
								echo wp_kses_post( Portum_Helper::generate_section_title( $fields['about_subtitle'], $fields['about_title'] ) );
								?>
								<?php echo wpautop( wp_kses_post( $fields['about_text'] ) ); ?>

								<?php if ( $button_primary ) { ?>
									<a class="ewf-btn ewf-btn--huge <?php echo esc_attr( isset( $fields['about_button_primary_color'] ) ? $fields['about_button_primary_color'] : '' ); ?>" href="<?php echo esc_url( $fields['about_button_primary_url'] ); ?>">
										<?php echo wp_kses_post( $fields['about_button_primary_label'] ); ?>
									</a>
								<?php }; ?>
							</div><!--/.ewf-section-text-->
						</div><!--/.col-md-->
					</div><!--/.row-->

				<?php } elseif ( 'left' === $fields['about_row_title_align'] ) { ?>
				<div class="row">

					<div class="col-md-<?php echo esc_attr( $section_content_cols ); ?>">
						<div class="ewf-section-text">
							<?php
							echo wp_kses_post( Portum_Helper::generate_section_title( $fields['about_subtitle'], $fields['about_title'] ) );
							?>
							<?php echo wpautop( wp_kses_post( $fields['about_text'] ) ); ?>

							<?php if ( $button_primary ) { ?>
								<a class="ewf-btn ewf-btn--huge <?php echo esc_attr( isset( $fields['about_button_primary_color'] ) ? $fields['about_button_primary_color'] : '' ); ?>" href="<?php echo esc_url( $fields['about_button_primary_url'] ); ?>">

									<?php echo wp_kses_post( $fields['about_button_primary_label'] ); ?></a>
							<?php }; ?>
						</div><!--/.ewf-section-text-->
					</div><!--/.col-md-->

					<?php if ( ! empty( $fields['about_image'] ) ) { ?>

						<div class="col-md-6">
							<img src="<?php echo esc_url( $fields['about_image'] ); ?>" />
						</div>
					<?php }//endif ?>
					<div><!--/.row-->

						<?php } else { ?>

							<div class="row">
								<div class="col-md-12">
									<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['about_subtitle'], $fields['about_title'] ) ); ?>
									<?php echo wpautop( wp_kses_post( $fields['about_text'] ) ); ?>

									<?php if ( $button_primary ) { ?>
										<a class="ewf-btn ewf-btn--huge <?php echo esc_attr( isset( $fields['about_button_primary_color'] ) ? $fields['about_button_primary_color'] : '' ); ?>" href="<?php echo esc_url( $fields['about_button_primary_url'] ); ?>"><?php echo wp_kses_post( $fields['about_button_primary_label'] ); ?></a>
									<?php }; ?>
								</div><!--/.col-md--12-->
							</div><!--/.row-->

							<?php if ( $fields['about_image'] ) { ?>
								<div class="row">
									<div class="col-sm-12">
										<img src="<?php echo esc_url( $fields['about_image'] ); ?>" />
									</div><!--/.col-sm-12-->
								</div>

							<?php }//endif ?>
						<?php }//endelse ?>
					</div>
				</div><!--/.ewf-section--content-->
			</div><!--/.attr-helper-->
</section>
