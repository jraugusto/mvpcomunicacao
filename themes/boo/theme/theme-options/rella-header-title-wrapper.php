<?php
/*
 * Title Wrapper Section
*/

// Title Bar
$this->sections[] = array(
	'title'      => esc_html__( 'Title Wrapper', 'boo' ),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'       => 'title-bar-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Enable Title Wrapper', 'boo' ),
			'subtitle' => esc_html__( 'If on, this layout part will be displayed.', 'boo' ),
			'options'  => array(
				'on'  => esc_html__( 'On', 'boo' ),
				'off' => esc_html__( 'Off', 'boo' )
			),
			'default'     => 'on'
		),

		array(
			'id'    => 'title-bar-heading',
			'type'  => 'text',
			'title' => esc_html__( 'Heading', 'boo' )
		),

		'title-bar-typography' => array(
			'id'          => 'title-bar-typography',
			'title'       => esc_html__( 'Title Bar Heading Typography', 'boo' ),
			'subtitle' => esc_html__( 'These settings control the typography for the titlebar heading', 'boo' ),
			'type'        => 'typography',
			'text-transform' => true,
			'letter-spacing' => true,
			'text-align'     => true,
			'compiler'       => true,
			'units'          => '%',
		),

		array(
			'id'    => 'title-bar-subheading',
			'type'  => 'text',
			'title' => esc_html__( 'Sub-Heading', 'boo' )
		),

		'title-bar-subheading-typography' => array(
			'id'          => 'title-bar-subheading-typography',
			'title'       => esc_html__( 'Title Bar Subheading Typography', 'boo' ),
			'subtitle' => esc_html__( 'These settings control the typography for the titlebar subheading', 'boo' ),
			'type'        => 'typography',
			'text-transform' => true,
			'letter-spacing' => true,
			'text-align'     => true,
			'compiler'       => true,
			'units'          => '%',
		),

		array(
			'id'    => 'title-bar-content',
			'type'  => 'editor',
			'title' => esc_html__( 'Content', 'boo' )
		),
		
		array(
			'id'       => 'title-bar-content-style',
			'type'     => 'select',
			'title'    => esc_html__( 'Content style', 'boo' ),
			'options'  => array(
				''           => esc_html__( 'None', 'boo' ),
				'split'      => esc_html__( 'Split', 'boo' ),
				'overlay'    => esc_html__( 'Overlay', 'boo' ),
				'bottom'     => esc_html__( 'Bottom', 'boo' ),
				'bottom-bar' => esc_html__( 'Bottom Bar', 'boo' )
			),
		),

		array(
			'id'      => 'title-bar-breadcrumb',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Enable Breadcrumbs', 'boo' ),
			'options' => array(
				'on' => 'On',
				'off' => 'Off'
			)
		),

		array(
			'id'    => 'title-bar-breadcrumb-style',
			'type'  => 'select',
			'title' => esc_html__( 'Breadcrumb style', 'boo' ),
			'options' => array(
				'' => esc_html__( 'Default', 'boo' ),
				'parallelogram' => esc_html__( 'Parallelogram', 'boo' ),
			),
			'required' => array(
				'title-bar-breadcrumb',
				'!=',
				'off'
			),
			'default' => 'off'
		),

		array(
			'id'      => 'title-bar-size',
			'type'    => 'select',
			'title'   => esc_html__( 'Title size', 'boo' ),
			'options' => array(
				''      => 'Default',
				'xxxsm' => 'xxxSmall',
				'xxsm'  => 'xxSmall',
				'xsm'   => 'xSmall',
				'sm'    => 'Small',
				'md'    => 'Medium',
				'lg'    => 'Large',
				'xlg'   => 'xLarge'
			),
			'default' => 'xlg'
		),

		array(
			'id'       => 'title-bar-height',
			'type'     => 'select',
			'title'    => esc_html__( 'Title bar height', 'boo' ),
			'options' => array(
				''      => 'Default',
				'np'    => 'No Paddings',
				'full'  => 'Fullheight',
				'xxxsm' => 'xxxSmall',
				'xxsm'  => 'xxSmall',
				'xsm'   => 'xSmall',
				'sm'    => 'Small',
				'md'    => 'Medium',
				'md2'   => 'Medium2',
				'lg'    => 'Large',
				'lg2'   => 'Large2',
				'xlg'   => 'xLarge',
				'xxlg'  => 'xxLarge',
				'xxxlg' => 'xxxLarge'
			)
		),

		array(
			'id'       => 'title-bar-scheme',
			'type'     => 'select',
			'title'    => esc_html__( 'Color scheme', 'boo' ),
			'options' => array(
				'text-dark' => 'Dark',
				'text-white' => 'Light'
			),
			'default' => 'xlg'
		),

		array(
			'id'       => 'title-bar-align',
			'type'     => 'select',
			'title'    => esc_html__( 'Alignment', 'boo' ),
			'options' => array(
				'text-left' => 'Left',
				'text-center' => 'Center',
				'text-right' => 'Right'
			),
			'default' => 'xlg'
		),

		array(
			'id'       => 'title-background-type',
			'type'     => 'select',
			'title'    => esc_html__( 'Background Type', 'boo' ),
			'options' => array(
				'solid' => 'Solid',
				'gradient' => 'Gradient',
				'image' => 'Image'
			),
			'default' => 'image'
		),

		array(
			'id'=>'title-bar-bg',
			'type' => 'media',
			'url' => true,
			'title' => esc_html__('Background', 'boo'),
			'required' => array(
				'title-background-type',
				'equals',
				'image'
			)
		),
		
		array(
			'id'       => 'title-bar-parallax',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Enable Parallax?', 'boo' ),
			'required' => array(
				'title-background-type',
				'equals',
				'image'
			),
			'options' => array(
				'on'   => esc_html__( 'On', 'boo' ),
				'off'  => esc_html__( 'Off', 'boo' ),
			),
			'default' => 'off',
		),
		
		array(
			'id'       => 'title-bar-bg-attachment',
			'type'     => 'select',
			'title'    => esc_html__( 'Background Attachment', 'boo' ),
			'options'  => array(
				'scroll'  => esc_html__( 'Default', 'boo' ),
				'fixed'   => esc_html__( 'Fixed', 'boo' ),
				'inherit' => esc_html__( 'Inherit', 'boo' ),
			),
			'required' => array(
				'title-background-type',
				'equals',
				'image'
			),
		),

		array(
			'id'=>'title-bar-solid',
			'type' => 'color',
			'title' => esc_html__('Background', 'boo'),
			'required' => array(
				'title-background-type',
				'equals',
				'solid'
			)
		),

		array(
			'id'=>'title-bar-gradient',
			'type' => 'gradient',
			'title' => esc_html__('Background', 'boo'),
			'required' => array(
				'title-background-type',
				'equals',
				'gradient'
			)
		),
		
		array(
			'id'      => 'title-bar-overlay',
			'type'	  => 'button_set',
			'title'   => esc_html__( 'Enable Overlay', 'boo' ),
			'options' => array(
				'on'   => esc_html__( 'On', 'boo' ),
				'off'  => esc_html__( 'Off', 'boo' ),
			),

		),
		
		array(
			'id'       => 'title-bar-overlay-background-type',
			'type'     => 'select',
			'title'    => esc_html__( 'Overlay Type', 'boo' ),
			'options' => array(
				'color' => 'Color',
				'gradient' => 'Gradient',
			),
			'required' => array(
				'title-bar-overlay',
				'equals',
				'on'
			),
		),

		array(
			'id'    => 'title-bar-overlay-solid',
			'type'  => 'color_rgba',
			'title' => esc_html__( 'Overlay Color', 'boo' ),
			'required' => array(
				'title-bar-overlay-background-type',
				'equals',
				'color'
			)
		),

		array(
			'id'       => 'title-bar-overlay-gradient',
			'type'     => 'gradient',
			'title'    => esc_html__( 'Overlay Gradient', 'boo' ),
			'required' => array(
				'title-bar-overlay-background-type',
				'equals',
				'gradient'
			)
		),

		array(
			'id'=>'title-bar-classes',
			'type' => 'text',
			'title' => esc_html__('Extra classes', 'boo')
		)
	)
);