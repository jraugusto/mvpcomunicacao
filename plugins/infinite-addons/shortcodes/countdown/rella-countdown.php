<?php
/**
* Shortcode Countdown
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Countdown extends RA_Shortcode {

	/**
	 * [$days description]
	 * @var array
	 */
	private $days = array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31');

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_countdown';
		$this->title       = esc_html__( 'Countdown', 'infinite-addons' );
		$this->icon        = 'fa fa-clock-o';
		$this->description = esc_html__( 'Add countdown timer', 'infinite-addons' );
		$this->scripts     = array( 'jquery-countdown' );
		$this->styles      = array( 'rella-sc-countdown' );

		parent::__construct();
	}

	public function get_params() {

		$this->params = array(

			array(
				'type'       => 'dropdown',
				'param_name' => 'month',
				'heading'    => esc_html__( 'Month', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'January', 'infinite-addons' )   => '1',
					esc_html__( 'February', 'infinite-addons' )  => '2',
					esc_html__( 'March', 'infinite-addons' )     => '3',
					esc_html__( 'April', 'infinite-addons' )     => '4',
					esc_html__( 'May', 'infinite-addons' )       => '5',
					esc_html__( 'June', 'infinite-addons' )      => '6',
					esc_html__( 'July', 'infinite-addons' )      => '7',
					esc_html__( 'August', 'infinite-addons' )    => '8',
					esc_html__( 'September', 'infinite-addons' ) => '9',
					esc_html__( 'Octomber', 'infinite-addons' )  => '10',
					esc_html__( 'November', 'infinite-addons' )  => '11',
					esc_html__( 'December', 'infinite-addons' )  => '12',
				),
				'admin_label' => true,
				'edit_field_class' => 'vc_column-with-padding vc_col-sm-4'
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'day',
				'heading'     => esc_html__( 'Day', 'infinite-addons' ),
				'value'       => $this->days,
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-4'
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'year',
				'heading'     => esc_html__( 'Year', 'infinite-addons' ),
				'std' 		  => '2017',
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-4'
			),
			
			//Labels
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_label',
				'heading'    => esc_html__( 'Labels', 'infinite-addons' ),
			),
			
			array(
				'type'        => 'textfield',
				'param_name'  => 'day_label',
				'heading'     => esc_html__( 'Days', 'infinite-addons' ),
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-3'
			),
			
			array(
				'type'        => 'textfield',
				'param_name'  => 'hours_label',
				'heading'     => esc_html__( 'Hours', 'infinite-addons' ),
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-3'
			),
			
			array(
				'type'        => 'textfield',
				'param_name'  => 'min_label',
				'heading'     => esc_html__( 'Minutes', 'infinite-addons' ),
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-3'
			),
			
			array(
				'type'        => 'textfield',
				'param_name'  => 'sec_label',
				'heading'     => esc_html__( 'Seconds', 'infinite-addons' ),
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-3'
			),
			
			array(
				'type'        => 'textfield',
				'param_name'  => 'timezone',
				'heading'     => esc_html__( 'Set Timezone', 'infinite-addons' ),
				'admin_label' => true,
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'primary_color',
				'heading'    => esc_html__( 'Primary Color', 'infinite-addons' ),
				'group'      => esc_html__( 'Design Options', 'infinite-addons' ),
			)

		);

		$this->add_extras();
	}

	protected function get_plugin_opts() {

		$y = ! empty( $this->atts['year'] ) ? $this->atts['year'] : '2017';
		$m = $this->atts['month'];
		$d = $this->atts['day'];

		$opts = array(
			'until' => "$y-$m-$d"
		);
		
		if( ! empty( $this->atts['day_label'] ) ) {
			$opts['daysLabel'] = esc_attr( $this->atts['day_label'] );
		}
		
		if( ! empty( $this->atts['hours_label'] ) ) {
			$opts['hoursLabel'] = esc_attr( $this->atts['hours_label'] );
		}
		
		if( ! empty( $this->atts['min_label'] ) ) {
			$opts['minutesLabel'] = esc_attr( $this->atts['min_label'] );
		}
		
		if( ! empty( $this->atts['sec_label'] ) ) {
			$opts['secondsLabel'] = esc_attr( $this->atts['sec_label'] );
		}
		
		if( ! empty( $this->atts['timezone'] ) ) {
			$opts['timezone'] = esc_attr( $this->atts['timezone'] );
		}

		echo " data-plugin-options='" . wp_json_encode( $opts ) ."'";
	}

	protected function generate_css() {

		// check
		if( empty( $this->atts['primary_color'] ) ) {
			return '';
		}

		extract( $this->atts );
		$elements = array();
		$id = '.' .$this->get_id();

		$elements[ rella_implode( '%1$s' ) ]['color'] = $primary_color;

		$this->dynamic_css_parser( $id, $elements );
	}

}
new RA_Countdown;
