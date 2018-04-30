<?php
/**
* Shortcode Promo
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Promo extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_promo';
		$this->title       = esc_html__( 'Promo', 'infinite-addons' );
		$this->description = esc_html__( 'Create a promo box.', 'infinite-addons' );
		$this->icon        = 'fa fa-dot-circle-o';

		parent::__construct();
	}

	public function get_params() {

		$params = array(

			array( 'id' => 'title' ),

			array(
				'type'        => 'textarea',
				'param_name'  => 'content',
				'heading'     => esc_html__( 'Content', 'infinite-addons' ),
				'holder'      => 'div'
			)
		);

		$icon = rella_get_icon_params( false, '', 'all',  array( 'color', 'size', 'margin-right', 'margin-left' ) );

		//Design Options
		$design_params = array(

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'primary_color',
				'heading'     => esc_html__( 'Primary Color', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'primary_bg',
				'heading'     => esc_html__( 'Background', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'content_color',
				'heading'     => esc_html__( 'Content', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			)
		);
		foreach( $design_params as &$param ) {
			$param['group'] = esc_html__( 'Design Options', 'infinite-addons' );
		}

		$this->params = array_merge( $params, $icon, $design_params );
		$this->add_extras();
	}

	protected function get_title() {

		// check
		if( empty( $this->atts['title'] ) ) {
			return '';
		}

		$title  = wp_kses_post( do_shortcode( $this->atts['title'] ) );
		$icon = rella_get_icon( $this->atts );

		if( 'left' === $icon['align'] )  {
			$title = sprintf( '<i class="%s"></i> ', $icon['icon'] ) . $title;
		}
		else {
			$title = $title . sprintf( ' <i class="%s text-%s"></i>', $icon['icon'], $icon['align'] );
		}

		printf( '<strong>%s</strong>', $title );
	}

	protected function get_content() {

		// check
		if( empty( $this->atts['content'] ) ) {
			return;
		}

		echo wp_kses_post( $this->atts['content'] );
	}

	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' .$this->get_id();

		// Genral
		$elements[rella_implode( '%1$s:not(.masonry-item) i ' )] = array(
			'color' => $primary_color
		);
		$elements[rella_implode( '%1$s strong' )] = array(
			'color' => $content_color
		);
		$elements[rella_implode( '%1$s' )] = array(
			'background-color' => $primary_bg,
			'color' => $content_color
		);

		$this->dynamic_css_parser( $id, $elements );
	}

}
new RA_Promo;
