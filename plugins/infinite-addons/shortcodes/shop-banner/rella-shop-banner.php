<?php
/**
* Shortcode Banner
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Shop_Banner extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug         = 'ra_shop_banner';
		$this->title        = esc_html__( 'Shop Banner', 'infinite-addons' );
		$this->description  = esc_html__( 'Add Shop Banner content', 'infinite-addons' );
		$this->icon         = 'fa fa-star';
		$this->scripts     = array( 'jquery-panr', 'TweenMax' );
		$this->styles      = array( 'rella-sc-shop-banner', 'rella-sc-button' );
		$this->is_container = true;

		parent::__construct();
	}

	public function get_params() {

		$this->params = array(

			array(
				'type'       => 'dropdown',
				'param_name' => 'style',
				'heading'    => esc_html__( 'Style', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Only Button', 'infinite-addons' ) => 'only-btn',
					esc_html__( 'With Hover Effect', 'infinite-addons' ) => 'hover-effect',
				)
			),

			array(
				'type'        => 'rella_attach_image',
				'param_name'  => 'image',
				'heading'     => esc_html__( 'Image', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 'only-btn' )
				),
			),

			array(
				'type'       => 'css_editor',
				'param_name' => 'css',
				'heading'    => esc_html__( 'CSS box', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
			),

			array(
				'type' => 'textfield',
				'param_name' => 'height',
				'heading'     => esc_html__( 'Height', 'infinite-addons' ),
				'description' => esc_html__( 'Add height to shop banner in px (150px)', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 'only-btn' )
				),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
			),

		);

		$this->add_extras();
	}

	public function before_output( $atts, &$content ) {

		if( 'only-btn' == $atts['style'] ) {
			$atts['template'] = 'only-btn';
		}

		return $atts;
	}

	protected function get_image() {

		// check
		if( empty( $this->atts['image'] ) ) {
			return;
		}

		if( preg_match( '/^\d+$/', $this->atts['image'] ) ){
			$image = rella_get_image( $this->atts['image'] );
		} else {
			$image = esc_url( $this->atts['image'] );
		}

		$style = $this->atts['style'];

		if( in_array( $style, array( 'only-btn' ) ) ) {
			printf( '<figure style="background: url(%1$s);"  data-panr="true" data-plugin-options=\'{ "moveTarget": ".shop-banner", "sensitivity": 10, "scaleTo": 1.08, "scaleDuration": 0.5, "panDuration": 1.25 }\'></figure>', $image );
		}
	}

	protected function get_class( $style ) {

		$hash = array(
			'only-btn'     => 'shop-banner-only-btn',
			'hover-effect' => 'shop-banner-hover-shadow',
		);

		return $hash[$style];
	}

	protected function generate_css() {

		// check
		if( empty( $this->atts['height'] ) ) {
			return '';
		}

		extract( $this->atts );

		$elements = array();
		$id = '.' . $this->get_id();

		$elements[ rella_implode( '%1$s' ) ] = array(
			'height' => $height,
		);

		$this->dynamic_css_parser( $id, $elements );

	}

}
new RA_Shop_Banner;
class WPBakeryShortCode_RA_Shop_Banner extends RA_ShortcodeContainer {}
