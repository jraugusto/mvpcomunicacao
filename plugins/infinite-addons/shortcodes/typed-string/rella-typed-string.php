<?php
/**
* Shortcode Types string
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Typed_Strings extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_typed_strings';
		$this->title       = esc_html__( 'Typed string', 'infinite-addons' );
		$this->description = esc_html__( 'Typed animated string', 'infinite-addons' );
		$this->icon        = 'fa fa-star';
		$this->scripts     = array( 'typed' );
		$this->styles      = array( 'rella-sc-typed' );

		parent::__construct();
	}

	public function get_params() {

		$this->params = array(
			
			array(
				'type' => 'textfield',
				'param_name' => 'before_text',
				'heading' => esc_html__( 'Text Before', 'infinite-addons' ),
				'description' => esc_html__( 'Content before the text with typed effect', 'infinite-addons' ),
			),

			array(
				'type' => 'param_group',
				'param_name' => 'titles',
				'params' => array(

					array( 
						'id'      => 'title',
						'heading' => esc_html__( 'Text with Typed effect', 'infinite-addons' ), )
				)
			),
			
			array(
				'type'        => 'textfield',
				'param_name'  => 'after_text',
				'heading'     => esc_html__( 'Text After', 'infinite-addons' ),
				'description' => esc_html__( 'Content after the text with typed effect', 'infinite-addons' ),
			),
			
			array(
				'type'       => 'subheading',
				'param_name' => 'sb',
				'heading'    => 'Custom Typo for typewrite text',
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
			),

			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Use for Typewrite text theme default font family?', 'infinite-addons' ),
				'param_name'  => 'use_theme_fonts',
				'value'       => array(
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes'
				),
				'description' => esc_html__( 'Use font family from the theme.', 'infinite-addons' ),
				'std'         => 'yes',
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
			),

			array(
				'type'       => 'google_fonts',
				'param_name' => 'text_font',
				'value'      => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
				'settings'   => array(
					'fields' => array(
						'font_family_description' => esc_html__( 'Select font family.', 'infinite-addons' ),
						'font_style_description'  => esc_html__( 'Select font styling.', 'infinite-addons' ),
					),
				),
				'dependency' => array(
					'element'            => 'use_theme_fonts',
					'value_not_equal_to' => 'yes',
				),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'txt_color',
				'heading'    => esc_html__( 'Text Color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
			),
			
			array(
				'type'        => 'textfield',
				'param_name'  => 'txt_fs',
				'heading'     => esc_html__( 'Font Size', 'infinite-addons' ),
				'description' => esc_html__( 'Set font size, ex. 20px', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			
			array(
				'type'        => 'textfield',
				'param_name'  => 'txt_fw',
				'heading'     => esc_html__( 'Font Weght', 'infinite-addons' ),
				'description' => esc_html__( 'Set font weight, ex. 600', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-3',
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'txt_lh',
				'heading'     => esc_html__( 'Line Height', 'infinite-addons' ),
				'description' => esc_html__( 'Set line height, ex. 20px', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			
			array(
				'type'        => 'textfield',
				'param_name'  => 'txt_ls',
				'heading'     => esc_html__( 'Letter Spacing', 'infinite-addons' ),
				'description' => esc_html__( 'Set letter spacing, ex. 1px', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-3',
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'sb_other',
				'heading'    => 'Custom Typo for Before&After text',
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
			),

			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Use for Before&After text theme default font family?', 'infinite-addons' ),
				'param_name'  => 'use_other_theme_fonts',
				'value'       => array(
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes'
				),
				'description' => esc_html__( 'Use font family from the theme.', 'infinite-addons' ),
				'std'         => 'yes',
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
			),

			array(
				'type'       => 'google_fonts',
				'param_name' => 'other_font',
				'value'      => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
				'settings'   => array(
					'fields' => array(
						'font_family_description' => esc_html__( 'Select font family.', 'infinite-addons' ),
						'font_style_description'  => esc_html__( 'Select font styling.', 'infinite-addons' ),
					),
				),
				'dependency' => array(
					'element'            => 'use_other_theme_fonts',
					'value_not_equal_to' => 'yes',
				),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
			),
			
			array(
				'type'       => 'colorpicker',
				'param_name' => 'text_color',
				'heading'    => esc_html__( 'Text Color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
			),
			
			array(
				'type'        => 'textfield',
				'param_name'  => 'fs',
				'heading'     => esc_html__( 'Font Size', 'infinite-addons' ),
				'description' => esc_html__( 'Set font size, ex. 20px', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			
			array(
				'type'        => 'textfield',
				'param_name'  => 'fw',
				'heading'     => esc_html__( 'Font Weght', 'infinite-addons' ),
				'description' => esc_html__( 'Set font weight, ex. 600', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-3',
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'lh',
				'heading'     => esc_html__( 'Line Height', 'infinite-addons' ),
				'description' => esc_html__( 'Set line height, ex. 20px', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			
			array(
				'type'        => 'textfield',
				'param_name'  => 'ls',
				'heading'     => esc_html__( 'Letter Spacing', 'infinite-addons' ),
				'description' => esc_html__( 'Set letter spacing, ex. 1px', 'infinite-addons' ),
				'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			

			
			
			
			
			
			
		);

		$this->add_extras();
	}
	
	protected function before_text() {
		
		if( empty( $this->atts['before_text'] ) ) {
			return;
		}
		
		printf( '<span>%s</span>', esc_html( $this->atts['before_text'] ) );
		
	}
	
	protected function after_text() {
		
		if( empty( $this->atts['after_text'] ) ) {
			return;
		}
		
		printf( '<span>%s</span>', esc_html( $this->atts['after_text'] ) );
		
	}

	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' . $this->get_id();
		$text_font_inline_style = '';
		$other_font_inline_style = '';

		if( 'yes' !== $use_theme_fonts ) {

			// Build the data array
			$text_font_data = $this->get_fonts_data( $text_font );

			// Build the inline style
			$text_font_inline_style = $this->google_fonts_style( $text_font_data );

			// Enqueue the right font
			$this->enqueue_google_fonts( $text_font_data );

		}
		
		if( 'yes' !== $use_other_theme_fonts ) {

			// Build the data array
			$other_text_font_data = $this->get_fonts_data( $other_font );

			// Build the inline style
			$other_font_inline_style = $this->google_fonts_style( $other_text_font_data );

			// Enqueue the right font
			$this->enqueue_google_fonts( $other_text_font_data );

		}

		$elements[rella_implode( '%1$s span' )] = array(
			$other_font_inline_style,
			'color'          => $text_color,
			'font-size'      => $fs,
			'font-weight'    => $fw,
			'line-height'    => $lh,
			'letter-spacing' => $ls
		);
		
		$elements[rella_implode( '%1$s .typed-strings,%1$s .typed-element,%1$s .typed-cursor' )] = array(
			$text_font_inline_style,
			'color'          => $txt_color,
			'font-size'      => $txt_fs,
			'font-weight'    => $txt_fw,
			'line-height'    => $txt_lh,
			'letter-spacing' => $txt_ls
		);

		$this->dynamic_css_parser( $id, $elements );
	}
	
}
new RA_Typed_Strings;