<?php

extract( $atts );

// Enqueue Conditional Script
$this->scripts();

$titles = vc_param_group_parse_atts( $titles );

if( empty( $titles ) ) {
	return;
}

$this->generate_css();

?>
<div class="typed <?php echo $this->get_id() ?>" data-plugin-typed="true" data-plugin-options='{}'>
	<?php $this->before_text(); ?>
	<div class="typed-strings">
		<?php foreach( $titles as $item ) : ?>
			<span><?php echo $item['title'] ?></span>
		<?php endforeach; ?>
	</div><!-- /.typed-strings -->

	<div class="typed-element"></div><!-- /.typed-element -->
	<?php $this->after_text(); ?>
</div>