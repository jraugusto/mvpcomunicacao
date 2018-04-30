<?php
/**
* Shortcode Portfolio
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class RA_Portfolio extends RA_Shortcode {

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
		$this->slug        = 'ra_portfolio';
		$this->title       = esc_html__( 'Featured Works', 'infinite-addons' );
		$this->description = esc_html__( 'Create portfolio short listing (Use on homepages)', 'infinite-addons' );
		$this->icon        = 'fa fa-briefcase';
		$this->scripts     = array( 'magnific-popup', 'flickity', 'packery-mode', 'ofi-polyfill', 'jquery-matchHeight', 'StackBlur' );
		$this->styles      = array( 'theme-portfolio', 'rella-sc-portfolio', 'rella-sc-image-comparison' );

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

	public function get_params() {

		$url = rella_addons()->plugin_uri() . '/assets/img/sc-preview/portfolio/';

		$this->params = array(

			array(
				'type'       => 'select_preview',
				'param_name' => 'template',
				'heading'    => esc_html__( 'Style', 'infinite-addons' ),
				'value'      => array(

					array(
						'value' => 'default',
						'label' => esc_html__( 'Default', 'infinite-addons' ),
						'image' => $url . 'default.png'
					),

					array(
						'label' => esc_html__( 'Classic', 'infinite-addons' ),
						'value' => 'classic',
						'image' => $url . 'classic.png'
					),

					array(
						'label' => esc_html__( 'Elegant', 'infinite-addons' ),
						'value' => 'elegant',
						'image' => $url . 'elegant.png'
					),

					array(
						'label' => esc_html__( 'Masonry', 'infinite-addons' ),
						'value' => 'masonry',
						'image' => $url . 'masonry.png'
					),

					array(
						'label' => esc_html__( 'No gap', 'infinite-addons' ),
						'value' => 'no-gap',
						'image' => $url . 'no-gap.png'
					),

					array(
						'label' => esc_html__( 'Simple', 'infinite-addons' ),
						'value' => 'simple',
						'image' => $url . 'simple.png'
					)
				),
				'admin_label' => true,
				'save_always' => true,				
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
				'param_holder_class' => 'vc_not-for-custom',
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'columns',
				'heading'     => esc_html__( 'Portfolio columns', 'infinite-addons' ),
				'description' => esc_html__( 'Select how many columns to show per row', 'infinite-addons' ),
				'value'       => array(
					esc_html__( '3 Columns' ) => 'col-md-4 col-sm-12 col-xs-12',
					esc_html__( '4 Columns' ) => 'col-md-3 col-sm-6 col-xs-12'
				),
				'dependency'  => array(
					'element' => 'template',
					'value'   => 'classic'
				)
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
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'autocomplete',
				'param_name'  => 'filter_cats',
				'heading'     => esc_html__( 'Categories', 'infinite-addons' ),
				'description' => esc_html__( 'Enter categories to display in filter bar.', 'infinite-addons' ),
				'settings'    => array(
					'multiple'       => true,
					'min_length'     => 1,
					'groups'         => true,
					'sortable'       => true,
					'no_hide'        => true, // In UI after select doesn't hide an select list
					'unique_values'  => true,
					'display_inline' => true,
					'delay'          => 500,
					'auto_focus'     => true,
				),
				'param_holder_class' => 'vc_not-for-custom',
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'filter_align',
				'heading'     => esc_html__( 'Filter alignment', 'infinite-addons' ),
				'description' => esc_html__( 'Select filter items alignment', 'infinite-addons' ),
				'value' => array(
					esc_html__( 'Center', 'infinite-addons' ) => 'text-center',
					esc_html__( 'Left', 'infinite-addons' )   => 'text-left',
					esc_html__( 'Right', 'infinite-addons' )  => 'text-right'
				),
				'dependency'  => array(
					'element' => 'show_filter',
					'value'   => 'yes'
				),
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'posts_per_page',
				'heading'     => esc_html__( 'How many posts to show', 'infinite-addons' ),
				'description' => esc_html__( 'How many posts do you want to show?', 'infinite-addons' ),
				'admin_label' => true
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'exclude_posts',
				'heading'     => esc_html__( 'Exclude posts', 'infinite-addons' ),
				'description' => esc_html__( 'Post IDs you want to exclude, separated by commas eg. 120, 123, 1005', 'infinite-addons' ),
				'admin_label' => true
			),

		);

		$this->add_extras();
	}

	protected function get_style( $style ) {

		$hash = array(
			'classic' => 'portfolio-classic',
			'simple'  => 'portfolio-simple',
			'elegant' => 'portfolio-elegant elegant-filters',
			'flat'    => 'portfolio-flat outline-filters',
			'fold'    => 'portfolio-fold boxed-filters',
			'masonry' => 'portfolio-masonry text-center',
			'no-gap'  => 'portfolio-no-gap outline-filters'
		);

		return !empty( $hash[ $style ] ) ? $hash[ $style ] : 'portfolio-default boxed-filters';
	}

	protected function get_filter( $grid_id, $class = 'list-unstyled list-inline text-uppercase text-center' ) {

		//check filter
		if ( ! $this->atts['show_filter'] ) {
			return '';
		}

		$falign = $this->atts['filter_align'];

		$filter_args = array(
			'style'    => 'none',
			'taxonomy' => 'rella-portfolio-category',
			'walker'   => new Rella_Walker_Portfolio_List_Categories(),
		);

		$filter_cats = ! empty( $this->atts['filter_cats'] ) ? $this->atts['filter_cats'] : false;

		$exp_cats = explode( ',', $filter_cats );
		$new_cats = array();

		if( $exp_cats[0] != '') { //Stop here if the user didn't select custom category 
			foreach ( $exp_cats as $cat_value ) {
				$term = get_term_by( 'slug', $cat_value, 'rella-portfolio-category' ); // Since wp_list_categories() require ids only

				$has_children = get_term_children( intval( $term->term_id ), 'rella-portfolio-category' );

				if( ! empty( $has_children ) ) {
						$new_cats[] = implode( ',', $has_children );
				} else {
					$new_cats[] = $term->term_id;
				}
			}
	    }

		$filter_args['include'] = implode( ',', $new_cats );

?>
		<div class="masonry-filters" data-target="#<?php echo $grid_id; ?>">
			<ul class="<?php echo $class; ?> <?php echo $falign; ?>">
				<li data-filter="*" class="active"><span><?php esc_html_e( 'All projects', 'infinite-addons' ); ?></span></li>
				<?php wp_list_categories( $filter_args ); ?>
			</ul>
		</div>
<?php
	}

	protected function get_col_size( $size ) {

		$hash =  array(
			'rella-portfolio'          => 'col-md-3 col-sm-6 col-xs-12',
			'rella-portfolio-sq'       => 'col-md-3 col-sm-6 col-xs-12',
			'rella-portfolio-big-sq'   => 'col-md-6 col-sm-12 col-xs-12',
			'rella-portfolio-portrait' => 'col-md-3 col-sm-6 col-xs-12',
			'rella-portfolio-wide'     => 'col-md-6 col-sm-12 col-xs-12',

			'rella-full-3'             => 'col-md-3 col-sm-6 col-xs-12',
			'rella-full-4'             => 'col-md-4 col-sm-12 col-xs-12',
			'rella-full-6'             => 'col-md-6 col-sm-12 col-xs-12',
			'rella-full-8'             => 'col-md-8 col-sm-12 col-xs-12',

		);


		return !empty( $hash[ $size ] ) ? $hash[ $size ] : 'col-md-4';

	}

	protected function get_data_plugin() {

		if ( empty( $this->atts['show_filter'] ) ) {
			return '';
		}

		echo 'data-plugin-portfolio="true"';
	}

	protected function get_terms_class() {

		$data    = array( 'term_ids' => array() );
		$terms   = wp_get_post_terms( get_the_ID(), 'rella-portfolio-category', $args = array() );

		if( empty( $terms ) || is_wp_error( $terms ) ) {
			return $data;
		}

		foreach ( $terms as $term ) {
			$data['term_ids'][] = 'portfolio_cat-' . $term->term_id;
		}

		$tax_classes = implode( ' ', $data['term_ids'] );
		return $tax_classes;
	}
	
	protected function entry_like() {
		
		if( function_exists( 'rella_likes_button' ) ) {
			rella_likes_button( array(
				'container_class' => 'portfolio-likes',
				'format' => wp_kses_post( __( '<span><i class="fa fa-heart"></i> <span class="post-likes-count">%s</span></span>', 'infinite-addons' ) )
			) );
		}

	}
	
	/**
	 * [entry_lightbox description]
	 * @method entry_lightbox
	 * @return [type]         [description]
	 */
	protected function entry_lightbox() {

		$url   = wp_get_attachment_url( get_post_thumbnail_id(), 'full' );
		$style = $this->atts['template'];
		
		if( 'simple' === $style ){
			printf( '<a href="%s" data-type="image" class="btn lighbox-link"><span>+</span></a>', $url );
			return;
		}
		elseif ( 'elegant' === $style ) {
			printf( '<a href="%s" data-type="image" class="btn lightbox-link"><span class="fa fa-arrows-alt"></span></a>', $url );
			return;
		}

		return;

	}

	// AJAX Helpers ------------------------------------------------

	/**
	 * @param $search_string
	 *
	 * @return array
	 */
	public function include_field_search( $search_string ) {
		$query = $search_string;
		$data  = array();
		$args  = array(
			's'         => $query,
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

	function render_autocomplete_field( $term ) {
		return ra_helper()->vc_autocomplete_taxonomies_field_render($term, 'rella-portfolio-category');
	}

}
new RA_Portfolio;