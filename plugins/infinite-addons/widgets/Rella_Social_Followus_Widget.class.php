<?php
/**
* Rella Social Followers Widget
*
* @package Boo
*/
 
class Rella_Social_Followus_Widget extends WP_Widget {

	function __construct() {

		$widget_ops = array( 'classname' => 'widget_follow_us', 'description' => esc_html__( "Display socials sites links", 'infinite-addons' ) );
		parent::__construct( 'social-followus', esc_html__( 'ThemeRella: Follow Us links', 'infinite-addons' ), $widget_ops );

		$this-> alt_option_name = 'widget_social_followus';

		add_action( 'save_post', array( &$this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( &$this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( &$this, 'flush_widget_cache' ) );

	}

	function widget( $args, $instance ) {

		global $post;

		$cache = wp_cache_get( 'widget_social_followus', 'widget' );

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
		
		$social_one      = ! empty( $instance['social_one'] ) ? $instance['social_one'] : '';
		$social_one_link = ! empty( $instance['social_one_link'] ) ? $instance['social_one_link'] : '#';
		
		$social_two      = ! empty( $instance['social_two'] ) ? $instance['social_two'] : '';
		$social_two_link = ! empty( $instance['social_two_link'] ) ? $instance['social_two_link'] : '#';
		
		$social_three      = ! empty( $instance['social_three'] ) ? $instance['social_three'] : '';
		$social_three_link = ! empty( $instance['social_three_link'] ) ? $instance['social_three_link'] : '#';
		
		$social_four      = ! empty( $instance['social_four'] ) ? $instance['social_four'] : '';
		$social_four_link = ! empty( $instance['social_four_link'] ) ? $instance['social_four_link'] : '#';

		$social_five      = ! empty( $instance['social_five'] ) ? $instance['social_five'] : '';
		$social_five_link = ! empty( $instance['social_five_link'] ) ? $instance['social_five_link'] : '#';

		ob_start();
		extract( $args );

		echo $before_widget; 
		
		$desc = ! empty( $instance['desc'] ) ? $instance['desc'] : '';
		
		if( $desc ):
			echo wpautop( wp_kses_post( $desc ) );
        endif;
	
	?>
	<ul class="social-icon branded-text">

		<?php 
			if( ! empty( $social_one ) ) { 
			$icon = rella_get_network_class( $social_one );
			$i_class = $icon['icon'];
		?>
			<li><a href="<?php echo esc_url( $social_one_link ) ?>"><i class="<?php echo esc_attr( $i_class ) ?>"></i></a></li>
		<?php } ?>
		
		<?php 
			if( ! empty( $social_two ) ) { 
			$icon = rella_get_network_class( $social_two );
			$i_class = $icon['icon'];
		?>
			<li><a href="<?php echo esc_url( $social_two_link ) ?>"><i class="<?php echo esc_attr( $i_class ) ?>"></i></a></li>
		<?php } ?>
		
		<?php 
			if( ! empty( $social_three ) ) { 
			$icon = rella_get_network_class( $social_three );
			$i_class = $icon['icon'];
		?>
			<li><a href="<?php echo esc_url( $social_three_link ) ?>"><i class="<?php echo esc_attr( $i_class ) ?>"></i></a></li>
		<?php } ?>
		
		<?php 
			if( ! empty( $social_four ) ) { 
			$icon = rella_get_network_class( $social_four );
			$i_class = $icon['icon'];
		?>
			<li><a href="<?php echo esc_url( $social_four_link ) ?>"><i class="<?php echo esc_attr( $i_class ) ?>"></i></a></li>
		<?php } ?>
		
		<?php 
			if( ! empty( $social_five ) ) { 
			$icon = rella_get_network_class( $social_five );
			$i_class = $icon['icon'];
		?>
			<li><a href="<?php echo esc_url( $social_five_link ) ?>"><i class="<?php echo esc_attr( $i_class ) ?>"></i></a></li>
		<?php } ?>
		
		
	</ul>
	<?php
		echo $after_widget;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set( 'widget_social_followus', $cache, 'widget' );
	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['desc'] = $new_instance['desc'];

		$instance['social_one']      = strip_tags( $new_instance['social_one'] );
		$instance['social_one_link'] = strip_tags( $new_instance['social_one_link'] );
		
		$instance['social_two']      = strip_tags( $new_instance['social_two'] );
		$instance['social_two_link'] = strip_tags( $new_instance['social_two_link'] );
		
		$instance['social_three']      = strip_tags( $new_instance['social_three'] );
		$instance['social_three_link'] = strip_tags( $new_instance['social_three_link'] );

		$instance['social_four']      = strip_tags( $new_instance['social_four'] );
		$instance['social_four_link'] = strip_tags( $new_instance['social_four_link'] );
		
		$instance['social_five']      = strip_tags( $new_instance['social_five'] );
		$instance['social_five_link'] = strip_tags( $new_instance['social_five_link'] );


		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['widget_social_followus'] ) ) {

			delete_option( 'widget_social_followus' );

		}
		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete( 'widget_social_followus', 'widget' );
	}

	function form( $instance ) {
		
		$instance = wp_parse_args( ( array ) $instance, array( 'desc' => '', 'social_one' => '', 'social_one_link' => '#', 'social_two' => '', 'social_two_link' => '#', 'social_three' => '',  'social_three_link' => '#', 'social_four' => '', 'social_four_link' => '#', 'social_five' => '', 'social_five_link' => '#' ) );
		
		$socials = array(
			esc_html__( 'Select Social', 'infinite-addons' )   => '',
			esc_html__( 'Facebook', 'infinite-addons' )	       => 'facebook',
			esc_html__( 'Facebook Square', 'infinite-addons' ) => 'facebook-square',
			esc_html__( 'Twitter', 'infinite-addons' )	       => 'twitter',
			esc_html__( 'Youtube', 'infinite-addons' )         => 'youtube',
			esc_html__( 'Youtube Play', 'infinite-addons' )    => 'youtube-play',
			esc_html__( 'Google', 'infinite-addons' )          => 'google',
			esc_html__( 'Instagram', 'infinite-addons' )       => 'instagram',
			esc_html__( 'Behance', 'infinite-addons' )	       => 'behance',
			esc_html__( 'Dribbble', 'infinite-addons' )	       => 'dribbble',
			esc_html__( 'Flickr', 'infinite-addons' )          => 'flickr',
			esc_html__( 'Google +', 'infinite-addons' )	       => 'google-plus',
			esc_html__( 'Github', 'infinite-addons' )	       => 'github',
			esc_html__( 'Linkedin', 'infinite-addons' )	       => 'linkedin',
			esc_html__( 'Pinterest', 'infinite-addons' )       => 'pinterest',
			esc_html__( 'RSS', 'infinite-addons' )	           => 'rss',
			esc_html__( 'Skype', 'infinite-addons' )           => 'skype',
			esc_html__( 'Vimeo', 'infinite-addons' )           => 'vimeo',
		);

		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>"><?php esc_html_e( 'Description:', 'infinite-addons' ); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'desc' ) ); ?>"><?php echo esc_attr( $instance['desc'] ); ?></textarea>
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'social_one' ) ); ?>"><?php esc_html_e( 'Social One Site:', 'infinite-addons' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'social_one' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'social_one' ) ); ?>" class="widefat">
			<?php foreach( $socials as $key => $value ) { ?>
				<option value="<?php echo esc_attr( $value ) ?>"<?php selected( $instance['social_one'], $value ); ?>><?php esc_html_e( $key ); ?></option>
			<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'social_one_link' ) ); ?>"><?php esc_html_e( 'Social One URL:', 'infinite-addons' ); ?></label>
			<input type="text" value="<?php echo esc_attr( $instance['social_one_link'] ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'social_one_link' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'social_one_link' ) ); ?>" class="widefat" />
			<br />
			<small><?php esc_html_e( 'Add Social Site Link', 'infinite-addons' ); ?></small>
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
			<label for="<?php echo esc_attr( $this->get_field_id( 'social_two_link' ) ); ?>"><?php esc_html_e( 'Social Two URL:', 'infinite-addons' ); ?></label>
			<input type="text" value="<?php echo esc_attr( $instance['social_two_link'] ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'social_two_link' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'social_two_link' ) ); ?>" class="widefat" />
			<br />
			<small><?php esc_html_e( 'Add Social Site Link', 'infinite-addons' ); ?></small>
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
			<label for="<?php echo esc_attr( $this->get_field_id( 'social_three_link' ) ); ?>"><?php esc_html_e( 'Social Three URL:', 'infinite-addons' ); ?></label>
			<input type="text" value="<?php echo esc_attr( $instance['social_three_link'] ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'social_three_link' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'social_three_link' ) ); ?>" class="widefat" />
			<br />
			<small><?php esc_html_e( 'Add Social Site Link', 'infinite-addons' ); ?></small>
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'social_four' ) ); ?>"><?php esc_html_e( 'Social Four Site:', 'infinite-addons' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'social_four' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'social_four' ) ); ?>" class="widefat">
			<?php foreach( $socials as $key => $value ) { ?>
				<option value="<?php echo esc_attr( $value ) ?>"<?php selected( $instance['social_four'], $value ); ?>><?php esc_html_e( $key ); ?></option>
			<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'social_four_link' ) ); ?>"><?php esc_html_e( 'Social Four URL:', 'infinite-addons' ); ?></label>
			<input type="text" value="<?php echo esc_attr( $instance['social_four_link'] ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'social_four_link' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'social_four_link' ) ); ?>" class="widefat" />
			<br />
			<small><?php esc_html_e( 'Add Social Site Link', 'infinite-addons' ); ?></small>
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'social_five' ) ); ?>"><?php esc_html_e( 'Social Five Site:', 'infinite-addons' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'social_five' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'social_five' ) ); ?>" class="widefat">
			<?php foreach( $socials as $key => $value ) { ?>
				<option value="<?php echo esc_attr( $value ) ?>"<?php selected( $instance['social_five'], $value ); ?>><?php esc_html_e( $key ); ?></option>
			<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'social_five_link' ) ); ?>"><?php esc_html_e( 'Social Five URL:', 'infinite-addons' ); ?></label>
			<input type="text" value="<?php echo esc_attr( $instance['social_five_link'] ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'social_five_link' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'social_five_link' ) ); ?>" class="widefat" />
			<br />
			<small><?php esc_html_e( 'Add Social Site Link', 'infinite-addons' ); ?></small>
		</p>

<?php
	}
}