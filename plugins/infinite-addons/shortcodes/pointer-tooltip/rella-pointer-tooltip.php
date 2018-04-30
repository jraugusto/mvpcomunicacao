<?php
/**
* Shortcode Pointer
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Pointer_Tooltip extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_pointer_tooltip';
		$this->title       = esc_html__( 'Pointer - Tooltip', 'infinite-addons' );
		$this->description = esc_html__( 'Add pointer with Tooltip', 'infinite-addons' );
		$this->icon        = 'fa fa-mouse-pointer';
		$this->content_element = true;
		$this->as_child    = array( 'only' => 'ra_tooltiped_image' );
		$this->styles      = array( 'rella-sc-img-map' );

		parent::__construct();
	}

	public function get_params() {

		$this->params = array(

			array(
				'id' => 'title',
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-6'
			),
			
			array(
				'type'       => 'vc_link',
				'heading'    => esc_html__( 'URL', 'infinite-addons' ),
				'param_name' => 'link',
				'edit_field_class' => 'vc_col-sm-6'
			),
			
			array(
				'type'        => 'textarea_html',
				'param_name'  => 'content',
				'heading' => esc_html__( 'Tooltip Content', 'infinite-addons' ),
				'description' => esc_html__( 'Add tooltip content to display', 'infinite-addons' ),
				'holder'      => 'div',
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'position',
				'heading'     => esc_html__( 'Tooltip Alignment', 'infinite-addons' ),
				'description' => esc_html__( 'Tooltip alignment relative to the image', 'infinite-addons' ),
				'value'       => array(
					esc_html__( 'Top', 'infinite-addons' )   => '',
					esc_html__( 'Right', 'infinite-addons' ) => 'align-right',
					esc_html__( 'Left', 'infinite-addons' )   => 'align-left',
					esc_html__( 'Bottom', 'infinite-addons' ) => 'align-bottom',
				)
			),

			array(
				'type'         => 'textfield',
				'param_name'  => 'top',
				'heading'     => esc_html__( 'Top', 'infinite-addons' ),
				'description' => esc_html__( 'Add top position for pointer, use px or %', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-3'
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'bottom',
				'heading'     => esc_html__( 'Bottom', 'infinite-addons' ),
				'description' => esc_html__( 'Add bottom position for pointer, use px or %', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-3'
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'left',
				'heading'     => esc_html__( 'Left', 'infinite-addons' ),
				'description' => esc_html__( 'Add left position for pointer, use px or %', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-3'
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'right',
				'heading'     => esc_html__( 'Right', 'infinite-addons' ),
				'description' => esc_html__( 'Add right position for pointer, use px or %', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-3'
			),

			array(
				'type'       => 'css_editor',
				'heading'    => esc_html__( 'CSS box', 'infinite-addons' ),
				'param_name' => 'css',
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
			),
			
			array(
				'type' => 'colorpicker',
				'param_name' => 'bg_pointer',
				'heading' => esc_html__( 'Pointer Background', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type' => 'colorpicker',
				'param_name' => 'color_pointer',
				'heading' => esc_html__( 'Pointer Color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

		);

		$this->add_extras();
	}

	protected function get_title() {

		extract( $this->atts );

		// check
		if( empty( $title ) ) {
			return '';
		}

		$link = rella_get_link_attributes( $link, false );

		if( ! empty ( $link['href'] ) ) {
			$title = sprintf( '<h3><a%2$s>%1$s</a></h3>', $title, ra_helper()->html_attributes( $link ) );
		} else {
			$title = sprintf( '<h3>%s</h3>', $title );
		}

		echo $title;
	}


	protected function get_content() {

		// check
		if( empty( $this->atts['content'] ) ) {
			return;
		}

		echo wp_kses_post( ra_helper()->do_the_content( $this->atts['content'] ) );
	}


	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' .$this->get_id();
		
		if( empty( $top ) ){
			$top = 'auto';
		}
		if( empty( $right ) ){
			$right = 'auto';
		}
		if( empty( $bottom ) ){
			$bottom = 'auto';
		}
		if( empty( $left ) ){
			$left = 'auto';
		}

		$elements[ rella_implode( '%1$s' ) ] = array(
			'top'    => $top .' !important',
			'right'  => $right .' !important',
			'bottom' => $bottom .' !important',
			'left'   => $left .' !important'
		);
		
		if( ! empty( $bg_pointer ) ) {
			$elements[ rella_implode( '%1$s.info-box:before, %1$s.info-box:after' ) ]['background-color'] = esc_attr( $bg_pointer ) . ' !important';
		}
		if( ! empty( $color_pointer ) ) {
			$elements[ rella_implode( '%1$s.info-box:before' ) ]['color'] = esc_attr( $color_pointer ) . ' !important';
		}

		$this->dynamic_css_parser( $id, $elements );

	}

}
new RA_Pointer_Tooltip;