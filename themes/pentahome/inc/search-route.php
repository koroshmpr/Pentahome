<?php
add_action('rest_api_init', 'register_new_search');
function register_new_search()
{
    register_rest_route('search/v1', 'search', array(
        'methods' => WP_REST_Server::READABLE,
        'callback' => 'GoldSearchResults'
    ));
}
function GoldSearchResults($data) {
    $mainQuery = new WP_Query(array(
        'post_type' => array('post', 'page' , 'portfolio'),
        's' => sanitize_text_field($data['term'])
    ));

    $mainResults = array(
        'post' => array(),
        'page' => array(),
        'portfolio' => array()
    );

    while ($mainQuery->have_posts()) {
        $mainQuery->the_post();
        $content = get_the_content();
        $content = wp_strip_all_tags($content);
        $content = wp_trim_words($content, 24, '...'); // limit content to 24 words

        if (get_post_type() == 'post') {
            array_push($mainResults['post'], array(
                'title' => get_the_title(),
                'url' => get_the_permalink(),
                'post_type' => get_post_type(),
                'img' => get_the_post_thumbnail_url(),
                'category' => get_the_category()[0]->name,
                'content' => $content
            ));
        } if (get_post_type() == 'page') {
            $page_content = get_the_content(); // Get the full content for pages
            $page_content = wp_strip_all_tags($page_content);
            $page_content = wp_trim_words($page_content, 24, '...'); // limit content to 24 words

            array_push($mainResults['page'], array(
                'title' => get_the_title(),
                'url' => get_the_permalink(),
                'post_type' => get_post_type(),
                'img' => get_the_post_thumbnail_url(),
                'content' => $page_content // Use the content specific to pages
            ));
        }if (get_post_type() == 'portfolio') {
            $page_content = get_the_content(); // Get the full content for pages
            $page_content = wp_strip_all_tags($page_content);
            $page_content = wp_trim_words($page_content, 24, '...'); // limit content to 24 words

            array_push($mainResults['portfolio'], array(
                'title' => get_the_title(),
                'url' => get_the_permalink(),
                'post_type' => get_post_type(),
                'img' => get_the_post_thumbnail_url(),
                'content' => $page_content // Use the content specific to pages
            ));
        }
    }

    wp_reset_postdata();

    return $mainResults;
}


