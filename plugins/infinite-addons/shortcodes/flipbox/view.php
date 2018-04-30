<?php
extract( $atts );

$classes = array( 'flipbox', $direction, $atts['el_class'], $this->get_id() );

// Enqueue Conditional Script
$this->scripts();
$this->generate_css();

?>
<div class="<?php echo ra_helper()->sanitize_html_classes( $classes ); ?>" <?php echo $this->get_effect(); ?>>
	<div class="flipbox-container" <?php echo $this->get_stacking_factor() ?>>
		<?php $this->get_content() ?>
	</div>
</div>