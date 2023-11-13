<?php


function portfolio_post_types()
{
    // game post-type
    register_post_type('portfolio', array(
        'supports' => array('title', 'editor', 'comments', 'excerpt', 'custom-fields', 'thumbnail'),
        'rewrite' => array('slug' => 'portfolio'),
        'has_archive' => true,
        'public' => true,
        
        'labels' => array(
            'name' => 'نمونه کار',
            'add_new' => 'افزودن نمونه کار',
            'add_new_item' => 'افزودن نمونه کار',
            'edit_item' => 'ویرایش نمونه کار',
            'all_items' => 'همه ی نمونه کار ها',
            'singular_name' => 'نمونه کار ها'
        ),
        'menu_icon' => 'dashicons-portfolio'
    ));
    register_taxonomy(
        'portfolio_categories',
        'portfolio',             // post type name
        array(
            'hierarchical' => true,
            'label' => 'دسته بندی نمونه کار', // display name
            'query_var' => true,
        )
    );

}

add_action('init', 'portfolio_post_types');