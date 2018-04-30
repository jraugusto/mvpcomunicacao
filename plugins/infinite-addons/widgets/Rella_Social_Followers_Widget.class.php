<?php
/**
* Rella Social Followers Widget
*
* @package Boo
*/
 
class Rella_Social_Followers_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_social_followers_widget', 'description' => esc_html__( "Display socials sites links", 'infinite-addons' ) );
		parent::__construct( 'social-followers', esc_html__( 'ThemeRella: Social Site Links', 'infinite-addons' ), $widget_ops);

		$this-> alt_option_name = 'widget_social_followers';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget( $args, $instance ) {

		global $post;

		$cache = wp_cache_get('widget_social_followers', 'widget');

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
		
		$social_one      = ! empty( $instance['social_one'] ) ? $instance['social_one'] : 'facebook';
		$social_one_link = ! empty( $instance['social_one_link'] ) ? $instance['social_one_link'] : '#';
		$social_one_label = ! empty( $instance['social_one_label'] ) ? $instance['social_one_label'] : '';
		$social_one_desc = ! empty( $instance['social_one_desc'] ) ? $instance['social_one_desc'] : '';
		
		$social_two      = ! empty( $instance['social_two'] ) ? $instance['social_two'] : 'facebook';
		$social_two_label = ! empty( $instance['social_two_label'] ) ? $instance['social_two_label'] : '';
		$social_two_link = ! empty( $instance['social_two_link'] ) ? $instance['social_two_link'] : '#';
		$social_two_desc = ! empty( $instance['social_two_desc'] ) ? $instance['social_two_desc'] : '';
		
		$social_three      = ! empty( $instance['social_three'] ) ? $instance['social_three'] : 'facebook';
		$social_three_label = ! empty( $instance['social_three_label'] ) ? $instance['social_three_label'] : '';
		$social_three_link = ! empty( $instance['social_three_link'] ) ? $instance['social_three_link'] : '#';
		$social_three_desc = ! empty( $instance['social_three_desc'] ) ? $instance['social_three_desc'] : '';

		ob_start();
		extract( $args );

		echo $before_widget; 
	
	?>


	<?php 
		
		if( ! empty ( $social_one_label ) ) { 
		$icon = rella_get_network_class( $social_one );
		$i_class = $icon['icon'];
		
	?>
		<a class="btn btn-social-alt branded-text text-uppercase" target="_blank" href="<?php echo esc_url( $social_one_link ) ?>">
			<i class="<?php echo $i_class ?>"></i>
			<span>
				<span><?php echo esc_html( $social_one_label ); ?></span>
			<?php if ( ! empty( $social_one_desc ) ) { ?>				
				<strong><?php echo esc_html( $social_one_desc ); ?></strong>
			<?php } ?>

			</span>
		</a>
	<?php } ?>
	

	<?php 
		
		if( ! empty(  $social_two_label ) ) { 
		$icon = rella_get_network_class( $social_two );
		$i_class = $icon['icon'];
		
	?>
		<a class="btn btn-social-alt branded-text text-uppercase" target="_blank" href="<?php echo esc_url( $social_two_link ) ?>">
			<i class="<?php echo $i_class ?>"></i>
			<span>
				<span><?php echo esc_html( $social_two_label ); ?></span>
			<?php if ( ! empty( $social_two_desc ) ) { ?>				
				<strong><?php echo esc_html( $social_two_desc ); ?></strong>
			<?php } ?>

			</span>
		</a>
	<?php } ?>
	
	<?php 
		
		if(  ! empty( $social_three_label ) ) { 
		$icon = rella_get_network_class( $social_three );
		$i_class = $icon['icon'];
		
	?>
		<a class="btn btn-social-alt branded-text text-uppercase" target="_blank" href="<?php echo esc_url( $social_three_link ) ?>">
			<i class="<?php echo $i_class ?>"></i>
			<span>
				<span><?php echo esc_html( $social_three_label ); ?></span>
			<?php if ( ! empty( $social_three_desc ) ) { ?>				
				<strong><?php echo esc_html( $social_three_desc ); ?></strong>
			<?php } ?>

			</span>
		</a>
	<?php } ?>

	<?php
		echo $after_widget;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_social_followers', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['social_one']      = strip_tags( $new_instance['social_one'] );
		$instance['social_one_link'] = strip_tags( $new_instance['social_one_link'] );
		$instance['social_one_label'] = strip_tags( $new_instance['social_one_label'] );
		$instance['social_one_desc'] = strip_tags( $new_instance['social_one_desc'] );
		
		$instance['social_two']      = strip_tags( $new_instance['social_two'] );
		$instance['social_two_label'] = strip_tags( $new_instance['social_two_label'] );
		$instance['social_two_link'] = strip_tags( $new_instance['social_two_link'] );
		$instance['social_two_desc'] = strip_tags( $new_instance['social_two_desc'] );
		
		$instance['social_three']      = strip_tags( $new_instance['social_three'] );
		$instance['social_three_label'] = strip_tags( $new_instance['social_three_label'] );
		$instance['social_three_link'] = strip_tags( $new_instance['social_three_link'] );
		$instance['social_three_desc'] = strip_tags( $new_instance['social_three_desc'] );

		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['widget_social_followers'] ) ) {

			delete_option('widget_social_followers');

		}
		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete( 'widget_social_followers', 'widget' );
	}

	function form( $instance ) {
		
		$instance = wp_parse_args( (array) $instance, array( 'social_one' => '', 'social_one_label' => '', 'social_one_link' => '#', 'social_one_desc' => '','social_two' => '', 'social_two_label' => '', 'social_two_link' => '#', 'social_two_desc' => '','social_three' => '', 'social_three_label' => '', 'social_three_link' => '#', 'social_three_desc' => '' ) );
		
		$socials = array(
			esc_html__( 'Select Social', '_s' )	=> '',
			esc_html__( 'Facebook', '_s' )	=> 'facebook',
			esc_html__( 'Facebook Square', '_s' )	=> 'facebook-square',
			esc_html__( 'Twitter', '_s' )	=> 'twitter',
			esc_html__( 'Youtube', '_s' )   => 'youtube',
			esc_html__( 'Youtube Play', '_s' )  => 'youtube-play',
			esc_html__( 'Google' )          => 'google',
			esc_html__( 'Instagram', '_s' ) => 'instagram',
			esc_html__( 'Behance', '_s' )	=> 'behance',
			esc_html__( 'Dribbble', '_s' )	=> 'dribbble',
			esc_html__( 'Flickr', '_s' )    => 'flickr',
			esc_html__( 'Google +', '_s' )	=> 'google-plus',
			esc_html__( 'Github', '_s' )	=> 'github',
			esc_html__( 'Linkedin', '_s' )	=> 'linkedin',
			esc_html__( 'Pinterest', '_s' ) => 'pinterest',
			esc_html__( 'RSS', '_s' )	    => 'rss',
			esc_html__( 'Skype', '_s' )	    => 'skype',
			esc_html__( 'Vimeo', '_s' )     => 'vimeo',
		);

		$social_one       = isset( $instance['social_one'] ) ? $instance['social_one'] : '';
		$social_one_label = isset( $instance['social_one_label'] ) ? $instance['social_one_label'] : '';
		$social_one_link  = isset( $instance['social_one_link'] ) ? $instance['social_one_link'] : '#';
		$social_one_desc  = isset( $instance['social_one_desc'] ) ? $instance['social_one_desc'] : '';

		$social_two       = isset( $instance['social_two'] ) ? $instance['social_two'] : '';
		$social_two_label = isset( $instance['social_two_label'] ) ? $instance['social_two_label'] : '';
		$social_two_link  = isset( $instance['social_two_link'] ) ? $instance['social_two_link'] : '#';
		$social_two_desc  = isset( $instance['social_two_desc'] ) ? $instance['social_two_desc'] : '';
		
		$social_three       = isset( $instance['social_three'] ) ? $instance['social_three'] : '';
		$social_three_label = isset( $instance['social_three_label'] ) ? $instance['social_three_label'] : '';
		$social_three_link  = isset( $instance['social_three_link'] ) ? $instance['social_three_link'] : '#';
		$social_three_desc  = isset( $instance['social_three_desc'] ) ? $instance['social_three_desc'] : '';
		

		?>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'social_one' ) ); ?>"><?php esc_html_e( 'Social One Site:', 'infinite-addons' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'social_one' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'social_one' ) ); ?>" class="widefat">
			<?php foreach( $socials as $key => $value ) { ?>
				<option value="<?php echo esc_attr( $value ) ?>"<?php selected( $instance['social_one'], $value ); ?>><?php esc_html_e( $key ); ?></option>
			<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'social_one_label' ) ); ?>"><?php esc_html_e( 'Social One Label:', 'infinite-addons' ); ?></label>
			<input type="text" value="<?php echo esc_attr( $instance['social_one_label'] ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'social_one_label' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'social_one_label' ) ); ?>" class="widefat" />
			<br />
			<small><?php esc_html_e( 'Add Social Site Label', 'infinite-addons' ); ?></small>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'social_one_link' ) ); ?>"><?php esc_html_e( 'Social One URL:', 'infinite-addons' ); ?></label>
			<input type="text" value="<?php echo esc_attr( $instance['social_one_link'] ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'social_one_link' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'social_one_link' ) ); ?>" class="widefat" />
			<br />
			<small><?php esc_html_e( 'Add Social Site Linke', 'infinite-addons' ); ?></small>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'social_one_desc' ) ); ?>"><?php esc_html_e( 'Social One Description', 'infinite-addons' ); ?></label>
			<input type="text" value="<?php echo esc_attr( $instance['social_one_desc'] ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'social_one_desc' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'social_one_desc' ) ); ?>" class="widefat" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'social_two' ) ); ?>"><?php esc_html_e( 'Social Two Site:', 'infinite-addons' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'social_two' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'social_two' ) ); ?>" class="widefat">
			<?php foreach( $socials as $key => $value ) { ?>
				<option value="<?php echo esc_attr( $value ) ?>"<?php selected( $instance['social_two'], $value ); ?>><?php esc_html_e( $key ); ?></option>
			<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'social_two_label' ) ); ?>"><?php esc_html_e( 'Social Two Label:', 'infinite-addons' ); ?></label>
			<input type="text" value="<?php echo esc_attr( $instance['social_two_label'] ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'social_two_label' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'social_two_label' ) ); ?>" class="widefat" />
			<br />
			<small><?php esc_html_e( 'Add Social Two Site Label', 'infinite-addons' ); ?></small>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'social_two_link' ) ); ?>"><?php esc_html_e( 'Social Two URL:', 'infinite-addons' ); ?></label>
			<input type="text" value="<?php echo esc_attr( $instance['social_two_link'] ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'social_two_link' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'social_two_link' ) ); ?>" class="widefat" />
			<br />
			<small><?php esc_html_e( 'Add Social Two Site Link', 'infinite-addons' ); ?></small>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'social_two_desc' ) ); ?>"><?php esc_html_e( 'Social Two Description', 'infinite-addons' ); ?></label>
			<input type="text" value="<?php echo esc_attr( $instance['social_two_desc'] ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'social_two_desc' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'social_two_desc' ) ); ?>" class="widefat" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'social_three' ) ); ?>"><?php esc_html_e( 'Social Three Site:', 'infinite-addons' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'social_three' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'social_three' ) ); ?>" class="widefat">
			<?php foreach( $socials as $key => $value ) { ?>
				<option value="<?php echo esc_attr( $value ) ?>"<?php selected( $instance['social_three'], $value ); ?>><?php esc_html_e( $key ); ?></option>
			<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'social_three_label' ) ); ?>"><?php esc_html_e( 'Social Three Label:', 'infinite-addons' ); ?></label>
			<input type="text" value="<?php echo esc_attr( $instance['social_three_label'] ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'social_three_label' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'social_three_label' ) ); ?>" class="widefat" />
			<br />
			<small><?php esc_html_e( 'Add Social Three Site Label', 'infinite-addons' ); ?></small>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'social_three_link' ) ); ?>"><?php esc_html_e( 'Social Three URL:', 'infinite-addons' ); ?></label>
			<input type="text" value="<?php echo esc_attr( $instance['social_three_link'] ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'social_three_link' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'social_three_link' ) ); ?>" class="widefat" />
			<br />
			<small><?php esc_html_e( 'Add Social Three Site Link', 'infinite-addons' ); ?></small>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'social_three_desc' ) ); ?>"><?php esc_html_e( 'Social Three Description', 'infinite-addons' ); ?></label>
			<input type="text" value="<?php echo esc_attr( $instance['social_three_desc'] ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'social_three_desc' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'social_three_desc' ) ); ?>" class="widefat" />
		</p>
		

		<?php
	}
}