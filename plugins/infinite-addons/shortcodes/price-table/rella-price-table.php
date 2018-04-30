<?php
/**
* Shortcode Pricing Table
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Price_Table extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_price_table';
		$this->title       = esc_html__( 'Price Table', 'infinite-addons' );
		$this->description = esc_html__( 'Create pricing table.', 'infinite-addons' );
		$this->icon        = 'fa fa-star';
		$this->styles      = array( 'rella-sc-pricing-table', 'rella-sc-button' );

		parent::__construct();
	}

	public function get_params() {

		$url = rella_addons()->plugin_uri() . '/assets/img/sc-preview/pricing-table/';

		$icon = rella_get_icon_params( false, '', 'all', array( 'align' ), 'i_', array(
			'element' => 'style',
			'value' => array( 's8' )
		) );

		$content = array_merge(
		array(
			array(
				'type'        => 'select_preview',
				'param_name'  => 'style',
				'heading'     => esc_html__( 'Style', 'infinite-addons' ),
				'admin_label' => true,
				'value'       => array(

					array(
						'value' => 's1',
						'label' => esc_html__( 'Style 1', 'infinite-addons' ),
						'image' => $url . 'style1.png'
					),

					array(
						'label' => esc_html__( 'Style 2', 'infinite-addons' ),
						'value' => 's2',
						'image' => $url . 'style2.png'
					),

					array(
						'label' => esc_html__( 'Style 3', 'infinite-addons' ),
						'value' => 's3',
						'image' => $url . 'style3.png'
					),

					array(
						'label' => esc_html__( 'Style 4', 'infinite-addons' ),
						'value' => 's4',
						'image' => $url . 'style4.png'
					),

					array(
						'label' => esc_html__( 'Style 5', 'infinite-addons' ),
						'value' => 's5',
						'image' => $url . 'style5.png'
					),

					array(
						'label' => esc_html__( 'Style 6', 'infinite-addons' ),
						'value' => 's6',
						'image' => $url . 'style6.png'
					),

					array(
						'label' => esc_html__( 'Style 7', 'infinite-addons' ),
						'value' => 's7',
						'image' => $url . 'style7.png'
					),

					array(
						'label' => esc_html__( 'Style 8', 'infinite-addons' ),
						'value' => 's8',
						'image' => $url . 'style8.png'
					),

					array(
						'label' => esc_html__( 'Style 9', 'infinite-addons' ),
						'value' => 's9',
						'image' => $url . 'style9.png'
					),

					array(
						'label' => esc_html__( 'Style 10', 'infinite-addons' ),
						'value' => 's10',
						'image' => $url . 'style10.png'
					),

					array(
						'label' => esc_html__( 'Style 11', 'infinite-addons' ),
						'value' => 's11',
						'image' => $url . 'style11.png'
					),

					array(
						'label' => esc_html__( 'Style 12', 'infinite-addons' ),
						'value' => 's12',
						'image' => $url . 'style12.png'
					),

					array(
						'label' => esc_html__( 'Style 13', 'infinite-addons' ),
						'value' => 's13',
						'image' => $url . 'style13.png'
					),

					array(
						'label' => esc_html__( 'Style 14', 'infinite-addons' ),
						'value' => 's14',
						'image' => $url . 'style14.png'
					),

					array(
						'label' => esc_html__( 'Style 15', 'infinite-addons' ),
						'value' => 's15',
						'image' => $url . 'style15.png'
					),

					array(
						'label' => esc_html__( 'Style 16', 'infinite-addons' ),
						'value' => 's16',
						'image' => $url . 'style16.png'
					),

					array(
						'label' => esc_html__( 'Style 17', 'infinite-addons' ),
						'value' => 's17',
						'image' => $url . 'style17.png'
					),

					array(
						'label' => esc_html__( 'Style 18', 'infinite-addons' ),
						'value' => 's18',
						'image' => $url . 'style18.png'
					),

					array(
						'label' => esc_html__( 'Style 19', 'infinite-addons' ),
						'value' => 's19',
						'image' => $url . 'style19.png'
					),

					array(
						'label' => esc_html__( 'Style 20', 'infinite-addons' ),
						'value' => 's20',
						'image' => $url . 'style20.png'
					)
				),
				'save_always' => true,
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'featured',
				'heading'    => esc_html__( 'Featured?', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'No', 'infinite-addons' )  => '',
					esc_html__( 'Yes', 'infinite-addons' ) => 'featured',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'feature_column',
				'heading'    => esc_html__( 'Features Column', 'infinite-addons' ),
				'value'      => array(
					'No'  => 'no',
					'Yes' => 'yes'
				),
				'dependency' => array(
					'element' => 'style',
					'value'   => array( 's14' )
				),
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'title',
				'heading'     => esc_html__( 'Title', 'infinite-addons' ),
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'subtitle',
				'heading'     => esc_html__( 'Sub Title', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'textfield',
				'param_name' => 'description',
				'heading'    => esc_html__( 'Description', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'textfield',
				'param_name' => 'price',
				'heading'    => esc_html__( 'Price', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'textfield',
				'param_name' => 'currency',
				'heading'    => esc_html__( 'Currency', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'textfield',
				'param_name' => 'ribbon',
				'heading'    => esc_html__( 'Ribbon Text', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'style',
					'value'   => array( 's4', 's9' )
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
		),

		$icon,

		array(

			array(
				'type'       => 'rella_attach_image',
				'param_name' => 'image',
				'heading'    => esc_html__( 'Upload Image', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'style',
					'value'   => array( 's6', 's14', 's15', 's16', 's17' )
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'textarea_html',
				'param_name'  => 'content',
				'heading'     => esc_html__( 'Features', 'infinite-addons' ),
				'description' => esc_html__( 'Input values here. Divide values by pressing Enter. Example: <strong>10GB</strong> Disk Space,<strong>100GB</strong> Monthly Bandwidth;', 'infinite-addons'),
				'value'       => '<ul><li>Free One Year Domain</li><li>10+ Pages Design</li><li>Full Organized Layered</li><li>Unlimited Revision</li><li>50% Discount Off</li><li>Free Logo Design</li><li>Free Stationary Design</li></ul>',
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'show_button',
				'heading'    => esc_html__( 'Show Button', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes',
					esc_html__( 'No', 'infinite-addons' )  => ''
				),
			)

		) );

		$button = vc_map_integrate_shortcode( 'ra_button', 'pt_', esc_html__( 'Button', 'infinite-addons' ),
			array(
				'exclude' => array(
					'primary_color',
					'el_id',
					'el_class'
				)
			),
			array(
				'element' => 'show_button',
				'value' => 'yes',
			)
		);

		$design = array(
			array(
				'type'		 => 'colorpicker',
				'param_name' => 'primary_color',
				'heading'    => esc_html__( 'Primary Color', 'infinite-addons' )
			)
		);
		foreach( $design as &$param ) {
			$param['group'] = esc_html__( 'Design Options', 'infinite-addons' );
		}

		$this->params = array_merge( $content, $design, $button );

		$this->add_extras();
	}

	public function before_output( $atts, &$content ) {

		if( 's6' == $atts['style'] || 's18' == $atts['style'] ) {
			$atts['template'] = 'price-with-btn';
		}
		elseif( 's7' == $atts['style'] ) {
			$atts['template'] = 'features-after-btn';
		}
		elseif( 's14' == $atts['style'] && !empty( $atts['feature_column'] ) && 'yes' == $atts['feature_column'] ) {
			$atts['template'] = 'feature-table';
		}
		elseif( 's15' == $atts['style'] || 's16' == $atts['style'] ) {
			$atts['template'] = 'price-after-image';
		}
		elseif( 's17' == $atts['style'] ) {
			$atts['template'] = 'image-inside-header';
		}
		elseif( 's19' == $atts['style'] ) {
			$atts['template'] = 'minimal';
		}

		return $atts;
	}

	protected function get_title() {

		// check
		if( empty( $this->atts['title'] ) ) {
			return '';
		}

		$style = $this->atts['style'];
		$title = esc_html( $this->atts['title'] );

		// Default

		if( 's10' == $style || 's20' == $style ) {
			$title = sprintf( '<h4 class="text-uppercase">%s</h4><hr>', $title );
		}
		elseif( 's11' == $style ) {
			$title = sprintf( '<h4>%s</h4><hr>', $title );
		}
		elseif( 's12' == $style ) {
			$title = sprintf( '<h4 class="text-lowercase">%s</h4>', $title );
		}
		elseif( 's13' == $style || 's14' == $style || 's16' == $style || 's17' == $style || 's18' == $style ) {
			$title = sprintf( '<h4 class="text-uppercase">%s</h4>', $title );
		}
		else {
			$title = sprintf( '<h4>%s</h4>', $title );
		}

		echo $title;

		if( 's6' == $style ) {
			echo '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100px" x="0" y="0" viewbox="0 0 74 7" style="enable-background:new 0 0 74 7;" xml:space="preserve"><path style="fill-rule:evenodd;clip-rule:evenodd;" d="M57.7,5c-6.2-1.6-13.5-5-20.8-5c-7.2,0-14.4,3.3-20.5,4.8C11.2,6.1,5.3,6.7,0,7v0h72.4 C67.4,6.7,62.2,6.1,57.7,5z" /></svg>';
		}
	}

	protected function get_pricing() {

		$out = '';
		$style = $this->atts['style'];
		$subtitle = !empty( $this->atts['subtitle'] ) ? $this->atts['subtitle'] : '';
		$description = !empty( $this->atts['description'] ) ? $this->atts['description'] : '';

		if( 's8' == $style || 's12' == $style || 's15' == $style || 's16' == $style || 's18' == $style ) {
			$out .= '<div class="pricing text-uppercase">';
		}
		else {
			$out .= '<div class="pricing">';
		}

			$out .= $this->before_pricing();

			$out .= $subtitle;

			$out .= $this->get_price();

			$out .= $description;

		$out .= '</div>';

		echo $out;


		if( 's18' == $style ) {
			echo '<hr />';
		}
	}

	protected function before_pricing() {

		$out = '';
		$style = $this->atts['style'];

		if( 's2' == $style || 's3' == $style ) {
			$out .= '<svg class="pricing-bg" viewBox="0 0 260 260"><polygon points="0,0 0,143 130.5,167 261,143 261,0" xmlns="http://www.w3.org/2000/svg" /></svg>';
		}

		return $out;
	}

	protected function get_featured() {

		$featured = ! empty( $this->atts['featured'] ) ? $this->atts['featured'] : '';

		return $featured;
	}

	protected function get_price() {

		// check
		if( empty( $this->atts['price'] ) && empty( $this->atts['currency'] ) ) {
			return '';
		}

		$out = '';
		$style = $this->atts['style'];
		$price = esc_html( $this->atts['price'] );
		$currency = esc_html( $this->atts['currency'] );

		if( 's4' == $style || 's9' == $style ) {
			$out .= sprintf( '<span class="price">%2$s</span>%1$s', $currency, $price );
		}
		// Default
		else {
			$currency = sprintf( '<span class="currency">%s</span>', $currency );
			$out .= sprintf( '<span class="price">%1$s%2$s</span>', $currency, $price );
		}

		return $out;
	}

	protected function get_ribbon() {

		// check
		if( empty( $this->atts['ribbon'] ) ) {
			return '';
		}

		$ribbon = esc_html( $this->atts['ribbon'] );

		// Default
		$ribbon = sprintf( '<span class="popular-badge">%s</span>', $ribbon );

		echo $ribbon;
	}

	protected function get_figure() {

		// check
		if( empty( $this->atts['image'] ) ) {
			return '';
		}

		$image = esc_html( $this->atts['image'] );

		if( preg_match( '/^\d+$/', $this->atts['image'] ) ){
			if( $url = rella_get_image( $image ) ) {
				printf( '<figure><img src="%s" alt=""></figure>', $url );
			}
		} else {
			printf( '<figure><img src="%s" alt=""></figure>', $image );
		}

	}

	protected function get_features() {

		// check
		if( empty( $this->atts['content'] ) ) {
			return '';
		}

		$content = ra_helper()->do_the_content( $this->atts['content'] );
		$content = str_replace( '<ul>', '<ul class="list-unstyled pricing-features">', $content );

		echo wp_kses_post( $content );
	}

	protected function get_button() {

		if ( empty( $this->atts['show_button'] ) ) {
			return;
		}

		$data = vc_map_integrate_parse_atts( $this->slug, 'ra_button', $this->atts, 'pt_' );
		if ( $data ) {


			if( ! in_array( $this->atts['style'], array( 's4', 's9' ) ) ) {
				$data['primary_color'] = $this->atts['primary_color'];
			}

			$btn = visual_composer()->getShortCode( 'ra_button' )->shortcodeClass();

			if ( is_object( $btn ) ) {
				$btn->parent_selector = '.' . $this->get_id();
				echo $btn->render( array_filter( $data ) );
				unset( $btn->parent_selector );
			}
		}
	}

	protected function get_icon() {

		$icon = rella_get_icon( $this->atts );

		if( empty( $icon ) || empty( $icon['type'] ) ) {
			return;
		}

		extract( $icon );

		printf('<i class="%s"></i>', $icon );
	}

	protected function get_class( $style ) {

		$hash = array(
			's1'  => 'pricing-table-default',
			's2'  => 'pricing-table-default-alt',
			's3'  => 'pricing-table-inverted',
			's4'  => 'pricing-table-classic',
			's5'  => 'pricing-table-elegant',
			's6'  => 'pricing-table-graphic',
			's7'  => 'pricing-table-flat',
			's8'  => 'pricing-table-flat-head',
			's9'  => 'pricing-table-app animate-bg-expand',
			's10' => 'pricing-table-tabular',
			's11' => 'pricing-table-tabular-alt',
			's12' => 'pricing-table-minimal',
			's13' => 'pricing-table-sticky-head',
			's14' => 'pricing-table-sticky-head-alt',
			's15' => 'pricing-table-minimal-icon',
			's16' => 'pricing-table-flat-gradient',
			's17' => 'pricing-table-flat-head-gradient',
			's18' => 'pricing-table-mini',
			's19' => 'pricing-table-minimal2',
			's20' => 'pricing-table-tabular-alt2',
		);

		return $hash[ $style ];
	}

	protected function generate_css() {

		// check
		if( empty( $this->atts['primary_color'] ) ) {
			return '';
		}

		$elements = array();
		extract( $this->atts );
		$id = '.' .$this->get_id();

		if( 's1' === $style ) {

			$selector = array(
				'%1$s:before',
				'%1$s:after',
				'%1$s .pricing-table-inner:before',
				'%1$s .pricing-table-inner:after',
				'%1$s h4'
			);
			$elements[ rella_implode( $selector ) ]['background-color'] = $primary_color;

			$selector = array(
				'%1$s:hover .price',
				'%1$s:hover .pricing'
			);
			$elements[ rella_implode( $selector ) ]['color'] = $primary_color;
		}
		elseif( 's2' == $style || 's3' == $style ) {

			$selector = array(
				'%1$s:before',
				'%1$s:after',
				'%1$s .pricing-table-inner:before',
				'%1$s .pricing-table-inner:after'
			);
			$elements[ rella_implode( $selector ) ]['background-color'] = $primary_color;
			$elements[ rella_implode( '%1$s h4' ) ]['color'] = $primary_color;
			$elements[ rella_implode( '%1$s:hover .pricing-bg polygon' ) ]['fill'] = $primary_color;
		}
		elseif( 's4' === $style ) {

			$selector = array(
				'%1$s.pricing-table-classic:hover',
				'%1$s.pricing-table-classic:hover .btn'
			);
			$elements[ rella_implode( $selector ) ]['border-color'] = $primary_color;
			$elements[ rella_implode( '%1$s .popular-badge' ) ]['background-color'] = $primary_color;
			$elements[ rella_implode( '%1$s .popular-badge:after' ) ]['border-color'] = $primary_color;
			$elements[ rella_implode( array( '%1$s.pricing-table-classic .price', '%1$s.pricing-table-classic:hover .btn' ) ) ]['color'] = $primary_color;
			$elements[ rella_implode( '%1$s.pricing-table-classic:hover' ) ]['box-shadow'] = 'inset 0 0 0 2px' . $primary_color;
			$elements[ rella_implode( '%1$s.pricing-table-classic:hover .btn' ) ]['box-shadow'] = 'inset 0 1px 0 0' . $primary_color;

		}
		elseif( 's5' === $style ) {

			$elements[ rella_implode( '%1$s .price' ) ]['color'] = $primary_color;
			$elements[ rella_implode( '%1$s .featured' ) ]['border-color'] = $primary_color;

		}
		elseif( 's6' === $style ) {

			$elements[ rella_implode( '%1$s h4' ) ]['background-color'] = $primary_color;
			$elements[ rella_implode( '%1$s .price' ) ]['color'] = $primary_color;
			$elements[ rella_implode( '%1$s header path' ) ]['fill'] = $primary_color;
		}
		elseif( 's7' === $style ) {

			$elements[ rella_implode( '%1$s' ) ]['background-color'] = $primary_color;
		}
		elseif( 's8' === $style ) {

			$elements[ rella_implode( '%1$s header' ) ]['background-color'] = $primary_color;
		}
		elseif( 's9' === $style ) {

			$selector = array(
				'%1$s',
				'%1$s .btn'
			);
			$elements[ rella_implode( $selector ) ]['border-color'] = $primary_color;

			$selector = array(
				'%1$s:before',
				'%1$s.featured'
			);
			$elements[ rella_implode( $selector ) ] = array(
				'background' => 'none',
				'background-color' => $primary_color,
			);

			$selector = array(
				'%1$s .pricing',
				'%1$s .price',
				'%1$s .btn',
			);
			$elements[ rella_implode( $selector ) ]['color'] = $primary_color;

			$selector = array(
				'%1$s.featured .popular-badge',
				'%1$s:hover .popular-badge'
			);
			$elements[ rella_implode( $selector ) ] = array(
				'background-color' => '#fff',
				'color' => $primary_color
			);

			$selector = array(
				'%1$s.featured .popular-badge:after',
				'%1$s:hover .popular-badge:after'
			);
			$elements[ rella_implode( $selector ) ]['border-color'] = $primary_color;
		}
		elseif( 's10' === $style ) {

			$elements[ rella_implode( '%1$s .price' ) ]['color'] = $primary_color;

		}
		elseif( 's12' === $style ) {

			$selector = array(
				'%1$s.featured h4',
				'%1$s.featured .price',
				'%1$s.featured .currency'
			);
			$elements[ rella_implode( '%1$s.featured' ) ]['border-color'] = $primary_color;
			$elements[ rella_implode( $selector ) ]['color'] = $primary_color;
		}
		elseif( 's13' === $style || 's14' === $style ) {

			$selector = array(
				'%1$s',
				'%1$s.featured h4'
			);
			$elements[ rella_implode( $selector ) ]['background'] = $primary_color;

			$elements[ rella_implode( '%1$s.featured' ) ]['box-shadow'] = 'inset 0 0 0 3px ' . $primary_color;

			$selector = array(
				'%1$s.featured .currency',
				'%1$s.featured .price',
				'%1$s.featured .pricing'
			);
			$elements[ rella_implode( $selector ) ]['color'] = $primary_color;
		}
		elseif( 's15' === $style ) {

			$elements[ rella_implode( '%1$s:hover' ) ]['outline-color'] = $primary_color;
			$elements[ rella_implode( '%1$s .price' ) ]['color'] = $primary_color;
		}
		elseif( 's16' === $style ) {

			$elements[ rella_implode( '1$s' ) ]['background'] = $primary_color;
		}
		elseif( 's17' === $style ) {

			$selector = array(
				'%1$s header',
				'%1$s:hover header'
			);
			$elements[ rella_implode( $selector ) ]['background'] = $primary_color;
		}
		elseif( 's18' === $style ) {

			$selector = array(
				'%1$s h4',
				'%1$s .btn',
				'%1$s .price'
			);
			$elements[ rella_implode( $selector ) ]['color'] = $primary_color;
		}

		$this->dynamic_css_parser( $id, $elements );
	}
}
new RA_Price_Table;
