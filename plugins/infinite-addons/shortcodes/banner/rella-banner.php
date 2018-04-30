<?php
/**
* Shortcode Banner
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Banner extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug         = 'ra_banner';
		$this->title        = esc_html__( 'Banner', 'infinite-addons' );
		$this->icon         = 'fa fa-star';
		$this->description  = esc_html__( 'Banner content', 'infinite-addons' );
		$this->is_container = true;
		$this->scripts      = array( 'ofi-polyfill' );
		$this->styles       = array( 'rella-sc-banner', 'mediaelement' );		

		parent::__construct();
	}

	public function get_params() {

		$url = rella_addons()->plugin_uri() . '/assets/img/sc-preview/banner/';

		$this->params = array(

			array(
				'type'       => 'select_preview',
				'param_name' => 'style',
				'heading'    => esc_html__( 'Style', 'infinite-addons' ),
				'value'      => array(

					array(
						'value' => 'default',
						'label' => esc_html__( 'Default', 'infinite-addons' ),
						'image' => $url . 'default.png'
					),

					array(
						'label' => esc_html__( 'Broad', 'infinite-addons' ),
						'value' => 's9',
						'image' => $url . 'broad.png'
					),

					array(
						'label' => esc_html__( 'Broad 2', 'infinite-addons' ),
						'value' => 's14',
						'image' => $url . 'broad-2.png'
					),

					array(
						'label' => esc_html__( 'Condensed', 'infinite-addons' ),
						'value' => 's5',
						'image' => $url . 'condensed.png'
					),

					array(
						'label' => esc_html__( 'Condensed 2', 'infinite-addons' ),
						'value' => 's10',
						'image' => $url . 'condensed-2.png'
					),

					array(
						'label' => esc_html__( 'Deal', 'infinite-addons' ),
						'value' => 's11',
						'image' => $url . 'deal.png'
					),

					array(
						'label' => esc_html__( 'Icons', 'infinite-addons' ),
						'value' => 's12',
						'image' => $url . 'icons.png'
					),

					array(
						'label' => esc_html__( 'List', 'infinite-addons' ),
						'value' => 's15',
						'image' => $url . 'list.png'
					),

					array(
						'label' => esc_html__( 'Mobile App', 'infinite-addons' ),
						'value' => 's1',
						'image' => $url . 'mobile-app.png'
					),

					array(
						'label' => esc_html__( 'Rhombus Background', 'infinite-addons' ),
						'value' => 's8',
						'image' => $url . 'bg-rhombus.png'
					),

					array(
						'label' => esc_html__( 'Rhombus Subtitle', 'infinite-addons' ),
						'value' => 's2',
						'image' => $url . 'rhombus-subtitle.png'
					),

					array(
						'label' => esc_html__( 'Rhombus Subtitle 2', 'infinite-addons' ),
						'value' => 's3',
						'image' => $url . 'rhombus-subtitle-2.png'
					),

					array(
						'label' => esc_html__( 'Two Halfs', 'infinite-addons' ),
						'value' => 's4',
						'image' => $url . 'two-halfs.png'
					),

					array(
						'label' => esc_html__( 'Zoom', 'infinite-addons' ),
						'value' => 's7',
						'image' => $url . 'zoom.png'
					)
				),
				'save_always' => true,
			),

			array(
				'type'       => 'css_editor',
				'heading'    => esc_html__( 'CSS box', 'infinite-addons' ),
				'param_name' => 'css',
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
			),

		);

		$this->add_extras();
	}

	protected function get_class( $style ) {

		$hash = array(
			'default' => 'banner-default',
			's1'      => 'banner-app',
			's2'      => 'banner-rhombus-subtitle banner-rhombus-subtitle-default text-center',
			's3'      => 'banner-rhombus-subtitle-alt banner-rhombus-subtitle text-center',
			's4'      => 'banner-half-bg',
			's5'      => 'banner-condensed',
			's13'     => 'banner-condensed-2 banner-condensed-2-alt',
			's6'      => 'banner-icon-lightbox',
			's7'      => 'banner-bg-zoom',
			's8'      => 'banner-bg-rhombus',
			's9'      => 'banner-broad',
			's14'     => 'banner-broad-2',
			's10'     => 'banner-condensed-2',
			's11'     => 'banner-deals',
			's12'     => 'banner-icons',
			's15'     => 'banner-list',

		);

		return $hash[$style];
	}


}
new RA_Banner;
class WPBakeryShortCode_RA_Banner extends RA_ShortcodeContainer {}
