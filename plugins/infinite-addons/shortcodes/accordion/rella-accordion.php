<?php
/**
* Shortcode Accordion
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Accordions extends RA_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug          = 'vc_accordion';
		$this->title         = esc_html__( 'Accordion', 'infinite-addons' );
		$this->icon          = 'fa fa-plus-circle';
		$this->description   = esc_html__( 'Create an accordion.', 'infinite-addons' );
		$this->styles        = array( 'rella-sc-accordion' );
		$this->is_container  = true;
		$this->show_settings_on_create = false;
		$this->js_view       = 'VcAccordionView';
		$this->custom_markup = '<div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">%content%</div><div class="tab_controls"><a class="add_tab" title="Add section"><span class="vc_icon"></span> <span class="tab-label">Add section</span></a></div>';
		$this->default_content = '
			[vc_accordion_tab title="' . sprintf( '%s %d', 'Section', 1 ) . '"][/vc_accordion_tab]
			[vc_accordion_tab title="' . sprintf( '%s %d', 'Section', 2 ) . '"][/vc_accordion_tab]';

		parent::__construct();
	}

	/**
	 * Get params
	 * @return array
	 */
	public function get_params() {

		$url = rella_addons()->plugin_uri() . '/assets/img/sc-preview/accordion/';

		$this->params = array_merge(
			array(

				array(
					'type'        => 'select_preview',
					'param_name'  => 'style',
					'heading'     => esc_html__( 'Style', 'infinite-addons' ),
					'value'       => array(

						array(
							'value' => 'default',
							'label' => esc_html__( 'Default', 'infinite-addons' ),
							'image' => $url . 'default.png'
						),

						array(
							'label' => esc_html__( 'Big Square', 'infinite-addons' ),
							'value' => 'big-square',
							'image' => $url . 'big-square.png'
						),

						array(
							'label' => esc_html__( 'Boxed', 'infinite-addons' ),
							'value' => 'boxed',
							'image' => $url . 'boxed.png'
						),

						array(
							'label' => esc_html__( 'Boxed Shadow', 'infinite-addons' ),
							'value' => 'shadow',
							'image' => $url . 'boxed-shadow.png'
						),

						array(
							'label' => esc_html__( 'Expanded', 'infinite-addons' ),
							'value' => 'expanded',
							'image' => $url . 'expanded.png'
						),

						array(
							'label' => esc_html__( 'Facebook', 'infinite-addons' ),
							'value' => 'facebook',
							'image' => $url . 'facebook.png'
						),

						array(
							'label' => esc_html__( 'Highlighted', 'infinite-addons' ),
							'value' => 'highlight',
							'image' => $url . 'highlighted.png'
						),

						array(
							'label' => esc_html__( 'Minimal', 'infinite-addons' ),
							'value' => 'minimal',
							'image' => $url . 'minimal.png'
						),

						array(
							'label' => esc_html__( 'Minimal Inverted', 'infinite-addons' ),
							'value' => 'minimal-inverted',
							'image' => $url . 'minimal-inverted.png'
						),

						array(
							'label' => esc_html__( 'Square', 'infinite-addons' ),
							'value' => 'square',
							'image' => $url . 'square.png'
						),

						array(
							'label' => esc_html__( 'Square2', 'infinite-addons' ),
							'value' => 'square-hfiller',
							'image' => $url . 'square-hfiller.png'
						),

						array(
							'label' => esc_html__( 'Square Inverted', 'infinite-addons' ),
							'value' => 'square-inverted',
							'image' => $url . 'square-inverted.png'
						),

						array(
							'label' => esc_html__( 'Square Inverted 2', 'infinite-addons' ),
							'value' => 'square-hfiller-inverted',
							'image' => $url . 'square-hfiller-inverted.png'
						),

						array(
							'label' => esc_html__( 'Minimal Alt', 'infinite-addons' ),
							'value' => 'minimal-alt',
							'image' => $url . 'minimal-alt.png'
						),

						array(
							'label' => esc_html__( 'Underline', 'infinite-addons' ),
							'value' => 'underline',
							'image' => $url . 'underline.png'
						),
					),
					'save_always' => true,
				),

				array(
					'type'        => 'dropdown',
					'param_name'  => 'alignment',
					'heading'     => esc_html__( 'Alignment', 'infinite-addons' ),
					'value'       => array(
						esc_html__( 'Left', 'infinite-addons' )  => 'accordion-left',
						esc_html__( 'Right', 'infinite-addons' ) => 'accordion-right'
					),
					'edit_field_class' => 'vc_col-sm-6'
				),

				array(
					'type'        => 'textfield',
					'param_name'  => 'active_tab',
					'heading'     => esc_html__( 'Active tab', 'infinite-addons' ),
					'edit_field_class' => 'vc_col-sm-6'
				),

				array(
					'type'        => 'checkbox',
					'param_name'  => 'show_icon',
					'heading'     => esc_html__( 'Icons?', 'infinite-addons' ),
					'description' => esc_html__( 'If enabled will show icons in expander', 'infinite-addons' ),
					'group'       => esc_html__( 'Icon', 'infinite-addons' ),
					'value'       => array( esc_html__( ' Yes', 'infinite-addons' ) => 'yes' ),
					'std'         => 'yes',
				),

				array(
					'type'       => 'checkbox',
					'param_name' => 'i_add_icon',
					'heading'    => esc_html__( 'Add inactive icon?', 'infinite-addons' ),
					'group'      => esc_html__( 'Icon', 'infinite-addons' ),
					'value'      => '',
					'dependency' => array(
						'element' => 'show_icon',
						'value'   => 'yes'
					),
				),
			),

			rella_get_icon_params( 'manual', esc_html__( 'Icon', 'infinite-addons' ), 'all', array( 'align', 'color' ) ),

			array(

				array(
					'type'       => 'checkbox',
					'param_name' => 'active_add_icon',
					'heading'    => esc_html__( 'Add active icon?', 'infinite-addons' ),
					'group'      => esc_html__( 'Icon', 'infinite-addons' ),
					'value'      => '',
					'dependency' => array(
						'element' => 'show_icon',
						'value'   => 'yes'
					),
				),

			),

			rella_get_icon_params( 'manual', esc_html__( 'Icon', 'infinite-addons' ), 'all', array( 'align', 'color' ), 'active_' ),

			array(

				array(
					'type'       => 'colorpicker',
					'param_name' => 'color_border',
					'heading'    => esc_html__( 'Border', 'infinite-addons' ),
					'group'      => esc_html__( 'Design', 'infinite-addons' ),
					'dependency' => array(
						'element' => 'style',
						'value'   => array( 'boxed', 'highlight', 'expanded', 'big-square', 'minimal' )
					)
				),

				array(
					'type'       => 'colorpicker',
					'param_name' => 'color_background',
					'heading'    => esc_html__( 'Background', 'infinite-addons' ),
					'group'      => esc_html__( 'Design', 'infinite-addons' ),
					'dependency' => array(
						'element' => 'style',
						'value'   => array( 'square-inverted' )
					)
				),

				array(
					'type'       => 'colorpicker',
					'param_name' => 'color_icon',
					'heading'    => esc_html__( 'Icon Background', 'infinite-addons' ),
					'group'      => esc_html__( 'Design', 'infinite-addons' ),
					'dependency' => array(
						'element' => 'style',
						'value'   => array( 'boxed', 'square-hfiller-inverted', 'big-square', 'minimal')
					)
				),

				array(
					'type'       => 'colorpicker',
					'param_name' => 'color_icon_text',
					'heading'    => esc_html__( 'Icon', 'infinite-addons' ),
					'group'      => esc_html__( 'Design', 'infinite-addons' ),
					'dependency' => array(
						'element' => 'style',
						'value'   => array( 'big-square', 'minimal', 'default' )
					)
				),

				array(
					'type'       => 'colorpicker',
					'param_name' => 'color_icon_text_active',
					'heading'    => esc_html__( 'Active Icon', 'infinite-addons' ),
					'group'      => esc_html__( 'Design', 'infinite-addons' ),
					'dependency' => array(
						'element' => 'style',
						'value' => array( 'default' )
					)
				),

				array(
					'type'       => 'colorpicker',
					'param_name' => 'color_toggler',
					'heading'    => esc_html__( 'Toggle Background', 'infinite-addons' ),
					'group'      => esc_html__( 'Design', 'infinite-addons' ),
					'dependency' => array(
						'element' => 'style',
						'value'   => array( 'shadow', 'square', 'square-hfiller', 'square-inverted', 'facebook', 'square-hfiller-inverted', 'expanded', 'minimal-inverted', 'minimal-alt' )
					)
				),

				array(
					'type'       => 'colorpicker',
					'param_name' => 'color_toggler_active',
					'heading'    => esc_html__( 'Toggle Active State Background', 'infinite-addons' ),
					'group'      => esc_html__( 'Design', 'infinite-addons' ),
					'dependency' => array(
						'element' => 'style',
						'value' => array( 'square-hfiller-inverted', 'minimal-inverted', 'default' )
					)
				),
			)
		);

		$this->add_extras();
	}

	public function before_output( $atts, &$content ) {

		global $rella_accordion_tabs;

		$rella_accordion_tabs = array();

		//parse vc_accordion_tab shortcode
		do_shortcode( $content );

		$atts['items'] = $rella_accordion_tabs;

		return $atts;
	}

	protected function get_style_class( $style ) {

		$hash = array(
			'default'                 => 'accordion-default',
			'boxed'                   => 'accordion-boxed',
			'highlight'               => 'accordion-boxed accordion-highlighted',
			'shadow'                  => 'accordion-square accordion-red',
			'square'                  => 'accordion-square',
			'square-hfiller'          => 'accordion-square with-filler',
			'square-inverted'         => 'accordion-square-inverted',
			'facebook'                => 'accordion-facebook',
			'square-hfiller-inverted' => 'accordion-square-hfiller-inverted',
			'expanded'                => 'accordion-square-expanded',
			'big-square'              => 'accordion-big-square',
			'minimal'                 => 'accordion-boxed-minimal',
			'minimal-inverted'        => 'accordion-square-hfiller-inverted no-expander',
			'minimal-alt'             => 'accordion-university',
			'underline'               => 'accordion-underline',
		);

		return $hash[ $style ];
	}

	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' .$this->get_id();

		if( 'default' === $style ) {

			$elements[ rella_implode( '%1$s .accordion-body' ) ]['color'] = '#999';
			$elements[ rella_implode( '%1$s .accordion-expander' ) ]['color'] = $color_icon_text;
			$elements[ rella_implode( '%1$s .active .accordion-toggle' ) ]['background-color'] = $color_toggler_active;
			$elements[ rella_implode( '%1$s .active .accordion-toggle, %1$s .active .accordion-toggle a, %1$s .active .accordion-expander' ) ]['color'] = $color_icon_text_active;
		}
		elseif( 'boxed' === $style ) {

			$elements[ rella_implode( '%1$s .accordion-item' ) ]['border-color'] = $color_border;
			$elements[ rella_implode( '%1$s .accordion-expander' ) ]['background-color'] = $color_icon;
			$elements[ rella_implode( '%1$s .active .accordion-expander' ) ] = array(
				'border-color' => $color_icon,
				'color' => $color_icon
			);
		}
		elseif( 'highlight' === $style ) {

			$elements[ rella_implode( '%1$s .active.accordion-item' ) ]['border-color'] = $color_border;
		}
		elseif( 'shadow' === $style || 'square' === $style || 'square-hfiller' === $style ) {

			$elements[ rella_implode( '%1$s .accordion-expander' ) ]['background-color'] = $color_toggler;
			$elements[ rella_implode( '%1$s .active .accordion-expander' ) ]['color'] = $color_toggler;
			$elements[ rella_implode( '%1$s .active .accordion-toggle' ) ]['background-color'] = $color_toggler;

			if( 'square-hfiller' === $style ) {
				$elements[ rella_implode( '%1$s.with-filler .active .accordion-toggle' ) ]['border-color'] = $color_toggler;
			}
		}
		elseif( 'square-inverted' === $style ) {

			$elements[ rella_implode( array('%1$s .accordion-toggle', '%1$s .accordion-body' ) ) ]['background-color'] = $color_background;
			$elements[ rella_implode( '%1$s .active .accordion-toggle' ) ]['background-color'] = $color_toggler;
		}
		elseif( 'facebook' === $style ) {

			$elements[ rella_implode( '%1$s .accordion-item:not(.active) .accordion-expander' ) ]['color'] = $color_toggler;
			$elements[ rella_implode( '%1$s .active .accordion-toggle' ) ]['background-color'] = $color_toggler;
		}
		elseif( 'square-hfiller-inverted' === $style ) {

			$elements[ rella_implode( '%1$s .accordion-toggle a' ) ]['background-color'] = $color_icon;
			$elements[ rella_implode( array( '%1$s .accordion-expander', '%1$s .active .accordion-expander' ) ) ]['background-color'] = $color_toggler;
			$elements[ rella_implode( '%1$s .active .accordion-toggle a' ) ]['background-color'] = $color_toggler_active;
		}
		elseif( 'expanded' === $style ) {

			$elements[ rella_implode( array( '%1$s .accordion-toggle a', '%1$s .accordion-body', '%1$s .accordion-expander' ) ) ]['border-color'] = $color_border;
			$elements[ rella_implode( '%1$s .accordion-expander' ) ]['color'] = $color_toggler;
			$elements[ rella_implode( array( '%1$s .active .accordion-expander', '%1$s .active .accordion-toggle a' ) ) ] = array(
				'background-color' => $color_toggler,
				'border-color' => $color_toggler
			);
		}
		elseif( 'big-square' === $style ) {

			$elements[ rella_implode( '%1$s .accordion-toggle a' ) ]['border-color'] = $color_border;
			$elements[ rella_implode( '%1$s .accordion-expander' ) ] = array(
				'background-color' => $color_icon,
				'color' => $color_icon_text
			);
		}
		elseif( 'minimal' === $style ) {

			$elements[ rella_implode( '%1$s .accordion-item' ) ]['border-color'] = $color_border;
			$elements[ rella_implode( '%1$s .accordion-expander' ) ] = array(
				'background-color' => $color_icon,
				'border-color' => $color_icon,
				'color' => $color_icon_text
			);
			$elements[ rella_implode( '%1$s .active .accordion-expander' ) ] = array(
				'border-color' => $color_icon,
				'color' => $color_icon
			);
		}
		elseif( 'minimal-inverted' === $style ) {

			$elements[ rella_implode( '%1$s .accordion-toggle a' ) ]['background-color'] = $color_toggler;
			$elements[ rella_implode( '%1$s .active .accordion-toggle a' ) ]['background-color'] = $color_toggler_active;
		}
		elseif( 'minimal-alt' === $style ) {

			$elements[ rella_implode( array('%1$s .accordion-toggle', '%1$s .accordion-toggle a' ) ) ]['color'] = $color_toggler;
			$elements[ rella_implode( '%1$s .active .accordion-toggle' ) ]['border-color'] = $color_toggler;
		}

		$this->dynamic_css_parser( $id, $elements );
	}
}
new RA_Accordions;

// Accordion Tab
include_once 'rella-accordion-tab.php';
