<?php
/**
* Shortcode Pointer
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Pointer extends RA_Shortcode {

	/**
	 * [$post_type description]
	 * @var string
	 */
	private $post_type = 'product';

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_pointer';
		$this->title       = esc_html__( 'Pointer - Woocommerce Product', 'infinite-addons' );
		$this->description = esc_html__( 'Add pointer with woocommerce product info', 'infinite-addons' );
		$this->icon        = 'fa fa-mouse-pointer';
		$this->content_element = true;
		$this->as_child    = array( 'only' => 'ra_mapped_image' );
		$this->scripts     = array( 'woocommerce', 'wc-add-to-cart' );
		$this->styles       = array( 'rella-sc-img-map' );

		require_once vc_path_dir( 'CONFIG_DIR', 'grids/vc-grids-functions.php' );
		if ( 'vc_get_autocomplete_suggestion' === vc_request_param( 'action' ) || 'vc_edit_form' === vc_post_param( 'action' ) ) {
			add_filter( 'vc_autocomplete_'. $this->slug . '_include_callback', array( $this, 'include_field_search' ) ); // Get suggestion(find). Must return an array
			add_filter( 'vc_autocomplete_'. $this->slug . '_include_render', 'vc_include_field_render' ); // Render exact product. Must return an array (label,value)
		}

		parent::__construct();
	}

	public function get_params() {

		$this->params = array(

			array(
				'type'        => 'autocomplete',
				'param_name'  => 'include',
				'heading'     => esc_html__( 'Product only', 'infinite-addons' ),
				'description' => esc_html__( 'Add product to display info from.', 'infinite-addons' ),
				'settings'     => array(
					'multiple' => false,
					'sortable' => true,
					'groups'   => true,
					'no_hide'  => false, // In UI after select doesn't hide an select list
				),
				'admin_label' => true,
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'position',
				'heading'     => esc_html__( 'Alignment', 'infinite-addons' ),
				'description' => esc_html__( 'Alignment relative to the image', 'infinite-addons' ),
				'value'       => array(
					esc_html__( 'Left', 'infinite-addons' )   => 'align-right',
					esc_html__( 'Right', 'infinite-addons' ) => 'align-left'
				)
			),

			array(
				'type'         => 'textfield',
				'param_name'  => 'top',
				'heading'     => esc_html__( 'Top', 'infinite-addons' ),
				'description' => esc_html__( 'Add top position for pointer, use px or %', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-3'
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'bottom',
				'heading'     => esc_html__( 'Bottom', 'infinite-addons' ),
				'description' => esc_html__( 'Add bottom position for pointer, use px or %', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-3'
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'left',
				'heading'     => esc_html__( 'Left', 'infinite-addons' ),
				'description' => esc_html__( 'Add left position for pointer, use px or %', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-3'
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'right',
				'heading'     => esc_html__( 'Right', 'infinite-addons' ),
				'description' => esc_html__( 'Add right position for pointer, use px or %', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-3'
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'width',
				'heading'     => esc_html__( 'Border width', 'infinite-addons' ),
				'description' => esc_html__( 'Add width to border, use px or %', 'infinite-addons' ),
			),

			array(
				'type'       => 'css_editor',
				'heading'    => esc_html__( 'CSS box', 'infinite-addons' ),
				'param_name' => 'css',
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
			),

		);

		$this->add_extras();
	}

	protected function get_info() {

		if( empty( $this->atts['include'] ) ) {
			echo '<small>Please add <br/>product ID</small>';
			return;
		}

		global $product;
		$product_id = $this->atts['include'];
		$product    = wc_get_product( $product_id );
		
		if( ! $product ) {
			echo '<small>Please, add <br/>correct product ID</small>';
			return;
		}

		printf( '<a href="%s"><h3>%s</h3>%s</a>', get_permalink( $product_id ), get_the_title( $product_id ), $product->get_price_html()   );
	}

	protected function add_to_cart() {

		if ( empty( $this->atts['include'] ) ) {
			return;
		}

		global $product;
		$product_id = $this->atts['include'];
		$product    = wc_get_product( $product_id );
		
		if( !$product ) {
			return;
		}

		if ( ! in_array( $product->get_type(), array( 'variable', 'grouped', 'external' ) ) ) {
		// only if can be purchased
			if ( $product->is_purchasable() ) {

			echo apply_filters( 'woocommerce_loop_add_to_cart_link',
				sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="add_to_cart_button ajax_add_to_cart %s product_type_%s">%s</a>',
					esc_url( $product->add_to_cart_url() ),
					esc_attr( $product->get_id() ),
					esc_attr( $product->get_sku() ),
					$product->is_purchasable() ? 'add_to_cart_button' : '',
					esc_attr( $product->get_type() ),
					'<span>+</span>' . esc_html( $product->add_to_cart_text() )
				),
			$product );	

			}

		}

	}

	// AJAX Helpers ------------------------------------------------

	/**
	 * @param $search_string
	 *
	 * @return array
	 */
	public function include_field_search( $search_string ) {
		$query = $search_string;
		$data  = array();
		$args  = array(
			's'         => $query,
			'post_type' => $this->post_type,
		);
		$args['vc_search_by_title_only'] = true;
		$args['numberposts'] = - 1;
		if ( 0 === strlen( $args['s'] ) ) {
			unset( $args['s'] );
		}
		add_filter( 'posts_search', 'vc_search_by_title_only', 500, 2 );
		$posts = get_posts( $args );
		if ( is_array( $posts ) && ! empty( $posts ) ) {
			foreach ( $posts as $post ) {
				$data[] = array(
					'value' => $post->ID,
					'label' => $post->post_title
				);
			}
		}

		return $data;
	}

	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' .$this->get_id();
		
		if( empty( $top ) ){
			$top = 'auto';
		}
		if( empty( $right ) ){
			$right = 'auto';
		}
		if( empty( $bottom ) ){
			$bottom = 'auto';
		}
		if( empty( $left ) ){
			$left = 'auto';
		}

		$elements[ rella_implode( '%1$s' ) ] = array(
			'top'    => $top .' !important',
			'right'  => $right .' !important',
			'bottom' => $bottom .' !important',
			'left'   => $left .' !important'
		);

		$elements[ rella_implode( '%1$s .border' ) ] = array(
			'width' => $width	
		);

		$this->dynamic_css_parser( $id, $elements );

	}

}
new RA_Pointer;