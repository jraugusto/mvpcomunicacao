<?php
/**
 * Themerella Theme Framework
 */

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * [rella_site_title description]
 * @method rella_site_title
 * @return [type]           [description]
 */
function rella_site_title() {
	echo rella_get_site_title();
}

/**
 * [rella_get_site_title description]
 * @method rella_get_site_title
 * @return [type]               [description]
 */
function rella_get_site_title() {

	if ( $title = get_bloginfo( 'name' ) ) {
		$title = sprintf( '<h1 %s><a href="%s" rel="home">%s</a></h1>', rella_helper()->get_attr( 'site-title' ), esc_url( home_url() ), $title );
	}

	return apply_filters( 'rella_site_title', $title );
}

/**
 * [rella_site_description description]
 * @method rella_site_description
 * @return [type]                 [description]
 */
function rella_site_description() {
	echo rella_get_site_description();
}

/**
 * [rella_get_site_description description]
 * @method rella_get_site_description
 * @return [type]                     [description]
 */
function rella_get_site_description() {

	if ( $desc = get_bloginfo( 'description' ) ) {
		$desc = sprintf( '<h2 %s>%s</h2>', rella_helper()->get_attr( 'site-description' ), $desc );
	}

	return apply_filters( 'rella_site_description', $desc );
}

/**
 * [rella_get_content_template description]
 * @method rella_get_content_template
 * @return [type]                     [description]
 */
function rella_get_content_template() {

	// Set up an empty array and get the post type.
	$templates = array();
	$post_type = get_post_type();

	// Assume the theme developer is creating an attachment template.
	if ( 'attachment' === $post_type ) {

		remove_filter( 'the_content', 'prepend_attachment' );

		$type = rella_helper()->get_attachment_type();

		$templates[] = "templates/content/attachment-{$type}.php";
	}

	// If the post type supports 'post-formats', get the template based on the format.
	if ( post_type_supports( $post_type, 'post-formats' ) ) {

		// Get the post format.
		$post_format = get_post_format() ? get_post_format() : 'standard';

		// Template based off post type and post format.
		$templates[] = "templates/content/{$post_type}-{$post_format}.php";

		// Template based off the post format.
		$templates[] = "templates/content/{$post_format}.php";
	}

	// Template based off the post type.
	$templates[] = "templates/content/{$post_type}.php";

	// Fallback 'content.php' template.
	$templates[] = 'templates/content/content.php';

	// Apply filters to the templates array.
	$templates = apply_filters( 'rella_content_template_hierarchy', $templates );

	// Locate the template.
	$template = locate_template( $templates );

	// If template is found, include it.
	if ( apply_filters( 'rella_content_template', $template, $templates ) ) {
		include( $template );
	}
}

function rella_get_sc_with_google_fonts() {

	global $post;
	
	$tags = 'ra_icon_box|ra_content_box|vc_custom_heading';
	//$pattern = "/\[$tags (.+?)\]/";
	$pattern = get_shortcode_regex( array( 'ra_icon_box', 'ra_content_box', 'vc_custom_heading' ) );

	preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches);
	//preg_match_all( $pattern, $post->post_content, $matches );
	//print_r($matches[3]);
	
	$out = $vc_fonts = array();
	
	foreach( (array) $matches as $key => $value ) {
		
       if( isset($matches[3][$key]) ) {

	   	//print_r($matches[3][$key]);

		  $out[] = shortcode_parse_atts( $matches[3][$key] );

       }
    }
    
    if( is_array( $out ) ) {
	    foreach ( $out as $attr => $value ) {
		   if( array_key_exists( 'google_fonts', $value ) ) {
			   
			   $font_attr = rella_get_fonts_data($value['google_fonts']);
			   
			  // print_r(rella_get_font_family_data($font_attr['values']['font_family']));
			   
			   $font_family = rella_get_font_family_data( $font_attr['values']['font_family'] ); 
			   $font_styles = rella_get_font_styles_data( $font_attr['values']['font_family'] ); 
			   
			   $vc_fonts[$font_family] = $font_styles;
			   
			   if( isset( $fonts_attr['values']['font_family'] ) ) {
				//$vc_fonts[ $fonts_attr['values']['font_family'] ];
			   }
		   		//print_r( rella_get_fonts_data($value['google_fonts']));
			}
			elseif( array_key_exists( 'heading_font', $value ) ){
				
				$font_attr = rella_get_fonts_data($value['heading_font']);

			   $font_family = rella_get_font_family_data( $font_attr['values']['font_family'] ); 
			   $font_styles = rella_get_font_styles_data( $font_attr['values']['font_family'] ); 
			   
			   $vc_fonts[$font_family] = $font_styles;			   
			   
				//$vc_fonts[] = rella_get_fonts_data($value['heading_font']);;
				//print_r(rella_get_fonts_data($value['heading_font']));
			}
	    
	    
	    }
    }
    
    //print_r($vc_fonts);
    
    return $vc_fonts;
	
	
		
}

function rella_get_font_family_data( $fontsString ) {
	
	$font_family = '';
	$font_data = explode( ':', $fontsString );
	
	if( isset( $font_data[0] ) ){
		$font_family = $font_data[0];		
	}

	return $font_family;
}

function rella_get_font_styles_data( $fontsString ) {
	
	$font_style = $font_style_arr =  array();
	$font_data = explode( ':', $fontsString );

	if( isset( $font_data[1] ) ){
		$font_style = explode( ',', $font_data[1] );
	}	
	$font_style_arr = array( 'font-style' => $font_style );
	
	return $font_style_arr;
}

// Build the string of values in an Array
function rella_get_fonts_data( $fontsString ) {

	// Font data Extraction
	$fieldSettings = array();
	$fontsData = strlen( $fontsString ) > 0 ? rella_vc_google_fonts_parse_attributes( $fieldSettings, $fontsString ) : '';
	return $fontsData;

}

/**
 * @param $attr
 * @param $value
 *
 * @since 4.3
 * @return array
 */
function rella_vc_google_fonts_parse_attributes( $attr, $value ) {
	$fields = array();
	if ( is_array( $attr ) && ! empty( $attr ) ) {
		foreach ( $attr as $key => $val ) {
			if ( is_numeric( $key ) ) {
				$fields[ $val ] = '';
			} else {
				$fields[ $key ] = $val;
			}
		}
	}

	$values = vc_parse_multi_attribute( $value, array(
		'font_family' => isset( $fields['font_family'] ) ? $fields['font_family'] : '',
		'font_style' => isset( $fields['font_style'] ) ? $fields['font_style'] : '',
		'font_family_description' => isset( $fields['font_family_description'] ) ? $fields['font_family_description'] : '',
		'font_style_description' => isset( $fields['font_style_description'] ) ? $fields['font_style_description'] : '',
	) );

	return array( 'fields' => $fields, 'values' => $values );
}

function rella_get_shadow_css( $atts = array(), $id = '' ) {
	
	if( empty( $atts ) ){
		return;
	}
	
	$css_arr = array();
	$res_css = $shadow_css = '';
	
	$res_styles = array( '-webkit-box-shadow', '-moz-box-shadow', 'box-shadow' );
	foreach( $atts as $att ) {
		$css_arr[] = rella_create_box_shadow_property( $att );
	}
	$shadow_css = join( ', ', $css_arr );

	$res_css .= '.' . $id . '{';
		foreach( $res_styles as $style ) {
			$res_css .= $style . ':' . $shadow_css . ';';
		}
	$res_css .= '}';

	return $res_css;

}

function rella_create_box_shadow_property( $param = array() ) {
	
	$param = array_filter( $param );
	if( empty( $param ) ) {
		return;
	}
	
	$res = '';

	$res .= ! empty( $param['inset'] ) ? $param['inset'] . ' ' : '';
	$res .= isset( $param['x_offset'] ) ? $param['x_offset'] . ' ' : '0px ';
	$res .= isset( $param['y_offset'] ) ? $param['y_offset'] . ' ' : '0px ';
	$res .= isset( $param['blur_radius'] ) ? $param['blur_radius'] . ' ' : '0px ';		
	$res .= isset( $param['spread_radius'] ) ? $param['spread_radius'] . ' ' : '0px ';
	$res .= ! empty( $param['shadow_color'] ) ? $param['shadow_color'] : '#000';
	
	return $res;
	
}
