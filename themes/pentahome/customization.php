<?php /* Template Name: customization */
get_header(); ?>
<section class="row row-cols-lg-2 justify-content-lg-between justify-content-center gap-4 gap-lg-0">
    <img class="object-fit vh-100 order-first order-lg-last px-0" src="<?= get_field('image')['url']; ?>"
         alt="<?= get_field('image')['title']; ?>" data-aos="fade-right" data-aos-duration="600">
    <div class="row justify-content-center align-self-center">
        <h1 class="text-center display-4 text-primary fw-bold mb-5" data-aos="fade-up"
            data-aos-duration="600">چرا سفارشی سازی؟</h1>
        <div class="col-lg-11 row row-cols-lg-2 text-center">
            <?php while (have_rows('list')): the_row(); ?>
                <p class="text-secondary p-3 border fs-5 hover-border" data-aos="fade-up" data-aos-duration="500"
                   data-aos-delay="<?php the_row_index(); ?>00">
                    <?= get_sub_field('list_item'); ?>
                </p>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<section class="pb-5">
    <div class="row justify-content-center align-items-center h-100 py-5">
        <h2 class="text-center title text-primary fs-1 pt-3 pb-5" data-aos="fade-down"><?= get_the_title(); ?></h2>
        <div class="col-lg-6 col-11 bg-primary p-lg-4 p-3 bg-opacity-25 rounded-2 shadow-sm" data-aos="zoom-in"
             data-aos-duration="500">
            <?php echo do_shortcode('[gravityform id="2" title="false" description="false" ajax="true"]'); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
