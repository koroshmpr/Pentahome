<?php /* Template Name: Home */
get_header(); ?>


<?php if (have_posts()) {
    the_post(); ?>

    <div class="swiper swiper1 lazy vh-100">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <div class="swiper-slide vh-100" data-hash="Slides">
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
        <div class="swiper-pagination-custom z-below position-absolute top-0 bottom-0 d-flex flex-column justify-content-center w-auto h-100 start-0 ms-2"
             data-aos="fade-left" data-aos-duration="700"></div>
    </div>


<?php }
get_footer();
