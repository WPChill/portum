<?php
/**
 * File that renders the theme Header
 *
 * @package Portum
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class() ?>>

<?php
/**
 * Hook: portum_header.
 *
 * @hooked portum_classic_header - 10
 */
do_action( 'portum_header' )
?>

<div id="wrap">
