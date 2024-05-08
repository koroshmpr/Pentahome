<?php /* Template Name: Home */
get_header(); ?>


<?php if (have_posts()) {
    the_post(); ?>

    <div class="swiper swiper1 lazy vh-100">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <div class="swiper-slide vh-50 vh-lg-100" data-hash="Slides">
                <?php
                //    <!--Hero -->
                get_template_part('template-parts/homepage/hero_slider');
                ?>
            </div>
            <?php
//            get_template_part('template-parts/homepage/portfolio_slider')
            get_template_part('template-parts/homepage/portfolio_categories-slide')
            ?>
            <?php
            get_template_part('template-parts/Layout/footer');
            ?>

        </div>
        <!-- If we need pagination -->
        <div class="d-flex swiper-pagination-custom z-below position-absolute align-items-center align-items-lg-start flex-lg-column px-3 py-2 px-lg-0 py-lg-0 justify-content-between justify-content-lg-center ms-lg-2"
             data-aos="" data-aos-duration="700"></div>
    </div>


<?php }
get_footer();
