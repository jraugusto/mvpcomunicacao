<?php
/**
* Shortcode Portfolio Listing
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_PortfolioListing extends RA_Shortcode {

	/**
	 * [$post_type description]
	 * @var string
	 */
	private $post_type = 'rella-portfolio';

	/**
	 * [$taxonomies description]
	 * @var array
	 */
	private $taxonomies = array( 'rella-portfolio-category' );

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_portfolio_listing';
		$this->title       = esc_html__( 'Portfolio Listing', 'infinite-addons' );
		$this->description = esc_html__( 'Create portfolio listing', 'infinite-addons' );
		$this->icon        = 'vc_icon-vc-media-grid';
		$this->scripts     = array( 'rella-likes', 'flickity', 'jquery-appear', 'magnific-popup', 'animation-gsap', 'packery-mode', 'ofi-polyfill', 'jquery-matchHeight', 'StackBlur', 'jquery-panr' );
		$this->styles      = array( 'TweenMax', 'flickity', 'magnific-popup', 'theme-portfolio', 'rella-sc-image-comparison', 'rella-sc-lettering', 'rella-sc-button' );

		require_once vc_path_dir( 'CONFIG_DIR', 'grids/vc-grids-functions.php' );
		if ( 'vc_get_autocomplete_suggestion' === vc_request_param( 'action' ) || 'vc_edit_form' === vc_post_param( 'action' ) ) {
			add_filter( 'vc_autocomplete_'. $this->slug . '_include_callback', array( $this, 'include_field_search' ) ); // Get suggestion(find). Must return an array
			add_filter( 'vc_autocomplete_'. $this->slug . '_include_render', 'vc_include_field_render' ); // Render exact product. Must return an array (label,value)

			// Narrow data taxonomies
			add_filter( 'vc_autocomplete_'. $this->slug . '_taxonomies_callback', array( $this,'autocomplete_taxonomies_field_search' ) );
			add_filter( 'vc_autocomplete_'. $this->slug . '_taxonomies_render', array($this, 'render_autocomplete_field') );

			// Filter Cats
			add_filter( 'vc_autocomplete_'. $this->slug . '_filter_cats_callback', array( $this,'autocomplete_taxonomies_field_search' ) );
			add_filter( 'vc_autocomplete_'. $this->slug . '_filter_cats_render', array($this, 'render_autocomplete_field') );

			// Narrow data taxonomies for exclude_filter
			add_filter( 'vc_autocomplete_'. $this->slug . '_exclude_callback', array( $this, 'exclude_field_search' ) ); // Get suggestion(find). Must return an array
			add_filter( 'vc_autocomplete_'. $this->slug . '_exclude_render', 'vc_exclude_field_render' ); // Render exact product. Must return an array (label,value)
		}

		parent::__construct();
	}

	protected function get_post_type_list() {

		$postTypesList[] = array(
			$this->post_type,
			esc_html__( 'Posts', 'infinite-addons' ),
		);
		$postTypesList[] = array(
			'custom',
			esc_html__( 'Custom query', 'infinite-addons' ),
		);
		$postTypesList[] = array(
			'ids',
			esc_html__( 'List of IDs', 'infinite-addons' ),
		);

		return $postTypesList;
	}

	public function get_params() {

		$url = rella_addons()->plugin_uri() . '/assets/img/sc-preview/portfolio-listing/';

		$general = array(
			array(
				'type'       => 'select_preview',
				'param_name' => 'style',
				'heading'    => esc_html__( 'Style', 'infinite-addons' ),
				'value'      => array(

					array(
						'value' => 'classic',
						'label' => esc_html__( 'Classic', 'infinite-addons' ),
						'image' => $url . 'classic.png'
					),

					array(
						'label' => esc_html__( 'Grid', 'infinite-addons' ),
						'value' => 'grid',
						'image' => $url . 'grid.png'
					),

					array(
						'label' => esc_html__( 'Masonry', 'infinite-addons' ),
						'value' => 'masonry',
						'image' => $url . 'masonry.png'
					),

					array(
						'label' => esc_html__( 'Metro', 'infinite-addons' ),
						'value' => 'metro',
						'image' => $url . 'metro.png'
					),

					array(
						'label' => esc_html__( 'Packery', 'infinite-addons' ),
						'value' => 'packery',
						'image' => $url . 'packery.png'
					),

					array(
						'label' => esc_html__( 'Slider', 'infinite-addons' ),
						'value' => 'slider',
						'image' => $url . 'slider.png'
					)
				),
				'description' => esc_html__( 'Select content type for your grid.', 'infinite-addons' ),
				'admin_label' => true,
				'save_always' => true,
				'edit_field_class' => 'vc_col-sm-12',
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'item_style',
				'heading'    => esc_html__( 'Item Styles', 'infinite-addons' ),
				'value'      => array(
					// List
					esc_html__( 'Plain', 'infinite-addons' )      => 'list',
					esc_html__( 'List Shadow', 'infinite-addons' )  => 'shadow',
					esc_html__( 'List Outline', 'infinite-addons' ) => 'outline',

					// Hover
					esc_html__( 'Hover Blur', 'infinite-addons' )         => 'hover-blur',
					esc_html__( 'Hover Bottom', 'infinite-addons' )       => 'hover-bottom',
					esc_html__( 'Hover Classic', 'infinite-addons' )      => 'hover-dark',
					esc_html__( 'Hover Curtain', 'infinite-addons' )      => 'hover-color',
					esc_html__( 'Hover Frame Border', 'infinite-addons' ) => 'hover-frame',
					esc_html__( 'Hover Frame', 'infinite-addons' )        => 'hover-light',
					esc_html__( 'Hover Icons', 'infinite-addons' )        => 'hover-only-icons',
					esc_html__( 'Hover Left', 'infinite-addons' )         => 'hover-bottom-left',
					esc_html__( 'Hover Masked', 'infinite-addons' )       => 'hover-gradient',
					esc_html__( 'Hover Outline', 'infinite-addons' )      => 'hover-rectangular',
					esc_html__( 'Hover Plus', 'infinite-addons' )         => 'hover-side',
					esc_html__( 'Hover Rounded', 'infinite-addons' )      => 'hover-elegant',
					esc_html__( 'Hover Shadow', 'infinite-addons' )       => 'hover-bottom-shadow',
					
					//New
					esc_html__( 'Hover Top Left', 'infinite-addons' ) => 'hover-top-left',
					
					// Caption
					esc_html__( 'Fixed Caption', 'infinite-addons' )     => 'caption-fixed',
				),
				'admin_label' => true,
				'save_always' => true,
				'dependency'  => array(
					'element' => 'style',
					'value_not_equal_to' => array(
						'slider',
					),
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'content_alignment',
				'heading'    => esc_html__( 'Content Alignment', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Default', 'infinite-addons' )       => 'default',
					esc_html__( 'Left', 'infinite-addons' )          => 'left',
					esc_html__( 'Center', 'infinite-addons' )        => 'center',
					esc_html__( 'Right', 'infinite-addons' )         => 'right',
					esc_html__( 'Inside Left', 'infinite-addons' )   => 'inside-left',
					esc_html__( 'Inside Center', 'infinite-addons' ) => 'inside-center',
					esc_html__( 'Inside Right', 'infinite-addons' )  => 'inside-right',
				),
				'save_always' => true,
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 'classic' )
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'text_alignment',
				'heading'    => esc_html__( 'Text Alignment', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Left', 'infinite-addons' )          => 'left',
					esc_html__( 'Center', 'infinite-addons' )        => 'center',
					esc_html__( 'Right', 'infinite-addons' )         => 'right',
				),
				'save_always' => true,
				'dependency'  => array(
					'element' => 'item_style',
					'value'   => array( 'list', 'shadow', 'outline' )
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'grid_columns',
				'heading'    => esc_html__( 'Columns', 'infinite-addons' ),
				'value'      => array(
					'1 Columns' => '1',
					'2 Columns' => '2',
					'3 Columns' => '3',
					'4 Columns' => '4',
					'6 Columns' => '6'
				),
				'dependency' => array(
					'element' => 'style',
					'value'   => array( 'grid', 'masonry')
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'columns_gap',
				'heading'     => esc_html__( 'Columns gap', 'infinite-addons' ),
				'description' => esc_html__( 'Select gap between columns in row.', 'infinite-addons' ),
				'value'       => array(
					'0px'  => '0',
					'1px'  => '1',
					'2px'  => '2',
					'3px'  => '3',
					'4px'  => '4',
					'5px'  => '5',
					'10px' => '10',
					'15px' => '15',
					'20px' => '20',
					'25px' => '25',
					'30px' => '30',
					'35px' => '35'
				),
				'dependency' => array(
					'element' => 'style',
					'value'   => array( 'grid', 'masonry', 'metro', 'packery' )
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'post_type',
				'heading'     => esc_html__( 'Data source', 'infinite-addons' ),
				'description' => esc_html__( 'Select content type for your grid.', 'infinite-addons' ),
				'value'       => $this->get_post_type_list(),
				'save_always' => true,
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'posts_per_page',
				'heading'     => esc_html__( 'Total items', 'infinite-addons' ),
				'description' => esc_html__( 'Set max limit or enter -1 to display all (limited to 1000).', 'infinite-addons' ),
				'value'       => 10,
				// default value
				'dependency'  => array(
					'element' => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom',
					),
				),
				'param_holder_class' => 'vc_not-for-custom',
				'edit_field_class'   => 'vc_col-sm-6'
			),
			
			array(
				'type'        => 'textfield',
				'param_name'  => 'post_excerpt',
				'heading'     => esc_html__( 'Post Excerpt limit', 'infinite-addons' ),
				'description' => esc_html__( 'Set post excerpt limit', 'infinite-addons' ),
				'value'       => 10,
				// default value
				'dependency'  => array(
					'element' => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom',
					),
				),
				'param_holder_class' => 'vc_not-for-custom',
				'edit_field_class'   => 'vc_col-sm-6'
			),

			array(
				'type'        => 'autocomplete',
				'param_name'  => 'include',
				'heading'     => esc_html__( 'Include only', 'infinite-addons' ),
				'description' => esc_html__( 'Add posts, pages, etc. by title.', 'infinite-addons' ),
				'settings'    => array(
					'multiple' => true,
					'sortable' => true,
					'groups'   => true,
					'no_hide'  => true, // In UI after select doesn't hide an select list
				),
				'dependency' => array(
					'element' => 'post_type',
					'value'   => array( 'ids' )
				)
			),

			// Custom query tab
			array(
				'type'        => 'textarea_safe',
				'param_name'  => 'custom_query',
				'heading'     => esc_html__( 'Custom query', 'infinite-addons' ),
				'description' => __( 'Build custom query according to <a href="http://codex.wordpress.org/Function_Reference/query_posts">WordPress Codex</a>.', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'post_type',
					'value'   => array( 'custom' )
				)
			),

			array(
				'type'        => 'autocomplete',
				'param_name'  => 'taxonomies',
				'heading'     => esc_html__( 'Narrow data source', 'infinite-addons' ),
				'description' => esc_html__( 'Enter categories, tags or custom taxonomies.', 'infinite-addons' ),
				'settings'    => array(
					'multiple'       => true,
					'min_length'     => 1,
					'groups'         => true,
					'no_hide'        => true, // In UI after select doesn't hide an select list
					'unique_values'  => true,
					'display_inline' => true,
					'delay'          => 500,
					'auto_focus'     => true,
				),
				'dependency' => array(
					'element' => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom'
					)
				),
				'param_holder_class' => 'vc_not-for-custom',
			),

			array(
				'type'        => 'subheading',
				'param_name'  => 'show_hide_parts',
				'heading'     => esc_html__( 'Show / Hide Parts', 'infinite-addons' )
			),

			array(
				'type'        => 'rella_checkbox',
				'param_name'  => 'show_title',
				'value'       =>  array( esc_html__( 'Title', 'infinite-addons' ) => 'true' ),
				'std'         => 'true',
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'        => 'rella_checkbox',
				'param_name'  => 'show_summary',
				'value'       =>  array( esc_html__( 'Description', 'infinite-addons' ) => 'true' ),
				'std'         => 'true',
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'        => 'rella_checkbox',
				'param_name'  => 'show_category',
				'value'       =>  array( esc_html__( 'Categories', 'infinite-addons' ) => 'true' ),
				'std'         => 'true',
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'        => 'rella_checkbox',
				'param_name'  => 'show_one_category',
				'value'       => array( esc_html__( 'One Category', 'infinite-addons' ) => 'true' ),
				'std'         => 'true',
				'dependency'  => array(
					'element' => 'show_category',
					'value'   => 'true',
				),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'        => 'rella_checkbox',
				'param_name'  => 'show_like',
				'value'       =>  array( esc_html__( 'Like', 'infinite-addons' ) => 'true' ),
				'std'         => 'true',
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'        => 'rella_checkbox',
				'param_name'  => 'show_client',
				'value'       =>  array( esc_html__( 'Client', 'infinite-addons' ) => 'true' ),
				'std'         => 'true',
				'dependency'  => array(
					'element' => 'item_style',
					'value_not_equal_to' => array( 'hover-bottom', 'hover-only-icons', 'hover-bottom-shadow', 'hover-elegant' )
				),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'        => 'rella_checkbox',
				'param_name'  => 'show_date',
				'value'       =>  array( esc_html__( 'Date', 'infinite-addons' ) => 'true' ),
				'std'         => 'true',
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'        => 'rella_checkbox',
				'param_name'  => 'show_link',
				'value'       =>  array( esc_html__( 'Detail Button', 'infinite-addons' ) => 'true' ),
				'dependency'  => array(
					'element' => 'style',
					'value_not_equal_to' => array( 'slider', )
				),
				'std'         => 'true',
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'        => 'rella_checkbox',
				'param_name'  => 'show_ext_link',
				'value'       =>  array( esc_html__( 'External Link Button', 'infinite-addons' ) => 'true' ),
				'std'         => 'true',
				'dependency'  => array(
					'element' => 'item_style',
					'value_not_equal_to' => array( 'list', 'shadow', 'outline', 'hover-light', 'hover-side' )
				),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'        => 'rella_checkbox',
				'param_name'  => 'show_share',
				'value'       =>  array( esc_html__( 'Share Button', 'infinite-addons' ) => 'true' ),
				'std'         => 'true',
				'dependency'  => array(
					'element' => 'item_style',
					'value_not_equal_to' => array( 'hover-light', 'hover-side' )
				),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'        => 'rella_checkbox',
				'param_name'  => 'show_lightbox',
				'value'       =>  array( esc_html__( 'Lightbox Button', 'infinite-addons' ) => 'true' ),
				'std'         => '',
				'dependency'  => array(
					'element' => 'item_style',
					'value_not_equal_to' => array( 'hover-light', 'hover-side', 'list', 'shadow', 'outline' )
				),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'        => 'rella_checkbox',
				'param_name'  => 'enable_panr',
				'value'       =>  array( esc_html__( 'Zoom Effect', 'infinite-addons' ) => 'true' ),
				'std'         => '',
				'dependency'  => array(
					'element' => 'item_style',
					'value_not_equal_to' => array( 'list', 'shadow', 'outline', 'caption-fixed' )
				),
				'edit_field_class' => 'vc_col-sm-4',
			),

			//Title Typo options
			array(
				'type'        => 'subheading',
				'param_name'  => 'show_title_typo',
				'heading'     => esc_html__( 'Title Typography', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'show_title',
					'value'   => 'true'
				),
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'title_size',
				'heading'     => esc_html__( 'Title Size', 'infinite-addons' ),
				'description' => esc_html__( 'Add size in pixels/em e.g 15px', 'infinite-addons' ),

				'edit_field_class' => 'vc_col-sm-4'
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'title_weight',
				'heading'     => esc_html__( 'Title Weight', 'infinite-addons' ),
				'description' => esc_html__( 'Add title weight', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-4'
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'title_color',
				'heading'     => esc_html__( 'Title Color', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-4'
			),

			//Misc
			array(
				'type'        => 'subheading',
				'param_name'  => 'show_misc',
				'heading'     => esc_html__( 'Misc.', 'infinite-addons' )
			),
			
			array(
				'type'        => 'dropdown',
				'param_name'  => 'enable_ext',
				'heading'     => esc_html__( 'Enable External links', 'infinite-addons' ),
				'description' => esc_html__( 'External link will be apllied to the portfolio item "Detail Button"', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'show_link',
					'value'   => 'true'
				),
				'value'       => array(
					esc_html__( 'No', 'infinite-addons' )  => '',
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'disable_postformat',
				'heading'     => esc_html__( 'Disable Post Formats?', 'infinite-addons' ),
				'description' => esc_html__( 'If yes will show only featured images of the post, will ignore post formats', 'infinite-addons' ),
				'value'       => array(
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes',
					esc_html__( 'No', 'infinite-addons' )  => '',
				),
				'dependency' => array(
					'element' => 'item_style',
					'value' => array(
						'list',
						'shadow',
						'outline',
						'caption-fixed'
					)
				),
				'std'        => 'yes',
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'enable_stagger',
				'heading'     => esc_html__( 'Enable stagger Effect?', 'infinite-addons' ),
				'description' => '',
				'value'       => array(
					esc_html__( 'No', 'infinite-addons' )  => '',
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'show_filter',
				'heading'     => esc_html__( 'Enable filter?', 'infinite-addons' ),
				'description' => esc_html__( 'Will enable portfolio categories filter', 'infinite-addons' ),
				'value'       => array(
					esc_html__( 'No', 'infinite-addons' )  => '',
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'enable_gallery',
				'heading'     => esc_html__( 'Enable Gallery?', 'infinite-addons' ),
				'description' => esc_html__( 'Lightbox gallery of the featured images', 'infinite-addons' ),
				'value'       => array(
					esc_html__( 'No', 'infinite-addons' )  => '',
					esc_html__( 'Yes', 'infinite-addons' ) => 'listing-lightbox-gallery',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'enable_parallax',
				'heading'     => esc_html__( 'Enable parallax?', 'infinite-addons' ),
				'description' => esc_html__( 'Parallax for images', 'infinite-addons' ),
				'value'       => array(
					esc_html__( 'Yes', 'infinite-addons' ) => '',
					esc_html__( 'No', 'infinite-addons' )  => 'no'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'enable_rise',
				'heading'     => esc_html__( 'Enable Hover Effect?', 'infinite-addons' ),
				'description' => esc_html__( '"Rise on hover" effect', 'infinite-addons' ),
				'value'       => array(
					esc_html__( 'No', 'infinite-addons' )  => 'no',
					esc_html__( 'Yes', 'infinite-addons' ) => 'rise-on-hover',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'enable_loader',
				'heading'     => esc_html__( 'Enable loader?', 'infinite-addons' ),
				'description' => esc_html__( 'Loader while item loading.', 'infinite-addons' ),
				'value'       => array(
					esc_html__( 'No', 'infinite-addons' )  => 'no',
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type' => 'dropdown',
				'param_name' => 'pagination',
				'heading' => esc_html__( 'Pagination Style', 'infinite-addons' ),
				'description' => esc_html__( 'Select pagination style.', 'infinite-addons' ),
				'value' => array(
					esc_html__( 'None', 'infinite-addons' ) => 'none',
					esc_html__( 'Pagination', 'infinite-addons' ) => 'pagination',
					esc_html__( 'Ajax 1', 'infinite-addons' ) => 'ajax1',
					esc_html__( 'Ajax 2', 'infinite-addons' ) => 'ajax2',
					esc_html__( 'Ajax 3', 'infinite-addons' ) => 'ajax3',
					esc_html__( 'Ajax 4', 'infinite-addons' ) => 'ajax4'
				),
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'ajax_text',
				'heading'     => esc_html__( 'Text on ajax button', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'pagination',
					'value'   => array( 'ajax1', 'ajax2', 'ajax3', 'ajax4' )
				),
			),

			vc_map_add_css_animation( false )
		);

		$filter = array(
			
			
			array(
				'type'       => 'dropdown',
				'param_name' => 'filter_style',
				'heading'    => esc_html__( 'Filter Style', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Default', 'infinite-addons' ) => 'default',
					esc_html__( 'Classic', 'infinite-addons' ) => 'classic',
				),
				'save_always' => true,
				'std' => 'default'
			),

			array(
				'type'        => 'autocomplete',
				'param_name'  => 'filter_cats',
				'heading'     => esc_html__( 'Categories', 'infinite-addons' ),
				'description' => esc_html__( 'Enter categories to display in filter bar.', 'infinite-addons' ),
				'settings'    => array(
					'multiple'      => true,
					'min_length'    => 1,
					'groups'        => true,
					'sortable'      => true,
					'no_hide'       => true, // In UI after select doesn't hide an select list
					'unique_values' => true,
					'delay'         => 500,
					'auto_focus'    => true,
				),
				'param_holder_class' => 'vc_not-for-custom',

			),

			array(
				'type'       => 'textfield',
				'param_name' => 'filter_title',
				'heading'    => esc_html__( 'Filter title', 'infinite-addons' ),
				'value'      => esc_html__( 'Filter portfolio', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'filter_lbl_all',
				'heading'     => esc_html__( 'Label "All"', 'infinite-addons' ),
				'value'       => esc_html__( 'All', 'infinite-addons' ),
				'save_always' => true,
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'show_order',
				'heading'     => esc_html__( 'Show order?', 'infinite-addons' ),
				'value'       => array(
					esc_html__( 'No', 'infinite-addons' )  => '',
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'show_orderby',
				'heading'     => esc_html__( 'Show orderby?', 'infinite-addons' ),
				'value'       => array(
					esc_html__( 'No', 'infinite-addons' )  => '',
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'filter_color',
				'heading'     => esc_html__( 'Filter color', 'infinite-addons' ),
				'value'       => array(
					esc_html__( 'Default', 'infinite-addons' )  => '',
					esc_html__( 'Light', 'infinite-addons' )    => 'masonry-filters-light'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
		);

		foreach( $filter as &$param ) {
			$param['group'] = esc_html__( 'Filter', 'infinite-addons' );
			$param['dependency'] = array(
				'element' => 'show_filter',
				'value' => array( 'yes' )
			);
		}

		$data = array(
			array(
				'type'        => 'dropdown',
				'param_name'  => 'orderby',
				'heading'     => esc_html__( 'Order by', 'infinite-addons' ),
				'description' => esc_html__( 'Select order type. If "Meta value" or "Meta value Number" is chosen then meta key is required.', 'infinite-addons' ),
				'value'       => array(
					esc_html__( 'Date', 'infinite-addons' )                  => 'date',
					esc_html__( 'Order by post ID', 'infinite-addons' )      => 'ID',
					esc_html__( 'Author', 'infinite-addons' )                => 'author',
					esc_html__( 'Title', 'infinite-addons' )                 => 'title',
					esc_html__( 'Last modified date', 'infinite-addons' )    => 'modified',
					esc_html__( 'Post/page parent ID', 'infinite-addons' )   => 'parent',
					esc_html__( 'Number of comments', 'infinite-addons' )    => 'comment_count',
					esc_html__( 'Menu order/Page Order', 'infinite-addons' ) => 'menu_order',
					esc_html__( 'Meta value', 'infinite-addons' )            => 'meta_value',
					esc_html__( 'Meta value number', 'infinite-addons' )     => 'meta_value_num',
					esc_html__( 'Random order', 'infinite-addons' )          => 'rand',
				),
				'group'       => esc_html__( 'Data Settings', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom'
					)
				),
				'param_holder_class' => 'vc_grid-data-type-not-ids',
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'order',
				'heading'     => esc_html__( 'Sort order', 'infinite-addons' ),
				'description' => esc_html__( 'Select sorting order.', 'infinite-addons' ),
				'group'       => esc_html__( 'Data Settings', 'infinite-addons' ),
				'value'       => array(
					esc_html__( 'Descending', 'infinite-addons' ) => 'DESC',
					esc_html__( 'Ascending', 'infinite-addons' )  => 'ASC',
				),
				'dependency' => array(
					'element' => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom',
					)
				),
				'param_holder_class' => 'vc_grid-data-type-not-ids',
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'meta_key',
				'heading'     => esc_html__( 'Meta key', 'infinite-addons' ),
				'description' => esc_html__( 'Input meta key for grid ordering.', 'infinite-addons' ),
				'group'       => esc_html__( 'Data Settings', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'orderby',
					'value'   => array(
						'meta_value',
						'meta_value_num',
					)
				),
				'param_holder_class' => 'vc_grid-data-type-not-ids',
			),

			array(
				'type'        => 'autocomplete',
				'param_name'  => 'exclude',
				'heading'     => esc_html__( 'Exclude', 'infinite-addons' ),
				'description' => esc_html__( 'Exclude posts, pages, etc. by title.', 'infinite-addons' ),
				'group'       => esc_html__( 'Data Settings', 'infinite-addons' ),
				'settings'    => array(
					'multiple' => true,
					'no_hide'  => true, // In UI after select doesn't hide an select list
				),
				'dependency'  => array(
					'element' => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom',
					),
					'callback' => 'vc_grid_exclude_dependency_callback'
				),
				'param_holder_class' => 'vc_grid-data-type-not-ids',
			)

		);

		$design = array(

			array(
				'type'        => 'textfield',
				'param_name'  => 'overlay_opacity',
				'heading'     => esc_html__( 'Overlay Opacity', 'infinite-addons' ),
				'description' => esc_html__( 'Add overlay opacity (0.1  -  1)', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'item_style',
					'value_not_equal_to' => array(
						'list',
						'shadow',
						'outline',
						'caption-fixed'
					)
				),
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'bg_type',
				'heading'    => esc_html__( 'Background type', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'None', 'infinite-addons' )     => '',
					esc_html__( 'Solid', 'infinite-addons' )    => 'solid',
					esc_html__( 'Gradient', 'infinite-addons' ) => 'gradient'
				),
				'dependency'  => array(
					'element' => 'style',
					'value_not_equal_to' => array(
						'slider'
					)
				),
				'edit_field_class' => 'vc_col-sm-4 vc_column-with-padding'
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'color_primary',
				'heading'    => esc_html__( 'Color', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'bg_type',
					'value'   => 'solid'
				),
				'edit_field_class' => 'vc_col-sm-8',
			),

			array(
				'type'       => 'gradient',
				'param_name' => 'gradient_primary',
				'heading'    => esc_html__( 'Gradient', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'bg_type',
					'value'   => 'gradient'
				),
				'edit_field_class' => 'vc_col-sm-8',
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'color_type',
				'heading'    => esc_html__( 'Text Color', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Dark', 'infinite-addons' )  => '',
					esc_html__( 'Light', 'infinite-addons' ) => 'text-light',
				),
				'edit_field_class' => 'vc_col-sm-4 clearfix'
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'color_loader',
				'heading'    => esc_html__( 'Loader Color', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'enable_loader',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-4 clearfix',
			),

		);

		foreach( $design as &$param ) {
			$param['group'] = esc_html__( 'Design Options', 'infinite-addons' );
		}

		$this->params = array_merge( $general, $filter, $data, $design );

		$this->add_extras();
	}

	/**
	 * [before_output description]
	 * @method before_output
	 * @param  [type]        $atts    [description]
	 * @param  [type]        $content [description]
	 * @return [type]                 [description]
	 */
	public function before_output( $atts, &$content ) {

		if( 'classic' === $atts['style'] && !empty( $atts['classic_style'] ) ) {
			$atts['item_style'] = $atts['classic_style'];
		}
		elseif( 'slider' === $atts['style'] ) {
			$atts['template'] = 'slider';
		}
		return $atts;
	}

	// https://codex.wordpress.org/Making_Custom_Queries_using_Offset_and_Pagination
	// check it
	protected function build_query() {

		extract( $this->atts );
		$settings = array();

		if( 'custom' === $post_type && ! empty( $custom_query ) ) {
			$query = html_entity_decode( vc_value_from_safe( $custom_query ), ENT_QUOTES, 'utf-8' );
			$settings = wp_parse_args( $query );
		}
		elseif( 'ids' === $post_type ) {

			if ( empty( $include ) ) {
				$include = - 1;
			}

			$incposts = wp_parse_id_list( $settings['include'] );
			$settings = array(
				'post__in'       => $incposts,
				'posts_per_page' => count( $incposts ),
				'post_type'      => 'any',
				'orderby'        => 'post__in',
			);
		}
		else {

			$orderby = !empty( $_GET['orderby'] ) ? $_GET['orderby'] : $orderby;
			$order   = !empty( $_GET['order'] ) ? $_GET['order'] : $order;

			$settings = array(
				'posts_per_page' => isset( $posts_per_page ) ? (int) $posts_per_page : 100,
				'orderby'        => $orderby,
				'order'          => $order,
				'meta_key'       => in_array( $orderby, array(
					'meta_value',
					'meta_value_num',
				) ) ? $meta_key : '',
				'post_type'           => $post_type,
				'ignore_sticky_posts' => true,
			);

			if( $exclude ) {
				$settings['post__not_in'] = wp_parse_id_list( $exclude );
			}

			if( 'none' === $pagination ) {
				$settings['no_found_rows'] = true;
			}
			else {
				$settings['paged'] = ra_helper()->get_paged();
			}

			if ( $settings['posts_per_page'] < 1 ) {
				$settings['posts_per_page'] = 1000;
			}

			if ( ! empty( $taxonomies ) ) {
				$taxonomies = ra_helper()->terms_are_ids_or_slugs( $taxonomies, $this->taxonomies[0] );

				$terms = get_terms( $this->taxonomies, array(
					'hide_empty' => false,
					'include' => $taxonomies,
				) );
				$settings['tax_query'] = array();
				$tax_queries = array(); // List of taxnonimes
				foreach ( $terms as $t ) {
					if ( ! isset( $tax_queries[ $t->taxonomy ] ) ) {
						$tax_queries[ $t->taxonomy ] = array(
							'taxonomy' => $t->taxonomy,
							'field'    => 'id',
							'terms'    => array( $t->term_id ),
							'relation' => 'IN',
						);
					} else {
						$tax_queries[ $t->taxonomy ]['terms'][] = $t->term_id;
					}
				}
				$settings['tax_query'] = array_values( $tax_queries );
				$settings['tax_query']['relation'] = 'OR';
			}
		}

		return $settings;
	}

	// Entry Helper ------------------------------------------------

	protected function entry_title() {

		if( !$this->atts['show_title'] ) {
			return;
		}

		$sub_style = $this->atts['item_style'];

		// Default
		the_title( sprintf( '<h2><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
	}

	protected function entry_read_more() {

		if( !$this->atts['show_link'] ) {
			return;
		}

		$link = '<a href="' . esc_url( get_permalink() ) . '" class="read-more">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					 	viewBox="0 0 268.832 268.832" style="enable-background:new 0 0 268.832 268.832;"
						 xml:space="preserve">
						<g>
							<path d="M265.171,125.577l-80-80c-4.881-4.881-12.797-4.881-17.678,0c-4.882,4.882-4.882,12.796,0,17.678l58.661,58.661H12.5
								c-6.903,0-12.5,5.597-12.5,12.5c0,6.902,5.597,12.5,12.5,12.5h213.654l-58.659,58.661c-4.882,4.882-4.882,12.796,0,17.678
								c2.44,2.439,5.64,3.661,8.839,3.661s6.398-1.222,8.839-3.661l79.998-80C270.053,138.373,270.053,130.459,265.171,125.577z"/>
						</g>
					</svg>
				</a>';

		echo $link;
	}

	protected function entry_content() {

		if( !$this->atts['show_summary'] ) {
			return;
		}
	?>
	    <div class="portfolio-summary">
	        <p><?php rella_portfolio_the_excerpt(); ?></p>
	    </div>
	<?php
	}

	public function add_excerpt_hooks() {
		add_filter( 'excerpt_more', array( $this, 'excerpt_more' ) );
		add_filter( 'excerpt_length', array( $this, 'excerpt_length' ) );
	}

	public function remove_excerpt_hooks() {
		remove_filter( 'excerpt_more', array( $this, 'excerpt_more' ) );
		remove_filter( 'excerpt_length', array( $this, 'excerpt_length' ) );
	}

	public function excerpt_more() {
		return '';
	}

	public function excerpt_length() {
		
		$limit = $this->atts['post_excerpt'];
		if( empty( $limit ) ) {
			return 10;
		}
		
		return $limit;
	}

	protected function entry_cats() {

		if( !$this->atts['show_category'] ) {
			return;
		}

		if( !$this->atts['show_one_category'] ) {

			$cat = get_the_term_list( get_the_ID(), $this->taxonomies[0], '<ul class="category"><li>', '</li> <li>', '</li></ul>' );
			if( $cat ) { echo $cat; }

		} else {

			$terms = get_the_terms( get_the_ID(), $this->taxonomies[0] );
			$term = $terms[0];

			if( isset( $term ) ) {
				echo '<ul class="category"><li><a href="' . get_term_link( $term->slug, $this->taxonomies[0] ) . '">' . $term->name . '</a></li></ul>';
			}
		}

	}

	protected function add_loader() {

		if( 'yes' !== $this->atts['enable_loader'] ) {
			return;
		}

		echo '<div class="items-loader"><svg class="circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/></svg></div>';
	}

	protected function get_zoom_effect() {

		if( !$this->atts['enable_panr'] ) {
			return;
		}

		echo ' data-panr="true" data-plugin-options=\'{ "moveTarget": ".portfolio-item" }\' ';

	}

	protected function enable_parallax() {

		if( 'no' === $this->atts['enable_parallax'] ) {
			return;
		}

		return ' data-parallax-bg="true"';
	}

	protected function get_parallax() {

		if( 'no' === $this->atts['enable_parallax'] ) {
			return;
		}

		return 'parallax-activated';
	}

	protected function entry_thumbnail( $size = 'post-thumbnail' ) {

		if ( post_password_required() || is_attachment() ) {
			return;
		}

		$format = get_post_format();
		$style = $this->atts['style'];
		$sub_style = $this->atts['item_style'];
		$parallax = $this->atts['enable_parallax'];

		if  ( 'yes' === $this->atts['disable_postformat'] || rella_helper()->str_starts_with( 'hover-', $sub_style ) ) {
			$format = 'image';
		}

		// Audio
		if( 'audio' === $format && $audio = rella_helper()->get_option( 'post-audio' ) ) {

			$classes = array( 'post-audio' );
			if( 'classic-image-medium' === $style ) {
				$classes[] = 'with-art';
			}
			printf( '<div class="%s">%s</div>', join( ' ', $classes ), do_shortcode( '[audio src="' . $audio . '"]' ) );
		}

		// Gallery
		elseif( 'gallery' === $format && $gallery = rella_helper()->get_option( 'post-gallery' ) ) {
			if ( is_array( $gallery ) ) {

				echo '<div class="carousel-container carousel-parallax carousel-nav-style4">';

					echo '<div class="carousel-items">';

						foreach ( $gallery as $item ) {

							if ( isset ( $item['attachment_id'] ) ) {

								if( 'no' === $parallax ){
									printf( '<div class="col-xs-12 no-padding">%s</div>', wp_get_attachment_image( $item['attachment_id'], 'full', array( 'alt' => esc_attr( $item['title'] ) ) ) );

								} else {

									$image_src = wp_get_attachment_image_src( $item['attachment_id'], 'full' );
									$get_small_image_src = rella_get_the_small_image( $image_src[0] );

									$image = wp_get_attachment_image( $item['attachment_id'], 'full', array( 'alt' => esc_attr( $item['title'] ) ) );

									printf( '<div class="col-xs-12 no-padding"><figure style="background-image: url(%s);"%s>%s</figure></div>', $get_small_image_src, $this->enable_parallax(), $image );
								}
							}
						}

					echo '</div>';

					echo '<div class="carousel-nav"><button class="flickity-prev-next-button previous"><i class="fa fa-angle-left"></i></button><button class="flickity-prev-next-button next"><i class="fa fa-angle-right"></i></button></div>';

				echo '</div>';
			}
		}

		// Video
		elseif( 'video' === $format ) {

			$video = '';
			if( $url = rella_helper()->get_option( 'post-video-url', 'url' ) ) {
				global $wp_embed;
				echo $wp_embed->run_shortcode( '[embed]' . $url . '[/embed]' );
			}
			elseif( $file = rella_helper()->get_option( 'post-video-file' ) ) {
				if( rella_helper()->str_contains( '[embed', $file ) ) {
					global $wp_embed;
					echo $wp_embed->run_shortcode( $file );
				} else {
					echo do_shortcode( $file );
				}
			}
			else {
				$video = rella_helper()->get_option( 'post-video-html' );
			}

			if( '' != $video ) {
				$my_allowed = wp_kses_allowed_html( 'post' );

				// iframe
				$my_allowed['iframe'] = array(
					'align'        => true,
					'width'        => true,
					'height'       => true,
					'frameborder'  => true,
					'name'         => true,
					'src'          => true,
					'id'           => true,
					'class'        => true,
					'style'        => true,
					'scrolling'    => true,
					'marginwidth'  => true,
					'marginheight' => true,
				);

				echo wp_kses( $video, $my_allowed );
			}

		}

		else {

				$thumb_size = $this->get_thumb_size();

				if( ! empty( $thumb_size ) ) {
					$size = $thumb_size;
				}

				if( 'no' === $parallax ){

					echo '<figure>';

					rella_the_post_thumbnail( $size );

				} else {

					$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
					$resized_image = rella_get_resized_image_src( $image_src, $size );
					$get_small_image_src = rella_get_the_small_image( $resized_image );

					$url = rella_helper()->get_option( 'enable-lazy-load' ) ? $get_small_image_src : $resized_image;

					printf( '<figure style="background-image: url(%s);"%s>', $url, $this->enable_parallax() );

					rella_the_post_thumbnail( $size );
				}

			if( 'grid' === $style && 'list' === $sub_style || 'masonry' === $style && in_array( $sub_style, array( 'list', 'outline', 'hover-elegant', 'shadow' ) ) || 'classic' === $style && in_array( $sub_style, array( 'list' ) ) ) {
				echo '<a class="portfolio-overlay-link" href="' . get_permalink() . '"></a>';
			}

			echo '</figure>';

		}
	}

	protected function get_full_image( $size = 'full' ) {

		$parallax = $this->atts['enable_parallax'];

		if( 'no' === $parallax ){

			echo '<figure>';
			rella_the_post_thumbnail( $size );

		} else {

			$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), $size );
			$get_small_image_src = rella_get_the_small_image( $image_src[0] );

			$url = rella_helper()->get_option( 'enable-lazy-load' ) ? $get_small_image_src : $image_src[0];

			printf( '<figure style="background-image: url(%s);"%s>', $url, $this->enable_parallax() );
			rella_the_post_thumbnail( $size );

		}

		echo '</figure>';
	}

	/**
	 * [entry_footer_link description]
	 * @method entry_footer_link
	 * @return [type]            [description]
	 */
	protected function entry_footer_link() {

		if( !$this->atts['show_link'] ) {
			return;
		}

		$sub_style = $this->atts['item_style'];

		$ext_url   = get_post_meta( get_the_ID(), 'portfolio-website', true );
		$local_url = get_the_permalink();
		
		$enable_ext = $this->atts['enable_ext'];		
		if( $enable_ext ) {
			$url = $ext_url ? esc_url( $ext_url ) : $local_url;
		}
		else {
			$url = esc_url( $local_url );	
		}

		if( rella_helper()->str_starts_with( 'hover-', $sub_style ) ) {

			if( in_array( $sub_style, array( 'hover-dark', 'hover-blur', 'hover-bottom', 'hover-gradient' ) ) ) {
				printf( '<a href="%s" class="btn circle"><span><i class="fa fa-eye"></i></span></a>', $url );
				return;
			}

			if( in_array( $sub_style, array( 'hover-elegant', 'hover-rectangular', 'hover-only-icons', 'hover-color', 'hover-frame', 'hover-bottom-left' ) ) ) {
				printf( '<a href="%s" class="btn"><span><i class="fa fa-eye"></i></span></a>', $url );
				return;
			}

			if( in_array( $sub_style, array( 'hover-bottom-shadow' ) ) ) {
				printf( '<a href="%s" class="btn round"><span><i class="fa fa-eye"></i></span></a>', $url );
				return;
			}

			if( in_array( $sub_style, array( 'hover-light' ) ) ) {
				printf( '<a href="%s" class="btn btn-naked"><span><svg width="24.55" height="26.11" viewBox="0 0 24.55 26.11">
							  <path stroke-width="0.2"  d="M1482.31,8707.65h-1.34v12.3h-11.28v1.32h11.28v12.28h1.34v-12.28h11.74v-1.32h-11.74v-12.3Z" transform="translate(-1469.6 -8707.54)"/>
							</svg></span></a>', $url );
				return;
			}

			if( in_array( $sub_style, array( 'hover-side' ) ) ) {
				printf( '<a href="%s" class="btn btn-naked"><span><svg width="24.55" height="26.11" viewBox="0 0 24.55 26.11">
							  <path stroke-width="0.2"  d="M1482.31,8707.65h-1.34v12.3h-11.28v1.32h11.28v12.28h1.34v-12.28h11.74v-1.32h-11.74v-12.3Z" transform="translate(-1469.6 -8707.54)"/>
							</svg></span></a>', $url );
				return;
			}

			// Hover Default
			printf( '<a href="%s" class="btn btn-naked"><span>+</span></a>', $url );
			return;
		}

		// Default
		printf( '<a href="%s" class="btn btn-sm round"><span>%s <i class="fa fa-long-arrow-right"></i></span></a>', $url, esc_html__( 'See Details', 'infinite-addons' ) );
	}

/**
	 * [entry_lightbox description]
	 * @method entry_lightbox
	 * @return [type]         [description]
	 */
	protected function entry_ext_link() {

		if( !$this->atts['show_ext_link'] ) {
			return;
		}

		$name = get_post_meta( get_the_ID(), 'portfolio-client', true );
		$url  = get_post_meta( get_the_ID(), 'portfolio-website', true );
		$url  = $url ? esc_url( $url ) : '#';

		$sub_style = $this->atts['item_style'];

		if( in_array( $sub_style, array( 'list', 'shadow', 'outline', 'hover-light', 'hover-side' ) ) ) {
			return;
		}

		if( in_array( $sub_style, array( 'hover-dark', 'hover-blur', 'hover-bottom', 'hover-gradient' ) ) ) {
			printf( '<a href="%s" class="btn circle"><span><i class="fa fa-external-link"></i></span></a>', $url );
			return;
		}

		if( in_array( $sub_style, array( 'hover-elegant', 'hover-rectangular', 'hover-only-icons', 'hover-color', 'hover-frame', 'hover-bottom-left' ) ) ) {
			printf( '<a href="%s" class="btn"><span><i class="fa fa-external-link"></i></span></a>', $url );
			return;
		}

		if( in_array( $sub_style, array( 'hover-rectangular' ) ) ) {
			printf( '<a href="%s" class="btn"><span><i class="fa fa-external-link-square"></i></span></a>', $url );
			return;
		}

		if( in_array( $sub_style, array( 'hover-bottom-shadow' ) ) ) {
			printf( '<a href="%s" class="btn round"><span><i class="fa fa-external-link"></i></span></a>', $url );
			return;
		}

		// Default
		printf( '<a href="%s" class="btn btn-sm round"><span><i class="fa fa-external-link"></i></span></a>', $url );
	}

	/**
	 * [lightbox_gallery_link description]
	 * @method lightbox_gallery_link
	 * @return [type]         [description]
	 */
	protected function lightbox_gallery_link() {

		if( ! $this->atts['enable_gallery'] ) {
			return;
		}

		$url = wp_get_attachment_url( get_post_thumbnail_id(), 'full' );
		printf( '<a href="%s" data-type="image" class="lightbox-overlay-link lightbox-link"></a>', $url );

	}

	/**
	 * [entry_lightbox description]
	 * @method entry_lightbox
	 * @return [type]         [description]
	 */
	protected function entry_lightbox() {

		if( !$this->atts['show_lightbox'] ) {
			return;
		}
		
		$sub_style = $this->atts['item_style'];
		$url = wp_get_attachment_url( get_post_thumbnail_id(), 'full' );
		$format = get_post_format();
		$video_content = '';
		$data_type = 'image';
		$the_ID = get_the_id();

		if( 'video' === $format ) {
			$video = '';
			$video_url = rella_helper()->get_option( 'post-video-url', 'url' );	
			$data_type = 'inline';

			if( ! empty( $video_url ) ) {
				$url = 	$video_url;
				$data_type = 'video';
			} 
			elseif( $file = rella_helper()->get_option( 'post-video-file' ) ) {
				$url = '#video-' . $the_ID;
				if( rella_helper()->str_contains( '[embed', $file ) ) {
					global $wp_embed;
					$video_content = '<div id="video-' . $the_ID . '" class="video-popup mfp-hide">' . $wp_embed->run_shortcode( $file ) . '</div>';
				} else {
					$video_content = '<div id="video-' . $the_ID . '" class="video-popup mfp-hide">' . do_shortcode( $file ) . '</div>';
				}
			}
			else {
				$url = '#video-' . $the_ID;
				$video = rella_helper()->get_option( 'post-video-html' );
			}

			if( '' != $video ) {
				$my_allowed = wp_kses_allowed_html( 'post' );
		
				// iframe
				$my_allowed['iframe'] = array(
					'align'        => true,
					'width'        => true,
					'height'       => true,
					'frameborder'  => true,
					'name'         => true,
					'src'          => true,
					'id'           => true,
					'class'        => true,
					'style'        => true,
					'scrolling'    => true,
					'marginwidth'  => true,
					'marginheight' => true,
				);
		
				$video_content = '<div id="video-' . $the_ID . '" class="video-popup mfp-hide">' . wp_kses( $video, $my_allowed ) . '</div>';
			}

		}		

		if( in_array( $sub_style, array( 'hover-dark', 'hover-blur', 'hover-bottom', 'hover-gradient' ) ) ) {
			printf( '<a href="%s" data-type="%s" class="btn circle lightbox-link"><span><i class="fa fa-search"></i></span></a> %s', $url, $data_type, $video_content );
			return;
		}

		if( in_array( $sub_style, array( 'hover-elegant', 'hover-rectangular', 'hover-only-icons', 'hover-color', 'hover-frame', 'hover-bottom-left' ) ) ) {
			printf( '<a href="%s" data-type="%s" class="btn lightbox-link"><span><i class="fa fa-search"></i></a> %s', $url, $data_type, $video_content );
			return;
		}

		if( in_array( $sub_style, array( 'hover-bottom-shadow' ) ) ) {
			printf( '<a href="%s" data-type="%s" class="btn round lightbox-link"><span><i class="fa fa-search"></i></span></a> %s', $url, $data_type, $video_content );
			return;
		}

		// Default
		printf( '<a href="%s" data-type="%s" class="btn btn-sm round lightbox-link"><span><i class="fa fa-search"></i></span></a> %s', $url, $data_type, $video_content );
	}

	/**
	 * [entry_share description]
	 * @method entry_share
	 * @return [type]      [description]
	 */
	protected function entry_share() {

		if( !$this->atts['show_share'] ) {
			return;
		}

		$sub_style = $this->atts['item_style'];
		$url = esc_url( get_the_permalink() );
		$pinterest_image = wp_get_attachment_url( get_post_thumbnail_id(), 'full' );
		$btn_class = 'btn btn-sm round';

		if( in_array( $sub_style, array( 'hover-side', 'hover-light' ) ) ) {
			return;
		}

		if( in_array( $sub_style, array( 'hover-dark', 'hover-blur', 'hover-bottom', 'hover-gradient' ) ) ) {
			$btn_class = 'btn circle';
		}
		elseif( in_array( $sub_style, array( 'hover-elegant', 'hover-rectangular', 'hover-only-icons', 'hover-color', 'hover-frame', 'hover-bottom-left' ) ) ) {
			$btn_class = 'btn';
		}
		elseif( in_array( $sub_style, array( 'hover-bottom-shadow' ) ) ) {
			$btn_class = 'btn round';
		}

		?>
		<div class="portfolio-share">
			<span class="<?php echo $btn_class ?>">
				<span><i class="fa fa-share"></i></span>
			</span>
			<div class="portfolio-share-popup">
				<ul class="social-icon">
					<li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url ?>"><i class="fa fa-facebook"></i></a></li>
					<li><a target="_blank" href="https://twitter.com/home?status=<?php echo $url ?>"><i class="fa fa-twitter"></i></a></li>
					<li><a target="_blank" href="https://plus.google.com/share?url=<?php echo $url ?>"><i class="fa fa-google"></i></a></li>
					<?php if( ! empty( $pinterest_image ) ):?>
					<li><a target="_blank" href="https://pinterest.com/pin/create/button/?url=&amp;media=<?php echo esc_url( $pinterest_image ); ?>&amp;description=<?php echo urlencode( get_the_title() ); ?>"><i class="fa fa-pinterest-p"></i></a></li>
					<?php endif; ?>
					<li><a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url ?>&amp;title=<?php echo get_the_title(); ?>&amp;source=<?php echo get_bloginfo( 'name' ); ?>"><i class="fa fa-linkedin"></i></a></li>
				</ul>
			</div>
		</div>
		<?php
	}

	protected function entry_like() {

		if( !$this->atts['show_like'] ) {
			return;
		}

		if( function_exists( 'rella_likes_button' ) ) {
			rella_likes_button( array(
				'container_class' => 'portfolio-likes',
				'format' => wp_kses_post( __( '<span><i class="fa fa-heart"></i> <span class="post-likes-count">%s</span></span>', 'infinite-addons' ) )
			) );
		}
	}

	protected function entry_date() {

		if( !$this->atts['show_date'] ) {
			return;
		}
		?>
		<span class="date">
			<time datetime="<?php echo get_the_date('Y') ?>">
				<?php echo get_the_date('Y') ?>
			</time>
		</span>
		<?php
	}

	protected function entry_client() {

		if( !$this->atts['show_client'] ) {
			return;
		}

		$name = get_post_meta( get_the_ID(), 'portfolio-client', true );
		$url = get_post_meta( get_the_ID(), 'portfolio-website', true );
		$url = $url ? esc_url( $url ) : '#';

		if( !$name ) {
			return;
		}

		?>
		<span class="client">
			<a href="<?php echo $url ?>"><?php echo esc_html( $name ) ?></a>
		</span>
		<?php
	}

	/**
	 * [entry_term_classes description]
	 * @method entry_term_classes
	 * @return [type]             [description]
	 */
	protected function entry_term_classes() {

		$terms = get_the_terms( get_the_ID(), $this->taxonomies[0] );
		if( !$terms ) {
			return;
		}
		$terms = wp_list_pluck( $terms, 'slug' );
		return join( ' ', $terms );

	}

	// AJAX Helpers ------------------------------------------------

	/**
	 * @param $search_string
	 *
	 * @return array
	 */
	public function include_field_search( $search_string ) {
		$query = $search_string;
		$data = array();
		$args = array(
			's' => $query,
			'post_type' => $this->post_type,
		);
		$args['vc_search_by_title_only'] = true;
		$args['numberposts'] = - 1;
		if ( 0 === strlen( $args['s'] ) ) {
			unset( $args['s'] );
		}
		add_filter( 'posts_search', 'vc_search_by_title_only', 500, 2 );
		$posts = get_posts( $args );
		if ( is_array( $posts ) && ! empty( $posts ) ) {
			foreach ( $posts as $post ) {
				$data[] = array(
					'value' => $post->ID,
					'label' => $post->post_title
				);
			}
		}

		return $data;
	}

	/**
	 * @param $data_arr
	 *
	 * @return array
	 */
	function vc_exclude_field_search( $data_arr ) {

		$term = isset( $data_arr['term'] ) ? $data_arr['term'] : '';
		$data = array();
		$args = array(
			's' => $term,
			'post_type' => $this->post_type,
		);
		$args['vc_search_by_title_only'] = true;
		$args['numberposts'] = - 1;
		if ( 0 === strlen( $args['s'] ) ) {
			unset( $args['s'] );
		}
		add_filter( 'posts_search', 'vc_search_by_title_only', 500, 2 );
		$posts = get_posts( $args );
		if ( is_array( $posts ) && ! empty( $posts ) ) {
			foreach ( $posts as $post ) {
				$data[] = array(
					'value' => $post->ID,
					'label' => $post->post_title
				);
			}
		}

		return $data;
	}

	/**
	 * @since 4.5.2
	 *
	 * @param $search_string
	 *
	 * @return array|bool
	 */
	function autocomplete_taxonomies_field_search( $search_string ) {
		$data = array();
		$vc_taxonomies = get_terms( $this->taxonomies, array(
			'hide_empty' => false,
			'search'     => $search_string,
		) );
		if ( is_array( $vc_taxonomies ) && ! empty( $vc_taxonomies ) ) {
			foreach ( $vc_taxonomies as $t ) {
				if ( is_object( $t ) ) {
					$data[] = ra_helper()->get_term_object( $t );
				}
			}
		}

		return $data;
	}

	protected function get_class( $id ) {

		$sub_style = $this->atts['item_style'];

		$hash = array(
			'classic' => 'classic',
			'grid'    => 'grid',
			'masonry' => 'grid masonry',
			'metro'   => 'grid metro',
			'packery' => 'grid packery',
			'slider'  => 'carousel-container carousel-parallax gallery gallery-style2 gallery-with-thumb nav-vertical',
		);

		return !empty( $hash[ $id ] ) ? $hash[ $id ] : '';
	}

	protected function get_item_class( $id ) {

		$hash = array(
			// List
			'list'    => 'style-default',
			'shadow'  => 'shadow',
			'outline' => 'outline',

			// Hover
			'hover-light'         => 'hover-light style-hover buttons-naked',
			'hover-dark'          => 'hover-dark style-hover buttons-circle',
			'hover-blur'          => 'hover-blur style-hover buttons-circle',
			'hover-side'          => 'hover-side style-hover buttons-naked',
			'hover-elegant'       => 'hover-elegant style-hover buttons-square',
			'hover-rectangular'   => 'hover-rectangular style-hover buttons-square',
			'hover-bottom'        => 'hover-bottom style-hover buttons-circle',
			'hover-only-icons'    => 'hover-only-icons style-hover buttons-rectangle',
			'hover-bottom-shadow' => 'hover-bottom-shadow style-hover buttons-square',
			'hover-gradient'      => 'hover-gradient style-hover buttons-circle',
			'hover-color'         => 'hover-color style-hover buttons-naked',
			'hover-frame'         => 'hover-frame style-hover buttons-square',
			'hover-bottom-left'   => 'hover-bottom-left style-hover buttons-naked',

			//New
			'hover-top-left'      => 'hover-top-left style-hover text-light buttons-naked',

			// Caption
			'caption-fixed'       => 'caption-fixed'
		);

		$class = !empty( $hash[ $id ] ) ? $hash[ $id ] : '';

		return $class;
	}

	protected function get_alignment() {

		if( 'classic' !== $this->atts['style'] ){
			return;
		}

		$meta = get_post_meta( get_the_ID(), 'portfolio-align', true );
		$align = ! empty( $meta ) ? $meta : $this->atts['content_alignment'];

		$hash = array(
			'default'       => 'item-right',
			'left'          => 'item-left',
			'center'        => 'item-center',
			'right'         => 'item-right',
			'inside-left'   => 'item-left item-inside',
			'inside-center' => 'item-center item-inside',
			'inside-right'  => 'item-right item-inside'
		);

		$class = !empty( $hash[ $align ] ) ? $hash[ $align ] : '';

		return $class;
	}

	protected function get_text_alignment() {

		if( empty( $this->atts['text_alignment'] ) && ! isset( $this->atts['text_alignment'] ) ) {
			return;
		}

		$text_align = $this->atts['text_alignment'];
		$hash = array(
			'left'          => 'text-left',
			'center'        => 'text-center',
			'right'         => 'text-right',
		);

		$class = !empty( $hash[ $text_align ] ) ? $hash[ $text_align ] : '';

		return $class;

	}

	protected function get_thumbs_classname() {

		$thumb = get_post_meta( get_the_ID(), '_portfolio_image_size', true );
		if ( empty( $thumb ) ) {
			return;
		}

		return $thumb;

	}

	protected function get_thumb_size() {

		$size = get_post_meta( get_the_ID(), '_portfolio_image_size', true );

		if ( ! empty( $size ) ) {
			return $size;
		}

		$style = $this->atts['style'];
		if( ! in_array( $style, array( 'grid', 'masonry' ) ) ) {
			return;
		}

		$column = $this->atts['grid_columns'];

		$hash = array(
			'1' => 'rella-portfolio-one-col',
			'2' => 'rella-portfolio-two-col',
			'3' => 'rella-portfolio-three-col',
			'4' => 'rella-portfolio-four-col',
			'6' => 'rella-portfolio-six-col'
		);

		return $hash[$column];

	}

	protected function get_grid_class() {

		$column = $this->atts['grid_columns'];
		$hash = array(
			'1' => '12',
			'2' => '6',
			'3' => '4',
			'4' => '3',
			'6' => '2'
		);

		return sprintf( 'col-md-%s col-sm-6 col-xs-12', $hash[$column] );
	}

	protected function get_column_class() {

		$width = get_post_meta( get_the_ID(), 'portfolio-width', true );

		if ( !empty( $width ) && 'auto' !=  $width ) {
			return $width;
		}

		$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'post-thumbnail' );
		$width = $img[1];

		if( $width > 260 && $width < 370 ) {
			return 3;
		}

		if( $width > 360 && $width < 470 ) {
			return 4;
		}

		if( $width > 471 && $width < 600 ) {
			return 5;
		}

		if( $width > 600 ) {
			return 6;
		}
	}

	protected function before_portfolio_meta( $check = array() ) {
		$atts = array();
		if( ! empty ( $check ) ) {
			foreach ( $check as $key ) {
				$atts[] = $this->atts[ $key ];
			}
		}
		if( count( array_filter( $atts ) ) == 0) {
			return;
		}
		return '<div class="portfolio-meta">';
	}
	protected function after_portfolio_meta( $check = array() ) {
		$atts = array();
		if( ! empty ( $check ) ) {
			foreach ( $check as $key ) {
				$atts[] = $this->atts[ $key ];
			}
		}
		if( count( array_filter( $atts ) ) == 0) {
			return;
		}
		return '</div>';
	}

	protected function before_portfolio_footer( $check = array() ) {
		$atts = array();
		if( ! empty ( $check ) ) {
			foreach ( $check as $key ) {
				$atts[] = $this->atts[ $key ];
			}
		}
		if( count( array_filter( $atts ) ) == 0) {
			return;
		}
		return '<div class="portfolio-footer">';
	}
	protected function after_portfolio_footer( $check = array() ) {
		$atts = array();
		if( ! empty ( $check ) ) {
			foreach ( $check as $key ) {
				$atts[] = $this->atts[ $key ];
			}
		}
		if( count( array_filter( $atts ) ) == 0) {
			return;
		}
		return '</div>';
	}

	protected function before_portfolio_title( $check = array() ) {
		$atts = array();
		if( ! empty ( $check ) ) {
			foreach ( $check as $key ) {
				$atts[] = $this->atts[ $key ];
			}
		}
		if( count( array_filter( $atts ) ) == 0) {
			return;
		}
		return '<div class="title-wrapper">';
	}
	protected function after_portfolio_title( $check = array() ) {
		$atts = array();
		if( ! empty ( $check ) ) {
			foreach ( $check as $key ) {
				$atts[] = $this->atts[ $key ];
			}
		}
		if( count( array_filter( $atts ) ) == 0) {
			return;
		}
		return '</div>';
	}

	protected function generate_css() {

		extract( $this->atts );

		$bg = $elements = array();
		$id = '.' .$this->get_id();

		// Backgrund
		if( 'solid' === $bg_type && $color_primary ) {
			$bg = array( 'background' => $color_primary );
		}
		if( 'gradient' === $bg_type && $gradient_primary ) {
			$bg = rella_parse_gradient( $gradient_primary );
			$bg['background-color'] = 'transparent !important';
		}

		if( 'caption-fixed' === $item_style ) {
			$elements[ rella_implode( '%1$s .portfolio-item.caption-fixed .portfolio-content' ) ] = $bg;
		}
		elseif( in_array( $item_style, array( 'list', 'shadow', 'outline' ) ) ) {
			$elements[ rella_implode( '%1$s .portfolio-item .portfolio-content' ) ] = $bg;
		}
		elseif( 'hover-elegant' === $item_style ) {
			$elements[ rella_implode( '%1$s .portfolio-item.hover-elegant .portfolio-content' ) ] = $bg;
		}
		elseif( 'hover-color' === $item_style ) {
			$elements[ rella_implode( '%1$s .portfolio-item.hover-color .portfolio-content:before' ) ] = $bg;
		}
		elseif( 'hover-bottom' === $item_style ) {
			$elements[ rella_implode( '%1$s .portfolio-item.hover-bottom .title-wrapper' ) ] = $bg;
		}
		elseif( 'hover-only-icons' === $item_style ) {
			$elements[ rella_implode( '%1$s .portfolio-item.hover-only-icons .portfolio-footer' ) ] = $bg;
		}
		elseif( 'hover-frame' === $item_style ) {
			$elements[ rella_implode( '%1$s .portfolio-item.hover-frame .portfolio-main-image:after' ) ] = $bg;
		}
		elseif( 'hover-blur' === $item_style ) {
			$elements[ rella_implode( '%1$s .portfolio-item.hover-blur .portfolio-content' ) ] = $bg;
		}
		// Rest of the hovers
		else {
			$elements[ rella_implode( '%1$s .portfolio-item[class*=hover] .portfolio-content' ) ] = $bg;
		}

		// Loader
		$elements[ rella_implode( '%1$s .items-loader .circular .path' ) ] = array(
			'stroke' => $color_loader
		);

		if( ! empty( $overlay_opacity ) ) {
			$elements[ rella_implode( '%1$s .portfolio-item:hover .portfolio-main-image:before' ) ] = array(
				'opacity' => $overlay_opacity
			);
		}

		// Column Gaps
		if( 'grid' === $style || 'masonry' === $style || 'metro' === $style || 'packery' === $style ) {

			$grid_id = '%1$s .' . $this->grid_id;
			$gap = $columns_gap . 'px';

			$elements[ rella_implode( $grid_id ) ] = array(
				'margin-left' => '-' . $gap,
				'margin-right' => '-' . $gap
			);

			$elements[ rella_implode( $grid_id . ' .masonry-item' ) ] = array(
				'padding-left' => $gap,
				'padding-right' => $gap
			);
		}

		// Bottom Gaps
		if( isset( $columns_gap ) ) {
			$elements[ rella_implode( '%1$s .portfolio-item.grid' ) ]['margin-bottom'] = ( $columns_gap * 2 ) . 'px';
		}
		if( isset( $columns_gap ) && '0' !== $columns_gap ) {
			$elements[ rella_implode( '%1$s .page-nav nav' ) ]['margin-top'] = ( ( $columns_gap * 2 ) * -1 ) . 'px';
		}

		if( 'packery' === $style && isset( $columns_gap ) ) {

			$elements[ rella_implode( '%1$s .portfolio-item.rella-portfolio-portrait.style-hover .portfolio-main-image img' ) ]['width'] = 'calc( 100% + ' . $columns_gap . 'px ) !important';

			$elements[ rella_implode( '%1$s .portfolio-item.rella-portfolio-wide.style-hover .portfolio-main-image' ) ]['margin-top'] = ( $columns_gap * -1) . 'px !important';

			$elements[ rella_implode( array( '%1$s .portfolio-item.packery.style-default.rella-portfolio-portrait-tall .portfolio-main-image img', '%1$s .portfolio-item.packery.outline.rella-portfolio-portrait-tall .portfolio-main-image img', '%1$s .portfolio-item.packery.shadow.rella-portfolio-portrait-tall .portfolio-main-image img' ) ) ]['width'] = 'calc( 100% + ' . ($columns_gap * 0.25) . 'px ) !important';
			$elements[ rella_implode( array( '%1$s .portfolio-item.rella-portfolio-wide.style-default .portfolio-main-image > figure', '%1$s .portfolio-item.rella-portfolio-wide.outline .portfolio-main-image > figure', '%1$s .portfolio-item.rella-portfolio-wide.shadow .portfolio-main-image > figure' ) ) ]['margin-top'] = ( $columns_gap  * -1) . 'px !important';

		}

		if( ! empty( $title_color ) || ! empty( $title_size ) || ! empty( $title_weight ) ) {

			$elements[rella_implode( '.portfolio-item .title-wrapper h2, .portfolio-item .title-wrapper h2 a' )] = array(
				'color'       => $title_color . ' !important',
				'font-size'   => $title_size . ' !important',
				'font-weight' => $title_weight . ' !important',
			);
		}

		$this->dynamic_css_parser( $id, $elements );
	}

	function render_autocomplete_field( $term ) {
		return ra_helper()->vc_autocomplete_taxonomies_field_render($term, 'rella-portfolio-category');
	}
}
new RA_PortfolioListing;
