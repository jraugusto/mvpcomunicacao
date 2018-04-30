<?php

$classes = array( 'pricing-table', 'features-table', $this->get_class( $atts['style'] ), $atts['el_class'], $this->get_id() );
// Enqueue Conditional Script
$this->scripts();
$this->generate_css();

?>
<div class="<?php echo ra_helper()->sanitize_html_classes( $classes ); ?>">
	<div class="pricing-table-inner text-right">
		<header>
			<?php $this->get_title() ?>
			<?php $this->get_figure() ?>
			<?php $this->get_icon() ?>
		</header>
		<?php $this->get_features() ?>
		<div class="spacing">Hidden</div>
	</div>
</div>
