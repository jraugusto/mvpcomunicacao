<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$order_count = WC()->cart->get_cart_contents_count();
$is_empty    = WC()->cart->is_empty();
$sub_total   = WC()->cart->get_cart_subtotal();

?>
<span class="item-count" style="display:none;"><?php echo $order_count; ?></span>
<table class="header-cart-container">
	<thead class="header">
		<tr>
			<th class="product">
				<p>
					<?php esc_html_e( 'Your Cart', 'boo' ); ?>
					<span class="items-counter"><?php echo $order_count ?></span>
				</p>
			</th>
			<th>
				<div class="module-trigger module-trigger-inner">
					<button type="button" class="navbar-toggle module-toggle" aria-expanded="false">
						<span class="sr-only">
							<?php esc_html_e( 'Toggle navigation', 'boo' ); ?>
						</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
			</th>
		</tr>
	</thead>

    <tbody class="items-container">

		<?php if ( ! $is_empty ) : ?>

			<?php

				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
						$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
						$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
						$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
						?>
						<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'item mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
							<td class="product">
								<?php
								echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
									'<a href="%s" class="remove" title="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">&times;</a>',
									esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
									__( 'Remove this item', 'boo' ),
									esc_attr( $product_id ),
									esc_attr( $cart_item_key ),
									esc_attr( $_product->get_sku() )
								), $cart_item_key );
								?>
								<?php if ( ! $_product->is_visible() ) : ?>
									<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) ?>
									<?php echo $product_name ?>
								<?php else : ?>
									<a href="<?php echo esc_url( $product_permalink ); ?>">
										<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) ?>
										<?php echo $product_name ?>
									</a>
								<?php endif; ?>
		                    </td>
		                    <td class=counter>
		                        <span class="amount"><?php echo $product_price ?></span>
		                        <?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="qty quantity">x ' . $cart_item['quantity'] . '</span>', $cart_item, $cart_item_key ); ?>
		                    </td>
						</tr>
						<?php
					}
				}
			?>

		<?php else : ?>

			<tr class="empty"><td><?php esc_html_e( 'No products in the cart.', 'boo' ); ?></td></tr>

		<?php endif; ?>

	</tbody>
	<?php if ( ! $is_empty ) : ?>

		<tfoot>
            <tr>
                <td>
                    <h5><?php esc_html_e( 'Subtotal', 'boo' ); ?></h5>
                </td>
                <td class="counter">
                    <span class="amount"><?php echo $sub_total; ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="<?php echo esc_url( WC()->cart->get_checkout_url() ); ?>" class="button checkout"><span><?php esc_html_e( 'Checkout', 'boo' ); ?></span><i class="fa fa-angle-right"></i></a>
                </td>
            </tr>
        </tfoot>

	<?php endif; ?>

</table>
