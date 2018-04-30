<?php

extract( $atts );

// Enqueue Conditional Script
$this->scripts();

// classes
$classes = array( $this->get_class( $style ), $el_class, $this->get_id() );

?>
<div class="<?php echo ra_helper()->sanitize_html_classes( $classes ) ?>" id="<?php echo $this->get_id(); ?>">

<?php $this->generate_css() ?>

	<div class="bar"></div>

	<div class="history-inner">

		<?php $this->get_image() ?>

		<div class="history-content">

			<?php if ( 's1' == $style ): ?>

				<?php $this->get_year() ?>
				<?php $this->get_icon() ?>
				<?php $this->get_title() ?>

			<?php else: ?>

				<?php $this->get_title() ?>
				<?php $this->get_icon() ?>
				<?php $this->get_year() ?>

			<?php endif; ?>

			<?php $this->get_content() ?>

		</div>

	</div>

</div>
