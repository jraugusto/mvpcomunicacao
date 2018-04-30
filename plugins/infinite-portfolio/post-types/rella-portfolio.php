<?php
/**
* Post Type: Portfolios
* Register Custom Post Type
*/

$portfolio_slug = 'portfolio';
$portfolio_cat_slug = 'portfolio-category';

if( function_exists( 'rella_helper' ) ) {
	$custom_portfolio_slug = rella_helper()->get_option( 'portfolio-single-slug' );
	if( ! empty( $custom_portfolio_slug ) ) {
		$portfolio_slug = esc_attr( $custom_portfolio_slug );
	}
	$custom_portfolio_cat_slug = rella_helper()->get_option( 'portfolio-category-slug' );
	if( ! empty( $custom_portfolio_cat_slug ) ) {
		$portfolio_cat_slug = esc_attr( $custom_portfolio_cat_slug );
	}
}

$labels = array(
	'name'                  => _x( 'Portfolios', 'Post Type General Name', 'infinite-portfolio' ),
	'singular_name'         => _x( 'Portfolio', 'Post Type Singular Name', 'infinite-portfolio' ),
	'menu_name'             => __( 'Portfolio items', 'infinite-portfolio' ),
	'name_admin_bar'        => __( 'Portfolio item', 'infinite-portfolio' ),
	'archives'              => __( 'Portfolio item Archives', 'infinite-portfolio' ),
	'parent_item_colon'     => __( 'Parent Item:', 'infinite-portfolio' ),
	'all_items'             => __( 'All Items', 'infinite-portfolio' ),
	'add_new_item'          => __( 'Add New Portfolio', 'infinite-portfolio' ),
	'add_new'               => __( 'Add New', 'infinite-portfolio' ),
	'new_item'              => __( 'New Portfolio', 'infinite-portfolio' ),
	'edit_item'             => __( 'Edit Portfolio', 'infinite-portfolio' ),
	'update_item'           => __( 'Update Portfolio', 'infinite-portfolio' ),
	'view_item'             => __( 'View Portfolio', 'infinite-portfolio' ),
	'search_items'          => __( 'Search Portfolios', 'infinite-portfolio' ),
	'not_found'             => __( 'Not found', 'infinite-portfolio' ),
	'not_found_in_trash'    => __( 'Not found in Trash', 'infinite-portfolio' ),
	'featured_image'        => __( 'Featured Image', 'infinite-portfolio' ),
	'set_featured_image'    => __( 'Set featured image', 'infinite-portfolio' ),
	'remove_featured_image' => __( 'Remove featured image', 'infinite-portfolio' ),
	'use_featured_image'    => __( 'Use as featured image', 'infinite-portfolio' ),
	'insert_into_item'      => __( 'Insert into Portfolio', 'infinite-portfolio' ),
	'uploaded_to_this_item' => __( 'Uploaded to this Portfolio', 'infinite-portfolio' ),
	'items_list'            => __( 'Items list', 'infinite-portfolio' ),
	'items_list_navigation' => __( 'Items list navigation', 'infinite-portfolio' ),
	'filter_items_list'     => __( 'Filter items list', 'infinite-portfolio' ),
);
$rewrite = array(
	'slug'                  => $portfolio_slug,
	'with_front'            => true,
	'pages'                 => true,
	'feeds'                 => false,
);
$args = array(
	'label'                 => __( 'Portfolio', 'infinite-portfolio' ),
	'labels'                => $labels,
	'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'post-formats', 'rella-post-likes' ),
	'hierarchical'          => false,
	'public'                => true,
	'show_ui'               => true,
	'show_in_menu'          => true,
	'menu_position'         => 25.3,
	'menu_icon'             => 'dashicons-format-image',
	'show_in_admin_bar'     => true,
	'show_in_nav_menus'     => false,
	'can_export'            => true,
	'has_archive'           => 'portfolios',
	'exclude_from_search'   => false,
	'publicly_queryable'    => true,
	'query_var'             => 'portfolios',
	'rewrite'               => $rewrite,
	'capability_type'       => 'page',
);
register_post_type( 'rella-portfolio', $args );

/**
 * Taxonomy: Portfolio Category
 * Register Custom Taxonomy
 */
$labels = array(
	'name'                       => _x( 'Portfolio Categories', 'Taxonomy General Name', 'infinite-portfolio' ),
	'singular_name'              => _x( 'Portfolio Category', 'Taxonomy Singular Name', 'infinite-portfolio' ),
	'menu_name'                  => __( 'Categories', 'infinite-portfolio' ),
	'all_items'                  => __( 'All Categories', 'infinite-portfolio' ),
	'parent_item'                => __( 'Parent Category', 'infinite-portfolio' ),
	'parent_item_colon'          => __( 'Parent Category:', 'infinite-portfolio' ),
	'new_item_name'              => __( 'New Category Name', 'infinite-portfolio' ),
	'add_new_item'               => __( 'Add New Category', 'infinite-portfolio' ),
	'edit_item'                  => __( 'Edit Category', 'infinite-portfolio' ),
	'update_item'                => __( 'Update Category', 'infinite-portfolio' ),
	'view_item'                  => __( 'View Category', 'infinite-portfolio' ),
	'separate_items_with_commas' => __( 'Separate Categories with commas', 'infinite-portfolio' ),
	'add_or_remove_items'        => __( 'Add or remove Categories', 'infinite-portfolio' ),
	'choose_from_most_used'      => __( 'Choose from the most used', 'infinite-portfolio' ),
	'popular_items'              => __( 'Popular Categories', 'infinite-portfolio' ),
	'search_items'               => __( 'Search Categories', 'infinite-portfolio' ),
	'not_found'                  => __( 'Not Found', 'infinite-portfolio' ),
	'no_terms'                   => __( 'No Categories', 'infinite-portfolio' ),
	'items_list'                 => __( 'Items list', 'infinite-portfolio' ),
	'items_list_navigation'      => __( 'Items list navigation', 'infinite-portfolio' ),
);
$rewrite = array(
	'slug'                       => $portfolio_cat_slug,
	'with_front'                 => true,
	'hierarchical'               => false,
);
$args = array(
	'labels'                     => $labels,
	'hierarchical'               => true,
	'public'                     => true,
	'show_ui'                    => true,
	'show_admin_column'          => true,
	'show_in_nav_menus'          => false,
	'show_tagcloud'              => true,
	'query_var'                  => 'portfolio-category',
	'rewrite'                    => $rewrite,
);
register_taxonomy( 'rella-portfolio-category', array( 'rella-portfolio' ), $args );
register_taxonomy_for_object_type( 'post_format', 'rella-portfolio' );

/**
 * Adjust Post Type
 */
add_action( 'load-post.php','rella_portfolio_adjust_post_formats' );
add_action( 'load-post-new.php','rella_portfolio_adjust_post_formats' );
/**
 * [rella_portfolio_adjust_post_formats description]
 * @method rella_portfolio_adjust_post_formats
 * @return [type]                              [description]
 */
function rella_portfolio_adjust_post_formats() {
	if( isset( $_GET['post'] ) ) {
		$post = get_post( $_GET['post'] );
		if ( $post ) {
			$post_type = $post->post_type;
		}
	}
	elseif ( !isset($_GET['post_type']) ) {
		$post_type = 'post';
	}
	elseif ( in_array( $_GET['post_type'], get_post_types( array( 'show_ui' => true ) ) ) ) {
		$post_type = $_GET['post_type'];
	}
	else {
		return; // Page is going to fail anyway
	}

	if ( 'rella-portfolio' == $post_type ) {
		add_theme_support( 'post-formats', array(
			'audio', 'gallery', 'video'
		) );
	}
}
