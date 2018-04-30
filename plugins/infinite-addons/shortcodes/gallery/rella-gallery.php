<?php
/**
* Shortcode Gallery
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Gallery extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_gallery';
		$this->title       = esc_html__( 'Gallery', 'infinite-addons' );
		$this->icon        = 'fa fa-square';
		$this->description = esc_html__( 'Create gallery.', 'infinite-addons' );
		$this->scripts     = array( 'flickity' );
		$this->styles      = array( 'flickity', 'rella-sc-carousel' );

		parent::__construct();
	}

	public function get_params() {

		$this->params = array(

			array(
				'type'        => 'attach_images',
				'param_name'  => 'images',
				'heading'     => esc_html__( 'Gallery Images', 'infinite-addons' ),
				'description' => esc_html__( 'Add images to show in the gallery', 'infinite-addons' )
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'show_caption',
				'heading'     => esc_html__( 'Show Caption', 'infinite-addons' ),
				'description' => esc_html__( 'If yes, will display the image caption', 'infinite-addons' ),
				'value'       => array(
					esc_html__( 'No', 'infinite-addons' )  => 'no',
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes'
				)
			)
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
new RA_Gallery;