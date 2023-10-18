<?php get_header(); ?>

<?php $gallery = get_field('gallery'); ?>
    <section class="container-fluid">
        <div class="masonry justify-content-center">
            <?php
            $i = 0;
            if ($gallery): ?>
                <?php foreach ($gallery as $image): ?>
                    <div class="masonry-item col-lg-6 p-2">
                        <img class="object-fit img-fluid"
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