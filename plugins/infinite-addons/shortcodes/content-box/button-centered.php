<?php

extract( $atts );

$classes = array( 'content-box', $this->get_class( $style ), $el_class, $this->get_id() );
$this->generate_css();

$sc_js = $this->load_js_sc();

// Enqueue Conditional Script
$this->scripts( $sc_js );
?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ra_helper()->sanitize_html_classes( $classes ) ?>">
	
	<?php $this->get_image(); ?>
	<?php $this->get_button(); ?>

</div>
