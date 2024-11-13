<?php get_header(); ?>

<?php $gallery = get_field('gallery'); ?>
    <section class="container-fluid">
        <?php
        if (has_excerpt()) {
            ob_start();
            the_excerpt(); // Capture the output of the_excerpt
            $content = ob_get_clean(); // Store the output in $content
        } else {
            $content = wp_trim_words(get_the_content(), 30);
        }

        $args = array(
            'title' => get_the_title(),
            'imgUrl' => get_the_post_thumbnail_url(),
            'content' => $content
        );
        get_template_part('template-parts/page_banner', null, $args);
        ?>

        <div class="masonry justify-content-center mt-2">
            <?php
            $i = 0;
            if ($gallery): ?>
                <?php foreach ($gallery as $image): ?>
                    <div class="masonry-item col-lg-6 p-2">
                        <img class="object-fit rounded-1 img-fluid bg-warning w-100"
                             src="<?php echo esc_url($image['url']); ?>"
                             alt="<?php echo esc_attr($image['alt']); ?>"/>
                    </div>
                    <?php
                    $i++;
                endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
<?php get_footer(); ?>