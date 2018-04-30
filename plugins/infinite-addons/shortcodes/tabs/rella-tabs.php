<?php
/**
* Shortcode Tab
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Tabs extends RA_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug          = 'ra_tabs';
		$this->title         = esc_html__( 'Tabs', 'infinite-addons' );
		$this->description   = esc_html__( 'Tabbed content.', 'infinite-addons' );
		$this->icon          = 'icon-wpb-ui-tab-content';
		$this->is_container  = true;
		$this->show_settings_on_create = false;
		$this->js_view       = 'VcBackendTtaTabsView';
		$this->as_parent     = array( 'only' => 'ra_tab_section' );
		$this->scripts       = array( 'TweenMax', 'jquery-appear', 'SplitText' );
		$this->styles        = array( 'rella-sc-tabs' );

		$this->custom_markup = '<div class="vc_tta-container" data-vc-action="collapse">
			<div class="vc_general vc_tta vc_tta-tabs vc_tta-color-backend-tabs-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-spacing-1 vc_tta-tabs-position-top vc_tta-controls-align-left">
				<div class="vc_tta-tabs-container">'
				. '<ul class="vc_tta-tabs-list">'
					. '<li class="vc_tta-tab" data-vc-tab data-vc-target-model-id="{{ model_id }}" data-element_type="ra_tab_section"><a href="javascript:;" data-vc-tabs data-vc-container=".vc_tta" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-target-model-id="{{ model_id }}"><span class="vc_tta-title-text">{{ section_title }}</span></a></li>'
				. '</ul>
				</div>
				<div class="vc_tta-panels vc_clearfix {{container-class}}">
					{{ content }}
				</div>
			</div>
		</div>';
		$this->default_content = '
			[ra_tab_section title="' . sprintf( '%s %d', 'Tab', 1 ) . '"][/ra_tab_section]
			[ra_tab_section title="' . sprintf( '%s %d', 'Tab', 2 ) . '"][/ra_tab_section]';
		$this->admin_enqueue_js = array( vc_asset_url( 'lib/vc_tabs/vc-tabs.min.js' ) );

		parent::__construct();
	}

	/**
	 * Get params
	 * @return array
	 */
	public function get_params() {

		$url = rella_addons()->plugin_uri() . '/assets/img/sc-preview/tabs/';

		$this->params = array(

			array(
				'type'        => 'select_preview',
				'param_name'  => 'style',
				'heading'     => 'Style',
				'value'       => array(

					array(
						'value' => 's1',
						'label' => esc_html__( 'Default', 'infinite-addons' ),
						'image' => $url . 'default.png'
					),

					array(
						'label' => esc_html__( 'Border Center 1', 'infinite-addons' ),
						'value' => 's7',
						'image' => $url . 'border-center-1.png'
					),

					array(
						'label' => esc_html__( 'Border Center 2', 'infinite-addons' ),
						'value' => 's8',
						'image' => $url . 'border-center-2.png'
					),

					array(
						'label' => esc_html__( 'Border Center 3', 'infinite-addons' ),
						'value' => 's21',
						'image' => $url . 'border-center-3.png'
					),

					array(
						'label' => esc_html__( 'Bordered', 'infinite-addons' ),
						'value' => 's3',
						'image' => $url . 'bordered.png'
					),

					array(
						'label' => esc_html__( 'Bordered Floated', 'infinite-addons' ),
						'value' => 's4',
						'image' => $url . 'border-floated.png'
					),

					array(
						'label' => esc_html__( 'Broad Border', 'infinite-addons' ),
						'value' => 's14',
						'image' => $url . 'broad-border.png'
					),

					array(
						'label' => esc_html__( 'Broad Border 2', 'infinite-addons' ),
						'value' => 's19',
						'image' => $url . 'broad-border-2.png'
					),

					array(
						'label' => esc_html__( 'Bubble', 'infinite-addons' ),
						'value' => 's6',
						'image' => $url . 'bubble.png'
					),

					array(
						'label' => esc_html__( 'Bubble Alt', 'infinite-addons' ),
						'value' => 's10',
						'image' => $url . 'bubble-alt.png'
					),

					array(
						'label' => esc_html__( 'Dot Icons', 'infinite-addons' ),
						'value' => 's11',
						'image' => $url . 'dot-icons.png'
					),

					array(
						'label' => esc_html__( 'History', 'infinite-addons' ),
						'value' => 's13',
						'image' => $url . 'history.png'
					),

					array(
						'label' => esc_html__( 'Icon Center', 'infinite-addons' ),
						'value' => 's15',
						'image' => $url . 'icon-center.png'
					),

					array(
						'label' => esc_html__( 'Naked', 'infinite-addons' ),
						'value' => 's12',
						'image' => $url . 'naked.png'
					),

					array(
						'label' => esc_html__( 'Naked 2', 'infinite-addons' ),
						'value' => 's18',
						'image' => $url . 'naked-2.png'
					),

					array(
						'label' => esc_html__( 'Shadowed', 'infinite-addons' ),
						'value' => 's5',
						'image' => $url . 'shadowed.png'
					),

					array(
						'label' => esc_html__( 'Sided', 'infinite-addons' ),
						'value' => 's17',
						'image' => $url . 'sided.png'
					),

					array(
						'label' => esc_html__( 'Sided Vertical', 'infinite-addons' ),
						'value' => 's20',
						'image' => $url . 'sided-vertical.png'
					),

					array(
						'label' => esc_html__( 'Simple', 'infinite-addons' ),
						'value' => 's2',
						'image' => $url . 'simple.png'
					),

					array(
						'label' => esc_html__( 'Switch', 'infinite-addons' ),
						'value' => 's9',
						'image' => $url . 'switch.png'
					),

					array(
						'label' => esc_html__( 'Switch Gradient', 'infinite-addons' ),
						'value' => 's16',
						'image' => $url . 'switch-gradient.png'
					),

					array(
						'label' => esc_html__( 'Underlined', 'infinite-addons' ),
						'value' => 's22',
						'image' => $url . 'underlined.png'
					)
				),
				'save_always' => true,
			),

			array(
				'id' => 'title',
				'description' => esc_html__( 'Used in some styles (Note: you can leave it empty).', 'infinite-addons' ),
			),
			
			array(
				'type'        => 'textfield',
				'param_name'  => 'heading_size',
				'heading'     => esc_html__( 'Title Size', 'infinite-addons'  ),
				'description' => esc_html__( 'Add title size in px, ex. 30px', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'style',
					'value'   => 's18'
				),
				'edit_field_class' => 'vc_column-with-padding vc_col-sm-4',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'heading_size_tablet',
				'heading'     => esc_html__( 'Title Size (Tablet)', 'infinite-addons'  ),
				'description' => esc_html__( 'Add title size in px, ex. 20px on tablet', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'style',
					'value'   => 's18'
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'heading_size_mobile',
				'heading'     => esc_html__( 'Title Size (Mobile)', 'infinite-addons'  ),
				'description' => esc_html__( 'Add title size in px, ex. 10px on mobile devices', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'style',
					'value'   => 's18'
				),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'        => 'checkbox',
				'param_name'  => 'show_numbers',
				'heading'     => esc_html__( 'Show Numbers?', 'infinite-addons' ),
				'description' => esc_html__( 'Enable to show numbered tabs', 'infinite-addons' ),
				'value'       => array( esc_html__( 'Yes' , 'boo-adddons' ) => 'yes' ),
				'dependency'  => array(
					'element' => 'style',
					'value'   => 's11'
				)
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'align',
				'heading'    => esc_html__( 'Align nav items', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Left', 'infinite-addons' ) => 'left',
					esc_html__( 'Center', 'infinite-addons' ) => 'center',
					esc_html__( 'Right', 'infinite-addons' ) => 'right'
				),
				'dependency' => array(
					'element' => 'style',
					'value' => 's18'
				),
			),
			
			array(
				'type'       => 'dropdown',
				'param_name' => 'sticky_nav',
				'heading'    => esc_html__( 'Tab navigation sticky?', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'No', 'infinite-addons' )  => '',
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes'
				),
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'use_resolve_effect',
				'heading'    => esc_html__( 'Use resolving effect on title?', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'No', 'infinite-addons' ) => '',
					esc_html__( 'Yes', 'infinite-addons') => 'yes'
				),
				'dependency'  => array(
					'element' => 'style',
					'value'   => 's18',
				),
				'group' => esc_html__( 'Effects', 'infinite-addons' )
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'use_typewriter_effect',
				'heading'    => esc_html__( 'Use typewriter effect on title?', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'No', 'infinite-addons' ) => '',
					esc_html__( 'Yes', 'infinite-addons') => 'yes'
				),
				'dependency'  => array(
					'element' => 'style',
					'value'   => 's18',
				),
				'group' => esc_html__( 'Effects', 'infinite-addons' )
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'primary_color',
				'heading'     => esc_html__( 'Primary Color', 'infinite-addons' ),
				'description' => esc_html__( 'Pick a primary color for tabs', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'style',
					'value'   => 's11'
				),
				'edit_field_class' => 'vc_column-with-padding vc_col-sm-4',
				'group' => esc_html__( 'Design Options', 'infinite-addons' ),
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'active_color',
				'heading'     => esc_html__( 'Active Color', 'infinite-addons' ),
				'description' => esc_html__( 'Pick a color for actvive tab', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'style',
					'value'   => 's11'
				),
				'edit_field_class' => 'vc_col-sm-4',
				'group' => esc_html__( 'Design Options', 'infinite-addons' ),
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'secondary_color',
				'heading'     => esc_html__( 'Secondary Color', 'infinite-addons' ),
				'description' => esc_html__( 'Pick a color for secondary elements of the tab', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'style',
					'value'   => 's11'
				),
				'edit_field_class' => 'vc_col-sm-4',
				'group' => esc_html__( 'Design Options', 'infinite-addons' ),
			),

		);

		$this->add_extras();
	}

	public function before_output( $atts, &$content ) {

		global $rella_accordion_tabs;

		$rella_accordion_tabs = array();

		//parse ra_tab_section shortcode
		do_shortcode( $content );

		$atts['items'] = $rella_accordion_tabs;

		return $atts;
	}

	protected function get_class( $style ) {

		$hash = array(
			's1'  => 'tabs tabs-default equally-sized-parent equally-size-child reset-nav-tab-styles',
			's2'  => 'tabs tabs-simple tabs-default equally-size-child equally-sized-parent reset-nav-tab-styles',
			's3'  => 'tabs tabs-border tabs-default equally-size-child equally-sized-parent reset-nav-tab-styles',
			's4'  => 'tabs tabs-border-floated tabs-border tabs-default equally-size-child equally-sized-parent reset-nav-tab-styles',
			's5'  => 'tabs tabs-shadow tabs-default equally-sized-parent equally-size-child reset-nav-tab-styles',
			's6'  => 'tabs tabs-stacked-bubble tabs-stacked-bubble-default row reset-nav-pill-styles',
			's7'  => 'tabs tabs-border-center tabs-border-center-default center-list reset-nav-tab-styles',
			's8'  => 'tabs tabs-border-center center-list tabs-border-center-alt tabs-border-center-alt1 reset-nav-tab-styles',
			's21' => 'tabs tabs-border-center center-list tabs-border-center-alt tabs-border-center-alt2 reset-nav-tab-styles',
			's9'  => 'tabs tabs-switch-center center-list reset-nav-tab-styles tabs-border-center',
			's10' => 'tabs tabs-stacked-bubble tabs-stacked-bubble-invert row reset-nav-pill-styles',
			's11' => 'tabs tabs-icon-dots equally-sized-parent equally-size-child reset-nav-tab-styles',
			's12' => 'tabs tabs-naked center-list',
			's13' => 'tabs tabs-history',
			's14' => 'tabs tabs-broad-border center-list reset-nav-tab-styles',
			's15' => 'tabs tabs-icon-center center-list reset-nav-tab-styles',
			's16' => 'tabs tabs-switch-center tabs-switch-center-gradient center-list reset-nav-tab-styles tabs-border-center',
			's17' => 'tabs tabs-stacked-default reset-nav-pill-styles',
			's18' => 'tabs tabs-title-naked',
			's19' => 'tabs tabs-broad-border broad-border-alt center-list reset-nav-tab-styles',
			's20' => 'tabs tabs-side reset-nav-tab-styles',
			's22' => 'tabs tabs-underlined center-list reset-nav-tab-styles',
		);

		return $hash[ $style ];
	}

	protected function get_effects( $type, $delay ) {

		$effect = '';

		if( ! empty( $this->atts['use_resolve_effect'] ) && 'resolving' === $type ) {
			$effect = sprintf( ' data-plugin-resolve="true" data-plugin-resolve-options=\'{ "element": "a", "seperator": "chars", "startDelay": %s }\'', $delay );
		}

		if( ! empty( $this->atts['use_typewriter_effect'] ) && 'typewriter' === $type ) {
			$effect .= sprintf( '  data-lettering="true" data-plugin-options=\'{"animateOnAppear": true, "animationType": "typewriter", "animateDelay": %s }\'', $delay );
		}

		return $effect;
	}

	protected function get_nav() {

		$out = ''; $first = true;
		$style = $this->atts['style'];
		$sticky = $this->atts['sticky_nav'];
		
		$nav_attributes = array();
		$nav_attributes[] = 'role="tablist"';
		
		if( 'yes' === $sticky ) {
			$nav_attributes[] = 'data-sticky-element="true" data-plugin-sticky-options=\'{ "limitElement": ".tabs" }\'';	
		}

		if( in_array( $style, array( 's6', 's10', 's17' ) ) ) {
			$out .= '<ul class="nav nav-pills nav-stacked col-md-3" ' . implode( ' ', $nav_attributes ) . '>';
		}
		elseif( in_array( $style, array( 's12', 's14', 's15', 's18', 's19', 's20', 's21', 's22' ) ) ) {
			$out .= '<ul class="nav nav-tabs" ' . implode( ' ', $nav_attributes ) . '>';
		}
		elseif( in_array( $style, array( 's13' ) ) ) {
			$out .= '<ul class="nav navbar-nav" ' . implode( ' ', $nav_attributes ) . '>';
		}
		elseif( in_array( $style, array( 's11' ) ) ) {
			$out .= '<span class="bg-line fullwidth"></span><ul class="nav nav-tabs" ' . implode( ' ', $nav_attributes ) . '>';
		}
		else{
			$out .= '<ul class="nav nav-tabs nav-inline" ' . implode( ' ', $nav_attributes ) . '>';
		}

			// Main Title
			if( $this->atts['title'] && 's4' == $style ) {
				$out .= '<li class="title text-uppercase"><h4>'. wp_kses_data( $this->atts['title'] ) .'</h4></li>';
			}

			foreach( $this->atts['items'] as $i => $tab ) {

				// Classes
				$classes = array();
				if( $first ) {
					$classes[] = 'active';
				}

				if( in_array( $style, array( 's3', 's4', 's5' ) ) ) {
					$classes[] = 'text-uppercase';
				}
				$classes = !empty( $classes ) ? ' class="'.join(' ', $classes).'"' : '';

				// Tab title
				$title = wp_kses_data( do_shortcode( $tab['title'] ) );
				if( 's4' === $style ) {
					$ex = explode( "|", $title );
					if ( ! empty( $ex ) && isset( $ex[1] ) ) {
						$title = sprintf( '<span class="date clearfix">%1$s</span>%2$s</a>',$ex[0], $ex[1] );
					}
				}
				if( 's6' === $style ) {
					$title = '<span class="number">0'. ( $i+1 ) .'.</span> ' . $title;
				}
				if( 's11' === $style ) {
					$number = 'yes' == $this->atts['show_numbers'] ? '0'. ( $i+1 ) .'.' : '';
					if ( $tab['icon']['type'] ) {
						$title = '<span class="icon-container"><i class="'.$tab['icon']['icon'].'"></i></span><span class="number-with-dot">'. $number .'</span> ' . $title;
					} else {
						$title = '<span class="icon-container"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="64px" height="64px" viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve"><g><rect x="1" y="10" fill="none" stroke="#000000" stroke-width="2" stroke-miterlimit="10" width="62" height="41"/><line fill="none" stroke="#000000" stroke-width="2" stroke-miterlimit="10" x1="22" y1="63" x2="42" y2="63"/><line fill="none" stroke="#000000" stroke-width="2" stroke-miterlimit="10" x1="32" y1="63" x2="32" y2="51"/></g><line fill="none" stroke="#000000" stroke-width="2" stroke-miterlimit="10" x1="1" y1="43" x2="64" y2="43"/></svg></span><span class="number-with-dot">' . $number . '</span> ' . $title;
						}
				}
				if( 's13' === $style ) {
					$title = sprintf( '<i class="fa fa-circle"></i><span class="clearfix">%s</span>', $title );
				}
				if( $tab['icon']['type'] && 's11' != $style ) {
					if( 's15' == $style ) {
						$title = sprintf( '<span class="%s"></span>', $tab['icon']['icon'] ) . $title;
					}
					else {
						$title = sprintf( '<i class="%s"></i>', $tab['icon']['icon'] ) . $title;
					}

				}

				$effect = $resolving = '';
				if( 's18' === $style ) {
					$effect = $this->get_effects( 'typewriter', $i*0.6 );
					$resolving = $this->get_effects( 'resolving', $i*0.3 );
				}

				// Nav
				$out .= sprintf(
					'<li role="presentation"%3$s %5$s><a href="#%1$s" aria-expanded="false" aria-controls="%1$s" role="tab" data-toggle="tab"%4$s>%2$s</a></li>',
					$this->get_id( $tab ), $title, $classes, $effect, $resolving
				);
				$first = false;
			}

		$out .= '</ul>';

		echo $out;
	}

	protected function get_content() {

		$out = ''; $first = true;

		if( 's6' == $this->atts['style'] || 's10' == $this->atts['style'] || 's17' == $this->atts['style'] ) {
			$out .= '<div class="tab-content col-md-9">';
		}
		else{
			$out .= '<div class="tab-content">';
		}

			foreach( $this->atts['items'] as $tab ) {
				$out .= sprintf(
					'<div id="%1$s" role="tabpanel" class="tab-pane fade%3$s">%2$s</div>',
					$this->get_id( $tab ), $tab['content'], ( $first ? ' active in' : '')
				);
				$first = false;
			}

		$out .= '</div>';

		echo $out;
	}

	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' .$this->get_id();

		if( ! empty( $primary_color ) ) {
			$elements[ rella_implode( '%1$s .nav-tabs > li > a' ) ]['color'] = $primary_color;
		}
		if( ! empty( $active_color ) ) {
			$elements[ rella_implode( '%1$s .nav-tabs > li.active > a, %1$s .nav-tabs > li.active > a i' ) ]['color'] = $active_color;
		}
		if( ! empty( $secondary_color ) ) {
			$elements[ rella_implode( array( '%1$s .nav-tabs>li>a span.number-with-dot::before', '%1$s span.bg-line' ) ) ]['background-color'] = $secondary_color;
		}

		if( 's1' === $style ) {

			$elements[ rella_implode( '%1$s' ) ]['border-color'] = $bdrcolor;
			$elements[ rella_implode( '%1$s .nav-tabs > li > a' ) ] = array(
				'color' => $color,
				'border-right-color' => $bdrcolor,
				'border-bottom-color' => $bdrcolor,
				'background' => $bgcolor
			);
		}
		elseif( 's18' === $style ) {
			$elements[ rella_implode( '%1$s.tabs-title-naked .nav-tabs' ) ]['text-align'] = $align;
			
			if( ! empty( $heading_size ) ) {
				$elements[ rella_implode( '%1$s.tabs-title-naked .nav-tabs li' ) ]['font-size'] = $heading_size;
			}
			if( ! empty( $heading_size_tablet ) ) {
				$elements[ rella_implode( '@media (max-width: 991px) and (min-width: 768px) { %1$s.tabs-title-naked .nav-tabs li' ) ]['font-size'] = $heading_size_tablet . '}';
			}
			if( ! empty( $heading_size_mobile ) ) {
				$elements[ rella_implode( '@media (max-width: 767px) { %1$s.tabs-title-naked .nav-tabs li' ) ]['font-size'] = $heading_size_mobile . '}';
			}	
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

			$elements[ rella_implode( '%1$s .accordion-expander' ) ]['color'] = $color_toggler;
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
		elseif( 'university' === $style ) {

			$elements[ rella_implode( array('%1$s .accordion-toggle', '%1$s .accordion-toggle a' ) ) ]['color'] = $color_toggler;
			$elements[ rella_implode( '%1$s .active .accordion-toggle' ) ]['border-color'] = $color_toggler;
		}

		$this->dynamic_css_parser( $id, $elements );
	}
}
new RA_Tabs;

// Accordion Tab
include_once 'rella-tab-section.php';
