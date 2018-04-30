<?php
/**
 * Latest posts widget
 *
 * @package Boo
 */

class Rella_Trending_Posts_Widget extends WP_Widget {

	/**
	 * Sets up a new Rella latests posts carousel widget instance.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	function __construct() {

		$widget_ops = array(
			'classname' => 'widget_trending_posts',
			'description' => esc_html__( 'Displays the most trending posts', 'infinite-addons' ) 
		);
		parent::__construct( 'rella-trending-posts', esc_html__( 'ThemeRella: Trending Posts', 'infinite-addons' ), $widget_ops );

		$this->alt_option_name = 'widget_trending_posts_entries';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
		
	}

	/**
	 * Outputs the content for the current Rella trending posts widget instance.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Rella latests posts carousel widget instance.
	 */	

	function widget( $args, $instance ) {
		global $post;

		$cache = wp_cache_get('widget_trending_posts_entries', 'widget');

		if ( !is_array($cache) ) {
			$cache = array();
		}
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract( $args );

		echo $before_widget;

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_html__( ' Trending Posts', 'infinite-addons' ) : $instance['title'], $instance, $this->id_base );
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) ) {
			$number = 5;
		}
		
		$query_args = array( 
			'posts_per_page' => $number, 
			'no_found_rows'  => true, 
			'post_status'    => 'publish', 
			'ignore_sticky_posts' => true, 
			'meta_key' => '_rella_views_count', 
			'orderby'  => 'meta_value_num', 
			'order' => 'DESC'
		);
		
		$r = new WP_Query( $query_args );

		if ( $r->have_posts() ) : ?>
		
		<div class="blog-posts trending">

			<?php echo $before_title . esc_html( $title ) . $after_title;  ?>

				<?php  while ( $r->have_posts() ) : $r->the_post(); ?>

					<article class="blog-post hentry entry post-image-large-alt trending">

						<a href="<?php echo get_permalink(); ?>" class="overlay-link"></a>

						<figure class="post-image hmedia">
							<a href="<?php echo get_permalink(); ?>">
								<?php rella_the_post_thumbnail( 'rella-trend-widget' ); ?>
							</a>
						</figure><!-- /.main-image -->

						<div class="post-contents">
							<header>
								<h2 class="entry-title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
							</header>
						</div><!-- /.contents -->

					</article><!-- /.blog-post -->

				<?php endwhile; ?>

			<?php
			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata(); ?>
			
		</div><!--/ .blog-posts -->

		<?php endif; //have_posts()

		echo $after_widget;
		
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set( 'widget_trending_posts_entries', $cache, 'widget' );
	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_trending_posts_entries']) ) {
			delete_option('widget_trending_posts_entries');
		}
		return $instance;
	}

	function flush_widget_cache() {

		wp_cache_delete('widget_trending_posts_entries', 'widget');

	}

	function form( $instance ) {

		$title  = isset( $instance['title'] ) ? $instance['title'] : '';
		$number = isset( $instance['number'] ) ? $instance['number'] : 5;

		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'infinite-addons' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name('title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'pasific-addons' ); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" />
		</p>

		<?php
	}
}