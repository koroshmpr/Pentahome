<section class="z-top">
    <!-- Slider main container -->
    <div class="swiper swiper2">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <?php
            $i = 0;
            $images = get_field('home_slider');
            $size = 'full'; // (thumbnail, medium, large, full or custom size)
            if ($images): ?>
                <?php foreach ($images as $image): $i++; ?>
                    <div class="swiper-slide vh-100">
                        <div class="position-relative">
                            <div class="diagonal position-absolute bottom-0" data-number="<?= $i; ?>" data-aos="fade-right" data-aos-delay="100" data-aos-duration="400"></div>
                            <h2 data-aos="fade-in" data-aos-delay="400" data-aos-duration="800" data-number="<?= $i; ?>" class="text-white display-2 fw-bold position-absolute translate-middle-y top-50  m-auto w-100 text-center">
                                شما خیال کنید
                                <br>
                                ما می‌سازیم
                            </h2>
                            <img class="vh-100 object-fit w-100" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"/>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination hero-pagination m-auto start-0 bg-dark bg-opacity-50 rounded-pill d-flex justify-content-center p-2"></div>
</section>