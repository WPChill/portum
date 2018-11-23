<?php
/**
 * Template part for displaying a frontpage section
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

$layout    = Portum_Helper::get_layout( 'portum_page_layout' );
$frontpage = Epsilon_Page_Generator::get_instance( 'portum_frontpage_sections_' . get_the_ID(), get_the_ID() );
$fields    = $frontpage->sections[ $section_id ];

$id = get_the_ID();
if ( ! empty( $fields['content_page_id'] ) ) {
	$id = $fields['content_page_id'];
}
$pages = new WP_Query( array(
	'p'         => $id,
	'post_type' => 'page',
) );


$attr_helper = new Epsilon_Section_Attr_Helper( $fields, 'content', Portum_Repeatable_Sections::get_instance() );

if ( empty( $fields['content_section_unique_id'] ) ) {
	$fields['content_section_unique_id'] = Portum_Helper::generate_section_id( 'content' );
}
$parent_attr = array(
	'id'    => array( $fields['content_section_unique_id'] ),
	'class' => array( 'ewf-section', 'ewf-section-' . $fields['content_section_visibility'] ),
);

?>

<section class="content content-section" data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>" data-customizer-section-string-id="content">
	<?php Portum_Helper::generate_inline_css( $fields['content_section_unique_id'], 'content', $fields ); ?>
	<?php echo wp_kses( Epsilon_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'content' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php $attr_helper->generate_color_overlay(); ?>
		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'content', $fields ) ); ?>">

				<div class="row">
					<?php
					if ( 'left-sidebar' === $layout['type'] && is_active_sidebar( 'sidebar' ) ) {
						?>
						<div class="col-sm-<?php echo esc_attr( $layout['columns']['sidebar']['span'] ); ?>">
							<!-- /// SIDEBAR CONTENT  /////////////////////////////////////////////////////////////////////////////////// -->
							<?php dynamic_sidebar( 'sidebar' ); ?>
							<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////// -->
						</div>
						<?php
					}
					?>

					<div class="<?php echo ( 1 === $layout['columnsCount'] && ! is_active_sidebar( 'sidebar' ) ) ? 'col-sm-12' : 'col-sm-' . esc_attr( $layout['columns']['content']['span'] ); ?>">
						<!-- /// MAIN CONTENT  ////////////////////////////////////////////////////////////////////////////////////// -->
						<?php
						if ( $pages->have_posts() ) :
							while ( $pages->have_posts() ) :
								$pages->the_post();
								get_template_part( 'template-parts/content/content', 'page' );
							endwhile;
						endif;
						wp_reset_postdata();
						?>
						<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////// -->
					</div>

					<?php
					if ( 'right-sidebar' === $layout['type'] && is_active_sidebar( 'sidebar' ) ) {
						?>
						<div class="col-sm-<?php echo esc_attr( $layout['columns']['sidebar']['span'] ); ?>">
							<!-- /// SIDEBAR CONTENT  /////////////////////////////////////////////////////////////////////////////////// -->
							<?php dynamic_sidebar( 'sidebar' ); ?>
							<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////// -->
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
</section>
