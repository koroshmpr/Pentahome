<div class="px-0 mx-0 container-fluid<?= is_front_page() ? ' swiper-slide' : ' ' ?> custom-height-slide row align-items-end" data-hash="footer">
    <div class="bg-warning py-5">
        <div class="h-100 d-flex justify-content-center align-items-center">
            <div class="row w-100">
                <div class="col-lg-6">
                    <div class="d-flex align-items-center justify-content-start flex-column gap-lg-3">
                        <a aria-label="logo-footer" href="/">
                            <?= get_field('logo_footer' , 'option');?>
                        </a>
                        <?php
                        $locations = get_nav_menu_locations();
                        $menu = wp_get_nav_menu_object($locations['headerMenuLocation']);
                        if ($menu) :
                            wp_nav_menu(array(
                                'theme_location' => 'footerLocationOne',
                                'menu_class' => 'list-unstyled d-flex gap-2 align-items-center flex-wrap',
                                'container' => false,
                                'menu_id' => 'navbarTogglerMenu',
                                'item_class' => 'nav-item ', // Add 'dropdown' class to top-level menu items
                                'link_class' => 'nav-link text-primary', // Add 'nav-link' and 'dropdown-toggle' classes to menu item links
                                'depth' => 1,
                            ));
                        endif;
                        ?>
                    </div>
                </div>
                <div class="col-lg-6 ps-lg-5">
                    <div class="d-flex flex-column justify-content-start align-items-lg-start align-content-center gap-lg-5">
                        <div class="order-last order-lg-first d-inline-flex gap-3 align-items-center justify-content-center  pb-3 pb-lg-0">
                            <h5 class="text-start">
                                شبکه های اجتماعی:
                            </h5>
                            <div class="d-flex align-items-center gap-3">
                                <?php get_template_part('template-parts/social-media');?>
                            </div>
                        </div>
                        <div class="d-grid d-lg-flex gap-3 align-items-start justify-content-center py-4 py-lg-0">
                            <h5 class="text-start mb-0">
                                راه های تماس:
                            </h5>
                            <div class="d-flex align-items-start gap-3">
                                <ul class="list-unstyled mb-0 d-flex flex-column align-items-start justify-content-start">
                                    <li class="d-inline-flex gap-3 align-items-center">
                                        <i class="bi bi-telephone fs-4 text-primary"></i>
                                        <a class="" href="tel:<?= get_field('phone', 'option'); ?>">
                                            <?= get_field('phone', 'option'); ?>
                                        </a>
                                    </li>
                                    <li class="d-inline-flex gap-3 align-items-center">
                                        <i class="bi bi-envelope fs-4 text-primary"></i>
                                        <a class="" href="mailto:<?= get_field('email', 'option'); ?>">
                                            <?= get_field('email', 'option'); ?>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>