<?php

function paywithbank3d_init(){
    $labels = array(
        'name' => _x('Paywithbank3D', 'paywithban3d'),
        'singular_name' => _x('Paywithbank3D', 'paywithbank3d'),
        'add_new' => _x('Add New', 'paywithbank3d'),
        'add_new_item' => _x('Add Paywithbank3D Form', 'paywithbank3d'),
        'edit_item' => _x('Edit Paywithbank3D Form', 'paywithbank3d'),
        'new_item' => _x('Paywithbank3D Form', 'paywithbank3d'),
        'view_item' => _x('View Paywithbank3D Form', 'paywithbank3d'),
        'all_items' => _x('All Forms', 'paywithbank3d'),
        'search_items' => _x('Search Paywithbank3D Forms', 'paywithbank3d'),
        'not_found' => _x('No Paywithbank3D Forms found', 'paywithbank3d'),
        'not_found_in_trash' => _x('No Paywithbank3D Forms found in Trash', 'paywithbank3d'),
        'parent_item_colon' => _x('Parent Paywithbank3D Form:', 'paywithbank3d'),
        'menu_name' => _x('Paywithbank3D', 'paywithbank3d'),

    );

    $args = array(
        'labels'             => $labels,
        'description' => 'Paywithbank3D Forms filterable by genre',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus' => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'paywithbank3d' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => true,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'editor' ),
        'show_in_rest' => false,
        'exclude_from_search' => false,
        'can_export' => true,
        'comments' => false,
        'menu_icon' => plugins_url('../assets/images/3D.png', __FILE__),
    );

    register_post_type( 'paywithbank3d', $args );
}

//function pwb3d_init($wp_rewrite)
//{
//    $wp_rewrite->rules = array_merge(
//        ['paywithbank3dinvoice/(\d+)/?$' => 'index.php?pwb3d_id=$matches[1]'],
//        $wp_rewrite->rules
//    );
//}

function pwb3d_init_internal()
{
    add_rewrite_rule( 'paywithbank3dinvoice$', 'index.php?pwb3d_id=$matches[1]', 'top' );
}
