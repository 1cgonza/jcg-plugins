<?php
// The custom dashicons are at: http://melchoyce.github.io/dashicons/

register_post_type( 'films',
  array(
    'labels' => array(
      'name'               => 'Films',
      'singular_name'      => 'Film',
      'all_items'          => 'All Films',
      'add_new'            => 'Add New',
      'add_new_item'       => 'Add New Film',
      'edit'               => 'Edit',
      'edit_item'          => 'Edit Film',
      'new_item'           => 'New Film',
      'view_item'          => 'View Film',
      'search_items'       => 'Search Film',
      'not_found'          => 'Nothing found in the Database.',
      'not_found_in_trash' => 'Nothing found in Trash',
      'parent_item_colon'  => ''
    ),
    'description'         => 'The films post type with custom display.',
    'public'              => true,
    'publicly_queryable'  => true,
    'exclude_from_search' => false,
    'show_ui'             => true,
    'query_var'           => true,
    'menu_icon'           => 'dashicons-editor-video',
    'has_archive'         => true,
    'capability_type'     => 'post',
    'hierarchical'        => false,
    'supports'            => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'comments', 'revisions', 'sticky'),
    'taxonomies'          => array('category', 'post_tag')
  )
);

register_post_type( 'cv_meta',
  array(
    'labels' => array(
      'name'               => 'CV Meta',
      'singular_name'      => 'CV Meta item',
      'all_items'          => 'All CV Meta items',
      'add_new'            => 'Add New',
      'add_new_item'       => 'Add New CV Meta item',
      'edit'               => 'Edit',
      'edit_item'          => 'Edit CV Meta item',
      'new_item'           => 'New CV Meta item',
      'view_item'          => 'View CV Meta item',
      'search_items'       => 'Search CV Meta items',
      'not_found'          => 'Nothing found in the Database.',
      'not_found_in_trash' => 'Nothing found in Trash',
      'parent_item_colon'  => ''
    ),
    'description'         => 'Festival Selections, Awards, Exhibitions, Conferences, Education, etc.',
    'public'              => false,
    'publicly_queryable'  => false,
    'exclude_from_search' => true,
    'show_ui'             => true,
    'query_var'           => true,
    'menu_icon'           => 'dashicons-awards',
    'has_archive'         => false,
    'capability_type'     => 'post',
    'hierarchical'        => false,
    'supports'            => array('title', 'author', 'thumbnail')
  )
);

register_post_type( 'experiments',
  array(
    'labels' => array(
      'name'               => 'Experiments',
      'singular_name'      => 'Experiment',
      'all_items'          => 'All Experiments',
      'add_new'            => 'Add New',
      'add_new_item'       => 'Add New Experiment',
      'edit'               => 'Edit',
      'edit_item'          => 'Edit Experiment',
      'new_item'           => 'New Experiment',
      'view_item'          => 'View Experiment',
      'search_items'       => 'Search Experiment',
      'not_found'          => 'Nothing found in the Database.',
      'not_found_in_trash' => 'Nothing found in Trash',
      'parent_item_colon'  => ''
    ),
    'description'         => 'LAB.',
    'public'              => true,
    'publicly_queryable'  => true,
    'exclude_from_search' => false,
    'show_ui'             => true,
    'query_var'           => true,
    'menu_icon'           => 'dashicons-art',
    'has_archive'         => true,
    'capability_type'     => 'post',
    'hierarchical'        => false,
    'supports'            => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'comments', 'revisions', 'sticky'),
    'taxonomies'          => array('post_tag')
  )
);

register_post_type( 'commissions',
  array(
    'labels' => array(
      'name'               => 'Comissions',
      'singular_name'      => 'Comission',
      'all_items'          => 'All Comissions',
      'add_new'            => 'Add New',
      'add_new_item'       => 'Add New Comission',
      'edit'               => 'Edit',
      'edit_item'          => 'Edit Comission',
      'new_item'           => 'New Comission',
      'view_item'          => 'View Comission',
      'search_items'       => 'Search Comissions',
      'not_found'          => 'Nothing found in the Database.',
      'not_found_in_trash' => 'Nothing found in Trash',
      'parent_item_colon'  => ''
    ),
    'description'         => 'Commissioned projects.',
    'public'              => true,
    'publicly_queryable'  => true,
    'exclude_from_search' => false,
    'show_ui'             => true,
    'query_var'           => true,
    'menu_icon'           => 'dashicons-products',
    'has_archive'         => true,
    'capability_type'     => 'post',
    'hierarchical'        => false,
    'supports'            => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'comments', 'revisions', 'sticky'),
    'taxonomies'          => array('post_tag')
  )
);

register_taxonomy('cv_cat',
  array('cv_meta'),
  array(
    'hierarchical' => true,
    'labels'       => array(
      'name'              => 'CV Categories',
      'singular_name'     => 'CV Category',
      'search_items'      => 'Search CV Categories',
      'all_items'         => 'All CV Categories',
      'parent_item'       => 'Parent CV Category',
      'parent_item_colon' => 'Parent CV Category:',
      'edit_item'         => 'Edit CV Category',
      'update_item'       => 'Update CV Category',
      'add_new_item'      => 'Add New CV Category',
      'new_item_name'     => 'New CV Category Name',
    ),
    'show_admin_column' => true,
    'show_ui'           => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'cv' )
  )
);

register_taxonomy( 'commission_cat',
  array('commissions'),
  array(
    'hierarchical' => true,
    'labels'       => array(
      'name'              => 'Comission Categories',
      'singular_name'     => 'Comission Category',
      'search_items'      => 'Search Comission Categories',
      'all_items'         => 'All Comission Categories',
      'parent_item'       => 'Parent Comission Category',
      'parent_item_colon' => 'Parent Comission Category:',
      'edit_item'         => 'Edit Comission Category',
      'update_item'       => 'Update Comission Category',
      'add_new_item'      => 'Add New Comission Category',
      'new_item_name'     => 'New Comission Category Name',
    ),
    'show_admin_column' => true,
    'show_ui'           => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'comission' )
  )
);
