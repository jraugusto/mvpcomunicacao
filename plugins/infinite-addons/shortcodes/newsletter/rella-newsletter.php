<?php
/**
* Shortcode Newsletter
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Newsletter extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_newsletter';
		$this->title       = esc_html__( 'Newsletter', 'infinite-addons' );
		$this->description = esc_html__( 'Create a newsletter.', 'infinite-addons' );
		$this->icon        = 'fa fa-envelope';
		$this->styles      = array( 'rella-sc-subscribe-form', 'rella-sc-button' );

		parent::__construct();
	}

	public function get_params() {

		$url = rella_addons()->plugin_uri() . '/assets/img/sc-preview/newsletter/';

		$general = array(

			array(
				'type'        => 'dropdown',
				'param_name'  => 'newsletter_id',
				'heading'     => esc_html__( 'Newsletter ID', 'infinite-addons' ),
				'description' => esc_html__( 'Choose newsletter to be displayed. MailPoet WP plugin is required to use this feature.', 'infinite-addons' ),
				'value'       => array_merge_recursive( array( 'Choose' => '' ) , array_flip( $this->get_mailpoet_forms() ) ),
				'admin_label' => true,
			),

			array(
				'type'       => 'select_preview',
				'param_name' => 'style',
				'heading'    => esc_html__( 'Input Style', 'infinite-addons' ),
				'value'      => array(

					array(
						'value' => 'bordered',
						'label' => esc_html__( 'Bordered', 'infinite-addons' ),
						'image' => $url . 'input-bordered.png'
					),

					array(
						'label' => esc_html__( 'Solid', 'infinite-addons' ),
						'value' => 'solid',
						'image' => $url . 'input-solid.png'
					),

					array(
						'label' => esc_html__( 'Underlined', 'infinite-addons' ),
						'value' => 'underlined',
						'image' => $url . 'input-underlined.png'
					),
				),
				'save_always' => true,
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'inputs_size',
				'heading'    => esc_html__( 'Size', 'infinite-addons' ),
				'description' => esc_html__( 'Select input border size', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Default', 'infinite-addons' ) => 'subscribe-form--size-md',
					esc_html__( 'xSmall', 'infinite-addons' )  => 'subscribe-form--size-xs',
					esc_html__( 'Small', 'infinite-addons' )  => 'subscribe-form--size-sm',
					esc_html__( 'Medium', 'infinite-addons' )  => 'subscribe-form--size-md',
					esc_html__( 'Large', 'infinite-addons' )   => 'subscribe-form--size-lg',
					esc_html__( 'xLarge', 'infinite-addons' )   => 'subscribe-form--size-xl',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'inputs_radius',
				'heading'    => esc_html__( 'Border radius', 'infinite-addons' ),
				'description' => esc_html__( 'Select input border radius', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Sharp', 'infinite-addons' )    => 'subscribe-form--sharp',
					esc_html__( 'Semi Round', 'infinite-addons' ) => 'subscribe-form--semi-round',
					esc_html__( 'Round', 'infinite-addons' )      => 'subscribe-form--round',
					esc_html__( 'Circle', 'infinite-addons' )     => 'subscribe-form--circle',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'inputs_border',
				'heading'    => esc_html__( 'Border thickness', 'infinite-addons' ),
				'description' => esc_html__( 'Select input border thickness', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Thin', 'infinite-addons' ) => 'subscribe-form--border-thin',
					esc_html__( 'Thick', 'infinite-addons' )   => 'subscribe-form--border-thick',
					esc_html__( 'Thicker', 'infinite-addons' ) => 'subscribe-form--border-thicker',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'inputs_shadow',
				'heading'    => esc_html__( 'Other', 'infinite-addons' ),
				'description' => esc_html__( 'Select input other styling', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Default', 'infinite-addons' )  => '',
					esc_html__( 'Shadowed 1', 'infinite-addons' ) => 'subscribe-form--input-shadow-1',
					esc_html__( 'Shadowed 2', 'infinite-addons' )     => 'subscribe-form--input-shadow-2',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

		);

		$button = array(

			array(
				'type'       => 'subheading',
				'param_name' => 'sh_buttons',
				'heading'    => esc_html__( 'Submit Button', 'infinite-addons' ),
			),

			array(
				'type'       => 'select_preview',
				'param_name' => 'btn_style',
				'heading'    => esc_html__( 'Submit Button Style', 'infinite-addons' ),
				'value'      => array(

					array(
						'value' => 'solid',
						'label' => esc_html__( 'Solid', 'infinite-addons' ),
						'image' => $url . 'btn-solid.png'
					),

					array(
						'label' => esc_html__( 'Bordered', 'infinite-addons' ),
						'value' => 'bordered',
						'image' => $url . 'btn-bordered.png'
					),

					array(
						'label' => esc_html__( 'Underlined', 'infinite-addons' ),
						'value' => 'underlined',
						'image' => $url . 'btn-underlined.png'
					),

					array(
						'label' => esc_html__( 'Naked', 'infinite-addons' ),
						'value' => 'naked',
						'image' => $url . 'btn-naked.png'
					),	
				),
				'save_always' => true,
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'btn_state',
				'heading'    => esc_html( 'Button state', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Display', 'infinite-addons' ) => 'subscribe-form--button-show',
					esc_html__( 'Hidden', 'infinite-addons' )  => 'subscribe-form--button-hidden',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'btn_display',
				'heading'    => esc_html__( 'Button display', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Button label', 'infinite-addons' )          => 'label',
					esc_html__( 'Icon', 'infinite-addons' )                  => 'icon',
					esc_html__( 'Button label and icon', 'infinite-addons' ) => 'label_icon',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'btn_position',
				'heading'    => esc_html__( 'Button Position', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Default', 'infinite-addons' )  => '',
					esc_html__( 'In input', 'infinite-addons' ) => 'subscribe-form--button-inside',
					esc_html__( 'Near input' )             => 'subscribe-form--button-inline',
					esc_html__( 'Under input' )            => 'subscribe-form--button-block',
				),
				'dependency' => array(
					'element' => 'btn_state',
					'value_not_equal_to' => 'subscribe-minimal',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

		);

		$icon = rella_get_icon_params( $add_icon = false, $group = '', $fonts = 'all',  $remove = array( 'color' ), $prefix = 'i_', array( 'element' => 'btn_display', 'value_not_equal_to' => 'label' ) );

		$design = array(

			//design options
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_inputs',
				'heading'    => esc_html__( 'Inputs', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'txt_color',
				'heading'    => esc_html__( 'Text Color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'bg_color',
				'heading'    => esc_html__( 'Background Color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'brd_color',
				'heading'    => esc_html__( 'Border Color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'sh_inputs_f',
				'heading'    => esc_html__( 'Inputs Focus', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'txt_f_color',
				'heading'    => esc_html__( 'Text Color', '_s' ),
				'group'      => esc_html__( 'Design Options', '_s' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'bg_f_color',
				'heading'    => esc_html__( 'Background Color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'brd_f_color',
				'heading'    => esc_html__( 'Border Color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'sh_buttons',
				'heading'    => esc_html__( 'Submit Button', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'btn_txt_color',
				'heading'    => esc_html__( 'Label color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'btn_bg_color',
				'heading'    => esc_html__( 'Background color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'btn_brd_color',
				'heading'    => esc_html__( 'Border color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'sh_buttons_hover',
				'heading'    => esc_html__( 'Hover Submit Button', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'hover_btn_txt_color',
				'heading'    => esc_html__( 'Label color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'hover_btn_bg_color',
				'heading'    => esc_html__( 'Background color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'hover_btn_brd_color',
				'heading'    => esc_html__( 'Border color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

		);



		$this->params = array_merge( $general, $button, $icon, $design );

		$this->add_extras();

	}

	/**
	 * Get MailPoet plugin forms (old Wysija Newsletter)
	 * @return array
	 */
	protected function get_mailpoet_forms() {

		if ( !class_exists('WYSIJA') ) {
			return array();
		}

		$model_forms = WYSIJA::get( 'forms', 'model' );
		$model_forms->reset();
		$forms = $model_forms->getRows( array( 'form_id', 'name' ) );
		$items = array();
		if (is_array($forms) && !is_wp_error($forms)) {
			foreach ($forms as $form) {
				$items[$form['form_id']] = $form['name'];
			}
		}

		return $items;
	}

	protected function get_data_plugin() {

		// if ( $this->atts['btn_position'] == 'subscribe-button-block' ) {
		// 	return '';
		// }

		echo 'data-plugin-subscribe-form="true"';
	}

	protected function data_plugin_opts() {

		$icon = rella_get_icon( $this->atts );

		extract( $icon );

		$data_opts = array();
		$data_opts['icon'] = ! empty ( $icon ) && $this->atts['btn_display'] != 'label' ? $icon : '';

		echo 'data-plugin-options=\'' . wp_json_encode( $data_opts ) . '\' ';
	}

	protected function get_class( $style ) {

		$hash = array(
			'underlined' => 'subscribe-form--input-underlined',
			'solid'      => 'subscribe-form--input-solid',
			'bordered'   => 'subscribe-form--input-bordered',
		);

		return $hash[ $style ];
	}

	protected function get_btn_class( $style ) {

		$hash = array(
			'solid'      => 'subscribe-form--button-solid',
			'bordered'   => 'subscribe-form--button-bordered',
			'underlined' => 'subscribe-form--button-underlined',
			'naked'   => 'subscribe-form--button-naked',
		);

		return $hash[ $style ];
	}

	protected function if_icon() {

		if ( 'icon' == $this->atts['btn_display'] ) {
			return 'subscribe-form--button-hide-label';
		}
		return'';
	}

	protected function generate_css() {

		extract( $this->atts );
		$elements = array();
		$id = '.' .$this->get_id();

		include_once rella_addons()->plugin_dir() . 'includes/rella-color.php';

		$elements[rella_implode( '%1$s.subscribe-form input[type="text"], %1$s.subscribe-form select' )] = array(
			'background-color' => $bg_color,
			'color'            => $txt_color,
			'border-color'     => $brd_color
		);

		$elements[rella_implode( '%1$s.subscribe-form input[type="text"]:focus, %1$s.subscribe-form select:focus' )] = array(
			'background-color' => $bg_f_color,
			'color'            => $txt_f_color,
			'border-color'     => $brd_f_color
		);

		$elements[rella_implode( '%1$s.subscribe-form input.wysija-submit, %1$s.subscribe-form .wysija-submit' )] = array(
			'background-color' => $btn_bg_color,
			'color'            => $btn_txt_color,
			'border-color'     => $btn_brd_color
		);

		$elements[rella_implode( '%1$s.subscribe-form input.wysija-submit:hover, %1$s.subscribe-form .wysija-submit:hover' )] = array(
			'background-color' => $hover_btn_bg_color,
			'color'            => $hover_btn_txt_color,
			'border-color'     => $hover_btn_brd_color
		);

		$this->dynamic_css_parser( $id, $elements );
	}


}
new RA_Newsletter;
