<?php /* Template Name: customization */
get_header(); ?>
<section class="py-5">
    <h1 class="text-center text-primary fs-2 py-5" data-aos="fade-down" data-aos-duration="500">سفارشی سازی</h1>
    <div class="row justify-content-center align-items-center h-100 py-4">
        <div class="col-lg-6 col-11 bg-primary p-lg-4 p-2 bg-opacity-25 rounded-2 shadow-sm" data-aos="zoom-in" data-aos-duration="500">
            <?php echo do_shortcode('[gravityform id="2" title="false" description="false" ajax="true"]'); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
