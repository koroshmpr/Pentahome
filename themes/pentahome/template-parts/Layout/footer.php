<footer class="bg-warning mt-5 pb-5 pt-2 container-fluid<?= is_front_page() ? ' swiper-slide' : ' '; ?> custom-height-slide d-lg-flex d-grid justify-content-center align-items-lg-center align-items-start"
        data-hash="footer">
    <div class="col-lg-6 d-flex align-items-center justify-content-start flex-column gap-lg-3">
        <a aria-label="logo-footer" href="<?= esc_url(get_home_url()) ?>">
            <?= get_field('logo_footer', 'option'); ?>
        </a>
        <?php
        $locations = get_nav_menu_locations();
        $menu = wp_get_nav_menu_object($locations['headerMenuLocation']);
        if ($menu) :
            wp_nav_menu(array(
                'theme_location' => 'footerLocationOne',
                'menu_class' => 'list-unstyled d-flex gap-2 align-items-center flex-wrap justify-content-center',
                'container' => false,
                'menu_id' => 'navbarTogglerMenu',
                'item_class' => 'nav-item ', // Add 'dropdown' class to top-level menu items
                'link_class' => 'nav-link text-primary', // Add 'nav-link' and 'dropdown-toggle' classes to menu item links
                'depth' => 1,
            ));
        endif;
        ?>
    </div>
    <div class="col-lg-6 ps-lg-5 px-3 d-flex flex-column justify-content-start align-items-lg-start align-content-center gap-lg-2 pb-5 pb-lg-0">
        <div class="order-last order-lg-first d-inline-flex gap-3 align-items-center justify-content-center pt-2 pb-5 pb-lg-2 mb-lg-3 ">
            <div class="d-flex align-items-center gap-3">
                <?php get_template_part('template-parts/social-media'); ?>
            </div>
        </div>
        <?php $svgSize = '30'; ?>
        <address class="d-flex mb-0 gap-3 text-primary align-items-start justify-content-start">
            <svg width="<?= $svgSize; ?>" height="<?= $svgSize; ?>" fill="currentColor"
                 class="bi bi-geo-alt" viewBox="0 0 16 16">
                <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/>
                <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
            </svg>
            <?= get_field('address', 'option'); ?>
        </address>
        <ul class="list-unstyled mb-0 d-flex flex-column align-items-start justify-content-start gap-2">
            <?php get_template_part('template-parts/phones'); ?>
            <li class="d-inline-flex gap-3 align-items-center text-primary">
                <svg width="<?= $svgSize; ?>" height="<?= $svgSize; ?>" fill="currentColor"
                     class="bi bi-envelope" viewBox="0 0 16 16">
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
                </svg>
                <a href="mailto:<?= get_field('email', 'option'); ?>">
                    <?= get_field('email', 'option'); ?>
                </a>
            </li>
        </ul>
    </div>
</footer>