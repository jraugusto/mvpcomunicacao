<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $equal_height
 * @var $columns_placement
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $parallax_speed_bg
 * @var $parallax_speed_video
 * @var $content - shortcode content
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$el_class = $full_height = $parallax_speed_bg = $parallax_speed_video = $full_width = $equal_height = $flex_row = $columns_placement = $content_placement = $parallax = $parallax_image = $css = $responsive_css = $el_id = $video_bg = $self_hosted_video_bg = $video_bg_url = $video_bg_parallax = $css_animation = $gradient_bg = $gradient_bg_color = $bg_position = $bg_pos_h = $bg_pos_v = $bg_attachment = $svg_separator = $svg_color = $zindex = $row_svg_divider = '';
$disable_element = $row_overflow = $fullpage_title = $fullpage_brightness = '';
$output = $after_output = $bg_styles = '';
$overlay_bg = $overlay_type = $overlay_color = $gradient_overlay = $responsive_style = '';

//Box Shadow att
$row_box_shadow = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'wpb_composer_front_js' );

$el_class = $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );

$css_classes = array(
	'vc_row',
	'wpb_row',
	//deprecated
	'vc_row-fluid',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);

$row_box_shadow = vc_param_group_parse_atts( $row_box_shadow );
if( ! empty( $row_box_shadow ) ) {
	$shadow_box_id = uniqid('rella-row-shadowbox-');
	$shadow_css    = rella_get_shadow_css( $row_box_shadow, $shadow_box_id );
	$css_classes[] = $shadow_box_id;
}

$row_top_divider = $row_bottom_divider = '';
if( ! empty( $row_svg_divider ) ) {
	$row_top_divider    = Rella_Shape_Divider_Options::getShape( $row_svg_divider );
	$row_bottom_divider = Rella_Shape_Divider_Options::getShape( $row_svg_divider, 'bottom' );
}

if( 'yes' === $row_overflow ) {
	$css_classes[] = 'overflow-visible';
}

if( ! empty( $responsive_css ) ) {
	$responsive_id = uniqid('rella-row-responsive-');
	$responsive_style = Rella_Responsive_Options::generate_css( $responsive_css, $responsive_id );
	$css_classes[] = $responsive_id;
}

if ( 'yes' === $disable_element ) {
	if ( vc_is_page_editable() ) {
		$css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
	} else {
		return '';
	}
}

$svg = '';
if ( 'yes' === $svg_separator ) {
				$svg = '<svg class="section-separator separator1" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 579 33" style="enable-background:new 0 0 579 33;" xml:space="preserve"> 
									<g>
										<g>
											<g>
												<path fill="'. esc_attr( $svg_color ) .'" ;="" d="M283,33c52.7,0,105-15.1,149.1-21.8C481.4,3.8,517.8,1,542.1,0H0c41.4,1.1,90.3,3.9,131.7,10.5 C176.5,17.7,229.9,33,283,33z"></path>
											</g>
										</g>
									</g>';
}

if ( vc_shortcode_custom_css_has_property( $css, array(
		'border',
		'background',
	) ) || $video_bg || $parallax
) {
	$css_classes[] = 'vc_row-has-fill';
}

if ( ! empty( $atts['gap'] ) ) {
	$css_classes[] = 'vc_column-gap-' . $atts['gap'];
}

$wrapper_attributes = array();
// build attributes for wrapper
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
if ( ! empty( $full_width ) ) {
	$wrapper_attributes[] = 'data-vc-full-width="true"';
	$wrapper_attributes[] = 'data-vc-full-width-init="false"';
	if ( 'stretch_row_content' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
	} elseif ( 'stretch_row_content_no_spaces' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
		$css_classes[] = 'vc_row-no-padding';
	}
	$after_output .= '<div class="vc_row-full-width vc_clearfix"></div>';
}

if ( ! empty( $full_height ) ) {
	$css_classes[] = 'vc_row-o-full-height';
	if ( ! empty( $columns_placement ) ) {
		$flex_row = true;
		$css_classes[] = 'vc_row-o-columns-' . $columns_placement;
		if ( 'stretch' === $columns_placement ) {
			$css_classes[] = 'vc_row-o-equal-height';
		}
	}
}

if( ! empty( $fullpage_title ) ) {
	$wrapper_attributes[] = 'data-section-name="'. esc_attr( $fullpage_title ) .'"';
}

if( ! empty( $fullpage_brightness ) ) {
	$wrapper_attributes[] = 'data-row-brightness="'. esc_attr( $fullpage_brightness ) .'"';
}

if ( ! empty( $equal_height ) ) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-equal-height';
}

if ( ! empty( $content_placement ) ) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-content-' . $content_placement;
}

if ( ! empty( $flex_row ) ) {
	$css_classes[] = 'vc_row-flex';
}

$has_video_bg = ( ! empty( $video_bg ) && ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );

$parallax_speed = $parallax_speed_bg;
if ( $has_video_bg ) {
	$parallax = $video_bg_parallax;
	$parallax_speed = $parallax_speed_video;
	$parallax_image = $video_bg_url;
	$css_classes[] = 'vc_video-bg-container';
	wp_enqueue_script( 'vc_youtube_iframe_api_js' );
}

$enabled_fullpage = rella_helper()->get_option( 'enable-fullpage' ); {
	if( 'on' ===  $enabled_fullpage ) {
		$parallax = $parallax_image = '';		
	}
}

$sh_video_bg = '';
if( ! empty( $self_hosted_video_bg ) ) {
	$sh_video_bg = '<div class="rella-self-hosted-row-bg">';
	$sh_video_bg .=		'<video autoplay loop muted>';
	$sh_video_bg .= 		'<source src="' . esc_url( $self_hosted_video_bg ) . '" type="video/mp4">';
	$sh_video_bg .= 	'</video>';
	$sh_video_bg .= '</div>';
	
	wp_enqueue_script( 'wp-mediaelement' );
	wp_enqueue_style( 'wp-mediaelement' );
	
}


if ( ! empty( $parallax ) ) {
	wp_enqueue_script( 'vc_jquery_skrollr_js' );
	$wrapper_attributes[] = 'data-vc-parallax="' . esc_attr( $parallax_speed ) . '"'; // parallax speed
	$css_classes[] = 'vc_general vc_parallax vc_parallax-' . $parallax;
	if ( false !== strpos( $parallax, 'fade' ) ) {
		$css_classes[] = 'js-vc_parallax-o-fade';
		$wrapper_attributes[] = 'data-vc-parallax-o-fade="on"';
	} elseif ( false !== strpos( $parallax, 'fixed' ) ) {
		$css_classes[] = 'js-vc_parallax-o-fixed';
	}
}

if ( ! empty( $parallax_image ) ) {
	if ( $has_video_bg ) {
		$parallax_image_src = $parallax_image;
	} else {
		$parallax_image_id = preg_replace( '/[^\d]/', '', $parallax_image );
		$parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
		if ( ! empty( $parallax_image_src[0] ) ) {
			$parallax_image_src = $parallax_image_src[0];
		}
	}
	$wrapper_attributes[] = 'data-vc-parallax-image="' . esc_attr( $parallax_image_src ) . '"';
}
if ( ! $parallax && $has_video_bg ) {
	$wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr( $video_bg_url ) . '"';
}
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( array_unique( $css_classes ) ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

if( 'yes' === $gradient_bg && ! empty( $gradient_bg_color ) ) {
	$bg = rella_parse_gradient( $gradient_bg_color );
	$bg_styles = ' background:' . esc_attr( $bg['background-image'] ) . ';';
}
if( 'custom' != $bg_position && ! empty( $bg_position ) ) {
	$bg_styles = ' background-position:' . esc_attr( $bg_position ) . ' !important;';
} 
elseif( 'custom' === $bg_position ) {
	$bg_styles = ' background-position:' . esc_attr( $bg_pos_h ) . ' ' . esc_attr( $bg_pos_v ) . ' !important; ';
}

if( 'scroll' !== $bg_attachment ){
	$bg_attachment = ' background-attachment:' .  esc_attr( $bg_attachment ) . '; ';
} else {
	$bg_attachment = '';
}

$z_index_style = ! empty( $zindex ) ? ' z-index:' . esc_attr( $zindex ) . ';' : '';

$wrapper_attributes[] = 'style="' . esc_attr( trim( $bg_styles . $bg_attachment . $z_index_style ) ) . '"';

$overlay_html = '';
if( $overlay_bg ) {
	$overlay_html = '<div class="rella-row-overlay"></div>';
	if ( 'color' === $overlay_type && ! empty( $overlay_color ) ) {
		$overlay_html = '<div class="rella-row-overlay" style="background:' . esc_attr( $overlay_color ) . '"></div>';	
	}
	elseif( 'gradient' === $overlay_type && ! empty( $gradient_overlay ) ) {
		$bg = rella_parse_gradient( $gradient_overlay );
		$overlay_html = '<div class="rella-row-overlay" style="background:' . esc_attr( $bg['background-image'] ) . '"></div>';	
	}
}

$check = apply_filters( 'rella_dinamic_css_output', 'rella_return_true' );

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= $sh_video_bg;
$output .= $overlay_html;
$output .= $svg;
$output .= $row_top_divider;
$output .= wpb_js_remove_wpautop( $content );
$output .= $row_bottom_divider;
if( ! empty( $responsive_style ) && $check || ! empty( $shadow_css ) && $check ) {
	$output .= '<script type="text/javascript">'
			. '(function($) {'
				. '$("head").append("<style>' . $responsive_style . $shadow_css . '</style>");'
			. '})(jQuery);'
		. '</script>';
}
$output .= '</div>';
$output .= $after_output;
echo $output;