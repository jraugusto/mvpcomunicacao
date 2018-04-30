<?php
/**
* Shortcode Tab
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Flipbox extends RA_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug          = 'ra_flipbox';
		$this->title         = esc_html__( 'Flipbox', 'infinite-addons' );
		$this->description   = esc_html__( 'Flipbox content.', 'infinite-addons' );
		$this->styles      = array( 'rella-sc-flipbox' );
		$this->icon          = 'fa fa-undo';
		$this->is_container  = true;
		$this->show_settings_on_create = false;
		$this->js_view       = 'VcBackendTtaTabsView';
		$this->as_parent     = array( 'only' => 'ra_flipbox_section' );
		$this->custom_markup = '<div class="vc_tta-container" data-vc-action="collapse">
			<div class="vc_general vc_tta vc_tta-tabs vc_tta-color-backend-tabs-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-spacing-1 vc_tta-tabs-position-top vc_tta-controls-align-left">
				<div class="vc_tta-tabs-container">'
				. '<ul class="vc_tta-tabs-list">'
					. '<li class="vc_tta-tab" data-vc-tab data-vc-target-model-id="{{ model_id }}" data-element_type="ra_flipbox_section"><a href="javascript:;" data-vc-tabs data-vc-container=".vc_tta" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-target-model-id="{{ model_id }}"><span class="vc_tta-title-text">{{ section_title }}</span></a></li>'
				. '</ul>
				</div>
				<div class="vc_tta-panels vc_clearfix {{container-class}}">
					{{ content }}
				</div>
			</div>
		</div>';
		$this->default_content = '
			[ra_flipbox_section title="' . sprintf( '%s', 'Front' ) . '"][vc_row_inner][vc_column_inner offset="vc_col-xs-12"][/vc_column_inner][/vc_row_inner][/ra_flipbox_section]
			[ra_flipbox_section title="' . sprintf( '%s', 'Back' ) . '"][vc_row_inner][vc_column_inner offset="vc_col-xs-12"][/vc_column_inner][/vc_row_inner][/ra_flipbox_section]';
		$this->admin_enqueue_js = array( vc_asset_url( 'lib/vc_tabs/vc-tabs.min.js' ) );

		parent::__construct();
	}

	/**
	 * Get params
	 * @return array
	 */
	public function get_params() {

		$this->params = array(

			array(
				'type'        => 'dropdown',
				'param_name'  => 'direction',
				'heading'     => esc_html__( 'Direction', 'infinite-addons' ),
				'description' => esc_html__( 'Select a direction for flipbox', 'infinite-addons' ),
				'value' => array(
					esc_html__( 'Default - Left to Right', 'infinite-addons' ) => '',
					esc_html__( 'Right to Left', 'infinite-addons' ) => 'flipbox-right-to-left',
					esc_html__( 'Top to Bottom', 'infinite-addons' ) => 'flipbox-top-to-bottom',
					esc_html__( 'Bottom to Top', 'infinite-addons' ) => 'flipbox-bottom-to-top',
				),
			),

			array(
				'type'        => 'rella_checkbox',
				'heading'     => esc_html__( '3D Effect', 'infinite-addons' ),
				'param_name'  => 'd_effect',
				'value'       =>  array( esc_html__( 'Enable 3D effect', 'infinite-addons' ) => 'yes' ),
				'std'         => 'yes',
				'edit_field_class' => 'vc_column-with-padding vc_col-sm-6',
			),
			
			array(
				'type'       => 'textfield',
				'param_name' => 'stacking_factor',
				'heading'    => esc_html__( 'Stacking Factor', 'infinite-addons' ),
				'description' => esc_html__( 'Enter a value from 0.6 to 1', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'd_effect',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'subheading',
				'param_name'  => 'front_sbh',
				'heading'     => esc_html__( 'Front Side Flipbox', 'infinite-addons' ),
				'group' => esc_html__( 'Design Options', 'infinite-addons' ),
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'bg_type',
				'heading'     => esc_html__( 'Background Type', 'infinite-addons' ),
				'description' => esc_html__( 'Select a type of the background for front side of the flipbox', 'infinite-addosn' ),
				'value'       => array(
					esc_html__( 'Default', 'infinite-addons' )  => 'default',
					esc_html__( 'Gradient', 'infinite-addons' ) => 'gradient',
				),
				'group' => esc_html__( 'Design Options', 'infinite-addons' ),
			),

			array(
				'type'        => 'rella_attach_image',
				'param_name'  => 'bg_image',
				'heading'     => esc_html__( 'Background Image', 'infinite-addons' ),
				'description' => esc_html__( 'Add an image as backround', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'bg_type',
					'value'   => 'default'
				),
				'edit_field_class' => 'vc_column-with-padding  vc_col-sm-6',
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'bg_color',
				'heading'     => esc_html__( 'Background Color', 'infinite-addons' ),
				'description' => esc_html__( 'Pick backround color for front side of the flipbox', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'bg_type',
					'value'   => 'default'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'gradient',
				'param_name'  => 'bg_gradient',
				'heading'     => esc_html__( 'Background Gradient', 'infinite-addons' ),
				'description' => esc_html__( 'Background gradient for front side of the flipbox', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'bg_type',
					'value' => 'gradient'
				),
			),

			array(
				'type'        => 'subheading',
				'param_name'  => 'back_sbh',
				'heading'     => esc_html__( 'Back Side Flipbox', 'infinite-addons' ),
				'group' => esc_html__( 'Design Options', 'infinite-addons' ),
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'back_bg_type',
				'heading'     => esc_html__( 'Background Type', 'infinite-addons' ),
				'description' => esc_html__( 'Select a type of the background for back side of the flipbox', 'infinite-addosn' ),
				'value'       => array(
					esc_html__( 'Default', 'infinite-addons' )  => 'default',
					esc_html__( 'Gradient', 'infinite-addons' ) => 'gradient',
				),
				'group' => esc_html__( 'Design Options', 'infinite-addons' ),
			),

			array(
				'type'        => 'rella_attach_image',
				'param_name'  => 'back_bg_image',
				'heading'     => esc_html__( 'Background Image', 'infinite-addons' ),
				'description' => esc_html__( 'Add an image as backround', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'back_bg_type',
					'value'   => 'default'
				),
				'edit_field_class' => 'vc_column-with-padding  vc_col-sm-6',
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'back_bg_color',
				'heading'     => esc_html__( 'Background Color', 'infinite-addons' ),
				'description' => esc_html__( 'Pick backround color for back side of the flipbox', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'back_bg_type',
					'value'   => 'default'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'gradient',
				'param_name'  => 'back_bg_gradient',
				'heading'     => esc_html__( 'Background Gradient', 'infinite-addons' ),
				'description' => esc_html__( 'Background gradient for front side of the flipbox', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'back_bg_type',
					'value' => 'gradient'
				),
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

	protected function get_effect(){
		
		if( 'yes' !== $this->atts['d_effect'] ){
			return;
		}
		return 'data-hover3d="true"';
	}

	protected function get_stacking_factor() {

		if( 'yes' !== $this->atts['d_effect'] ){
			return;
		}		
		if( !empty( $this->atts['stacking_factor'] ) ){
			return 'data-stacking-factor="' . esc_attr( $this->atts['stacking_factor'] ) . '"';
		}
		return 'data-stacking-factor="0.5"';
	}

	protected function get_content() {

		$out = ''; $first = true;

			foreach( $this->atts['items'] as $tab ) {
				$out .= sprintf(
					'<div id="%1$s" class="%3$s">%2$s</div>',
					$this->get_id( $tab ), $tab['content'], ( $first ? 'flipbox-head' : 'flipbox-foot' )
				);
				$first = false;
			}

		echo $out;
	}

	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' .$this->get_id();

		if( ! empty( $bg_image ) ) {
			if( preg_match( '/^\d+$/', $bg_image ) ){
				$src = rella_get_image_src( $bg_image );
				$elements[ rella_implode( '%1$s .flipbox-head' ) ]['background-image'] = 'url(' . esc_url( $src[0] ) . ')';
			} else {
				$src = $bg_image;
				$elements[ rella_implode( '%1$s .flipbox-head' ) ]['background-image'] = 'url(' . esc_url( $src ) . ')';
			}
		}
		if( ! empty( $bg_color ) ) {
			$elements[ rella_implode( '%1$s .flipbox-head' ) ]['background-color'] = $bg_color;
		}
		if( ! empty( $bg_gradient ) && 'gradient' === $bg_type ) {
			$bg = rella_parse_gradient( $bg_gradient );
			$elements[ rella_implode( '%1$s .flipbox-head' ) ]['background'] = $bg['background-image'];
		}

		if( ! empty( $back_bg_image ) ) {
			if( preg_match( '/^\d+$/', $back_bg_image ) ){
				$back_src = rella_get_image_src( $back_bg_image );
				$elements[ rella_implode( '%1$s .flipbox-foot' ) ]['background-image'] = 'url(' . esc_url( $back_src[0] ) . ')';
			} else {
				$back_src = $back_bg_image;
				$elements[ rella_implode( '%1$s .flipbox-foot' ) ]['background-image'] = 'url(' . esc_url( $back_src ) . ')';
			}
		}
		if( ! empty( $back_bg_color ) ) {
			$elements[ rella_implode( '%1$s .flipbox-foot' ) ]['background-color'] = $back_bg_color;
		}
		if( ! empty( $back_bg_gradient ) && 'gradient' === $back_bg_type ) {
			$back_bg = rella_parse_gradient( $back_bg_gradient );
			$elements[ rella_implode( '%1$s .flipbox-foot' ) ]['background'] = $back_bg['background-image'];
		}

		$this->dynamic_css_parser( $id, $elements );
	}
}
new RA_Flipbox;

// Accordion Tab
include_once 'rella-flipbox-section.php';