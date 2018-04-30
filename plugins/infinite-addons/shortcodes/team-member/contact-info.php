<?php

extract( $atts );

// classes
$classes = array( $this->get_style_class( $template ), $el_class, $this->get_id() );
// Enqueue Conditional Script
$this->scripts();
$this->generate_css();

?>
<div class="team-member <?php echo ra_helper()->sanitize_html_classes( $classes ) ?>" id="<?php echo $this->get_id() ?>">

	<?php $this->get_image() ?>

	<div class="team-member-details">
		<?php $this->get_name() ?>
		<?php $this->get_position() ?>
		<?php $this->get_content() ?>
		<?php if ( ! empty( $phone ) || ! empty( $emal ) ) { ?>
			<hr />
		<?php } ?>
		<?php if ( ! empty( $phone ) ) { ?>
			<p><span class="fa fa-phone"></span> <?php echo esc_html__( $phone ); ?></p>
		<?php } ?>
		<?php if ( ! empty( $email ) ) { ?>
			<p><span class="fa fa-envelope-o"></span> <?php echo esc_html__( $email ); ?></p>
		<?php } ?>
	</div>

</div>
