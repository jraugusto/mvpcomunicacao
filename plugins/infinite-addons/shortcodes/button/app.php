<?php
extract( $atts );

// Enqueue Conditional Script
$this->scripts();

// check
if( ! $title ) {
	return;
}

$classes = array( 'btn', $style, $shape, $size, $fix_v_line, $border, $others, $el_class, $text, $this->get_id(), $this->get_liniar(), $this->if_lightbox(), $this->get_icon_pos(), trim( vc_shortcode_custom_css_class( $css ) ) );

$this->generate_css();

$attributes = rella_get_link_attributes( $link, '#' );
$attributes['class'] = ra_helper()->sanitize_html_classes( $classes );
?>
<a<?php echo ra_helper()->html_attributes( $attributes ) ?> <?php $this->get_lightbox_data(); ?>>
	<?php
		$icon = rella_get_icon( $atts );

		if( $icon['type'] && 'left' == $icon['align'] ) {
			printf( '<i class="%s"></i>', $icon['icon'] );
		}
	?>
	<span>
	<?php
		if ( ! empty( $other ) ) {
			echo '<small>' . wp_kses_post( do_shortcode( $other ) ) . '</small>' ;
		}
		echo wp_kses_post( do_shortcode( $title ) );
	?>
	</span>
	<?php
		if( $icon['type'] && 'right' == $icon['align'] ) {
			printf( '<i class="%s"></i>', $icon['icon'] );
		}
	?>
</a>
