<?php get_header();
$args = array(
    'title' => get_the_title(),
    'imgUrl' => get_the_post_thumbnail_url(),
);
get_template_part('template-parts/page_banner', null, $args);
?>
<section class="d-flex justify-content-lg-evenly justify-content-center align-items-stretch position-relative flex-wrap">
    <article
            class="p-4 py-lg-5 bg-primary text-justify bg-opacity-10 col-12 col-lg-9 text-dark">
        <?php the_content(); ?>
    </article>
    <aside class="col-lg-3 col-12 border-end border-start border-primary mt-2 mt-lg-0">
        <div class="bg-primary p-4">
            <p class="fw-bold fs-4 mb-3 text-white">مقالات پیشنهادی ما</p>
            <div class="row overflow-hidden">
                <?php
                $args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'posts_per_page' => '3',
                    'ignore_sticky_posts' => TRUE
                );
                $loop = new WP_Query($args);
                if ($loop->have_posts()) : $i = 0;
                    /* Start the Loop */
                    while ($loop->have_posts()) :
                        $loop->the_post(); ?>
                        <a data-aos="fade-right" data-aos-delay="<?= $i;?>0" data-aos-duration="500" href="<?php echo get_the_permalink(); ?>" class="d-flex align-items-center my-2">
                            <img class="rounded img-fluid object-fit col-3" style="aspect-ratio: 1;"
                                 src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                            <div class="ps-3 flex-grow-1">
                                <p class="fw-bold text-white mb-2"><?php echo get_the_title(); ?></p>
                                <div class="d-flex align-items-center gap-2 text-dark">
                                    <?php
                                    $category_detail = get_the_category($post->ID); //$post->ID
                                    foreach ($category_detail as $category) { ?>
                                        <span class="small px-2 py-1 bg-white text-dark rounded">
                                    <?php echo $category->name ?>
                                </span>
                                    <?php } ?>
                                </div>
                            </div>
                        </a>
                    <?php
                        $i += 5;
                    endwhile;
                endif;
                wp_reset_postdata(); ?>
            </div>
        </div>
        <?php
        // Get the min-heading and max-heading values from the options
        $tableOfContent = get_field('table_of_content', 'option');
        $min_heading = $tableOfContent['min-heading'] ?? 2;
        $max_heading = $tableOfContent['max-heading'] ?? 4;

        // Output the TOC shortcode with the dynamic values
        echo do_shortcode('[TOC from_tag="' . $min_heading . '" to_tag="' . $max_heading . '"]');
        ?>
    </aside>
</section>
<?php get_footer(); ?>