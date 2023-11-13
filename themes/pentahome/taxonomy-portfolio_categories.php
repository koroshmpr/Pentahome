<?php get_header();

$current_category_id = get_queried_object_id();
$id = 'portfolio_categories_' . $current_category_id;
$thumbnail = get_field('thumbnail-image', $id);

if ($thumbnail) {
    $thumbnail_url = $thumbnail['url'];
    $thumbnail_title = $thumbnail['title'];
}
?>

<section>
    <div class="w-100 object-fit position-relative categories-hero" style="background: url('<?= $thumbnail_url; ?>');" data-aos="fade-down" data-aos-duration="500">
        <div class="d-inline-flex align-items-center gap-4 ps-3 py-3 title position-absolute start-0 top-0 bottom-0 end-0">
            <hr class="text-white mb-4 opacity-100 rounded-pill bg-white" style="width: 40px" data-aos="fade-left"
                data-aos-duration="500">
            <h1 class="display-1 fw-bold text-white" data-aos="fade-left" data-aos-duration="500" data-aos-delay="150">
                <?= single_cat_title('', false); ?>
            </h1>
        </div>
    </div>

    <div class="container">
        <ul class="category-list d-flex justify-content-lg-center gap-3 my-2 py-1 align-items-center list-unstyled justify-content-start overflow-scroll pe-3 pe-lg-0">
            <?php
            $current_category = get_queried_object(); // Get the current category
            $taxonomy = 'portfolio_categories';

            // Query child categories of the current category
            $child_args = array(
                'taxonomy' => $taxonomy,
                'child_of' => $current_category->term_id,
                'hide_empty' => 0,
            );

            $subcategories = get_categories($child_args);
            if ($subcategories) {
                // Add the "Select All" option
                echo '<li class="category-filter__list border border-secondary py-2 rounded-2 px-4 text-secondary">';
                echo '<label class="d-flex align-items-start gap-2">';
                echo '<input type="checkbox" class="category-filter" value="all"> '; // Use "all" as the value for "Select All"
                echo '<p class="mb-0">همه</p>';
                echo '</label>';
                echo '</li>';
            }
            foreach ($subcategories as $subcategory) {
                $thumbnail_id = get_term_meta($subcategory->term_id, 'thumbnail_id', true);
                $thumbnail_url = wp_get_attachment_image_url($thumbnail_id, 'thumbnail');
                $subcategory_name = $subcategory->name;

                echo '<li class="category-filter__list border border-secondary py-2 rounded-2 px-4 text-secondary">';
                echo '<label class="d-flex align-items-start gap-2">';
                echo '<input type="checkbox" class="category-filter" value="' . $subcategory->term_id . '"> ';
                echo '<p class="mb-0"> ' . $subcategory_name . '</p>';
                if ($thumbnail_url) {
                    echo '<img class="img-thumbnail ms-auto me-0" width="40" height="40" src="' . $thumbnail_url . '">';
                }
                echo '</label>';
                echo '</li>';
            }
            ?>
        </ul>

    </div>
    <?php

    // Filter variables
    $selected_categories = isset($_GET['category']) ? explode(',', $_GET['category']) : array();


    $args = array(
        'post_type' => 'portfolio',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'portfolio_categories',
                'field' => 'slug',
                'terms' => get_queried_object()->slug,
            ),
        ),
    );
    $loop = new WP_Query($args);

    if ($loop->have_posts()) :
        $i = 0;
        ?>
        <div class="masonry justify-content-center product-cards">
            <?php while ($loop->have_posts()) :
                $loop->the_post();
                $post_id = get_the_ID();
                $category_ids = wp_get_post_terms(get_the_ID(), 'portfolio_categories', array('fields' => 'ids'));
                $category_string = implode(',', $category_ids);
                ?>
                <div class="masonry-item col-12 col-md-6 p-2 overflow-hidden product-card"
                     data-categories="<?php echo $category_string; ?>">
                    <div class="w-100 h-100 position-relative portfolio_card p-0 overflow-hidden">
                        <img class="object-fit w-100 img-fluid bg-warning"
                             src="<?php echo esc_url(the_post_thumbnail_url()); ?>"
                             alt="<?php echo get_the_title(); ?>"/>
                        <a href="<?php the_permalink(); ?>"
                           class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center align-items-start bg-primary bg-opacity-75 portfolio_description gap-3 px-5">
                            <h3 class="fs-1 text-white"><?php echo get_the_title(); ?></h3>
                            <div class="text-white text-opacity-75">
                                <?php echo wp_trim_words(get_the_content(), 30); ?>
                            </div>
                        </a>
                    </div>
                </div>
            <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
    <?php endif; ?>
</section>

<?php get_footer(); ?>
