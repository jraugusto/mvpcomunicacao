<?php
/**
 * Default header template
 *
 * @package base-html
 */

$header = rella_get_header_layout();
?>
<header <?php rella_helper()->attr( 'header', $header['attributes'] ); ?>>

	<?php 
		
/*
		if ( function_exists( 'pll_get_post' ) ) {
			$header['id'] = pll_get_post( $header['id'] );
		}
*/
		
		$header_content = get_post_field( 'post_content', $header['id'] );

		echo do_shortcode( $header_content );
		
	?>

</header>