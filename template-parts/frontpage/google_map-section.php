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
	'values'   => $fields['google_map_grouping'],
	'group_by' => 'contact_title',
);

$fields['contact_boxes'] = $frontpage->get_repeater_field( $fields['google_map_repeater_field'], array(), $grouping );
$span                    = 12 / absint( $fields['google_map_column_group'] );
$api                     = get_theme_mod( 'portum_google_api_key', '' );

?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>" class="google-map-section">
	<?php if ( ! empty( $api ) ) : ?>
		<div class="contact-overlay"></div>
		<div class="contact-map" id="contact-map" data-zoom="<?php echo esc_attr( $fields['google_map_zoom'] ); ?>" data-address="<?php echo esc_attr( $fields['google_map_address'] ); ?>"></div>
	<?php endif; ?>
	<div class="container">
		<?php echo wp_kses( Portum_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'google_map' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
		<div class="contact-details">
			<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['google_map_subtitle'], $fields['google_map_title'] ) ); ?>
			<div class="wrapper fixed">
				<?php
				if ( ! empty( $fields['contact_boxes'] ) ) {
					?>
					<div class="row">
						<?php foreach ( $fields['contact_boxes'] as $field ) { ?>
							<div class="col-xs-12 col-md-<?php echo absint( $span ); ?>">
								<div class="contact-details-item">
									<h5>
										<i class="fa <?php echo esc_attr( $field['contact_icon'] ); ?>" aria-hidden="true"></i>
										<?php echo esc_html( $field['contact_title'] ); ?>
									</h5>
									<?php echo wpautop( wp_kses_post( $field['contact_text'] ) ); ?>
								</div>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>
