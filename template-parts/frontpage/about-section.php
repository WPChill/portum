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

$parent_attr = array(
	'id'    => ! empty( $fields['about_section_unique_id'] ) ? array( $fields['about_section_unique_id'] ) : array(),
	'class' => array( 'section-about', 'section', 'ewf-section' ),
	'style' => array( 'background-image', 'background-position', 'background-size', 'background-repeat' ),
);
?>
<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<?php
	if ( is_customize_preview() ) {
		?>
		<style>
			[data-section="<?php echo esc_attr($section_id); ?>"] h1,
			[data-section="<?php echo esc_attr($section_id); ?>"] h2,
			[data-section="<?php echo esc_attr($section_id); ?>"] h3,
			[data-section="<?php echo esc_attr($section_id); ?>"] h4,
			[data-section="<?php echo esc_attr($section_id); ?>"] h5,
			[data-section="<?php echo esc_attr($section_id); ?>"] h6,
			[data-section="<?php echo esc_attr($section_id); ?>"] .headline span {
				color: <?php echo esc_attr($fields['about_heading_color']); ?>
			}

			[data-section="<?php echo esc_attr($section_id); ?>"] p {
				color: <?php echo esc_attr($fields['about_text_color']); ?>
			}
		</style>
		<?php
	}
	?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php
		$attr_helper->generate_video_overlay();
		$attr_helper->generate_color_overlay();
		?>

		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'about', $fields ) ); ?>">

				<?php echo wp_kses( Portum_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'about' ), Epsilon_Helper::allowed_kses_pencil() ); ?>

				<div class="row">
					<?php if ( $fields['about_row_title_align'] == 'right' ) { ?>

						<?php if ( ! empty( $fields['about_image'] ) ) { ?>
							<div class="col-md-6">
								<?php
								//about_row_title_align
								//echo '<pre>';
								//	print_r($fields);
								//echo '</pre>';
								?>

								<img src="<?php echo esc_url( $fields['about_image'] ); ?>" alt=""/>
							</div>
						<?php } ?>

						<div class="col-md-6">
							<?php
							echo wp_kses_post(
								Portum_Helper::generate_section_title(
									$fields['about_subtitle'],
									$fields['about_title'],
									array(
										'doubled' => false,
										'center'  => false,
									)
								)
							);
							?>

							<?php echo wpautop( wp_kses_post( $fields['about_text'] ) ); ?>
						</div>


					<?php } else { ?>

						<div class="col-md-6">
							<?php
							echo wp_kses_post(
								Portum_Helper::generate_section_title(
									$fields['about_subtitle'],
									$fields['about_title'],
									array(
										'doubled' => false,
										'center'  => false,
									)
								)
							);
							?>

							<?php echo wpautop( wp_kses_post( $fields['about_text'] ) ); ?>
						</div>

						<?php if ( ! empty( $fields['about_image'] ) ) { ?>
							<div class="col-md-6">
								<img src="<?php echo esc_url( $fields['about_image'] ); ?>" alt=""/>
							</div>
						<?php } ?>

					<?php } ?>


				</div>
			</div>
		</div>
	</div>
</section>
