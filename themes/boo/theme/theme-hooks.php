<?php
/**
 * Themerella Theme Framework
 */

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_filter( 'body_class', 'rella_add_body_classes' );
/**
 * [rella_add_body_classes description]
 * @method rella_add_body_classes
 * @param  [type]                 $classes [description]
 */
function rella_add_body_classes( $classes ) {

	//Boxed Layout
	$layout = rella_helper()->get_option( 'page-layout-width' );
	if( 'boxed' === $layout ) {
		$classes[] = 'boxed';
	}

	//Preloader classnames
	$enable_preloader = rella_helper()->get_theme_option( 'enable-preloader' );
	$preloader_style  = rella_helper()->get_theme_option( 'preloader-style' );
	if( $enable_preloader ) {
		$classes[] = 'preloader-animation--not-started preloader-' . $preloader_style;
	}

	//Header vertical nav
	$head_id = rella_get_custom_header_id(); // which one
	$is_vertical = rella_get_vertical_navigation( $head_id );
	if( $is_vertical ) {
		$classes[] = 'header-side';
	}

	// Header sticky class
	$id = rella_get_custom_header_id(); // which one
	if( $scroll = rella_helper()->get_post_meta( 'header-scroll-type', $id ) ) {
		$classes[] = 'header-' . $scroll;
	}

	//Progressively load classnames
	if( rella_helper()->get_option( 'enable-lazy-load' ) && !is_admin() ) {
		$classes[] = 'progressive-load-activated';
	}

	//Smooth scroll classnames
	if( rella_helper()->get_option( 'smooth-scroll' ) ) {
		$classes[] = 'smooth-wheel-enabled';
	}

	if( 'wide' === rella_helper()->get_theme_option( 'page-layout-width' ) ){
		$classes[] = 'layout-1275';
	}

	//Footer fixed
	$footer_id = rella_get_custom_footer_id();
	if( 'on' === rella_helper()->get_post_meta( 'footer-fixed', $footer_id ) ) {
		$classes[] = 'footer-fixed';
	}

	//Mobile header overlay
	$enabled_mobile_overlay = rella_helper()->get_option( 'mobile-header-overlay-enable' );
	if(! empty( $enabled_mobile_overlay ) ) {
		$classes[] = $enabled_mobile_overlay;
	}

	//Fullpage enable
	$enabled_fullpage = rella_helper()->get_option( 'enable-fullpage' );
	if( 'on' === $enabled_fullpage ) {

		$fullpage_nav_style = rella_helper()->get_option( 'fullpage-nav-style' );
		$fullpage_header_visibility = rella_helper()->get_option( 'fullpage-header-visibility' );

		$classes[] = 'overflow-hidden fullpage-nav-' . $fullpage_nav_style . ' ' . $fullpage_header_visibility;


	}

	return $classes;
}

add_filter( 'rella_single_post_class', 'rella_add_single_post_class' );
/**
 * [rella_add_single_post_class description]
 * @method rella_add_single_post_class
 * @param  [type]                 $classes [description]
 */
function rella_add_single_post_class( $class ) {
	
	if( ! is_single() ) {
		return $class;
	}

	$style = rella_helper()->get_option( 'post-style', 'default' );
	$single_classname = '';	

	if( 'cover' === $style )	 {
		$single_classname = ' blog-single blog-single-alt'; 	
	}

	return $class . $single_classname;

}

/**
* [rella_preloader description]
* @method rella_preloader
* @return [type]                [description]
*/
add_action( 'rella_before_header', 'rella_preloader' );
function rella_preloader() {

	$enable_preloader = rella_helper()->get_theme_option( 'enable-preloader' );
	$preloader_style  = rella_helper()->get_theme_option( 'preloader-style' );
	if( ! $enable_preloader ) {
		return;
	}

	if( 'style2' === $preloader_style ){
		get_template_part( 'templates/preloader/style2' );
		return;
	}
	elseif( 'style3' === $preloader_style ){
		get_template_part( 'templates/preloader/style3' );
		return;
	}
	elseif( 'style4' === $preloader_style ){
		get_template_part( 'templates/preloader/style4' );
		return;
	}
	elseif( 'style5' === $preloader_style ){
		get_template_part( 'templates/preloader/style5' );
		return;
	}
	elseif( 'style6' === $preloader_style ){
		get_template_part( 'templates/preloader/style6' );
		return;
	}

	get_template_part( 'templates/preloader/default' );
}

/**
* [rella_add_top_promo_box description]
* @method rella_add_top_promo_box
* @return [type]                [description]
*/
add_action( 'rella_before', 'rella_add_top_promo_box' );
function rella_add_top_promo_box() {
	
	$enable = rella_helper()->get_option( 'enable-promo', 'raw', '' );
	$position = rella_helper()->get_option( 'promo-positions' );
	
	if( is_search() ) {
		$enable = rella_helper()->get_theme_option( 'enable-promo', 'raw', '' );
		$position = rella_helper()->get_theme_option( 'promo-positions' );		
	}
	
	if( 'on' !== $enable ) {
		return;
	}
	elseif( 'inpost' === $position ) {
		return;
	}

	get_template_part( 'templates/promo/in', 'header' );
	
}

/**
* [rella_add_inpost_promo_box description]
* @method rella_add_inpost_promo_box
* @return [type]                [description]
*/
add_action( 'rella_after_author_content', 'rella_add_inpost_promo_box' );
function rella_add_inpost_promo_box() {
	
	$enable = rella_helper()->get_option( 'enable-promo' );
	$position = rella_helper()->get_option( 'promo-positions' );
	
	if( 'on' !== $enable ) {
		return;
	}
	elseif( 'top' === $position  ) {
		return;
	}

	get_template_part( 'templates/promo/in', 'post' );
	
}

/**
 * [rella_get_header_view description]
 * @method rella_get_header_view
 * @return [type]             [description]
 */
add_action( 'rella_header', 'rella_get_header_view' );
function rella_get_header_view() {

	//Check if is not frontend vc editor
	if( function_exists( 'vc_mode' ) && 'page_editable' === vc_mode() ) {
		return;
	}

	$enable = rella_helper()->get_option( 'header-enable-switch', 'raw', '' );
	// Check if header is enabled
	if( 'off' === $enable ) {
		return;
	}

	// Overlay Header
	$header_id = rella_get_custom_header_id();
	$layout    = rella_helper()->get_post_meta( 'header-layout', $header_id );
	$enable_titlebar    = rella_helper()->get_option( 'title-bar-enable', 'raw', '' );

	if( 'overlay' === $layout && 'on' === $enable_titlebar ){
		return;
	}

	if( $id = rella_helper()->get_option( 'header-template', 'raw', false ) ) {
		get_template_part( 'templates/header/custom' );
		return;
	}

	get_template_part( 'templates/header/default' );
}

/**
 * [rella_get_header_view description]
 * @method rella_get_header_view
 * @return [type]             [description]
 */
add_action( 'rella_header_titlebar', 'rella_get_header_titlebar_view' );
function rella_get_header_titlebar_view() {

	//Check if is not frontend vc editor
	if( function_exists( 'vc_mode' ) && 'page_editable' === vc_mode() ) {
		return;
	}

	$enable = rella_helper()->get_option( 'header-enable-switch', 'raw', '' );
	// Check if title bar is enabled
	if( 'on' !== $enable ) {
		return;
	}

	// Overlay Header
	$header_id = rella_get_custom_header_id();
	$layout    = rella_helper()->get_post_meta( 'header-layout', $header_id );
	$layout    = $layout ? $layout : 'default';

	if( 'default' === $layout ){
		return;
	}

	if( $id = rella_helper()->get_option( 'header-template', 'raw', false ) ) {
		get_template_part( 'templates/header/custom' );
		return;
	}

	get_template_part( 'templates/header/default' );
}

add_action( 'rella_after_header', 'rella_get_titlebar_view' );
/**
 * [rella_get_titlebar_view description]
 * @method rella_get_titlebar_view
 * @return [type]                  [description]
 */
function rella_get_titlebar_view() {

	if( class_exists( 'ReduxFramework' ) ) {

		if( is_search() ) {
			$enable = rella_helper()->get_option( 'search-title-bar-enable', 'raw', '' );
		}
		elseif( is_post_type_archive( 'rella-portfolio' ) || is_tax( 'rella-portfolio-category' ) ) {
			$enable = rella_helper()->get_option( 'portfolio-title-bar-enable', 'raw', '' );
		}
		elseif( class_exists( 'WooCommerce' ) && ( is_product_taxonomy() || is_product_category() ) ) {
			$enable = rella_helper()->get_option( 'wc-archive-title-bar-enable', 'raw', '' );
		}
		elseif( ! rella_helper()->get_current_page_id() && is_home() ){
			$enable = rella_helper()->get_option( 'blog-title-bar-enable', 'raw', '' );
		}
		elseif( is_category() ) {
			$enable = rella_helper()->get_option( 'category-title-bar-enable', 'raw', '' );
		}
		elseif( is_tag() ){
			$enable = rella_helper()->get_option( 'tag-title-bar-enable', 'raw', '' );
		}
		elseif( is_author() ) {
			$enable = rella_helper()->get_option( 'author-title-bar-enable', 'raw', '' );
		}
		else {
			$enable = rella_helper()->get_option( 'title-bar-enable', 'raw', '' );
		}

		if( is_404() || 'on' !== $enable ) {
			return;
		}
	}

	if( is_singular( 'rella-portfolio' )) {
		get_template_part( 'templates/header/header-title-bar', 'portfolio' );
		return;
	}

	if( ! class_exists( 'ReduxFramework' ) && is_single() ) {
		return;
	}

	get_template_part( 'templates/header/header-title', 'bar' );
}

/**
 * [rella_get_footer_view description]
 * @method rella_get_footer_view
 * @return [type]             [description]
 */
add_action( 'rella_footer', 'rella_get_footer_view' );
function rella_get_footer_view() {
	$enable = rella_helper()->get_option( 'footer-enable-switch', 'raw', '' );
	if( 'off' === $enable ) {
		return;
	}

	if( $id = rella_helper()->get_option( 'footer-template', 'raw', false ) ) {
		get_template_part( 'templates/footer/custom' );
		return;
	}

	get_template_part( 'templates/footer/default' );
}

/**
 * [rella_custom_sidebars description]
 * @method rella_custom_sidebars
 * @return [type]                [description]
 */
add_action( 'after_setup_theme', 'rella_custom_sidebars', 9 );
function rella_custom_sidebars() {

	//adding custom sidebars defined in theme options
	$custom_sidebars = rella_helper()->get_theme_option( 'custom-sidebars' );
	$custom_sidebars = array_filter( (array)$custom_sidebars );

	if ( !empty( $custom_sidebars ) ) {

		foreach ( $custom_sidebars as $sidebar ) {

			register_sidebar ( array (
				'name' => $sidebar,
				'id' => sanitize_title( $sidebar ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );
		}
	}
}

/**
 * Remove ver variable from enqueued scripts and css files
 * @method rella_remove_clear_static_files
 * @param  [type]                         $src [description]
 * @return [type]                              [description]
 */

function rella_remove_clear_static_files() {
	if ( rella_helper()->get_theme_option( 'clear-static-files' ) ) {
		add_filter( 'script_loader_src', 'rella_clear_files_query_string', 15, 1 );
		add_filter( 'style_loader_src', 'rella_clear_files_query_string', 15, 1 );
	}
}
add_action( 'init', 'rella_remove_clear_static_files' );

/**
 * Remove ver variable from enqueued scripts and css files
 * E.g. http://yourdomain/style.css?ver=1.3
 *
 * @method rella_clear_files_query_string
 * @param  [type]                         $src [description]
 * @return [type]                              [description]
 */
function rella_clear_files_query_string( $src ) {

	$src = remove_query_arg( array( 'ver', 'v', 'tumestamp' ), $src );

	return $src;
}

/**
 * Remove type and id attribute from stylesheet
 * @method rella_html5_stylesheet
 * @param  [type]                 $html   [description]
 * @param  [type]                 $handle [description]
 * @return [type]                         [description]
 */

if( current_theme_supports( 'html5', 'rella-assets' ) ) {
	add_filter( 'style_loader_tag', 'rella_html5_stylesheet', 10, 2 );
	add_filter( 'script_loader_tag', 'rella_html5_stylesheet', 10, 2 );
}
function rella_html5_stylesheet( $html, $handle ) {

	$html = str_replace(" type='text/css'", '', $html );
	$html = str_replace(" type='text/javascript'", '', $html );
    return str_replace( " id='$handle-css' ", '', $html );
}

/**
 * [rella_wpcf7_submit_button description]
 * @method rella_wpcf7_submit_button
 * @return [type]                    [description]
 */
add_action( 'wpcf7_init', 'rella_wpcf7_submit_button', 25 );
function rella_wpcf7_submit_button() {
	if( function_exists( 'wpcf7_remove_form_tag' ) ) {
		wpcf7_remove_form_tag('submit');
		wpcf7_add_form_tag( 'submit', 'rella_wpcf7_submit_shortcode_handler' );
	}
}

function rella_wpcf7_submit_shortcode_handler( $tag ) {

	$tag = new WPCF7_FormTag( $tag );

	$class = wpcf7_form_controls_class( $tag->type );

	$atts = array();

	$atts['class'] = $tag->get_class_option( $class );
	$atts['id'] = $tag->get_id_option();
	$atts['tabindex'] = $tag->get_option( 'tabindex', 'int', true );

	$value = isset( $tag->values[0] ) ? $tag->values[0] : '';

	if ( empty( $value ) )
		$value = esc_html__( 'Send', 'boo' );

	$atts['type'] = 'submit';
	//$atts['value'] = $value;

	$atts = wpcf7_format_atts( $atts );

	$html = sprintf( '<button %1$s>%2$s</button>', $atts, $value );

	return $html;
}

/**
 * [rella_nav_menu_args description]
 * @method rella_nav_menu_args
 * @param  [type]              $args [description]
 * @return [type]                    [description]
 */
add_filter( 'wp_nav_menu_args', 'rella_nav_menu_args' );
function rella_nav_menu_args( $args ) {

	$menu = rella_helper()->get_option( 'header-primary-menu' );
	if( current_theme_supports( 'theme-demo' ) && !empty( $_GET['mid'] ) ) {
		$menu = $_GET['mid'];
	}

	if( empty( $menu ) ) {
		return $args;
	}

	$args['menu'] = $menu;

	return $args;
}

/**
 * [rella_page_ajaxify description]
 * @method rella_page_ajaxify
 * @param  [type]             $template [description]
 * @return [type]                       [description]
 */
add_action( 'template_include', 'rella_page_ajaxify', 1 );
function rella_page_ajaxify( $template ) {

	if( isset( $_GET['ajaxify'] ) && $_GET['ajaxify'] ) {
		
		if( ! is_archive() ) {
			$located = locate_template( 'ajaxify.php' );
		}

		if( '' != $located ) {
			return $located;
		}
	}

	return $template;
}

/**
 * [rella_maintenance_mode description]
 * @method rella_maintenance_mode
 * @param  [type]             $template [description]
 * @return [type]                       [description]
 */
add_action( 'template_include', 'rella_maintenance_mode', 1 );
function rella_maintenance_mode( $template ) {

	if ( ! class_exists( 'ReduxFramework' ) ) {
		return $template;
	}

	$enable = rella_helper()->get_option( 'page-maintenance-enable', 'raw', '', 'options' );
	$enable = isset( $_GET['emm'] ) ? 'on' : $enable;

	if ( is_user_logged_in() || 'off' === $enable ) {
		return $template;
	}

	$maintenance_mode = true;

	//show maintenance mode only to specific time
	if ( 'on' === rella_helper()->get_option( 'page-maintenance-mode-till', 'raw', '', 'options' ) ) {

		$date    = rella_helper()->get_option( 'page-maintenance-mode-till-date', 'raw', '', 'options' );
		$hour    = rella_helper()->get_option( 'page-maintenance-mode-till-hour', 'raw', '', 'options' );
		$minutes = rella_helper()->get_option( 'page-maintenance-mode-till-minutes', 'raw', '', 'options' );

		if ( !empty( $date ) && !empty( $hour ) && !empty( $minutes ) ) {
			$till_time = DateTime::createFromFormat('m/d/Y H:i', $date.' '.$hour.':'.$minutes);
			//don't show maintenance mode if time is in the past
			if ( current_time( 'timestamp' ) > $till_time->getTimestamp() ) {
				$maintenance_mode = false;
			}
		}
	}

	if( !$maintenance_mode ) {
		return $template;
	}

	$new_template = locate_template( array( 'tmpl-maintenance-mode.php' ) );
	if ( '' != $new_template ) {
		return $new_template;
	}

	return $template;
}

/**
 * [rella_tag_cloud_widget description]
 * @method rella_tag_cloud_widget
 * @param  [array] $args [description]
 * @return [array] [description]
 */
add_filter( 'widget_tag_cloud_args', 'rella_tag_cloud_widget' );
function rella_tag_cloud_widget( $args ) {

    $args['largest'] = 13; //largest tag
    $args['smallest'] = 13; //smallest tag
    $args['unit'] = 'px';  //tag font unit

    return $args;
}

add_filter( 'avatar_defaults', 'rella_gravatar' );

function rella_gravatar ( $avatar_defaults ) {

	$rella_avatar = get_template_directory_uri() . '/assets/img/rella-avatar.jpg';
	$avatar_defaults[$rella_avatar] = "Rella Gravatar";

	return $avatar_defaults;
}

/**
 * [rella_audio_shortcode_class description]
 * @method rella_audio_shortcode_class
 * @param  [type] $class [description]
 * @return [type] $class [description]
 */
add_filter( 'wp_audio_shortcode_class', 'rella_audio_shortcode_class', 1, 1 );
function rella_audio_shortcode_class( $class ) {

	$class = '';

	return $class;
}


/**
 * [rella_video_shortcode_class description]
 * @method rella_video_shortcode_class
 * @param  [type] $class [description]
 * @return [type] $class [description]
 */
add_filter( 'wp_video_shortcode_class', 'rella_video_shortcode_class', 1, 1 );
function rella_video_shortcode_class( $class ) {

	$class = '';

	return $class;
}

/**
 * [rella_add_image_placeholders description]
 * @method rella_add_image_placeholders
 * @param  [type]                       $content [description]
 */

add_action( 'init', 'rella_enable_lazy_load' );
function rella_enable_lazy_load() {

	if( rella_helper()->get_option( 'enable-lazy-load' ) && !is_admin() ) {
		add_filter( 'wp_get_attachment_image_attributes', 'rella_filter_gallery_img_atts', 10, 2 );
	}

}

/**
 * [rella_filter_gallery_img_atts description]
 * @method rella_process_image_placeholders
 * @param  [type]             $atts [description]
 * @param  [type]             $attachment [description]
 * @return [type]            [description]
 */
function rella_filter_gallery_img_atts( $atts, $attachment ) {

		$img_data = $atts['src'];

		@list( $width ) = getimagesize( $atts['src'] );

		//Check the size of the image
		if( isset( $width ) && $width < '230' ) {
			return $atts;
		}

		$atts['srcset']= '';
		$atts['src'] = rella_get_the_small_image( $img_data );
		$atts['class'] .= ' progressive__img progressive--not-loaded';
		$atts['data-progressive'] = $img_data;

    return $atts;
}

/**
* [rella_get_vertical_navigation description]
* @method rella_get_vertical_navigation
* @return [type]                [description]
*/
function rella_get_vertical_navigation( $header_id ) {

	if( $header_id ) {

		$header = get_post( $header_id );
		$content = $header->post_content;
		if ( rella_helper()->str_contains( 'vertical_nav', $content ) ) {
			return true;
		}
	}

	return false;
}

/**
 * Allows for excerpt generation outside the loop.
 *
 * @param string $text  The text to be trimmed
 * @return string       The trimmed text
 */
function rella_trim_excerpt( $text = '' ) {
    $text = strip_shortcodes( $text );
    $text = apply_filters( 'the_content', $text );
    $text = str_replace(']]>', ']]&gt;', $text );
    $excerpt_length = apply_filters( 'excerpt_length', 55 );
    $excerpt_more = apply_filters( 'excerpt_more', ' ' . '[...]' );
    return wp_trim_words( $text, $excerpt_length, $excerpt_more );
}
add_filter( 'wp_trim_excerpt', 'rella_trim_excerpt' );

$woo_product_style = rella_helper()->get_theme_option( 'woo_single_style' );
if( 'alt' === $woo_product_style ) {
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 25 );	
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 55 );
}

$sorterby_enable = rella_helper()->get_theme_option( 'wc-archive-sorter-enable' );
if( 'off' === $sorterby_enable ) {
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
}

function rella_return_true() {
	return true;
}
function rella_return_false() {
	return false;
}