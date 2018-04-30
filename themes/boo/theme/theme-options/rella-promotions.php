<?php
/*
 * Prono Boxes
 */

$this->sections[] = array(
	'title'  => esc_html__( 'Promo Boxes', 'boo' ),
	'icon'   => 'el-icon-th'
);

$this->sections[] = array(
	'post_types' => array( 'post', 'page', 'rella-portfolio' ),
	'subsection' => true,
	'title'      => esc_html__('Promotions', 'boo'),
	'icon'       => 'el-icon-adjust-alt',
	'fields'     => array(
		
		array(
			'id'    => 'enable-promo',
			'type'  => 'button_set',
			'title' => esc_html__( 'Enable Promo boxes', 'boo' ),
			'desc'  => esc_html__( 'Enable to show promo boxes', 'boo' ),
			'options' => array(
				'on'   => esc_html__( 'On', 'boo' ),
				'off'  => esc_html__( 'Off', 'boo' ),
			),
			'default'  => 'off',
		),
		
		array(
			'id'       => 'promo-positions',
			'type'     => 'select',
			'title'    => esc_html__( 'Promo boxes positions', 'boo' ),
			'options'  => array(
				'top'    => 'Top',
				'inpost' => 'In Content',
				'both'   => 'Both'
			),
			'required' => array(
				'enable-promo',
				'equals',
				'on'
			),
		),
		
		array(
			'id'       => 'promo-top-template',
			'type'     => 'select',
			'title'    => esc_html__( 'Top Promo box content', 'boo' ),
			'subtitle' => esc_html__( 'Select which promobox content post to display', 'boo' ),
			'data'     => 'post',
			'args'     => array( 
				'post_type'      => 'rella-promotions', 
				'posts_per_page' => -1 
			),
			'required'  => array(
				'promo-positions', 
				'!=', 
				'inpost'
			),
		),
		
		array(
			'id'       => 'promo-incontent-template',
			'type'     => 'select',
			'title'    => esc_html__( 'In post Promo box content', 'boo' ),
			'subtitle' => esc_html__( 'Select which promobox content post to display (works for single post only, and display after the Author Bio section)', 'boo' ),
			'data'     => 'post',
			'args'     => array( 
				'post_type'      => 'rella-promotions', 
				'posts_per_page' => -1 
			),
			'required'  => array(
				'promo-positions', 
				'!=', 
				'top'
			),
		),

	)
);
