<?php
/**
* Themerella Theme Framework
* The Rella_Admin initiate the theme admin
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Rella_Admin extends Rella_Base {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Envato Market
		get_template_part( 'rella/libs/importer/rella', 'importer' );

		$this->add_action( 'init', 'init', 7 );
		$this->add_action( 'admin_init', 'save_plugins' );
		$this->add_action( 'admin_enqueue_scripts', 'enqueue', 99 );
		$this->add_action( 'admin_menu', 'fix_parent_menu', 999 );
		$this->add_action( 'admin_bar_menu', 'rella_toolbar', 999 );

		$this->add_action( 'vc_backend_editor_enqueue_js_css', 'vc_iconpicker_editor_jscss' );
		$this->add_action( 'vc_frontend_editor_enqueue_js_css', 'vc_iconpicker_editor_jscss' );
		$this->add_action( 'vc_frontend_editor_enqueue_js_css', 'vc_frontend_editor_js' );

	}

	/**
	 * [init description]
	 * @method init
	 * @return [type] [description]
	 */
	public function init() {

		rella()->load_theme_part( 'theme-register-plugins' );

		include_once( get_template_directory() . '/rella/admin/rella-admin-page.php' );
		include_once( get_template_directory() . '/rella/admin/rella-admin-dashboard.php' );
		//include_once 'rella-admin-plugins.php';
		include_once( get_template_directory() . '/rella/admin/rella-admin-import.php' );
		//include_once 'rella-admin-license.php';
	}

	/**
	 * [enqueue description]
	 * @method enqueue
	 * @return [type] [description]
	 */
    public function enqueue() {
	    
	    global $pagenow;

		wp_enqueue_style( 'rella-admin', rella()->load_assets( 'css/rella-admin.css' ) );
		wp_enqueue_style( 'rella-redux', rella()->load_assets( 'css/rella-redux.css' ) );
		wp_enqueue_style( 'font-awesome', rella()->load_assets( 'css/font-awesome.min.css' ) );
		
		//RTL Bootstrap
		if( is_rtl() ) {
			wp_enqueue_style( 'bootstrap-rtl', get_template_directory_uri() . '/assets/vendors/bootstrap-rtl/bootstrap-rtl.min.css' );	
		}

		if( 'nav-menus.php' == $pagenow || 'widgets.php' == $pagenow ) {
			//iconpicker
			wp_enqueue_style( 'rella-icon-picker-main-css', rella()->load_assets( 'vendors/iconpicker/css/jquery.fonticonpicker.min.css' ) );
			wp_enqueue_style( 'rella-icon-picker-main-css-theme', rella()->load_assets( 'vendors/iconpicker/themes/grey-theme/jquery.fonticonpicker.grey.min.css' ) );
		}

		//imagepicker
		wp_enqueue_style( 'rella-imagepicker-css', rella()->load_assets( 'vendors/image-picker/image-picker.css' ) );
		wp_enqueue_style( 'jquery-confirm-css', rella()->load_assets( 'css/jquery-confirm.min.css' ) );
		wp_enqueue_script( 'rella-modernizr', rella()->load_assets( 'js/modernizr-custom.js' ), array( 'jquery' ), false, false );

		if( 'nav-menus.php' == $pagenow || 'widgets.php' == $pagenow ) {
			wp_enqueue_script( 'rella-icon-picker', rella()->load_assets( 'vendors/iconpicker/jquery.fonticonpicker.min.js' ), array( 'jquery' ), false, true );
			wp_enqueue_script( 'rella-custom-icon-upload', rella()->load_assets( 'js/rella-custom-icon-upload.js' ), array( 'jquery' ), false, true );
			wp_localize_script(
				'rella-custom-icon-upload', 'rellaMenuCustomIcon', array(
					'l10n'     => array(
						'uploaderTitle'      => esc_html__( 'Choose an image/svg icon', 'boo' ),
						'uploaderButtonText' => esc_html__( 'Select', 'boo' ),
					),
					'settings' => array(
						'nonce' => wp_create_nonce( 'update-menu-item' ),
					),
				)
			);
			wp_enqueue_media();
		}
		
		wp_enqueue_script( 'intersection-observer', get_template_directory_uri() . '/assets/vendors/intersection-observer.js', array( 'jquery' ), false, true );

		wp_enqueue_script( 'rella-image-picker', rella()->load_assets( 'vendors/image-picker/image-picker.min.js' ), array( 'jquery' ), false, true );
		wp_enqueue_script( 'jquery-confirm', rella()->load_assets( 'js/jquery-confirm.min.js' ), array( 'jquery' ), false, true );
		wp_enqueue_script( 'rella-admin', rella()->load_assets( 'js/rella-admin.js' ), array( 'jquery', 'intersection-observer', 'underscore', 'rella-image-picker' ), false, true );
		wp_localize_script( 'rella-admin', 'rella_admin_messages', array(
			'reset_title'     => wp_kses_post( __( '<span class="dashicons dashicons-info"></span> Reset', 'boo' ) ),
			'reset_message'   => esc_html__( 'Remove posts, pages, media and any other content on your current site, We strongly recommend to reset before importing ( even if this is a fresh site ) to avoid any overlap or conflict with your current content.<br/><strong>Note:</strong> Don\'t use the reset option if you are trying to import some parts only ( For example if you are going to import theme options only then you may continue without reset )', 'boo' ),
			'reset_confirm'   => esc_html__( 'Reset Then Import', 'boo' ),
			'reset_continue'  => esc_html__( 'Keep Importing Without Resetting', 'boo' ),
			'reset_final_confirm' => esc_html__( 'I understand', 'boo' ),
			'reset_final_title'   => wp_kses_post( __( '<span class="dashicons dashicons-warning"></span> Warning', 'boo' ) ),
			'reset_final_message' => esc_html__( 'Since you selected to reset before importing please be aware this action cannot be reversed ( Any removed content cannot be restored )', 'boo' )
		) );

		// Icons
		$uri = get_template_directory_uri() . '/assets/vendors/' ;
		wp_register_style('rella-icons', $uri . 'rella-font-icon/css/rella-font-icon.css' );

    }

	public function vc_frontend_editor_js() {

		wp_enqueue_style( 'flickity', get_template_directory_uri() . '/assets/vendors/flickity/flickity.min.css' );
		wp_enqueue_script( 'flickity', get_template_directory_uri() . '/assets/vendors/flickity/flickity.pkgd.min.js' );
		wp_enqueue_script( 'theme-js', get_template_directory_uri() . '/assets/js/theme.min.js' );

	}

	public function vc_iconpicker_editor_jscss() {

		$font_icons = rella_helper()->get_theme_option( 'font-icons' );
		if( !empty( $font_icons ) ) {
			foreach( $font_icons as $handle ) {
				wp_enqueue_style($handle);
			}
		}
	}
	
	public function admin_redirects() {

		global $pagenow;

		if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
			wp_redirect( admin_url( 'admin.php?page=rella' ) );
			exit;
		}
	}

	/**
	 * [rella_toolbar description]
	 * @method rella_toolbar
	 * @return [type]          [description]
	 */
	public function rella_toolbar( $wp_admin_bar ) {
		
		if ( !current_user_can( 'edit_theme_options' ) ) {
		    return;
		}

		//Add parent shortcut link
		$args = array(
			'id'    => 'rella',
			'title' => 'Rella',
			'href'  => admin_url( 'admin.php?page=rella' ),
			'meta'  => array(
				'class' => 'rella-toolbar-page',
				'title' => 'Rella Options',
			)
		);
		$wp_admin_bar->add_node( $args );
		
		//Add import-demo shortcut link
		$args = array(
			'id' => 'rella-dashboard',
			'title' => 'Dashboard',
			'href' => admin_url( 'admin.php?page=rella' ),
			'parent' => 'rella',
			'meta'  => array(
				'class' => 'rella-dashboard',
				'title' => 'Rella Dashboard',
			),
		);
		$wp_admin_bar->add_node( $args );
		
		//Add theme-options shortcut link
		if( class_exists( 'ReduxFramework' ) ) {
			$args = array(
				'id' => 'rella-theme-options',
				'title' => 'Theme Options',
				'href' => admin_url( 'admin.php?page=rella-theme-options' ),
				'parent' => 'rella',
				'meta'  => array(
					'class' => 'rella-theme-options',
					'title' => 'Rella Theme Options',
				),
			);
			$wp_admin_bar->add_node( $args );
		}

		//Add import-demo shortcut link
		$args = array(
			'id' => 'rella-import-demo',
			'title' => 'Import Demos',
			'href' => admin_url( 'admin.php?page=rella-import-demos' ),
			'parent' => 'rella',
			'meta'  => array(
				'class' => 'rella-import-demo',
				'title' => 'Rella Import Demo',
			),
		);
		$wp_admin_bar->add_node( $args );


		//Add envato-market shortcut link
		if( class_exists( 'Envato_Market' ) ) {
			$args = array(
				'id' => 'rella-envato-market',
				'title' => 'Envato Market',
				'href' => admin_url( 'admin.php?page=envato-market' ),
				'parent' => 'rella',
				'meta'  => array(
					'class' => 'rella-envato-market',
					'title' => 'Envato Market',
				),
			);
			$wp_admin_bar->add_node( $args );
		}
	}

	/**
	 * [fix_parent_menu description]
	 * @method fix_parent_menu
	 * @return [type]          [description]
	 */
	public function fix_parent_menu() {

        if ( !current_user_can( 'edit_theme_options' ) ) {
            return;
        }
		
		global $submenu;

		$submenu['rella'][0][0] = esc_html__( 'Dashboard', 'boo' );

		remove_submenu_page( 'themes.php', 'tgmpa-install-plugins' );
		remove_submenu_page( 'tools.php', 'redux-about' );
	}

	/**
	 * [save_plugins description]
	 * @method save_plugins
	 * @return [type]       [description]
	 */
	public function save_plugins() {

        if ( !current_user_can( 'edit_theme_options' ) ) {
            return;
        }

		// Deactivate Plugin
        if ( isset( $_GET['rella-deactivate'] ) && 'deactivate-plugin' == $_GET['rella-deactivate'] ) {

			check_admin_referer( 'rella-deactivate', 'rella-deactivate-nonce' );

			$plugins = TGM_Plugin_Activation::$instance->plugins;

			foreach( $plugins as $plugin ) {
				if ( $plugin['slug'] == $_GET['plugin'] ) {

					deactivate_plugins( $plugin['file_path'] );

                    wp_redirect( admin_url( 'admin.php?page=' . $_GET['page'] ) );
					exit;
				}
			}
		}

		// Activate plugin
		if ( isset( $_GET['rella-activate'] ) && 'activate-plugin' == $_GET['rella-activate'] ) {

			check_admin_referer( 'rella-activate', 'rella-activate-nonce' );

			$plugins = TGM_Plugin_Activation::$instance->plugins;

			foreach( $plugins as $plugin ) {
				if ( $plugin['slug'] == $_GET['plugin'] ) {

					activate_plugin( $plugin['file_path'] );

					wp_redirect( admin_url( 'admin.php?page=' . $_GET['page'] ) );
					exit;
				}
			}
		}
    }
}
new Rella_Admin;
