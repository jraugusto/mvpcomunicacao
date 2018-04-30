<?php
/**
 * The Asset Manager
 * Enqueue scripts and styles for the frontend
 */

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Rella_Theme_Assets extends Rella_Base {

    /**
     * Hold data for wa_theme for frontend
     * @var array
     */
    private static $theme_json = array();

	/**
	 * [__construct description]
	 * @method __construct
	 */
    public function __construct() {

        // Frontend
        $this->add_action( 'wp_enqueue_scripts', 'dequeue', 2 );
        $this->add_action( 'wp_enqueue_scripts', 'register' );
        $this->add_action( 'wp_enqueue_scripts', 'enqueue' );
        $this->add_action( 'wp_enqueue_scripts', 'woo_register' );
		//$this->add_action( 'wp_enqueue_scripts', 'woocommerce' );
        $this->add_action( 'wp_footer', 'script_data' );

        self::add_config( 'uris', array(
            'ajax'    => admin_url('admin-ajax.php', 'relative')
        ));
    }

    /**
     * Unregister Scripts and Styles
     * @method dequeue
     * @return [type]  [description]
     */
    public function dequeue() {

    }

    /**
     * Register Scripts and Styles
     * @method register
     * @return [type]   [description]
     */
    public function register() {

        // Styles --------------------------------------------------------------------------------

		// Icons
		$this->style('rella-icons', $this->get_vendor_uri('rella-font-icon/css/rella-font-icon.min.css'));
		$this->style('font-awesome', $this->get_vendor_uri('font-awesome/css/font-awesome.min.css'));

		// Vendors
		$this->style('bootstrap', $this->get_vendor_uri('bootstrap/css/bootstrap.min.css'));
		$this->style('bootstrap-1275', $this->get_vendor_uri('bootstrap/css/bootstrap-1275.min.css'));
		$this->style('bootstrap-rtl', $this->get_vendor_uri('bootstrap-rtl/bootstrap-rtl.min.css'));

		$this->style('flickity', $this->get_vendor_uri('flickity/flickity.min.css'));
		$this->style('progressively', $this->get_vendor_uri('progressively/progressively.min.css'));
		$this->style('magnific-popup', $this->get_vendor_uri('magnific-popup/magnific-popup.css'));
		
		//FullPage
		$this->style('jquery-fullpage', $this->get_vendor_uri('fullpage/dist/jquery.fullpage.min.css'));

		$this->style('jquery-ui', $this->get_vendor_uri('jquery-ui/jquery-ui.min.css'));

        $this->style('base', get_template_directory_uri() . '/style.css');
		$this->style('theme', $this->get_css_uri('theme.min'));
		$this->style('theme-blog', $this->get_css_uri('theme-blog.min'));
        $this->style('theme-animate', $this->get_css_uri('theme-animate'));
		$this->style('theme-portfolio', $this->get_css_uri('theme-portfolio.min'));
		//$this->style('theme-elements', $this->get_css_uri('theme-elements.min'));

		//Register shortcodes css files
		$this->style( 'rella-sc-accordion', $this->get_elements_uri( 'accordion/accordion.min' ) );
		$this->style( 'rella-sc-banner', $this->get_elements_uri( 'banner/banner.min' ) );
		$this->style( 'rella-sc-button' , $this->get_elements_uri( 'button/button.min' ) );
		$this->style( 'rella-sc-carousel' , $this->get_elements_uri( 'carousel/carousel.min' ) );
		$this->style( 'rella-sc-client' , $this->get_elements_uri( 'client/client.min' ) );
		$this->style( 'rella-sc-contact-form' , $this->get_elements_uri( 'contact-form/contact-form.min' ) );
		$this->style( 'rella-sc-content-box' , $this->get_elements_uri( 'content-box/content-box.min' ) );
		$this->style( 'rella-sc-countdown' , $this->get_elements_uri( 'countdown/countdown.min' ) );
		$this->style( 'rella-sc-counter-box' , $this->get_elements_uri( 'counter-box/counter-box.min' ) );
		$this->style( 'rella-sc-custom-menu' , $this->get_elements_uri( 'custom-menu/custom-menu.min' ) );
		$this->style( 'rella-sc-featured-box' , $this->get_elements_uri( 'featured-box/featured-box.min' ) );
		$this->style( 'rella-sc-flipbox' , $this->get_elements_uri( 'flipbox/flipbox.min' ) );
		$this->style( 'rella-sc-gallery' , $this->get_elements_uri( 'gallery/gallery.min' ) );
		$this->style( 'rella-sc-history' , $this->get_elements_uri( 'history/history.min' ) );
		$this->style( 'rella-sc-icon-box' , $this->get_elements_uri( 'icon-box/icon-box.min' ) );
		$this->style( 'rella-sc-image-comparison' , $this->get_elements_uri( 'image-comparison/image-comparison.min' ) );
		$this->style( 'rella-sc-img-map' , $this->get_elements_uri( 'img-map/img-map.min' ) );
		$this->style( 'rella-sc-latest-posts' , $this->get_elements_uri( 'latest-posts/latest-posts.min' ) );
		$this->style( 'rella-sc-lettering' , $this->get_elements_uri( 'lettering/lettering.min' ) );
		$this->style( 'rella-sc-lightbox' , $this->get_elements_uri( 'lightbox/lightbox.min' ) );
		$this->style( 'rella-sc-line-guide' , $this->get_elements_uri( 'line-guide/line-guide.min' ) );
		$this->style( 'rella-sc-map' , $this->get_elements_uri( 'map/map.min' ) );
		$this->style( 'rella-sc-portfolio' , $this->get_elements_uri( 'portfolio/portfolio.min' ) );

		//TO DO, add dependency to wp-medialelement
		$this->style( 'rella-sc-media' , $this->get_elements_uri( 'media/media.min' ) );

		$this->style( 'rella-sc-misc' , $this->get_elements_uri( 'misc/misc.min' ) );
		$this->style( 'rella-sc-modal' , $this->get_elements_uri( 'modal/modal.min' ) );
		$this->style( 'rella-sc-pricing-table' , $this->get_elements_uri( 'pricing-table/pricing-table.min' ) );
		$this->style( 'rella-sc-progressbar' , $this->get_elements_uri( 'progressbar/progressbar.min' ) );
		$this->style( 'rella-sc-section-title' , $this->get_elements_uri( 'section-title/section-title.min' ) );
		$this->style( 'rella-sc-shop-banner' , $this->get_elements_uri( 'shop-banner/shop-banner.min' ) );
		$this->style( 'rella-sc-social-icon' , $this->get_elements_uri( 'social-icon/social-icon.min' ) );
		//$this->style( 'rella-sc-step' , $this->get_elements_uri( 'step/step.min' ) );
		$this->style( 'rella-sc-subscribe-form' , $this->get_elements_uri( 'subscribe-form/subscribe-form.min' ) );
		$this->style( 'rella-sc-tabs' , $this->get_elements_uri( 'tabs/tabs.min' ) );
		$this->style( 'rella-sc-team-member' , $this->get_elements_uri( 'team-member/team-member.min' ) );
		$this->style( 'rella-sc-testimonial' , $this->get_elements_uri( 'testimonial/testimonial.min' ) );
		$this->style( 'rella-sc-testimonial-slider' , $this->get_elements_uri( 'testimonial/testimonial-slider.min' ) );
		$this->style( 'rella-sc-typed' , $this->get_elements_uri( 'typed/typed.min' ) );

		//RTL Css Files
		$this->style('theme-rtl', $this->get_css_uri('theme-rtl.min'));
		$this->style('theme-blog-rtl', $this->get_css_uri('theme-blog-rtl.min'));
		$this->style('theme-portfolio-rtl', $this->get_css_uri('theme-portfolio-rtl.min'));
		$this->style('theme-elements-rtl', $this->get_css_uri('theme-elements-rtl.min'));

		$this->style('theme-bbpress', $this->get_css_uri('theme-bbpress'));
        $this->style('custom', $this->get_css_uri('custom'));

		// Register ----------------------------------------------------------

		// Essentials
		$this->script( 'modernizr', $this->get_vendor_uri( 'modernizr.min.js' ), array( 'jquery' ), false );
		$this->script( 'img-aspect-ratio', $this->get_vendor_uri( 'img-aspect-ratio.min.js' ), array( 'jquery' ), false );
		$this->script( 'bootstrap', $this->get_vendor_uri( 'bootstrap/js/bootstrap.min.js' ) );
		$this->script( 'imagesloaded', $this->get_vendor_uri( 'imagesloaded.pkgd.min.js' ), array( 'jquery' ) );

		// Plugins
		// $this->script( 'jquery-appear', $this->get_vendor_uri( 'jquery.appear.js' ), array( 'jquery' ) );
		$this->script( 'jquery-appear', $this->get_vendor_uri( 'intersection-observer.js' ), array( 'jquery' ) );

		$this->script( 'magnific-popup', $this->get_vendor_uri( 'magnific-popup/jquery.magnific-popup.min.js' ), array( 'jquery' ) );
		$this->script( 'google-maps-api', $this->google_map_api_url() );
		$this->script( 'vivus', $this->get_vendor_uri( 'vivus.min.js' ) );
		$this->script( 'typed', $this->get_vendor_uri( 'typed.min.js' ) );

		$this->script( 'countdown-plugin',$this->get_vendor_uri( 'countdown/jquery.plugin.min.js' ) );
		$this->script( 'jquery-countdown',$this->get_vendor_uri( 'countdown/jquery.countdown.min.js' ), array( 'countdown-plugin' ) );
		$this->script( 'TweenMax', $this->get_vendor_uri( 'greensock/TweenMax.min.js' ), array( 'jquery' ) );
		$this->script( 'flickity', $this->get_vendor_uri( 'flickity/flickity.pkgd.min.js' ), array( 'jquery', 'TweenMax' ) );
		$this->script( 'jquery-countTo', $this->get_vendor_uri( 'jquery.countTo.js' ) );
		$this->script( 'jquery-panr', $this->get_vendor_uri( 'jquery.panr.js' ) );
		$this->script( 'circle-progress', $this->get_vendor_uri('circle-progress.min.js'));
		$this->script( 'sticky-kit', $this->get_vendor_uri( 'jquery.sticky-kit.min.js' ) );
		$this->script( 'retina', $this->get_vendor_uri( 'retina.min.js' ) );
		
		$this->script( 'scrolloverflow', $this->get_vendor_uri( 'fullpage/vendors/scrolloverflow.min.js' ) );
		$this->script( 'fullpage', $this->get_vendor_uri( 'fullpage/dist/jquery.fullpage.min.js' ) );

		$deps = array(
			'modernizr',
			'bootstrap',
			'imagesloaded',
			'jquery-appear'
		);
		
		// Progressivelly load
		if( rella_helper()->get_option( 'enable-lazy-load' ) ) {
			$this->script( 'progressively', $this->get_vendor_uri( 'progressively/progressively.min.js' ), array( 'img-aspect-ratio' ) );
			array_push( $deps,
				'progressively'
			);
		}

		if( is_archive() ) {
			array_push( $deps,
				'jquery-appear',
				'flickity',
				'animation-gsap',
				'packery-mode',
				'ofi-polyfill',
				'jquery-matchHeight',
				'TweenMax',
				'jquery-panr'
			);
		}

	    if( class_exists( 'WooCommerce' ) ) {
		    array_push( $deps,
				'underscore',
				'jquery-ui',
				'flickity'
			);
			if( is_product() ) {
				array_push( $deps,
					'flickity',
					'magnific-popup',
					'jquery-ui'
				);
			}
			if( is_cart() || is_checkout() ) {
				array_push( $deps,
					'jquery-ui'
				);
			}
		}

		if( is_single() || is_page() ) {
			array_push( $deps,
				'animation-gsap',
				'TweenMax',
				'ofi-polyfill'
			);
		}
		
		$enable_floated_box = rella_helper()->get_option( 'post-floated-box-enable' );
		if( is_single() && 'on' === $enable_floated_box ) {
			array_push( $deps,
				'sticky-kit'
			);			
		}

		$enable_go_top = rella_helper()->get_theme_option( 'enable-go-top' );
		if( $enable_go_top ) {
			array_push( $deps,
				'TweenMax',
				'ScrollToPlugin'
			);
		}
		if( is_singular( 'rella-portfolio' ) ) {
			array_push( $deps,
				'rella-likes',
				'jquery-appear',
				'flickity',
				'jquery-migrate',
				'jquery-mobile',
				'image-comparison',
				'magnific-popup',
				'adaptive-backgrounds',
				'animation-gsap',
				'packery-mode',
				'jquery-matchHeight'
			);
		}
		if( is_post_type_archive( 'rella-portfolio' ) || is_tax( 'rella-portfolio-category' ) ) {
			array_push( $deps,
				'rella-likes',
				'flickity',
				'jquery-appear',
				'magnific-popup',
				'animation-gsap',
				'packery-mode',
				'ofi-polyfill',
				'jquery-matchHeight',
				'jquery-panr'
			);
		}

		//Fullpage enable load
		$enabled_fullpage = rella_helper()->get_option( 'enable-fullpage' );
		if( 'on' === $enabled_fullpage ) {
			array_push( $deps,
				'scrolloverflow',
				'fullpage'
			);			
		}

		// Fullscreen Nav
		$this->script( 'jquery-dlmenu', $this->get_vendor_uri( 'jquery.dlmenu.js' ) );

		// jQuery UI
		$this->script( 'jquery-ui', $this->get_vendor_uri( 'jquery-ui/jquery-ui.min.js'), array( 'jquery' ) );

		// ScrollMagic
		$this->script( 'animation-gsap', $this->get_vendor_uri( 'scrollmagic/ScrollMagic.concat.min.js' ) );

		// ScrollToPlugin
		$this->script( 'ScrollToPlugin', $this->get_vendor_uri( 'greensock/plugins/ScrollToPlugin.min.js' ) );

		array_push( $deps,
			'retina'
		);

		// Portfolio & Blog
		$this->script( 'rella-isotope', $this->get_vendor_uri( 'isotope.min.js' ) );
		$this->script( 'packery-mode', $this->get_vendor_uri( 'packery-mode.pkgd.min.js' ), array( 'rella-isotope') );
		$this->script( 'SplitText', $this->get_vendor_uri( 'greensock/utils/SplitText.min.js' ), array( 'jquery' ) );
		$this->script( 'ofi-polyfill', $this->get_vendor_uri( 'object-fit-polyfill/ofi.min.js' ) );
		$this->script( 'jquery-matchHeight', $this->get_vendor_uri( 'jquery.matchHeight-min.js' ), array( 'rella-isotope' ) );
		$this->script( 'jquery-lettering', $this->get_vendor_uri( 'jquery.lettering.js' ) );
		$this->script( 'jquery-migrate', $this->get_vendor_uri( 'jquery-migrate-3.0.0.min.js' ) );
		$this->script( 'jquery-mobile', $this->get_vendor_uri( 'jquery.mobile.custom.min.js' ) );
		$this->script( 'image-comparison', $this->get_vendor_uri( 'cd-image-comparison.js' ) );
		$this->script( 'adaptive-backgrounds', $this->get_vendor_uri( 'jquery.adaptive-backgrounds.js' ) );
		$this->script( 'headroom', $this->get_vendor_uri( 'headroom/headroom.min.js' ) );

		$sticky_sidebar  = rella()->layout->sidebars['sticky'];
		$sticky_pf_style = get_post_meta( get_the_ID(), 'portfolio-style', true );
		if( 'on' === $sticky_sidebar || 'gallery-stacked-5' == $sticky_pf_style ) {
			array_push( $deps,
				'sticky-kit'
			);

		}

		// At the End
		$this->script( 'rella-theme', $this->get_js_uri( 'theme.min' ), $deps );
		$this->script( 'custom', $this->get_js_uri( 'custom' ), array( 'rella-theme' ) );
    }

	public function defer_scripts( $tag, $handle ) {

		// Defer
		$defer_scripts = array( 'google-maps-api' );
		foreach( $defer_scripts as $defer_script ) {
			if ( $defer_script === $handle ) {
				return str_replace( ' src', ' async="async" src', $tag );
			}
		}
		return $tag;
    }

    /**
     * Enqueue Scripts and Styles
     * @method enqueue
     * @return [type]  [description]
     */
    public function enqueue() {

		$layout_width = rella_helper()->get_theme_option( 'page-layout-width' );

        // Styles-----------------------------------------------------
		$font_icons = rella_helper()->get_theme_option( 'font-icons' );
		if( !empty( $font_icons ) ) {
			foreach( $font_icons as $handle ) {
				wp_enqueue_style($handle);
			}
		}

		wp_enqueue_style( 'font-awesome' );
		wp_enqueue_style( 'bootstrap' );

		if( 'wide' === $layout_width ) {
			wp_enqueue_style( 'bootstrap-1275' );
		}

		if( is_rtl() ) {
			wp_enqueue_style( 'bootstrap-rtl' );
		}

		// Progressivelly load
		if( rella_helper()->get_option( 'enable-lazy-load' ) ) {
			wp_enqueue_style( 'progressively' );
		}
		
		//Fullpage enable load
		$enabled_fullpage = rella_helper()->get_option( 'enable-fullpage' );
		if( 'on' === $enabled_fullpage ) {
			wp_enqueue_style( 'jquery-fullpage' );
		}
		
		//wp_enqueue_style( 'wp-mediaelement' );

		//Base css files
		wp_enqueue_style( 'base' );
		wp_enqueue_style( 'theme' );

		//Temporary Css
		wp_enqueue_style( 'theme-temp' );
		

		//Enqueue blog.css only on blog pages
		if( is_single() && ! is_singular( 'rella-portfolio' ) || is_archive() || is_home() || is_search() ) {
			wp_enqueue_style( 'theme-blog' );
			wp_enqueue_style( 'rella-sc-social-icon' );
			wp_enqueue_style( 'rella-sc-media' );
		}

		//Enqueue portfolio.css only on portfolio css
		if( is_singular( 'rella-portfolio' ) || is_post_type_archive( 'rella-portfolio' ) || is_tax( 'rella-portfolio-category' ) ) {
			wp_enqueue_style( 'rella-sc-image-comparison' );
			wp_enqueue_style( 'magnific-popup' );
			wp_enqueue_style( 'flickity' );
			wp_enqueue_style( 'rella-sc-carousel' );
			wp_enqueue_style( 'theme-portfolio' );
			wp_enqueue_style( 'rella-sc-social-icon' );
		}

		if( is_404() || 'on' === rella_helper()->get_option( 'page-maintenance-enable', 'raw', '', 'options' ) ) {
			wp_enqueue_style( 'rella-sc-button' );
		}
		wp_enqueue_style( 'rella-sc-misc' );
		wp_enqueue_style( 'rella-sc-media' );
		//Action to add sc styles from infinite-addons
		do_action( 'rella_shortcodes_styles' );

		if( is_rtl() ) {
			wp_enqueue_style( 'theme-rtl' );
			wp_enqueue_style( 'theme-blog-rtl' );
			wp_enqueue_style( 'theme-portfolio-rtl' );
			wp_enqueue_style( 'theme-elements-rtl' );
		}

		wp_enqueue_style( 'custom' );
		if( !class_exists('ReduxFrameworkPlugin') ) {
			wp_enqueue_style('rella-default-fonts', $this->google_default_fonts_url(), array(), '1.0');
		}


        // Scripts -----------------------------------------------------
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		if ( class_exists('bbPress') ) {
			wp_enqueue_style( 'theme-bbpress' );
		}

		wp_enqueue_script('custom');

	}

	public function google_map_api_url() {

		$api_key = rella_helper()->get_theme_option( 'google-api-key' );
		$google_map_api = add_query_arg( 'key', $api_key, '//maps.googleapis.com/maps/api/js' );

		return $google_map_api;
	}

	public function google_default_fonts_url() {
		 $font_url = add_query_arg( 'family', urlencode( 'Karla|Poppins:400,400italic,700italic,700,600italic,600&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );
		 return $font_url;
	}

    //Register the woocommerce  shop styles
    public function woo_register() {

	    //check if woocommerce is activated and styles are loaded
	    if( class_exists( 'WooCommerce' ) ) {
			$deps = array( 'woocommerce-layout', 'woocommerce-smallscreen', 'woocommerce-general' );
			$this->style( 'theme-shop', $this->get_css_uri('theme-shop.min'), $deps );
			wp_enqueue_style( 'rella-sc-button' );
			wp_enqueue_style( 'jquery-ui' );
			wp_enqueue_style( 'theme-shop' );
			wp_enqueue_style( 'magnific-popup' );
			wp_enqueue_style( 'flickity' );
	    }
		if( class_exists( 'WooCommerce' ) && is_rtl() ) {
			$this->style( 'theme-shop-rtl', $this->get_css_uri('theme-shop-rtl.min'), $deps );
			wp_enqueue_style( 'rella-sc-button' );
			wp_enqueue_style( 'jquery-ui' );
			wp_enqueue_style( 'magnific-popup' );
			wp_enqueue_style( 'theme-shop-rtl' );
			wp_enqueue_style( 'flickity' );
		}

    }

	/**
	 * Optimize WooCommerce Scripts
	 * Remove WooCommerce Generator tag, styles, and scripts from non WooCommerce pages.
	 *
	 * @return [type]      [description]
	 */
	public function woocommerce() {

		if ( class_exists('WooCommerce') && ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {

			## Dequeue styles.
			wp_dequeue_style( 'woocommerce-layout' );
			wp_dequeue_style( 'woocommerce-smallscreen' );
			wp_dequeue_style( 'woocommerce-general' );
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );

			## Dequeue scripts.
			wp_dequeue_script( 'wc-add-payment-method' );
			wp_dequeue_script( 'wc_price_slider' );
			wp_dequeue_script( 'wc-add-to-cart-variation' );
			wp_dequeue_script( 'prettyPhoto' );
			wp_dequeue_script( 'prettyPhoto-init' );

			wp_dequeue_script( 'wc-cart-fragments' );
			wp_dequeue_script( 'woocommerce' );
			wp_dequeue_script( 'wc-add-to-cart' );
			wp_dequeue_script( 'wc-checkout' );
			wp_dequeue_script( 'wc-cart' );
			wp_dequeue_script( 'wc-single-product' );
		}
	}

    /**
     * Localize Data Object
     * @method script_data
     * @return [type]      [description]
     */
    public function script_data() {

        wp_localize_script( 'rella-theme', 'rellaTheme', self::$theme_json );
    }

    // Register Helpers ----------------------------------------------------------
    public function script( $handle, $src, $deps = null, $in_footer = true, $ver = null ) {
        wp_register_script( $handle, $src, $deps, $ver, $in_footer);
    }

    public function style( $handle, $src, $deps = null, $ver = null, $media = 'all' ) {
        wp_register_style( $handle, $src, $deps, $ver, $media );
    }

    /**
     * Add items to JSON object
     * @method add_config
     * @param  [type]     $id    [description]
     * @param  string     $value [description]
     */
    public static function add_config( $id, $value = '' ) {

        if(!$id) {
            return;
        }

        if(isset(self::$theme_json[$id])) {
            if(is_array(self::$theme_json[$id])) {
                self::$theme_json[$id] = array_merge(self::$theme_json[$id],$value);
            }
            elseif(is_string(self::$theme_json[$id])) {
                self::$theme_json[$id] = self::$theme_json[$id].$value;
            }
        }
        else {
            self::$theme_json[$id] = $value;
        }
    }

    // Uri Helpers ---------------------------------------------------------------

    public function get_theme_uri($file = '') {
        return get_template_directory_uri() . '/' . $file;
    }

    public function get_child_uri($file = '') {
        return get_stylesheet_directory_uri() . '/' . $file;
    }

    public function get_css_uri($file = '') {
        return $this->get_theme_uri('assets/css/'.$file.'.css');
    }

    public function get_elements_uri( $file = '' ) {
		return $this->get_theme_uri( 'assets/css/elements/' . $file . '.css' );
    }

    public function get_js_uri($file = '') {
        return $this->get_theme_uri('assets/js/'.$file.'.js');
    }

    public function get_vendor_uri($file = '') {
        return $this->get_theme_uri('assets/vendors/'.$file);
    }
}
new Rella_Theme_Assets;
