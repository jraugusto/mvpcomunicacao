<?php
/**
* Shortcode Icon box
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Icon_Box extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_icon_box';
		$this->title       = esc_html__( 'Icon Box', 'infinite-addons' );
		$this->description = esc_html__( 'Create an icon box.', 'infinite-addons' );
		$this->icon        = 'fa fa-dot-circle-o';
		$this->scripts     = array( 'vivus', 'jquery-countTo', 'jquery-appear', 'SplitText' );
		$this->styles      = array( 'rella-sc-icon-box', 'rella-sc-button' );

		parent::__construct();
	}

	public function get_params() {

		$url = rella_addons()->plugin_uri() . '/assets/img/sc-preview/icon-box/';

		$advanced = array(
			array(
				'type'        => 'rella_advanced_checkbox',
				'param_name'  => 'adv_opts',
				'value'       =>  array( esc_html__( 'Simple Mode', 'infinite-addons' ) => 'true' ),
				'std'         => '',
			)
		);

		$button = vc_map_integrate_shortcode( 'ra_button', 'ib_', esc_html__( 'Button', 'infinite-addons' ),
			array(
				'exclude' => array(
					'el_id',
					'el_class'
				),
			),
			array(
				'element' => 'show_button',
				'value' => 'yes',
			)
		);

		$effect = array(

			array(
				'type'        => 'dropdown',
				'param_name'  => 'effect_tag',
				'heading'     => esc_html__( 'Tag', 'infinite-addons' ),
				'description' => esc_html__( 'Select title tag to apply the effect', 'infinite-addons' ),
				'value'       => array(
					'h1',
					'h2',
					'h3',
					'h4',
					'h5',
					'h6',
					'p',
					'div',
				),
				'std' => 'h3',
				'dependency' => array(
					'element' => 'effect',
					'value' => array(
						'filling_effect',
						'resolving_effect',
						'slide_horizontal_effect',
						'slide_horizontal_vertical'
					),
				),
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'seperator',
				'heading'     => esc_html__( 'Separator', 'infinite-addons' ),
				'description' => esc_html__( 'Select a separator of the elements', 'infinite-addons' ),
				'value'       => array(
					'chars',
					'words',
					'lines',
				),
				'dependency' => array(
					'element' => 'effect',
					'value' => array(
						'resolving_effect'
					),
				),
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'autoplay',
				'heading'    => esc_html__( 'Autoplay', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'No', 'infinite-addons' )  => '',
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes',
				),
				'dependency' => array(
					'element' => 'effect',
					'value' => array(
						'slide_horizontal_effect',
						'slide_horizontal_vertical'
					),
				),
				'edit_field_class' => 'vc_col-sm-6',

			),

			array(
				'type'       => 'textfield',
				'param_name' => 'delay',
				'heading'    => esc_html__( 'Delay', 'infinite-addons' ),
				'description' => esc_html__( 'Delay time between slider, ex. 2000', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'effect',
					'value' => array(
						'slide_horizontal_effect',
						'slide_horizontal_vertical'
					),
				),
				'edit_field_class' => 'vc_col-sm-6',

			),

			array(
				'type' => 'textfield',
				'param_name' => 'startdelay',
				'heading' => esc_html__( 'Start Delay', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'effect',
					'value' => array(
						'resolving_effect'
					),
				),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type' => 'textfield',
				'param_name' => 'start_resolving',
				'heading' => esc_html__( 'Start', 'infinite-addons' ),
				'description' => esc_html__( 'The time between start and end ex. 0.12000', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'effect',
					'value' => array(
						'resolving_effect'
					),
				),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type' => 'textfield',
				'param_name' => 'end_resolving',
				'heading' => esc_html__( 'End', 'infinite-addons' ),
				'description' => esc_html__( 'The time between start and end ex. 0.52000', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'effect',
					'value' => array(
						'resolving_effect'
					),
				),
				'edit_field_class' => 'vc_col-sm-4',
			),

		);

		foreach( $effect as &$param ) {
			$param['group'] = esc_html__( 'Effect Options', 'infinite-addons' );
		}

		$params = array(

			array(
				'type'       => 'select_preview',
				'param_name' => 'template',
				'heading'    => esc_html__( 'Style', 'infinite-addons' ),
				'value'      => array(

					array(
						'label' => esc_html__( 'Default', 'infinite-addons' ),
						'value' => '',
						'image' => $url . 'default.png'
					),

					array(
						'label' => esc_html__( 'App', 'infinite-addons' ),
						'value' => 'app',
						'image' => $url . 'app.png'
					),

					array(
						'label' => esc_html__( 'Boxed', 'infinite-addons' ),
						'value' => 'boxed',
						'image' => $url . 'boxed.png'
					),

					array(
						'label' => esc_html__( 'Boxed Alt', 'infinite-addons' ),
						'value' => 'boxed-alt',
						'image' => $url . 'boxed-alt.png'
					),

					array(
						'label' => esc_html__( 'Boxed Alt 2', 'infinite-addons' ),
						'value' => 'boxed-alt2',
						'image' => $url . 'boxed-alt-2.png'
					),

					array(
						'label' => esc_html__( 'Boxed Alt 3', 'infinite-addons' ),
						'value' => 'boxed-alt3',
						'image' => $url . 'boxed-alt-3.png'
					),

					array(
						'label' => esc_html__( 'Boxed Alt 4', 'infinite-addons' ),
						'value' => 'boxed-alt4',
						'image' => $url . 'boxed-alt-4.png'
					),

					array(
						'label' => esc_html__( 'Boxed Alt 5', 'infinite-addons' ),
						'value' => 'boxed-alt5',
						'image' => $url . 'boxed-alt-5.png'
					),

					array(
						'label' => esc_html__( 'Card', 'infinite-addons' ),
						'value' => 'card',
						'image' => $url . 'card.png'
					),

					array(
						'label' => esc_html__( 'Contact Info', 'infinite-addons' ),
						'value' => 'ci',
						'image' => $url . 'contact-info.png'
					),

					array(
						'label' => esc_html__( 'Contact Info 2', 'infinite-addons' ),
						'value' => 'ci2',
						'image' => $url . 'contact-info-2.png'
					),

					array(
						'label' => esc_html__( 'Contact Info 3', 'infinite-addons' ),
						'value' => 'ci3',
						'image' => $url . 'contact-info-3.png'
					),

					array(
						'label' => esc_html__( 'Shadow box', 'infinite-addons' ),
						'value' => 'shadow',
						'image' => $url . 'shadow.png',
					),

					array(
						'label' => esc_html__( 'Shadowed', 'infinite-addons' ),
						'value' => 'shadowed',
						'image' => $url . 'shadowed.png',
					),

					array(
						'label' => esc_html__( 'Filled', 'infinite-addons' ),
						'value' => 'filled',
						'image' => $url . 'filled.png'
					),

					array(
						'label' => esc_html__( 'Large Gradient Circle', 'infinite-addons' ),
						'value' => 'gradient-circle',
						'image' => $url . 'gradient-circle.png'
					),

					array(
						'label' => esc_html__( 'Process', 'infinite-addons' ),
						'value' => 'process',
						'image' => $url . 'process.png'
					)
				),
				'save_always' => true,
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'type',
				'heading'    => esc_html__( 'Icon Type', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Font', 'infinite-addons' )	=> 'font',
					esc_html__( 'Image', 'infinite-addons' )	=> 'image',
					esc_html__( 'SVG', 'infinite-addons' )	=> 'svg'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'id' => 'title',
				'group' => esc_html__( 'Content', 'infinite-addons' ),
			),

			array(
				'type'       => 'param_group',
				'param_name' => 'items',
				'heading'    => esc_html__( 'Title slide rotator words', 'infinite-addons' ),
				'params'     => array(
					array(
						'type'        => 'textfield',
						'param_name'  => 'word',
						'heading'     => esc_html__( 'Title word', 'infinite-addons' ),
						'description' => esc_html__( 'Add word for title rotator', 'infinite-addons' ),
						'admin_label' => true,
					),
				),
				'group' => esc_html__( 'Content', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'effect',
					'value' => array(
						'slide_horizontal_effect',
						'slide_horizontal_vertical'
					),
				),
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'heading_size',
				'heading'    => esc_html__( 'Title Size', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Default', 'infinite-addons' )	  => '',
					esc_html__( 'Extra Small', 'infinite-addons' ) => 'icon-box-heading-xsm',
					esc_html__( 'Small', 'infinite-addons' )		  => 'icon-box-heading-sm',
					esc_html__( 'Medium', 'infinite-addons' )	  => 'icon-box-heading-md',
					esc_html__( 'Large', 'infinite-addons' )		  => 'icon-box-heading-lg',
					esc_html__( 'Extra Large', 'infinite-addons' ) => 'icon-box-heading-xlg',
					esc_html__( 'Custom', 'infinite-addons' )	  => 'custom',
				),
				'group' => esc_html__( 'Content', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-4'
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'heading_weight',
				'heading'    => esc_html__( 'Title Weight', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Default', 'infinite-addons' )   => '',
					esc_html__( 'Light', 'infinite-addons' )     => 'weight-light',
					esc_html__( 'Normal', 'infinite-addons' )    => 'weight-normal',
					esc_html__( 'Medium', 'infinite-addons' )    => 'weight-medium',
					esc_html__( 'Semi Bold', 'infinite-addons' ) => 'weight-semibold',
					esc_html__( 'Bold', 'infinite-addons' )      => 'weight-bold'
				),
				'group' => esc_html__( 'Content', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-4'
			),


			array(
				'type'        => 'dropdown',
				'param_name'  => 'effect',
				'heading'     => esc_html__( 'Effect', 'infinite-addons' ),
				'description' => esc_html__( 'Select title effect', 'infinite-addons' ),
				'value'       => array(
					esc_html__( 'None', 'infinite-addons' )    => '',
					esc_html__( 'Filling', 'infinite-addons' ) => 'filling_effect',
					esc_html__( 'Resolving', 'infinite-addons' ) => 'resolving_effect',
					esc_html__( 'Text Slide Horizontal', 'infinite-addons' ) => 'slide_horizontal_effect',
					esc_html__( 'Text Slide Vertical', 'infinite-addons' ) => 'slide_horizontal_vertical',
				),
				'group' => esc_html__( 'Content', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'        => 'textarea_html',
				'param_name'  => 'content',
				'heading'     => esc_html__( 'Content', 'infinite-addons' ),
				'holder'      => 'div',
				'group' => esc_html__( 'Content', 'infinite-addons' )
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'show_button',
				'heading'    => esc_html__( 'Show Button', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'No', 'infinite-addons' )  => '',
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes'
				),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'group' => esc_html__( 'Content', 'infinite-addons' ),
			),

		);

		$icon = rella_get_icon_params( false, null, 'all', array( 'align', 'color' ), 'i_', array( 'element' => 'type', 'value' => 'font' ) );
		$img_params = array(
			array(
				'type'        => 'rella_attach_image',
				'param_name'  => 'image',
				'heading'     => esc_html__( 'Upload SVG/Image', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'type',
					'value'   => array( 'svg', 'image' )
				)
			)
		);

		$svg_params = array(

			array(
				'type'       => 'dropdown',
				'param_name' => 'animation',
				'heading'    => esc_html__( 'Animate SVG Icon?', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'No', 'infinite-addons' )  => '',
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes'
				),
				'dependency' => array(
					'element' => 'type',
					'value' => 'svg',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'hover_animation',
				'heading'    => esc_html__( 'Restart Animation on Hover', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'No', 'infinite-addons' )  => '',
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes'
				),
				'dependency' => array(
					'element' => 'animation',
					'value' => 'yes',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'       => 'textfield',
				'param_name' => 'animation_delay',
				'heading'    => esc_html__( 'SVG Animation Delay', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'animation',
					'value' => 'yes',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'textfield',
				'param_name' => 'svg_width',
				'heading'    => esc_html__( 'SVG width', 'infinite-addons' ),
				'description' => esc_html__( 'Add svg width in px, ex. 40px', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'type',
					'value' => 'svg',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
		);

		$counter_params = array(

			array(
				'type'       => 'subheading',
				'param_name' => 'sh_counter',
				'heading'    => esc_html__( 'Counter / Serial / Rating', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'counter',
				'heading'     => esc_html__( 'Counter', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-4'
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'serial',
				'heading'     => esc_html__( 'Serial', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-4'
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'rating',
				'heading'     => esc_html__( 'Rating', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-4'
			),
		);

		$styling_params = array(

			array(
				'type'       => 'subheading',
				'param_name' => 'sh_separator',
				'heading'    => esc_html__( 'Icon Properties', 'infinite-addons' )
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'background_shape',
				'heading'    => 'Shape',
				'value'      => array(
					esc_html__( 'None', 'infinite-addons' )             => '',
					esc_html__( 'Circle', 'infinite-addons' )           => 'circle',
					esc_html__( 'Circle Bordered', 'infinite-addons' )  => 'circle-bordered',
					esc_html__( 'Square', 'infinite-addons' )           => 'square',
					esc_html__( 'Square Bordered', 'infinite-addons' )  => 'square-bordered',
					esc_html__( 'Lozenge', 'infinite-addons' )          => 'lozenge',
					esc_html__( 'Hexagon', 'infinite-addons' )          => 'hexagon'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'shape_size',
				'heading'    => esc_html__( 'Shape Size', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Default', 'infinite-addons' )	  => '',
					esc_html__( 'Extra Small', 'infinite-addons' ) => 'xsm',
					esc_html__( 'Small', 'infinite-addons' )		  => 'sm',
					esc_html__( 'Medium', 'infinite-addons' )	  => 'md',
					esc_html__( 'Large', 'infinite-addons' )		  => 'lg',
					esc_html__( 'Extra Large', 'infinite-addons' ) => 'xlg',
					esc_html__( 'Custom', 'infinite-addons' )      => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type' => 'textfield',
				'param_name' => 'shape_custom',
				'heading' => esc_html__( 'Custom shape size', 'infinite-addons' ),
				'description' => esc_html__( 'Add size in px, ex. 60px', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'shape_size',
					'value' => 'custom'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Icon Position', 'infinite-addons' ),
				'param_name' => 'position',
				'value'      => array(
					esc_html__( 'Default', 'infinite-addons' )        => '',
					esc_html__( 'Heading Inline', 'infinite-addons' ) => 'icon-box-inline',
					esc_html__( 'Content Inline', 'infinite-addons' ) => 'icon-box-side'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Alignment', 'infinite-addons' ),
				'param_name' => 'alignment',
				'value'      => array(
					esc_html__( 'Default', 'infinite-addons' ) => '',
					esc_html__( 'Left', 'infinite-addons' )    => 'text-left',
					esc_html__( 'Right', 'infinite-addons' )   => 'text-right',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Icon vertical alignment', 'infinite-addons' ),
				'param_name' => 'valignment',
				'value'      => array(
					esc_html__( 'Default', 'infinite-addons' ) => '',
					esc_html__( 'Middle', 'infinite-addons' )  => 'icon-middle',
				),
				'dependency' => array(
					'element' => 'position',
					'value'   => array( 'icon-box-side' )
				),
			)

		);

		//Title Effects Options
		$effects_params = array(

			array(
				'type'        => 'subheading',
				'param_name'  => 'sh_text_sliding',
				'heading'     => esc_html__( 'Icon Styling', 'infinite-addons' )
			),

		);

		//Design Options
		$design_params = array(

			array(
				'type'       => 'css_editor',
				'param_name' => 'css',
				'heading'    => esc_html__( 'CSS box', 'infinite-addons' ),
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'primary_color',
				'heading'     => esc_html__( 'Primary Color', 'infinite-addons' ),
			),

			array(
				'type' => 'colorpicker',
				'param_name' => 'hb_color',
				'heading'     => esc_html__( 'Hover state - Border Color', 'infinite-addons' ),
				'description' => esc_html__( 'Border color on hover state', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'template',
					'value'   => 'card',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type' => 'colorpicker',
				'param_name' => 'hb_color_2',
				'heading'     => esc_html__( 'Hover state - Border Color 2', 'infinite-addons' ),
				'description' => esc_html__( 'Border color 2 on hover state, for gradient.', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'template',
					'value'   => 'card',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			// icon
			array(
				'type'        => 'subheading',
				'param_name'  => 'sh_icon',
				'heading'     => esc_html__( 'Icon Styling', 'infinite-addons' )
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'icon_color',
				'heading'     => esc_html__( 'Color', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'type',
					'value'   => array( 'font', 'svg' )
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'icon_color2',
				'heading'     => esc_html__( 'Second Color', 'infinite-addons' ),
				'description' => esc_html__( 'Used for Font/SVG icon to create gradient effect.', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'type',
					'value'   => array( 'font', 'svg' )
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'h_icon_color',
				'heading'     => esc_html__( 'Hover Color', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'type',
					'value'   => array( 'font', 'svg' )
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'h_icon_color_2',
				'heading'     => esc_html__( 'Second Hover Color', 'infinite-addons' ),
				'description' => esc_html__( 'Used for Font/SVG icon to create gradient effect.', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'type',
					'value'   => array( 'font', 'svg' )
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'brd_color',
				'heading'     => esc_html__( 'Border Color', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'background_shape',
					'value'   => array( 'circle-bordered', 'square-bordered' )
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'h_brd_color',
				'heading'     => esc_html__( 'Hover Border Color', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'background_shape',
					'value'   => array( 'circle-bordered', 'square-bordered' )
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'icon_bg',
				'heading'     => esc_html__( 'Background', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'h_icon_bg',
				'heading'     => esc_html__( 'Hover Background', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'         => 'checkbox',
				'param_name'   => 'enable_bg',
				'heading'      => esc_html__( 'Use gradient background?', 'infinite-addons' ),
				'description'  => esc_html__( 'If checked, gradient color will be used as background.', 'infinite-addons' ),
				'value'        => array(
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes'
				),
				'dependency' => array(
					'element' => 'background_shape',
					'value' => array( 'circle', 'square', 'lozenge' )
				),
			),

			array(
				'type'        => 'gradient',
				'param_name'  => 'gradient_bg',
				'heading'     => esc_html__( 'Gradient Background', 'infinite-addons' ),
				'dependency'  => array(
					'element'   => 'enable_bg',
					'not_empty' => true,
				),
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'icon_fs',
				'heading'     => esc_html__( 'Size', 'infinite-addons' ),
				'description' => esc_html__( 'Add size in pixels e.g 15px', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'type',
					'value'   => array( 'font' )
				)
			),

			//title customization
			array(
				'type'        => 'subheading',
				'param_name'  => 'sh_content',
				'heading'     => esc_html__( 'Content Styling', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
			),

			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Use for Title theme default font family?', 'infinite-addons' ),
				'param_name'  => 'use_theme_fonts',
				'value'       => array(
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes'
				),
				'description' => esc_html__( 'Use font family from the theme.', 'infinite-addons' ),
				'std'         => 'yes',
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
			),

			array(
				'type'       => 'google_fonts',
				'param_name' => 'heading_font',
				'value'      => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
				'settings'   => array(
					'fields' => array(
						'font_family_description' => esc_html__( 'Select font family.', 'infinite-addons' ),
						'font_style_description'  => esc_html__( 'Select font styling.', 'infinite-addons' ),
					),
				),
				'dependency' => array(
					'element'            => 'use_theme_fonts',
					'value_not_equal_to' => 'yes',
				),
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'title_size',
				'heading'     => esc_html__( 'Title Size', 'infinite-addons' ),
				'description' => esc_html__( 'Add size in pixels/em e.g 15px', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'title_color',
				'heading'     => esc_html__( 'Title Color', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			//content customization
			array(
				'type'        => 'textfield',
				'param_name'  => 'content_size',
				'heading'     => esc_html__( 'Content Size', 'infinite-addons' ),
				'description' => esc_html__( 'Add size in pixels e.g 15px', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'content_color',
				'heading'     => esc_html__( 'Content Color', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			//counter customization
			array(
				'type'        => 'textfield',
				'param_name'  => 'counter_size',
				'heading'     => esc_html__( 'Counter Size', 'infinite-addons' ),
				'description' => esc_html__( 'Add size in pixels e.g 15px', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'colorpicker',
				'param_name'  => 'counter_color',
				'heading'     => esc_html__( 'Counter Color', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6',
			)
		);

		foreach( $design_params as &$param ) {
			$param['group'] = esc_html__( 'Design Options', 'infinite-addons' );
		}

		$this->params = array_merge( $advanced, $params, $icon, $img_params, $svg_params, $counter_params, $styling_params, $design_params, $effect, $button );
		$this->add_extras();
	}

	protected function load_js_sc() {

		$args = array( 'no_js' );

		if( 'svg' === $this->atts['type'] ){
			array_push( $args,
				'vivus'
			);
		}
		if( 'yes' === $this->atts['animation'] ){
			array_push( $args,
				'jquery-appear'
			);
		}
		if( ! empty( $this->atts['counter'] ) ) {
			array_push( $args,
				'jquery-countTo',
				'jquery-appear'
			);
		}
		if( 'filling_effect' === $this->atts['effect'] || 'resolving_effect' === $this->atts['effect'] ) {
			array_push( $args,
				'SplitText',
				'jquery-appear'
			);
		}
		if( 'slide_horizontal_effect' === $this->atts['effect'] || 'slide_horizontal_vertical' === $this->atts['effect'] ) {
			array_push( $args,
				'jquery-appear'
			);
		}

		return $args;
	}

	protected function get_class( $id ) {

		$hash = array(
			'app'			=> 'icon-box icon-box-app',
			'boxed'			=> 'icon-box icon-box-boxed-unfilled',
			'boxed-alt'		=> 'icon-box icon-box-boxed-unfilled-alt',
			'boxed-alt2'	=> 'icon-box icon-box-boxed-unfilled-alt2',
			'boxed-alt3'	=> 'icon-box icon-box-boxed-unfilled-alt3',
			'boxed-alt4'	=> 'icon-box icon-box-boxed-unfilled-alt4',
			'boxed-alt5'	=> 'icon-box icon-box-boxed-unfilled-alt5 icon-box-heading-uppercase',
			'card'			=> 'icon-box icon-box-boxed-unfilled-card icon-box-heading-uppercase counter-box counter-box-sm',
			'ci'			=> 'icon-box icon-box-ci',
			'ci2'			=> 'icon-box icon-box-ci icon-box-heading-uppercase',
			'ci3'			=> 'icon-box icon-middle icon-box-ci-alt',
			'filled'		=> 'icon-box icon-box-boxed-filled',
			'shadow'        => 'icon-box icon-box-shadow-onhover',
			'shadowed'      => 'icon-box icon-container-shadowed',
			'process'		=> 'icon-box icon-box-counter-lg'
		);

		return !empty( $hash[ $id ] ) ? $hash[ $id ] : 'icon-box';
	}

	protected function get_shape( $el ) {

		$hash = array(
			'circle'          => 'icon-box-circle',
			'circle-bordered' => 'icon-box-circle icon-box-bordered',
			'square'          => 'icon-box-square',
			'square-bordered' => 'icon-box-square icon-box-bordered',
			'lozenge'         => 'icon-box-lozenge',
			'hexagon'         => 'icon-box-hexagon'
		);

		return !empty( $hash[ $el ] ) ? $hash[ $el ] : false;
	}

	protected function get_shape_size() {

		if ( empty( $this->atts['shape_size'] ) ){
			return;
		}

		$shape_size = $this->atts['shape_size'];

		return 'icon-box-' . $shape_size;

	}

	protected function get_counter() {

		// check
		if( empty( $this->atts['counter'] ) ) {
			return '';
		}
		$weight = $this->atts['heading_weight'];

		$counter = esc_html( $this->atts['counter'] );

		printf( '<span class="counter-element %s"><span>%d</span></span>', $weight,  $counter );
	}

	protected function get_counter_classes() {

		// check
		if ( empty( $this->atts['counter'] ) ) {
			return '';
		}

		if ( 'icon-box-side' == $this->atts['position'] ) {
			return 'counter-box counter-box-md';
		}
		else {
			return '';
		}

	}

	protected function get_rating() {

		// check
		if( empty( $this->atts['rating'] ) ) {
			return '';
		}

		$stars = '';
		$rating = floatval( $this->atts['rating'] );

		for( $i=0; $i<intval($rating); $i++ ) {
			$stars .= sprintf( '<li><i class="fa fa-star"></i></li>' );
		}
		if( $rating - intval($rating) ) {
			$stars .= sprintf( '<li><i class="fa fa-star-half"></i></li>' );
		}

		printf( '<ul class="star-rating">%s</ul>', $stars );
	}

	protected function get_title() {

		$title  = wp_kses_post( do_shortcode( $this->atts['title'] ) ) . $this->get_title_words();
		$weight = $this->atts['heading_weight'];

		if ( ! empty ( $weight ) ) {
			$weight	 = ' class="' . $weight . '" ';
		}

		if( ! empty( $this->atts['serial'] ) && 'process' != $this->atts['template'] ) {
			$title = sprintf( '%1$s <span class="counter">0%2$d</span></h3>', $title, $this->atts['serial'] );
		}

		printf( '<h3%s>%s</h3>', $weight, $title );
	}

	protected function get_content() {

		// check
		if( empty( $this->atts['content'] ) ) {
			return;
		}

		echo wp_kses_post( ra_helper()->do_the_content( $this->atts['content'] ) );
	}

	protected function before_icon_box_content() {

		// check
		if( 'icon-box-inline' === $this->atts['position'] && empty( $this->atts['counter'] ) && empty( $this->atts['content'] ) && empty( $this->atts['rating'] ) && empty( $this->atts['show_button'] ) ) {
			return '';
		}

		return '<div class="contents">';
	}

	protected function after_icon_box_content() {

		// check
		if( 'icon-box-inline' === $this->atts['position'] && empty( $this->atts['counter'] ) && empty( $this->atts['content'] ) && empty( $this->atts['rating'] ) && empty( $this->atts['show_button'] ) ) {
			return '';
		}

		return '</div>';

	}

	protected function get_svg_border(){

		$style = $this->atts['style'];

	}

	protected function get_title_effect() {

		if( empty( $this->atts['effect'] ) ){
			return;
		}

		$effect = $this->atts['effect'];
		$tag    = $this->atts['effect_tag'];
		$effect_data = $effect_opts = array();

		$effect_opts['element'] = $tag;

		if( 'filling_effect' === $effect ){
			$effect_data[] = ' data-plugin-fillIn="true" ';
			$effect_data[] = ' data-plugin-fillin-options=\'' . wp_json_encode( $effect_opts ) . '\' ';
		}
		elseif( 'resolving_effect' === $effect ) {
			$effect_opts['seperator'] = $this->atts['seperator'];
			$effect_opts['startDelay'] = ! empty( $this->atts['startdelay'] ) ? (int)$this->atts['startdelay'] : 0 ;

			if( ! empty( $this->atts['start_resolving'] ) ) {
				$effect_opts['start'] =  (float)$this->atts['start_resolving'];
			}

			if( ! empty( $this->atts['end_resolving'] ) ) {
				$effect_opts['end'] = (float)$this->atts['end_resolving'];
			}

			$effect_data[] = ' data-plugin-resolve="true" ';
			$effect_data[] = ' data-plugin-resolve-options=\'' . wp_json_encode( $effect_opts ) . '\' ';
		}
		elseif( 'slide_horizontal_effect' === $effect ){

			$effect_opts['autoplay'] = ( 'yes' === $this->atts['autoplay'] ) ? true : false;

			if( ! empty( $this->atts['delay'] ) ) {
				$effect_opts['delay'] =  (int)$this->atts['delay'];
			}

			$effect_data[] = ' data-plugin-texteffect="true" ';
			$effect_data[] = ' data-plugin-options=\'' . wp_json_encode( $effect_opts ) . '\' ';
		}
		elseif( 'slide_horizontal_vertical' === $effect ) {

			$effect_opts['autoplay'] = ( 'yes' === $this->atts['autoplay'] ) ? true : false;

			if( ! empty( $this->atts['delay'] ) ) {
				$effect_opts['delay'] =  (int)$this->atts['delay'];
			}

			$effect_data[] = ' data-plugin-textslide="true" ';
			$effect_data[] = ' data-plugin-textslide-options=\'' . wp_json_encode( $effect_opts ) . '\' ';
		}

		$effect_data =  implode( ' ', $effect_data );
		echo $effect_data;

	}

	protected function get_title_words() {

		if( empty( $this->atts['items'] ) ) {
			return;
		}

		$words = vc_param_group_parse_atts( $this->atts['items'] );
		$words = array_filter( $words );

		if( empty( $words ) ) {
			return;
		}

		$out = '';

		if( 'slide_horizontal_effect' === $this->atts['effect'] ) {

			$out .= ' <span class="typed-strings">';
			foreach ( $words as $word ) {
				$out .= '<span>' . esc_html( $word['word'] ) . '</span>';
			}
			$out .= '</span><!-- /.typed-strings -->';

			return $out;

		}
		elseif( 'slide_horizontal_vertical' === $this->atts['effect'] ) {

			$out .= ' <span class="typed-keywords">';
			$i = 1;
			foreach ( $words as $word ) {
				$active = ( $i == 1 ) ? ' active' : '';
				$out .= '<span class="keyword' . $active . '">' . esc_html( $word['word'] ) . '</span>';
				$i++;
			}
			$out .= '</span><!-- /.typed-keywords -->';

			return $out;

		}

	}

	protected function get_the_icon() {

		$type  = $this->atts['type'];
		$style = $this->atts['template'];

		$attributes = array(
			'class' => 'icon-container'
		);

		if ( 'svg' == $this->atts['type'] ) {
			// if( in_array( $style, array( 'shadow' ) ) ) {

				$shadow_svg = array();

				$attributes['class'] = 'icon-container';
				$attributes['data-plugin-animated-icon'] = true;

				if ( ! empty( $this->atts['icon_color'] ) ) {
					$shadow_svg['color'] = $this->atts['icon_color'];
				}

				if ( ! empty( $this->atts['icon_color2'] ) ) {
					$shadow_svg['color'] .= ',' . $this->atts['icon_color2'];
				}

				if ( ! empty( $this->atts['h_icon_color'] ) ) {
					$shadow_svg['hoverColor'] = $this->atts['h_icon_color'];
				}

				if ( ! empty( $this->atts['h_icon_color_2'] ) ) {
					$shadow_svg['hoverColor'] .= ',' . $this->atts['h_icon_color_2'];
				}

				if( empty( $this->atts['animation'] ) ) {
					$shadow_svg['animated'] = false;
				} else {
					$shadow_svg['animated'] = true;
				}

				if( 'yes' === $this->atts['hover_animation'] ) {
					$shadow_svg['resetOnHover'] = true;
				}

				$attributes['data-plugin-options'] = wp_json_encode( $shadow_svg );

			// } else {

				$attributes['class'] = 'icon-container appear-animation-visible';
				$attributes['data-plugin-animated-icon'] = true;

			// }
		}

		if ( ! empty( $this->atts['animation'] ) && 'svg' == $this->atts['type'] ) {
			$svg = array();

			if ( ! empty( $this->atts['icon_color'] ) ) {
				$svg['color'] = $this->atts['icon_color'];
			}

			if ( ! empty( $this->atts['icon_color2'] ) ) {
				$svg['color'] .= ',' . $this->atts['icon_color2'];
			}

			if( ! empty( $this->atts['h_icon_color'] ) ) {
				$svg['hoverColor'] = $this->atts['h_icon_color'];
			}

			if ( ! empty( $this->atts['animation_delay'] ) ) {
				$svg['delay'] = $this->atts['animation_delay'];
			}

			if( 'yes' === $this->atts['hover_animation'] ) {
				$svg['resetOnHover'] = true;
			}

			if ( ! empty( $svg ) && 'shadow' !== $style ) {
				$attributes['data-plugin-options'] = json_encode( $svg );
			}
		}

		printf('<span%s>', ra_helper()->html_attributes( $attributes ) );

		if ( 'svg' === $type ) {
			if( preg_match( '/^\d+$/', $this->atts['image'] ) ){
				$image = rella_include_svg( $this->atts['image'] );
			}
			else {
				$image = $this->atts['image'];
			} 
			echo file_get_contents( $image );
		}
		elseif ( 'image' === $type ) {
			if( preg_match( '/^\d+$/', $this->atts['image'] ) ){
				$image = rella_get_image( $this->atts['image'] );
			}
			else {
				$image = $this->atts['image'];
			} 
			printf( '<img src="%s" alt="" />', $image );
		}
		else {
			$icon = rella_get_icon( $this->atts );
			if( !empty( $icon['type'] ) ) {
				printf( '<i class="%s"></i>', $icon['icon'] );
			}
		}

		echo '</span>';
	}

	protected function get_button() {

		if ( empty( $this->atts['show_button'] ) ) {
			return;
		}

		$data = vc_map_integrate_parse_atts( $this->slug, 'ra_button', $this->atts, 'ib_' );
		if ( $data ) {

			$btn = visual_composer()->getShortCode( 'ra_button' )->shortcodeClass();

			if ( is_object( $btn ) ) {
				echo $btn->render( array_filter( $data ) );
			}
		}
	}

	protected function generate_css() {

		extract( $this->atts );

		$bg = $elements = array();
		$id = '.' . $this->get_id();
		$title_font_inline_style = '';

		if( 'yes' !== $use_theme_fonts ) {

			// Build the data array
			$title_font_data = $this->get_fonts_data( $heading_font );

			// Build the inline style
			$title_font_inline_style = $this->google_fonts_style( $title_font_data );

			// Enqueue the right font
			$this->enqueue_google_fonts( $title_font_data );

		}

		// Defaults
		$icon_bg = $icon_bg ? $icon_bg : $primary_color;

		if( 'svg' !== $type ) {
			$elements[rella_implode( '%1$s .icon-container' )] = array(
				'color'            => $icon_color,
				'font-size'        => $icon_fs,
				'width'            => $shape_custom,
				'height'           => $shape_custom,
				'line-height'      => $shape_custom,
			);
		}
		// General
		if( $icon_bg ) {
			$elements[rella_implode( '%1$s .icon-container' )]['background-color'] = $icon_bg;
		}
		if( $brd_color ) {
			$elements[rella_implode( '%1$s .icon-container' )]['border-color'] = $brd_color . '!important';
		}

		if( 'svg' === $type && ! empty( $shape_custom ) ) {
			$elements[rella_implode( '%1$s.icon-box .icon-container' )] = array(
				'width'  => $shape_custom,
				'height' => $shape_custom,
			);
		}

		if( 'hexagon' === $background_shape && ! empty( $shape_custom ) ) {
			$shape_custom = ( (int)$shape_custom / 1.6667 ) . 'px';
			$elements[rella_implode( '%1$s .icon-container' )]['height'] = $shape_custom;
		}
		
		//Hover General
		if( ! empty( $h_icon_bg ) ) {
			$elements[rella_implode( '%1$s:hover .icon-container' )]['background-color'] = $h_icon_bg;
		}
		if( ! empty( $h_icon_color ) ) {
			$elements[rella_implode( '%1$s:hover .icon-container' )]['color'] = $h_icon_color;
		}
		if( ! empty( $h_brd_color ) ) {
			$elements[rella_implode( '%1$s:hover .icon-container' )]['border-color'] = $h_brd_color . '!important';
		}

		if ( 'square-bordered' === $background_shape ) {

			if ( ! empty( $h_brd_color ) ) {

				$elements[rella_implode( '%1$s.icon-box-bordered .icon-container:before, %1$s.icon-box-bordered .icon-container:after' )] = array(
					'content' => 'none'
				);

			}

		}

		$elements[rella_implode( '%1$s h3' )] = array(
			$title_font_inline_style,
			'color'     => $title_color,
			'font-size' => $title_size
		);

		$elements[rella_implode( '%1$s .contents p' )] = array(
			'color'     => $content_color,
			'font-size' => $content_size
		);

		/*
			* Using js to set svg colors
			* colors and hover colors are applied to data-plugin-options attribute
		*/

		// if ( empty( $animation ) && 'svg' == $type ) {
		// 	$elements[rella_implode( array( '%1$s .icon-container svg polyline', '%1$s .icon-container svg polygon', '%1$s .icon-container svg circle', '%1$s .icon-container svg path', '%1$s .icon-container svg rect', '%1$s .icon-container svg ellipse' ) )] = array(
		// 		'stroke' => $icon_color
		// 	);
		// 	$elements[rella_implode( array( '%1$s.icon-box .icon-container img[src$=".svg"], %1$s.icon-box .icon-container object, %1$s.icon-box .icon-container svg' ) )] = array(
		// 		'fill' => $icon_color
		// 	);
		// }

		// if ( empty( $animation ) && 'svg' == $type ) {
		// 	$elements[rella_implode( array( '%1$s:hover .icon-container svg polyline', '%1$s:hover .icon-container svg polygon', '%1$s:hover .icon-container svg circle', '%1$s:hover .icon-container svg path', '%1$s:hover .icon-container svg rect', '%1$s:hover .icon-container svg ellipse' ) )] = array(
		// 		'stroke' => $h_icon_color
		// 	);
		// 	$elements[rella_implode( array( '%1$s.icon-box:hover .icon-container img[src$=".svg"], %1$s.icon-box:hover .icon-container object, %1$s.icon-box:hover .icon-container svg' ) )] = array(
		// 		'fill' => $h_icon_color
		// 	);
		// }

		if ( empty( $animation ) && 'font' == $type && $icon_color2 ) {
			$elements[rella_implode( '.backgroundcliptext %1$s .icon-container i' )] = array(
				'background'              => 'linear-gradient(to right, ' . $icon_color . ', ' . $icon_color2 . ')',
				'background-clip'         => 'text',
				'-webkit-background-clip' => 'text',
				'text-fill-color'         => 'transparent',
				'-webkit-text-fill-color' => 'transparent',
				'line-height' => '1.15em !important'
			);
			if( ! empty( $h_icon_color ) ) {
				$h_icon_color_2 = ! empty( $h_icon_color_2 ) ? $h_icon_color_2 : $h_icon_color;
				$elements[rella_implode( '.backgroundcliptext %1$s:hover .icon-container i' )] = array(
					'background'              => 'linear-gradient(to right, ' . $h_icon_color . ', ' . $h_icon_color_2 . ')',
					'background-clip'         => 'text',
					'-webkit-background-clip' => 'text',
					'text-fill-color'         => 'transparent',
					'-webkit-text-fill-color' => 'transparent',
					'line-height' => '1.15em !important'
				);
			}
		}

		if( ! empty( $serial ) && 'process' != $template ) {
			$elements[rella_implode( '%1$s .counter' )] = array(
				'color' => $primary_color
			);
		}

		if( ! empty( $counter ) ) {
			$elements[rella_implode( '%1$s .counter-element' )] = array(
				'color'     => $counter_color,
				'font-size' => $counter_size
			);
		}

		$elements[rella_implode( '%1$s.with-sep h3:after' )] = array(
			'background-color' => $primary_color
		);

		if( ! empty( $brd_color ) ) {
			$elements[rella_implode( '%1$s .circle-gradient-border .border' )] = array(
				'stroke' => $brd_color . ' !important'
			);
		}

		if( ! empty( $hb_color ) ) {

			if( empty( $hb_color_2 ) ) $hb_color_2 = $hb_color;

			$elements[rella_implode( '%1$s.icon-box-boxed-unfilled-card:before, %1$s.icon-box-boxed-unfilled-card:after' )] = array(
				'background-image' => '-webkit-gradient(linear, left top, left bottom, from(' . $hb_color . '), to(' . $hb_color_2 . '))',
				'background-image' => 'linear-gradient(' . $hb_color . ' 0%, ' . $hb_color_2 . ' 100%)',
			);

			$elements[rella_implode( '%1$s.icon-box-boxed-unfilled-card:hover' )] = array(
				'border-color' =>  $hb_color,
				'border-bottom-color' => $hb_color_2
			);
		}

		// Template based
		if( 'boxed-alt3' == $template ) {
			$elements[rella_implode( '%1$s:hover' )] = array(
				'background-color' => $primary_color
			);

			$selector = array(
				'%1$s:hover h3',
				'%1$s:hover p',
				'%1$s:hover .btn',
				'%1$s:hover .icon-container',
				'%1$s:hover .counter',
			);
			$elements[rella_implode( $selector )] = array(
				'color' => '#fff'
			);
		}

		if( 'filled' == $template ) {
			$elements[rella_implode( '%1$s' )] = array(
				'background-color' => $primary_color
			);
		}

		if( ! empty( $svg_width ) ) {
			$elements[rella_implode( '%1$s .icon-container svg' )]['width'] = $svg_width;
		}

		//Gradient background color
		if( ! empty ( $gradient_bg ) ) {
			$bg = rella_parse_gradient( $gradient_bg );
			$elements[rella_implode( '%1$s .icon-container' )] = $bg;
		}

		$this->dynamic_css_parser( $id, $elements );
	}

}
new RA_Icon_Box;