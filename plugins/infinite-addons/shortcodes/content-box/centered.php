<?php

extract( $atts );

$sc_js = $this->load_js_sc();

// Enqueue Conditional Script
$this->scripts( $sc_js );

$classes = array( 'content-box', $this->get_class( $style ), $el_class, $this->get_id() );

$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ra_helper()->sanitize_html_classes( $classes ) ?>">

	<?php $this->get_image(); ?>

	<div class="content-box-content">
		<?php $this->get_title(); ?>
		<?php $this->get_info(); ?>
		<?php $this->get_content(); ?>
	</div><!-- /.content-box-content -->

</div><!-- /.content-box -->