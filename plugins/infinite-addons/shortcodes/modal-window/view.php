<?php

extract( $atts );

$classes = array( 'rella-modal', 'mfp-hide' , $el_class );

?>

<div id="<?php echo $this->get_id(); ?>" class="<?php echo ra_helper()->sanitize_html_classes( $classes ); ?>">
	<div class="container">
		
			<?php echo ra_helper()->do_the_content( $content, false ); ?>
		
			<div class="close-btn-container">
		
				<a href="#" class="btn btn-solid btn-sm round" onclick="jQuery.magnificPopup.close()"><span><?php esc_html_e( 'Close', 'infinite-addons' ); ?></span></a>
		
			</div><!-- /.close-btn-container -->
	</div><!-- /.container -->
</div><!-- /.white-popup mfp-hide -->