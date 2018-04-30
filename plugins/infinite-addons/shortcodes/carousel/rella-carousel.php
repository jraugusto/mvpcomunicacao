<?php
/**
* Shortcode Carousel
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Carousel extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug         = 'ra_carousel';
		$this->title        = esc_html__( 'Carousel', 'infinite-addons' );
		$this->icon         = 'fa fa-square';
		$this->description  = esc_html__( 'Create a carousel.', 'infinite-addons' );
		$this->is_container = true;
		$this->scripts      = 'flickity';
		$this->styles       = array( 'flickity', 'rella-sc-carousel', 'rella-sc-button' );

		parent::__construct();
	}

	public function get_params() {

		$options = array(

			array(
				'type'        => 'subheading',
				'heading'     => esc_html__( 'Layout', 'infinite-addons' ),
				'param_name'  => 'sh_layout',
			),

			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Initial Index', 'infinite-addons' ),
				'description' => esc_html__( 'Zero-based index of the initial selected cell.', 'infinite-addons' ),
				'param_name'  => 'initialindex',
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Cell Align', 'infinite-addons' ),
				'description' => esc_html__( 'Align cells within the carousel element.', 'infinite-addons' ),
				'param_name'  => 'cellalign',
				'value'       => array(
					esc_html__( 'Center', 'infinite-addons' ) => 'center',
					esc_Html__( 'Left', 'infinite-addons' )   => 'left',
					esc_html__( 'Right', 'infinite-addons' )  => 'right',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Contain', 'infinite-addons' ),
				'description' => esc_html__( 'Contains cells to carousel element to prevent excess scroll at beginning or end. Has no effect if wrapAround: true', 'infinite-addons' ),
				'param_name'  => 'contain',
				'value'       => array(
					esc_html__( 'No', 'infinite-addons' )  => '',
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Group Cells', 'infinite-addons' ),
				'description' => esc_html__( 'Groups cells together in slides. Flicking, page dots, and previous/next buttons are mapped to group slides, not individual cells.', 'infinite-addons' ),
				'param_name'  => 'groupcells',
				'value'       => array(
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes',
					esc_html__( 'No', 'infinite-addons' )  => 'no'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'groupcellscustom',
				'heading'     => esc_html__( 'Number or Percent', 'infinite-addons' ),
				'description' => esc_html__( 'If set to a number, group cells by that number, if set to a percent string, group cells that fit in the percent of the width of the carousel viewport ex. 3 or 80%', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'groupcells',
					'value' => 'yes',
				),
			),


			array(
				'type'        => 'subheading',
				'heading'     => esc_html__( 'Navigation', 'infinite-addons' ),
				'param_name'  => 'sh_nav',
			),

			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Navigation', 'infinite-addons' ),
				'description' => esc_html__( 'Creates and enables previous & next buttons.', 'infinite-addons' ),
				'param_name'  => 'prevnextbuttons',
				'value'       => array(
					esc_html__( 'No', 'infinite-addons' )  => '',
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Pagination', 'infinite-addons' ),
				'description' => esc_html__( 'Create and enable page dots.', 'infinite-addons' ),
				'param_name'  => 'pagedots',
				'value'       => array(
					esc_html__( 'No', 'infinite-addons' )  => '',
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Align page dots', 'infinite-addons' ),
				'description' => esc_html__( 'Select alignment for page dots', 'infinite-addons' ),
				'param_name'  => 'align_dots',
				'value'       => array(
					esc_html__( 'Default', 'infinite-addons' ) => '',
					esc_html__( 'Left', 'infinite-addons' )    => 'dots-pushed-left',
					esc_html__( 'Right', 'infinite-addons' )   => 'dots-pushed-right'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'  => array(
					'element' => 'pagedots',
					'value'   => 'yes'
				)
			),

			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Size page dots', 'infinite-addons' ),
				'description' => esc_html__( 'Select size for page dots', 'infinite-addons' ),
				'param_name'  => 'size_dots',
				'value'       => array(
					esc_html__( 'Default', 'infinite-addons' )  => '',
					esc_html__( 'Small' )          => 'dots-sm',
					esc_html__( 'Medium' )         => 'dots-md',
					esc_html__( 'Large' )          => 'dots-lg',
				),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'pagedots',
					'value'   => 'yes'
				)
			),

			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Autoplay', 'infinite-addons' ),
				'description' => esc_html__( 'Automatically advances to the next cell.', 'infinite-addons' ),
				'param_name'  => 'autoplay',
				'value'       => array(
					esc_html__( 'No', 'infinite-addons' )  => '',
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Autoplay time', 'infinite-addons' ),
				'description' => esc_html__( 'i.e. 1500 will advance cells every 1.5 seconds.', 'infinite-addons' ),
				'param_name'  => 'autoplaytime',
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'  => array(
					'element' => 'autoplay',
					'value'   => array( 'yes' )
				)
			),

			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Pause AutoPlay On Hover', 'infinite-addons' ),
				'description' => esc_html__( 'Auto play pause when user hovers over carousel', 'infinite-addons' ),
				'param_name'  => 'pauseautoplayonhover',
				'value'       => array(
					esc_html__( 'No', 'infinite-addons' )  => 'no',
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'  => array(
					'element' => 'autoplay',
					'value'   => array( 'yes' )
				)
			),

			array(
				'type'        => 'subheading',
				'heading'     => esc_html__( 'Behavior', 'infinite-addons' ),
				'param_name'  => 'sh_behavior',
			),

			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Draggable', 'infinite-addons' ),
				'description' => esc_html__( 'Enables dragging and flicking.', 'infinite-addons' ),
				'param_name'  => 'draggable',
				'value'       => array(
					esc_html__( 'Yes', 'infinite-addons' ) => '',
					esc_html__( 'No', 'infinite-addons' )  => 'no'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Free Scroll', 'infinite-addons' ),
				'description' => esc_html__( 'Enables content to be freely scrolled.', 'infinite-addons' ),
				'param_name'  => 'freescroll',
				'value'       => array(
					esc_html__( 'No', 'infinite-addons' )  => '',
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Wrap Around', 'infinite-addons' ),
				'description' => esc_html__( 'Wrap around for infinite scrolling.', 'infinite-addons' ),
				'param_name'  => 'wraparound',
				'value'       => array(
					esc_html__( 'No', 'infinite-addons' )  => '',
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Adaptive Height', 'infinite-addons' ),
				'description' => esc_html__( 'Changes height of carousel to fit height of selected slide.', 'infinite-addons' ),
				'param_name'  => 'adaptiveheight',
				'value'       => array(
					esc_html__( 'No', 'infinite-addons' )  => '',
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'subheading',
				'heading'     => esc_html__( 'Lazy Load', 'infinite-addons' ),
				'param_name'  => 'sh_lazy',
			),

			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'LazyLoad', 'infinite-addons' ),
				'description' => esc_html__( 'Set a number to load images in adjacent cells.', 'infinite-addons' ),
				'param_name'  => 'lazyload',
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Background LazyLoad', 'infinite-addons' ),
				'description' => esc_html__( 'Set a number to load background 7images in adjacent cells.', 'infinite-addons' ),
				'param_name'  => 'bglazyload',
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'subheading',
				'heading'     => esc_html__( 'Others', 'infinite-addons' ),
				'param_name'  => 'sh_others',
			),

			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Random vertical offset', 'infinite-addons' ),
				'description' => esc_html__( 'Add random vertical offset to the carousel items', 'infinite-addons' ),
				'param_name'  => 'random_v_offset',
				'value'       => array(
					esc_html__( 'No', 'infinite-addons' )  => '',
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Show "Swipe" hint', 'infinite-addons' ),
				'param_name'  => 'swipe_hint',
				'value'       => array(
					esc_html__( 'No', 'infinite-addons' )  => '',
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),


		);
		foreach( $options as &$param ) {
			$param['group'] = esc_html__( 'Carousel Options', 'infinite-addons' );
		}

		$design = array(

			array(
				'type'       => 'colorpicker',
				'param_name' => 'dot_color',
				'heading'    => esc_html__( 'Page dot color', 'infinite-addons' ),
				'edit_field_class' => 'vc_column-with-padding vc_col-sm-6'
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'dot_color_active',
				'heading'    => esc_html__( 'Active page dot color', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),
		);
		foreach( $design as &$param ) {
			$param['group'] = esc_html__( 'Design Options', 'infinite-addons' );
		}

		$this->params = array_merge( array(

			// Params goes here
			array(
				'type'        => 'dropdown',
				'param_name'  => 'style',
				'heading'     => esc_html__( 'Style', 'infinite-addons' ),
				'value'       => array(
					esc_html__( 'Style1' )	=> 's1',
					esc_html__( 'Style2' )	=> 's2',
					esc_html__( 'Style3' )	=> 's3',
					esc_html__( 'Style4' )	=> 's4',
					esc_html__( 'Style5' )	=> 's5',
					esc_html__( 'Style6' )	=> 's6',
					esc_html__( 'Style7' )	=> 's7',
					esc_html__( 'Style8' )	=> 's8',
					esc_html__( 'Style9' )	=> 's9',
					esc_html__( 'Style10' )	=> 's10',
					esc_html__( 'Style11' )	=> 's11',

					esc_html__( 'Device', 'infinite-addons' ) => 'device',
					esc_html__( 'Mobile', 'infinite-addons' ) => 'mobile',
				)
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'scheme',
				'heading'    => esc_html__( 'Navigation Scheme', 'infinite-addons' ),
				'value'      => array(
					'Dark'  => 'nav-dark',
					'Light' => 'nav-light',
				),
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 's11' )
				),
			),

			array(
				'id'         => 'title',
				'dependency' => array(
					'element' => 'style',
					'value'   => array( 's1' )
				)
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'mockup',
				'heading'     => esc_html__( 'Mobile Carousel Background', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Mockup 1', 'infinite-addons' )  => 'phone-1',
					esc_html__( 'Mockup 2', 'infinite-addons' )  => 'phone-2',
				),
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 'mobile' )
				)
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'columns',
				'heading'     => esc_html__( 'Number of Columns', 'infinite-addons' ),
				'value'       => array(
					esc_html__( '1 Column', 'infinite-addons' )            => 'col-xs-12 no-padding no-margin',
					esc_html__( '1 Column - Spaced', 'infinite-addons' )   => 'col-xs-12',
					esc_html__( '2 Columns', 'infinite-addons' )           => 'col-sm-6 col-xs-12 no-padding no-margin',
					esc_html__( '2 Columns - Spaced', 'infinite-addons' )  => 'col-sm-6 col-xs-12',
					esc_html__( '3 Columns', 'infinite-addons' )           => 'col-md-4 col-sm-6 col-xs-12 no-padding no-margin',
					esc_html__( '3 Columns - Spaced', 'infinite-addons' )  => 'col-md-4 col-sm-6 col-xs-12',
					esc_html__( '4 Columns', 'infinite-addons' )           => 'col-md-3 col-sm-6 col-xs-12 no-padding no-margin',
					esc_html__( '4 Columns - Spaced', 'infinite-addons' )  => 'col-md-3 col-sm-6 col-xs-12',
					esc_html__( '5 Columns', 'infinite-addons' )           => 'col-one-fifth col-sm-6 col-xs-12',
				),
			)
		), $options, $design );

		$this->add_extras();
	}

	public function before_output( $atts, &$content ) {

		if( 'device' == $atts['style'] ) {
			$atts['template'] = 'device';
		}
		elseif( 'mobile' == $atts['style'] ) {
			$atts['template'] = 'mobile';
		}

		return $atts;
	}

	protected function columnize_content( &$content ) {
		global $shortcode_tags;

		if( 'mobile' === $this->atts['style'] ) {
			$this->atts['columns'] = 'carousel-cell col-xs-12 no-padding';
		}

		// Find all registered tag names in $content.
		preg_match_all( '@\[([^<>&/\[\]\x00-\x20=]++)@', $content, $matches );
		$tagnames = array_intersect( array_keys( $shortcode_tags ), $matches[1] );
		$pattern = get_shortcode_regex();

		foreach( $tagnames as $tag ) {
			$start = "[$tag";
			$end = "[/$tag]";

			if( ra_helper()->str_contains( $end, $content ) ) {
				$content = str_replace( $start, '<div class="'. $this->atts['columns'].'">' . $start, $content );
				$content = str_replace( $end, $end . '</div>', $content );
			}
			else {
				preg_match_all( '/' . $pattern . '/s', $content, $matches );

				foreach( array_unique( $matches[0] ) as $replace ) {
					$content = str_replace( $replace, '<div class="'. $this->atts['columns'].'">' . $replace . '</div>', $content );
				}
			}

		}

	}

	protected function get_class( $style ) {

		$hash = array(
			's1'     => 'carousel-container carousel-nav-style1',
			's2'     => 'carousel-container carousel-nav-style2',
			's3'     => 'carousel-container carousel-nav-style3',
			's4'     => 'carousel-container carousel-nav-style4',
			's5'     => 'carousel-container carousel-nav-style5',
			's6'     => 'carousel-container carousel-nav-style6',
			's7'     => 'carousel-container product-bordered carousel-nav-style7',
			's8'     => 'carousel-container carousel-bordered carousel-nav-style8',
			's9'     => 'carousel-container product-bordered carousel-nav-style9',
			's10'    => 'carousel-container carousel-nav-style10',
			's11'    => 'carousel-container',
			'mobile' => 'carousel-phone',
			'device' => 'carousel-device carousel-container',
		);

		return $hash[$style];
	}

	protected function get_vertical_offset() {

		if( empty( $this->atts['random_v_offset'] ) ) {
			return'';
		}

		echo 'carousel-vertical-random-offset';
	}

	protected function get_swipe_hint() {

		if( empty( $this->atts['swipe_hint'] ) ) {
			return;
		}

		echo '<div class="carousel-swipe-button"><span>' . esc_html__( 'SWIPE', 'infinite-addons' )  . '</span></div>';

	}

	protected function get_nav( $pos = 'top' ) {

		extract( $this->atts );

		if( in_array( $style, array( 's1', 's5', 's7', 's9', 's11' ) ) ) {
			$position = 'top';
		}
		elseif( in_array( $style, array( 's2', 's3', 's4', 's6', 's8', 's10' ) ) ) {
			$position = 'bottom';
		}

		$file = dirname( __FILE__ ) . "/templates/$style.php";

		if( file_exists( $file ) && 'yes' == $prevnextbuttons && $pos == $position ) {
			include $file;
		}
		elseif( ! file_exists( $file ) && 'yes' == $prevnextbuttons && $pos == $position ) {
			include dirname( __FILE__ ) . "/templates/nav.php";;
		}

	}

	protected function get_size_dots() {

		// check
		if( empty( $this->atts['size_dots'] ) ) {
			return '';
		}

		$size = $this->atts['size_dots'];

		return $size;

	}

	protected function get_align_dots() {

		// check
		if( empty( $this->atts['align_dots'] ) ) {
			return '';
		}

		$align = $this->atts['align_dots'];

		return $align;

	}

	protected function get_options() {

		$opts = array();
		$raw = $this->atts;
		$ids = array(
			'initialindex'    => 'initialIndex',
			'cellalign'       => 'cellAlign',
			'contain'         => 'contain',
			'groupcells'      => 'groupCells',
			'groupcellscustom' => 'groupCells',
			'prevnextbuttons' => 'prevNextButtons',
			'pagedots'        => 'pageDots',
			'autoplay'        => 'autoPlay',
			'autoplaytime'    => 'autoPlay',
			'pauseautoplayonhover' => 'pauseAutoPlayOnHover',
			'draggable'       => 'draggable',
			'freescroll'      => 'freeScroll',
			'wraparound'      => 'wrapAround',
			'adaptiveheight'  => 'adaptiveHeight',
			'lazyload'        => 'lazyLoad',
			'bglazyload'      => 'bgLazyLoad'
		);

		unset(
			$raw['style'],
			$raw['columns'],
			$raw['title'],
			$raw['content'],
			$raw['_id'],
			$raw['el_id'],
			$raw['el_class'],
			$raw['template'],
			$raw['mockup'],
			$raw['scheme'],
			$raw['size_dots'],
			$raw['align_dots'],
			$raw['dot_color'],
			$raw['dot_color_active'],
			$raw['random_v_offset'],
			$raw['swipe_hint']
		);

		$raw = array_filter( $raw );

		foreach( $raw as $id => $val ) {

			// Casting
			if( 'yes' === $val ) {
				$val = true;
			}
			if( 'no' === $val ) {
				$val = false;
			}
			if( in_array( $id, array( 'initialindex', 'autoplaytime', 'lazyload', 'bglazyload' ) ) ) {
				$val = intval( $val );
			}

			$opts[ $ids[ $id ] ] = $val;
		}

		if( !empty( $opts ) ) {
			echo " data-flickity-options='" . wp_json_encode( $opts ) ."'";
		}
	}

	protected function generate_css() {

		// check
		if( empty( $this->atts['dot_color'] ) && empty( $this->atts['dot_color_active'] ) ) {
			return '';
		}

		extract( $this->atts );
		$elements = array();
		$id = '.' .$this->get_id();

		if( ! empty( $dot_color ) ) {
			$elements[ rella_implode( '%1$s .flickity-page-dots .dot' ) ] = array(
				'background' => $dot_color,
				'opacity' => '1'
			);
		}
		if( ! empty( $dot_color_active ) ) {
			$elements[ rella_implode( '%1$s .flickity-page-dots .dot.is-selected' ) ] = array(
				'background' => $dot_color_active,
			);
		}

		$this->dynamic_css_parser( $id, $elements );
	}

}
new RA_Carousel;
class WPBakeryShortCode_RA_Carousel extends RA_ShortcodeContainer {}
