<?php /* Template Name: about us */
get_header(); ?>
<section class="row row-cols-lg-2 justify-content-lg-between justify-content-center gap-4 gap-lg-0">
    <img class="object-fit vh-100 order-first order-lg-last px-0" src="<?= get_field('hero_image')['url'];?>"
         alt="<?= get_field('hero_image')['title'];?>" data-aos="fade-right" data-aos-duration="600">
    <div class="row justify-content-center align-self-center">
        <h1 class="text-center display-4 text-primary fw-bold mb-5" data-aos="fade-up"
            data-aos-duration="600"><?= get_the_title(); ?></h1>
        <p class="col-lg-7 text-justify border p-4 shadow-sm" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
            <?= get_field('aboutus_content');?>
        </p>
    </div>
</section>
<section class="row row-cols-lg-2 justify-content-lg-between justify-content-center gap-4 gap-lg-0">
    <div class="row justify-content-center align-self-center order-last order-first">
        <h1 class="text-center display-4 text-primary fw-bold mb-5" data-aos="fade-up"
            data-aos-duration="600"><?= get_the_title(); ?></h1>
        <p class="col-lg-7 text-justify border p-4 shadow-sm" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
            <?= get_field('aboutus_content');?>
        </p>
    </div>
    <img class="object-fit img-fluid px-0" src="<?= get_field('hero_image')['url'];?>"
         alt="<?= get_field('hero_image')['title'];?>" data-aos="fade-left" data-aos-duration="600">
</section>
<?php get_footer(); ?>
