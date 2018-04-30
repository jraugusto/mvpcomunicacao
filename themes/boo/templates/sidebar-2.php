<?php
	$sidebar_fixed = '';
	if( 'on' === rella_helper()->get_option( 'rella-sidebar-fixed' ) ) {
		$sidebar_fixed = 'data-sticky-element="true" data-plugin-sticky-options=\'{ "limitElement": ".container" }\'';	
	}
?>
<div class="col-md-3 sidebar-container">
	<aside class="main-sidebar" <?php echo $sidebar_fixed; ?>>
		<?php dynamic_sidebar( rella()->layout->sidebars['sidebar_1'] ) ?>
	</aside>
</div>
