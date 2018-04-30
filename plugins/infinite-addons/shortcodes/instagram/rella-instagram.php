<?php
/**
* Shortcode Instagram
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Instagram extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_instagram';
		$this->title       = esc_html__( 'Instagram', 'infinite-addons' );
		$this->description = esc_html__( 'Add instagram feed with button', 'infinite-addons' );
		$this->icon        = 'fa fa-instagram';
		$this->styles      = array( 'rella-sc-button' );

		parent::__construct();
	}

	public function get_params() {

		$params = array(
			
			array(
				'type'       => 'dropdown',
				'param_name' => 'template',
				'heading'    => esc_html__( 'Style', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Default', 'infinite-addons' ) => 'default',
					esc_html__( 'Spaced', 'infinite-addons' )  => 'alt',
					esc_html__( 'Single', 'infinite-addons' )  => 'single',
				),
				'admin_label' => true,
			),

			array(
				'id'  => 'limit',
				'std' => 9,
				'dependency' => array(
					'element' => 'template',
					'value' => array(
						'default',
						'alt',
					),
				),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'images_per_row',
				'heading'    => esc_html__( 'Columns', 'infinite-addons' ),
				'value'      => array(
					3,
					4,
					6,
				),
				'dependency' => array(
					'element' => 'template',
					'value' => array(
						'default',
						'alt',
					),
				),
				'std' => 6
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'stretch',
				'heading'     => esc_html__( 'Stretch Images', 'infinite-addons' ),
				'description' => esc_html__( 'Enable if you want to stretch images', 'infinite-addons' ),
				'value'      => array( 
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes' 
				),
				'dependency' => array(
					'element' => 'template',
					'value' => array(
						'default',
						'alt',
					),
				),
				'std' => '',
			),

		);

		$button = vc_map_integrate_shortcode( 'ra_button', 'ib_', esc_html__( 'Button', 'infinite-addons' ), array(
			'exclude' => array(
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

		$design = array(

			array(
				'type'       => 'css_editor',
				'param_name' => 'css',
				'heading'    => esc_html__( 'CSS box', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
			),

		);

		$this->params = array_merge( $params, $button, $design );
		$this->add_extras();
	}

	protected function get_class( $template ) {

		$hash = array(
			'default' => 'widget_instagram_feed widget_instagram_feed_style2',
			'alt'     => 'widget_instagram_feed widget_instagram_feed_style1',
			'single'  => 'widget_instagram_feed_style3'
		);

		return isset( $hash[ $template ] ) ? $hash[ $template ] : $hash['default'];
	}
	
	protected function get_columns() {

		$columns = $this->atts['images_per_row'];
		if( empty(  $columns ) ) {
			return;
		}
		
		return "rella-insta-columns-$columns";		
		
	}
	
	protected function get_stretch() {
		
		$enable = $this->atts['stretch'];
		if( empty( $enable ) ) {
			return;
		}
	
		return 'rella-stretch-images';
	
	}
	
	protected function get_images() {

		$limit        = $this->atts['limit'];
		$style        = $this->atts['template'];
		if( 'single' === $style ) { $limit = 1; };
		$access_token = rella_helper()->get_option( 'instagram-token' );
		
		if( empty( $access_token ) ) {
			return wp_kses_post( _e( '<div class="alert alert-danger">Please, check you have set the access token in Theme Option Panel</div>', 'infinite-addons' ) );
		}
		
		$remote_wp    = wp_remote_get( 'https://api.instagram.com/v1/users/self/media/recent/?access_token=' . $access_token . '&count=' . $limit .'' );
		
		$media_array = json_decode( $remote_wp['body'] );
		
		if( $remote_wp['response']['code'] == 200 ) {

			foreach ( $media_array->data as $item ) {
				
				$alt = isset( $item->caption->text ) ? $item->caption->text : '';
				
				echo '<li><a href="' . esc_url( $item->link ) . '"><img src="' . esc_url( $item->images->standard_resolution->url ) . '"  alt="' . esc_attr( $alt ) . '" /></a></li>';
				
			}
		
		} elseif ( $remote_wp['response']['code'] == 400 ) {

			echo '<div class="alert alert-danger">' . $remote_wp['response']['message'] . ':' . $media_array->meta->error_message . '</div>';

		}

	}	

	protected function get_button() {

		if ( empty( $this->atts['show_button'] ) ) {
			return;
		}

		$data = vc_map_integrate_parse_atts( $this->slug, 'ra_button', $this->atts, 'ib_' );
		if ( $data ) {

			$btn = visual_composer()->getShortCode( 'ra_button' )->shortcodeClass();

			if ( is_object( $btn ) ) {
				echo $btn->render( array_filter( $data ) );
			}
		}
	}

}
new RA_Instagram;