<?php
/**
 * Rella Latest Comments widget
 *
 * @package Boo
 */

class Rella_Latest_Comments_Widget extends WP_Widget {

	function __construct() {

		$widget_ops = array('classname' => 'widget_recent_comments_carousel', 'description' => esc_html__( "Displays the most latest posts", 'infinite-addons' ) );
		parent::__construct('latest-comments', esc_html__( 'ThemeRella: Latest Comments Carousel', 'infinite-addons' ), $widget_ops);

		$this-> alt_option_name = 'widget_latest_comments';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
		add_action( 'rella_shortcodes_styles', array( &$this, 'styles' ) );
	}
	
	function styles() {
		wp_enqueue_style( 'rella-sc-button' );
		wp_enqueue_style( 'flickity' );
		wp_enqueue_style( 'rella-sc-carousel' );
	} 

	function widget( $args, $instance ) {

		global $comments, $comment;

		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get('widget_latest_comments', 'widget');
		}
		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		$output = '';

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Latest Comments', 'infinite-addons' );

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 3;
		if ( ! $number ) $number = 3;
		$c = ! empty( $instance['carousel'] ) ? '1' : '0';

		/**
		 * Filter the arguments for the Recent Comments widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Comment_Query::query() for information on accepted arguments.
		 *
		 * @param array $comment_args An array of arguments used to retrieve the recent comments.
		 */
		$comments = get_comments( apply_filters( 'widget_comments_args', array(
			'number'      => $number,
			'status'      => 'approve',
			'post_status' => 'publish'
		) ) );

		$output .= $args['before_widget'];

		if ( $title ) {
			$output .= $args['before_title'] . $title . $args['after_title'];
		}

		if ( $c ) {

			$output .= '<div class="carousel-container carousel-nav-style8" data-slides-viewable="1">';
			$output .= '<div class="recentcomments">';
			$output .= '<div class="carousel-items row js-flickity" data-flickity-options=\'{ "adaptiveHeight": true, "pageDots": false }\'>';

		}

		if ( $comments ) {
			// Prime cache for associated posts. (Prime post term cache if we need it for permalinks.)
			$post_ids = array_unique( wp_list_pluck( $comments, 'comment_post_ID' ) );
			_prime_post_caches( $post_ids, strpos( get_option( 'permalink_structure' ), '%category%' ), false );

			foreach ( (array) $comments as $comment) {

				$output .= '<div class="col-xs-12 no-padding">';
				$output .= '<div class="comment">';
				$output .= '<figure>';
				$output .= get_avatar( $comment, 180 );
				$output .= '<a href="' . get_comment_author_link() . '"></a>';
				$output .= '</figure>';
				$output .= '<div class="contents">';
				$output .= '<h5 class="comment-author-name">';
				$output .= get_comment_author_link();
				$output .= '</h5>';
				$output .= '<h6>';
				$output .= esc_html__( 'on', 'infinite-addons' );
				$output .= ' <a href="' . esc_url( get_comment_link( $comment->comment_ID ) ) . '">' . get_the_title( $comment->comment_post_ID ) . '</a>';
				$output .= '</h6>';
				$output .= '<span class="comment-text">';
				$output .= get_comment_excerpt();
				$output .= '</span>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
			}
		}

		if ( $c ) {
			$output .= '</div>'; // .carousel-items
			$output .= '<div class="carousel-nav">
							<button class="flickity-prev-next-button previous"><i class="fa fa-angle-left"></i></button>
							<button class="flickity-prev-next-button next"><i class="fa fa-angle-right"></i></button>
						</div>';
			$output .= '</div>'; // .recentcomments
			$output .= '</div>'; //.carosel-container
		}

		$output .= $args['after_widget'];

		wp_enqueue_script( 'flickity' );

		echo $output;

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = $output;
			wp_cache_set( 'widget_latest_comments', $cache, 'widget' );
		}
	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['carousel'] = ! empty( $new_instance['carousel'] ) ? 1 : 0;

		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_latest_comments']) ) {

			delete_option('widget_latest_comments');
		}
		return $instance;
	}

	function flush_widget_cache() {

		wp_cache_delete('widget_latest_comments', 'widget');

	}

	function form( $instance ) {

		$title = isset($instance['title']) ? $instance['title'] : '';
		$number = isset($instance['number']) ? $instance['number'] : 5;
		$carousel = isset( $instance['carousel'] ) ? ( bool ) $instance['carousel'] : false;

		?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e( 'Title:', 'rhythm-addons' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php _e( 'Number of posts to show:', 'rhythm-addons' ); ?></label>
		<input id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" /></p>

		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('carousel'); ?>" name="<?php echo $this->get_field_name('carousel'); ?>"<?php checked( $carousel ); ?> />
		<label for="<?php echo $this->get_field_id('carousel'); ?>"><?php esc_html_e( 'Enable/Disable carousel', 'infinite-addons' ); ?></label></p>
		<?php
	}
}
