<?php
/**
* Shortcode Header Wishlist
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Header_Wishlist extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_header_wishlist';
		$this->title       = esc_html__( 'Header Wishlist', 'infinite-addons' );
		$this->description = esc_html__( 'Add header wishlist', 'infinite-addons' );
		$this->icon        = 'fa fa-heart';
		$this->category    = esc_html__( 'Header', 'infinite-addons' );

		parent::__construct();
	}

	public function get_params() {

		$this->params = array(
			array(
				'type'       => 'dropdown',
				'param_name' => 'trigger_size',
				'heading'    => esc_html__( 'Trigger Size', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Medium', 'infinite-addons' ) => 'md',
					esc_html__( 'Small', 'infinite-addons' )  => 'sm',
					esc_html__( 'Large', 'infinite-addons' )  => 'lg',
				)
			),
		);

		$this->add_extras();
	}

	public function change_view( $params ) {
		$params['template_part'] = 'header';

		return $params;
	}
}
new RA_Header_Wishlist;