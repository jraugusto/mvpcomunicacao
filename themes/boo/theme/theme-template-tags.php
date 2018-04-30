<?php
/**
 * The Template Tags
 */

/**
 * [rella_get_header_layout description]
 * @method rella_get_header_layout
 * @return [type]                  [description]
 */
function rella_get_header_layout() {
	global $post;

	//Keep old id
	$ID = $post->ID;

	// which one
	$id     = rella_get_custom_header_id();
	$header = get_post( $id );
	$post   = $header;

	$mobile_logo_alignment = get_post_meta( $id, 'mobile_logo_alignment', true );
	$mobile_modules_show   = get_post_meta( $id, 'enable_mobile_modules', true );
	
	$mobile_search_show   = get_post_meta( $id, 'enable_mobile_search', true );
	$mobile_cart_show     = get_post_meta( $id, 'enable_mobile_cart', true );
	$mobile_language_show = get_post_meta( $id, 'enable_mobile_language', true );

	$defaul_classnames = array(
		'main-header',
		'navbar',
		'navbar-default',
		$mobile_logo_alignment,
		$mobile_modules_show,
		$mobile_search_show,
		$mobile_cart_show,
		$mobile_language_show
	);
	
	$overaly_classnames = array(
		'main-header',
		'navbar', 
		'navbar-default',
		'header-overlay',
		$mobile_logo_alignment,
		$mobile_modules_show,
		$mobile_search_show,
		$mobile_cart_show,
		$mobile_language_show
	);

	// Hash
	$header_styles = array(
		'default' => implode( ' ', $defaul_classnames ),
		'overlay' => implode( ' ', $overaly_classnames )
	);

	// layout
	$layout = rella_helper()->get_post_meta( 'header-layout', $id );
	$layout = $layout ? $layout : 'default';

	// Classes
	$class = $header_styles[$layout];
	
	$mobile_toggle = 'false';
	$mobile_toggle_opt = $mobile_modules_show   = get_post_meta( $id, 'mobile_parent_link', true );
	if( 'yes' === $mobile_toggle_opt ) {
		$mobile_toggle = 'true';
	}
	
	// Attributes
	$attributes = array(
		'class' => $class,
		'data-wait-for-images' => 'true',
		'data-add-mobile-submenutoggle' => $mobile_toggle
	);

	// Styles
	$nav = rella_helper()->get_post_meta( 'nav_typography', $id );
	if( (isset( $nav['google'] ) && 'false' === $nav['google']) || 1 === count($nav) ) {
		$nav = rella_helper()->get_theme_option( 'nav_typography' );
	}
	$child_nav = rella_helper()->get_post_meta( 'nav_child_typography', $id );
	if( ( isset( $child_nav['google'] ) && 'false' === $child_nav['google']) || 1 === count( $child_nav ) ) {
		$child_nav = rella_helper()->get_theme_option( 'nav_child_typography' );
	}
	update_post_meta( $ID, '_local_nav_typography', $nav );

	$mobile_nav = rella_helper()->get_post_meta( 'nav_mobile_typography', $id );
	if( (isset( $mobile_nav['google'] ) && 'false' === $mobile_nav['google']) || 1 === count($mobile_nav) ) {
		$mobile_nav = rella_helper()->get_theme_option( 'nav_mobile_typography' );
	}
	$child_mobile_nav = rella_helper()->get_post_meta( 'nav_child_mobile_typography', $id );
	if( ( isset( $child_mobile_nav['google'] ) && 'false' === $child_mobile_nav['google']) || 1 === count( $child_mobile_nav ) ) {
		$child_mobile_nav = rella_helper()->get_theme_option( 'nav_child_mobile_typography' );
	}
	update_post_meta( $ID, '_local_mobile_nav_typography', $mobile_nav );

	$out = array(
		'id' => $id,
		'attributes' => $attributes,
		'layout' => $layout,

		// Styles
		'typography' => $nav,
		'child_typography' => $child_nav,
		'mobile_typography' => $mobile_nav,
		'child_mobile_typography' => $child_mobile_nav,
		'color' => rella_helper()->get_post_meta( 'nav_color' , $id ),
		'secondary_color' => rella_helper()->get_post_meta( 'nav_secondary_color', $id ),
		'active_color' => rella_helper()->get_post_meta( 'nav_active_color', $id ),
		'padding' => rella_helper()->get_post_meta( 'nav_padding', $id ),
		'logo_padding' => get_post_meta( $id, 'nav_logo_padding', true ),
	);

	// reset
	wp_reset_postdata();
	return $out;
}

/**
 * [rella_get_footer_layout description]
 * @method rella_get_footer_layout
 * @return [type]                  [description]
 */
function rella_get_footer_layout() {
	global $post;

	// which one
	$id = rella_get_custom_footer_id();
	$footer = get_post( $id );
	$post = $footer;


	// Styles
	$styles = $out = array();

	if( $bg = rella_helper()->get_post_meta( 'footer-bg', $id ) ) {

		if( isset( $bg['background-color'] ) ) {
			$out['background-color'] = $bg['background-color'];
		}
		if( isset( $bg['background-image'] ) ) {
			$out['background-image'] = 'url(' . $bg['background-image'] . ')' ;
		}
		if( isset( $bg['background-repeat'] ) ) {
			$out['background-repeat'] = $bg['background-repeat'];
		}
		if( isset( $bg['background-position'] ) ) {
			$out['background-position'] = $bg['background-position'];
		}
		if( isset( $bg['background-attachment'] ) ) {
			$out['background-attachment'] = $bg['background-attachment'];
		}

	}

	if( $color = rella_helper()->get_post_meta( 'footer-text-color', $id ) ) {
		if( $color['alpha'] < 1  ) {
			$out['color'] = isset( $color['rgba'] ) ? $color['rgba'] : '';
		} else {
			$out['color'] = isset( $color['color'] ) ? $color['color'] : '';
		}
	}
	if( $padding = rella_helper()->get_post_meta( 'footer-padding', $id ) ) {
		$out['padding'] = $padding;
	}
	if( $link = rella_helper()->get_post_meta( 'footer-link-color', $id ) ) {
		$out['link'] = $link;
	}

	$out = array_filter( $out );

	$out['id'] = $id;

	// reset
	wp_reset_postdata();

	return $out;
}

function get_top_promo_layout() {

	global $post;
	
	$promo_id = rella_helper()->get_option( 'promo-top-template' );

	// reset
	wp_reset_postdata();
	
	return $promo_id;	

}

function get_in_post_promo_layout() {

	global $post;
	$promo_id = rella_helper()->get_option( 'promo-incontent-template' );

	// reset
	wp_reset_postdata();	
	return $promo_id;	

}

/**
 * [rella_portfolio_media description]
 * @method rella_portfolio_media
 * @return [type]                [description]
 */
function rella_portfolio_media( $args = array() ) {

	if ( post_password_required() || is_attachment() ) {
		return;
	}

	$defaults = array(
		'before' => '',
		'after' => '',
		'image_class' => 'portfolio-image'
	);
	extract( wp_parse_args( $args, $defaults ) );

	$format = get_post_format();
	$style = get_post_meta( get_the_ID(), 'portfolio-style', true );
	$style = $style ? $style : 'gallery-stacked';
	$lightbox = rella_helper()->get_option( 'post-gallery-lightbox' );

	// Audio
	if( 'audio' === $format && $audio = rella_helper()->get_option( 'post-audio' ) ) {

		printf( '<div class="post-audio">%s</div>', do_shortcode( '[audio src="' . $audio . '"]' ) );
	}

	// Gallery
	elseif( 'gallery' === $format && $gallery = rella_helper()->get_option( 'post-gallery' ) ) {
		if ( is_array( $gallery ) ) {

			if( in_array( $style, array( 'gallery-stacked', 'gallery-stacked-2', 'gallery-stacked-3', 'gallery-stacked-6' ) ) ) {

				foreach ( $gallery as $item ) {

					if ( !isset ( $item['attachment_id'] ) ) {
						continue;
					}

					$attachment   = get_post( $item['attachment_id'] );
					$retina_image = wp_get_attachment_image_src( $item['attachment_id'], 'large' );
					$full_image   = wp_get_attachment_image_src( $item['attachment_id'], 'full' );

					echo $before . '<figure class="' . $image_class . '" data-element-inview="true">';
						echo '<div class="overlay"></div>';
						echo wp_get_attachment_image( $item['attachment_id'], 'large', false, array(
							'alt' => get_the_title(),
							'data-rjs' => $retina_image[0]
						));
						if( is_object( $attachment ) && ! empty( $attachment->post_excerpt ) ) {
							printf( '<figcaption><span>%s</span></figcaption>', $attachment->post_excerpt );
						}
						if( 'on' === $lightbox ){
							echo rella_get_lightbox_link( $full_image[0] );
						}
					echo '</figure>' . $after;
				}
			}
			elseif( in_array( $style, array( 'gallery-stacked-5' ) ) ) {

				echo '<div class="row listing-lightbox-gallery">';

				$before = '<div class="col-xs-12">';
				$after ='</div>';
				$image_class = 'portfolio-image mb-30';

				foreach ( $gallery as $item ) {

					if ( !isset ( $item['attachment_id'] ) ) {
						continue;
					}

					$attachment = get_post( $item['attachment_id'] );
					$retina_image = wp_get_attachment_image_src( $item['attachment_id'], 'large' );
					$full_image   = wp_get_attachment_image_src( $item['attachment_id'], 'full' );

					echo $before. '<figure class="'. $image_class .'" data-element-inview="true">' ;
						echo '<div class="overlay"></div>';
						echo wp_get_attachment_image( $item['attachment_id'], 'large', false, array(
							'alt' => get_the_title(),
							'data-rjs' => $retina_image[0]
						));
						if( is_object( $attachment ) && ! empty( $attachment->post_excerpt ) ) {
							printf( '<figcaption><span>%s</span></figcaption>', $attachment->post_excerpt );
						}
						if( 'on' === $lightbox ){
							echo rella_get_lightbox_link( $full_image[0] );
						}
					echo '</figure>' . $after;

					// Not first
					$before = '<div class="col-md-6">';
					$image_class = 'portfolio-image';
				}

				echo '</div>';
			}
			elseif( in_array( $style, array( 'masonry' ) ) ) {

				$cols = rella_helper()->get_option( 'masonry-columns' );
				if( ! isset( $cols ) ){
					$cols = '4';
				}

				echo '<div class="row listing-lightbox-gallery" data-plugin-masonry="true">';

					foreach ( $gallery as $item ) {

						if ( !isset ( $item['attachment_id'] ) ) {
							continue;
						}

						$attachment = get_post( $item['attachment_id'] );
						$retina_image = wp_get_attachment_image_src( $item['attachment_id'], 'large' );
						$full_image   = wp_get_attachment_image_src( $item['attachment_id'], 'full' );

						echo $before. '<div class="col-md-' . $cols . ' col-sm-6 col-xs-12 masonry-item"><figure class=" ' . $image_class . ' " data-element-inview="true">' ;
							echo '<div class="overlay"></div>';
							echo wp_get_attachment_image( $item['attachment_id'], 'large', false, array(
								'alt' => get_the_title(),
								'data-rjs' => $retina_image[0]
							));
							if( is_object( $attachment ) && ! empty( $attachment->post_excerpt ) ) {
								printf( '<figcaption><span>%s</span></figcaption>', $attachment->post_excerpt );
							}
							if( 'on' === $lightbox ){
								echo rella_get_lightbox_link( $full_image[0] );
							}
						echo '</figure></div>' . $after;
					}

				echo '</div>';
			}
			elseif( 'gallery-slider' === $style ) {

				echo '<div class="carousel-container carousel-nav-style6">';

					echo '<div class="row carousel-items js-flickity" data-flickity-options=\'{ "initialIndex": 2, "draggable": "false", "prevNextButtons": "false", "pageDots": true,"contain": true, "wrapAround": true, "cellAlign": "center"   }\'>';

						foreach ( $gallery as $item ) {
							if ( isset ( $item['attachment_id'] ) ) {

								$src_image     = wp_get_attachment_image_src( $item['attachment_id'], 'full' );
								$resized_image = rella_get_resized_image_src( $src_image, 'rella-large-slider' );
								$retina_image  = rella_get_retina_image( $resized_image );

								printf( '<div class="col-md-8 col-xs-12"><img src="%s" alt="%s" data-rjs="%s"></div>', $resized_image ,esc_attr( $item['title'] ), $retina_image );

							}
						}

					echo '</div>';

					echo '<div class="carousel-nav"><div class="row"><div class="col-md-8 col-md-offset-2"><button class="flickity-prev-next-button previous"><i class="fa fa-angle-left"></i></button><button class="flickity-prev-next-button next"><i class="fa fa-angle-right"></i></button></div></div></div>';

				echo '</div>';
			}
			elseif( 'gallery-slider-4' === $style ) {

				echo '<div id="gallery-1" class="carousel-container carousel-parallax carousel-nav-style6 gallery gallery-style3 gallery-with-thumb">';

					echo '<div class="carousel-items slides js-flickity" data-flickity-options=\'{ "prevNextButtons": false, "pageDots": false, "contain": true, "selectedAttraction": 0.03, "friction": 0.3, "adaptiveHeight": true}\'>';

						foreach ( $gallery as $item ) {
							if ( isset ( $item['attachment_id'] ) ) {
								$attachment = get_post( $item['attachment_id'] );
								$retina_image = wp_get_attachment_image_src( $item['attachment_id'], 'large' );
								echo '<figure>';

									echo wp_get_attachment_image( $item['attachment_id'], 'large', false, array( 'alt' => esc_attr( $item['title'] ), 'data-rjs' => $retina_image[0] ) );

									if( is_object( $attachment ) && ! empty( $attachment->post_excerpt ) ) {
										printf( '<div class="caption caption-style2"><h4>%s</h4></div>', $attachment->post_excerpt );
									}

								echo '</figure>';
							}
						}

					echo '</div>'; // images

					echo '<div class="thumbs row js-flickity" data-flickity-options=\'{ "asNavFor": "#gallery-1 .slides", "contain": true, "prevNextButtons": false, "pageDots": false }\'>';

						foreach ( $gallery as $item ) {
							if ( isset ( $item['attachment_id'] ) ) {
								$retina_image = wp_get_attachment_image_src( $item['attachment_id'], array( 340, 240 ) );

								echo '<div class="col-md-2 col-sm-3 col-xs-4"><figure>';

									echo wp_get_attachment_image( $item['attachment_id'], array( 170, 120 ), false, array( 'alt' => esc_attr( $item['title'] ), 'data-rjs' => $retina_image[0] ) );

								echo '</figure></div>';
							}
						}

					echo '</div>'; // thumbs

					echo '<div class="carousel-nav"><button class="flickity-prev-next-button previous"><i class="fa fa-angle-left"></i></button><button class="flickity-prev-next-button next"><i class="fa fa-angle-right"></i></button></div>';

				echo '</div>';
			}
			elseif( 'gallery-slider-2' === $style || 'gallery-slider-3' === $style ) {

				echo 'gallery-slider-3' === $style ? '<div class="carousel-container carousel-parallax carousel-nav-style6">' : '<div class="carousel-container carousel-nav-style6">';

					echo '<div class="row carousel-items js-flickity" data-flickity-options=\'{ "prevNextButtons": "false", "pageDots": true, "contain": true, "adaptiveHeight": true  }\'>';

						foreach ( $gallery as $item ) {
							if ( isset ( $item['attachment_id'] ) ) {
								$retina_image = wp_get_attachment_image_src( $item['attachment_id'], 'large' );
								printf( '<div class="col-xs-12 no-padding">%s</div>', wp_get_attachment_image( $item['attachment_id'], 'large', false, array( 'alt' => esc_attr( $item['title'] ), 'data-rjs' => $retina_image[0] ) ) );
							}
						}

					echo '</div>';

					echo '<div class="carousel-nav"><button class="flickity-prev-next-button previous"><i class="fa fa-angle-left"></i></button><button class="flickity-prev-next-button next"><i class="fa fa-angle-right"></i></button></div>';

				echo '</div>';
			}
		}
	}

	// Video
	elseif( 'video' === $format ) {
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
				'align' => true,
				'width' => true,
				'height' => true,
				'frameborder' => true,
				'name' => true,
				'src' => true,
				'id' => true,
				'class' => true,
				'style' => true,
				'scrolling' => true,
				'marginwidth' => true,
				'marginheight' => true,
			);

			echo wp_kses( $video, $my_allowed );
		}

	}

	else {

		$attachment = get_post( get_post_thumbnail_id() );

		echo $before. '<figure class="'. $image_class .'" data-element-inview="true">' ;
			echo '<div class="overlay"></div>';
			rella_the_post_thumbnail( 'rella-large', array(
			));
			if( is_object( $attachment ) && ! empty( $attachment->post_excerpt ) ) {
				printf( '<figcaption><span>%s</span></figcaption>', $attachment->post_excerpt );
			}
		echo '</figure>' . $after;
	}
}

/**
 * [rella_portfolio_meta description]
 * @method rella_portfolio_meta
 * @param  [type]               $key   [description]
 * @param  [type]               $label [description]
 * @return [type]                      [description]
 */
function rella_portfolio_meta( $key, $label, $col = 6 ) {

	$value = get_post_meta( get_the_ID(), 'portfolio-' . $key, true );
	if( !$value ) {
		return;
	}
	?>
	<div class="col-md-<?php echo esc_attr( $col ) ?>">

		<p>
			<strong class="info-title"><?php echo esc_html( $label ) ?>:</strong> <?php echo esc_html( $value ); ?>
		</p>

	</div>
	<?php
}

/**
 * [rella_portfolio_atts description]
 * @method rella_portfolio_date
 * @return [type]               [description]
 */
function rella_portfolio_atts( $col = 6 ) {

	$atts = get_post_meta( get_the_ID(), 'portfolio-attributes', true );
	if( ! is_array( $atts ) ) {
		return;
	}
	foreach ( $atts as $attr ) {

		if( ! empty( $attr ) ) {
			$attr = explode( "|", $attr );
			$label = isset( $attr[0] ) ? $attr[0] : '';
			$value = isset( $attr[1] ) ? $attr[1] : $label;
		?>
		<div class="col-md-<?php echo $col ?>">
			<p>
				<?php if( $label ) { ?><strong class="info-title"><?php echo esc_html( $label ) ?>:</strong><?php } ?> <?php echo esc_html( $value ); ?>
			</p>
		</div>
		<?php

		}
	}
}


/**
 * [rella_portfolio_archive_link description]
 * @method rella_portfolio_archive_link
 * @return [type]               [description]
 */
function rella_portfolio_archive_link() {

	$pf_link         = rella_helper()->get_option( 'portfolio-archive-link' );
	$pf_archive_link = get_post_type_archive_link( 'rella-portfolio' );

	$link = ! empty( $pf_link ) ? $pf_link : $pf_archive_link;
	?>
	<a href="<?php echo esc_url( $link ) ?>" class="portfolio-view-all"><span></span></a>
	<?php
}

/**
 * [rella_portfolio_date description]
 * @method rella_portfolio_date
 * @return [type]               [description]
 */
function rella_portfolio_date( $col = 6 ) {

	if( 'off' === rella_helper()->get_option( 'portfolio-enable-date' ) ) {
		return;
	}

	$label = rella_helper()->get_option( 'portfolio-date-label' ) ? rella_helper()->get_option( 'portfolio-date-label' ) : esc_html__( 'Date', 'boo' );
	$date = rella_helper()->get_option( 'portfolio-date' ) ? rella_helper()->get_option( 'portfolio-date' ) : get_the_date();
	?>
	<div class="col-md-<?php echo $col ?>">
		<p>
			<?php if( $label ) { ?><strong class="info-title"><?php echo esc_html( $label ) ?>:</strong><?php } ?> <?php echo esc_html( $date ) ?>
		</p>
	</div>
	<?php
}

/**
 * [rella_portfolio_likes description]
 * @method rella_portfolio_likes
 * @return [type]                [description]
 */
function rella_portfolio_likes( $class = 'portfolio-likes style-alt', $post_type = 'portfolio' ) {

	$option_name = str_replace( 'rella-', '', $post_type ) . '-likes-';
	if( 'off' === rella_helper()->get_option( $option_name . 'enable' ) || ! function_exists( 'rella_likes_button' ) ) {
		return;
	}

	rella_likes_button(array(
		'container' => 'div',
		'container_class' => $class,
		'format' => wp_kses_post( __( '<span><i class="fa fa-heart"></i> <span class="post-likes-count">%s</span></span>', 'boo' ) )
	));
}

/**
 * [rella_get_lightbox_link]
 * @method rella_get_lightbox_link
 * @return [type]                [description]
 */
function rella_get_lightbox_link( $link_to_image ) {
	if( empty( $link_to_image ) ) {
		return;
	}

	return '<a class="lightbox-link" data-type="image" href="' . esc_url( $link_to_image ) . '"></a>';
}

/**
 * [rella_render_related_posts description]
 * @method rella_render_related_posts
 * @param  string                     $post_type [description]
 * @return [type]                                [description]
 */
function rella_render_related_posts( $post_type = 'post' ) {

	$folder = str_replace( 'rella-', '', $post_type );
	$option_name = $folder . '-related-';
	if( 'off' === rella_helper()->get_option( $option_name . 'enable' ) ) {
		return;
	}

	$data_effect = $data_stacking = '';
	if( 'on' === rella_helper()->get_option( 'portfolio-related-effect' ) ) {
		$data_effect   = 'data-hover3d="true"';
		$data_stacking = 'data-stacking-factor="0.8"';
	}

	$heading = rella_helper()->get_option( $option_name . 'title', 'html' );
	$number_of_posts = rella_helper()->get_option( $option_name . 'number' );
	$number_of_posts = '0' == $number_of_posts ? '-1' : $number_of_posts;
	$taxonomy = 'post' === $post_type ? 'category' : $post_type . '-category';

	$related_posts = rella_get_post_type_related_posts( get_the_ID(), $number_of_posts, $post_type, $taxonomy );

	if( $related_posts && $related_posts->have_posts() ) {
		$located = locate_template( array(
			'templates/related-'. $folder .'.php',
			'templates/related-posts.php'
		) );

		if( $located ) require $located;
	}
}

/**
 * [rella_get_post_type_related_posts description]
 * @method rella_get_post_type_related_posts
 * @param  [type]                            $post_id      [description]
 * @param  integer                           $number_posts [description]
 * @param  string                            $post_type    [description]
 * @param  string                            $taxonomy     [description]
 * @return [type]                                          [description]
 */
function rella_get_post_type_related_posts( $post_id, $number_posts = 6, $post_type = 'post', $taxonomy = 'category' ) {

	if( 0 == $number_posts ) {
		return false;
	}

	$item_array = array();
	$item_cats = get_the_terms( $post_id, $taxonomy );
	if ( $item_cats ) {
		foreach( $item_cats as $item_cat ) {
			$item_array[] = $item_cat->term_id;
		}
	}

	if( empty( $item_array ) ) {
		return false;
	}

	$args = array(
		'post_type'				=> $post_type,
		'posts_per_page'		=> $number_posts,
		'post__not_in'			=> array( $post_id ),
		'ignore_sticky_posts'	=> 0,
		'tax_query'				=> array(
			array(
				'field'		=> 'id',
				'taxonomy'	=> $taxonomy,
				'terms'		=> $item_array
			)
		)
	);

	return new WP_Query( $args );
}

/**
 * [rella_render_post_nav description]
 * @method rella_render_post_nav
 * @param  string                $post_type [description]
 * @return [type]                           [description]
 */
function rella_render_post_nav( $post_type = 'post' ) {

	$post_type = str_replace( 'rella-', '', $post_type );
	if( 'off' === rella_helper()->get_option( $post_type . '-navigation-enable' ) ) {
		return;
	}

	$post_type = 'post' === $post_type ? 'blog' : $post_type;
	get_template_part( 'templates/'. $post_type .'/single/navigation' );
}

/**
 * [rella_portfolio_the_content description]
 * @method rella_portfolio_the_content
 * @return [type]                      [description]
 */
function rella_portfolio_the_content() {

	$content = get_post_meta( get_the_ID(), 'portfolio-description', true );
	if( $content ) {
		echo apply_filters( 'the_content', $content );
		return;
	}

	$content = get_the_content();
	if( rella_helper()->str_contains( '[vc_row', $content ) ) {
		return;
	}

	the_content( sprintf(
		esc_html__( 'Continue reading %s', 'boo' ),
		the_title( '<span class="screen-reader-text">', '</span>', false )
	) );
}

/**
 * [rella_portfolio_the_excerpt description]
 * @method rella_portfolio_the_content
 * @return [type]                      [description]
 */
function rella_portfolio_the_excerpt() {

	$excerpt = get_post_meta( get_the_ID(), 'portfolio-description', true );
	if( $excerpt ) {
		$excerpt = apply_filters( 'get_the_excerpt', $excerpt );
		$excerpt = apply_filters( 'the_excerpt', $excerpt );
		echo $excerpt;
		return;
	}

	$excerpt = get_the_excerpt();
	if( rella_helper()->str_contains( '[vc_row', $excerpt ) ) {
		return;
	}

	the_excerpt( sprintf(
		esc_html__( 'Continue reading %s', 'boo' ),
		the_title( '<span class="screen-reader-text">', '</span>', false )
	) );
}


/**
 * [rella_portfolio_the_vc description]
 * @method rella_portfolio_the_vc
 * @return [type]                 [description]
 */
function rella_portfolio_the_vc() {

	$content = get_the_content();
	if( !rella_helper()->str_contains( '[vc_row', $content ) ) {
		return;
	}

	the_content( sprintf(
		esc_html__( 'Continue reading %s', 'boo' ),
		the_title( '<span class="screen-reader-text">', '</span>', false )
	) );
}

/**
 * [rella_author_link description]
 * @method rella_author_link
 * @param  array             $args [description]
 * @return [type]                  [description]
 */
function rella_author_link( $args = array() ) {

	global $authordata;
    if ( ! is_object( $authordata ) ) {
        return;
    }

	$defaults = array(
		'before' => '<i class="fa fa-user"></i> ',
		'after' => ''
	);
	extract( wp_parse_args( $args, $defaults ) );

	$link = sprintf(
        '<a class="url fn" href="%1$s" title="%2$s" rel="author">%3$s</a>',
        esc_url( get_author_posts_url( $authordata->ID, $authordata->user_nicename ) ),
        esc_attr( sprintf( esc_html__( 'Posts by %s', 'boo' ), get_the_author() ) ),
        $before . get_the_author() . $after
    );
	?>
	<span <?php rella_helper()->attr( 'entry-author', array( 'class' => 'vcard author' ) ); ?>>
		<span itemprop="name">
			<?php echo $link ?>
		</span>
	</span>
	<?php
}

/**
 * [rella_floated_share_box]
 * @method rella_floated_share_box
 * @return [type]            [description]
 */
function rella_floated_share_box() {
	
	$enable = rella_helper()->get_option( 'post-floated-box-enable' );
	if( 'on' !== $enable ) {
		return;
	}
	$url = get_the_permalink();
	
	?>
	<div class="post-share floated">
		<div class="post-share-inner" data-sticky-element="true">
			<p><?php esc_html_e( 'Share', 'boo' ); ?></p>
			<ul class="social-icon circle vertical branded">
				<li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( $url ) ?>"><i class="fa fa-facebook"></i></a></li>
				<li><a target="_blank" href="https://twitter.com/home?status=<?php echo esc_url( $url ) ?>"><i class="fa fa-twitter"></i></a></li>
				<li><a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url( $url ) ?>&amp;title=<?php echo get_the_title(); ?>&amp;source=<?php echo get_bloginfo( 'name' ); ?>"><i class="fa fa-linkedin"></i></a></li>
				<li><a href="mailto:?subject=<?php echo get_the_title(); ?>&amp;body=<?php echo esc_url( $url ) ?>" title="<?php esc_html_e( 'Send this article to a friend!', 'boo' ); ?>"><i class="fa fa-envelope"></i></a></li>
			</ul>
		</div><!-- /.post-share-inner -->
	</div> <!-- /.post-share floated -->	
<?php
}

/**
 * [rella_author_role description]
 * @method rella_author_role
 * @return [type]            [description]
 */
function rella_author_role() {

	global $authordata;
    if ( ! is_object( $authordata ) ) {
        return;
    }

	$user = new WP_User( $authordata->ID );
    return array_shift( $user->roles );
}

if ( ! function_exists( 'rella_post_time' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time.
 */
function rella_post_time( $icon = false, $echo = true ) {

	$time_string = '<time %5$s >%2$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() ),
		rella_helper()->get_attr( 'entry-published' )
	);

	$time_url = get_day_link( get_post_time( 'Y' ), get_post_time( 'm' ), get_post_time( 'j' ) );
	$icon_html = $icon ? '<i class="fa fa-clock-o"></i>' : '';

	$out = sprintf( '<a href="%1$s">%3$s %2$s</a>', get_the_permalink(), $time_string, $icon_html );

	if( $echo ) {
		echo $out;
	} else {
		return $out;
	}
}
endif;
