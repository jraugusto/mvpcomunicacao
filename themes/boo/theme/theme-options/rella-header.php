<?php
/*
 * Header Section
*/

$this->sections[] = array(
	'title'  => esc_html__('Header', 'boo'),
	'icon'   => 'el-icon-photo'
);

include_once( get_template_directory() . '/theme/theme-options/rella-header-layout.php' );
include_once( get_template_directory() . '/theme/theme-options/rella-header-menu.php' );
include_once( get_template_directory() . '/theme/theme-options/rella-header-title-wrapper.php' );
