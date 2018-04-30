<?php
extract( $atts );

// Enqueue Conditional Script
$this->scripts();

// check
if( empty( $id ) ) {
	return;
}

$this->generate_css();

$classes = array( $this->get_class( $style ), $this->get_id() );

$replace = array( 'class="wpcf7"' );
$with = array( 'class="wpcf7"' );

if( ! empty( $btn ) ) {
	$replace[] = 'class="wpcf7-form-control wpcf7-submit"';
	$with[] = 'class="'. $btn .' wpcf7-form-control wpcf7-submit"';
}

$form = do_shortcode( sprintf( '[contact-form-7 id="%d"]', intval( $id ) ) );

// Integrate Icon
$icon = rella_get_icon( $atts );
if( $icon['type'] && 'left' == $icon['align'] ) {
	$form = str_replace( 'wpcf7-form-control wpcf7-submit">', sprintf( 'wpcf7-form-control wpcf7-submit"><i class="%s"></i> ', $icon['icon'] ), $form );
}

if( $icon['type'] && 'right' == $icon['align'] ) {
	$form = str_replace( '</button>', sprintf( ' <i class="%s"></i></button>', $icon['icon'] ), $form );
}
?>
<div class="<?php echo ra_helper()->sanitize_html_classes( $classes ) ?>">
	<?php echo str_replace( $replace, $with, $form ); ?>
</div>