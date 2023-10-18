<?php if (!is_front_page()) { ?>
    <footer class="bg-primary bg-opacity-25 py-5 overflow-hidden mt-4">
        <div class="container">
            <div class="row row-cols-lg-2">
                <div class="text-center">
                    <a aria-label="logo-footer" href="/">
                        <?= get_field('logo_footer', 'option'); ?>
                    </a>
                    <div class="d-flex align-items-center gap-3 justify-content-center">
                        <?php
                        if (have_rows('social', 'option')):
                            // Loop through rows.
                            while (have_rows('social', 'option')) : the_row(); ?>
                                <a class="text-primary" href="<?= get_sub_field('link', 'option')['url']; ?>">
                                    <?= get_sub_field('icon', 'option'); ?>
                                </a>
                            <?php endwhile;
                        endif; ?>
                    </div>
                </div>
                <div class="col-lg-5 align-self-center px-4 px-lg-5 mx-lg-auto pb-4 pb-lg-0">
                    <div class="pt-4 row gap-3">
                        <address class="mb-0 text-primary fs-5">
                            <i class="bi bi-geo-alt fs-4 text-primary me-3"></i>
                            <?= get_field('address', 'option'); ?>
                        </address>
                        <?php $phone = get_field('phone', 'option'); ?>
                        <?php $email = get_field('email', 'option'); ?>
                        <a href="tel:<?= $phone; ?>">
                            <i class="bi bi-telephone fs-4 text-primary me-3"></i>
                            <?= $phone; ?>
                        </a>
                        <a href="mailto:<?= $email; ?>">
                            <i class="bi bi-envelope fs-4 text-primary me-3"></i>
                            <?= $email; ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    <?php get_template_part('template-parts/backto-top');
    echo '</div>';
} ?>
</main>
<?php wp_footer(); ?>
</body>
</html>
