<?php
/**
* Shortcode Header Cart
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Header_Cart extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_header_cart';
		$this->title       = esc_html__( 'Header Cart', 'infinite-addons' );
		$this->description = esc_html__( 'Mini cart', 'infinite-addons' );
		$this->icon        = 'fa fa-star';
		$this->category    = esc_html__( 'Header', 'infinite-addons' );

		parent::__construct();
	}

	public function get_params() {

		$this->params = array_merge(
			array(
				array(
					'type'       => 'dropdown',
					'param_name' => 'badge_style',
					'heading'    => esc_html__( 'Badge Style', 'infinite-addons' ),
					'value'      => array(
						esc_html__( 'Inline', 'infinite-addons' ) => 'icon-inline',
						esc_html__( 'Super', 'infinite-addons' )  => 'icon-sup'
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
				),

				array(
					'type'       => 'dropdown',
					'param_name' => 'trigger_size',
					'heading'    => esc_html__( 'Trigger Size', 'infinite-addons' ),
					'value'      => array(
						esc_html__( 'Medium', 'infinite-addons' ) => 'md',
						esc_html__( 'Small', 'infinite-addons' )  => 'sm',
						esc_html__( 'Large', 'infinite-addons' )  => 'lg',
					),
					'edit_field_class' => 'vc_col-sm-6'
				),

				array(
					'type'       => 'dropdown',
					'param_name' => 'count_visibility',
					'heading'    => esc_html__( 'Count Visibility', 'infinite-addons' ),
					'value'      => array(
						esc_html__( 'Show', 'infinite-addons' ) => '',
						esc_html__( 'Hide', 'infinite-addons' ) => 'hide'
					),
					'edit_field_class' => 'vc_col-sm-6'
				),

				array(
					'type'       => 'dropdown',
					'param_name' => 'amount_visibility',
					'heading'    => esc_html__( 'Amount Visibility', 'infinite-addons' ),
					'value'      => array(
						esc_html__( 'Show', 'infinite-addons' ) => '',
						esc_html__( 'Hide', 'infinite-addons' ) => 'hide'
					),
					'edit_field_class' => 'vc_col-sm-6'
				)
			),

			rella_get_icon_params( false, '', 'all', array( 'align', 'size', 'margin-left', 'margin-right' ) )
		);

		$this->add_extras();
	}
}
new RA_Header_Cart;