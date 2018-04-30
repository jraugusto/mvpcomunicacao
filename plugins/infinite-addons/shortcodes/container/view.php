<?php

// check
if( ! $atts['style'] ) {
	return;
}

// Enqueue Conditional Script
$this->scripts();

do_action( 'rella_'. $atts['style'] .'_container', $this->atts );