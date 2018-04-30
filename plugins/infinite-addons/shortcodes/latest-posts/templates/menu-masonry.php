<div class="widget widget_latest_posts_entries-style2 <?php echo ra_helper()->sanitize_html_classes( $classes ) ?>" id="<?php echo $this->get_id(); ?>">
	<?php
		if( $atts['title'] ) {
			printf( '<h3 class="widget-title">%s</h3>', $atts['title'] );
		}
	?>
    <ul>
        <?php $i = 0; while( have_posts() ): the_post(); ?>
		<?php
			$i++;

			$full_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
			$figure_bg  = rella_get_resized_image_src( $full_image, 'rella-masonry-header-small' );
			if( $i == 3 ) {
				$figure_bg = rella_get_resized_image_src( $full_image, 'rella-masonry-header-big' );
			}
		?>
        <li class="masonry-item">
			<a href="<?php the_permalink() ?>">
			<article>
	            <figure style="background-image: url(<?php echo esc_url( $figure_bg ); ?>)">

						<?php if( has_post_thumbnail() ) {
							if( $i != 3 ) {
								rella_the_post_thumbnail( 'rella-masonry-header-small' );
							} else {
								rella_the_post_thumbnail( 'rella-masonry-header-big' );
							}
						} else{
							echo '<div class="latest-post-thumbnail-placeholder"></div>';
						} ?>

	            </figure>
	            <div class="contents">
					<span class="time"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?></span>
	                <h3><?php the_title() ?></h3>
	            </div>
			</article>
	      </a>
		</li>

        <?php endwhile; ?>
    </ul>
</div>
