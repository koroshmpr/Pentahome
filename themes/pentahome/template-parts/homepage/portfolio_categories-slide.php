<?php
$selectedCats = get_field('selected_cats');
$terms = get_terms('works_categories', array(
    'parent' => 0, // This will retrieve only top-level categories
));
foreach ($selectedCats as $category) :

    // Fetch and display portfolio item data (title, design, manufacturer, etc.) here
    $title = $category->name;;
    $id = 'works_categories_' . $category->term_id;
    $design = get_field('design_by', $id);
    $manufacturer = get_field('manufactured_by', $id);
    $gallery = get_field('gallery', $id);
    $category_description = $category->description;
    $engTitle = get_field('eng-title', $id);

    // Display the data as needed within the HTML structure
    ?>
    <div class="swiper-slide product_slide min-vh-100 min-vh-50" data-hash="products">
        <section class="container">
            <div class="row align-items-lg-center align-content-center justify-content-lg-between gap-2 gap-lg-0">
                <div class="col-lg-5 content-portfolio">
                    <div class="d-inline-flex align-items-center gap-3"
                         data-aos-delay="100">
                        <hr class="text-dark my-0 opacity-100 rounded-pill bg-dark">
                        <h2 class="display-5 fw-bold text-dark">
                            <?= $title;
                            if ($engTitle) { ?>
                                <span class="text-uppercase badge bg-primary text-white fs-4"> <?= $engTitle; ?></span>
                            <?php } ?>
                        </h2>
                    </div>
                    <?php if ($design) { ?>
                        <h3 class="text-primary fs-5 mt-3">
                            <?= $design; ?>
                        </h3>
                    <?php }
                    if ($manufacturer) { ?>
                        <h4 class="text-dark fs-5 mt-1">
                            <?= $manufacturer; ?>
                        </h4>
                    <?php }
                    if ($category_description) { ?>
                        <div class="my-lg-4 my-3">
                            <?= $category_description; ?>
                        </div>
                    <?php } ?>
                    <a href="<?= get_term_link($category) ?? ''; ?>" class="btn-custom ball py-1 ms-3 ms-lg-0">
                        <span class="text-green">مشاهده</span>
                    </a>
                </div>
                <div class="col-lg-7 translate-middle-lg-y">
                    <div class="swiper overflow-visible swiper2">
                        <div class="swiper-wrapper">
                            <?php
                            if ($gallery) {
                                // Shuffle the array to randomize the order
                                shuffle($gallery);

                                // Limit the number of items to 6
                                $limitedGallery = array_slice($gallery, 0, 6);

                                foreach ($limitedGallery as $image) {
                                    // Get the thumbnail URL for this image
                                    $thumbnail_url = wp_get_attachment_image_src($image['ID'], 'large'); // Replace 'thumbnail' with your preferred size
                                    $thumbnail_url = $thumbnail_url ? $thumbnail_url[0] : $image['url']; // Fallback to original if thumbnail not available
                                    ?>
                                    <div class="swiper-slide">
                                        <img class="portfolio-slider__image lazy rounded-1 object-fit w-100 bg-warning"
                                             height="500"
                                             src="<?php echo esc_url($thumbnail_url); ?>"
                                             alt="<?php echo esc_attr($image['alt']) ?? $title; ?>"/>
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