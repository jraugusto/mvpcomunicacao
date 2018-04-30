<?php

extract( $atts );

// Enqueue Conditional Script
$this->scripts();

$attributes = rella_get_link_attributes( $link );
$attributes['class'] = 'navbar-brand' . ( $el_class ? ' ' . $el_class: '' );

$img = $logo ? rella_get_image( $logo ) : rella_helper()->get_option( 'header-logo' );

if( is_array( $img ) && !empty( $img['url'] ) ) {
	$img = esc_url( $img['url'] );
}

$retina_img = $data_retina = '';
$retina_img = $retina_logo ? rella_get_image( $retina_logo ) : rella_helper()->get_option( 'header-logo-retina' );

if( is_array( $retina_img ) && !empty( $retina_img['url'] ) ) {
	$retina_img = esc_url( $retina_img['url'] );
}

if( $retina_img ) {
	$data_retina = 'data-rjs=' . $retina_img;
}

if( !$img ) return;

?>
<a<?php echo ra_helper()->html_attributes( $attributes ) ?>>
	<span class="brand-inner">
		<img src="<?php echo $img ?>" alt="Logo" <?php echo $data_retina; ?>>
	</span>
</a>
