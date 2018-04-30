<?php
/**
* Shortcode Testimonial Slider
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Testi extends RA_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug          = 'ra_testi';
		$this->title         = esc_html__( 'Testimonial Slider Item', 'infinite-addons' );
		$this->icon          = 'fa fa-comments-o';
		$this->description   = esc_html__( 'Create testimonial slider item.', 'infinite-addons' );
		$this->as_child      = array( 'only' => 'ra_testi_slider' );
		$this->styles        = array( 'rella-sc-testimonial-slider' );
		$this->scripts       = array( 'TweenMax', 'animation-gsap', 'jquery-ui' );


		parent::__construct();
	}

	/**
	 * Get params
	 * @return array
	 */
	public function get_params() {

		$this->params = array(
			
			array(
				'type' => 'textfield',
				'param_name' => 'author',
				'heading' => esc_html__( 'Author', 'infinite-addons' ),
				'edit_field_class' => 'vc_column-with-padding vc_col-sm-6',
				'admin_label' => true,
			),

			array(
				'type'        => 'rella_attach_image',
				'param_name'  => 'image',
				'heading'     => esc_html__( 'Image', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'textarea_html',
				'param_name'  => 'content',
				'holder'      => 'div',
				'heading'     => esc_html__( 'Blockquote', 'infinite-addons' ),
			),
			
		);

		$this->add_extras();
	}

	public function render( $atts, $content = '' ) {

		global $rella_testi;

		$atts = vc_map_get_attributes( $this->slug, $atts );
		$atts = $this->before_output( $atts, $content );
		$atts['_id'] = uniqid( $this->slug .'_' );
		$atts['content'] = ra_helper()->do_the_content( $content );

		$rella_testi[]  = $atts;
	}

}
new RA_Testi;