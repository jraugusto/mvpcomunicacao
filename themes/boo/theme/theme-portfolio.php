<?php
/**
 * Theme Blog class for blog posts page and blog archives
 */

class ThemePortfolio extends RA_PortfolioListing {
	
	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {
	
		$this->atts = array(
			'style'             => rella_helper()->get_option( 'portfolio-style' ),
			'item_style'        => rella_helper()->get_option( 'portfolio-items-style' ),
			'content_alignment' => rella_helper()->get_option( 'portfolio-content-alignment' ),
			'text_alignment'    => rella_helper()->get_option( 'portfolio-text-alignment' ),
			'grid_columns'      => rella_helper()->get_option( 'portfolio-grid-columns' ),
			'columns_gap'       => rella_helper()->get_option( 'portfolio-columns-gap' ),

			'show_title'        => ( 'on' === rella_helper()->get_option( 'portfolio-show-title' ) ? true : '' ),
			'show_summary'      => ( 'on' === rella_helper()->get_option( 'portfolio-show-summary' ) ? true : '' ),
			'show_category'     => ( 'on' === rella_helper()->get_option( 'portfolio-show-category' ) ? true : '' ),
			'show_one_category' => ( 'on' === rella_helper()->get_option( 'portfolio-show-one-category' ) ? true : '' ),
			'show_like'         => ( 'on' === rella_helper()->get_option( 'portfolio-show-like' ) ? true : '' ),
			'show_client'       => ( 'on' === rella_helper()->get_option( 'portfolio-show-client' ) ? true : '' ),
			'show_date'         => ( 'on' === rella_helper()->get_option( 'portfolio-show-date' ) ? true : '' ),
			'show_link'         => ( 'on' === rella_helper()->get_option( 'portfolio-show-link' ) ? true : '' ),
			'show_ext_link'     => ( 'on' === rella_helper()->get_option( 'portfolio-show-ext-link' ) ? true : '' ),
			'show_share'        => ( 'on' === rella_helper()->get_option( 'portfolio-show-share' ) ? true : '' ),
			'show_lightbox'     => ( 'on' === rella_helper()->get_option( 'portfolio-show-lightbox' ) ? true : '' ),
			'enable_panr'       => ( 'on' === rella_helper()->get_option( 'portfolio-enable-panr' ) ? true : '' ),
			
			'enable_ext'        => ( 'on' === rella_helper()->get_option( 'portfolio-enable-ext' ) ? true : '' ),
			
			'disable_postformat' => rella_helper()->get_option( 'portfolio-disable-postformat' ),
			'enable_parallax'    => rella_helper()->get_option( 'portfolio-enable-parallax' ),
			'enable_rise'        => rella_helper()->get_option( 'portfolio-enable-rise' ),
			'enable_loader'      => rella_helper()->get_option( 'portfolio-enable-loader' ),
			
			'post_excerpt'       => rella_helper()->get_option( 'portfolio-excerpt-length' ),

			'pagination'    => 'pagination',
			'css_animation' => 'none',
			
		);

		$this->render( $this->atts );

		wp_enqueue_script( 'flickity' );
	}

	/**
	 * [render description]
	 * @method render
	 * @return [type] [description]
	 */
	public function render( $atts, $content = '' ) {
	
		extract( $atts );
		
		$sub_style = $item_style;
		
		// Locate the template and check if exists.
		$located = locate_template( array(
			"templates/portfolio/tmpl-$style-$sub_style.php",
			"templates/portfolio/tmpl-$style.php"
		) );
		if ( ! $located ) {
			return;
		}

		$this->grid_id = $grid_id = uniqid( 'grid-');
		
		// Container
		echo '<div class="portfolio-grid '. $this->get_id() .'" data-plugin-portfolio="true">';
		
		$before = $after = '';

		if( in_array( $style, array( 'classic', 'grid', 'masonry', 'metro', 'packery' ) ) ) {
			printf( '<div id="%1$s" class="row items-container %1$s">', $this->grid_id );
		}
	
		$this->add_loader();
	
		$this->add_excerpt_hooks();
		
		while( have_posts() ): the_post();
	
			$post_classes = array( 'portfolio-item', $this->get_class( $style ), $this->get_item_class( $sub_style ), $this->get_thumbs_classname(), $this->get_alignment(), $this->get_text_alignment(), $this->get_parallax(), $atts['enable_rise'] );
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
				'prev_text' => '<span aria-hidden="true">' . wp_kses_post( __( '<i class="fa fa-angle-left"></i>', 'boo' ) ) . '</span>',
				'next_text' => '<span aria-hidden="true">' . wp_kses_post( __( '<i class="fa fa-angle-right"></i>', 'boo' ) ) . '</span>'
			));
			
			if( ! empty( $links ) ) {
				printf( '<div class="page-nav"><nav aria-label="Page navigation"><ul class="pagination"><li>%s</li></ul></nav></div>', join( "</li>\n\t<li>", $links ) );
			}
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
					$ajax_text = ! empty( $atts['ajax_text'] ) ? esc_html( $atts['ajax_text'] ) : esc_html__( 'More Stories', 'boo' );
					$attributes['class'] = 'btn btn-md ajax-load-more';
					printf( '<a%2$s><span>%1$s<i class="fa fa-angle-down"></i></span><i class="icon-arrows_clockwise loading-icon"></i></a>', $ajax_text, ra_helper()->html_attributes( $attributes ), $url );
					break;
	
				case 'ajax2':
					$ajax_text = ! empty( $atts['ajax_text'] ) ? esc_html( $atts['ajax_text'] ) : esc_html__( 'Load more', 'boo' );
					$attributes['class'] = 'btn btn-md wide border-thick circle ajax-load-more ajax-load-more-alt text-uppercase';
					printf( '<a%2$s><span>%1$s</span><i class="icon-arrows_clockwise loading-icon"></i></a>', $ajax_text, ra_helper()->html_attributes( $attributes ), $url );
					break;
	
				case 'ajax3':
					$ajax_text = ! empty( $atts['ajax_text'] ) ? esc_html( $atts['ajax_text'] ) : esc_html__( 'More Stories', 'boo' );
					$attributes['class'] = 'btn btn-md ajax-load-more ajax-load-more-block';
					printf( '<a%2$s><span>%1$s<i class="fa fa-angle-down"></i></span><i class="icon-arrows_clockwise loading-icon"></i></a>', $ajax_text, ra_helper()->html_attributes( $attributes ), $url );
					break;
	
				case 'ajax4':
					$ajax_text = ! empty( $atts['ajax_text'] ) ? esc_html( $atts['ajax_text'] ) : esc_html__( 'Read more stories', 'boo' );
					$attributes['class'] = 'btn btn-naked ajax-load-more ajax-load-more-huge';
					$attributes['data-fitText'] = true;
					$attributes['data-max-fontSize'] = '75px';
					printf( '<a%2$s><span>%1$s<i class="fa fa-angle-down"></i></span><i class="icon-arrows_clockwise loading-icon"></i></a>', $ajax_text, ra_helper()->html_attributes( $attributes ), $url );
					break;
			}
	
			echo '</nav></div>';
		}

		echo '</div>';
	}	
}
new ThemePortfolio;