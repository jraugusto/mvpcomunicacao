<?php
/**
 * Top Promo template
 *
 * @package Boo
 */

$promo_id = get_top_promo_layout();

$promo_classes = 'promote-box collapse in';

$get_cookie_promo = isset( $_COOKIE['ra_promote_box_stats'] ) ? $_COOKIE['ra_promote_box_stats'] : '';

if( 'hidden' === $get_cookie_promo ) {
	$promo_classes = 'promote-box collapse';
}
?>
<div class="<?php echo $promo_classes; ?>" id="promote-box">
	<div class="promote-inner">
	<?php 

		$promo_content = get_post_field( 'post_content', $promo_id );
		echo do_shortcode( $promo_content );	

	?>
	</div><!-- /.promote-inner -->
	<button class="close" type="button" data-toggle="collapse" data-target="#promote-box" aria-expanded="true" aria-controls="promote-box"><span aria-hidden="true"><i class="icon-cross"></i></span></button>
</div><!-- /.promote -->