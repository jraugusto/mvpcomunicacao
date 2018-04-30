<?php
extract( $atts );

// Enqueue Conditional Script
$this->scripts();

$mobile_classname = ( 'phone-1' === $mockup ? 'mobile-mockup-1' : 'mobile-mockup-2' );
$classes = array( $mobile_classname, $this->get_class( $style ), $el_class, $this->get_id() );

$this->generate_css();
?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ra_helper()->sanitize_html_classes( $classes ); ?>">

	<div class="carousel row" data-flickity='{ "wrapAround": true , "prevNextButtons": false, "groupCells": false, "cellAlign": "center", "contain": false , "cellSelector": ".carousel-cell", "pageDots": true }'>
	<?php
		$this->columnize_content( $content );
		echo ra_helper()->do_the_content( $content );
	?>
	</div><!-- /.carousel-items -->

	<figure class="carousel-phone-bg">
		<img src="<?php echo get_template_directory_uri() . '/assets/img/mockups/' . $mockup . '.png'  ; ?>">
	</figure>

</div><!-- /.carousel-device -->