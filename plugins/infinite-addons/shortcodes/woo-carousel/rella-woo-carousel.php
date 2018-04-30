<?php
/**
* Shortcode Woo Products
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Woo_Carousel extends RA_Shortcode {


	/**
	 * [$post_type description]
	 * @var string
	 */
	private $post_type = 'product';

	/**
	 * [$taxonomies description]
	 * @var array
	 */
	private $taxonomies = array( 'product_cat' );


	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_woo_carousel';
		$this->title       = esc_html__( 'Woocommerce Products', 'infinite-addons' );
		$this->description = esc_html__( 'Display Woocommerce Products', 'infinite-addons' );
		$this->icon        = 'fa fa-arrows-h';
		$this->scripts     = array( 'flickity', 'woocommerce', 'wc-add-to-cart' );
		$this->styles      = array( 'flickity', 'rella-sc-carousel' );

		require_once vc_path_dir( 'CONFIG_DIR', 'grids/vc-grids-functions.php' );
		if ( 'vc_get_autocomplete_suggestion' === vc_request_param( 'action' ) || 'vc_edit_form' === vc_post_param( 'action' ) ) {
			// Narrow data taxonomies
			add_filter( 'vc_autocomplete_'. $this->slug . '_taxonomies_callback', array( $this,'autocomplete_taxonomies_field_search' ) );
			add_filter( 'vc_autocomplete_'. $this->slug . '_taxonomies_render', array($this, 'render_autocomplete_field') );

		}

		parent::__construct();
	}

	public function get_params() {

		$this->params = array(

			array(
				'type'       => 'dropdown',
				'param_name' => 'style',
				'heading'    => esc_html__( 'Style', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Style 1', 'infinite-addons' ) => 's1',
					esc_html__( 'Style 2', 'infinite-addons' ) => 's2',
					esc_html__( 'Style 3', 'infinite-addons' ) => 's3',
					esc_html__( 'Style 4', 'infinite-addons' ) => 's4'
				)
			),
			
			array(
				'type'       => 'dropdown',
				'param_name' => 'enable_carousel',
				'heading'    => esc_html__( 'Enable Carousel', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes',
					esc_html__( 'No', 'infinite-addons' )  => 'no',
				),
			),

			array(
				'type'       => 'autocomplete',
				'heading'    => esc_html__( 'Categories', 'infinite-addons' ),
				'param_name' => 'taxonomies',
				'settings'   => array(
					'multiple'       => true,
					'min_length'     => 1,
					'groups'         => true,
					'no_hide'        => true, // In UI after select doesn't hide an select list
					'unique_values'  => true,
					'display_inline' => true,
					'delay'          => 500,
					'auto_focus'     => true,
				),
				'param_holder_class' => 'vc_not-for-custom',
				'description'        => esc_html__( 'Enter categories, tags or custom taxonomies.', 'infinite-addons' ),
			),

			array(
				'id' => 'limit'
			),

		);

		$this->add_extras();

	}

	public function before_output( $atts, &$content ) {

		if( 's3' == $atts['style'] || 's4' == $atts['style'] ) {
			$atts['template'] = 'elegant';
		}

		return $atts;
	}

	protected function get_class( $style ) {
		
		$enable_carousel = $this->atts['enable_carousel'];		

		$hash = array(
			's1' => 'product-hover-shadow',
			's2' => 'product-bordered carousel-container carousel-nav-style7',
			's3' => 'carousel carousel-container carousel-nav-style9',
			's4' => 'carousel-container',
		);
		
		if( 'yes' !== $enable_carousel ) {
			$hash = array(
				's1' => 'product-hover-shadow',
				's2' => 'product-bordered',
				's3' => '',
				's4' => 'carousel-container',
			);
		}

		return $hash[ $style ];
	}

	protected function get_navigation() {

		$style = $this->atts['style'];
		$enable_carousel = $this->atts['enable_carousel'];
		if( 'yes' !== $enable_carousel ) {
			return;
		}
		
		if ( in_array( $style, array( 's2' ) ) ) {
			return '<div class="carousel-nav">
						<button class="flickity-prev-next-button previous"><i class="fa fa-long-arrow-left"></i></button>
						<button class="flickity-prev-next-button next"><i class="fa fa-long-arrow-right"></i></button>
					</div>';
		}
		elseif ( in_array( $style, array( 's3' ) ) ) {
			return '<div class="carousel-nav">
						<button class="flickity-prev-next-button previous"><i class="fa fa-angle-left"></i></button>
						<button class="flickity-prev-next-button next"><i class="fa fa-angle-right"></i></button>
						</div><!-- /.carousel-nav -->';
		}

		return '';

	}

	/**
	 * @since 4.5.2
	 *
	 * @param $search_string
	 *
	 * @return array|bool
	 */
	function autocomplete_taxonomies_field_search( $search_string ) {
		$data = array();
		$vc_taxonomies = get_terms( $this->taxonomies, array(
			'hide_empty' => false,
			'search'     => $search_string,
		) );
		if ( is_array( $vc_taxonomies ) && ! empty( $vc_taxonomies ) ) {
			foreach ( $vc_taxonomies as $t ) {
				if ( is_object( $t ) ) {
					$data[] = ra_helper()->get_term_object( $t );
				}
			}
		}

		return $data;
	}

	function render_autocomplete_field( $term ) {
		return ra_helper()->vc_autocomplete_taxonomies_field_render($term, 'product_cat');
	}

}
new RA_Woo_Carousel;