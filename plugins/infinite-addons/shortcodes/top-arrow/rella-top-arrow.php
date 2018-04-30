<?php
/**
* Shortcode Top Arrow
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Top_Arrow extends RA_Shortcode {
	
	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_top_arrow';
		$this->title       = esc_html__( 'Back to Top', 'infinite-addons' );
		$this->icon        = 'fa fa-arrow-up';
		$this->description = esc_html__( 'Add Back to top link', 'infinite-addons' );

		parent::__construct();
	}
	
	public function get_params() {
	
		$this->params = array(

			array(
				'type'       => 'dropdown',
				'param_name' => 'style',
				'heading'    => esc_html__( 'Style', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Style 1', 'infinite-addons' ) => 's1',
					esc_html__( 'Style 2', 'infinite-addons' ) => 's2'
				)
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'label',
				'heading'     => esc_html__( 'Label text', 'infinite-addons' ),
				'admin_label' => true,
				'dependency'  => array(
					'element' => 'style',
					'value'   => 's1'
				)
			),
		);

		$this->add_extras();
	
	}

	protected function get_class( $style ) {

		$hash = array(
			's1' => 'widget_back_to_top',
			's2' => 'widget_back_to_top_style2',
		);

		return !empty( $hash[ $style ] ) ? $hash[ $style ] : 'widget ';
	}

	protected function get_label() {
		
		// check
		if( empty( $this->atts['label'] ) ) {
			return '';
		}

		$label = esc_html( $this->atts['label'] );

		printf( '<span>%s</span>', $label );

	}

}
new RA_Top_Arrow;