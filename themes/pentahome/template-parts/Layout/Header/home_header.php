<header class="position-fixed z-10 w-100 bg-secondary">
    <nav class="navbar py-0">
        <div class="container">
            <div class="w-100 d-flex align-items-center justify-content-between">
                <button class="btn p-0 border-0" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                    <div class="hamburger-menu" id="hamburger-menu" aria-label="menu offcanvas">
                        <div class="menu-bar1"></div>
                        <div class="menu-bar2"></div>
                        <div class="menu-bar3"></div>
                    </div>
                </button>
                <div class="offcanvas offcanvas-start bg-secondary" tabindex="-1" id="offcanvasRight"
                     aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title mx-auto ps-4"
                            id="offcanvasRightLabel"><?php get_template_part('template-parts/logo_brand'); ?></h5>
                        <button type="button" class="btn-close bg-white" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body d-flex flex-column justify-content-between align-items-center pt-lg-5">
                        <?php
                        $locations = get_nav_menu_locations();
                        $menu = wp_get_nav_menu_object($locations['headerMenuLocation']);
                        if ($menu) :
                            wp_nav_menu(array(
                                'theme_location' => 'headerMenuLocation',
                                'menu_class' => 'navbar-nav gap-2 align-items-center flex-wrap',
                                'container' => false,
                                'menu_id' => 'navbarHomeMenu',
                                'item_class' => 'nav-item ', // Add 'dropdown' class to top-level menu items
                                'link_class' => 'nav-link text-white fs-5', // Add 'nav-link' and 'dropdown-toggle' classes to menu item links
                                'depth' => 2,
                            ));
                        endif;
                        ?>

                        <div class="d-flex gap-5 justify-content-center">
                            <div class="d-flex justify-content-center align-items-center gap-3">
                                <?php get_template_part('template-parts/social-media'); ?>
                            </div>
                            <div>
                                <div class="d-flex align-items-start gap-3">
                                    <ul class="list-unstyled mb-0 d-flex flex-column align-items-start justify-content-start">
                                        <?php
                                        $textClass = 'text-white';
                                        $args = array(
                                            'textClass' => $textClass,
                                        );
                                        get_template_part('template-parts/phones', null, $args);
                                        ?>
                                        <li class="d-inline-flex gap-3 align-items-center">
                                            <i class="bi bi-envelope fs-4 text-primary"></i>
                                            <a class="text-white" href="mailto:<?= get_field('email', 'option'); ?>">
                                                <?= get_field('email', 'option'); ?>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php get_template_part('template-parts/logo_brand'); ?>
                <div class="d-none d-lg-flex align-items-center gap-3">
                    <?php
                    while (have_rows('social', 'option')): the_row() ?>
                        <a target="_blank" aria-label="<?= get_sub_field('name', 'option') ?>"
                           href="<?= get_sub_field('link')['url'] ?>">
                            <?= get_sub_field('icon') ?>
                        </a>
                    <?php
                    endwhile; ?>
                </div>
            </div>
        </div>
    </nav>
</header>