<?php
/**
* Shortcode Contact Info
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Contact_Info extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_contact_info';
		$this->title       = esc_html__( 'Contact Info', 'infinite-addons' );
		$this->icon        = 'fa fa-star';
		$this->description = esc_html__( 'Contact Info', 'infinite-addons' );

		parent::__construct();
	}

	public function get_params() {

		$url = rella_addons()->plugin_uri() . '/assets/img/sc-preview/contact-info/';

		$this->params = array(

			array(
				'type'       => 'select_preview',
				'param_name' => 'style',
				'heading'    => esc_html__( 'Style', 'infinite-addons' ),
				'value'      => array(

					array(
						'value' => 'default',
						'label' => esc_html__( 'Default', 'infinite-addons' ),
						'image' => $url . 'default.png'
					),

					array(
						'label' => esc_html__( 'Big List', 'infinite-addons' ),
						'value' => 'big',
						'image' => $url . 'big-list.png'
					),

					array(
						'label' => esc_html__( 'Circle', 'infinite-addons' ),
						'value' => 'circle',
						'image' => $url . 'circle.png'
					),

					array(
						'label' => esc_html__( 'With Label', 'infinite-addons' ),
						'value' => 'label',
						'image' => $url . 'label.png'
					)
				),
				'save_always' => true,				
			),

			array(
				'type'       => 'param_group',
				'param_name' => 'titles',
				'params'     => array(

					array(
						'type'      => 'dropdown',
						'param_name'  => 'type',
						'heading'   => esc_html__( 'Type', 'infinite-addons' ),
						'value'     => array(
							esc_html__( 'Email', 'infinite-addons' )         => 'email',
							esc_html__( 'Phone', 'infinite-addons' )         => 'phone',
							esc_html__( 'Address', 'infinite-addons' )       => 'address',
							esc_html__( 'Live Chat', 'infinite-addons' )     => 'chat',
							esc_html__( 'Working Hours', 'infinite-addons' ) => 'hours',
						),
						'admin_label' => true
					),

					array( 'id'  => 'label' ),
					array( 'id'  => 'title', 'heading' => esc_html__( 'Text', 'infinite-addons' ), )
				)
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'text_color',
				'heading'    => esc_html__( 'Text Color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'bg_color',
				'heading'    => esc_html__( 'Background Color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
			),
		);

		$this->add_extras();
	}

	protected function generate_css() {

		// check
		if( empty( $this->atts['text_color'] ) && empty( $this->atts['bg_color'] ) ) {
			return '';
		}

		extract( $this->atts );

		$elements = array();
		$id = '.' .$this->get_id();

		$elements[rella_implode( '%1$s.contact-info li' )]['color'] = $text_color;
		$elements[rella_implode( '%1$s.contact-info i' )]['background-color'] = $bg_color;

		$this->dynamic_css_parser( $id, $elements );
	}
}
new RA_Contact_Info;