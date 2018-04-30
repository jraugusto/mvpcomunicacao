<?php
/**
* Shortcode Progress Bar
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Progressbar extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_progressbar';
		$this->title       = esc_html__( 'Progressbar', 'infinite-addons' );
		$this->description = esc_html__( 'Create eye-catching progress bars', 'infinite-addons' );
		$this->icon        = 'fa fa-circle-o-notch';
		$this->scripts     = array( 'jquery-appear' );
		$this->styles      = array( 'rella-sc-progressbar' );

		parent::__construct();
	}

	public function get_params() {

		$url = rella_addons()->plugin_uri() . '/assets/img/sc-preview/progressbar/';

		$this->params = array(

			array(
				'type'        => 'select_preview',
				'param_name'  => 'style',
				'heading'     => esc_html__( 'Style', 'infinite-addons' ),
				'value'       => array(

					array(
						'value' => 'circular',
						'label' => esc_html__( 'Circular Bar', 'infinite-addons' ),
						'image' => $url . 'circular.png'
					),

					array(
						'label' => esc_html__( 'Gradient Bar', 'infinite-addons' ),
						'value' => 'gradient',
						'image' => $url . 'gradient.png'
					),

					array(
						'label' => esc_html__( 'Hexa Bar', 'infinite-addons' ),
						'value' => 'hexa',
						'image' => $url . 'hexa.png'
					),

					array(
						'label' => esc_html__( 'Outline Bar', 'infinite-addons' ),
						'value' => 'outline',
						'image' => $url . 'outline.png'
					),

					array(
						'label' => esc_html__( 'Rounded Bar', 'infinite-addons' ),
						'value' => 'round',
						'image' => $url . 'round.png'
					),

					array(
						'label' => esc_html__( 'Slim Bar', 'infinite-addons' ),
						'value' => 'slim',
						'image' => $url . 'slim.png'
					),

					array(
						'label' => esc_html__( 'Square Bar', 'infinite-addons' ),
						'value' => 'default',
						'image' => $url . 'square.png'
					),

					array(
						'label' => esc_html__( 'Vertical Bar', 'infinite-addons' ),
						'value' => 'vertical',
						'image' => $url . 'vertical.png'
					)
				),
				'admin_label' => true,
				'save_always' => true,
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'label',
				'heading'     => esc_html__( 'Label', 'infinite-addons' ),
				'admin_label' => true
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'count',
				'heading'     => esc_html__( 'Bar Counter', 'infinite-addons' ),
				'admin_label' => true
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'label_color',
				'heading'    => esc_html__( 'Label Color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'count_color',
				'heading'    => esc_html__( 'Count Color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'bar',
				'heading'    => esc_html__( 'Bar Color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'background',
				'heading'    => esc_html__( 'Bar Background Color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6',
			)
		);

		$this->add_extras();
	}

	protected function get_class( $style ) {

		$hash = array(
			'default'   => 'progressbar progressbar-default',
			'slim'      => 'progressbar progressbar-thin-line',
			'round'     => 'progressbar progressbar-wide-line',
			'outline'   => 'progressbar progressbar-outline',
			'gradient'  => 'progressbar progressbar-line-gradient',
			'hexa'      => 'progressbar progressbar-outline-hexagon',
			'circular'  => 'progressbar progressbar-line-rounded',
			'vertical'  => 'vertical-progressbar'
		);

		return isset( $hash[ $style ] ) ? $hash[ $style ] : $hash['s1'];
	}

	protected function generate_css() {

		$elements = array();
		extract( $this->atts );
		$id = '.' .$this->get_id();

		$elements[rella_implode( '%1$s .progressbar-title')]['color'] = $label_color;
		$elements[rella_implode( '%1$s .progressbar-value')]['color'] = $count_color;
		$elements[rella_implode( '%1$s .progressbar-bar span')]['background'] = $bar;
		$elements[rella_implode( '%1$s .progressbar-bar')] = array(
			'background' => $background,
			'border-color' => $background
		);

		if( 'hexa' === $style ) {
			$elements[rella_implode( '%1$s .polygon-container svg path')]['stroke'] = $bar;
		}

		$this->dynamic_css_parser( $id, $elements );
	}
}
new RA_Progressbar;