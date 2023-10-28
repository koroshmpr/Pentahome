<?php get_header(); ?>

<?php $gallery = get_field('gallery'); ?>
    <section class="container-fluid">
        <div class="d-inline-flex align-items-end gap-4 ps-3 py-3 title" data-aos="fade-left" data-aos-duration="500">
            <hr class="text-dark mb-4 opacity-100 rounded-pill bg-dark" style="width: 40px">
            <h1 class="display-1 fw-bold text-secondary">
                <?= the_title(); ?>
            </h1>
        </div>
        <div class="masonry justify-content-center">
            <?php
            $i = 0;
            if ($gallery): ?>
                <?php foreach ($gallery as $image): ?>
                    <div class="masonry-item col-lg-6 p-2">
                        <img class="object-fit img-fluid bg-warning w-100"
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