<?php
/**
 * in Content Promo template
 *
 * @package Boo
 */

$promo_id = get_in_post_promo_layout();
?>
<div class="promote-box-inpost text-lg-center">
	<div class="promote-inner">
	<?php 

		$promo_content = get_post_field( 'post_content', $promo_id );
		echo do_shortcode( $promo_content );	

	?>
	</div> <!-- /.promote-inner -->
</div> <!-- /.promote-box-inpost -->