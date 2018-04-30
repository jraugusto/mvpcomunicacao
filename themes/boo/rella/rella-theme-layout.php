<?php
/**
 * Themerella Theme Framework
 * The Rella_Theme initiate the theme engine
 */

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Rella Theme
 */
class Rella_Theme_Layout extends Rella_Base {

	public function __construct() {
		$this->add_action( 'wp', 'init' );
		$this->add_filter( 'body_class', 'body_classes' );
		$this->add_action( 'rella_before_content', 'start_row_wrapper' );
		$this->add_action( 'rella_after_content', 'end_row_wrapper' );
	}

	public function init() {

		// Get the sidebars and assign to public variable.
		$this->sidebars = $this->setup_sidebar( $this->setup_options() );
	}

	public function body_classes( $classes ) {

		if( $this->has_sidebar() ) {
			$classes[] = 'has-sidebar';

			if( 'left' === $this->sidebars['position'] ) {
				$classes[] = 'has-left-sidebar';
			}
		}

		return $classes;
	}

	public function start_row_wrapper() {

		if( $this->has_sidebar() ) {
			echo '<div class="row">';

			$content_class = '';

			if( 'right' === $this->sidebars['position'] ) {
				$content_class = 'col-md-8 contents-container';
			}
			elseif( 'left' === $this->sidebars['position'] ) {
				$content_class = 'col-md-8 contents-container col-md-offset-1';
				get_template_part( 'templates/sidebar-2' );
			}
			
			$content_class = apply_filters( 'rella_single_post_class', $content_class );

			echo '<div class="'. $content_class .'">';
		}
	}

	public function end_row_wrapper() {

		if( $this->has_sidebar() ) {

			echo '</div><!-- /content -->';

			if( 'right' === $this->sidebars['position'] ) {
				get_template_part( 'templates/sidebar-1' );
			}

			echo '</div>';
		}
	}

	public function setup_sidebar( $sidebar_options ) {

		// Post Options.
		$sidebar_1        = rella_helper()->get_option( 'rella-sidebar-one', 'raw', false );
		$sidebar_position = rella_helper()->get_option( 'rella-sidebar-position', 'raw', 'default' );
		$sidebar_sticky   = rella_helper()->get_option( 'rella-sidebar-fixed' );

		$opts_sidebar_1 = isset( $sidebar_options['sidebar_1'] ) ? $sidebar_options['sidebar_1'] : '';
		$opts_sticky = isset( $sidebar_options['sticky'] ) ? $sidebar_options['sticky'] : '';
		// Setting Default
		$sidebar_position = $sidebar_1 ? $sidebar_position : 'default';
		$sidebar_1 = $sidebar_1 ? $sidebar_1 : $opts_sidebar_1;
		$sidebar_sticky = $sidebar_sticky ? $sidebar_sticky : $opts_sticky;

		// Theme options.
		$sidebar_position_theme_option = array_key_exists( 'position', $sidebar_options ) ? strtolower( $sidebar_options['position'] ) : '';

		// Get sidebars and position from theme options if it's being forced globally.
		if ( array_key_exists( 'global', $sidebar_options ) && 'on' === $sidebar_options['global'] ) {
			$sidebar_1 = ( '' != $sidebar_options['sidebar_1'] ) ? $sidebar_options['sidebar_1'] : '';
			$sidebar_position = $sidebar_position_theme_option;
		}

		// If sidebar position is default OR no entry in database exists.
		if ( 'default' === $sidebar_position ) {
			$sidebar_position = $sidebar_position_theme_option;
		}

		$return = array( 'position' => $sidebar_position );

		if ( $sidebar_1 && 'none' !== $sidebar_1 ) {
			$return['sidebar_1'] = $sidebar_1;
		}
		
		$return['sticky'] = $sidebar_sticky;

		return $return;
	}

	public function has_sidebar( $which = '1' ) {

		if( is_array( $this->sidebars ) && isset( $this->sidebars['sidebar_'.$which] ) && ! empty( $this->sidebars['sidebar_'.$which] ) ) {
			return true;
		}

		return false;
	}

	public function has_double_sidebars() {

		if( $this->has_sidebar('1') && $this->has_sidebar('2') ) {
			return true;
		}

		return false;
	}

	public function setup_options() {

		if( is_home() ) {
			$sidebars = array(
				'global'    => true,
				'sticky'    => rella_helper()->get_theme_option( 'blog-archive-sidebar-enable-sticky' ),
				'sidebar_1' => rella_helper()->get_theme_option( 'blog-archive-sidebar-one' ),
				'position'  => rella_helper()->get_theme_option( 'blog-archive-sidebar-position' ),
			);
		}
		elseif ( class_exists( 'WooCommerce' ) && is_product() ) {
			$sidebars = array(
				'global'    => rella_helper()->get_theme_option( 'wc-enable-global' ),
				'sticky'    => rella_helper()->get_theme_option( 'wc-sidebar-enable-sticky' ),
				'sidebar_1' => rella_helper()->get_theme_option( 'wc-sidebar-one' ),
				'position'  => rella_helper()->get_theme_option( 'wc-sidebar-position' ),
			);
		}
		elseif ( class_exists( 'WooCommerce' ) && ( is_shop() || is_product_taxonomy() || is_product_category() ) ) {
			$sidebars = array(
				'global'    => true,
				'sticky'    => rella_helper()->get_theme_option( 'wc-archive-sidebar-enable-sticky' ),
				'sidebar_1' => rella_helper()->get_theme_option( 'wc-archive-sidebar-one' ),
				'position'  => rella_helper()->get_theme_option( 'wc-archive-sidebar-position' )
			);
		}
		elseif ( is_page() ) {
			$sidebars = array(
				'global'    => rella_helper()->get_theme_option( 'page-enable-global' ),
				'sticky'    => rella_helper()->get_theme_option( 'page-sidebar-enable-sticky' ),
				'sidebar_1' => rella_helper()->get_theme_option( 'page-sidebar-one' ),
				'position'  => rella_helper()->get_theme_option( 'page-sidebar-position' ),
			);
		}
		elseif ( is_single() ) {

			$sidebars = array(
				'global'    => rella_helper()->get_theme_option( 'blog-enable-global' ),
				'sticky'    => rella_helper()->get_theme_option( 'blog-sidebar-enable-sticky' ),
				'sidebar_1' => rella_helper()->get_theme_option( 'blog-sidebar-one' ),
				'position'  => rella_helper()->get_theme_option( 'blog-sidebar-position' )
			);

			if ( is_singular( 'rella-portfolio' ) ) {
				$sidebars = array(
					'global'    => rella_helper()->get_theme_option( 'portfolio-enable-global' ),
					'sticky'    => rella_helper()->get_theme_option( 'portfolio-sidebar-enable-sticky' ),
					'sidebar_1' => rella_helper()->get_theme_option( 'portfolio-sidebar-one' ),
					'position'  => rella_helper()->get_theme_option( 'portfolio-sidebar-position' ),
				);
			}
		}
		elseif ( is_archive() ) {
			$sidebars = array(
				'global'    => true,
				'sticky'    => rella_helper()->get_theme_option( 'blog-archive-sidebar-enable-sticky' ),
				'sidebar_1' => rella_helper()->get_theme_option( 'blog-archive-sidebar-one' ),
				'position'  => rella_helper()->get_theme_option( 'blog-archive-sidebar-position' ),

			);

			if ( is_post_type_archive( 'rella-portfolio' ) || is_tax( 'rella-portfolio-category' ) ) {
				$sidebars = array(
					'global'    => true,
					'sticky'    => rella_helper()->get_theme_option( 'portfolio-archive-sidebar-enable-sticky' ),
					'sidebar_1' => rella_helper()->get_theme_option( 'portfolio-archive-sidebar-one' ),
					'position'  => rella_helper()->get_theme_option( 'portfolio-archive-sidebar-position' ),
				);
			}
		}
		 elseif ( is_search() ) {
			$sidebars = array(
				'global'    => true,
				'sticky'    => rella_helper()->get_theme_option( 'seach-sidebar-enable-sticky' ),
				'sidebar_1' => rella_helper()->get_theme_option( 'search-sidebar-one' ),
				'position'  => rella_helper()->get_theme_option( 'search-sidebar-position' ),
			);
		}
		else {
			$sidebars = array(
				'global'    => rella_helper()->get_theme_option( 'page-enable-global' ),
				'sticky'    => rella_helper()->get_theme_option( 'page-sidebar-enable-sticky' ),
				'sidebar_1' => rella_helper()->get_theme_option( 'page-sidebar-one' ),
				'position'  => rella_helper()->get_theme_option( 'page-sidebar-position' ),
			);
		}

		// Remove sidebars from the certain woocommerce pages.
		if ( class_exists( 'WooCommerce' ) ) {
			if ( is_cart() || is_checkout() || is_account_page() || ( get_option( 'woocommerce_thanks_page_id' ) && is_page( get_option( 'woocommerce_thanks_page_id' ) ) ) ) {
				$sidebars = array();
			}
		}

		return $sidebars;
	}

}
return new Rella_Theme_Layout;