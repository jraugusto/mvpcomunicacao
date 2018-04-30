<?php

extract( $atts );

$classes = array( $this->get_class( $style ), $align, $el_class, $this->get_id() );
// Enqueue Conditional Script
$this->scripts();
$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ra_helper()->sanitize_html_classes( $classes ) ?>">

	<?php $this->get_avatar() ?>

	<div class="media-body">
		<?php $this->get_quote() ?>
		<?php $this->get_details() ?>
	</div>

</div>