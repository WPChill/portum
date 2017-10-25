<?php
/**
 * Template part for displaying a frontpage section
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

$frontpage = Portum_Page_Generator::get_instance( 'portum_frontpage_sections_' . get_the_ID(), get_the_ID() );
$fields    = $frontpage->sections[ $section_id ];
$grouping  = array(
	'values'   => $fields['portfolio_grouping'],
	'group_by' => 'portfolio_title',
);

$fields['portfolio_items'] = $frontpage->get_repeater_field( $fields['portfolio_repeater_field'], array(), $grouping );
?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<div class="section-portfolio section">
		<?php if ( is_customize_preview() ) { ?>
			<div class="container">
				<?php echo wp_kses_post( Portum_Helper::generate_pencil() ); ?>
			</div>
		<?php } ?>

		<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['portfolio_subtitle'], $fields['portfolio_title'] ) ); ?>

		<?php if ( ! empty( $fields['portfolio_items'] ) ) { ?>
			<div class="portfolio-grid fixed">
				<?php foreach ( $fields['portfolio_items'] as $item ) { ?>
					<div class="portfolio-grid-item small-column">
						<?php if ( ! empty( $item['portfolio_image'] ) ) { ?>
							<img src="<?php echo esc_url( $item['portfolio_image'] ); ?>" alt=""/>
						<?php } ?>

						<div class="overlay">

							<div class="wrapper">
								<?php if ( ! empty( $item['portfolio_title'] ) ) { ?>
									<h5><?php echo esc_html( $item['portfolio_title'] ); ?></h5>
								<?php } ?>

								<?php echo wpautop( wp_kses_post( $item['portfolio_description'] ) ); ?>

								<div class="action fixed">
									<a href="<?php echo esc_url( $item['portfolio_image'] ); ?>" class="magnific-link zoom">
										<i class="fa fa-search" aria-hidden="true"></i>
									</a>
									<a href="#" class="link">
										<i class="fa fa-chain" aria-hidden="true"></i>
									</a>
								</div>

							</div>

						</div>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
</section>
