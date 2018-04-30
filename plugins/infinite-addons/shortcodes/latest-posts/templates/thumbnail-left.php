<div class="widget widget_latest_posts_entries widget_latest_posts_entries_with_thumb <?php echo ra_helper()->sanitize_html_classes( $classes ) ?>" id="<?php echo $this->get_id(); ?>">
	<?php
		if( $atts['title'] ) {
			printf( '<h3 class="widget-title">%s</h3>', $atts['title'] );
		}
	?>
    <ul>
        <?php while( have_posts() ): the_post(); ?>
        <li>
            <figure>
	            <a href="<?php the_permalink() ?>">
					<?php if( has_post_thumbnail() ) {
						rella_the_post_thumbnail( 'rella-medium', null, false );
					} else{
						echo '<div class="latest-post-thumbnail-placeholder"></div>';
					} ?>
				</a>
            </figure>
            <div class="contents">
                <h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
                <span class="time"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?></span>
            </div>
        </li>
        <?php endwhile; ?>
    </ul>
</div>
