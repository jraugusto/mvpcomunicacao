<?php
	$sidebar_fixed = '';
	$enable_sticky = rella()->layout->sidebars['sticky'];
	if( 'on' === $enable_sticky ) {
		$sidebar_fixed = 'data-sticky-element="true" data-plugin-sticky-options=\'{ "limitElement": ".container" }\'';	
	}	

?>
<div class="col-md-3 col-md-offset-1 sidebar-container">
	<aside class="main-sidebar" <?php echo $sidebar_fixed; ?>>
		<?php dynamic_sidebar( rella()->layout->sidebars['sidebar_1'] ) ?>
	</aside>
</div>