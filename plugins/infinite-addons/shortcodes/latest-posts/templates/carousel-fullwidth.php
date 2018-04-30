<div class="carousel-container carousel-nav-style2">

	<div class="carousel-items">

		<?php

			while( have_posts() ): the_post();
			$post_bg = rella_helper()->get_option( 'post-bg' );

		?>

			<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 no-padding no-margin">

				<div class="latest-posts latest-caption latest-meta meta-no-comma">
					
					<a class="overlay-link" href="<?php the_permalink() ?>"></a>

					<figure><?php rella_the_post_thumbnail( 'full' ) ?></figure>

					<div class="latest-content latest-content-extra-padding">
						<header>
							<div class="meta mb5 text-uppercase">

								<time class="weight-semibold" datetime="<?php the_date('Y-m-d'); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>

									<?php
										$category      = get_the_category();
										$firstCategory = $category[0]->cat_name;
										$category_id   = $category[0]->term_id;
										if ( ! empty( $firstCategory ) ) {
									?>
									<span class="tags" style="background: <?php echo esc_attr( $post_bg ); ?>"><a href="<?php echo get_category_link( $category[0]->term_id ); ?>"><?php echo $firstCategory; ?></a></span>
									<?php } ?>

							</div>

							<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

						</header>
					</div><!-- /.lates-content -->
				</div><!-- /.latest-posts -->

			</div><!-- /.col-md-2 -->

		<?php endwhile; ?>


	</div><!-- /.carousel-items -->

	<div class="carousel-nav">
		<div class="container">
			<div class="row">
				<div class="col-md-1 pull-left">
					<a href="#" class="flickity-prev-next-button previous"><span><i class="fa fa-angle-left"></i></span></a>
				</div><!-- /.col-md-1 -->
				<div class="col-md-1 pull-right">
					<a href="#" class="flickity-prev-next-button next"><span><i class="fa fa-angle-right"></i></span></a>
				</div><!-- /.col-md-1 -->
			</div><!-- /.row -->
		</div><!-- /.container -->
	</div><!-- /.carousel-nav -->

</div><!-- /.carousel-container -->
