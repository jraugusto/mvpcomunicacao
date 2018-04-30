<?php
/**
* Themerella Theme Framework
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Wp editor Class -----------------------------------------------------

/**
 * Rella Theme
 */
class Rella_Wp_Editor extends Rella_Base {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		$this->add_action( 'admin_enqueue_scripts', 'enqueue_scripts' );
		$this->add_filter( 'mce_buttons_2',         'rella_style_select' );
		$this->add_filter( 'mce_buttons_2',         'rella_mce_buttons' );
		$this->add_filter( 'tiny_mce_before_init',  'rella_mce_text_sizes' );
		$this->add_filter( 'tiny_mce_before_init',  'rella_styles_dropdown' );
	}

	public function enqueue_scripts( $hook ) {

		if( $hook == 'post.php' || $hook == 'post-new.php' ) {

			wp_enqueue_style( 'rella-wp-editor', get_template_directory_uri() . '/rella/extensions/wp-editor/rella-wp-editor.css' );
			wp_enqueue_script( 'rella-wp-editor', get_template_directory_uri() . '/rella/extensions/wp-editor/rella-wp-editor.js', array( 'jquery' ), '0.1', true );

		}
	}
	
	// Enable font size & font family selects in the editor
	public function rella_mce_buttons( $buttons ) {
			array_unshift( $buttons, 'fontselect' ); // Add Font Select
			array_unshift( $buttons, 'fontsizeselect' ); // Add Font Size Select
			return $buttons;
		}
	
	// Customize mce editor font sizes
	public function rella_mce_text_sizes( $initArray ){
		$initArray['fontsize_formats'] = "9px 10px 12px 13px 14px 16px 18px 21px 24px 28px 32px 36px";
		return $initArray;
	}

	// Add Formats Dropdown Menu To MCE
	public function rella_style_select( $buttons ) {
		array_push( $buttons, 'styleselect' );
		return $buttons;
	}

	// Add new styles to the TinyMCE "formats" menu dropdown
	public function rella_styles_dropdown( $settings ) {

		// Create array of new styles
		$new_styles = array(
			array(
				'title'	=> esc_html__( 'Text Transform', 'boo' ),
				'items'	=> array(
					array(
						'title'		=> esc_html__( 'Uppercase', 'boo' ),
						'inline'	=> 'span',
						'styles'    => array( 'text-transform' => 'uppercase' ),
					),
					array(
						'title'		=> esc_html__( 'Lowercase', 'boo' ),
						'inline'	=> 'span',
						'styles'    => array( 'text-transform' => 'lowercase' ),
					),
					array(
						'title'		=> esc_html__( 'Capitalize', 'boo' ),
						'inline'	=> 'span',
						'styles'    => array( 'text-transform' => 'capitalize' ),
					),
				),
			),
		);

		// Merge old & new styles
		//$settings['style_formats_merge'] = true;

		// Add new styles
		$settings['style_formats'] = json_encode( $new_styles );

		// Return New Settings
		return $settings;
	}

}

new Rella_Wp_Editor();