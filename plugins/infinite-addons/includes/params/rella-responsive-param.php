<?php
/**
* Rella Responsive Options
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
if( ! class_exists( 'Rella_Responsive_Options' ) ) {

	class Rella_Responsive_Options  {
		
		/**
		 * @var array
		 */
		protected $layers = array( 'margin', 'border', 'padding', 'content' );
		/**
		 * @var array
		 */
		protected $positions = array( 'top', 'right', 'bottom', 'left' );
		/**
		 * @var array
		 */
		protected $devices = array( 'desktop', 'tablet', 'mobile' );
		
		function __construct() {

			if ( function_exists( 'vc_add_shortcode_param' ) ) {
				vc_add_shortcode_param('responsive_css_editor', array( $this, 'responsive_param' ) );
			}
		}

		function responsive_param( $settings, $value ) {
			
			$label = isset( $settings['label'] ) ? $settings['label'] : esc_html__( 'Responsive Options', 'infinite-addons' );
			$values = $this->get_responsive_values( $value );
			$output = '<div class="rella-responsive-css-container vc_css-editor vc_row vc_ui-flex-row">';
				
			$devices = $this->devices;
			$i = 0;

			foreach( $devices as $device ) {
				
				$active = ( $i == 0 ) ? 'active' : '';
				
				$output .= '<div class="rella-main-responsive-wrapper ' . $active . '">';
				$output .= '<h3 class="rella-responsive-css-heading '. $device .'">' . $device  . '</h3>';
				$output .= '<div class="rella-inner-wrap">';
				$output .=  $this->onionLayout( $device, $values );	
				$output .= '</div>';
				$output .= '</div>';
				
				$i++;	
			};
			
			$output .= '</div>';
			$output .= '<input name="' . $settings['param_name'] . '" class="wpb_vc_param_value  ' . $settings['param_name'] . ' ' . $settings['type'] . '_field" type="hidden" value="' . $value . '" />';
			
			return $output;
			
		}
		
		public static function get_responsive_values( $value ) {
			return vc_parse_multi_attribute( $value, array( 'margin_top_desktop' => '', 'margin_right_desktop' => '', 'margin_bottom_desktop' => '', 'margin_left_desktop' => '', 'border_top_desktop' => '', 'border_right_desktop' => '', 'border_bottom_desktop' => '', 'border_left_desktop' => '', 'padding_top_desktop' => '', 'padding_right_desktop' => '', 'padding_bottom_desktop' => '', 'padding_left_desktop' => '', 'margin_top_tablet' => '', 'margin_right_tablet' => '', 'margin_bottom_tablet' => '', 'margin_left_tablet' => '', 'border_top_tablet' => '', 'border_right_tablet' => '', 'border_bottom_tablet' => '', 'border_left_tablet' => '', 'padding_top_tablet' => '', 'padding_right_tablet' => '', 'padding_bottom_tablet' => '', 'padding_left_tablet' => '', 'margin_top_mobile' => '', 'margin_right_mobile' => '', 'margin_bottom_mobile' => '', 'margin_left_mobile' => '', 'border_top_mobile' => '', 'border_right_mobile' => '', 'border_bottom_mobile' => '', 'border_left_mobile' => '', 'padding_top_mobile' => '', 'padding_right_mobile' => '', 'padding_bottom_mobile' => '', 'padding_left_mobile' => '' ) );
		}

		/**
		 * @return string
		 */
		function onionLayout( $prefix = '', $values = array() ) {

			$output = '<div class="vc_layout-onion vc_col-xs-12">'
			          . '    <div class="vc_margin">' . $this->layerControls( 'margin', $prefix, $values )
			          . '      <div class="vc_border">' . $this->layerControls( 'border', $prefix, $values )
			          . '          <div class="vc_padding">' . $this->layerControls( 'padding', $prefix, $values )
			          . '              <div class="vc_content"><i></i></div>'
			          . '          </div>'
			          . '      </div>'
			          . '    </div>'
			          . '</div>';

			return $output;
		}
		
		/**
		 * @param $name
		 * @param string $prefix
		 *
		 * @return string
		 */
		protected function layerControls( $name, $prefix = '', $values = array() ) {

			$output = '<label>' . $name . '</label>';

			foreach ( $this->positions as $pos ) {
				$output .= '<input type="number" name="' . $name . '_' . $pos . ( '' !== $prefix ? '_' . $prefix : '' ) . '" data-name="' . $name . '-' . $pos . ( '' !== $prefix ? '-' . $prefix : '' ) . '" class="vc_' . $pos . '" placeholder="-" value="' .  $values['' . $name . '_' . $pos . ( '' !== $prefix ? '_' . $prefix : '' ) . ''] . '">';
			}

			return $output;
		
		}
		
		public static function generate_css( $value, $id = '' ) {
			
			if( empty( $value ) ){
				return;
			}
			
			$values = Rella_Responsive_Options::get_responsive_values( $value );
			$resolutions = array( 'desktop', 'tablet', 'mobile' );
			$positions = array( 'top', 'right', 'bottom', 'left' );
			$atts = array( 'margin', 'padding', 'border' );
			$media_query = array(
				'desktop' => '@media (max-width: 1199px) and (min-width: 992px)',
				'tablet'  => '@media (max-width: 991px) and (min-width: 768px)',
				'mobile'  => '@media (max-width: 767px)',
			);
			
			$res_css = '';
			$res_style = array( 'desktop' => '', 'tablet' => '', 'mobile' => '' );

			foreach ( $atts as $attr ) {
				foreach( $positions as $pos ) {

					if(  isset( $values['' . $attr . '_' . $pos .'_desktop'] ) && $values['' . $attr . '_' . $pos .'_desktop'] != '' ) {
						if( 'border' === $attr ){
							$res_style['desktop'] .= $attr . '-' . $pos . '-width:' . $values['' . $attr . '_' . $pos .'_desktop'] . 'px !important; ';	
						}
						else {
							$res_style['desktop'] .= $attr . '-' . $pos . ':' . $values['' . $attr . '_' . $pos .'_desktop'] . 'px !important; ';
						}
					} 
					if(  isset( $values['' . $attr . '_' . $pos .'_tablet'] ) && $values['' . $attr . '_' . $pos .'_tablet'] != '' ) {
						if( 'border' === $attr ){
							$res_style['tablet'] .= $attr . '-' . $pos . '-width:' . $values['' . $attr . '_' . $pos .'_tablet'] . 'px !important; ';	
						}
						else {
							$res_style['tablet'] .= $attr . '-' . $pos . ':' . $values['' . $attr . '_' . $pos .'_tablet'] . 'px !important; ';
						}
					} 
					if(  isset( $values['' . $attr . '_' . $pos .'_mobile'] ) && $values['' . $attr . '_' . $pos .'_mobile'] != '' ) {
						if( 'border' === $attr ){
							$res_style['mobile'] .= $attr . '-' . $pos . '-width:' . $values['' . $attr . '_' . $pos .'_mobile'] . 'px !important; ';							
						}
						else {
							$res_style['mobile'] .= $attr . '-' . $pos . ':' . $values['' . $attr . '_' . $pos .'_mobile'] . 'px !important; ';	
						}
					}
				}
			}			

			if( isset( $res_style['desktop'] ) && $res_style['desktop'] !== '' ) {
				$res_css .= $media_query['desktop'] . ' { '. '.' . $id . ' {' . $res_style['desktop'] . ' }  } ';
			}
			if( isset( $res_style['tablet'] ) && $res_style['tablet'] !== '' ) {
				$res_css .= $media_query['tablet'] . ' { '. '.' . $id . ' {' . $res_style['tablet'] . ' }  } ';
			}
			if( isset( $res_style['mobile'] ) && $res_style['mobile'] !== '' ) {
				$res_css .= $media_query['mobile'] . ' { '. '.' . $id . ' {' . $res_style['mobile'] . ' }  } ';
			}

			return $res_css;		
		}
	}
}

new Rella_Responsive_Options;