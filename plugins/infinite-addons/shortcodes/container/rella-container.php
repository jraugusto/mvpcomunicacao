<?php
/**
* Shortcode Container
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Container extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug         = 'ra_container';
		$this->title        = esc_html__( 'Container', 'infinite-addons' );
		$this->icon         = 'fa fa-square';
		$this->description  = esc_html__( 'General container.', 'infinite-addons' );
		$this->is_container = true;

		parent::__construct();
	}

	public function get_params() {

		$values = apply_filters( 'rella_shortcode_container_values', array(
			esc_html__( 'None', 'infinite-addons' ) => ''
		));

		$this->params = array(
			array(
				'type'        => 'dropdown',
				'param_name'  => 'style',
				'heading'     => esc_html__( 'Container for', 'infinite-addons' ),
				'value'       => $values,
				'admin_label' => true
			),
		);

		$this->add_extras();
	}
}
new RA_Container;
class WPBakeryShortCode_RA_Container extends RA_ShortcodeContainer {}