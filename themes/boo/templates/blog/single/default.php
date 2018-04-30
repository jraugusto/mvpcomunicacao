<?php 

$time_to_read = rella_helper()->get_option( 'post-time-read' );
$enable_titlebar = rella_helper()->get_option( 'title-bar-enable', 'raw', '' );

?>
<div class="contents-container blog-single">

	<div class="contents">

		<article <?php rella_helper()->attr( 'post', array( 'class' => 'blog-post' ) ) ?>>
			
			<link itemprop="mainEntityOfPage" href="<?php the_permalink() ?>" />

			<?php if( 'on' === $enable_titlebar ) : ?>
				<?php the_title( '<h2 '. rella_helper()->get_attr( 'entry-title' ) .'>', '</h2>' ); ?>
			<?php else : ?>
				<?php the_title( '<h1 '. rella_helper()->get_attr( 'entry-title' ) .'>', '</h1>' ); ?>
			<?php endif; ?>

			<?php get_template_part( 'templates/blog/single/part', 'media' ) ?>

			<div class="post-contents">
								
				<?php rella_floated_share_box() ?>

				<header>

					<div class="post-info">
						<span><?php rella_post_time(true); ?></span>
						<?php rella_author_link() ?>
						
						<?php if ( comments_open() ) : ?>
						<span class="comments">
							<?php comments_popup_link( '<i class="fa fa-comment"></i> ' . esc_html__( '0 Opinions', 'boo' ) .'', '<i class="fa fa-comment"></i> ' . esc_html__( '1 Opinion', 'boo' ) .  '', '<i class="fa fa-comment"></i> % '. esc_html__( 'Opinions', 'boo' ) .'', 'comments-link', '' ); ?>
						</span>
						<?php endif; ?>

						<?php if( ! empty( $time_to_read ) ) : ?>
							<span class="post-time-read"><i class="fa fa-book"></i> <?php echo esc_html( $time_to_read ); ?></span>
						<?php endif; ?>
						
						<?php if( '' === get_the_post_thumbnail() ) : ?>
							<?php
								$categories_list = get_the_category_list( esc_html__( ', ', 'boo' ) );
								if( '' != $categories_list ) :								
							?>
							<span>
								<i class="fa fa-folder-open"></i> <?php echo $categories_list; ?>
							</span>
							<?php endif; ?>
								
						<?php endif; ?>
						
							<span>
								<?php the_tags( '<span class="tags"><i class="fa fa-tag"></i> ', esc_html_x( ', ', 'Used between list items, there is a space after the comma.', 'boo' ), '</span>' ); ?>
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

			</div><!-- /.contents -->
			
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

	</div>

</div>
