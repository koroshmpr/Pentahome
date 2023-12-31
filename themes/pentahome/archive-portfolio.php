<?php get_header();
/* Template Name: archive Portfolio */

$thumbnail = get_field('thumbnail-image', 111);
?>
<?php
$pageBanner = $thumbnail['url'];
$args = array(
    'title' => 'نمونه کارها',
    'imgUrl' => $pageBanner,
);
get_template_part('template-parts/page_banner', null, $args);
?>
    <section class="container">
        <ul class="category-list d-flex justify-content-md-center gap-3 mb-0 py-4 align-items-center list-unstyled justify-content-start pe-3 pe-lg-0">
            <?php
            $current_category = get_queried_object(); // Get the current category
            $taxonomy = 'portfolio_categories';
            // Query child categories of the current category
            $child_args = array(
                'taxonomy' => $taxonomy,
                'parent' => 0, // 0 indicates parent categories
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
                echo '<input type="checkbox" class="category-filter mt-1" value="' . $subcategory->term_id . '"> ';
                echo '<p class="mb-0"> ' . $subcategory_name . '</p>';
                if ($thumbnail_url) {
                    echo '<img class="img-thumbnail ms-auto me-0" width="40" height="40" src="' . $thumbnail_url . '">';
                }
                echo '</label>';
                echo '</li>';
            }
            ?>
        </ul>
    </section>
    <?php
    // Filter variables
    $selected_categories = isset($_GET['category']) ? explode(',', $_GET['category']) : array();
    $args = array(
        'post_type' => 'portfolio',
        'posts_per_page' => -1,
    );
    $loop = new WP_Query($args);

    if ($loop->have_posts()) :
        $i = 0;
        ?>
        <section class="masonry justify-content-center product-cards">
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
        </section>
    <?php endif; ?>

<?php get_footer(); ?>
