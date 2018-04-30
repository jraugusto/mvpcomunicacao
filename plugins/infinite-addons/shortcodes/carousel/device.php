<?php

extract( $atts );

// Enqueue Conditional Script
$this->scripts();

$classes = array( 'device-mockup-1', $this->get_class( $style ), $el_class, $this->get_id() );

$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ra_helper()->sanitize_html_classes( $classes ); ?>"<?php $this->get_options() ?>>

	<div class="carousel-nav carousel-nav-style11 text-center mb-60">
		<a href='javascript:void(0)' class="btn btn-naked flickity-prev-next-button previous"><i class="fa fa-long-arrow-left"></i></a>
		<a href='javascript:void(0)' class="btn btn-naked flickity-prev-next-button next"><i class="fa fa-long-arrow-right"></i></a>
	</div><!-- /.carousel-nav -->

	<div class="row carousel-items text-center">
	<?php
		$this->columnize_content( $content );
		echo ra_helper()->do_the_content( $content );
	?>
	</div><!-- /.carousel-items -->

	<figure class="carousel-device-bg">
		<img src="<?php echo get_template_directory_uri() . '/assets/img/mockups/laptop-1.png'; ?>">
	</figure>

</div><!-- /.carousel-device -->