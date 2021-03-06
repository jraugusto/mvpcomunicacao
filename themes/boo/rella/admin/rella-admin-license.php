<?php
/**
* Themerella Theme Framework
* The dashbaord class
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Rella_Admin_License extends Rella_Admin_Page {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		$this->id         = 'rella-license';
		$this->page_title = 'Rella License';
		$this->menu_title = 'License';
		$this->position   = '55';
		$this->parent     = 'rella';

		parent::__construct();
	}

	/**
	 * [display description]
	 * @method display
	 * @return [type]  [description]
	 */
	public function display() {
		include_once( get_template_directory() . '/rella/admin/views/rella-login.php' );
	}

	/**
	 * [save description]
	 * @method save
	 * @return [type] [description]
	 */
	public function save() {

	}
}
new Rella_Admin_License;
