<?php get_header(); ?>
    <section class="container-fluid p-4 p-lg-5 min-vh-100">
        <div class="row gap-4">
            <h1><?= get_the_title(); ?></h1>
            <img class="object-fit img-fluid"
                 src="<?php echo esc_url(the_post_thumbnail_url()); ?>"
                 alt="<?php echo get_the_title(); ?>"/>
            <artcile>
                <?= get_the_content(); ?>
            </artcile>
        </div>
    </section>
<?php get_footer(); ?>