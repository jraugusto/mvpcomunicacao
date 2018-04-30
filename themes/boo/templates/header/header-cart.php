<?php

// check
if( ! rella_helper()->is_woocommerce_active() || is_admin() ) {
	return;
}

$order_count = WC()->cart->get_cart_contents_count();
$is_empty    = WC()->cart->is_empty();
$sub_total   = WC()->cart->get_cart_subtotal();

$icon_opts = rella_get_icon( $atts );
$icon      = ! empty( $icon_opts['type'] ) && ! empty( $icon_opts['icon'] ) ? $icon_opts['icon'] : 'icon-flaticon-shopping-bag2';
$style     = ! empty( $icon_opts['color'] ) ? sprintf( ' style="color:%s;"', $icon_opts['color'] ) : '';

?>
<div class="header-module module-cart <?php echo esc_attr( $atts['badge_style'] ) ?>">
	<span class="module-trigger <?php echo esc_attr( $atts['trigger_size'] ) ?>">
	<i class="<?php echo $icon ?>"
	<?php echo $style ?>><?php if( 'hide' !== $atts['count_visibility'] ) {
		printf( '<span class="badge header-cart-fragments">%d</span>', $order_count );
	}?></i>
	<?php
		if ( 'hide' !== $atts['amount_visibility'] ) {
			printf( ' <span class="header-cart-amount" %s>%s</span>', $style, $sub_total );
		}
	?>
	</span>
	<div class="module-container">
		<div class="header-quickcart">
			<?php rella_woocommerce_header_cart() ?>
		</div>
	</div>
</div>
