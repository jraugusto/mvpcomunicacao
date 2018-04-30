<?php

// Enqueue Conditional Script
$this->scripts();

$style = $atts['style'];

// check
$located = locate_template( "templates/blog/tmpl-$style.php" );
if ( ! file_exists( $located ) ) {
	return;
}

$ajax_wrapper = '';

if( ! empty( $atts['unique_id'] ) ) {
	$unique_id = $atts['unique_id'];
	$ajax_wrapper = '.' . $unique_id;
}

echo '<div class="blog-posts ' . $unique_id . ' ' . $style . '">';

// Build Query
$GLOBALS['wp_query'] = new WP_Query( $this->build_query() );
$before = $after = $count_bar = '';


	if( in_array( $style, array( 'default', 'classic-date-featured', 'classic-image-large', 'classic-image-large-alt', 'classic-image-medium', 'classic-image-medium-alt', 'no-image', 'split', 'featured-title', 'only-title' ) ) ) {
		echo '<div class="row">';
		$before = '<div class="col-xs-12">';
		$after  = '</div>';
	}

	if( 'featured-posts' === $style ) {
		echo '<div class="row">';
		$before     = '<div class="col-lg-6 col-md-12">';
		$after      = '</div>';
		$large_post = 1;
	}

	if( 'featured-post-sm' === $style ) {
		echo '<div class="row no-margin">';
		$before     = '<div class="col-lg-2 col-md-4 col-sm-6 no-padding">';
		$after      = '</div>';
	}

	if( 'featured-posts-alt' === $style ) {
		echo '<div class="row no-margin">';
		$before     = '<div class="col-md-4 no-padding">';
		$after      = '</div>';
	}

	if( 'grid' === $style || 'classic-image-featured-alt' === $style ) {
		echo '<div class="row">';
		$before = '<div class="' . $this->get_grid_class() . '">';
		$after  = '</div>';
	}

	if( 'puzzle' === $style ) {
		echo '<div class="row no-margin">';
		$before = '<div class="col-md-6 no-padding">';
		$after  = '</div>';
	}

	if( 'timeline' === $style ) {
		$before = '<div class="col-md-5 col-sm-12 masonry-item">';
		$after  = '</div>';
		// Initialize the time stamps for timeline month/year check
		$post_count          = 1;
		$prev_post_timestamp = null;
		$prev_post_month     = null;
		$prev_post_year      = null;
		$count_bar           = 1;
		$middle_bar          = '<div class="col-md-2 mid-bar masonry-item"></div>';

	}

	if( 'masonry' === $style || 'masonry-creative' === $style ) {
		echo '<div class="row" data-plugin-masonry="true">';
		$before = '<div class="col-md-4 col-sm-6 col-xs-12 masonry-item">';
		$after  = '</div>';
	}

	while( have_posts() ): the_post();
		$count_bar++;
		$post_classes = array( 'blog-post', $this->get_class( $style ) );
		$post_classes = join( ' ', get_post_class( $post_classes, get_the_ID() ) );

		$attributes = array(
			'id'    => 'post-' . get_the_ID(),
			'class' => $post_classes
		);

		if( 'featured-posts' === $style ) {
			if( $large_post > 1 ) {
				$before = '<div class="col-lg-3 col-sm-6">';
			}
			$large_post++;
		}

		if( 'featured-posts-alt' === $style ) {
			$attributes['data-hover3d'] = 'true';
		}

		if( 'classic-image-large' === $style ) {
			$attributes['class'] = $attributes['class'] . ' post-image-large';
		}

		if( 'puzzle' === $style ) {
			$attributes['data-mh'] = 'post-puzzle';
		}

		if( 'timeline' === $style ) {
			$post_timestamp = get_the_time( 'U' );
			$post_month     = date( 'n', $post_timestamp );
			$post_year      = get_the_date( 'Y' );

			// Set the timeline month label
			if ( $prev_post_month != $post_month ||
				 $prev_post_year != $post_year
			) {

				if ( $post_count > 1 ) {
					echo '</div>';
				}
				$count_bar = 1;
				printf( '<div class="row timeline-row" data-plugin-masonry="true"><time class="timeline-date" datatime="' . get_the_date( 'Y-m-d' ) . '"><span>%s</span><div class="loader"><div class="loader-inner"></div></div></time>', get_the_date( 'M Y' ) );
			}
		}

		if( 'masonry-creative' === $style ) {
			$width  = get_post_meta( get_the_ID(), 'post-width', true );
			$width  = $width ? $width : 'col-md-3';
			$before = sprintf( '<div class="%s col-sm-6 col-xs-12 masonry-item no-padding">', $width );

			$height = get_post_meta( get_the_ID(), 'post-height', true );
			$height = $height ? $height : 'default';
			$attributes['data-mh'] = $height;

			if( 'tall' == $height ) {
				$attributes['class'] = $attributes['class'] . ' tall';
			}
		}

		echo $before;

		printf( '<article%s>', ra_helper()->html_attributes( $attributes ) );

			if( 'quote' === get_post_format() ) {
				$quote_located = locate_template( 'templates/blog/format-quote.php' );
				include $quote_located;
			}
			else {
				include $located;
			}

		echo '</article>';

		echo $after;

		// Adjust the timestamp settings for next loop
		if( 'timeline' === $style ) {
			$prev_post_timestamp = $post_timestamp;
			$prev_post_month     = $post_month;
			$prev_post_year      = $post_year;
			$post_count++;
			if ( $count_bar == 1 ) {
				echo $middle_bar;
			}
		}

	endwhile;

	if( in_array( $style, array('default','classic-date-featured','classic-image-large', 'classic-image-featured-alt', 'classic-image-large-alt', 'classic-image-medium', 'classic-image-medium-alt', 'no-image','split','featured-title', 'featured-posts', 'featured-posts-alt', 'featured-post-sm', 'only-title' ) ) ) {
		echo '</div>';
	}

	if ( 'timeline' === $style && $post_count > 1 ) {
		echo '</div>';
	}

	if( 'grid' === $style || 'puzzle' === $style || 'masonry' === $style || 'masonry-creative' === $style ) {
		echo '</div>';
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

		if( !empty( $links ) ) {
			printf( '<div class="page-nav"><nav aria-label="Page navigation"><ul class="pagination"><li>%s</li></ul></nav></div>', join( "</li>\n\t<li>", $links ) );
		}
	}

	if( in_array( $atts['pagination'], array( 'ajax1', 'ajax2', 'ajax3', 'ajax4', 'ajax5', 'ajax6' ) ) && $url = get_next_posts_page_link( $GLOBALS['wp_query']->max_num_pages ) ) {
		$hash = array(
			'ajax1' => 'btn btn-md ajax-load-more',
			'ajax2' => 'btn btn-md wide border-thick circle ajax-load-more ajax-load-more-alt text-uppercase',
			'ajax3' => 'btn btn-md ajax-load-more ajax-load-more-block',
			'ajax4' => 'btn btn-naked ajax-load-more ajax-load-more-huge',
			'ajax5' => 'btn btn-md btn-block btn-linear ajax-load-more blog-load-more blog-load-more-block',
			'ajax6' => 'btn btn-md btn-block btn-solid ajax-load-more blog-load-more blog-load-more-block',
		);

		$attributes = array(
			'href' => add_query_arg( 'ajaxify', '1', $url),
			'data-plugin-ajaxify' => true,
			'data-plugin-options' => json_encode( array(
				'wrapper' => 'timeline' === $style ? '.blog-posts' . $ajax_wrapper : '.blog-posts' . $ajax_wrapper . ' > .row',
				'items' => 'timeline' === $style ? '.timeline-row' : '.blog-post'
			))
		);

		echo '<div class="page-nav page-ajax"><nav aria-label="Page navigation">';
		switch( $atts['pagination'] ) {

			case 'ajax1':
				$attributes['class'] = 'btn btn-md ajax-load-more';
				printf( '<a%2$s><span>%1$s<i class="fa fa-angle-down"></i></span><i class="icon-arrows_clockwise loading-icon"></i></a>', esc_html( $atts['ajax_label'] ), ra_helper()->html_attributes( $attributes ), $url );
				break;

			case 'ajax2':
				$attributes['class'] = 'btn btn-md wide border-thick circle ajax-load-more ajax-load-more-alt text-uppercase';
				printf( '<a%2$s><span>%1$s</span><i class="icon-arrows_clockwise loading-icon"></i></a>', esc_html( $atts['ajax_label'] ), ra_helper()->html_attributes( $attributes ), $url );
				break;

			case 'ajax3':
				$attributes['class'] = 'btn btn-md ajax-load-more ajax-load-more-block';
				printf( '<a%2$s><span>%1$s<i class="fa fa-angle-down"></i></span><i class="icon-arrows_clockwise loading-icon"></i></a>', esc_html( $atts['ajax_label'] ), ra_helper()->html_attributes( $attributes ), $url );
				break;

			case 'ajax4':
				$attributes['class'] = 'btn btn-naked ajax-load-more ajax-load-more-huge';
				$attributes['data-fitText'] = true;
				$attributes['data-max-fontSize'] = '75px';
				printf( '<a%2$s><span>%1$s<i class="fa fa-angle-down"></i></span><i class="icon-arrows_clockwise loading-icon"></i></a>', esc_html( $atts['ajax_label'] ), ra_helper()->html_attributes( $attributes ), $url );
				break;

			case 'ajax5':
				$attributes['class'] = 'btn btn-md btn-block btn-linear ajax-load-more blog-load-more blog-load-more-block';
				printf( '<a%2$s><span>%1$s<i class="fa fa-angle-down"></i></span><i class="icon-arrows_clockwise loading-icon"></i></a>', esc_html( $atts['ajax_label'] ), ra_helper()->html_attributes( $attributes ), $url );
				break;

			case 'ajax6':
				$attributes['class'] = 'btn btn-md btn-block btn-solid ajax-load-more blog-load-more blog-load-more-block';
				printf( '<a%2$s><span>%1$s<i class="fa fa-angle-down"></i></span><i class="icon-arrows_clockwise loading-icon"></i></a>', esc_html( $atts['ajax_label'] ), ra_helper()->html_attributes( $attributes ), $url );
				break;
		}

		echo '</nav></div>';
	}

wp_reset_query();

echo '</div>';
