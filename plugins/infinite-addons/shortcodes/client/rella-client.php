<?php
/**
* Shortcode Client
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Client extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_client';
		$this->title       = esc_html__( 'Client', 'infinite-addons' );
		$this->icon        = 'fa fa-star';
		$this->description = esc_html__( 'Clients logo', 'infinite-addons' );
		$this->styles      = array( 'rella-sc-client' );

		parent::__construct();
	}

	public function get_params() {

		$url = rella_addons()->plugin_uri() . '/assets/img/sc-preview/client/';

		$this->params = array(

			array(
				'type'        => 'select_preview',
				'param_name'  => 'effect',
				'heading'     => esc_html__( 'Effect', 'infinite-addons' ),
				'value' => array (

					array(
						'value' => 'client',
						'label' => esc_html__( 'Default', 'infinite-addons' ),
						'image' => $url . 'client-default.png'
					),

					array(
						'label' => esc_html__( 'Bordered', 'infinite-addons' ),
						'value' => 'client-border',
						'image' => $url . 'client-border.png'
					),

					array(
						'label' => esc_html__( 'Bordered 2', 'infinite-addons' ),
						'value' => 'client-border2',
						'image' => $url . 'client-border2.png'
					),

					array(
						'label' => esc_html__( 'Border BW', 'infinite-addons' ),
						'value' => 'client-border-bw',
						'image' => $url . 'client-border-bw.png'
					),

					array(
						'label' => esc_html__( 'Border BW Inverted', 'infinite-addons' ),
						'value' => 'client-border-bw-inverted',
						'image' => $url . 'client-border-bw-inverted.png'
					),

					array(
						'label' => esc_html__( 'Desaturated', 'infinite-addons' ),
						'value' => 'client-desaturated',
						'image' => $url . 'client-desaturated.png'
					),

					array(
						'label' => esc_html__( 'Opaque', 'infinite-addons' ),
						'value' => 'client-opaque',
						'image' => $url . 'client-opaque.png'
					),

					array(
						'label' => esc_html__( 'Opaque Inverted', 'infinite-addons' ),
						'value' => 'client-opaque-inverted',
						'image' => $url . 'client-opaque-inverted.png'
					)
				),
				'save_always' => true,				
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'name',
				'heading'     => esc_html__( 'Name', 'infinite-addons' ),
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'rella_attach_image',
				'param_name'  => 'logo',
				'heading'     => esc_html__( 'Client Logo', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'vc_link',
				'param_name' => 'link',
				'heading'    => esc_html__( 'Client link', 'infinite-addons' )
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'opacity',
				'heading'     => esc_html__( 'Opacity', 'infinite-addons' ),
				'description' => esc_html__( 'Set Opacity for the image from 0 to 1. ex 0.8', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			)
		);

		$this->add_extras();
	}

	protected function get_image() {

		// check
		if( empty( $this->atts['logo'] ) ) {
			return;
		}
		
		$link  = rella_get_link_attributes( $this->atts['link'], false );
		$title = ! empty( $this->atts['name'] ) ? esc_html( $this->atts['name'] ) : '' ;

		if( preg_match( '/^\d+$/', $this->atts['logo'] ) ){
			$logo = rella_get_image( $this->atts['logo'] );
		} else {
			$logo = $this->atts['logo'];
		}

		$retina = $this->get_retina( $logo );

		if ( ! empty ( $link['href'] ) ) {
			$image = sprintf( '<a%3$s><img src="%1$s" data-rjs="%4$s" alt="%2$s"></a>', $logo, $title, ra_helper()->html_attributes( $link ), $retina );
		} else {
			$image = sprintf( '<img src="%s" alt="%s" data-rjs="%s">', $logo, $title, $retina );
		}

		echo $image;

	}
	
	protected function get_retina( $image ) {
		
		if( ! function_exists( 'rella_get_retina_image' ) ) {
			return $image;
		}

		$retina = rella_get_retina_image( $image );

		return $retina;
	}

	protected function get_data_mh() {

		$ef = $this->atts['effect'];

		if ( in_array( $ef, array( 'client-border-bw', 'client-border-bw-inverted' ) ) ) {
			return 'data-mh="' . esc_attr( $ef ) . '"';
		}

		return '';
	}

	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' . $this->get_id();

		if( $opacity ) {
			$elements[rella_implode( '%1$s img' )] = array(
				'opacity' => $opacity
			);
		}

		$this->dynamic_css_parser( $id, $elements );
	}

}
new RA_Client;