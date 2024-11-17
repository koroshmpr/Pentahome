<section class="w-100 object-fit position-relative categories-hero"
         style="background: url('<?= $args['imgUrl'] ?? ''; ?>');" data-aos="fade-down" data-aos-duration="500">
    <div class="d-inline-flex flex-wrap align-content-center align-items-center <?= is_singular('post') ? 'gap-1' : 'gap-4'; ?> ps-3 py-3 title position-absolute start-0 top-0 bottom-0 end-0">
        <hr class="text-white d-none d-md-block opacity-100 rounded-pill bg-white" style="width: 40px"
            data-aos="fade-right"
            data-aos-duration="500">
        <h1 class="display-1 fw-bold text-white" data-aos="fade-right" data-aos-duration="500" data-aos-delay="150">
            <?= $args['title'] ?? get_the_title(); ?>
        </h1>
        <?php
        if (is_singular('post')):
            ?>
            <div class="d-flex flex-wrap w-100 mt-3 text-white ps-lg-5 overflow-hidden">
                <div class="d-flex gap-2 align-items-center" data-aos="fade-up" data-aos-delay="300">
                    <svg width="15" height="15" fill="currentColor" class="bi bi-stopwatch" viewBox="0 0 16 16">
                        <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5z"/>
                        <path
                                d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64l.012-.013.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5M8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3"/>
                    </svg>
                    <span class="d-none d-lg-inline">زمان مطالعه</span>
                    <span class="fw-bold text-primary"><?= do_shortcode('[reading_time]') ?></span>
                    <span>دقیقه</span>
                </div>
                <div class="vr mx-3" data-aos="fade-out" data-aos-delay="300"></div>
                <div class="d-flex gap-2 justify-items-center align-items-center" data-aos="fade-down" data-aos-delay="300">
                    <svg width="15" height="15" fill="currentColor"
                         class="bi bi-calendar3" viewBox="0 0 16 16">
                        <path
                                d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857z"/>
                        <path
                                d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                    </svg>
                    <?= get_the_date('d  F , Y'); ?>
                </div>
            </div>
        <?php
        endif;
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