<?php
/**
* Shortcode Button
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Button extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_button';
		$this->title       = esc_html__( 'Button', 'infinite-addons' );
		$this->icon        = 'fa fa-square';
		$this->description = esc_html__( 'Create a custom button.', 'infinite-addons' );
		$this->scripts     = array( 'magnific-popup' );
		$this->styles      = array( 'magnific-popup', 'rella-sc-button' );

		parent::__construct();
	}

	public function get_params() {

		$url = rella_addons()->plugin_uri() . '/assets/img/sc-preview/button/';

		$advanced = array(

			array(
				'type'        => 'rella_advanced_checkbox',
				'param_name'  => 'adv_opts',
				'value'       =>  array( esc_html__( 'Simple Mode', 'infinite-addons' ) => 'true' ),
				'std'         => '',
			)

		);

		$this->params = array_merge( $advanced, array(

			array(
				'type'       => 'select_preview',
				'param_name' => 'style',
				'heading'    => esc_html__( 'Style', 'infinite-addons' ),
				'value'      => array(

					array(
						'value' => 'btn-default',
						'label' => esc_html__( 'Default', 'infinite-addons' ),
						'image' => $url . 'btn-default.png'
					),

					array(
						'label' => esc_html__( 'Solid', 'infinite-addons' ),
						'value' => 'btn-solid',
						'image' => $url . 'btn-solid.png'
					),

					array(
						'label' => esc_html__( 'Naked', 'infinite-addons' ),
						'value' => 'btn-naked',
						'image' => $url . 'btn-naked.png'
					),

					array(
						'label' => esc_html__( 'Underlined', 'infinite-addons' ),
						'value' => 'btn-underlined',
						'image' => $url . 'btn-underlined.png'
					),

					array(
						'label' => esc_html__( 'Linethrough', 'infinite-addons' ),
						'value' => 'btn-linethrough',
						'image' => $url . 'btn-linethrough.png'
					),

					array(
						'label' => esc_html__( 'Centered', 'infinite-addons' ),
						'value' => 'btn-center',
						'image' => $url . 'btn-center.png'
					),

					array(
						'label' => esc_html__( 'App', 'infinite-addons' ),
						'value' => 'btn-app',
						'image' => $url . 'btn-app.png'
					),

					array(
						'label' => esc_html__( 'Boxed', 'infinite-addons' ),
						'value' => 'btn-boxed',
						'image' => $url . 'btn-boxed.png'
					),

					array(
						'label' => esc_html__( 'Vertical Line', 'infinite-addons' ),
						'value' => 'btn-v-line',
						'image' => $url . 'btn-v-line.png',
					),

					array(
						'label' => esc_html__( 'Play', 'infinite-addons' ),
						'value' => 'btn-play',
						'image' => $url . 'btn-play.png'
					)
				),
				'save_always' => true,
			),

			// Params goes here
			array(
				'type'        => 'textarea',
				'param_name'  => 'title',
				'heading'     => 'Title',
				'default'     => '<strong>Text goes here</strong>',
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'textarea',
				'param_name'  => 'other',
				'heading'     => esc_html__( 'Secondary Content', 'infinite-addons' ),
				'description' => esc_html__( 'Content displayed before the button label', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'id' => 'link',
				'description'      => esc_html__( 'If modal, add ID of the modal window container. For ex #modal_window', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-4'
			),

			array(
				'type' => 'dropdown',
				'param_name' => 'vline_direction',
				'heading' => esc_html__( 'Line Direction', 'infinite-addons' ),
				'description' => esc_html__( 'Select direction for vertical line of the button', 'infinite-addons' ),
				'value' => array(
					esc_html__( 'Top', 'infinite-addons' )    => 'line-top',
					esc_html__( 'Bottom', 'infinite-addons' ) => 'line-bottom',
				),
				'dependency' => array(
					'element' => 'style',
					'value' => 'btn-v-line'
				),
			),

			array(
				'type'        => 'checkbox',
				'param_name'  => 'lightbox',
				'heading'     => esc_html__( 'Enable lightbox?', 'infinite-addons' ),
				'description' => esc_html__( 'Enable to show an image or video in lightbox', 'infinite-addons' ),
				'value'       => array(
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes'
				),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'lightbox_type',
				'heading'     => esc_html__( 'Lightbox Type', 'infinite-addons' ),
				'description' => esc_html__( 'Select a type for lightbox', 'infinite-addons' ),
				'dependency'  => array(
					'element'   => 'lightbox',
					'not_empty' => true,
				),
				'value' => array(
					esc_html__( 'Image', 'infinite-addons' ) => 'image',
					esc_html__( 'Video', 'infinite-addons' ) => 'video',
					esc_html__( 'Modal Window', 'infinite-addons' ) => 'inline',
				),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type' => 'dropdown',
				'param_name' => 'curtain_hover',
				'heading' => esc_html__( 'Hover curtain effect', 'infinite-addons' ),
				'description' => esc_html__( 'Add curtain hover effect on button', 'infinite-addons' ),
				'dependency'  => array(
					'element'   => 'style',
					'value' => array( 'btn-default', 'btn-solid' ),
				),
				'value' => array(
					esc_html__( 'None', 'infinite-addons' )         => 'none',
					esc_html__( 'Top', 'infinite-addons' )          => 'top',
					esc_html__( 'Right', 'infinite-addons' )        => 'right',
					esc_html__( 'Bottom', 'infinite-addons' )       => 'bottom',
					esc_html__( 'Left', 'infinite-addons' )         => 'left',
					esc_html__( 'Rotate Right', 'infinite-addons' ) => 'rotate-right',
					esc_html__( 'Rotate Left', 'infinite-addons' )  => 'rotate-left',
				),
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'sh_styling',
				'heading'    => esc_html__( 'Styling', 'infinite-addons' ),
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'shape',
				'heading'    => esc_html__( 'Shape', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Default', 'infinite-addons' )    => '',
					esc_html__( 'Semi Round', 'infinite-addons' ) => 'semi-round',
					esc_html__( 'Round', 'infinite-addons' )      => 'round',
					esc_html__( 'Circle', 'infinite-addons' )     => 'circle'
				),
				'edit_field_class' => 'vc_col-sm-4',
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to' => array( 'btn-naked', 'btn-underlined', 'btn-linethrough', 'btn-v-line', 'btn-boxed' )
				)
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'size',
				'heading'    => esc_html__( 'Size', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'None', 'infinite-addons' )        => '',
					esc_html__( 'Default', 'infinite-addons' )     => 'btn-md',
					esc_html__( 'Extra Small', 'infinite-addons' ) => 'btn-xsm',
					esc_html__( 'Small', 'infinite-addons' )       => 'btn-sm',
					esc_html__( 'Medium', 'infinite-addons' )      => 'btn-md',
					esc_html__( 'Large', 'infinite-addons' )       => 'btn-lg',
					esc_html__( 'Extra Large', 'infinite-addons' ) => 'btn-xlg',
					esc_html__( 'Custom', 'infinite-addons' )      => 'btn-custom',

				),
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to' => array( 'btn-naked', 'btn-underlined', 'btn-linethrough', 'btn-v-line', 'btn-play', 'btn-boxed' )
				),
				'edit_field_class' => 'vc_col-sm-4'
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'custom_size',
				'heading'     => esc_html__( 'Custom Width', 'infinite-addons' ),
				'description' => esc_html__( 'Add custom width for button, in px.', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'size',
					'value'   => 'btn-custom'
				),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'custom_height',
				'heading'     => esc_html__( 'Custom Height', 'infinite-addons' ),
				'description' => esc_html__( 'Add custom height for button, in px.', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'size',
					'value'   => 'btn-custom'
				),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'alt_size',
				'heading'    => esc_html__( 'Size', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'None', 'infinite-addons' )  => '',
					esc_html__( 'Default', 'infinite-addons' )  => 'btn-md',
					esc_html__( 'Small', 'infinite-addons' )    => 'btn-sm',
					esc_html__( 'Medium', 'infinite-addons' )   => 'btn-md',
					esc_html__( 'Large', 'infinite-addons' )    => 'btn-lg',
					esc_html__( 'Custom', 'infinite-addons' )   => 'btn-custom',
				),
				'dependency' => array(
					'element' => 'style',
					'value'	=> 'btn-play'
				),
				'edit_field_class' => 'vc_col-sm-4'
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'alt_custom_size',
				'heading'     => esc_html__( 'Custom Width', 'infinite-addons' ),
				'description' => esc_html__( 'Add custom width for button, in px.', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'alt_size',
					'value'   => 'btn-custom'
				),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'alt_custom_height',
				'heading'     => esc_html__( 'Custom Height', 'infinite-addons' ),
				'description' => esc_html__( 'Add custom height for button, in px.', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'alt_size',
					'value'   => 'btn-custom'
				),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'border',
				'heading'    => esc_html__( 'Border Size', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Default', 'infinite-addons' ) => 'border-thin',
					esc_html__( 'None', 'infinite-addons' ) => 'border-none',
					esc_html__( 'Thick', 'infinite-addons' )   => 'border-thick',
					esc_html__( 'Thicker', 'infinite-addons' ) => 'border-thicker'
				),
				'edit_field_class' => 'vc_col-sm-4',
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to' => array( 'btn-naked', 'btn-linethrough', 'btn-v-line', 'btn-play', 'btn-boxed', 'btn-center' )
				),
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'text',
				'heading'    => esc_html__( 'Transformation', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Default', 'infinite-addons' )    => '',
					esc_html__( 'Uppercase', 'infinite-addons' )  => 'text-uppercase',
					esc_html__( 'Lowercase', 'infinite-addons' )  => 'text-lowercase',
					esc_html__( 'Capitalize', 'infinite-addons' ) => 'text-capitalize',
				),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-4'
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'others',
				'heading'    => esc_html__( 'Other Styles', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Default', 'infinite-addons' )  => '',
					esc_html__( 'Block', 'infinite-addons' )    => 'btn-block',
					esc_html__( 'Wide', 'infinite-addons' )     => 'wide',
					esc_html__( 'Disabled', 'infinite-addons' ) => 'disabled'
				),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-4'
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'sh_icon',
				'heading'    => esc_html__( 'Icon', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
			),

		), rella_get_icon_params( false, '', 'all', array(), 'i_', array( 'element' => 'adv_opts', 'is_empty' => true ) ), array(

			array(
				'type'       => 'dropdown',
				'param_name' => 'fix_v_line',
				'heading'    => esc_html__( 'Fix align icon on vertical' ),
				'description' => esc_html__( 'Enable in case if the icon is not aligned on vertical', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'No', 'boo' ) => '',
					esc_html__( 'Yes', 'boo' )  => 'fix-v-align' ,
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'i_size',
				'heading'     => esc_html__( 'Icon Size', 'infinite-addons' ),
				'description' => esc_html__( 'Add size of the icon in pixels (20px)', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'          => 'textfield',
				'param_name'    => 'i_ml',
				'heading'       => esc_html__( 'Icon Margin Left', 'infinite-addons' ),
				'description'   => esc_html__( 'Add left margin to Icon in pixels (20px)', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'i_mr',
				'heading'     => esc_html__( 'Icon Margin Right', 'infinite-addons' ),
				'description' => esc_html__( 'Add Right margin to Icon in pixels (20px)', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'sh_css_box',
				'heading'    => esc_html__( 'CSS Box', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
			),

			array(
				'type'        => 'css_editor',
				'param_name'  => 'css',
				'description' => '',
				'heading'     => esc_html__( 'CSS Box', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'primary_color',
				'heading'    => esc_html__( 'Primary Color', 'infinite-addons' ),
				'description' => esc_html__( 'Primary Background/Border color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_column-with-padding  vc_col-sm-6',
				'dependency' => array(
					'element' => 'enable_gradient',
					'value_not_equal_to' => 'yes'
				),
			),

			array(
				'type'        => 'gradient',
				'param_name'  => 'gradient_color',
				'heading'     => esc_html__( 'Primary Gradient', 'infinite-addons' ),
				'description' => esc_html__( 'Will override the Primary color', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_column-with-padding  vc_col-sm-6',
				'dependency' => array(
					'element' => 'enable_gradient',
					'not_empty' => true
				),
			),

			array(
				'type'       => 'checkbox',
				'param_name' => 'enable_gradient',
				'heading'    => esc_html__( 'Enable Gradient', 'infinite-addons' ),
				'value'      => array( esc_html__( 'Yes', 'infinite-addons' ) => 'yes' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to' => array( 'btn-naked', 'btn-underlined', 'btn-linethrough', 'btn-v-line' )
				),
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'hbg',
				'heading'     => esc_html__( 'Hover Color', 'infinite-addons' ),
				'description' => esc_html__( 'Hover state background color', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'enable_hover_gradient',
					'value_not_equal_to' => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'gradient',
				'param_name'  => 'hbg_gradient',
				'heading'     => esc_html__( 'Hover Gradient', 'infinite-addons' ),
				'description' => esc_html__( 'Will override the hover background color', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'enable_hover_gradient',
					'not_empty' => true
				),
			),

			array(
				'type'       => 'checkbox',
				'param_name' => 'enable_hover_gradient',
				'heading'    => esc_html__( 'Enable Hover Gradient', 'infinite-addons' ),
				'value'      => array( esc_html__( 'Yes', 'infinite-addons' ) => 'yes' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to' => array( 'btn-naked', 'btn-underlined', 'btn-linethrough', 'btn-v-line' )
				),
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'curtain_hbg',
				'heading'     => esc_html__( 'Curtain Hover Color', 'infinite-addons' ),
				'description' => esc_html__( 'Hover state background color with curtain effect', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'curtain_hover',
					'value_not_equal_to' => 'none'
				),
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'second_color',
				'heading'    => esc_html__( 'Second Color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'style',
					'value' => array( 'btn-play' ),
				),
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'sh_label',
				'heading'    => esc_html__( 'Label', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'text_color',
				'heading'    => esc_html__( 'Label Color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'htext_color',
				'heading'    => esc_html__( 'Label Hover Color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'fs',
				'heading'     => esc_html__( 'Font Size', 'infinite-addons' ),
				'description' => esc_html__( 'Example: 20px', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-3',
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'lh',
				'heading'     => esc_html__( 'Line-Height', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-3',
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'fw',
				'heading'     => esc_html__( 'Font Weight', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-3',
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'ls',
				'heading'     => esc_html__( 'Letter Spacing', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-3',
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'sh_border',
				'heading'    => esc_html__( 'Border', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to' => array( 'btn-naked', 'btn-play', 'btn-center' )
				),
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'bc',
				'heading'    => 'Border Color',
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to' => array( 'btn-naked', 'btn-play', 'btn-center' )
				),
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'hbc',
				'heading'    => 'Hover Border Color',
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to' => array( 'btn-naked', 'btn-play', 'btn-center' )
				),
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'sh_shadowbox',
				'heading'    => esc_html__( 'Box-shadow', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
			),

			//Box Shadow Options
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Enable box-shadow?', 'infinite-addons' ),
				'param_name'  => 'enable_row_shadowbox',
				'description' => esc_html__( 'If checked, the box-shadow options will be visible', 'infinite-addons' ),
				'value'       => array( esc_html__( 'Yes', 'infinite-addons' ) => 'yes' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options', 'infinite-addons' ),
			),

			array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Shadow Box Options', 'infinite-addons' ),
				'param_name' => 'button_box_shadow',
				'group' => esc_html__( 'Design Options', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'enable_row_shadowbox',
					'not_empty' => true,
				),
				'params' => array(
					array(
						'type'        => 'dropdown',
						'param_name'  => 'inset',
						'heading'     => esc_html__( 'Inset', 'infinite-addons' ),
						'description' => esc_html__(  'Select if it is inset', 'infinite-addons' ),
						'value'      => array(
							esc_html__( 'No', 'infinite-addons' )  => '',
							esc_html__( 'Yes', 'infinite-addons' ) => 'inset',
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'x_offset',
						'heading'     => esc_html__( 'Position X', 'infinite-addons' ),
						'description' => esc_html__(  'Set position X in px', 'infinite-addons' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'y_offset',
						'heading'     => esc_html__( 'Position Y', 'infinite-addons' ),
						'description' => esc_html__(  'Set position Y in px', 'infinite-addons' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'blur_radius',
						'heading'     => esc_html__( 'Blur Radius', 'infinite-addons' ),
						'description' => esc_html__(  'Add blur radius in px', 'infinite-addons' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'spread_radius',
						'heading'     => esc_html__( 'Spread Radius', 'infinite-addons' ),
						'description' => esc_html__(  'Add spread radius in px', 'infinite-addons' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'colorpicker',
						'param_name'  => 'shadow_color',
						'heading'     => esc_html__( 'Color', 'infinite-addons' ),
						'description' => esc_html__(  'Pick a color for shadow', 'infinite-addons' ),
						'edit_field_class' => 'vc_col-sm-6'
					),

				)
			),

			//Hover state box-shadow
			array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Hover Shadow Box Options', 'infinite-addons' ),
				'param_name' => 'hover_button_box_shadow',
				'group' => esc_html__( 'Design Options', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'enable_row_shadowbox',
					'not_empty' => true,
				),
				'params' => array(
					array(
						'type'        => 'dropdown',
						'param_name'  => 'inset',
						'heading'     => esc_html__( 'Inset', 'infinite-addons' ),
						'description' => esc_html__(  'Select if it is inset', 'infinite-addons' ),
						'value'      => array(
							esc_html__( 'No', 'infinite-addons' )  => '',
							esc_html__( 'Yes', 'infinite-addons' ) => 'inset',
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'x_offset',
						'heading'     => esc_html__( 'Position X', 'infinite-addons' ),
						'description' => esc_html__(  'Set position X in px', 'infinite-addons' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'y_offset',
						'heading'     => esc_html__( 'Position Y', 'infinite-addons' ),
						'description' => esc_html__(  'Set position Y in px', 'infinite-addons' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'blur_radius',
						'heading'     => esc_html__( 'Blur Radius', 'infinite-addons' ),
						'description' => esc_html__(  'Add blur radius in px', 'infinite-addons' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'spread_radius',
						'heading'     => esc_html__( 'Spread Radius', 'infinite-addons' ),
						'description' => esc_html__(  'Add spread radius in px', 'infinite-addons' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'colorpicker',
						'param_name'  => 'shadow_color',
						'heading'     => esc_html__( 'Color', 'infinite-addons' ),
						'description' => esc_html__(  'Pick a color for shadow', 'infinite-addons' ),
						'edit_field_class' => 'vc_col-sm-6'
					),

				)
			),


		) );

		$this->add_extras();
	}

	public function before_output( $atts, &$content ) {

		if( 'btn-app' == $atts['style'] ) {
			$atts['template'] = 'app';
		}
		elseif( 'btn-center' == $atts['style'] ) {
			$atts['template'] = 'center';
		}
		elseif( 'btn-play' == $atts['style'] ) {
			$atts['template'] = 'play';
		}

		return $atts;
	}

	protected function hover_curtain_effect() {

		$style = $this->atts['style'];
		if( ! in_array( $style, array( 'btn-default', 'btn-solid' ) ) ) {
			return;
		}

		$type = $this->atts['curtain_hover'];

		$effect = array(
			'none'         => '',
			'top'          => 'btn-hover-curtain hc-default curtain-top',
			'right'        => 'btn-hover-curtain hc-default curtain-right',
			'bottom'       => 'btn-hover-curtain hc-default curtain-bottom',
			'left'         => 'btn-hover-curtain hc-default curtain-left',
			'rotate-right' => 'btn-hover-curtain hc-rotate curtain-right',
			'rotate-left'  => 'btn-hover-curtain hc-rotate curtain-left',
		);

		return $effect[ $type ];

	}

	protected function get_icon_pos() {

		$icon = rella_get_icon( $this->atts );

		if( $icon['type'] && 'left' == $icon['align'] ) {
			return 'icon-left';
		}
		return '';
	}

	protected function if_lightbox() {

		if( ! $this->atts['lightbox'] ){
			return'';
		}

		return 'lightbox-link';

	}

	protected function get_liniar() {

		if( empty( $this->atts['gradient_color'] ) && !$this->atts['enable_gradient'] && empty( $this->atts['hbg_gradient'] ) && !$this->atts['enable_hover_gradient'] ) {
			return;
		}

		return 'btn-linear';

	}

	protected function vline_direction() {

		if( 'btn-v-line' !== $this->atts['style'] ) {
			return'';
		}

		$direction = $this->atts['vline_direction'];

		return $direction;

	}

	protected function get_lightbox_data() {

		if( ! $this->atts['lightbox'] ){
			return'';
		}

		$type = $this->atts['lightbox_type'];

		if( 'inline' === $type ) {
			return printf( 'data-type="%s" data-plugin-options=\'{ "closeBtnInside": true }\'', $type );
		}
		else {
			return printf( 'data-type="%s"', $type );
		}
	}

	protected function generate_css() {

		extract( $this->atts );

		$elements     = array();
		$parent       = isset( $this->parent_selector ) ? $this->parent_selector . ' ' : '';
		$id           = '.' .$this->get_id();
		$parent_hover = isset( $this->parent_selector ) ? $this->parent_selector . ':hover ' . $id : '';
		$text_color   = ( ! empty( $text_color ) ) ? $text_color : $primary_color;
		$bc           = ( ! empty( $bc ) ) ? $bc : $primary_color;

		$button_box_shadow = vc_param_group_parse_atts( $button_box_shadow );
		$hover_button_box_shadow = vc_param_group_parse_atts( $hover_button_box_shadow );


		include_once rella_addons()->plugin_dir() . 'includes/rella-color.php';

		if ( ! empty( $i_color ) || ! empty( $i_size ) || ! empty( $i_ml ) || ! empty( $i_mr ) ) {
			$elements[rella_implode( array( '%1$s i' ) )] = array(
				'color'        => $i_color,
				'font-size'    => $i_size,
				'margin-left'  => $i_ml,
				'margin-right' => $i_mr,
			);
		}

		if( 'btn-underlined' === $style ) {

			$elements[rella_implode( '%1$s' )]['color'] = $text_color;
			$elements[rella_implode( array( '%1$s.btn-underlined:before', '%1$s.btn-underlined:after' ) )]['border-color'] = $text_color;

			$elements[rella_implode( array( $parent_hover, '%1$s:hover', '%1$s:focus' ) )] = array(
				'color' => $text_color
			);

			if( $bc ) {
				$elements[rella_implode( array( '%1$s.btn-underlined:before', '%1$s.btn-underlined:after' ) )]['border-color'] = $bc;
			}

			if( $hbc ) {
				$elements[rella_implode( '%1$s.btn-underlined:after' )]['border-color'] = $hbc;
			}

		}
		elseif( 'btn-linethrough' === $style ) {

			if( $text_color ) {
				$elements[rella_implode( array('%1$s span:before', '%1$s span:after') )]['background-color'] = $text_color;
			}

			$elements[rella_implode( '%1$s' )]['color'] = $text_color;

			$elements[rella_implode( '%1$s span:before' )]['background-color'] = $bc;
			$elements[rella_implode( '%1$s span:after' )]['background-color'] = $hbc;

			$elements[rella_implode( array( $parent_hover, '%1$s:hover', '%1$s:focus' ) )] = array(
				'color' => $text_color
			);
		}
		elseif( 'btn-v-line' === $style ) {
			$elements[rella_implode( '%1$s:before' )]['background-color'] = $bc;
			$elements[rella_implode( '%1$s:after' )]['background-color'] = $hbc;

			$elements[rella_implode( '%1$s' )]['color'] = $text_color;
			$elements[rella_implode( array( $parent_hover, '%1$s:hover', '%1$s:focus' ) )] = array(
				'color' => $text_color
			);

		}
		elseif( 'btn-boxed' === $style ) {

			if( $primary_color ) {
				$primary_color_obj = new Color( $primary_color );
				$ligthen = '#' . $primary_color_obj->lighten(3);

				$elements[rella_implode( array( $parent_hover, '%1$s:hover', '%1$s:focus' ) )] = array(
					'background-color' => $ligthen
				);

				$elements[rella_implode( '%1$s' )]['background-color'] = $primary_color;
			}

			$elements[rella_implode( '%1$s' )]['color'] = $text_color;

			/* Side and top borders */
			if ( $primary_color ) {

				$primary_color_obj = new Color( $primary_color );
				$darken = '#' . $primary_color_obj->darken(6);

				$elements[rella_implode( array( '%1$s span:first-child:before', '%1$s span:first-child:after' ) )] = array(
					'background-color' => $darken
				);

			};
			if ( $bc ) {

				$bc_obj = new Color( $bc );
				$bc_darken = '#' . $bc_obj->darken(6);

				$elements[rella_implode( array( '%1$s span:first-child:before', '%1$s span:first-child:after' ) )] = array(
					'background-color' => $bc_darken
				);

			}

			/* Hover Side and top borders */
			if ( $hbg ) {

				$hbg_color_obj = new Color( $hbg );
				$hbg_darken = '#' . $hbg_color_obj->darken(3);

				$elements[rella_implode( array( $parent_hover, '%1$s:hover span:first-child:before', '%1$s:hover span:first-child:after', '%1$s:focus span:first-child:before', '%1$s:focus span:first-child:after' ) )] = array(
					'background-color' => $hbg_darken
				);

			}
			if ( $hbc ) {

				$elements[rella_implode( array( '%1$s:hover span:first-child:before', '%1$s:hover span:first-child:after','%1$s:focus span:first-child:before', '%1$s:focus span:first-child:after' ) )] = array(
					'background-color' => $hbc
				);

			}

		}
		elseif( 'btn-play' === $style ) {

			if( $primary_color ) {
				$elements[rella_implode( '%1$s.lightbox-play-button > i' )]['background-color'] = $primary_color;
			}
			$elements[rella_implode( '%1$s.lightbox-play-button' )]['color'] = $text_color;
			if( $hbg ) {
				$elements[rella_implode( array('%1$s:hover > i', '%1$s:focus > i') )]['background-color'] = $hbg;
			}

		}
		elseif( 'btn-naked' === $style ) {

			$elements[rella_implode( '%1$s' )] = array(
				'border-color' => $primary_color . ' !important',
				'color' => $text_color . ' !important'
			);
		}
		elseif( 'btn-solid' === $style ) {

			$elements[rella_implode( '%1$s' )] = array(
				'background-color' => $primary_color,
				'color' => $text_color,
				'border-color' => $primary_color . '!important'
			);

			$elements[rella_implode( array( $parent_hover, '%1$s:hover', '%1$s:focus' ) )] = array(
				'background-color' => $hbg,
				'border-color' => $hbg . '!important'
			);

		}
		elseif( 'btn-default' === $style ) {




			$elements[rella_implode( '%1$s' )] = array(
				'border-color' => $primary_color . '!important',
				'color' => $primary_color
			);

			if ( $text_color ) {

				$elements[rella_implode( '%1$s' )] = array(
					'color' => $text_color
				);

			}

			if ( $hbg ) {

				$elements[rella_implode( array( $parent_hover, '%1$s:hover', '%1$s:focus' ) )] = array(
					'background-color' => $hbg,
					'border-color' => $hbg . '!important'
				);

			} elseif ( $primary_color ) {

				$elements[rella_implode( array( $parent_hover, '%1$s:hover', '%1$s:focus' ) )] = array(
					'background-color' => $primary_color,
					'border-color' => $primary_color . '!important'
				);

			}

		}
		else {
			$elements[rella_implode( '%1$s' )] = array(
				'border-color' => $bc . ' !important',
				'color' => $text_color . ' !important'
			);
			$elements[rella_implode( array( $parent_hover, '%1$s:hover', '%1$s:focus' ) )] = array(
				'background-color' => $primary_color . ' !important'
			);
			$elements[rella_implode( array( $parent_hover ) )] = array(
				'border-color' => $primary_color . ' !important',
			);

		}

		if( $second_color ) {
			$elements[rella_implode( array( '%1$s.btn-linethrough:before', '%1$s.btn-linethrough:after' ) )]['background-color'] = $second_color;
			$elements[rella_implode( array( '%1$s.lightbox-play-button > i' ) )]['color'] = $second_color;
		}

		if( $custom_size ) {
			$elements[rella_implode( '%1$s' )] = array(
				'width'       => $custom_size,
			);
		}

		if( $custom_height ) {
			$elements[rella_implode( '%1$s' )] = array(
				'height'      => $custom_height,
				'line-height' => $custom_height,
			);
		}

		if( $alt_custom_size ) {
			$elements[rella_implode( '%1$s.lightbox-play-button > i' )]['width'] = $alt_custom_size;
		}
		if( $alt_custom_height ) {
			$elements[rella_implode( '%1$s.lightbox-play-button > i' )]['height'] = $alt_custom_height;
			$elements[rella_implode( '%1$s.lightbox-play-button > i' )]['line-height'] =  $alt_custom_height;
		}

		if( $lh ) {
			$elements[rella_implode( '%1$s' )]['line-height'] = $lh . ' !important';
		}

		if ( $fs ) {
			$elements[rella_implode( '%1$s' )]['font-size'] = $fs . ' !important';
		}

		if ( $fw ) {
			$elements[rella_implode( '%1$s' )]['font-weight'] = $fw . ' !important';
		}
		if ( $ls ) {
			$elements[rella_implode( '%1$s' )]['letter-spacing'] = $ls . ' !important';
		}

		if( $htext_color ) {
			$elements[rella_implode( array( $parent_hover, '%1$s:hover', '%1$s:focus' ) )]['color'] = $htext_color . ' !important';
		}

		if( $hbg ) {
			$elements[rella_implode( array( '%1$s:hover', '%1$s:focus' ) )]['background-color'] = $hbg;
		}

		if( $curtain_hbg ) {
			$elements[rella_implode( array( '%1$s.btn-hover-curtain .btn-curtain' ) )]['background-color'] = $curtain_hbg;
		}

		if( $bc ) {
			$elements[rella_implode( array( '%1$s' ) )]['border-color'] = $bc . ' !important';
		}

		if( $hbc ) {
			$elements[rella_implode( array( '%1$s:hover', '%1$s:focus' ) )]['border-color'] = $hbc . ' !important';
		}

		if( ! empty( $gradient_color ) && 'yes' === $enable_gradient ) {
			$bg = rella_parse_gradient( $gradient_color );
			$elements[rella_implode( array( '%1$s', '%1$s.lightbox-play-button > i' ) )]['background'] = $bg['background-image'];
		}

		if( ! empty( $hbg_gradient ) && 'yes' === $enable_hover_gradient ) {
			$bg = rella_parse_gradient( $hbg_gradient );
			$elements[rella_implode( array( '%1$s:before', '%1$s.lightbox-play-button > i:before' ) )]['background'] = $bg['background-image'];
		}

		if( ! empty( $button_box_shadow ) ) {

			$button_box_shadow_css = $this->get_shadow_css( $button_box_shadow );
			$elements[rella_implode( '%1$s' )]['-webkit-box-shadow'] = $button_box_shadow_css;
			$elements[rella_implode( '%1$s' )]['-moz-box-shadow'] = $button_box_shadow_css;
			$elements[rella_implode( '%1$s' )]['box-shadow'] = $button_box_shadow_css;

		}

		if( ! empty( $hover_button_box_shadow ) ) {

			$hover_button_box_shadow_css = $this->get_shadow_css( $hover_button_box_shadow );
			$elements[rella_implode( array( '%1$s:hover', '%1$s:focus' ) )]['-webkit-box-shadow'] = $hover_button_box_shadow_css;
			$elements[rella_implode( array( '%1$s:hover', '%1$s:focus' ) )]['-moz-box-shadow'] = $hover_button_box_shadow_css;
			$elements[rella_implode( array( '%1$s:hover', '%1$s:focus' ) )]['box-shadow'] = $hover_button_box_shadow_css;

		}



		$this->dynamic_css_parser( $parent . $id, $elements );
	}
}
new RA_Button;
