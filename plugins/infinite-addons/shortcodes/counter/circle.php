<?php

extract( $atts );

// classes
$classes = array( 'counter-box progressbar-circle counter-box-xlg text-center text-uppercase', $el_class, $this->get_id() );

$this->generate_css();

wp_enqueue_script( 'circle-progress' );
// Enqueue Conditional Script
$this->scripts();
?>

<div id="<?php echo $this->get_id(); ?>" class="<?php echo ra_helper()->sanitize_html_classes( $classes ) ?>" data-plugin-counter="true" data-percentage="<?php echo intval( $percent ) ?>" data-thickness="25" data-empty-fill="rgba(0, 0, 0, 0)" data-start-color="<?php echo esc_attr( $start_color ); ?>" data-end-color="<?php echo esc_attr( $end_color ); ?>">

	<div class="contents">

		<h3 class="counter-element weight-semibold">
			<?php echo esc_html( $prefix ) ?><span><?php echo esc_html( $count ) ?></span><?php echo esc_html( $suffix ) ?>
		</h3>

		<?php if( $label ): ?>
		<p class="weight-bold"><?php echo esc_html( $label ) ?></p>
		<?php endif; ?>

	</div><!-- /.contents -->
	<div class="progressbar-inner"></div>
</div>
