<?php
/**
* Shortcode Header Nav
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Header_Nav extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_header_main_nav';
		$this->title       = esc_html__( 'Header Nav', 'infinite-addons' );
		$this->description = esc_html__( 'Header Navigation', 'infinite-addons' );
		$this->icon        = 'fa fa-star';
		$this->category    = esc_html__( 'Header', 'infinite-addons' );
		parent::__construct();
	}

	public function get_params() {

		$this->params = array(

			array(
				'type'        => 'dropdown',
				'param_name'  => 'menu_slug',
				'heading'     => esc_html__( 'Menu', 'infinite-addons' ),
				'description' => esc_html__( 'Select the menu you want to use.', 'infinite-addons' ),
				'value' => ra_helper()->get_terms_data_for_vc('nav_menu'),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'second_menu_slug',
				'heading'     => esc_html__( 'Second Menu', 'infinite-addons' ),
				'description' => esc_html__( 'Select the second menu you want to use.', 'infinite-addons' ),
				'value' => ra_helper()->get_terms_data_for_vc('nav_menu'),
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 'dm' )
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'style',
				'heading'    => esc_html__( 'Style', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Default', 'infinite-addons' )                  => '',
					esc_html__( 'Doubled menu', 'infinite-addons' )             => 'dm',
					esc_html__( 'Line Above', 'infinite-addons' )               => 's3',
					esc_html__( 'Line Above with Seprator', 'infinite-addons' ) => 's7',
					esc_html__( 'With Vertical Line', 'infinite-addons' )       => 's8',
					esc_html__( 'One Page', 'infinite-addons' )                 => 'onepage',
					esc_html__( 'Underlined', 'infinite-addons' )               => 's1',
					esc_html__( 'Fullscreen 1', 'infinite-addons' )             => 'fs1',
					esc_html__( 'Fullscreen 2', 'infinite-addons' )             => 'fs2',
					esc_html__( 'Fullscreen 3', 'infinite-addons' )             => 'fs3',
					esc_html__( 'Fullscreen 4', 'infinite-addons' )             => 'fs4',
					esc_html__( 'Fullscreen 5', 'infinite-addons' )             => 'fs5',
					esc_html__( 'Fullscreen 6', 'infinite-addons' )             => 'fs6',
					esc_html__( 'Fullscreen 7', 'infinite-addons' )             => 'fs7',
					esc_html__( 'Off Canvas', 'infinite-addons' )               => 'off-canvas',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'logo_visibility',
				'heading'    => esc_html__( 'Logo Visibility', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Show', 'infinite-addons' ) => '',
					esc_html__( 'Hide', 'infinite-addons' ) => 'hide'
				),
			),

			array(
				'type'        => 'attach_image',
				'param_name'  => 'logo',
				'heading'     => esc_html__( 'Logo', 'infinite-addons' ),
				'description' => esc_html__( 'If you want to use other logo beside uploaded in theme option.', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'attach_image',
				'param_name'  => 'retina_logo',
				'heading'     => esc_html__( 'Retina Logo', 'infinite-addons' ),
				'description' => esc_html__( 'If you want to use other retina logo beside uploaded in theme option.', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'fs_menu_title',
				'heading'     => esc_html__( 'Trigger Title', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 'fs1', 'fs2', 'fs3', 'fs4', 'fs5', 'fs6', 'fs7' )
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'id'          => 'link',
				'description' => esc_html__( 'If you want to use other link beside home url.', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'caret_visibility',
				'heading'    => esc_html__( 'Caret Visibility', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Hide', 'infinite-addons' ) => '',
					esc_html__( 'Show', 'infinite-addons' ) => 'show'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'local_scroll',
				'heading'     => esc_html__( 'One Page menu', 'infinite-addons' ),
				'description' => esc_html__( 'Select YES to make menu local scroll, works for one page website', 'infinite-addons' ),
				'value'       => array(
					esc_html__( 'No', 'infinite-addons' ) => '',
					esc_html__( 'Yes', 'infinite-addons' ) => 'true'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'add_divider',
				'heading'    => esc_html__( 'Add Divider', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'No', 'infinite-addons' )  => '',
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'attach_image',
				'param_name'  => 'nav_bg',
				'heading'     => esc_html__( 'Nav background', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 'fs1', 'fs2', 'fs3', 'fs4', 'fs5', 'fs6', 'fs7' )
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'nav_bg_color',
				'heading'     => esc_html__( 'Nav background color', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 'fs1', 'fs2', 'fs3', 'fs4', 'fs5', 'fs6', 'fs7' )
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'border_color',
				'heading'     => esc_html__( 'Border color', 'infinite-addons' ),
				'description' => esc_html__( 'Pick a color for the border', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'style',
					'value' => array( 's8' )
				)
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'ns_color',
				'heading'     => esc_html__( 'Trigger color', 'infinite-addons' ),
				'description' => esc_html__( 'Pick a color for normal state of the trigger', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 'fs1', 'fs2', 'fs3', 'fs4', 'fs5', 'fs6', 'fs7' )
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'as_color',
				'heading'     => esc_html__( 'Trigger active color', 'infinite-addons' ),
				'description' => esc_html__( 'Pick a color for active state of the trigger', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 'fs1', 'fs2', 'fs3', 'fs4', 'fs5', 'fs6', 'fs7' )
				),
				'edit_field_class' => 'vc_col-sm-6'
			),


		);

		$this->add_extras();
	}

	public function get_style( $id ) {

		$hash = array(
			's1' => 'underlined weight-light',
			's2' => 'text-uppercase weight-semibold',
			's3' => 'text-uppercase line-above',
			's4' => 'weight-bold',
			's5' => 'text-uppercase weight-bold',
			's6' => 'text-uppercase',
			's7' => 'text-uppercase line-above nav-with-sep weight-medium',
			's8' => 'v-line text-uppercase weight-semibold'
		);

		return isset( $hash[$id] ) ? ' ' . $hash[$id] : '';
	}

	protected function get_logo() {

		$logo = $this->atts['logo'];
		$retina_logo = $this->atts['retina_logo'];

		$alt = get_bloginfo( 'title' );
		$img = get_template_directory_uri() . '/assets/img/logo54.png';
		$retina_img = get_template_directory_uri() . '/assets/img/logo@2x.png';

		if( $logo ) {
			$img = rella_get_image( $logo, 'full' );
		} else {
			$img_array = rella_helper()->get_option( 'header-logo' );
			if( is_array( $img_array ) && ! empty( $img_array['url'] ) ) {
				$img = esc_url( $img_array['url'] );
			}
		}

		if( ! $logo ) {
			$retina_img_arr = rella_helper()->get_option( 'header-logo-retina' );
			if( is_array( $retina_img_arr ) && ! empty( $retina_img_arr['url'] ) ) {
				$retina_img = esc_url( $retina_img_arr['url'] );
			} else {
				$retina_img = $img;
			}
		} else {
			if( $retina_logo ) {
				$retina_img = rella_get_image( $retina_logo, 'full' );
			} else {
				$retina_img = $img;
			}
		}

		printf( '<img src="%s" data-rjs="%s" alt="%s"/>', $img, $retina_img, esc_attr( $alt ) );

	}

	protected function get_sticky_logo() {

		$logo = $retina_logo = '';

		$logo_arr = rella_helper()->get_option( 'sticky-header-logo' );
		$logo_retina_arr = rella_helper()->get_option( 'sticky-header-logo-retina' );

		$alt = get_bloginfo( 'title' );

		if( is_array( $logo_arr ) && ! empty( $logo_arr['url'] ) ) {
			$logo = esc_url( $logo_arr['url'] );
		}

		if( is_array( $logo_retina_arr ) && ! empty( $logo_retina_arr['url'] ) ) {
			$retina_logo = esc_url( $logo_retina_arr['url'] );
		}

		if( empty( $logo ) ) {
			return;
		}

		if( $retina_logo ) {
			$retina_img = $retina_logo;
		} else {
			$retina_img = $this->get_retina( $logo );
		}

		printf( '<img class="sticky-logo" src="%s" data-rjs="%s" alt="%s"/>', $logo, $retina_img, esc_attr( $alt ) );

	}

	protected function get_sticky_light_logo() {

		$logo = $retina_logo = '';

		$logo_arr = rella_helper()->get_option( 'sticky-header-logo-light' );
		$logo_retina_arr = rella_helper()->get_option( 'sticky-header-logo-retina-light' );

		$alt = get_bloginfo( 'title' );

		if( is_array( $logo_arr ) && ! empty( $logo_arr['url'] ) ) {
			$logo = esc_url( $logo_arr['url'] );
		}

		if( is_array( $logo_retina_arr ) && ! empty( $logo_retina_arr['url'] ) ) {
			$retina_logo = esc_url( $logo_retina_arr['url'] );
		}

		if( empty( $logo ) ) {
			return;
		}

		if( $retina_logo ) {
			$retina_img = $retina_logo;
		} else {
			$retina_img = $this->get_retina( $logo );
		}

		printf( '<img class="sticky-light-logo" src="%s" data-rjs="%s" alt="%s"/>', $logo, $retina_img, esc_attr( $alt ) );

	}

	protected function get_light_logo() {

		$logo = $retina_logo = '';

		$logo_arr = rella_helper()->get_option( 'header-logo-light' );
		$logo_retina_arr = rella_helper()->get_option( 'header-logo-retina-light' );

		$alt = get_bloginfo( 'title' );

		if( is_array( $logo_arr ) && ! empty( $logo_arr['url'] ) ) {
			$logo = esc_url( $logo_arr['url'] );
		}

		if( is_array( $logo_retina_arr ) && ! empty( $logo_retina_arr['url'] ) ) {
			$retina_logo = esc_url( $logo_retina_arr['url'] );
		}

		if( empty( $logo ) ) {
			return;
		}

		if( $retina_logo ) {
			$retina_img = $retina_logo;
		} else {
			$retina_img = $this->get_retina( $logo );
		}


		printf( '<img class="logo-light" src="%s" data-rjs="%s" alt="%s"/>', $logo, $retina_img, esc_attr( $alt ) );

	}

	protected function get_mobile_logo() {

		$logo       = $this->atts['logo'];
		$alt        = get_bloginfo( 'title' );
		$mobile_img = $logo ? rella_get_image( $logo, 'full' ) : get_template_directory_uri() . '/assets/img/logo54.png';

		$mobile_img_arr = rella_helper()->get_option( 'menu-logo' );
		if( is_array( $mobile_img_arr ) && ! empty( $mobile_img_arr['url'] ) ) {
			$mobile_img = esc_url( $mobile_img_arr['url'] );
		}
		else {
			$mobile_img_arr = rella_helper()->get_option( 'header-logo' );
			if( is_array( $mobile_img_arr ) && ! empty( $mobile_img_arr['url'] ) ) {
				$mobile_img = esc_url( $mobile_img_arr['url'] );
			}
		}

		$retina_img_arr = rella_helper()->get_option( 'menu-logo-retina' );
		if( ! empty( $retina_img_arr['url'] ) ) {
			$retina_img = esc_url( $retina_img_arr['url'] );
		} else {
			$retina_img = $mobile_img;
		}

		printf( '<img src="%s" data-rjs="%s" alt="%s"/>', $mobile_img, $retina_img, esc_attr( $alt ) );

	}

	protected function get_retina( $logo ) {

		if( ! function_exists( 'rella_get_retina_image' ) ) {
			return $logo;
		}

		$retina = rella_get_retina_image( $logo );

		return $retina;
	}

	public function generate_css( $header ) {

		extract( $header );

		$elements = array();
		$out = '';
		$id = '.' .$this->get_id();

		$padding = empty( $padding ) ? array() : $padding;
		unset( $padding['units'] );

		$logo_padding = empty( $logo_padding ) ? array() : $logo_padding;
		unset( $logo_padding['units'] );

		$typography = empty( $typography ) ? array() : $typography;
		unset( $typography['google'] );

		$child_typography = empty( $child_typography ) ? array() : $child_typography;
		unset( $child_typography['google'] );

		$mobile_typography = empty( $mobile_typography ) ? array() : $mobile_typography;
		unset( $mobile_typography['google'] );

		$child_mobile_typography = empty( $child_mobile_typography ) ? array() : $child_mobile_typography;
		unset( $child_mobile_typography['google'] );

		if( in_array( $this->atts['style'], array( 'fs1', 'fs2', 'fs3', 'fs4', 'fs5', 'fs6', 'fs7' ) ) ) {
			$elements['.main-nav li, .main-header .modules-fullscreen .navbar-collapse>.container>.nav-item-children li, .main-header .modules-fullscreen .navbar-collapse .main-nav-container>.nav-item-children li, .modules-fullscreen .main-nav li'] = array_merge( $padding, $typography );
			$elements['.main-header .modules-fullscreen .navbar-collapse >.container>.nav-item-children li, .main-header .modules-fullscreen .navbar-collapse .main-nav-container>.nav-item-children li, .nav-item-children > li, .nav-item-children .menu-item'] = $child_typography;
			$elements['.main-header.mobile .main-nav li, #mobile-nav .main-nav > li'] = $mobile_typography;
			$elements['.main-header.mobile .nav-item-children > li, #mobile-nav .nav-item-children > li'] = $child_mobile_typography;
			$elements[rella_implode( '.nav-item-children li a,.modules-fullscreen .main-nav li a, .nav-item-children li a:focus,.modules-fullscreen .main-nav li a:focus' )]['color'] = isset( $color['rgba'] ) ? $color['rgba'] : '';
			$elements[rella_implode( '.nav-item-children li.current-menu-item > a,.modules-fullscreen .main-nav li.current-menu-item > a,.nav-item-children li:hover > a,.modules-fullscreen .main-nav li:hover > a' )]['color'] = isset( $active_color['rgba'] ) ? $active_color['rgba'] : '';
			$elements[rella_implode( '.nav-item-children li a > .link-txt:after,.main-nav li a > .link-txt:after,.main-nav > li > a > .link-txt:after' )]['background-color'] = isset( $secondary_color['rgba'] ) ? $secondary_color['rgba'] : '';

			if( $this->atts['nav_bg'] ) {
				$img = rella_get_image( $this->atts['nav_bg'], 'full' );
				if( is_array( $img ) && !empty( $img['url'] ) ) {
					$img = esc_url( $img['url'] );
				}
				$elements[rella_implode( '.navbar-collapse' )]['background-image'] = "url($img)";
			}
			if( $this->atts['nav_bg_color'] ) {
				$elements[rella_implode( '.main-bar-container .navbar-collapse' )]['background-color'] = esc_attr( $this->atts['nav_bg_color'] );
			}
		}
		else {
			$elements['.main-nav > li'] = array_merge( $padding, $typography );
			$elements['.nav-item-children > li, .nav-item-children .menu-item'] = $child_typography;
			$elements['.main-header.mobile .main-nav li, #mobile-nav .main-nav > li'] = $mobile_typography;
			$elements['.main-header.mobile .nav-item-children > li, #mobile-nav .nav-item-children > li'] = $child_mobile_typography;
			$elements[rella_implode( '.navbar-default .main-nav > li > a, .navbar-default .main-nav > li > a:focus' )]['color'] = isset( $color['rgba'] ) ? $color['rgba'] : '';
			$elements[rella_implode( '.navbar-default .main-nav > li > a > .link-icon svg' )]['fill'] = isset( $color['rgba'] ) ? $color['rgba'] : '';
			$elements[rella_implode( '.navbar-default .main-nav > li > a > .link-icon svg' )]['stroke'] = isset( $color['rgba'] ) ? $color['rgba'] : '';
			$elements[rella_implode( '.navbar-default .main-nav > li > a > i' )]['color'] = isset( $secondary_color['rgba'] ) ? $secondary_color['rgba'] : '';
			$elements[rella_implode( '.navbar-default .main-bar-container .main-nav > li > a:after,.navbar-default .main-bar-container .main-nav > li > a > .link-txt:after' )]['background-color'] = isset( $secondary_color['rgba'] ) ? $secondary_color['rgba'] : '';
			$elements[rella_implode( '.navbar-default .main-nav > li > a:hover,.navbar-default .main-nav > li.current-menu-item > a,.navbar-default .main-nav > li.active > a' )]['color'] = isset( $active_color['rgba'] ) ? $active_color['rgba'] : '';
			$elements[rella_implode( '.navbar-default .main-nav > li > a:hover > .link-icon svg, .navbar-default .main-nav > li.active > a > .link-icon svg, .navbar-default .main-nav > li.current-menu-item > a > .link-icon svg, .navbar-default .main-nav > li.current_page_item > a > .link-icon svg' )]['fill'] = isset( $active_color['rgba'] ) ? $active_color['rgba'] : '';
			$elements[rella_implode( '.navbar-default .main-nav > li > a:hover > .link-icon svg, .navbar-default .main-nav > li.active > a > .link-icon svg, .navbar-default .main-nav > li.current-menu-item > a > .link-icon svg, .navbar-default .main-nav > li.current_page_item > a > .link-icon svg' )]['stroke'] = isset( $active_color['rgba'] ) ? $active_color['rgba'] : '';
			$elements[rella_implode( '.navbar-default .main-nav > li mark.style2' )]['background-color'] = isset( $active_color['rgba'] ) ? $active_color['rgba'] : '';
			$elements[rella_implode( '.navbar-default .main-nav > li mark.style2:before' )]['border-top-color'] = isset( $active_color['rgba'] ) ? $active_color['rgba'] : '';
		}

		$elements[rella_implode( '.navbar-brand' )] = $logo_padding;

		if( ! empty( $padding['padding-top'] ) ) {
			$elements[rella_implode( '.main-bar-container .main-nav.line-above > li > a:after' )]['margin-top'] = '-' . $padding['padding-top'];
		}

		if( ! empty( $this->atts['border_color'] ) ) {
			$elements[ rella_implode( '.main-nav.v-line > li' ) ]['border-color'] = esc_attr( $this->atts['border_color'] ) . ' !important';
		}

		if( ! empty( $this->atts['ns_color'] ) ) {
			$elements[ rella_implode( '.header-module.module-nav-trigger .bars span, .header-module.module-nav-trigger .bars:before, .header-module.module-nav-trigger .bars:after, .header-module.module-nav-trigger .bars span:before, .header-module.module-nav-trigger .bars span:after' ) ]['background-color'] = esc_attr( $this->atts['ns_color'] . ' !important' );
		}

		if( ! empty( $this->atts['as_color'] ) ) {
			$elements[ rella_implode( '.header-module.module-nav-trigger.module-container-is-showing .bars span, .header-module.module-nav-trigger.module-container-is-showing .bars:before, .header-module.module-nav-trigger.module-container-is-showing .bars:after, .header-module.module-nav-trigger.module-container-is-showing .bars span:before, .header-module.module-nav-trigger.module-container-is-showing .bars span:after' ) ]['background-color'] = esc_attr( $this->atts['as_color'] . ' !important' );
		}

		if( isset( $color['rgba'] ) ){
			$elements[ rella_implode( '.main-header .main-bar-container .social-icon li a, .main-header .main-bar-container .module-cart .module-trigger,.main-header .main-bar-container .module-wishlist .module-trigger,.main-header .main-bar-container .module-search-form > .module-trigger' ) ]['color'] = $color['rgba'];
		}

		if( isset( $secondary_color['rgba'] ) ){
			$elements[ rella_implode( '.main-header .main-bar-container .social-icon li a:hover' ) ]['color'] = $secondary_color['rgba'];
		}

		$this->dynamic_css_parser( '', $elements );
	}
}
new RA_Header_Nav;
