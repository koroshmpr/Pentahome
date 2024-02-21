<?php if (!is_front_page()) { ?>
    <footer class="bg-warning py-5 overflow-hidden h-100">
        <div class="container">
            <div class="row row-cols-lg-2">
                <div class="text-center">
                    <a aria-label="logo-footer" href="/">
                        <?= get_field('logo_footer', 'option'); ?>
                    </a>
                    <div class="d-flex align-items-center gap-3 justify-content-center">
                        <?php get_template_part('template-parts/social-media'); ?>
                    </div>
                </div>
                <div class="col-lg-5 align-self-center px-4 px-lg-5 mx-lg-auto pb-4 pb-lg-0">
                    <div class="pt-4 row gap-3">
                        <address class="mb-0 text-primary fs-5">
                            <i class="bi bi-geo-alt fs-4 text-primary me-3"></i>
                            <?= get_field('address', 'option'); ?>
                        </address>
                        <?php get_template_part('template-parts/phones'); ?>
                        <?php $email = get_field('email', 'option'); ?>
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
