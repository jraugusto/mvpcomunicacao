<?php
/*
 * Export options
*/

$this->sections[] = array(
	'title' => esc_html__( 'Import/Export', 'boo' ),
	'desc' => esc_html__( 'Import/Export Options', 'boo' ),
	'icon' => 'el-icon-arrow-down',
	'fields' => array(		

		array(
			'id'            => 'opt-import-export',
			'type'          => 'import_export',
			'title'         => esc_html__( 'Import Export', 'boo' ),
			'subtitle'      => esc_html__( 'Save and restore your Redux options', 'boo' ),
			'full_width'    => false,
		),
	),
);