<?php /* Template Name: how to order */
get_header(); ?>
<?php
$pageBanner = get_field('image')['url'];
$args = array(
    'imgUrl' => $pageBanner,
);
get_template_part('template-parts/page_banner', null, $args);
?>
    <section class="row justify-content-lg-between justify-content-center gap-4 gap-lg-0 py-5">
        <div class="row justify-content-center align-self-center">
            <h2 class="h6 text-center px-lg-5 px-3 mb-4 fs-3 text-primary" data-aos="fade-up" data-aos-duration="600"
                data-aos-delay="100">
                <?= get_field('content'); ?>
            </h2>
            <div class="col-lg-11">
                <?php while (have_rows('list')): the_row(); ?>
                    <div class="border-bottom border-0 mb-3 rounded-2 overflow-hidden" data-aos="fade-left"
                         data-aos-duration="600" data-aos-delay="<?php the_row_index(); ?>00">
                        <div class="d-flex gap-2 py-3 justify-content-start align-items-center">
                            <hr class="text-dark opacity-100 rounded-pill bg-dark" style="width: 40px;  height:3px"
                                data-aos="fade-left"
                                data-aos-duration="500">
                            <h3 class="mb-0"><?= get_sub_field('title'); ?></h3>
                        </div>
                        <p class="text-dark py-2 text-lg-start text-center px-lg-5 px-3 fs-5">
                            <?= get_sub_field('content'); ?>
                        </p>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
<?php get_footer(); ?>