<?php

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if( class_exists( 'ReduxFramework' ) ) {
	
	class Rella_Custom_Fonts {
		
		/**
		 * [$params description]
		 * @var array
		 */
		private $rella_custom_fonts = null;
		
		
		/**
		 * [$params description]
		 * @var array
		 */
		private $rella_custom_fonts_woff2 = null;
		
		/**
		 * [$params description]
		 * @var array
		 */
		private $rella_custom_fonts_woff = null;
		
		/**
		 * [$params description]
		 * @var array
		 */
		private $rella_custom_fonts_ttf = null;
		
		/**
		 * [$params description]
		 * @var array
		 */
		private $rella_custom_fonts_svg = null;
		

		/**
		 * [__construct description]
		 * @method __construct
		 */
		function __construct() {
			
			add_action( 'init', array( $this, 'get_custom_fonts' ) );
			//add_action( 'init', array( $this, 'add_font_face_css' ) );
			add_filter( 'redux/prefix_opt_name/field/typography/custom_fonts', array( $this, 'add_custom_fonts_to_redux') );
			add_filter( 'rella_dynamic_css', array( $this, 'add_font_face_css') );

		}		
		
		/**
		 * add_typekit_fonts_to_redux
		 * @return  [arr] fonts array
		 */
		function add_custom_fonts_to_redux( $fonts = array() ) {
			
			$get_fonts = $this->get_custom_fonts_array();
			
			if( empty( $get_fonts ) ) {
				return $fonts;
			}
			
			if( isset( $fonts['Typekit Fonts'] ) ) {
				$all_fonts = array_merge( $fonts['Typekit Fonts'], $get_fonts );
			} 
			elseif( isset( $fonts['Custom Fonts'] ) ) {
				$all_fonts = array_merge( $fonts['Custom Fonts'], $get_fonts );				
			}
			else {
				$all_fonts = $get_fonts;	
			}
			
			$fonts_label = esc_html__( 'Custom Fonts', 'boo' );
			$fonts       = array( $fonts_label => $all_fonts );
			
			return $fonts;

		}

		function get_custom_fonts_array() {
			
			if ( empty( $this->rella_custom_fonts ) ) {
				return;
			}
			
			$ret = array();
			$fontsData = $this->rella_custom_fonts;
			
			foreach($fontsData as $cfont ) {
				if( isset( $cfont ) && ! empty( $cfont ) ) {
					$slug = $cfont;
					$name = $cfont;
					$ret[$slug] = $name;
				}
			}

			return $ret;
			
		}
		
		function add_font_face_css( $css ) {
			
			$font_face = '';
			
			$get_fonts = array();
			
			$get_fonts = $this->rella_custom_fonts;
			$woff2_arr = $this->rella_custom_fonts_woff2;
			$woff_arr  = $this->rella_custom_fonts_woff;
			$ttf_arr   = $this->rella_custom_fonts_ttf;
			$svg_arr   = $this->rella_custom_fonts_svg;
			
			if( is_array( $get_fonts ) ) {
				$get_fonts = array_filter( $get_fonts );	
			}

			if( empty( $get_fonts ) ) {
				return $css;
			}
				
			foreach( $get_fonts as $key => $font_name ) {
				
				$urls = array();
				if( isset( $woff2_arr[ $key ] ) && ! empty( $woff2_arr[ $key ] ) ) {
					$urls[] = 'url(' . esc_url( $woff2_arr[ $key ] ) . ')';
				}
				if( isset( $woff_arr[ $key ] ) &&  ! empty( $woff_arr[ $key ] ) ) {
					$urls[] = 'url(' . esc_url( $woff_arr[ $key ] ) . ')';	
				}
				if( isset( $ttf_arr[ $key ] ) && ! empty( $ttf_arr[ $key ] ) ) {
					$urls[] = 'url(' . esc_url( $ttf_arr[ $key ] ) . ')';
				}
				if( isset( $svg_arr[ $key ] ) && ! empty( $svg_arr[ $key ] ) ) {
					$urls[] = 'url(' . esc_url( $svg_arr[ $key ] ) . ')';
				}
				
				$font_face .= '@font-face {' . "\n";
				$font_face .= 'font-family:"' . esc_attr( $font_name ) . '";' . "\n";
				$font_face .= 'src:';
				$font_face .= implode( ', ', $urls ) . ';';
				$font_face .= '}' . "\n";
			}
				

			return $font_face . $css;

		}
		
		/**
		 * get_custom_fonts_array
		 * 
		 * @return [arr] fonts array
		 */
		function get_custom_fonts() {
		
			global $rella_options;
			
			$this->rella_custom_fonts = ! empty( $rella_options['custom_font_title'] ) ? $rella_options['custom_font_title'] : null;
			$this->rella_custom_fonts_woff2 = ! empty( $rella_options['custom_font_woff2'] ) ? $rella_options['custom_font_woff2'] : null;
			$this->rella_custom_fonts_woff = ! empty( $rella_options['custom_font_woff'] ) ? $rella_options['custom_font_woff'] : null;
			$this->rella_custom_fonts_ttf = ! empty( $rella_options['custom_font_ttf'] ) ? $rella_options['custom_font_ttf'] : null;
			$this->rella_custom_fonts_svg = ! empty( $rella_options['custom_font_svg'] ) ? $rella_options['custom_font_svg'] : null;			
		
		}

	}
	
	new Rella_Custom_Fonts;
	
}