<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;


$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
$gallery_ids = $product->get_gallery_image_ids();

$attachment_ids = '';

if( count( $gallery_ids ) >= 1 ) {
	$attachment_ids = array();
	$attachment_ids[] = $post_thumbnail_id;
	$attachment_ids = array_merge( $attachment_ids, $gallery_ids );
}

//vertical thumbs classes
$woo_product_style = rella_helper()->get_theme_option( 'woo_single_style' );
if( 'alt' === $woo_product_style ) {
?>

	<div class="col-xs-2 thumbnails-container">

		<div class="thumbnails carousel-thumbnails-vertical" data-asnavfor=".product-main-image-carousel">
		<?php
		
			if ( $attachment_ids && has_post_thumbnail() ) {
				foreach ( $attachment_ids as $attachment_id ) {
					$full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
					$thumbnail       = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
					$image_title     = get_post_field( 'post_excerpt', $attachment_id );
			
					$attributes = array(
						'title'                   => $image_title,
						'data-src'                => $full_size_image[0],
						'data-rjs'                => $full_size_image[0],
						'data-large_image'        => $full_size_image[0],
						'data-large_image_width'  => $full_size_image[1],
						'data-large_image_height' => $full_size_image[2],
					);
					
					$html  = '<div class="thumb-item">';
					$html .= wp_get_attachment_image( $attachment_id, 'shop_single', false, $attributes );
					$html .= '</div><!-- /.thumb-item -->';
			
					echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
				}
			}
		
		?>
	</div><!-- /.carousel-items -->

	</div><!-- /.thumbnails-container -->

<?php } else { ?>

<div class="thumbnails">

	<div class="carousel-container carousel-nav-style7">

		<div class="carousel-items row js-flickity product-thumb-carousel" data-flickity='{ "pageDots": false, "prevNextButtons": false, "cellAlign": "left", "contain": true, "asNavFor": ".product-main-image-carousel" }'>
		<?php
		
			if ( $attachment_ids && has_post_thumbnail() ) {
				foreach ( $attachment_ids as $attachment_id ) {
					$full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
					$thumbnail       = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
					$image_title     = get_post_field( 'post_excerpt', $attachment_id );
			
					$attributes = array(
						'title'                   => $image_title,
						'data-src'                => $full_size_image[0],
						'data-rjs'                => $full_size_image[0],
						'data-large_image'        => $full_size_image[0],
						'data-large_image_width'  => $full_size_image[1],
						'data-large_image_height' => $full_size_image[2],
					);
					
					$html  = '<div class="col-md-3 col-sm-4 col-xs-6">';
					$html .= wp_get_attachment_image( $attachment_id, 'shop_single', false, $attributes );
					$html .= '</div><!-- /.col-md-3 col-sm-4 col-xs-6 -->';
			
					echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
				}
			}
		
		?>
	</div><!-- /.carousel-items -->

	</div><!-- /.carousel-container -->
</div><!-- /.thumbnails -->

<?php } ?>