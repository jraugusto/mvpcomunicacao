<?php

extract( $atts );

$classes = array( 'rella-js-raw-code', $el_class, $this->get_id() );
?>


<div id="<?php echo $this->get_id() ?>" class="<?php echo ra_helper()->sanitize_html_classes( $classes ) ?>">
	<div class="wpb_wrapper">
		<?php $this->get_content(); ?>
	</div>
</div>