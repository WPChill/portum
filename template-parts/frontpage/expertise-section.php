<?php
/**
 * Template part for displaying a frontpage section
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

$frontpage = Portum_Frontpage::get_instance( 'portum_frontpage_sections' );
$fields    = $frontpage->sections[ $section_id ];
$grouping  = array(
	'values'   => $fields['expertise_grouping'],
	'group_by' => 'expertise_title',
);

$fields['expertise'] = $frontpage->get_repeater_field( $fields['expertise_repeater_field'], array(), $grouping );
?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<div class="section-expertise section">
		<div class="container">
			<?php echo wp_kses_post( Portum_Helper::generate_pencil() ); ?>
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
										<?php ?>
										<a href="#"><?php echo esc_html( $expertise['expertise_title'] ) ?></a>
										<strong>0
											<?php
											//TODO Am pus 0 inaintea cifrei, dar aici trebuie sa folosesc number format, pentru ca putem avea 10/11/12/13 etc;
											echo absint( $index + 1 );
											?>
										</strong>
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
