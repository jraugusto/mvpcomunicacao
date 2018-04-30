<?php
/*
 * Layout Section
*/

$this->sections[] = array(

	'title'  => esc_html__( 'Layout Settings', 'boo' ),
	'icon'   => 'el-icon-website',
	'fields' => array(

		array(
			'id'        => 'page-layout-width',
			'type'      => 'button_set',
			'title'     => esc_html__( 'Layout width', 'boo' ),
			'subtitle'  => esc_html__( 'Controls the site layout width', 'boo' ),
			'options'   => array(
				'boxed'    => esc_html__( 'Boxed', 'boo' ),
				'standart' => esc_html__( 'Default - 1170px', 'boo' ),
				'wide'     => esc_html__( 'Wide - 1270px', 'boo' ),
			),
			'default'   => 'standart'
		),
		
		//Body Background
		array(
			'id'       => 'body-background-type',
			'type'     => 'select',
			'title'    => esc_html__( 'Body Background Type', 'boo' ),
			'options'  => array(
				'solid'    => 'Solid',
				'gradient' => 'Gradient'
			),
			'required' => array(
				'page-layout-width',
				'equals',
				'boxed'
			),
		),

		array(
			'id'       => 'body-bg',
			'type'     => 'background',
			//'preview'  => false,
			'title'  => esc_html__( 'Body Background', 'boo' ),
			'required' => array(
				'body-background-type',
				'equals',
				'solid'
			),
		),

		array(
			'id'       => 'body-bar-gradient',
			'type'     => 'gradient',
			'url'      => true,
			'title'    => esc_html__('Body Background Gradient', 'boo'),
			'required' => array(
				'body-background-type',
				'equals',
				'gradient'
			),
		),
		
		//Content Background
		array(
			'id'       => 'page-background-type',
			'type'     => 'select',
			'title'    => esc_html__( 'Content Background Type', 'boo' ),
			'options'  => array(
				'solid'    => 'Solid',
				'gradient' => 'Gradient'
			),
		),

		array(
			'id'       => 'page-bg',
			'type'     => 'background',
			'preview'  => false,
			'title'  => esc_html__( 'Content Background', 'boo' ),
			'required' => array(
				'page-background-type',
				'equals',
				'solid'
			),
		),

		array(
			'id'=>'page-bar-gradient',
			'type' => 'gradient',
			'url' => true,
			'title' => esc_html__('Content Background Gradient', 'boo'),
			'required' => array(
				'page-background-type',
				'equals',
				'gradient'
			),
		),

		array(
			'id'    => 'content-padding',
			'type'	=> 'spacing',
			'title' => esc_html__('Content Padding', 'boo'),
			'left'  => false, 'right' => false,
			'units' => array(
				'px',
				'%',
				'em',
				'rem'
			)
		)

	)
);
