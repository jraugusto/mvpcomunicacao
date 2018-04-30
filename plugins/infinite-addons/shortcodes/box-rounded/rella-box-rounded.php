<?php
/**
* Shortcode Box Rounded
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Box_Rounded extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_box_rounded';
		$this->title       = esc_html__( 'Image Box', 'infinite-addons' );
		$this->description = esc_html__( 'Add image box with rounded corners and tooltip on hover', 'infinite-addons' );
		$this->icon        = 'icon-wpb-single-image';

		parent::__construct();
	}

	public function get_params() {
		
		$this->params = array(
			
			array(
				'type'        => 'rella_attach_image',
				'param_name'  => 'image',
				'heading'     => esc_html__( 'Image', 'infinite-addons' ),
				'description' => esc_html__( 'Add or upload a new image', 'infinite-addons' ),
			),
			
			array(
				'id' => 'title',
				'edit_field_class' => 'vc_col-sm-6',
			),
			
			array(
				'type'        => 'textfield',
				'param_name'  => 'tooltip',
				'heading'     => esc_html__( 'Tooltip text', 'infinite-addons' ),
				'description' => esc_html__( 'Add a tooltip text', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6',
			),

		);
		
		$this->add_extras();
	}

	protected function get_title() {
		
		if( empty( $this->atts['title'] ) ) {
			return;
		}

		$title = esc_html( $this->atts['title'] );

		// Title
		if( $title ) {
			printf( '<h3>%s</h3>', $title );
		}
	}
	
	protected function get_image() {

		// check
		if( empty( $this->atts['image'] ) ) {
			return;
		}
		
		if( preg_match( '/^\d+$/', $this->atts['image'] ) ){
			$image  = wp_get_attachment_image_src( $this->atts['image'], 'full' );
			$image  = sprintf( '<div class="rounded-image"><img src="%s" alt="" /></div>', $image[0] );
		} else {
			$image  = sprintf( '<div class="rounded-image"><img src="%s" alt="" /></div>', esc_url( $this->atts['image'] ) );
		}

		echo $image;

	}
	
	protected function get_tooltip() {
		
		if( empty( $this->atts['tooltip'] ) ) {
			return;
		}		

		$tooltip = esc_html( $this->atts['tooltip'] );
		
		if ( $tooltip ) {
			printf( '<div class="rounded-tooltip"><span>%s</span></div>', $tooltip );
		}			
	}

}
new RA_Box_Rounded;