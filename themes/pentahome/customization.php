<?php /* Template Name: customization */
get_header(); ?>
<section class="pb-5">
        <h1 class="text-center title text-primary fs-1 pt-3 pb-5" data-aos="fade-down"><?= get_the_title(); ?></h1>
    <div class="row justify-content-center align-items-center h-100 py-5">
        <div class="col-lg-6 col-11 bg-primary p-lg-4 p-3 bg-opacity-25 rounded-2 shadow-sm" data-aos="zoom-in"
             data-aos-duration="500">
            <?php echo do_shortcode('[gravityform id="2" title="false" description="false" ajax="true"]'); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
