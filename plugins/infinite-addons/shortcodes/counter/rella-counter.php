<?php
/**
* Shortcode Counter
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Counter extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_counter';
		$this->title       = esc_html__( 'Counter', 'infinite-addons' );
		$this->icon        = 'fa fa-star';
		$this->description = esc_html__( 'Create counter.', 'infinite-addons' );
		$this->scripts     = array( 'jquery-appear', 'jquery-countTo' );
		$this->styles      = array( 'rella-sc-counter-box' );

		parent::__construct();
	}

	public function get_params() {

		$url = rella_addons()->plugin_uri() . '/assets/img/sc-preview/counter-box/';

		$content = array(

			array(
				'type'        => 'select_preview',
				'param_name'  => 'style',
				'heading'     => esc_html__( 'Style', 'infinite-addons' ),
				'admin_label' => true,
				'value'       => array(

					array(
						'value' => 's1',
						'label' => esc_html__( 'Default', 'infinite-addons' ),
						'image' => $url . 'default.png'
					),

					array(
						'label' => esc_html__( 'Bordered', 'infinite-addons' ),
						'value' => 's3',
						'image' => $url . 'bordered.png'
					),

					array(
						'label' => esc_html__( 'Circle Progress', 'infinite-addons' ),
						'value' => 's5',
						'image' => $url . 'circle-progress.png'
					),

					array(
						'label' => esc_html__( 'Dots', 'infinite-addons' ),
						'value' => 's2',
						'image' => $url . 'dots.png'
					),

					array(
						'label' => esc_html__( 'Downloads', 'infinite-addons' ),
						'value' => 's4',
						'image' => $url . 'download.png'
					)
				)
			),

			array(
				'type'       => 'textfield',
				'param_name' => 'label',
				'heading'    => esc_html__( 'Label', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-8'
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'weight',
				'heading'    => esc_html__( 'Label Weight', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Default', 'infinite-addons' )   => '',
					esc_html__( 'Light', 'infinite-addons' )     => 'weight-light',
					esc_html__( 'Normal', 'infinite-addons' )    => 'weight-normal',
					esc_html__( 'Medium', 'infinite-addons' )    => 'weight-medium',
					esc_html__( 'Semi Bold', 'infinite-addons' ) => 'weight-semibold',
					esc_html__( 'Bold', 'infinite-addons' )      => 'weight-bold'
				),
				'edit_field_class' => 'vc_col-sm-4'
			),

			array(
				'type'       => 'textfield',
				'param_name' => 'prefix',
				'heading'    => esc_html__( 'Prefix', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-4'
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'count',
				'heading'     => esc_html__( 'Count', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-4'
			),

			array(
				'type'       => 'textfield',
				'param_name' => 'suffix',
				'heading'    => esc_html__( 'Suffix', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-4'
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'size',
				'heading'    => esc_html__( 'Size', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Extra Small', 'infinite-addons' )   => 'xs',
					esc_html__( 'Small', 'infinite-addons' )         => 'sm',
					esc_html__( 'Medium', 'infinite-addons' )        => 'md',
					esc_html__( 'Large', 'infinite-addons' )         => 'lg',
					esc_html__( 'Extra Large', 'infinite-addons' )   => 'xlg',
					esc_html__( 'Extra Large 2', 'infinite-addons' ) => 'xxlg',
					esc_html__( 'Extra Large 3', 'infinite-addons' ) => 'xxlg2',
					esc_html__( 'Extra Large 4', 'infinite-addons' ) => 'xlg4',
					esc_html__( 'Extra Large 5', 'infinite-addons' ) => 'xlg5',
					esc_html__( 'Custom Size', 'infinite-addons' ) => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-4'
			),
			
			array(
				'type'        => 'textfield',
				'param_name'  => 'custom_size',
				'heading'     => esc_html__( 'Custom Size', 'infinite-addons' ),
				'description' => esc_html__( 'Add custom size with px. ex 20px', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'size',
					'value'   => 'custom'
				),
				'edit_field_class' => 'vc_col-sm-4',					
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'align',
				'heading'    => esc_html__( 'Alignment', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'None', 'infinite-addons' )  => '',
					esc_html__( 'Left', 'infinite-addons' )   => 'text-left',
					esc_html__( 'Center', 'infinite-addons' ) => 'text-center',
					esc_html__( 'Right', 'infinite-addons' )  => 'text-right'
				),
				'edit_field_class' => 'vc_col-sm-4'
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'counter_weight',
				'heading'    => esc_html__( 'Counter Weight', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Default', 'infinite-addons' )   => '',
					esc_html__( 'Light', 'infinite-addons' )     => 'weight-light',
					esc_html__( 'Normal', 'infinite-addons' )    => 'weight-normal',
					esc_html__( 'Medium', 'infinite-addons' )    => 'weight-medium',
					esc_html__( 'Semi Bold', 'infinite-addons' ) => 'weight-semibold',
					esc_html__( 'Bold', 'infinite-addons' )      => 'weight-bold'
				),
				'edit_field_class' => 'vc_col-sm-4'
			),

			array(
				'type'       => 'textfield',
				'param_name' => 'percent',
				'heading'    => esc_html__( 'Percent', 'infinite-addons' ),
				'std'        => '70',
				'dependency' => array(
					'element' => 'style',
					'value'   => 's5'
				),
				'edit_field_class' => 'vc_col-sm-4',
			)
		);

		$design = array(

			array(
				'type'             => 'colorpicker',
				'param_name'       => 'text_color',
				'heading'          => esc_html__( 'Text Color', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			
			array(
				'type'             => 'colorpicker',
				'param_name'       => 'counter_color',
				'heading'          => esc_html__( 'Counter Color', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'start_color',
				'heading'    => esc_html__( 'Circle Start Color', 'infinite-addons' ),
				'std'        => '#109df7',
				'dependency' => array(
					'element' => 'style',
					'value'   => 's5'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'end_color',
				'heading'    => esc_html__( 'Circle End Color', 'infinite-addons' ),
				'std'        => '#109df7',
				'dependency' => array(
					'element' => 'style',
					'value' => 's5'
				),
				'edit_field_class' => 'vc_col-sm-6',
			)
		);
		foreach( $design as &$param ) {
			$param['group'] = esc_html__( 'Design Options', 'infinite-addons' );
		}

		$this->params = array_merge( $content, $design );

		$this->add_extras();
	}

	public function before_output( $atts, &$content ) {

		if( 's3' == $atts['style'] ) {
			$atts['template'] = 'bordered';
		}
		if( 's4' == $atts['style'] ) {
			$atts['template'] = 'downloads';
		}
		if( 's5' == $atts['style'] ) {
			$atts['template'] = 'circle';
		}

		return $atts;
	}

	protected function get_class( $style ) {

		$hash = array(
			's1' => 'counter-box',
			's2' => 'counter-box counter-box-dots',
			's3' => 'counter-box counter-box-sep'
		);

		return isset( $hash[ $style ] ) ? $hash[ $style ] : $hash['s1'];
	}

	protected function generate_css() {
		
		extract( $this->atts );
		
		$elements = array();

		$id = '.' . $this->get_id();
		
		$elements[rella_implode( array( '%1$s h3', '%1$s p' ) )] = array(
			'color' => $text_color
		);
		
		$elements[rella_implode( array( '%1$s .contents .counter-element, %1$s .counter-element' ) )] = array(
			'color' => $counter_color . ' !important',
			'font-size' => $custom_size . ' !important',
		);

		$this->dynamic_css_parser( $id, $elements );
	}
}
new RA_Counter;
