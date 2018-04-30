<?php
/**
* Shortcode Lightbox Video
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Lightbox extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_lightbox';
		$this->title       = esc_html__( 'Lightbox', 'infinite-addons' );
		$this->description = esc_html__( 'Add image with button to lightbox popup', 'infinite-addons' );
		$this->icon        = 'fa fa-search';
		$this->scripts     = array( 'magnific-popup', 'TweenMax', 'animation-gsap', );
		$this->styles      = array( 'magnific-popup', 'rella-sc-lightbox', 'rella-sc-button' );

		parent::__construct();
	}

	public function get_params() {

		$this->params = array(

			array(
				'type'       => 'dropdown',
				'param_name' => 'lightbox_type',
				'heading'    => esc_html__( 'Lightbox type', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Image', 'infinite-addons' )  => 'image',
					esc_html__( 'Video', 'infinite-addons' )  => 'video',
				),
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
			),

			array(
				'type'        => 'rella_attach_image',
				'param_name'  => 'image',
				'heading'     => esc_html__( 'Background Image', 'infinite-addons' ),
				'description' => esc_html__( 'Add background image to the lightbox button', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'vc_link',
				'param_name'  => 'link',
				'heading'     => esc_html__( 'Lightbox link', 'infinite-addons' ),
				'description' => esc_html__( 'Add link to image or video to display in lightbox', 'infinite-addons' )
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'side_label',
				'heading'     => esc_html__( 'Sided button Label', 'infinite-addons' ),
				'description' => esc_html__( 'Add label if you want show sided link' )
			),

			array(
				'type'        => 'vc_link',
				'param_name'  => 'side_link',
				'heading'     => esc_html__( 'Sided button link', 'infinite-addons' ),
				'description' => esc_html__( 'Add URL to sided button link', 'infinite-addons' )
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
			$image  = wp_get_attachment_image_src( $this->atts['image'], 'full' );
			$image  = sprintf( '<img src="%s" alt="" />', $image[0] );
		} else {
			$image  = sprintf( '<img src="%s" alt="" />', esc_url( $this->atts['image'] ) );
		}

		echo $image;

	}

	protected function get_sided_link() {

		// check
		if( empty( $this->atts['side_label'] ) ) {
			return;
		}

		$link = $this->atts['side_link'];

		$label = esc_html( $this->atts['side_label'] );
		$attributes = rella_get_link_attributes( $link, '#' );
		$attributes['class'] = 'btn btn-naked';

		return printf( '<div class="sidetext"><div class="more"><a%s>%s</a></div></div>', ra_helper()->html_attributes( $attributes ), $label );
	}

	protected function get_figure_atts() {

		// check
		if( empty( $this->atts['image'] ) ) {
			return;
		}
		
		if( preg_match( '/^\d+$/', $this->atts['image'] ) ){
			$image   = wp_get_attachment_image_src( $this->atts['image'], 'full' );
			$img_src = $image[0];
		} else {
			$img_src = $this->atts['image'];
		}
		
		$figure_attributes = array();

		$figure_attributes[] = ' style="background-image: url(' . $img_src . ')" ';
		$figure_attributes[] = ' data-parallax-bg="true" ';
		$figure_attributes[] = ' data-parallax-options=\'{ "x": -100, "ease": "Linear.easeNone" }\' ';

		$figure_attributes = implode( ' ', $figure_attributes );

		echo $figure_attributes;
	}

	protected function get_lightbox_link() {

		$type = $this->atts['lightbox_type'];
		$link = $this->atts['link'];

		$attributes = rella_get_link_attributes( $link, '#' );
		$attributes['class'] = 'lightbox-link';
		$attributes['data-type'] = $type;

		$link = sprintf( '<a%s></a>', ra_helper()->html_attributes( $attributes ) );

		echo $link;
	}


}
new RA_Lightbox;
