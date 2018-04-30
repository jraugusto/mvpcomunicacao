<div class="row">

	<?php while( have_posts() ): the_post(); ?>

	<div class="col-md-4 col-md-offset-0 col-sm-8 col-sm-offset-2">
	
		<div class="latest-posts latest-default latest-title-lg latest-content-extra-padding2 latest-shadow-2 meta-caption meta-semibold meta-sm2">
			
			<figure>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php if( has_post_thumbnail() ) {
							rella_the_post_thumbnail( 'rella-default-blog', null, false );
						} else{
							echo '<div class="latest-post-thumbnail-placeholder"></div>';
						} 
					?>
					<div class="meta text-uppercase">
						<time datetime="<?php the_date('Y-m-d'); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
					</div>
				</a>
			</figure>
			
			<div class="latest-content">	

				<header>
					<h3 class="entry-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
				</header>
	
				<div class="excerpt">
					<?php the_excerpt(); ?>
				</div>
	
				<footer>
					<a href="<?php the_permalink() ?>" class="read-more btn btn-naked text-uppercase"><span><?php echo esc_html__( 'Read More', 'infinite-addons' ); ?></span><i class="fa fa-angle-right"></i></a>
				</footer>
	
			</div><!-- /.latest-content -->
		</div><!-- /.latest-posts -->
	
	</div><!-- /.col-md-4 -->

	<?php endwhile; ?>
	
</div>