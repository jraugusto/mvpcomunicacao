<?php
$classes = array( $this->get_class( $atts['style'] ), $atts['el_class'], $this->get_id() );
// Enqueue Conditional Script
$this->scripts();
$this->generate_css();
?>
<div class="<?php echo ra_helper()->sanitize_html_classes( $classes ); ?>">
	<?php
		if( 's13' !== $atts['style'] ) {
			$this->get_nav();
		}
	?>
	<?php $this->get_content() ?>
	<?php
		if( 's13' === $atts['style'] ) {
			$this->get_nav();
		}
	?>
</div>
