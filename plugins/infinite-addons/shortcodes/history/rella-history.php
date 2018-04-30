<?php
/**
* Shortcode History
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_History extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_history';
		$this->title       = esc_html__( 'History Item', 'infinite-addons' );
		$this->description = esc_html__( 'Create history timeline', 'infinite-addons' );
		$this->icon        = 'fa fa-comment';
		$this->styles      = array( 'rella-sc-history' );
		$this->defaults    = array();

		parent::__construct();

		add_filter( 'rella_shortcode_container_values', array( $this, 'add_container' ) );
		add_action( 'rella_history_container', array( $this, 'view_container' ) );
	}

	public function add_container( $values ) {
		$values[ esc_html__( 'History timeline', 'infinite-addons' ) ] = 'history';

		return $values;
	}

	public function view_container( $atts ) {
		extract( $atts );

		echo '<div class="history-box history-circle">';

			echo ra_helper()->do_the_content( $content );

		echo '</div>';
	}

	public function get_params() {

		$url = rella_addons()->plugin_uri() . '/assets/img/sc-preview/history/';

		$this->params = array_merge( array(

			array(
				'type'       => 'select_preview',
				'param_name' => 'style',
				'heading'    => esc_html__( 'Style', 'infinite-addons' ),
				'value'      => array(

					array(
						'value' => 's2',
						'label' => esc_html__( 'Content', 'infinite-addons' ),
						'image' => $url . 'content.png'
					),

					array(
						'label' => esc_html__( 'Timeline', 'infinite-addons' ),
						'value' => 's1',
						'image' => $url . 'timeline.png'
					)
				),
				'admin_label' => true
			),

			array(
				'id' => 'title',
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'param_name' => 'year',
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Year', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'textarea_html',
				'param_name' => 'content',
				'heading'    => esc_html__( 'Text', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-9'
			),

			array(
				'type'        => 'rella_attach_image',
				'param_name'  => 'image',
				'heading'     => esc_html__( 'Image', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-3'
			),
		), rella_get_icon_params( false, '', 'all', array( 'align', 'color' ) ), array(

			array(
				'type'        => 'subheading',
				'param_name'  => 'sh_bar',
				'heading'     => esc_html__( 'Bar Colors', 'infinite-addons' )
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'color1',
				'heading'     => esc_html__( 'Color 1', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'color2',
				'heading'     => esc_html__( 'Color 2', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),
		));

		$this->add_extras();
	}

	protected function get_title() {

		// check
		if( empty( $this->atts['title'] ) ) {
			return '';
		}

		$title = sprintf( '<h3>%s</h3>', $this->atts['title'] );

		echo $title;
	}

	protected function get_year() {

		// check
		if( empty( $this->atts['year'] ) ) {
			return '';
		}

		$year = sprintf( '<span class="history-date text-center text-uppercase">%s</span>', $this->atts['year'] );

		echo $year;
	}

	protected function get_icon() {
		$icon = rella_get_icon( $this->atts );

		if( $icon['type'] ) {
			$icon = sprintf( '<i class="icon %s"></i>', $icon['icon'] );
			echo $icon;
		}
	}

	protected function get_image() {

		// check
		if( empty( $this->atts['image'] ) ) {
			return '';
		}

		$image = '';

		if( preg_match( '/^\d+$/', $this->atts['image'] ) ){
			$src   = rella_get_image_src( $this->atts['image'] );
			$image = wp_get_attachment_image( $this->atts['image'], 'full', false, array( 'data-rjs' => $src[0] ) );
		} else {
			$image =  '<img alt="" src="' . esc_url( $this->atts['image'] ) . '" data-rjs="' . esc_url( $this->atts['image'] ) . '" />';
		}

		$image = sprintf( '<figure>%s</figure>', $image );


		echo $image;
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
			's1' => 'history-item',
			's2' => 'history-item'
		);

		return $hash[ $style ];
	}

	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' .$this->get_id();

		$elements[ rella_implode( '%1$s .history-date' ) ] = array(
			'border-color' => $color2
		);

		$elements[ rella_implode( '%1$s .bar' ) ] = array(
			'background-image' => 'linear-gradient(to bottom, '. $color1 .' 0%, '. $color2 .' 100%)'
		);

		$this->dynamic_css_parser( $id, $elements );
	}
}
new RA_History;