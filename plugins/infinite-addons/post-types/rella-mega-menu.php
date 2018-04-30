<?php

/**
 * Post Type: Mega Menu
 * Register Custom Post Type
 */

$labels = array(
	'name'                  => _x( 'Mega Menus', 'Post Type General Name', 'infinite-addons' ),
	'singular_name'         => _x( 'Mega Menu', 'Post Type Singular Name', 'infinite-addons' ),
	'menu_name'             => __( 'Mega Menus', 'infinite-addons' ),
	'name_admin_bar'        => __( 'Mega Menus', 'infinite-addons' ),
	'archives'              => __( 'Item Archives', 'infinite-addons' ),
	'parent_item_colon'     => __( 'Parent Item:', 'infinite-addons' ),
	'all_items'             => __( 'All Items', 'infinite-addons' ),
	'add_new_item'          => __( 'Add New Mega Menu', 'infinite-addons' ),
	'add_new'               => __( 'Add New', 'infinite-addons' ),
	'new_item'              => __( 'New Mega Menu', 'infinite-addons' ),
	'edit_item'             => __( 'Edit Mega Menu', 'infinite-addons' ),
	'update_item'           => __( 'Update Mega Menu', 'infinite-addons' ),
	'view_item'             => __( 'View Mega Menu', 'infinite-addons' ),
	'search_items'          => __( 'Search Mega Menu', 'infinite-addons' ),
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
$args = array(
	'label'                 => __( 'Mega Menu', 'infinite-addons' ),
	'labels'                => $labels,
	'supports'              => array( 'title', 'editor', 'revisions', ),
	'hierarchical'          => false,
	'public'                => true,
	'show_ui'               => true,
	'show_in_menu'          => true,
	'menu_position'         => 25,
	'menu_icon'             => 'dashicons-align-center',
	'show_in_admin_bar'     => true,
	'show_in_nav_menus'     => false,
	'can_export'            => true,
	'has_archive'           => false,
	'exclude_from_search'   => true,
	'publicly_queryable'    => false,
	'rewrite'               => false,
	'capability_type'       => 'page',
);
register_post_type( 'rella-mega-menu', $args );
