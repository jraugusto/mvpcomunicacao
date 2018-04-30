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

$url = get_template_directory_uri() . '/theme/assets/headers';
$sections[] = array(
	'post_types' => array('rella-header'),
	'title' => esc_html__('Menu Design Options', 'boo'),
	'icon' => 'el-icon-cog',
	'fields' => array(
		
		array(
			'id' => 'header-layout',
			'type'	 => 'select',
			'title' => esc_html__('Style', 'boo'),
			'options' => array(
				'default' => esc_html__('Default', 'boo'),
				'overlay' => esc_html__('Overlay', 'boo')
			),
			'default' => 'default'
		),

		array(
			'id'          => 'nav_typography',
			'title'       => esc_html__( 'Menus Typography', 'boo' ),
			'description' => esc_html__( 'These settings control the typography for all menus.', 'boo' ),
			'type'        => 'typography',
			'text-align' => false,
			'text-transform' => true,
			'color' => false,
			'letter-spacing' => true,
			'preview' => false,
			'subsets' => false
		),

		array(
			'id'          => 'nav_mobile_typography',
			'title'       => esc_html__( 'Mobile Menus Typography', 'boo' ),
			'description' => esc_html__( 'These settings control the typography for mobile menu.', 'boo' ),
			'type'        => 'typography',
			'text-align' => false,
			'text-transform' => true,
			'color' => false,
			'letter-spacing' => true,
			'preview' => false,
			'subsets' => false
		),
		
		array(
			'id'       => 'nav_child_enable_typo',
			'type'	   => 'button_set',
			'title'    => esc_html__('Typography for Child Menus', 'boo'),
			'subtitle' => '',
			'options'  => array(
				'on'   => 'On',
				'0'    => 'Default',
				'off'  => 'Off'
			),
			'default' => '0'
		),
		
		array(
			'id'          => 'nav_child_typography',
			'title'       => esc_html__( 'Child Menus Typography', 'boo' ),
			'description' => esc_html__( 'These settings control the typography for all menus.', 'boo' ),
			'type'        => 'typography',
			'text-align' => false,
			'text-transform' => true,
			'line-height' => false,
			'color' => false,
			'letter-spacing' => true,
			'preview' => false,
			'subsets' => false,
			'required' => array(
				'nav_child_enable_typo',
				'equals',
				'on'
			),
		),
		
		array(
			'id'          => 'nav_child_mobile_typography',
			'title'       => esc_html__( 'Mobile Child Menus Typography', 'boo' ),
			'description' => esc_html__( 'These settings control the typography for mobile menu.', 'boo' ),
			'type'        => 'typography',
			'text-align' => false,
			'text-transform' => true,
			'color' => false,
			'letter-spacing' => true,
			'preview' => false,
			'subsets' => false,
			'required' => array(
				'nav_child_enable_typo',
				'equals',
				'on'
			),
		),

		array(
			'id'          => 'nav_color',
			'title'       => esc_html__( 'Main Color', 'boo' ),
			'type'        => 'color_rgba',
		),

		array(
			'id'          => 'nav_secondary_color',
			'title'       => esc_html__( 'Secondary Color', 'boo' ),
			'type'        => 'color_rgba',
		),

		array(
			'id'          => 'nav_active_color',
			'title'       => esc_html__( 'Active Color', 'boo' ),
			'type'        => 'color_rgba',
		),

		array(
			'id'    => 'nav_padding',
			'type'	=> 'spacing',
			'title' => esc_html__( 'Menu Item Spacing', 'boo' ),
			'units' => array(
				'px',
				'%',
				'em',
				'rem'
			)
		),

		array(
			'id'     => 'nav_logo_padding',
			'type'	 => 'spacing',
			'title'  => esc_html__( 'Logo Spacing', 'boo' ),
			'units'  => array(
				'px',
				'%',
				'em',
				'rem'
			)
		),

		array(
			'id'      => 'mobile_parent_link',
			'type'    => 'select',
			'title'   => esc_html__( 'Enable parent links on mobile menu', 'boo' ),
			'options' => array(
				''    => esc_html__( 'No', 'boo' ),
				'yes' => esc_html__( 'Yes', 'boo' ),
			),
		),

		array(
			'id'      => 'mobile_logo_alignment',
			'type'    => 'select',
			'title'   => esc_html__( 'Mobile Logo Alignment', 'boo' ),
			'options' => array(
				'logo-sm-left'      => esc_html__( 'Left', 'boo' ),
				'logo-sm-left-edge' => esc_html__( 'Left Edge', 'boo' ),
				'logo-sm-centered'  => esc_html__( 'Center', 'boo' ),
			),
		),

		array(
			'id'          => 'enable_mobile_modules',
			'type'        => 'select',
			'title'       => esc_html__( 'Enable Modules on Mobile Header', 'boo' ),
			'description' => esc_html__( 'Select Yes to display desktop header modules in header of the mobile version also ( works only for cart/search/language switcher modules )', 'boo' ),
			'options' => array(
				''                   => esc_html__( 'No', 'boo' ),
				'modules-sm-visible' => esc_html__( 'Yes', 'boo' ),
			),
		),
		array(
			'id'          => 'enable_mobile_search',
			'type'        => 'select',
			'title'       => esc_html__( 'Show Search Module on Mobile Header', 'boo' ),
			'description' => esc_html__( 'Select Yes to display search header module in the header of the mobile version', 'boo' ),
			'options' => array(
				''                   => esc_html__( 'No', 'boo' ),
				'search-sm-visible' => esc_html__( 'Yes', 'boo' ),
			),
			'required' => array(
				'enable_mobile_modules',
				'equals',
				'modules-sm-visible'
			)
		),
		array(
			'id'          => 'enable_mobile_cart',
			'type'        => 'select',
			'title'       => esc_html__( 'Show Cart Module on Mobile Header', 'boo' ),
			'description' => esc_html__( 'Select Yes to display cart header module in the header of the mobile version', 'boo' ),
			'options' => array(
				''                => esc_html__( 'No', 'boo' ),
				'cart-sm-visible' => esc_html__( 'Yes', 'boo' ),
			),
			'required' => array(
				'enable_mobile_modules',
				'equals',
				'modules-sm-visible'
			)
		),
		array(
			'id'          => 'enable_mobile_language',
			'type'        => 'select',
			'title'       => esc_html__( 'Show Language Module on Mobile Header', 'boo' ),
			'description' => esc_html__( 'Select Yes to display language header module in the header of the mobile version', 'boo' ),
			'options' => array(
				''                   => esc_html__( 'No', 'boo' ),
				'language-sm-visible' => esc_html__( 'Yes', 'boo' ),
			),
			'required' => array(
				'enable_mobile_modules',
				'equals',
				'modules-sm-visible'
			)
		),

	)
);
