<?php
/**
 * Themerella WooCommerce hooks
 *
 * @package rella-framework
 */


/**
 * Layout
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

/**
 * Loop
 * @see  rella_woocommere_headline()
 * @see  rella_woocommerce_template_loop_product_title()
 */
remove_action( 'woocommerce_before_shop_loop',           'woocommerce_result_count',                      20 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating',               5 );
remove_action( 'woocommerce_shop_loop_item_title',       'woocommerce_template_loop_product_title',       10 );
add_action( 'woocommerce_shop_loop_item_title',          'rella_woocommerce_template_loop_product_title', 10 );

/**
 * Loop List
 * @see rella_woocommerce_add_to_cart_list()
 */
add_action( 'woocommerce_shop_loop_add_cart_list', 'rella_woocommerce_add_to_cart_list', 10 );

/**
 * Loop carousel add to cart
 * @see rella_woocommerce_add_to_cart_carousel()
 */
add_action( 'rella_woocommerce_loop_add_to_cart_carousel', 'rella_woocommerce_add_to_cart_carousel', 10 );

/**
 * Loop elegant add to cart
 * @see rella_woocommerce_add_to_cart_elegant()
 */
add_action( 'rella_woocommerce_loop_add_to_cart_elegant', 'rella_woocommerce_add_to_cart_elegant', 10 );

/**
 * Product
 * @see  rella_woocommerce_template_single_cats()
 * @see  rella_woocommerce_variations_quantity_input()
 */
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash',         10 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 25 );

add_action( 'woocommerce_after_single_product', 'rella_theme_init_js', 30 );

add_action( 'woocommerce_checkout_order_review', 'rella_heading_payment_method', 15 );

/**
 * Filters
 * @see  rella_woocommerce_body_class()
 * @see  rella_products_per_page()
 * @see  rella_loop_columns()
 * @see  rella_wc_add_custom_query_var()
 * @see  rella_woocommerce_catalog_orderby()
 */
add_filter( 'body_class',                           'rella_woocommerce_body_class' );
add_filter( 'loop_shop_per_page',                   'rella_wc_limit_archive_posts_per_page', 20 );
add_filter( 'loop_shop_columns',                    'rella_loop_columns' );
add_filter( 'woocommerce_related_products_columns', 'rella_related_loop_columns', 10, 1 );
add_filter( 'woocommerce_up_sells_columns',         'rella_upsell_loop_columns', 10, 1 );
add_filter( 'woocommerce_cross_sells_columns',      'rella_cross_sell_loop_columns', 10, 1 );
add_filter( 'query_vars',                           'rella_wc_add_custom_query_var' );
add_filter( 'woocommerce_catalog_orderby',          'rella_woocommerce_catalog_orderby' );

/**
 * Custom actions
 * @see  rella_woocommerce_setup()
 */
add_action( 'after_switch_theme', 'rella_woocommerce_setup', 1 );
add_action( 'init',               'rella_woocommerce_clear_cart_url' );

/**
 * Custom metaboxes for products in general tab
 * @see  rella_add_custom_general_fields()
 * @see  rella_add_custom_general_fields_save()
 */
add_action( 'woocommerce_product_options_general_product_data', 'rella_add_custom_general_fields' );
add_action( 'woocommerce_process_product_meta',                 'rella_add_custom_general_fields_save' );

add_filter( 'woocommerce_add_to_cart_fragments', 'rella_add_to_cart_fragments' );
add_filter( 'woocommerce_add_to_cart_fragments', 'rella_add_to_cart_amount' );
add_filter( 'woocommerce_add_to_cart_fragments', 'rella_add_to_cart_quickcart' );


function rella_add_to_cart_fragments( $fragments ) {

	ob_start();
?>
	<span class="badge header-cart-fragments"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
<?php

	$fragments['span.header-cart-fragments'] = ob_get_clean();
    return $fragments;

};

function rella_add_to_cart_amount( $fragments ) {

	ob_start();
?>
	<span class="header-cart-amount"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
<?php

	$fragments['span.header-cart-amount'] = ob_get_clean();
    return $fragments;

};

function rella_add_to_cart_quickcart( $fragments ) {

    ob_start();

?>

	<div class="header-quickcart"><?php rella_woocommerce_header_cart() ?></div>
    <?php $fragments['div.header-quickcart'] = ob_get_clean();

    return $fragments;

};


function rella_add_cart_single_ajax() {
	
	$product_id = $_POST['product_id'];
	$variation_id = $_POST['variation_id'];
	$quantity = $_POST['quantity'];

	if ($variation_id) {
		WC()->cart->add_to_cart( $product_id, $quantity, $variation_id );
	} else {
		WC()->cart->add_to_cart( $product_id, $quantity);
	}

	$items = WC()->cart->get_cart();
	global $woocommerce;
	$item_count = $woocommerce->cart->cart_contents_count; ?>

	<?php rella_woocommerce_header_cart() ?>

	<?php die();
}

add_action( 'wp_ajax_rella_add_cart_single', 'rella_add_cart_single_ajax' );
add_action( 'wp_ajax_nopriv_rella_add_cart_single', 'rella_add_cart_single_ajax' );