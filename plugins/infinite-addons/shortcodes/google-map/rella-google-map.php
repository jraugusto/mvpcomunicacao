<?php
/**
* Shortcode Google map
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Google_Map extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_google_map';
		$this->title       = esc_html__( 'Google Map', 'infinite-addons' );
		$this->description = esc_html__( 'Add a google map', 'infinite-addons' );
		$this->icon        = 'fa fa-map-marker';
		$this->defaults    = array();
		$this->scripts     = 'google-maps-api';
		$this->styles      = array( 'rella-sc-map' );

		parent::__construct();
	}

	public function get_params() {

		$url = rella_addons()->plugin_uri() . '/assets/img/sc-preview/google-maps/';

		$advanced = array(

			array(
				'type'        => 'rella_advanced_checkbox',
				'param_name'  => 'adv_opts',
				'value'       =>  array( esc_html__( 'Simple Mode', 'infinite-addons' ) => 'true' ),
				'std'         => '',
			)

		);

		$general = array(

			array(
				'type'       => 'select_preview',
				'param_name' => 'style',
				'heading'    => esc_html__( 'Map Style', 'infinite-addons' ),
				'value'      => array(

					array(
						'value' => 'aeropuerto',
						'label' => esc_html__( 'Aeropuerto', 'infinite-addons' ),
						'image' => $url . 'aeropuerto.png'
					),

					array(
						'label' => esc_html__( 'Apple', 'infinite-addons' ),
						'value' => 'apple',
						'image' => $url . 'apple.png'
					),

					array(
						'label' => esc_html__( 'Blue Water', 'infinite-addons' ),
						'value' => 'blueWater',
						'image' => $url . 'blueWater.png'
					),

					array(
						'label' => esc_html__( 'Classy', 'infinite-addons' ),
						'value' => 'classy',
						'image' => $url . 'classy.png'
					),

					array(
						'label' => esc_html__( 'Desaturated Road', 'infinite-addons' ),
						'value' => 'desaturated',
						'image' => $url . 'desaturated.png'
					),

					array(
						'label' => esc_html__( 'Flat Pale', 'infinite-addons' ),
						'value' => 'flatPale',
						'image' => $url . 'flatPale.png'
					),

					array(
						'label' => esc_html__( 'Fuse', 'infinite-addons' ),
						'value' => 'fuse',
						'image' => $url . 'fuse.png'
					),

					array(
						'label' => esc_html__( 'Light and Dark', 'infinite-addons' ),
						'value' => 'lightAndDark',
						'image' => $url . 'lightAndDark.png'
					),

					array(
						'label' => esc_html__( 'Pastel', 'infinite-addons' ),
						'value' => 'pastel',
						'image' => $url . 'pastel.png'
					),

					array(
						'label' => esc_html__( 'Shades of Grey', 'infinite-addons' ),
						'value' => 'shadesOfGrey',
						'image' => $url . 'shadesOfGrey.png'
					),

					array(
						'label' => esc_html__( 'Ultra Light', 'infinite-addons' ),
						'value' => 'ultraLight',
						'image' => $url . 'ultraLight.png'
					)
				),
				'admin_label' => true,
				'save_always' => true,				
			),
			
			array(
				'type'        => 'textarea',
				'heading'     => esc_html__( 'Address', 'infinite-addons' ),
				'param_name'  => 'address',
				'admin_label' => true,
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'map_height',
				'heading'     => esc_html__( 'Height', 'infinite-addons' ),
				'description' => esc_html__( 'Set custom google map height, in px. eg 250px', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'map_marker',
				'heading'    => esc_html__( 'Marker', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'None', 'infinite-addons' )   => 'no',
					esc_html__( 'Pin 1', 'infinite-addons' )  => 'map-pin',
					esc_html__( 'Pin 2', 'infinite-addons' )  => 'map-pin2',
					esc_html__( 'Pin 3', 'infinite-addons' )  => 'map-pin3',
					esc_html__( 'Custom', 'infinite-addons' ) => 'custom',
					esc_html__( 'Html', 'infinite-addons' )   => 'html_marker'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			
			array(
				'type'       => 'colorpicker',
				'param_name' => 'color_marker',
				'heading'	 => esc_html__( 'Marker Color', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'map_marker',
					'value'   => array( 'html_marker' )
				),				
			),

			array(
				'type'       => 'attach_image',
				'param_name' => 'custom_marker',
				'heading'    => esc_html__( 'Custom Marker', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'map_marker',
					'value'   => array( 'custom' )
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'checkbox',
				'param_name'  => 'multiple_markers',
				'heading'     => esc_html__( 'Multiple markers?', 'infinite-addons' ),
				'description' => esc_html__( 'Enable multiple markers on map', 'infinite-addons' ),
				'value'       => array( esc_html__( 'Yes', 'infinite-addons' ) => 'yes' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
			),

			array(
				'type'       => 'param_group',
				'param_name' => 'marker_coordinates',
				'heading'    => esc_html__( 'Marker\'s coordinates', 'infinite-addons' ),
				'params'     => array(
					array(
						'type'        => 'textfield',
						'param_name'  => 'lat',
						'heading'     => esc_html__( 'Latitude', 'infinite-addons' ),
						'description' => esc_html__( 'Marker Latitude', 'infinite-addons' ),
						'admin_label' => true,
						'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
					),

					array(
						'type'        => 'textfield',
						'param_name'  => 'long',
						'heading'     => esc_html__( 'Longitude', 'infinite-addons' ),
						'description' => esc_html__( 'Marker Longitude', 'infinite-addons' ),
						'admin_label' => true,
						'edit_field_class' => 'vc_col-sm-6'
					)
				),
				'dependency' => array(
					'element' => 'multiple_markers',
					'value' => 'yes'
				),
			),
			
			array(
				'type'        => 'checkbox',
				'param_name'  => 'show_infobox',
				'heading'     => esc_html__( 'Show info box', 'infinite-addons' ),
				'description' => esc_html__( 'Enable info box on map', 'infinite-addons' ),
				'value'       => array( esc_html__( 'Yes', 'infinite-addons' ) => 'yes' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
			),

			array(
				'type'       => 'textarea_html',
				'param_name' => 'content',
				'heading'    => esc_html__( 'Info box content', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-8',
				'dependency' => array(
					'element' => 'show_infobox',
					'value'   => 'yes'	
				),
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'content_style',
				'heading'    => esc_html__( 'Content position' ),
				'value'      => array(
					esc_html__( 'Default', 'infinite-addons' )      => 'contents-style2',
					esc_html__( 'Center', 'infinite-addons' )       => 'contents-style3',
					esc_html__( 'Center 2', 'infinite-addons' )     => 'contents-style4',
					esc_html__( 'Center 2 Alt', 'infinite-addons' ) => 'contents-style4 alt',
				),
				'dependency' => array(
					'element' => 'show_infobox',
					'value'   => 'yes'	
				),
				'edit_field_class' => 'vc_col-sm-4',
			)
		);

		$socials = vc_map_integrate_shortcode( 'ra_social_icons', 'si_', esc_html__( 'Social Identities', 'infinite-addons' ), 
			array(
				'exclude' => array(
					'primary_color',
					'el_id',
					'el_class'
				),
			),
			array(
				'element' => 'show_infobox',
				'value'   => 'yes'	
			)
		);

		$map = array(
			array(
				'type'       => 'dropdown',
				'param_name' => 'map_type',
				'heading'    => esc_html__( 'Map Type', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Roadmap', 'infinite-addons' )	=> 'roadmap',
					esc_html__( 'Satellite', 'infinite-addons' )	=> 'satellite',
					esc_html__( 'Hybrid', 'infinite-addons' )	=> 'hybrid',
					esc_Html__( 'Terrain', 'infinite-addons' )	=> 'terrain',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'zoom',
				'heading'     => esc_html__( 'Zoom', 'infinite-addons' ),
				'value'       => 14,
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'rella_checkbox',
				'param_name' => 'map_controls',
				'heading'    => esc_html__( 'Enable/Disable controls', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Fullscreen', 'infinite-addons' )  => 'fullscreenControl',
					esc_html__( 'Pan', 'infinite-addons' )         => 'panControl',
					esc_html__( 'Rotate', 'infinite-addons' )      => 'rotateControl',
					esc_html__( 'Scale', 'infinite-addons' )       => 'scaleControl',
					esc_Html__( 'Scrollwheel', 'infinite-addons' ) => 'scrollwheel',
					esc_html__( 'Street View', 'infinite-addons' ) => 'streetViewControl',
					esc_html__( 'Zoom', 'infinite-addons' )        => 'zoomControl',
				)
			),



		);

		foreach( $map as &$param ) {
			$param['group'] = esc_html__( 'Map Options', 'infinite-addons' );
		}

		$this->params = array_merge( $advanced, $general, $socials, $map );

		$this->add_extras();
	}

	protected function get_marker() {

		if( empty( $this->atts['map_marker'] ) || 'no' == $this->atts['map_marker'] ) {
			return;
		}

		if( 'custom' == $this->atts['map_marker'] && $url = rella_get_image( $this->atts['custom_marker'] ) ) {
			return $url;
		}
		if( 'html_marker' ==  $this->atts['map_marker'] ) {
			return rella_addons()->plugin_uri() . 'assets/img/markers/map-pin.svg';	
		}

		return rella_addons()->plugin_uri() . 'assets/img/markers/' . $this->atts['map_marker'] . '.svg';
	}

	protected function get_coordinates() {

		if( empty( $this->atts['multiple_markers'] ) ) {
			return;
		}

		$items = vc_param_group_parse_atts( $this->atts['marker_coordinates'] );
		$items = array_filter( $items );

		if( empty( $items ) ) {
			return;
		}

		$data = array();

		foreach( $items as $item ) {
			$data[] = array( ''. esc_attr( $item['lat'] ) . '', '' . esc_attr( $item['long'] ) . '' );
		}

		return $data;

	}

	protected function get_content() {

		if( ! $this->atts['show_infobox'] || empty( $this->atts['content'] ) ) {
			return;
		}

		echo '<div class="marker-contents"><div class="contents-inner clearfix"><div class="details">';

			echo do_shortcode( wp_kses_post( ra_helper()->do_the_content( $this->atts['content'] ) ) );

			$this->get_social();

		echo '</div></div></div>';
	}

	protected function get_social() {

		$data = vc_map_integrate_parse_atts( $this->slug, 'ra_social_icons', $this->atts, 'si_' );
		if ( $data ) {

			$si = visual_composer()->getShortCode( 'ra_social_icons' )->shortcodeClass();

			if ( is_object( $si ) ) {
				echo $si->render( array_filter( $data ) );
			}
		}
	}

	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' . $this->get_id();

		if( ! empty( $color_marker ) ) {
			$elements[rella_implode( '%1$s .map_marker, %1$s .map_marker div' )]['background-color'] = $color_marker;
		}

		$this->dynamic_css_parser( $id, $elements );
	}		
	
}
new RA_Google_Map;