<?php
/**
* Shortcode Content Box
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Content_Box extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_content_box';
		$this->title       = esc_html__( 'Content Box', 'infinite-addons' );
		$this->icon        = 'fa fa-dot-circle-o';
		$this->description = esc_html__( 'Create a content box', 'infinite-addons' );
		$this->scripts     = array( 'ofi-polyfill', 'jquery-panr', 'TweenMax' );
		$this->styles      = array( 'rella-sc-content-box', 'rella-sc-button' );

		parent::__construct();
	}

	public function get_params() {

		$url = rella_addons()->plugin_uri() . '/assets/img/sc-preview/content-box/';

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

		$params = array(

			array(
				'type'       => 'select_preview',
				'param_name' => 'style',
				'heading'    => esc_html__( 'Style', 'infinite-addons' ),
				'value'      => array(

					array(
						'value' => 's0',
						'label' => esc_html__( 'Default', 'infinite-addons' ),
						'image' => $url . 'default.png'
					),

					array(
						'label' => esc_html__( 'Bordered Box', 'infinite-addons' ),
						'value' => 's13',
						'image' => $url . 'bordered.png'
					),

					array(
						'label' => esc_html__( 'Boxed', 'infinite-addons' ),
						'value' => 's6',
						'image' => $url . 'boxed.png'
					),

					array(
						'label' => esc_html__( 'Boxed Centered', 'infinite-addons' ),
						'value' => 's3',
						'image' => $url . 'boxed-centered.png'
					),

					array(
						'label' => esc_html__( 'Boxed with arrow', 'infinite-addons' ),
						'value' => 's4',
						'image' => $url . 'boxed-w-arrow.png'
					),

					array(
						'label' => esc_html__( 'Box with Large Image', 'infinite-addons' ),
						'value' => 's7',
						'image' => $url . 'boxed-w-large-img-left.png'
					),

					array(
						'label' => esc_html__( 'Box with Large Image Alt', 'infinite-addons' ),
						'value' => 's8',
						'image' => $url . 'boxed-w-large-img-right.png'
					),

					array(
						'label' => esc_html__( 'Button Centered', 'infinite-addons' ),
						'value' => 's12',
						'image' => $url . 'btn-centered.png'
					),

					array(
						'label' => esc_html__( 'Button Centered 2', 'infinite-addons' ),
						'value' => 's12-alt',
						'image' => $url . 'btn-centered.png'
					),

					array(
						'label' => esc_html__( 'Caption Hover', 'infinite-addons' ),
						'value' => 's5',
						'image' => $url . 'caption.png'
					),

					array(
						'label' => esc_html__( 'Centered Content', 'infinite-addons' ),
						'value' => 's9',
						'image' => $url . 'centered-content.png'
					),

					array(
						'label' => esc_html__( 'Content on Image', 'infinite-addons' ),
						'value' => 's2',
						'image' => $url . 'content-on-img.png'
					),

					array(
						'label' => esc_html__( 'Hover Effect Thumbnail', 'infinite-addons' ),
						'value' => 's10',
						'image' => $url . 'hover-effect-thumbnail.png'
					),

					array(
						'label' => esc_html__( 'Hover Effect Thumbnail - Alt', 'infinite-addons' ),
						'value' => 's11',
						'image' => $url . 'hover-effect-thumbnail-alt.png'
					),

					array(
						'label' => esc_html__( 'Numbered', 'infinite-addons' ),
						'value' => 's1',
						'image' => $url . 'numbered.png'
					)
				),
				'save_always' => true,
			),

			array(
				'id'          => 'title',
				'dependency'  => array(
					'element' => 'style',
					'value_not_equal_to' => array( 's12', 's12-alt' ),
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'heading_weight',
				'heading'    => esc_html__( 'Title Weight', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Default', 'infinite-addons' )   => '',
					esc_html__( 'Light', 'infinite-addons' )     => 'weight-light',
					esc_html__( 'Normal', 'infinite-addons' )    => 'weight-normal',
					esc_html__( 'Medium', 'infinite-addons' )    => 'weight-medium',
					esc_html__( 'Semi Bold', 'infinite-addons' ) => 'weight-semibold',
					esc_html__( 'Bold', 'infinite-addons' )      => 'weight-bold',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'textarea',
				'param_name'  => 'info',
				'heading'     => esc_html__( 'Box info', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 's2', 's7', 's8', 's9', 's10', 's11' )
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'textarea',
				'param_name' => 'info2',
				'heading'    => esc_html__( 'Box info 2', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'style',
					'value'   => array( 's7', 's8' )
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'textfield',
				'param_name' => 'number',
				'heading'    => esc_html__( 'Number', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'style',
					'value'   => array( 's1' )
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'rella_attach_image',
				'param_name'  => 'image',
				'heading'     => esc_html__( 'Image', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'style',
					'value_not_equal_to'   => array( 's1', 's13' ),
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'rella_attach_image',
				'param_name'  => 'overlay_image',
				'heading'     => esc_html__( 'Overlay Image (optional)', 'infinite-addons' ),
				'description' => esc_html__( 'Overlay Image will display on hover main image of the content box', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'style',
					'value_not_equal_to'   => array( 's1', 's13' ),
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'position',
				'heading'     => esc_html__( 'Position', 'infinite-addons' ),
				'description' => esc_html__( 'Image Position', 'infinite-addons' ),
				'value'       => array(
					esc_html__( 'Left', 'infinite-addons' )  => 'left',
					esc_html__( 'Right', 'infinite-addons' ) => 'right',
				),
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 's4', 's8' )
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'vc_link',
				'param_name'  => 'img_link',
				'heading'     => esc_html__( 'Link for image', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 's2', 's9' )
				),
			),

			array(
				'type'       => 'textarea_html',
				'param_name' => 'content',
				'heading'    => esc_html__( 'Text', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to'   => array( 's12', 's12-alt' )
				)
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'show_button',
				'heading'    => esc_html__( 'Show Button', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'No', 'infinite-addons' )  => '',
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes'
				),
			)

		);

		//Design Options
		$design_params = array(

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'primary_color',
				'heading'     => esc_html__( 'Primary Color', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-4'
			),

			//title customization
			array(
				'type'        => 'subheading',
				'param_name'  => 'sh_content',
				'heading'     => esc_html__( 'Content Styling', 'infinite-addons' )
			),

			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Use for Title theme default font family?', 'infinite-addons' ),
				'param_name'  => 'use_theme_fonts',
				'value'       => array(
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes'
				),
				'description' => esc_html__( 'Use font family from the theme.', 'infinite-addons' ),
				'std'         => 'yes',
			),

			array(
				'type'       => 'google_fonts',
				'param_name' => 'heading_font',
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
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'title_size',
				'heading'     => esc_html__( 'Title Size', 'infinite-addons' ),
				'description' => esc_html__( 'Add size in pixels/em e.g 15px', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'title_color',
				'heading'     => esc_html__( 'Title Color', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			//content customization
			array(
				'type'        => 'textfield',
				'param_name'  => 'content_size',
				'heading'     => esc_html__( 'Content Size', 'infinite-addons' ),
				'description' => esc_html__( 'Add size in pixels e.g 15px', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'content_color',
				'heading'     => esc_html__( 'Content Color', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			//counter customization
			array(
				'type'        => 'textfield',
				'param_name'  => 'counter_size',
				'heading'     => esc_html__( 'Counter Size', 'infinite-addons' ),
				'description' => esc_html__( 'Add size in pixels e.g 15px', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'style',
					'value'   => 's1'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'counter_color',
				'heading'     => esc_html__( 'Counter Color', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'style',
					'value'   => 's1'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

		);
		foreach( $design_params as &$param ) {
			$param['group'] = esc_html__( 'Design Options', 'infinite-addons' );
		}

		$this->params = array_merge( $params, $design_params, $button );
		$this->add_extras();
	}

	protected function load_js_sc() {

		$args = array( 'no_js' );

		if( 's5' === $this->atts['style'] || ! empty( $this->atts['overlay_image'] ) ){
			array_push( $args,
				'ofi-polyfill'
			);
		}
		if( 's12' === $this->atts['style'] || 's12-alt' === $this->atts['style'] ) {
			array_push( $args,
				'jquery-panr',
				'TweenMax'
			);
		}

		return $args;
	}

	public function before_output( $atts, &$content ) {

		if( 's4' == $atts['style'] ) {
			$atts['template'] = 'box-with-arrow';
		}
		elseif( 's7' == $atts['style'] ) {
			$atts['template'] = 'big-img';
		}
		elseif( 's8' == $atts['style'] ) {
			$atts['template'] = 'big-img-right';
		}
		elseif( 's9' == $atts['style'] ) {
			$atts['template'] = 'centered';
		}
		elseif( 's10' == $atts['style'] || 's11' == $atts['style'] ) {
			$atts['template'] = 'effect-thumbnail';
		}
		elseif( 's12' == $atts['style'] ||  's12-alt' == $atts['style'] ) {
			$atts['template'] = 'button-centered';
		}

		return $atts;
	}

	protected function get_title() {

		// check
		$style = $this->atts['style'];
		if( empty( $this->atts['title'] ) ) {
			return '';
		}

		$weight = $this->atts['heading_weight'];

		if ( ! empty ( $weight ) ) {
			$weight	 = ' class="' . $weight . '" ';
		}

		if( 's4' == $style ) {
			$title = sprintf( '<h3%s><i class="fa fa-check"></i>%s</h3>', $weight, $this->atts['title'] );
		}
		elseif( 's1' == $style) {
			$title = sprintf( '<h3 class="weight-normal">%s</h3>', $this->atts['title'] );
		}
		elseif( 's10' == $style || 's11' == $style ) {
			$title = sprintf( '<h3 class="text-uppercase">%s</h3>', $this->atts['title'] );
		}
		else {
			$title = sprintf( '<h3%s>%s</h3>', $weight, $this->atts['title'] );
		}

		echo $title;
	}

	protected function get_info() {

		// check
		$style = $this->atts['style'];
		if( empty( $this->atts['info'] ) ) {
			return '';
		}

		if( 's7' == $style || 's8' == $style ) {
			$info = sprintf( '<h6 class="content-box-info text-uppercase">%s</h6>', $this->atts['info'] );
		}
		else {
			$info = sprintf( '<span class="content-box-info text-uppercase">%s</span>', $this->atts['info'] );
		}

		echo $info;
	}

	protected function get_info2() {

		// check
		if( empty( $this->atts['info2'] ) ) {
			return '';
		}

		$info = sprintf( '<h6 class="content-box-info-2">%s</h6>', $this->atts['info2'] );

		echo $info;
	}

	protected function get_number() {

		// check
		if( empty( $this->atts['number'] ) ) {
			return '';
		}

		$number = sprintf( '<span class="number">%s</span>', $this->atts['number'] );

		echo $number;
	}

	protected function get_image() {

		// check
		if( empty( $this->atts['image'] ) ) {
			return;
		}

		$img_src = '';
		if( preg_match( '/^\d+$/', $this->atts['image'] ) ){
			$src = rella_get_image_src( $this->atts['image'] );
			$img_src = $src[0];
			$html = wp_get_attachment_image( $this->atts['image'], 'full', false, array( 'data-rjs' => $img_src ) );
		} else {
			$img_src  = $this->atts['image'];
			$html = '<img src="' . esc_url( $img_src ) . '" alt="" data-rjs="' .  esc_url( $img_src ) . '" />';
		}

		$link  = rella_get_link_attributes( $this->atts['img_link'], false );

		$overlay_image = $this->get_overlay_image();
		$style = $this->atts['style'];

		$image = '';

		if ( ! empty ( $link['href'] ) ) {
			$image = sprintf( '<figure>%3$s %1$s<a%2$s class="content-box-link text-hide">Click</a></figure>', $html, ra_helper()->html_attributes( $link ), $overlay_image );
		}
		elseif( 's10' == $style || 's11' == $style ) {
			$image = $html;
		}
		elseif( 's12' == $style || 's12-alt' == $style ) {
			$image = sprintf( '<figure><img data-panr="true" data-plugin-options=\'{ "scaleDuration": 0.5, "scaleTo": 1.08,"moveTarget": ".content-box" }\' src="%s" alt="%s" /></figure>', $img_src, $this->atts['title'] );
		}
		else {
			$image = sprintf( '<figure>%s %s</figure>',$overlay_image, $html );
		}

		echo $image;
	}

	protected function get_overlay_image() {

		// check
		if( empty( $this->atts['overlay_image'] ) ) {
			return '';
		}

		if( preg_match( '/^\d+$/', $this->atts['overlay_image'] ) ){
			$src    = rella_get_image_src( $this->atts['overlay_image'] );
			$image  = wp_get_attachment_image( $this->atts['overlay_image'], 'full', false, array( 'data-rjs' => $src[0] ) );
		} else {
			$src   = $this->atts['overlay_image'];
			$image = '<img src="' . esc_url( $src ) . '" alt="" data-rjs="' .  esc_url( $src ) . '" />';
		}

		$out = '<figure class="overlay-image">
					'. $image .'
				</figure>';

		return $out;

	}

	protected function get_background( $pos ) {

		// check
		if( empty( $this->atts['image'] ) ) {
			return '';
		}
		if ( $this->atts['position'] != $pos ) {
			return '';
		}

		$bg = '';
		if( $bg = rella_get_image( $this->atts['image'] ) ) {
			$bg = sprintf( '<figure class="col-md-6 no-padding" style="background: url(%s); background-size: cover;"></figure>', $bg );
		}

		echo $bg;

	}

	protected function get_content() {

		// check
		if( empty( $this->atts['content'] ) ) {
			return '';
		}

		$content = ra_helper()->do_the_content( $this->atts['content'] );

		echo $content;
	}

	protected function get_class( $style ) {

		$hash = array(
			's0'  => 'content-box-default content-box-classic',
			's1'  => 'content-box-boxed-numbered content-box-with-border content-box-boxed',
			's2'  => 'content-box-img-alternate text-center',
			's3'  => 'content-box-boxed-centered content-box-default content-box-with-border text-center',
			's4'  => 'content-box-arrow',
			's5'  => 'content-box-caption',
			's6'  => 'content-box-boxed content-box-boxed-default content-box-default content-box-with-border',
			's7'  => 'content-box-big-img content-box-big-img-default carousel-cell',
			's8'  => 'content-box-big-img-alt content-box-big-img content-box-align-right',
			's9'  => 'content-box-info-centered text-center',
			's10' => 'content-box-img content-box-img-default text-center',
			's11' => 'content-box-img-info content-box-img content-box-default content-box-with-border text-center',
			's12' => 'content-box-btn',
			's12-alt' => 'content-box-btn content-box-btn-alt',
			's13' => 'content-box-bordered',
		);

		return $hash[ $style ];
	}

	protected function get_alignment() {

		// check
		if( empty( $this->atts['position'] ) ) {
			return '';
		}

		$pos = $this->atts['position'];

		return 'arrow-' . $pos;

	}

	protected function get_button() {

		if ( empty( $this->atts['show_button'] ) ) {
			return;
		}

		$data = vc_map_integrate_parse_atts( $this->slug, 'ra_button', $this->atts, 'ib_' );
		if ( $data ) {

			$data['primary_color'] = $this->atts['primary_color'];
			$btn = visual_composer()->getShortCode( 'ra_button' )->shortcodeClass();

			if ( is_object( $btn ) ) {
				echo $btn->render( array_filter( $data ) );
			}
		}
	}

	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' .$this->get_id();
		$title_font_inline_style = '';

		if( 'yes' !== $use_theme_fonts ) {

			// Build the data array
			$title_font_data = $this->get_fonts_data( $heading_font );

			// Build the inline style
			$title_font_inline_style = $this->google_fonts_style( $title_font_data );

			// Enqueue the right font
			$this->enqueue_google_fonts( $title_font_data );

		}

		$elements[rella_implode( '%1$s h3' )] = array(
			$title_font_inline_style,
			'color'     => $title_color . ' !important',
			'font-size' => $title_size . ' !important'
		);

		$elements[rella_implode( '%1$s .content-box-content p' )] = array(
			'color'     => $content_color . ' !important',
			'font-size' => $content_size . ' !important'
		);
		if( 's1' === $style ) {
			$elements[ rella_implode( '%1$s .number' ) ] =  array(
				'color'     => $counter_color . ' !important',
				'font-size' => $counter_size . ' !important',
			);
		}
		elseif( 's3' === $style ){
			$elements[ rella_implode( '%1$s.content-box-boxed-centered figure' ) ]['border-bottom-color'] = $primary_color;
		}
		elseif( 's4' === $style ){
			$elements[ rella_implode( '%1$s .content-box-content' ) ]['background'] = $primary_color;
			$elements[ rella_implode( '%1$s.arrow-left:before' ) ]['border-right-color'] = $primary_color;
			$elements[ rella_implode( '%1$s.arrow-right:before' ) ]['border-left-color'] = $primary_color;
		}
		elseif( 's6' === $style ){
			$elements[ rella_implode( '%1$s figure:after' ) ]['background'] = $primary_color;
		}
		elseif( 's7' === $style || 's8' === $style  ){
			$elements[ rella_implode( '%1$s .content-box-info' ) ]['background'] = $primary_color;
		}

		$this->dynamic_css_parser( $id, $elements );

	}

}
new RA_Content_Box;
