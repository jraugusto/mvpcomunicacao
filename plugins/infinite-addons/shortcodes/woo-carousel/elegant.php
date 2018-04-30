<?php

global $wpdb, $product;

// check
if( ! rella_helper()->is_woocommerce_active() ) {
	return;
}

extract( $atts );
// Enqueue Conditional Script
$this->scripts();
// classes
$classes = array( $this->get_class( $style ), $el_class, $this->get_id() );

//query args
$args = array(
	'posts_per_page' => intval( $limit ) ? intval( $limit ) : '6',
	'offset'         => 0,
	'orderby'        => 'date',
	'order'          => 'DESC',
	'include'        => '',
	'exclude'        => '',
	'meta_key'       => '',
	'meta_value'     => '',
	'post_type'      => 'product',
	'post_mime_type' => '',
	'post_parent'    => '',
	'paged'          => 1,
	'post_status'    => 'publish',
);

if ( ! empty( $taxonomies ) ) {

	$cats_tax = explode( ',', $taxonomies );
	if ( is_array( $cats_tax ) && count( $cats_tax ) == 1 ) {
		$cats_tax = array_shift( $cats_tax );
	}
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'product_cat',
			'field'    => 'slug',
			'terms'    => $cats_tax
		)
	);
}

$shop_query = new WP_Query( $args );

if( !$shop_query->have_posts() ) {
	return '';
}

?>
<div class="<?php echo ra_helper()->sanitize_html_classes( $classes ) ?>" id="<?php echo $this->get_id() ?>">
	<?php echo $this->get_navigation(); ?>
	<div class="product-elegant<?php if( 's4' == $style ){ echo '-alt'; } ?>">
		<ul class="products carousel-items">
		<?php
	
			while ( $shop_query->have_posts() ) :
	
				$shop_query->the_post();
	
				$product = new WC_Product( get_the_ID() );
		
				if ( function_exists( 'wc_get_template_part' ) ):
	
					wc_get_template_part( 'content', 'product-elegant' );
	
				endif;
	
			endwhile; // end of the loop.
	
			wp_reset_postdata();
	
		?>
		</ul>
	</div>
</div><!-- /.product-hover-shadow -->