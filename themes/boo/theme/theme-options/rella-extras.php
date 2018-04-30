<?php
/*
 * Extras Section
*/

$this->sections[] = array(
	'title'  => esc_html__('Extras', 'boo'),
	'icon'   => 'el-icon-cogs'
);

include_once( get_template_directory() . '/theme/theme-options/rella-page-search.php' );
include_once( get_template_directory() . '/theme/theme-options/rella-page-404.php' );
include_once( get_template_directory() . '/theme/theme-options/rella-page-maintenance.php' );
