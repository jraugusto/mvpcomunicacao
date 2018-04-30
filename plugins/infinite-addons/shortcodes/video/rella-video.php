<?php
/**
* Shortcode Video
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Video extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_video';
		$this->title       = esc_html__( 'HTML5 Video', 'infinite-addons' );
		$this->description = esc_html__( 'Create html5 video', 'infinite-addons' );
		$this->icon        = 'fa fa-play';

		parent::__construct();

	}

	public function get_params() {

		$this->params = array(

			array(
				'id' => 'title'
			),

			array(
				'type'       => 'textfield',
				'param_name' => 'video_mp4_url',
				'heading'    => esc_html__( 'Video URL MP4', 'infinite-addons' ),
			),
			
			array(
				'type'       => 'textfield',
				'param_name' => 'video_url_ogg',
				'heading'    => esc_html__( 'Video URL OGV', 'infinite-addons' ),
			),
			
			array(
				'type'       => 'textfield',
				'param_name' => 'video_url_webm',
				'heading'    => esc_html__( 'Video URL WEBM', 'infinite-addons' ),
			),
			
			array(
				'type'       => 'attach_image',
				'param_name' => 'poster',
				'heading'    => esc_html__( 'Video Poster', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
			),
			
			array(
				'type'       => 'attach_image',
				'param_name' => 'fallback',
				'heading'    => esc_html__( 'Fallback Image', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),
			
			array(
				'type'       => 'textfield',
				'param_name' => 'height',
				'heading'    => esc_html__( 'Video Height', 'infinite-addons' ),
				'description' => esc_html__( 'Input the height of the video, ex. 200px', 'infinite-addons' )
			),

		);

		$this->add_extras();
	}
	
	protected function get_source_video( $source = '', $type = 'video/mp4' ) {

		// check
		if ( empty ( $source ) ) {
			return '';
		}
		
		$video = sprintf( '<source src="%s" type="%s" />', esc_url( $source ), esc_attr( $type ) );
	
		echo $video;
	}

	protected function get_fallback() {
		// check
		if ( empty ( $this->atts['fallback'] ) ) {
			return '';
		}

		$img = rella_get_image( $this->atts[ 'fallback' ]);

		$fallback = sprintf( '<img alt="" src="%s" title="Video playback is not supported by your browser" />', $img );

		echo $fallback;

	}

}
new RA_Video;