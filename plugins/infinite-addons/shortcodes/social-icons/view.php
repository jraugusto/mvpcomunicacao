<?php

extract( $atts );

$identities = vc_param_group_parse_atts( $identities );

if( empty( $identities ) )
	return;

$classes = array( 'social-icon', $style, $shape, $visibility, $scheme, $size, $orientation, $text_transform, $el_class, $this->get_id(), $this->get_animation() );
// Enqueue Conditional Script
$this->scripts();
$this->generate_css();

?>
<ul class="<?php echo ra_helper()->sanitize_html_classes( $classes ) ?>" id=<?php echo $this->get_id() ?>>
<?php
	foreach ( $identities as $social ) {
		if ( empty( $social['url'] ) ) {
			continue;
		}

		$net = rella_get_network_class( $social['network'] );
		$attr = array( 'href' => esc_url( $social['url'] ), 'target' => '_blank' );

		if( 'text-only' === $style ) {
			printf( '<li><a%s>%s</a></li>',
				ra_helper()->html_attributes( $attr ), $net['text']
			);
		}
		else {
			printf( '<li><a%s><i class="%s"></i></a></li>',
				ra_helper()->html_attributes( $attr ), $net['icon']
			);
		}
	}
?>
</ul>
