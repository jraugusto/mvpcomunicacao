<?php

extract( $atts );

// classes
$classes = array( $this->get_style_class( $template ), $el_class, $this->get_id() );
// Enqueue Conditional Script
$this->scripts();
$this->generate_css();

?>
<div class="team-member <?php echo ra_helper()->sanitize_html_classes( $classes ) ?>" id="<?php echo $this->get_id() ?>">

	<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100px" x="0px" y="0px" viewbox="0 0 74 7" style="enable-background:new 0 0 74 7;" xml:space="preserve">
		<path style="fill-rule:evenodd;clip-rule:evenodd;" d="M57.7,5c-6.2-1.6-13.5-5-20.8-5c-7.2,0-14.4,3.3-20.5,4.8C11.2,6.1,5.3,6.7,0,7v0h72.4 C67.4,6.7,62.2,6.1,57.7,5z" />
	</svg>

	<?php $this->get_position() ?>
	<?php $this->get_image() ?>

	<div class="team-member-details">
		<?php $this->get_name() ?>
		<?php $this->get_content() ?>
	</div>

	<?php $this->get_social() ?>

</div>
