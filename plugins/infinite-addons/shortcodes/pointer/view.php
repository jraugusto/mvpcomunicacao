<?php

// check
if( ! rella_helper()->is_woocommerce_active() ) {
	return;
}

extract( $atts );

$classes = array( $position, $el_class, $this->get_id() );

$this->generate_css();

// Enqueue Conditional Script
$this->scripts();

?>

<div id="<?php echo $this->get_id(); ?>" class="info-box <?php echo ra_helper()->sanitize_html_classes( $classes ); ?>">

	<?php $this->get_info(); ?>
	<?php $this->add_to_cart(); ?>
	<span class="border"></span>

</div><!-- /.info-box -->