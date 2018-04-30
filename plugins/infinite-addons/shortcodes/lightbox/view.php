<?php

extract( $atts );

// Enqueue Conditional Script
$this->scripts();

$classes = array( 'lightbox-video', $el_class, $this->get_id() );

?>
<div id="<?php echo $this->get_id(); ?>" class="<?php echo ra_helper()->sanitize_html_classes( $classes ); ?>">
	
	<?php $this->get_sided_link() ?>
	
	<figure<?php $this->get_figure_atts() ?>></figure>
	<figure>

		<?php $this->get_image() ?>

		<div class="hover-line">
			<i class="icon fa fa-play"></i>
			<div class="line left"></div>
			<div class="line right"></div>
		</div>

		<?php $this->get_lightbox_link() ?>

	</figure>
</div>