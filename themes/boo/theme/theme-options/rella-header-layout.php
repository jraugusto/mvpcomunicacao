<?php
/*
 * Header Layout Section
*/

$this->sections[] = array(
	'title'  => esc_html__('Layout', 'boo'),
	'subsection' => true,
	'fields' => array(

		array(
			'id' => 'header-enable-switch',
			'type'	 => 'button_set',
			'title' => esc_html__('Enable Header', 'boo'),
			'subtitle' => esc_html__('If on, this layout part will be displayed.', 'boo'),
			'options' => array(
				'on' => 'On',
				'off' => 'Off'
			)
		),

		array(
 			'id'=>'header-template',
 			'type' => 'select',
 			'title' => esc_html__('Template', 'boo'),
 			'subtitle'=> esc_html__('Choose template for header.', 'boo'),
 			'data' => 'post',
			'args' => array( 'post_type' => 'rella-header', 'posts_per_page' => -1 )
 		),
 		
		array(
			'id'       => 'mobile-header-overlay-enable',
			'type'     => 'select',
			'title'    => esc_html__( 'Mobile dropdown style', 'boo'),
			'subtitle' => '',
			'options'  => array(
				''                      => esc_html__( 'Default', 'boo' ),
				'mobile-header-overlay' => esc_html__( 'Alternative', 'boo' ),
			),
		),
		
		array(
			'id'      => 'mobile-trigger-color',
			'type'    => 'color',
			'title'   => esc_html__( 'Mobile nav trigger color' , 'boo' ),
			'subtile' => '',
			'desc'    => esc_html__( 'Use this colorpicker to set a color for mobile nav trigger', 'boo' ),
			'required'  => array(
				'mobile-header-overlay-enable', 
				'=', 
				'mobile-header-overlay'
			),
		),

		
	)
);
