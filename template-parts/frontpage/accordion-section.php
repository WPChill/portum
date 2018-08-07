<?php
/**
 * Template part for displaying a frontpage section
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package portum
 */
$frontpage           = Epsilon_Page_Generator::get_instance( 'portum_frontpage_sections_' . get_the_ID(), get_the_ID() );
$fields              = $frontpage->sections[ $section_id ];
$grouping            = array(
	'values'   => $fields['accordion_grouping'],
	'group_by' => 'accordion_title',
);
$fields['accordion'] = $frontpage->get_repeater_field( $fields['accordion_repeater_field'], array(), $grouping );

$attr_helper = new Epsilon_Section_Attr_Helper( $fields, 'accordion', Portum_Repeatable_Sections::get_instance() );
$parent_attr = array(
	'id'    => ! empty( $fields['accordion_section_unique_id'] ) ? array( $fields['accordion_section_unique_id'] ) : array(),
	'class' => array(
		'section-accordion',
		'section',
		'ewf-section',
		'ewf-section-' . $fields['accordion_section_visibility'],
	),
	'style' => array( 'background-image', 'background-position', 'background-size', 'background-repeat' ),
);
?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<?php Portum_Helper::generate_css_color_tabs( $section_id, 'accordion', $fields ); ?>
	<?php echo wp_kses( Portum_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'accordion' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php
		$attr_helper->generate_color_overlay();
		$section_item_columns  = 12 / intval( $fields['accordion_column_group'] );
		$section_items_content = 12 - $section_item_columns;
		$counter               = 1;
		?>
		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'accordion', $fields ) ); ?>">
				<div class="row">

					<?php if ( 'left' === $fields['accordion_row_title_align'] ) { ?>
						<div class="efw-section-text col-sm-4">
							<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['accordion_title'], $fields['accordion_subtitle'] ) ); ?>
							<?php echo wpautop( wp_kses_post( $fields['accordion_text'] ) ); ?>
						</div><!--/.col-sm-7-->
						<?php if ( ! empty( $fields['accordion'] ) ) { ?>
							<div class="accordion col-sm-8">
								<?php foreach ( $fields['accordion'] as $key => $accordion ) { ?>
									<div class="accordion-item__container col-md-<?php echo esc_attr( $section_item_columns ); ?>">
										<?php
										echo wp_kses( Epsilon_Helper::generate_field_repeater_pencil( $key, 'portum_accordion_section', 'portum_accordion' ), Epsilon_Helper::allowed_kses_pencil() );
										?>
										<div class="accordion-item-toggle">
											<?php echo esc_html( $accordion['accordion_title'] ); ?>
										</div><!--/.accordion-item-toggle-->
										<div class="accordion-item-content <?php echo esc_attr( true === $accordion['accordion_opened'] ) ? 'accordion-item-opened' : ''; ?>">
											<?php echo wpautop( wp_kses_post( $accordion['accordion_text'] ) ); ?>
										</div><!--/.accordion-item-content-->
									</div><!--/.accordion-item-container-->
								<?php } //endforeach ?>
							</div><!--/.accordion-->
						<?php } // endif ?>
					<?php } elseif ( 'right' === $fields['accordion_row_title_align'] ) { ?>
						<?php if ( ! empty( $fields['accordion'] ) ) { ?>
							<div class="accordion col-sm-8">
								<?php foreach ( $fields['accordion'] as $key => $accordion ) { ?>
									<div class="accordion-item__container col-md-<?php echo esc_attr( $section_item_columns ); ?>">
										<?php
										echo wp_kses( Epsilon_Helper::generate_field_repeater_pencil( $key, 'portum_accordion_section', 'portum_accordion' ), Epsilon_Helper::allowed_kses_pencil() );
										?>
										<div class="accordion-item-toggle">
											<?php echo esc_html( $accordion['accordion_title'] ); ?>
										</div><!--/.accordion-item-toggle-->
										<div class="accordion-item-content <?php echo esc_attr( true === $accordion['accordion_opened'] ) ? 'accordion-item-opened' : ''; ?>">
											<?php echo wpautop( wp_kses_post( $accordion['accordion_text'] ) ); ?>
										</div><!--/.accordion-item-content-->
									</div><!--/.accordion-item-container-->
								<?php } //endforeach ?>
							</div><!--/.accordion-->
						<?php } // endif ?>
						<div class="efw-section-text col-sm-4">
							<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['accordion_title'], $fields['accordion_subtitle'] ) ); ?>
							<?php echo wpautop( wp_kses_post( $fields['accordion_text'] ) ); ?>
						</div><!--/.col-sm-7-->
					<?php } else { ?>
						<div class="ewf-section-text col-sm-12">
							<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['accordion_title'], $fields['accordion_subtitle'] ) ); ?>
							<?php echo wpautop( wp_kses_post( $fields['accordion_text'] ) ); ?>
						</div><!--/.col-sm-7-->
						<?php if ( ! empty( $fields['accordion'] ) ) { ?>
							<div class="accordion col-sm-12">
								<?php foreach ( $fields['accordion'] as $key => $accordion ) { ?>
									<div class="accordion-item__container col-md-<?php echo esc_attr( $section_item_columns ); ?>">
										<?php
										echo wp_kses( Epsilon_Helper::generate_field_repeater_pencil( $key, 'portum_accordion_section', 'portum_accordion' ), Epsilon_Helper::allowed_kses_pencil() );
										?>
										<div class="accordion-item-toggle" href="#">
											<?php echo esc_html( $accordion['accordion_title'] ); ?>
										</div><!--/.accordion-item-toggle-->
										<div class="accordion-item-content <?php echo esc_attr( true === $accordion['accordion_opened'] ) ? 'accordion-item-opened' : ''; ?>">
											<?php echo wpautop( wp_kses_post( $accordion['accordion_text'] ) ); ?>
										</div><!--/.accordion-item-content-->
									</div><!--/.accordion-item-container-->
								<?php } //endforeach ?>
							</div><!--/.accordion-->
						<?php } // endif ?>
					<?php } ?>

				</div>
			</div>
		</div>
</section>
