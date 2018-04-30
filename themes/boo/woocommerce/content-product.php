<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$hover_img = '';
$hover_img_id = get_post_meta( $product->get_id(), 'product_product-secondary-image_thumbnail_id', true );
if( ! empty( $hover_img_id ) ) {
	
	$src = wp_get_attachment_image_src( $hover_img_id, 'full' );
	$resized_img = rella_get_resized_image_src( $src, 'rella-woo-elegant' );
	$retina_img  = rella_get_retina_image( $src[0], 'rella-woo-elegant' );
	$hover_img = '<div class="image-hover"><img src="' . esc_url( $resized_img ) . '" alt="" data-rjs="' . $retina_img . '" /></div>';

}

?>
<li <?php post_class(); ?>>

	<div class="product-image-container">
		<a href="<?php the_permalink(); ?>">
			<?php echo $hover_img; ?>
			<?php rella_the_post_thumbnail( 'rella-woo-elegant' ); ?>
		</a>
		<?php woocommerce_show_product_loop_sale_flash(); ?>
		<?php do_action( 'rella_woocommerce_loop_add_to_cart_elegant' );  ?>

	</div>
	
	<a class="woocommerce-LoopProduct-link" href="<?php the_permalink(); ?>">
		<h3><?php the_title(); ?></h3>
		<?php woocommerce_template_loop_price(); ?>
		<?php woocommerce_template_loop_rating(); ?>
	</a>
	
	<?php //Check if the plugin is active and add icon add-to-wishlist
		if ( class_exists( 'YITH_WCWL' ) ): 
			echo do_shortcode('[yith_wcwl_add_to_wishlist label="<i class=\'fa fa-heart\'></i>"]');
		endif; 
	?>
	<a href="<?php the_permalink(); ?>" class="product-zoom"><i class="fa fa-search"></i></a>
	
	<?php //Check if the plugin is active and add icon add-to-wishlist
		if ( class_exists( 'YITH_WCQV_Frontend' ) ): 
			echo do_shortcode('[yith_quick_view product_id="' . $product->get_id() . '" label="<i class=\'fa fa-eye\'></i>"]');
		endif; 
	?>



</li>