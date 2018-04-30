<div class="row">

	<?php

		while( have_posts() ): the_post();
		$post_bg = rella_helper()->get_option( 'post-bg' );

	?>

		<div class="col-md-4 col-md-offset-0 col-sm-6 col-xs-12">

		<?php if ( ! empty( $post_bg ) ) { ?>
		<style scoped>
			.latest-posts footer { background-color: <?php echo esc_attr( $post_bg ); ?>; }
			.latest-posts footer svg { fill: <?php echo esc_attr( $post_bg ); ?>; }
		</style>
		<?php  } ?>

		<div class="latest-posts latest-default latest-shadow latest-svg-hover latest-meta">
			<figure>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php
					if( has_post_thumbnail() ) {
						rella_the_post_thumbnail( 'rella-agency-blog' );
					} else{
						echo '<div class="latest-post-thumbnail-placeholder"></div>';
					}
				?>
				</a>
			</figure>
			<div class="latest-content">

				<header>

					<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

					<div class="meta latest-meta-default text-uppercase">

						<time datetime="<?php the_date('Y-m-d'); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>

						<?php $author_url = get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>
						<span class="author"><?php if( $author_url ) { ?><a href="<?php echo esc_url( $author_url ); ?>"><?php } ?> <?php echo get_the_author(); ?><?php if( $author_url ) { ?> </a> <?php } ?></span>

					</div>
				</header>

				<div class="excerpt">
					<?php the_excerpt(); ?>
				</div>

				<footer>
					<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewbox="0 0 74 7" style="enable-background:new 0 0 74 7;" xml:space="preserve">
						<path style="fill-rule:evenodd;clip-rule:evenodd;" d="M57.7,5c-6.2-1.6-13.5-5-20.8-5c-7.2,0-14.4,3.3-20.5,4.8C11.2,6.1,5.3,6.7,0,7v0h72.4 C67.4,6.7,62.2,6.1,57.7,5z" />
					</svg>
					<?php
						$category      = get_the_category();
						$firstCategory = $category[0]->cat_name;
						$category_id   = $category[0]->term_id;
						if ( ! empty( $firstCategory ) ) {
					?>
					<span class="tags"><a href="<?php echo get_category_link( $category[0]->term_id ); ?>"><?php echo $firstCategory; ?></a></span>
					<?php } ?>

				</footer>
			</div>
		</div>

		</div><!-- /.col-md-4 -->

	<?php endwhile; ?>

</div>
