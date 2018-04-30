<?php

/**
 * Format of the $css array:
 * $css['media-query']['element']['property'] = value
 *
 * If no media query is required then set it to 'global'
 *
 * If we want to add multiple values for the same property then we have to make it an array like this:
 * $css[media-query][element]['property'][] = value1
 * $css[media-query][element]['property'][] = value2
 *
 * Multiple values defined as an array above will be parsed separately.
 */
function rella_dynamic_css_array() {

	$css = array();

	$primary_color_elements	  = rella_get_primary_color_elements();
	$secondary_color_elements = rella_get_secondary_color_elements();
	$tertiary_color_elements  = rella_get_tertiary_color_elements();

	$primary_gradient_elements   = rella_get_primary_gradient_color_elements();
	$secondary_gradient_elements = rella_get_secondary_gradient_color_elements();
	$tertiary_gradient_elements  = rella_get_tertiary_gradient_color_elements();

	$body_typography_elements = rella_get_body_typography_elements();
	$extra_body_typography_elements = rella_get_extra_typography_elements();

	$h1_typography_elements = rella_get_h1_typography_elements();
	$h2_typography_elements = rella_get_h2_typography_elements();
	$h3_typography_elements = rella_get_h3_typography_elements();
	$h4_typography_elements = rella_get_h4_typography_elements();
	$h5_typography_elements = rella_get_h5_typography_elements();
	$h6_typography_elements = rella_get_h6_typography_elements();

	$enable_default_typo = rella_helper()->get_option( 'typo-default-enable' );
	$shortcode_typography = rella_get_shortcodes_typography_elements();

	$body_typography = rella_helper()->get_option( 'body_typography' );
	$body_extra_typography = rella_helper()->get_option( 'body_extra_typography' );
	$body_sec_extra_typography = rella_helper()->get_option( 'body_sec_extra_typography' );

	if ( isset ( $body_typography_elements['family'] ) ) {
		$css['global'][ rella_implode( $body_typography_elements['family'] ) ] = array(
			'font-family'    => isset( $body_typography['font-family'] ) ? wp_strip_all_tags( $body_typography['font-family'] ) : '',
			'font-weight'    => isset( $body_typography['font-weight'] ) ? intval( $body_typography['font-weight'] ) : '',
			'letter-spacing' => isset( $body_typography['letter-spacing'] ) ? round( $body_typography['letter-spacing'] ) . 'px' : '',
			'font-style'     => ! empty( $body_typography['font-style'] ) ? esc_attr( $body_typography['font-style'] ) : ''
		);
	}
	if ( isset ( $body_typography_elements['line-height'] ) ) {
		$css['global'][ rella_implode( $body_typography_elements['line-height'] ) ]['line-height'] = isset( $body_typography['line-height'] ) ?  $body_typography['line-height'] : '';
	}
	if ( isset ( $body_typography_elements['size'] ) ) {
		$css['global'][ rella_implode( $body_typography_elements['size'] ) ]['font-size'] = isset( $body_typography['font-size'] ) ? $body_typography['font-size'] : '';
	}
	if ( isset ( $body_typography_elements['color'] ) ) {
		$css['global'][ rella_implode( $body_typography_elements['color'] ) ]['color'] = ! empty( $body_typography['color'] ) ? $body_typography['color'] : '';
	}

	if ( isset ( $body_typography_elements['additional'] ) ) {
		$css['global'][ rella_implode( $body_typography_elements['additional'] ) ]['font-family'] = isset( $body_typography['font-family'] ) ? wp_strip_all_tags( $body_typography['font-family'] ) : '';
	}

	if ( isset ( $extra_body_typography_elements['family'] ) ) {
		$css['global'][ rella_implode( $extra_body_typography_elements['family'] ) ]['font-family'] = isset( $body_sec_extra_typography['font-family'] ) ? wp_strip_all_tags( $body_sec_extra_typography['font-family'] ) : '';
	}

	if ( isset ( $h3_typography_elements['additional'] ) ) {
		$css['global'][ rella_implode( $h3_typography_elements['additional'] ) ]['font-family'] = isset( $body_extra_typography['font-family'] ) ? wp_strip_all_tags( $body_extra_typography['font-family'] ) : '';
	}

	/**
	 * Headings
	 */

	// H1
	$h1_typography = rella_helper()->get_option( 'h1_typography' );
	if ( isset ( $h1_typography_elements['family'] ) ) {
		$css['global'][ rella_implode( $h1_typography_elements['family'] ) ] = array(
			'font-family'    => isset( $h1_typography['font-family'] ) ? wp_strip_all_tags( $h1_typography['font-family'] ) : '',
			'font-weight'    => isset( $h1_typography['font-weight'] ) ? intval( $h1_typography['font-weight'] ) : '',
			'line-height'    => isset( $h1_typography['line-height'] ) ? $h1_typography['line-height'] : '',
			'letter-spacing' => isset( $h1_typography['letter-spacing'] ) ? round( $h1_typography['letter-spacing'] ) . 'px' : '',
			'font-style'     => ! empty( $h1_typography['font-style'] ) ? esc_attr( $h1_typography['font-style'] ) : ''
		);
	}

	if ( isset ( $h1_typography_elements['size'] ) ) {
		$css['global'][ rella_implode( $h1_typography_elements['size'] ) ]['font-size'] = isset( $h1_typography['font-size'] ) ? $h1_typography['font-size'] : '';
	}
	if ( isset ( $h1_typography_elements['color'] ) ) {
		$css['global'][ rella_implode( $h1_typography_elements['color'] ) ]['color'] = isset( $h1_typography['color'] ) ? $h1_typography['color'] : '';
	}

	// H2
	$h2_typography = rella_helper()->get_option( 'h2_typography' );

		if( 'on' === $enable_default_typo ) {
			$css['global'][ rella_implode( $h2_typography_elements['family'] ) ] = array(
				'font-family'    => isset( $h1_typography['font-family'] ) ? wp_strip_all_tags( $h1_typography['font-family'] ) : '',
				'font-weight'    => isset( $h1_typography['font-weight'] ) ? intval( $h1_typography['font-weight'] ) : '',
				'line-height'    => isset( $h2_typography['line-height'] ) ? $h2_typography['line-height'] : '',
				'letter-spacing' => isset( $h2_typography['letter-spacing'] ) ? round( $h2_typography['letter-spacing'] ) . 'px' : '',
				'font-style'     => ! empty( $h1_typography['font-style'] ) ? esc_attr( $h1_typography['font-style'] ) : ''
			);
		} else {
			$css['global'][ rella_implode( $h2_typography_elements['family'] ) ] = array(
				'font-family'    => isset( $h2_typography['font-family'] ) ? wp_strip_all_tags( $h2_typography['font-family'] ) : '',
				'font-weight'    => isset( $h2_typography['font-weight'] ) ? intval( $h2_typography['font-weight'] ) : '',
				'line-height'    => isset( $h2_typography['line-height'] ) ? $h2_typography['line-height'] : '',
				'letter-spacing' => isset( $h2_typography['letter-spacing'] ) ? round( $h2_typography['letter-spacing'] ) . 'px' : '',
				'font-style'     => ! empty( $h2_typography['font-style'] ) ? esc_attr( $h2_typography['font-style'] ) : ''
			);
		}

	if ( isset ( $h2_typography_elements['additional'] ) ) {

		if( 'on' === $enable_default_typo ) {
			$css['global'][ rella_implode( $h2_typography_elements['additional'] ) ] = array(
				'font-family' => isset( $h1_typography['font-family'] ) ? wp_strip_all_tags( $h1_typography['font-family'] ) : '',
			);
		} else {
			$css['global'][ rella_implode( $h2_typography_elements['additional'] ) ] = array(
				'font-family' => isset( $h2_typography['font-family'] ) ? wp_strip_all_tags( $h2_typography['font-family'] ) : '',
			);
		}
	}

	if ( isset ( $h2_typography_elements['size'] ) ) {
		$css['global'][ rella_implode( $h2_typography_elements['size'] ) ]['font-size'] = isset( $h2_typography['font-size'] ) ? $h2_typography['font-size'] : '';
	}
	if ( isset ( $h2_typography_elements['color'] ) ) {
		if( 'on' === $enable_default_typo ) {
			$css['global'][ rella_implode( $h2_typography_elements['color'] ) ]['color'] = isset( $h1_typography['color'] ) ? $h1_typography['color'] : '';
		} else {
			$css['global'][ rella_implode( $h2_typography_elements['color'] ) ]['color'] = isset( $h2_typography['color'] ) ? $h2_typography['color'] : '';
		}
	}

	// H3
	$h3_typography = rella_helper()->get_option( 'h3_typography' );

	if ( isset ( $h3_typography_elements['family'] ) ) {

		if( 'on' === $enable_default_typo ) {
			$css['global'][ rella_implode( $h3_typography_elements['family'] ) ] = array(
				'font-family'    => isset( $h1_typography['font-family'] ) ? wp_strip_all_tags( $h1_typography['font-family'] ) : '',
				'font-weight'    => isset( $h1_typography['font-weight'] ) ? intval( $h1_typography['font-weight'] ) : '',
				'line-height'    => isset( $h3_typography['line-height'] ) ? $h3_typography['line-height'] : '',
				'letter-spacing' => isset( $h3_typography['letter-spacing'] ) ? round( $h3_typography['letter-spacing'] ) . 'px' : '',
				'font-style'     => ! empty( $h1_typography['font-style'] ) ? esc_attr( $h1_typography['font-style'] ) : ''
			);
		} else {
			$css['global'][ rella_implode( $h3_typography_elements['family'] ) ] = array(
				'font-family'    => isset( $h3_typography['font-family'] ) ? wp_strip_all_tags( $h3_typography['font-family'] ) : '',
				'font-weight'    => isset( $h3_typography['font-weight'] ) ? intval( $h3_typography['font-weight'] ) : '',
				'line-height'    => isset( $h3_typography['line-height'] ) ? $h3_typography['line-height'] : '',
				'letter-spacing' => isset( $h3_typography['letter-spacing'] ) ? round( $h3_typography['letter-spacing'] ) . 'px' : '',
				'font-style'     => ! empty( $h3_typography['font-style'] ) ? esc_attr( $h3_typography['font-style'] ) : ''
			);
		}

	}

	if ( isset ( $h3_typography_elements['size'] ) ) {
		$css['global'][ rella_implode( $h3_typography_elements['size'] ) ]['font-size'] = isset( $h3_typography['font-size'] ) ? $h3_typography['font-size'] : '';
	}
	if ( isset ( $h3_typography_elements['color'] ) ) {
		if( 'on' === $enable_default_typo ) {
			$css['global'][ rella_implode( $h3_typography_elements['color'] ) ]['color'] = isset( $h1_typography['color'] ) ? $h1_typography['color'] : '';
		} else {
			$css['global'][ rella_implode( $h3_typography_elements['color'] ) ]['color'] = isset( $h3_typography['color'] ) ? $h3_typography['color'] : '';
		}

	}

	// H4
	$h4_typography = rella_helper()->get_option( 'h4_typography' );
	if ( isset ( $h4_typography_elements['family'] ) ) {
		if( 'on' === $enable_default_typo ) {
			$css['global'][ rella_implode( $h4_typography_elements['family'] ) ] = array(
				'font-family'    => isset( $h1_typography['font-family'] ) ? wp_strip_all_tags( $h1_typography['font-family'] ) : '',
				'font-weight'    => isset( $h1_typography['font-weight'] ) ? intval( $h1_typography['font-weight'] ) : '',
				'line-height'    => isset( $h4_typography['line-height'] ) ? $h4_typography['line-height'] : '',
				'letter-spacing' => isset( $h4_typography['letter-spacing'] ) ? round( $h4_typography['letter-spacing'] ) . 'px' : '',
				'font-style'     => ! empty( $h1_typography['font-style'] ) ? esc_attr( $h1_typography['font-style'] ) : ''
			);
		} else {
			$css['global'][ rella_implode( $h4_typography_elements['family'] ) ] = array(
				'font-family'    => isset( $h4_typography['font-family'] ) ? wp_strip_all_tags( $h4_typography['font-family'] ) : '',
				'font-weight'    => isset( $h4_typography['font-weight'] ) ? intval( $h4_typography['font-weight'] ) : '',
				'line-height'    => isset( $h4_typography['line-height'] ) ? $h4_typography['line-height'] : '',
				'letter-spacing' => isset( $h4_typography['letter-spacing'] ) ? round( $h4_typography['letter-spacing'] ) . 'px' : '',
				'font-style'     => ! empty( $h4_typography['font-style'] ) ? esc_attr( $h4_typography['font-style'] ) : ''
			);
		}
	}

	if ( isset ( $h4_typography_elements['size'] ) ) {
		$css['global'][ rella_implode( $h4_typography_elements['size'] ) ]['font-size'] = isset( $h4_typography['font-size'] ) ? $h4_typography['font-size'] : '';
	}
	if ( isset ( $h4_typography_elements['color'] ) ) {
		if( 'on' === $enable_default_typo ) {
			$css['global'][ rella_implode( $h4_typography_elements['color'] ) ]['color'] = isset( $h1_typography['color'] ) ? $h4_typography['color'] : '';
		} else {
			$css['global'][ rella_implode( $h4_typography_elements['color'] ) ]['color'] = isset( $h4_typography['color'] ) ? $h4_typography['color'] : '';
		}
	}

	// H5
	$h5_typography = rella_helper()->get_option( 'h5_typography' );
	if ( isset ( $h5_typography_elements['family'] ) ) {
		if( 'on' === $enable_default_typo ) {
			$css['global'][ rella_implode( $h5_typography_elements['family'] ) ] = array(
				'font-family'    => isset( $h1_typography['font-family'] ) ? wp_strip_all_tags( $h1_typography['font-family'] ) : '',
				'font-weight'    => isset( $h1_typography['font-weight'] ) ? intval( $h1_typography['font-weight'] ) : '',
				'line-height'    => isset( $h5_typography['line-height'] ) ? $h5_typography['line-height'] : '',
				'letter-spacing' => isset( $h5_typography['letter-spacing'] ) ? round( $h5_typography['letter-spacing'] ) . 'px' : '',
				'font-style'     => ! empty( $h1_typography['font-style'] ) ? esc_attr( $h1_typography['font-style'] ) : ''
			);
		} else {
			$css['global'][ rella_implode( $h5_typography_elements['family'] ) ] = array(
				'font-family'    => isset( $h5_typography['font-family'] ) ? wp_strip_all_tags( $h5_typography['font-family'] ) : '',
				'font-weight'    => isset( $h5_typography['font-weight'] ) ? intval( $h5_typography['font-weight'] ) : '',
				'line-height'    => isset( $h5_typography['line-height'] ) ? $h5_typography['line-height'] : '',
				'letter-spacing' => isset( $h5_typography['letter-spacing'] ) ? round( $h5_typography['letter-spacing'] ) . 'px' : '',
				'font-style'     => ! empty( $h5_typography['font-style'] ) ? esc_attr( $h5_typography['font-style'] ) : ''
			);
		}
	}

	if ( isset ( $h5_typography_elements['size'] ) ) {
		$css['global'][ rella_implode( $h5_typography_elements['size'] ) ]['font-size'] = isset( $h5_typography['font-size'] ) ? $h5_typography['font-size'] : '';
	}
	if ( isset ( $h5_typography_elements['color'] ) ) {
		if( 'on' === $enable_default_typo ) {
			$css['global'][ rella_implode( $h5_typography_elements['color'] ) ]['color'] = isset( $h1_typography['color'] ) ? $h1_typography['color'] : '';
		} else {
			$css['global'][ rella_implode( $h5_typography_elements['color'] ) ]['color'] = isset( $h5_typography['color'] ) ? $h5_typography['color'] : '';
		}
	}

	// H6
	$h6_typography = rella_helper()->get_option( 'h6_typography' );
	if ( isset ( $h6_typography_elements['family'] ) ) {
		if( 'on' === $enable_default_typo ) {
			$css['global'][ rella_implode( $h6_typography_elements['family'] ) ] = array(
				'font-family'    => isset( $h1_typography['font-family'] ) ? wp_strip_all_tags( $h1_typography['font-family'] ) : '',
				'font-weight'    => isset( $h1_typography['font-weight'] ) ? intval( $h1_typography['font-weight'] ) : '',
				'line-height'    => isset( $h6_typography['line-height'] ) ? $h6_typography['line-height'] : '',
				'letter-spacing' => isset( $h6_typography['letter-spacing'] ) ? round( $h6_typography['letter-spacing'] ) . 'px' : '',
				'font-style'     => ! empty( $h1_typography['font-style'] ) ? esc_attr( $h1_typography['font-style'] ) : ''
			);
		} else {
			$css['global'][ rella_implode( $h6_typography_elements['family'] ) ] = array(
				'font-family'    => isset( $h6_typography['font-family'] ) ? wp_strip_all_tags( $h6_typography['font-family'] ) : '',
				'font-weight'    => isset( $h6_typography['font-weight'] ) ? intval( $h6_typography['font-weight'] ) : '',
				'line-height'    => isset( $h6_typography['line-height'] ) ? $h6_typography['line-height'] : '',
				'letter-spacing' => isset( $h6_typography['letter-spacing'] ) ? round( $h6_typography['letter-spacing'] ) . 'px' : '',
				'font-style'     => ! empty( $h6_typography['font-style'] ) ? esc_attr( $h6_typography['font-style'] ) : ''
			);
		}
	}

	if ( isset ( $h6_typography_elements['size'] ) ) {
		$css['global'][ rella_implode( $h6_typography_elements['size'] ) ]['font-size'] = isset( $h6_typography['font-size'] ) ? $h6_typography['font-size'] : '';
	}
	if ( isset ( $h6_typography_elements['color'] ) ) {
		if( 'on' === $enable_default_typo ) {
			$css['global'][ rella_implode( $h6_typography_elements['color'] ) ]['color'] = isset( $h1_typography['color'] ) ? $h1_typography['color'] : '';
		} else {
			$css['global'][ rella_implode( $h6_typography_elements['color'] ) ]['color'] = isset( $h6_typography['color'] ) ? $h6_typography['color'] : '';
		}
	}

	//Single Post Heading Typography
	$single_post_typography = rella_helper()->get_option( 'single_typography' );
	$css['global'][ rella_implode( '.single .blog-single h1.entry-title, .single .blog-single h2.entry-title' ) ] = array(
		'font-family'    => isset( $single_post_typography['font-family'] ) ? wp_strip_all_tags( $single_post_typography['font-family'] ) : '',
		'font-size'      => isset( $single_post_typography['font-size'] ) ? $single_post_typography['font-size'] : '',
		'font-weight'    => isset( $single_post_typography['font-weight'] ) ? intval( $single_post_typography['font-weight'] ) : '',
		'line-height'    => ! empty( $single_post_typography['line-height'] ) ? round( $single_post_typography['line-height'] ) . 'px' : '',
		'color'          => isset( $single_post_typography['color'] ) ? $single_post_typography['color'] : '',
		'letter-spacing' => ! empty( $single_post_typography['letter-spacing'] ) ? round( $single_post_typography['letter-spacing'] ) . 'px' : '',
		'font-style'     => ! empty( $single_post_typography['font-style'] ) ? esc_attr( $single_post_typography['font-style'] ) : ''
	);

	//Shortcode Typography
	$btn_sc_typography = rella_helper()->get_option( 'btn_sc_fonts' );
	if( isset( $shortcode_typography['button'] ) ) {
		$css['global'][ rella_implode( $shortcode_typography['button'] ) ] = array(
			'font-family'    => isset( $btn_sc_typography['font-family'] ) ? wp_strip_all_tags( $btn_sc_typography['font-family'] ) : '',
			'font-size'      => isset( $btn_sc_typography['font-size'] ) ? $btn_sc_typography['font-size'] : '',
			'font-weight'    => isset( $btn_sc_typography['font-weight'] ) ? intval( $btn_sc_typography['font-weight'] ) : '',
			'line-height'    => ! empty( $btn_sc_typography['line-height'] ) ? round( $btn_sc_typography['line-height'] ) . 'px' : '',
			'text-transform' => isset( $btn_sc_typography['text-transform'] ) ? $btn_sc_typography['text-transform'] : '',
			'letter-spacing' => ! empty( $btn_sc_typography['letter-spacing'] ) ? round( $btn_sc_typography['letter-spacing'] ) . 'px' : '',
			'font-style'     => ! empty( $btn_sc_typography['font-style'] ) ? esc_attr( $btn_sc_typography['font-style'] ) : ''
		);
	}

	// Primary Color
	$primary_color = rella_helper()->get_option( 'primary_ac_color' );
	if ( isset( $primary_color_elements['color'] ) ) {
		$css['global'][ rella_implode( $primary_color_elements['color'] ) ]['color'] = $primary_color;
	}
	if ( isset( $primary_color_elements['background'] ) ) {
		$css['global'][ rella_implode( $primary_color_elements['background'] ) ]['background-color'] = $primary_color;
	}
	if ( isset( $primary_color_elements['border'] ) ) {
		$css['global'][ rella_implode( $primary_color_elements['border'] ) ]['border-color'] = $primary_color;
	}
	if ( isset( $primary_color_elements['border-right'] ) ) {
		$css['global'][ rella_implode( $primary_color_elements['border-right'] ) ]['border-right-color'] = $primary_color;
	}
	if ( isset( $primary_color_elements['border-top'] ) ) {
		$css['global'][ rella_implode( $primary_color_elements['border-top'] ) ]['border-top-color'] = $primary_color;
	}
	if ( isset( $primary_color_elements['border-bottom'] ) ) {
		$css['global'][ rella_implode( $primary_color_elements['border-bottom'] ) ]['border-bottom-color'] = $primary_color;
	}
	if ( isset( $primary_color_elements['shadow'] ) ) {
		$css['global'][ rella_implode( $primary_color_elements['shadow'] ) ]['box-shadow'] = 'inset 0 0 0 2px ' . $primary_color;
	}
	if ( isset( $primary_color_elements['shadow-1'] ) ) {
		$css['global'][ rella_implode( $primary_color_elements['shadow-1'] ) ]['box-shadow'] = 'inset 0 0 0 1px ' . $primary_color;
	}
	if ( isset( $primary_color_elements['shadow-2'] ) ) {
		$css['global'][ rella_implode( $primary_color_elements['shadow-2'] ) ]['box-shadow'] = 'inset 0 1px 0 0 ' . $primary_color;
	}
	if ( isset( $primary_color_elements['shadow-3'] ) ) {
		$css['global'][ rella_implode( $primary_color_elements['shadow-3'] ) ]['box-shadow'] = '0 0 0 2px ' . $primary_color;
	}
	if ( isset( $primary_color_elements['shadow-4'] ) ) {
		$css['global'][ rella_implode( $primary_color_elements['shadow-4'] ) ]['box-shadow'] = 'inset 0 -3px 0 0 ' . $primary_color;
	}

	if ( isset( $primary_color_elements['other-2'] ) ) {
		$css['global'][ rella_implode( $primary_color_elements['other-2'] ) ]['fill'][] = $primary_color;
	}

	if ( isset( $primary_color_elements['other-3'] ) ) {
		$css['global'][ rella_implode( $primary_color_elements['other-3'] ) ]['stroke'][] = $primary_color;
	}

	if ( isset( $primary_color_elements['other-4'] ) ) {
		$css['global'][ rella_implode( $primary_color_elements['other-4'] ) ]['background'][] = '-moz-linear-gradient(-87deg, rgba(255,45,84,0) 0%, rgba(255,45,86,0) 0%, rgba(255,44,88,0) 34%, ' . $primary_color .' 100%)';
		$css['global'][ rella_implode( $primary_color_elements['other-4'] ) ]['background'][] = '-webkit-linear-gradient(-87deg, rgba(255,45,84,0) 0%, rgba(255,45,86,0) 0%, rgba(255,44,88,0) 34%, ' . $primary_color .' 100%)';
		$css['global'][ rella_implode( $primary_color_elements['other-4'] ) ]['background'][] = 'linear-gradient(177deg, rgba(255,45,84,0) 0%, rgba(255,45,86,0) 0%, rgba(255,44,88,0) 34%, ' . $primary_color .' 100%)';
	}

	// Secondary Color
	$secondary_color = rella_helper()->get_option( 'secondary_ac_color' );
	if ( isset( $secondary_color_elements['color'] ) ) {
		$css['global'][ rella_implode( $secondary_color_elements['color'] ) ]['color'] = $secondary_color;
	}
	if ( isset( $secondary_color_elements['background'] ) ) {
		$css['global'][ rella_implode( $secondary_color_elements['background'] ) ]['background'] = $secondary_color;
	}
	if ( isset( $secondary_color_elements['border'] ) ) {
		$css['global'][ rella_implode( $secondary_color_elements['border'] ) ]['border-color'] = $secondary_color;
	}
	if ( isset( $secondary_color_elements['border-top'] ) ) {
		$css['global'][ rella_implode( $secondary_color_elements['border-top'] ) ]['border-top-color'] = $secondary_color;
	}
	if ( isset( $secondary_color_elements['border-left'] ) ) {
		$css['global'][ rella_implode( $secondary_color_elements['border-left'] ) ]['border-left-color'] = $secondary_color;
	}
	if ( isset( $secondary_color_elements['shadow'] ) ) {
		$css['global'][ rella_implode( $secondary_color_elements['shadow'] ) ]['box-shadow'] = 'inset 0 0 0 1px' . $secondary_color;
	}

	// Tertiary Color
	$tertiary_color = rella_helper()->get_option( 'tertiary_ac_color' );
	if ( isset( $tertiary_color_elements['color'] ) ) {
		$css['global'][ rella_implode( $tertiary_color_elements['color'] ) ]['color'] = $tertiary_color;
	}
	if ( isset( $tertiary_color_elements['background'] ) ) {
		$css['global'][ rella_implode( $tertiary_color_elements['background'] ) ]['background-color'] = $tertiary_color;
	}

	// Primary Gradient Colors
	$primary_gradient_color = rella_helper()->get_option( 'primary_gradient_color' );
	$pr_gradient_color  = isset( $primary_gradient_color['from'] ) ? $primary_gradient_color['from'] : $primary_color;
	$sec_gradient_color = isset( $primary_gradient_color['to'] ) ? $primary_gradient_color['to'] : $secondary_color;

	if ( isset( $primary_gradient_elements['gradient'] ) ) {
		$css['global'][ rella_implode( $primary_gradient_elements['gradient'] ) ]['background'][] = $pr_gradient_color;
		$css['global'][ rella_implode( $primary_gradient_elements['gradient'] ) ]['background'][] = '-moz-linear-gradient(left, ' . $sec_gradient_color . ' 0%, ' . $pr_gradient_color . ' 100%)';
		$css['global'][ rella_implode( $primary_gradient_elements['gradient'] ) ]['background'][] = '-webkit-linear-gradient(left, ' . $sec_gradient_color . ' 0%, ' . $pr_gradient_color . ' 100%)';
		$css['global'][ rella_implode( $primary_gradient_elements['gradient'] ) ]['background'][] = 'linear-gradient(to right, ' . $sec_gradient_color . ' 0%,' . $pr_gradient_color . ' 100%)';
	}

	if ( isset( $primary_gradient_elements['gradient-1'] ) ) {
		$css['global'][ rella_implode( $primary_gradient_elements['gradient-1'] ) ]['background'][] = $pr_gradient_color;
		$css['global'][ rella_implode( $primary_gradient_elements['gradient-1'] ) ]['background'][] = '-moz-linear-gradient(left, ' . $pr_gradient_color . ' 0% ' . $sec_gradient_color . ' 100%);';
		$css['global'][ rella_implode( $primary_gradient_elements['gradient-1'] ) ]['background'][] = '-webkit-linear-gradient(left, ' . $pr_gradient_color . ' 0%,' . $sec_gradient_color . ' 100%)';
		$css['global'][ rella_implode( $primary_gradient_elements['gradient-1'] ) ]['background'][] = 'linear-gradient(to right, ' . $pr_gradient_color . ' 0%,' . $sec_gradient_color . ' 100%)';
	}

	if ( isset( $primary_gradient_elements['gradient-2'] ) ) {
		$css['global'][ rella_implode( $primary_gradient_elements['gradient-2'] ) ]['background'][] = $pr_gradient_color;
		$css['global'][ rella_implode( $primary_gradient_elements['gradient-2'] ) ]['background'][] = '-moz-linear-gradient(-45deg, ' . $sec_gradient_color . ' 0%, ' . $pr_gradient_color . ' 100%)';
		$css['global'][ rella_implode( $primary_gradient_elements['gradient-2'] ) ]['background'][] = '-webkit-linear-gradient(-45deg, ' . $sec_gradient_color . ' 0%,' . $pr_gradient_color . ' 100%)';
		$css['global'][ rella_implode( $primary_gradient_elements['gradient-2'] ) ]['background'][] = 'linear-gradient(135deg, ' . $sec_gradient_color . ' 0%,' . $pr_gradient_color . ' 100%)';
	}

	if ( isset( $primary_gradient_elements['gradient-2-1'] ) ) {
		$css['global'][ rella_implode( $primary_gradient_elements['gradient-2-1'] ) ]['background'][] = $pr_gradient_color;
		$css['global'][ rella_implode( $primary_gradient_elements['gradient-2-1'] ) ]['background'][] = '-moz-linear-gradient(-45deg, ' . $pr_gradient_color . ' 0%, ' . $sec_gradient_color . ' 100%)';
		$css['global'][ rella_implode( $primary_gradient_elements['gradient-2-1'] ) ]['background'][] = '-webkit-linear-gradient(-45deg, ' . $pr_gradient_color . ' 0%,' . $sec_gradient_color . ' 100%)';
		$css['global'][ rella_implode( $primary_gradient_elements['gradient-2-1'] ) ]['background'][] = 'linear-gradient(135deg, ' . $pr_gradient_color . ' 0%,' . $sec_gradient_color . ' 100%)';
	}

	if ( isset( $primary_gradient_elements['gradient-3'] ) ) {
		$css['global'][ rella_implode( $primary_gradient_elements['gradient-3'] ) ]['background'][] = $sec_gradient_color;
		$css['global'][ rella_implode( $primary_gradient_elements['gradient-3'] ) ]['background'][] = '-moz-linear-gradient(top, ' . $sec_gradient_color . ' 0%, ' . $pr_gradient_color . ' 100%)';
		$css['global'][ rella_implode( $primary_gradient_elements['gradient-3'] ) ]['background'][] = '-webkit-linear-gradient(top, ' . $sec_gradient_color . ' 0%,' . $pr_gradient_color . ' 100%)';
		$css['global'][ rella_implode( $primary_gradient_elements['gradient-3'] ) ]['background'][] = 'linear-gradient(to bottom, ' . $sec_gradient_color . ' 0%,' . $pr_gradient_color . ' 100%)';
	}

	if ( isset( $primary_gradient_elements['gradient-4'] ) ) {
		$css['global'][ rella_implode( $primary_gradient_elements['gradient-4'] ) ]['background'][] = $sec_gradient_color;
		$css['global'][ rella_implode( $primary_gradient_elements['gradient-4'] ) ]['background'][] = '-moz-linear-gradient(bottom, ' . $sec_gradient_color . ' 0%, ' . $pr_gradient_color . ' 100%)';
		$css['global'][ rella_implode( $primary_gradient_elements['gradient-4'] ) ]['background'][] = '-webkit-linear-gradient(bottom, ' . $sec_gradient_color . ' 0%,' . $pr_gradient_color . ' 100%)';
		$css['global'][ rella_implode( $primary_gradient_elements['gradient-4'] ) ]['background'][] = 'linear-gradient(to top, ' . $sec_gradient_color . ' 0%,' . $pr_gradient_color . ' 100%)';
	}

	if ( isset( $primary_gradient_elements['gradient-3-end-color'] ) ) {
		$css['global'][ rella_implode( $primary_gradient_elements['gradient-3-end-color'] ) ]['border-color'][] = $pr_gradient_color;
	}

	if ( isset( $primary_gradient_elements['other'] ) ) {
		$css['global'][ rella_implode( $primary_gradient_elements['other'] ) ]['stop-color'][] = $sec_gradient_color;
	}

	if ( isset( $primary_gradient_elements['other-1'] ) ) {
		$css['global'][ rella_implode( $primary_gradient_elements['other-1'] ) ]['stop-color'][] = $pr_gradient_color;
	}

	//Logo max-width
	$logo_max_width = rella_helper()->get_option( 'logo-max-width' );
	if( ! empty( $logo_max_width ) ) {
		$css['global'][ rella_implode( '.main-header .navbar-brand' ) ]['max-width'] = esc_attr( $logo_max_width );
	}

	//Logo width
	$logo_width = rella_helper()->get_option( 'logo-width' );
	if( ! empty( $logo_width ) ) {
		$css['global'][ rella_implode( '.main-header .navbar-brand' ) ]['width'] = esc_attr( $logo_width );
	}

	//Secondary Gradient Colors
	$secondary_gradient_color = rella_helper()->get_option( 'secondary_gradient_color' );
	$pr_sec_gradient_color  = isset( $secondary_gradient_color['from'] ) ? $secondary_gradient_color['from'] : $primary_color;
	$sec_sec_gradient_color = isset( $secondary_gradient_color['to'] ) ? $secondary_gradient_color['to'] : $secondary_color;

	if ( isset( $secondary_gradient_elements['gradient'] ) ) {
		$css['global'][ rella_implode( $secondary_gradient_elements['gradient'] ) ]['background'][] = $sec_sec_gradient_color;
		$css['global'][ rella_implode( $secondary_gradient_elements['gradient'] ) ]['background'][] = '-moz-linear-gradient(top, ' . $sec_sec_gradient_color . ' 0%, ' . $pr_sec_gradient_color . ' 100%)';
		$css['global'][ rella_implode( $secondary_gradient_elements['gradient'] ) ]['background'][] = '-webkit-linear-gradient(top, ' . $sec_sec_gradient_color . ' 0%,' . $pr_sec_gradient_color . ' 100%)';
		$css['global'][ rella_implode( $secondary_gradient_elements['gradient'] ) ]['background'][] = 'linear-gradient(to bottom, ' . $sec_sec_gradient_color . ' 0%,' . $pr_sec_gradient_color . ' 100%)';
	}

	//Titlebar Heading
	$titlebar_global_typo         = rella_helper()->get_theme_option( 'title-bar-typography' );
	$titlebar_heading_typography  = rella_helper()->get_post_meta( 'title-bar-typography' );

	$css['global'][ rella_implode( '.titlebar-inner h1, .titlebar .titlebar__masked-text h1, .titlebar .titlebar__masked-text text' ) ] = array(

		'font-family'    => rella_helper()->get_typography_option( $titlebar_global_typo, $titlebar_heading_typography, 'font-family' ),
		'font-size'      => rella_helper()->get_typography_option( $titlebar_global_typo, $titlebar_heading_typography, 'font-size' ),
		'font-weight'    => rella_helper()->get_typography_option( $titlebar_global_typo, $titlebar_heading_typography, 'font-weight' ),
		'text-transform' => rella_helper()->get_typography_option( $titlebar_global_typo, $titlebar_heading_typography, 'text-transform' ),
		'font-style'     => rella_helper()->get_typography_option( $titlebar_global_typo, $titlebar_heading_typography, 'font-style' ),
		'text-align'     => rella_helper()->get_typography_option( $titlebar_global_typo, $titlebar_heading_typography, 'text-align' ),
		'line-height'    => rella_helper()->get_typography_option( $titlebar_global_typo, $titlebar_heading_typography, 'line-height' ),
		'letter-spacing' => rella_helper()->get_typography_option( $titlebar_global_typo, $titlebar_heading_typography, 'letter-spacing' ),
		'color'          => rella_helper()->get_typography_option( $titlebar_global_typo, $titlebar_heading_typography, 'color' ),

	);

	$max_fontsize = rella_helper()->get_option( 'title-bar-overlay-size' );
	if( ! empty( $max_fontsize ) && isset( $max_fontsize ) ) {
		$css['global'][ rella_implode( '.titlebar .titlebar__masked-text h1' ) ]['font-size'] = $max_fontsize;
	}

	//Titlebar SubHeading
	$titlebar_sub_global_typo        = rella_helper()->get_theme_option( 'title-bar-subheading-typography' );
	$titlebar_subheading_typography  = rella_helper()->get_post_meta( 'title-bar-subheading-typography' );

	$css['global'][ rella_implode( '.titlebar-inner h6' ) ] = array(
		'font-family'    => rella_helper()->get_typography_option( $titlebar_sub_global_typo, $titlebar_subheading_typography, 'font-family' ),
		'font-size'      => rella_helper()->get_typography_option( $titlebar_sub_global_typo, $titlebar_subheading_typography, 'font-size' ),
		'font-weight'    => rella_helper()->get_typography_option( $titlebar_sub_global_typo, $titlebar_subheading_typography, 'font-weight' ),
		'text-transform' => rella_helper()->get_typography_option( $titlebar_sub_global_typo, $titlebar_subheading_typography, 'text-transform' ),
		'font-style'     => rella_helper()->get_typography_option( $titlebar_sub_global_typo, $titlebar_subheading_typography, 'font-style' ),
		'text-align'     => rella_helper()->get_typography_option( $titlebar_sub_global_typo, $titlebar_subheading_typography, 'text-align' ),
		'line-height'    => rella_helper()->get_typography_option( $titlebar_sub_global_typo, $titlebar_subheading_typography, 'line-height' ),
		'letter-spacing' => rella_helper()->get_typography_option( $titlebar_sub_global_typo, $titlebar_subheading_typography, 'letter-spacing' ),
		'color'          => rella_helper()->get_typography_option( $titlebar_sub_global_typo, $titlebar_subheading_typography, 'color' ),
	);

	//Titlebar Overlay
	$titlebar_overlay_type = rella_helper()->get_theme_option( 'title-bar-overlay-background-type' );
	$local_titlebar_overlay_type  = rella_helper()->get_post_meta( 'title-bar-overlay-background-type' );
	if( ! empty( $local_titlebar_overlay_type ) ) {
		$titlebar_overlay_type = $local_titlebar_overlay_type;
	}

	$titlebar_overlay_color    = rella_helper()->get_option( 'title-bar-overlay-solid' );

	$titlebar_overlay_gradient = rella_helper()->get_option( 'title-bar-overlay-gradient' );

	if( 'color' === $titlebar_overlay_type && ! empty( $titlebar_overlay_color ) ) {
		if( $titlebar_overlay_color['alpha'] < 1  ) {
			$css['global'][ rella_implode( '.titlebar > .rella-row-overlay' )]['background'] = isset( $titlebar_overlay_color['rgba'] ) ? $titlebar_overlay_color['rgba'] : '';
		}
	}
	elseif( 'gradient' === $titlebar_overlay_type && ! empty( $titlebar_overlay_gradient ) ) {
		$overlay_gradient = rella_parse_gradient( $titlebar_overlay_gradient );
		$css['global'][ rella_implode( '.titlebar > .rella-row-overlay' ) ]['background'] = $overlay_gradient['background-image'];
	}

	//Links colors
	$link_colors = rella_helper()->get_option( 'links_color' );
	if( ! empty( $link_colors['regular'] ) ) {
		$css['global'][ rella_implode( 'a' ) ]['color'] = $link_colors['regular'];
	}
	if( ! empty( $link_colors['hover'] ) ) {
		$css['global'][ rella_implode( 'a:hover, a:focus' ) ]['color'] = $link_colors['hover'];
	}
	if( ! empty( $link_colors['visited'] ) ) {
		$css['global'][ rella_implode( 'a:visited' ) ]['color'] = $link_colors['visited'];
	}


	//Scroll Button Color
	$scroll_color = rella_helper()->get_option( 'title-bar-scroll-color' );
	if( ! empty( $scroll_color ) ) {
		$css['global'][ rella_implode( '.local-scroll.move-bottom a' ) ]['color'] = $scroll_color;
	}

	//Preloader background color
	$preloader_color = rella_helper()->get_option( 'preloader-color' );
	$preloader_color_back = rella_helper()->get_option( 'preloader-color-back' );
	if( ! empty( $preloader_color ) ) {
		$css['global'][ rella_implode( '.page-loader .page-loader-inner' ) ]['background-color'] = $preloader_color;
		$css['global'][ rella_implode( '.page-loader-inner-style2' ) ]['background-color'] = $preloader_color;
		$css['global'][ rella_implode( '.page-loader-inner-style1' ) ]['box-shadow'] = '0 -1px 0 ' . $preloader_color;
		$css['global'][ rella_implode( '.page-loader-inner-style3 .curtain-front' ) ]['background-color'] = $preloader_color;
	}
	if( ! empty( $preloader_color_back ) ) {
		$css['global'][ rella_implode( '.page-loader-inner-style3 .curtain-back' ) ]['background-color'] = $preloader_color_back;
	}

	// Content Padding
	$content_padding = rella_helper()->get_option('content-padding');
	if( !empty( $content_padding ) ) {

		if( isset( $content_padding['units'] ) ) {
			unset( $content_padding['units'] );
		}
		$css['global'][ rella_implode('#wrap #content') ] = $content_padding;
	}

	//Body Background
	$type_body_bg     = rella_helper()->get_option( 'body-background-type' );
	$body_bg          = rella_helper()->get_option( 'body-bg' );
	$body_gradient_bg = rella_helper()->get_option( 'body-bar-gradient' );

	if( ! empty( $body_bg ) && 'solid' === $type_body_bg ) {

		if( isset( $body_bg['background-color'] ) && ! empty( $body_bg['background-color'] ) ) {
			$css['global'][ rella_implode( 'body.boxed' ) ]['background-color'] = $body_bg['background-color'];
		}
		if( isset( $body_bg['background-image'] ) && ! empty( $body_bg['background-image'] ) ) {
			$css['global'][ rella_implode( 'body.boxed' ) ]['background-image'] = 'url( ' . esc_url( $body_bg['background-image'] ) . ')';
		}
		if( isset( $body_bg['background-repeat'] ) && ! empty( $body_bg['background-repeat'] ) ) {
			$css['global'][ rella_implode( 'body.boxed' ) ]['background-repeat'] = $body_bg['background-repeat'];
		}
		if( isset( $body_bg['background-size'] ) && ! empty( $body_bg['background-size'] ) ) {
			$css['global'][ rella_implode( 'body.boxed' ) ]['background-size'] = $body_bg['background-size'];
		}
		if( isset( $body_bg['background-attachment'] ) && ! empty( $body_bg['background-attachment'] ) ) {
			$css['global'][ rella_implode( 'body.boxed' ) ]['background-attachment'] = $body_bg['background-attachment'];
		}
		if( isset( $body_bg['background-position'] ) && ! empty( $body_bg['background-position'] ) ) {
			$css['global'][ rella_implode( 'body.boxed' ) ]['background-position'] = $body_bg['background-position'];
		}
	}
	elseif( ! empty( $body_gradient_bg ) && 'gradient' === $type_body_bg ) {
		$body_bg = rella_parse_gradient( $body_gradient_bg );
		$css['global'][ rella_implode( 'body.boxed' ) ]['background'] = $body_bg['background-image'];
	}


	//Content background
	$type_bg        = rella_helper()->get_option( 'page-background-type' );
	$content_bg     = rella_helper()->get_option( 'page-bar-solid' );
	$new_content_bg = rella_helper()->get_option( 'page-bg' );
	$gradient_bg    = rella_helper()->get_option( 'page-bar-gradient' );

	if( ! empty( $content_bg ) && empty( $new_content_bg['background-color'] ) ) {
		$new_content_bg['background-color']	= esc_attr( $content_bg );
	}

	if( ! empty( $new_content_bg ) && 'solid' === $type_bg ) {

		if( isset( $new_content_bg['background-color'] ) && ! empty( $new_content_bg['background-color'] ) ) {
			$css['global'][ rella_implode( '#content' ) ]['background-color'] = $new_content_bg['background-color'];
		}
		if( isset( $new_content_bg['background-image'] ) && ! empty( $new_content_bg['background-image'] ) ) {
			$css['global'][ rella_implode( '#content' ) ]['background-image'] = 'url( ' . esc_url( $new_content_bg['background-image'] ) . ')';
		}
		if( isset( $new_content_bg['background-repeat'] ) && ! empty( $new_content_bg['background-repeat'] ) ) {
			$css['global'][ rella_implode( '#content' ) ]['background-repeat'] = $new_content_bg['background-repeat'];
		}
		if( isset( $new_content_bg['background-size'] ) && ! empty( $new_content_bg['background-size'] ) ) {
			$css['global'][ rella_implode( '#content' ) ]['background-size'] = $new_content_bg['background-size'];
		}
		if( isset( $new_content_bg['background-attachment'] ) && ! empty( $new_content_bg['background-attachment'] ) ) {
			$css['global'][ rella_implode( '#content' ) ]['background-attachment'] = $new_content_bg['background-attachment'];
		}
		if( isset( $new_content_bg['background-position'] ) && ! empty( $new_content_bg['background-position'] ) ) {
			$css['global'][ rella_implode( '#content' ) ]['background-position'] = $new_content_bg['background-position'];
		}
	}
	elseif( ! empty( $gradient_bg ) && 'gradient' === $type_bg ) {
		$bg = rella_parse_gradient( $gradient_bg );
		$css['global'][ rella_implode( '#content' ) ]['background'] = $bg['background-image'];
	}

	$mobile_trigger_nav_color = rella_helper()->get_option( 'mobile-trigger-color' );
	if( ! empty( $mobile_trigger_nav_color ) ) {
		$css['@media (max-width: 991px)'][ rella_implode( 'body.mobile-header-overlay .main-header .header-module .navbar-toggle:before, body.mobile-header-overlay .main-header .header-module .navbar-toggle:after, body.mobile-header-overlay .main-header .header-module .navbar-toggle .icon-bar:before, body.mobile-header-overlay .main-header .header-module .navbar-toggle .icon-bar:after' ) ]['background'] = $mobile_trigger_nav_color;
	}

	return $css;
}


// Helpers ---------------------------------------

/**
 * Helper function.
 * Merge and combine the CSS elements
 */
function rella_implode( $elements = array() ) {

	if ( ! is_array( $elements ) ) {
		return $elements;
	}

	// Make sure our values are unique
	$elements = array_unique( array_filter( $elements ) );
	// Sort elements alphabetically.
	// This way all duplicate items will be merged in the final CSS array.
	sort( $elements );

	// Implode items and return the value.
	return implode( ',', $elements );

}

/**
 * Maps elements from dynamic css to the selector
 */
function rella_map_selector( $elements, $selector ) {
	$array = array();

	foreach( $elements as $element ) {
		$array[] = $element . $selector;
	}

	return $array;
}


/**
 * Typography body, h1, h2, h3, h4, h5, h6
 */
// CSS classes that inherit body typography settings
function rella_get_body_typography_elements() {
	$elements = array();

	// css classes that inherit body font size
	$elements['size'] = array(
		'body'
	);
	// css classes that inherit body font color
	$elements['color'] = array(
		'body'
	);
	// css classes that inherit body font
	$elements['family'] = array(
		'body'
	);
	// css classes that inherit body font
	$elements['line-height'] = array(
		'body'
	);

	$elements['additional'] = array(
		'.banner-half-bg .icon-box h3',
		'.format-quote .post-quote blockquote::before',
		'.format-link .post-quote blockquote::before',
		'.car-rent-reservation .ui-selectmenu-button',
		'.car-rent-reservation input',
		'.car-rent-reservation label',
		'.cart_totals table.shop_table th',
		'.counter-box .counter-element',
		'.content-box-img-info p',
		'.domain-search .ui-widget',
		'.img-maps-products h3',
		'.pricing-table-minimal2 h4',
		'.portfolio-no-gap .portfolio-item .btn',
		'.pricing-table-elegant .price',
		'.pricing-table-flat-head .currency',
		'.pricing-table-flat-head .pricing',
		'.pricing-table-tabular-alt2 h4',
		'.pricing-table-flat-head-gradient h4',
		'.pricing-table-flat-gradient h4',
		'.product-elegant-alt .product h3',
		'.product-elegant .product h3',
		'.section-title-underlined-title h2',
		'.section-title-side-line h2',
		'.tabs-border-floated .nav-tabs > li a',
		'.tabs-shadow .nav-tabs li a',
		'.tabs-shadow .nav-tabs li.active a',
		'.tabs-shadow h6',
		'.team-member-contact-info .team-member-title',
		'.team-member-border-bw .team-member-title',
		'.team-member-whole-border .team-member-title',
		'.team-member-hover-social-special .team-member-name',
		'.team-member-side-border .team-member-title',
		'.widget-title',
		'.widget_latest_posts_entries_carousel .contents h3'
	);


	return $elements;
}

// CSS classes that inherit H1 typography settings
function rella_get_h1_typography_elements() {
	$elements = array();

	// css classes that inherit h1 size
	$elements['size'] = array(
		'h1',
		'.h1',
		'.post-content h1'
	);
	// css classes that inherit h1 font family
	$elements['family'] = array(
		'h1',
		'.h1',
		'.post-content h1',
		'.module-fullheight-side .menu'
	);
	// css classes that inherit h1 color
	$elements['color'] = array(
		'h1',
		'.h1',
		'.post-content h1'
	);

	return $elements;
}

// CSS classes that inherit H2 typography settings
function rella_get_h2_typography_elements() {
	$elements = array();

	// css classes that inherit h2 size
	$elements['size'] = array(
		'h2',
		'.h2'
	);
	// css classes that inherit h2 color
	$elements['color'] = array(
		'h2',
		'.h2',
		'.post-content h2'
	);
	// css classes that inherit h2 font family
	$elements['family'] = array(
		'h2',
		'.h2',
		'.post-content h2'
	);
	// css classes that inherit h2 font family
	$elements['additional'] = array(
		'.format-quote .post-quote blockquote'
	);

	return $elements;
}

// CSS classes that inherit H3 typography settings
function rella_get_h3_typography_elements() {
	$elements = array();

	// css classes that inherit h3 font family
	$elements['family'] = array(
		'h3',
		'.h3',
		'.post-content h3',
		'.sidebar .widget h3'
	);
	// css classes that inherit h3 size
	$elements['size'] = array(
		'h3',
		'.h3',
		'.post-content h3'
	);
	// css classes that inherit h3 color
	$elements['color'] = array(
		'h3',
		'.h3',
		'.post-content h3',
		'.sidebar .widget h3'
	);

	$elements['additional'] = array(
		'.accordion-underline .accordion-toggle',
		'.acccordion-big-square .accordion-toggle',
		'.author-info h6',
		'.banner-half-bg p',
		'.banner-rhombus-subtitle-alt p',
		'.blog-posts .page-nav',
		'.blog-post .post-quote footer',
		'.blog-post .post-info',
		'.post-masonry .post-image .tags',
		'.post-masonry .post-video .tags',
		'.post-masonry .post-audio .tags',
		'.post-masonry .entry-more',
		'.box-rounded .rounded-tooltip',
		'.box-rounded h3',
		'.btn-social-alt',
		'.car-search .radio-group label',
		'.car-search .ui-selectmenu-button',
		'.car-rent-reservation li::before',
		'.car-rent-reservation label',
		'.carousel-swipe-button',
		'.carousel-items .latest-bold-title.latest-meta .meta',
		'.comment-list .comment .comment-meta',
		'.comment-list .comment .reply',
		'.comment-respond .comment-form input[type=submit]',
		'.content-box-big-img-alt .content-box-info',
		'.counter-box p',
		'.counter-element',
		'.contact-default-alt2 button',
		'.contact-gray button',
		'.domain-search.style3 input',
		'.domain-search.style3 select',
		'.domain-search.style3 button',
		'.elegant-filters li',
		'.format-quote .post-quote cite',
		'.featured-box-product-centered .featured-box-info',
		'.featured-box-product-centered .featured-box-price',
		'.icon-box .counter',
		// '.icon-box-boxed-unfilled-alt5 h3',
		'.page-nav',
		'.portfolio-grid .category',
		'.portfolio-grid .portfolio-meta',
		'.portfolio-grid .masonry-filters',
		'.portfolio .masonry-filters',
		'.portfolio-elegant .portfolio-item .item-details .subheading',
		'.pricing-table-flat-head .price',
		'.pricing-table-graphic .pricing',
		'.pricing-table-sticky-head-alt .price',
		'.pricing-table-sticky-head h4',
		'.pricing-table-sticky-head .pricing',
		'.pricing-table-minimal .price',
		'.pricing-table-tabular-alt .price',
		'.pricing-table-tabular-alt .currency',
		'.pricing-table-tabular-alt2 h4',
		'.pricing-table-flat-gradient .price',
		'.pricing-table-tabular-alt2 .pricing .price',
		'.sorting-option label',
		'.section-title .subtitle',
		'.section-title-thick .subtitle',
		'.team-member-hover-social .team-member-title',
		'.tabs-stacked-default .nav-pills li',
		'.tabs-border-floated .nav-tabs > li a .date',
		'.tabs-border-center-alt .nav-tabs li',
		'.tabs-switch-center-gradient .nav-tabs > li a',
		'.testimonial-minimal-vertical-default .testimonial-name',
		'.testimonial-minimal-square .testimonial-details',
		'.testimonial-inverted .testimonial-name',
		'.testimonial-minimal-vertical-big .quote-symbol:before',
		'.testimonial-minimal-vertical-default .testimonial-details:before',
		'.team-member-whole-border .team-member-title',
		'.team-member .team-member-details',
		'.testimonial-boxed .testimonial-details',
		'.testimonial-slider .testimonial-slider-pagination .pages',
		'.testimonial-slider .testimonial-quote-author',
		'.testimonial-minimal-vertical-default .testimonial-details::before',
		'.ui-selectmenu-menu li',
		'.main-sidebar .widget_wysija .wysija-submit',
		'.main-sidebar .widget_wysija input[type=submit]',
		'.main-sidebar .widget_wysija button',
		'.megamenu .custom-menu>h5',
		'.megamenu .widget-title',
		'#ship-to-different-address',
		'.module-cart .btn',
		'.module-cart .counter',
		'.module-cart .header-cart-container td h5',
		'.module-cart .header-cart-container td h6',
		'.module-cart .header-cart-container tfoot h5',
		'.module-wishlist .btn',
		'.module-wishlist .counter',
		'.module-wishlist .header-wishlist-container td h5',
		'.module-wishlist .header-wishlist-container td h6',
		'.module-wishlist .header-wishlist-container tfoot h5',
		'.woocommerce-page.single-product .entry-title',
		'.woocommerce .shop_table .button',
		'.woocommerce .cart-collaterals .button',
		'.woocommerce .main-sidebar .widget > h5',
		'.woocommerce .main-sidebar .widget .widget-title'
	);

	return $elements;
}

// CSS classes that inherit H4 typography settings
function rella_get_h4_typography_elements() {
	$elements = array();

	// css classes that inherit h4 size
	$elements['size'] = array(
		'h4',
		'.h4',
		'.post-content h4',
		'.author-heading',
		'.post-related h4',
		'.comments-area .comments-title',
		'.comments-area .comment-reply-title',
	);
	// css classes that inherit h4 color
	$elements['color'] = array(
		'h4',
		'.h4',
		'.post-content h4',
		'.author-heading',
		'.post-related h4',
		'.comments-area .comments-title',
		'.comments-area .comment-reply-title',
	);
	// css classes that inherit h4 font family
	$elements['family'] = array(
		'h4',
		'.h4',
		'.post-content h4',
		'.author-heading',
		'.post-related h4',
		'.comments-area .comments-title',
		'.comments-area .comment-reply-title',
	);

	return $elements;
}

// CSS classes that inherit H5 typography settings
function rella_get_h5_typography_elements() {
	$elements = array();

	// css classes that inherit h5 size
	$elements['size'] = array(
		'h5',
		'.h5',
		'.post-content h5'
	);
	// css classes that inherit h5 color
	$elements['color'] = array(
		'h5',
		'.h5',
		'.post-content h5'
	);
	// css classes that inherit h5 font family
	$elements['family'] = array(
		'h5',
		'.h5',
		'.post-content h5'
	);

	return $elements;
}

// CSS classes that inherit H6 typography settings
function rella_get_h6_typography_elements() {
	$elements = array();

	// css classes that inherit h6 size
	$elements['size'] = array(
		'h6',
		'.h6',
		'.post-content h6'
	);
	// css classes that inherit h6 color
	$elements['color'] = array(
		'h6',
		'.h6',
		'.post-content h6'
	);
	// css classes that inherit h6 font family
	$elements['family'] = array(
		'h6',
		'.h6',
		'.post-content h6'
	);

	return $elements;
}

function rella_get_extra_typography_elements() {

	$elements = array();

	$elements['family'] = array(
		'.banner-broad h3',
		'.banner-condensed-2-alt .btn',
		'.banner-deals .text-center .ribbon-text',
		'.banner-deals .text-left p',
		'.banner-deals .text-right p',
		'.car-rent-reservation',
		'.car-rent-reservation input',
		'.car-rent-reservation .ui-selectmenu-button',
		'.cart_totals table.shop_table td',
		'.content-box-img-alternate h3',
		'.content-box-img',
		'.content-box-img-info',
		'.featured-box-product .featured-box-featured',
		'.featured-box-product .featured-box-price',
		'.icon-box .counter-element',
		'.img-maps-products .price',
		'.latest-post__meta',
		'.outline-filters li',
		'.portfolio-elegant .portfolio-item .subheading',
		'.portfolio-elegant .masonry-filters li',
		'.portfolio .portfolio-item p',
		'.pricing-table-elegant .btn',
		'.pricing-table-graphic h4',
		'.pricing-table-minimal .pricing',
		'.pricing-table-minimal2 .currency',
		'.pricing-table-classic header h4',
		'.pricing-table-classic .price',
		'.pricing-table-classic .popular-badge',
		'.pricing-table-tabular .pricing',
		'.pricing-table-tabular-alt2 .pricing .currency',
		'.portfolio-classic .portfolio-item .item-details p',
		'.product-hover-shadow .price',
		'.product-bordered .product .price',
		'.product-elegant-alt li.product .price',
		'.product-elegant li.product .price',
		'.section-title-classic4 .subtitle',
		'.section-title-classic4-alt .subtitle',
		'.section-title-numerical h6',
		'.section-title-numerical-alt h6',
		'.section-title-classic3 .subtitle',
		'.section-title-blue-underline .subtitle',
		'#shipping_method .amount',
		'.tabs-switch-center > ul > li',
		'.tabs-icon-dots .nav-tabs > li > a',
		'.tabs-naked .nav-tabs > li',
		'.team-member-border .team-member-title',
		'.team-member-hover-expand .social-icons',
		'.testimonial-blurb-vertical .testimonial-details',
		'.testimonial-inverted .testimonial-details-other',
		'.vertical-progressbar .progressbar-title',
		'.vertical-progressbar .progressbar-value',
		'.woocommerce .woocommerce-checkout-review-order-table .amount',
		'.woocommerce table.shop_table td.product-subtotal',
		'.woocommerce table.shop_table td.product-price'
	);

	return $elements;

}

// CSS classes that inherit shortcodes typography settings
function rella_get_shortcodes_typography_elements() {
	$elements = array();

	// css classes that inherit h6 font family
	$elements['button'] = array(
		'.btn'
	);

	return $elements;
}


// CSS classes that inherit primary color settings
function rella_get_primary_color_elements() {
	$elements = array();

	// css classes that inherit primary text color
	$elements['color'] = array(
		'a:hover',
		'a:active',
		'a:focus',
		'.accordion-big-square .accordion-toggle a',
		'.accordion-university .accordion-expander',
		'.accordion-university .active .accordion-toggle a',
		'.accordion-boxed .active .accordion-expander',
		'.accordion-boxed-minimal .active .accordion-expander',
		'.accordion-facebook .accordion-expander',
		'.accordion-facebook-alt .accordion-expander',
		'.accordion-square-inverted .accordion-expander',
		'.accordion-square-expanded .accordion-expander',
		'.btn.ajax-load-more:focus',
		'.btn.ajax-load-more:hover',
		'.btn-app',
		'.btn-naked',
		'.btn-default',
		'.btn-center',
		'.btn-linethrough',
		'.btn-underlined',
		'.btn-underlined:hover',
		'.btn-underlined:focus',
		'.btn-underlined:active',
		'.btn-v-line',
		'.banner-app h6',
		'.blog-posts.timeline .timeline-date',
		'.blog-posts.timeline .post-info .tags a',
		'.blog-posts.puzzle .entry-more',
		'.blog-posts.puzzle .entry-more:hover',
		'.blog-posts.split .entry-more',
		'.blog-posts.split .entry-more:hover',
		'.blog-posts.masonry .entry-more',
		'.blog-posts.masonry .entry-more:hover',
		'.blog-posts .page-nav .ajax-load-more.loading',
		'.blog-posts .page-nav .ajax-load-more:focus',
		'.blog-posts .page-nav .ajax-load-more:hover',
		'.post:not(.blog-post) .entry-header .entry-byline a:hover',
		// '.blog-single .post-contents > .entry-content > p:first-child:first-letter',
		'.blog-single .post-info a[rel*=tag]:hover',
		'.blog-single .post-info a[rel*=category]:hover',
		'.blog-single .entry-summary blockquote::before',
		'.blog-single .entry-content blockquote::before',
		'.page .format-link .post-contents:before',
		'.blog .format-link .post-contents:before',
		'.blog-post .post-info a:focus',
		'.blog-post .post-info a:hover',
		'.post-featured-small:hover .entry-title a',
		'.btn.ajax-load-more:focus.btn-solid',
		'.btn.ajax-load-more:hover.btn-solid',
		'.pagination > li > span:hover',
		'.pagination > li a:hover',
		'.pagination > li > span:hover',
		'.pagination > li span.current',
		'.format-quote .post-quote blockquote::before',
		'.format-link .post-quote blockquote::before',
		'.blog-post .entry-title a:hover',
		'.blog-post .entry-title a:focus',
		'.car-rent-reservation label',
		'.car-rent-reservation .ui-selectmenu-button:after',
		'.car-rent-reservation .datepicker-container:before',
		'.cd-google-map.contents-style4 p',
		'.carousel-nav-style5 .flickity-prev-next-button:hover',
		'.content-box-bordered h3',
		'.outline-filters .masonry-filters li:hover',
		'.outline-filters .masonry-filters li.active',
		'.contact-black-alt button',
		'.contact-form.contact-inverted input',
		'.contact-minimal input[type="submit"]:hover',
		'.contact-minimal button:hover',
		'.contact-minimal-sm input[type="submit"]:hover',
		'.contact-minimal-sm button:hover',
		'.content-box-classic .btn',
		'.restaurant-menu .item-price',
		'.featured-box-product h3 a:hover',
		'.featured-box-product-centered h3 a',
		'.format-quote .post-quote blockquote:before',
		'.format-link .post-quote blockquote:before',
		'.format-link .entry-title a:before',
		'.product-hover-shadow li.product .price',
		'.car-search input[type="checkbox"]:checked ~ label',
		'.car-search input[type="checkbox"]:checked ~ label span',
		'.content-box-boxed-numbered .number',
		'.content-box-info-centered .content-box-info',
		'.accordion-university .active .accordion-toggle a',
		'.icon-box .counter',
		'.icon-box-counter-lg:hover h3',
		'.icon-box-boxed-unfilled-card h3',
		'.icon-box-boxed-unfilled-card .icon-container',
		'.icon-box-boxed-unfilled-alt5 h3',
		'.icon-box-boxed-unfilled-alt5 .icon-container',
		'.icon-box-boxed-unfilled-alt3:not(:hover) .icon-container',
		'.icon-box-boxed-unfilled-alt4:hover .icon-container',
		'.icon-box-boxed-unfilled-alt4:hover h3',
		'.img-maps .contents .info-box .price',
		'.latest-post__meta a',
		'.latest-post__meta_link-color-accent > span a',
		'.carousel-items .latest-bold-title .entry-title a',
		'.latest-svg-hover .meta a',
		'.latest-meta .meta a:hover',
		'.latest-default .entry-title a:hover',
		'.meta-caption .meta a:hover',
		'.main-nav li.current-menu-item > a',
		'.main-nav li.current_page_item > a',
		'.main-nav li.active > a',
		'.module-search-form.style-simple .search-form button',
		'.module-cart .header-cart-container tfoot .counter',
		'.module-cart .header-cart-container .header .items-counter',
		'.module-cart .header-cart-container a:hover',
		'.module-cart .header-cart-container a h5:hover',
		'.module-wishlist .header-wishlist-container tfoot .counter',
		'.module-wishlist .header-wishlist-container .header .items-counter',
		'.module-wishlist .header-wishlist-container a:hover',
		'.module-wishlist .header-wishlist-container a h5:hover',
		'.main-nav > li mark',
		'.module-search-form h4',
		'.megamenu .custom-menu > h5',
		'.main-header .main-nav > li > a:hover',
		'.main-header .main-nav > li.current-menu-item > a',
		'.main-header .main-nav > li.active > a',
		'.nav-side li.current-menu-item > a',
		'.nav-side li.current_page_item > a',
		'.nav-side li:hover > a',
		'.nav-side li.current-menu-item > a',
		'.nav-side li.current_page_item > a',
		'.section-title-thick h2',
		'.section-title-thick2 h2',
		'.section-title-thick .subtitle',
		'.section-title-orange-underline h2',
		'.section-title-default .subtitle',
		'.section-title-classic4 .subtitle',
		'.section-title-numerical-alt .subtitle',
		'.section-title-classic2 .subtitle',
		'.section-title-underlined-title h2',
		'.section-title-underlined-subtitle .subtitle',
		'.subscribe-form--button-bordered .wysija-submit',
		'.subscribe-form--button-underlined .wysija-submit',
		'.subscribe-form--button-naked .wysija-submit',
		'.page-nav .ajax-load-more-alt',
		'.page-links > span',
		'.pricing-table-elegant .price',
		'.pricing-table-app .btn',
		'.pricing-table-app .pricing',
		'.pricing-table-app .price',
		'.pricing-table-app .popular-badge',
		'.pricing-table-graphic .pricing',
		'.pricing-table-classic:hover .btn',
		'.pricing-table-classic .price',
		'.pricing-table-tabular .price',
		'.pricing-table-minimal h4',
		'.pricing-table-minimal .price',
		'.pricing-table-minimal .currency',
		'.pricing-table-sticky-head.featured .pricing',
		'.pricing-table-tabular-alt .price',
		'.pricing-table-tabular-alt2 .price',
		'.pricing-table-flat-gradient.featured .pricing',
		'.pricing-table-flat-gradient.featured .price',
		'.pricing-table-flat-gradient.featured .currency',
		'.pricing-table-sticky-head.featured .price',
		'.pricing-table-sticky-head.featured .pricing',
		'.pricing-table-sticky-head.featured .currency',
		'.pricing-table-sticky-head-alt.featured .pricing',
		'.pricing-table-sticky-head-alt.featured .price',
		'.pricing-table-sticky-head-alt.featured .currency',
		'.pricing-table-minimal.featured h4',
		'.pricing-table-minimal.featured .price',
		'.pricing-table-minimal.featured .currency',
		'.product-elegant ul.products li.product .product-image-container .product-label strong',
		'.product-elegant ul.products li.product .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a',
		'.product-elegant ul.products li.product .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a',
		'.product-elegant-alt ul.products li.product .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a',
		'.product-elegant-alt ul.products li.product .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a',
		'.product-elegant ul.products li.product .price',
		'.product-elegant-alt ul.products li.product:hover .price',
		'.post-date-featured .entry-date',
		'.pricing-table-flat-head .btn',
		'.pricing-table-tabular-alt2 .btn',
		'.product-elegant ul.products li.product .price',
		'.post-nav a:hover',
		'.post-nav a:focus',
		'.post-nav a:before',
		'.portfolio-likes.liked a',
		'.portfolio-likes a:focus',
		'.portfolio-likes a:hover',
		'.portfolio-item:not(.style-hover) .title-wrapper h2 a:hover',
		'.promo i',
		'.masonry.style-hover .portfolio-likes a:hover',
		'.masonry.style-hover .portfolio-likes a i:hover',
		'.testimonial-boxed .testimonial-name',
		'.tabs-stacked-bubble .nav-pills > li > a .number',
		'.team-member-border .social-icon a',
		'.team-member-whole-border.team-member-sm .team-member-title',
		'.team-member-contact-info .team-member-title',
		'.team-member-whole-border.team-member-sm p a',
		'.team-member-whole-border .team-member-name',
		'.team-member-button .social-icon li a:hover',
		'.team-member .team-member-details > span',
		'.team-member-info-side .details-inner > span',
		'.team-member .team-member-details a:hover',
		'.testimonial-icon .testimonial-quote:before',
		'.testimonial-blurb-default a',
		'.testimonial-details a',
		'.testimonial-boxed-vertical a',
		'.testimonial-minimal-vertical-default .testimonial-details:before',
		'.testimonial-minimal-vertical-default .testimonial-details a',
		'.testimonial-minimal-vertical-default .testimonial-details::before',
		'.testimonial-minimal-vertical-big .testimonial-details:before',
		// '.testimonial-blurb-vertical .testimonial-name',
		'.testimonial-minimal-vertical-big .quote-symbol:before',
		'.testimonial-minimal-vertical-big .quote-symbol:before',
		'.carousel-nav-style11 .flickity-prev-next-button:hover',
		'.carousel-nav-style11.nav-light .flickity-prev-next-button:hover',
		'.carousel-nav-style11.nav-dark .flickity-prev-next-button:hover',
		'.tabs-shadow .tab-content p .fa',
		'.tabs-shadow .nav-tabs li.active a',
		'.tabs-icon-center .nav-tabs > li.active a span',
		'.tabs-broad-border:not(.broad-border-alt) .nav-tabs > li.active a',
		'.tabs-border:not(.tabs-border-floated) .nav-tabs li.active a',
		'.tabs-icon-dots .nav-tabs > li.active > a',
		'.tabs-icon-dots .nav-tabs > li.active > a i',
		'.tabs-icon-dots .nav-tabs > li.active > a span',
		'.tabs-icon-dots .nav-tabs > li > a span.number-with-dot',
		'.tabs-icon-dots .nav-tabs > li > .active > a .icon-container',
		'.tabs-stacked-bubble-invert .nav-pills > li:hover > a',
		'.tabs-stacked-bubble-invert .nav-pills > li.active > a',
		'.tabs-naked .nav-tabs > li.active a',
		'.tabs-naked .nav-tabs > li.active:hover a',
		'.tabs-naked .nav-tabs > li.active a:hover',
		'.tabs-title-naked .nav-tabs li.active a',
		'.tabs-side .nav-tabs li.active>a',
		'.tabs-history .navbar-nav li.active i',
		'.tabs-history .navbar-nav li.active a',
		'.widget_tag_cloud a:hover',
		'.widget_product_tag_cloud a:hover',
		'.main-sidebar .widget.woocommerce > h5',
		'.main-sidebar .widget.woocommerce .widget-title',
		'.woocommerce table.shop_table td.product-subtotal',
		'.woocommerce table.shop_table td.product-price',
		'.woocommerce table.shop_table .product-info a:hover',
		'.woocommerce .cart-collaterals .cart_totals table.shop_table .order-total th',
		'.woocommerce .cart-collaterals .cart_totals table.shop_table .order-total td',
		'.woocommerce .woocommerce-checkout .create-account input.input-checkbox:checked ~ label.checkbox',
		'.woocommerce .woocommerce-checkout h3 input.input-checkbox:checked ~ label.checkbox',
		'.woocommerce table.woocommerce-checkout-review-order-table tr.shipping .amount',
		'.woocommerce table.woocommerce-checkout-review-order-table .cart-subtotal th',
		'.woocommerce table.woocommerce-checkout-review-order-table .order-total th',
		'.woocommerce table.woocommerce-checkout-review-order-table .order-total td .amount',
		'.woocommerce table.shop_table .product-info a:hover',
		'.woocommerce .cart-collaterals .cart_totals table.shop_table .order-total th',
		'.woocommerce .cart-collaterals .cart_totals table.shop_table .order-total td',
		'.woocommerce .woocommerce-checkout #payment button.btn',
		'.woocommerce-page.single-product #content div.product p.price',
		'.woocommerce-page.single-product div.product p.price',
		'.woocommerce .woocommerce-product-rating .star-rating span::before',
		'.woocommerce .star-rating span::before',
		'.woocommerce .woocommerce-info a',
		'.woocommerce-page.single-product.woocommerce p.stars a.active',
		'.woocommerce-page.single-product.woocommerce .stars a.active',
		'.woocommerce .woocommerce-error a',
		'.woocommerce .woocommerce-info a',
		'.woocommerce .woocommerce-message a',
		'.woocommerce .main-sidebar .widget > h5',
		'.woocommerce .main-sidebar .widget .widget-title',
		'.widget_products ul.product_list_widget li .amount',
		'.widget_recently_viewed_products ul.product_list_widget li .amount',
		'.widget_recent_reviews ul.product_list_widget li .amount',
		'.widget_top_rated_products ul.product_list_widget li .amount',
		'.widget_products_carousel .product .amount',
		'.woocommerce .widget_shopping_cart ul.product_list_widget li .amount',
		'.woocommerce.widget_shopping_cart ul.product_list_widget li .amount',
		'#yith-quick-view-modal #yith-quick-view-content div.product p.price',
		'#yith-quick-view-modal #yith-quick-view-content div.product span.price'
	);
	// css classes that inherit primary border color
	$elements['border'] = array(
		'.accordion-highlighted .active.accordion-item',
		'.accordion-boxed .active .accordion-expander',
		'.accordion-boxed-minimal .active .accordion-expander',
		'.accordion-square-expanded .active .accordion-toggle a',
		'.accordion-boxed .accordion-item.active',
		'.accordion-university .active .accordion-toggle',
		'.accordion-square.with-filler .active .accordion-toggle',
		'.accordion-square-expanded .active .accordion-expander',
		'.btn',
		'.btn-app',
		'.btn-solid',
		'.btn-underlined:hover',
		'.btn-underlined:active',
		'.btn-underlined:focus',
		'.btn.ajax-load-more:focus',
		'.btn.ajax-load-more:active',
		'.btn.ajax-load-more:hover',
		'.btn-underlined:before',
		'.btn-underlined:after',
		'blockquote',
		'.page .format-link .entry-title a:hover',
		'.blog .format-link .entry-title a:hover',
		'.post-no-image .entry-more:hover',
		'.post-no-image .entry-more:focus',
		'.car-search .ui-slider-handle.ui-state-focus',
		'.carousel-nav-style11 .flickity-prev-next-button:hover',
		'.carousel-nav-style11.nav-light .flickity-prev-next-button:hover',
		'.carousel-nav-style11.nav-dark .flickity-prev-next-button:hover',
		'.carousel-nav-style5 .flickity-prev-next-button:hover',
		'.client-border2:hover',
		'.contact-black-alt button',
		'.content-box-boxed-centered figure',
		'.fullpage-nav-style1 #fp-nav ul li .fp-tooltip:before',
		'.outline-filters .masonry-filters li:hover',
		'.outline-filters .masonry-filters li.active',
		'.icon-box-boxed-unfilled-alt2:hover',
		'.icon-box-boxed-unfilled-alt:hover',
		'.icon-box-bordered',
		'.icon-box-boxed-unfilled-alt:after',
		'.main-bar-container.floated .main-nav .link-txt:before',
		'.page-links > span',
		'.pricing-table-classic .popular-badge:after',
		'.pricing-table-classic:hover .btn',
		'.pricing-table-classic:hover',
		'.pricing-table-app',
		'.pricing-table-app .btn',
		'.pricing-table-minimal .btn',
		'.pricing-table-flat-head .btn',
		'.pricing-table-tabular-alt2 .btn',
		'.pricing-table-tabular-alt2 .btn:focus',
		'.pricing-table-tabular-alt2 .btn:hover',
		'.pricing-table-minimal.featured',
		'.pricing-table-tabular-alt:hover .btn',
		'.page-nav .ajax-load-more-alt',
		'.tabs-stacked-bubble-default .nav-pills > li::before',
		'.blog-posts.timeline .timeline-date',
		'.blog-posts .page-nav .ajax-load-more.loading',
		'.blog-posts .page-nav .ajax-load-more:focus',
		'.blog-posts .page-nav .ajax-load-more:hover',
		'.page .format-link .entry-title a:hover',
		'.pagination > li > span:hover',
		'.pagination > li a:hover',
		'.pagination > li span.current',
		'.portfolio-item:not(.style-hover) .portfolio-footer .btn:hover',
		'.portfolio-item:not(.style-hover) .portfolio-footer .portfolio-share:hover .btn',
		'.section-title-underlined-title h2',
		'.section-title-underlined-subtitle .subtitle',
		'.subscribe-form--button-bordered .wysija-submit',
		'.subscribe-form--button-underlined .wysija-submit',
		'.tabs-side .nav-tabs li:hover a',
		'.team-member-border:hover .team-member-details',
		'.team-member-side-border .team-member-name',
		'.team-member-side-border .team-member-title',
		'.testimonial-blurb-default .testimonial-quote',
		'.widget_tag_cloud a:hover',
		'.widget_product_tag_cloud a:hover',
		'.main-sidebar .widget.woocommerce > h5',
		'.main-sidebar .widget.woocommerce .widget-title',
		'.woocommerce-page.single-product.woocommerce p.stars a.active',
		'.woocommerce-page.single-product.woocommerce .stars a.active',
		'.woocommerce .woocommerce-checkout #payment .form-row.place-order .button',
		'.woocommerce .main-sidebar .widget > h5',
		'.woocommerce .main-sidebar .widget .widget-title'
	);
	// css classes that inherit primary border-right color
	$elements['border-right'] = array(
		'.testimonial-blurb-default .testimonial-quote:before',
		'.portfolio-item.classic:not(.style-hover) .portfolio-share-popup:before'
	);
	// css classes that inherit primary border-top color
	$elements['border-top'] = array(
		'.blog-posts.timeline .timeline-date .loader-inner',
		'.car-search .val-tooltip:after',
		'.cd-google-map.contents-style4.alt .contents-inner .details::after',
		'.cd-google-map.contents-style4 .contents-inner .details::after',
		'.img-maps .contents .info-box .border',
		'.portfolio-share .portfolio-share-popup:before',
		'.tabs-title-naked .nav-tabs li.active a:before',
		'.team-member.team-details-up .team-member-details::after',
		'.testimonial-blurb-default .testimonial-quote:before',
		'.vertical-progressbar .progressbar-bar',
	);
	// css classes that inherit primary border-bottom color
	$elements['border-bottom'] = array(
		'.team-member-masonry .team-member-details:after',
		'.banner-icons'
	);
	// css classes that inherit primary background color
	$elements['background'] = array(
		'.bg-accent',
		'.accordion-red .active .accordion-toggle',
		'.accordion-red .accordion-expander',
		'.accordion-facebook .active .accordion-toggle',
		'.accordion-facebook-alt .active .accordion-toggle',
		'.accordion-square .active .accordion-toggle',
		'.accordion-square .accordion-expander',
		'.accordion-square-expanded .active .accordion-toggle a',
		'.accordion-square-hfiller-inverted .accordion-toggle a',
		'.accordion-square-expanded .active .accordion-expander',
		'.accordion-boxed .accordion-expander',
		'.btn-solid',
		'.btn-app:hover',
		'.btn-app:focus',
		'.btn-boxed',
		'.btn-boxed:hover',
		'.btn-boxed:focus',
		'.btn-default:hover',
		'.btn-default:active',
		'.btn-default:focus',
		'.btn-linethrough span:after',
		'.btn-linethrough span:before',
		'.btn-center:hover',
		'.btn-hover-curtain .btn-curtain',
		'.blog-post a[rel*="tag"]',
		'.blog-post a[rel*="category"]',
		'.post-no-image .entry-more:hover',
		'.post-no-image .entry-more:focus',
		'.boxed-filters .masonry-filters li:hover',
		'.boxed-filters .masonry-filters li.active',
		'.portfolio-share .portfolio-share-popup',
		'.banner-icons',
		'.banner-condensed .btn-rhombus:before',
		'.blog-post .post-video > time',
		'.blog-post .post-audio > time',
		'.blog-posts.timeline .blog-post .post-image > time',
		'.blog-posts.only-title .post-only-title:hover',
		'.blog-post.post-masonry-alt.format-quote',
		'.meta-caption .meta', //http://hosting.themerella.com/
		'.post-featured .post-contents .tags a',
		'.comment-respond .comment-form input[type=submit]',
		'.car-search .val-tooltip',
		'.car-search button',
		'.car-search .ui-slider-range',
		'.car-search .ui-slider-handle:before',
		'.car-search .ui-slider-handle.ui-state-focus',
		'.car-rent-reservation button',
		'.carousel-nav-style4 .flickity-page-dots .dot.is-selected',
		'.carousel-nav-style6 .flickity-page-dots .dot.is-selected',
		'.cd-google-map.contents-style4.alt .contents-inner .details',
		'.cd-google-map.contents-style4 .contents-inner .details',
		'.contact-form.contact-inverted button',
		'.content-box-boxed figure:after',
		'.content-box-big-img-default .content-box-info',
		'.content-box-big-img-alt .content-box-info',
		'.content-box-caption .content-box-content:before',
		'.contact-form.contact-default-primary .wpcf7-submit',
		'.contact-inverted-line-alt .wpcf7-submit',
		'.contact-default-alt2 button',
		'.contact-default-alt3 button',
		'.contact-gray button',
		'.contact-line-alt .wpcf7-form-control-wrap:after',
		'.flickity-page-dots .dot.is-selected',
		'.flickity-page-dots li.is-selected',
		'.featured-box-product .featured-box-featured',
		'.featured-box-product .featured-box-price',
		'.fullpage-nav-style1 #fp-nav ul li a span:before',
		'.fullpage-nav-style1 #fp-nav ul li .fp-tooltip',
		'.grid.style-hover.hover-bottom-shadow.buttons-square .btn:hover',
		'.icon-box-boxed-unfilled-alt3:hover',
		'.icon-box-square .icon-container',
		'.icon-box-circle .icon-container',
		'.icon-box-lozenge .icon-container',
		'.img-maps .contents .info-box::before',
		'.img-maps .contents .info-box::after',
		'.latest-post__footer_svg',
		'.latest-post__meta_solid',
		'.latest-post:hover .latest-post__meta_stick_top-side',
		'.latest-svg-hover footer',
		'.main-bar-container.floated .main-nav .link-txt',
		'.map_marker',
		'.map_marker div',
		'.main-bar-container.floated .main-nav a:after',
		'.main-sidebar .widget_wysija .wysija-submit',
		'.main-sidebar .widget_wysija button',
		'.main-sidebar .widget_subscribe .wysija-submit',
		'.main-sidebar .widget_subscribe button',
		'.mejs-container .mejs-controls .mejs-volume-button .mejs-volume-slider .mejs-volume-handle',
		'.mejs-container .mejs-controls .mejs-volume-button .mejs-volume-slider .mejs-volume-current',
		'.mejs-container .mejs-controls .mejs-time-rail .mejs-time-total .mejs-time-current',
		'.module-trigger .badge',
		'.nav-item-children-style2 .menu-item > a:after',
		'.nav-item-children-style2 .nav-item-children .menu-item > a > .link-txt:after',
		'.section-title-numerical-alt h2:after',
		'.section-title-side-line h2:after',
		'.section-title-red-underline2 h2:after',
		'.section-title-thick h2:after',
		'.sorting-option input:checked + .input-dummy:after',
		'.subscribe-form--button-solid .wysija-submit',
		'.pricing-table-graphic h4',
		'.pricing-table-classic .popular-badge',
		'.pricing-table-flat-head header',
		'.pricing-table-minimal .btn',
		'.pricing-table-flat-head .btn:hover',
		'.pricing-table-flat-head header',
		'.pricing-table-tabular-alt2 .btn:focus',
		'.pricing-table-tabular-alt2 .btn:hover',
		'.pricing-table-tabular-alt:hover .btn',
		'.portfolio-item.hover-side .portfolio-footer:before',
		'.portfolio-item.hover-bottom-shadow .btn:hover',
		'.portfolio-item.hover-bottom-shadow .portfolio-share .btn:hover',
		'.portfolio-item.hover-bottom-shadow .portfolio-share:hover .btn',
		'.portfolio-likes.liked a i',
		'.portfolio-likes a:focus i',
		'.portfolio-likes a:hover i',
		'.portfolio-item.text-light .portfolio-likes i',
		'.portfolio-item.hover-bottom .btn:hover',
		'.portfolio-item.hover-bottom .portfolio-share .btn:hover',
		'.portfolio-item.hover-bottom .portfolio-share:hover .btn',
		'.portfolio-likes.style-alt a > span',
		'.grid.style-hover.hover-bottom.text-light .btn:hover',
		'.grid.style-hover.hover-bottom.text-light .portfolio-share .btn:hover',
		'.grid.style-hover.hover-bottom.text-light .portfolio-share:hover .btn',
		'.nav-side a:after',
		'.tabs-stacked-bubble-default .nav-pills > li.active > a',
		'.tabs-border-floated .nav-tabs li a:before',
		'.tabs-border .nav-tabs li a:before',
		'.tabs-border-floated .nav-tabs > li.active:hover a',
		'.tabs-border-floated .nav-tabs > li:hover a',
		'.tabs-border-floated .nav-tabs > li.active a',
		'.tabs-border-center-default .nav-tabs > li.active a',
		'.tabs-border-center-default .nav-tabs > li.active a:hover',
		'.tabs-switch-center .nav-tabs > li a',
		'.tabs-icon-dots .nav-tabs > li > a span.number-with-dot:before',
		'.tabs-switch-center .nav-tabs > li:hover a',
		'.tabs-title-naked .nav-tabs li.active a:after',
		'.tabs-stacked-default .nav-pills > li:hover > a',
		'.tabs-stacked-bubble-default .nav-pills > li:hover > a',
		'.tabs-stacked-bubble-default .nav-pills > li.active > a',
		'.tabs-stacked-default .nav-pills > li.active > a',
		'.tabs-simple .nav-tabs li.active a',
		'.tabs-simple .nav-tabs li.active:hover a',
		'.tabs-history .navbar-nav li a:before',
		'.tabs-history .navbar-nav li a:after',
		'.tabs-border-center-alt1 .nav-tabs > li.active:hover a',
		'.tabs-border-center-alt1 .nav-tabs > li.active a',
		'.team-member-top-curve .team-member-title',
		'.team-member-card-minimal .team-member-title',
		'.team-member-hover-social .team-member-title',
		'.team-member-masonry .team-member-details',
		'.testimonial-bg',
		'.team-member-button .btn',
		'.page-loader .page-loader-inner',
		'.popular-badge',
		'.portfolio-classic .item-details:before',
		'.portfolio-no-gap .item-details:before',
		'.portfolio-flat .item-details:before',
		'.portfolio-item:not(.style-hover) .portfolio-footer .btn:hover',
		'.portfolio-item:not(.style-hover) .portfolio-footer .portfolio-share:hover .btn',
		'.portfolio-simple .item-details a:before',
		'.section-title-thick3 hr',
		'.widget_back_to_top_style2 a',
		'.widget_search input[type="submit"]',
		'.widget_product_search input[type="submit"]',
		'.widget_nav_menu a:hover mark',
		'.woocommerce .wc-proceed-to-checkout a.button.checkout-button:hover',
		'.woocommerce .wc-proceed-to-checkout a.button.checkout-button',
		'.woocommerce .woocommerce-checkout #payment .form-row.place-order .button',
		'.woocommerce .widget_price_filter .ui-slider .ui-slider-handle',
		'.woocommerce .widget_price_filter .ui-slider .ui-slider-range',
		'#yith-quick-view-modal #yith-quick-view-content div.product form.cart .button'
	);

	// css classes that inherit primary color in shadow inset 0 0 0 2px $primaryColor
	$elements['shadow'] = array(
		'.tabs-switch-center .nav-tabs > li.active a',
		'.tabs-switch-center .nav-tabs > li.active a:hover',
		'.pricing-table-sticky-head.featured'
	);
	// css classes that inherit primary color in shadow inset 0 0 0 1px $primaryColor
	$elements['shadow-1'] = array(
		'.pricing-table-classic:hover'
	);
	// css classes that inherit primary color in shadow inset 0 1px 0 0 $primaryColor
	$elements['shadow-2'] = array(
		'.pricing-table-classic:hover .btn'
	);
	// css classes that inherit primary color in shadow 0 0 0 2px $primaryColor
	$elements['shadow-3'] = array(
		'.tabs-icon-center .nav-tabs > li.active a'
	);
	// css classes that inherit primary color in shadow inset 0 -3px 0 0 $primaryColor
	$elements['shadow-4'] = array(
		'.testimonial-boxed-vertical:hover'
	);

	// SVG Fill
	$elements['other-2'] = array(
		'.team-member-top-curve svg',
		'.latest-post__footer_svg',
		'.pricing-table-graphic header svg',
		'.navbar-default .main-nav > li > a:hover > .link-icon svg',
		'.navbar-default .main-nav > li.current-menu-item > a > .link-icon svg',
		'.latest-svg-hover footer svg'
	);

	// SVG Stroke
	$elements['other-3'] = array(
		'.team-member-top-curve svg',
		'.latest-post__footer_svg',
		// '.pricing-table-graphic header svg',
		'.navbar-default .main-nav > li > a:hover > .link-icon svg',
		'.navbar-default .main-nav > li.current_page_item > a > .link-icon svg'
	);

	// other
	$elements['other-4'] = array(
		'.section-title-red-underline hr',
		'.testimonial-minimal-square .testimonial-details:before'
	);

	return $elements;
}

// CSS classes that inherit secondary color settings
function rella_get_secondary_color_elements() {

	$elements = array();

	// css classes that inherit secondary color
	$elements['color'] = array(
		'.car-rent-reservation li:before',
		'.featured-box-product h3 a:hover',
		'.carousel-items .latest-bold-title .entry-title a:hover',
		'.carousel-items .latest-bold-title .entry-title a:focus',
		'.pricing-table-minimal.featured h4',
		'.pricing-table-minimal.featured .price',
		'.pricing-table-minimal.featured .currency',
		'.testimonial-boxed .testimonial-details a',
		'.elegant-filters .masonry-filters li.active'
	);
	// css classes that inherit secondary background-color
	$elements['background'] = array(
		'.accordion-big-square .accordion-item.active .accordion-expander',
		'.banner-rhombus-subtitle-alt h6',
		'.content-box-big-img-alt .content-box-info-2:after',
		'.featured-box-product .featured-box-price',
		'.latest-posts-carousel-nav .flickity-prev-next-button::before',
		'.pricing-table-flat-head:hover header',
		'.pricing-table-minimal.featured .btn',
		'.portfolio-elegant .item-details',
		'.section-title-orange-underline hr',
		'.section-title-thick i',
		'.section-title-thick2 p i',
		'.section-title-thick2 hr',
		'.tabs-border-center-alt1 .nav-tabs > li.active:hover a',
		'.tabs-border-center-alt1 .nav-tabs li.active a',
		'.team-member-hover-social:hover .team-member-title',
		'.team-member-card-minimal .team-member-title',
		'.team-member-hover-social .team-member-title',
		'.team-member-hover-social .social-icon:before',
		'.vertical-progressbar .progressbar-bar:before'
	);

	// css classes that inherit secondary border-color
	$elements['border'] = array(
		'.car-rent-reservation li:before',
		'.domain-search input[type="checkbox"]:checked + label:before',
		// '.icon-box-boxed-unfilled-alt5 .btn',
		'.pricing-table-minimal.featured',
		'.pricing-table-minimal.featured .btn'
	);
	// css classes that inherit secondary border-top color
	$elements['border-top'] = array(
		'.vertical-progressbar .progressbar-bar',
		// '.testimonial-blurb-vertical:hover .testimonial-quote:before'
	);
	// css classes that inherit secondary border-left color
	$elements['border-left'] = array(
		'.team-member-side-border.style2 .team-member-name',
		'.team-member-side-border.style2 .team-member-title'
	);

	// css classes that inherit secondary shadow color
	$elements['shadow'] = array(
		'.domain-search input[type="checkbox"]:checked + label:before'
	);

	return $elements;
}

// CSS classes that inherit secondary color settings
function rella_get_tertiary_color_elements() {
	$elements = array();

	$elements['background'] = array(
		'.contact-envelope button'
	);

	$elements['color'] = array(
		'.team-member-side-border .team-member-title'
	);

	return $elements;
}

// CSS classes that inherit primary gradient color settings
function rella_get_primary_gradient_color_elements() {
	$elements = array();

	// css classes that inherit primary gradient right to left color
	$elements['gradient-1'] = array(
		'.team-member-hover-social .social-icon:before',
		'.pricing-table-flat-head-gradient .btn::before',
		'.pricing-table-flat-head-gradient header',
		'.pricing-table-flat-head-gradient:hover header',
		'.contact-line.contact-elegant .wpcf7-form-control-wrap:after',
		'.btn.ajax-load-more.btn-linear',
		'.blog-posts.trending .blog-post.trending .post-image:before',
		'.backgroundcliptext .blog-post.trending:hover .entry-title',
		'.icon-box-boxed-unfilled-gradient:after'
	);

	// css classes that inherit primary gradient left to right color
	$elements['gradient'] = array(
		'.accordion-facebook .active .accordion-toggle',
		'.contact-line.contact-elegant .wpcf7-submit:before',
		'.latest-post__meta_solid-gradient',
		'.pricing-table-elegant .btn:before',
		'.section-title-blue-underline2 hr',
		'.section-title-blue-underline hr',
		'.team-member-hover-social .social-icon:before'
	);

	// css classes that inherit primary gradient top left to bottom right color
	$elements['gradient-2'] = array(
		'.animate-bg-expand:before',
		'.domain-search .search-field + button',
		'.pricing-table-app:before',
		'.pricing-table-sticky-head-alt',
		'.pricing-table-sticky-head.featured h4',
		'.tabs-switch-center-gradient .nav-tabs:after',
		'.team-member-hover-social-special .team-member-details:before',
		'.pricing-table-sticky-head-alt.features-table .pricing-table-inner',
		'.portfolio-default .item-details:before',
	);

	// css classes that inherit primary gradient bottom right to top left color
	$elements['gradient-2-1'] = array(
		'.carousel-nav-style3 .flickity-prev-next-button:before',
		'.carousel-nav-style3 button:before',
		'.latest-posts-carousel-nav .flickity-prev-next-button:before',
		'.latest-posts-carousel-nav button:before',
		'.portfolio-elegant .item-details',
		'.progressbar-bar span',
		'.pricing-table-sticky-head',
		'.pricing-table-sticky-head.featured .btn',
		'.team-member-cards .social-icon',
		'.backgroundcliptext .counter-box-sep:hover .counter-element',
		'.backgroundcliptext .counter-box-sep:hover p'
	);

	// css classes that inherit primary gradient top to bottom color
	$elements['gradient-3'] = array(
		'.testimonial-blurb-vertical .testimonial-quote',
		'.section-title-blue-underline i',
		'.pricing-table-elegant.featured',
		'.backgroundcliptext .pricing-table-elegant .price'
	);

	// css classes that inherit primary gradient bottom to top color
	$elements['gradient-4'] = array(
		'.backgroundcliptext .pricing-table-minimal2 .price'
	);

	// css classes that inherit primary gradient end color
	$elements['gradient-3-end-color'] = array(
		'.testimonial-blurb-vertical:hover .testimonial-quote:before'
	);

	// SVG Gradient Stop Color 1
	$elements['other'] = array(
		'.circle-gradient-border linearGradient stop:first-child'
	);

	// SVG Gradient Stop Color 2
	$elements['other-1'] = array(
		'.circle-gradient-border linearGradient stop:last-child'
	);

	return $elements;
}

// CSS classes that inherit secondary gradient color settings
function rella_get_secondary_gradient_color_elements() {
	$elements = array();

	// css classes that inherit primary gradient left to right color
	$elements['gradient'] = array(
		'.team-member-hover-social .social-icon:before'
	);

	return $elements;
}

// CSS classes that inherit secondary gradient color settings
function rella_get_tertiary_gradient_color_elements() {
	$elements = array();

	return $elements;
}
