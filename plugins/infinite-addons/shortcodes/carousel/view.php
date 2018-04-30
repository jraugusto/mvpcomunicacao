<?php
extract( $atts );

// Enqueue Conditional Script
$this->scripts();

$classes = array( $this->get_class( $style ), $this->get_size_dots(), $this->get_align_dots(), $el_class, $this->get_id() );

$this->generate_css();
 
$this->get_swipe_hint();
?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ra_helper()->sanitize_html_classes( $classes ); ?>"<?php $this->get_options() ?>>

	<?php $this->get_nav( 'top' ); ?>

	<div class="row carousel-items <?php $this->get_vertical_offset() ?>">
	<?php
		$this->columnize_content( $content );
		echo ra_helper()->do_the_content( $content );
	?>
	</div>

	<?php $this->get_nav( 'bottom' ); ?>

</div>