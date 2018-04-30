<?php

extract( $atts );

$sc_js = $this->load_js_sc();

// Enqueue Conditional Script
$this->scripts( $sc_js );

// classes
$classes = array( $this->get_class( $template ), $this->get_shape( $background_shape ), $this->get_shape_size(), $heading_size, $position, $alignment, $el_class, $this->get_id(), trim( vc_shortcode_custom_css_class( $css ) ) );

$this->generate_css();

?>

<div class="<?php echo ra_helper()->sanitize_html_classes( $classes ) ?>" <?php $this->get_title_effect() ?> id="<?php echo $this->get_id(); ?>"<?php echo ! empty( $this->atts['counter'] ) ? ' data-plugin-counter="true"' : '' ?>>

	<div class="icon-wrapper">

		<svg class="circle-gradient-border" width="150" height="150" xmlns="http://www.w3.org/2000/svg"> <defs> <linearGradient y2="1" x2="0" y1="0" x1="0" id="svg_2"> <stop offset="0" stop-opacity="0.996094" stop-color="#00b9ff"></stop> <stop offset="1" stop-opacity="0.996094" stop-color="#007aff"></stop> </linearGradient> </defs> <g> <g display="none" overflow="visible" y="0" x="0" height="100%" width="100%" id="canvasGrid"> <rect fill="url(#gridpattern)" stroke-width="0" y="0" x="0" height="100%" width="100%"></rect> </g> </g> <g> <ellipse class="border" stroke="url(#svg_2)" ry="73.701305" rx="73.701297" id="svg_1" cy="75" cx="74.999999" stroke-width="2" fill="none"></ellipse> <ellipse class="bg" fill="url(#svg_2)" ry="73.701305" rx="73.701297" id="svg_1" cy="75" cx="74.999999" stroke-width="2" fill="none"></ellipse> </g> </svg>

		<?php $this->get_the_icon() ?>

	</div><!-- /.icon-wrapper -->

	<div class="contents">
		<?php $this->get_counter() ?>
		<?php $this->get_title() ?>
		<?php $this->get_content() ?>
    </div>

</div>
