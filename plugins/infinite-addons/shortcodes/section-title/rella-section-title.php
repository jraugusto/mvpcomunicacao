<?php
/**
* Shortcode Section Title
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Section_Title extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_section_title';
		$this->title       = esc_html__( 'Section Title', 'infinite-addons' );
		$this->description = esc_html__( 'Add a section title', 'infinite-addons' );
		$this->icon        = 'fa fa-font';
		$this->scripts     = array( 'TweenMax', 'jquery-appear', 'SplitText' );
		$this->styles      = array( 'rella-sc-section-title', 'rella-sc-button' );

		parent::__construct();
	}

	public function get_params() {

		$url = rella_addons()->plugin_uri() . '/assets/img/sc-preview/section-title/';

		$advanced = array(
			array(
				'type'        => 'rella_advanced_checkbox',
				'param_name'  => 'adv_opts',
				'value'       =>  array( esc_html__( 'Simple Mode', 'infinite-addons' ) => 'true' ),
				'std'         => '',
			)
		);

		$custom_title = rella_get_font_params( 'title_', esc_html__( 'Title', 'infinite-addons' ), array(
			'element' => 'use_custom_fonts_title',
			'value'   => 'true',
		));

		$custom_subtitle = rella_get_font_params( 'content_', esc_html__( 'Subtitle', 'infinite-addons' ), array(
			'element' => 'use_custom_fonts_content',
			'value' => 'true',
		));

		$button = vc_map_integrate_shortcode( 'ra_button', 'ib_', esc_html__( 'Button', 'infinite-addons' ),
			array(
				'exclude' => array(
					'primary_color',
					'el_id',
					'el_class'
				),
			),
			array(
				'element' => 'show_button',
				'value' => 'yes',
			)
		);

		$effect = array(

			array(
				'type'        => 'dropdown',
				'param_name'  => 'effect_tag',
				'heading'     => esc_html__( 'Tag', 'infinite-addons' ),
				'description' => esc_html__( 'Select title tag to apply the effect', 'infinite-addons' ),
				'value'       => array(
					'h1',
					'h2',
					'h3',
					'h4',
					'h5',
					'h6',
					'p',
					'div',
				),
				'std' => 'h2',
				'dependency' => array(
					'element' => 'effect',
					'value' => array(
						'filling_effect',
						'resolving_effect',
						'slide_horizontal_effect',
						'slide_horizontal_vertical'
					),
				),
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'filling_duration',
				'heading'     => esc_html__( 'Duration', 'infinite-addons' ),
				'description' => esc_html__( 'Add duration of the effect on the letter, for ex 0.07', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'effect',
					'value'   => array(
						'filling_effect',
					),
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'filling_stagger',
				'heading'     => esc_html__( 'Stagger', 'infinite-addons' ),
				'description' => esc_html__( 'Delay between letters effect, for ex 0.03', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'effect',
					'value'   => array(
						'filling_effect',
					),
				),
				'edit_field_class' => 'vc_col-sm-6',
			),


			array(
				'type'        => 'dropdown',
				'param_name'  => 'seperator',
				'heading'     => esc_html__( 'Separator', 'infinite-addons' ),
				'description' => esc_html__( 'Select a separator of the elements', 'infinite-addons' ),
				'value'       => array(
					'chars',
					'words',
					'lines',
				),
				'dependency' => array(
					'element' => 'effect',
					'value' => array(
						'resolving_effect'
					),
				),
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'autoplay',
				'heading'    => esc_html__( 'Autoplay', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'No', 'infinite-addons' )  => '',
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes',
				),
				'dependency' => array(
					'element' => 'effect',
					'value' => array(
						'slide_horizontal_effect',
						'slide_horizontal_vertical'
					),
				),
				'edit_field_class' => 'vc_col-sm-6',

			),

			array(
				'type'       => 'textfield',
				'param_name' => 'delay',
				'heading'    => esc_html__( 'Delay', 'infinite-addons' ),
				'description' => esc_html__( 'Delay time between slider, ex. 2000', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'effect',
					'value' => array(
						'slide_horizontal_effect',
						'slide_horizontal_vertical'
					),
				),
				'edit_field_class' => 'vc_col-sm-6',

			),

			array(
				'type' => 'textfield',
				'param_name' => 'startdelay',
				'heading' => esc_html__( 'Start Delay', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'effect',
					'value' => array(
						'resolving_effect'
					),
				),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type' => 'textfield',
				'param_name' => 'start_resolving',
				'heading' => esc_html__( 'Start', 'infinite-addons' ),
				'description' => esc_html__( 'The time between start and end ex. 0.12000', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'effect',
					'value' => array(
						'resolving_effect'
					),
				),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type' => 'textfield',
				'param_name' => 'end_resolving',
				'heading' => esc_html__( 'End', 'infinite-addons' ),
				'description' => esc_html__( 'The time between start and end ex. 0.52000', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'effect',
					'value' => array(
						'resolving_effect'
					),
				),
				'edit_field_class' => 'vc_col-sm-4',
			),

		);

		foreach( $effect as &$param ) {
			$param['group'] = esc_html__( 'Effect Options', 'infinite-addons' );
		}

		$this->params = array_merge(

			$advanced,

			array(

				array(
					'type'        => 'select_preview',
					'param_name'  => 'style',
					'heading'     => esc_html__( 'Section title style', 'infinite-addons' ),
					'description' => ' ',
					'value'       => array(

						array(
							'value' => 'default',
							'label' => esc_html__( 'Default', 'infinite-addons' ),
							'image' => $url . 'section-title-default.png'
						),

						array(
							'label' => esc_html__( 'Big', 'infinite-addons' ),
							'value' => 'big',
							'image' => $url . 'section-title-big.png'
						),

						array(
							'label' => esc_html__( 'Classic', 'infinite-addons' ),
							'value' => 'classic',
							'image' => $url . 'section-title-classic.png'
						),

						array(
							'label' => esc_html__( 'Classic 02', 'infinite-addons' ),
							'value' => 'classic2',
							'image' => $url . 'section-title-classic2.png'
						),

						array(
							'label' => esc_html__( 'Classic 03', 'infinite-addons' ),
							'value' => 'classic3',
							'image' => $url . 'section-title-classic3.png'
						),

						array(
							'label' => esc_html__( 'Classic 04', 'infinite-addons' ),
							'value' => 'classic4',
							'image' => $url . 'section-title-classic4.png'
						),

						array(
							'label' => esc_html__( 'Classic 05', 'infinite-addons' ),
							'value' => 'classic5',
							'image' => $url . 'section-title-classic4-alt.png'
						),

						array(
							'label' => esc_html__( 'Classic 06', 'infinite-addons' ),
							'value' => 'classic6',
							'image' => $url . 'section-title-classic5.png'
						),

						array(
							'label' => esc_html__( 'Classic 07', 'infinite-addons' ),
							'value' => 'classic7',
							'image' => $url . 'section-title-classic6.png'
						),

						array(
							'label' => esc_html__( 'Classic 8' , 'infinite-addons' ),
							'value' => 'resolve',
							'image' => $url . 'resolve.png',
						),

						array(
							'label' => esc_html__( 'Icon', 'infinite-addons' ),
							'value' => 'icon',
							'image' => $url . 'section-title-icon.png'
						),

						array(
							'label' => esc_html__( 'Numerical', 'infinite-addons' ),
							'value' => 'numerical',
							'image' => $url . 'section-title-numerical.png'
						),

						array(
							'label' => esc_html__( 'Numerical Alt', 'infinite-addons' ),
							'value' => 'numerical-alt',
							'image' => $url . 'section-title-numerical-alt.png'
						),

						array(
							'label' => esc_html__( 'Thick', 'infinite-addons' ),
							'value' => 'thick',
							'image' => $url . 'section-title-thick.png'
						),

						array(
							'label' => esc_html__( 'Thick 02', 'infinite-addons' ),
							'value' => 'thick2',
							'image' => $url . 'section-title-thick2.png'
						),

						array(
							'label' => esc_html__( 'Thick 03', 'infinite-addons' ),
							'value' => 'thick3',
							'image' => $url . 'section-title-thick3.png'
						),

						array(
							'label' => esc_html__( 'Side Line', 'infinite-addons' ),
							'value' => 'side-line',
							'image' => $url . 'section-title-side-line.png'
						),

						array(
							'label' => esc_html__( 'Underline', 'infinite-addons' ),
							'value' => 'underline',
							'image' => $url . 'section-title-blue-underlined.png'
						),

						array(
							'label' => esc_html__( 'Underline 02', 'infinite-addons' ),
							'value' => 'underline2',
							'image' => $url . 'section-title-blue-underline2.png'
						),

						array(
							'label' => esc_html__( 'Underline 03', 'infinite-addons' ),
							'value' => 'underline3',
							'image' => $url . 'section-title-red-underline.png'
						),

						array(
							'label' => esc_html__( 'Underline 04', 'infinite-addons' ),
							'value' => 'underline4',
							'image' => $url . 'section-title-underlined-title.png'
						),

						array(
							'label' => esc_html__( 'Underline 05', 'infinite-addons' ),
							'value' => 'underline5',
							'image' => $url . 'section-title-orange-underline.png'
						),

						array(
							'label' => esc_html__( 'Underline 06', 'infinite-addons' ),
							'value' => 'underline6',
							'image' => $url . 'section-title-red-underline2.png'
						),

						array(
							'label' => esc_html__( 'Subtitle Underlined', 'infinite-addons' ),
							'value' => 'sub-underlined',
							'image' => $url . 'section-title-underlined-subtitle.png'
						),

						array(
							'label' => esc_html__( 'With Sep', 'infinite-addons' ),
							'value' => 'sep',
							'image' => $url . 'section-title-lines-between.png'
						),

						array(
							'label' => esc_html__( 'Overlay', 'infinite-addons' ),
							'value' => 'overlay',
							'image' => $url . 'section-title-overlay.png',
						),

					),
					'save_always' => true,
				),

				array(
					'type' => 'subheading',
					'param_name' => 'title_heading',
					'heading' => esc_html__( 'Title', 'infinite-addons' ),
				),

				array(
					'id'          => 'title',
					'description' => esc_html__( 'Enter text for heading line.', 'infinite-addons' ),
					'value'       => esc_html__( 'Hey! I am first heading line feel free to change me', 'infinite-addons' ),
					'edit_field_class' => 'vc_col-sm-9',
				),

				array(
					'type'       => 'checkbox',
					'param_name' => 'use_custom_fonts_title',
					'heading'    => esc_html__( 'Custom font?', 'infinite-addons' ),
					'description' => esc_html__( 'Check to use custom font for title', 'infinite-addons' ),
					'dependency' => array(
						'element' => 'adv_opts',
						'is_empty' => true,
					),
					'edit_field_class' => 'vc_col-sm-3',
				),

				array(
					'type'       => 'param_group',
					'param_name' => 'items',
					'heading'    => esc_html__( 'Separated words for slider', 'infinite-addons' ),
					'value'      => '',
					'params'     => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'word',
							'heading'     => esc_html__( 'Title word', 'infinite-addons' ),
							'description' => esc_html__( 'Add word for title rotator', 'infinite-addons' ),
							'admin_label' => true,
							'edit_field_class' => 'vc_column-with-padding  vc_col-sm-6',
						),
						array(
							'type'        => 'colorpicker',
							'param_name'  => 'word_color',
							'heading'     => esc_html__( 'Title word color', 'infinite-addons' ),
							'description' => esc_html__( 'Pick a different color for the title word', 'infinite-addons' ),
							'edit_field_class' => 'vc_col-sm-6',
						),
					),
					'dependency' => array(
						'element' => 'effect',
						'value' => array(
							'slide_horizontal_effect',
							'slide_horizontal_vertical'
						),
					),
				),

				array(
					'type'        => 'dropdown',
					'param_name'  => 'alignment',
					'heading'     => esc_html__( 'Alignment', 'infinite-addons' ),
					'description' => esc_html__( 'Select title alignment', 'infinite-addons' ),
					'value'       => array(
						esc_html__( 'Center', 'infinite-addons' ) => 'align-center',
						esc_html__( 'Left', 'infinite-addons' )   => 'align-left',
						esc_html__( 'Right', 'infinite-addons' )  => 'align-right',
					),
					'dependency' => array(
						'element' => 'adv_opts',
						'is_empty' => true,
					),
					'edit_field_class' => 'vc_column-with-padding vc_col-sm-3',
				),

				array(
					'type'        => 'dropdown',
					'param_name'  => 'transform',
					'heading'     => esc_html__( 'Transformation', 'infinite-addons' ),
					'description' => esc_html__( 'Select title transformation', 'infinite-addons' ),
					'value'       => array(
						esc_html__( 'Default', 'infinite-addons' )    => '',
						esc_html__( 'Uppercase', 'infinite-addons' )  => 'text-uppercase',
						esc_html__( 'Lowercase', 'infinite-addons' )  => 'text-lowercase',
						esc_html__( 'Capitalize', 'infinite-addons' ) => 'text-capitalize',
					),
					'dependency' => array(
						'element' => 'adv_opts',
						'is_empty' => true,
					),
					'edit_field_class' => 'vc_col-sm-3',
				),

				array(
					'type'        => 'dropdown',
					'param_name'  => 'scheme',
					'heading'     => esc_html__( 'Scheme', 'infinite-addons' ),
					'description' => esc_html__( 'Select title scheme', 'infinite-addons' ),
					'value'       => array(
						esc_html__( 'Default', 'infinite-addons' ) => '',
						esc_html__( 'Inverse', 'infinite-addons' ) => 'inverse',
					),
					'dependency' => array(
						'element' => 'adv_opts',
						'is_empty' => true,
					),
					'edit_field_class' => 'vc_col-sm-3',
				),

				array(
					'type'        => 'dropdown',
					'param_name'  => 'effect',
					'heading'     => esc_html__( 'Effect', 'infinite-addons' ),
					'description' => esc_html__( 'Select title effect', 'infinite-addons' ),
					'value'       => array(
						esc_html__( 'None', 'infinite-addons' )    => '',
						esc_html__( 'Filling', 'infinite-addons' ) => 'filling_effect',
						esc_html__( 'Resolving', 'infinite-addons' ) => 'resolving_effect',
						esc_html__( 'Text Slide Horizontal', 'infinite-addons' ) => 'slide_horizontal_effect',
						esc_html__( 'Text Slide Vertical', 'infinite-addons' ) => 'slide_horizontal_vertical',
					),
					'dependency' => array(
						'element' => 'adv_opts',
						'is_empty' => true,
					),
					'edit_field_class' => 'vc_col-sm-3',
				),

			),

			$custom_title,

			array(

				array(
					'type' => 'subheading',
					'param_name' => 'sb_heading',
					'heading' => esc_html__( 'Subtitle', 'infinite-addons' ),
				),

				array(
					'type'       => 'textarea_html',
					'param_name' => 'content',
					'heading'    => esc_html__( 'Subtitle', 'infinite-addons' ),
					'edit_field_class' => 'vc_col-sm-9',
				),

				array(
					'type'       => 'checkbox',
					'param_name' => 'use_custom_fonts_content',
					'heading'    => esc_html__( 'Custom font?', 'infinite-addons' ),
					'description' => esc_html__( 'Check to use custom font for subtitle', 'infinite-addons' ),
					'dependency' => array(
						'element' => 'adv_opts',
						'is_empty' => true,
					),
					'edit_field_class' => 'vc_col-sm-3',
				),

				array(
					'type'       => 'dropdown',
					'param_name' => 'subtitle_transform',
					'heading'    => esc_html__( 'Subtitle Transformation', 'infinite-addons' ),
					'value'      => array(
						esc_html__( 'Default', 'infinite-addons' )    => '',
						esc_html__( 'Uppercase', 'infinite-addons' )  => 'text-uppercase',
						esc_html__( 'Lowercase', 'infinite-addons' )  => 'text-lowercase',
						esc_html__( 'Capitalize', 'infinite-addons' ) => 'text-capitalize',
					),
					'dependency' => array(
						'element' => 'adv_opts',
						'is_empty' => true,
					),
					'edit_field_class' => 'vc_col-sm-9',
				),

			),

			$custom_subtitle,

			array(

				array(
					'type'       => 'subheading',
					'param_name' => 'sb_heading',
					'heading'    => esc_html__( 'Secondary Options', 'infinite-addons' ),
					'dependency' => array(
						'element' => 'adv_opts',
						'is_empty' => true,
					),
				),

				array(
					'type'       => 'exploded_textarea',
					'param_name' => 'description',
					'heading'    => esc_html__( 'Text', 'infinite-addons' ),
					'dependency' => array(
						'element' => 'adv_opts',
						'is_empty' => true,
					),
					'edit_field_class' => 'vc_col-sm-9',
				),

				array(
					'type'       => 'dropdown',
					'param_name' => 'show_button',
					'heading'    => esc_html__( 'Add Button?', 'infinite-addons' ),
					'description' => esc_html__( 'Will add a button to the section title', 'infinite-addons' ),
					'value'      => array(
						esc_html__( 'No', 'infinite-addons' )  => '',
						esc_html__( 'Yes', 'infinite-addons' ) => 'yes'
					),
					'dependency' => array(
						'element' => 'adv_opts',
						'is_empty' => true,
					),
					'edit_field_class' => 'vc_col-sm-6',
				),

			),
			$effect,
			rella_get_icon_params( false, '', 'all', array( 'color', 'size', 'margin-left', 'margin-right' ), 'i_', array( 'element' => 'adv_opts', 'is_empty' => true ) ),
			$button,
			array(

				array(
					'type'       => 'css_editor',
					'param_name' => 'css',
					'heading'    => esc_html__( 'CSS box', 'infinite-addons' ),
					'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				),

				array(
					'type'        => 'colorpicker',
					'param_name'  => 'icon_color',
					'heading'     => esc_html__( 'Icon Color', 'infinite-addons' ),
					'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
					'dependency' => array(
						'element' => 'style',
						'value_not_equal_to' => array( 'underline', 'thick', 'thick2' ),
					),
					'edit_field_class' => 'vc_col-sm-6',
				),

				array(
					'type'        => 'colorpicker',
					'param_name'  => 'hr_bg_color',
					'heading'     => esc_html__( 'HR Background Color', 'infinite-addons' ),
					'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
					'edit_field_class' => 'vc_col-sm-6',
				),
			)
		);

		$this->add_extras();
	}
	
	protected function load_js_sc() {

		$args = array( 'no_js' );
		
		if( 'overlay' === $this->atts['style'] ) {
			array_push( $args,
				'jquery-appear'
			);			
		}
		if( 'filling_effect' === $this->atts['effect'] || 'resolving_effect' === $this->atts['effect'] ) {
			array_push( $args,
				'SplitText',
				'jquery-appear'
			);
		}
		if( 'slide_horizontal_effect' === $this->atts['effect'] || 'slide_horizontal_vertical' === $this->atts['effect'] ) {
			array_push( $args,
				'jquery-appear'
			);			
		}

		return $args;
	}

	protected function get_title( $h_fonts ) {

		$style = esc_html( $this->atts['style'] );
		$title = do_shortcode( esc_html( $this->atts['title'] ) ) . $this->get_title_words();
		$icon  = rella_get_icon( $this->atts );

		if( !in_array( $style, array( 'underline', 'thick', 'thick2' ) ) && ! empty( $icon['type'] ) ) {
			if( 'left' == $icon['align'] ) {
				$title = sprintf( '<i class="icon %s"></i>%s', $icon['icon'], $title );
			} else {
				$title = sprintf( '%s<i class="icon %s"></i>', $title, $icon['icon'] );
			}
		}

		// Title
		if( $title ) {
			printf( '<%1$s>%2$s</%1$s>', isset( $h_fonts['tag'] ) ? $h_fonts['tag'] : 'h2', $title );
		}
	}

	protected function get_content( $c_fonts ) {

		if( empty( $this->atts['content'] ) ) {
			return;
		}

		$style   = esc_html( $this->atts['style'] );
		$transform = ! empty( $this->atts['subtitle_transform'] ) ? $this->atts['subtitle_transform'] : '';
		$content = do_shortcode( $this->atts['content'] );

		// Content
		if( $content ) {
			if( 'p' != $c_fonts['tag'] ) {
				if ( in_array( $style, array( 'resolve' ) ) ) {
					printf( '<%1$s class="%3$s">%2$s</%1$s>', $c_fonts['tag'], wp_kses_post( ra_helper()->do_the_content( $content, false ) ), $transform );
				}
				else {
					printf( '<%1$s class="subtitle %3$s">%2$s</%1$s>', $c_fonts['tag'], wp_kses_post( ra_helper()->do_the_content( $content, false ) ), $transform );
				}
			}
			else {
				$content = wp_kses_post( ra_helper()->do_the_content( $content, true ) );
				if ( in_array( $style, array( 'underline', 'underline2', 'underline4', 'big', 'numerical-alt', 'classic6', 'resolve' ) ) )  {
					echo $content;
				} else {
					echo str_replace( '<p>', '<p class="subtitle ' . $transform . '">', $content );
				}
			}
		}
	}

	protected function get_title_effect() {

		$effect_data = $effect_opts = array();

		$style = $this->atts['style'];
		if( 'overlay' === $style ) {
			$effect_data[] = ' data-element-inview="true"';
		}
		elseif( empty( $this->atts['effect'] ) ){
			return;
		}

		$effect = $this->atts['effect'];
		$tag    = $this->atts['effect_tag'];

		$effect_opts['element'] = $tag;

		if( 'filling_effect' === $effect ){

			$effect_opts['duration'] = ! empty( $this->atts['filling_duration'] ) ? $this->atts['filling_duration'] : '0.07';
			$effect_opts['stagger'] = ! empty( $this->atts['filling_stagger'] ) ? $this->atts['filling_stagger'] : '0.03';

			$effect_data[] = ' data-plugin-fillin="true" ';
			$effect_data[] = ' data-plugin-fillin-options=\'' . wp_json_encode( $effect_opts ) . '\' ';
		}
		elseif( 'resolving_effect' === $effect ) {
			$effect_opts['seperator'] = $this->atts['seperator'];
			$effect_opts['startDelay'] = ! empty( $this->atts['startdelay'] ) ? (int)$this->atts['startdelay'] : 0 ;

			if( ! empty( $this->atts['start_resolving'] ) ) {
				$effect_opts['start'] =  (float)$this->atts['start_resolving'];
			}

			if( ! empty( $this->atts['end_resolving'] ) ) {
				$effect_opts['end'] = (float)$this->atts['end_resolving'];
			}

			$effect_data[] = ' data-plugin-resolve="true" ';
			$effect_data[] = ' data-plugin-resolve-options=\'' . wp_json_encode( $effect_opts ) . '\' ';
		}
		elseif( 'slide_horizontal_effect' === $effect ){

			$effect_opts['autoplay'] = ( 'yes' === $this->atts['autoplay'] ) ? true : false;

			if( ! empty( $this->atts['delay'] ) ) {
				$effect_opts['delay'] =  (int)$this->atts['delay'];
			}

			$effect_data[] = ' data-plugin-texteffect="true" ';
			$effect_data[] = ' data-plugin-options=\'' . wp_json_encode( $effect_opts ) . '\' ';
		}
		elseif( 'slide_horizontal_vertical' === $effect ) {

			$effect_opts['autoplay'] = ( 'yes' === $this->atts['autoplay'] ) ? true : false;

			if( ! empty( $this->atts['delay'] ) ) {
				$effect_opts['delay'] =  (int)$this->atts['delay'];
			}

			$effect_data[] = ' data-plugin-textslide="true" ';
			$effect_data[] = ' data-plugin-textslide-options=\'' . wp_json_encode( $effect_opts ) . '\' ';
		}

		$effect_data =  implode( ' ', $effect_data );
		echo $effect_data;

	}

	protected function get_title_words() {

		if( empty( $this->atts['items'] ) ) {
			return;
		}

		$words = vc_param_group_parse_atts( $this->atts['items'] );
		$words = array_filter( $words );

		if( empty( $words ) ) {
			return;
		}

		$out = $style_word = '';

		if( 'slide_horizontal_effect' === $this->atts['effect'] ) {

			$out .= ' <span class="typed-strings">';
			foreach ( $words as $word ) {
				if( ! empty( $word['word_color'] ) ) {
					$style_word = 'style="color:' . esc_attr( $word['word_color'] ) . '"';
				}
				$out .= '<span ' . $style_word . '>' . esc_html( $word['word'] ) . '</span>';
			}
			$out .= '</span><!-- /.typed-strings -->';

			return $out;

		}
		elseif( 'slide_horizontal_vertical' === $this->atts['effect'] ) {

			$out .= ' <span class="typed-keywords">';
			$i = 1;
			foreach ( $words as $word ) {
				if( ! empty( $word['word_color'] ) ) {
					$style_word = 'style="color:' . esc_attr( $word['word_color'] ) . '"';
				}
				$active = ( $i == 1 ) ? ' active' : '';
				$out .= '<span class="keyword' . $active . '" ' . $style_word . '>' . esc_html( $word['word'] ) . '</span>';
				$i++;
			}
			$out .= '</span><!-- /.typed-keywords -->';

			return $out;

		}

	}

	protected function get_description() {

		if( empty( $this->atts['description'] ) ) {
			return;
		}

		$description = do_shortcode( $this->atts['description'] );
		$style       = esc_html( $this->atts['style'] );
		$icon        = rella_get_icon( $this->atts );

		if( in_array( $style, array( 'underline', 'thick', 'thick2' ) ) && ! empty( $icon['type'] ) ) {
			$description = sprintf( '<i class="icon %s"></i>%s', $icon['icon'], $description );
		}

		printf( '<p>%s</p>', str_replace( ',', '<br />', $description ) );
	}

	protected function get_style_class( $style ) {

		$hash = array(
			'default'        => 'section-title-default',
			'classic'        => 'section-title-classic',
			'classic2'       => 'section-title-classic2',
			'classic3'       => 'section-title-classic3',
			'classic4'       => 'section-title-classic4',
			'classic5'       => 'section-title-classic4-alt',
			'classic6'       => 'section-title-classic5',
			'classic7'       => 'section-title-classic6',
			'icon'           => 'section-title-icon',
			'sep'            => 'section-title-lines-between',
			'side-line'      => 'section-title-side-line',
			'underline'      => 'section-title-blue-underline',
			'underline2'     => 'section-title-blue-underline2',
			'underline3'     => 'section-title-red-underline',
			'underline4'     => 'section-title-underlined-title',
			'underline5'     => 'section-title-orange-underline',
			'underline6'     => 'section-title-red-underline2',
			'sub-underlined' => 'section-title-underlined-subtitle',
			'big'            => 'section-title-big',
			'thick'          => 'section-title-thick',
			'thick2'         => 'section-title-thick2',
			'thick3'         => 'section-title-thick3',
			'numerical'      => 'section-title-numerical',
			'numerical-alt'  => 'section-title-numerical-alt',
			'resolve'        => 'section-title-default section-title-resolve',
			'overlay'        => 'section-title-overlay',
		);

		return $hash[ $style ];
	}

	protected function get_button() {

		if ( empty( $this->atts['show_button'] ) ) {
			return;
		}

		$data = vc_map_integrate_parse_atts( $this->slug, 'ra_button', $this->atts, 'ib_' );
		if ( $data ) {

			$btn = visual_composer()->getShortCode( 'ra_button' )->shortcodeClass();

			if ( is_object( $btn ) ) {
				echo $btn->render( array_filter( $data ) );
			}
		}
	}

	protected function generate_css( $h_fonts, $c_fonts ) {

		$settings = get_option( 'wpb_js_google_fonts_subsets' );
		if ( is_array( $settings ) && ! empty( $settings ) ) {
			$subsets = '&subset=' . implode( ',', $settings );
		} else {
			$subsets = '';
		}

		extract( $this->atts );

		$elements = array();
		$id = '.' . $this->get_id();

		if( ! empty( $hr_bg_color ) ) {
			$elements[ rella_implode( array( '%1$s hr', '%1$s.section-title-thick h2:after', '%1$s.section-title-thick2 h2:after' ) ) ]['background-color'] = $hr_bg_color . ' !important;';
		}

		if( ! empty( $icon_color ) ) {
			$elements[ '%1$s .icon']['background-color'] = $icon_color;
		}

		if( ! empty( $h_fonts['styles'] ) ) {

			foreach( $h_fonts['styles'] as $raw ) {
				$raw = explode( ':', $raw );
				$elements[ '%1$s ' . $h_fonts['tag'] ][ trim( $raw[0] ) ] = trim( $raw[1] );
				$elements[ '%1$s ' . $h_fonts['tag'] ][ 'border-bottom-color' ] = trim( $raw[1] );
			}

			if ( $h_fonts['font_family'] ) {
				wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $h_fonts['font_family'] ), '//fonts.googleapis.com/css?family=' . $h_fonts['font_family'] . $subsets );
			}
		}

		if( ! empty( $c_fonts['styles'] ) ) {

			foreach( $c_fonts['styles'] as $raw ) {
				$raw = explode( ':', $raw );
				$elements[ '%1$s '.$c_fonts['tag'].'.subtitle' ][ trim( $raw[0] ) ] = trim( $raw[1] );
				$elements[ '%1$s '.$c_fonts['tag']][ trim( $raw[0] ) ] = trim( $raw[1] );
			}

			if ( $c_fonts['font_family'] ) {
				wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $c_fonts['font_family'] ), '//fonts.googleapis.com/css?family=' . $c_fonts['font_family'] . $subsets );
			}
		}

		$this->dynamic_css_parser( $id, $elements );
	}

	public function get_heading( $param, $tag = 'h6' ) {

		return rella_get_font( $this->slug, $this->atts, $param, $tag );
	}
}
new RA_Section_Title;
