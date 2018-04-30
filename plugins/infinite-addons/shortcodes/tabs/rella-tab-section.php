<?php
/**
* Shortcode Tab Section
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Tab Section Container Class
VcShortcodeAutoloader::getInstance()->includeClass( 'WPBakeryShortCode_VC_Tta_Section' );
class WPBakeryShortCode_Ra_tab_section extends WPBakeryShortCode_VC_Tta_Section {
	/**
	 * @param $width
	 * @param $i
	 *
	 * @return string
	 */
	public function mainHtmlBlockParams( $width, $i ) {
		$sortable = ( vc_user_access_check_shortcode_all( $this->shortcode ) ? 'wpb_sortable' : $this->nonDraggableClass );

		return 'data-element_type="' . $this->settings['base'] . '" class="wpb_' . $this->settings['base'] . ' ' . $sortable . ' wpb_vc_tta_section wpb_content_holder vc_shortcodes_container"' . $this->customAdminBlockParams();
	}
}


/**
* RA_Shortcode
*/
class RA_Tab_Section extends RA_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug          = 'ra_tab_section';
		$this->title         = esc_html__( 'Tab Section', 'infinite-addons' );
		$this->description   = esc_html__( 'Section for Tabs.', 'infinite-addons' );
		$this->icon          = 'icon-wpb-ui-tta-section';
		$this->is_container  = true;
		$this->allowed_container_element = 'vc_row';
		$this->show_settings_on_create = false;
		$this->scripts       = array( 'jquery-lettering' );
		$this->as_child      = array( 'only' => 'ra_tabs' );
		$this->js_view       = 'VcBackendTtaSectionView';
		$this->custom_markup = '<div class="vc_tta-panel-heading">
		    <h4 class="vc_tta-panel-title vc_tta-controls-icon-position-left"><a href="javascript:;" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-accordion data-vc-container=".vc_tta-container"><span class="vc_tta-title-text">{{ section_title }}</span><i class="vc_tta-controls-icon vc_tta-controls-icon-plus"></i></a></h4>
		</div>
		<div class="vc_tta-panel-body">
			{{ editor_controls }}
			<div class="{{ container-class }}">
			{{ content }}
			</div>
		</div>';

		parent::__construct();
	}

	public function get_params() {

		$this->params = array_merge(
			array(

				array( 'id' => 'title' ),
				
				array(
					'type'       => 'el_id',
					'param_name' => 'tab_id',
					'settings'   => array(
						'auto_generate' => true,
					),
					'heading'     => esc_html__( 'Section ID', 'infinite-addons' ),
					'description' => wp_kses_post( __( 'Enter section ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'infinite-addons' ) ),
				),

			),

			rella_get_icon_params( false, '', 'all', array( 'align', 'color' ) )
		);

		$this->add_extras();
	}

	public function render( $atts, $content = '' ) {

		global $rella_accordion_tabs;

		$atts = vc_map_get_attributes( $this->slug, $atts );
		$atts = $this->before_output( $atts, $content );
		$atts['_id'] = $atts['tab_id'];
		$atts['content'] = ra_helper()->do_the_content( $content );
		$atts['icon'] = rella_get_icon( $atts );

		$rella_accordion_tabs[]  = $atts;
	}
}
new RA_Tab_Section;