<?php
/**
 * The Admin Menu Walker
 * Menu Walker class to add fields into menu management screen
*/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Add new Fields
 * Based on Walker_Nav_Menu_Edit class.
 */
class Rella_Mega_Menu_Edit_Walker extends Walker_Nav_Menu_Edit {

	function __construct() {

		$this->megamenus = get_posts(array(
			'post_type' => 'rella-mega-menu',
			'posts_per_page' => -1
		));

		$this->walker_args = array(
			'depth' => 0,
			'child_of' => 0,
			'selected' => 0,
			'value_field' => 'ID'
		);
	}

	/**
	 * Start the element output.
	 *
	 * @see Walker_Nav_Menu::start_el()
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$item_output = '';
		parent::start_el($item_output, $item, $depth, $args, $id);

		// Adding new Fields
        $item_output = str_replace( '<fieldset class="field-move', $this->get_fields( $item, $depth, $args, $id ) . '<fieldset class="field-move', $item_output );

        $output .= $item_output;
	}

	function get_fields( $item, $depth = 0, $args = array(), $id = 0 ) {
        ob_start();

        $item_id = esc_attr( $item->ID );
	?>

		<?php if( 0 === $depth ) : ?>
		<p class="description description-wide">
            <label for="edit-menu-item-rella-megaprofile-<?php echo esc_attr( $item_id ); ?>">
                <?php esc_html_e( 'Select Mega Menu', 'boo' ); ?><br />
				<select id="edit-menu-item-rella-megaprofile-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-rella-megaprofile[<?php echo esc_attr( $item_id ); ?>]">
					<option value="0"><?php esc_html_e( 'None', 'boo' ) ?></option>
					<?php
						$r = $this->walker_args;
						$r['selected'] = $item->rella_megaprofile;
						echo walk_page_dropdown_tree( $this->megamenus, $r['depth'], $r );
					?>
				</select>
            </label>
        </p>
        
        <p class="description description-wide">
            <label for="edit-menu-item-rella-submenu-color-<?php echo esc_attr( $item_id ); ?>">
				<?php esc_html_e( 'Submenu Style', 'boo' ); ?><br />
				<select id="edit-menu-item-rella-submenu-color-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-rella-submenu-color[<?php echo esc_attr( $item_id ); ?>]">
					<option value="default" <?php selected( 'default', esc_attr( $item->rella_submenu_color ) ) ?>><?php esc_html_e( 'Default', 'boo' ); ?></option>
					<option value="submenu-dark" <?php selected( 'submenu-dark', esc_attr( $item->rella_submenu_color ) ) ?>><?php esc_html_e( 'Default Dark', 'boo' ); ?></option>
					<option value="nav-item-children-style2" <?php selected( 'nav-item-children-style2', esc_attr( $item->rella_submenu_color ) ) ?>><?php esc_html_e( 'Style 2', 'boo' ); ?></option>
				</select>
            </label>
	    </p>

		<p class="description description-wide">
            <label for="edit-menu-item-rella-badge-<?php echo esc_attr( $item_id ); ?>">
                <?php esc_html_e( 'Badge', 'boo' ); ?><br />
                <input type="text" id="edit-menu-item-rella-badge-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-rella-badge[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->rella_badge ); ?>" />
            </label>
        </p>

		<p class="description description-wide">
            <label for="edit-menu-item-rella-badge-style-<?php echo esc_attr( $item_id ); ?>">
                <?php esc_html_e( 'Badge Style', 'boo' ); ?><br />
                <select id="edit-menu-item-rella-badge-style-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-rella-badge-style[<?php echo esc_attr( $item_id ); ?>]">
					<option value="style1" <?php selected( 'style1', esc_attr( $item->rella_badge_style ) ) ?>><?php esc_html_e( 'Style1', 'boo' ); ?></option>
					<option value="style2" <?php selected( 'style2', esc_attr( $item->rella_badge_style ) ) ?>><?php esc_html_e( 'Style2', 'boo' ); ?></option>
				</select>
            </label>
        </p>
		<?php endif; ?>

		<p class="description description-wide">
            <label for="edit-menu-item-rella-icon-<?php echo esc_attr( $item_id ); ?>">
                <?php esc_html_e( 'Icon', 'boo' ); ?><br />
					<select id="edit-menu-item-rella-icon-<?php echo esc_attr( $item_id ); ?>" class="widefat rella-icon-picker" name="menu-item-rella-icon[<?php echo esc_attr( $item_id ); ?>]">
						<option value="" <?php selected( '', esc_attr( $item->rella_icon ) ) ?>><?php esc_html_e( 'No Icons', 'boo' ) ?></option>
					<?php $arr = apply_filters( 'rella_menu_iconpicker_icons', array() );
						foreach ( $arr as $group => $icons ) { 	?>
						<optgroup label="<?php echo esc_attr( $group ); ?>">
						<?php foreach ( $icons as $key => $label ) {
							$class_key = key( $label ); ?>
							<option value="<?php echo esc_attr( $class_key ); ?>" <?php selected( $class_key, esc_attr( $item->rella_icon ) ) ?>><?php echo esc_html( current( $label ) ); ?></option>
						<?php } ?>
						</optgroup>
					<?php } ?>
					</select>
            </label>
        </p>
        
		<?php
			// add rella custom icon option
			do_action( 'wp_nav_menu_item_custom_fields', $item_id, $item, $depth, $args );
		?>
        
		<p class="description description-wide">
            <label for="edit-menu-item-rella-icon-position-<?php echo esc_attr( $item_id ); ?>">
                <?php esc_html_e( 'Icon Position', 'boo' ); ?><br />
                <select id="edit-menu-item-rella-icon-position-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-rella-icon-position[<?php echo esc_attr( $item_id ); ?>]">
					<option value="left" <?php selected( 'left', esc_attr( $item->rella_icon_position ) ) ?>><?php esc_html_e( 'Left', 'boo' ); ?></option>
					<option value="center" <?php selected( 'center', esc_attr( $item->rella_icon_position ) ) ?>><?php esc_html_e( 'Center', 'boo' ); ?></option>
					<option value="right" <?php selected( 'right', esc_attr( $item->rella_icon_position ) ) ?>><?php esc_html_e( 'Right', 'boo' ); ?></option>
				</select>
            </label>
        </p>

        <?php if( 0 !== $depth ) : ?>
		<p class="description description-wide">
            <label for="edit-menu-item-rella-heading-item-<?php echo esc_attr( $item_id ); ?>">
                <?php esc_html_e( 'Make this item menu heading?', 'boo' ); ?><br />
                <select id="edit-menu-item-rella-heading-item-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-rella-heading-item[<?php echo esc_attr( $item_id ); ?>]">
					<option value="no" <?php selected( 'no', esc_attr( $item->rella_heading_item ) ) ?>><?php esc_html_e( 'No', 'boo' ); ?></option>
					<option value="yes" <?php selected( 'yes', esc_attr( $item->rella_heading_item ) ) ?>><?php esc_html_e( 'Yes', 'boo' ); ?></option>
				</select>            
			</label>
        </p>
        <?php endif; ?>

	<?php
        return ob_get_clean();
    }
}
