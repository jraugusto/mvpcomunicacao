<?php

$classes = array( 'pricing-table', $this->get_class( $atts['style'] ), $atts['el_class'], $this->get_id() );
// Enqueue Conditional Script
$this->scripts();
$this->generate_css();

?>
<div class="<?php echo ra_helper()->sanitize_html_classes( $classes ); ?>">
	<div class="pricing-table-inner">
		<header>
			<?php $this->get_title() ?>
			<?php $this->get_pricing() ?>
		</header>
		<?php $this->get_ribbon() ?>
		<?php $this->get_figure() ?>
		<footer>
			<?php $this->get_button() ?>
		</footer>
		<?php $this->get_features() ?>
	</div>
</div>
