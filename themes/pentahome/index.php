<?php get_header();
/* Template Name: blog archive */
?>

<?php
$pageID = get_option('page_for_posts');
$args = array(
    'title' => get_the_title($pageID),
    'imgUrl' => get_the_post_thumbnail_url($pageID),
);
get_template_part('template-parts/page_banner', null, $args);
?>
    <section class="container-fluid">
        <?php
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'order' => 'DESC',
            'posts_per_page' => '-1',
            'ignore_sticky_posts' => true
        );
        $loop = new WP_Query($args);
        if ($loop->have_posts()) :
        $i = 0;
        $j = 0;
        /* Start the Loop */
        ?>
        <div class="justify-content-start mt-3 align-items-start d-flex flex-wrap">
            <?php while ($loop->have_posts()) :
                $loop->the_post();
                get_template_part('template-parts/blog/archive-card');
                $j += 20;
            endwhile;
            endif;
            wp_reset_postdata(); ?>
        </div>
    </section>
<?php get_footer(); ?>