<div class="row">

	<?php while( have_posts() ): the_post(); ?>
	<div class="col-md-4 col-md-offset-0 col-sm-6 col-xs-12">

		<div class="latest-posts latest-default latest-content-overlap latest-meta meta latest-normal-title latest-content-extra-padding2 meta-caption meta-no-comma meta-sm3 meta-sticky-left">

			<figure>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php
						if( has_post_thumbnail() ) {
							rella_the_post_thumbnail( 'rella-shop-blog' );
						} else{
							echo '<div class="latest-post-thumbnail-placeholder"></div>';
						}
					?>
					<div class="meta">
						<time datetime="<?php the_date('Y-m-d'); ?>"><?php echo get_the_time( 'M' ); ?><br /> <?php echo get_the_time( 'd' ); ?></time>
					</div>
				</a>
			</figure>

			<div class="latest-content">

				<header style="font-size: 15px;">
					<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				</header>

				<div class="excerpt">
					<?php the_excerpt(); ?>
				</div><!-- /.except -->

				<footer>
					<a href="<?php the_permalink(); ?>" class="read-more btn btn-naked text-uppercase" style="font-size: 13px; "><span><?php echo esc_html__( 'Read More', 'infinite-addons' ); ?></span><i class="fa fa-long-arrow-right"></i></a>
				</footer>

			</div><!-- /.latest-content -->

		</div><!-- /.latest-posts -->

	</div><!-- /.col-md-4 -->
	<?php endwhile; ?>

</div>
