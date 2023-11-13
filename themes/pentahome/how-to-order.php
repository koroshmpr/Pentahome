<?php /* Template Name: how to order */
get_header(); ?>
<section class="row row-cols-lg-2 justify-content-lg-between justify-content-center gap-4 gap-lg-0">
    <img class="object-fit vh-100 order-first order-lg-last px-0" src="<?= get_field('image')['url']; ?>"
         alt="<?= get_field('image')['title']; ?>" data-aos="fade-right" data-aos-duration="600">
    <div class="row justify-content-center align-self-center">
        <h1 class="text-center display-4 text-primary fw-bold mb-4" data-aos="fade-up"
            data-aos-duration="600"> <?= get_the_title();?></h1>
        <h2 class="h6 text-center px-5 mb-4" data-aos="fade-up" data-aos-duration="600" data-aos-delay="100">
            <?= get_field('content');?>
        </h2>
        <div class="col-lg-10">
            <?php while (have_rows('list')): the_row(); ?>
            <div class="border mb-3 rounded-2 overflow-hidden" data-aos="fade-left" data-aos-duration="600" data-aos-delay="<?php the_row_index(); ?>00">
                <div class="d-flex gap-2 py-3 justify-content-center align-items-center bg-primary bg-opacity-25 shadow-sm">
                    <?= get_sub_field('icon'); ?>
                    <h3 class="mb-0"><?= get_sub_field('title'); ?></h3>
                </div>
                <p class="text-secondary py-2 text-center border-top px-lg-5 px-3">
                    <?= get_sub_field('content'); ?>
                </p>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>