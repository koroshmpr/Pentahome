<?php
// Check rows existexists.
$i = 2;
if (have_rows('products_list')):
    // Loop through rows.
    while (have_rows('products_list')) : the_row();
        $i++;
        $title = get_sub_field('title');
        $design = get_sub_field('design_by');
        $manufacturer = get_sub_field('manufactured_by');
        $text = get_sub_field('text');
        $gallery = get_sub_field('gallery');
        ?>
        <div class="swiper-slide product_slide vh-100" data-hash="products">
            <section class="container" >
                <div class="row align-items-start justify-content-start px-5">
                    <div class="col-lg-6">
                        <div class="d-inline-flex align-items-end gap-4" data-aos="fade-in" data-aos-duration="600"
                             data-aos-delay="100">
                            <hr class="text-dark mb-4 opacity-100 rounded-pill bg-dark">
                            <h1 class="display-3 fw-bold text-dark">
                                <?= $title; ?>
                            </h1>
                        </div>
                        <h2 class="text-primary fs-5 mt-3">
                            <?= $design; ?>
                        </h2>
                        <h3 class="text-dark fs-5 mt-1">
                            <?= $manufacturer; ?>
                        </h3>
                        <p class="mt-4">
                            <?= $text; ?>
                        </p>
                        <button class="button button-white">
                            ثبت سفارش
                        </button>
                    </div>
                    <div class="col-lg-6">

                    </div>
                </div>
                <div class="row translate-middle-y">
                    <div class="col-lg-6"></div>
                    <div class="col-lg-6">
                        <div class="swiper overflow-visible swiper<?= $i; ?>">
                            <div class="swiper-wrapper">
                                <?php
                                if ($gallery): ?>
                                    <?php foreach ($gallery as $image): ?>
                                        <div class="swiper-slide">
                                            <img class="rounded-2 object-fit w-100"
                                                 src="<?php echo esc_url($image['url']); ?>"
                                                 alt="<?php echo esc_attr($image['alt']); ?>"/>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <!-- If we need pagination -->
                            <div class="swiper-pagination w-100 px-0 mx-0 mb-n4 start-0 rounded-pill d-flex justify-content-center p-2"></div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    <?php endwhile;
endif; ?>