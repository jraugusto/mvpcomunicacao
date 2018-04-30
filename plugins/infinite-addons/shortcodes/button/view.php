<?php
extract( $atts );

$icon = rella_get_icon( $atts );

// check
if( ! $title && ! isset( $icon['icon'] ) ) {
	return;
}

// Enqueue Conditional Script
$this->scripts();

$classes = array( 'btn', $style, $shape, $size, $border, $fix_v_line, $others, $el_class, $text, $this->get_id(), $this->vline_direction(), $this->get_icon_pos(), $this->get_liniar(), $this->if_lightbox(), $this->hover_curtain_effect(), trim( vc_shortcode_custom_css_class( $css ) ) );

$this->generate_css();

$attributes = rella_get_link_attributes( $link, '#' );
$attributes['class'] = ra_helper()->sanitize_html_classes( $classes );
?>
<a<?php echo ra_helper()->html_attributes( $attributes ) ?> <?php $this->get_lightbox_data(); ?>>
	<?php
		if ( ! empty( $other ) ) {
			echo wp_kses_post( do_shortcode( $other ) );
		}
	?>
	<?php
		if( 'btn-boxed' === $style ) {
			printf( '<span></span>' );
		}
	?>
	<?php if( 'none' !== $curtain_hover ) { ?>
		<span class="btn-curtain"></span>
	<?php } ?>
	<span>
	<?php

		if( $icon['type'] && 'left' == $icon['align'] ) {
			printf( '<i class="%s"></i>', $icon['icon'] );
		}

		echo wp_kses_post( do_shortcode( $title ) );

		if( $icon['type'] && 'right' == $icon['align'] ) {
			printf( '<i class="%s"></i>', $icon['icon'] );
		}
	?>
	</span>
</a>
