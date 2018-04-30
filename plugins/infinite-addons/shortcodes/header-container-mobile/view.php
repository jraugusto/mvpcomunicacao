<?php

extract( $atts );

// Enqueue Conditional Script
$this->scripts();

$classes = array( 'mobile-header-container' );

?>

<div class="<?php echo ra_helper()->sanitize_html_classes( $classes ) ?>">

	<?php $this->header_module( $content ); ?>
	<?php echo ra_helper()->do_the_content( $content ); ?>

</div>

