<?php

extract( $atts );

$sc_js = $this->load_js_sc();

// Enqueue Conditional Script
$this->scripts( $sc_js );

// classes
$classes = array( $this->get_class( $template ), $this->get_shape( $background_shape ), $this->get_shape_size(), $heading_size, $position, $alignment, $valignment, $this->get_counter_classes(), $el_class, $this->get_id(), trim( vc_shortcode_custom_css_class( $css ) ) );

$this->generate_css();

?>

<div class="<?php echo ra_helper()->sanitize_html_classes( $classes ) ?>" <?php $this->get_title_effect() ?> id="<?php echo $this->get_id(); ?>"<?php echo ! empty( $this->atts['counter'] ) ? ' data-plugin-counter="true"' : '' ?>>

	<?php $this->get_the_icon() ?>

	<?php if( 'icon-box-inline' === $position ) {
		$this->get_title();
	} ?>

	<?php echo $this->before_icon_box_content() ?>

		<?php $this->get_counter() ?>
		<?php if( 'icon-box-inline' !== $position ) { $this->get_title(); } ?>
		<?php $this->get_content() ?>
		<?php $this->get_rating() ?>
		<?php $this->get_button() ?>

	<?php echo $this->after_icon_box_content() ?>

</div>
