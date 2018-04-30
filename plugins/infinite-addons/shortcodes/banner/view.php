<?php

extract( $atts );

// Enqueue Conditional Script
$this->scripts();

$classes = array( 'banner', $this->get_class( $style ), $el_class, $this->get_id(), trim( vc_shortcode_custom_css_class( $css ) ) );

?>

<div id="<?php echo $this->get_id() ?>" class="<?php echo ra_helper()->sanitize_html_classes( $classes ); ?>">

	<?php if ( in_array( $style, array( 's11' ) ) ) { ?>
		<div class="banner-inner">
	<?php  } ?>
	<?php if ( in_array( $style, array( 's8' ) ) ) { ?>
		<div class="banner-container">
	<?php  } ?>

		<?php echo ra_helper()->do_the_content( $content, false ); ?>

	<?php if ( in_array( $style, array( 's8', 's11' ) ) ) { ?>
		</div>
	<?php } ?>

</div>