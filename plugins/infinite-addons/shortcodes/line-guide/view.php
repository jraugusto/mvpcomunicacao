<?php

extract( $atts );

// Enqueue Conditional Script
$this->scripts();

$items   = vc_param_group_parse_atts( $items );

$classes = array( 'line-guide', $el_class, $this->get_id(), trim( vc_shortcode_custom_css_class( $css ) ) );

?>

<div class="<?php echo ra_helper()->sanitize_html_classes( $classes ) ?>" id=<?php echo $this->get_id() ?>>
	
	<?php foreach ( $items as $line ) { 

		$pos   = $line['position'];
		$value = isset( $line['position_value'] ) ? esc_attr( $line['position_value'] ) : '';

	?>
	
		<span class="line <?php echo ra_helper()->sanitize_html_classes( $line['direction'] ) ?>" <?php echo $this->get_position( $pos, $value ); ?>>
			<span data-lettering="true" data-plugin-options='{ "animateOnAppear": true }'><?php echo esc_html( $line['label'] ); ?></span>
		</span>

	<?php } ?>

	<?php $this->get_image(); ?>

</div>