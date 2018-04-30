<?php

extract( $atts );

// Enqueue Conditional Script
$this->scripts();

$classes = array( 'img-maps img-maps-products', $el_class, $this->get_id() );

?>
<div id="<?php echo $this->get_id(); ?>" class="<?php echo ra_helper()->sanitize_html_classes( $classes ); ?>">

	<?php $this->get_image(); ?>

	<div class="contents">
		<?php echo do_shortcode( $content ); ?>
	</div><!-- /.contents -->

</div><!-- /.img-maps -->