<div class="row">

	<?php

		wp_enqueue_script( 'TweenMax' );
		while( have_posts() ): the_post();

			//Gradient Colors
			$gradient_bg = rella_helper()->get_option( 'post-gradient-bg' );
			$pr_gradient_color  = isset( $gradient_bg['from'] ) ? $gradient_bg['from'] : '';
			$sec_gradient_color = isset( $gradient_bg['to'] ) ? $gradient_bg['to'] : '';
			$bg_style = '';

			if ( ! empty( $pr_gradient_color ) || ! empty ( $sec_gradient_color ) ) {
				$bg_style = 'style="background-image: linear-gradient( 120deg, ' . $pr_gradient_color . ' 0%, ' . $sec_gradient_color . ' 100% );"';
			}
			
			$full_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
			$figure_bg  = rella_get_resized_image_src( $full_image, 'rella-dhover-blog' );
			
	?>

	<div class="col-md-4">

		<article class="latest-posts latest-post-hover" data-hover3d="true">

		<div class="latest-hover-box" data-stacking-factor="0.6" <?php echo $bg_style; ?>>
			<div class="latest-hover-box-inner"></div>
		</div>

		<div class="latest-hover-image" data-stacking-factor="0.6" <?php echo $bg_style; ?>>
			<figure style="background-image: url(<?php echo esc_url( $figure_bg ); ?>)">
				<?php rella_the_post_thumbnail( 'rella-dhover-blog' ); ?>
			</figure>

		</div>

		<div class="latest-hover-line" data-stacking-factor="0.7" <?php echo $bg_style; ?>>
			<div class="latest-hover-content">

			<header>
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			</header>

			<?php the_excerpt(); ?>

			<footer>
				<a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read the story', '_s' ); ?> <i class="fa fa-long-arrow-right"></i></a>
			</footer>

			</div><!-- /.latest-hover-content -->
		</div>
		<a class="overlay-link" href="<?php the_permalink(); ?>"></a>

		</article>

	</div>

	<?php endwhile; ?>

</div><!--/ .row-->
