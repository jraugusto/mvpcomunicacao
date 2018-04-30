<?php

extract( $atts );

// Enqueue Conditional Script
$this->scripts();

if( '' !== $position && 'off-canvas' === $position ) {
	echo '<div class="header-module module-fullheight-side '. $off_canvas .'" data-enable-fullheight="true" id="main-header-off-canvas"><div class="module-inner">';

		echo ra_helper()->do_the_content( $content );

	echo '</div></div>';

	return;
}

echo '<div class="modules-container '. $this->get_id() .' ' . $position . ' ' . trim( vc_shortcode_custom_css_class( $css ) ) . '">';

if( '' !== $position ) {
	$classes = array( 'header-container' );
	printf( '<div class="%s">', ra_helper()->sanitize_html_classes( $classes ) );
}

$this->generate_css();

$this->header_module( $content );
echo ra_helper()->do_the_content( $content );

if( '' !== $position ) {
	echo '</div>';
}

echo '</div>';