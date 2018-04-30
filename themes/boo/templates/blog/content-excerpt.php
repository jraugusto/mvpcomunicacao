<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 */
?>

<article <?php rella_helper()->attr( 'post' ) ?>>

	<?php the_post_thumbnail(); ?>

		<header class="entry-header">

			<?php the_title( sprintf( '<h2 %s><a href="%s" rel="bookmark">', rella_helper()->get_attr( 'entry-title' ), esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<?php get_template_part( 'templates/entry', 'meta' ) ?>

		</header>

		<div <?php rella_helper()->attr( 'entry-summary' ) ?>>
			<?php add_filter( 'rella_dinamic_css_output', 'rella_return_false' ); ?>
			<?php the_excerpt() ?>
			<?php remove_filter( 'rella_dinamic_css_output', 'rella_return_false' ); ?>
		</div><!-- .entry-content -->


</article><!-- #post-## -->