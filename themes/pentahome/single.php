<?php get_header();
$args = array(
    'title' => get_the_title(),
    'imgUrl' => get_the_post_thumbnail_url(),
);
get_template_part('template-parts/page_banner', null, $args);
?>
<section class="d-flex justify-content-lg-evenly align-items-start position-relative flex-wrap">
    <article
            class="p-4 py-lg-5 bg-primary text-justify bg-opacity-10 border-end border-start border-primary col-lg-9 text-dark">
        <?php the_content(); ?>
    </article>
    <aside class="col-lg-2 bg-primary bg-opacity-10 shadow-sm p-3 mt-4">
        <?php
        // Get the min-heading and max-heading values from the options
        $tableOfContent = get_field('table_of_content', 'option');
        $min_heading = $tableOfContent['min-heading'] ?? 2;
        $max_heading = $tableOfContent['max-heading'] ?? 4;

        // Output the TOC shortcode with the dynamic values
        echo do_shortcode('[TOC from_tag="' . $min_heading . '" to_tag="' . $max_heading . '"]');
        ?>
    </aside>
</section>
<?php get_footer(); ?>