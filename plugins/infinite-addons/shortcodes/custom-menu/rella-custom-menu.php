<?php
/**
* Shortcode Custom Menu
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Custom_Menu extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_custom_menu';
		$this->title       = esc_html__( 'Custom Menu', 'infinite-addons' );
		$this->icon        = 'fa fa-star';
		$this->description = esc_html__( 'Add one of your custom menus.', 'infinite-addons' );
		$this->styles      = array( 'rella-sc-button' );

		parent::__construct();

	}

	public function get_params() {

		$url = rella_addons()->plugin_uri() . '/assets/img/sc-preview/custom-menu/';

		$advanced = array(
			array(
				'type'        => 'rella_advanced_checkbox',
				'param_name'  => 'adv_opts',
				'value'       =>  array( esc_html__( 'Simple Mode', 'infinite-addons' ) => 'true' ),
				'std'         => '',
			)
		);

		$button = vc_map_integrate_shortcode( 'ra_button', 'cm_', esc_html__( 'Button', 'infinite-addons' ),
			array(
				'exclude' => array(
					'primary_color',
					'el_id',
					'el_class'
				)
			),
			array(
				'element' => 'show_button',
				'value'   => 'yes',
			)
		);

		$design = array(

			array(
				'type'       => 'colorpicker',
				'param_name' => 'color',
				'heading'    => esc_html__( 'Color', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_column-with-padding  vc_col-sm-6',
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'h_color',
				'heading'    => esc_html__( 'Hover Color', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Use theme default font family?', 'infinite-addons' ),
				'param_name'  => 'use_theme_fonts',
				'value'       => array(
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes'
				),
				'description' => esc_html__( 'Use font family from the theme.', 'infinite-addons' ),
				'std'         => 'yes',
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
			),

			array(
				'type'        => 'google_fonts',
				'param_name'  => 'menu_font',
				'value'       => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
				'settings'    => array(
					'fields'  => array(
						'font_family_description' => esc_html__( 'Select font family.', 'infinite-addons' ),
						'font_style_description'  => esc_html__( 'Select font styling.', 'infinite-addons' ),
					),
				),
				'dependency'  => array(
					'element'            => 'use_theme_fonts',
					'value_not_equal_to' => 'yes',
				),
			),

			array(
				'type'             => 'textfield',
				'param_name'       => 'f_size',
				'heading'          => esc_html__( 'Font size', 'infinite-addons' ),
				'description'      => esc_html__( 'Font size for custom menu', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-3',
			),

			array(
				'type'             => 'dropdown',
				'param_name'       => 't_transform',
				'heading'          => esc_html__( 'Text transform', 'infinite-addons' ),
				'description'      => esc_html__( 'Text transform for custom menu', 'infinite-addons' ),
				'value' => array(
					esc_html__( 'None', 'infinite-addons' )       => '',
					esc_html__( 'Capitalize', 'infinite-addons' ) => 'capitalize',
					esc_html__( 'Uppercase', 'infinite-addons' )  => 'uppercase',
					esc_html__( 'Lowercase', 'infinite-addons' )  => 'lowercase',
					esc_html__( 'Inherit', 'infinite-addons' )    => 'inherit',
				),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-3',
			),

			array(
				'type'             => 'textfield',
				'param_name'       => 'l_height',
				'heading'          => esc_html__( 'Line height', 'infinite-addons' ),
				'description'      => esc_html__( 'Line height for custom menu', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-3',
			),

			array(
				'type'             => 'textfield',
				'param_name'       => 'l_spacing',
				'heading'          => esc_html__( 'Letter spacing', 'infinite-addons' ),
				'description'      => esc_html__( 'Letter spacing for custom menu', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-3',
			),

		);

		foreach( $design as &$param ) {
			$param['group'] = esc_html__( 'Design Options', 'infinite-addons' );
		}

		$button = array_merge( array(

			array(
				'type'       => 'colorpicker',
				'param_name' => 'primary_color',
				'heading'    => esc_html__( 'Primary Color', 'infinite-addons' ),
				'group'      => esc_html__( 'Button: Design Options', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'show_button',
					'value'   => 'yes',
				),
			),

		), $button );

		$this->params = array_merge(
			$advanced,
			array(

				array(
					'type'        => 'select_preview',
					'param_name'  => 'style',
					'heading'     => esc_html__( 'Style', 'infinite-addons' ),
					'description' => esc_html__( 'Select the style you want to use.', 'infinite-addons' ),
					'value' => array(

						array(
							'value' => 'default',
							'label' => esc_html__( 'Default', 'infinite-addons' ),
							'image' => $url . 'default.png'
						),

						array(
							'label' => esc_html__( '2 Columns', 'infinite-addons' ),
							'value' => 'col2',
							'image' => $url . 'two-columns.png'
						),

						array(
							'label' => esc_html__( 'Dropdown', 'infinite-addons' ),
							'value' => 'dropdown',
							'image' => $url . 'dropdown.png'
						),

						array(
							'label' => esc_html__( 'Inline', 'infinite-addons' ),
							'value' => 'inline',
							'image' => $url . 'inline.png'
						),

						array(
							'label' => esc_html__( 'Underline', 'infinite-addons' ),
							'value' => 'underline',
							'image' => $url . 'underlined.png'
						),
						array(
							'label' => esc_html__( 'Underline 2', 'infinite-addons' ),
							'value' => 'underline2',
							'image' => $url . 'underlined-2.png'
						)
					),
					'save_always' => true,
				),

				array(
					'id' => 'title',
					'edit_field_class' => 'vc_col-sm-6'
				),

				array(
					'type'        => 'dropdown',
					'param_name'  => 'menu_slug',
					'heading'     => esc_html__( 'Menu', 'infinite-addons' ),
					'description' => esc_html__( 'Select the menu you want to use.', 'infinite-addons' ),
					'value'        => ra_helper()->get_terms_data_for_vc('nav_menu'),
					'edit_field_class' => 'vc_col-sm-6'
				),

				array(
					'type'       => 'dropdown',
					'param_name' => 'show_button',
					'heading'    => esc_html__( 'Show Button', 'infinite-addons' ),
					'value'      => array(
						esc_html__( 'No', 'infinite-addons' )  => '',
						esc_html__( 'Yes', 'infinite-addons' ) => 'yes',
					),
					'dependency' => array(
						'element' => 'adv_opts',
						'is_empty' => true,
					),
				),

			),

			rella_get_icon_params( false, '', 'all', array( 'color' ), 'i_', array( 'element' => 'adv_opts', 'is_empty' => true ) ),
			$design,
			$button
		);

		$this->add_extras();
	}

	protected function get_nav() {

		$style   = $this->atts['style'];
		$menu_slug = $this->atts['menu_slug'];

		if( !is_nav_menu( $menu_slug ) ) {
			$menu_slug = '';
		}

		// Arguments
		$defaults = array(
			'menu'            => $menu_slug,
			'container_class' => 'widget widget_nav_menu',
			'link_before'     => '<span>',
			'link_after'      => '</span>',
			'walker'          => class_exists( 'Rella_Mega_Menu_Walker' ) ? new Rella_Mega_Menu_Walker : ''
		);

		if( 'inline' === $style ) {
			$args = array(
				'menu_class'      => 'widget_nav_menu',
				'container_class' => 'widget widget_nav_menu widget_inline_nav'
			);
		}
		elseif( 'col2' === $style ) {
			$args = array(
				'menu_class'      => 'widget widget_nav_menu list-inline columns2',
				'container_class' => 'widget_nav_menu'
			);
		}
		elseif( 'underline' === $style ) {
			$args = array(
				'menu_class'      => 'widget_nav_menu',
				'container_class' => 'widget widget_nav_menu widget_inline_nav underlined'
			);
		}
		elseif( 'underline2' === $style ) {
			$args = array(
				'menu_class' => 'menu-inline text-white lg skewed-underline',
				'container'  => false,
			);
		}
		elseif( 'dropdown' === $style ) {
			$args = array(
				'menu_class'      => 'dropdown-list',
				'container_class' => 'module-container'
			);
		}
		else {
			$args = array(
				'container_class' => false,
				'link_before'     => '<span class="link-txt">',
				'link_after'      => '</span>',
			);
		}

		wp_nav_menu( wp_parse_args( $args, $defaults ) );
	}

	protected function get_button() {

		if ( empty( $this->atts['show_button'] ) ) {
			return;
		}

		$data = vc_map_integrate_parse_atts( $this->slug, 'ra_button', $this->atts, 'cm_' );
		if ( $data ) {

			if( ! empty( $this->atts['primary_color'] ) ) {
				$data['primary_color'] = $this->atts['primary_color'];
			}

			$btn = visual_composer()->getShortCode( 'ra_button' )->shortcodeClass();

			if ( is_object( $btn ) ) {
				echo $btn->render( array_filter( $data ) );
				unset( $btn->parent_selector );
			}
		}
	}

	protected function generate_css() {

		extract( $this->atts );

		$elements = array();

		$id = '.' . $this->get_id();

		$menu_font_inline_style = '';

		if( 'yes' !== $use_theme_fonts ) {

			// Build the data array
			$menu_font_data = $this->get_fonts_data( $menu_font );

			// Build the inline style
			$menu_font_inline_style = $this->google_fonts_style( $menu_font_data );

			// Enqueue the right font
			$this->enqueue_google_fonts( $menu_font_data );

		}

		if( $primary_color ) {
			$elements[rella_implode( array( '%1$s .module-trigger', '%1$s .skewed-underline li a:before', '%1$s .skewed-underline li a:after' ) )] = array(
				'color' => $primary_color
			);
		}

		if( 'underline2' === $style && ! empty( $color ) ) {
			$elements[rella_implode( array( '%1$s .skewed-underline li a:before', '%1$s .skewed-underline li a:after' ) )] = array(
				'background-color' => $color
			);
		}

		$elements[rella_implode( array( '.main-header .custom-menu%1$s li a', '.custom-menu%1$s li a', '.custom-menu%1$s .module-trigger' ) )] = array(
			$menu_font_inline_style,
			'color'          => $color,
			'font-size'      => $f_size,
			'text-transform' => $t_transform,
			'line-height'    => $l_height,
			'letter-spacing' => $l_spacing
		);

		$elements[rella_implode( array( '.main-header .custom-menu%1$s li a:hover', '.custom-menu%1$s li a:hover', '.main-header .custom-menu%1$s li.current_page_item a', '.custom-menu%1$s li.current_page_item a', '.main-header .custom-menu%1$s li.current-menu-item a', '.custom-menu%1$s li.current-menu-item a' ) )]['color'] = $h_color;



		$this->dynamic_css_parser( $id, $elements );
	}
}
new RA_Custom_Menu;
