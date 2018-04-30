<?php
/*
 * Header Section
 *
 * Available options on $section array:
 * separate_box (boolean) - separate metabox is created if true
 * box_title - title for separate metabox
 * title - section title
 * desc - section description
 * icon - section icon
 * fields - fields, @see https://docs.reduxframework.com/ for details
*/

$sections[] = array(
	'post_types' => array( 'post', 'page', 'rella-portfolio' ),
	'title'      => esc_html__( 'Header', 'boo' ),
	'icon'       => 'el-icon-cog',
	'fields'     => array(

		array(
			'id'       => 'header-enable-switch',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Display Header', 'boo' ),
			'subtitle' => esc_html__( 'Choose to show or hide the header.', 'boo' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'boo' ),
				'0'    => esc_html__( 'Default', 'boo' ),
				'off'  => esc_html__( 'Off', 'boo' ),
			),
			'default'  => '0'
		),

		array(
			'id'       => 'header-template',
			'type'     => 'select',
			'title'    => esc_html__( 'Header Template', 'boo' ),
			'subtitle' => esc_html__( 'Select which header displays on this page, this header override the default header.', 'boo' ),
			'data'     => 'post',
			'args'     => array( 
				'post_type'      => 'rella-header', 
				'posts_per_page' => -1 
			),
			'required'  => array(
				'header-enable-switch', 
				'!=', 
				'off'
			),
		),
		
		array(
			'id'       => 'header-position',
			'type'     => 'select',
			'title'    => esc_html__( 'Header Position', 'boo' ),
			'subtitle' => esc_html__( 'Select position for overlay header in titlebar, works only if titlebar is enabled and header is overlay style', 'boo' ),
			'options'  => array(
				''       => esc_html__( 'Default', 'boo' ),
				'bottom' => esc_html__( 'Bottom', 'boo' )
			),
			'required' => array(
				'header-enable-switch', 
				'!=', 
				'off'
			),
			'default'  => ''
		),

		array(
			'id'       => 'header-primary-menu',
			'type'     => 'select',
			'title'    => esc_html__( 'Main Navigation Menu', 'boo' ),
			'subtitle' => esc_html__( 'Select which menu displays on this page, this menu override the header menu set at primary location.', 'boo' ),
			'data'     => 'menus',
			'default'  => ''
		),
		
		array(
			'id'          => '_local_nav_typography',
			'title'       => esc_html__( 'Menus Typography', 'boo' ),
			'description' => esc_html__( 'These settings control the typography for all menus.', 'boo' ),
			'type'        => 'typography',
			'class'       => 'hidden',
			'text-align' => false,
			'text-transform' => true,
			'color' => false,
			'letter-spacing' => true,
			'preview' => false,
			'subsets' => false
		),
		
		array(
			'id'          => '_local_mobile_nav_typography',
			'title'       => esc_html__( 'Menus Typography', 'boo' ),
			'description' => esc_html__( 'These settings control the typography for all menus.', 'boo' ),
			'type'        => 'typography',
			'class'       => 'hidden',
			'text-align' => false,
			'text-transform' => true,
			'color' => false,
			'letter-spacing' => true,
			'preview' => false,
			'subsets' => false
		),

	), // #fields
);