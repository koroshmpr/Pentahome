<?php
$args = array(
    'post_type' => 'portfolio',
    'post_status' => 'publish',
    'order' => 'ASC',
    'posts_per_page' => -1,
    'ignore_sticky_posts' => true
);
$loop = new WP_Query($args);
if ($loop->have_posts()) :
    $i = 1;
    while ($loop->have_posts()) :
        $loop->the_post(); // Use the_post() to set up post data
        $i++;
        $design = get_field('design_by');
        $manufacturer = get_field('manufactured_by');
        $gallery = get_field('gallery');
        ?>
        <div class="swiper-slide product_slide vh-100" data-hash="products">
            <section class="container">
                <div class="row align-items-lg-start align-content-center justify-content-lg-between px-lg-5 gap-4 gap-lg-0">
                    <div class="content-portfolio col-lg-6">
                        <div class="d-inline-flex align-items-end gap-4"
                             data-aos-delay="100">
                            <hr class="text-dark mb-4 opacity-100 rounded-pill bg-dark">
                            <h2 class="display-3 fw-bold text-dark">
                                <?= the_title(); ?>
                            </h2>
                        </div>
                        <h3 class="text-primary fs-5 mt-3">
                            <?= $design; ?>
                        </h3>
                        <h4 class="text-dark fs-5 mt-1">
                            <?= $manufacturer; ?>
                        </h4>
                        <div class="mt-4 mb-5">
                            <?= the_content(); ?>
                        </div>
                        <a href="<?= the_permalink();?>" class="btn-custom ball py-1 ms-3 ms-lg-0">
                           <span class="text-green">مشاهده</span>
                        </a>
                    </div>
                    <div class="col-lg-6 translate-middle-lg-y">
                        <div class="swiper overflow-visible swiper<?= $i; ?>">
                            <div class="swiper-wrapper">
                                <?php
                                if ($gallery) {
                                    // Shuffle the array to randomize the order
                                    shuffle($gallery);

                                    // Limit the number of items to 6
                                    $limitedGallery = array_slice($gallery, 0, 6);

                                    foreach ($limitedGallery as $image) {
                                        ?>
                                        <div class="swiper-slide">
                                            <img class="rounded-2 object-fit w-100 bg-warning" height="450"
                                                 src="<?php echo esc_url($image['url']); ?>"
                                                 alt="<?php echo esc_attr($image['alt']); ?>"/>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
<!--                             If we need pagination-->
                            <div class="swiper-pagination w-100 px-0 mx-0 mb-n4 start-0 rounded-pill d-flex justify-content-center p-2"></div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    <?php endwhile;
    wp_reset_postdata(); // Reset post data
endif;
?>