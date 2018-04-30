<?php
/**
* Shortcode Testimonial Slider
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Testi_Slider extends RA_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug          = 'ra_testi_slider';
		$this->title         = esc_html__( 'Testimonial Slider', 'infinite-addons' );
		$this->icon          = 'fa fa-comments-o';
		$this->description   = esc_html__( 'Create Testimonial Slide.', 'infinite-addons' );
		$this->is_container  = true;
		$this->show_settings_on_create = false;
		$this->styles        = array( 'rella-sc-testimonial-slider' );
		$this->scripts       = array( 'TweenMax', 'animation-gsap', 'jquery-ui' );
		$this->as_parent     = array ( 'only' => 'ra_testi' );

		parent::__construct();
	}

	/**
	 * Get params
	 * @return array
	 */
	public function get_params() {

		$this->params = array();
		$this->add_extras();
	}

	public function before_output( $atts, &$content ) {

		global $rella_testi;

		$rella_testi = array();

		//parse vc_accordion_tab shortcode
		do_shortcode( $content );

		$atts['items'] = $rella_testi;

		return $atts;
	}

}
new RA_Testi_Slider;
class WPBakeryShortCode_RA_Testi_Slider extends RA_ShortcodeContainer {}
// Testimonial Item
include_once 'rella-testi.php';