<?php
/**
* Shortcode Tweet
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Tweet extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_tweet';
		$this->title       = esc_html__( 'Single Tweet', 'infinite-addons' );
		$this->description = esc_html__( 'Add single tweet (from Twitter URL)', 'infinite-addons' );
		$this->icon        = 'fa fa-twitter';

		parent::__construct();
	}

	public function get_params() {

		 $params = array(

			array(
				'type'        => 'textfield',
				'param_name'  => 'tweet',
				'heading'     => esc_html__( 'Tweet URL', 'infinite-addons' ),
				'description' => esc_html__( 'Input here the URL of the single tweet you want to display', 'infinite-addons' ),
			),
		);

		$button = vc_map_integrate_shortcode( 'ra_button', 'ib_', esc_html__( 'Button', 'infinite-addons' ), array(
			'exclude' => array(
				'primary_color',
				'el_id',
				'el_class'
			)
		) );

		$button = array_merge( array(
			array(
				'type'       => 'dropdown',
				'param_name' => 'show_button',
				'heading'    => esc_html__( 'Show Button', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'No', 'infinite-addons' )  => '',
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes'
				),
				'group' => esc_html__( 'Button', 'infinite-addons' )
			)
		), $button );

		$this->params = array_merge( $params, $button );

		$this->add_extras();
	}


	protected function get_tweet_data() {
	
		if ( empty( $this->atts['tweet'] ) ) {
			return;
		}

		$url       = esc_url( $this->atts['tweet'] );
		$url_fetch = "https://publish.twitter.com/oembed?url=$url&hide_media=true&hide_thread=true&omit_script=true";
		
		// Get remote HTML file
		add_filter('https_ssl_verify', '__return_false');
		$response = wp_remote_get( $url_fetch );

		// Check for error
		if ( is_wp_error( $response ) ) {
			return;
		}

		$data = json_decode( wp_remote_retrieve_body( $response ), true );
		
		// Check for error
		if ( is_wp_error( $data ) ) {
			return;
		}

		extract( $data );

		echo $html;

	}

	protected function get_button() {

		if ( empty( $this->atts['show_button'] ) ) {
			return;
		}

		$data = vc_map_integrate_parse_atts( $this->slug, 'ra_button', $this->atts, 'ib_' );
		if ( $data ) {

			$data['primary_color'] = $this->atts['primary_color'];
			$btn = visual_composer()->getShortCode( 'ra_button' )->shortcodeClass();

			if ( is_object( $btn ) ) {
				echo $btn->render( array_filter( $data ) );
			}
		}
	}

}
new RA_Tweet;