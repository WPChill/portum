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
$grouping  = array(
	'values'   => $fields['expertise_grouping'],
	'group_by' => 'expertise_title',
);

$fields['expertise'] = $frontpage->get_repeater_field( $fields['expertise_repeater_field'], array(), $grouping );
$attr_helper         = new Epsilon_Section_Attr_Helper( $fields, 'expertise', Portum_Repeatable_Sections::get_instance() );
$parent_attr         = array(
	'id'    => ! empty( $fields['expertise_section_unique_id'] ) ? array( $fields['expertise_section_unique_id'] ) : array(),
	'class' => array( 'section-expertise', 'section', 'ewf-section' ),
	'style' => array( 'background-image', 'background-position', 'background-size', 'background-repeat' ),
);
?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php
		$attr_helper->generate_video_overlay();
		$attr_helper->generate_color_overlay();
		?>
		<div class="<?php echo esc_attr( Portum_Helper::container_class( 'expertise', $fields ) ); ?>">
			<?php echo wp_kses( Portum_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'expertise' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
			<div class="row">
				<div class="col-md-7">
					<?php
					echo wp_kses_post(
						Portum_Helper::generate_section_title(
							$fields['expertise_subtitle'],
							$fields['expertise_title'],
							array(
								'doubled' => false,
								'center'  => false,
							)
						)
					);
					?>

					<?php if ( ! empty( $fields['expertise'] ) ) { ?>

						<?php foreach ( $fields['expertise'] as $index => $expertise ) { ?>
							<div class="expertise-item">
								<?php if ( ! empty( $expertise['expertise_title'] ) ) { ?>
									<h4>
										<!--<a href="#"></a>-->
										<?php echo esc_html( $expertise['expertise_title'] ); ?>
										<strong><?php echo esc_html( $expertise['expertise_number'] ); ?></strong>
									</h4>
								<?php } ?>

								<?php echo wp_kses_post( wpautop( $expertise['expertise_description'] ) ); ?>
							</div>
						<?php } ?>

					<?php } ?>
				</div>
				<?php if ( ! empty( $fields['expertise_image'] ) ) { ?>
					<div class="col-md-5">
						<img class="expertise-image-block" src="<?php echo esc_url( $fields['expertise_image'] ); ?>" alt=""/>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>
