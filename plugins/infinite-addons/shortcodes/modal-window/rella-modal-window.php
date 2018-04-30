<?php
/**
* Modal Window Button
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Modal_Window extends RA_Shortcode {
	
	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_modal_window';
		$this->title       = esc_html__( 'Modal Window', 'infinite-addons' );
		$this->icon        = 'fa fa-square';
		$this->description = esc_html__( 'Create a modal window', 'infinite-addons' );
		$this->is_container = true;
		$this->scripts     = array( 'magnific-popup' );
		$this->styles      = array( 'magnific-popup', 'rella-sc-modal', 'rella-sc-button' );

		parent::__construct();
	}
	
	public function get_params() {

		$this->params = array();

		$this->add_extras();
	}
	

}
new RA_Modal_Window;
class WPBakeryShortCode_RA_Modal_Window extends RA_ShortcodeContainer {}