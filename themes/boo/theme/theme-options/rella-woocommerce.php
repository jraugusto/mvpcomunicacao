<?php

$this->sections[] = array(
	'title' => esc_html__( 'Woocommerce', 'boo' ),
	'icon'  => 'el-icon-shopping-cart'
);

$this->sections[] = array(
	'title'      => esc_html__( 'Shop Settings', 'boo' ),
	'subsection' => true,
	'fields'     => array(
		
		array(
			'id'       => 'wc-archive-title-bar-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Woo Category Title Bar', 'boo' ),
			'subtitle' => esc_html__( 'Turn on to show the woo category title bar', 'boo' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'boo' ),
				'off'  => esc_html__( 'Off', 'boo' )
			),
			'default'  => 'on'
		),

		array(
			'id'       => 'wc-archive-title-bar-heading',
			'type'	   => 'text',
			'title'    => esc_html__( 'Woo Category Title', 'boo' ),
			'subtitle' => esc_html__( 'Controls the title text that displays in the woo category', 'boo' ),
		),

		array(
			'id'       => 'wc-archive-title-bar-subheading',
			'type'	   => 'text',
			'title'    => esc_html__( 'Woo Category Subtitle', 'boo' ),
			'subtitle' => esc_html__( 'Controls the subtitle text that displays in the woo category', 'boo' )
		),
		
		array(
			'id'    => 'ra_woo_style',
			'type'  => 'select',	
			'title' => esc_html__( 'Shop Catalog Style', 'boo' ),
			'desc'  => esc_html__( 'Select a style for products to display on shop catalog', 'boo' ),
			'options' => array(
				'elegant' => esc_html( 'Elegant', 'boo' )
			),
			'default' => 'elegant'

		),
		
		array(
			'id'       => 'wc-archive-sorter-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Sorter By', 'boo' ),
			'subtitle' => esc_html__( 'Turn on to show sorterby on shop/category page', 'boo' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'boo' ),
				'off'  => esc_html__( 'Off', 'boo' )
			),
			'default'  => 'off'
		),
		
		array(
			'id'      => 'ra_woo_products_per_page',
			'type'    => 'text',	
			'title'   => esc_html__( 'Products per page', 'boo' ),
			'desc'    => esc_html__( 'How many products per page to display?', 'boo' ),
			'default' => '12'
		),

		array(
			'id'    => 'ra_woo_columns',
			'type'  => 'select',	
			'title' => esc_html__( 'Shop Columns', 'boo' ),
			'desc'  => esc_html__( 'Select how many columns per row to display', 'boo' ),
			'options' => array(
				'1' => esc_html( '1', 'boo' ),
				'2' => esc_html( '2', 'boo' ),
				'3' => esc_html( '3', 'boo' ),
				'4' => esc_html( '4', 'boo' ),
				'5' => esc_html( '5', 'boo' ),
				'6' => esc_html( '6', 'boo' ),
			),
			'default' => '3'

		),

	) 
);

$this->sections[] = array(
	'title' => esc_html__( 'Single Product', 'boo' ),
	'subsection' => true,
	'fields' => array(
		
		array(
			'id'    => 'woo_single_style',
			'type'  => 'select',	
			'title' => esc_html__( 'Product Style', 'boo' ),
			'desc'  => esc_html__( 'Select a single product style display', 'boo' ),
			'options' => array(
				'default' => esc_html( 'Default', 'boo' ),
				'alt'     => esc_html__( 'Alternative', 'boo' ),
			),
			'default' => 'default',
		),
		
		array(
			'id'       => 'ra_enable_woo_related',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Enable Related Products', 'boo' ),
			'desc'     => esc_html__( 'Will enable related products on single product ', 'boo' ),
			'options' => array(
				'on' => 'On',
				'off' => 'Off'
			),
			'default' => 'on'
		),

		array(
			'id'    => 'ra_woo_related_columns',
			'type'  => 'select',	
			'title' => esc_html__( 'Related Products Columns', 'boo' ),
			'desc'  => esc_html__( 'Select how many columns per row to display', 'boo' ),
			'options' => array(
				'1' => esc_html( '1', 'boo' ),
				'2' => esc_html( '2', 'boo' ),
				'3' => esc_html( '3', 'boo' ),
				'4' => esc_html( '4', 'boo' ),
				'5' => esc_html( '5', 'boo' ),
				'6' => esc_html( '6', 'boo' ),
			),
			'default' => '4',
			'required' => array(
				'ra_enable_woo_related',
				'!=',
				'off'
			),
		),
	
		array(
			'id'    => 'ra_woo_up_sell_columns',
			'type'  => 'select',	
			'title' => esc_html__( 'Up-Sell Products Columns', 'boo' ),
			'desc'  => esc_html__( 'Select how many columns per row to display', 'boo' ),
			'options' => array(
				'1' => esc_html( '1', 'boo' ),
				'2' => esc_html( '2', 'boo' ),
				'3' => esc_html( '3', 'boo' ),
				'4' => esc_html( '4', 'boo' ),
				'5' => esc_html( '5', 'boo' ),
				'6' => esc_html( '6', 'boo' ),
			),
			'default' => '4'
		),
		
		array(
			'id'    => 'ra_woo_cross_sell_columns',
			'type'  => 'select',	
			'title' => esc_html__( 'Cross-Sell Products Columns', 'boo' ),
			'desc'  => esc_html__( 'Select how many columns per row to display', 'boo' ),
			'options' => array(
				'1' => esc_html( '1', 'boo' ),
				'2' => esc_html( '2', 'boo' ),
				'3' => esc_html( '3', 'boo' ),
				'4' => esc_html( '4', 'boo' ),
				'5' => esc_html( '5', 'boo' ),
				'6' => esc_html( '6', 'boo' ),
			),
			'default' => '2'
		),
		
	)
);
	
?>