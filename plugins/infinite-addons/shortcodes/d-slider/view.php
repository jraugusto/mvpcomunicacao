<?php

$attachments  = $this->get_attachments();

if ( !is_array( $attachments ) ) {
	return;
}

// Enqueue Conditional Script
$this->scripts();
	
?>
<div class="slider-3d">
	<div class="carousel-3d">

	<?php
		foreach ( $attachments as $attachment ) { 
			if( $url = wp_get_attachment_image_src( $attachment->ID, 'full' ) ) {		
	?>
			<div class="item-3d">
				<a href="#"><img src="<?php echo $url[0]; ?>" alt="" /></a>
			</div>
	<?php
			}
		}
	?>

	</div>
</div>