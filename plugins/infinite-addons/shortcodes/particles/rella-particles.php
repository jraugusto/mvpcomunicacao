<?php
/**
* Shortcode Particles
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Particles extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_particles';
		$this->title       = esc_html__( 'Particles', 'infinite-addons' );
		$this->description = esc_html__( 'Add image particles', 'infinite-addons' );
		$this->icon        = 'fa fa-dot-circle-o';
		$this->scripts     = array( 'animation-gsap' );

		parent::__construct();
	}

	public function get_params() {

		$this->params = array(
			
			array(
				'type'       => 'param_group',
				'param_name' => 'items',
				'heading'    => esc_html__( 'Particle Item', 'infinite-addons' ),
				'params'     => array(
					
					array(
						'type'       => 'rella_attach_image',
						'param_name' => 'image',
						'heading'    => esc_html__( 'Image', 'infinite-addons' ),
						'descripton' => esc_html__( 'Add image from gallery or upload new', 'infinite-addons' )
					),
					
					array(
						'type'        => 'textfield',
						'param_name'  => 'top_pos',
						'heading'     => esc_html__( 'Top', 'infinite-addons' ),
						'description' => esc_html__( 'Add position value in px ( ex. 20px )', 'infinite-addons' ),
						'admin_label' => true,
						'edit_field_class' => 'vc_col-sm-3'
					),

					array(
						'type'        => 'textfield',
						'param_name'  => 'right_pos',
						'heading'     => esc_html__( 'Right', 'infinite-addons' ),
						'description' => esc_html__( 'Add position value in px ( ex. 20px )', 'infinite-addons' ),
						'admin_label' => true,
						'edit_field_class' => 'vc_col-sm-3'
					),
					
					array(
						'type'        => 'textfield',
						'param_name'  => 'bottom_pos',
						'heading'     => esc_html__( 'Bottom', 'infinite-addons' ),
						'description' => esc_html__( 'Add position value in px ( ex. 20px )', 'infinite-addons' ),
						'admin_label' => true,
						'edit_field_class' => 'vc_col-sm-3'
					),
					
					array(
						'type'        => 'textfield',
						'param_name'  => 'left_pos',
						'heading'     => esc_html__( 'Left', 'infinite-addons' ),
						'description' => esc_html__( 'Add position value in px ( ex. 20px )', 'infinite-addons' ),
						'admin_label' => true,
						'edit_field_class' => 'vc_col-sm-3'
					),
					
					array(
						'type'        => 'dropdown',
						'param_name'  => 'prlx_preset',
						'heading'     => esc_html__( 'Parallax Presets', 'infinite-addons' ),
						'description' => esc_html__( 'Select a parallax preset to apply to particle', 'infinite-addons' ),
						'value' => array(
							'fadeIn',
							'fadeInDownLong',
							'fadeInDownShort',
							'fadeInLeftLong',
							'fadeInLeftShort',
							'fadeInRightLong',
							'fadeInRightShort',
							'fadeInUpLong',
							'fadeInUpShort',
							'rotateIn',
							'rotateOut',
							'slideDownLong',
							'slideLeftLong',
							'slideLeftShort',
							'slideRightLong',
							'slideRightShort',
							'slideUpLong',
							'slideUpShort',
							'zoomIn',
							'zoomOut',
							'custom',
						)
					),
					
					array(
						'type'        => 'textarea',
						'param_name'  => 'prlx_from',
						'heading'     => esc_html__( 'Parallax From', 'infinite-addons' ),
						'description' => esc_html__( 'Parallax custom options to add to data-paralax-from attribute', 'infinite-addons' ),
						'dependency'  => array(
							'element' => 'prlx_preset',
							'value'   => 'custom',
						),
						'edit_field_class' => 'vc_col-sm-6',
					),
					
					array(
						'type'        => 'textarea',
						'param_name'  => 'prlx_to',
						'heading'     => esc_html__( 'Parallax To', 'infinite-addons' ),
						'description' => esc_html__( 'Parallax custom options to add to data-paralax-from attribute', 'infinite-addons' ),
						'dependency'  => array(
							'element' => 'prlx_preset',
							'value'   => 'custom',
						),
						'edit_field_class' => 'vc_col-sm-6',
					),

					array(
						'type' => 'textfield',
						'param_name' => 'prlx_time',
						'heading'     => esc_html__( 'Parallax Time', 'infinite-addons' ),
						'description' => esc_html__( 'Duration of the animation in sec', 'infinite-addons' ),
						'edit_field_class' => 'vc_col-sm-6',
					),

					array(
						'type' => 'textfield',
						'param_name' => 'prlx_duration',
						'heading'     => esc_html__( 'Parallax Duration', 'infinite-addons' ),
						'description' => esc_html__( 'define how much the animation last during the scroll. could be defined in px (150) or percent(100%)', 'infinite-addons' ),
						'edit_field_class' => 'vc_col-sm-6',
					),	

				)
			),

		);

		$this->add_extras();
	}

	protected function get_image( $img ) {

		if ( empty( $img ) ) {
			return;
		}
		
		if( preg_match( '/^\d+$/', $img ) ){
			$image  = wp_get_attachment_image_src( $img, 'full' );
			$image = sprintf( '<img src="%s" alt="" />', $image[0] );
		} else {
			$image = sprintf( '<img src="%s" alt="" />', esc_url( $img ) );
		}

		return $image;
	}

	protected function get_position( $pos = array() ) {
		
		$out = '';
		
		if( ! empty( $pos['top_pos'] ) ) {
			$out .= 'top:' . esc_attr( $pos['top_pos'] ) . ';';	
		}
		if( ! empty( $pos['right_pos'] ) ) {
			$out .= 'right:' . esc_attr( $pos['right_pos'] ) . ';';	
		}
		if( ! empty( $pos['bottom_pos'] ) ) {
			$out .= 'bottom:' . esc_attr( $pos['bottom_pos'] ) . ';';	
		}
		if( ! empty( $pos['left_pos'] ) ) {
			$out .= 'left:' . esc_attr( $pos['left_pos'] ) . ';';
		}

		 $out = sprintf( 'style="%s" ', $out );
		 
		 return $out;
	}
	
	protected function get_parallax( $parallax = array() ) {
			
		$data = array();
		$preset = $parallax['prlx_preset'];
		
		if( 'custom' !== $preset ) {
			$data = rella_get_parallax_preset( $preset );
		} else{
			if( ! empty( $parallax['prlx_from'] ) ) {
				$data['from'] = $parallax['prlx_from'];
			}
			if( ! empty( $parallax['prlx_to'] ) ) {
				$data['to'] = $parallax['prlx_to'];
			}
		}
		
		$p = $opts = array();
		$p[] = 'data-parallax="true"';
		$p[] = 'data-smooth-transition="true"';

		if( is_array( $data['from'] ) ) {
			$p[] = 'data-parallax-from=\'' . wp_json_encode( $data['from'] ) . '\'';
		} else {
			$p[] = 'data-parallax-from=\'{' . $data['from'] . '}\'';
		}
		if( ! empty( $data['to'] ) ) {
			if( is_array( $data['to'] ) ) {
				$p[] = 'data-parallax-to=\'' . wp_json_encode( $data['to'] ) . '\'';
			}else {
				$p[] = 'data-parallax-to=\'{' . $data['to'] . '}\'';
			}
		}
		
		if( ! empty( $parallax['prlx_time'] ) ) {
			$opts['time'] = esc_attr( $parallax['prlx_time'] );
		}
		if( ! empty( $parallax['prlx_duration'] ) ) {
			$opts['duration'] = esc_attr( $parallax['prlx_duration'] );
		}
		if( ! empty( $opts ) ) {
			$p[] = 'data-parallax-options=\'' . wp_json_encode( $opts ) . '\'';
		}
		
		$out = implode( ' ', $p );
		
		return $out;
		
	}
	
	protected function get_items() {
		
		extract( $this->atts );
		
		$out = $right = '';
		
		$items = vc_param_group_parse_atts( $items );
		
		foreach( $items as $particle ) {
			
			if( ! empty( $particle['right_pos'] ) ) { $right = 'right'; }
			$out .= sprintf( '<div class="particle %s" %s>%s</div>', $right, $this->get_position( $particle ) . $this->get_parallax( $particle ), $this->get_image( $particle['image'] )  );
		}
		
		echo $out;
		
	}

}
new RA_Particles;