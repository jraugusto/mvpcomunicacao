<?php

global $post;

$style = rella_helper()->get_option( 'post-style', 'default' );
if( empty( $style) ) {
	$style = 'default';
}
$format = get_post_format();
if( current_theme_supports( 'theme-demo' ) && !empty( $_GET['ps'] ) ) {
	$style = $_GET['ps'];
}
if( 'video' === $format && class_exists( 'ReduxFramework' ) ){
	$style = 'cover';
}
elseif( 'audio' === $format && class_exists( 'ReduxFramework' ) ){
	$style = 'minimal';
}

if( 'default' === $style && 'gallery' === $format && class_exists( 'ReduxFramework' ) ) :

?>
<?php

	$gallery = rella_helper()->get_option( 'post-gallery' );
	if ( is_array( $gallery ) ) {
		wp_enqueue_script( 'flickity' );

?>
	<figure class="post-image hmedia">
		<div class="carousel-container carousel-parallax carousel-nav-style4">
			<div class="carousel-items"  data-flickity='{ "adaptiveHeight": true, "pageDots": false }' >

			<?php
				foreach ( $gallery as $item ) {
					if ( isset ( $item['image'] ) ) {
					$img_src = $item['image'];
					    if( isset( $img_src ) ) { //don't print empty markup
			?>
				<div class="carousel-item">
					<?php
						printf( '<img src="%s" alt="" />', esc_url( $img_src ) );
					?>
				</div><!-- /.carousel-item -->
			<?php
		                 }
					}
				}
			?>

			</div><!-- /.carousel-items -->
			<div class="carousel-nav">
				<button class="flickity-prev-next-button previous"><i class="fa fa-angle-left"></i></button>
				<button class="flickity-prev-next-button next"><i class="fa fa-angle-right"></i></button>
			</div><!-- /.carousel-nav -->

		</div><!-- /.carousel-container -->

		<?php the_tags( '<div class="tags">', esc_html_x( ', ', 'Used between list items, there is a space after the comma.', 'boo' ), '</div>' ); ?>

	</figure><!-- /.main-image -->
<?php } ?>
<?php

	elseif( 'default' === $style ) :

?>
<?php if( '' !== get_the_post_thumbnail() ) { ?>
	<figure class="post-image hmedia">
		<div itemprop="image" itemscope="itemscope" itemtype="http://schema.org/ImageObject">
	<?php
		if( '' !== get_the_post_thumbnail() ) {
			
			rella_the_post_thumbnail( 'rella-thumbnail-post', array( 'itemprop' => 'url' ) );

			$categories_list = get_the_category();
			if( '' != $categories_list ) :
				echo '<div class="tags"><a rel="category" href="' . esc_url( get_category_link( $categories_list[0]->term_id ) ) . '">' . esc_html( $categories_list[0]->name ) . '</a></div>';
			endif;
		}
	?>
		</div>
	</figure>
	<?php }; ?>

<?php else : ?>

	<?php

	switch( $format ) {
		case 'video':

	?>
	<div class="post-video">
	<?php
			$video = '';
			if( $url = rella_helper()->get_option( 'post-video-url', 'url' ) ) {
				global $wp_embed;
				echo $wp_embed->run_shortcode( '[embed]' . $url . '[/embed]' );
			}
			elseif( $file = rella_helper()->get_option( 'post-video-file' ) ) {
				if( rella_helper()->str_contains( '[embed', $file ) ) {
					global $wp_embed;
					echo $wp_embed->run_shortcode( $file );
				} else {
					echo do_shortcode( $file );
				}
			}
			else {
				$video = rella_helper()->get_option( 'post-video-html' );
			}

			if( '' != $video ) {
				$my_allowed = wp_kses_allowed_html( 'post' );

				// iframe
				$my_allowed['iframe'] = array(
					'align'        => true,
					'width'        => true,
					'height'       => true,
					'frameborder'  => true,
					'name'         => true,
					'src'          => true,
					'id'           => true,
					'class'        => true,
					'style'        => true,
					'scrolling'    => true,
					'marginwidth'  => true,
					'marginheight' => true,
				);

				echo wp_kses( $video, $my_allowed );
			}

		?>
	</div>
	<?php

		break;
		default;
		case 'image':

		if( rella_helper()->get_option( 'enable-lazy-load' ) ) {
			$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
			$url = rella_get_the_small_image( $image_src[0] );

		} else {
			$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
			$url = $image_src[0];
		}
	?>
	<?php if( '' !== get_the_post_thumbnail() ) :
			
			$enable_parallax = rella_helper()->get_option( 'post-parallax-enable' );
		
		?>
		<?php if( 'off' !== $enable_parallax ) { ?>
				<figure class="post-image hmedia" style="background-image: url(<?php echo $url ?>);" data-parallax-bg="true" data-parallax-options='{ "y": "-20%", "opacity": 1 }'>
					<?php the_post_thumbnail( 'full', array( 'itemprop' => 'url' ) ); ?>
				</figure><!-- /.main-image -->
			<?php } else { ?>
				<figure class="post-image hmedia">
					<?php the_post_thumbnail( 'full', array( 'class' => 'post-image background-image', 'itemprop' => 'url' ) ); ?>
				</figure><!-- /.main-image -->			

			<?php } ?>
			
		<?php endif; ?>
	<?php

		break;
	}

	?>

<?php endif; ?>
