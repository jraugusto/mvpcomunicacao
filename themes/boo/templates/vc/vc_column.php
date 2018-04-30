<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $width
 * @var $css
 * @var $offset
 * @var $content - shortcode content
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column
 */
$el_class = $width = $css = $responsive_css = $offset = $css_animation = $delay = $align = $gradient_bg = $gradient_bg_color = $bg_position = $bg_pos_h = $bg_pos_v = $zindex = $enable_transform = '';
$output = $bg_styles = '';

//Paralax vars
$parallax = $parallax_preset = $parallax_from = $parallax_to = $parallax_time = $parallax_duration = $parallax_offset = $parallax_trigger = $parallax_trigger_number = $enable_reverse = '';

$translate_from_x = $translate_from_y = $translate_from_z = $scale_from_x = $scale_from_y = $scale_from_z = $rotate_from_x = $rotate_from_y = $rotate_from_z = $from_torigin_x = $from_torigin_x_custom = $from_torigin_y = $from_torigin_y_custom = $from_opacity = '';

$translate_to_x = $translate_to_y = $translate_to_z = $scale_to_x = $scale_to_y = $scale_to_z = $rotate_to_x = $otate_to_y = $rotate_to_z = $to_torigin_x = $to_torigin_x_custom = $to_torigin_y = $to_torigin_y_custom = $to_opacity = $to_delay = $to_easy = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$width = wpb_translateColumnWidthToSpan( $width );
$width = vc_column_offset_class_merge( $offset, $width );

$animation_class = $this->getCSSAnimation( $css_animation );
$animation_class = str_replace( 'wpb_animate_when_almost_visible', 'rella_animate_when_almost_visible', $animation_class );

$css_classes = array(
	$this->getExtraClass( $el_class ),
	$animation_class,
	'wpb_column',
	'vc_column_container',
	$width,
	$align
);

if ( vc_shortcode_custom_css_has_property( $css, array(
	'border',
	'background',
) ) ) {
	$css_classes[] = 'vc_col-has-fill';
}

if( ! empty( $responsive_css ) ) {
	$responsive_id = uniqid('rella-column-responsive-');
	$column_selector = $responsive_id . ' > .vc_column-inner';
	$responsive_style = Rella_Responsive_Options::generate_css( $responsive_css, $column_selector );
	$css_classes[] = $responsive_id;
}

if( has_shortcode( $content, 'ra_history' ) ) {
	$css_classes[] = 'history-box history-circle';
}

$wrapper_attributes = array();

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
if( ! empty( $delay ) ) {
	$wrapper_attributes[] = 'data-animation-delay="' . esc_attr( $delay ) . '"';
}

$col_styles = array();

if( 'yes' === $gradient_bg && ! empty( $gradient_bg_color ) ) {
	$bg = rella_parse_gradient( $gradient_bg_color );
	$bg_styles = ' background:' . esc_attr( $bg['background-image'] ) . '';
}
if( 'custom' != $bg_position && ! empty( $bg_position ) ) {
	$bg_styles = ' background-position:' . esc_attr( $bg_position ) . ' !important; ';
}
elseif( 'custom' === $bg_position ) {
	$bg_styles = ' background-position:' . esc_attr( $bg_pos_h ) . ' ' . esc_attr( $bg_pos_v ) . ' !important; ';
}
$z_index_style = ! empty( $zindex ) ? 'style="z-index:' . esc_attr( $zindex ) . ';"' : '';
$wrapper_attributes[] = $z_index_style;

$col_styles[] = ' style="' . esc_attr( trim( $bg_styles ) ) . '"';

$enabled_fullpage = rella_helper()->get_option( 'enable-fullpage' ); {
	if( 'on' ===  $enabled_fullpage ) {
		$parallax = '';		
	}
}

if( 'yes' === $parallax ) {

	wp_enqueue_script( 'animation-gsap' );
	wp_enqueue_script( 'TweenMax' );

	$parallax_data = $parallax_data_from = $parallax_data_to = $parallax_opts = array();

	$wrapper_attributes[] = 'data-parallax="true"';
	$wrapper_attributes[] = 'data-smooth-transition="true"';

	//Data-options-from
	if ( isset( $translate_from_x ) ) { $parallax_data_from['x']      = ( int ) $translate_from_x; }
	if ( isset( $translate_from_y ) ) { $parallax_data_from['y']      = ( int ) $translate_from_y; }
	if ( isset( $translate_from_z ) ) { $parallax_data_from['z']      = ( int ) $translate_from_z; }

	if ( isset( $scale_from_x ) ) { $parallax_data_from['scaleX']     = ( float ) $scale_from_x; }
	if ( isset( $scale_from_y ) ) { $parallax_data_from['scaleY']     = ( float ) $scale_from_y; }
	if ( isset( $scale_from_z ) ) { $parallax_data_from['scaleZ']     = ( float ) $scale_from_z; }

	if ( isset( $rotate_from_x ) ) { $parallax_data_from['rotationX'] = ( int ) $rotate_from_x; }
	if ( isset( $rotate_from_y ) ) { $parallax_data_from['rotationY'] = ( int ) $rotate_from_y; }
	if ( isset( $rotate_from_z ) ) { $parallax_data_from['rotationZ'] = ( int ) $rotate_from_z; }

	if ( isset( $from_opacity ) ) { $parallax_data_from['opacity']    = ( float ) $from_opacity; }

	if ( ! empty(
		$from_torigin_x_custom ) ) { $_x_custom = $from_torigin_x_custom;
	} else {
		$_x_custom = ! empty( $from_torigin_x ) ? $from_torigin_x : '';
	}
	if ( ! empty( $from_torigin_y_custom ) ) {
		$_y_custom = $from_torigin_y_custom;
	} else {
		$_y_custom = ! empty( $from_torigin_y ) ? $from_torigin_y : '';
	}
	if ( ! empty( $_x_custom ) && ! empty( $_y_custom ) ) {
		$parallax_data_from['transformOrigin'] = $_x_custom . '&nbsp;' . $_y_custom;
	}

	//Data-options-to
	if ( isset( $translate_to_x ) ) { $parallax_data_to['x'] = ( int ) $translate_to_x; }
	if ( isset( $translate_to_y ) ) { $parallax_data_to['y'] = ( int ) $translate_to_y; }
	if ( isset( $translate_to_z ) ) { $parallax_data_to['z'] = ( int ) $translate_to_z; }

	if ( isset( $scale_to_x ) ) { $parallax_data_to['scaleX'] = ( float ) $scale_to_x; }
	if ( isset( $scale_to_y ) ) { $parallax_data_to['scaleY'] = ( float ) $scale_to_y; }
	if ( isset( $scale_to_z ) ) { $parallax_data_to['scaleZ'] = ( float ) $scale_to_z; }

	if ( isset( $rotate_to_x ) ) { $parallax_data_to['rotationX'] = ( int ) $rotate_to_x; }
	if ( isset( $rotate_to_y ) ) { $parallax_data_to['rotationY'] = ( int ) $rotate_to_y; }
	if ( isset( $rotate_to_z ) ) { $parallax_data_to['rotationZ'] = ( int ) $rotate_to_z; }

	if ( isset( $to_opacity ) ) { $parallax_data_to['opacity'] = ( float ) $to_opacity; }

	if( ! empty(
		$to_torigin_x_custom ) ) { $to_x_custom = $to_torigin_x_custom;
	} else {
		$to_x_custom = ! empty( $to_torigin_x ) ? $to_torigin_x : '';
	}
	if( ! empty( $to_torigin_y_custom ) ) {
		$to_y_custom = $to_torigin_y_custom;
	} else {
		$to_y_custom = ! empty( $to_torigin_y ) ? $to_torigin_y : '';
	}
	if( ! empty( $to_x_custom ) && ! empty( $to_y_custom ) ) {
		$parallax_data_to['transformOrigin'] = $to_x_custom . '&nbsp;' . $to_y_custom;
	}

	//Parallax general options
	if( 'custom' !== $parallax_preset ) {
			$parallax_data = rella_get_parallax_preset( $parallax_preset );
	} else {

		if ( ! empty( $parallax_from ) ) {
			$parallax_data['from'] = $parallax_from;
		} else {
			$parallax_data['from'] = $parallax_data_from;
		}
		if( ! empty( $parallax_to ) ) {
			$parallax_data['to'] = $parallax_to;
		} else {
			$parallax_data['to'] = $parallax_data_to;
		}
	}

	if( is_array( $parallax_data['from'] ) && ! empty( $parallax_data['from'] ) ) {
		$wrapper_attributes[] = 'data-parallax-from=\'' . wp_json_encode( $parallax_data['from'] ) . '\'';
	}
	elseif( ! empty( $parallax_from ) ) {
		$wrapper_attributes[] = 'data-parallax-from=\'{' . $parallax_from . '}\'';
	}

	if( is_array( $parallax_data['to'] ) && ! empty( $parallax_data['to'] ) ) {

		$wrapper_attributes[] = 'data-parallax-to=\'' . wp_json_encode( $parallax_data['to'] ) . '\'';
	}
	elseif( ! empty( $parallax_to ) ) {
		$wrapper_attributes[] = 'data-parallax-to=\'{' . $parallax_to . '}\'';
	}

	if( ! empty( $parallax_time ) ) { $parallax_opts['time'] = esc_attr( $parallax_time ); }
	if( ! empty( $parallax_duration ) ) { $parallax_opts['duration'] = esc_attr( $parallax_duration ); }
	if ( isset( $to_easy ) ) { $parallax_opts['ease'] = $to_easy; }
	if ( ! empty( $to_delay ) ) { $parallax_opts['delay'] = ( float ) $to_delay; }
	if( ! empty( $parallax_offset ) ) { $parallax_opts['offset'] = esc_attr( $parallax_offset ); }
	if( 'yes' === $enable_reverse ) {
		$parallax_opts['reverse'] = true;
	}
	else {
		$parallax_opts['reverse'] = false;
	}
	if( 'number' !== $parallax_trigger ){
		$parallax_opts['triggerHook'] = esc_attr( $parallax_trigger );
	}
	elseif ( ! empty( $parallax_trigger_number ) ) {
		$parallax_opts['triggerHook'] = esc_attr( $parallax_trigger_number );
	}
	if( 'yes' === $enable_transform ){
		$parallax_opts['addPerspective'] = true;
	}
	if( ! empty( $parallax_opts ) ) {
		$wrapper_attributes[] = 'data-parallax-options=\'' . wp_json_encode( $parallax_opts ) .'\'';
	}

}

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= '<div class="vc_column-inner ' . esc_attr( trim( vc_shortcode_custom_css_class( $css ) ) ) . '" ' . implode( ' ', $col_styles ) . '>';
$output .= '<div class="wpb_wrapper">';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
$output .= '</div>';
if( ! empty( $responsive_style ) ) {
	$output .= '<script type="text/javascript">'
			. '(function($) {'
				. '$("head").append("<style>' . $responsive_style . '</style>");'
			. '})(jQuery);'
		. '</script>';
}
$output .= '</div>';
echo $output;

wp_dequeue_script( 'custom' );
wp_enqueue_script( 'custom' );
