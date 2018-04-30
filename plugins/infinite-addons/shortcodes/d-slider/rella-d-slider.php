<?php
/**
* Shortcode 3D Slider
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_D_Slider extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_d_slider';
		$this->title       = esc_html__( '3D slider', 'infinite-addons' );
		$this->icon        = 'fa fa-square';
		$this->description = esc_html__( 'Create 3D Slider', 'infinite-addons' );
		$this->scripts      = array( 'jquery-ui' );

		parent::__construct();
	}

	public function get_params() {

		$this->params = array(

			array(
				'type'        => 'attach_images',
				'param_name'  => 'images',
				'heading'     => esc_html__( 'Slider Images', 'infinite-addons' ),
				'description' => esc_html__( 'Add images to show in the slider', 'infinite-addons' ),
				'admin_label' => true
			),

		);
	}

	protected function get_attachments() {

		$images = explode( ',', $this->atts['images'] );

		if( empty( $images ) ) {
			return;
		}

		$args = array(
			'posts_per_page' => -1,
			'include'        => $images,
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'orderby'        => 'post__in',

			// improve query performance
			'ignore_sticky_posts'    => true,
			'no_found_rows'          => true,
			'update_post_term_cache' => false,
			'update_post_meta_cache' => false
		);

		return get_posts( $args );
	}
}
new RA_D_Slider;