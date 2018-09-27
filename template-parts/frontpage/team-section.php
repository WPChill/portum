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
	'values'   => $fields['team_grouping'],
	'group_by' => 'member_title',
);

$attr_helper = new Epsilon_Section_Attr_Helper( $fields, 'team', Portum_Repeatable_Sections::get_instance() );

$fields['members']             = $frontpage->get_repeater_field( $fields['team_repeater_field'], array(), $grouping );
$fields['team_column_spacing'] = isset( $fields['team_column_spacing'] ) ? $fields['team_column_spacing'] : '';

$parent_attr = array(
	'id'    => ! empty( $fields['team_section_unique_id'] ) ? array( $fields['team_section_unique_id'] ) : array(),
	'class' => array( 'section-team', 'ewf-section', 'ewf-section-' . $fields['team_section_visibility'] ),
	'style' => array( 'background-image', 'background-position', 'background-size', 'background-repeat' ),
);
$span        = 12 / absint( $fields['team_column_group'] );
?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<?php //Portum_Helper::generate_inline_css( $section_id, 'team', $fields ); ?>
	<?php echo wp_kses( Epsilon_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'team' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php
		$attr_helper->generate_color_overlay();
		?>

		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'team', $fields ) ); ?>">

				<div class="row">
					<div class="col-sm-12">
						<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['team_subtitle'], $fields['team_title'] ) ); ?>
					</div>
				</div>

				<?php if ( ! empty( $fields['members'] ) ) { ?>
					<div class="row">
						<div class="ewf-section__team">
							<?php foreach ( $fields['members'] as $key => $v ) { ?>

								<div class="col-sm-<?php echo esc_attr( $span ); ?> ewf-item__spacing-<?php echo esc_attr( $fields['team_column_spacing'] ); ?>">
									<div class="ewf-team__container">
										<?php
										echo wp_kses( Epsilon_Helper::generate_field_repeater_pencil( $key, 'portum_team_members_section', 'portum_team' ), Epsilon_Helper::allowed_kses_pencil() );
										?>

										<?php if ( ! empty( $v['member_title'] ) ) { ?>
											<div class="ewf-team__title">
												<div class="ewf-like-h5">
													<?php echo wp_kses_post( $v['member_title'] ); ?>
												</div>
											</div>
										<?php } ?>


										<?php if ( ! empty( $v['member_text'] ) ) { ?>
											<div class="ewf-team__content">
												<?php echo wp_kses_post( wpautop( $v['member_text'] ) ); ?>
											</div>
										<?php } ?>


										<?php if ( ! empty( $v['member_image'] ) ) { ?>
											<div class="ewf-team__thumbnail">
												<img src="<?php echo esc_url( $v['member_image'] ); ?>" />
											</div>
										<?php } ?>


										<?php
										$arr = array(
											'facebook'  => $v['member_social_facebook'],
											'twitter'   => $v['member_social_twitter'],
											'pinterest' => $v['member_social_pinterest'],
											'linkedin'  => $v['member_social_linkedin'],
										);
										$arr = array_filter( $arr );

										if ( ! empty( $arr ) ) {

											?>
											<ul class="ewf-team__social_links">
												<?php foreach ( $arr as $k => $v ) { ?>
													<li>
														<a href="<?php echo esc_url( $v ); ?>">
															<i class="fa fa-<?php echo esc_attr( $k ); ?>" aria-hidden="true"></i>
														</a>
													</li>
												<?php } ?>
											</ul>
										<?php } // endif ?>
									</div><!--/.ewf-team__container-->
								</div><!--/.col-sm-->
							<?php } // endforeach ?>
						</div><!--/.ewf-section__team-->
					</div><!--/.row-->
				<?php }  // !empty ?>

			</div><!--./ewf-section__content-->
</section>