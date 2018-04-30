<?php
/**
* Rella Newslleter Widget
*
* @package Boo
*/
 
class Rella_Newsletter_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_subscribe', 'description' => esc_html__( "Display Newsletter Form", 'infinite-addons' ) );
		parent::__construct( 'rella-newsllter', esc_html__( 'ThemeRella: Newsletter Form', 'infinite-addons' ), $widget_ops);

		$this-> alt_option_name = 'widget_rella_subscribe';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget( $args, $instance ) {

		$cache = wp_cache_get('widget_rella_subscribe', 'widget');

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
		
		$newsletter_id = ! empty( $instance['newsletter_id'] ) ? $instance['newsletter_id'] : '';
		$newsletter_style = ! empty( $instance['newsletter_style'] ) ? $instance['newsletter_style'] : '';

		ob_start();
		extract( $args );

		echo $before_widget;
		
        $title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );

        if( $title ):
            echo $before_title . esc_html( $title ) . $after_title;
        endif; ?>

	<?php if( 'alt' === $newsletter_style ) : ?>	
		<div class="subscribe-form subscribe-button-block-alt widget_subscribe_alt" data-plugin-subscribe-form="true" data-plugin-options='{"icon":"fa fa-angle-right"}'>
	<?php else : ?>
		<div class="subscribe-form subscribe-button-block-alt" data-plugin-subscribe-form="true" data-plugin-options='{"icon":"fa fa-angle-right"}'>
	<?php endif; ?>
		<?php echo do_shortcode('[wysija_form id=" ' . $newsletter_id . '"]'); ?>
	</div>
	<?php
		echo $after_widget;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_rella_subscribe', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
        $instance['title']         = strip_tags($new_instance['title']);
		$instance['newsletter_id'] = strip_tags( $new_instance['newsletter_id'] );
		$instance['newsletter_style'] = strip_tags( $new_instance['newsletter_style'] );

		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['widget_rella_subscribe'] ) ) {

			delete_option('widget_rella_subscribe');

		}
		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete( 'widget_rella_subscribe', 'widget' );
	}
	
	function get_mailpoet_forms() {

		if ( !class_exists('WYSIJA') ) {
			return array();
		}

		$model_forms = WYSIJA::get( 'forms', 'model' );
		$model_forms->reset();
		$forms = $model_forms->getRows( array( 'form_id', 'name' ) );
		$items = array();
		if (is_array($forms) && !is_wp_error($forms)) {
			foreach ($forms as $form) {
				$items[$form['form_id']] = $form['name'];
			}
		}

		return $items;

	}

	function form( $instance ) {

        $title   = isset($instance['title']) ? $instance['title'] : '';
		$newsletter_id = isset( $instance['newsletter_id'] ) ? $instance['newsletter_id'] : '';
		$newsletter_style = isset( $instance['newsletter_style'] ) ? $instance['newsletter_style'] : '';

		$forms = array_merge_recursive( array( esc_html__( 'Select', 'infinite-addons' ) => '' ) , array_flip( $this->get_mailpoet_forms() ) );
		
		$styles = array(
			'default' => esc_html__( 'Default', 'infinite-addons' ),
			'alt' => esc_html__( 'Style 1', 'infinite-addons'  ),
		);

		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'infinite-addons' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'newsletter_style' ) ); ?>"><?php esc_html_e( 'Newsletter Style:', 'infinite-addons' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'newsletter_style' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'newsletter_style' ) ); ?>" class="widefat">
			<?php foreach( $styles as $key => $style ) { ?>
				<option value="<?php echo esc_attr( $key ) ?>"<?php selected( $instance['newsletter_style'], $key ); ?>><?php esc_html_e( $style ); ?></option>
			<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'newsletter_id' ) ); ?>"><?php esc_html_e( 'Newsletter:', 'infinite-addons' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'newsletter_id' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'newsletter_id' ) ); ?>" class="widefat">
			<?php foreach( $forms as $key => $value ) { ?>
				<option value="<?php echo esc_attr( $value ) ?>"<?php selected( $instance['newsletter_id'], $value ); ?>><?php esc_html_e( $key ); ?></option>
			<?php } ?>
			</select>
		</p>

		<?php
	}
}