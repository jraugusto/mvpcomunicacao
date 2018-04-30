<?php
/*
 * Page 404
*/

$this->sections[] = array (
	'title'  => esc_html__( 'Search Page', 'boo' ),
	'subsection' => true,
	'fields' => array(

		array(
 			'id'       => 'search-header-template',
 			'type'     => 'select',
 			'title'    => esc_html__( 'Header Template', 'boo' ),
 			'subtitle' => esc_html__( 'Select a header template for search result page, will override the default one.', 'boo'),
 			'data'     => 'post',
			'args'     => array( 
				'post_type'      => 'rella-header', 
				'posts_per_page' => -1 
			)
 		),

		array(
			'id'       => 'search-title-bar-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Search Page Title Bar', 'boo' ),
			'subtitle' => esc_html__( 'Turn on to show the search page title bar.', 'boo' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'boo' ),
				'off'  => esc_html__( 'Off', 'boo' )
			),
			'default'  => 'on'
		),

		array(
			'id'       => 'search-title-bar-subheading',
			'type'	   => 'text',
			'title'    => esc_html__( 'Search Page Subtitle', 'boo' ),
			'subtitle' => esc_html__( 'Controls the subtitle text that displays in the search result page title bar.', 'boo' )
		),
		
/*
		array(
			'id'       => 'search-excerpt-length',
			'type'     => 'text',
			'title'    => esc_html__( 'Search result page posts excerpt length', 'boo' ),
			'validate' => 'numeric',
			'default'  => '45',
		),
*/

	)
);