<?php get_header();

$current_category_id = get_queried_object_id();
$id = 'works_categories_' . $current_category_id;
$thumbnail = get_field('thumbnail-image', $id);

if ($thumbnail) {
    $thumbnail_url = $thumbnail['url'];
    $thumbnail_title = $thumbnail['title'];
}
?>

<?php
$pageBanner = $thumbnail_url;
$args = array(
    'title' => single_cat_title('', false),
    'content' => category_description(),
    'imgUrl' => $pageBanner,
);
get_template_part('template-parts/page_banner', null, $args);
?>
    <div class="container">
        <ul class="category-list d-flex justify-content-md-center gap-3 mb-0 py-2 py-lg-4 align-items-center list-unstyled justify-content-start pe-3 pe-lg-0">
            <?php
            $current_category = get_queried_object(); // Get the current category
            $taxonomy = 'works_categories';

            // Query child categories of the current category
            $child_args = array(
                'taxonomy' => $taxonomy,
                'child_of' => $current_category->term_id,
                'hide_empty' => 0,
            );

            $subcategories = get_categories($child_args);
            if ($subcategories) {
                // Add the "Select All" option
                ?>
                <li class="category-filter__list border col-auto border-secondary py-2 rounded-2 px-4 text-secondary active">
                    <label class="d-flex align-items-start gap-2">
                        <input type="checkbox" class="category-filter" value="all">
                        <p class="mb-0">همه</p>
                    </label>
                </li>
                <?php
            }
            foreach ($subcategories as $subcategory) {
                $thumbnail_id = get_term_meta($subcategory->term_id, 'thumbnail_id', true);
                $thumbnail_url = wp_get_attachment_image_url($thumbnail_id, 'thumbnail');
                $subcategory_name = $subcategory->name; ?>

                <li class="category-filter__list border border-secondary py-2 rounded-2 px-4 text-secondary">
                    <label class="d-flex align-items-start gap-2">
                        <input type="checkbox" class="category-filter" value="<?= $subcategory->term_id; ?>">
                        <p class="mb-0"><?= $subcategory_name; ?></p>
                    </label>
                </li>
            <?php } ?>
        </ul>
    </div>
<?php

// Filter variables
$selected_categories = isset($_GET['category']) ? explode(',', $_GET['category']) : array();


$args = array(
    'post_type' => 'works',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'works_categories',
            'field' => 'slug',
            'terms' => get_queried_object()->slug,
        ),
    ),
);
$loop = new WP_Query($args);

if ($loop->have_posts()) :
    $i = 0;
    ?>
    <section class="masonry justify-content-center product-cards">
        <?php while ($loop->have_posts()) :
            $loop->the_post();
            $post_id = get_the_ID();
            $category_ids = wp_get_post_terms(get_the_ID(), 'works_categories', array('fields' => 'ids'));
            $category_string = implode(',', $category_ids);
            ?>
            <div class="masonry-item col-12 col-md-6 p-2 overflow-hidden product-card"
                 data-categories="<?php echo $category_string; ?>">
                <div class="w-100 h-100 position-relative portfolio_card p-0 rounded-1 overflow-hidden">
                    <img class="object-fit rounded-1 w-100 img-fluid bg-warning"
                         src="<?php echo esc_url(the_post_thumbnail_url()); ?>"
                         alt="<?php echo get_the_title(); ?>"/>
                    <a href="<?php the_permalink(); ?>"
                       class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column rounded-1 justify-content-center align-items-start bg-primary bg-opacity-75 portfolio_description gap-3 px-5">
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