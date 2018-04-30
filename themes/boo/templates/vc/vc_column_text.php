<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $css_animation
 * @var $css
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column_text
 */
$el_class = $css = $css_animation = $fill = $tag = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$class_to_filter = 'wpb_text_column wpb_content_element ' . $this->getCSSAnimation( $css_animation );
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$wrapper_attributes = array();
$wrapper_attributes[] = 'class="' . esc_attr( $css_class ) . '"';
if ( 'yes' === $fill ) {
	wp_enqueue_script( 'in-view' );
	wp_enqueue_script( 'SplitText' );
	$wrapper_attributes[] = 'data-plugin-fillin="true"';
	$wrapper_attributes[] = 'data-plugin-fillin-options=\'{ "element": "' . $tag . '" }\'';
}

$output = '
	<div ' . implode( ' ', $wrapper_attributes ) . '>
		<div class="wpb_wrapper">
			' . wpb_js_remove_wpautop( $content, true ) . '
		</div>
	</div>
';
echo $output;

wp_enqueue_script( 'jquery-appear' );