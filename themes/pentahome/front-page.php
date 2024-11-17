<?php /* Template Name: Home */
get_header(); ?>


<?php if (have_posts()) {
    the_post(); ?>
        <section class="swiper-wrapper">
            <!-- Slides -->
            <article class="swiper-slide vh-50 vh-lg-100" data-hash="Slides">
                <?php
                //    <!--Hero -->
                get_template_part('template-parts/homepage/hero_slider');
                ?>
            </article>
            <?php
//            get_template_part('template-parts/homepage/portfolio_slider')
            get_template_part('template-parts/homepage/portfolio_categories-slide')
            ?>
            <?php
            get_template_part('template-parts/Layout/footer');
            ?>

        </section>
        <!-- If we need pagination -->
        <aside class="d-flex swiper-pagination-custom z-below position-absolute align-items-center align-items-lg-start flex-lg-column px-3 py-2 px-lg-0 py-lg-0 justify-content-between justify-content-lg-center ms-lg-2"
             data-aos="" data-aos-duration="700"></aside>
<?php }
get_footer();
