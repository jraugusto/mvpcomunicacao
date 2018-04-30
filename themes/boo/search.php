<?php 
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Boo
 * @since 1.0
 */

get_header();

	if( have_posts() ) :

		// Start the Loop.
		while ( have_posts() ) : the_post();

			get_template_part( 'templates/blog/content', 'excerpt' );
			
		endwhile; // End of the loop.

		// Set up paginated links.
	    $links = paginate_links( array(
			'type' => 'array',
			'prev_next' => true,
			'prev_text' => '<span aria-hidden="true">' . wp_kses_post( __( '<i class="fa fa-angle-left"></i>', 'boo' ) ) . '</span>',
			'next_text' => '<span aria-hidden="true">' . wp_kses_post( __( '<i class="fa fa-angle-right"></i>', 'boo' ) ) . '</span>'
		));
	
		if( !empty( $links ) ) {
	
			printf( '<div class="blog-nav"><nav aria-label="Page navigation"><ul class="pagination"><li>%s</li></ul></nav></div>', join( "</li>\n\t<li>", $links ) );
		};

	else : // If no posts were found.

		get_template_part( 'templates/content/error' );

	endif;

get_footer();