<?php

/**
 * Post Type: FAQ
 * Register Custom Post Type
 */
$labels = array(
	'name'                  => _x( 'FAQs', 'Post Type General Name', 'infinite-addons' ),
	'singular_name'         => _x( 'FAQs', 'Post Type Singular Name', 'infinite-addons' ),
	'menu_name'             => __( 'FAQs', 'infinite-addons' ),
	'name_admin_bar'        => __( 'FAQs', 'infinite-addons' ),
	'archives'              => __( 'FAQs Archives', 'infinite-addons' ),
	'parent_item_colon'     => __( 'Parent FAQs:', 'infinite-addons' ),
	'all_items'             => __( 'All FAQs', 'infinite-addons' ),
	'add_new_item'          => __( 'Add New FAQ', 'infinite-addons' ),
	'add_new'               => __( 'Add New', 'infinite-addons' ),
	'new_item'              => __( 'New FAQ', 'infinite-addons' ),
	'edit_item'             => __( 'Edit FAQ', 'infinite-addons' ),
	'update_item'           => __( 'Update FAQ', 'infinite-addons' ),
	'view_item'             => __( 'View FAQ', 'infinite-addons' ),
	'search_items'          => __( 'Search FAQs', 'infinite-addons' ),
	'not_found'             => __( 'Not found', 'infinite-addons' ),
	'not_found_in_trash'    => __( 'Not found in Trash', 'infinite-addons' ),
	'featured_image'        => __( 'Featured Image', 'infinite-addons' ),
	'set_featured_image'    => __( 'Set featured image', 'infinite-addons' ),
	'remove_featured_image' => __( 'Remove featured image', 'infinite-addons' ),
	'use_featured_image'    => __( 'Use as featured image', 'infinite-addons' ),
	'insert_into_item'      => __( 'Insert into item', 'infinite-addons' ),
	'uploaded_to_this_item' => __( 'Uploaded to this item', 'infinite-addons' ),
	'items_list'            => __( 'Items list', 'infinite-addons' ),
	'items_list_navigation' => __( 'Items list navigation', 'infinite-addons' ),
	'filter_items_list'     => __( 'Filter items list', 'infinite-addons' ),
);
$rewrite = array(
	'slug'                  => 'faqs',
	'with_front'            => true,
	'pages'                 => true,
	'feeds'                 => false,
);
$args = array(
	'label'                 => __( 'FAQs', 'infinite-addons' ),
	'description'           => __( 'Post Type Description', 'infinite-addons' ),
	'labels'                => $labels,
	'supports'              => array( 'title', 'editor', ),
	'hierarchical'          => false,
	'public'                => true,
	'show_ui'               => true,
	'show_in_menu'          => true,
	'menu_position'         => 25.5,
	'menu_icon'             => 'dashicons-editor-help',
	'show_in_admin_bar'     => false,
	'show_in_nav_menus'     => false,
	'can_export'            => true,
	'has_archive'           => 'faqs',
	'exclude_from_search'   => true,
	'publicly_queryable'    => true,
	'query_var'             => 'faqs',
	'rewrite'               => $rewrite,
	'capability_type'       => 'page',
);
register_post_type( 'rella-faqs', $args );

/**
 * Taxonomy: FAQ Category
 * Register Custom Taxonomy
 */
$labels = array(
	'name'                       => _x( 'FAQ Categories', 'Taxonomy General Name', 'infinite-addons' ),
	'singular_name'              => _x( 'FAQ Category', 'Taxonomy Singular Name', 'infinite-addons' ),
	'menu_name'                  => __( 'Categories', 'infinite-addons' ),
	'all_items'                  => __( 'All Categories', 'infinite-addons' ),
	'parent_item'                => __( 'Parent Category', 'infinite-addons' ),
	'parent_item_colon'          => __( 'Parent Category:', 'infinite-addons' ),
	'new_item_name'              => __( 'New Category Name', 'infinite-addons' ),
	'add_new_item'               => __( 'Add New Category', 'infinite-addons' ),
	'edit_item'                  => __( 'Edit Category', 'infinite-addons' ),
	'update_item'                => __( 'Update Category', 'infinite-addons' ),
	'view_item'                  => __( 'View Category', 'infinite-addons' ),
	'separate_items_with_commas' => __( 'Separate Categories with commas', 'infinite-addons' ),
	'add_or_remove_items'        => __( 'Add or remove Categories', 'infinite-addons' ),
	'choose_from_most_used'      => __( 'Choose from the most used', 'infinite-addons' ),
	'popular_items'              => __( 'Popular Categories', 'infinite-addons' ),
	'search_items'               => __( 'Search Categories', 'infinite-addons' ),
	'not_found'                  => __( 'Not Found', 'infinite-addons' ),
	'no_terms'                   => __( 'No Categories', 'infinite-addons' ),
	'items_list'                 => __( 'Items list', 'infinite-addons' ),
	'items_list_navigation'      => __( 'Items list navigation', 'infinite-addons' ),
);
$rewrite = array(
	'slug'                       => 'faq-category',
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
	'query_var'                  => 'faq-category',
	'rewrite'                    => $rewrite,
);
register_taxonomy( 'rella-faq-category', array( 'rella-faqs' ), $args );
