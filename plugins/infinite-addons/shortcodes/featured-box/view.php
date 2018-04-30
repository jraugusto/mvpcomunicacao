<?php

extract( $atts );

$classes = array( 'featured-box', $this->get_class( $style ), $el_class, $this->get_id() );

// Enqueue Conditional Script
$this->scripts();

$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ra_helper()->sanitize_html_classes( $classes ) ?>">

	<figure>
	
		<?php $this->get_image(); ?>
		<?php $this->get_ribbon(); ?>
		<?php $this->get_price(); ?>
	
	</figure>

	<div class="featured-box-content">

		<?php $this->get_title(); ?>
		<?php $this->get_info(); ?>

	</div><!-- /.featured-box-content -->
</div><!-- /.featured-box -->