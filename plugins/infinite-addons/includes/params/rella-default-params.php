<?php
/**
* Default Params
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * [rella_default_params description]
 * @method rella_default_params
 * @return [type]               [description]
 */
function rella_default_params() {

	$params = array(

		'title' => array(
			'type'          => 'textfield',
			'param_name'	=> 'title',
			'heading'		=> esc_html__( 'Title', 'infinite-addons' ),
			'admin_label'	=> true
		),

		'label' => array(
			'type'			=> 'textfield',
			'param_name'	=> 'label',
			'heading'		=> esc_html__( 'Label', 'infinite-addons' ),
			'admin_label'	=> true
		),

		'limit' => array(
			'type'        => 'textfield',
			'param_name'  => 'limit',
			'heading'     => esc_html__( 'Limit', 'infinite-addons' ),
			'admin_label' => true
		),

		'link' => array(
			'type'        => 'vc_link',
			'param_name'  => 'link',
			'heading'     => esc_html__( 'URL (Link)', 'infinite-addons' ),
			'description' => esc_html__( 'Add link to button.', 'infinite-addons' )
		),

		'network' => array(
			'type'       => 'dropdown',
			'param_name' => 'network',
			'heading'    => esc_html__( 'Network', 'infinite-addons' ),
			'value'      => array(
				esc_html__( 'Facebook', 'infinite-addons' )	=> 'facebook',
				esc_html__( 'Facebook Square', 'infinite-addons' ) => 'facebook-square',
				esc_html__( 'Twitter', 'infinite-addons' )	=> 'twitter',
				esc_html__( 'Youtube', 'infinite-addons' )   => 'youtube',
				esc_html__( 'Youtube Play', 'infinite-addons' ) => 'youtube-play',
				esc_html__( 'Google' )                  => 'google',
				esc_html__( 'Instagram', 'infinite-addons' ) => 'instagram',
				esc_html__( 'Behance', 'infinite-addons' )	=> 'behance',
				esc_html__( 'Dribbble', 'infinite-addons' )	=> 'dribbble',
				esc_html__( 'Flickr', 'infinite-addons' )    => 'flickr',
				esc_html__( 'Google +', 'infinite-addons' )	=> 'google-plus',
				esc_html__( 'Github', 'infinite-addons' )	=> 'github',
				esc_html__( 'Linkedin', 'infinite-addons' )	=> 'linkedin',
				esc_html__( 'Pinterest', 'infinite-addons' ) => 'pinterest',
				esc_html__( 'RSS', 'infinite-addons' )	    => 'rss',
				esc_html__( 'Skype', 'infinite-addons' )	    => 'skype',
				esc_html__( 'Vimeo', 'infinite-addons' )     => 'vimeo',
			),
			'admin_label' => true
		)
	);

	ra_helper()->add_params($params);
}
rella_default_params(); // Init


/**
 * [rella_get_link_attributes description]
 * @method rella_get_link_attributes
 * @param  [type]                    $link     [description]
 * @param  boolean                   $fallback [description]
 * @return [type]                              [description]
 */
function rella_get_link_attributes( $link, $fallback = true ) {

	// fallback to home_url
	$attributes['href'] = $fallback && is_bool( $fallback ) ? esc_url( home_url('/') ) : $fallback;

	// Link
	$link = ( '||' === $link ) ? '' : $link;
	$link = vc_build_link( $link );
	if ( strlen( $link['url'] ) > 0 ) {

		$attributes['href'] = esc_url( trim( $link['url'] ) );
		$attributes['title'] = esc_attr( trim( $link['title'] ) );
			if ( ! empty( $link['target'] ) ) {
				$attributes['target'] = esc_attr( trim( $link['target'] ) );
			}
	}

	return $attributes;
}

/**
 * [rella_get_image description]
 * @method rella_get_image
 * @param  [type]          $attachment_id [description]
 * @return [type]                         [description]
 */
function rella_get_image( $attachment_id ) {

	if( ! $attachment_id || ! is_numeric( $attachment_id ) ) {
		return '';
	}

	$url = wp_get_attachment_url( $attachment_id );

	return $url ? esc_url( $url ) : false;
}

/**
 * [rella_get_image_src description]
 * @method rella_get_image_src
 * @param  [type]              $attachment_id [description]
 * @return [type]                             [description]
 */
function rella_get_image_src( $attachment_id, $size = 'full' ) {

	if( ! $attachment_id || ! is_numeric( $attachment_id ) ) {
		return '';
	}

	$attachment = wp_get_attachment_image_src( $attachment_id, $size );
	if( !empty( $attachment ) && !empty( $attachment[0] ) ) {
		$attachment[0] = esc_url( $attachment[0] );
	}
	else {
		$attachment = false;
	}

	return $attachment;
}

/**
 * [rella_include_svg description]
 * @method rella_include_svg
 * @param  [type]            $attachment_id [description]
 * @return [type]                           [description]
 */
function rella_include_svg( $attachment_id ) {

	if( ! $attachment_id || ! is_numeric( $attachment_id ) ) {
		return '';
	}

	$url = get_attached_file( $attachment_id );

	return $url ? $url : false;
}

/**
 * [rella_get_parallax_preset description]
 * @method rella_get_parallax_preset
 * @param  [type]                  $preset [description]
 * @return [type]                           [description]
 */
function rella_get_parallax_preset( $preset ) {

	$hash = array(

		'fadeIn' => array(
			'from' => array( 'opacity' => 0, 'y' => 0 ),
			'to'   => '',
		),
		'fadeInDownLong' => array(
			'from' => array( 'y' => '-100%', 'opacity' => 0 ),
			'to'   => array( 'y' => '0%', 'opacity' => 1 ),
		),
		'fadeInDownShort' => array(
			'from' => array( 'opacity' => 0, 'y' => -35 ),
			'to'   => '',
		),
		'fadeInLeftLong' => array(
			'from' => array( 'y' => 0, 'x' => '-100%', 'opacity' => 0 ),
			'to'   => array( 'x' => '0%', 'opacity' => 1 ),
		),
		'fadeInLeftShort' => array(
			'from' => array( 'y' => 0, 'x' => -35, 'opacity' => 0 ),
			'to'   => '',
		),
		'fadeInRightLong' => array(
			'from' => array( 'y' => 0, 'x' => '100%', 'opacity' => 0 ),
			'to'   => array( 'x' => '0%', 'opacity' => 1 ),
		),
		'fadeInRightShort' => array(
			'from' => array( 'y' => 0, 'x' => 35, 'opacity' => 0 ),
			'to'   => '',
		),
		'fadeInUpLong' => array(
			'from' => array( 'y' => '100%', 'opacity' => 0 ),
			'to'   => array( 'y' => '0%', 'opacity' => 1 ),
		),
		'fadeInUpShort' => array(
			'from' => array( 'y' => 35, 'opacity' => 0 ),
			'to'   => '',
		),
		'slideDownLong' => array(
			'from' => array( 'y' => '-100%' ),
			'to'   => array( 'y' => '0%' ),
		),
		'slideLeftLong' => array(
			'from' => array( 'y' => 0, 'x' => '-100%', ),
			'to'   => array( 'x' => '0%' ),
		),
		'slideLeftShort' => array(
			'from' => array( 'y' => 0, 'x' => -35 ),
			'to'   => '',
		),
		'slideRightLong' => array(
			'from' => array( 'y' => 0, 'x' => '100%' ),
			'to'   => array( 'x' => '0%' ),
		),
		'slideRightShort' => array(
			'from' => array( 'y' => 0, 'x' => 35 ),
			'to'   => '',
		),
		'slideUpLong' => array(
			'from' => array( 'y' => '100%' ),
			'to'   => array( 'y' => '0%' ),
		),
		'slideUpShort' => array(
			'from' => array( 'y' => 35 ),
			'to'   => '',
		),
		'rotateInX' => array(
			'from' => array( 'y' => 35, 'rotationX' => -35, 'opacity' => 0 ),
			'to'   => '',
		),
		'rotateOutX' => array(
			'from' => array( 'y' => 0 ),
			'from' => array( 'y' => 35, 'rotationX' => -35, 'opacity' => 0 )
		),
		'rotateInY' => array(
			'from' => array( 'x' => 35, 'rotationY' => -35, 'opacity' => 0 ),
			'to'   => '',
		),
		'rotateOutY' => array(
			'from' => array( 'x' => 0 ),
			'from' => array( 'x' => 35, 'rotationY' => -35, 'opacity' => 0 )
		),
		'zoomIn' => array(
			'from' => array( 'scale' => 0.5, 'y' => 0, 'opacity' => 0 ),
			'to'   => '',
		),
		'zoomOut' => array(
			'from' => array( 'y' => 0 ),
			'to' => array( 'scale' => 0.5, 'opacity' => 0 ),
		),
	);

	return $hash[ $preset ];

}

/**
 * [rella_get_network_class description]
 * @method rella_get_network_class
 * @param  [type]                  $network [description]
 * @return [type]                           [description]
 */
function rella_get_network_class( $network ) {

	$hash = array(
		'facebook' => array(
			'bg' => 'bg-facebook',
			'icon' => 'fa fa-facebook',
			'text' => 'Facebook'
		),
		'facebook-square' => array(
			'bg' => 'bg-facebook-square',
			'icon' => 'fa fa-facebook-square',
			'text' => 'Facebook'
		),
		'twitter' => array(
			'bg' => 'bg-twitter',
			'icon' => 'fa fa-twitter',
			'text' => 'Twitter'
		),
		'youtube' => array(
			'bg' => 'bg-youtube',
			'icon' => 'fa fa-youtube',
			'text' => 'Youtube'
		),
		'youtube-play' => array(
			'bg' => 'bg-youtube-play',
			'icon' => 'fa fa-youtube-play',
			'text' => 'Youtube Play'
		),
		'google' => array(
			'bg' => 'bg-google',
			'icon' => 'fa fa-google',
			'text' => 'Google'
		),
		'google-plus' => array(
			'bg' => 'bg-google-plus',
			'icon' => 'fa fa-google-plus',
			'text' => 'Google+'
		),
		'instagram' => array(
			'bg' => 'bg-instagram',
			'icon' => 'fa fa-instagram',
			'text' => 'Instagram'
		),
		'flickr' => array(
			'bg' => 'bg-flickr',
			'icon' => 'fa fa-flickr',
			'text' => 'Flickr'
		),
		'pinterest' => array(
			'bg' => 'bg-pinterest',
			'icon' => 'fa fa-pinterest',
			'text' => 'Pinterest'
		),
		'vimeo' => array(
			'bg' => 'bg-vimeo',
			'icon' => 'fa fa-vimeo',
			'text' => 'Vimeo'
		),
		'linkedin' => array(
			'bg' => 'bg-linkedin',
			'icon' => 'fa fa-linkedin',
			'text' => 'Linkedin'
		),
		'github' => array(
			'bg' => 'bg-github',
			'icon' => 'fa fa-github',
			'text' => 'Github'
		),
		'dribbble' => array(
			'bg' => 'bg-dribbble',
			'icon' => 'fa fa-dribbble',
			'text' => 'Dribbble'
		),
		'skype' => array(
			'bg' => 'bg-skype',
			'icon' => 'fa fa-skype',
			'text' => 'Skype'
		),
		'behance' => array(
			'bg' => 'bg-behance',
			'icon' => 'fa fa-behance',
			'text' => 'Behance'
		),
		'rss' => array(
			'bg' => 'bg-rss',
			'icon' => 'fa fa-rss',
			'text' => 'Rss'
		),
	);

	return $hash[ $network ];
}
