<div class="row">

	<?php while( have_posts() ): the_post(); ?>
		<div class="col-md-4 col-md-offset-0 col-sm-6 col-xs-12">
			<div class="latest-posts latest-default latest-background latest-content-extra-padding2 latest-title-lg2 latest-light-title latest-read-more-sm meta-caption meta-lg2 meta-sticky-down meta-no-comma">
				<figure>
					<?php

						if( has_post_thumbnail() ) {
							rella_the_post_thumbnail( 'rella-cloud-blog' );

						} else{

							echo '<div class="latest-post-thumbnail-placeholder"></div>';

						}
					?>
					<div class="meta text-center">
						<?php $author_url = get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>
						<span class="user"> <?php if( $author_url ) { ?><a href="<?php echo esc_url( $author_url ); ?>"><?php } ?><i class="fa fa-user"></i> <?php echo get_the_author(); ?><?php if( $author_url ) { ?> </a> <?php } ?> </span>

						<time datetime="<?php the_date('Y-m-d'); ?>"><i class="fa fa-clock-o"></i> <?php the_time( get_option( 'date_format' ) ); ?></time>

						<?php

							if ( comments_open() ) {
							$num_comments = get_comments_number();

						?>

						<span class="comments"><a href="<?php echo get_comments_link(); ?>"><i class="fa fa-comment-o"></i> <?php echo $num_comments; ?></a></span>

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
						<a href="<?php the_permalink(); ?>" class="read-more btn btn-naked text-uppercase"><span><?php echo esc_html__( 'Read More', 'infinite-addons' ); ?></span><i class="fa fa-angle-right"></i></a>
					</footer>

				</div><!-- /.latest-content -->

			</div><!-- /.latest-posts -->

		</div><!-- /.col-md-4 -->
	<?php endwhile; ?>
</div>
