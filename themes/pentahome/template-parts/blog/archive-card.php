<div class="col-12 col-md-6 col-xl-4 p-2 overflow-hidden portfolio_card">
    <div class="w-100 h-100 position-relative p-0 overflow-hidden" data-aos="fade-down" data-aos-duration="500" data-aos-delay="<?= $j; ?>0">
        <img class="object-fit-cover w-100" height="350"
             src="<?php echo esc_url(the_post_thumbnail_url()); ?>"
             alt="<?php echo get_the_title(); ?>"/>
        <a href="<?php the_permalink(); ?>"
           class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center align-items-start bg-primary bg-opacity-75 portfolio_description gap-3 px-3 px-lg-5">
            <div class="text-white text-opacity-75 text-justify">
                <?php echo wp_trim_words(get_the_content(), 30); ?>
            </div>
            <div class="d-flex gap-2 text-white align-items-center" data-aos="fade-up" data-aos-delay="300">
                <svg width="15" height="15" fill="currentColor" class="bi bi-stopwatch" viewBox="0 0 16 16">
                    <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5z"/>
                    <path
                        d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64l.012-.013.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5M8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3"/>
                </svg>
                <span class="fw-bold"><?= do_shortcode('[reading_time]') ?></span>
                <span>دقیقه</span>
            </div>
            <div class="d-flex gap-2 text-white justify-items-center align-items-center" data-aos="fade-down" data-aos-delay="300">
                <svg width="15" height="15" fill="currentColor"
                     class="bi bi-calendar3" viewBox="0 0 16 16">
                    <path
                        d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857z"/>
                    <path
                        d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                </svg>
                <?= shamsi_date('d F, Y', get_the_time('U')); ?>
            </div>
        </a>
    </div>
        <h3 class="fs-6 bg-primary p-3 mb-0 text-center text-white"><?php echo get_the_title(); ?></h3>
</div>