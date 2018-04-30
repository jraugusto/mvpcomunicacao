<?php
/**
* Shortcode Team Member
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Team_Member extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_team_member';
		$this->title       = esc_html__( 'Team member', 'infinite-addons' );
		$this->icon        = 'fa fa-user';
		$this->description = esc_html__( 'Add team member', 'infinite-addons' );
		$this->styles      = array( 'rella-sc-team-member', 'rella-sc-button', 'rella-sc-social-icon' );

		parent::__construct();
	}

	public function get_params() {

		$url = rella_addons()->plugin_uri() . '/assets/img/sc-preview/team-member/';

		$general = array(
			array(
				'type'        => 'select_preview',
				'param_name'  => 'template',
				'heading'     => esc_html__( 'Style', 'infinite-addons' ),
				'value'       => array(

					array(
						'value' => 'border-bw',
						'label' => esc_html__( 'Border between', 'infinite-addons' ),
						'image' => $url . 'border-bw.png'
					),

					array(
						'label' => esc_html__( 'Bordered info', 'infinite-addons' ),
						'value' => 'bordered',
						'image' => $url . 'bordered-info.png'
					),

					array(
						'label' => esc_html__( 'Boxed', 'infinite-addons' ),
						'value' => 'whole-bordered',
						'image' => $url . 'whole-bordered.png'
					),

					array(
						'label' => esc_html__( 'Boxed Alt', 'infinite-addons' ),
						'value' => 'whole-bordered-alt',
						'image' => $url . 'whole-bordered.png'
					),

					array(
						'label' => esc_html__( 'With Button', 'infinite-addons' ),
						'value' => 'with-button',
						'image' => $url . 'button.png'
					),

					array(
						'label' => esc_html__( 'Cards', 'infinite-addons' ),
						'value' => 'cards',
						'image' => $url . 'cards.png'
					),

					array(
						'label' => esc_html__( 'Flat', 'infinite-addons' ),
						'value' => 'flat',
						'image' => $url . 'flat.png'
					),

					array(
						'label' => esc_html__( 'Hover Special', 'infinite-addons' ),
						'value' => 'hover-special',
						'image' => $url . 'hover-special.png'
					),

					array(
						'label' => esc_html__( 'Masonry', 'infinite-addons' ),
						'value' => 'masonry',
						'image' => $url . 'masonry.png'
					),

					array(
						'label' => esc_html__( 'Minimal', 'infinite-addons' ),
						'value' => 'minimal',
						'image' => $url . 'minimal.png'
					),

					array(
						'label' => esc_html__( 'Slide Down Panel', 'infinite-addons' ),
						'value' => 'hover-expand',
						'image' => $url . 'hover-expand.png'
					),

					array(
						'label' => esc_html__( 'Slide Up Panel', 'infinite-addons' ),
						'value' => 'hover-social',
						'image' => $url . 'hover-social.png'
					),

					array(
						'label' => esc_html__( 'Socials on Side', 'infinite-addons' ),
						'value' => 'info-side',
						'image' => $url . 'info-side.png'
					),

					array(
						'label' => esc_html__( 'Top curve', 'infinite-addons' ),
						'value' => 'top-curve',
						'image' => $url . 'top-curve.png'
					),

					array(
						'label' => esc_html__( 'Contact Info', 'infinite-addons' ),
						'value' => 'contact-info',
						'image' => $url . 'contact-info.png'
					),
				),
				'save_always' => true,
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'name',
				'heading'     => esc_html__( 'Name', 'infinite-addons' ),
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'position',
				'heading'     => esc_html__( 'Position', 'infinite-addons' ),
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'vc_link',
				'param_name' => 'link',
				'heading'    => esc_html__( 'External link', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'rella_attach_image',
				'param_name'  => 'image',
				'heading'     => esc_html__( 'Image', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'info_up',
				'heading'    => esc_html__( 'Show info up', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'No', 'infinite-addons' )  => '',
					esc_html__( 'Yes', 'infinite-addons' ) => 'team-details-up',
				),
				'dependency' => array(
					'element' => 'template',
					'value'   => 'masonry'
				)
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'phone',
				'heading'     => esc_html__( 'Phone', 'infinite-addons' ),
				'value'       => '',
				'dependency' => array(
					'element' => 'template',
					'value'   => array( 'contact-info', 'minimal', 'info-side' )
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'email',
				'heading'     => esc_html__( 'Email', 'infinite-addons' ),
				'value'       => '',
				'dependency' => array(
					'element' => 'template',
					'value'   => 'contact-info'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type' => 'dropdown',
				'param_name' => 'side_border',
				'heading' => esc_html__( 'Side Border', 'infinite-addons' ),
				'value' => array(
					esc_html__( 'No', 'infinite-addons' )  => '',
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes'
				),
				'dependency' => array(
					'element' => 'template',
					'value'   => 'border-bw'
				)
			),

			array(
				'type'        => 'textarea_html',
				'param_name'  => 'content',
				'heading'     => esc_html__( 'Content', 'infinite-addons' ),
				'holder'      => 'div',
				'dependency'  => array(
					'element' => 'template',
					'value'   => array( 'top-curve', 'whole-border', 'border-bw', 'hover-expand', 'contact-info', 'split', 'whole-bordered' )
				)
			)
		);

		$skills = array(
			array(
				'type'       => 'param_group',
				'param_name' => 'skills',
				'heading'    => esc_html__( 'Skills', 'infinite-addons' ),
				'params'     => array(

					array(
						'type'       => 'textfield',
						'param_name' => 'skill_title',
						'heading'    => esc_html__( 'Skill', 'infinite-addons' ),
						'admin_label' => true,
						'edit_field_class' => 'vc_column-with-padding vc_col-sm-6',
					),

					array(
						'type'       => 'textfield',
						'param_name' => 'skill_percent',
						'heading'    => esc_html__( 'Percent', 'infinite-addons' ),
						'admin_label' => true,
						'edit_field_class' => 'vc_col-sm-6',
					)
				)
			),

			// Progress bar customization
			array(
				'type'       => 'colorpicker',
				'param_name' => 'pb_label_color',
				'heading'    => esc_html__( 'Label Color', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'pb_percent_color',
				'heading'    => esc_html__( 'Percentage Color', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'pb_color',
				'heading'    => esc_html__( 'Bar Color', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'pb_bg_color',
				'heading'    => esc_html__( 'Bar Background Color', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			)
		);

		foreach( $skills as &$param ) {
			$param['group'] = esc_html__( 'Skills', 'infinite-addons' );
			$param['dependency'] = array(
				'element' => 'template',
				'value'   => array( 'split', 'skills-info' )
			);
		}

		$socials = array(
			array(
				'type'       => 'dropdown',
				'param_name' => 'vertical',
				'heading'    => esc_html__( 'Show vertical?', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'No', 'infinite-addons' )  => '',
					esc_html__( 'Yes', 'infinite-addons' ) => 'vertical'
				),
				'dependency' => array(
					'element' => 'template',
					'value'   => 'hover-social'
				)
			),

			array(
				'type'       => 'param_group',
				'param_name' => 'socials',
				'heading'    => esc_html__( 'Social link', 'infinite-addons' ),
				'params'     => array(

					array(
						'id' => 'network',
						'edit_field_class' => 'vc_column-with-padding vc_col-sm-6'
					),

					array(
						'type'        => 'textfield',
						'param_name'  => 'url',
						'heading'     => esc_html__( 'URL (Link)', 'infinite-addons' ),
						'description' => esc_html__(  'Add social link', 'infinite-addons' ),
						'edit_field_class' => 'vc_col-sm-6'
					)
				)
			)
		);

		foreach( $socials as &$param ) {
			$param['group'] = esc_html__( 'Social Identites', 'infinite-addons' );
		}

		$design = array(

			// Title customization
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_content',
				'heading'    => esc_html__( 'Title & Position Styling', 'infinite-addons' )
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'name_size',
				'heading'     => esc_html__( 'Name font-Size', 'infinite-addons' ),
				'description' => esc_html__( 'Add size in pixels/em e.g 15px', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'name_color',
				'heading'     => esc_html__( 'Name Color', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'title_size',
				'heading'     => esc_html__( 'Position Font-Size', 'infinite-addons' ),
				'description' => esc_html__( 'Add size in pixels/em e.g 15px', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'title_color',
				'heading'     => esc_html__( 'Position Color', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			// Design options
			array(
				'type'        => 'subheading',
				'param_name'  => 'other_st',
				'heading'     => esc_html__( 'Other Styling', 'infinite-addons' )
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'main_bg',
				'heading'    => esc_html__( 'Main Color', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'template',
					'value'   => array( 'top-curve', 'skills-info', 'flat', 'masonry' )
				),
				'edit_field_class' => 'vc_col-sm-4'
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'border_color',
				'heading'    => esc_html__( 'Border Color', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'template',
					'value'   => array( 'border-bw', 'bordered', 'flat' )
				),
				'edit_field_class' => 'vc_col-sm-4'
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'border_hover_color',
				'heading'    => esc_html__( 'Border Hover Color', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'template',
					'value'   => array( 'bordered' )
				),
				'edit_field_class' => 'vc_col-sm-4'
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'social_bg_color',
				'heading'    => esc_html__( 'Social Background Color', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'template',
					'value'   => array( 'cards' )
				),
				'edit_field_class' => 'vc_col-sm-4'
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'social_color',
				'heading'    => esc_html__( 'Social Color', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'template',
					'value'   => array( 'border-bw', 'bordered', 'cards', 'flat', 'split' )
				),
				'edit_field_class' => 'vc_col-sm-4'
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'social_hover_color',
				'heading'    => esc_html__( 'Social Hover Color', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'template',
					'value'   => array( 'split' )
				),
				'edit_field_class' => 'vc_col-sm-4'
			)
		);

		foreach( $design as &$param ) {
			$param['group'] = esc_html__( 'Design Options', 'infinite-addons' );
		}

		$this->params = array_merge( $general, $socials, $design );

		$this->add_extras();
	}

	protected function get_content() {

		// check
		if( empty( $this->atts['content'] ) ) {
			return;
		}

		echo wp_kses_post( ra_helper()->do_the_content( $this->atts['content'] ) );
	}

	protected function get_name() {

		// check
		if( empty( $this->atts['name'] ) ) {
			return;
		}

		$template = $this->atts['template'];
		$name     = esc_html( $this->atts['name'] );
		$link     = rella_get_link_attributes( $this->atts['link'], false );

		if ( ! empty( $link['href'] ) ) {
			$name = sprintf( '<a%s>%s</a>', ra_helper()->html_attributes( $link ), $name );
		}

		if( in_array( $template, array( 'hover-expand', 'whole-bordered-alt' ) ) ) {
			printf( '<h4 class="team-member-name text-uppercase">%s</h4>', $name );
		}
		else {
			printf( '<h4 class="team-member-name">%s</h4>', $name );
		}
	}

	protected function get_position() {

		// check
		if( empty( $this->atts['position'] ) ) {
			return;
		}

		$template = $this->atts['template'];
		$position = esc_html( $this->atts['position'] );

		if( empty( $template ) || 'top-curve' == $template ) {
			$position = '<strong>'. $position .'</strong>';
		}

		if( in_array( $template, array( 'contact-info', 'flat', 'masonry', 'skills-info', 'with-button' ) ) ) {
			printf( '<h5 class="team-member-title">%s</h5>', $position );
		}
		else {
			printf( '<h5 class="team-member-title text-uppercase">%s</h5>', $position );
		}
	}

	protected function get_image() {

		// check
		if( empty( $this->atts['image'] ) ) {
			return;
		}

		$template = $this->atts['template'];
		$name     = esc_attr( $this->atts['name'] );

		if( preg_match( '/^\d+$/', $this->atts['image'] ) ){
			$image = rella_get_image_src( $this->atts['image'] );
			$html  = wp_get_attachment_image( $this->atts['image'], 'full', false, array( 'data-rjs' => $image[0] ) );
			$src  = $image[0];
		} else {
			$src  = esc_url( $this->atts['image'] );
			$html = '<img src="' . $src . '" alt="" data-rjs="' . $src . '" />';
		}


		$link = rella_get_link_attributes( $this->atts['link'], false );

		if( in_array( $template, array( 'cards', 'hover-social', 'hover-special', 'with-button', 'info-side' ) ) ) {
			echo $html;
		}
		elseif( in_array( $template, array( 'hover-expand' ) ) &&  ! empty( $link['href'] ) ) {

			printf( '<figure>%1$s<a%2$s><span>+</span></a></figure>', $html, ra_helper()->html_attributes( $link ) );

		}
		elseif( in_array( $template, array( 'whole-bordered', 'whole-bordered-alt' ) ) ) {
			printf( '<figure class="col-xs-6" style="background: url(%1$s) no-repeat center; background-size:cover; "></figure>', $src, $name );
		}
		else {
			printf( '<figure>%1$s</figure>', $html );
		}
	}

	protected function get_social() {

		$template = $this->atts['template'];
		$socials  = (array) vc_param_group_parse_atts( $this->atts['socials'] );

		// check
		if( empty( $socials ) ) {
			return;
		}

		$out = '';
		foreach ( $socials as $social ) {
			if ( empty( $social['url'] ) ) {
				continue;
			}

			$net = rella_get_network_class( $social['network'] );
			$attr = array( 'href' => esc_url( $social['url'] ) );

			if( in_array( $template, array( 'info-side' ) ) ) {
				$out .= sprintf( '<a%s>%s</a>',
					ra_helper()->html_attributes( $attr ), $social['network']
				);
			}
			elseif( in_array( $template, array( 'hover-expand' ) ) ) {
				$out .= sprintf( '<li><a%s>%s</a></li>',
					ra_helper()->html_attributes( $attr ), $social['network']
				);
			}
			else {
				$out .= sprintf( '<li><a%s><i class="%s"></i></a></li>',
					ra_helper()->html_attributes( $attr ), $net['icon']
				);
			}


		}

		if( empty( $template ) || in_array( $template, array( 'top-curve' ) ) ) {
			printf( '<ul class="social-icon circle branded">%s</ul>', $out );
		}
		elseif( in_array( $template, array( 'hover-expand' ) ) ) {
			printf( '<ul class="social-icon text-uppercase">%s</ul>', $out );
		}
		elseif( in_array( $template, array( 'info-side' ) ) ) {
			printf( '%s', $out );
		}
		elseif( in_array( $template, array( 'hover-social', 'hover-special', 'cards', 'masonry', 'flat',  'skills-info' ) ) ) {
			printf( '<ul class="social-icon scheme-white">%s</ul>', $out );
		}
		else {
			printf( '<ul class="social-icon">%s</ul>', $out );
		}
	}

	protected function get_skills() {

		$template = $this->atts['template'];
		$skills   = (array) vc_param_group_parse_atts( $this->atts['skills'] );

		// check
		if( empty( $skills ) ) {
			return;
		}

		$classes = 'split' == $template ? 'progressbar progressbar-wide-line' : 'progressbar';

		$out = '';
		foreach ( $skills as $skill ) {
			if ( ! empty ( $skill['skill_percent'] ) && ! empty( $skill['skill_title'] ) ) {
				$out .= sprintf(
					'<div class="%s" data-percent="%s"><span class="progressbar-title">%s</span></div>',
			 		$classes, esc_attr( $skill['skill_percent'] ), esc_html( $skill['skill_title'] )
				);
			}
		}

		printf( '<div class="team-member-skills">%s</div>', $out );
	}

	protected function get_style_class( $template ) {

		$hash = array(
			'border-bw'      => array( 'team-member-border-bw', 'team-member-side-border' ),
			'bordered'       => 'team-member-border text-center',
			'cards'          => 'team-member-cards text-center',
			'contact-info'   => 'team-member-contact-info text-center',
			'flat'           => 'team-member-flat text-center',
			'hover-expand'   => 'team-member-hover-expand',
			'hover-social'   => 'team-member-hover-social text-center',
			'masonry'        => 'team-member-masonry text-center',
			'minimal'        => 'team-member-card-minimal text-center',
			'skills-info'    => 'team-member-with-skills',
			'split'          => 'team-member-split',
			'top-curve'      => 'team-member-top-curve text-center',
			'whole-bordered' => 'team-member-whole-border',
			'whole-bordered-alt' => 'team-member-whole-border team-member-sm',
			'hover-special'  => 'team-member-hover-social-special',
			'with-button'	 => 'team-member-button',
			'info-side'      => 'team-member team-member-info-side'
		);

		return $hash[$template];

	}

	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' .$this->get_id();

		$elements[ rella_implode( '%1$s .team-member-name' ) ] = array(
			'font-size' => $name_size,
			'color' => $name_color
		);

		$elements[ rella_implode( '%1$s .team-member-title' ) ] = array(
			'font-size' => $title_size,
			'color' => $title_color
		);

		if ( 'top-curve' === $template ) {

			$elements[ rella_implode( '%1$s.team-member-top-curve .team-member-title' ) ]['background-color'] = $main_bg;
			$elements[ rella_implode( '%1$s.team-member-top-curve svg' ) ] = array(
				'fill' => $main_bg,
				'stroke' => $main_bg
			);
		}
		elseif ( 'border-bw' === $template ) {

			$selector = array(
				'%1$s.team-member-side-border .team-member-name',
				'%1$s.team-member-side-border .team-member-title'
			);
			$elements[ rella_implode( $selector ) ]['border-color'] = $border_color;

			$selector = array(
				'%1$s.team-member-border-bw .social-icon a',
				'%1$s.team-member-side-border .social-icon a'
			);
			$elements[ rella_implode( $selector ) ]['color'] = $social_color;
		}
		elseif ( 'bordered' === $template ) {

			$elements[ rella_implode( '%1$s.team-member-border .team-member-details' ) ]['border-color'] = $border_color;
			$elements[ rella_implode( '%1$s.team-member-border:hover .team-member-details' ) ]['border-color'] = $border_hover_color;
			$elements[ rella_implode( '%1$s.team-member-border .social-icon a' ) ]['color'] = $social_color;
		}
		elseif ( 'cards' === $template ) {

			$elements[ rella_implode( '%1$s.team-member-cards .social-icon' ) ]['background'] = $social_bg_color;
			$elements[ rella_implode( '%1$s.team-member-cards .social-icon a' ) ]['color'] = $social_color;
		}
		elseif ( 'skills-info' === $template ) {

			$elements[ rella_implode( '%1$s.team-member-with-skills' ) ]['background'] = $social_bg_color;
			$elements[ rella_implode( '%1$s.team-member-with-skills .social-icon' ) ]['background'] = $social_bg_color;
			$elements[ rella_implode( '%1$s.team-member-with-skills .social-icon a' ) ]['color'] = $social_color;

			$elements[ rella_implode( '%1$s.team-member-with-skills .progressbar-title' ) ]['color'] = $pb_label_color;
			$elements[ rella_implode( '%1$s.team-member-with-skills .progressbar-bar' ) ]['background'] = $pb_bg_color;
			$elements[ rella_implode( '%1$s.team-member-with-skills .progressbar-bar span' ) ]['background'] = $pb_color;
		}
		elseif ( 'flat' === $template ) {

			$elements[ rella_implode( '%1$s.team-member-flat' ) ] = array(
				'background' => $main_bg,
				'border-color' => $border_color
			);

			$elements[ rella_implode( '%1$s.team-member-flat .social-icons a' ) ]['color'] = $social_color;
		}
		elseif ( 'masonry' === $template ) {

			$elements[ rella_implode( '%1$s.team-member-masonry .team-member-details' ) ]['background'] = $main_bg;
			$elements[ rella_implode( '%1$s.team-member-masonry .team-member-details:after' ) ]['border-color'] = 'transparent transparent ' . $main_bg;
			$elements[ rella_implode( '%1$s.team-member-masonry.team-details-up .team-member-details:after' ) ]['border-color'] = $main_bg . ' transparent transparent';
		}
		elseif ( 'split' === $template ) {

			$elements[ rella_implode( '%1$s.team-member-split .social-icon a' ) ]['color'] = $social_color;
			$elements[ rella_implode( '%1$s.team-member-split .social-icon a:hover' ) ] = array(
				'background-color' => $social_color,
				'color' => $social_hover_color
			);

			$elements[ rella_implode( '%1$s.team-member-split .team-member-skills .progressbar-wide-line' ) ]['color'] = $pb_label_color;
			$elements[ rella_implode( '%1$s.team-member-split .team-member-skills .progressbar-bar' ) ]['background'] = $pb_bg_color;
			$elements[ rella_implode( '%1$s.team-member-split .team-member-skills .progressbar-bar span' ) ]['background'] = $pb_color;

		}

		$this->dynamic_css_parser( $id, $elements );
	}

}
new RA_Team_Member;
