<?php

extract( $atts );

// Enqueue Conditional Script
$this->scripts();

if( empty( $items ) ) {
	return '';
}

?>
<div class="testimonial-slider">

	<div class="testimonial-slider-temporary">

		<?php foreach ( $items as $item ) : ?>

			<div class="testimonial-item">

				<blockquote class="testimonial-quote">

				<?php if( $item['content'] ) { ?>
					<div class="testimonial-quote-text"><?php echo wp_kses_post( ra_helper()->do_the_content( $item['content'], true ) ); ?></div>
				<?php } ?>

				<?php if( $item['author'] ) { ?>
					<cite class="testimonial-quote-author"><?php echo esc_html( $item['author' ]); ?></cite>
				<?php } ?>
				</blockquote>

				<?php

					if( $item['image'] ) {
						
						if( preg_match( '/^\d+$/', $item['image'] ) ){
							$image = wp_get_attachment_image_src( $item['image'], 'full' );
							$src = $image[0];
						} else {
							$src = $item['image'];
						}						
				?>
				<figure class="testimonial-image">
					<img src="<?php echo esc_url( $src ); ?>" alt="" />
				</figure>
				<?php } ?>

			</div>

		<?php endforeach; ?>

	</div>

	<div class="testimonial-slider-opposite">
		<div class="testimonial-slider-item item-left" data-parallax="true" data-parallax-from='{ "y": 80 }' data-parallax-to='{ "y": -80 }' data-parallax-options='{ "duration": "1850" }' data-smooth-transition="true">
			<div class="carousel-swipe-button">
				<span>SWIPE</span>
			</div>
			<ul></ul>
		</div>
		<div class="testimonial-slider-item item-right" data-parallax="true" data-parallax-from='{ "y": -150 }' data-parallax-to='{ "y": 150 }' data-parallax-options='{ "duration": "1600" }' data-smooth-transition="true">
			<ul></ul>
		</div>
		<div class="pages-all">
			<div class="testimonial-slider-pagination">
				<a href="#" class="prev"><i class="fa fa-caret-up"></i></a>
				<div class="pages">
					<div class="actives"><ul></ul></div>
					<div class="all"><span class="all"></span></div>
				</div>
				<a href="#" class="next"><i class="fa fa-caret-down"></i></a>
			</div>
		</div>
	</div>

</div>
