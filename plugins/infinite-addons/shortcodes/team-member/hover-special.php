<?php

extract( $atts );

// classes
$classes = array( $this->get_style_class( $template ), $el_class, $this->get_id() );
// Enqueue Conditional Script
$this->scripts();
$this->generate_css();

?>
<div class="team-member <?php echo ra_helper()->sanitize_html_classes( $classes ) ?>" id="<?php echo $this->get_id() ?>">

	<figure>
		<?php $this->get_image() ?>
	</figure>

	<div class="team-member-details">
		<?php $this->get_social() ?>
		<?php $this->get_name() ?>
		<?php $this->get_position() ?>
	</div><!-- /.team-member-details -->

</div><!-- /.team-member -->