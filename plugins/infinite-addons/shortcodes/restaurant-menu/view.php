<?php

extract( $atts );

$items = vc_param_group_parse_atts( $items );
// Enqueue Conditional Script
$this->scripts();
// classes
$classes = array( 'restaurant-menu', $el_class, $this->get_id() );

?>

<div class="<?php echo ra_helper()->sanitize_html_classes( $classes ) ?>" id="<?php echo $this->get_id() ?>">

	<?php $this->get_title(); ?>

	<?php foreach ( $items as $item ) { ?>
	<div class="item">
		<h5 class="item-title">
			<span class="item-heading"><?php echo esc_html( $item['item_title'] ); ?></span>
			<span class="item-price"><?php echo esc_html( $item['price'] ); ?></span>
		</h5>
		<p><?php echo esc_html( $item['description'] ); ?></p>
	</div>
	<?php } ?>
	
</div>