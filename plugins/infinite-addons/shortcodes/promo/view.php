<?php

extract( $atts );

// classes
$classes = array( 'promo', $el_class, $this->get_id() );
// Enqueue Conditional Script
$this->scripts();
$this->generate_css();

?>

<div class="<?php echo ra_helper()->sanitize_html_classes( $classes ) ?>" id="<?php echo $this->get_id(); ?>">
	<p>
		<?php $this->get_title(); ?>
		<?php $this->get_content() ?>
	</p>
</div>
