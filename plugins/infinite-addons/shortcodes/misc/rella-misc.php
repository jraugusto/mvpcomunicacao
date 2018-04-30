<?php

/**
 * Shortcode Title: Icon
 * Shortcode: ra_icon
 */
add_shortcode( 'ra_icon', 'ra_sc_icon' );
function ra_sc_icon( $atts, $content = null ) {

	extract( shortcode_atts(array(
		'icon'      => false,
		'container' => false,
		'span'      => false,
		'container_class' => 'icon-container'
    ), $atts ));

	if ( ! $icon ) {
		return '';
	}

	if ( $container ) {
		return sprintf( '<span class="%2$s"><i class="%1$s"></i></span>', ra_helper()->sanitize_html_classes( $icon ), $container_class );
	}

	if ( $span ) {
		return sprintf( '<span class="%1$s"></span>', ra_helper()->sanitize_html_classes( $icon ) );
	} else {
		return sprintf( '<i class="%1$s"></i>', ra_helper()->sanitize_html_classes( $icon ) );
	}

}

/**
 * Shortcode Title: Link
 * Shortcode: ra_link
 */
add_shortcode( 'ra_link', 'ra_sc_link' );
function ra_sc_link( $atts, $content = null ) {

	extract( shortcode_atts(array(
		'href'  => '#',
		'class' => false,
		'target' => false,

    ), $atts ));
	
	if( ! empty( $class ) ) {
		$class = 'class="'. $class .'"';
	}

	if( ! empty( $target ) ) {
		$target = 'target="'. $target .'"';
	}

	return '<a '. $class .' href="'. esc_url( $href ) .'" '. $target .'  >' . do_shortcode( $content ) . '</a>';
}

/**
 * Shortcode Title: Category Title
 * Shortcode: ra_category_title
 */
add_shortcode( 'ra_category_title', 'ra_sc_category_title' );
function ra_sc_category_title( $atts, $content = null ) {
	return single_cat_title( '', false );
}

/**
 * Shortcode Title: Tag Title
 * Shortcode: ra_tag_title
 */
add_shortcode( 'ra_tag_title', 'ra_sc_tag_title' );
function ra_sc_tag_title( $atts, $content = null ) {
	return single_tag_title( '', false );
}

/**
 * Shortcode Title: Author
 * Shortcode: ra_author
 */
add_shortcode( 'ra_author', 'ra_sc_author' );
function ra_sc_author( $atts, $content = null ) {
	return get_the_author();
}

/**
 * Shortcode Title: Typed
 * Shortcode: ra_typed
 */

add_shortcode( 'ra_typed', 'ra_sc_typed' );
function ra_sc_typed( $atts, $content = null ) {

	extract( shortcode_atts(array(

		'words' => false,

	), $atts ));
	
	if ( empty( $words ) ) {
		return;
	}

	$out = '';
	$words = explode( '|', $words );
	
	$out .= '<span class="typed-keywords">';
	$i = 1;
	foreach ( $words as $word ) {
		$active = ( $i == 1 ) ? ' active' : '';
		$out .= '<span class="keyword' . $active . '">' . $word . '</span>';
		$i++;
	}
	$out .= '</span><!-- /.typed-keywords -->';
	
	return $out;
	
}

/**
 * Shortcode Title: Typed String
 * Shortcode: ra_string
 */
add_shortcode( 'ra_string', 'ra_sc_string' );
function ra_sc_string( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
		
		'words' => false,
		
	), $atts ));

	if ( empty( $words ) ) {
		return;
	}
	
	$out = '';
	$words = explode( '|', $words );
	
	$out .= '<span class="typed-strings">';
	foreach ( $words as $word ) {
		$out .= '<span>' . $word . '</span>';
	}
	$out .= '</span><!-- /.typed-strings -->';

	return $out;	

}


/**
 * Shortcode Title: DropCap
 * Shortcode: ra_dropcap
 */
add_shortcode( 'ra_dropcap', 'ra_sc_dropcap' );
function ra_sc_dropcap( $atts, $content = null ) {

	return '<span class="dropcap">' . esc_html( $content ) . '</span>';
}

/**
 * Shortcode Title: Span
 * Shortcode: ra_span
 */
add_shortcode( 'ra_span', 'ra_sc_span' );
function ra_sc_span( $atts, $content = null ) {
	
	return '<span>' . esc_html( $content ) . '</span>';
}

/**
 * Shortcode Title: Break
 * Shortcode: ra_br
 */
add_shortcode( 'ra_br', 'ra_sc_break' );
function ra_sc_break( $atts, $content = null ) {

	return '<br />';
}