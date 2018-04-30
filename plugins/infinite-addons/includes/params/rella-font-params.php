<?php
/**
* Font Params
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function rella_get_font( $slug, $atts, $param, $tag = 'h6' ) {

	if ( isset( $atts[ $param ] ) && '' !== trim( $atts[ $param ] ) ) {

		if ( isset( $atts[ 'use_custom_fonts_' . $param ] ) && 'true' === $atts[ 'use_custom_fonts_' . $param ] ) {
			$custom_heading = visual_composer()->getShortCode( 'vc_custom_heading' )->shortcodeClass();
			$h_atts = vc_map_integrate_parse_atts( $slug, 'vc_custom_heading', $atts, $param . '_' );
			// print_r($h_atts);
			$data = $custom_heading->getAttributes( $h_atts );
			// print_r($data);
			$styles = $custom_heading->getStyles( '', '', $data['google_fonts_data'], $data['font_container_data'], $h_atts );
			//print_r($styles);
			$styles['tag'] = isset( $data['font_container_data']['values']['tag'] ) ? $data['font_container_data']['values']['tag'] : $tag;

			if ( ( ! isset( $h_atts['use_theme_fonts'] ) || 'yes' !== $h_atts['use_theme_fonts'] ) && ! empty( $data['google_fonts_data'] ) && isset( $data['google_fonts_data']['values']['font_family'] ) ) {
				$styles['font_family'] = $data['google_fonts_data']['values']['font_family'];
			}
			else {
				$styles['font_family'] = false;
			}

			unset( $styles['css_class'] );

			return $styles;
		}
		else {
			return array(
				'tag' => $tag,
				'styles' => array(),
				'font_family' => false
			);
		}
	}

	return false;
}

function rella_get_font_params( $prefix, $title, $dependency = array() ) {

	require_once vc_path_dir( 'CONFIG_DIR', 'content/vc-custom-heading-element.php' );

	$custom = vc_map_integrate_shortcode( vc_custom_heading_element_params(), $prefix, $title, array(
		'exclude' => array(
			'source',
			'text',
			'link',
			'el_class',
			'css',
		),
	), $dependency );

	// This is needed to remove custom heading _tag and _align options.
	if ( is_array( $custom ) && ! empty( $custom ) ) {
		foreach ( $custom as $key => &$param ) {

			// text_align
			if ( is_array( $param ) && isset( $param['type'] ) && 'font_container' === $param['type'] ) {
				$custom[ $key ]['value'] = '';
				if ( isset( $param['settings'] ) && is_array( $param['settings'] ) && isset( $param['settings']['fields'] ) ) {
					$sub_key = array_search( 'text_align', $param['settings']['fields'] );
					if ( false !== $sub_key ) {
						unset( $custom[ $key ]['settings']['fields'][ $sub_key ] );
					} elseif ( isset( $param['settings']['fields']['text_align'] ) ) {
						unset( $custom[ $key ]['settings']['fields']['text_align'] );
					}
				}
			}
		}
	}

	return $custom;
}

function rella_custom_google_fonts() {
	
	$fonts_list = '[
		{"font_family":"Abril Fatface","font_styles":"regular","font_types":"400 regular:400:normal"},
		{"font_family":"Arimo","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},
		{"font_family":"Arvo","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},
		{"font_family":"Archivo","font_styles":"regular,italic,500,500italic,600,600italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,500 medium regular:500:normal,500 medium italic:500:italic,600 semi-bold regular:600:normal,600 semi-bold italic:600:italic,700 bold regular:700:normal,700 bold italic:700:italic"},
		{"font_family":"Assistant","font_styles":"200,300,regular,600,700,800","font_types":"200 light:200:normal,300 light:300:normal,400 regular:400:normal,600 bold regular:600:normal,700 bold regular:700:normal,800 bold regular:800:normal"},
		{"font_family":"Barlow Semi Condensed","font_styles":"300,regular,500","font_types":"300 light regular:300:normal,400 regular:400:normal,500 medium regular:500:normal"},
		{"font_family":"Bitter","font_styles":"regular,italic,700","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal"},
		{"font_family":"Cabin","font_styles":"regular,italic,500,500italic,600,600italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,500 bold regular:500:normal,500 bold italic:500:italic,600 bold regular:600:normal,600 bold italic:600:italic,700 bold regular:700:normal,700 bold italic:700:italic"},
		{"font_family":"Cinzel","font_styles":"regular,700,900","font_types":"400 regular:400:normal,700 bold regular:700:normal,900 bold regular:900:normal"},
		{"font_family":"Coda","font_styles":"regular,800","font_types":"400 regular:400:normal,800 bold regular:800:normal"},
		{"font_family":"Condiment","font_styles":"regular","font_types":"400 regular:400:normal"},
		{"font_family":"Damion","font_styles":"regular","font_types":"400 regular:400:normal"},
		{"font_family":"Delius","font_styles":"regular","font_types":"400 regular:400:normal"},
		{"font_family":"Dosis","font_styles":"200,300,regular,500,600,700,800","font_types":"200 light regular:200:normal,300 light regular:300:normal,400 regular:400:normal,500 bold regular:500:normal,600 bold regular:600:normal,700 bold regular:700:normal,800 bold regular:800:normal"},
		{"font_family":"Droid Sans","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},
		{"font_family":"Droid Serif","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},
		{"font_family":"Exo","font_styles":"100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic","font_types":"100 light regular:100:normal,100 light italic:100:italic,200 light regular:200:normal,200 light italic:200:italic,300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,500 bold regular:500:normal,500 bold italic:500:italic,600 bold regular:600:normal,600 bold italic:600:italic,700 bold regular:700:normal,700 bold italic:700:italic,800 bold regular:800:normal,800 bold italic:800:italic,900 bold regular:900:normal,900 bold italic:900:italic"},
		{"font_family":"Hind","font_styles":"300,regular,500,600,700","font_types":"300 light regular:300:normal,400 regular:400:normal,500 bold regular:500:normal,600 bold regular:600:normal,700 bold regular:700:normal"},
		{"font_family":"Istok Web","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},
		{"font_family":"Josefin Sans","font_styles":"100,100italic,300,300italic,regular,italic,600,600italic,700,700italic","font_types":"100 light regular:100:normal,100 light italic:100:italic,300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,600 bold regular:600:normal,600 bold italic:600:italic,700 bold regular:700:normal,700 bold italic:700:italic"},
		{"font_family":"Josefin Slab","font_styles":"100,100italic,300,300italic,regular,italic,600,600italic,700,700italic","font_types":"100 light regular:100:normal,100 light italic:100:italic,300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,600 bold regular:600:normal,600 bold italic:600:italic,700 bold regular:700:normal,700 bold italic:700:italic"},
		{"font_family":"Karla","font_styles":"regular","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},		
		{"font_family":"Lato","font_styles":"100,100italic,300,300italic,regular,italic,700,700italic,900,900italic","font_types":"100 light regular:100:normal,100 light italic:100:italic,300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic,900 bold regular:900:normal,900 bold italic:900:italic"},
		{"font_family":"Libre Baskerville","font_styles":"regular,italic,700","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal"},
		{"font_family":"Lobster","font_styles":"regular","font_types":"400 regular:400:normal"},
		{"font_family":"Lora","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},
		{"font_family":"Merienda","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},
		{"font_family":"Merriweather","font_styles":"300,300italic,regular,italic,700,700italic,900,900italic","font_types":"300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic,900 bold regular:900:normal,900 bold italic:900:italic"},
		{"font_family":"Merriweather Sans","font_styles":"300,300italic,regular,italic,700,700italic,800,800italic","font_types":"300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic,800 bold regular:800:normal,800 bold italic:800:italic"},
		{"font_family":"Montserrat","font_styles":"100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic","font_types":"100 thin regular:100:normal,100 thin italic:100:italic,200 extra-light regular:200:normal,200 extra-light italic:200:italic,300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,500 medium regular:500:normal,500 medium italic:500:italic,600 semi-bold regular:600:normal,600 semi-bold italic:600:italic,700 bold regular:700:normal,700 bold italic:700:italic,800 extra-bold regular:800:normal,800 extra-bold italic:800:italic,900 black regular:900:normal,900 black italic:900:italic"},
		{"font_family":"Muli","font_styles":"300,300italic,regular,italic,600,600italic,700,700italic,800,800italic,900,900italic","font_types":"200 light regular:200:normal,200 light italic:200:italic,300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,600 bold regular:600:normal,600 bold italic:600:italic,700 bold regular:700:normal,700 bold italic:700:italic,800 bold regular:800:normal,800 bold italic:800:italic,900 bold regular:900:normal,900 bold italic:900:italic"},
		{"font_family":"Neuton","font_styles":"200,300,regular,italic,700,800","font_types":"200 light regular:200:normal,300 light regular:300:normal,400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,800 bold regular:800:normal"},{"font_family":"Nothing You Could Do","font_styles":"regular","font_types":"400 regular:400:normal"},
		{"font_family":"Noto Sans","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},
		{"font_family":"Noto Serif","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},
		{"font_family":"Nunito","font_styles":"300,regular,600,700","font_types":"300 regular:300:normal,400 regular:400:normal,600 bold regular:600:normal,700 bold regular:700:normal"},
		{"font_family":"Old Standard TT","font_styles":"regular,italic,700","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal"},
		{"font_family":"Oleo Script","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},
		{"font_family":"Open Sans","font_styles":"300,300italic,regular,italic,600,600italic,700,700italic,800,800italic","font_types":"300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,600 bold regular:600:normal,600 bold italic:600:italic,700 bold regular:700:normal,700 bold italic:700:italic,800 bold regular:800:normal,800 bold italic:800:italic"},
		{"font_family":"Open Sans Condensed","font_styles":"300,300italic,700","font_types":"300 light regular:300:normal,300 light italic:300:italic,700 bold regular:700:normal"},
		{"font_family":"Orbitron","font_styles":"regular,500,700,900","font_types":"400 regular:400:normal,500 bold regular:500:normal,700 bold regular:700:normal,900 bold regular:900:normal"},
		{"font_family":"Oswald","font_styles":"300,regular,700","font_types":"300 light regular:300:normal,400 regular:400:normal,700 bold regular:700:normal"},
		{"font_family":"Oxygen","font_styles":"300,regular,700","font_types":"300 light regular:300:normal,400 regular:400:normal,700 bold regular:700:normal"},
		{"font_family":"PT Sans","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},
		{"font_family":"PT Serif","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},
		{"font_family":"Pacifico","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Permanent Marker","font_styles":"regular","font_types":"400 regular:400:normal"},
		{"font_family":"Philosopher","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},
		{"font_family":"Pinyon Script","font_styles":"regular","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},
		{"font_family":"Poppins","font_styles":"regular","font_types":" 300 light regular:300:normal,400 regular:400:normal,500 regular:500:normal,600 bold regular:600:normal,700 bold regular:700:normal"},
		{"font_family":"Playfair Display","font_styles":"regular,italic,700,700italic,900,900italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic,900 bold regular:900:normal,900 bold italic:900:italic"},
		{"font_family":"Radley","font_styles":"regular,italic","font_types":"400 regular:400:normal,400 italic:400:italic"},
		{"font_family":"Rajdhani","font_styles":"300,regular,500,600,700","font_types":"300 light regular:300:normal,400 regular:400:normal,500 medium regular:500:normal,600 semi-bold regular:600:normal,700 bold regular:700:normal"},
		{"font_family":"Raleway","font_styles":"100,200,300,regular,500,600,700,800,900","font_types":"100 light regular:100:normal,200 light regular:200:normal,300 light regular:300:normal,400 regular:400:normal,500 bold regular:500:normal,600 bold regular:600:normal,700 bold regular:700:normal,800 bold regular:800:normal,900 bold regular:900:normal"},
		{"font_family":"Roboto","font_styles":"100,100italic,300,300italic,regular,italic,500,500italic,700,700italic,900,900italic","font_types":"100 light regular:100:normal,100 light italic:100:italic,300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,500 bold regular:500:normal,500 bold italic:500:italic,700 bold regular:700:normal,700 bold italic:700:italic,900 bold regular:900:normal,900 bold italic:900:italic"},
		{"font_family":"Roboto Condensed","font_styles":"300,300italic,regular,italic,700,700italic","font_types":"300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},
		{"font_family":"Roboto Slab","font_styles":"100,300,regular,700","font_types":"100 light regular:100:normal,300 light regular:300:normal,400 regular:400:normal,700 bold regular:700:normal"},
		{"font_family":"Satisfy","font_styles":"regular","font_types":"400 regular:400:normal"},
		{"font_family":"Signika","font_styles":"300,regular,600,700","font_types":"300 light regular:300:normal,400 regular:400:normal,600 bold regular:600:normal,700 bold regular:700:normal"},
		{"font_family":"Source Code Pro","font_styles":"200,300,regular,500,600,700,900","font_types":"200 light regular:200:normal,300 light regular:300:normal,400 regular:400:normal,500 bold regular:500:normal,600 bold regular:600:normal,700 bold regular:700:normal,900 bold regular:900:normal"},
		{"font_family":"Space Mono","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},
		{"font_family":"Ubuntu","font_styles":"300,300italic,regular,italic,500,500italic,700,700italic","font_types":"300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,500 bold regular:500:normal,500 bold italic:500:italic,700 bold regular:700:normal,700 bold italic:700:italic"},
		{"font_family":"Ubuntu Mono","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},
		{"font_family":"Vollkorn","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},
		{"font_family":"Yeseva One","font_styles":"regular","font_types":"400 regular:400:normal"}]';
	
	return json_decode( $fonts_list );
}

add_filter( 'vc_google_fonts_get_fonts_filter', 'rella_custom_google_fonts' );