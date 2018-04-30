<?php

// Enqueue Conditional Script
$this->scripts();

$attachments  = $this->get_attachments();
$show_caption = (isset( $atts['show_caption'] ) && 'yes' == $atts['show_caption']);

?>
<div id="<?php echo $this->get_id() ?>" class="carousel-container carousel-parallax gallery gallery-with-thumb">

	<div class="carousel-items slides js-flickity" data-flickity-options='{ "prevNextButtons": false, "pageDots": false, "contain": true, "selectedAttraction": 0.03, "friction": 0.3, "adaptiveHeight": true }'>

		<?php
		foreach ( $attachments as $attachment ) {

				$src = wp_get_attachment_image_src( $attachment->ID, 'full', false );
				$resized_src = rella_get_resized_image_src( $src, 'rella-gallery-large' );

				echo '<figure>';

					printf( '<img src="%s" data-rjs="%s" />', $resized_src, $resized_src );

					if( $show_caption ) {
						$caption = $attachment->post_excerpt;
						if( !$caption ) {
							$caption = $attachment->post_content;
						}
						if( !$caption ) {
							$caption = $attachment->post_title;
						}

						if( $caption ) {
							printf( '<div class="caption"><h4>%s</h4></div>', $caption );
						}
					}

				echo '</figure>';

		}

		?>
	</div>

	<div class="thumbs row js-flickity" data-flickity-options='{ "asNavFor": "#<?php echo $this->get_id() ?> .slides", "contain": true, "prevNextButtons": false, "pageDots": false, "cellAlign": "center" }'>

		<?php
		foreach ( $attachments as $attachment ) {

			$src = wp_get_attachment_image_src( $attachment->ID, 'full', false );
			$resized_src = rella_get_resized_image_src( $src, 'rella-widget' );
			$retina_src = rella_get_retina_image( $resized_src );

			printf( '<div class="col-md-1 col-sm-2 col-xs-3"><figure><img src="%s" data-rjs="%s" height="70" width="70" /></figure></div>', $resized_src, $retina_src );

		}
		?>

	</div>
</div>
