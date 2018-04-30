<?php
/**
 * Latest posts widget
 *
 * @package Boo
 */

class Rella_Latest_Posts_Widget extends WP_Widget {

	/**
	 * Sets up a new Rella latests posts carousel widget instance.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	function __construct() {

		$widget_ops = array('classname' => 'widget_latest_posts_entries_carousel', 'description' => esc_html__( "Displays the most latest posts carousel", 'infinite-addons' ) );
		parent::__construct('rella-latest-posts', esc_html__( 'ThemeRella: Latest Posts Carousel', 'infinite-addons' ), $widget_ops);

		$this-> alt_option_name = 'widget_latest_posts_entries';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
		add_action( 'rella_shortcodes_styles', array( &$this, 'styles' ) );
	}

	/**
	 * Outputs the content for the current Rella latests posts carousel widget instance.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Rella latests posts carousel widget instance.
	 */
	
	function styles() {
		wp_enqueue_style( 'rella-sc-button' );
		wp_enqueue_style( 'flickity' );
		wp_enqueue_style( 'rella-sc-carousel' );
	} 
	 
	function widget( $args, $instance ) {
		global $post;

		$cache = wp_cache_get('widget_latest_posts_entries', 'widget');

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

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_html__( 'Latest Posts', 'infinite-addons' ) : $instance['title'], $instance, $this->id_base );
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) ) {
			$number = 10;
		}
		$r = new WP_Query( apply_filters( 'widget_posts_args', array('orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true) ) );
		if ($r->have_posts()) : ?>
			<?php echo $before_title . esc_html( $title ) . $after_title;  ?>

			<div class="carousel-container carousel-nav-style8">
				 <div class="carousel-items row">

				<?php
					$posts_sz = count( $r->posts );
					if( $number > $posts_sz ) {
						$all = $posts_sz;
					} else {
						$all = $number;
					}
				?>
				<?php $i = $last = 0; ?>

					<?php  while ( $r->have_posts() ) : $r->the_post(); $i++; $last++; ?>


					<?php if( $i == 1 ) { ?>
						<div class="col-xs-12">
					<?php } ?>

							<div class="post">
								<figure>
									<?php rella_the_post_thumbnail( 'rella-widget' ); ?>
								</figure>
								<div class="contents">
									<time datetime="<?php the_date('Y-m-d'); ?>" class="time"><?php the_time('F d');?></time>
									<h3><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
								</div> <!-- .contents -->
							</div><!-- /.post -->
	
				<?php if( $i == 2 || $last === $all ) { $i = 0; ?>
						</div>
				<?php } ?>

					<?php endwhile; ?>

				<?php
				// Reset the global $the_post as this query will have stomped on it
				wp_reset_postdata(); ?>

			</div><!--/product_list_widget-->

			<div class="carousel-nav">
				<button class="flickity-prev-next-button previous"><i class="fa fa-angle-left"></i></button>
				<button class="flickity-prev-next-button next"><i class="fa fa-angle-right"></i></button>
			</div><!-- /.carousel-nav -->

			</div><!-- /.vertical-carousel -->

			<?php endif; //have_posts()

		echo $after_widget;

		wp_enqueue_script( 'flickity' );	
		
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_latest_posts_entries', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_latest_posts_entries']) ) {
			delete_option('widget_latest_posts_entries');
		}
		return $instance;
	}

	function flush_widget_cache() {

		wp_cache_delete('widget_latest_posts_entries', 'widget');

	}

	function form( $instance ) {

		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$number = isset( $instance['number'] ) ? $instance['number'] : 5;
		$carousel = isset( $instance['carousel'] ) ? $instance['carousel'] : true;

		?>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'infinite-addons' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name('title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'pasific-addons' ); ?></label>
		<input id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" /></p>

		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('carousel'); ?>" name="<?php echo $this->get_field_name('carousel'); ?>"<?php checked( $carousel ); ?> />
		<label for="<?php echo $this->get_field_id('carousel'); ?>"><?php esc_html_e( 'Enable/Disable carousel', 'infinite-addons' ); ?></label></p>
		<?php
	}
}