<header class="position-fixed z-10 w-100 bg-secondary">
    <nav class="navbar py-0">
        <div class="container">
            <div class="w-100 d-flex align-items-center justify-content-between">
                <button class="btn p-0 border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                    <div class="hamburger-menu" id="hamburger-menu">
                        <div class="menu-bar1"></div>
                        <div class="menu-bar2"></div>
                        <div class="menu-bar3"></div>
                    </div>
                </button>
                <div class="offcanvas offcanvas-bottom bg-secondary bg-opacity-75" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasRightLabel"></h5>
                        <button type="button" class="btn-close bg-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <?php
                        $locations = get_nav_menu_locations();
                        $menu = wp_get_nav_menu_object($locations['headerMenuLocation']);
                        if ($menu) :
                            wp_nav_menu(array(
                                'theme_location' => 'headerMenuLocation',
                                'menu_class' => 'navbar-nav gap-2 align-items-center flex-wrap',
                                'container' => false,
                                'menu_id' => 'navbarTogglerMenu',
                                'item_class' => 'nav-item ', // Add 'dropdown' class to top-level menu items
                                'link_class' => 'nav-link text-white fs-3', // Add 'nav-link' and 'dropdown-toggle' classes to menu item links
                                'depth' => 1,
                            ));
                        endif;
                        ?>
                    </div>
                </div>
            <?php get_template_part('template-parts/logo_brand');?>
                <div class="d-none d-lg-flex align-items-center gap-3">
                    <?php
                    while (have_rows('social','option')): the_row() ?>
                        <a href="<?= get_sub_field('link')['url'] ?>">
                            <?= get_sub_field('icon') ?>
                        </a>
                    <?php
                    endwhile; ?>
                </div>
            </div>
        </div>
    </nav>
</header>