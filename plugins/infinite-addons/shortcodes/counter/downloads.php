<?php
extract( $atts );

// classes
$classes = array( $this->get_class( $style ), $el_class, $this->get_id() );

// Enqueue Conditional Script
$this->scripts();

$this->generate_css();
?>
<div id="<?php echo $this->get_id(); ?>" class="<?php echo ra_helper()->sanitize_html_classes( $classes ) ?>" style="margin-top:60px; display:block" data-plugin-counter="true">
	<span class="downloads-counter counter-element" style="font-size: 120px; line-height: 1; font-weight: 300"><span><?php echo esc_html( $count ) ?></span></span>
</div>