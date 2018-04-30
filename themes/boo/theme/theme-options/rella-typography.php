<?php
/*
 * General Section
*/

$this->sections[] = array(
	'title'  => esc_html__( 'Typography', 'boo' ),
	'icon'   => 'el-icon-fontsize'
);

// Body
$this->sections[] = array(
	'title'      => esc_html__( 'Body Typography', 'boo' ),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'             => 'body_typography',
			'type'           => 'typography',
			'title'          => esc_html__( 'Body Typography', 'boo' ),
			'subtitle'       => esc_html__( 'These settings control the typography for all body text.', 'boo' ),
			'letter-spacing' => true,
			'text-align'     => false,
			'compiler'       => true,
			'units'          => '%',
			'default'        => array(
				'font-family'    => 'Poppins',
				'font-size'      => '14px',
				'font-weight'    => '400',
				'line-height'    => '2',
				'letter-spacing' => '0',
				'color'          => '#737373',
			)
		),

		array(
			'id'             => 'body_extra_typography',
			'title'          => esc_html__( 'Body Extra Typography', 'boo' ),
			'subtitle'       => esc_html__( 'This setting control the typography for some elements in text.', 'boo' ),
			'type'           => 'typography',
			'letter-spacing' => false,
			'text-align'     => false,
			'units'          => '%',
			'all_styles'     => true,
			'color'          => false,
			'font-size'      => false,
			'line-height'    => false,
			'font-style'     => false,
			'font-weight'    => false,
		),

		array(
			'id'             => 'body_sec_extra_typography',
			'title'          => esc_html__( 'Body Extra Typography', 'boo' ),
			'subtitle'       => esc_html__( 'This setting control the typography for some elements in text.', 'boo' ),
			'type'           => 'typography',
			'letter-spacing' => false,
			'text-align'     => false,
			'units'          => '%',
			'all_styles'     => true,
			'color'          => false,
			'font-size'      => false,
			'line-height'    => false,
			'font-style'     => false,
			'font-weight'    => false,
		),
		
		
	)
);


// Headers
$this->sections[] = array(
	'title'      => esc_html__( 'Headings Typography', 'boo' ),
	'subsection' => true,
	'fields'     => array(

		'h1_typography' => array(
			'id'             => 'h1_typography',
			'type'           => 'typography',
			'title'          => esc_html__( 'H1 Heading Typography', 'boo' ),
			'subtitle'       => esc_html__( 'These settings control the typography for all H1 Heading.', 'boo' ),
			'letter-spacing' => true,
			'text-align'     => false,
			'compiler'       => true,
			'units'          => '%',
			'default'        => array(
				'font-family'    => 'Poppins',
				'font-size'      => '50px',
				'font-weight'    => '400',
				'line-height'    => '1.5em',
				'letter-spacing' => '0',
				'color'          => '#000000'
			)
		),
		
		array(
			'id'       => 'typo-default-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Enable Inheritance', 'boo' ),
			'subtitle' => esc_html__( 'Turn on to inherite the same font-family and font-style for all other headings', 'boo' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'boo' ),
				'off'  => esc_html__( 'Off', 'boo' )
			),
			'default'  => 'off'
		),

		'h2_typography' => array(
			'id'              => 'h2_typography',
			'title'           => esc_html__( 'H2 Heading Typography', 'boo' ),
			'subtitle'        => esc_html__( 'These settings control the typography for all H2 Headings.', 'boo' ),
			'type'            => 'typography',
			'letter-spacing'  => true,
			'text-align'      => false,
			'compiler'        => true,
			'units'           => '%',
			'default'         => array(
				'font-family'    => 'Poppins',
				'font-size'      => '40px',
				'font-weight'    => '600',
				'line-height'    => '1.375em',
				'letter-spacing' => '-0.025em',
				'color'          => '#000000'
			)
		),

		'h3_typography' => array(
			'id'             => 'h3_typography',
			'type'           => 'typography',
			'title'          => esc_html__( 'H3 Heading Typography', 'boo' ),
			'subtitle'       => esc_html__( 'These settings control the typography for all H3 Headings.', 'boo' ),
			'letter-spacing' => true,
			'text-align'     => false,
			'compiler'       => true,
			'units'          => '%',
			'default'        => array(
				'font-family'    => 'Poppins',
				'font-size'      => '21px',
				'font-weight'    => '500',
				'line-height'    => '1.7em',
				'letter-spacing' => '0',
				'color'          => '#000000'
			)
		),

		'h4_typography' => array(
			'id'             => 'h4_typography',
			'type'           => 'typography',
			'title'          => esc_html__( 'H4 Heading Typography', 'boo' ),
			'subtitle'       => esc_html__( 'These settings control the typography for all H4 Headings.', 'boo' ),
			'letter-spacing' => true,
			'text-align'     => false,
			'compiler'       => true,
			'units'          => '%',
			'default'        => array(
				'font-family'    => 'Poppins',
				'font-size'      => '20px',
				'font-weight'    => '500',
				'line-height'    => '1.7em',
				'letter-spacing' => '0',
				'color'          => '#000000'
			)
		),

		'h5_typography' => array(
			'id'             => 'h5_typography',
			'type'           => 'typography',
			'title'          => esc_html__( 'H5 Heading Typography', 'boo' ),
			'subtitle'       => esc_html__( 'These settings control the typography for all H5 Headings.', 'boo' ),
			'letter-spacing' => true,
			'text-align'     => false,
			'compiler'       => true,
			'units'          => '%',
			'default'        => array(
				'font-family'    => 'Poppins',
				'font-size'      => '18px',
				'font-weight'    => '500',
				'line-height'    => '2em',
				'letter-spacing' => '0',
				'color'          => '#000000'
			)
		),

		'h6_typography' => array(
			'id'             => 'h6_typography',
			'type'           => 'typography',
			'title'          => esc_html__( 'H6 Heading Typography', 'boo' ),
			'subtitle'       => esc_html__( 'These settings control the typography for all H6 Headings.', 'boo' ),
			'letter-spacing' => true,
			'text-align'     => false,
			'compiler'       => true,
			'units'          => '%',
			'default'        => array(
				'font-family'    => 'Poppins',
				'font-size'      => '17px',
				'font-weight'    => '500',
				'line-height'    => '2',
				'letter-spacing' => '0',
				'color'          => '#a4a4a4'
			)
		),
	)
);

// Custom Fonts
$this->sections[] = array(
	'title'      => esc_html__( 'Custom fonts', 'boo' ),
	'subsection' => true,
	'fields'     => array(
		
		array(
			'id' => 'rella_custom_fonts',
			'type' => 'repeater',
			'title'    => esc_html__( 'Custom Fonts', 'boo' ),
			'subtitle' => esc_html__( 'Add your custom fonts here', 'boo' ),
			'desc' => esc_html__( 'NOTE: All fonts file should be uploaded via FTP on your server', 'boo' ),
			'sortable' => false,
			'group_values' => false,
			'fields' => array(
				
				array(
					'id' => 'custom_font_title',
					'type' => 'text',
					'title'    => esc_html__( 'Font title', 'boo' ),
					'placeholder' => esc_html__( 'Montserrat', 'boo' ),
					'subtitle' => esc_html__( 'Add title of the font as it will be used in Redux Typography', 'boo' ),
				),
				
				array(
					'id'    => 'custom_font_woff2',
					'type'  => 'text',	
					'title' => esc_html__( 'WOFF2 file', 'boo' ),
					'placeholder' => esc_html__( 'http://example.com/wp-content/my-custom-font/my-custom-font.woff2', 'boo' ),
				),
				
				array(
					'id'    => 'custom_font_woff',
					'type'  => 'text',	
					'title' => esc_html__( 'WOFF file', 'boo' ),
					'placeholder' => esc_html__( 'http://example.com/wp-content/my-custom-font/my-custom-font.woff', 'boo' ),
				),
				
				array(
					'id'    => 'custom_font_ttf',
					'type'  => 'text',	
					'title' => esc_html__( 'TTF file', 'boo' ),
					'placeholder' => esc_html__( 'http://example.com/wp-content/my-custom-font/my-custom-font.ttf', 'boo' ),
				),
				
				array(
					'id'    => 'custom_font_svg',
					'type'  => 'text',	
					'title' => esc_html__( 'SVG file', 'boo' ),
					'placeholder' => esc_html__( 'http://example.com/wp-content/my-custom-font/my-custom-font.svg', 'boo' ),
				),
				
			)
		)
	)
);