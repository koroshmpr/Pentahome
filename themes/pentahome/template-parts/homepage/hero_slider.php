<div class="z-top swiper swiper2">
    <div class="swiper-wrapper">
        <?php
        $i = 0;
        $slides = get_field('slides');
        $effect = get_field('effect');
        if ($slides): ?>
            <?php foreach ($slides as $index => $slide): $i++; ?>
                <div class="swiper-slide vh-50 vh-lg-100 position-relative">
                        <div data-number="<?= $i; ?>" data-aos-duration="400" data-aos-delay="100" data-aos="fade-right"
                            <?php
                            if ($effect == 'line') { ?>
                                class="diagonal position-absolute bottom-0 d-flex justify-content-center align-items-center"
                            <?php }
                            if ($effect == 'circle') { ?>
                                class="heroBg position-absolute top-50 start-50 translate-middle d-flex justify-content-center align-items-center"
                            <?php } ?>>
                            <h<?= $i <= 6 ? $i : 6; ?>
                                    class="text-white display-2 fw-bold">
                                <?= $slide['title-1'] ?>
                                <br>
                                <?= $slide['title-2'] ?>
                            </h<?= $i <= 6 ? $i : 6; ?>>
                        </div>
                        <img class="vh-50 vh-lg-100 object-fit w-100"
                             src="<?php echo esc_url($slide['slide-image']['url']); ?>"
                             alt="<?php echo esc_attr($slide['slide-image']['alt']); ?>"/>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div class="swiper-pagination hero-pagination m-auto start-50 translate-middle-x bg-dark bg-opacity-50 rounded-pill d-flex justify-content-center p-2"></div>
</div>