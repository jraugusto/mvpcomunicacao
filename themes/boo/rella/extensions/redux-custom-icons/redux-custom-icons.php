<?php

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if ( class_exists( 'ReduxFramework' ) ) {

	class Rella_Custom_Icons {
		
		/**
		 * [$params description]
		 * @var array
		 */
		private $rella_custom_icons_fonts = null;	

		/**
		 * [$params description]
		 * @var array
		 */
		private $rella_custom_icons_path = null;	

		/**
		 * [$params description]
		 * @var array
		 */
		private $rella_custom_icons = null;

		/**
		 * [__construct description]
		 * @method __construct
		 */
		function __construct() {

			add_action( 'init', array( $this, 'get_font_options' ) );

			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_css_styles' ), 99 );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_css_styles' ), 99 );

			add_filter( 'rella_custom_icons_font', array( $this, 'add_custom_fonts_icons_to_icon_param' ) );

			//Add Custom Icons
			add_filter( 'rella_menu_iconpicker_icons', array( $this, 'add_rella_custom_icons' ) );
			add_filter( 'vc_iconpicker-type-rella_custom_icons', array( $this, 'add_rella_custom_icons' ) );
			

		}

		/**
		 * [get_font_options description]
		 * @method get_font_options
		 */
		function get_font_options() {
			
			global $rella_options;
			
			$this->rella_custom_icons_fonts = ! empty( $rella_options['custom_icon_font_title'] ) ? $rella_options['custom_icon_font_title'] : '';
			$this->rella_custom_icons_path  = ! empty( $rella_options['custom_icon_font_css'] ) ? $rella_options['custom_icon_font_css'] : '';
			$this->rella_custom_icons  = ! empty( $rella_options['custom_icons_classnames'] ) ? $rella_options['custom_icons_classnames'] : '';

		}

		/**
		 * [add_custom_icons_to_menu_items description]
		 * @method add_custom_icons_to_menu_items
		 */
		function add_rella_custom_icons( $icons ) {
			
			if( empty( $this->rella_custom_icons_fonts ) ) {
				return $icons;
			}
			
			$custom_icons = array();
			
			$icons_fonts = $this->rella_custom_icons_fonts;
			$icons_arr   = $this->rella_custom_icons;
			
			foreach( $icons_fonts as $key => $icon_font ) {
				if( isset( $icon_font ) && ! empty( $icon_font ) ) {
					$icons_ready = array();
					$icons_data = explode( ',', $icons_arr[ $key ] );
					foreach( $icons_data as $font ) {
						$icons_ready[] = array( $font => ucfirst( $font ) ) ;	
					};
					$custom_icons[$icon_font] = $icons_ready;
				}
			}
			
			return array_merge( $icons, $custom_icons );
			
		}
		
		/**
		 * [add_custom_fonts_icons_to_icon_param description]
		 * @method add_custom_fonts_icons_to_icon_param
		 */
		function add_custom_fonts_icons_to_icon_param( $fonts ) {
			
			$fonts_array = $this->rella_custom_icons_fonts;
			
			if( ! isset( $fonts_array[0] ) || empty( $fonts_array[0] ) ) {
				return $fonts;
			}

			$custom_icons_fonts = array(
				'rella_custom_icons' => esc_html__( 'Rella Custom Icons', 'boo' ),
			);

			return array_merge( $fonts, $custom_icons_fonts );
			
		}
		
		
		/**
		 * [enqueue_css_styles description]
		 * @method enqueue_css_styles
		 */
		function enqueue_css_styles() {
			
			$icons_fonts = $this->rella_custom_icons_fonts;
			$css_paths_arr = $this->rella_custom_icons_path;
			
			if( empty( $icons_fonts ) || empty( $css_paths_arr ) ) {
				return;
			}
			
			foreach( $icons_fonts as $key => $icon_font ) {
				$css_id = 'rella-custom-font-icons-' . $key . '-' . sanitize_title( $icon_font );
				$css_path = trim( $css_paths_arr[$key] );
				wp_enqueue_style( $css_id, $css_path );
			}

		}


	}
	
	new Rella_Custom_Icons;

}