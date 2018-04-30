<?php
/**
* Shortcode Header Container
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Header_Container extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug         = 'ra_header_container';
		$this->title        = esc_html__( 'Header Modules Container', 'infinite-addons' );
		$this->description  = esc_html__( 'Contains modules for header.', 'infinite-addons' );
		$this->icon         = 'fa fa-square';
		$this->category     = esc_html__( 'Header', 'infinite-addons' );
		$this->is_container = true;

		parent::__construct();
	}

	public function get_params() {

		$this->params = array(

			array(
				'type'       => 'dropdown',
				'param_name' => 'position',
				'heading'    => esc_html__( 'Style', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'None', 'infinite-addons' )       => '',
					esc_html__( 'Off Canvas', 'infinite-addons' ) => 'off-canvas',

					esc_html__( 'Top Left ( Fullscreen Mainbar Style 1 )', 'infinite-addons' )  => 'top-left',
					esc_html__( 'Top Right ( Fullscreen Mainbar Style 1 )', 'infinite-addons' ) => 'top-right',

					esc_html__( 'Mid Left ( Fullscreen Mainbar Style 1 )', 'infinite-addons' )  => 'mid-left',
					esc_html__( 'Mid Right ( Fullscreen Mainbar Style 1 )', 'infinite-addons' ) => 'mid-right',

					esc_html__( 'Bottom ( Fullscreen Mainbar Style 1 )', 'infinite-addons' )       => 'bottom',
					esc_html__( 'Bottom Left ( Fullscreen Mainbar Style 1 )', 'infinite-addons' )  => 'bottom-left',
					esc_html__( 'Bottom Right ( Fullscreen Mainbar Style 1 )', 'infinite-addons' ) => 'bottom-right'
				),
				'edit_field_class' => 'vc_column-with-padding vc_col-sm-6'
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'off_canvas',
				'heading'    => esc_html__( 'Offcanvas module position', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Left', 'infinite-addons' )       => 'left',
					esc_html__( 'Left Wide', 'infinite-addons' )  => 'left wide',
					esc_html__( 'Right', 'infinite-addons' )      => 'right',
					esc_html__( 'Right Wide', 'infinite-addons' ) => 'right wide',
				),
				'dependency'  => array(
					'element' => 'position',
					'value'   => 'off-canvas'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'css_editor',
				'param_name'  => 'css',
				'description' => '',
				'heading'     => esc_html__( 'CSS Box', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'module_padding',
				'heading'     => esc_html__( 'Modules Side Spacing', 'infinite-addons' ),
				'description' => esc_html__( 'modules side spacing in px, for ex. 40px', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6',
			),

		);

		$this->add_extras();
	}

	protected function header_module( &$content ) {
		global $shortcode_tags;

		// Find all registered tag names in $content.
		preg_match_all( '@\[([^<>&/\[\]\x00-\x20=]++)@', $content, $matches );
		$tagnames = array_intersect( array_keys( $shortcode_tags ), $matches[1] );

		foreach( $tagnames as $tag ) {
			$start = "[$tag";
			$end = "[/$tag]";

			if( in_array( $tag, array( 'vc_separator', 'ra_header_search', 'ra_header_cart', 'ra_header_wishlist' ) ) ) {
				continue;
			}

			if( 'ra_lang_chooser' === $tag ) {
				
				
				$header_id = rella_get_custom_header_id();
				$mobile_language_show = get_post_meta( $header_id, 'enable_mobile_language', true );
				$mobile_visible = '';
				if( 'language-sm-visible' === $mobile_language_show ) {
					$mobile_visible = 'sm-visible';	
				}
				
				if( ra_helper()->str_contains( $end, $content ) ) {
					$content = str_replace( $start, '<div class="header-module lang-switch-module ' . $mobile_visible . '">' . $start, $content );
					$content = str_replace( $end, $end . '</div>', $content );
				}
				else {
					preg_match_all( '/\[(\[?)('.$tag.')(?![\w-])([^\]\/]*(?:\/(?!\])[^\]\/]*)*?)(?:(\/)\]|\](?:([^\[]*+(?:\[(?!\/\2\])[^\[]*+)*+)\[\/\2\])?)(\]?)/s ', $content, $matches );
					foreach( array_unique( $matches[0] ) as $replace ) {
						$content = str_replace( $replace, '<div class="header-module lang-switch-module ' . $mobile_visible . '">' . $replace . '</div>', $content );
					}
				}
				
			}
			else {
				if( ra_helper()->str_contains( $end, $content ) ) {
					$content = str_replace( $start, '<div class="header-module">' . $start, $content );
					$content = str_replace( $end, $end . '</div>', $content );
				}
				else {
					preg_match_all( '/\[(\[?)('.$tag.')(?![\w-])([^\]\/]*(?:\/(?!\])[^\]\/]*)*?)(?:(\/)\]|\](?:([^\[]*+(?:\[(?!\/\2\])[^\[]*+)*+)\[\/\2\])?)(\]?)/s ', $content, $matches );
					foreach( array_unique( $matches[0] ) as $replace ) {
						$content = str_replace( $replace, '<div class="header-module">' . $replace . '</div>', $content );
					}
				}
			}
		}
	}

	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' . $this->get_id();

		if( $module_padding ) {
			$elements[rella_implode( '%1$s .header-module, %1$s .module-cart .module-trigger, %1$s .module-wishlist .module-trigger, %1$s .module-search-form .module-trigger' )] = array(
				'padding-left'  => $module_padding,
				'padding-right' => $module_padding,
			);
		}

		$this->dynamic_css_parser( $id, $elements );
	}

}
new RA_Header_Container;
class WPBakeryShortCode_RA_Header_Container extends RA_ShortcodeContainer {}
