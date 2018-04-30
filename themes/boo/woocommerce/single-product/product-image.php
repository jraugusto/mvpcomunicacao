<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;

$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
$attachment_ids = array();
$gallery_ids = $product->get_gallery_image_ids();

$attachment_ids[] = $post_thumbnail_id;
$attachment_ids = array_merge( $attachment_ids, $gallery_ids );

$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
$image_title       = get_post_field( 'post_excerpt', $post_thumbnail_id );
$placeholder       = has_post_thumbnail() ? 'with-images' : 'without-images';
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . $placeholder,
	'images',
) );

//vertical thumbs classes
$woo_product_style = rella_helper()->get_theme_option( 'woo_single_style' );

if( 'alt' === $woo_product_style ) {

?>
<div class="images thumbs-side">
	
	<div class="row">
		
		<?php do_action( 'woocommerce_product_thumbnails' ); ?>
		
		<div class="col-xs-10 col-xs-offset-2">

			<div class="carousel-container carousel-parallax carousel-nav-style7">
	
				<div class="carousel-items row js-flickity product-main-image-carousel" data-flickity='{ "prevNextButtons": false,"wrapAround": true }'>
	
	
					<?php if( count( $attachment_ids ) > 1 && has_post_thumbnail() )  {
	
						foreach ( $attachment_ids as $attachment_id ) {
							$full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
							$thumbnail       = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
							$image_title     = get_post_field( 'post_excerpt', $attachment_id );
	
							$attributes = array(
								'title'                   => $image_title,
								'data-rjs'                => $full_size_image[0],
								'data-src'                => $full_size_image[0],
								'data-large_image'        => $full_size_image[0],
								'data-large_image_width'  => $full_size_image[1],
								'data-large_image_height' => $full_size_image[2],
								'class' => 'wp-post-image',
							);
	
							$html  = '<div class="col-xs-12">';
							$html .= '<div data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'shop_thumbnail' ) . '" class="woocommerce-product-gallery__image">';
							$html .= wp_get_attachment_image( $attachment_id, 'shop_single', false, $attributes );
							$html .= '<a class="zoom lightbox-link" href="' . esc_url( $full_size_image[0] ) . '" data-type="image" itemprop="image" title=""></a>';
							$html .= '</div>';
							$html .= '</div><!-- /.col-xs-12 -->';
	
							echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
						}
	
					} else {
	
						$attributes = array(
							'title'                   => $image_title,
							'data-rjs'                => $full_size_image[0],
							'data-src'                => $full_size_image[0],
							'data-large_image'        => $full_size_image[0],
							'data-large_image_width'  => $full_size_image[1],
							'data-large_image_height' => $full_size_image[2],
							'class' => 'wp-post-image',
						);
	
						if ( has_post_thumbnail() ) {
							$html  = '<div class="col-xs-12">';
							$html .= '<div data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'shop_thumbnail' ) . '" class="woocommerce-product-gallery__image">';
							$html .= get_the_post_thumbnail( $post->ID, 'shop_single', $attributes );
							$html .= '<a class="zoom lightbox-link" href="' . esc_url( $full_size_image[0] ) . '" data-type="image" itemprop="image" title=""></a>';
							$html .= '</div>';
							$html .= '</div><!-- /.col-xs-12 -->';
						} else {
							$html  = '<div class="col-xs-12 woocommerce-product-gallery__image--placeholder">';
							$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'boo' ) );
							$html .= '<a class="zoom lightbox-link" href="' . esc_url( $full_size_image[0] ) . '" data-type="image" itemprop="image" title=""></a>';
							$html .= '</div>';
						}
	
						echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id( $post->ID ) );
	
					}
				?>
	
				</div><!-- /.carousel-items -->
				
				<?php if( count( $attachment_ids ) > 1 && has_post_thumbnail() ) : ?>
	
				<div class="carousel-nav">
					<button class="flickity-prev-next-button previous"><i class="fa fa-angle-left"></i></button>
					<button class="flickity-prev-next-button next"><i class="fa fa-angle-right"></i></button>
				</div><!-- /.carousel-nav -->
				
				<?php endif; ?>
	
			</div><!-- /.carousel-container -->
		
		</div><!-- /.col-xs-10 -->
	
	</div><!-- /.row -->

</div><!-- /.images -->

<?php } else { ?>

<div class="images">

		<div class="carousel-container carousel-parallax carousel-nav-style7">

			<div class="carousel-items row js-flickity product-main-image-carousel" data-flickity='{ "prevNextButtons": false,"wrapAround": true }'>


				<?php if( count( $attachment_ids ) > 1 && has_post_thumbnail() )  {

					foreach ( $attachment_ids as $attachment_id ) {
						$full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
						$thumbnail       = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
						$image_title     = get_post_field( 'post_excerpt', $attachment_id );

						$attributes = array(
							'title'                   => $image_title,
							'data-rjs'                => $full_size_image[0],
							'data-src'                => $full_size_image[0],
							'data-large_image'        => $full_size_image[0],
							'data-large_image_width'  => $full_size_image[1],
							'data-large_image_height' => $full_size_image[2],
							'class' => 'wp-post-image',
						);

						$html  = '<div class="col-xs-12">';
						$html .= '<div data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'shop_thumbnail' ) . '" class="woocommerce-product-gallery__image">';
						$html .= wp_get_attachment_image( $attachment_id, 'shop_single', false, $attributes );
						$html .= '<a class="zoom lightbox-link" href="' . esc_url( $full_size_image[0] ) . '" data-type="image" itemprop="image" title=""></a>';
						$html .= '</div>';
						$html .= '</div><!-- /.col-xs-12 -->';

						echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
					}

				} else {

					$attributes = array(
						'title'                   => $image_title,
						'data-rjs'                => $full_size_image[0],
						'data-src'                => $full_size_image[0],
						'data-large_image'        => $full_size_image[0],
						'data-large_image_width'  => $full_size_image[1],
						'data-large_image_height' => $full_size_image[2],
						'class' => 'wp-post-image',
					);

					if ( has_post_thumbnail() ) {
						$html  = '<div class="col-xs-12">';
						$html .= '<div data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'shop_thumbnail' ) . '" class="woocommerce-product-gallery__image">';
						$html .= get_the_post_thumbnail( $post->ID, 'shop_single', $attributes );
						$html .= '<a class="zoom lightbox-link" href="' . esc_url( $full_size_image[0] ) . '" data-type="image" itemprop="image" title=""></a>';
						$html .= '</div>';
						$html .= '</div><!-- /.col-xs-12 -->';
					} else {
						$html  = '<div class="col-xs-12 woocommerce-product-gallery__image--placeholder">';
						$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'boo' ) );
						$html .= '<a class="zoom lightbox-link" href="' . esc_url( $full_size_image[0] ) . '" data-type="image" itemprop="image" title=""></a>';
						$html .= '</div>';
					}

					echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id( $post->ID ) );

				}
			?>

			</div><!-- /.carousel-items -->
			
			<?php if( count( $attachment_ids ) > 1 && has_post_thumbnail() ) : ?>

			<div class="carousel-nav">
				<button class="flickity-prev-next-button previous"><i class="fa fa-angle-left"></i></button>
				<button class="flickity-prev-next-button next"><i class="fa fa-angle-right"></i></button>
			</div><!-- /.carousel-nav -->
			
			<?php endif; ?>

		</div><!-- /.carousel-container -->

	<?php do_action( 'woocommerce_product_thumbnails' ); ?>

</div><!-- /.images -->

<?php } ?>