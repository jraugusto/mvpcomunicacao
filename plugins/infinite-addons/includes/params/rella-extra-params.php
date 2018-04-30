<?php

// VC Section
function rella_section_extras() {

	$params = array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Section Type', 'infinite-addons' ),
			'description' => esc_html__( 'Select columns position within row.', 'infinite-addons' ),
			'param_name'  => 'section_type',
			'value'       => array(
				esc_html__( 'Default', 'infinite-addons' )          => 'default',
				esc_html__( 'Scrollable', 'infinite-addons' )       => 'scrollable',
				esc_html__( 'Header Main', 'infinite-addons' )      => 'main-bar-container',
				esc_html__( 'Header Secondary', 'infinite-addons' ) => 'secondary-bar',
			),
			'weight'      => 1
		),
		
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Navigation', 'infinite-addons' ),
			'description' => esc_html__( 'select a position for main navigation', 'infinite-addons' ),
			'param_name'  => 'vertical_nav',
			'value'       => array(
				esc_html__( 'Default', 'infinite-addons' )    => '',
				esc_html__( 'Vertical', 'infinite-addons' ) => 'yes',
			),
			'weight'      => 1
		),

		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Section stretch', 'infinite-addons' ),
			'description' => esc_html__( 'Select stretching options for section and content (Note: stretched may not work properly if parent container has "overflow: hidden" CSS property).', 'infinite-addons' ),
			'param_name'  => 'main_full_width',
			'value'       => array(
				esc_html__( 'Default', 'infinite-addons' ) => '',
				esc_html__( 'Stretch section', 'infinite-addons' ) => 'stretch_row',
			),
			'dependency' => array(
				'element' => 'section_type',
				'value'   => array( 'main-bar-container', 'secondary-bar' )
			),
			'weight'     => 1,
		),

		array(
			'type'       => 'rella_checkbox',
			'param_name' => 'mainbar_container_style',
			'heading'    => esc_html__('Mainbar Container Style', 'infinite-addons'),
			'value'      => array(
				esc_html__( 'No Side Spacing', 'infinite-addons' )      => 'no-side-spacing',
				esc_html__( 'Centered with Logo' )                      => 'header-fullwidth-justified header-logo-centered',
				esc_html__( 'Pull Up', 'infinite-addons' )              => 'pulled-up',
				esc_html__( 'Shadow', 'infinite-addons' )               => 'shadowed',
				esc_html__( 'Permanent Sticky', 'infinite-addons' )     => 'always_sticky',
				esc_html__( 'Visible sticky on scroll-up', 'infinite-addons' ) => 'sticky',
				esc_html__( 'Default Sticky', 'infinite-addons' )       => 'sticky2',
				esc_html__( 'Shrink sticky menu', 'infinite-addons' )   => 'shrink_sticky',
				esc_html__( 'Sticky on mobile', 'infinite-addons' )     => 'mobile_sticky',
				esc_html__( 'Floated', 'infinite-addons' )              => 'floated',
				esc_html__( 'Fullwidth Justified', 'infinite-addons' )  => 'header-fullwidth-justified',
				esc_html__( 'Fullscreen', 'infinite-addons' )           => 'modules-fullscreen',
				esc_html__( 'Fullscreen 2', 'infinite-addons' )         => 'modules-fullscreen-alt',
				esc_html__( 'Fullscreen 3', 'infinite-addons' )         => 'modules-fullscreen-alt-2',
				esc_html__( 'Fullscreen 4', 'infinite-addons' )         => 'modules-fullscreen-alt-3',
			),
			'dependency' => array(
				'element' => 'section_type',
				'value'   => array( 'main-bar-container' )
			),
			'weight' => 1
		),

		array(
			'type'       => 'rella_checkbox',
			'param_name' => 'secondary_bar_style',
			'heading'    => esc_html__( 'Secondary Container Style', 'infinite-addons' ),
			'value'      => array(
				esc_html__( 'Permanent Sticky', 'infinite-addons' )    => 'always_sticky',
				esc_html__( 'Visible sticky on scroll-up', 'infinite-addons' ) => 'sticky',
				esc_html__( 'Defaul Sticky', 'infinite-addons' ) => 'sticky2',
			),
			'std' => " ",
			'dependency' => array(
				'element' => 'section_type',
				'value'   => array( 'secondary-bar' )
			),
			'weight' => 1
		),

		array(
			'type'       => 'dropdown',
			'param_name' => 'sticky_start',
			'heading'    => esc_html__( 'Sticky Start', 'infinite-addons' ),
			'description' => esc_html__( 'Will work only with permanent sticky effect or defaul sticky enabled', 'infinite-addons' ),
			'value'      => array(
				esc_html__( 'Default', 'infinite-addons' ) => '',
				esc_html__( 'Begining of the bar', 'infinite-addons' ) => 'bar_begining',
			),
			'edit_field_class' => 'vc_col-sm-6',
			'weight' => 1
		),
		
		array(
			'type'             => 'textfield',
			'param_name'       => 'sticky_tolerance',
			'heading'          => esc_html__( 'Sticky scroll tolerance', 'infinite-addons' ),
			'edit_field_class' => 'vc_col-sm-6',
			'weight' => 1
		),


		array(
			'type'       => 'rella_checkbox',
			'param_name' => 'mainbar_style',
			'heading'    => esc_html__( 'Mainbar Style', 'infinite-addons' ),
			'value' => array(
				esc_html__( 'Round', 'infinite-addons' )         => 'round',
				esc_html__( 'Solid', 'infinite-addons' )         => 'solid',
				esc_html__( 'Shadow', 'infinite-addons' )        => 'shadowed',
				esc_html__( 'Nav Left', 'infinite-addons' )  => 'nav-left',
				esc_html__( 'Nav Right', 'infinite-addons' ) => 'nav-right'
			),
			'dependency' => array(
				'element' => 'section_type',
				'value' => array( 'main-bar-container' )
			),
			'weight' => 1,
		),

		array(
			'type'       => 'dropdown',
			'param_name' => 'mainbar_color_type',
			'heading'    => esc_html__( 'Mainbar Fill', 'infinite-addons' ),
			'value' => array(
				esc_html__( 'Solid', 'infinite-addons' )    => 'solid',
				esc_html__( 'Gradient', 'infinite-addons' ) => 'gradient'
			),
			'dependency'  => array(
				'element' => 'section_type',
				'value' => array( 'main-bar-container' )
			),
			'weight' => 1, 'edit_field_class' => 'vc_col-sm-6'
		),

		array(
			'type'        => 'colorpicker',
			'param_name'  => 'mainbar_color',
			'heading'     => esc_html__( 'Main Bar Color', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'mainbar_color_type',
				'value' => array( 'solid' )
			),
			'weight' => 1, 'edit_field_class' => 'vc_col-sm-6'
		),

		array(
			'type'        => 'colorpicker',
			'param_name'  => 'stickybar_color',
			'heading' => esc_html__( 'Sticky Bar Color', 'infinite-addons' ),
			'dependency' => array(
				'element' => 'section_type',
				'value'   => array( 'main-bar-container', 'secondary-bar' )
			),
			'weight' => 1,
			'edit_field_class' => 'vc_col-sm-6'
		),

		array(
			'type'        => 'gradient',
			'param_name'  => 'mainbar_gradient',
			'heading' => esc_html__( 'Main Bar Color', 'infinite-addons' ),
			'dependency' => array(
				'element' => 'mainbar_color_type',
				'value' => array( 'gradient' )
			),
			'weight' => 1, 'edit_field_class' => 'vc_col-sm-6'
		)
	);

	vc_add_params( 'vc_section', $params );

	vc_update_shortcode_param( 'vc_section', array(
		'param_name' => 'full_width',
		'dependency' => array(
			'element' => 'section_type',
			'value' => array( 'default', 'scrollable' )
		)
	));

	vc_update_shortcode_param( 'vc_section', array(
		'param_name' => 'full_height',
		'dependency' => array(
			'element' => 'section_type',
			'value' => array( 'default', 'scrollable' )
		)
	));

	vc_update_shortcode_param( 'vc_section', array(
		'param_name' => 'content_placement',
		'dependency' => array(
			'element' => 'section_type',
			'value' => array( 'default', 'scrollable' )
		)
	));

	vc_update_shortcode_param( 'vc_section', array(
		'param_name' => 'video_bg',
		'dependency' => array(
			'element' => 'section_type',
			'value' => array( 'default', 'scrollable' )
		)
	));

	vc_update_shortcode_param( 'vc_section', array(
		'param_name' => 'parallax',
		'dependency' => array(
			'element' => 'section_type',
			'value' => array( 'default', 'scrollable' )
		)
	));
}
rella_section_extras();

// New Params for Row
function rella_row_extras() {

	vc_remove_param( 'vc_row', 'css' );

	$params = array(

		array(
			'type'       => 'checkbox',
			'param_name' => 'enable_responsive_options',
			'heading'    => esc_html__( 'Enable Responsive Css Box', 'infinite-addons' ),
			'description' => esc_html__( 'Will enable small dekstop, tablet and mobile css options', 'infinite-addons' ),
			'group' => esc_html__( 'Design Options', 'infinite-addons' ),
			'value'      => array( esc_html__( 'Yes', 'infinite-addons' ) => 'yes' ),
		),

		array(
			'type'        => 'css_editor',
			'heading'     => esc_html__( 'CSS box', 'infinite-addons' ),
			'param_name'  => 'css',
			'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
		),

		array(
			'type' => 'dropdown',
			'param_name' => 'bg_position',
			'heading' => esc_html__( 'Background Position', 'infinite-addons' ),
			'value' => array(
				esc_html__( 'Default', 'infinite-addons' )         => '',
				esc_html__( 'Center Bottom', 'infinite-addons' )   => 'center bottom',
				esc_html__( 'Center Center', 'infinite-addons' )   => 'center center',
				esc_html__( 'Center Top', 'infinite-addons' )      => 'center top',
				esc_html__( 'Left Bottom', 'infinite-addons' )     => 'left bottom',
				esc_html__( 'Left Center', 'infinite-addons' )     => 'left center',
				esc_html__( 'Left Top', 'infinite-addons' )        => 'left top',
				esc_html__( 'Right Bottom', 'infinite-addons' )    => 'right bottom',
				esc_html__( 'Right Center', 'infinite-addons' )    => 'right center',
				esc_html__( 'Right Top', 'infinite-addons' )       => 'right top',
				esc_html__( 'Custom Position', 'infinite-addons' ) => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Design Options', 'infinite-addons' ),
		),

		array(
			'type'             => 'textfield',
			'param_name'       => 'bg_pos_h',
			'heading'          => esc_html__( 'Horizontal Position', 'infinite-addons' ),
			'description'      => esc_html__( 'Enter custom horizontal position in px or %', 'infinite-addons' ),
			'group'            => esc_html__( 'Design Options', 'infinite-addons' ),
			'edit_field_class' => 'vc_col-sm-6',
			'dependency'  => array(
				'element' => 'bg_position',
				'value'   => 'custom'
			)
		),

		array(
			'type'             => 'textfield',
			'param_name'       => 'bg_pos_v',
			'heading'          => esc_html__( 'Vertical Position', 'infinite-addons' ),
			'description'      => esc_html__( 'Enter custom vertical position in px or %', 'infinite-addons' ),
			'group'            => esc_html__( 'Design Options', 'infinite-addons' ),
			'edit_field_class' => 'vc_col-sm-6',
			'dependency'  => array(
				'element' => 'bg_position',
				'value'   => 'custom'
			)
		),

		array(
			'type'       => 'dropdown',
			'param_name' => 'bg_attachment',
			'heading'    => esc_html__( 'Background Attachment', 'infinite-addons' ),
			'value'      => array(
				esc_html__( 'Default', 'infinite-addons' ) => 'scroll',
				esc_html__( 'Fixed', 'infinite-addons' )   => 'fixed',
				esc_html__( 'Inherit', 'infinite-addons' ) => 'inherit',
			),
			'group' => esc_html__( 'Design Options', 'infinite-addons' ),
			'edit_field_class' => 'vc_col-sm-6',
		),

		array(
			'type'       => 'textfield',
			'param_name' => 'zindex',
			'heading'    => esc_html__( 'Z-index', 'infinite-addons' ),
			'description' => esc_html__( 'Add z-index for this row', 'infinite-addons' ),
		),
		
		array(
			'type'        => 'textfield',
			'param_name'  => 'self_hosted_video_bg',
			'heading'     => esc_html__( 'Self Hosted Video Background', 'infinite-addons' ),
			'description' => esc_html__( 'Add full path to mp4 video to show it as background of the row', 'infinite-addons' ),
		),
		
		//Box Shadow Options
		array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Enable box-shadow?', 'infinite-addons' ),
			'param_name'  => 'enable_row_shadowbox',
			'description' => esc_html__( 'If checked, the box-shadow options will be visible', 'infinite-addons' ),
			'value'       => array( esc_html__( 'Yes', 'infinite-addons' ) => 'yes' ),
			'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Design Options', 'infinite-addons' ),
		),
		
		array(
			'type' => 'param_group',
			'heading' => esc_html__( 'Shadow Box Options', 'infinite-addons' ),
			'param_name' => 'row_box_shadow',
			'group' => esc_html__( 'Design Options', 'infinite-addons' ),
			'dependency' => array(
				'element' => 'enable_row_shadowbox',
				'not_empty' => true,
			),
			'params' => array(				
				array(
					'type'        => 'dropdown',
					'param_name'  => 'inset',
					'heading'     => esc_html__( 'Inset', 'infinite-addons' ),
					'description' => esc_html__(  'Select if it is inset', 'infinite-addons' ),
					'value'      => array(
						esc_html__( 'No', 'infinite-addons' )  => '',
						esc_html__( 'Yes', 'infinite-addons' ) => 'inset',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
				),
				array(
					'type'        => 'textfield',
					'param_name'  => 'x_offset',
					'heading'     => esc_html__( 'Position X', 'infinite-addons' ),
					'description' => esc_html__(  'Set position X in px', 'infinite-addons' ),
					'edit_field_class' => 'vc_col-sm-6'
				),
				array(
					'type'        => 'textfield',
					'param_name'  => 'y_offset',
					'heading'     => esc_html__( 'Position Y', 'infinite-addons' ),
					'description' => esc_html__(  'Set position Y in px', 'infinite-addons' ),
					'edit_field_class' => 'vc_col-sm-6'
				),
				array(
					'type'        => 'textfield',
					'param_name'  => 'blur_radius',
					'heading'     => esc_html__( 'Blur Radius', 'infinite-addons' ),
					'description' => esc_html__(  'Add blur radius in px', 'infinite-addons' ),
					'edit_field_class' => 'vc_col-sm-6'
				),
				array(
					'type'        => 'textfield',
					'param_name'  => 'spread_radius',
					'heading'     => esc_html__( 'Spread Radius', 'infinite-addons' ),
					'description' => esc_html__(  'Add spread radius in px', 'infinite-addons' ),
					'edit_field_class' => 'vc_col-sm-6'
				),
				array(
					'type'        => 'colorpicker',
					'param_name'  => 'shadow_color',
					'heading'     => esc_html__( 'Color', 'infinite-addons' ),
					'description' => esc_html__(  'Pick a color for shadow', 'infinite-addons' ),
					'edit_field_class' => 'vc_col-sm-6'
				),
				
			)
		),

		array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Enable svg dividers?', 'infinite-addons' ),
			'param_name'  => 'enable_row_dividers',
			'description' => esc_html__( 'If checked, the svg dividers will be visible', 'infinite-addons' ),
			'value'       => array( esc_html__( 'Yes', 'infinite-addons' ) => 'yes' ),
			'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Design Options', 'infinite-addons' ),
		),

		array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Row overflow visible?', 'infinite-addons' ),
			'param_name'  => 'row_overflow',
			'description' => esc_html__( 'If checked, the row overflow will be visible', 'infinite-addons' ),
			'value'       => array( esc_html__( 'Yes', 'infinite-addons' ) => 'yes' ),
			'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Design Options', 'infinite-addons' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Use gradient background?', 'infinite-addons' ),
			'param_name' => 'gradient_bg',
			'description' => esc_html__( 'If checked, gradient color will be used as row background.', 'infinite-addons' ),
			'value' => array( esc_html__( 'Yes', 'infinite-addons' ) => 'yes' ),
			'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Design Options', 'infinite-addons' ),
		),
		array(
			'type' => 'gradient',
			'heading' => esc_html__( 'Gradient Picker', 'infinite-addons' ),
			'param_name' => 'gradient_bg_color',
			'description' => esc_html__( 'Set gradient color', 'infinite-addons' ),
			'dependency' => array(
				'element' => 'gradient_bg',
				'not_empty' => true,
			),
			'group' => esc_html__( 'Design Options', 'infinite-addons' ),
		),
		
		//Overlay
		array(
			'type'        => 'checkbox',
			'param_name'  => 'overlay_bg',
			'heading'     => esc_html__( 'Enable Overlay', 'infinite-addons' ),
			'description' => esc_html__( 'If checked, overlay will be enabled', 'infinite-addons' ),
			'value'       => array( esc_html__( 'Yes', 'infinite-addons' ) => 'yes' ),
			'edit_field_class' => 'vc_col-sm-6',
			'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
		),
		
		array(
			'type'        => 'dropdown',
			'param_name'  => 'overlay_type',
			'heading'     => esc_html__( 'Overlay type', 'infinite-addons' ),
			'description' => esc_html__( 'Select a type of the overlay', 'infinite-addons' ),
			'value'      => array(
				esc_html__( 'Default', 'infinite-addons' )  => 'color',
				esc_html__( 'Gradient', 'infinite-addons' ) => 'gradient',
			),
			'dependency'  => array(
				'element' => 'overlay_bg',
				'not_empty' => true,
			),
			'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Design Options', 'infinite-addons' ),
		),
		
		array(
			
			'type'       => 'colorpicker',
			'param_name' => 'overlay_color',
			'heading'    => esc_html__( 'Color Overlay', 'infinite-addons' ),
			'description'  => esc_html__( 'Set overlay color', 'infinite-addons' ),
			'dependency'   => array(
				'element'   => 'overlay_type',
				'value' => 'color',
			),
			'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Design Options', 'infinite-addons' ),
			
		),

		array(
			'type'         => 'gradient',
			'heading'      => esc_html__( 'Gradient Overlay Picker', 'infinite-addons' ),
			'param_name'   => 'gradient_overlay',
			'description'  => esc_html__( 'Set gradient overlay color', 'infinite-addons' ),
			'dependency'   => array(
				'element'   => 'overlay_type',
				'value' => 'gradient',
			),
			'group' => esc_html__( 'Design Options', 'infinite-addons' ),
		),

		array(
			'type'       => 'responsive_css_editor',
			'heading'    => esc_html__( 'Responsive CSS Box', 'infinite-addons' ),
			'param_name' => 'responsive_css',
			'group'      => esc_html__( 'Responsive Options', 'infinite-addons' ),
			'dependency' => array(
				'element' => 'enable_responsive_options',
				'not_empty' => true,
			),
		),
		
		array(
			'type'       => 'rella_shape_divider',
			'heading'    => esc_html__( 'Shape Divider Options', 'infinite-addons' ),
			'param_name' => 'row_svg_divider',
			'group'      => esc_html__( 'Shape Divider', 'infinite-addons' ),
			'dependency' => array(
				'element' => 'enable_row_dividers',
				'not_empty' => true,
			),
		),

	);

	vc_add_params( 'vc_row', $params );
	
	//Fullpage enable
	$fullpage_params = array();
	$enabled_fullpage = get_post_meta( get_the_ID(), 'enable-fullpage', false );
	//if( 'on' === $enabled_fullpage ) {
		
		$fullpage_params = array(
			
			array(
				'type'       => 'textfield',
				'param_name' => 'fullpage_title',
				'heading'    => esc_html__( 'Fullpage navigation title', 'infinite-addons' ),
				'description' => esc_html__( 'Add title to display on floated navigation', 'infinite-addons' ),
			),
			
			array(
				'type'       => 'dropdown',
				'param_name' => 'fullpage_brightness',
				'heading'    => esc_html__( 'Fullpage row brightness', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Light', 'infinite-addons' ) => 'light',
					esc_html__( 'Dark', 'infinite-addons' )  => 'dark',
				),
			),
				
		);

	//}

	vc_add_params( 'vc_row', $fullpage_params );	
	

}
rella_row_extras();

// New Params for Inner Row
function rella_inner_row_extras() {

	$params = array(

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Row stretch', 'infinite-addons' ),
			'param_name' => 'full_width',
			'value' => array(
				esc_html__( 'Default', 'infinite-addons' ) => '',
				esc_html__( 'Stretch row', 'infinite-addons' ) => 'stretch_row',
				esc_html__( 'Stretch row and content', 'infinite-addons' ) => 'stretch_row_content',
				esc_html__( 'Stretch row and content (no paddings)', 'infinite-addons' ) => 'stretch_row_content_no_spaces',
			),
			'weight' => 1,
			'description' => esc_html__( 'Select stretching options for row and content (Note: stretched may not work properly if parent container has "overflow: hidden" CSS property).', 'infinite-addons' ),
		),

		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Full height row?', 'infinite-addons' ),
			'param_name' => 'full_height',
			'description' => esc_html__( 'If checked row will be set to full height.', 'infinite-addons' ),
			'value' => array( esc_html__( 'Yes', 'infinite-addons' ) => 'yes' ),
			'weight' => 1,
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Columns position', 'infinite-addons' ),
			'param_name' => 'columns_placement',
			'value' => array(
				esc_html__( 'Middle', 'infinite-addons' ) => 'middle',
				esc_html__( 'Top', 'infinite-addons' ) => 'top',
				esc_html__( 'Bottom', 'infinite-addons' ) => 'bottom',
				esc_html__( 'Stretch', 'infinite-addons' ) => 'stretch',
			),
			'description' => esc_html__( 'Select columns position within row.', 'infinite-addons' ),
			'weight' => 1,
			'dependency' => array(
				'element' => 'full_height',
				'not_empty' => true,
			),
		),
	);

	vc_add_params( 'vc_row_inner', $params );
}
rella_inner_row_extras();

//New Params for widgetized sidebar
function rella_sidebar_extras() {
	
	$params = array(

		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Sticky Sidebar?', 'infinite-addons' ),
			'param_name' => 'sticky_sidebar',
			'description' => esc_html__( 'If checked the sidebar will become sticky', 'infinite-addons' ),
			'value' => array( esc_html__( 'Yes', 'infinite-addons' ) => 'yes' ),
			'edit_field_class' => 'vc_col-sm-6'
		),

		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Limit container', 'infinite-addons' ),
			'param_name' => 'limit_container',
			'description' => esc_html__( 'Input the classname or ID of the container to limit the sticky sidebar', 'infinite-addons' ),
			'dependency' => array(
				'element' => 'sticky_sidebar',
				'not_empty' => true,
			),
			'edit_field_class' => 'vc_col-sm-6'
		),
	);
	
	vc_add_params( 'vc_widget_sidebar', $params );

}
rella_sidebar_extras();

//New Params for Columns and inner columns
vc_remove_param( 'vc_column', 'el_class' );

function rella_columns_extras() {

	$params = array(
		vc_map_add_css_animation( false ),
		array(
			'type'             => 'textfield',
			'heading'          => esc_html__( 'Animation Delay', 'infinite-addons' ),
			'param_name'       => 'delay',
			'description'      => esc_html__( 'Add animation delay in mls', 'infinite-addons' ),
			'edit_field_class' => 'vc_col-sm-6'

		),

		array(
			'type'        => 'responsive_alignment',
			'param_name'  => 'align',
			'heading'     => esc_html__( 'Text align', 'infinite-addons' ),
			'description' => esc_html__( 'Text alignment inside the column', 'infinite-addons' ),
		),

		array(
			'type'        => 'dropdown',
			'param_name'  => 'parallax',
			'heading'     => esc_html__( 'Parallax', 'infinite-addons' ),
			'description' => esc_html__( 'Add parallax for column.', 'infinite-addons' ),
			'value'       => array(
				esc_html__( 'None', 'infinite-addons' ) => '',
				esc_html__( 'Yes', 'infinite-addons' )  => 'yes'
			),
		),

		//Paralax settings for vc_column and vc_column_inner
		array(
			'type'        => 'dropdown',
			'param_name'  => 'parallax_preset',
			'heading'     => esc_html__( 'Parallax Presets', 'infinite-addons' ),
			'description' => esc_html__( 'Select a parallax preset to apply to particle', 'infinite-addons' ),
			'value'       => array(
				'fadeIn',
				'fadeInDownLong',
				'fadeInDownShort',
				'fadeInLeftLong',
				'fadeInLeftShort',
				'fadeInRightLong',
				'fadeInRightShort',
				'fadeInUpLong',
				'fadeInUpShort',
				'rotateInX',
				'rotateInY',
				'rotateOutX',
				'rotateOutY',
				'slideDownLong',
				'slideLeftLong',
				'slideLeftShort',
				'slideRightLong',
				'slideRightShort',
				'slideUpLong',
				'slideUpShort',
				'zoomIn',
				'zoomOut',
				'custom',
			),
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),
		),

		array(
			'type'        => 'subheading',
			'param_name'  => 'prlx_from',
			'heading'     => esc_html__( 'Parallax "From" Options', 'infinite-addons' ),
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'parallax_preset',
				'value'   => 'custom',
			),
		),

		array(
			'type'        => 'rella_slider',
			'param_name'  => 'translate_from_x',
			'heading'     => esc_html__( 'Translate X', 'infinite-addons' ),
			'description' => esc_html__( 'Select translate on X axe', 'infinite-addons' ),
			'min'         => -500,
			'max'         => 500,
			'step'        => 1,
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'parallax_preset',
				'value'   => 'custom',
			),

		),

		array(
			'type'        => 'rella_slider',
			'param_name'  => 'translate_from_y',
			'heading'     => esc_html__( 'Translate Y', 'infinite-addons' ),
			'description' => esc_html__( 'Select translate on Y axe', 'infinite-addons' ),
			'min'         => -500,
			'max'         => 500,
			'step'        => 1,
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'parallax_preset',
				'value'   => 'custom',
			),

		),

		array(
			'type'        => 'rella_slider',
			'param_name'  => 'translate_from_z',
			'heading'     => esc_html__( 'Translate Z', 'infinite-addons' ),
			'description' => esc_html__( 'Select translate on Z axe', 'infinite-addons' ),
			'min'         => -500,
			'max'         => 500,
			'step'        => 1,
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'parallax_preset',
				'value'   => 'custom',
			),

		),

		array(
			'type'        => 'rella_slider',
			'param_name'  => 'scale_from_x',
			'heading'     => esc_html__( 'Scale X', 'infinite-addons' ),
			'description' => esc_html__( 'Select Scale X', 'infinite-addons' ),
			'min'         => 0,
			'max'         => 10,
			'step'        => 0.25,
			'std'         => 1,
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'parallax_preset',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-4',

		),

		array(
			'type'        => 'rella_slider',
			'param_name'  => 'scale_from_y',
			'heading'     => esc_html__( 'Scale Y', 'infinite-addons' ),
			'description' => esc_html__( 'Select Scale Y', 'infinite-addons' ),
			'min'         => 0,
			'max'         => 10,
			'step'        => 0.25,
			'std'         => 1,
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'parallax_preset',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-4',
		),

		array(
			'type'        => 'rella_slider',
			'param_name'  => 'scale_from_z',
			'heading'     => esc_html__( 'Scale Z', 'infinite-addons' ),
			'description' => esc_html__( 'Select Scale Z', 'infinite-addons' ),
			'min'         => 0,
			'max'         => 10,
			'step'        => 0.25,
			'std'         => 1,
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'parallax_preset',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-4',
		),

		array(
			'type'        => 'rella_slider',
			'param_name'  => 'rotate_from_x',
			'heading'     => esc_html__( 'Rotate X', 'infinite-addons' ),
			'description' => esc_html__( 'Select rotate degree on X axe', 'infinite-addons' ),
			'min'         => -360,
			'max'         => 360,
			'step'        => 1,
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'parallax_preset',
				'value'   => 'custom',
			),

		),

		array(
			'type'        => 'rella_slider',
			'param_name'  => 'rotate_from_y',
			'heading'     => esc_html__( 'Rotate Y', 'infinite-addons' ),
			'description' => esc_html__( 'Select rotate degree on Y axe', 'infinite-addons' ),
			'min'         => -360,
			'max'         => 360,
			'step'        => 1,
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'parallax_preset',
				'value'   => 'custom',
			),

		),

		array(
			'type'        => 'rella_slider',
			'param_name'  => 'rotate_from_z',
			'heading'     => esc_html__( 'Rotate Z', 'infinite-addons' ),
			'description' => esc_html__( 'Select rotate degree on Z axe', 'infinite-addons' ),
			'min'         => -360,
			'max'         => 360,
			'step'        => 1,
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'parallax_preset',
				'value'   => 'custom',
			),

		),

		array(
			'type'        => 'dropdown',
			'param_name'  => 'from_torigin_x',
			'heading'     => esc_html__( 'Transform Origin X', 'infinite-addons' ),
			'description' => esc_html__( 'Select or add transform origin X axe', 'infinite-addons' ),
			'value'       => array(
				esc_html__( 'None', 'infinite-addons' )   => '',
				esc_html__( 'Left', 'infinite-addons' )   => 'left',
				esc_html__( 'Center', 'infinite-addons' ) => 'center',
				esc_html__( 'Right', 'infinite-addons' )  => 'right',
				esc_html__( 'Custom', 'infinite-addons' ) => 'custom',
			),
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'parallax_preset',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),

		array(
			'type'        => 'textfield',
			'param_name'  => 'from_torigin_x_custom',
			'heading'     => esc_html__( 'Custom value for X-asex', 'infinite-addons' ),
			'description' => esc_html__( 'Add custom value for transform-origin X axe in px or %', 'infinite-addons' ),
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'from_torigin_x',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),

		array(
			'type'        => 'dropdown',
			'param_name'  => 'from_torigin_y',
			'heading'     => esc_html__( 'Transform Origin Y', 'infinite-addons' ),
			'description' => esc_html__( 'Select or add transform origin Y axe', 'infinite-addons' ),
			'value'       => array(
				esc_html__( 'None', 'infinite-addons' )   => '',
				esc_html__( 'Top', 'infinite-addons' )    => 'top',
				esc_html__( 'Center', 'infinite-addons' ) => 'center',
				esc_html__( 'Bottom', 'infinite-addons' ) => 'bottom',
				esc_html__( 'Custom', 'infinite-addons' ) => 'custom',
			),
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'parallax_preset',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),

		array(
			'type'        => 'textfield',
			'param_name'  => 'from_torigin_y_custom',
			'heading'     => esc_html__( 'Custom value for Y-asex', 'infinite-addons' ),
			'description' => esc_html__( 'Add custom value for transform-origin Y axe in px or %', 'infinite-addons' ),
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'from_torigin_y',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),

		array(
			'type'        => 'rella_slider',
			'param_name'  => 'from_opacity',
			'heading'     => esc_html__( 'Opacity', 'infinite-addons' ),
			'description' => esc_html__( 'Set opacity', 'infinite-addons' ),
			'min'         => 0,
			'max'         => 1,
			'step'        => 0.1,
			'std'         => 1,
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'parallax_preset',
				'value'   => 'custom',
			),

		),

		//parallax custom code textarea
		array(
			'type'        => 'textarea',
			'param_name'  => 'parallax_from',
			'heading'     => esc_html__( 'Parallax "From" Custom Options', 'infinite-addons' ),
			'description' => esc_html__( 'Parallax custom options to add to data-paralax-from attribute, will override all options above', 'infinite-addons' ),
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'parallax_preset',
				'value'   => 'custom',
			),
		),

		array(
			'type'        => 'subheading',
			'param_name'  => 'prlx_to',
			'heading'     => esc_html__( 'Parallax "To" Options', 'infinite-addons' ),
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'parallax_preset',
				'value'   => 'custom',
			),
		),

		array(
			'type'        => 'rella_slider',
			'param_name'  => 'translate_to_x',
			'heading'     => esc_html__( 'Translate X', 'infinite-addons' ),
			'description' => esc_html__( 'Select translate on X axe', 'infinite-addons' ),
			'min'         => -500,
			'max'         => 500,
			'step'        => 1,
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'parallax_preset',
				'value'   => 'custom',
			),

		),

		array(
			'type'        => 'rella_slider',
			'param_name'  => 'translate_to_y',
			'heading'     => esc_html__( 'Translate Y', 'infinite-addons' ),
			'description' => esc_html__( 'Select translate on Y axe', 'infinite-addons' ),
			'min'         => -500,
			'max'         => 500,
			'step'        => 1,
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'parallax_preset',
				'value'   => 'custom',
			),

		),

		array(
			'type'        => 'rella_slider',
			'param_name'  => 'translate_to_z',
			'heading'     => esc_html__( 'Translate Z', 'infinite-addons' ),
			'description' => esc_html__( 'Select translate on Z axe', 'infinite-addons' ),
			'min'         => -500,
			'max'         => 500,
			'step'        => 1,
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'parallax_preset',
				'value'   => 'custom',
			),

		),

		array(
			'type'        => 'rella_slider',
			'param_name'  => 'scale_to_x',
			'heading'     => esc_html__( 'Scale X', 'infinite-addons' ),
			'description' => esc_html__( 'Select Scale X', 'infinite-addons' ),
			'min'         => 0,
			'max'         => 10,
			'step'        => 0.25,
			'std'         => 1,
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'parallax_preset',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-4',

		),

		array(
			'type'        => 'rella_slider',
			'param_name'  => 'scale_to_y',
			'heading'     => esc_html__( 'Scale Y', 'infinite-addons' ),
			'description' => esc_html__( 'Select Scale Y', 'infinite-addons' ),
			'min'         => 0,
			'max'         => 10,
			'step'        => 0.25,
			'std'         => 1,
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'parallax_preset',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-4',
		),

		array(
			'type'        => 'rella_slider',
			'param_name'  => 'scale_to_z',
			'heading'     => esc_html__( 'Scale Z', 'infinite-addons' ),
			'description' => esc_html__( 'Select Scale Z', 'infinite-addons' ),
			'min'         => 0,
			'max'         => 10,
			'step'        => 0.25,
			'std'         => 1,
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'parallax_preset',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-4',
		),

		array(
			'type'        => 'rella_slider',
			'param_name'  => 'rotate_to_x',
			'heading'     => esc_html__( 'Rotate X', 'infinite-addons' ),
			'description' => esc_html__( 'Select rotate degree on X axe', 'infinite-addons' ),
			'min'         => -360,
			'max'         => 360,
			'step'        => 1,
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'parallax_preset',
				'value'   => 'custom',
			),

		),

		array(
			'type'        => 'rella_slider',
			'param_name'  => 'rotate_to_y',
			'heading'     => esc_html__( 'Rotate Y', 'infinite-addons' ),
			'description' => esc_html__( 'Select rotate degree on Y axe', 'infinite-addons' ),
			'min'         => -360,
			'max'         => 360,
			'step'        => 1,
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'parallax_preset',
				'value'   => 'custom',
			),

		),

		array(
			'type'        => 'rella_slider',
			'param_name'  => 'rotate_to_z',
			'heading'     => esc_html__( 'Rotate Z', 'infinite-addons' ),
			'description' => esc_html__( 'Select rotate degree on Z axe', 'infinite-addons' ),
			'min'         => -360,
			'max'         => 360,
			'step'        => 1,
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'parallax_preset',
				'value'   => 'custom',
			),

		),

		array(
			'type'        => 'dropdown',
			'param_name'  => 'to_torigin_x',
			'heading'     => esc_html__( 'Transform Origin X', 'infinite-addons' ),
			'description' => esc_html__( 'Select or add transform origin X axe', 'infinite-addons' ),
			'value'       => array(
				esc_html__( 'None', 'infinite-addons' )   => '',
				esc_html__( 'Left', 'infinite-addons' )   => '0%',
				esc_html__( 'Center', 'infinite-addons' ) => '50%',
				esc_html__( 'Right', 'infinite-addons' )  => '100%',
				esc_html__( 'Custom', 'infinite-addons' ) => 'custom',
			),
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'parallax_preset',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),

		array(
			'type'        => 'textfield',
			'param_name'  => 'to_torigin_x_custom',
			'heading'     => esc_html__( 'Custom value for X-asex', 'infinite-addons' ),
			'description' => esc_html__( 'Add custom value for transform-origin X axe in px or %', 'infinite-addons' ),
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'to_torigin_x',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),

		array(
			'type'        => 'dropdown',
			'param_name'  => 'to_torigin_y',
			'heading'     => esc_html__( 'Transform Origin Y', 'infinite-addons' ),
			'description' => esc_html__( 'Select or add transform origin Y axe', 'infinite-addons' ),
			'value'       => array(
				esc_html__( 'None', 'infinite-addons' )   => '',
				esc_html__( 'Top', 'infinite-addons' )    => '0%',
				esc_html__( 'Center', 'infinite-addons' ) => '50%',
				esc_html__( 'Bottom', 'infinite-addons' ) => '100%',
				esc_html__( 'Custom', 'infinite-addons' ) => 'custom',
			),
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'parallax_preset',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),

		array(
			'type'        => 'textfield',
			'param_name'  => 'to_torigin_y_custom',
			'heading'     => esc_html__( 'Custom value for Y-asex', 'infinite-addons' ),
			'description' => esc_html__( 'Add custom value for transform-origin Y axe in px or %', 'infinite-addons' ),
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'to_torigin_y',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),

		array(
			'type'        => 'rella_slider',
			'param_name'  => 'to_opacity',
			'heading'     => esc_html__( 'Opacity', 'infinite-addons' ),
			'description' => esc_html__( 'Set opacity', 'infinite-addons' ),
			'min'         => 0,
			'max'         => 1,
			'step'        => 0.1,
			'std'         => 1,
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'parallax_preset',
				'value'   => 'custom',
			),

		),

		array(
			'type'        => 'textarea',
			'param_name'  => 'parallax_to',
			'heading'     => esc_html__( 'Parallax To', 'infinite-addons' ),
			'description' => esc_html__( 'Parallax custom options to add to data-paralax-from attribute', 'infinite-addons' ),
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'parallax_preset',
				'value'   => 'custom',
			),
		),

		array(
			'type'        => 'subheading',
			'param_name'  => 'prlx_common',
			'heading'     => esc_html__( 'Parallax Settings', 'infinite-addons' ),
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),
		),

		array(
			'type'        => 'textfield',
			'param_name'  => 'to_delay',
			'heading'     => esc_html__( 'Delay', 'infinite-addons' ),
			'description' => esc_html__( 'Add delay time in seconds', 'infinite-addons' ),
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),
		),

		array(
			'type'        => 'dropdown',
			'param_name'  => 'to_easy',
			'heading'     => esc_html__( 'Animation Easing', 'infinite-addons' ),
			'description' => '',
			'value'       => array(
				'Linear.easeNone'  => 'Linear.easeNone',
				'Power0.easeIn'    => 'Power0.easeIn',
				'Power0.easeInOut' => 'Power0.easeInOut',
				'Power0.easeOut'   => 'Power0.easeOut',
				'Power1.easeIn'    => 'Power1.easeIn',
				'Power1.easeInOut' => 'Power1.easeInOut',
				'Power1.easeOut'   => 'Power1.easeOut',
				'Power2.easeIn'    => 'Power2.easeIn',
				'Power2.easeInOut' => 'Power2.easeInOut',
				'Power2.easeOut'   => 'Power2.easeOut',
				'Power3.easeIn'    => 'Power3.easeIn',
				'Power3.easeInOut' => 'Power3.easeInOut',
				'Power3.easeOut'   => 'Power3.easeOut',
				'Power4.easeIn'    => 'Power4.easeIn',
				'Power4.easeInOut' => 'Power4.easeInOut',
				'Power4.easeOut'   => 'Power4.easeOut',
				'Back.easeIn'      => 'Back.easeIn',
				'Back.easeInOut'   => 'Back.easeInOut',
				'Back.easeOut'     => 'Back.easeOut',
				'Elastic.easeIn'   => 'Elastic.easeIn',
				'Elastic.easeInOut' => 'Elastic.easeInOut',
				'Elastic.easeOut'  => 'Elastic.easeOut',
				'Circ.easeIn'      => 'Circ.easeIn',
				'Circ.easeInOut'   => 'Circ.easeInOut',
				'Circ.easeOut'     => 'Circ.easeOut',
				'Expo.easeIn'      => 'Expo.easeIn',
				'Expo.easeInOut'   => 'Expo.easeInOut',
				'Expo.easeOut'     => 'Expo.easeOut',
				'Sine.easeIn'      => 'Sine.easeIn',
				'Sine.easeInOut'   => 'Sine.easeInOut',
				'Sine.easeOut'     => 'Sine.easeOut',
				'Quint.easeIn'     => 'Quint.easeIn',
				'Quint.easeInOut'  => 'Quint.easeInOut',
				'Quint.easeOut'    => 'Quint.easeOut',
			),
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),
		),

		array(
			'type'        => 'textfield',
			'param_name'  => 'parallax_time',
			'heading'     => esc_html__( 'Parallax Time', 'infinite-addons' ),
			'description' => esc_html__( 'Duration of the animation in sec', 'infinite-addons' ),
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),
			'edit_field_class' => 'vc_col-sm-6',
		),

		array(
			'type'        => 'textfield',
			'param_name'  => 'parallax_offset',
			'heading'     => esc_html__( 'Parallax Offset', 'infinite-addons' ),
			'description' => esc_html__( 'Offset number', 'infinite-addons' ),
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),
			'edit_field_class' => 'vc_col-sm-6',
		),

		array(
			'type'       => 'dropdown',
			'param_name' => 'parallax_trigger',
			'heading'    => esc_html__( 'Parallax Trigger', 'infinite-addons' ),
			'value' => array(
				esc_html__( 'On Enter', 'infinite-addons' )  => 'onEnter',
				esc_html__( 'On Leave', 'infinite-addons' ) => 'onLeave',
				esc_html__( 'On Center', 'infinite-addons' ) => 'onCenter',
				esc_html__( 'Number Value', 'infinite-addons' ) => 'number',
			),
			'std'        => 'onEnter',
			'group'      => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency' => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),
			'edit_field_class' => 'vc_col-sm-6',
		),

		array(
			'type'        => 'textfield',
			'param_name'  => 'parallax_trigger_number',
			'heading'     => esc_html__( 'Parallax Trigger Number', 'infinite-addons' ),
			'description' => esc_html__( 'Input trigger number value from 0 to 1', 'infinite-addons' ),
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'parallax_trigger',
				'value'   => 'number'
			),
			'edit_field_class' => 'vc_col-sm-6',
		),

		array(
			'type'        => 'textfield',
			'param_name'  => 'parallax_duration',
			'heading'     => esc_html__( 'Parallax Duration', 'infinite-addons' ),
			'description' => esc_html__( 'define how much the animation last during the scroll. could be defined in px (150) or percent(100%)', 'infinite-addons' ),
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),
			'edit_field_class' => 'vc_col-sm-6',
		),

		array(
			'type'        => 'dropdown',
			'param_name'  => 'enable_transform',
			'heading'     => esc_html__( 'Add Perspective', 'infinite-addons' ),
			'description' => esc_html__( 'Will enable 3D Transform for column with parallax', 'infinite-addons' ),
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'value'       => array(
				esc_html__( 'No', 'infinite-addons' )  => 'no',
				esc_html__( 'Yes', 'infinite-addons' ) => 'yes',
			),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),
			'edit_field_class' => 'vc_col-sm-6',
		),

		array(
			'type'        => 'dropdown',
			'param_name'  => 'enable_reverse',
			'heading'     => esc_html__( 'Enable Reverse', 'infinite-addons' ),
			'description' => esc_html__( 'Will enable animation each time the element will come in viewport', 'infinite-addons' ),
			'group'       => esc_html__( 'Parallax Options', 'infinite-addons' ),
			'value'       => array(
				esc_html__( 'No', 'infinite-addons' ) => 'no',
				esc_html__( 'Yes', 'infinite-addons' ) => 'yes',
			),
			'std' => 'yes',
			'dependency' => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),
			'edit_field_class' => 'vc_col-sm-6',
		),

		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', 'js_composer' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
		),

		array(
			'type'        => 'checkbox',
			'param_name'  => 'enable_responsive_options',
			'heading'     => esc_html__( 'Enable Responsive Css Box', 'infinite-addons' ),
			'description' => esc_html__( 'Will enable small dekstop, tablet and mobile css options', 'infinite-addons' ),
			'value'       => array( esc_html__( 'Yes', 'infinite-addons' ) => 'yes' ),
			'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
		),

		array(
			'type'        => 'responsive_css_editor',
			'heading'     => esc_html__( 'Responsive CSS box', 'infinite-addons' ),
			'param_name'  => 'responsive_css',
			'group'       => esc_html__( 'Design Options', 'infinite-addons' ),
			'dependency'  => array(
				'element' => 'enable_responsive_options',
				'not_empty' => true,
			),
		),

	);

	vc_add_params( 'vc_column', $params );
	vc_add_params( 'vc_column_inner', $params );
}
rella_columns_extras();

function rella_background_position_params() {

	$params = array(

		array(
			'type' => 'dropdown',
			'param_name' => 'bg_position',
			'heading' => esc_html__( 'Background Position', 'infinite-addons' ),
			'value' => array(
				esc_html__( 'Default', 'infinite-addons' )         => '',
				esc_html__( 'Center Bottom', 'infinite-addons' )   => 'center bottom',
				esc_html__( 'Center Center', 'infinite-addons' )   => 'center center',
				esc_html__( 'Center Top', 'infinite-addons' )      => 'center top',
				esc_html__( 'Left Bottom', 'infinite-addons' )     => 'left bottom',
				esc_html__( 'Left Center', 'infinite-addons' )     => 'left center',
				esc_html__( 'Left Top', 'infinite-addons' )        => 'left top',
				esc_html__( 'Right Bottom', 'infinite-addons' )    => 'right bottom',
				esc_html__( 'Right Center', 'infinite-addons' )    => 'right center',
				esc_html__( 'Right Top', 'infinite-addons' )       => 'right top',
				esc_html__( 'Custom Position', 'infinite-addons' ) => 'custom',
			),
			'group' => esc_html__( 'Design Options', 'infinite-addons' ),
		),

		array(
			'type'             => 'textfield',
			'param_name'       => 'bg_pos_h',
			'heading'          => esc_html__( 'Horizontal Position', 'infinite-addons' ),
			'description'      => esc_html__( 'Enter custom horizontal position in px or %', 'infinite-addons' ),
			'group'            => esc_html__( 'Design Options', 'infinite-addons' ),
			'edit_field_class' => 'vc_col-sm-6',
			'dependency'  => array(
				'element' => 'bg_position',
				'value'   => 'custom'
			)
		),

		array(
			'type'             => 'textfield',
			'param_name'       => 'bg_pos_v',
			'heading'          => esc_html__( 'Vertical Position', 'infinite-addons' ),
			'description'      => esc_html__( 'Enter custom vertical position in px or %', 'infinite-addons' ),
			'group'            => esc_html__( 'Design Options', 'infinite-addons' ),
			'edit_field_class' => 'vc_col-sm-6',
			'dependency'  => array(
				'element' => 'bg_position',
				'value'   => 'custom'
			)
		),

		array(
			'type'        => 'textfield',
			'param_name'  => 'zindex',
			'heading'     => esc_html__( 'Z-index', 'infinite-addons' ),
			'description' => esc_html__( 'Add z-index for this element', 'infinite-addons' ),
		),

	);

	vc_add_params( 'vc_row_inner', $params );
	vc_add_params( 'vc_column', $params );
	vc_add_params( 'vc_column_inner', $params );

}
rella_background_position_params();

function rella_row_separator() {

	$params = array(

		array(
			'type'        => 'checkbox',
			'param_name'  => 'svg_separator',
			'heading'     => esc_html__( 'Enable curve svg separator', 'infinite-addons' ),
			'description' => esc_html__( 'If checked curve svg separator will be set to the row.', 'infinite-addons' ),
			'value'       => array( esc_html__( 'Yes', 'infinite-addons' ) => 'yes' ),
			'edit_field_class' => 'vc_column-with-padding vc_col-sm-6',
		),

		array(
			'type'        => 'colorpicker',
			'param_name'  => 'svg_color',
			'heading'     => esc_html__( 'Background Color', 'infinite-addons' ),
			'description' => esc_html__( 'Background Color for Curve Separator', 'infinite-addons' ),
			'dependency'  => array(
				'element'   => 'svg_separator',
				'not_empty' => true,
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
	);

	vc_add_params( 'vc_row', $params );
	vc_add_params( 'vc_row_inner', $params );

}
rella_row_separator();

function rella_separator_extra() {

	$params = array(

		array(
			'type'        => 'checkbox',
			'param_name'  => 'vertical',
			'heading'     => esc_html__( 'Vertical?', 'infinite-addons' ),
			'description' => esc_html__( 'If checked separator will be set vertical.', 'infinite-addons' ),
			'value'       => array( esc_html__( 'Yes', 'infinite-addons' ) => 'yes' ),
			'edit_field_class' => 'vc_column-with-padding vc_col-sm-6',
			'weight' => 1
		),

		array(
			'type' => 'dropdown',
			'param_name' => 'sep_height',
			'heading' => esc_html__( 'Height', 'infinite-addons' ),
			'value' => array(
				esc_html__( 'Default', 'infinite-addons' )  => 'v-sep',
				esc_html__( 'Shortest', 'infinite-addons' ) => 'v-sep shortest',
				esc_html__( 'Shorter', 'infinite-addons' )  => 'v-sep shorter',
				esc_html__( 'Short', 'infinite-addons' )    => 'v-sep short',
			),
			'description' => esc_html__( 'Select vertical separator height', 'infinite-addons' ),
			'dependency' => array(
				'element' => 'vertical',
				'not_empty' => true,
			),
			'edit_field_class' => 'vc_col-sm-6',
			'weight' => 1
		),
	);

	vc_add_params( 'vc_separator', $params );

	vc_update_shortcode_param( 'vc_separator', array(
		'param_name' => 'align',
		'dependency' => array(
			'element' => 'vertical',
			'value_not_equal_to' => 'yes',
		),
	) );

	vc_update_shortcode_param( 'vc_separator', array(
		'param_name' => 'style',
		'dependency' => array(
			'element' => 'vertical',
			'value_not_equal_to' => 'yes',
		),
	) );

	vc_update_shortcode_param( 'vc_separator', array(
		'param_name' => 'el_width',
		'dependency' => array(
			'element' => 'vertical',
			'value_not_equal_to' => 'yes',
		),
	) );

	vc_update_shortcode_param( 'vc_separator', array(
		'param_name' => 'border_width',
		'dependency' => array(
			'element' => 'vertical',
			'value_not_equal_to' => 'yes',
		),
	) );

	vc_update_shortcode_param( 'vc_separator', array(
		'param_name' => 'color',
		'dependency' => array(
			'element' => 'vertical',
			'value_not_equal_to' => 'yes',
		),
	) );

}
rella_separator_extra();

function rella_extends_vc_icon() {

	vc_update_shortcode_param( 'vc_icon', array(
		'param_name' => 'type',
		'value' => array(
			esc_html__( 'Font Awesome', 'infinite-addons' ) => 'fontawesome',
			esc_html__( 'Linea 10', 'infinite-addons' )     => 'linea',
			esc_html__( 'Open Iconic', 'infinite-addons' )  => 'openiconic',
			esc_html__( 'Typicons', 'infinite-addons' )     => 'typicons',
			esc_html__( 'Entypo', 'infinite-addons' )       => 'entypo',
			esc_html__( 'Linecons', 'infinite-addons' )     => 'linecons',
			esc_html__( 'Mono Social', 'infinite-addons' )  => 'monosocial',
			esc_html__( 'Material', 'infinite-addons' )     => 'material',
		),
		'weight' => 1

	));

	$param = array(

		'type' => 'iconpicker',
		'heading' => esc_html__( 'Icon', 'infinite-addons' ),
		'param_name' => 'icon_linea',
		'value' => 'icon-weather_aquarius',
		// default value to backend editor admin_label
		'settings' => array(
			'emptyIcon' => false,
			// default true, display an "EMPTY" icon?
			'type' => 'linea',
			'iconsPerPage' => 4000,
			// default 100, how many icons per/page to display
		),
		'dependency' => array(
			'element' => 'type',
			'value' => 'linea',
		),
		'weight' => 1

	);

	vc_add_param( 'vc_icon', $param );

}
rella_extends_vc_icon();

//Add vc_custom_heading extra options
function rella_extends_vc_custom_heading() {

	$params = array(

		array(
			'type'        => 'textfield',
			'param_name'  => 'letter_spacing',
			'heading'     => esc_html__( 'Letter Spacing', 'infinite-addons' ),
			'description' => esc_html__( 'Add letter spacing', 'infinite-addons' ),
		),
		array(
			'type'       => 'checkbox',
			'param_name' => 'enable_gradient',
			'heading'    => esc_html__( 'Enable Gradient color', 'infinite-addons' ),
			'value'      => array( esc_html__( 'Yes', 'infinite-addons' ) => 'yes' ),
		),
		array(
			'type'        => 'gradient',
			'param_name'  => 'gradient_color',
			'heading'     => esc_html__( 'Gradient Color', 'infinite-addons' ),
			'description' => esc_html__( 'Add gradient color to text' ),
			'dependency'  => array(
				'element'   => 'enable_gradient',
				'not_empty' => true
			),
		),
		array(
			'type'       => 'checkbox',
			'param_name' => 'enable_fittext',
			'heading'    => esc_html__( 'Enable fitText', 'infinite-addons' ),
			'value'      => array( esc_html__( 'Yes', 'infinite-addons' ) => 'yes' ),
		),
		array(
			'type'        => 'textfield',
			'param_name'  => 'fittex_size',
			'heading'     => esc_html__( 'fitText Max size', 'infinite-addons' ),
			'description' => esc_html__( 'Add Max text size in px ex. 75px', 'infinite-addons' ),
			'dependency'  => array(
				'element'   => 'enable_fittext',
				'not_empty' => true
			),
		),

	);

	vc_add_params( 'vc_custom_heading', $params );
}
rella_extends_vc_custom_heading();

function rella_extends_vc_single_image() {

		$params = array (

			array(
				'type'       => 'dropdown',
				'param_name' => 'image_type',
				'heading'    =>  esc_html__( 'Image type', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Image', 'infinite-addons' ) => '',
					esc_html__( 'SVG', 'infinite-addons') => 'svg',
				),
				'weight' => 1
			),
			
			array(
				'type'        => 'textfield',
				'param_name'  => 'image_max_width',
				'heading'     => esc_html__( 'Image Max Width', 'infinite-addons' ),
				'description' => esc_html__( 'Set Image max width for ex. 250px', 'infinite-addons' ),
			),

			array(
				'type'        => 'checkbox',
				'param_name'  => 'invisible',
				'heading'     => esc_html__( 'Invisible?', 'infinite-addons' ),
				'description' => esc_html__( 'Check to make image invisible and use as placeholder', 'infinite-addons' ),
				'value'       => array( esc_html__( 'Yes', 'infinite-addons' ) => 'yes' ),
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'd_effect',
				'heading'    =>  esc_html__( 'Enable 3D effect', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'No', 'infinite-addons' ) => '',
					esc_html__( 'Yes', 'infinite-addons') => 'yes',
				),
				'group' => esc_html__( 'Effects', 'infinite-addons' ),
				'weight' => 1
			),

			array(
				'type'       => 'textfield',
				'param_name' => 'stacking_factor',
				'heading'    => esc_html__( 'Stacking Factor', 'infinite-addons' ),
				'description' => esc_html__( 'Enter a value from 0.6 to 1', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'd_effect',
					'value'   => 'yes'
				),
				'group' => esc_html__( 'Effects', 'infinite-addons' ),
				'weight' => 1,
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'enable_panr_effect',
				'heading'     => esc_html__( 'Enable Panr Effect', 'infinite-addons' ),
				'description' => esc_html__( 'Will enable zoom and pan effect on the image', 'infinite-addons' ),
				'value'       => array(
					esc_html__( 'No', 'infinite-addons' ) => '',
					esc_html__( 'Yes', 'infinite-addons') => 'yes',
				),
				'group'       => esc_html__( 'Effects', 'infinite-addons' ),
				'weight'      => 1
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'sensitivity',
				'heading'     => esc_html__( 'Sensitivy', 'infinite-addons' ),
				'description' => esc_html__( 'Sensitivity to mouse movement ex. 15', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'enable_panr_effect',
					'value'   => 'yes'
				),
				'std'         => '15',
				'group'       => esc_html__( 'Effects', 'infinite-addons' ),
				'weight'      => 1,
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'movetarget',
				'heading'     => esc_html__( 'Move target', 'infinite-addons' ),
				'description' => esc_html__( 'Select a move target', 'infinite-addons' ),
				'value'       => array(
					esc_html__( 'Image itself', 'infinite-addons' )     => '',
					esc_html__( 'Parent container', 'infinite-addons' ) => 'parent',
					esc_html__( 'Custom Selector', 'infinite-addons' )  => 'custom',
				),
				'dependency'  => array(
					'element' => 'enable_panr_effect',
					'value'   => 'yes'
				),
				'group'       => esc_html__( 'Effects', 'infinite-addons' ),
				'weight'      => 1,
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'customtarget',
				'heading'     => esc_html__( 'Custom Target', 'infinite-addons' ),
				'description' => esc_html__( 'Input selector of the moveTarget', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'movetarget',
					'value'   => 'custom'
				),
				'group'       => esc_html__( 'Effects', 'infinite-addons' ),
				'weight'      => 1,
			),

			array(
				'type' => 'dropdown',
				'param_name' => 'scale',
				'heading' => esc_html__( 'Scale', 'infinite-addons' ),
				'description' => esc_html__( 'Enable to scale the element', 'infinite-addons' ),
				'value'       => array(
					esc_html__( 'No', 'infinite-addons' ) => '',
					esc_html__( 'Yes', 'infinite-addons') => 'yes',
				),
				'dependency'  => array(
					'element' => 'enable_panr_effect',
					'value'   => 'yes'
				),
				'group'       => esc_html__( 'Effects', 'infinite-addons' ),
				'weight'      => 1,
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type' => 'dropdown',
				'param_name' => 'scaleonhover',
				'heading' => esc_html__( 'Scale on Hover', 'infinite-addons' ),
				'description' => esc_html__( 'Enable to scale on hover', 'infinite-addons' ),
				'value'       => array(
					esc_html__( 'No', 'infinite-addons' ) => '',
					esc_html__( 'Yes', 'infinite-addons') => 'yes',
				),
				'dependency'  => array(
					'element' => 'enable_panr_effect',
					'value'   => 'yes'
				),
				'std'         => 'yes',
				'group'       => esc_html__( 'Effects', 'infinite-addons' ),
				'weight'      => 1,
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type' => 'textfield',
				'param_name' => 'scaleduration',
				'heading' => esc_html__( 'Scale Duration', 'infinite-addons' ),
				'description' => esc_html__( 'Scaling speed in seconds. ex. 0.25', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'enable_panr_effect',
					'value'   => 'yes'
				),
				'std'         => '0.25',
				'group'       => esc_html__( 'Effects', 'infinite-addons' ),
				'weight'      => 1,
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type' => 'textfield',
				'param_name' => 'scaleto',
				'heading' => esc_html__( 'Scale to', 'infinite-addons' ),
				'description' => esc_html__( 'scale value on mouse hover, ex. 1.08', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'enable_panr_effect',
					'value'   => 'yes'
				),
				'std'         => '1.08',
				'group'       => esc_html__( 'Effects', 'infinite-addons' ),
				'weight'      => 1,
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type' => 'dropdown',
				'param_name' => 'panx',
				'heading' => esc_html__( 'PanX', 'infinite-addons' ),
				'description' => esc_html__( 'Enable PanX', 'infinite-addons' ),
				'value'       => array(
					esc_html__( 'No', 'infinite-addons' ) => '',
					esc_html__( 'Yes', 'infinite-addons') => 'yes',
				),
				'dependency'  => array(
					'element' => 'enable_panr_effect',
					'value'   => 'yes'
				),
				'std'         => 'yes',
				'group'       => esc_html__( 'Effects', 'infinite-addons' ),
				'weight'      => 1,
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type' => 'dropdown',
				'param_name' => 'pany',
				'heading' => esc_html__( 'PanY', 'infinite-addons' ),
				'description' => esc_html__( 'Enable PanY', 'infinite-addons' ),
				'value'       => array(
					esc_html__( 'No', 'infinite-addons' ) => '',
					esc_html__( 'Yes', 'infinite-addons') => 'yes',
				),
				'dependency'  => array(
					'element' => 'enable_panr_effect',
					'value'   => 'yes'
				),
				'std'         => 'yes',
				'group'       => esc_html__( 'Effects', 'infinite-addons' ),
				'weight'      => 1,
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type' => 'textfield',
				'param_name' => 'panduration',
				'heading' => esc_html__( 'Pan Duration', 'infinite-addons' ),
				'description' => esc_html__( 'panning in seconds on mouse move, ex. 1.25', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'enable_panr_effect',
					'value'   => 'yes'
				),
				'std'         => '1.25',
				'group'       => esc_html__( 'Effects', 'infinite-addons' ),
				'weight'      => 1,
			),

		);

		vc_add_params( 'vc_single_image', $params );

		vc_update_shortcode_param( 'vc_single_image', array(
		'type' => 'dropdown',
		'heading' => esc_html__( 'Link Target', 'infinite-addons' ),
		'param_name' => 'img_link_target',
		'value' => array(
			esc_html__( 'Same window', 'infinite-addons' ) => '_self',
			esc_html__( 'New window', 'infinite-addons' ) => '_blank',
			esc_html__( 'Lightbox', 'infinite-addons' )    => 'lightbox'
		),
		'dependency' => array(
			'element' => 'onclick',
			'value' => array(
				'custom_link',
				'img_link_large',
			),
		),

	));
}
rella_extends_vc_single_image();

function rella_extends_vc_column_text() {

	$params = array(

		array(
			'type'        => 'checkbox',
			'param_name'  => 'fill',
			'heading'     => esc_html__( 'Fill Effect', 'infinite-addons' ),
			'description' => esc_html__( 'If checked the fill effect will be enabled', 'infinite-addons' ),
			'value'       => array( esc_html__( 'Yes', 'infinite-addons' ) => 'yes' ),
			'edit_field_class' => 'vc_column-with-padding vc_col-sm-6',
		),

		array(
			'type' => 'dropdown',
			'param_name' => 'tag',
			'heading' => esc_html__( 'Tag', 'infinite-addons' ),
			'description' => esc_html__( 'Select tag to aplly the fill effect on it', 'infinite-addons' ),
			'value' => array(
				'h1',
				'h2',
				'h3',
				'h4',
				'h5',
				'h6',
				'p',
				'div',
			),
			'dependency' => array(
				'element' => 'fill',
				'not_empty' => true,
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
	);

	vc_add_params( 'vc_column_text', $params );
}
rella_extends_vc_column_text();
