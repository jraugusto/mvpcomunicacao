<?php
/**
 * Default footer template
 *
 * @package base-html
 */

$footer = rella_get_footer_layout();
$footer_id = $footer['id'];
$footer_link = isset( $footer['link'] ) ? $footer['link'] : false;
unset( $footer['id'], $footer['link'] );

if( !empty( $footer ) || !empty( $footer_link ) ) {
	echo '<style>';

		if( !empty( $footer ) ) {
			printf( '#footer {%s}', rella_helper()->output_css( $footer ) );
		}

		if( !empty( $footer_link ) ) {
			$css = '';
			foreach( $footer_link as $k => $v ) {

				if( 'regular' === $k ) {
					printf( '#footer a:not(.btn) { color: %s }', $v  );
				}
				else {
					printf( '#footer a:not(.btn):%s { color: %s }', $k, $v  );
				}
			}
		}

	echo '</style>';
}
?>
<footer <?php rella_helper()->attr( 'footer' ); ?>>

	<div class="container">

		<?php 
			
/*
			if ( function_exists( 'pll_get_post' ) ) {
				$footer_id = pll_get_post( $footer_id );
			}
*/

			$footer_content = get_post_field( 'post_content', $footer_id );

			echo do_shortcode( $footer_content );

		?>

	</div>

</footer>