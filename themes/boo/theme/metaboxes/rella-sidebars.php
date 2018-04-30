<?php
/*
 * Slider Section
*/

$sections[] = array(
	'post_types' => array( 'post', 'page' ),
	'title'      => esc_html__('Sidebars', 'boo'),
	'icon'       => 'el-icon-adjust-alt',
	'fields'     => array(

		array(
			'id'       => 'rella-sidebar-one',
			'type'     => 'select',
			'title'    => esc_html__( 'Select Sidebar', 'boo' ),
			'subtitle' => esc_html__( 'Select sidebar that will display on this page. Choose "No Sidebar" for full width.', 'boo' ),
			'options'  => rella_helper()->get_sidebars( array( 'none' => esc_html__( 'No Sidebar', 'boo' ), 'main' => esc_html__( 'Main Sidebar', 'boo' ) ) ),
		),

		array(
			'id'       => 'rella-sidebar-position',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Sidebar Position', 'boo' ),
			'subtitle' => esc_html__( 'Select the sidebar position. If sidebar 2 is selected, it will display on the opposite side. ', 'boo' ),
			'options'  => array(
				'default' => esc_html__( 'Default', 'boo' ),
				'left'    => esc_html__( 'Left', 'boo' ),
				'right'   => esc_html__( 'Right', 'boo' )
			),
			'required' => array(
				array( 'rella-sidebar-one', 'not', '' ),
				array( 'rella-sidebar-one', 'not', 'none' )
			),
			'default' => 'default'
		),

		array(
			'id'       => 'rella-sidebar-fixed',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Sticky Sidebar?', 'boo' ),
			'subtitle' => esc_html__( 'Enable on to make Sidebar fixed', 'boo' ),
			'options'  => array(
				'on'  => esc_html__( 'On', 'boo' ),
				'off' => esc_html__( 'Off', 'boo' )
			),
			'required' => array(
				array( 'rella-sidebar-one', 'not', '' ),
				array( 'rella-sidebar-one', 'not', 'none' )
			),
			'default' => 'off'
		)
	)
);