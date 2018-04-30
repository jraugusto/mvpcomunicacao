<?php
/** The Media
 * Contains all the Media functions
 *
 * Table of Content
 *
 */

/**
 * [rella_get_the_small_image]
 * @function rella_get_the_small_image
 * @param  string $src [description]
 * @param  string $width [description]
 * @param  string $height [description]
 * @return string $small_image [description]
 */
function rella_get_the_small_image( $src ) {
	
	if( empty( $src )  ){
		return;
	}
	
	@list( $width, $height ) = getimagesize( $src );
	
	if( ! $width ) {
		return $src;
	}
	elseif( $width > $height ) {
		$image_ratio = $height / $width;
		$width = 30;
		$height = 30 * $image_ratio;
	}
	elseif( $width < $height ) {
		$image_ratio = $width / $height;
		$height = 30;
		$width = 30 * $image_ratio;
	}
	elseif( $width == $height ) {
		$width  = 30;
		$height = 30;
	}

	$small_image = aq_resize( $src, $width, $height, false );

	return $small_image;	

}

function rella_get_retina_image( $image, $size = null ) {

	if( empty( $image ) ) {
		return;
	}

	if( $size ) {
		//Get image sizes
		$aq_size = rella_image_sizes( $size );
		$width  = $aq_size['width'];
		$height = $aq_size['height'];	
	}
	else {
		@list( $width, $height ) = getimagesize( $image );

	}
	
	//Double the size for the retina display
	$retina_width   = $width * 2;
	$retina_height  = $height * 2;

	$retina_src = aq_resize( $image, (int)$retina_width, (int)$retina_height, true, true, true );
	
	return $retina_src;
	
}

function rella_the_post_thumbnail( $size = 'rella-thumbnail', $attr = '', $retina = true ) {
	
	$html = '';
	$attachment_id = get_post_thumbnail_id();
	$image         = wp_get_attachment_image_src( $attachment_id, 'full', false );
	
	if ( $image ) {
		
		@list( $src, $width, $height ) = $image;
		
		//Get image sizes
		$aq_size = rella_image_sizes( $size );

        if( is_array( $aq_size ) && ! empty( $aq_size['height'] ) ) {

			$resize_width  = $aq_size['width'];
			$resize_height = $aq_size['height'];
			$resize_crop   = $aq_size['crop'];
			
			if( $resize_width >= $width ) {
				$resize_width = $width;
			}
			if( $resize_height >= $height && ! empty( $resize_height ) ) {
				$resize_height = $height;
			}
			
			//Double the size for the retina display
			$retina_width   = $resize_width * 2;
			$retina_height  = $resize_height * 2;
			if( $retina_width >= $width ) {
				$retina_width = $width;
			}
			if( $retina_height >= $height ) {
				$retina_height = $height;
			}
			
			//Get resized images
			$retina_src  = aq_resize( $src, $retina_width, $retina_height, true );
			$resized_src = aq_resize( $src, $resize_width, $resize_height, $resize_crop );
			if( ! empty( $resized_src ) ) {
				$src = 	$resized_src;		
			}
			
			$hwstring = image_hwstring( $resize_width, $resize_height );
			
			if( ! $retina ) {
				$retina_src = $src;
			}

        } else {
	        $retina_src = $src;
			$hwstring = image_hwstring( $width, $height );
        }

        $size_class = $size;
        if ( is_array( $size_class ) ) {
            $size_class = join( 'x', $size_class );
        }
        $attachment = get_post($attachment_id);
        $default_attr = array(
            'src'   => $src,
            'class' => "attachment-$size_class size-$size_class",
            'alt'   => get_the_title(),
            'data-rjs' => $retina_src,
        );
 
        $attr = wp_parse_args( $attr, $default_attr );
 
		$attr = apply_filters( 'wp_get_attachment_image_attributes', $attr, $attachment, $size );
		
		$attr = array_map( 'esc_attr', $attr );
        $html = rtrim("<img $hwstring");
        foreach ( $attr as $name => $value ) {
            $html .= " $name=" . '"' . $value . '"';
        }
        $html .= ' />';
    }

    echo $html;
}

function rella_get_resized_image_src( $original_src, $size = 'rella-thumbnail' ) {
	
	if( empty( $original_src) ) {
		return;
	}

	@list( $src, $width, $height ) = $original_src;
	//Get image sizes
	$aq_size = rella_image_sizes( $size );

	if( ! empty( $aq_size ) ) {

		$resize_width  = $aq_size['width'];
		$resize_height = $aq_size['height'];
		$resize_crop   = $aq_size['crop'];
		
		if( $resize_width >= $width ) {
			$resize_width = $width;
		}
		if( $resize_height >= $height && ! empty( $resize_height ) ) {
			$resize_height = $height;
		}

		//Get resized images
		$resized_src = aq_resize( $src, $resize_width, $resize_height, $resize_crop );
	}
	else {
		return $src;
	}
	return $resized_src;
	
}


/**
 * [rella_image_sizes description]
 * @method rella_image_sizes
 * @param  array $image_sizes [description]
 * @return array $image_sizes [description]
 */
function rella_image_sizes( $size ) {
	
	$sizes = array(
		'rella-medium'          => array( 'width'  => '300', 'height' => '300',  'crop' => true ),
		'rella-large'           => array( 'width'  => '1024', 'height' => '',    'crop' => false ),
		'rella-large-slider'    => array( 'width'  => '1024', 'height' => '700', 'crop' => true ),
		'rella-default-blog'    => array( 'width'  => '690',  'height' => '460', 'crop' => true ), 
		'rella-thumbnail'       => array( 'width'  => '150',  'height' => '150', 'crop' => true ),
		'rella-agency-blog'     => array( 'width'  => '370',  'height' => '270', 'crop' => true ),
		'rella-cloud-blog'      => array( 'width'  => '370',  'height' => '205', 'crop' => true ),
		'rella-shop-blog'       => array( 'width'  => '370',  'height' => '300', 'crop' => true ),
		'rella-dhover-blog'     => array( 'width'  => '370',  'height' => '370', 'crop' => true ),
		'rella-medium-blog'     => array( 'width'  => '740',  'height' => '640', 'crop' => true ),
		'rella-university-blog' => array( 'width'  => '400',  'height' => '280', 'crop' => true ),
		'rella-classic-blog'    => array( 'width'  => '750',  'height' => '440', 'crop' => true ),
		'rella-widget'          => array( 'width'  => '180',  'height' => '180', 'crop' => true ),
		'rella-trend-widget'    => array( 'width'  => '320',  'height' => '185', 'crop' => true ),
		'rella-slider-nav'      => array( 'width'  => '180',  'height' => '130', 'crop' => true ),
		'rella-masonry-blog'    => array( 'width'  => '450',  'height' => '',    'crop' => false ),
		
		'rella-masonry-header-small' => array( 'width'  => '295',  'height' => '220', 'crop' => true ),
		'rella-masonry-header-big'   => array( 'width'  => '295',  'height' => '440', 'crop' => true ),
		
		'rella-timeline-blog'   => array( 'width'  => '470', 'height' => '',    'crop' => false ),	
		'rella-puzzle-blog'     => array( 'width'  => '300', 'height' => '300', 'crop' => true ),	
		'rella-split-blog'      => array( 'width'  => '385', 'height' => '450', 'crop' => true ),
		'rella-featured-blog'  	=> array( 'width'  => '360', 'height' => '220', 'crop' => true ),
		'rella-thumbnail-post'  => array( 'width'  => '765', 'height' => '400', 'crop' => true ),
		
		'rella-small-blog'  	=> array( 'width'  => '388', 'height' => '240', 'crop' => true ),
		'rella-split-alt-blog'  => array( 'width'  => '720', 'height' => '440', 'crop' => true ),

		'rella-related-post'           => array( 'width'  => '370',  'height' => '190', 'crop' => true ),
		'rella-related-post-three-col' => array( 'width'  => '488',  'height' => '230', 'crop' => true ),
		'rella-related-post-two-col'   => array( 'width'  => '730',  'height' => '425', 'crop' => true ),
		'rella-related-post-one-col'   => array( 'width'  => '1463', 'height' => '640', 'crop' => true ),

		//Portfolio sizes
		'rella-portfolio'                    => array( 'width'  => '480', 'height' => '480',  'crop' => true ),
		'rella-portfolio-sq'                 => array( 'width'  => '285', 'height' => '285',  'crop' => true ),
		'rella-portfolio-big-sq'             => array( 'width'  => '570', 'height' => '570',  'crop' => true ),
		'rella-portfolio-portrait'           => array( 'width'  => '285', 'height' => '570',  'crop' => true ),
		'rella-portfolio-double-portrait'    => array( 'width'  => '570', 'height' => '1140', 'crop' => true ),
		'rella-portfolio-portrait-tall'      => array( 'width'  => '570', 'height' => '867',  'crop' => true ),
		'rella-portfolio-wide'               => array( 'width'  => '570', 'height' => '285',  'crop' => true ),
		'rella-portfolio-related'            => array( 'width'  => '285', 'height' => '275',  'crop' => true ),
		'rella-portfolio-grid-hover-elegant' => array( 'width'  => '720', 'height' => '560',  'crop' => true ),

		'rella-portfolio-full'      => array( 'width'  => '1463', 'height' => '', 'crop' => false ),		
		'rella-portfolio-one-col'   => array( 'width'  => '1463', 'height' => '', 'crop' => false ),
		'rella-portfolio-two-col'   => array( 'width'  => '731',  'height' => '', 'crop' => false ),
		'rella-portfolio-three-col' => array( 'width'  => '488',  'height' => '', 'crop' => false ),
		'rella-portfolio-four-col'  => array( 'width'  => '366',  'height' => '', 'crop' => false ),
		'rella-portfolio-six-col'   => array( 'width'  => '244',  'height' => '', 'crop' => false ),
		
		'rella-full-6'   => array( 'width'  => '555',  'height' => '400', 'crop' => true ),
		
		

		'rella-gallery-large'  => array( 'width'  => '1170', 'height' => '500', 'crop' => true ),
		'rella-gallery-nav'    => array( 'width'  => '70',   'height' => '70',  'crop' => true ),

		'rella-woo-elegant'         => array( 'width'  => '360', 'height' => '470', 'crop' => true ),
		
	);
	
	$image_sizes = ! empty( $sizes[ $size ] ) ? $sizes[ $size ] : '';

	return $image_sizes;
}