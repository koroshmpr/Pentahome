<?php get_header();
/* Template Name: portfilio archive */
?>

    <section class="container-fluid">
        <?php
        $args = array(
            'post_type' => 'portfolio',
            'post_status' => 'publish',
            'order' => 'DESC',
            'posts_per_page' => '-1',
            'ignore_sticky_posts' => true
        );
        $loop = new WP_Query($args);
        if ($loop->have_posts()) :
        $i = 0;
        /* Start the Loop */
        ?>
        <div class="masonry justify-content-center">
            <?php while ($loop->have_posts()) :
                $loop->the_post(); ?>
                <div class="masonry-item col-12 col-md-6 p-2 overflow-hidden">
                    <div class="w-100 h-100 position-relative portfolio_card p-0 overflow-hidden">
                        <img class="object-fit img-fluid"
                             src="<?php echo esc_url(the_post_thumbnail_url()); ?>"
                             alt="<?php echo get_the_title(); ?>"/>
                        <a href="<?php the_permalink(); ?>"
                           class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center align-items-start bg-primary bg-opacity-75 portfolio_description gap-3 px-5">
                            <h3 class="fs-1 text-white"><?php echo get_the_title(); ?></h3>
                            <div class="text-white text-opacity-75">
                                <?php echo wp_trim_words(get_the_content(), 30); ?>
                            </div>

                        </a>
                    </div>
                </div>

            <?php
            endwhile;
            endif;
            wp_reset_postdata(); ?>
        </div>
    </section>
<?php get_footer(); ?>