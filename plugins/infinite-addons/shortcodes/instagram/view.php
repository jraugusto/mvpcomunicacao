<?php

extract( $atts );

$classes = array( 'widget', $this->get_class( $template ), $el_class, $this->get_stretch(), $this->get_columns(), $this->get_id(), trim( vc_shortcode_custom_css_class( $css ) ) );

?>

<div id="<?php echo $this->get_id(); ?>" class="<?php echo ra_helper()->sanitize_html_classes( $classes ); ?>">

	<ul class="instagram_feed_list">
		<?php $this->get_images(); ?>
	</ul>
	
	<?php $this->get_button() ?>

</div><!-- /.widget_instagram_feed -->