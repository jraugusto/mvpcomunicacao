<?php
	add_action( 'wp_enqueue_scripts', 'boo_child_theme_style', 99 );
	function boo_parent_theme_scripts() {
	    wp_enqueue_style( 'base', get_template_directory_uri() . '/style.css' );
	}
	function boo_child_theme_style(){
	    wp_enqueue_style( 'child-boo-style', get_stylesheet_directory_uri() . '/style.css' );	
	}


