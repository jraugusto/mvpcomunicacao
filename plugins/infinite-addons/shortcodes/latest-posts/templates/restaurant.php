<div class="row row-eq-height">

	<?php while( have_posts() ): the_post(); ?>

		<div class="col-md-6 no-padding no-margin">
		
			<div class="latest-posts latest-default latest-border-tabular latest-meta">
		
				<div class="row row-eq-height">
		
					<div class="col-xs-6 no-padding">
		
						<div class="latest-content">
		
							<header>
								<div class="meta text-uppercase">
									<time datetime="<?php the_date('Y-m-d'); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
								</div><!-- /.meta -->
		
								<h3 class="entry-title text-uppercase"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							</header>
		
							<footer>
								<a href="<?php the_permalink(); ?>" class="read-more btn btn-naked text-uppercase"><span><?php echo esc_html__( 'Read More', 'infinite-addons' ); ?></span></a>
							</footer>
		
						</div><!-- /.latest-content -->
		
					</div><!-- /.col-md-6 -->
					<?php
						$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
						$resized   = rella_get_resized_image_src( $image_src, 'rella-portfolio' );
					?>
					<figure class="col-xs-6 no-padding" style="background: url(<?php echo $resized; ?>); background-size: cover;">
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
		
				</div><!-- /.row -->
		
			</div><!-- /.latest-posts -->
		
		</div><!-- /.col-md-6 -->

	<?php endwhile; ?>

</div>