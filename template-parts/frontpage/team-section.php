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

$fields['members'] = $frontpage->get_repeater_field( $fields['team_repeater_field'], array(), $grouping );

$parent_attr = array(
	'id'    => ! empty( $fields['team_section_unique_id'] ) ? array( $fields['team_section_unique_id'] ) : array(),
	'class' => array( 'section-team', 'ewf-section', 'ewf-section-' . $fields['team_section_visibility'] ),
	'style' => array( 'background-image', 'background-position', 'background-size', 'background-repeat' ),
);

$items_count = 0;
$items_class = null;
?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<?php Portum_Helper::generate_css_color_tabs( $section_id, 'team', $fields ); ?>
	<?php echo wp_kses( Portum_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'team' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php
		$attr_helper->generate_color_overlay();
		$attr_helper->generate_video_overlay();
		?>

		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'team', $fields ) ); ?>">

				<div class="row">

					<?php if ( 'left' === $fields['team_row_title_align'] ) { ?>

						<div class="col-md-6">
							<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['team_subtitle'], $fields['team_title'] ) ); ?>
						</div>

						<div class="col-md-6">
							<?php if ( $fields['members'] ) { ?>
								<?php foreach ( $fields['members'] as $key => $member ) { ?>

									<?php

									if ( $items_count & 1 ) {
										$items_class = ( $items_class ? null : ' right' );
									}

									$items_count++;
									?>

									<div class="team-members-item team-members-item--full<?php echo esc_attr( $items_class ); ?>">
										<?php
										echo wp_kses( Epsilon_Helper::generate_field_repeater_pencil( $key, 'portum_team_members_section', 'portum_team_members' ), Epsilon_Helper::allowed_kses_pencil() );
										?>
										<?php
										$arr = array(
											'facebook'  => $member['member_social_facebook'],
											'twitter'   => $member['member_social_twitter'],
											'pinterest' => $member['member_social_pinterest'],
											'linkedin'  => $member['member_social_linkedin'],
										);

										$arr = array_filter( $arr );
										?>


										<?php if ( $items_count & 1 ) { ?>

											<?php if ( ! empty( $member['member_image'] ) ) { ?>
												<div class="portrait">
													<img src="<?php echo esc_url( $member['member_image'] ); ?>" alt="" />
													<div class="overlay"></div>
												</div>
											<?php } ?>

											<div class="details">
												<?php if ( ! empty( $member['member_title'] ) ) { ?>
													<h5><?php echo wp_kses_post( $member['member_title'] ); ?></h5>
													<?php echo wp_kses_post( wpautop( $member['member_text'] ) ); ?>

												<?php } ?>
											</div>

										<?php } else { ?>

											<div class="details">
												<?php if ( ! empty( $member['member_title'] ) ) { ?>
													<h5><?php echo wp_kses_post( $member['member_title'] ); ?></h5>
													<?php echo wp_kses_post( wpautop( $member['member_text'] ) ); ?>

												<?php } ?>
											</div>
											<?php if ( ! empty( $member['member_image'] ) ) { ?>
												<div class="portrait">
													<img src="<?php echo esc_url( $member['member_image'] ); ?>" alt="" />
													<div class="overlay"></div>
												</div>
											<?php } ?>

										<?php } ?>

										<ul class="social-team">
											<?php foreach ( $arr as $k => $v ) { ?>
												<li>
													<a href="<?php echo esc_url( $v ); ?>">
														<i class="fa fa-<?php echo esc_attr( $k ); ?>" aria-hidden="true"></i>
													</a>
												</li>
											<?php } ?>
										</ul>

									</div>
								<?php }// End foreach(). ?>
							<?php }// End if(). ?>
						</div>

					<?php } elseif ( 'right' === $fields['team_row_title_align'] ) { ?>

						<div class="col-md-6">
							<?php if ( $fields['members'] ) { ?>
								<?php foreach ( $fields['members'] as $key => $member ) { ?>

									<?php

									if ( $items_count & 1 ) {
										$items_class = ( $items_class ? null : ' right' );
									}

									$items_count++;
									?>

									<div class="team-members-item team-members-item--full<?php echo esc_attr( $items_class ); ?>">
										<?php
										echo wp_kses( Epsilon_Helper::generate_field_repeater_pencil( $key, 'portum_team_members_section', 'portum_team_members' ), Epsilon_Helper::allowed_kses_pencil() );
										?>
										<?php
										$arr = array(
											'facebook'  => $member['member_social_facebook'],
											'twitter'   => $member['member_social_twitter'],
											'pinterest' => $member['member_social_pinterest'],
											'linkedin'  => $member['member_social_linkedin'],
										);

										$arr = array_filter( $arr );
										?>


										<?php if ( $items_count & 1 ) { ?>

											<?php if ( ! empty( $member['member_image'] ) ) { ?>
												<div class="portrait">
													<img src="<?php echo esc_url( $member['member_image'] ); ?>" alt="" />
													<div class="overlay"></div>
												</div>
											<?php } ?>

											<div class="details">
												<?php if ( ! empty( $member['member_title'] ) ) { ?>
													<h5><?php echo wp_kses_post( $member['member_title'] ); ?></h5>
													<?php echo wp_kses_post( wpautop( $member['member_text'] ) ); ?>

												<?php } ?>
											</div>

										<?php } else { ?>

											<div class="details">
												<?php if ( ! empty( $member['member_title'] ) ) { ?>
													<h5><?php echo wp_kses_post( $member['member_title'] ); ?></h5>
													<?php echo wp_kses_post( wpautop( $member['member_text'] ) ); ?>

												<?php } ?>
											</div>
											<?php if ( ! empty( $member['member_image'] ) ) { ?>
												<div class="portrait">
													<img src="<?php echo esc_url( $member['member_image'] ); ?>" alt="" />
													<div class="overlay"></div>
												</div>
											<?php } ?>

										<?php } ?>

										<ul class="social-team">
											<?php foreach ( $arr as $k => $v ) { ?>
												<li>
													<a href="<?php echo esc_url( $v ); ?>">
														<i class="fa fa-<?php echo esc_attr( $k ); ?>" aria-hidden="true"></i>
													</a>
												</li>
											<?php } ?>
										</ul>

									</div>
								<?php }// End foreach(). ?>
							<?php }// End if(). ?>
						</div>

						<div class="col-md-6">
							<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['team_subtitle'], $fields['team_title'] ) ); ?>
						</div>

					<?php } else { ?>

						<div class="col-md-12">
							<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['team_subtitle'], $fields['team_title'] ) ); ?>
						</div>

						<div class="col-md-12">
							<?php if ( $fields['members'] ) { ?>
								<?php foreach ( $fields['members'] as $key => $member ) { ?>

									<?php

									if ( 2 === $items_count ) {
										$items_class = ( $items_class ? null : ' right' );

										$items_count = 0;
									}

									$items_count++;
									?>

									<div class="team-members-item<?php echo esc_attr( $items_class ); ?>">
										<?php
										echo wp_kses( Epsilon_Helper::generate_field_repeater_pencil( $key, 'portum_team_members_section', 'portum_team_members' ), Epsilon_Helper::allowed_kses_pencil() );
										?>
										<?php
										$arr = array(
											'facebook'  => $member['member_social_facebook'],
											'twitter'   => $member['member_social_twitter'],
											'pinterest' => $member['member_social_pinterest'],
											'linkedin'  => $member['member_social_linkedin'],
										);

										$arr = array_filter( $arr );
										?>


										<?php if ( $items_class ) { ?>

											<div class="details">
												<?php if ( ! empty( $member['member_title'] ) ) { ?>
													<h5><?php echo wp_kses_post( $member['member_title'] ); ?></h5>
													<?php echo wp_kses_post( wpautop( $member['member_text'] ) ); ?>

												<?php } ?>
											</div>
											<?php if ( ! empty( $member['member_image'] ) ) { ?>
												<div class="portrait">
													<img src="<?php echo esc_url( $member['member_image'] ); ?>" alt="" />
													<div class="overlay"></div>
												</div>
											<?php } ?>

										<?php } else { ?>

											<?php if ( ! empty( $member['member_image'] ) ) { ?>
												<div class="portrait">
													<img src="<?php echo esc_url( $member['member_image'] ); ?>" alt="" />
													<div class="overlay"></div>
												</div>
											<?php } ?>

											<div class="details">
												<?php if ( ! empty( $member['member_title'] ) ) { ?>
													<h5><?php echo wp_kses_post( $member['member_title'] ); ?></h5>
													<?php echo wp_kses_post( wpautop( $member['member_text'] ) ); ?>

												<?php } ?>
											</div>

										<?php } ?>

										<ul class="social-team">
											<?php foreach ( $arr as $k => $v ) { ?>
												<li>
													<a href="<?php echo esc_url( $v ); ?>">
														<i class="fa fa-<?php echo esc_attr( $k ); ?>" aria-hidden="true"></i>
													</a>
												</li>
											<?php } ?>
										</ul>

									</div>
								<?php }// End foreach(). ?>
							<?php }// End if(). ?>
						</div>

					<?php } ?>
				</div>

			</div>
		</div>

	</div>
</section>
