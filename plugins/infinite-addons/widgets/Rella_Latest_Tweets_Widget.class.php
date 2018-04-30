<?php
/**
 * Rella Latest Tweets widget
 *
 * @package Boo
 */

class Rella_Latest_Tweets_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_latest_tweets_widget', 'description' => esc_html__( "Displays the most latest tweets", 'infinite-addons' ) );
		parent::__construct( 'latest-tweets', esc_html__( 'ThemeRella: Latest Tweets', 'infinite-addons' ), $widget_ops);

		$this-> alt_option_name = 'widget_latest_tweets';

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

		global $post;

		$cache = wp_cache_get('widget_latest_tweets', 'widget');

		if ( ! is_array( $cache ) ) {
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

		echo $before_widget; ?>

		<div class="twitter-carousel carousel-container carousel-nav-style8 carousel-bordered">

		<div class="icon-box icon-box-xsm1 icon-box-circle">
			<span class="icon-container"><i class="fa fa-twitter"></i></span>
		</div>

		<?php

		$title = apply_filters( 'widget_title', empty($instance['title']) ? esc_html__( 'Latest Tweets', 'infinite-addons' ) : $instance['title'], $instance, $this->id_base);

		$consumer_key = ! empty( $instance['twitter-consumer-key'] ) ? $instance['twitter-consumer-key'] : '';
		$consumer_secret = ! empty( $instance['twitter-consumer-secret'] ) ? $instance['twitter-consumer-secret'] : '';
		$access_token = ! empty( $instance['twitter-access-token'] ) ? $instance['twitter-access-token'] : '';
		$access_token_secret = ! empty( $instance['twitter-access-token-secret'] ) ? $instance['twitter-access-token-secret'] : '';

		if ( ! empty( $instance['username'] ) ):

			//echo $before_title . esc_html( $title ) . $after_title;

			$tweets = rella_get_recent_tweets( $instance['username'], $consumer_key, $consumer_secret, $access_token, $access_token_secret );

			if ( $tweets['is_error'] == 'true' ) : ?>

			<?php elseif ( ! empty( $tweets['tweets'] ) ) :
				$tweets['tweets'] = json_decode( $tweets['tweets'] );

				if ( is_array( $tweets['tweets'] ) && count( $tweets['tweets'] ) > 0):
				?>
				<div class="carousel-items row js-flickity" data-flickity-options='{ "adaptiveHeight": true, "pageDots": false }'>
				<?php
				$i = 0;
				foreach ( $tweets['tweets'] as $tweet ):
					if ($i >= $instance['number']):
						break;
					endif; ?>
					<div class="col-xs-12 text-center">
						<div class="twitter-container">
							<div class="content">
								<p><?php echo rella_replace_in_tweets( $tweet ); ?></p>
								<span class="date"><?php echo rella_time_elapsed_string( $tweet -> created_at );?></span>
							</div><!-- /.content -->
						</div><!-- /.twitter-container -->
						<a href="https://twitter.com/<?php echo $instance['username']; ?>" class="btn btn-naked btn-sm text-uppercase mb-30"><span><?php esc_html_e( 'Follow on twitter', 'infinite-addons' ); ?></span></a>
					</div>
					<?php $i ++; ?>
				<?php endforeach; ?>

				</div><!-- /.carousel-items -->

				<?php
					endif;
				endif;
			endif;
		?>

		<div class="carousel-nav">
			<button class="flickity-prev-next-button previous"><i class="fa fa-angle-left"></i></button>
			<button class="flickity-prev-next-button next"><i class="fa fa-angle-right"></i></button>
		</div><!-- /.carousel-nav -->

	</div><!-- /.carousel-container -->

	<?php
		echo $after_widget;

		wp_enqueue_script( 'flickity' );

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_latest_tweets', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {

		$instance             = $old_instance;
		$instance['title']    = strip_tags($new_instance['title']);
		$instance['username'] = strip_tags($new_instance['username']);

		$instance['twitter-consumer-key'] = $new_instance['twitter-consumer-key'];
		$instance['twitter-consumer-secret'] = $new_instance['twitter-consumer-secret'];
		$instance['twitter-access-token'] = $new_instance['twitter-access-token'];
		$instance['twitter-access-token-secret'] = $new_instance['twitter-access-token-secret'];

		$instance['number']   = (int) $new_instance['number'];
		$instance['carousel'] = ! empty( $new_instance['carousel'] ) ? 1 : 0;

		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_latest_tweets']) ) {

			delete_option('widget_latest_tweets');

		}
		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete( 'widget_latest_tweets', 'widget' );
	}

	function form( $instance ) {

		$title    = isset( $instance['title'] ) ? $instance['title'] : '';
		$username = isset( $instance['username'] ) ? $instance['username'] : '';

		$consumer_key = isset( $instance['twitter-consumer-key'] ) ? $instance['twitter-consumer-key'] : '';
		$consumer_secret = isset( $instance['twitter-consumer-secret'] ) ? $instance['twitter-consumer-secret'] : '';
		$access_token = isset( $instance['twitter-access-token'] ) ? $instance['twitter-access-token'] : '';
		$access_token_secret = isset( $instance['twitter-access-token-secret'] ) ? $instance['twitter-access-token-secret'] : '';

		$number = isset($instance['number']) ? $instance['number'] : 3;
		$carousel = isset( $instance['carousel'] ) ? ( bool ) $instance['carousel'] : false;
		?>

		<!--p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'infinite-addons' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p-->

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"><?php esc_html_e( 'User name:', 'infinite-addons' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'username' ) ); ?>" type="text" value="<?php echo esc_attr( $username ); ?>" /></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'twitter-consumer-key' ) ); ?>"><?php esc_html_e( 'Consumer Key:', 'infinite-addons' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter-consumer-key' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter-consumer-key' ) ); ?>" type="text" value="<?php echo esc_attr( $consumer_key ); ?>" /></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'twitter-consumer-secret' ) ); ?>"><?php esc_html_e( 'Consumer Secret:', 'infinite-addons' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter-consumer-secret' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter-consumer-secret' ) ); ?>" type="text" value="<?php echo esc_attr( $consumer_secret ); ?>" /></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'twitter-access-token' ) ); ?>"><?php esc_html_e( 'Access Token:', 'infinite-addons' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter-access-token' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter-access-token' ) ); ?>" type="text" value="<?php echo esc_attr( $access_token ); ?>" /></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'twitter-access-token-secret' ) ); ?>"><?php esc_html_e( 'Access Token Secret:', 'infinite-addons' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter-access-token-secret' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter-access-token-secret' ) ); ?>" type="text" value="<?php echo esc_attr( $access_token_secret ); ?>" /></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of tweets to show:', 'infinite-addons' ); ?></label>
		<input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3" /></p>

		<!--p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('carousel'); ?>" name="<?php echo $this->get_field_name('carousel'); ?>"<?php checked( $carousel ); ?> />
		<label for="<?php echo $this->get_field_id('carousel'); ?>"><?php esc_html_e( 'Enable carousel', 'infinite-addons' ); ?></label></p-->

		<?php
	}
}
