<?php
extract( $atts );

// Enqueue Conditional Script
$this->scripts();

$classes = array( $effect, $el_class, $this->get_id() );

$this->generate_css();
?>
<figure class="<?php echo ra_helper()->sanitize_html_classes( $classes ) ?>" <?php echo $this->get_data_mh(); ?>>
	<?php $this->get_image(); ?>
</figure>