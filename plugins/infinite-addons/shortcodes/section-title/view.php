<?php

extract( $atts );

$sc_js = $this->load_js_sc();

// Enqueue Conditional Script
$this->scripts( $sc_js );

$id = ( $el_id ) ? ' id="' . esc_attr( $el_id ) . '"' : '';
$classes = array( 'section-title', $this->get_style_class( $style ), $alignment, $transform, $scheme, $el_class, $_id, trim( vc_shortcode_custom_css_class( $css ) ) );

$c_tag = array(
	'numerical' => 'h6',
	'numerical-alt' => 'h6',
);

$h_fonts = $this->get_heading( 'title', 'h2' );
$c_fonts = $this->get_heading( 'content', isset( $c_tag[$style] ) ? $c_tag[$style] : 'p' );

$this->generate_css( $h_fonts, $c_fonts );

?>
<header<?php echo $id; ?> class="<?php echo ra_helper()->sanitize_html_classes( $classes ); ?>" <?php $this->get_title_effect(); ?>>
	<?php

		if( 'sep' === $style ) {
			$this->get_content( $c_fonts );
			echo '<hr>';
			$this->get_title( $h_fonts );
			$this->get_description();
		}
		elseif( 'numerical' === $style || 'numerical-alt' === $style || 'classic2' === $style || 'classic3' === $style || 'classic4' === $style || 'classic5' === $style ) {
			$this->get_content( $c_fonts );
			$this->get_title( $h_fonts );
			$this->get_description();
		}
		elseif( 'underline3' === $style ) {
			$this->get_content( $c_fonts );
			$this->get_title( $h_fonts );
			echo '<hr>';
			$this->get_description();
			$this->get_button();
		}
		else {
			$this->get_title( $h_fonts );
			if( 'underline2' === $style || 'underline5' === $style ) {
				echo '<hr>';
			}
			$this->get_content( $c_fonts );
			
			$this->get_description();
			$this->get_button();
		}
	?>
</header>