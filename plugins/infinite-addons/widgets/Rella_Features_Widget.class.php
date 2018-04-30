<?php
/**
* Rella Features Widget
*
* @package Boo
*/
 
class Rella_Features_Widget extends WP_Widget {
	
		function __construct() {

		$widget_ops = array( 
			'classname' => 'widget_features', 
			'description' => esc_html__( 'Displays icon with text', 'infinite-addons' ) 
		);

		parent::__construct( 'rella-features-widget', esc_html__( 'ThemeRella: Features List', 'infinite-addons' ), $widget_ops );

		$this-> alt_option_name = 'widget_rella_features';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
		add_action( 'rella_shortcodes_styles', array( &$this, 'styles' ) );

	}
	
	function styles() {
		wp_enqueue_style( 'rella-sc-button' );
		wp_enqueue_style( 'rella-sc-icon-box' );
	} 
	
	function widget( $args, $instance ) {

		$cache = wp_cache_get( 'widget_rella_features', 'widget' );

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
		
		$feature_one_icon = isset( $instance['feature_one_icon'] ) ? $instance['feature_one_icon'] : '';
		$feature_one_heading = ! empty( $instance['feature_one_heading'] ) ? $instance['feature_one_heading'] : '';
		
		$feature_two_icon = isset( $instance['feature_two_icon'] ) ? $instance['feature_two_icon'] : '';
		$feature_two_heading = ! empty( $instance['feature_two_heading'] ) ? $instance['feature_two_heading'] : '';
		
		$feature_three_icon = isset( $instance['feature_three_icon'] ) ? $instance['feature_three_icon'] : '';
		$feature_three_heading = ! empty( $instance['feature_three_heading'] ) ? $instance['feature_three_heading'] : '';
		
		$feature_four_icon = isset( $instance['feature_four_icon'] ) ? $instance['feature_four_icon'] : '';
		$feature_four_heading = ! empty( $instance['feature_four_heading'] ) ? $instance['feature_four_heading'] : '';
		
		$feature_five_icon = isset( $instance['feature_five_icon'] ) ? $instance['feature_five_icon'] : '';
		$feature_five_heading = ! empty( $instance['feature_five_heading'] ) ? $instance['feature_five_heading'] : '';
		
		$feature_six_icon = isset( $instance['feature_six_icon'] ) ? $instance['feature_six_icon'] : '';
		$feature_six_heading = ! empty( $instance['feature_six_heading'] ) ? $instance['feature_six_heading'] : '';
		
		$button_label = isset( $instance['button_label'] ) ? $instance['button_label'] : '';
		$button_url   = isset( $instance['button_url'] ) ? $instance['button_url'] : '';

		ob_start();
		extract( $args );

		echo $before_widget;
		
		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$desc = ! empty( $instance['desc'] ) ? $instance['desc'] : '';

        if( $title ):
            echo $before_title . esc_html( $title ) . $after_title;
        endif; 
        
		if( $desc ):
			echo wpautop( wp_kses_post( $desc ) );
        endif;
        ?>
		<ul>
			<?php
				if( ! empty( $feature_one_heading ) ) :
			?>
			<li>
				<div class="icon-box icon-box-inline">
					<div class="icon-container">
						<i class="<?php echo $feature_one_icon; ?>"></i>
					</div> <!-- /.icon-container -->
					<h3><?php echo esc_html( $feature_one_heading ); ?></h3>
				</div> <!-- /.icon-box icon-box-inline -->
			</li>
			<?php
				endif;
			?>
			<?php
				if( ! empty( $feature_two_heading ) ) :
			?>
			<li>
				<div class="icon-box icon-box-inline">
					<div class="icon-container">
						<i class="<?php echo $feature_two_icon; ?>"></i>
					</div> <!-- /.icon-container -->
					<h3><?php echo esc_html( $feature_two_heading ); ?></h3>
				</div> <!-- /.icon-box icon-box-inline -->
			</li>
			<?php
				endif;
			?>
			<?php
				if( ! empty( $feature_three_heading ) ) :
			?>
			<li>
				<div class="icon-box icon-box-inline">
					<div class="icon-container">
						<i class="<?php echo $feature_three_icon; ?>"></i>
					</div> <!-- /.icon-container -->
					<h3><?php echo esc_html( $feature_three_heading ); ?></h3>
				</div> <!-- /.icon-box icon-box-inline -->
			</li>
			<?php
				endif;
			?>
			<?php
				if( ! empty( $feature_four_heading ) ) :
			?>
			<li>
				<div class="icon-box icon-box-inline">
					<div class="icon-container">
						<i class="<?php echo $feature_four_icon; ?>"></i>
					</div> <!-- /.icon-container -->
					<h3><?php echo esc_html( $feature_four_heading ); ?></h3>
				</div> <!-- /.icon-box icon-box-inline -->
			</li>
			<?php
				endif;
			?>
			<?php
				if( ! empty( $feature_five_heading ) ) :
			?>
			<li>
				<div class="icon-box icon-box-inline">
					<div class="icon-container">
						<i class="<?php echo $feature_five_icon; ?>"></i>
					</div> <!-- /.icon-container -->
					<h3><?php echo esc_html( $feature_five_heading ); ?></h3>
				</div> <!-- /.icon-box icon-box-inline -->
			</li>
			<?php
				endif;
			?>
			<?php
				if( ! empty( $feature_six_heading ) ) :
			?>
			<li>
				<div class="icon-box icon-box-inline">
					<div class="icon-container">
						<i class="<?php echo $feature_six_icon; ?>"></i>
					</div> <!-- /.icon-container -->
					<h3><?php echo esc_html( $feature_six_heading ); ?></h3>
				</div> <!-- /.icon-box icon-box-inline -->
			</li>
			<?php
				endif;
			?>
			
		</ul>
		
		<?php
			if( ! empty( $button_label ) ) :
		?>
			<a href="<?php echo esc_url( $button_url ); ?>" class="btn btn-solid circle btn-block"><span><?php echo esc_html( $button_label ); ?><i class="fa fa-angle-right"></i></span></a>
		<?php
			endif;
		?>

	<?php
		echo $after_widget;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_rella_features', $cache, 'widget');
	}
	
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['desc'] = $new_instance['desc'];
		
		$instance['feature_one_icon'] = strip_tags( $new_instance['feature_one_icon'] );
		$instance['feature_one_heading'] = strip_tags( $new_instance['feature_one_heading'] );

		$instance['feature_two_icon'] = strip_tags( $new_instance['feature_two_icon'] );
		$instance['feature_two_heading'] = strip_tags( $new_instance['feature_two_heading'] );
		
		$instance['feature_three_icon'] = strip_tags( $new_instance['feature_three_icon'] );
		$instance['feature_three_heading'] = strip_tags( $new_instance['feature_three_heading'] );
		
		$instance['feature_four_icon'] = strip_tags( $new_instance['feature_four_icon'] );
		$instance['feature_four_heading'] = strip_tags( $new_instance['feature_four_heading'] );
		
		$instance['feature_five_icon'] = strip_tags( $new_instance['feature_five_icon'] );
		$instance['feature_five_heading'] = strip_tags( $new_instance['feature_five_heading'] );
		
		$instance['feature_six_icon'] = strip_tags( $new_instance['feature_six_icon'] );
		$instance['feature_six_heading'] = strip_tags( $new_instance['feature_six_heading'] );
		
		$instance['button_label'] = strip_tags( $new_instance['button_label'] );
		$instance['button_url'] = esc_url( $new_instance['button_url'] );

		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['widget_rella_features'] ) ) {

			delete_option('widget_rella_features');

		}
		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete( 'widget_rella_features', 'widget' );
	}
	
	function form( $instance ) {

        $title = isset( $instance['title'] ) ? $instance['title'] : '';
		$desc  = isset( $instance['desc'] ) ? $instance['desc'] : '';
		
		$feature_one_icon    = isset( $instance['feature_one_icon'] ) ? $instance['feature_one_icon'] : '';
		$feature_one_heading = isset( $instance['feature_one_heading'] ) ? $instance['feature_one_heading'] : '';
		
		$feature_two_icon    = isset( $instance['feature_two_icon'] ) ? $instance['feature_two_icon'] : '';
		$feature_two_heading = isset( $instance['feature_two_heading'] ) ? $instance['feature_two_heading'] : '';
		
		$feature_three_icon    = isset( $instance['feature_three_icon'] ) ? $instance['feature_three_icon'] : '';
		$feature_three_heading = isset( $instance['feature_three_heading'] ) ? $instance['feature_three_heading'] : '';
		
		$feature_four_icon    = isset( $instance['feature_four_icon'] ) ? $instance['feature_four_icon'] : '';
		$feature_four_heading = isset( $instance['feature_four_heading'] ) ? $instance['feature_four_heading'] : '';
		
		$feature_five_icon    = isset( $instance['feature_five_icon'] ) ? $instance['feature_five_icon'] : '';
		$feature_five_heading = isset( $instance['feature_five_heading'] ) ? $instance['feature_five_heading'] : '';
		
		$feature_six_icon    = isset( $instance['feature_six_icon'] ) ? $instance['feature_six_icon'] : '';
		$feature_six_heading = isset( $instance['feature_six_heading'] ) ? $instance['feature_six_heading'] : '';

		$button_label = isset( $instance['button_label'] ) ? $instance['button_label'] : '';
		$button_url   = isset( $instance['button_url'] ) ? $instance['button_url'] : '';
		
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'infinite-addons' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>"><?php esc_html_e( 'Description:', 'infinite-addons' ); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'desc' ) ); ?>"><?php echo esc_attr( $desc ); ?></textarea>
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'feature_one_icon' ) ); ?>"><?php esc_html_e( 'Feature #1 Icon', 'infinite-addons' ); ?>
				<select id="<?php echo esc_attr( $this->get_field_id( 'feature_one_icon' ) ); ?>" class="widefat rella-icon-picker" name="<?php echo esc_attr( $this->get_field_name( 'feature_one_icon' ) ); ?>">
					<option value="" <?php selected( '', esc_attr( $feature_one_icon) ) ?>><?php esc_html_e( 'No Icons', 'boo' ) ?></option>
				<?php $arr = apply_filters( 'rella_menu_iconpicker_icons', array() );
					foreach ( $arr as $group => $icons ) { 	?>
					<optgroup label="<?php echo esc_attr( $group ); ?>">
					<?php foreach ( $icons as $key => $label ) {
						$class_key = key( $label ); ?>
						<option value="<?php echo esc_attr( $class_key ); ?>" <?php selected( $class_key, esc_attr( $feature_one_icon ) ) ?>><?php echo esc_html( current( $label ) ); ?></option>
					<?php } ?>
					</optgroup>
				<?php } ?>
				</select>
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'feature_one_heading' ) ); ?>"><?php esc_html_e( 'Feature #1 Heading', 'infinite-addons' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'feature_one_heading' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'feature_one_heading' ) ); ?>" type="text" value="<?php echo esc_attr( $feature_one_heading ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'feature_two_icon' ) ); ?>"><?php esc_html_e( 'Feature #2 Icon', 'infinite-addons' ); ?>
				<select id="<?php echo esc_attr( $this->get_field_id( 'feature_two_icon' ) ); ?>" class="widefat rella-icon-picker" name="<?php echo esc_attr( $this->get_field_name( 'feature_two_icon' ) ); ?>">
					<option value="" <?php selected( '', esc_attr( $feature_two_icon) ) ?>><?php esc_html_e( 'No Icons', 'boo' ) ?></option>
				<?php $arr = apply_filters( 'rella_menu_iconpicker_icons', array() );
					foreach ( $arr as $group => $icons ) { 	?>
					<optgroup label="<?php echo esc_attr( $group ); ?>">
					<?php foreach ( $icons as $key => $label ) {
						$class_key = key( $label ); ?>
						<option value="<?php echo esc_attr( $class_key ); ?>" <?php selected( $class_key, esc_attr( $feature_two_icon ) ) ?>><?php echo esc_html( current( $label ) ); ?></option>
					<?php } ?>
					</optgroup>
				<?php } ?>
				</select>
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'feature_two_heading' ) ); ?>"><?php esc_html_e( 'Feature #2 Heading', 'infinite-addons' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'feature_two_heading' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'feature_two_heading' ) ); ?>" type="text" value="<?php echo esc_attr( $feature_two_heading ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'feature_three_icon' ) ); ?>"><?php esc_html_e( 'Feature #3 Icon', 'infinite-addons' ); ?>
				<select id="<?php echo esc_attr( $this->get_field_id( 'feature_three_icon' ) ); ?>" class="widefat rella-icon-picker" name="<?php echo esc_attr( $this->get_field_name( 'feature_three_icon' ) ); ?>">
					<option value="" <?php selected( '', esc_attr( $feature_three_icon) ) ?>><?php esc_html_e( 'No Icons', 'boo' ) ?></option>
				<?php $arr = apply_filters( 'rella_menu_iconpicker_icons', array() );
					foreach ( $arr as $group => $icons ) { 	?>
					<optgroup label="<?php echo esc_attr( $group ); ?>">
					<?php foreach ( $icons as $key => $label ) {
						$class_key = key( $label ); ?>
						<option value="<?php echo esc_attr( $class_key ); ?>" <?php selected( $class_key, esc_attr( $feature_three_icon ) ) ?>><?php echo esc_html( current( $label ) ); ?></option>
					<?php } ?>
					</optgroup>
				<?php } ?>
				</select>
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'feature_three_heading' ) ); ?>"><?php esc_html_e( 'Feature #3 Heading', 'infinite-addons' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'feature_three_heading' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'feature_three_heading' ) ); ?>" type="text" value="<?php echo esc_attr( $feature_three_heading ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'feature_four_icon' ) ); ?>"><?php esc_html_e( 'Feature #4 Icon', 'infinite-addons' ); ?>
				<select id="<?php echo esc_attr( $this->get_field_id( 'feature_four_icon' ) ); ?>" class="widefat rella-icon-picker" name="<?php echo esc_attr( $this->get_field_name( 'feature_four_icon' ) ); ?>">
					<option value="" <?php selected( '', esc_attr( $feature_four_icon) ) ?>><?php esc_html_e( 'No Icons', 'boo' ) ?></option>
				<?php $arr = apply_filters( 'rella_menu_iconpicker_icons', array() );
					foreach ( $arr as $group => $icons ) { 	?>
					<optgroup label="<?php echo esc_attr( $group ); ?>">
					<?php foreach ( $icons as $key => $label ) {
						$class_key = key( $label ); ?>
						<option value="<?php echo esc_attr( $class_key ); ?>" <?php selected( $class_key, esc_attr( $feature_four_icon ) ) ?>><?php echo esc_html( current( $label ) ); ?></option>
					<?php } ?>
					</optgroup>
				<?php } ?>
				</select>
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'feature_four_heading' ) ); ?>"><?php esc_html_e( 'Feature #4 Heading', 'infinite-addons' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'feature_four_heading' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'feature_four_heading' ) ); ?>" type="text" value="<?php echo esc_attr( $feature_four_heading ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'feature_five_icon' ) ); ?>"><?php esc_html_e( 'Feature #5 Icon', 'infinite-addons' ); ?>
				<select id="<?php echo esc_attr( $this->get_field_id( 'feature_five_icon' ) ); ?>" class="widefat rella-icon-picker" name="<?php echo esc_attr( $this->get_field_name( 'feature_five_icon' ) ); ?>">
					<option value="" <?php selected( '', esc_attr( $feature_five_icon) ) ?>><?php esc_html_e( 'No Icons', 'boo' ) ?></option>
				<?php $arr = apply_filters( 'rella_menu_iconpicker_icons', array() );
					foreach ( $arr as $group => $icons ) { 	?>
					<optgroup label="<?php echo esc_attr( $group ); ?>">
					<?php foreach ( $icons as $key => $label ) {
						$class_key = key( $label ); ?>
						<option value="<?php echo esc_attr( $class_key ); ?>" <?php selected( $class_key, esc_attr( $feature_five_icon ) ) ?>><?php echo esc_html( current( $label ) ); ?></option>
					<?php } ?>
					</optgroup>
				<?php } ?>
				</select>
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'feature_five_heading' ) ); ?>"><?php esc_html_e( 'Feature #5 Heading', 'infinite-addons' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'feature_five_heading' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'feature_five_heading' ) ); ?>" type="text" value="<?php echo esc_attr( $feature_five_heading ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'feature_six_icon' ) ); ?>"><?php esc_html_e( 'Feature #6 Icon', 'infinite-addons' ); ?>
				<select id="<?php echo esc_attr( $this->get_field_id( 'feature_six_icon' ) ); ?>" class="widefat rella-icon-picker" name="<?php echo esc_attr( $this->get_field_name( 'feature_six_icon' ) ); ?>">
					<option value="" <?php selected( '', esc_attr( $feature_six_icon) ) ?>><?php esc_html_e( 'No Icons', 'boo' ) ?></option>
				<?php $arr = apply_filters( 'rella_menu_iconpicker_icons', array() );
					foreach ( $arr as $group => $icons ) { 	?>
					<optgroup label="<?php echo esc_attr( $group ); ?>">
					<?php foreach ( $icons as $key => $label ) {
						$class_key = key( $label ); ?>
						<option value="<?php echo esc_attr( $class_key ); ?>" <?php selected( $class_key, esc_attr( $feature_six_icon ) ) ?>><?php echo esc_html( current( $label ) ); ?></option>
					<?php } ?>
					</optgroup>
				<?php } ?>
				</select>
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'feature_six_heading' ) ); ?>"><?php esc_html_e( 'Feature #6 Heading', 'infinite-addons' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'feature_six_heading' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'feature_six_heading' ) ); ?>" type="text" value="<?php echo esc_attr( $feature_six_heading ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'button_label' ) ); ?>"><?php esc_html_e( 'Button Label', 'infinite-addons' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_label' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_label' ) ); ?>" type="text" value="<?php echo esc_attr( $button_label ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'button_url' ) ); ?>"><?php esc_html_e( 'Button URL', 'infinite-addons' ); ?></label>
			<input class="widefat link" placeholder="http://" id="<?php echo esc_attr( $this->get_field_id( 'button_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_url' ) ); ?>" type="text" value="<?php echo esc_attr( $button_url ); ?>" />
		</p>
		<?php
	}

}