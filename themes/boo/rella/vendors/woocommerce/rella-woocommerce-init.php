<?php
/**
* Themerella WooCommerce init
*
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Load WooCommerce compatibility files.
 */
require get_template_directory() . '/rella/vendors/woocommerce/hooks.php';
require get_template_directory() . '/rella/vendors/woocommerce/functions.php';
require get_template_directory() . '/rella/vendors/woocommerce/template-tags.php';
require get_template_directory() . '/rella/vendors/woocommerce/options.php';
require get_template_directory() . '/rella/vendors/woocommerce/metaboxes.php';

function rella_single_woo_scripts() {
	
	if( apply_filters( 'rella_ajax_add_to_cart_single_product', true ) ) {
		wp_enqueue_script( 'rella_add_to_cart_ajax', get_template_directory_uri() . '/rella/vendors/woocommerce/js/rella_add_to_cart_ajax.js', array( 'jquery' ), null, true );
		wp_localize_script( 'rella_add_to_cart_ajax', 'rella_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	}
	
}
add_action( 'wp_enqueue_scripts', 'rella_single_woo_scripts' );