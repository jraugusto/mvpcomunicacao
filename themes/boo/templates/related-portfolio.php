<?php 

$related_count = $related_posts->post_count;
	
?>
<div class="related-projects">
    <div class="container">

        <h2 class="portfolio-title"><?php echo $heading ?></h2>
		
		<?php if( 1 == $related_count ) { ?>
		
			<div class="row">
				<?php while( $related_posts->have_posts() ): $related_posts->the_post(); ?>
	                <div class="col-md-12 col-xs-12">
	                    <div class="portfolio-item related" <?php echo $data_effect; ?>>
	                        <div class="portfolio-main-image" <?php echo $data_stacking; ?>>
	                            <figure>
	                            	<a href="<?php the_permalink() ?>">
										<?php rella_the_post_thumbnail( 'rella-related-post-one-col', null, false ); ?>
									</a>
								</figure>
	                        </div>
	                        <div class="portfolio-content">
	                            <div class="title-wrapper">
									<?php the_title( sprintf( '<h2><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ) ?>
									<?php the_terms( get_the_ID(), $taxonomy, '<ul class="category"><li>', '</li> <li>', '</li></ul>' ); ?>
	                            </div>
	                        </div>
	
	                    </div>
	                </div>
				<?php endwhile; ?>
			</div>

		<?php 

		} 
		elseif( 2 == $related_count ) { ?>

			<div class="row">
				<?php while( $related_posts->have_posts() ): $related_posts->the_post(); ?>
	                <div class="col-md-6 col-xs-12">
	                    <div class="portfolio-item related" <?php echo $data_effect; ?>>
	                        <div class="portfolio-main-image" <?php echo $data_stacking; ?>>
	                            <figure>
									<a href="<?php the_permalink() ?>">
										<?php rella_the_post_thumbnail( 'rella-related-post-two-col', null, false ); ?>
									</a>
								</figure>
	                        </div>
	                        <div class="portfolio-content">
	                            <div class="title-wrapper">
									<?php the_title( sprintf( '<h2><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ) ?>
									<?php the_terms( get_the_ID(), $taxonomy, '<ul class="category"><li>', '</li> <li>', '</li></ul>' ); ?>
	                            </div>
	                        </div>
	
	                    </div>
	                </div>
				<?php endwhile; ?>
			</div>

		<?php 
		
		}
		elseif( 3 == $related_count ) { ?>
		
			<div class="row">
				<?php while( $related_posts->have_posts() ): $related_posts->the_post(); ?>
	                <div class="col-md-4 col-xs-12">
	                    <div class="portfolio-item related" <?php echo $data_effect; ?>>
	                        <div class="portfolio-main-image" <?php echo $data_stacking; ?>>
	                            <figure>
									<a href="<?php the_permalink() ?>">
										<?php rella_the_post_thumbnail( 'rella-related-post-three-col', null, false ); ?>
									</a>
								</figure>
	                        </div>
	                        <div class="portfolio-content">
	                            <div class="title-wrapper">
									<?php the_title( sprintf( '<h2><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ) ?>
									<?php the_terms( get_the_ID(), $taxonomy, '<ul class="category"><li>', '</li> <li>', '</li></ul>' ); ?>
	                            </div>
	                        </div>
	
	                    </div>
	                </div>
				<?php endwhile; ?>
			</div>
			
		<?php } else { ?>

        <div class="carousel-container carousel-nav-style6">

            <div class="carousel-items row">
				<?php while( $related_posts->have_posts() ): $related_posts->the_post(); ?>
                    <div class="col-md-3 col-xs-6">
                        <div class="portfolio-item related">
                            <div class="portfolio-main-image">
                                <figure>
									<a href="<?php the_permalink() ?>">
										<?php rella_the_post_thumbnail( 'rella-portfolio-related', null, false ); ?>
									</a>
								</figure>
                            </div>
                            <div class="portfolio-content">
                                <div class="title-wrapper">
									<?php the_title( sprintf( '<h2><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ) ?>
									<?php the_terms( get_the_ID(), $taxonomy, '<ul class="category"><li>', '</li> <li>', '</li></ul>' ); ?>
                                </div>
                            </div>

                        </div>
                    </div>
				<?php endwhile; ?>
            </div><!-- /.carousel-items -->

            <div class="carousel-nav">
                <button class="flickity-prev-next-button previous"><i class="fa fa-angle-left"></i></button>
                <button class="flickity-prev-next-button next"><i class="fa fa-angle-right"></i></button>
            </div><!-- /.carousel-nav -->

        </div><!-- /.carousel-container -->
		
		<?php } ?>


    </div><!-- /.container -->
</div><!-- /.related-projects -->

<?php wp_reset_postdata();
