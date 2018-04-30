<?php
/**
* Shortcode Pointer
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Line_Guide extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_line_guide';
		$this->title       = esc_html__( 'Image with lines guide', 'infinite-addons' );
		$this->description = esc_html__( 'Add image with line guide and text', 'infinite-addons' );
		$this->icon        = 'fa fa-dot-circle-o';
		$this->scripts     = array( 'TweenMax', 'jquery-appear', 'jquery-lettering' );
		$this->styles      = array( 'rella-sc-line-guide', 'rella-sc-lettering' );

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
				'type'       => 'param_group',
				'param_name' => 'items',
				'heading'    => esc_html__( 'Line Guide Item', 'infinite-addons' ),
				'params'     => array(

					array(
						'type'        => 'textfield',
						'param_name'  => 'label',
						'heading'     => esc_html__( 'Label', 'infinite-addons' ),
						'description' => esc_html__( 'Add label to line', 'infinite-addons' ),
						'admin_label' => true,
						'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
					),

					array(
						'type'        => 'dropdown',
						'param_name'  => 'direction',
						'heading'     => esc_html__( 'Line Direction', 'infinite-addons' ),
						'description' => esc_html__( 'Selec a direction for line', 'infinite-addons' ),
						'value'       => array(
							esc_html__( 'Left Top', 'infinite-addons' )     => 'left top',
							esc_html__( 'Left Middle', 'infinite-addons' )  => 'left center',
							esc_html__( 'Left Bottom', 'infinite-addons' )  => 'left bottom',
							esc_html__( 'Right Top', 'infinite-addons' )    => 'right top',
							esc_html__( 'Right Middle', 'infinite-addons' ) => 'right center',
							esc_html__( 'Right Bottom', 'infinite-addons' ) => 'right bottom',
						),
						'edit_field_class' => 'vc_col-sm-6'
					),

					array(
						'type'       => 'dropdown',
						'param_name' => 'position',
						'heading'    => esc_html__( 'Label Position', 'infinite-addons' ),
						'value'      => array(
							esc_html__( 'Top', 'infinite-addons' )    => 'top',
							esc_html__( 'Right', 'infinite-addons' )  => 'right',
							esc_html__( 'Bottom', 'infinite-addons' ) => 'bottom',
							esc_html__( 'Left', 'infinite-addons' )   => 'left',
						),
						'edit_field_class' => 'vc_col-sm-6'
					),

					array(
						'type'        => 'textfield',
						'param_name'  => 'position_value',
						'heading'     => esc_html__( 'Position Value', 'infinite-addons' ),
						'description' => esc_html__( 'Add position value in px ( ex. 20px )', 'infinite-addons' ),
						'edit_field_class' => 'vc_col-sm-6'
					)

				)
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
			$retina = rella_get_image_src( $this->atts['image'] );
			$image  = wp_get_attachment_image( $this->atts['image'], 'full', false, array( 'data-rjs' => $retina[0] ) );
		} else {
			$img_src  = $this->atts['image'];
			$image = '<img src="' . esc_url( $img_src ) . '" alt="" data-rjs="' .  esc_url( $img_src ) . '" />';
		}
		
		$image = sprintf( '<figure class="image-container align-center">%s</figure>', $image );

		echo $image;

	}

	protected function get_position( $pos, $value = null ) {

		if ( empty( $value ) ) {
			return;
		}

		printf( 'style="%s:%s"', $pos, $value );

	}

}
new RA_Line_Guide;