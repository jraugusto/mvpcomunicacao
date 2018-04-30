<?php
/**
* Shortcode Lang Chooser
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Lang_Chooser extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_lang_chooser';
		$this->title       = esc_html__( 'Language Chooser', 'infinite-addons' );
		$this->description = esc_html__( 'Language dropdown', 'infinite-addons' );
		$this->icon        = 'fa fa-star';

		parent::__construct();
	}

	public function get_params() {

		$this->params = array(

			array(
				'type'       => 'colorpicker',
				'param_name' => 'trigger_color',
				'heading'    => esc_html__( 'Trigger Color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' )
			),
			
			array(
				'type'       => 'dropdown',
				'param_name' => 'transform',
				'heading'    => esc_html__( 'Transformation', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Default', 'infinite-addons' )    => '',
					esc_html__( 'Uppercase', 'infinite-addons' )  => 'text-uppercase',
					esc_html__( 'Lowercase', 'infinite-addons' )  => 'text-lowercase',
					esc_html__( 'Capitalize', 'infinite-addons' ) => 'text-capitalize',
				),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' )
			),
			
			array(
				'type'        => 'textfield',
				'param_name'  => 'fs',
				'heading'     => esc_html__( 'Font Size', 'infinite-addons' ),
				'description' => esc_html__( 'Example: 20px', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-3',
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'lh',
				'heading'     => esc_html__( 'Line-Height', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-3',
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'fw',
				'heading'     => esc_html__( 'Font Weight', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-3',
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'ls',
				'heading'     => esc_html__( 'Letter Spacing', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			

		);

		$this->add_extras();
	}

	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' .$this->get_id();

		$elements[rella_implode( '%1$s .module-trigger' )] = array(
			'color' => $trigger_color
		);
		
		if( $lh ) {
			$elements[rella_implode( array( '%1$s li a', '%1$s .module-trigger' ) )]['line-height'] = $lh;
		}

		if ( $fs ) {
			$elements[rella_implode( array( '%1$s li a', '%1$s .module-trigger' ) )]['font-size'] = $fs;
		}

		if ( $fw ) {
			$elements[rella_implode( array( '%1$s li a', '%1$s .module-trigger' ) )]['font-weight'] = $fw;
		}
		if ( $ls ) {
			$elements[rella_implode( array( '%1$s li a', '%1$s .module-trigger' ) )]['letter-spacing'] = $ls;
		}		

		$this->dynamic_css_parser( $id, $elements );
	}
}
new RA_Lang_Chooser;