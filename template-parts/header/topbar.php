<?php
/**
 * Template part for displaying the top bar
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */
/**
 * The defined sidebars
 */
$headersidebars = array(
	'header-sidebar-1',
	'header-sidebar-2',
	'header-sidebar-3',
	'header-sidebar-4',
);

$enabled_top_bar = get_theme_mod( 'portum_header_top_bar', true );

if ( ! $enabled_top_bar ) {
	return;
}

/**
 * We create an empty array that will keep which one of them has any active sidebars
 */
$sidebars = array();
foreach ( $headersidebars as $column ) {
	if ( is_active_sidebar( $column ) ) {
		$sidebars[] = $column;
	}
};

/**
 * Handle the sizing of the footer columns based on the user selection
 */
$header_layout = get_theme_mod( 'portum_header_columns', false );
if ( ! $header_layout ) {
	$header_layout = Portum_Helper::get_header_default();
}
if ( ! is_array( $header_layout ) ) {
	$header_layout = json_decode( $header_layout, true );
}
if ( empty( $sidebars ) ) {
	return;
}

Portum::get_instance()->top_bar = true;
?>

<header class="portum-top-bar">
	<div class="container">
		<?php if ( ! empty( $sidebars ) ) { ?>
			<div class="row">
				<?php foreach ( $header_layout['columns'] as $sidebar ) : ?>

					<?php if ( is_active_sidebar( 'header-sidebar-' . $sidebar['index'] ) ) { ?>
						<div id="header-widget-area-<?php echo esc_attr( $sidebar['index'] ); ?>" class="col-sm-<?php echo esc_attr( $sidebar['span'] ); ?>">
							<?php dynamic_sidebar( 'header-sidebar-' . $sidebar['index'] ); ?>
						</div>
					<?php } ?>

				<?php endforeach; ?>
			</div><!--.row-->
		<?php } ?>
	</div>
</header>
