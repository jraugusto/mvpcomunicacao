<?php
/**
* Shortcode Mapped Image
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Mapped_Image extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug         = 'ra_mapped_image';
		$this->title        = esc_html__( 'Image with Pointers', 'infinite-addons' );
		$this->description  = esc_html__( 'Add an image with pointers on it', 'infinite-addons' );
		$this->icon         = 'fa fa-file-image-o';
		$this->content_element = true;
		$this->is_container = true;
		$this->as_parent    = array( 'only' => 'ra_pointer' );
		$this->styles       = array( 'rella-sc-img-map' );

		parent::__construct();
	}

	public function get_params() {

		$this->params = array(

			array(
				'type'       => 'rella_attach_image',
				'param_name' => 'image',
				'heading'    => esc_html__( 'Image', 'infinite-addons' ),
				'descripton' => esc_html__( 'Add image from gallery or upload new', 'infinite-addons' )
			),

			array(
				'type'       => 'css_editor',
				'param_name' => 'css',
				'heading'    => esc_html__( 'CSS box', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
			),

		);

		$this->add_extras();
	}

	protected function get_image() {

		// check
		if( empty( $this->atts['image'] ) ) {
			return;
		}
		
		if( preg_match( '/^\d+$/', $this->atts['image'] ) ){
			$retina_image = wp_get_attachment_image_src( $this->atts['image'], 'full' );
			$image  = wp_get_attachment_image( $this->atts['image'], 'full', false, array( 'data-rjs' => $retina_image[0] ) );
		} else {
			$image = '<img src="' . esc_url( $this->atts['image'] ) . '" data-rjs="' . esc_url( $this->atts['image'] ) . '" alt="" />';
		}

		$image = sprintf( '<figure>%s</figure>', $image );
		
		echo $image;

	}

}
new RA_Mapped_Image;
class WPBakeryShortCode_RA_Mapped_Image extends RA_ShortcodeContainer {}