<?php

global $rella_header_wishlist_trigger_size;

$rella_header_wishlist_trigger_size = $atts['trigger_size'];

add_filter( 'yith_wcwl_wishlist_params', array( $this, 'change_view' ) );

	echo do_shortcode( '[yith_wcwl_wishlist]' );

remove_filter( 'yith_wcwl_wishlist_params', array( $this, 'change_view' ) );