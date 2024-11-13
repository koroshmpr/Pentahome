<?php
function works_post_types()
{
    // works post-type
    register_post_type('works', array(
        'supports' => array('title', 'editor', 'comments', 'excerpt', 'custom-fields', 'thumbnail'),
        'rewrite' => array('slug' => 'works'),
        'has_archive' => true,
        'public' => true,

        'labels' => array(
            'name' => 'ساخته ها',
            'add_new' => 'افزودن ساخته',
            'add_new_item' => 'افزودن ساخته جدید',
            'edit_item' => 'ویرایش ساخته',
            'all_items' => 'همه ی ساخته ها',
            'singular_name' => 'ساخته'
        ),
        'menu_icon' => 'dashicons-portfolio'
    ));
    register_taxonomy(
        'works_categories',
        'works',             // post type name
        array(
            'hierarchical' => true,
            'label' => 'دسته بندی ساخته', // display name
            'query_var' => true,
        )
    );

}

add_action('init', 'works_post_types');
function portfolio_post_types()
{
    // portfolio post-type
    register_post_type('portfolio', array(
        'supports' => array('title', 'editor', 'comments', 'excerpt', 'custom-fields', 'thumbnail'),
        'rewrite' => array('slug' => 'portfolio'),
        'has_archive' => true,
        'public' => true,

        'labels' => array(
            'name' => 'پروژه ها',
            'add_new' => 'افزودن پروژه',
            'add_new_item' => 'افزودن پروژه جدید',
            'edit_item' => 'ویرایش پروژه',
            'all_items' => 'همه ی پروژه ها',
            'singular_name' => 'پروژه'
        ),
        'menu_icon' => 'dashicons-portfolio'
    ));
    register_taxonomy(
        'portfolio_categories',
        'portfolio',             // post type name
        array(
            'hierarchical' => true,
            'label' => 'دسته بندی پروژه', // display name
            'query_var' => true,
        )
    );

}

add_action('init', 'portfolio_post_types');