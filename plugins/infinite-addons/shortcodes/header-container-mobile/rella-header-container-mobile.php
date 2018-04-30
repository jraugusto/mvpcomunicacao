<?php
/**
* Shortcode Header Container
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Header_Container_Mobile extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug         = 'ra_header_container_mobile';
		$this->title        = esc_html__( 'Header Mobile Modules Container', 'infinite-addons' );
		$this->description  = esc_html__( 'Contains modules for Mobile header.', 'infinite-addons' );
		$this->icon         = 'fa fa-square';
		$this->category     = esc_html__( 'Header', 'infinite-addons' );
		$this->is_container = true;

		parent::__construct();
	}

	public function get_params() {

		$this->params = array();
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
new RA_Header_Container_Mobile;
class WPBakeryShortCode_RA_Header_Container_Mobile extends RA_ShortcodeContainer {}