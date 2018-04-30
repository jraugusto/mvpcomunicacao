<?php

extract( $atts );

$classes_arr = $this->get_style_class( $template );
$sb = ! empty ( $side_border ) ? $classes_arr[1] : $classes_arr[0];

// classes
$classes = array( $sb, $el_class, $this->get_id() );
// Enqueue Conditional Script
$this->scripts();
$this->generate_css();

?>
<div class="team-member <?php echo ra_helper()->sanitize_html_classes( $classes ) ?>" id="<?php echo $this->get_id() ?>">

	<?php $this->get_image() ?>

	<div class="team-member-details">
		<?php $this->get_name() ?>
		<?php $this->get_position() ?>
		<hr />
		<?php $this->get_content() ?>
	</div>

	<?php $this->get_social() ?>

</div>
