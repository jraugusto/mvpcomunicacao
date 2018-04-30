<?php

extract( $atts );
// Enqueue Conditional Script
$this->scripts();
$classes = array( 'shop-banner', $this->get_class( $style ), $el_class, $this->get_id(), trim( vc_shortcode_custom_css_class( $css ) ) );

$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ra_helper()->sanitize_html_classes( $classes ); ?>">

	<div class="shop-banner-inner">

		<?php $this->get_image(); ?>
		<div class="contents">	
			<?php echo ra_helper()->do_the_content( $content ); ?>
		</div><!-- /.contents -->

	</div><!-- /.shop-banner-inner -->

</div>