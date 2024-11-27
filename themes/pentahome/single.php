<?php get_header();
$sideBar = get_field('sidebar', 'option');
$tableOfContent = get_field('table_of_content', 'option');
$min_heading = $tableOfContent['min-heading'] ?? 2;
$max_heading = $tableOfContent['max-heading'] ?? 4;
$args = array(
    'title' => get_the_title(),
    'imgUrl' => get_the_post_thumbnail_url(),
);
get_template_part('template-parts/page_banner', null, $args);
?>
    <section
            class="d-flex justify-content-lg-evenly justify-content-center bg-primary bg-opacity-10 align-items-stretch position-relative flex-wrap">
        <?php if (!$sideBar):
            echo do_shortcode('[TOC from_tag="' . $min_heading . '" to_tag="' . $max_heading . '" sideBar="' . $sideBar . '"]');
        endif; ?>
        <article id="post-content"
                 class="p-3 py-lg-5<?= $sideBar ? ' col-xl-9' : ' col-xl-10' ?> text-justify col-md-11 col-12 text-dark">
            <?php the_content(); ?>
        </article>
        <?php
        if ($sideBar):
            ?>
            <aside id="sidebar" style="<?= current_user_can('administrator') ? 'margin-top:32px!important;' : ''; ?>"
                   class="col-lg-3 col-xl-2 position-lg-fixed lazy bg-white top-0 bottom-0 end-0 z-10 col-12 border-end border-start border-primary mt-2 mt-lg-0">
                <button id="sidebarBtn"
                        class="py-2 d-lg-flex d-none justify-content-center align-items-center w-100 shadow-sm rounded-0 bg-primary text-white btn text-white">
                    <svg id="menu-icon" width="25" height="25" fill="currentColor" class="bi bi-list"
                         viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                              d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
                    </svg>
                    <svg id="list-icon" width="25" height="25" fill="currentColor" class="bi bi-card-text"
                         viewBox="0 0 16 16">
                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                        <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8m0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5"/>
                    </svg>
                </button>
                <?php
                $args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'orderby' => 'rand',
                    'posts_per_page' => 2,
                    'ignore_sticky_posts' => true,
                    'post__not_in' => array(get_the_ID()), // Exclude the current post
                );
                $loop = new WP_Query($args);
                if ($loop->have_posts()) :
                    $i = 0; ?>
                    <div class="bg-primary p-3">
                        <p class="fw-bold fs-5 mb-3 text-white">مقالات مرتبط</p>
                        <div class="row overflow-hidden">
                            <?php /* Start the Loop */
                            while ($loop->have_posts()) :
                                $loop->the_post(); ?>
                                <a data-aos="fade-right" data-aos-delay="<?= $i; ?>0" data-aos-duration="500"
                                   href="<?php echo get_the_permalink(); ?>" class="d-flex align-items-center my-2">
                                    <img class="rounded img-fluid object-fit col-3" style="aspect-ratio: 1;"
                                         src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                                    <div class="ps-3 flex-grow-1">
                                        <p class="fw-bold text-white text-justify mb-2"><?php echo get_the_title(); ?></p>
                                        <div class="d-flex align-items-center gap-2 text-dark">
                                            <?php
                                            $category_detail = get_the_category($post->ID); // $post->ID
                                            foreach ($category_detail as $category) { ?>
                                                <span class="small px-2 py-1 bg-white text-dark rounded"><?php echo $category->name ?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </a>
                                <?php
                                $i += 5;
                            endwhile; ?>
                        </div>
                    </div>
                <?php endif;
                wp_reset_postdata(); ?>

                <?= do_shortcode('[TOC from_tag="' . $min_heading . '" to_tag="' . $max_heading . '" sideBar="' . $sideBar . '"]'); ?>
            </aside>
            <script>
                const btnSidebar = document.getElementById('sidebarBtn');
                const sidebar = document.getElementById('sidebar');
                const listIcon = document.getElementById('list-icon');
                const menuIcon = document.getElementById('menu-icon');

                // Initial state setup
                menuIcon.style.display = 'inline'; // Show menu icon initially
                listIcon.style.display = 'none';  // Hide list icon initially

                btnSidebar.addEventListener('click', function () {
                    // Toggle sidebar translation
                    const isTranslated = sidebar.style.transform === 'translateY(95%)';
                    sidebar.style.transform = isTranslated ? 'translateY(0)' : 'translateY(95%)';

                    // Toggle the `w-100` class on the button
                    btnSidebar.classList.toggle('w-100');
                    sidebar.classList.toggle('bg-white');

                    // Toggle icons visibility
                    if (isTranslated) {
                        menuIcon.style.display = 'inline';
                        listIcon.style.display = 'none';
                    } else {
                        menuIcon.style.display = 'none';
                        listIcon.style.display = 'inline';
                    }
                });

            </script>
        <?php endif; ?>
    </section>
<?php
if (!$sideBar):?>
    <?php
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'orderby' => 'rand',
        'posts_per_page' => 3,
        'ignore_sticky_posts' => true,
        'post__not_in' => array(get_the_ID()), // Exclude the current post
    );
    $i = 0;
    $j = 0;
    $loop = new WP_Query($args);
    if ($loop->have_posts()) : $i = 0; ?>
        <section class="bg-primary bg-opacity-25 py-4 p-lg-5 p-3">
            <p class="fw-bold fs-4 mb-3 text-primary text-center">مقالات مرتبط</p>
            <div class="row overflow-hidden">
                <?php
                /* Start the Loop */
                while ($loop->have_posts()) :
                    $loop->the_post();
                    get_template_part('template-parts/blog/archive-card');
                    $j += 20;
                endwhile; ?>
            </div>
        </section>
    <?php endif;
    wp_reset_postdata();
endif;
get_footer(); ?>