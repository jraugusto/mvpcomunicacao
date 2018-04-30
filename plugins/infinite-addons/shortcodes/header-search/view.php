<?php

// Enqueue Conditional Script
$this->scripts();
$this->generate_css();

$style = $atts['style'];
$logo = $atts['logo'];
$retina_logo = $atts['retina_logo'];

// check
$located = locate_template( "templates/header/header-search-$style.php" );

if ( ! file_exists( $located ) ) {
	$located = locate_template( 'templates/header/header-search.php' );
}
include $located;