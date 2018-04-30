<?php
/**
* Gradient Params
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * [rella_param_gradient description]
 * @method rella_param_gradient
 * @param  [type]               $settings [description]
 * @param  [type]               $value    [description]
 * @return [type]                         [description]
 */
vc_add_shortcode_param( 'gradient', 'rella_param_gradient' );
function rella_param_gradient( $settings, $value ) {
	$output = '';

	$output .= sprintf( '<input type="text" class="hidden wpb_vc_param_value" id="%1$s" name="%1$s" value="%2$s">', $settings['param_name'], $value );
	$output .= sprintf( '<input type="text" class="hidden rella-gradient-css">', $settings['param_name'] );
	$output .= sprintf( '<input type="text" class="hidden rella-gradient-bg">', $settings['param_name'] );
	$output .= sprintf( '<div id="%1$s-gradient" class="rella-gradient"></div>', $settings['param_name'] );

	return $output;
}

/**
 * [rella_parse_gradient description]
 * @method rella_parse_gradient
 * @param  [type]               $value [description]
 * @return [type]                      [description]
 */
function rella_parse_gradient( $value, $return = 'array' ) {
	$value = explode('|', $value );

	if( 'css' === $return ) {

		$css = sprintf( 'background-image:%s;%s', $value[0], $value[1] );
		return $css;
	}

	$bg = array();
	$bg['background-image'] = $value[0];

	$value = explode( ';', $value[1] );
	array_pop( $value );
	foreach( $value as $item ) {
		$item = explode( ':', $item );

		$bg[ $item[0] ] = trim( $item[1] );
	}

	return $bg;
}
