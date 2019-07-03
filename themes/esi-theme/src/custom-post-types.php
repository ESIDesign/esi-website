<?php

function case_study() {

  $labels = array(
    'name'                  => _x( 'Case Studies', 'Post Type General Name', 'text_domain' ),
    'singular_name'         => _x( 'Case Study', 'Post Type Singular Name', 'text_domain' ),
    'menu_name'             => __( 'Case Studies', 'text_domain' ),
    'name_admin_bar'        => __( 'Case Study', 'text_domain' ),
    'archives'              => __( 'Case Studies', 'text_domain' ),
    'attributes'            => __( 'Item Attributes', 'text_domain' ),
    'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
    'all_items'             => __( 'All Case Studies', 'text_domain' ),
    'add_new_item'          => __( 'Add Case Study', 'text_domain' ),
    'add_new'               => __( 'Add New', 'text_domain' ),
    'new_item'              => __( 'New Case Study', 'text_domain' ),
    'edit_item'             => __( 'Edit Case Study', 'text_domain' ),
    'update_item'           => __( 'Update Case Study', 'text_domain' ),
    'view_item'             => __( 'View Case Study', 'text_domain' ),
    'view_items'            => __( 'View Case Studies', 'text_domain' ),
    'search_items'          => __( 'Search Case Studies', 'text_domain' ),
    'not_found'             => __( 'Not found', 'text_domain' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
    'featured_image'        => __( 'Featured Image', 'text_domain' ),
    'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
    'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
    'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
    'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
    'items_list'            => __( 'Items list', 'text_domain' ),
    'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
    'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
  );
  $args = array(
    'label'                 => __( 'Case Study', 'text_domain' ),
    'description'           => __( 'Case Study Post Type', 'text_domain' ),
    'labels'                => $labels,
    'supports'              => array( 'revisions' ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,    
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'page',
  );
  register_post_type( 'case_study', $args );

}
add_action( 'init', 'case_study', 0 );


function work() {

  $labels = array(
    'name'                  => _x( 'Works', 'Post Type General Name', 'text_domain' ),
    'singular_name'         => _x( 'Work', 'Post Type Singular Name', 'text_domain' ),
    'menu_name'             => __( 'Work', 'text_domain' ),
    'name_admin_bar'        => __( 'Work', 'text_domain' ),
    'archives'              => __( 'Work', 'text_domain' ),
    'attributes'            => __( 'Item Attributes', 'text_domain' ),
    'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
    'all_items'             => __( 'All Work', 'text_domain' ),
    'add_new_item'          => __( 'Add Work', 'text_domain' ),
    'add_new'               => __( 'Add New', 'text_domain' ),
    'new_item'              => __( 'New Work', 'text_domain' ),
    'edit_item'             => __( 'Edit Work', 'text_domain' ),
    'update_item'           => __( 'Update Work', 'text_domain' ),
    'view_item'             => __( 'View Work', 'text_domain' ),
    'view_items'            => __( 'View Works', 'text_domain' ),
    'search_items'          => __( 'Search Works', 'text_domain' ),
    'not_found'             => __( 'Not found', 'text_domain' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
    'featured_image'        => __( 'Featured Image', 'text_domain' ),
    'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
    'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
    'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
    'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
    'items_list'            => __( 'Items list', 'text_domain' ),
    'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
    'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
  );
  $args = array(
    'label'                 => __( 'Work', 'text_domain' ),
    'description'           => __( 'Work Post Type', 'text_domain' ),
    'labels'                => $labels,
    'supports'              => array( 'revisions', 'title' ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_rest'          => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'page',
  );
  register_post_type( 'work', $args );

}
add_action( 'init', 'work', 0 );

// Register Custom Taxonomy
function work_industry() {

  $labels = array(
    'name'                       => _x( 'Industry', 'Taxonomy General Name', 'text_domain' ),
    'singular_name'              => _x( 'Industry', 'Taxonomy Singular Name', 'text_domain' ),
    'menu_name'                  => __( 'Industry', 'text_domain' ),
    'all_items'                  => __( 'All Items', 'text_domain' ),
    'parent_item'                => __( 'Parent Item', 'text_domain' ),
    'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
    'new_item_name'              => __( 'New Industry', 'text_domain' ),
    'add_new_item'               => __( 'Add New Industry', 'text_domain' ),
    'edit_item'                  => __( 'Edit Item', 'text_domain' ),
    'update_item'                => __( 'Update Item', 'text_domain' ),
    'view_item'                  => __( 'View Item', 'text_domain' ),
    'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
    'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
    'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
    'popular_items'              => __( 'Popular Items', 'text_domain' ),
    'search_items'               => __( 'Search Items', 'text_domain' ),
    'not_found'                  => __( 'Not Found', 'text_domain' ),
    'no_terms'                   => __( 'No items', 'text_domain' ),
    'items_list'                 => __( 'Items list', 'text_domain' ),
    'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => false,
    'show_in_rest'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
  );
  register_taxonomy( 'work_industry', array( 'work' ), $args );

}
add_action( 'init', 'work_industry', 0 );

// Register Custom Taxonomy
function work_project_type() {

  $labels = array(
    'name'                       => _x( 'Project Type', 'Taxonomy General Name', 'text_domain' ),
    'singular_name'              => _x( 'Project Type', 'Taxonomy Singular Name', 'text_domain' ),
    'menu_name'                  => __( 'Project Type', 'text_domain' ),
    'all_items'                  => __( 'All Items', 'text_domain' ),
    'parent_item'                => __( 'Parent Item', 'text_domain' ),
    'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
    'new_item_name'              => __( 'New Project Type', 'text_domain' ),
    'add_new_item'               => __( 'Add New Project Type', 'text_domain' ),
    'edit_item'                  => __( 'Edit Item', 'text_domain' ),
    'update_item'                => __( 'Update Item', 'text_domain' ),
    'view_item'                  => __( 'View Item', 'text_domain' ),
    'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
    'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
    'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
    'popular_items'              => __( 'Popular Items', 'text_domain' ),
    'search_items'               => __( 'Search Items', 'text_domain' ),
    'not_found'                  => __( 'Not Found', 'text_domain' ),
    'no_terms'                   => __( 'No items', 'text_domain' ),
    'items_list'                 => __( 'Items list', 'text_domain' ),
    'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => false,
    'public'                     => true,
    'show_ui'                    => true,
    'show_in_rest'               => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
  );
  register_taxonomy( 'work_project_type', array( 'work' ), $args );

}
add_action( 'init', 'work_project_type', 0 );

function vertical() {

  $labels = array(
    'name'                  => _x( 'Verticals', 'Post Type General Name', 'text_domain' ),
    'singular_name'         => _x( 'Vertical', 'Post Type Singular Name', 'text_domain' ),
    'menu_name'             => __( 'Verticals', 'text_domain' ),
    'name_admin_bar'        => __( 'Vertical', 'text_domain' ),
    'archives'              => __( 'Verticals', 'text_domain' ),
    'attributes'            => __( 'Item Attributes', 'text_domain' ),
    'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
    'all_items'             => __( 'All Verticals', 'text_domain' ),
    'add_new_item'          => __( 'Add Vertical', 'text_domain' ),
    'add_new'               => __( 'Add New', 'text_domain' ),
    'new_item'              => __( 'New Vertical', 'text_domain' ),
    'edit_item'             => __( 'Edit Vertical', 'text_domain' ),
    'update_item'           => __( 'Update Vertical', 'text_domain' ),
    'view_item'             => __( 'View Vertical', 'text_domain' ),
    'view_items'            => __( 'View Verticals', 'text_domain' ),
    'search_items'          => __( 'Search Verticals', 'text_domain' ),
    'not_found'             => __( 'Not found', 'text_domain' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
    'featured_image'        => __( 'Featured Image', 'text_domain' ),
    'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
    'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
    'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
    'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
    'items_list'            => __( 'Items list', 'text_domain' ),
    'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
    'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
  );
  $args = array(
    'label'                 => __( 'Vertical', 'text_domain' ),
    'description'           => __( 'Vertical Post Type', 'text_domain' ),
    'labels'                => $labels,
    'supports'              => array( ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,    
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'page',
  );
  register_post_type( 'vertical', $args );

}
add_action( 'init', 'vertical', 0 );

function job() {

  $labels = array(
    'name'                  => _x( 'Jobs', 'Post Type General Name', 'text_domain' ),
    'singular_name'         => _x( 'Job', 'Post Type Singular Name', 'text_domain' ),
    'menu_name'             => __( 'Jobs', 'text_domain' ),
    'name_admin_bar'        => __( 'Job', 'text_domain' ),
    'archives'              => __( 'Jobs', 'text_domain' ),
    'attributes'            => __( 'Item Attributes', 'text_domain' ),
    'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
    'all_items'             => __( 'All Jobs', 'text_domain' ),
    'add_new_item'          => __( 'Add Job', 'text_domain' ),
    'add_new'               => __( 'Add New', 'text_domain' ),
    'new_item'              => __( 'New Job', 'text_domain' ),
    'edit_item'             => __( 'Edit Job', 'text_domain' ),
    'update_item'           => __( 'Update Job', 'text_domain' ),
    'view_item'             => __( 'View Job', 'text_domain' ),
    'view_items'            => __( 'View Jobs', 'text_domain' ),
    'search_items'          => __( 'Search Jobs', 'text_domain' ),
    'not_found'             => __( 'Not found', 'text_domain' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
    'featured_image'        => __( 'Featured Image', 'text_domain' ),
    'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
    'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
    'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
    'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
    'items_list'            => __( 'Items list', 'text_domain' ),
    'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
    'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
  );
  $rewrite = array(
    'slug'                  => 'jobs',
    'with_front'            => true,
    'pages'                 => true,
    'feeds'                 => true,
  );
  $args = array(
    'label'                 => __( 'Job', 'text_domain' ),
    'description'           => __( 'Job Post Type', 'text_domain' ),
    'labels'                => $labels,
    'supports'              => array( 'editor', 'excerpt', 'title' ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => false,
    'rewrite'               => true,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'rewrite'               => $rewrite,
    'capability_type'       => 'page',
  );
  register_post_type( 'job', $args );

}
add_action( 'init', 'job', 0 );

function instagram() {

  $labels = array(
    'name'                  => _x( 'Instagram Photos', 'Post Type General Name', 'text_domain' ),
    'singular_name'         => _x( 'Instagram Photo', 'Post Type Singular Name', 'text_domain' ),
    'menu_name'             => __( 'Instagram', 'text_domain' ),
    'name_admin_bar'        => __( 'Instagram', 'text_domain' ),
    'archives'              => __( 'Instagram Photos', 'text_domain' ),
    'attributes'            => __( 'Item Attributes', 'text_domain' ),
    'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
    'all_items'             => __( 'All Instagram Photos', 'text_domain' ),
    'add_new_item'          => __( 'Add Photo', 'text_domain' ),
    'add_new'               => __( 'Add New', 'text_domain' ),
    'new_item'              => __( 'New Photo', 'text_domain' ),
    'edit_item'             => __( 'Edit Photo', 'text_domain' ),
    'update_item'           => __( 'Update Photo', 'text_domain' ),
    'view_item'             => __( 'View Photo', 'text_domain' ),
    'view_items'            => __( 'View Photos', 'text_domain' ),
    'search_items'          => __( 'Search Instagram Photos', 'text_domain' ),
    'not_found'             => __( 'Not found', 'text_domain' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
    'featured_image'        => __( 'Featured Image', 'text_domain' ),
    'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
    'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
    'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
    'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
    'items_list'            => __( 'Items list', 'text_domain' ),
    'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
    'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
  );
  $args = array(
    'label'                 => __( 'Instagram', 'text_domain' ),
    'description'           => __( 'Instagram Post Type', 'text_domain' ),
    'labels'                => $labels,
    'supports'              => array( 'thumbnail', 'editor' ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,    
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'page',
  );
  register_post_type( 'instagram', $args );

}
add_action( 'init', 'instagram', 0 );


// Register Custom Taxonomy
function instagram_tag() {

  $labels = array(
    'name'                       => _x( 'Instagram Tag', 'Taxonomy General Name', 'text_domain' ),
    'singular_name'              => _x( 'Instagram Tag', 'Taxonomy Singular Name', 'text_domain' ),
    'menu_name'                  => __( 'Instagram Tag', 'text_domain' ),
    'all_items'                  => __( 'All Items', 'text_domain' ),
    'parent_item'                => __( 'Parent Item', 'text_domain' ),
    'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
    'new_item_name'              => __( 'New Instagram Tag', 'text_domain' ),
    'add_new_item'               => __( 'Add New Instagram Tag', 'text_domain' ),
    'edit_item'                  => __( 'Edit Item', 'text_domain' ),
    'update_item'                => __( 'Update Item', 'text_domain' ),
    'view_item'                  => __( 'View Item', 'text_domain' ),
    'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
    'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
    'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
    'popular_items'              => __( 'Popular Items', 'text_domain' ),
    'search_items'               => __( 'Search Items', 'text_domain' ),
    'not_found'                  => __( 'Not Found', 'text_domain' ),
    'no_terms'                   => __( 'No items', 'text_domain' ),
    'items_list'                 => __( 'Items list', 'text_domain' ),
    'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => false,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
  );
  register_taxonomy( 'instagram_tag', array( 'instagram' ), $args );

}

add_action( 'init', 'instagram_tag', 0 );
