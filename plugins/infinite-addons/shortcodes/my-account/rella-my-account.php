<?php
/**
* Shortcode My Account
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_My_Account extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_my_account';
		$this->title       = esc_html__( 'My Account', 'infinite-addons' );
		$this->description = esc_html__( 'WooCommerce links', 'infinite-addons' );
		$this->icon        = 'fa fa-star';

		parent::__construct();
	}

	public function get_params() {

		$this->params = array();

		$this->add_extras();
	}
}
new RA_My_Account;