<?php

extract( $atts );

$classes = array( 'content-box', $this->get_class( $style ), $el_class, $this->get_id() );

$sc_js = $this->load_js_sc();

// Enqueue Conditional Script
$this->scripts( $sc_js );

$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ra_helper()->sanitize_html_classes( $classes ) ?>">

	<div class="row row-eq-height">
		
		<?php if( 'left' === $position ) { ?>
			<div class="col-md-6 no-padding">
				<?php $this->get_info2(); ?>
				<?php $this->get_image(); ?>
			</div><!-- /.col-md-6 -->
		<?php } ?>

		<div class="col-md-6 no-padding">
			<div class="content-box-content">

				<?php $this->get_title(); ?>
				<?php $this->get_info(); ?>
				<?php $this->get_content(); ?>
				<?php $this->get_button(); ?>

			</div>
		</div>

		<?php if( 'right' === $position ) { ?>
			<div class="col-md-6 no-padding">
				<?php $this->get_info2(); ?>
				<?php $this->get_image(); ?>
			</div><!-- /.col-md-6 -->
		<?php } ?>		
		

	</div><!-- /.row -->

</div><!-- /.content-box -->