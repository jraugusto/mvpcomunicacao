<?php
	
$format =  get_post_format();
$time_to_read = rella_helper()->get_option( 'post-time-read' );
$enable_titlebar = rella_helper()->get_option( 'title-bar-enable', 'raw', '' );

?>
<div class="contents-container blog-single blog-single-minimal">
	<div class="contents">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">		

				<article <?php rella_helper()->attr( 'post', array( 'class' => 'blog-post' ) ) ?>>
					
					<link itemprop="mainEntityOfPage" href="<?php the_permalink() ?>" />
		
					<div class="post-contents">
						
					<?php rella_floated_share_box() ?>
		
						<header>
							<?php if( 'audio' === $format && $audio = rella_helper()->get_option( 'post-audio' ) ) : ?>
								<div class="post-audio">
									<?php echo do_shortcode( '[audio src="' . esc_url( $audio ) . '"]' ) ?>
								</div><!-- /.post-audio -->
							<?php endif; ?>
							
							<?php if( 'on' === $enable_titlebar ) : ?>
								<?php the_title( '<h2 '. rella_helper()->get_attr( 'entry-title' ) .'>', '</h2>' ); ?>
							<?php else : ?>
								<?php the_title( '<h1 '. rella_helper()->get_attr( 'entry-title' ) .'>', '</h1>' ); ?>
							<?php endif; ?>
		
							<div class="post-info">
								<span><?php rella_post_time(true); ?></span>
								<?php rella_author_link() ?>
								<span class="comments">
									<?php comments_popup_link( '<i class="fa fa-comment"></i> ' . esc_html__( '0 Opinions', 'boo' ) .'', '<i class="fa fa-comment"></i> ' . esc_html__( '1 Opinion', 'boo' ) .  '', '<i class="fa fa-comment"></i> % '. esc_html__( 'Opinions', 'boo' ) .'', 'comments-link', '' ); ?>
								</span>
							</div><!-- /.post-info -->
		
						</header>		

						<div <?php rella_helper()->attr( 'entry-content' ) ?>>
							<?php
								the_content( sprintf(
									esc_html__( 'Continue reading %s', 'boo' ),
									the_title( '<span class="screen-reader-text">', '</span>', false )
									) );

								wp_link_pages( array(
									'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'boo' ) . '</span>',
									'after'       => '</div>',
									'link_before' => '<span>',
									'link_after'  => '</span>',
									'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'boo' ) . ' </span>%',
									'separator'   => '<span class="screen-reader-text">, </span>',
								) );
							?>
						</div>

						<div class="row">
							<div class="col-md-10 col-md-offset-1">
							<?php if( function_exists( 'rella_portfolio_share' ) ) : ?>
								<?php rella_portfolio_share( get_post_type(), array(
									'class' => 'social-icon semi-round rectangle bordered branded-text',
									'before' => '<div class="post-share">',
									'after' => '</div>'
								) ); ?>
							<?php endif; ?>
								
								<?php rella_render_post_nav() ?>
		
								<?php get_template_part( 'templates/blog/single/part', 'author' ) ?>
								
								<?php do_action( 'rella_after_author_content' ) ?>
		
								<?php rella_render_related_posts( get_post_type() ) ?>
		
								<?php
								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif; ?>
		
							</div><!-- /.col-md-10 col-md-offset-1 -->
						</div><!-- /.row -->
					</div><!-- /.post-contents -->
					
					<div class="publisher-img hidden" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
						<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
							<img src="<?php echo get_template_directory_uri() . '/assets/img/logo/logo.png'; ?>" width="124" height="84"/>
							<meta itemprop="url" content="<?php echo get_template_directory_uri() . '/assets/img/logo/logo.png'; ?>">
							<meta itemprop="width" content="124">
							<meta itemprop="height" content="84">
						</div>
					<meta itemprop="name" content="<?php the_author(); ?>">
		
						</div>
		
					<meta itemprop="dateModified" content="<?php echo the_time('c'); ?>"/>

					
				</article><!-- #post-## -->

			</div><!-- /.col-md-10 -->
		</div><!-- /.row -->
	</div>
</div>