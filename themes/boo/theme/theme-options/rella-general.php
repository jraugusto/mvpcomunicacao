<?php
/*
 * General Section
*/

$this->sections[] = array(
	'title'  => esc_html__('General', 'boo'),
	'icon'   => 'el-icon-adjust-alt',
);

// General Setting
$this->sections[] = array(
	'title'  => esc_html__('General Settings', 'boo'),
	'subsection' => true,
	'fields' => array(

		array(
			'id'       => 'custom-sidebars',
			'type'     => 'multi_text',
			'title'    => esc_html__( 'Custom Sidebars', 'boo' ),
			'subtitle' => esc_html__( 'Custom sidebars can be assigned to any page or post.', 'boo' ),
			'desc'     => esc_html__( 'You can add as many custom sidebars as you need.', 'boo' )
		),

		array(
			'id'       => 'google-api-key',
			'type'     => 'text',
			'title'    => esc_html__( 'Google map API key', 'boo' ),
			'subtitle' => '',
			'desc'     => esc_html__( 'Add your Google map API key here. You can get Google API key from https://developers.google.com/maps/documentation/javascript/get-api-key', 'boo' )
		),
		
		array(
			'id'       => 'instagram-token',
			'type'     => 'text',
			'title'    => esc_html__( 'Instagram Access Token', 'boo' ),
			'subtitle' => '',
			'desc'     => wp_kses_post( __( 'In order to make instragam shortcode to work, you need to login in Instagram Account to <a target="_blank" href="https://instagram.com/oauth/authorize/?client_id=61156e54867448039c8325143064fac0&scope=basic&response_type=code&redirect_uri=http://themerella.com/instagram/instagram-auth.php">Generate the Access Token and get User ID</a>', 'boo' ) ),
		),
		
		array(
			'id'      => 'primary_ac_color',
			'type'    => 'color',
			'title'   => esc_html__( 'Primary Accent color' , 'boo' ),
			'subtile' => '',
			'desc'    => esc_html__( 'Use this colorpicker to override main accent color of the theme', 'boo' ),
			'default' => '#f13c46',

		),
		
		array(
			'id'      => 'secondary_ac_color',
			'type'    => 'color',
			'title'   => esc_html__( 'Secondary Accent color' , 'boo' ),
			'subtile' => '',
			'desc'    => esc_html__( 'Use this colorpicker to override secondary accent color of the theme', 'boo' ),
		),

		array(
			'id'      => 'tertiary_ac_color',
			'type'    => 'color',
			'title'   => esc_html__( 'Tertiary Accent color' , 'boo' ),
			'subtile' => '',
			'desc'    => esc_html__( 'Use this colorpicker to override tertiary accent color of the theme', 'boo' ),
		),
		
		array(
			'id'      => 'primary_gradient_color',
			'type'    => 'color_gradient',
			'title'   => esc_html__( 'Primary Gradient colors' , 'boo' ),
			'subtile' => '',
			'desc'    => esc_html__( 'Use this colorpicker to override main gradient colors of the theme', 'boo' ),
			'validate' => 'color',
			'default' => array(
				'from' => '#f42958',
				'to'   => '#e4442a',
				
			)
		),
		
		array(
			'id'      => 'secondary_gradient_color',
			'type'    => 'color_gradient',
			'title'   => esc_html__( 'Secondary Gradient colors' , 'boo' ),
			'subtile' => '',
			'desc'    => esc_html__( 'Use this colorpicker to override secondary gradient colors of the theme', 'boo' ),
			'validate' => 'color',
			'default' => array(
				'from' => '',
				'to' => '',
				
			)	
		),
		
		array(
			'id'      => 'tertiary_gradient_color',
			'type'    => 'color_gradient',
			'title'   => esc_html__( 'Tertiary Gradient colors' , 'boo' ),
			'subtile' => '',
			'desc'    => esc_html__( 'Use this colorpicker to override tertiary gradient colors of the theme', 'boo' ),
			'validate' => 'color',
			'default' => array(
				'from' => '',
				'to' => '',
				
			)	
		),
		
		array(
			'id'    => 'links_color',
			'type'  => 'link_color',
			'title' => esc_html__( 'Links Color Option', 'boo' ),
			'active' => false,
			'visited' => true,
		),
		
		
		
	)
);

// Theme Features
$this->sections[] = array(
	'title'      => esc_html__( 'Theme Features', 'boo' ),
	'subsection' => true,
	'fields'     => array(

		array(
			'id' => 'enable-boo-universe',
			'type'     => 'switch',
			'title'    => esc_html__( 'Enable Boo Universe', 'boo' ),
			'subtitle' => esc_html__( 'If on will enable Boo Visual Composer pre-builded templates', 'boo' ),
			'default'  => 1
		),

		array(
			'id'       => 'enable-preloader',
			'type'     => 'switch',
			'title'    => esc_html__( 'Enable Loader Effect', 'boo' ),
			'subtitle' => esc_html__( 'If on, a loader will appear before loading the page.', 'boo' ),
			'default'  => 0
		),
		
		array(
			'id'       => 'preloader-style',
			'type'     => 'select',
			'title'    => esc_html__( 'Preloader Style', 'boo'),
			'subtitle' => esc_html__( 'Select a preloader style', 'boo'),
			'options'  => array(
				'default' => esc_html__( 'Default', 'boo' ),
				'style2'  => esc_html__( 'Style 2', 'boo' ),
				'style3'  => esc_html__( 'Style 3', 'boo' ),
				'style4'  => esc_html__( 'Style 4', 'boo' ),
				'style5'  => esc_html__( 'Style 5', 'boo' ),
				'style6'  => esc_html__( 'Style 6', 'boo' ),
			),
			'default'   => 'default',
			'required'  => array(
				'enable-preloader', 
				'!=', 
				0
			),
		),
		
		array(
			'id'      => 'preloader-color',
			'type'    => 'color',
			'title'   => esc_html__( 'Preloader Color' , 'boo' ),
			'subtile' => '',
			'desc'    => esc_html__( 'Use this colorpicker to change preloader background color', 'boo' ),
			'required'  => array(
				'enable-preloader', 
				'!=', 
				0
			),
		),
		
		array(
			'id'      => 'preloader-color-back',
			'type'    => 'color',
			'title'   => esc_html__( 'Preloader Color Back' , 'boo' ),
			'subtile' => '',
			'desc'    => esc_html__( 'Use this colorpicker to change preloader back background color', 'boo' ),
			'required'  => array(
				'preloader-style', 
				'=', 
				'style5'
			),
		),

		array(
			'id'       => 'enable-lazy-load',
			'type'     => 'switch',
			'title'    => esc_html__( 'Enable Progressively Load', 'boo' ),
			'subtitle' => esc_html__( 'If enabled it will progressively load the images and speed up the page loading.', 'boo' ),
			'default'  => 1
		),
		
		array(
			'id'       => 'smooth-scroll',
			'type'     => 'switch',
			'title'    => esc_html__( 'Enable Smooth Scroll', 'boo' ),
			'subtitle' => esc_html__( 'If on, will enable smooth scroll', 'boo' ),
			'default'  => 0
		),

		array(
			'id'       => 'enable-go-top',
			'type'     => 'switch',
			'title'    => esc_html__( 'Enable Go To Top Buttons', 'boo' ),
			'subtitle' => esc_html__( 'If on, a button will appear in the right bottom corner the page.', 'boo' ),
			'default'  => 0
		),

		array(
			'id'    => 'sh_theme_features',
			'type'  => 'raw',
			'class' => 'redux-sub-heading',
			'desc'  => '<h2>' . esc_html__( 'Icons', 'boo' ) . '</h2>'
		),

		array(
			'id'       => 'font-icons',
			'type'     => 'select',
			'multi'    => true,
			'title'    => esc_html__( 'Additional Icon Fonts sets', 'boo' ),
			'subtitle' => esc_html__( 'Select icon fonts sets you want to enable', 'boo' ),
			'options'  => array(
				'rella-icons' => esc_html__( 'Rella Icons', 'boo' )
			),
			'default' => array( 'rella-icons' ),
		),

		array(
			'id' => 'custom-icons-fonts',
			'type' => 'repeater',
			'title'    => esc_html__( 'Custom Icons', 'boo' ),
			'subtitle' => esc_html__( 'Add your custom icons here', 'boo' ),
			'desc' => esc_html__( 'NOTE: All icons files should be uploaded via FTP on your server', 'boo' ),
			'sortable' => false,
			'group_values' => false,
						'fields' => array(
				
				array(
					'id' => 'custom_icon_font_title',
					'type' => 'text',
					'title'    => esc_html__( 'Font icon title', 'boo' ),
					'placeholder' => esc_html__( 'Awesome Font', 'boo' ),
					'subtitle' => esc_html__( 'Add title of the font icon as it will be used font icon id and will display in Iconpicker', 'boo' ),
				),
				
				array(
					'id'    => 'custom_icon_font_css',
					'type'  => 'text',	
					'title' => esc_html__( 'Icon Css file', 'boo' ),
					'placeholder' => esc_html__( 'http://example.com/wp-content/my-custom-icons/my-custom-icons.css', 'boo' ),
				),
				
				array(
					'id'    => 'custom_icons_classnames',
					'type'  => 'textarea',	
					'title' => esc_html__( 'Icons classnames', 'boo' ),
					'desc'  => esc_html__( 'Please, add icons classnames, separated by comma. Ex. icon-home, icon-envelope, icon-circle', 'boo' ),
				),
			)
		),		

	)
);