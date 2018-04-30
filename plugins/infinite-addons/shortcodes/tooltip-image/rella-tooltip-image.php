<?php
/**
* Shortcode Tooltiped Image
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Tooltiped_Image extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug         = 'ra_tooltiped_image';
		$this->title        = esc_html__( 'Image with Tooltips', 'infinite-addons' );
		$this->description  = esc_html__( 'Add an image with tooltiped pointers on it', 'infinite-addons' );
		$this->icon         = 'fa fa-file-image-o';
		$this->content_element = true;
		$this->is_container = true;
		$this->as_parent    = array( 'only' => 'ra_pointer_tooltip' );

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
			
			array(
				'type' => 'colorpicker',
				'param_name' => 'bg_pointer',
				'heading' => esc_html__( 'Pointer Background', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type' => 'colorpicker',
				'param_name' => 'color_pointer',
				'heading' => esc_html__( 'Pointer Color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

		);

		$this->add_extras();
	}

	protected function get_image() {

		// check
		if( empty( $this->atts['image'] ) ) {
			return;
		}
		
		$img_src = $html = '';
		if( preg_match( '/^\d+$/', $this->atts['image'] ) ){
			$src = rella_get_image_src( $this->atts['image'] );
			$img_src = $src[0];
			$html = wp_get_attachment_image( $this->atts['image'], 'full', false, array( 'data-rjs' => $img_src ) );
		} else {
			$img_src  = $this->atts['image'];
			$html = '<img src="' . esc_url( $img_src ) . '" alt="" data-rjs="' .  esc_url( $img_src ) . '" />';
		}

		$image = sprintf( '<figure>%s</figure>', $html );
		
		echo $image;

	}
	
	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' .$this->get_id();

		
		if( ! empty( $bg_pointer ) ) {
			$elements[ rella_implode( '%1$s.img-maps .contents .info-box:before, %1$s.img-maps .contents .info-box:after' ) ]['background-color'] = esc_attr( $bg_pointer );
		}
		if( ! empty( $color_pointer ) ) {
			$elements[ rella_implode( '%1$s.img-maps .contents .info-box:before' ) ]['color'] = esc_attr( $color_pointer );
		}

		$this->dynamic_css_parser( $id, $elements );

	}

}
new RA_Tooltiped_Image;
class WPBakeryShortCode_RA_Tooltiped_Image extends RA_ShortcodeContainer {}