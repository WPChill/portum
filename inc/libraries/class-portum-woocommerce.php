<?php
/**
 * Portum Theme Woocommerce
 *
 * @package Portum
 * @since   1.0
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Class Portum_Woocommerce
 */
class Portum_Woocommerce {
	/**
	 * Portum_Woocommerce constructor.
	 */
	public function __construct() {
		/**
		 * Change shop loop item title
		 */
		remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
		add_action( 'woocommerce_shop_loop_item_title', array( $this, 'shop_loop_item_title' ), 10 );	
	}

	/**
	 * Changes shop loop item title
	 *
	 * @return string
	 */
	public function shop_loop_item_title() {
		echo '<h4 class="woocommerce-loop-product__title">' . get_the_title() . '</h4>';
	}

}
