<?php

extract( $atts );

//add icon shape size
$size = ( ! empty ( $size ) && 'custom' !== $size ) ? 'counter-box-' . $size : '';

// classes
$classes = array( $this->get_class( $style ), $size, $align, 'text-uppercase', $el_class, $this->get_id() );

// Enqueue Conditional Script
$this->scripts();

$this->generate_css();

?>

<div id="<?php echo $this->get_id(); ?>" class="<?php echo ra_helper()->sanitize_html_classes( $classes ) ?>" data-plugin-counter="true">

	<div class="contents">

		<?php if( $label ): ?>
			<p class="weight-bold"><?php echo esc_html( $label ) ?></p>
		<?php endif; ?>

		<h3 class="counter-element <?php echo $counter_weight; ?>">
			<?php echo esc_html( $prefix ) ?><span class="weight-medium"><?php echo esc_html( $count ) ?></span><?php echo esc_html( $suffix ) ?>
		</h3>

	</div>

</div>