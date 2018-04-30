<div class="row">

	<?php while( have_posts() ): the_post(); ?>

		<div class="col-md-4 col-md-offset-0 col-sm-6 col-xs-12">

			<div class="latest-posts latest-default latest-title-lg3 latest-border latest-content-extra-padding3 latest-meta">
				<figure>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php if( has_post_thumbnail() ) {
							rella_the_post_thumbnail( 'rella-agency-blog' );
						} else{
							echo '<div class="latest-post-thumbnail-placeholder"></div>';
						}
					?>
					</a>
				</figure>

				<div class="latest-content">
					<header>

						<h3 class="entry-title weight-normal"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

						<div class="meta latest-meta-default text-uppercase">
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
					</div>

					<footer>
						<a href="<?php the_permalink(); ?>" class="read-more weight-normal btn btn-naked text-uppercase"><span><?php echo esc_html__( 'Read More', 'infinite-addons' );  ?></span><i class="fa fa-long-arrow-right"></i></a>
					</footer>
				</div><!-- /.latest-content -->

			</div><!-- /.latest-posts -->

		</div><!-- /.col-md-4 -->

	<?php endwhile; ?>

</div>
