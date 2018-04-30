<?php
/*
 * Portfolio
 */

$this->sections[] = array(
	'title'  => esc_html__( 'Portfolio', 'boo' ),
	'icon'   => 'el-icon-th'
);

$this->sections[] = array(
	'title'      => esc_html__( 'General', 'boo' ),
	'subsection' => true,
	'fields'     => array(
		
		array(
			'id'       => 'portfolio-title-bar-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Portfolio Archive/Category Title Bar', 'boo' ),
			'subtitle' => esc_html__( 'Turn on to show the portfolio archive/category title bar', 'boo' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'boo' ),
				'off'  => esc_html__( 'Off', 'boo' )
			),
			'default'  => 'on'
		),

		array(
			'id'       => 'portfolio-title-bar-heading',
			'type'	   => 'text',
			'title'    => esc_html__( 'Portfolio Archive/Category Title', 'boo' ),
			'desc'     => esc_html__( 'Use shortcode [ra_category_title] to display the portfolio category title', 'boo' ),
			'subtitle' => esc_html__( 'Controls the title text that displays in the portfolio category archive page title bar.', 'boo' ),
			'default'  => esc_html__( 'Portfolio: [ra_category_title]', 'boo' ),
		),

		array(
			'id'       => 'portfolio-title-bar-subheading',
			'type'	   => 'text',
			'title'    => esc_html__( 'Portfolio Archive/Category Subtitle', 'boo' ),
			'subtitle' => esc_html__( 'Controls the subtitle text that displays in the portfolio archive/category', 'boo' )
		),

		array(
			'id'      => 'portfolio-style',
			'type'    => 'select',
			'title'   => esc_html__( 'Style', 'boo' ),
			'options' => array(
				'classic' => esc_html__( 'Classic', 'boo' ),
				'grid'    => esc_html__( 'Grid', 'boo' ),
				'masonry' => esc_html__( 'Masonry', 'boo' ),
				'metro'   => esc_html__( 'Metro', 'boo' ),
				'packery' => esc_html__( 'Packery', 'boo' ),
			),
			'subtitle' => esc_html__( 'Select content type for your grid.', 'boo' ),
			'default'  => 'classic'
		),

		array(
			'id'      => 'portfolio-items-style',
			'type'    => 'select',
			'title'   => esc_html__( 'Items Style', 'boo' ),
			'options' => array(
				// List
				'list'                => esc_html__( 'Default', 'boo' ),
				'shadow'              => esc_html__( 'List Shadow', 'boo' ),
				'outline'             => esc_html__( 'List Outline', 'boo' ),
				// Hover
				'hover-light'         => esc_html__( 'Hover Light', 'boo' ),
				'hover-dark'          => esc_html__( 'Hover Dark', 'boo' ),
				'hover-blur'          => esc_html__( 'Hover Blur', 'boo' ),
				'hover-side'          => esc_html__( 'Hover Side', 'boo' ),
				'hover-elegant'       => esc_html__( 'Hover Elegant', 'boo' ),
				'hover-rectangular'   => esc_html__( 'Hover Rectangular', 'boo' ),
				'hover-bottom'        => esc_html__( 'Hover Bottom', 'boo' ),
				'hover-only-icons'    => esc_html__( 'Hover Icons', 'boo' ),
				'hover-bottom-shadow' => esc_html__( 'Hover Shadow', 'boo' ),
				'hover-gradient'      => esc_html__( 'Hover Gradient', 'boo' ),
				'hover-color'         => esc_html__( 'Hover Color', 'boo' ),
				'hover-frame'         => esc_html__( 'Hover Frame', 'boo' ),
				'hover-bottom-left'   => esc_html__( 'Hover Left', 'boo' ),
				// Caption
				'caption-fixed'       => esc_html__( 'Caption Fixed', 'boo' ),

			),
			'subtitle' => esc_html__( 'Select style for portfolio items', 'boo' ),
			'default'  => 'list'
		),
		
		array(
			'id'      => 'portfolio-content-alignment',
			'type'    => 'select',
			'title'   => esc_html__( 'Content Alignment', 'boo' ),
			'options' => array(
				'default'       => esc_html__( 'Default', 'boo' ),
				'left'          => esc_html__( 'Left', 'boo' ),
				'center'        => esc_html__( 'Center', 'boo' ),
				'right'         => esc_html__( 'Right', 'boo' ),
				'inside-left'   => esc_html__( 'Inside Left', 'boo' ),
				'inside-center' => esc_html__( 'Inside Center', 'boo' ),
				 'inside-right' => esc_html__( 'Inside Right', 'boo' ),
			),
			'required' => array(
				'portfolio-style',
				'equals',
				'classic'
			),
		),
		
		array(
			'id'      => 'portfolio-text-alignment',
			'type'    => 'select',
			'title'   => esc_html__( 'Text Alignment', 'boo' ),
			'options' => array(
				'left'   => esc_html__( 'Left', 'boo' ),
				'center' => esc_html__( 'Center', 'boo' ),
				'right'  => esc_html__( 'Right', 'boo' ),
			),
			'required' => array(
				'portfolio-items-style',
				'equals',
				array( 'list', 'shadow', 'outline' ),
			),
		),
		
		array(
			'id' => 'portfolio-grid-columns',
			'type' => 'select',
			'title' => esc_html__( 'Columns', 'boo' ),
			'options' => array(
				'1' => '1 Columns',
				'2' => '2 Columns',
				'3' => '3 Columns',
				'4' => '4 Columns',
				'6' => '6 Columns',
			),
			'required' => array(
				'portfolio-style',
				'equals',
				array( 'grid', 'masonry' ),
			),
		),
		
		
		array(
			'id'    => 'portfolio-columns-gap',
			'type'  => 'select',
			'title' => esc_html__( 'Columns gap', 'boo' ),
			'options' => array(
				'0'  => '0px',
				'1'  => '1px',
				'2'  => '2px',
				'3'  => '3px',
				'4'  => '4px',
				'5'  => '5px',
				'10' => '10px',
				'15' => '15px',
				'20' => '20px',
				'25' => '25px',
				'30' => '30px',
				'35' => '35px',
			),
			'required' => array(
				'portfolio-style',
				'equals',
				array( 'grid', 'masonry', 'metro', 'packery' ),
			),
		),

		array(
			'id'     => 'show_hide_parts_info',
			'type'  => 'info',
			'style' => 'info',
			'title' => esc_html__( 'Show / Hide Parts', 'boo' ),
			'desc'  => esc_html__( 'Show or hide parts of the portfolio items on portfolio listing', 'boo' ),
		),

		array(
			'id'      => 'portfolio-show-title',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Title', 'boo' ),
			'options' => array(
				'on'  => 'On',
				'off' => 'Off',
			),
			'default' => 'on',
		),
		
		array(
			'id'      => 'portfolio-show-summary',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Description', 'boo' ),
			'options' => array(
				'on'  => 'On',
				'off' => 'Off',
			),
			'default' => 'on',
		),

		array(
			'id'      => 'portfolio-show-category',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Categories', 'boo' ),
			'options' => array(
				'on'  => 'On',
				'off' => 'Off',
			),
			'default' => 'on',
		),
		
		array(
			'id'      => 'portfolio-show-one-category',
			'type'    => 'button_set',
			'title'   => esc_html__( 'One Category', 'boo' ),
			'options' => array(
				'on'  => 'On',
				'off' => 'Off',
			),
			'default' => 'on',
			'required' => array(
				'portfolio-show-category',
				'equals',
				'on',
			),
		),
		
		array(
			'id'      => 'portfolio-show-like',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Like', 'boo' ),
			'options' => array(
				'on'  => 'On',
				'off' => 'Off',
			),
			'default' => 'on',
		),
		
		array(
			'id'      => 'portfolio-show-client',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Client', 'boo' ),
			'options' => array(
				'on'  => 'On',
				'off' => 'Off',
			),
			'default' => 'off',
			'required' => array(
				array( 'portfolio-items-style', '!=', 'hover-bottom' ),
				array( 'portfolio-items-style', '!=', 'hover-only-icons' ),
				array( 'portfolio-items-style', '!=', 'hover-bottom-shadow' ),
				array( 'portfolio-items-style', '!=', 'hover-elegant' ),
			),
		),

		array(
			'id'      => 'portfolio-show-date',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Date', 'boo' ),
			'options' => array(
				'on'  => 'On',
				'off' => 'Off',
			),
			'default' => 'on',
		),

		array(
			'id'      => 'portfolio-show-link',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Detail Button', 'boo' ),
			'options' => array(
				'on'  => 'On',
				'off' => 'Off',
			),
			'default' => 'on',
		),
		
		array(
			'id'      => 'portfolio-show-ext-link',
			'type'    => 'button_set',
			'title'   => esc_html__( 'External Link Button', 'boo' ),
			'options' => array(
				'on'  => 'On',
				'off' => 'Off',
			),
			'default' => 'off',
			'required' => array(				
				array( 'portfolio-items-style', '!=', 'list' ),
				array( 'portfolio-items-style', '!=', 'shadow' ),
				array( 'portfolio-items-style', '!=', 'outline' ),
				array( 'portfolio-items-style', '!=', 'hover-light' ),
				array( 'portfolio-items-style', '!=', 'hover-side' ),
			),
		),

		array(
			'id'      => 'portfolio-show-share',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Share Button', 'boo' ),
			'options' => array(
				'on'  => 'On',
				'off' => 'Off',
			),
			'default' => 'off',
			'required' => array(
				array( 'portfolio-items-style', '!=', 'hover-light' ),
				array( 'portfolio-items-style', '!=', 'hover-side' ),
			),
		),

		array(
			'id'      => 'portfolio-show-lightbox',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Lightbox Button', 'boo' ),
			'options' => array(
				'on'  => 'On',
				'off' => 'Off',
			),
			'default' => 'off',
			'required' => array(
				array( 'portfolio-items-style', '!=', 'hover-light' ),
				array( 'portfolio-items-style', '!=', 'hover-side' ),
				array( 'portfolio-items-style', '!=', 'list' ),
				array( 'portfolio-items-style', '!=', 'shadow' ),
				array( 'portfolio-items-style', '!=', 'outline' ),
			),
		),

		array(
			'id'      => 'portfolio-enable-panr',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Zoom Effect', 'boo' ),
			'options' => array(
				'on'  => 'On',
				'off' => 'Off',
			),
			'default' => 'off',
			'required' => array(
				array( 'portfolio-items-style', '!=', 'list' ),
				array( 'portfolio-items-style', '!=', 'shadow' ),
				array( 'portfolio-items-style', '!=', 'outline' ),
				array( 'portfolio-items-style', '!=', 'caption-fixed' ),
			),
		),

		array(
			'id'     => 'portfolio_misc',
			'type'  => 'info',
			'style' => 'info',
			'title' => esc_html__( 'Misc.', 'boo' ),
		),

		array(
			'id'      => 'portfolio-enable-ext',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Enable External links', 'boo' ),
			'desc'    => esc_html__( 'External link will be apllied to the portfolio item "Detail Button"', 'boo' ),
			'options' => array(
				'on'  => 'On',
				'off' => 'Off',
			),
			'default' => 'off',
			'required' => array(				
				array( 'portfolio-show-ext-link', 'equals', 'on' ),
			),
		),

		array(
			'id'    => 'portfolio-disable-postformat',
			'type'  => 'select',
			'title' => esc_html__( 'Disable Post Formats?', 'boo' ),
			'desc'  => esc_html__( 'If yes will show only featured images of the post, will ignore post formats', 'boo' ),
			'options' => array(
				'no'  => esc_html__( 'No', 'boo' ),
				'yes' => esc_html__( 'Yes', 'boo' )
			),
			'required' => array(
				'portfolio-items-style',
				'equals',
				array( 'list', 'shadow', 'outline', 'caption-fixed' ),
			),
		),
		
		array(
			'id'    => 'portfolio-enable-parallax',
			'type'  => 'select',
			'title' => esc_html__( 'Enable parallax?', 'boo' ),
			'desc'  => esc_html__( 'Parallax for images', 'boo' ),
			'options' => array(
				'no'    => esc_html__( 'No', 'boo' ),
				'yes' => esc_html__( 'Yes', 'boo' )
			),
			'default' => 'no',
		),
		
		array(
			'id'    => 'portfolio-enable-rise',
			'type'  => 'select',
			'title' => esc_html__( 'Enable Hover Effect?', 'boo' ),
			'desc'  => esc_html__( '"Rise on hover" effect', 'boo' ),
			'options' => array(
				'no'    => esc_html__( 'No', 'boo' ),
				'rise-on-hover' => esc_html__( 'Yes', 'boo' )
			),
			'default' => 'no',
		),
		
		array(
			'id'    => 'portfolio-enable-loader',
			'type'  => 'select',
			'title' => esc_html__( 'Enable loader?', 'boo' ),
			'desc'  => esc_html__( 'Loader while items are loading.', 'boo' ),
			'options' => array(
				'no'    => esc_html__( 'No', 'boo' ),
				'yes' => esc_html__( 'Yes', 'boo' )
			),
		),

		array(
			'id'       => 'portfolio-excerpt-length',
			'type'     => 'text',
			'title'    => esc_html__( 'Portflio excerpt length', 'boo' ),
			'validate' => 'numeric',
			'default'  => '45',
		),

		array(
			'id'    => 'info_warning',
			'type'  => 'info',
			'title' => esc_html__( 'IMPORTANT NOTE:', 'boo' ),
			'style' => 'info',
			'desc'  => esc_html__( 'The options on this tab only control the portfolio page templates and portfolio archives, not the recent work shortcode. The only options on this tab that work with the recent work shortcode is the Load More Post Button Color.', 'boo' )
		),

		array(
			'type'  => 'text',
			'id'    => 'portfolio-single-slug',
			'title' => esc_html__( 'Portfolio Slug', 'boo' ),
			'subtitle' => esc_html__( 'The slug name cannot be the same name as your portfolio page or the layout will break. This option changes the permalink when you use the permalink type as %postname%. Visit the Settings - Permalinks screen after changing this setting', 'boo' ),
		),
		
		array(
			'type'  => 'text',
			'id'    => 'portfolio-category-slug',
			'title' => esc_html__( 'Portfolio Category Slug', 'boo' ),
			'subtitle' => esc_html__( 'The slug name cannot be the same name as your portfolio page over wide the layout will break. This option changes the permalink when you use the permalink type as %postname%. Visit the Settings - Permalinks screen after changing this setting', 'boo' ),
		),
		
	)
);

$this->sections[] = array(
	'title'      => esc_html__( 'Single Post', 'boo' ),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'       => 'portfolio-likes-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Like Button', 'boo' ),
			'subtitle' => esc_html__( 'Turn on to display the like button on single portfolio posts.', 'boo' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'boo' ),
				'off'  => esc_html__( 'Off', 'boo' )
			),
			'default' => 'on'
		),

		array(
			'id'       => 'portfolio-social-box-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Social Sharing Box', 'boo' ),
			'subtitle' => esc_html__( 'Turn on to display the social sharing box on single portfolio posts.', 'boo' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'boo' ),
				'off'  => esc_html__( 'Off', 'boo' )
			),
			'default'  => 'on'
		),
		
		array(
			'id'      => 'title-bar-nav',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Enable Portfolio Navigation in Titlebar', 'boo' ),
			'options' => array(
				'on'  => esc_html__( 'On', 'boo' ),
				'off' => esc_html__( 'Off', 'boo' ),
			),
			'default'  => 'on'
		),

		array(
			'id'       => 'portfolio-navigation-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Previous/Next Pagination below the content', 'boo' ),
			'subtitle' => esc_html__( 'Turn on to display the previous/next post pagination for single portfolio posts.', 'boo' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'boo' ),
				'off'  => esc_html__( 'Off', 'boo' )
			),
			'default'  => 'on'
		),
		
		array(
			'id'       => 'portfolio-archive-link',
			'type'     => 'text',
			'title'    => esc_html__( 'Portfolio Archive URL', 'boo' ),
			'desc'     => esc_html__( 'Custom link to portfolio page on navigation, leave blank to link to the default portfolio archive', 'boo' ),
			'validate' => 'url',
			'required' => array(
				'portfolio-navigation-enable',
				'equals',
				'on',
			),
		),

		array(
			'id'       => 'portfolio-related-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Related Projects', 'boo' ),
			'subtitle' => esc_html__( 'Turn on to display related projects on single portfolio posts.', 'boo' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'boo' ),
				'off'  => esc_html__( 'Off', 'boo' )
			),
			'default' => 'on'
		),

		array(
			'type'    => 'text',
			'id'      => 'portfolio-related-title',
			'title'   => esc_html__( 'Related Project Title', 'boo' ),
			'default' => 'Related Projects',
			'required' => array(
				'portfolio-related-enable',
				'equals',
				'on'
			)
		),

		array(
			'type'     => 'slider',
			'id'       => 'portfolio-related-number',
			'title'    => esc_html__( 'Number of Related Projects', 'boo' ),
			'subtitle' => esc_html__( 'Controls the number of projects that display under related project section.', 'boo' ),
			'default'  => 6,
			'max'      => 100,
			'required' => array(
				'portfolio-related-enable',
				'equals',
				'on'
			)
		)
	)
);