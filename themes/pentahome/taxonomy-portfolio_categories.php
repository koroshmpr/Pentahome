<?php get_header();

$current_category_id = get_queried_object_id();
$id = 'portfolio_categories_' . $current_category_id;
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
    <section class="container py-3 d-flex justify-content-lg-center align-items-center gap-3">
    <div class="text-secondary border p-2 bg-secondary bg-opacity-10 rounded-2">
        <svg width="25" height="25" fill="currentColor" class="bi bi-funnel" viewBox="0 0 16 16">
            <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2z"/>
        </svg>
    </div>
    <ul class="category-list d-flex justify-content-md-center gap-3 mb-0 py-2 align-items-center list-unstyled justify-content-start pe-3 pe-lg-0">
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

    <li class="category-filter__list border col-auto border-secondary py-2 rounded-2 px-4 text-secondary">
        <label class="d-flex align-items-start gap-2">
            <input type="checkbox" class="category-filter" value="<?= $subcategory->term_id; ?>">
            <p class="mb-0"><?= $subcategory_name; ?></p>
        </label>
    </li>
<?php }
if ($subcategories) { ?>
    </ul>
    </section>
<?php } ?>
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
    <section class="masonry justify-content-center product-cards">
        <?php while ($loop->have_posts()) :
            $loop->the_post();
            $post_id = get_the_ID();
            $category_ids = wp_get_post_terms(get_the_ID(), 'portfolio_categories', array('fields' => 'ids'));
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