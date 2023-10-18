<div class="pb-4 d-lg-flex justify-content-center align-content-center gap-4">
    <!--        <p class="fs-4 fw-bold text-center mb-0" data-aos="zoom-in" data-aos-duration="500">-->
    <!--            <span class="text-primary">اشتراک </span>گذاری-->
    <!--        </p>-->
    <?php
    // Get the current post URL
    $postUrl = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    // Get the post title and encode it for use in the share links
    $postTitle = urlencode(get_the_title());
    // Get the author's Twitter handle (replace "twitter" with your user meta key)
    $twitterHandle = get_the_author_meta('twitter');
    // Get the website name for use in the Twitter share link
    $websiteName = get_bloginfo('name');
    ?>
    <ul class="d-flex list-unstyled gap-2 m-0 align-items-center justify-content-center">
        <li data-aos="fade-up">
            <a class="bg-white p-2 rounded-circle shadow-sm"
               href="https://www.aparat.com/share?url=<?php echo urlencode($postUrl); ?>">
                <?php get_template_part('template-parts/svg/aparat'); ?>
            </a>
        </li>
        <li data-aos="fade-up" data-aos-delay="100">
            <a class="bg-white p-2 rounded-circle shadow-sm"
               href="https://telegram.me/share/url?url=<?php echo urlencode($postUrl); ?>&text=<?php echo $postTitle; ?>">
                <?php get_template_part('template-parts/svg/telegram', null, $args); ?>
            </a>
        </li>
        <li data-aos="fade-up" data-aos-delay="150">
            <a class="bg-white p-2 rounded-circle shadow-sm"
               href="https://www.youtube.com/share?url=<?php echo urlencode($postUrl); ?>">
                <?php get_template_part('template-parts/svg/youtube', null, $args); ?>
            </a>
        </li>
        <li data-aos="fade-up" data-aos-delay="200">
            <a class="bg-white p-2 rounded-circle shadow-sm"
               href="https://www.instagram.com/share?url=<?php echo urlencode($postUrl); ?>">
                <?php get_template_part('template-parts/svg/instagram', null, $args); ?>
            </a>
        </li>
        <li data-aos="fade-up" data-aos-delay="250">
            <a class="bg-white p-2 rounded-circle shadow-sm"
               href="https://twitter.com/intent/tweet?text=<?php echo urlencode('Check out this awesome post from ' . $websiteName . ': ') . $postTitle; ?>&url=<?php echo urlencode($postUrl); ?>&via=<?php echo urlencode($twitterHandle); ?>">
                <?php get_template_part('template-parts/svg/twitter', null, $args); ?>
            </a>
        </li>
        <li data-aos="fade-up" data-aos-delay="300">
            <a class="bg-white p-2 rounded-circle shadow-sm"
               href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode($postUrl); ?>&title=<?php echo $postTitle; ?>">
                <?php get_template_part('template-parts/svg/linkedin', null, $args); ?>
            </a>
        </li>
    </ul>
</div>