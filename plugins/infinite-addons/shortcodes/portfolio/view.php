<?php

extract( $atts );

// Enqueue Conditional Script
$this->scripts();

// classes
$classes = array( $this->get_style( $template ), $el_class, $this->get_id() );

$grid_id = uniqid( 'grid-' ); 

// Query args
$args = array(
	'post_type'      => 'rella-portfolio',
	'posts_per_page' => $posts_per_page,
	'paged'          => ra_helper()->get_paged()
);

if( $taxonomies ) {
	
	$cats_tax = explode( ',', $taxonomies );
	if ( is_array( $cats_tax ) && count( $cats_tax ) == 1 ) {
		$cats_tax = array_shift( $cats_tax );
	}

	$args['tax_query'] = array(
		array(
			'taxonomy'  => 'rella-portfolio-category',
			'field'    => 'slug',
			'terms'    => $cats_tax
		));
}

if ( ! empty( $exclude_posts ) ) {
	$exclude_posts_arr = explode( ',', $exclude_posts );
	if ( is_array( $exclude_posts_arr ) && count( $exclude_posts_arr ) > 0 ) {
		$args['post__not_in'] = array_map( 'intval', $exclude_posts_arr );
	}
}

$portfolio_query = new WP_Query( $args );

if ( !$portfolio_query->have_posts() ) {
	return '';
}

?>
<div class="portfolio <?php echo ra_helper()->sanitize_html_classes( $classes ) ?>" <?php $this->get_data_plugin(); ?> id="<?php echo $this->get_id(); ?>">

	<?php $this->get_filter( $grid_id );  ?>
	<div id="<?php echo esc_attr( $grid_id ); ?>" class="masonry-grid clearfix">

<?php

	while( $portfolio_query->have_posts() ) : $portfolio_query->the_post();
	
	$size         = ! empty ( rella_helper()->get_option( '_portfolio_image_size' ) ) ? rella_helper()->get_option( '_portfolio_image_size' ) : 'rella-portfolio';

	$col_size     = $this->get_col_size( $size );
	$item_classes = array( $col_size, 'masonry-item', $this->get_terms_class() );

?>
	<div class="<?php echo ra_helper()->sanitize_html_classes( $item_classes ) ?>">
		<div class="portfolio-item">
			
			<figure class="portfolio-thumbnail">
				<?php rella_the_post_thumbnail( $size ); ?>
			</figure>

			<div class="item-details">
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			</div>
			
		</div><!--//.portfolio-item-->
	</div><!--//.masonry-item-->

<?php	

	endwhile;
	wp_reset_query();

?>		

	</div><!--//.masonry-grid-->
</div><!--//.portfolio-->