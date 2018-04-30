<?php
/**
* Themerella Theme Framework
*/

if( ! defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly
	
// Template Tags -------------------------------------------------------
function rella_views_button( $post_id = 0 ) {

	// if post support post likes
	if( ! post_type_supports( get_post_type( $post_id ), 'rella-post-views' ) ) {
		esc_html_e( 'Post type not support views.', 'infinite-addons' );
		return;
	}

	echo Rella_Post_View::instance()->rella_get_post_views( $post_id );
}	

// Post Like Class -----------------------------------------------------

/**
 * Rella Theme
 */
class Rella_Post_View extends Rella_Base {
	
	/**
     * Hold an instance of Rella_Theme class.
     * @var Rella_Theme
     */
    protected static $instance = null;

	/**
	 * [$meta description]
	 * @var string
	 */
	protected $metakey = '_rella_views_count';

	/**
	 * Main Rella_Post_Like instance.
	 *
	 * @return Rella_Post_Like - Main instance.
	 */
    public static function instance() {

		if( null == self::$instance ) {
			self::$instance = new Rella_Post_View();
        }

        return self::$instance;
    }
    
	/**
	 * [__construct description]
	 * @method __construct
	 */
	private function __construct() {

		$this->add_action( 'wp_head', 'rella_track_post_views');
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

	}

	public function rella_set_post_views( $postID ) {

		$count_key = $this->metakey;
	    $count = get_post_meta( $postID, $count_key, true );

		if( $count == '' ){
	        $count = 0;
	        delete_post_meta( $postID, $count_key );
	        add_post_meta( $postID, $count_key, '0' );
		}
		else {
	        $count++;
			update_post_meta( $postID, $count_key, $count );
	    }
	}
	
	public function rella_track_post_views( $post_id ) {

		if ( ! is_single() ) 
			return;
		    
	    if ( empty ( $post_id) ) {
	        global $post;
	        $post_id = $post->ID;
	    }
		$this->rella_set_post_views( $post_id );

	}
	
	public function rella_get_post_views( $postID ){

	    $count_key = $this->metakey;
		$count     = get_post_meta( $postID, $count_key, true );

		if( $count == '' ){

	        delete_post_meta( $postID, $count_key );
	        add_post_meta( $postID, $count_key, '0' );
	        return esc_html__( 'O Views', 'infinite-addons' );

	    }

	    return $count . esc_html__( ' Views', 'infinite-addons' );

	}

}
Rella_Post_View::instance();