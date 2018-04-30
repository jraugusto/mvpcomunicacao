<?php
/*
 * Title Wrapper Section
 *
 * Available options on $section array:
 * separate_box (boolean) - separate metabox is created if true
 * box_title - title for separate metabox
 * title - section title
 * desc - section description
 * icon - section icon
 * fields - fields, @see https://docs.reduxframework.com/ for details
*/

$sections[] = array(
	'post_types' => array( 'post', 'page' ),
	'title'      => esc_html__( 'Title Wrapper', 'boo' ),
	'icon'       => 'el-icon-cog',
	'fields'     => array(

		array(
			'id'       => 'title-bar-enable',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Enable Title Wrapper', 'boo' ),
			'subtitle' => esc_html__( 'If on, this layout part will be displayed.', 'boo' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'boo' ),
				'0'    => esc_html__( 'Default', 'boo' ),
				'off'  => esc_html__( 'Off', 'boo' ),
			),
			'default'  => '0',
		),

		array(
			'id'    => 'title-bar-heading',
			'type'  => 'text',
			'title' => esc_html__( 'Custom Title', 'boo' ),
			'desc'  => esc_html__( 'If empty, will display default page/post title', 'boo' ),
		),
		
		array(
			'id'    => 'title-bar-heading-empty',
			'type'  => 'button_set',
			'title' => esc_html__( 'No heading', 'boo' ),
			'desc'  => esc_html__( 'Hide the default/custom page/post title in titlebar', 'boo' ),
			'options' => array(
				'on'   => esc_html__( 'On', 'boo' ),
				'off'  => esc_html__( 'Off', 'boo' ),				
			),
			'default'  => 'off',
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
			'id'       => 'title-bar-weight',
			'type'     => 'select',
			'title'    => esc_html__( 'Heading font Weight', 'boo' ),
			'options'  => array(
				''                => esc_html__( 'Default', 'boo' ),
				'weight-light'    => esc_html__( 'Light', 'boo' ),
				'weight-normal'   => esc_html__( 'Normal', 'boo' ),
				'weight-medium'   => esc_html__( 'Medium', 'boo' ),
				'weight-semibold' => esc_html__( 'Semibold', 'boo' ),
				'weight-bold'     => esc_html__( 'Bold', 'boo' ),
			),
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
			'id'      => 'title-bar-content',
			'type'    => 'editor',
			'title'   => esc_html__( 'Content', 'boo' ),
			'args'   => array(
				'teeny'            => false,
				'textarea_rows'    => 10
			),
			'default' => ''
		),

		array(
			'id'      => 'title-bar-content-style',
			'type'	  => 'select',
			'title'   => esc_html__( 'Content style', 'boo' ),
			'options' => array(
				''           => 'Default',
				'split'      => 'Split',
				'overlay'    => 'Overlay',
				'bottom'     => 'Bottom',
				'bottom-bar' => 'Bottom Bar'
			),
		),
		

		array(
			'id'       => 'title-bar-overlay-size',
			'type'     => 'text',	
			'title'    => esc_html__( 'Overlay title size', 'boo' ),
			'subtitle' => esc_html__( 'Input font size for the overlay title in px, for ex 125px', 'boo' ),
			'required' => array(
				'title-bar-content-style',
				'equals',
				'overlay'
			),			
		),


		array(
			'id'       => 'title-bar-position',
			'type'     => 'select',
			'title'    => esc_html__( 'Title Bar Content Vertical align', 'boo' ),
			'options'  => array(
				''                => esc_html__( 'Default', 'boo' ),
				'titlebar--content-top'     => esc_html__( 'Top', 'boo' ),
				'titlebar--content-bottom'     => esc_html__( 'Bottom', 'boo' ),
			),
			'required' => array(
				array( 'title-bar-content-style', '!=', 'overlay' ),
				array( 'title-bar-content-style', '!=', 'bottom-bar' ),
			),
		),

		array(
			'id'      => 'title-bar-breadcrumb',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Enable Breadcrumbs', 'boo' ),
			'options' => array(
				'on'  => esc_html__( 'On', 'boo' ),
				'0'   => esc_html__( 'Default', 'boo' ),
				'off' => esc_html__( 'Off', 'boo' ),
			)
		),

		array(
			'id'     => 'title-bar-breadcrumb-style',
			'type'	 => 'select',
			'title'  => esc_html__( 'Breadcrumb style', 'boo' ),
			'options' => array(
				''              => 'Default',
				'parallelogram' => 'Parallelogram',
			),
			'required' => array(
				'title-bar-breadcrumb',
				'!=',
				'off'
			),
			'default' => 'off'
		),

		array(
			'id'       => 'title-bar-size',
			'type'     => 'select',
			'title'    => esc_html__( 'Title size', 'boo' ),
			'options'  => array(
				''      => 'Default',
				'xxxsm' => 'xxxSmall (28px)',
				'xxsm'  => 'xxSmall (40px)',
				'xsm'   => 'xSmall (48px)',
				'sm'    => 'Small (50px)',
				'md'    => 'Medium (60px)',
				'lg'    => 'Large (75px)',
				'xlg'   => 'xLarge (90px)'
			),
			'default'   => 'xlg'
		),

		array(
			'id'       => 'title-bar-height',
			'type'     => 'select',
			'title'    => esc_html__( 'Title bar height', 'boo' ),
			'options'  => array(
				''     => 'Default',
				'np'    => 'No Paddings',
				'full'  => 'Full Height',
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
			'options'  => array(
				'text-dark'  => 'Dark',
				'text-white' => 'Light'
			),
			'default'  => 'xlg'
		),

		array(
			'id'       => 'title-bar-align',
			'type'     => 'select',
			'title'    => esc_html__( 'Alignment', 'boo' ),
			'options'  => array(
				'text-left'   => 'Left',
				'text-center' => 'Center',
				'text-right'  => 'Right'
			),
			'default'  => 'xlg'
		),

		array(
			'id'       => 'title-background-type',
			'type'     => 'select',
			'title'    => esc_html__( 'Background Type', 'boo' ),
			'options'  => array(
				'solid'    => 'Solid',
				'gradient' => 'Gradient',
				'image'    => 'Image'
			)
		),

		array(
			'id'       => 'title-bar-bg',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Background', 'boo' ),
			'required' => array(
				'title-background-type',
				'equals',
				'image'
			),
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
				'0'    => esc_html__( 'Default', 'boo' ),
				'off'  => esc_html__( 'Off', 'boo' ),
			),
			'default' => '',
		),

		array(
			'id'       => 'title-bar-solid',
			'type'     => 'color',
			'url'      => true,
			'title'    => esc_html__( 'Background', 'boo' ),
			'required' => array(
				'title-background-type',
				'equals',
				'solid'
			),
		),

		array(
			'id'       => 'title-bar-gradient',
			'type'     => 'gradient',
			'url'      => true,
			'title'    => esc_html__( 'Background', 'boo' ),
			'required' => array(
				'title-background-type',
				'equals',
				'gradient'
			),
		),
		
		array(
			'id'      => 'title-bar-overlay',
			'type'	  => 'button_set',
			'title'   => esc_html__( 'Enable Overlay', 'boo' ),
			'options' => array(
				'on'   => esc_html__( 'On', 'boo' ),
				'0'    => esc_html__( 'Default', 'boo'  ),
				'off'  => esc_html__( 'Off', 'boo' ),
			),
			'default' => '0',
		),
		
		array(
			'id'       => 'title-bar-overlay-background-type',
			'type'     => 'select',
			'title'    => esc_html__( 'Overlay Type', 'boo' ),
			'options' => array(
				'color'    => 'Color',
				'gradient' => 'Gradient',
			),
			'required' => array(
				'title-bar-overlay',
				'!=',
				'off'
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
			'id'    =>'title-bar-classes',
			'type'  => 'text',
			'title' => esc_html__( 'Extra classes', 'boo' )
		),

		array(
			'id'      => 'title-bar-scroll',
			'type'	  => 'button_set',
			'title'   => esc_html__( 'Enable Scroll Button', 'boo' ),
			'options' => array(
				'on'   => esc_html__( 'On', 'boo' ),
				'0'    => esc_html__( 'Default', 'boo' ),
				'off'  => esc_html__( 'Off', 'boo' ),
			),
			'default' => '0',
		),
		
		array(
			'id'       => 'title-bar-scroll-color',
			'type'     => 'color',
			'title'    => esc_html__( 'Scroll Button Color', 'boo' ),
			'subtitle' => esc_html__( 'Pick a color for scroll button', 'boo' ),
			'required' => array(
				'title-bar-scroll',
				'!=',
				'off'
			),
		),

		array(
			'id'       => 'title-bar-scroll-id',
			'type'     => 'text',
			'title'    => esc_html__( 'Anchor ID', 'boo' ),
			'subtitle' => esc_html__( 'Input anchor ID of the section for scroll button', 'boo' ),
			'required' => array(
				'title-bar-scroll',
				'!=',
				'off'
			),
		),

	), // #fields
);