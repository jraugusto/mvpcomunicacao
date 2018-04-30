<div class="carousel-nav">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<a href="#" class="flickity-prev-next-button previous btn btn-solid round"><span><i class="fa fa-angle-left"></i></span></a>
				<?php if( ! empty ( $title ) ) : ?>
					<h4><?php echo esc_html( $title );  ?></h4>
 				<?php endif; ?>
 				<a href="#" class="flickity-prev-next-button next btn btn-solid round"><span><i class="fa fa-angle-right"></i></span></a>
			</div><!-- /.col-md-6 col-md-offset-3 -->
		</div><!-- /.row -->
	</div><!-- /.container -->
</div><!-- /.carousel-nav -->