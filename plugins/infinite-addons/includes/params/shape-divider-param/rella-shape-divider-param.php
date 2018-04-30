<?php
/**
* Rella Shape Divider Options
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * [rella_param_select_preview description]
 * @method rella_param_select_preview
 * @param  [type]               $settings [description]
 * @param  [type]               $value    [description]
 * @return [type]                         [description]
 */
/*
vc_add_shortcode_param( 'css_responsive_editor', 'rella_param_responsive_options' );
function rella_param_responsive_options( $settings, $value ) {

	return 'Hi';

}
*/
if( ! class_exists( 'Rella_Shape_Divider_Options' ) ) {

	class Rella_Shape_Divider_Options  {

		/**
		 * @var array
		 */
		protected $positions = array( 'top', 'bottom' );

		function __construct() {

			if ( function_exists( 'vc_add_shortcode_param' ) ) {
				vc_add_shortcode_param( 'rella_shape_divider', array( $this, 'shape_divider_param' ) );
			}
		}

		function shape_divider_param( $settings, $value ) {

			$label  = isset( $settings['label'] ) ? $settings['label'] : esc_html__( 'Shape Divider Options', 'infinite-addons' );
			$values = $this->get_shape_divider_values( $value );

			$positions = $this->positions;
			$i = 0;

			$output = '<div class="vc_css-editor vc_row vc_ui-flex-row">';
			$output .= '	<div class="vc_col-xs-6 vc_settings">';

				foreach( $positions as $position ) {

					$hidden = ( $i != 0 ) ? 'hidden' : '';

					$output .= '<div class="rella-main-responsive-wrapper ">';
					$output .= '	<h3 class="rella-shape-divider-heading '. $position .'">' .  ucfirst( $position )  . '</h3>';
					$output .= '	<div class="rella-inner-wrap ' . $hidden . '">';

					// Shape type select
					$output .= '	<label>' . esc_html__( 'Shape Type', 'infinite-addons' ) . '</label>'
							. '	 	<div class="rella_shape_divider-type">'
							. '			<select data-name="' . $position . '-shape-type" data-preview-target=".rella_shape_' . $position . '" name="' . $position . '_shape_type" class="rella_shape_divider-type">'
							.				$this->getShapeTypeOptions( $position,  $values )
							. '			</select>'
							. '		</div>';

					// Shape divider backround color
					$output .= '	<label>' . esc_html__( 'Color', 'infinite-addons' ) . '</label>'
							. '	 	<div class="rella_shape_divider-color">'
							.			$this->getShapeColor( $position,  $values )
							. '		</div>';

					// Shape divider height
					$output .= '	<label>' . esc_html__( 'Height', 'infinite-addons' ) . '</label>'
							. '	 	<div class="rella_shape_divider-height">'
							.			$this->getShapeHeight( $position,  $values )
							. '		</div>';

					// Shape divider width
					/*$output .= '	<label>' . esc_html__( 'Width', 'infinite-addons' ) . '</label>'
							. '	 	<div class="rella_shape_divider-width">'
							.			$this->getShapeWidth( $position,  $values )
							. '		</div>'; */



					$output .= '	</div>'; //.rella-inner-wrap
					$output .= '</div>'; // .rella-main-shape_divider-wrapper

					$i++;

				}
			$output .= '	</div>'; //.vc_col-xs-6
			$output .= '	<input name="' . $settings['param_name'] . '" class="wpb_vc_param_value  ' . $settings['param_name'] . ' ' . $settings['type'] . '_field" type="hidden" value="' . $value . '" />';
			$output .= '	<div class="rella_shape_divider_preview vc_col-xs-6"><div class="rella_shape_top">' . $this->getTopShape( $values ) . '</div><div class="rella_shape_bottom">' . $this->getBottomShape( $values ) . '</div></div>';
			$output .= '</div>'; // .rella-shape-divider-container


			return $output;

		}

		public static function get_shape_divider_values( $value ) {
			return vc_parse_multi_attribute( $value, array( 'top_shape_type' => '', 'top_shape_color' => '', 'top_shape_height' => '', 'top_shape_width' => '', 'top_shape_flip' => '', 'top_shape_inverse' => '', 'bottom_shape_type' => '', 'bottom_shape_color' => '', 'bottom_shape_height' => '', 'bottom_shape_width' => '', 'bottom_shape_flip' => '', 'bottom_shape_inverse' => '' ) );
		}

		/**
		 * @return string
		 */
		function getShapeTypeOptions( $position, $values = array() ) {
			$output = '<option data-svg-path="" value="">' . esc_html__( 'None', 'infinite-addons' ) . '</option>';
			$styles = apply_filters( 'rella_shape_divider_type_options_data', array(
				'asymmetric-angle' => 'Asymmetric Angle',
				'centered-angle' => 'Centered Angle',
				'sea-waves' => 'Sea Waves',
				'semi-angle' => 'Semi Angle',
				'semi-circle' => 'Semi Circle',
				'triangle' => 'Triangle',
				'waves-1' => 'Waves 1',
				'waves-2' => 'Waves 2',
				'waves-3' => 'Waves 3',
				'waves-4' => 'Waves 4',
			) );
			foreach ( $styles as $key => $style ) {
				$output .= '<option '. selected( $key, $values[ $position . '_shape_type'] ) .' data-svg-path="' . get_template_directory_uri() . '/assets/img/svg-divider/' . $key . '.svg' . '" value="' . $key . '">' . $style  . '</option>';
			}

			return $output;
		}


		function getShapeColor( $position, $values = array() ) {

			$output = '<input type="text" data-name="' . $position . '-shape-color" name="' . $position . '_shape_color" value="' . $values[ $position . '_shape_color' ] . '" class="rella_color-control">';

			return $output;

		}

		function getShapeHeight( $position, $values = array() ) {

			return '<div class="rella-slider"><div class="rella-handle ui-slider-handle"></div></div><input type="hidden" data-name="' . $position . '-shape-height" name="' . $position . '_shape_height" value="' . $values[ $position . '_shape_height' ] . '" class="rella_shape_height-control rella-sliderinput" >';

		}

		function getShapeWidth( $position, $values = array() ) {

			return '<div class="rella-slider"><div class="rella-handle ui-slider-handle"></div></div><input type="hidden" data-name="' . $position . '-shape-width" name="' . $position . '_shape_weight" value="' . $values[ $position . '_shape_weight' ] . '" class="rella_shape_weight-control rella-sliderinput">';

		}

		function getTopShape( $values = array() ) {

			if( ! isset( $values[ 'top_shape_type' ] ) || empty( $values[ 'top_shape_type' ] ) ) {
				return;
			}

			return file_get_contents( get_template_directory() . '/assets/img/svg-divider/' . $values[ 'top_shape_type' ] . '.svg' );
		}

		function getBottomShape( $values = array() ) {

			if( ! isset( $values[ 'bottom_shape_type' ] ) || empty( $values[ 'bottom_shape_type' ] ) ) {
				return;
			}

			return file_get_contents( get_template_directory() . '/assets/img/svg-divider/' . $values[ 'bottom_shape_type' ] . '.svg' );
		}


		public static function getShape( $value, $pos = 'top' ) {

			if( empty( $value ) ){
				return;
			}

			$values = Rella_Shape_Divider_Options::get_shape_divider_values( $value );
			if( ! isset( $values[ $pos . '_shape_type' ] ) || empty( $values[ $pos . '_shape_type' ] ) ) {
				return;
			}

			$shape = $values[ $pos . '_shape_type' ];
			$svg = '';

			switch( $shape ) {

				case 'asymmetric-angle':
					$color  = isset( $values[ $pos . '_shape_color' ] ) ? $values[ $pos . '_shape_color' ] : '#000';
					$height = isset( $values[ $pos . '_shape_height' ] ) ? $values[ $pos . '_shape_height' ] : '90';
					$svg = '<svg fill="' . $color . '" preserveAspectRatio="none" width="612px" height="78px" viewBox="0 0 612 78" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
							<polygon points="448.3 46.7913564 612 -2.13162821e-14 612 77.4986189 9.49084355e-15 77.4986189 0 -2.13162821e-14"></polygon>
					</svg>';
					break;

				case 'centered-angle':
					$color  = isset( $values[ $pos . '_shape_color' ] ) ? $values[ $pos . '_shape_color' ] : '#000';
					$height = isset( $values[ $pos . '_shape_height' ] ) ? $values[ $pos . '_shape_height' ] : '90';
					$svg = '<svg fill="' . $color . '" class="centered-angle" preserveAspectRatio="none" viewBox="0 0 613 92" width="613" height="92" xmlns="http://www.w3.org/2000/svg">
					 <path d="M0.51613,91.2258L610.83879 91.2258 610.83879 0.90321 308.2581 46.06451 13.7247517 2.40934638 0.51613 0.45159z"></path>
					</svg>';
					break;

				case 'sea-waves':
					$color  = isset( $values[ $pos . '_shape_color' ] ) ? $values[ $pos . '_shape_color' ] : '#000';
					$height = isset( $values[ $pos . '_shape_height' ] ) ? $values[ $pos . '_shape_height' ] : '15';
					$svg = '<svg fill="' . $color . '" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						 viewBox="0 0 612 15" style="enable-background:new 0 0 612 15;" xml:space="preserve">
					<path d="M20.4,0c0,8.3,4.6,15,10.2,15H10.2C4.7,15,0.2,8.5,0,0.5V15h10.2C15.8,15,20.4,8.3,20.4,0z M40.8,0c0,8.3,4.6,15,10.2,15
						H30.6C36.2,15,40.8,8.3,40.8,0z M61.2,0c0,8.3,4.6,15,10.2,15H51C56.6,15,61.2,8.3,61.2,0z M81.6,0c0,8.3,4.6,15,10.2,15H71.4
						C77,15,81.6,8.3,81.6,0z M102,0c0,8.3,4.6,15,10.2,15H91.8C97.4,15,102,8.3,102,0z M122.4,0c0,8.3,4.6,15,10.2,15h-20.4
						C117.8,15,122.4,8.3,122.4,0z M142.8,0c0,8.3,4.6,15,10.2,15h-20.4C138.2,15,142.8,8.3,142.8,0L142.8,0z M163.2,0
						c0,8.3,4.6,15,10.2,15H153C158.6,15,163.2,8.3,163.2,0z M183.6,0c0,8.3,4.6,15,10.2,15h-20.4C179,15,183.6,8.3,183.6,0L183.6,0z
						 M204,0c0,8.3,4.6,15,10.2,15h-20.4C199.4,15,204,8.3,204,0L204,0z M408,0c0,8.3,4.6,15,10.2,15h-20.4C403.4,15,408,8.3,408,0z
						 M397.8,15h-20.4c-5.6,0-10.2-6.7-10.2-15c0,8.3-4.6,15-10.2,15h20.4c5.6,0,10.2-6.7,10.2-15C387.6,8.3,392.2,15,397.8,15L397.8,15z
						 M357,15h-20.4c-5.6,0-10.2-6.7-10.2-15c0,8.3-4.6,15-10.2,15h20.4c5.6,0,10.2-6.7,10.2-15C346.8,8.3,351.4,15,357,15L357,15z
						 M316.2,15h-20.4c-5.6,0-10.2-6.7-10.2-15c0,8.3-4.6,15-10.2,15h20.4c5.6,0,10.2-6.7,10.2-15C306,8.3,310.6,15,316.2,15L316.2,15z
						 M275.4,15H255c-5.6,0-10.2-6.7-10.2-15c0,8.3-4.6,15-10.2,15H255c5.6,0,10.2-6.7,10.2-15C265.2,8.3,269.8,15,275.4,15L275.4,15z
						 M234.6,15h-20.4c5.6,0,10.2-6.7,10.2-15C224.4,8.3,229,15,234.6,15z M428.4,0c0,8.3,4.6,15,10.2,15h-20.4
						C423.8,15,428.4,8.3,428.4,0L428.4,0z M448.8,0c0,8.3,4.6,15,10.2,15h-20.4C444.2,15,448.8,8.3,448.8,0z M469.2,0
						c0,8.3,4.6,15,10.2,15H459C464.6,15,469.2,8.3,469.2,0L469.2,0z M489.6,0c0,8.3,4.6,15,10.2,15h-20.4C485,15,489.6,8.3,489.6,0z
						 M510,0c0,8.3,4.6,15,10.2,15h-20.4C505.4,15,510,8.3,510,0L510,0z M530.4,0c0,8.3,4.6,15,10.2,15h-20.4C525.8,15,530.4,8.3,530.4,0
						z M550.8,0c0,8.3,4.6,15,10.2,15h-20.4C546.2,15,550.8,8.3,550.8,0L550.8,0z M571.2,0c0,8.3,4.6,15,10.2,15H561
						C566.6,15,571.2,8.3,571.2,0z M591.6,0c0,8.3,4.6,15,10.2,15h-20.4C587,15,591.6,8.3,591.6,0L591.6,0z M612,0.5V15h-10.2
						C607.3,15,611.8,8.5,612,0.5z"/>
					</svg>';
					break;

				case 'semi-angle':
					$color  = isset( $values[ $pos . '_shape_color' ] ) ? $values[ $pos . '_shape_color' ] : '#000';
					$height = isset( $values[ $pos . '_shape_height' ] ) ? $values[ $pos . '_shape_height' ] : '90';
					$svg = '<svg fill="' . $color . '" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						 viewBox="0 0 612 90" style="enable-background:new 0 0 612 90;" xml:space="preserve">
					<polygon points="612,0 612,90 0,90 "/>
					</svg>';
					break;

				case 'semi-circle':
					$color  = isset( $values[ $pos . '_shape_color' ] ) ? $values[ $pos . '_shape_color' ] : '#000';
					$height = isset( $values[ $pos . '_shape_height' ] ) ? $values[ $pos . '_shape_height' ] : '60';
					$svg = '<svg class="rella-divider-circle" fill="' . $color . '" preserveAspectRatio="none" width="120px" height="60px" viewBox="0 0 120 60" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
							<path d="M120,60 C120,26.862915 93.137085,0 60,0 C26.862915,0 0,26.862915 0,60 C0.485010818,60 119.882479,60 120,60 Z" ></path>
					</svg>';
					break;

				case 'triangle':
					$color  = isset( $values[ $pos . '_shape_color' ] ) ? $values[ $pos . '_shape_color' ] : '#000';
					$height = isset( $values[ $pos . '_shape_height' ] ) ? $values[ $pos . '_shape_height' ] : '60';
					$svg = '<svg class="rella-divider-triangle" fill="' . $color . '" preserveAspectRatio="none" width="94px" height="60px" viewBox="0 0 94 60" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
						<polygon id="Shape" transform="translate(47.000000, 30.000000) scale(1, -1) translate(-47.000000, -30.000000) " points="94 0 94 0.3 70.6 30 47 60 23.4 30 0 0.3 0 0 47 0"></polygon>
					</svg>';
					break;

				case 'waves-1':
					$color  = isset( $values[ $pos . '_shape_color' ] ) ? $values[ $pos . '_shape_color' ] : '#000';
					$height = isset( $values[ $pos . '_shape_height' ] ) ? $values[ $pos . '_shape_height' ] : '60';
					$svg = '<svg fill="' . $color . '" preserveAspectRatio="none" width="1920" height="198" viewBox="0 0 3200 198" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
							<path d="M1511,2.98155597e-19 C1911,2.98155597e-19 2011,198 2300,198 L700,198 C1011,198 1109.9,-0.2 1511,2.98155597e-19 Z"></path>
							<path d="M1600,121 C1911,121 2009.9,-0.2 2411,-1.42108547e-14 C2811,-1.42108547e-14 2911,121 3200,121 L3200,198 L1600,198 C1600,198 1600,150 1600,121 Z M0,121 C311,121 409.9,-0.2 811,-1.42108547e-14 C1211,-1.42108547e-14 1311,121 1600,121 L1600,198 L0,198 C0,198 0,150 0,121 Z" fill-opacity="0.5"></path>
					</svg>';
					break;

				case 'waves-2':
					$color  = isset( $values[ $pos . '_shape_color' ] ) ? $values[ $pos . '_shape_color' ] : '#000';
					$height = isset( $values[ $pos . '_shape_height' ] ) ? $values[ $pos . '_shape_height' ] : '60';
					$svg = '<svg fill="' . $color . '" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 300" preserveAspectRatio="none">
						<path d="M 1000 299 l 2 -279 c -155 -36 -310 135 -415 164 c -102.64 28.35 -149 -32 -232 -31 c -80 1 -142 53 -229 80 c -65.54 20.34 -101 15 -126 11.61 v 54.39 z"/>
						<path d="M 1000 286 l 2 -252 c -157 -43 -302 144 -405 178 c -101.11 33.38 -159 -47 -242 -46 c -80 1 -145.09 54.07 -229 87 c -65.21 25.59 -104.07 16.72 -126 10.61 v 22.39 z"/>
						<path d="M 1000 300 l 1 -230.29 c -217 -12.71 -300.47 129.15 -404 156.29 c -103 27 -174 -30 -257 -29 c -80 1 -130.09 37.07 -214 70 c -61.23 24 -108 15.61 -126 10.61 v 22.39 z"/>
					</svg>';
					break;

				case 'waves-3':
					$color  = isset( $values[ $pos . '_shape_color' ] ) ? $values[ $pos . '_shape_color' ] : '#000';
					$height = isset( $values[ $pos . '_shape_height' ] ) ? $values[ $pos . '_shape_height' ] : '100';
					$svg = '<svg fill="' . $color . '" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1600 100" style="enable-background:new 0 0 1600 100;" xml:space="preserve">
					<path fill-opacity="0.5" d="M1040,56c0.5,0,1,0,1.6,0c-16.6-8.9-36.4-15.7-66.4-15.7c-56,0-76.8,23.7-106.9,41c12.8,8,27.3,14.7,51.7,14.7
						C979.5,96,980,56,1040,56z"/>
					<path fill-opacity="0.5" d="M1699.8,96v10H1946l-0.3-6.9c0,0,0,0-88,0s-88.6-58.8-176.5-58.8c-51.4,0-73,20.1-99.6,36.8
						c14.5,9.6,29.6,18.9,58.4,18.9C1699.8,96,1699.8,96,1699.8,96z"/>
					<path fill-opacity="0.5" d="M1400,96c19.5,0,32.7-4.3,43.7-10c-35.2-17.3-54.1-45.7-115.5-45.7c-32.3,0-52.8,7.9-70.2,17.8
						c6.4-1.3,13.6-2.1,22-2.1C1340.1,56,1340.3,96,1400,96z"/>
					<path fill-opacity="0.5" d="M680,96c23.7,0,38.1-6.3,50.5-13.9C699.6,64.8,679,40.3,622.2,40.3c-30,0-49.8,6.8-66.3,15.8
						c1.3,0,2.7-0.1,4.1-0.1C619.7,56,620.2,96,680,96z"/>
					<path fill-opacity="0.5" d="M-22.5,90.7c28.3,0,43.3-8.7,57.4-18C7.9,55.9-13.5,35.3-65.7,35.3c-14.3,0-26.3,1.6-36.8,4.2v61.6h60v-10
						L-22.5,90.7z"/>
					<path fill-opacity="0.5" d="M504,73.4c-2.6-0.8-5.7-1.4-9.6-1.4c-19.4,0-19.6,13-39,13s-19.5-13-39-13c-14,0-18,6.7-26.3,10.4
						C402.4,89.9,416.7,96,440,96C472.5,96,487.5,84.2,504,73.4z"/>
					<path fill-opacity="0.5" d="M1205.4,85c-0.2,0-0.4,0-0.6,0c-19.5,0-19.5-13-39-13c-19.7,0-19.2,12.9-39,12.9c0,0-5.9,0-12.3,0.1
						c11.4,6.3,24.9,11,45.5,11S1194.1,91.2,1205.4,85z"/>
					<path fill-opacity="0.5" d="M1447.4,83.9c-2.4,0.7-5.2,1.1-8.6,1.1c-19.3,0-19.8-15.6-39-13c-37.3,5-46.1,20.4-39,13
						c2.1-2.2-5.5-0.3-7.7-0.8c11.6,6.6,25.4,11.8,46.9,11.8C1421.8,96,1435.7,90.7,1447.4,83.9z"/>
					<path fill-opacity="0.5" d="M985.8,72c-17.6,0.8-18.3,13-37,13c-19.4,0-19.5-13-39-13c-18.2,0-19.6,11.4-35.5,12.8
						c11.4,6.3,25,11.2,45.7,11.2C953.7,96,968.5,83.2,985.8,72z"/>
					<path fill-opacity="0.5" d="M1692.3,96V85c0,0,0,0-19.5,0s-19.6-13-39-13s-19.6,13-39,13c-0.1,0-0.2,0-0.4,0c11.4,6.2,24.9,11,45.6,11
						C1669.9,96,1684.8,96,1692.3,96z"/>
					<path d="M-40,95.6C20.3,95.6,20.1,56,80,56s60,40,120,40s59.9-40,120-40s60.3,40,120,40s60.3-40,120-40s60.2,40,120,40
						s60.1-40,120-40s60.5,40,120,40s60-40,120-40s60.4,40,120,40s59.9-40,120-40s60.3,40,120,40s60.2-40,120-40s60.2,40,120,40
						s59.8,0,59.8,0l0.2,143H-60V96L-40,95.6z"/>
					</svg>';
					break;

				case 'waves-4':
					$color  = isset( $values[ $pos . '_shape_color' ] ) ? $values[ $pos . '_shape_color' ] : '#000';
					$height = isset( $values[ $pos . '_shape_height' ] ) ? $values[ $pos . '_shape_height' ] : '100';
					$svg = '<svg fill="' . $color . '" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" x="0px" y="0px" viewBox="0 0 1440 149">
							  <path d="m0,54.06187c118.19818,9.64301 197.37493,15.71477 237.53025,18.21526c22.9659,1.4301 43.9256,3.1575 60.11153,3.83798c78.87981,3.31625 155.08061,4.4588 227.62385,1.88042c85.54281,-3.04043 180.25642,-8.19922 242.59375,-16.57343c150.375,-20.20094 300.50006,-40.24059 375.79417,-47.64866c27.83046,-2.73819 48.71532,-4.56444 74.66105,-6.57284c36.37895,-2.816 71.9183,-4.52609 98.99648,-5.52791c27.07819,-1.00183 58.90895,-1.67269 79.22064,-1.67269c13.54113,0 28.03056,0.55756 43.46828,1.67269l0,147.32731l-1440,0l0,-94.93813z"/>
							</svg>';
					break;


			}

			return '<div class="rella-row_' . $pos . '_divider" style="height:' . $height . 'px;">' . $svg . '</div>';

		}

	}

	new Rella_Shape_Divider_Options;

}
