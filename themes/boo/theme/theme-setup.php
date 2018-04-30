<?php
/**
 * Themerella Theme Framework
 * The Rella_Theme initiate the theme engine
 */

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

//Add support for Yellow Pencil plugin
define( 'YP_THEME_MODE', "true" );


//Only for demo purporse
//add_theme_support( 'theme-demo' );

// Custom Post Type Supports
add_theme_support( 'rella-portfolio' );
add_theme_support( 'rella-footer' );
add_theme_support( 'rella-header' );
add_theme_support( 'rella-promotion' );
add_theme_support( 'rella-mega-menu' );

// Custom Extensions
add_theme_support( 'rella-extension', array(
	'mega-menu',
	'breadcrumb',
	'wp-editor'
) );
add_post_type_support( 'post', 'rella-post-likes' );

// Set theme options
rella()->set_option_name( 'prefix_opt_name' );
add_theme_support( 'rella-theme-options', array(
	'general',
	'layout',
	'header',
	'logo',
	'footer',
	'sidebars',
	'typography',
	'blog',
	'portfolio',
	'promotions',
	'woocommerce',
	'extras',
	'advanced',
	'custom-code',
	'export'
));


//Set available metaboxes
add_theme_support( 'rella-metaboxes', array(
	'portfolio-general',
	'portfolio-meta',
	'page',
	'header',
	'footer',
	'sidebars',
	'title-wrapper',
	'title-wrapper-portfolio',
	'post',
	'post-format',

	// Rella Content
	'header-options',
	'footer-options'
));

//Enable support for Post Formats.
//See http://codex.wordpress.org/Post_Formats
add_theme_support( 'post-formats', array(
	'audio', 'gallery', 'link', 'quote', 'video'
) );

// Sets up theme navigation locations.
register_nav_menus( array(
   'primary' => esc_html__( 'Primary Menu', 'boo' )
));

// Register Widgets Area.
add_action( 'widgets_init', 'rella_main_sidebar' );
function rella_main_sidebar() {
	register_sidebar( array(
		'name'          => esc_html__( 'Main Sidebar', 'boo' ),
		'id'            => 'main',
		'description'   => esc_html__( 'Main widget area to display in sidebar', 'boo' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
}
