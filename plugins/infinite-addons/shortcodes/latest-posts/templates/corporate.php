<div class="row">

	<?php while( have_posts() ): the_post(); ?>

		<div class="col-md-4 col-md-offset-0 col-sm-6 col-xs-12">

			<div class="latest-posts latest-default latest-title-md3 latest-bold-title latest-content-extra-padding-sm2 meta-caption meta-sticky-down meta-sm2 meta-no-comma">

				<figure>

					<?php if( has_post_thumbnail() ) {
							rella_the_post_thumbnail( 'rella-cloud-blog' );
						} else{
							echo '<div class="latest-post-thumbnail-placeholder"></div>';
						}
					?>
					<div class="meta text-uppercase">

						<time datetime="<?php the_date('Y-m-d'); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
						<?php

							$category      = get_the_category();
							$firstCategory = $category[0]->cat_name;
							$category_id   = $category[0]->term_id;
							if ( ! empty( $firstCategory ) ) {
						?>
						<span class="tags pull-right"><a href="<?php echo get_category_link( $category[0]->term_id ); ?>"><?php echo $firstCategory; ?></a></span>
						<?php } ?>

					</div>

				</figure>

				<div class="latest-content">

					<header>
						<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					</header>

					<div class="excerpt">
						<?php the_excerpt(); ?>
					</div>

					<footer>
						<a href="<?php the_permalink(); ?>" class="read-more btn btn-naked text-uppercase"><span><?php echo esc_html__( 'Learn More', 'infinite-addons' ) ?></span><i class="fa fa-long-arrow-right"></i></a>
					</footer>

				</div><!-- /.latest-content -->

			</div><!-- /.latest-posts -->

			</div><!-- /.col-md-4 -->

	<?php endwhile; ?>

</div>
