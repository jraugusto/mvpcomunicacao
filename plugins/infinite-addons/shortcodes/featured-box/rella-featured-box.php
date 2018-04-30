<?php
/**
* Shortcode Featured Box
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Featured_Box extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_featured_box';
		$this->title       = esc_html__( 'Featured box', 'infinite-addons' );
		$this->icon        = 'fa fa-dot-circle-o';
		$this->description = esc_html__( 'Create a featured box', 'infinite-addons' );
		$this->styles      = array( 'rella-sc-featured-box', 'rella-sc-button' );

		parent::__construct();
	}

	public function get_params() {

		$url = rella_addons()->plugin_uri() . '/assets/img/sc-preview/featured-box/';

		$this->params = array(

			array(
				'type'       => 'select_preview',
				'param_name' => 'style',
				'heading'    => esc_html__( 'Style', 'infinite-addons' ),
				'value'      => array(

					array(
						'value' => 's1',
						'label' => esc_html__( 'Product box', 'infinite-addons' ),
						'image' => $url . 'product.png'
					),

					array(
						'label' => esc_html__( 'Product box 2', 'infinite-addons' ),
						'value' => 's2',
						'image' => $url . 'product-2.png'
					)
				),
				'save_always' => true,
			),

			array(
				'id' => 'title', 
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'textfield',
				'param_name' => 'price',
				'heading'    => esc_html__( 'Price', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'style',
					'value'   => array( 's1', 's2' )
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'rella_attach_image',
				'param_name'  => 'image',
				'heading'     => esc_html__( 'Image', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'vc_link',
				'heading'    => esc_html__( 'Featured Box URL', 'infinite-addons' ),
				'param_name' => 'link',
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'textfield',
				'param_name' => 'ribbon',
				'heading'    => esc_html__( 'Ribbon', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'style',
					'value'   => array( 's1' )
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'param_group',
				'heading'     => esc_html__( 'Attributes', 'infinite-addons' ),
				'description' => esc_html__( 'Enter values for attributes', 'infinite-addons' ),
				'param_name'  => 'fb_atts',
				'params' => array(
					array(
						'type'        => 'textfield',
						'param_name'  => 'fb_label',
						'heading'     => esc_html__( 'Label', 'infinite-addons' ),
						'description' => esc_html__( 'Enter text used as label', 'infinite-addons' ),
						'admin_label' => true,
					),
				),
				'group' => esc_html__( 'Attributes', 'infinite-addons' ),
			),

		);

		$this->add_extras();
	}


	protected function get_title() {

		extract( $this->atts );

		// check
		if( empty( $title ) ) {
			return '';
		}

		$link = rella_get_link_attributes( $link, false );

		if( ! empty ( $link['href'] ) ) {
			$title = sprintf( '<h3><a%2$s>%1$s</a></h3>', $title, ra_helper()->html_attributes( $link ) );
		} else {
			$title = sprintf( '<h3>%s</h3>', $title );
		}

		echo $title;
	}

	protected function get_image() {

		$style = $this->atts['style'];
		// check
		if( empty( $this->atts['image'] ) ) {
			return '';
		}
		
		if( preg_match( '/^\d+$/', $this->atts['image'] ) ){
			$src   = rella_get_image_src( $this->atts['image'] );
			$image = rella_get_image( $this->atts['image'] );
			$html  = wp_get_attachment_image( $this->atts['image'], 'full', false, array( 'data-rjs' => $src[0] ) );
		} else {
			$html = '<img src="' . esc_url( $this->atts['image'] ) . '" alt="" data-rjs="' . esc_url( $this->atts['image'] ) . '" />';
		}
		
		$link = rella_get_link_attributes( $this->atts['link'], false );
		$link = ra_helper()->html_attributes( $link );

		$title  = $this->atts['title'];

		if ( $link ) {
			$image = sprintf( '<a%2$s>%1$s</a>', $html, $link );
		} else {
			$image = $html;
		}

		echo $image;
	}

	protected function get_ribbon() {

		// check
		if( empty( $this->atts['ribbon'] ) ) {
			return '';
		}

		$ribbon = sprintf( '<span class="featured-box-featured text-uppercase">%s</span>', $this->atts['ribbon'] );

		echo $ribbon;
	}

	protected function get_price() {

		// check
		if( empty( $this->atts['price'] ) ) {
			return '';
		}

		$price = sprintf( '<span class="featured-box-price">%s</span>', $this->atts['price'] );

		echo $price;
	}

	protected function get_info() {

		$fb_atts = (array) vc_param_group_parse_atts( $this->atts['fb_atts'] );

		// check
		if( empty( $fb_atts ) ) {
			return '';
		}

		$out = '';
		foreach ( $fb_atts as $fb_att ) {
			if ( ! empty ( $fb_att['fb_label'] ) ) {
				$out .= sprintf(
					'<span>%s</span>',
			 		do_shortcode( wp_kses_post( $fb_att['fb_label'] ) )
				);
			}
		}

		printf( '<div class="featured-box-info">%s</div>', $out );

	}

	protected function get_class( $style ) {

		$hash = array(
			's1' => 'featured-box-product',
			's2' => 'featured-box-product featured-box-product-centered text-center'
		);

		return $hash[ $style ];
	}

	protected function generate_css() {

	}

}
new RA_Featured_Box;