<?php
/**
* Shortcode Latest Posts
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Latest_Posts extends RA_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_latest_posts';
		$this->title       = esc_html__( 'Latest Posts', 'infinite-addons' );
		$this->description = esc_html__( 'Posts, pages or custom posts', 'infinite-addons' );
		$this->icon        = 'icon-wpb-application-icon-large';
		$this->scripts     = array( 'flickity', 'ofi-polyfill' );
		$this->styles      = array( 'flickity', 'rella-sc-carousel', 'rella-sc-latest-posts', 'rella-sc-button' );

		require_once vc_path_dir( 'CONFIG_DIR', 'grids/vc-grids-functions.php' );
		require_once vc_path_dir( 'CONFIG_DIR', 'grids/class-vc-grids-common.php' );

		if ( 'vc_get_autocomplete_suggestion' === vc_request_param( 'action' ) || 'vc_edit_form' === vc_post_param( 'action' ) ) {
			add_filter( 'vc_autocomplete_'. $this->slug . '_include_callback', 'vc_include_field_search', 10, 1 ); // Get suggestion(find). Must return an array
			add_filter( 'vc_autocomplete_'. $this->slug . '_include_render', 'vc_include_field_render', 10, 1 ); // Render exact product. Must return an array (label,value)

			// Narrow data taxonomies
			add_filter( 'vc_autocomplete_'. $this->slug . '_taxonomies_callback', 'vc_autocomplete_taxonomies_field_search', 10, 1 );
			add_filter( 'vc_autocomplete_'. $this->slug . '_taxonomies_render', 'vc_autocomplete_taxonomies_field_render', 10, 1 );

			// Narrow data taxonomies for exclude_filter
			add_filter( 'vc_autocomplete_'. $this->slug . '_exclude_callback', 'vc_exclude_field_search', 10, 1 ); // Get suggestion(find). Must return an array
			add_filter( 'vc_autocomplete_'. $this->slug . '_exclude_render', 'vc_exclude_field_render', 10, 1 ); // Render exact product. Must return an array (label,value)
		}

		parent::__construct();
	}

	protected function get_post_type_list() {

		$postTypes = get_post_types( array(
			'public' => true
		), 'objects' );
		$postTypesList = array();
		$excludedPostTypes = array(
			'revision',
			'nav_menu_item',
			'rella-footer',
			'rella-header',
			'rella-mega-menu',
			'wpcf7_contact_form',
			'vc_grid_item',
		);

		if ( is_array( $postTypes ) && ! empty( $postTypes ) ) {
			foreach ( $postTypes as $postType => $obj ) {
				if ( ! in_array( $postType, $excludedPostTypes ) ) {
					$label = $obj->label;
					$postTypesList[] = array(
						$postType,
						$label,
					);
				}
			}
		}
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

		$url = rella_addons()->plugin_uri() . '/assets/img/sc-preview/latest-posts/';

		$general = array(
			array(
				'type'       => 'select_preview',
				'param_name' => 'style',
				'heading'    => esc_html__( 'Style', 'infinite-addons' ),
				'value'      => array(

					array(
						'value' => 'default',
						'label' => esc_html__( 'Default', 'infinite-addons' ),
						'image' => $url . 'default.png'
					),

					array(
						'label' => esc_html__( '3D Hover', 'infinite-addons'  ),
						'value' => '3d-hover',
						'image' => $url . '3d-hover.png'
					),

					array(
						'label' => esc_html__( 'Agency', 'infinite-addons' ),
						'value' => 'agency',
						'image' => $url . 'agency.png'
					),

					array(
						'label' => esc_html__( 'Carousel Fullwidth', 'infinite-addons' ),
						'value' => 'carousel-fullwidth',
						'image' => $url . 'carousel-fullwidth.png'
					),

					array(
						'label' => esc_html__( 'Carousel', 'infinite-addons' ),
						'value' => 'carousel',
						'image' => $url . 'carousel-style1.png'
					),

					array(
						'label' => esc_html__( 'Classic', 'infinite-addons' ),
						'value' => 'classic',
						'image' => $url . 'classic.png'
					),

					array(
						'label' => esc_html__( 'Cloud', 'infinite-addons' ),
						'value' => 'cloud',
						'image' => $url . 'cloud.png'
					),

					array(
						'label' => esc_html__( 'Corporate', 'infinite-addons' ),
						'value' => 'corporate',
						'image' => $url . 'corporate.png'
					),

					array(
						'label' => esc_html__( 'Hosting', 'infinite-addons' ),
						'value' => 'hosting',
						'image' => $url . 'hosting.png'
					),

					array(
						'label' => esc_html__( 'Lawyer', 'infinite-addons' ),
						'value' => 'lawyer',
						'image' => $url . 'layer.png'
					),

					array(
						'label' => esc_html__( 'Masonry in Menu', 'infinite-addons' ),
						'value' => 'menu-masonry',
						'image' => $url . 'masonry.png'
					),

					array(
						'label' => esc_html__( 'Mobile', 'infinite-addons' ),
						'value' => 'mobile',
						'image' => $url . 'mobile.png'
					),

					array(
						'label' => esc_html__( 'Rental', 'infinite-addons' ),
						'value' => 'rental',
						'image' => $url . 'rental.png'
					),

					array(
						'label' => esc_html__( 'Restaurant', 'infinite-addons' ),
						'value' => 'restaurant',
						'image' => $url . 'restaurant.png'
					),

					array(
						'label' => esc_html__( 'Rhombus', 'infinite-addons' ),
						'value' => 'rhombus',
						'image' => $url . 'rhombus.png'
					),

					array(
						'label' => esc_html__( 'Shop', 'infinite-addons' ),
						'value' => 'shop',
						'image' => $url . 'shop.png'
					),

					array(
						'label' => esc_html__( 'Thumbnail on Left', 'infinite-addons' ),
						'value' => 'thumbnail-left',
						'image' => $url . 'thumb-left.png'
					),

					array(
						'label' => esc_html__( 'Title Only', 'infinite-addons' ),
						'value' => 'excerpt-only',
						'image' => $url . 'title-only.png'
					),

					array(
						'label' => esc_html__( 'Title Only 2', 'infinite-addons' ),
						'value' => 'title-only',
						'image' => $url . 'title-only-2.png'
					),

					array(
						'label' => esc_html__( 'University', 'infinite-addons' ),
						'value' => 'university',
						'image' => $url . 'university.png'
					),
				),
				'save_always' => true,
				'description' => esc_html__( 'Select content type for your grid.', 'infinite-addons' ),
				'admin_label' => true
			),

			array(
				'type'       => 'select_preview',
				'param_name' => 'sub_style',
				'heading'    => esc_html__( 'Substyle', 'infinite-addons' ),
				'value'      => array(

					array(
						'value' => 'sb1',
						'label' => esc_html__( 'Carousel 1', 'infinite-addons' ),
						'image' => $url . 'carousel-style1.png'
					),

					array(
						'label' => esc_html__( 'Carousel 2', 'infinite-addons' ),
						'value' => 'sb2',
						'image' => $url . 'carousel-style2.png'
					),

					array(
						'label' => esc_html__( 'Carousel 3', 'infinite-addons' ),
						'value' => 'sb3',
						'image' => $url . 'carousel-style3.png'
					)
				),
				'save_always' => true,
				'dependency' => array(
					'element' => 'style',
					'value' => array( 'carousel' )
				)
			),

			array( 'id' => 'title' ),

			array(
				'type'       => 'textfield',
				'param_name' => 'subtitle',
				'heading'    => esc_html__( 'Subtitle', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'style',
					'value'   => array( 'carousel' )
				),
			),

			array(
				'type'       => 'textarea',
				'param_name' => 'desc',
				'heading'    => esc_html__( 'Description', 'infinite-addons' ),
				'dependency' => array(
					'element' => 'style',
					'value'   => array( 'carousel' )
				),
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'post_type',
				'heading'     => esc_html__( 'Data source', 'infinite-addons' ),
				'description' => esc_html__( 'Select content type for your grid.', 'infinite-addons' ),
				'value'       => $this->get_post_type_list(),
				'save_always' => true,
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'posts_per_page',
				'heading'     => esc_html__( 'Total items', 'infinite-addons' ),
				'description' => esc_html__( 'Set max limit for items in grid or enter -1 to display all (limited to 1000).', 'infinite-addons' ),
				'value'       => 10,
				// default value
				'dependency'  => array(
					'element'            => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom',
					),
				),
				'param_holder_class' => 'vc_not-for-custom',
				'edit_field_class'   => 'vc_col-sm-4',
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'post_excerpt_length',
				'heading'     => esc_html__( 'Excerpt Length', 'infinite-addons' ),
				'description' => esc_html__( 'Set the excerpt length or leave blank to set default 55 words', 'infinite-addons' ),
				'edit_field_class' => 'vc_col-sm-4',
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
				),
				'dependency' => array(
					'element' => 'post_type',
					'value'   => array( 'ids' ),
				),
			),

			// Custom query tab
			array(
				'type'        => 'textarea_safe',
				'param_name'  => 'custom_query',
				'heading'     => esc_html__( 'Custom query', 'infinite-addons' ),
				'description' => esc_html__( 'Build custom query according to <a href="http://codex.wordpress.org/Function_Reference/query_posts">WordPress Codex</a>.', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'post_type',
					'value'   => array( 'custom' ),
				),
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
					// In UI show results grouped by groups, default false
					'unique_values'  => true,
					// In UI show results except selected. NB! You should manually check values in backend, default false
					'display_inline' => true,
					// In UI show results inline view, default false (each value in own line)
					'delay'          => 500,
					// delay for search. default 500
					'auto_focus'     => true,
					// auto focus input, default true
				),
				'dependency' => array(
					'element' => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom',
					),
				),
				'param_holder_class' => 'vc_not-for-custom',
			)
		);

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
						'custom',
					),
				),
				'param_holder_class' => 'vc_grid-data-type-not-ids',
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'order',
				'heading'     => esc_html__( 'Sort order', 'infinite-addons' ),
				'description' => esc_html__( 'Select sorting order.', 'infinite-addons' ),
				'value'       => array(
					esc_html__( 'Descending', 'infinite-addons' ) => 'DESC',
					esc_html__( 'Ascending', 'infinite-addons' )  => 'ASC',
				),
				'group'       => esc_html__( 'Data Settings', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom',
					),
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
					),
				),
				'param_holder_class' => 'vc_grid-data-type-not-ids',
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'offset',
				'heading'     => esc_html__( 'Offset', 'infinite-addons' ),
				'description' => esc_html__( 'Number of grid elements to displace or pass over.', 'infinite-addons' ),
				'group'       => esc_html__( 'Data Settings', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom',
					),
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
				),
				'dependency' => array(
					'element'            => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom',
					),
					'callback' => 'vc_grid_exclude_dependency_callback',
				),
				'param_holder_class' => 'vc_grid-data-type-not-ids',
			),
		);

		$this->params = array_merge( $general, $data );

		$this->add_extras();
	}
	
	protected function load_js_sc() {
		
		$args = array( 'no_js' );

		if( 'carousel-fullwidth' === $this->atts['style'] ){
			array_push( $args,
				'flickity',
				'ofi-polyfill'
			);
		}
		elseif( 'carousel' === $this->atts['style'] ) {
			array_push( $args,
				'flickity'
			);
		}

		return $args;

	}

	protected function get_substyle_class() {

		if ( empty( $this->atts['sub_style'] ) ) {
			return;
		}

		$substyle = $this->atts['sub_style'];

		$hash = array(
			'sb1' => 'latest-posts latest-default latest-title-md1 latest-bold-title latest-post-no-margin latest-border latest-meta',
			'sb2' => 'latest-posts latest-default latest-title-lg3 latest-post-no-margin latest-border latest-meta meta-sm4',
			'sb3' => 'latest-posts latest-default latest-bg-grey latest-meta meta-sm6',
		);

		return $hash[ $substyle ];
	}

	public function excerpt_lengh( $length ) {

		if( empty( $this->atts['post_excerpt_length'] ) ) {
			return $length;
		}
		return $this->atts['post_excerpt_length'];
	}

	public function excerpt_more( $more ) {

		if( empty( $this->atts['post_excerpt_length'] ) ) {
			return $more;
		}
		return '';

	}

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
				'offset'         => 0,
				'post_type'      => 'any',
				'orderby'        => 'post__in',
			);
		}
		else {
			$settings = array(
				'posts_per_page' => isset( $posts_per_page ) ? (int) $posts_per_page : 100,
				'offset'         => $offset,
				'orderby'        => $orderby,
				'order'          => $order,
				'meta_key'       => in_array( $orderby, array(
					'meta_value',
					'meta_value_num',
				) ) ? $meta_key : '',
				'post_type'      => $post_type,
				'post__not_in'   => wp_parse_id_list( $exclude ),
				'ignore_sticky_posts' => true,
				'no_found_rows'  => true
			);

			if ( $settings['posts_per_page'] < 1 ) {
				$settings['posts_per_page'] = 1000;
			}

			if ( ! empty( $taxonomies ) ) {
				$vc_taxonomies_types = get_taxonomies( array( 'public' => true ) );
				$terms = get_terms( array_keys( $vc_taxonomies_types ), array(
					'hide_empty' => false,
					'include'    => $taxonomies,
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

	protected function get_class( $id ) {

		$hash = array(
			'title-only' => ''
		);

		return !empty( $hash[ $id ] ) ? $hash[ $id ] : 'latest-posts';
	}
}
new RA_Latest_Posts;
