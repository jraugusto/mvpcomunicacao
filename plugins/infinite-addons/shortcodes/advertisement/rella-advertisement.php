<?php
/**
* Shortcode Advertisment
*/

if( ! defined( 'ABSPATH' ) ) 	
	exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Advertisment extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_advertisment';
		$this->title       = esc_html__( 'Google AdSense', 'infinite-addons' );
		$this->description = esc_html__( 'Add google adsense js code here to show the ads in the page', 'infinite-addons' );
		$this->icon        = 'icon-wpb-raw-javascript';

		parent::__construct();
	}

	public function get_params() {
		
		$this->params = array(
			
			array(
				'type'        => 'textarea_raw_html',
				'holder'      => 'div',
				'heading'     => esc_html__( 'JavaScript Code', 'infinite-addons' ),
				'param_name'  => 'content',
				'value'       => esc_html__( base64_encode( '<script type="text/javascript"> alert("Enter your js here!" ); </script>' ), 'infinite-addons' ),
				'description' => esc_html__( 'Enter your JavaScript code.', 'infinite-addons' ),
			),

		);
		
		$this->add_extras();
	}
	
	protected function get_content() {
		
		// check
		if( empty( $this->atts['content'] ) ) {
			return '';
		}
		
		$content = rawurldecode( base64_decode( strip_tags( $this->atts['content'] ) ) );
		$content = wpb_js_remove_wpautop(  $content );

		echo $content;

	}

}
new RA_Advertisment;