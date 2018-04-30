<?php

// Fallback
if( !class_exists( 'RA_Blog' ) ) {
	// Start the Loop.
	while ( have_posts() ) : the_post();

		/*
		 * Include the Post-Format-specific template for the content.
		 * If you want to override this in a child theme, then include a file
		 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
		 */
		rella_get_content_template();

	// End the loop.
	endwhile;

	// Set up paginated links.
    $links = paginate_links( array(
		'type' => 'array',
		'prev_next' => true,
		'prev_text' => '<span aria-hidden="true">' . wp_kses_post( __( '<i class="fa fa-angle-left"></i>', 'boo' ) ) . '</span>',
		'next_text' => '<span aria-hidden="true">' . wp_kses_post( __( '<i class="fa fa-angle-right"></i>', 'boo' ) ) . '</span>'
	));

	if( !empty( $links ) ) {

		printf( '<div class="blog-nav"><nav aria-label="Page navigation"><ul class="pagination"><li>%s</li></ul></nav></div>', join( "</li>\n\t<li>", $links ) );
	}

	return;
}

get_template_part( 'theme/author-blog' );