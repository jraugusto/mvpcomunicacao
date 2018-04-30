<?php
/*
Plugin Name: Infinite Addons
Plugin URI: http://boo.themerella.com/
Description: A part of Boo theme
Version: 1.3.7
Author: ThemeRella Team
Author URI: https://themeforest.net/user/themerella
Text Domain: infinite-addons
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'RA_ADDONS_PATH', plugin_dir_path( __FILE__ ) );
define( 'RA_ADDONS_URL', plugin_dir_url( __FILE__ ) );

include_once RA_ADDONS_PATH . 'includes/rella-base.php';

class Rella_Addons extends Rella_Base {

	/**
	 * Hold an instance of Rella_Addons class.
	 * @var Rella_Addons
	 */
	protected static $instance = null;

	/**
	 * [$params description]
	 * @var array
	 */
	public $params = array();

	/**
	 * Main Rella_Addons instance.
	 *
	 * @return Rella_Addons - Main instance.
	 */
	public static function instance() {

		if(null == self::$instance) {
			self::$instance = new Rella_Addons();
		}

		return self::$instance;
	}

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		spl_autoload_register( array( $this, 'auto_load' ) );
		$this->includes();
		$this->add_action( 'plugins_loaded', 'load_plugin_textdomain' );
		$this->add_action( 'admin_init', 'libs_init', 10, 1 );
		$this->add_action( 'admin_init', 'rella_update_theme' );
		$this->add_action( 'rella_init', 'init_hooks' );
		$this->add_action( 'admin_notices', 'activate_theme_notice' );
		$this->add_filter( 'wp_kses_allowed_html', 'wp_kses_allowed_html', 10, 2 );
		$this->add_filter( 'tuc_request_update_query_args-Boo','autoupdate_verify');
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
	 * [Auto load libraries]
	 * @method auto_load
	 *
	 * @param $class
	 * @return type
	 * @since    1.0.0
	 */
	public function auto_load( $class ) {
		if( strpos( $class, 'Rella' ) !== false ) {
			$class_dir = RA_ADDONS_PATH  . 'libs'.DIRECTORY_SEPARATOR.'core-importer'.DIRECTORY_SEPARATOR;
        	$class_dir_ = RA_ADDONS_PATH . 'libs'.DIRECTORY_SEPARATOR.'rella-api'.DIRECTORY_SEPARATOR;
        	$class_name = str_replace( '_', DIRECTORY_SEPARATOR, $class ).'.php';
        	if(file_exists($class_dir.$class_name)) {
            	require_once $class_dir.$class_name;
        	}
        	if(file_exists($class_dir_.$class_name)) {
            	require_once $class_dir_.$class_name;
        	}
    	}
	}

	/**
	 * [includes description]
	 * @method includes
	 *
	 * @return [type]   [description]
	 */
	public function includes() {

		include_once $this->plugin_dir() . 'includes/rella-helpers.php';
		include_once $this->plugin_dir() . 'extensions/extensions.init.php';
		include_once $this->plugin_dir() . 'libs/updater/plugin-update-checker.php';

	}
	
	public function rella_update_theme() {
		
		if( defined( 'ENVATO_HOSTED_SITE' ) ) {
			return;
		}

		Puc_v4_Factory::buildUpdateChecker(
			'http://api.themerella.com/update.php',
			get_template_directory(),
			get_template()
		);		
		
	}

	/**
	 * [init_hooks description]
	 * @method init_hooks
	 *
	 * @return [type]     [description]
	 */
	public function init_hooks() {

		$this->assets_css = plugins_url( '/assets/css', __FILE__ );
		$this->assets_js  = plugins_url( '/assets/js', __FILE__ );

		include_once $this->plugin_dir() . 'extras/rella-extras.php';

		if( class_exists( 'WPBakeryShortCode' ) ) {
			include_once $this->plugin_dir() . 'includes/rella-shortcode.php';
			include_once $this->plugin_dir() . 'includes/params/rella-extra-params.php';
			include_once $this->plugin_dir() . 'includes/params/rella-default-params.php';
		    include_once $this->plugin_dir() . 'includes/params/rella-icon-params.php';
		    include_once $this->plugin_dir() . 'includes/params/rella-font-params.php';
		}

		$this->add_action( 'admin_print_scripts-post.php', 'enqueue', 99 );
		$this->add_action( 'admin_print_scripts-post-new.php', 'enqueue', 99 );
		$this->add_action( 'admin_print_scripts-widgets.php', 'enqueue_widgets', 99 );
		$this->add_action( 'vc_load_default_params', 'reload_vc_js' );
		$this->add_action( 'vc_load_iframe_jscss', 'vc_frontend_jscss' );
		$this->add_action( 'init', 'load_post_types', 1 );
		$this->add_action( 'init', 'init', 25 );
		$this->add_action( 'widgets_init', 'load_widgets', 25 );
	}

	public function activate_theme_notice() {

		if( did_action( 'rella_init' ) > 0 ) {
			return;
		}
	?>
		<div class="updated not-h2">
			<p><strong><?php esc_html_e( 'Please activate the Boo theme to use Infinite Addons plugin.', 'infinite-addons' ); ?></strong></p>
			<?php
				$screen = get_current_screen();
				if ($screen -> base != 'themes'):
			?>
				<p><a href="<?php echo esc_url( admin_url( 'themes.php' ) ); ?>"><?php esc_html_e( 'Activate theme', 'infinite-addons' ); ?></a></p>
			<?php endif; ?>
		</div>
	<?php
	}

	/**
	 * [init description]
	 * @method init
	 *
	 * @return [type] [description]
	 */
	public function init() {

		if ( class_exists( 'Vc_Manager' ) && class_exists( 'WPBakeryShortCode' ) ) {
			$this->init_vc();
			$this->vc_integration();
			$this->load_shortcodes();
			$this->vc_rella_templates();
		}
	}

	/**
	 * [Load plugin libraries]
	 * @method libs_init
	 *
	 * @return type
	 * @since    1.0.0
	 */
	public function libs_init() {
		global $RellaCore;//to do rename the libs core class
		$RellaCore                              = new RellaCore();
		$RellaCore['path']                      = RA_ADDONS_PATH;
    	$RellaCore['url']                       = RA_ADDONS_URL;
    	$RellaCore['version']                   = '1.0';
    	$RellaCore['RellaRedirect']             = new RellaRedirect();
    	$RellaCore['RellaEnvato']               = new RellaEnvato();
    	$RellaCore['RellaCheck']                = new RellaCheck();
    	$RellaCore['RellaNotices']              = new RellaNotices();
    	$RellaCore['RellaLog']                  = new RellaLog();
    	$RellaCore['RellaDownload']             = new RellaDownload( $RellaCore );
    	$RellaCore['RellaReset']                = new RellaReset( $RellaCore );
    	$RellaCore['RellaThemeDemoImporter']    = new RellaThemeDemoImporter( $RellaCore );
    	apply_filters( 'rella/config', $RellaCore );
    	return $RellaCore->run();
	}

	/**
	 * [Accsess the libs core class]
	 * @method rella_libs_core
	 *
	 * @return object|null
	 * @since    1.0.0
	 */
	public function rella_libs_core( $class = '' ) {
		global $RellaCore;
		if( isset( $class ) ) {
			return $RellaCore;
		} else {
			if( is_object( $RellaCore[$class] ) ) {
				return $RellaCore[$class];
			}
		}
	}

	/**
	 * [Show login notice for users]
	 * @method rella_login_notice
	 *
	 * @return object|null
	 * @since    1.0.0
	 */
	public function rella_login_notice() {
		$RellaCore = $this->rella_libs_core();
		if( $RellaCore['RellaCheck']->logged_in_mail() === null && !isset($_GET['refresh']) && $RellaCore['RellaNotices']->get_cookie_timer() != 1 ) {
			$message = sprintf( wp_kses_post( __( '<a href="%s">Log in</a> with your Envato account to take full advantage of <strong>Boo theme</strong>', 'infinite-addons' ) ), $RellaCore['RellaEnvato']->login_url() );
			$RellaCore['RellaNotices']->admin_notice($message, array(
            	'type' => 'info',
           		'classes' => 'rella-login-notice',
            	'dismissTime' => 'rella_dissmiss_timer'
        	));
		} elseif( !$RellaCore['RellaCheck']->is_vaild() && !isset($_GET['refresh']) ) {
    		$message = sprintf( wp_kses_post( __( 'We couldn\'t find <strong>Boo theme</strong> with the logged in account <a href="%s">Log in with different account</a>', 'infinite-addons' ) ), $RellaCore['RellaEnvato']->login_url() );
    		$RellaCore['RellaNotices']->admin_notice($message, array(
    			'type' => 'error',
            	'classes' => 'rella-login-notice rella-not-vaild',
            	'dismissTime' => 'rella_dissmiss_timer'
        	));
   		}
	}

	public function autoupdate_verify( $query_args ) {
		$RellaCore = $this->rella_libs_core();
		$rella_token = $RellaCore['RellaCheck']->get_token();
		if( isset($rella_token) && $rella_token != ''){
			$query_args['token'] = $rella_token;
		}else{
			$query_args['token'] = '';
		}
		return $query_args;
	}

	/**
	 * Loand vc scripts
	 */
	public function enqueue() {
		
		//Load jquery UI css
		wp_enqueue_style('jquery-ui', $this->assets_css. '/jquery-ui.min.css' );
		wp_enqueue_style('jquery-ui-structure', $this->assets_css. '/jquery-ui.structure.min.css' );
		wp_enqueue_style('jquery-ui-theme', $this->assets_css. '/jquery-ui.theme.min.css' );

		wp_enqueue_style( 'ics-gradient',    $this->assets_css. '/ics-gradient-editor.min.css' );
		wp_enqueue_style( 'ra-vc-custom', $this->assets_css. '/vc-style.css' );

		wp_enqueue_script( 'ics-gradient',   $this->assets_js . '/ics-gradient-editor.min.js' ,  array('jquery'), '1.0.0', true );
		wp_enqueue_script( 'ra-vc-script',   $this->assets_js . '/vc-script.js' ,      array('jquery'), '1.0.0', true );
	}

	/**
	 * Loand vc scripts
	 */
	public function vc_frontend_jscss() {
		wp_enqueue_style( 'ra-vc-frontend', $this->assets_css. '/vc-frontend-style.css' );
		wp_enqueue_script( 'ra-vc-frontend-script',   $this->assets_js . '/vc-script-frontend.js' , array('jquery'), '1.0.0', true );
	}

	/**
	 * [load_post_types description]
	 * @method load_post_types
	 *
	 * @return [type]          [description]
	 */
	public function load_post_types() {

		require_if_theme_supports( 'rella-header', $this->plugin_dir() . 'post-types/rella-header.php' );
		require_if_theme_supports( 'rella-promotion', $this->plugin_dir() . 'post-types/rella-promotion.php' );
		require_if_theme_supports( 'rella-footer', $this->plugin_dir() . 'post-types/rella-footer.php' );
		require_if_theme_supports( 'rella-mega-menu', $this->plugin_dir() . 'post-types/rella-mega-menu.php' );
		require_if_theme_supports( 'rella-team', $this->plugin_dir() . 'post-types/rella-team.php' );
		require_if_theme_supports( 'rella-faq', $this->plugin_dir() . 'post-types/rella-faq.php' );
		require_if_theme_supports( 'rella-testimonial', $this->plugin_dir() . 'post-types/rella-testimonial.php' );

	}

	/**
	 * [vc_rella_templates description]
	 * @method vc_rella_templates
	 *
	 * @return [type]  [description]
	 */
	public function vc_rella_templates() {

		$rella_templates = new Rella_Vc_Templates_Panel_Editor();
		return $rella_templates->init();

	}

	/**
	 * [init_vc description]
	 * @method init_vc
	 *
	 * @return [type]  [description]
	 */
	public function init_vc() {

		global $vc_manager;
		$vc_manager->setIsAsTheme();
		$vc_manager->disableUpdater();

		$list = array( 'page', 'post', 'product', 'rella-header', 'rella-footer', 'rella-mega-menu', 'rella-portfolio' );
		$vc_manager->setEditorDefaultPostTypes( $list );

		//disable VC update notifications
		if( is_admin() ) {

			if ( ! isset( $_COOKIE['vchideactivationmsg'] ) ) {
				setcookie( 'vchideactivationmsg', '1', strtotime( '+3 years' ), '/' );
			}

			if ( ! isset( $_COOKIE[ 'vchideactivationmsg_vc11' ] ) ) {
				setcookie( 'vchideactivationmsg_vc11', ( defined( 'WPB_VC_VERSION' ) ? WPB_VC_VERSION : '1' ), strtotime( '+3 years' ), '/' );
			}
		}

		include_once $this->plugin_dir() . 'includes/params/rella-gradient-param.php';
		include_once $this->plugin_dir() . 'includes/params/rella-select-image-param.php';
		include_once $this->plugin_dir() . 'includes/params/rella-slider-param.php';
		include_once $this->plugin_dir() . 'includes/params/rella-subheading-param.php';
		include_once $this->plugin_dir() . 'includes/params/rella-responsive-param.php';
		include_once $this->plugin_dir() . 'includes/params/rella-responsive-alignment-param.php';
		include_once $this->plugin_dir() . 'includes/params/shape-divider-param/rella-shape-divider-param.php';
		include_once $this->plugin_dir() . 'includes/params/rella-attach-image-param.php';
		include_once $this->plugin_dir() . 'includes/params/rella-checkbox-param.php';
		include_once $this->plugin_dir() . 'includes/params/rella-advanced-checkbox-param.php';

		// Set new theme directory
		$dir = get_template_directory() . '/templates/vc';
		vc_set_shortcodes_templates_dir( $dir );
	}

	/**
	 * [vc_integration description]
	 * @method vc_integration
	 *
	 * @return [type]         [description]
	 */
	public function vc_integration() {

	}

	/**
	 * [load_shortcodes description]
	 * @method load_shortcodes
	 *
	 * @return [type]          [description]
	 */
	public function load_shortcodes() {

		//List of shortcodes in APLHABETICAL ORDER!!!!
		$shortcodes = array(
			'advertisement',
			'accordion',
			'banner',
			'blog',
			'box-rounded',
			'button',
			'carousel',
			'client',
			'contact-form',
			'content-box',
			'counter',
			'countdown',
			'custom-menu',
			'd-slider',
			'featured-box',
			'flipbox',
			'lang-chooser',
			'gallery',
			'history',
			'icon-box',
			'instagram',
			'latest-posts',
			'lightbox',
			'line-guide',
			'mapped-image',
			'modal-window',
			'my-account',
			'newsletter',
			'particles',
			'pointer',
			'pointer-tooltip',
			'price-table',
			'progressbar',
			'promo',
			'restaurant-menu',
			'section-title',
			'shop-banner',
			'social-icons',
			'tabs',
			'team-member',
			'testi-slider',
			'testimonial',
			'tooltip-image',
			'top-arrow',
			'tweet',
			'typed-string',
			'video',
			'woo-products',
			'woo-carousel',

			// Should be in last
			'google-map',

			// Header
			'header-cart',
			'header-container',
			'header-container-mobile',
			'header-main-nav',
			'header-search',
			'header-wishlist',

			'misc'
		);

		//Add portfolio sc if Infinite Portfolio is enabled
		if( class_exists( 'Rella_Portfolio' ) ) {
			array_push(
				$shortcodes,
				'portfolio',
				'portfolio-listing'
			);
		};

		// Order Shortcodes
		sort( $shortcodes );

		foreach( $shortcodes as $shortcode ) {

			$file = $this->plugin_dir(). "shortcodes/{$shortcode}/rella-{$shortcode}.php";

			if ( file_exists( $file ) ) {
				require_once $file;
			}
		}
	}

	/**
	 * [load_widgets description]
	 * @method load_widgets
	 *
	 * @return [type]       [description]
	 */
	public function load_widgets() {

		//List of widgets in APLHABETICAL ORDER!!!!
		$widgets = array(
			'Rella_Latest_Comments_Widget',
			'Rella_Latest_Posts_Widget',
			'Rella_Trending_Posts_Widget',
			'Rella_Latest_Tweets_Widget',
			'Rella_Social_Followers_Widget',
			'Rella_Social_Followus_Widget',
			'Rella_Newsletter_Widget',
			'Rella_Side_Nav_Widget',
			'Rella_Features_Widget'
		);

		foreach( $widgets as $widget ) {
			if ( file_exists( $this->plugin_dir(). "widgets/{$widget}.class.php" ) ) {
				require_once( $this->plugin_dir(). "widgets/{$widget}.class.php" );
				register_widget( $widget );
			}
		}
	}

	/**
	 * Load widget scripts
	 */
	public function enqueue_widgets() {
		//wp_enqueue_script( 'rs-widgets',   $this->assets_js . '/widgets.js' ,  array('jquery','select2'), '1.0.0', true );
		wp_enqueue_media();
	}

	/**
	 * Reload JS
	 */
	public function reload_vc_js() {
		//echo '<script type="text/javascript">(function($){ $(document).ready( function(){ $.reloadPlugins(); }); })(jQuery);</script>';
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
		return RA_ADDONS_PATH;
	}

	public function wp_kses_allowed_html( $tags, $context ) {

		if( 'post' !== $context ) {
			return $tags;
		}

		$tags['style'] = array( 'types' => array() );

		return $tags;
	}
}

/**
 * Main instance of Rella_Theme.
 *
 * Returns the main instance of Rella_Theme to prevent the need to use globals.
 *
 * @return Rella_Theme
 */
function rella_addons() {
	return Rella_Addons::instance();
}
rella_addons(); // init i

register_activation_hook( __FILE__, array( 'Rella_Addons', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Rella_Addons', 'deactivate' ) );
