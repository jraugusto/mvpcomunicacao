<?php
/**
* Shortcode Contact Form
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Contact_Form extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Drop VC CF7
		//vc_remove_element( 'contact-form-7' );

		// Properties
		$this->slug        = 'ra_cf7';
		$this->title       = esc_html__( 'Rella Contact Form 7', 'infinite-addons' );
		$this->icon        = 'icon-wpb-contactform7';
		$this->description = esc_html__( 'Place Rella Contact Form7', 'infinite-addons' );
		$this->scripts      = array( 'jquery-ui' );
		$this->styles      = array( 'jquery-ui', 'jquery-ui-easy', 'jquery-ui-draggable', 'rella-sc-contact-form', 'rella-sc-button' );

		parent::__construct();
	}

	public function get_params() {

		$icon = rella_get_icon_params( false, '', 'all', array( 'color' ) );
		$icon[0]['edit_field_class'] = 'vc_col-sm-6';
		$icon[1]['edit_field_class'] = 'vc_col-sm-6';


		$url = rella_addons()->plugin_uri() . '/assets/img/sc-preview/contact-form/';

		$this->params = array_merge( array(

			array(
				'type'        => 'select_preview',
				'param_name'  => 'style',
				'heading'     => esc_html__( 'Style', 'infinite-addons' ),
				'save_always' => true,
				'value'       => array(

					array(
						'value' => 's1',
						'label' => esc_html__( 'Default', 'infinite-addons' ),
						'image' => $url . 'default.png'
					),

					array(
						'label' => esc_html__( 'Default Alt', 'infinite-addons' ),
						'value' => 's18',
						'image' => $url . 'default-alt.png'
					),

					array(
						'label' => esc_html__( 'Default Alt 2', 'infinite-addons' ),
						'value' => 's20',
						'image' => $url . 'default-alt2.png'
					),

					array(
						'label' => esc_html__( 'Black', 'infinite-addons' ),
						'value' => 's4',
						'image' => $url . 'black.png'
					),

					array(
						'label' => esc_html__( 'Black Alt', 'infinite-addons' ),
						'value' => 's5',
						'image' => $url . 'black-alt.png'
					),

					array(
						'label' => esc_html__( 'Border', 'infinite-addons' ),
						'value' => 's2',
						'image' => $url . 'border.png'
					),

					array(
						'label' => esc_html__( 'Border Alt', 'infinite-addons' ),
						'value' => 's3',
						'image' => $url . 'border-alt.png'
					),

					array(
						'label' => esc_html__( 'Classic', 'infinite-addons' ),
						'value' => 's17',
						'image' => $url . 'classic.png'
					),

					array(
						'label' => esc_html__( 'Envelope', 'infinite-addons' ),
						'value' => 's6',
						'image' => $url . 'envelope.png'
					),

					array(
						'label' => esc_html__( 'Gray', 'infinite-addons' ),
						'value' => 's21',
						'image' => $url . 'gray.png'
					),

					array(
						'label' => esc_html__( 'Icons', 'infinite-addons' ),
						'value' => 's7',
						'image' => $url . 'icon.png'
					),

					array(
						'label' => esc_html__( 'Inverted', 'infinite-addons' ),
						'value' => 's8',
						'image' => $url . 'inverted.png'
					),

					array(
						'label' => esc_html__( 'Inverted Line', 'infinite-addons' ),
						'value' => 's9',
						'image' => $url . 'inverted-line.png'
					),

					array(
						'label' => esc_html__( 'Inverted Line Alt', 'infinite-addons' ),
						'value' => 's10',
						'image' => $url . 'inverted-line-alt.png'
					),

					array(
						'label' => esc_html__( 'Inverted Line Small', 'infinite-addons' ),
						'value' => 's11',
						'image' => $url . 'inverted-line-sm.png'
					),

					array(
						'label' => esc_html__( 'Line', 'infinite-addons' ),
						'value' => 's12',
						'image' => $url . 'line.png'
					),

					array(
						'label' => esc_html__( 'Line Elegant', 'infinite-addons' ),
						'value' => 's22',
						'image' => $url . 'line-elegant.png'
					),

					array(
						'label' => esc_html__( 'Line Alt', 'infinite-addons' ),
						'value' => 's13',
						'image' => $url . 'line-alt.png'
					),

					array(
						'label' => esc_html__( 'Line Alt 2', 'infinite-addons' ),
						'value' => 's19',
						'image' => $url . 'line-alt-2.png'
					),

					array(
						'label' => esc_html__( 'Minimal', 'infinite-addons' ),
						'value' => 's14',
						'image' => $url . 'minimal.png'
					),

					array(
						'label' => esc_html__( 'Minimal Inverted', 'infinite-addons' ),
						'value' => 's15',
						'image' => $url . 'minimal-inverted.png'
					),

					array(
						'label' => esc_html__( 'White', 'infinite-addons' ),
						'value' => 's16',
						'image' => $url . 'white.png'
					)
				),
				'save_always' => true,
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'id',
				'heading'     => esc_html__( 'Select contact form', 'infinite-addons' ),
				'save_always' => true,
				'description' => esc_html__( 'Choose contact form from the drop down list.', 'infinite-addons' ),
				'data'        => 'posts',
				'args'        => array(
					'post_type'   => 'wpcf7_contact_form',
					'numberposts' => -1,
					'orderby'     => 'title'
				)
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'sh_button',
				'heading'    => esc_html__( 'Button Options', 'infinite-addons' )
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'btn',
				'heading'     => esc_html__( 'Button', 'infinite-addons' ),
				'save_always' => true,
				'value'       => array(
					esc_html__( 'Default', 'infinite-addons' )	=> '',
					esc_html__( 'Fullwidth', 'infinite-addons' )	=> 'full-width-submit'
				)
			)

		), $icon, array(

			array(
				'type'       => 'subheading',
				'param_name' => 'sh_design',
				'heading'    => esc_html__( 'Design Options', 'infinite-addons' )
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'primary_color',
				'heading'    => 'Primary Color',
				'edit_field_class' => 'vc_column-with-padding vc_col-sm-4',
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'border_color',
				'heading'    => esc_html__( 'Border Color', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'hbrd_color',
				'heading'    => esc_html__( 'Focus Border Color', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

		) );
	}

	protected function get_class( $style ) {

		$hash = array(
			's1'  => 'contact-form contact-default contact-default-primary',
			's18' => 'contact-form contact-default contact-default-alt2',
			's20' => 'contact-form contact-default contact-default-alt3',
			's2'  => 'contact-form contact-default contact-default-primary thick-border',
			's3'  => 'contact-form contact-default contact-default-alt thick-border',
			's4'  => 'contact-form contact-black contact-black-default',
			's5'  => 'contact-form contact-black contact-black-alt',
			's6'  => 'contact-form contact-envelope contact-envelope-default',
			's7'  => 'contact-form contact-icons',
			's8'  => 'contact-form contact-white contact-inverted',
			's9'  => 'contact-form contact-inverted-line contact-inverted-line-default',
			's10' => 'contact-form contact-inverted-line contact-inverted-line-alt',
			's11' => 'contact-form contact-inverted-line contact-inverted-line-sm',
			's12' => 'contact-form contact-line',
			's22' => 'contact-form contact-line contact-elegant',
			's13' => 'contact-form contact-line contact-line-thin',
			's14' => 'contact-form contact-minimal',
			's15' => 'contact-form contact-inverted-minimal',
			's16' => 'contact-form contact-white contact-white-default',
			's17' => 'contact-form contact-form-classic contact-envelope',
			's19' => 'contact-form contact-line-alt',
			's21' => 'contact-form contact-gray', //last is s22

		);

		return isset( $hash[ $style ] ) ? $hash[ $style ] : $hash['s1'];
	}

	protected function generate_css() {

		// check
		if( empty( $this->atts['primary_color'] ) && empty( $this->atts['border_color'] ) && empty( $this->atts['hbrd_color'] ) ) {
			return '';
		}

		extract( $this->atts );
		$elements = array();
		$id = '.' .$this->get_id();


		if( in_array( $style, array( 's1', 's2', 's6', 's10', 's18', 's19' ) ) ) {
			$elements[ rella_implode( '%1$s button' ) ]['background-color'] = $primary_color;
		}
		elseif( in_array( $style, array( 's3', 's4', 's5', 's12', 's13' ) ) ) {

			$elements[ rella_implode( '%1$s button' ) ] = array(
				'border-color' => $primary_color,
				'color' => $primary_color
			);
		}
		elseif( in_array( $style, array( 's7' ) ) ) {
			$elements[ rella_implode( '%1$s p .wpcf7-form-control-wrap + i' ) ]['color'] = $primary_color;
			$elements[ rella_implode( '%1$s button' ) ]['background-color'] = $primary_color;
		}
		elseif( in_array( $style, array( 's8' ) ) ) {
			$elements[ rella_implode( '%1$s.contact-form input, %1$s.contact-form textarea' ) ]['background-color'] = $primary_color;
		}
		elseif( in_array( $style, array( 's14' ) ) ) {

			$elements[ rella_implode( '%1$s button' ) ]['color'] = $primary_color;
		}

		if( ! empty( $border_color ) ) {
			$elements[ rella_implode( array( '%1$s input', '%1$s textarea' ) ) ]['border-color'] = $border_color;
		}
		if( ! empty( $hbrd_color ) ) {
			$elements[ rella_implode( array( '%1$s.contact-line-alt .wpcf7-form-control-wrap:after, %1$s input:focus,%1$s textarea:focus' ) ) ]['border-color'] = $hbrd_color;
			$elements[ rella_implode( array( '%1$s.contact-default-alt2 .wpcf7-form-control-wrap:after' ) ) ]['background-color'] = $hbrd_color;
		}

		$this->dynamic_css_parser( $id, $elements );
	}
}
if ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) || defined( 'WPCF7_PLUGIN' ) ) {
	new RA_Contact_Form;
}
