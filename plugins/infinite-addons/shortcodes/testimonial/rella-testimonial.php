<?php
/**
* Shortcode Testimonial
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Testimonial extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug = 'ra_testimonial';
		$this->title = esc_html__( 'Testimonial', 'infinite-addons' );
		$this->description = esc_html__( 'Testimonial box', 'infinite-addons' );
		$this->icon = 'fa fa-comment';
		$this->styles = array( 'rella-sc-testimonial' );

		parent::__construct();

		add_filter( 'rella_shortcode_container_values', array( $this, 'add_container' ) );
		add_action( 'rella_testimonial_container', array( $this, 'view_container' ) );
	}

	public function add_container( $values ) {
		$values[ esc_html__( 'Testimonial timeline', 'infinite-addons' ) ] = 'testimonial';

		return $values;
	}

	public function view_container( $atts ) {
		extract( $atts );

		echo '<div class="testimonial-timeline" data-plugin-masonry="true">';

			echo ra_helper()->do_the_content( $content );

		echo '</div>';
	}

	public function get_params() {

		$url = rella_addons()->plugin_uri() . '/assets/img/sc-preview/testimonial/';

		$this->params = array(

			array(
				'type'       => 'select_preview',
				'param_name' => 'style',
				'heading'    => esc_html__( 'Style', 'infinite-addons' ),
				'value' => array(

					array(
						'value' => 's12',
						'label' => esc_html__( 'Backgrounded', 'infinite-addons' ),
						'image' => $url . 'bg.png'
					),

					array(
						'label' => esc_html__( 'Blurb', 'infinite-addons' ),
						'value' => 's4',
						'image' => $url . 'blurb.png'
					),

					array(
						'label' => esc_html__( 'Blurb2', 'infinite-addons' ),
						'value' => 's6',
						'image' => $url . 'blurb2.png'
					),

					array(
						'label' => esc_html__( 'Blurb vertical', 'infinite-addons' ),
						'value' => 's5',
						'image' => $url . 'blurb-vertical.png'
					),

					array(
						'label' => esc_html__( 'Boxed', 'infinite-addons' ),
						'value' => 's8',
						'image' => $url . 'boxed.png'
					),

					array(
						'label' => esc_html__( 'Boxed Alt', 'infinite-addons' ),
						'value' => 's16',
						'image' => $url . 'boxed-alt.png'
					),

					array(
						'label' => esc_html__( 'Boxed vertical', 'infinite-addons' ),
						'value' => 's9',
						'image' => $url . 'boxed-vertical.png'
					),

					array(
						'label' => esc_html__( 'Inverted', 'infinite-addons' ),
						'value' => 's10',
						'image' => $url . 'inverted.png'
					),

					array(
						'label' => esc_html__( 'Inverted 2', 'infinite-addons' ),
						'value' => 's14',
						'image' => $url . 'inverted-2.png'
					),

					array(
						'label' => esc_html__( 'Icon', 'infinite-addons' ),
						'value' => 's17',
						'image' => $url . 'icon.png'
					),

					array(
						'label' => esc_html__( 'Minimal', 'infinite-addons' ),
						'value' => 's1',
						'image' => $url . 'minimal.png'
					),

					array(
						'label' => esc_html__( 'Minimal square', 'infinite-addons' ),
						'value' => 's2',
						'image' => $url . 'minimal-square.png'
					),

					array(
						'label' => esc_html__( 'Minimal vertical', 'infinite-addons' ),
						'value' => 's3',
						'image' => $url . 'minimal-vertical.png'
					),

					array(
						'label' => esc_html__( 'Minimal vertical alt', 'infinite-addons' ),
						'value' => 's13',
						'image' => $url . 'minimal-vertical-alt.png'
					)
				),
				'admin_label' => true,
				'save_always' => true,
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'align',
				'heading'    => esc_html__( 'Alignment', 'infinite-addons' ),
				'value' => array(
					esc_html__( 'Default', 'infinite-addons' ) => '',
					esc_html__( 'Left', 'infinite-addons' )    => 'text-left',
					esc_html__( 'Right', 'infinite-addons' )	  => 'text-right'
				),
				'dependency' => array(
					'element' => 'style',
					'value' => array( 's1', 's2', 's4', 's6', 's8' )
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array( 'id' => 'title', 'edit_field_class' => 'vc_col-sm-6' ),

			array(
				'type'        => 'textfield',
				'param_name'  => 'position',
				'heading'     => esc_html__( 'Position', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'textarea_html',
				'param_name' => 'content',
				'heading'    => esc_html__( 'Text', 'infinite-addons' )
			),

			array(
				'type'        => 'rella_attach_image',
				'param_name'  => 'avatar',
				'heading'     => esc_html__( 'Avatar', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'avatar_size',
				'heading'    => esc_html__( 'Avatar Size', 'infinite-addons' ),
				'value' => array(
					esc_html__( 'Medium', 'infinite-addons' )            => 'avatar-md',
					esc_html__( 'Medium2', 'infinite-addons' )           => 'avatar-md2',
					esc_html__( 'Extra extra small', 'infinite-addons' ) => 'avatar-xxs',
					esc_html__( 'Extra small', 'infinite-addons' )       => 'avatar-xs',
					esc_html__( 'Small', 'infinite-addons' )	            => 'avatar-sm',
					esc_html__( 'Small2', 'infinite-addons' )            => 'avatar-sm2',
					esc_html__( 'Large', 'infinite-addons' )	            => 'avatar-lg'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'company_name',
				'heading'     => esc_html__( 'Name', 'infinite-addons' ),
				'group'       => esc_html__( 'Company', 'infinite-addons' )
			),

			array(
				'type'        => 'vc_link',
				'param_name'  => 'company_link',
				'heading'     => esc_html__( 'Website', 'infinite-addons' ),
				'group'       => esc_html__( 'Company', 'infinite-addons' )
			),

			array(
				'type'        => 'attach_image',
				'param_name'  => 'company_logo',
				'heading'     => esc_html__( 'Logo', 'infinite-addons' ),
				'group'       => esc_html__( 'Company', 'infinite-addons' )
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'primary_color',
				'heading'    => esc_html__( 'Primary Color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'edit_field_class' => 'vc_column-with-padding  vc_col-sm-6',
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'second_color',
				'heading'    => esc_html__( 'Second Color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'style',
					'value'   => 's5'
				),
				'edit_field_class' => 'vc_col-sm-6'
			)

		);

		$this->add_extras();
	}

	public function before_output( $atts, &$content ) {

		if( 's3' == $atts['style'] || 's8' == $atts['style'] || 's13' == $atts['style'] || 's16' == $atts['style'] ) {
			$atts['template'] = 'vertical';
		}
		elseif( 's5' == $atts['style'] ) {
			$atts['template'] = 'vertical-blurb';
		}
		elseif( 's12' == $atts['style'] ) {
			$atts['template'] = 'bg';
		}
		elseif( 's9' == $atts['style'] ) {
			$atts['template'] = 'boxed-vertical';
		}

		return $atts;
	}

	protected function get_avatar() {

		// check
		if( empty( $this->atts['avatar'] ) ) {
			return '';
		}

		$style = $this->atts['style'];
		$avatar_size = $this->atts['avatar_size'];

		if( preg_match( '/^\d+$/', $this->atts['avatar'] ) ){
			$avatar = rella_get_image( $this->atts['avatar'] );
			// check
			if( ! $avatar ) {
				return;
			}
		} else {
			$avatar = esc_url( $this->atts['avatar'] );
		}

		// Default
		$avatar = sprintf( '<figure class="testimonial-avatar"><img class="%s" src="%s" alt="User" /></figure>', $avatar_size, $avatar );

		echo $avatar;
	}

	protected function get_quote() {

		// check
		if( empty( $this->atts['content'] ) ) {
			return '';
		}

		$style = $this->atts['style'];
		$content = ra_helper()->do_the_content( $this->atts['content'] );

		if( 's13' == $style ) {
			echo '<span class="quote-symbol"></span>';
		}

		// Default
		$content = sprintf( '<blockquote class="testimonial-quote">%s</blockquote>', $content );

		echo $content;
	}

	protected function get_details() {

		extract( $this->atts );

		// check
		if( empty( $title ) && empty( $company_name ) ) {
			return '';
		}

		$meta = array();
		if( $position ) {
			$meta[] = sprintf( '%s', $position );
		}

		if( $company_name ) {
			$link = rella_get_link_attributes( $company_link, false );

			if( empty( $link['href'] ) ) {
				$link['href'] = '#';
			}

			$meta[] = sprintf( '<a%2$s>%1$s</a>', $company_name, ra_helper()->html_attributes( $link ) );
		}

		if( $title ) {

			$classes = array( 'testimonial-name' );
			if( 's10' == $style ) {
				$classes[] = 'center-block';
			}

			$title = sprintf( '<span class="%s">%s</span>', join( ' ', $classes ), $title );

			if( in_array( $style, array( 's1', 's2', 's6', 's8', 's9' ) ) && ! empty( $meta ) ) {
				$title = $title . ', ';
			}
		}

		$meta = join( ', ', $meta );
		if( in_array( $style, array( 's10', 's14' ) ) ) {
			$meta = sprintf( '<span class="testimonial-details-other">%s</span>', $meta );
		}

		$classes = array( 'testimonial-details' );
		if( 's5' == $style ) {
			$classes[] = 'text-uppercase';
		}

		if( 's10' == $style ) {
			echo '<i class="icon-quote"></i>';
		}

		if( $company_logo && $url = rella_get_image( $company_logo ) ) {
			$company_logo = sprintf( '<figure class="center-block"><img src="%s" alt="%s" /></figure>', $url, $company_name );
		}

		printf( '<div class="%s">%s</div>', join( ' ', $classes ), ( $title . $meta . $company_logo ) );
	}

	protected function get_class( $style ) {

		$hash = array(
			's1'  => 'testimonial media testimonial-minimal',
			's2'  => 'testimonial media testimonial-minimal testimonial-minimal-square',
			's3'  => 'testimonial testimonial-minimal-vertical testimonial-minimal-vertical-default text-center',
			's4'  => 'testimonial media testimonial-blurb testimonial-blurb-default',
			's5'  => 'testimonial testimonial-blurb-vertical text-center',
			's6'  => 'testimonial testimonial-blurb-bg',
			's8'  => 'testimonial media testimonial-boxed testimonial-boxed-default',
			's9'  => 'testimonial media testimonial-boxed testimonial-boxed-vertical text-center',
			's10' => 'testimonial testimonial-inverted text-center',
			's12' => 'testimonial testimonial-bg',
			's13' => 'testimonial testimonial-minimal-vertical testimonial-minimal-vertical-big text-center',
			's14' => 'testimonial testimonial-inverted style2 text-center',
			's16' => 'testimonial media testimonial-boxed-vertical testimonial-boxed-sm no-hover-effect text-center',
			's17' => 'testimonial media testimonial-icon',
		);

		return $hash[ $style ];
	}

	protected function generate_css() {

		extract( $this->atts );
		// check
		if( empty( $primary_color ) ) {
			return '';
		}

		$id = '.' .$this->get_id();

		$elements[rella_implode( '%1$s a' )] = array(
			'color' => $primary_color
		);

		if( 's2' === $style ) {
			$elements[rella_implode( '%1$s .testimonial-details:before' )] = array(
				'background-color' => $primary_color
			);
		}
		elseif( 's3' === $style ) {
			$elements[rella_implode( '%1$s .testimonial-details:before' )] = array(
				'color' => $primary_color
			);
		}
		elseif( 's4' === $style ) {
			$elements[rella_implode( '%1$s .testimonial-quote' )] = array(
				'border-color' => $primary_color
			);
			$elements[rella_implode( '%1$s .testimonial-quote:before' )] = array(
				'border-right-color' => $primary_color
			);
			$elements[rella_implode( '%1$s.text-right .testimonial-quote:before' )] = array(
				'border-top-color' => $primary_color
			);
		}
		elseif( 's5' === $style ) {
			$elements[rella_implode( '%1$s .testimonial-quote' )] = array(
				'background' => $primary_color,
				'background' => '-webkit-linear-gradient(top, ' . $primary_color . ' 0%, ' . $second_color . ' 100%)',
				'background' => '-webkit-gradient(linear, left top, left bottom, from(' . $primary_color . '), to(' . $second_color . '))',
				'background' => 'linear-gradient(to bottom, ' . $primary_color . ' 0%, ' . $second_color . ' 100%)',
			);
			$elements[rella_implode( '%1$s:hover .testimonial-quote:before' )] = array(
				'border-top-color' => $second_color
			);
		}
		elseif( 's9' === $style ) {
			$elements[rella_implode( '%1$s:hover' )] = array(
				'box-shadow' => 'inset 0 -3px 0 0 ' . $primary_color
			);
		}
		elseif( 's12' === $style ) {
			$elements[rella_implode( '%1$s' )] = array(
				'background' => $primary_color
			);
		}

		$this->dynamic_css_parser( $id, $elements );

	}
}
new RA_Testimonial;
