<div class="row">

	<?php while( have_posts() ): the_post(); ?>

		<div class="col-md-4 col-md-offset-0 col-sm-6 col-xs-12">

			<div class="latest-posts latest-default latest-title-md meta-caption meta-sm">
				<header>
					<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				</header>

				<figure>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<?php if( has_post_thumbnail() ) {
							rella_the_post_thumbnail( 'rella-cloud-blog' );
							} else{
								echo '<div class="latest-post-thumbnail-placeholder"></div>';
							}
						?>
						<div class="meta bg-accent">
							<time datetime="<?php the_date('Y-m-d'); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
						</div>
					</a>
				</figure>

				<div class="latest-content">

					<?php
						$category      = get_the_category();
						$firstCategory = $category[0]->cat_name;
						if ( ! empty( $firstCategory ) ) {
					?>
					<p class="subheading">
						<?php $author_url = get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>
						<?php echo $firstCategory; ?> <?php echo esc_html__( 'by', 'infinite-addons' );  ?> <?php if( $author_url ) { ?><a href="<?php echo esc_url( $author_url ); ?>"><?php } ?> <?php echo get_the_author(); ?><?php if( $author_url ) { ?> </a> <?php } ?>
					</p>
					<?php } ?>

					<div class="excerpt">
						<?php the_excerpt(); ?>
					</div>

					<footer>
						<a href="<?php the_permalink(); ?>" class="read-more btn btn-naked text-uppercase"><span><?php echo esc_html__( 'Read More', 'infinite-addons' ); ?></span><i class="fa fa-angle-right"></i></a>
					</footer>
				</div>

			</div><!-- /.latest-posts -->

		</div><!-- /.col-md-4 -->

	<?php endwhile; ?>

</div>
