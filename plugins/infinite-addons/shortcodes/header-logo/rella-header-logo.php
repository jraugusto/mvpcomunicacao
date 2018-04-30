<?php
/**
* Shortcode Header Logo
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Header_Logo extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_header_logo';
		$this->title       = esc_html__( 'Header Logo', 'infinite-addons' );
		$this->description = esc_html__( 'Header Logo', 'infinite-addons' );
		$this->icon        = 'fa fa-star';
		$this->category    = esc_html__( 'Header', 'infinite-addons' );

		parent::__construct();
	}

	public function get_params() {

		$this->params = array(

			array(
				'type'        => 'attach_image',
				'param_name'  => 'logo',
				'heading'     => esc_html__( 'Header Logo', 'infinite-addons' ),
				'description' => esc_html__( 'If you want to use other logo beside uploaded in theme option.', 'infinite-addons' ),
			),
			
			array(
				'type'        => 'attach_image',
				'param_name'  => 'retina_logo',
				'heading'     => esc_html__( 'Header Retina Logo', 'infinite-addons' ),
				'description' => esc_html__( 'If you want to use other retina logo beside uploaded in theme option.', 'infinite-addons' ),
			),

			array(
				'id'  => 'link',
				'description' => esc_html__( 'If you want to use other link beside home url.', 'infinite-addons' ),
			)
		);

		$this->add_extras();
	}
}
new RA_Header_Logo;