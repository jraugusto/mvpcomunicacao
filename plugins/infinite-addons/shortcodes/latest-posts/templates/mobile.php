<div class="row">

	<?php while( have_posts() ): the_post(); ?>

		<div class="col-md-4 col-md-offset-0 col-sm-6 col-xs-12">

			<div class="latest-posts latest-default latest-meta latest-normal-title latest-content-extra-padding-sm">

				<figure>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php
						if( has_post_thumbnail() ) {
							rella_the_post_thumbnail( 'rella-default-blog' );
						} else{
							echo '<div class="latest-post-thumbnail-placeholder"></div>';
						}
					?>
					</a>
				</figure>

				<div class="latest-content">

					<header style="font-size: 15px;">
						<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="meta">
							<time datetime="<?php the_date('Y-m-d'); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
							<?php

								$num_comments = get_comments_number(); // get_comments_number returns only a numeric value

								if ( comments_open() ) {
									if ( $num_comments == 0 ) {
										$comments = esc_html__( '0 Comments' , 'infinite-addons' );
									} elseif ( $num_comments > 1 ) {
										$comments = $num_comments . esc_html__( ' Comments', 'infinite-addons' );
									} else {
										$comments = esc_html__( '1 Comment', 'infinite-addons' );
									}
									echo '<span class="comments"><a href="' . get_comments_link() .'"><i class="fa fa-comment-o"></i> ' . $comments . '</a></span>';
								}
							?>
						</div>
					</header>

					<div class="excerpt">
						<?php the_excerpt(); ?>
					</div><!-- /.except -->

					<footer>
						<a href="<?php the_permalink(); ?>" class="read-more btn btn-naked text-uppercase" style="font-size: 13px; "><span><?php echo esc_html__( 'Read More', 'infinite-addons' ); ?></span><i class="fa fa-angle-right"></i></a>
					</footer>

				</div><!-- /.latest-content -->

			</div><!-- /.latest-posts -->

		</div><!-- /.col-md-4 -->

	<?php endwhile; ?>

</div>
