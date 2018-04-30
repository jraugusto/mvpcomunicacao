<?php

extract( $atts );

// Enqueue Conditional Script
$this->scripts();

$classes = array( 'box-rounded', $el_class, $this->get_id() );

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ra_helper()->sanitize_html_classes( $classes ); ?>">

	<?php $this->get_tooltip() ?>
	<?php $this->get_image() ?>
	<?php $this->get_title() ?>

</div>