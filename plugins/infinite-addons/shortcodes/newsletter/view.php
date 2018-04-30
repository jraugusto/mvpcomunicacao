<?php

extract( $atts );

// Enqueue Conditional Script
$this->scripts();

$classes = array( $this->get_class( $style ), $this->get_btn_class( $btn_style ), $inputs_size, $this->if_icon(), $inputs_radius, $inputs_border, $inputs_shadow, $btn_state, $btn_position, $el_class, $this->get_id() );
$this->generate_css();

?>
<div id="<?php echo $this->get_id(); ?>" class="subscribe-form <?php echo ra_helper()->sanitize_html_classes( $classes ); ?>" <?php $this->get_data_plugin(); ?> <?php $this->data_plugin_opts(); ?>>
	<?php echo do_shortcode('[wysija_form id=" ' . $newsletter_id . '"]'); ?>
</div>
