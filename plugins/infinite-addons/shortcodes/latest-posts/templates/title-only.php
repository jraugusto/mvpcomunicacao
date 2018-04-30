<div class="widget widget_latest_posts_entries posts-enteries-minimal <?php echo ra_helper()->sanitize_html_classes( $classes ) ?>" id="<?php echo $this->get_id(); ?>">
	<?php
		if( $atts['title'] ) {
			printf( '<h3 class="widget-title">%s</h3>', $atts['title'] );
		}
	?>
    <ul>
        <?php while( have_posts() ): the_post(); ?>
        <li>
            <div class="contents">
				<span class="time"><?php echo get_the_time('M j'); ?></span>
                <h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
            </div>
        </li>
        <?php endwhile; ?>
    </ul>
</div>
