<?php
$terms = get_terms('portfolio_categories', array(
    'parent' => 0, // This will retrieve only top-level categories
));
foreach ($terms as $category) :

    // Fetch and display portfolio item data (title, design, manufacturer, etc.) here
    $title = $category->name;;
    $id = 'portfolio_categories_' . $category->term_id;
    $design = get_field('design_by' , $id);
    $manufacturer = get_field('manufactured_by', $id);
    $gallery = get_field('gallery' , $id);
    $category_description = $category->description;

    // Display the data as needed within the HTML structure
    ?>
    <div class="swiper-slide product_slide vh-100" data-hash="products">
        <section class="container">
            <div class="row align-items-lg-start align-content-center justify-content-lg-between px-lg-5 gap-4 gap-lg-0">
                <div class="col-lg-6">
                    <div class="d-inline-flex align-items-end gap-4"
                         data-aos-delay="100">
                        <hr class="text-dark mb-4 opacity-100 rounded-pill bg-dark">
                        <h2 class="display-3 fw-bold text-dark">
                            <?= $title;  ?>
                        </h2>
                    </div>
                    <h3 class="text-primary fs-5 mt-3">
                        <?= $design; ?>
                    </h3>
                    <h4 class="text-dark fs-5 mt-1">
                        <?= $manufacturer; ?>
                    </h4>
                    <div class="mt-4 mb-5">
                        <?= $category_description; ?>
                    </div>
                    <a href="<?= get_term_link($category) ?>" class="btn-custom ball py-1 ms-3 ms-lg-0">
                        <span class="text-green">مشاهده</span>
                    </a>
                </div>
                <div class="col-lg-6 translate-middle-lg-y">
                    <div class="swiper overflow-visible swiper2">
                        <div class="swiper-wrapper">
                            <?php
                            if ($gallery) {
                            echo 'image';
                                // Shuffle the array to randomize the order
                                shuffle($gallery);

                                // Limit the number of items to 6
                                $limitedGallery = array_slice($gallery, 0, 6);

                                foreach ($limitedGallery as $image) {
                                    ?>
                                    <div class="swiper-slide">
                                        <img class="rounded-2 object-fit w-100 bg-warning" height="450"
                                             src="<?php echo esc_url($image['url']); ?>"
                                             alt="<?php echo esc_attr($image['alt']); ?>"/>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <!--                             If we need pagination-->
                        <div class="swiper-pagination w-100 px-0 mx-0 mb-n4 start-0 rounded-pill d-flex justify-content-center p-2">
                            <div class="custom-pagination-item" data-index="0"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php
endforeach;
?>