<?php

extract( $atts );

// Enqueue Conditional Script
$this->scripts();

// classes
$classes = array( $this->get_style( $template ), $el_class, $this->get_id() );

$grid_id = uniqid( 'grid-' );

// Query args
$args = array(
	'post_type'       => 'rella-portfolio',
	'posts_per_page'  => $posts_per_page,
	'paged'           => ra_helper()->get_paged()
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

	<?php $this->get_filter( $grid_id, 'list-unstyled list-inline text-uppercase' );  ?>
	<div id="<?php echo esc_attr( $grid_id ); ?>" class="masonry-grid clearfix">

<?php

	while( $portfolio_query->have_posts() ) : $portfolio_query->the_post();

	$size         = ! empty ( rella_helper()->get_option( '_portfolio_image_size' ) ) ? rella_helper()->get_option( '_portfolio_image_size' ) : 'rella-portfolio';
	$retina_image = wp_get_attachment_image_src( get_post_thumbnail_id(), $size . '@2x' );
	$col_size     = $this->get_col_size( $size );
	$item_classes = array( $col_size, 'masonry-item', $this->get_terms_class() );
	$main = $col_size == 'col-md-6 col-sm-12 col-xs-12' ? 'main' : '';

	$terms = wp_get_post_terms(get_the_ID(), 'rella-portfolio-category');
	$term_names = array();
	if (count($terms) > 0):
		foreach ($terms as $term):
			$term_names[] = $term->name;
		endforeach;
	endif;

?>
	<div class="<?php echo ra_helper()->sanitize_html_classes( $item_classes ) ?>">
		<div class="portfolio-item <?php echo $main; ?>">

			<figure class="portfolio-thumbnail">
				<?php the_post_thumbnail( $size, array( 'data-rjs' => $retina_image[0] ) ); ?>
			</figure>

			<div class="item-details">
				<h3><?php the_title(); ?></h3>
				<p class="subheading text-uppercase"><?php echo $term_names[0]; ?></p>

				<?php if ( $col_size == 'col-md-6 col-sm-12 col-xs-12' ) : ?>
					<?php ra_helper()->do_the_content( the_excerpt() ); ?>
				<?php endif; ?>

				<div>
					<?php $this->entry_lightbox(); ?>
					<a class="btn" href="<?php the_permalink(); ?>"><span class="fa fa-link"></span></a>
				</div>
			</div>

		</div><!--//.portfolio-item-->
	</div><!--//.masonry-item-->

<?php

	endwhile;
	wp_reset_query();

?>

	</div><!--//.masonry-grid-->
</div><!--//.portfolio-->