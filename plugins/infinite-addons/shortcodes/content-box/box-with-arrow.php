<?php

extract( $atts );

$classes = array( 'content-box', $this->get_class( $style ), $this->get_alignment(), $el_class, $this->get_id() );

$sc_js = $this->load_js_sc();

// Enqueue Conditional Script
$this->scripts( $sc_js );

$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ra_helper()->sanitize_html_classes( $classes ) ?>" data-mh="content-box-arrow">
	<div class="row row-eq-height">

		<?php $this->get_background('left'); ?>

		<div class="col-md-6 content-box-content">

			<?php $this->get_title(); ?>
			<?php $this->get_content(); ?>
			<?php $this->get_button(); ?>
		
		</div><!-- content-box-content -->

		<?php $this->get_background('right'); ?>

	</div><!-- /.row -->
</div><!-- /.content-box -->