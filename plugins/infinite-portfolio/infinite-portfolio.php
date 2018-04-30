<?php
/*
Plugin Name: Infinite Portfolio
Plugin URI: http://boo.themerella.com/
Description: Portfolio custom posts for Boo theme
Version: 1.2
Author: ThemeRella Team
Author URI: https://themeforest.net/user/themerella
Text Domain: infinite-portfolio
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Rella_Portfolio {

	/**
	 * Hold an instance of Rella_Addons class.
	 * @var Rella_Addons
	 */
	protected static $instance = null;
	
	/**
	 * Main Rella_Addons instance.
	 *
	 * @return Rella_Addons - Main instance.
	 */
	public static function instance() {

		if(null == self::$instance) {
			self::$instance = new Rella_Portfolio();
		}

		return self::$instance;
	}

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );
		add_action( 'rella_init', array( $this, 'init_hooks' ) );
		add_action( 'admin_notices', array( $this, 'activate_addons_notice' ) );

	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain( 'infinite-addons', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

	/**
	 * [init_hooks description]
	 * @method init_hooks
	 * @return [type]     [description]
	 */
	public function init_hooks() {

		add_action( 'init', array( $this, 'load_post_types' ), 1 );

	}	

	public function activate_addons_notice() {

		if( class_exists( 'Rella_Addons' ) ) {
			return;
		}
	?>
		<div class="updated not-h2">
			<p><strong><?php esc_html_e( 'Please activate the Infinite Addons to use Infinite Portfolio plugin.', 'infinite-addons' ); ?></strong></p>
			<?php
				$screen = get_current_screen();
				if ($screen -> base != 'plugins'):
			?>
				<p><a href="<?php echo esc_url( admin_url( 'plugins.php' ) ); ?>"><?php esc_html_e( 'Activate Infinite Addons', 'infinite-addons' ); ?></a></p>
			<?php endif; ?>
		</div>
	<?php
	}

	/**
	 * [load_post_types description]
	 * @method load_post_types
	 * @return [type]          [description]
	 */
	public function load_post_types() {
		
		if( ! class_exists( 'Rella_Addons' ) ) {
			return;
		}

		if( function_exists( 'require_if_theme_supports' ) ) {
			require_if_theme_supports( 'rella-portfolio', $this->plugin_dir() . 'post-types/rella-portfolio.php' );
		}

	}

	/**
	 * Plugin activation
	 */
	public static function activate() {
		flush_rewrite_rules();
	}

	/**
	 * Plugin deactivation
	 */
	public static function deactivate() {
		flush_rewrite_rules();
	}

	public function plugin_uri() {
		return plugin_dir_url( __FILE__ );
	}

	public function plugin_dir() {
		return plugin_dir_path( __FILE__ );
	}
	
}

/**
 * Main instance of Rella_Theme.
 *
 * Returns the main instance of Rella_Theme to prevent the need to use globals.
 *
 * @return Rella_Theme
 */
function rella_portfolio() {
	return Rella_Portfolio::instance();
}
rella_portfolio(); // init i

register_activation_hook( __FILE__, array( 'Rella_Portfolio', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Rella_Portfolio', 'deactivate' ) );