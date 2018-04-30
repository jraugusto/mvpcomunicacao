<?php
/**
* Rella Slider Param
*/
if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * [rella_param_subheading description]
 * @method rella_param_subheading
 * @param  [type]               $settings [description]
 * @param  [type]               $value    [description]
 * @return [type]                         [description]
 */
vc_add_shortcode_param( 'rella_slider', 'rella_param_slider' );
function rella_param_slider( $settings, $value ) {

	$value = htmlspecialchars( $value );

	$min  = isset( $settings['min'] ) ? $settings['min'] : '';
	$max  = isset( $settings['max'] ) ? $settings['max'] : '';
	$step = isset( $settings['step'] ) ? $settings['step'] : '';

	return '<div class="rella-slider" data-min="' . $min . '" data-max="' . $max . '" data-step="' . $step . '"><div class="rella-handle ui-slider-handle"></div></div>
			<input name="' . $settings['param_name']
	       . '" class="wpb_vc_param_value rella-sliderinput '
	       . $settings['param_name'] . ' ' . $settings['type']
	       . '" type="hidden" value="' . $value . '"/>';
}