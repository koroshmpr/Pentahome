<?php /* Template Name: about us */
get_header(); ?>
<section class="w-100 h-auto categories-hero"
     style="background: url('<?= get_field('hero_image')['url']; ?>');" data-aos="fade-down" data-aos-duration="500">
    <div class="d-inline-flex align-items-center justify-content-center gap-4 ps-lg-3 py-5 title h-100">
       <div class="col-lg-7 col-11">
         <div class="d-flex gap-3 pb-4 align-items-center">
             <hr class="text-white opacity-100 rounded-pill bg-white" style="width: 40px" data-aos="fade-left"
                 data-aos-duration="500">
             <h1 class="display-1 fw-bold text-white" data-aos="fade-left" data-aos-duration="500" data-aos-delay="150">
                 <?= get_the_title(); ?>
             </h1>
         </div>
           <p class="bg-dark bg-opacity-75 p-3 p-lg-4 fs-4 text-justify text-white" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
               <?= get_field('aboutus_content'); ?>
           </p>
       </div>
    </div>
</section>
<?php get_footer(); ?>
