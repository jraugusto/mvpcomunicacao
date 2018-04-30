<?php
extract( $atts );

// Enqueue Conditional Script
$this->scripts();

global $post;

// Hash map
$icon_hash = array(
	'email'   => 'fa fa-envelope-o',
	'phone'   => 'fa fa-phone',
	'address' => 'fa fa-map-marker',
	'chat'    => 'fa fa-comments',
	'hours'   => 'fa fa-clock-o'
);

$style_hash = array(
	'default' => 'contact-info list-inline',
	'big'     => 'contact-info contact-info-big',
	'circle'  => 'contact-info contact-info-circle list-inline',
	'label'   => 'contact-info contact-info-label list-inline'
);

$titles = vc_param_group_parse_atts( $titles );

if( empty( $titles ) ) return;

$class = $style_hash[ $style ];

$this->generate_css();

?>

<ul class="<?php echo $class . ' ' . $this->get_id() ?>">
<?php foreach( $titles as $item ) {
	$out = sprintf( '<li><i class="%s"></i> ', $icon_hash[ $item['type'] ] );

	if( 'big' === $style ) {
		if( !empty( $item['label'] ) ) { $out .= sprintf( '<span class="title">%s</span> ', $item['label'] ); }
		if( !empty( $item['title'] ) ) { $out .= sprintf( '<span class="info">%s</span> ', $item['title'] ); }
	}
	else {

		if( !empty( $item['label'] ) ) { $out .= sprintf( '<span>%s</span> ', $item['label'] ); }
		if( !empty( $item['title'] ) ) { $out .= $item['title']; }
	}

	$out .= '</li>';

	echo $out;
}?>
</ul>