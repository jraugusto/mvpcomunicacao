<?php

/**
 * Post Type: Team Member
 * Register Custom Post Type
 */
$labels = array(
	'name'                  => _x( 'Team Members', 'Post Type General Name', 'infinite-addons' ),
	'singular_name'         => _x( 'Team Members', 'Post Type Singular Name', 'infinite-addons' ),
	'menu_name'             => __( 'Team Members', 'infinite-addons' ),
	'name_admin_bar'        => __( 'Team Members', 'infinite-addons' ),
	'archives'              => __( 'Team Members Archives', 'infinite-addons' ),
	'parent_item_colon'     => __( 'Parent Team Members:', 'infinite-addons' ),
	'all_items'             => __( 'All Team Members', 'infinite-addons' ),
	'add_new_item'          => __( 'Add New Team Member', 'infinite-addons' ),
	'add_new'               => __( 'Add New', 'infinite-addons' ),
	'new_item'              => __( 'New Team Member', 'infinite-addons' ),
	'edit_item'             => __( 'Edit Team Member', 'infinite-addons' ),
	'update_item'           => __( 'Update Team Member', 'infinite-addons' ),
	'view_item'             => __( 'View Team Member', 'infinite-addons' ),
	'search_items'          => __( 'Search Team Members', 'infinite-addons' ),
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
	'slug'                  => 'team-members',
	'with_front'            => true,
	'pages'                 => true,
	'feeds'                 => false,
);
$args = array(
	'label'                 => __( 'Team Members', 'infinite-addons' ),
	'description'           => __( 'Post Type Description', 'infinite-addons' ),
	'labels'                => $labels,
	'supports'              => array( 'title', 'thumbnail', 'editor', ),
	'hierarchical'          => false,
	'public'                => true,
	'show_ui'               => true,
	'show_in_menu'          => true,
	'menu_position'         => 25.4,
	'menu_icon'             => 'dashicons-businessman',
	'show_in_admin_bar'     => false,
	'show_in_nav_menus'     => false,
	'can_export'            => true,
	'has_archive'           => 'team-members',
	'exclude_from_search'   => true,
	'publicly_queryable'    => true,
	'query_var'             => 'team-members',
	'rewrite'               => $rewrite,
	'capability_type'       => 'page',
);
register_post_type( 'rella-team-members', $args );

/**
 * Taxonomy: Team Member Category
 * Register Custom Taxonomy
 */
$labels = array(
	'name'                       => _x( 'Team Member Categories', 'Taxonomy General Name', 'infinite-addons' ),
	'singular_name'              => _x( 'Team Member Category', 'Taxonomy Singular Name', 'infinite-addons' ),
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
	'slug'                       => 'team-category',
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
	'query_var'                  => 'team-category',
	'rewrite'                    => $rewrite,
);
register_taxonomy( 'rella-team-category', array( 'rella-team-members' ), $args );
