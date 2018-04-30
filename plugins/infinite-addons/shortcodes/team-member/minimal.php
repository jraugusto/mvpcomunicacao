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
		<?php if ( ! empty( $phone ) ) : ?>
		<div class="icon-box icon-box-side icon-middle icon-box-ci icon-box-xxsm icon-box-heading-xxsm">

			<span class="icon-container">
				<i class="fa fa-phone"></i>
			</span>

			<div class="contents">
				<p><?php echo esc_html( $phone ) ?></p>
			</div>

		</div>
		<?php endif; ?>

	</div>
</div>
