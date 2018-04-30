<?php
/**
* Shortcode Restaurant Menu
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Restaurant_Menu extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_restaurant_menu';
		$this->title       = esc_html__( 'Restaurant Menu', 'infinite-addons' );
		$this->description = esc_html__( 'Restaurant Menu item', 'infinite-addons' );
		$this->icon        = 'fa fa-list';

		parent::__construct();

	}

	public function get_params() {

		$this->params = array(
			
			array( 'id' => 'title' ),
			
			array(
				'type'       => 'param_group',
				'param_name' => 'items',
				'heading'    => esc_html__( 'Menu Item', 'infinite-addons' ),
				'params'     => array(

					array(
						'type'        => 'textfield',
						'param_name'  => 'item_title',
						'heading'     => esc_html__( 'Title', 'infinite-addons' ),
						'admin_label' => true,
						'edit_field_class' => 'vc_column-with-padding vc_col-sm-6',
					),

					array(
						'type'        => 'textfield',
						'param_name'  => 'price',
						'heading'     => esc_html__( 'Price', 'infinite-addons' ),
						'admin_label' =>  true,
						'edit_field_class' => 'vc_col-sm-6',
					),

					array(
						'type'       => 'textarea',
						'param_name' => 'description',
						'heading'    => esc_html__( 'Description', 'infinite-addons' )
					),
				)
			),

		);

		$this->add_extras();
	}
	
	protected function get_title() {

		// check
		if( empty( $this->atts['title'] ) ) {
			return '';
		}

		$title = esc_html( $this->atts['title'] );
		$title = sprintf( '<h3 class="menu-heading">%s</h3>', $title );
		echo $title;

	}

}
new RA_Restaurant_Menu;