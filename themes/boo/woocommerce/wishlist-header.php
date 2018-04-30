<?php

$item_count = count( $wishlist_items );

$browse_wishlist_text = get_option( 'yith_wcwl_browse_wishlist_text' );
$browse_wishlist_text = $browse_wishlist_text ? $browse_wishlist_text : esc_html__( 'View All', 'boo' );

global $rella_header_wishlist_trigger_size;

?>
<div class="header-module module-wishlist">

	<span class="module-trigger <?php echo $rella_header_wishlist_trigger_size ?>">
		<i class="icon-heart"><span class="badge"><?php echo $item_count ?></span></i>
	</span><!-- /.module-trigger -->

	<div class="module-container">

		<table class="header-wishlist-container">
			
				<thead class="header">
					<tr>
						<th class="product">
							<p>
								<span class="items-counter"><?php echo $item_count ?></span>
								<?php esc_html_e( 'items in your wishlist', 'boo' ); ?>
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

				<?php if( $item_count > 0 ) : ?>

					<?php

						foreach( $wishlist_items as $item ) :
		
			                global $product;
			                
			                $item['prod_id'] = yit_wpml_object_id ( $item['prod_id'], 'product', true );
			
							if( function_exists( 'wc_get_product' ) ) {
					            $product = wc_get_product( $item['prod_id'] );
				            }
				            else{
					            $product = get_product( $item['prod_id'] );
				            }
			
							if( $product && $product->exists() ) :
		
					?>
	
						<tr>
							<td class="product">
								<a href="<?php echo esc_url( add_query_arg( 'remove_from_wishlist', $item['prod_id'] ) ) ?>" class="remove">&times;</a>
								<a href="<?php echo esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $item['prod_id'] ) ) ) ?>">
									<?php echo $product->get_image() ?>
									<?php echo apply_filters( 'woocommerce_in_cartproduct_obj_title', $product->get_title(), $product ) ?>
								</a>
							</td>
							<td class="counter">
								<span class="amount"><?php echo $product->get_price() ? $product->get_price_html() : apply_filters( 'yith_free_text', esc_html__( 'Free!', 'boo' ) ); ?></span>
							</td>
						</tr>
	
					<?php endif; ?>
					
					<?php endforeach; ?>
					
				<?php else: ?>
				
					<tr class="empty"><td><?php esc_html_e( 'No products in the wishlist', 'boo' ); ?></td></tr>
				
				<?php endif; ?>
					
				</tbody>
				
				<?php if( $item_count > 0 ) : ?>
				<tfoot>
		            <tr>
		                <td>
		                    <a href="<?php echo esc_url( YITH_WCWL()->get_wishlist_url() ) ?>" class="btn btn-xsm btn-solid btn-block view-all weight-bold text-uppercase"><span><?php echo apply_filters( 'yith-wcwl-browse-wishlist-label', $browse_wishlist_text )?><i class="fa fa-angle-right"></i></span></a>
		                </td>
		            </tr>
		        </tfoot>
		        <?php endif; ?>

		</table><!-- /.header-wishlist-container -->

	</div><!-- /.module-container -->

</div><!-- /.module-wishlist -->