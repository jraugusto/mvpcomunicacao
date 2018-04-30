<?php
/**
* Shortcode Header Search
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Header_Search extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_header_search';
		$this->title       = esc_html__( 'Header Search', 'infinite-addons' );
		$this->description = esc_html__( 'Header search form', 'infinite-addons' );
		$this->icon        = 'fa fa-search';
		$this->category    = esc_html__( 'Header', 'infinite-addons' );
		$this->scripts     = array( 'TweenMax' );

		parent::__construct();
	}

	public function get_params() {
		
		$url = rella_addons()->plugin_uri() . '/assets/img/sc-preview/header-search/';

		$this->params = array_merge(

			array( 	

				array(
					'type'       => 'select_preview',
					'heading'    => esc_html__( 'Style', 'infinite-addons' ),
					'param_name' => 'style',
					'value'      => array(
	
						array(
							'label' => esc_html__( 'Default', 'infinite-addons' ),
							'value' => 'default',
							'image' => $url . 'default.png',
						),
						
						array(
							'label' => esc_html__( 'Simple', 'infinite-addons' ),
							'value' => 'simple',
							'image' => $url . 'simple.png',								
						),

						array(
							'label' => esc_html__( 'Fullscreen', 'infinite-addons' ),
							'value' => 'fullscreen',
							'image' => $url . 'fullscreen.png',
						),
						
						array(
							'label' => esc_html__( 'Offcanvas', 'infinite-addons' ),
							'value' => 'offcanvas',
							'image' => $url . 'offcanvas.png',
						),

						array(
							'label' => esc_html__( 'Ghost', 'infinite-addons' ),
							'value' => 'ghost',
							'image' => $url . 'ghost.png',
						),

					),
					'description' => esc_html__( 'Select search type for the header', 'infinite-addons' ),
					'admin_label' => true,
				),
				
				array(
					'type'        => 'attach_image',
					'param_name'  => 'logo',
					'heading'     => esc_html__( 'Logo', 'infinite-addons' ),
					'dependency' => array(
						'element' => 'style',
						'value'   => 'offcanvas'
					),
					'edit_field_class' => 'vc_col-sm-6',
				),
				
				array(
					'type'        => 'attach_image',
					'param_name'  => 'retina_logo',
					'heading'     => esc_html__( 'Retina Logo', 'infinite-addons' ),
					'dependency' => array(
						'element' => 'style',
						'value'   => 'offcanvas'
					),
					'edit_field_class' => 'vc_col-sm-6',
				),
				
			),
			
			rella_get_icon_params( false, '', 'all', array( 'color', 'align', 'size', 'margin-left', 'margin-right' ) ), 
			
			array(

				array(
					'type'       => 'dropdown',
					'param_name' => 'trigger_size',
					'heading'    => esc_html__( 'Trigger Size', 'infinite-addons' ),
					'value'      => array(
						esc_html__( 'Medium', 'infinite-addons' ) => 'md',
						esc_html__( 'Small', 'infinite-addons' )  => 'sm',
						esc_html__( 'Large', 'infinite-addons' )  => 'lg',
					)
				),

				array(
					'type'        => 'colorpicker',
					'param_name'  => 'primary_color',
					'heading'     => esc_html__( 'Primary Color', 'infinite-addons' )
				)
		) );

		$this->add_extras();
	}

	public function generate_css() {

		extract($this->atts);

		$elements = array();
		$out = '';

		$elements['.header-module.module-search-form .module-trigger']['color'] = $primary_color;
		$this->dynamic_css_parser( '', $elements );
	}
}
new RA_Header_Search;