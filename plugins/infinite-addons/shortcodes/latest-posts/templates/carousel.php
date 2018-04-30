<?php

$classes = $this->get_substyle_class();

$heading_class = ( 'sb1' == $this->atts['sub_style'] ) ? 'class="weight-bold"' : '';
?>
<div class="carousel-container latest-posts-carousel-nav carousel-nav-style3">

	<div class="row">

		<div class="col-md-4 col-sm-6 col-xs-12">

		<div class="carousel-nav">

			<?php if (  $atts['title'] ) { ?>
				<header class="section-title section-title-blue-underline align-left">
					<h2 <?php echo $heading_class; ?>><?php echo esc_html( $atts['title'] ); ?></h2>
					<?php if( ! empty( $atts['subtitle'] ) ) : ?>
						<strong class="subtitle"><?php echo esc_html( $atts[ 'subtitle' ] ); ?></strong>
					<?php endif; ?>
				</header>
			<?php  } ?>

			<?php if ( ! empty( $atts['desc'] ) ) { ?>
				<p><?php echo wp_kses_post( $atts['desc'] ); ?></p>
			<?php } ?>

			<button class="flickity-prev-next-button previous" type="button" aria-label="previous"><i class="fa fa-angle-left"></i></button>
			<button class="flickity-prev-next-button next" type="button" aria-label="next"><i class="fa fa-angle-right"></i></button>
		</div><!-- /.carousel-nav -->

		</div><!-- /.col-md-4 -->

		<div class="col-md-8 col-sm-6 col-xs-12">

			<div class="carousel-items row">

			<?php while( have_posts() ): the_post(); ?>

				<div class="col-md-6 col-xs-12">

					<div class="<?php echo ra_helper()->sanitize_html_classes( $classes ); ?>">

						<figure>
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php if( has_post_thumbnail() ) {
									rella_the_post_thumbnail( 'rella-default-blog', null, false );
								} else{
									echo '<div class="latest-post-thumbnail-placeholder"></div>';
								}
							?>
							</a>
						</figure>

						<div class="latest-content">

							<header>
								<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<div class="meta text-uppercase">

									<time datetime="<?php the_date('Y-m-d'); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
									<?php
										$category      = get_the_category();
										$firstCategory = $category[0]->cat_name;
										$category_id   = $category[0]->term_id;
										if ( ! empty( $firstCategory ) ) {
									?>
									<span class="tags"><a href="<?php echo get_category_link( $category[0]->term_id ); ?>"><?php echo $firstCategory; ?></a></span>
									<?php } ?>

								</div>
							</header>

							<div class="excerpt">
								<?php the_excerpt(); ?>
							</div><!-- /.excerpt -->

						</div><!-- /.latest-content -->

				</div><!-- /.latest-posts -->

				</div><!-- /.col-md-6 -->

			<?php endwhile; ?>

			</div><!-- /.carousel-items -->

		</div><!-- /.col-md-8 -->

</div><!-- /.row -->

</div><!-- /.carousel-container -->
