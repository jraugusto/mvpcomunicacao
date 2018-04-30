<?php
/**
* Shortcode Blog
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Blog extends RA_Shortcode {

	/**
	 * [$post_type description]
	 * @var string
	 */
	private $post_type = 'post';

	/**
	 * [$taxonomies description]
	 * @var array
	 */
	private $taxonomies = array( 'category', 'post_tag' );

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ra_blog';
		$this->title       = esc_html__( 'Blog', 'infinite-addons' );
		$this->icon        = 'icon-wpb-application-icon-large';
		$this->description = esc_html__( 'Posts listing', 'infinite-addons' );
		$this->scripts     = array( 'flickity', 'animation-gsap', 'packery-mode', 'ofi-polyfill', 'jquery-matchHeight', 'TweenMax', 'jquery-panr' );
		$this->styles      = array( 'theme-blog', 'rella-sc-media', 'rella-sc-button' );

		require_once vc_path_dir( 'CONFIG_DIR', 'grids/vc-grids-functions.php' );
		if ( 'vc_get_autocomplete_suggestion' === vc_request_param( 'action' ) || 'vc_edit_form' === vc_post_param( 'action' ) ) {
			add_filter( 'vc_autocomplete_'. $this->slug . '_include_callback', array( $this, 'include_field_search' ) ); // Get suggestion(find). Must return an array
			add_filter( 'vc_autocomplete_'. $this->slug . '_include_render', 'vc_include_field_render' ); // Render exact product. Must return an array (label,value)

			// Narrow data taxonomies
			add_filter( 'vc_autocomplete_'. $this->slug . '_taxonomies_callback', array( $this,'autocomplete_taxonomies_field_search' ) );
			add_filter( 'vc_autocomplete_'. $this->slug . '_taxonomies_render', 'vc_autocomplete_taxonomies_field_render' );

			// Narrow data taxonomies for exclude_filter
			add_filter( 'vc_autocomplete_'. $this->slug . '_exclude_callback', array( $this, 'exclude_field_search' ) ); // Get suggestion(find). Must return an array
			add_filter( 'vc_autocomplete_'. $this->slug . '_exclude_render', 'vc_exclude_field_render' ); // Render exact product. Must return an array (label,value)
		}
		
		add_action( 'pre_get_posts', array( $this, 'query_offset' ), 1 );
		add_filter( 'found_posts', array( $this, 'adjust_offset_pagination' ), 1, 2 );

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

		$url = rella_addons()->plugin_uri() . 'assets/img/sc-preview/blog/';

		$general = array(
			array(
				'type'       => 'select_preview',
				'heading'    => esc_html__( 'Style', 'infinite-addons' ),
				'param_name' => 'style',
				'value'      => array(

					array(
						'value' => 'classic-date-featured',
						'label' => esc_html__( 'Featured Date', 'infinite-addons' ),
						'image' => $url . 'classic-date-featured.png'
					),

					array(
						'label' => esc_html__( 'Featured Small Image', 'infinite-addons' ),
						'value' => 'featured-post-sm',
						'image' => $url . 'featured-sm.jpg'
					),

					array(
						'label' => esc_html__( 'Featured Image', 'infinite-addons' ),
						'value' => 'classic-image-large',
						'image' => $url . 'classic-img-lg.png'
					),
					
					array(
						'label' => esc_html__( 'Featured Large Image', 'infinite-addons' ),
						'value' => 'classic-image-large-alt',
						'image' => $url . 'featured-img-lg.jpg'
					),
					
					array(
						'label' => esc_html__( 'Featured Classic Image', 'infinite-addons' ),
						'value' => 'classic-image-featured-alt',
						'image' => $url . 'featured-img-sm.jpg'
					),

					array(
						'label' => esc_html__( 'Split', 'infinite-addons' ),
						'value' => 'classic-image-medium',
						'image' => $url . 'classic-img-md.png'
					),
					
					array(
						'label' => esc_html__( 'Split 2', 'infinite-addons' ),
						'value' => 'classic-image-medium-alt',
						'image' => $url . 'classic-img-md-alt.jpg'
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
						'label' => esc_html__( 'Masonry Creative', 'infinite-addons' ),
						'value' => 'masonry-creative',
						'image' => $url . 'masonry-creative.png'
					),

					array(
						'label' => esc_html__( 'No Image', 'infinite-addons' ),
						'value' => 'no-image',
						'image' => $url . 'no-img.png'
					),

					array(
						'label' => esc_html__( 'Puzzle', 'infinite-addons' ),
						'value' => 'puzzle',
						'image' => $url . 'puzzle.png'
					),

					array(
						'label' => esc_html__( 'Featured posts', 'infinite-addons' ),
						'value' => 'featured-posts',
						'image' => $url . 'featured.jpg',
					),
					
					array(
						'label' => esc_html__( 'Featured posts 2', 'infinite-addons' ),
						'value' => 'featured-posts-alt',
						'image' => $url . 'featured-2.jpg',
					),

					array(
						'label' => esc_html__( 'Shadow', 'infinite-addons' ),
						'value' => 'split',
						'image' => $url . 'split-half-content.png'
					),

					array(
						'label' => esc_html__( 'Timeline', 'infinite-addons' ),
						'value' => 'timeline',
						'image' => $url . 'timeline.png'
					),

					array(
						'label' => esc_html__( 'Title Featured', 'infinite-addons' ),
						'value' => 'featured-title',
						'image' => $url . 'title-featured.png'
					),

					array(
						'label' => esc_html__( 'Title Only', 'infinite-addons' ),
						'value' => 'only-title',
						'image' => $url . 'only-title.png'
					)
				),
				'description' => esc_html__( 'Select content type for your grid.', 'infinite-addons' ),
				'admin_label' => true,
				'save_always' => true,
			),
			
			array(
				'type'       => 'dropdown',
				'param_name' => 'grid_columns',
				'heading'    => esc_html__( 'Columns', 'infinite-addons' ),
				'value'      => array(
					'2 Columns' => '2',
					'3 Columns' => '3',
					'4 Columns' => '4',
				),
				'dependency' => array(
					'element' => 'style',
					'value'   => array( 'grid', 'classic-image-featured-alt' )
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'show_meta',
				'heading'     => esc_html__( 'Show Meta?', 'infinite-addons' ),
				'description' => esc_html__( 'Select yes to show tags or categories on post thumbnail', 'infinite-addons' ),
				'value'       => array(
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes',
					esc_html__( 'No', 'infinite-addons' ) => 'no'
				),
				'default' => 'yes',
				'edit_field_class' => 'vc_col-sm-4',
			),
			
			array(
				'type'        => 'dropdown',
				'param_name'  => 'meta_type',
				'heading'     => esc_html__( 'Meta Type', 'infinite-addons' ),
				'description' => esc_html__( 'Select what to show on post thumbnail', 'infinite-addons' ),
				'value'       => array(
					esc_html__( 'Tags', 'infinite-addons' ) => 'tags',
					esc_html__( 'Categories', 'infinite-addons' ) => 'cats'
				),
				'dependency'         => array(
					'element' => 'show_meta',
					'value'   => 'yes'
				),
				'default' => 'tags',
				'edit_field_class' => 'vc_col-sm-4',
			),
			
			array(
				'type'        => 'dropdown',
				'param_name'  => 'one_category',
				'heading'     => esc_html__( 'One category?', 'infinite-addons' ),
				'description' => esc_html__( 'Select yes to show one category in meta', 'infinite-addons' ),
				'value'       => array(
					esc_html__( 'Yes', 'infinite-addons' ) => 'yes',
					esc_html__( 'No', 'infinite-addons' ) => 'no'
				),
				'dependency'         => array(
					'element' => 'meta_type',
					'value'   => 'cats'
				),
				'default' => 'yes',
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Data source', 'infinite-addons' ),
				'param_name'  => 'post_type',
				'value'       => $this->get_post_type_list(),
				'save_always' => true,
				'description' => esc_html__( 'Select content type for your grid.', 'infinite-addons' ),
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Total items', 'infinite-addons' ),
				'param_name' => 'posts_per_page',
				'value'      => 10,
				// default value
				'param_holder_class' => 'vc_not-for-custom',
				'description'        => esc_html__( 'Set max limit for items in grid or enter -1 to display all (limited to 1000).', 'infinite-addons' ),
				'dependency'         => array(
					'element' => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom',
					),
				),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'post_excerpt_length',
				'heading'     => esc_html__( 'Excerpt Length', 'infinite-addons' ),
				'description' => esc_html__( 'Set the excerpt length or leave blank to set default 55 words', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'style',
					'value_not_equal_to' => array(
						'masonry-creative',
						'puzzle',
						'only-title'
					),
				),
				'edit_field_class' => 'vc_col-sm-4',
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
			),

			array(
				'type'        => 'autocomplete',
				'heading'     => esc_html__( 'Include only', 'infinite-addons' ),
				'param_name'  => 'include',
				'description' => esc_html__( 'Add posts, pages, etc. by title.', 'infinite-addons' ),
				'settings'    => array(
					'multiple' => true,
					'sortable' => true,
					'groups'   => true,
					'no_hide'  => true, // In UI after select doesn't hide an select list
				),
				'dependency'   => array(
					'element' => 'post_type',
					'value' => array( 'ids' ),
				),
			),

			// Custom query tab
			array(
				'type'        => 'textarea_safe',
				'heading'     => esc_html__( 'Custom query', 'infinite-addons' ),
				'param_name'  => 'custom_query',
				'description' => __( 'Build custom query according to <a href="http://codex.wordpress.org/Function_Reference/query_posts">WordPress Codex</a>.', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'post_type',
					'value' => array( 'custom' ),
				),
			),

			array(
				'type'       => 'autocomplete',
				'heading'    => esc_html__( 'Narrow data source', 'infinite-addons' ),
				'param_name' => 'taxonomies',
				'settings'   => array(
					'multiple'   => true,
					'min_length' => 3,
					'groups'     => true,
					'no_hide'    => true, // In UI after select doesn't hide an select list
					'unique_values'  => true,
					'display_inline' => true,
					'delay'      => 500,
					'auto_focus' => true,
				),
				'param_holder_class' => 'vc_not-for-custom',
				'description' => esc_html__( 'Enter categories, tags or custom taxonomies.', 'infinite-addons' ),
				'dependency'  => array(
					'element' => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom',
					),
				),
			),

			array(
				'type' => 'dropdown',
				'heading'    => esc_html__( 'Pagination Style', 'infinite-addons' ),
				'param_name' => 'pagination',
				'value' => array(
					esc_html__( 'None', 'infinite-addons' ) => 'none',
					esc_html__( 'Pagination', 'infinite-addons' ) => 'pagination',
					esc_html__( 'Ajax 1', 'infinite-addons' ) => 'ajax1',
					esc_html__( 'Ajax 2', 'infinite-addons' ) => 'ajax2',
					esc_html__( 'Ajax 3', 'infinite-addons' ) => 'ajax3',
					esc_html__( 'Ajax 4', 'infinite-addons' ) => 'ajax4',
					esc_html__( 'Ajax 5', 'infinite-addons' ) => 'ajax5',
					esc_html__( 'Ajax 6', 'infinite-addons' ) => 'ajax6',
				),
				'description' => esc_html__( 'Select pagination style.', 'infinite-addons' ),
			),

			array(
				'type' => 'textfield',
				'param_name' => 'ajax_label',
				'heading' => esc_html__( 'Ajax button label', 'infinite-addons' ),
				'std'     => 'Load More',
				'admin_label' => true,
				'dependency'  => array(
					'element' => 'pagination',
					'value_not_equal_to' => array(
						'none',
						'pagination'
					)
				)
			)
		);

		$data = array(
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Order by', 'infinite-addons' ),
				'param_name' => 'orderby',
				'value' => array(
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

				'description'        => esc_html__( 'Select order type. If "Meta value" or "Meta value Number" is chosen then meta key is required.', 'infinite-addons' ),
				'group'              => esc_html__( 'Data Settings', 'infinite-addons' ),
				'param_holder_class' => 'vc_grid-data-type-not-ids',
				'dependency'         => array(
					'element'            => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom'
					)
				)
			),

			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Sort order', 'infinite-addons' ),
				'param_name' => 'order',
				'group'      => esc_html__( 'Data Settings', 'infinite-addons' ),
				'value'      => array(
					esc_html__( 'Descending', 'infinite-addons' ) => 'DESC',
					esc_html__( 'Ascending', 'infinite-addons' ) => 'ASC',
				),
				'param_holder_class' => 'vc_grid-data-type-not-ids',
				'description'        => esc_html__( 'Select sorting order.', 'infinite-addons' ),
				'dependency'         => array(
					'element' => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom',
					)
				)
			),

			array(
				'type'               => 'textfield',
				'heading'            => esc_html__( 'Meta key', 'infinite-addons' ),
				'param_name'         => 'meta_key',
				'description'        => esc_html__( 'Input meta key for grid ordering.', 'infinite-addons' ),
				'group'              => esc_html__( 'Data Settings', 'infinite-addons' ),
				'param_holder_class' => 'vc_grid-data-type-not-ids',
				'dependency' => array(
					'element' => 'orderby',
					'value'   => array(
						'meta_value',
						'meta_value_num',
					)
				)
			),

			array(
				'type'           => 'textfield',
				'heading'        => esc_html__( 'Offset', 'infinite-addons' ),
				'param_name'     => 'offset',
				'description'    => esc_html__( 'Number of grid elements to displace or pass over.', 'infinite-addons' ),
				'group'          => esc_html__( 'Data Settings', 'infinite-addons' ),
				'param_holder_class' => 'vc_grid-data-type-not-ids',
				'dependency' => array(
					'element' => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom',
					)
				)
			),

			array(
				'type'        => 'autocomplete',
				'heading'     => esc_html__( 'Exclude', 'infinite-addons' ),
				'param_name'  => 'exclude',
				'description' => esc_html__( 'Exclude posts, pages, etc. by title.', 'infinite-addons' ),
				'group'       => esc_html__( 'Data Settings', 'infinite-addons' ),
				'settings' => array(
					'multiple' => true,
					'no_hide'  => true, // In UI after select doesn't hide an select list
				),
				'param_holder_class' => 'vc_grid-data-type-not-ids',
				'dependency'  => array(
					'element' => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom',
					),
					'callback' => 'vc_grid_exclude_dependency_callback'
				)
			),
			
			array(
				'type' => 'el_id',
				'settings' => array(
					'auto_generate' => true,
				),
				'heading'     => esc_html__( 'Unique ID', 'infinite-addons' ),
				'param_name'  => 'unique_id',
				'description' => esc_html__( 'Unique ID need for ajax load more posts functionality', 'infinite-addons' ),
				'group'       => esc_html__( 'Extras', 'infinite-addons' ),
			),
			
		);

		$this->params = array_merge( $general, $data );

		$this->add_extras();
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
				'post__in' => $incposts,
				'posts_per_page' => count( $incposts ),
				'post_type' => 'any',
				'orderby' => 'post__in',
			);
		}
		else {
			$settings = array(
				'posts_per_page' => isset( $posts_per_page ) ? (int) $posts_per_page : 100,
				'offset'         => $offset,
				'orderby' => $orderby,
				'order' => $order,
				'meta_key' => in_array( $orderby, array(
					'meta_value',
					'meta_value_num',
				) ) ? $meta_key : '',
				'post_type' => $post_type,
				'ignore_sticky_posts' => true,
			);

			if( $exclude ) {
				$settings['post__not_in'] = wp_parse_id_list( $exclude );
			}

			/*if( intval( $offset ) ) {
				$settings['no_found_rows'] = intval( $offset );
			}*/

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
							'field' => 'id',
							'terms' => array( $t->term_id ),
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
	
	public function query_offset( &$query ) {
		
		//Before anything else, make sure this is the right query...
		if ( ! $query->is_home() || empty( $this->atts['offset'] ) ) {
		    return;
		}

		$offset = $this->atts['offset'];
		$ppp = isset( $this->atts['posts_per_page'] ) ? (int) $this->atts['posts_per_page'] : 100;

		if ( $query->is_paged ) {
		    $page_offset = $offset + ( ( $query->query_vars['paged'] - 1 ) * $ppp );
			$query->set( 'offset', $page_offset );
		}
		else {		
			$query->set( 'offset', $offset );
		}
	}

	public function adjust_offset_pagination( $found_posts, $query ) {

		if ( empty( $this->atts['offset'] ) ) {
		    return $found_posts;
		}
		
		$offset = $this->atts['offset'];

		if ( $query->is_home() ) {
		    return $found_posts - $offset;
		}

		return $found_posts;
	}

	protected function entry_title() {

		$format = get_post_format();
		if ( 'link' !== $format && is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
			return;
		}

		$url = 'link' == $format ? rella_helper()->get_option( 'post-link-url' ) : get_permalink();

		the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( $url ) ), '</a></h2>' );
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
	
	public function clean_excerpt() {
		return false;
	}

	protected function entry_content() {

		if( !is_single() ) :

	?>
			<div class="entry-summary">
				<?php
					add_filter( 'excerpt_length', array( $this, 'excerpt_lengh' ), 999 );
					add_filter( 'excerpt_more', array( $this, 'excerpt_more' ) );
					add_filter( 'rella_dinamic_css_output', array( $this, 'clean_excerpt' ) );
					the_excerpt();
					remove_filter( 'rella_dinamic_css_output', array( $this, 'clean_excerpt' ) ); ?>
			</div>
		<?php else: ?>
			<div class="entry-content">
			<?php
				/* translators: %s: Name of current post */
				the_content( sprintf(
					__( 'Continue reading %s', 'infinite-addons' ),
					the_title( '<span class="screen-reader-text">', '</span>', false )
				) );

				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'infinite-addons' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'infinite-addons' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				) );
			?>
	    </div>
	<?php endif;

	}

	protected function entry_cats() {

		$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'infinite-addons' ) );

		if ( $categories_list ) {
			printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
				_x( 'Categories', 'Used before category names.', 'infinite-addons' ),
				$categories_list
			);
		}
	}

	protected function entry_tags( $html_tag = 'div' ) {
		
		$show_meta = $this->atts['show_meta'];
		if( 'no' === $show_meta ) {
			return;
		}

		$meta_type    = $this->atts['meta_type'];
		$one_category = $this->atts['one_category'];
		
		$tags_list = get_the_tag_list( '', '' );
		
		if( 'cats' === $meta_type ) {
			
			if( 'yes' === $one_category ) {				

				$categories_list = get_the_category();
				$tags_list = '';
				if( '' != $categories_list ) :
					$tags_list = '<a rel="category" href="' . esc_url( get_category_link( $categories_list[0]->term_id ) ) . '">' . esc_html( $categories_list[0]->name ) . '</a>';
				endif;
				
			} 
			else {
				$tags_list = get_the_category_list( ' ' );
			}
		}

		if ( $tags_list ) {
			printf( '<%3$s class="tags"><span class="screen-reader-text">%1$s </span>%2$s</%3$s>',
				_x( 'Tags', 'Used before tag names.', 'infinite-addons' ),
				$tags_list, $html_tag
			);
		}
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

		return ! empty( $hash[ $column ] ) ? sprintf( 'col-md-%s', $hash[ $column ] ) : 'col-md-6';
	}

	protected function entry_author( $avatar_size = false ) {

		$format = get_post_format();
		if ( 'link' === $format && !is_single() ) {
			return;
		}

		$avatar = '';
		$style = $this->atts['style'];

		if( $avatar_size ) {
			$avatar = get_avatar( get_the_author_meta( 'user_email' ), $avatar_size );
		}

		if( 'no-image' === $style ) {
			printf( '<figure class="avatar">%s</figure>', $avatar );
			$avatar = '';
		}

		printf( '<span class="author vcard"><span class="screen-reader-text">%1$s </span><a class="url fn n" href="%2$s">%4$s%3$s</a></span>',
			_x( 'Author', 'Used before post author name.', '_' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			get_the_author(),
			$avatar
		);
	}

	protected function entry_time_to_read() {

		$time_to_read = rella_helper()->get_option( 'post-time-read' );
		if( empty( $time_to_read ) ) {
			return;
		}

		printf( '<span class="post-time-read"><i class="fa fa-book"></i> %s</span>',
				esc_html( $time_to_read )
		);

	}

	protected function entry_comments() {

		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments">';
			comments_popup_link( __( '<i class="fa fa-comment"></i>No Opinions', 'infinite-addons' ), __( '<i class="fa fa-comment"></i>1 Opinion', 'infinite-addons' ), __( '<i class="fa fa-comment"></i>% Opinions', 'infinite-addons' ) );
			echo '</span>';
		}
	}

	protected function enable_parallax() {

		$parallax = isset( $this->atts['enable_parallax'] ) ? $this->atts['enable_parallax'] : '';

		if( 'no' === $parallax ) {
			return;
		}

		return ' data-parallax-bg="true"';
	}

	protected function entry_thumbnail( $size = 'post-thumbnail', $attr = '' ) {

		if ( post_password_required() || is_attachment() ) {
			return;
		}

		$format = get_post_format();
		$style = $this->atts['style'];
		$parallax = isset( $this->atts['enable_parallax'] ) ? $this->atts['enable_parallax'] : '';

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

						if( in_array( $style, array( 'grid', 'masonry', 'masonry-creative' ) ) ) {
							echo '<div class="carousel-items">';
						} else {
							echo '<div class="carousel-items js-flickity" data-flickity-options=\'{ "adaptiveHeight": true, "pageDots": false }\'>';
						}
						foreach ( $gallery as $item ) {

							if ( isset ( $item['attachment_id'] ) ) {
								$retina_image = wp_get_attachment_image_src( $item['attachment_id'], 'full' );
								$retina_src = $retina_image[0];
								
								if( empty( $retina_src ) ) {
									$retina_src = $item['image'];
								}

								if( 'no' === $parallax ){

									$image = wp_get_attachment_image( $item['attachment_id'], 'full', false, array( 'alt' => esc_attr( $item['title'] ), 'data-rjs' => $retina_src ) );
									if( ! $image ) {
										$image = '<img src="' . esc_url( $item['image'] ) . '" alt="' . esc_attr( $item['title'] ) . '" />';
									}
									printf( '<div class="col-xs-12 no-padding">%s</div>', $image );

								} else {
									
									if( rella_helper()->get_option( 'enable-lazy-load' ) ) {
										$image_src = wp_get_attachment_image_src( $item['attachment_id'], 'full' );
										$get_small_image_src = rella_get_the_small_image( $image_src[0] );
										if( ! $image_src ) {
											$image_src = $get_small_image_src = $item['image'];
										}
									} else {
										$image_src = wp_get_attachment_image_src( $item['attachment_id'], 'full' );
										$get_small_image_src = $image_src[0];
										if( ! $image_src ) {
											$image_src = $get_small_image_src = $item['image'];
										}										
									}

									$image = wp_get_attachment_image( $item['attachment_id'], 'full', false, array( 'alt' => esc_attr( $item['title'] ), 'data-rjs' => $retina_src ) );
									if( ! $image ) {
										$image = '<img src="' . esc_url( $item['image'] ) . '" alt="' . esc_attr( $item['title'] ) . '" />';
									}

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

		elseif( has_post_thumbnail() ) {
				echo '<a class="entry-link" href="' . get_permalink() . '"></a>';
				if( 'no' === $parallax ){
					echo '<figure>';
					rella_the_post_thumbnail( $size, $attr, true );
				} else {
					if( rella_helper()->get_option( 'enable-lazy-load' ) ) {
						$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
						$resized_image = rella_get_resized_image_src( $image_src, $size );
						$url = rella_get_the_small_image( $resized_image );
					} else {
						$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
						$resized_image = rella_get_resized_image_src( $image_src, $size );
						$url = $resized_image;
					}
					printf( '<figure style="background-image: url(%s);"%s>', $url, $this->enable_parallax() );
					rella_the_post_thumbnail( $size, $attr, true );
				}
			echo '</figure>';
		}
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
	function exclude_field_search( $data_arr ) {

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
			'search' => $search_string,
		) );
		if ( is_array( $vc_taxonomies ) && ! empty( $vc_taxonomies ) ) {
			foreach ( $vc_taxonomies as $t ) {
				if ( is_object( $t ) ) {
					$data[] = vc_get_term_object( $t );
				}
			}
		}

		return $data;
	}

	protected function get_class( $id ) {

		$hash = array(
			'classic-date-featured'      => 'post-date-featured',
			'classic-image-large-alt'    => 'post-image-large-alt featured',
			'classic-image-featured-alt' => 'post-image-large-alt',
			'classic-image-medium'       => 'post-img-medium',
			'classic-image-medium-alt'   => 'post-img-medium post-img-medium-alt',
			'grid'                  => 'post-grid',
			'no-image'              => 'post-no-image',
			'featured-posts'        => 'post-featured',
			'featured-posts-alt'    => 'post-featured-alt',
			'featured-post-sm'      => 'post-featured-small',
			'featured-title'        => 'post-title-featured',
			'masonry'               => 'post-grid post-masonry',
			'masonry-creative'      => 'post-masonry-alt',
			'only-title'            => 'post-only-title',
			'puzzle'                => 'post-puzzle',
			'timeline'              => 'post-timeline',
			'split'                 => 'post-half-content'
		);

		return !empty( $hash[ $id ] ) ? $hash[ $id ] : '';
	}
}
new RA_Blog;
