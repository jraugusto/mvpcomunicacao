<?php

$style = $atts['style'];

$sc_js = $this->load_js_sc();

// Enqueue Conditional Script
$this->scripts( $sc_js );

// classes
$classes = array( $this->get_class( $style ), $atts['el_class'], $this->get_id() );

//$this->generate_css();
query_posts( $this->build_query() );

add_filter( 'excerpt_length', array( $this, 'excerpt_lengh' ), 999 );
add_filter( 'excerpt_more', array( $this, 'excerpt_more' ) );

$file = dirname( __FILE__ ) . "/templates/$style.php";
if( file_exists( $file ) ) {

	include $file;

	wp_reset_query();

	return;
}