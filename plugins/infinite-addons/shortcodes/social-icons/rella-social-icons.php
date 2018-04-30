<?php
/**
* Shortcode Social Icons
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Social_Icons extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_social_icons';
		$this->title       = esc_html__( 'Social Icons', 'infinite-addons' );
		$this->description = esc_html__( 'Social Icons', 'infinite-addons' );
		$this->icon        = 'fa fa-star';
		$this->styles      = array( 'rella-sc-social-icon' );

		parent::__construct();
	}

	public function get_params() {

		$url = rella_addons()->plugin_uri() . '/assets/img/sc-preview/social-icons/';

		$this->params = array(
			
			array(
				'type'        => 'rella_advanced_checkbox',
				'param_name'  => 'adv_opts',
				'value'       =>  array( esc_html__( 'Simple Mode', 'infinite-addons' ) => 'true' ),
				'std'         => '',
			),

			array(
				'type'       => 'select_preview',
				'param_name' => 'style',
				'heading'    => esc_html__( 'Style', 'infinite-addons' ),
				'value'      => array(

					array(
						'value' => '',
						'label' => esc_html__( 'Default', 'infinite-addons' ),
						'image' => $url . 'default.png'
					),

					array(
						'label' => esc_html__( 'Branded', 'infinite-addons' ),
						'value' => 'branded',
						'image' => $url . 'branded.png'
					),

					array(
						'label' => esc_html__( 'Branded Text', 'infinite-addons' ),
						'value' => 'branded-text',
						'image' => $url . 'branded-text.png'
					),

					array(
						'label' => esc_html__( 'Text Only', 'infinite-addons' ),
						'value' => 'text-only',
						'image' => $url . 'text-only.png'
					)
				),
				'save_always' => true,
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'shape',
				'heading'    => esc_html__( 'Shape', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'None', 'infinite-addons' )       => '',
					esc_html__( 'Square', 'infinite-addons' )     => 'square',
					esc_html__( 'Bordered', 'infinite-addons' )   => 'square side-border',
					esc_html__( 'Bordered 2', 'infinite-addons' ) => 'rectangle bordered',
					esc_html__( 'Round', 'infinite-addons' )      => 'round',
					esc_html__( 'Rectangle', 'infinite-addons' )  => 'rectangle',
					esc_html__( 'Circle', 'infinite-addons' )     => 'circle',
				),
				'dependency'  => array(
					'element' => 'style',
					'value_not_equal_to'  => array( 'text-only' )
				),
				'edit_field_class' => 'vc_col-sm-4'
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'visibility',
				'heading'    => esc_html__( 'Visibility', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Normal', 'infinite-addons' ) => '',
					esc_html__( 'Faded', 'infinite-addons' )  => 'faded',
				),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'size',
				'heading'    => esc_html__( 'Size', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Small', 'infinite-addons' )  => 'sm',
					esc_html__( 'Medium', 'infinite-addons' ) => 'social-icon-md',
					esc_html__( 'Large', 'infinite-addons' )  => 'social-icon-lg'
				),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-4'
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'scheme',
				'heading'    => esc_html__( 'Scheme', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Default', 'infinite-addons' ) => '',
					esc_html__( 'Dark', 'infinite-addons' )    => 'scheme-dark',
					esc_html__( 'Light', 'infinite-addons' )   => 'scheme-white',
					esc_html__( 'Gray', 'infinite-addons' )    => 'scheme-gray'
				),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-4'
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'orientation',
				'heading'    => esc_html__( 'Orientation', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Horizontal', 'infinite-addons' ) => '',
					esc_html__( 'Vertical', 'infinite-addons' )   => 'vertical'
				),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-4'
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'text_transform',
				'heading'    => esc_html__( 'Text Transform', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Default', 'infinite-addons' ) => '',
					esc_html__( 'None', 'infinite-addons' )    => 'text-transform-none',
					esc_html__( 'Uppercase', 'infinite-addons' )   => 'text-uppercase',
					esc_html__( 'Lowercase', 'infinite-addons' )    => 'text-lowercase',
					esc_html__( 'Capitalize', 'infinite-addons' )    => 'text-capitalize'
				),
				'dependency'  => array(
					'element' => 'style',
					'value'  => array( 'text-only' )
				),
				'edit_field_class' => 'vc_col-sm-4'
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'letter_spacing',
				'heading'     => esc_html__( 'Letter Spacing', 'infinite-addons' ),
				'description' => esc_html__( 'Add letter spacing for texts', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'style',
					'value'  => array( 'text-only' )
				),
				'edit_field_class' => 'vc_col-sm-4'
			),

			array(
				'type'       => 'param_group',
				'param_name' => 'identities',
				'heading'    => esc_html__( 'Identities', 'infinite-addons' ),
				'params'     => array(

					array(
						'id' => 'network',
						'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
					),

					array(
						'type'        => 'textfield',
						'param_name'  => 'url',
						'heading'     => esc_html__( 'URL (Link)', 'infinite-addons' ),
						'description' => esc_html__(  'Add social link', 'infinite-addons' ),
						'edit_field_class' => 'vc_col-sm-6'
					)
				)
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'font_size',
				'heading'     => esc_html__( 'Size', 'infinite-addons' ),
				'description' => esc_html__( 'Add size in pixels e.g 15px', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'primary_color',
				'heading'     => esc_html__( 'Primary Color', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'hover_color',
				'heading'     => esc_html__( 'Hover Color', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'bg_color',
				'heading'     => esc_html__( 'Background Color', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'shape',
					'value' => array( 'square', 'round', 'circle', 'rectangle' )
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'hbg_color',
				'heading'     => esc_html__( 'Hover Background Color', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'shape',
					'value'   => array( 'square', 'round', 'circle', 'rectangle' )
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'border_color',
				'heading'    => esc_html__( 'Border Color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'shape',
					'value' => 'square side-border'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			vc_map_add_css_animation( false )
		);

		$this->add_extras();
	}

	public function generate_css() {

		extract($this->atts);

		$elements = array();
		$id = '.' .$this->get_id();
		$out = '';

		$elements['%1$s.social-icon'] = array (
			'font-size' => $font_size,
			'letter-spacing' => $letter_spacing
		);
		$elements['%1$s.social-icon a']['color'] = isset( $primary_color ) ? $primary_color . ' !important' : '';
		$elements['%1$s.social-icon li']['border-color'] = isset( $border_color ) ? $border_color . ' !important' : '';
		$elements['%1$s.social-icon li a:hover']['color'] = isset( $hover_color ) ? $hover_color . ' !important' : '';
		$elements['%1$s.social-icon a']['background-color'] = isset( $bg_color ) ? $bg_color . ' !important' : '';
		$elements['%1$s.social-icon a:hover']['background-color'] = isset( $hbg_color ) ? $hbg_color . ' !important' : '';
		$this->dynamic_css_parser( $id, $elements );
	}
}
new RA_Social_Icons;
