<?php

extract( $atts );

// Enqueue Conditional Script
$this->scripts();

// classes
$classes = array( $this->get_class( $style ), $el_class, $this->get_id() );

$this->generate_css();

?>

<div id="<?php echo $this->get_id(); ?>" class="<?php echo ra_helper()->sanitize_html_classes( $classes ) ?>" data-plugin-progressbar="true" data-plugin-options='{ "percent": <?php echo intval( $count ) ?> }'>

	<?php if( $label ): ?>
	<span class="progressbar-title"><?php echo esc_html( $label ) ?></span>
	<?php endif; ?>

	<?php if ( 'hexa' == $style ): ?>
	<div class="polygon-container">
		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="49" height="54.781" viewBox="0 0 49 54.781">
			<path d="M18.832,52.409 C14.783,49.943 10.693,47.548 6.562,45.226 C2.431,42.903 0.406,39.347 0.488,34.558 C0.570,29.769 0.570,24.981 0.488,20.192 C0.406,15.403 2.431,11.848 6.562,9.524 C10.693,7.202 14.783,4.807 18.832,2.341 C22.882,-0.125 26.931,-0.125 30.980,2.341 C35.029,4.807 39.119,7.202 43.251,9.524 C47.382,11.848 49.406,15.403 49.324,20.192 C49.243,24.981 49.243,29.769 49.324,34.558 C49.406,39.347 47.382,42.903 43.251,45.226 C39.119,47.548 35.029,49.943 30.980,52.409 C26.931,54.875 22.882,54.875 18.832,52.409 Z" class="cls-1">
		</svg>
	</div>
	<?php endif; ?>

</div>