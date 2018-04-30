<?php if ( 'post' !== get_post_type() ) return; ?>

<div class="entry-byline">

	<span <?php rella_helper()->attr( 'entry-author' ); ?>><?php the_author_posts_link(); ?></span>

	<span><?php rella_post_time(); ?></span>
	
	<?php if ( comments_open() ) : ?>
	<span class="comments">
		<?php comments_popup_link( '<i class="fa fa-comment"></i> ' . esc_html__( '0 Opinions', 'boo' ) .'', '<i class="fa fa-comment"></i> ' . esc_html__( '1 Opinion', 'boo' ) .  '', '<i class="fa fa-comment"></i> % '. esc_html__( 'Opinions', 'boo' ) .'', 'comments-link', '' ); ?>
	</span>
	<?php endif; ?>

	<?php edit_post_link(); ?>

</div><!-- .entry-byline -->
