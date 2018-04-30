<div class="row">
	<?php 
		
		while( have_posts() ): the_post(); 
		$rating = rella_helper()->get_option( 'post-rating' );
		
	?>
		<div class="col-md-4 col-md-offset-0 col-sm-8 col-sm-offset-2">
			<div class="latest-posts latest-default latest-border latest-title-md2 latest-hover-shadow meta-caption meta-caption-rhombus">
				<figure>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php	
						if( has_post_thumbnail() ) {
							rella_the_post_thumbnail( 'rella-default-blog', null, false );
						} else{
							echo '<div class="latest-post-thumbnail-placeholder"></div>';
						} 
					?>						
					</a>
					
					<?php if ( ! empty( $rating ) ) { ?>					
						<div class="meta"><span class="rating"><i class="fa fa-star"></i> <?php echo esc_html( $rating ); ?></span></div>
					<?php } ?>

				</figure>
				<div class="latest-content">
					<header>
						<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					</header>
		
					<div class="excerpt">
						<?php the_excerpt(); ?>
					</div><!-- /.except -->
	
					<footer>
						<a href="<?php the_permalink(); ?>" class="btn btn-naked btn-sm text-uppercase"><span><?php echo esc_html__( 'Read More', 'infinite-addons' ); ?></span><i class="fa fa-angle-right"></i></a>
					</footer>
				</div><!-- /.latest-content -->

			</div><!-- /.latest-posts -->
		</div><!-- /.col-md-4 -->
	<?php endwhile; ?>
</div>