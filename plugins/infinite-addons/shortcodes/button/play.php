<?php
extract( $atts );

// Enqueue Conditional Script
$this->scripts();

$classes = array( 'lightbox-play-button lightbox-link', $text, $alt_size, $fix_v_line, $others, $el_class, $this->get_id(), $this->get_liniar(), $this->if_lightbox(), trim( vc_shortcode_custom_css_class( $css ) ) );

$this->generate_css();

$attributes = rella_get_link_attributes( $link, '#' );
$attributes['class'] = ra_helper()->sanitize_html_classes( $classes );

?>
<a<?php echo ra_helper()->html_attributes( $attributes ) ?> <?php $this->get_lightbox_data(); ?>>
	<i>
		<?php
			if ( ! empty( $other ) ) {
				echo '<span class="btn-text"><span>' . $other . '</span></span>';
			}
		?>
		<span class="btn-icon"><i class="fa fa-play"></i></span>
	</i>
	<span>
	<?php
		if( ! empty( $title ) ) {
			echo wp_kses_post( do_shortcode( $title ) ) ;
		}
	?>
	<?php

		$icon = rella_get_icon( $atts );
		if( $icon['type'] ) {
			printf( ' <i class="%s"></i>', $icon['icon'] );
		}
	?>
	</span>
</a>
