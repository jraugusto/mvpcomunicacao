<?php
	
// Enqueue Conditional Script
$this->scripts();

$style = $atts['style'];
$sub_style = $atts['item_style'];
$listing_gallery =	$atts['enable_gallery'];
$show_title = $atts['show_title'];
$stagger = $atts['enable_stagger'];

if( $stagger ) {
	$stagger_effect = 'data-stagger="true"';
} else {
	$stagger_effect = '';
}

// Locate the template and check if exists.
$located = locate_template( array(
	"templates/portfolio/tmpl-$style-$sub_style.php",
	"templates/portfolio/tmpl-$style.php"
) );
if ( ! $located ) {
	return;
}

// Build Query and check for posts
$the_query = new WP_Query( $this->build_query() );
if( !$the_query->have_posts() ) {
	return;
}

$this->grid_id = $grid_id = uniqid( 'grid-');

// The CSS
$this->generate_css();

// Container
echo '<div class="portfolio-grid '. $this->get_id() .'" data-plugin-portfolio="true">';

// Build Query
$GLOBALS['wp_query'] = $the_query;
$before = $after = '';

	// Include filter
	if( 'yes' === $atts['show_filter'] ) {
		$filter_located = locate_template( 'templates/portfolio/partial-filters.php' );
		include $filter_located;
	}

	if( in_array( $style, array( 'classic', 'grid', 'masonry', 'metro', 'packery' ) ) ) {
		printf( '<div id="%1$s" class="row items-container %1$s %2$s" %3$s>', $this->grid_id, $listing_gallery, $stagger_effect );
	}

	$this->add_loader();

	$this->add_excerpt_hooks();

	while( have_posts() ): the_post();

		$post_classes = array( 'portfolio-item', $this->get_class( $style ), $this->get_item_class( $sub_style ), $this->get_thumbs_classname(), $this->get_alignment(), $this->get_text_alignment(), $this->get_parallax(), $atts['color_type'], $atts['enable_rise'] );
		$post_classes = join( ' ', get_post_class( $post_classes, get_the_ID() ) );

		$attributes = array(
			'id' => 'post-' . get_the_ID(),
			'class' => $post_classes
		);

		echo $before;

			include $located;

		echo $after;

	endwhile;

	$this->remove_excerpt_hooks();

	if( in_array( $style, array( 'classic', 'grid', 'masonry', 'metro', 'packery' ) ) ) {
		printf( '</div><!-- /#%s -->', $this->grid_id );
	}

	// Pagination
	if( 'pagination' === $atts['pagination'] ) {

		// Set up paginated links.
        $links = paginate_links( array(
			'type' => 'array',
			'prev_next' => true,
			'prev_text' => '<span aria-hidden="true">' . __( '<i class="fa fa-angle-left"></i>', 'infinite-addons' ) . '</span>',
			'next_text' => '<span aria-hidden="true">' . __( '<i class="fa fa-angle-right"></i>', 'infinite-addons' ) . '</span>'
		));

		printf( '<div class="page-nav"><nav aria-label="Page navigation"><ul class="pagination"><li>%s</li></ul></nav></div>', join( "</li>\n\t<li>", $links ) );
	}

	if( in_array( $atts['pagination'], array( 'ajax1', 'ajax2', 'ajax3', 'ajax4' ) ) && $url = get_next_posts_page_link( $GLOBALS['wp_query']->max_num_pages ) ) {
		$hash = array(
			'ajax1' => 'btn btn-md ajax-load-more',
			'ajax2' => 'btn btn-md wide border-thick circle ajax-load-more ajax-load-more-alt text-uppercase',
			'ajax3' => 'btn btn-md ajax-load-more ajax-load-more-block',
			'ajax4' => 'btn btn-naked ajax-load-more ajax-load-more-huge'
		);

		$attributes = array(
			'href' => add_query_arg( 'ajaxify', '1', $url),
			'data-plugin-ajaxify' => true,
			'data-plugin-options' => json_encode( array(
				'wrapper' => '.portfolio-grid .items-container',
				'items' => '.portfolio-item'
			))
		);

		echo '<div class="page-nav page-ajax"><nav aria-label="Page navigation">';
		switch( $atts['pagination'] ) {

			case 'ajax1':
				$ajax_text = ! empty( $atts['ajax_text'] ) ? esc_html( $atts['ajax_text'] ) : esc_html__( 'More Stories', 'infinite-addons' );
				$attributes['class'] = 'btn btn-md ajax-load-more';
				printf( '<a%2$s><span>%1$s<i class="fa fa-angle-down"></i></span><i class="icon-arrows_clockwise loading-icon"></i></a>', $ajax_text, ra_helper()->html_attributes( $attributes ), $url );
				break;

			case 'ajax2':
				$ajax_text = ! empty( $atts['ajax_text'] ) ? esc_html( $atts['ajax_text'] ) : esc_html__( 'Load more', 'infinite-addons' );
				$attributes['class'] = 'btn btn-md wide border-thick circle ajax-load-more ajax-load-more-alt text-uppercase';
				printf( '<a%2$s><span>%1$s</span><i class="icon-arrows_clockwise loading-icon"></i></a>', $ajax_text, ra_helper()->html_attributes( $attributes ), $url );
				break;

			case 'ajax3':
				$ajax_text = ! empty( $atts['ajax_text'] ) ? esc_html( $atts['ajax_text'] ) : esc_html__( 'More Stories', 'infinite-addons' );
				$attributes['class'] = 'btn btn-md ajax-load-more ajax-load-more-block';
				printf( '<a%2$s><span>%1$s<i class="fa fa-angle-down"></i></span><i class="icon-arrows_clockwise loading-icon"></i></a>', $ajax_text, ra_helper()->html_attributes( $attributes ), $url );
				break;

			case 'ajax4':
				$ajax_text = ! empty( $atts['ajax_text'] ) ? esc_html( $atts['ajax_text'] ) : esc_html__( 'Read more stories', 'infinite-addons' );
				$attributes['class'] = 'btn btn-naked ajax-load-more ajax-load-more-huge';
				$attributes['data-fitText'] = true;
				$attributes['data-max-fontSize'] = '75px';
				printf( '<a%2$s><span>%1$s<i class="fa fa-angle-down"></i></span><i class="icon-arrows_clockwise loading-icon"></i></a>', $ajax_text, ra_helper()->html_attributes( $attributes ), $url );
				break;
		}

		echo '</nav></div>';
	}

wp_reset_query();

echo '</div>';