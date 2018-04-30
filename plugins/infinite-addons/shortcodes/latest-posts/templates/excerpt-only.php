<div class="widget widget_latest_posts_entries <?php echo ra_helper()->sanitize_html_classes( $classes ) ?>" id="<?php echo $this->get_id(); ?>">
	<?php
		if( $atts['title'] ) {
			printf( '<h3 class="widget-title">%s</h3>', $atts['title'] );
		}
	?>
    <ul>
        <?php while( have_posts() ): the_post(); ?>
        <li>
            <div class="contents">
                <h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
                <span class="time"><?php echo get_the_time( 'F d' ); ?></span>
				<?php
				if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
					echo '<span class="comments">';
					comments_popup_link( __( 'No Comments', 'infinite-addons' ), __( '1 Comment', 'infinite-addons' ), __( '% Comments', 'infinite-addons' ) );
					echo '</span>';
				}
				?>
            </div>
        </li>
        <?php endwhile; ?>
    </ul>
</div>
