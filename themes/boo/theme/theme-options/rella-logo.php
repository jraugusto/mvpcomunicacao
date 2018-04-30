<?php
/*
 * Logo Section
*/

$this->sections[] = array(
	'title' => esc_html__( 'Logo', 'boo' ),
	'icon'  => 'el-icon-plus-sign'
);

// Body
$this->sections[] = array(
	'title'      => esc_html__( 'Logo', 'boo' ),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'       => 'header-logo',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Default Logo', 'boo' ),
			'subtitle' => esc_html__( 'Upload or select an image as your logo.', 'boo' ),
		),

		array(
			'id'       => 'header-logo-retina',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Retina Default Logo', 'boo' ),
			'subtitle' => esc_html__( 'Upload or select an image for the retina version of the logo. It should be exactly 2x the size of the main logo.', 'boo' ),
		),
		
		array(
			'id'       => 'header-logo-light',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Logo Light', 'boo' ),
			'subtitle' => esc_html__( 'Upload a light logo to display on section with dark background', 'boo' ),
		),

		array(
			'id'       => 'header-logo-retina-light',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Retina Logo Light', 'boo' ),
			'subtitle' => esc_html__( 'Upload a light retina logo to display on section with dark background', 'boo' ),
		),
		
		//Sticky header logo
		array(
			'id'       => 'sticky-header-logo',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Sticky Header Default Logo', 'boo' ),
			'subtitle' => esc_html__( 'Upload or select an image as your default logo for sticky header.', 'boo' ),
		),

		array(
			'id'       => 'sticky-header-logo-retina',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Sticky Header Retina Logo', 'boo' ),
			'subtitle' => esc_html__( 'Upload or select an image for the retina version of the logo for sticky header. It should be exactly 2x the size of the main logo.', 'boo' ),
		),
		
		array(
			'id'       => 'sticky-header-logo-light',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Sticky Header Logo Light', 'boo' ),
			'subtitle' => esc_html__( 'Upload a light logo to display on sticky header with dark background', 'boo' ),
		),

		array(
			'id'       => 'sticky-header-logo-retina-light',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Sticky Header Retina Logo Light', 'boo' ),
			'subtitle' => esc_html__( 'Upload a light retina logo to display on sticky header with dark background', 'boo' ),
		),

		array(
			'id'       => 'menu-logo',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Mobile Logo', 'boo' ),
			'subtitle' => esc_html__( 'Upload the logo that will be displayed in the menu bar for small devices.', 'boo' ),
		),
		
		array(
			'id'       => 'menu-logo-retina',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Retina Mobile Logo', 'boo' ),
			'subtitle' => esc_html__( 'Upload or select an image file for the retina version of the mobile logo. It should be exactly 2x the size of the mobile logo.', 'boo' ),
		),

		array(
			'id'       => 'logo-width',
			'type'     => 'text',
			'title'    => esc_html__( 'Width for logo', 'boo' ),
			'subtitle' => '',
			'desc'     => esc_html__( 'Add width for logo image ex. 150px', 'boo' )
		),
		array(
			'id'       => 'logo-max-width',
			'type'     => 'text',
			'title'    => esc_html__( 'Max Width for logo', 'boo' ),
			'subtitle' => '',
			'desc'     => esc_html__( 'Add max-width for logo image ex. 150px', 'boo' )
		),

	)
);

// Headers
$this->sections[] = array(
	'title'       => esc_html__( 'Favicon', 'boo' ),
	'subsection'  => true,
	'fields'      => array(

		array(
			'id'       => 'favicon',
			'type'     => 'media',
			'title'    => esc_html__( 'Favicon', 'boo' ),
			'subtitle' => esc_html__( 'Favicon for your website at 16px x 16px.', 'boo' )
		),

		array(
			'id'       => 'iphone_icon',
			'type'     => 'media',
			'title'    => esc_html__( 'Apple iPhone Icon Upload', 'boo' ),
			'subtitle' => esc_html__( 'Favicon for Apple iPhone at 57px x 57px.', 'boo' )
		),

		array(
			'id'       => 'iphone_icon_retina',
			'type'     => 'media',
			'title'    => esc_html__( 'Apple iPhone Retina Icon Upload', 'boo' ),
			'subtitle' => esc_html__( 'Favicon for Apple iPhone Retina Version at 114px x 114px.', 'boo' ),
			'required' => array(
				array( 'iphone_icon', '!=', '' ),
				array( 'iphone_icon', '!=', array( 'url'  => '' ) )
			)
		),

		array(
			'id'       => 'ipad_icon',
			'type'     => 'media',
			'title'    => esc_html__( 'Apple iPad Icon Upload', 'boo' ),
			'subtitle' => esc_html__( 'Favicon for Apple iPad at 72px x 72px.', 'boo' )
		),

		array(
			'id'       => 'ipad_icon_retina',
			'type'     => 'media',
			'title'    => esc_html__( 'Apple iPad Retina Icon Upload', 'boo' ),
			'subtitle' => esc_html__( 'Favicon for Apple iPad Retina Version at 144px x 144px.', 'boo' ),
			'required' => array(
				array( 'ipad_icon', '!=', '' ),
				array( 'ipad_icon', '!=', array( 'url'  => '' ) )
			)
		)
	)
);