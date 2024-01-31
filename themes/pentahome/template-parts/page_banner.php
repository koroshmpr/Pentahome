<section class="w-100 object-fit position-relative categories-hero"
         style="background: url('<?= $args['imgUrl'] ?? ''; ?>');" data-aos="fade-down" data-aos-duration="500">
    <div class="d-inline-flex flex-wrap align-content-center align-items-center gap-4 ps-3 py-3 title position-absolute start-0 top-0 bottom-0 end-0">
        <hr class="text-white d-none d-md-block opacity-100 rounded-pill bg-white" style="width: 40px" data-aos="fade-left"
            data-aos-duration="500">
        <h1 class="display-1 fw-bold text-white" data-aos="fade-left" data-aos-duration="500" data-aos-delay="150">
            <?= $args['title'] ?? get_the_title(); ?>
        </h1>
        <?php
        if (isset($args['content']) && !empty($args['content'])) { ?>
            <article class="col-11 mx-auto text-white">
                <?= $args['content']; ?>
            </article>
        <?php } ?>
    </div>
</section>
<?php
//$pageBanner = '';
//$args= array(
//            'title' => get_the_title(),
//            'imgUrl' => get_the_post_thumbnail_url(),
//            'content' => get_the_content()
//);
//get_template_part('template-parts/page_banner' , null, $args);
//?>
