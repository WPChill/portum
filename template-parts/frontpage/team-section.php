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
	'values'   => $fields['team_grouping'],
	'group_by' => 'member_title',
);

$fields['members'] = $frontpage->get_repeater_field( $fields['team_repeater_field'], array(), $grouping );
$fields['members'] = array_slice( $fields['members'], 0, 4 );

$i = 0;
?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<div class="section-team section dashed">
		<div class="container">
			<?php echo wp_kses_post( Portum_Helper::generate_pencil() ); ?>
			<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['team_subtitle'], $fields['team_title'] ) ); ?>

			<?php if ( $fields['members'] ) { ?>
				<div class="team-members fixed">
					<?php foreach ( $fields['members'] as $member ) { ?>
						<div class="team-members-item fixed">
							<?php $i ++; ?>

							<?php
							$arr = array(
								'facebook'  => $member['member_social_facebook'],
								'twitter'   => $member['member_social_twitter'],
								'pinterest' => $member['member_social_pinterest'],
								'linkedin'  => $member['member_social_linkedin'],
							);

							$arr = array_filter( $arr );
							?>

							<?php if ( $i > 2 ) { ?>
								<div class="details">
									<?php if ( ! empty( $member['member_title'] ) ) { ?>
										<h6><?php echo wp_kses_post( $member['member_title'] ); ?></h6>
										<?php echo wp_kses_post( wpautop( $member['member_text'] ) ); ?>

									<?php } ?>
								</div>
								<?php if ( ! empty( $member['member_image'] ) ) { ?>
									<div class="portrait">
										<img src="<?php echo esc_url( $member['member_image'] ); ?>"/>
										<div class="overlay"></div>
									</div>
								<?php } ?><?php } else { ?>

								<?php if ( ! empty( $member['member_image'] ) ) { ?>
								<div class="portrait">
									<img src="<?php echo esc_url( $member['member_image'] ); ?>"/>
									<div class="overlay"></div>
								</div>
							<?php } ?>

								<div class="details">
									<?php if ( ! empty( $member['member_title'] ) ) { ?>
										<h6><?php echo wp_kses_post( $member['member_title'] ); ?></h6>
										<?php echo wp_kses_post( wpautop( $member['member_text'] ) ); ?>

									<?php } ?>
								</div>
							<?php } ?>


							<ul class="social-team <?php echo 2 < $i ? '' : 'right'; ?>">
								<?php foreach ( $arr as $k => $v ) { ?>
									<li>
										<a href="<?php echo esc_url( $v ); ?>">
											<i class="fa fa-<?php echo esc_attr( $k ); ?>" aria-hidden="true"></i>
										</a>
									</li>
								<?php } ?>
							</ul>
						</div>
					<?php }// End foreach().
					?>
				</div>
			<?php }// End if().
			?>
		</div>
	</div>
</section>
