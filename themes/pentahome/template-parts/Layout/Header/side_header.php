<header class="col-lg-2 position-fixed top-0 bottom-0 end-0 z-top">
    <button class="btn bg-dark bg-opacity-25 d-lg-none mt-2" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasExample" aria-controls="offcanvasExample" data-aos="fade-right">
        <div class="hamburger-menu" id="hamburger-menu">
            <div class="menu-bar1 bg-primary"></div>
            <div class="menu-bar2 bg-primary"></div>
            <div class="menu-bar3 bg-primary"></div>
        </div>
    </button>
    <div class="py-2 d-none d-lg-flex flex-column justify-content-between h-100">
        <a class="d-flex justify-content-end" href="/">
            <?= get_field('logo_footer', 'option'); ?>
        </a>
        <?php
        $locations = get_nav_menu_locations();
        $menu = wp_get_nav_menu_object($locations['headerMenuLocation']);
        if ($menu) :
            wp_nav_menu(array(
                'theme_location' => 'headerMenuLocation',
                'menu_class' => 'navbar-nav gap-2 align-items-center flex-wrap mb-auto',
                'container' => false,
                'menu_id' => 'navbarMenu',
                'item_class' => 'nav-item ', // Add 'dropdown' class to top-level menu items
                'link_class' => 'nav-link fs-5 text-dark', // Add 'nav-link' and 'dropdown-toggle' classes to menu item links
                'depth' => 2,
            ));
        endif;
        ?>
                <div class="d-flex justify-content-center align-items-center gap-3 pb-3 flex-wrap">
                    <?php if(is_singular('portfolio')) {?>
                    <div class="call-button_container d-flex justify-content-center flex-column align-items-center col-12">
                        <a class="call-button bg-primary text-white rounded-circle d-flex justify-content-center align-content-center"
                           href="tel:<?= get_field('phone', 'option'); ?>">
                            <i class="bi bi-telephone"></i>
                        </a>
                        <div class="text-center my-3">برای سفارش تماس بگیرید</div>
                    </div>
                    <?php
                    }
                    while (have_rows('social', 'option')): the_row() ?>
                        <a href="<?= get_sub_field('link')['url'] ?>">
                            <?= get_sub_field('icon') ?>
                        </a>
                    <?php
                    endwhile; ?>
                </div>
    </div>
</header>
<div class="offcanvas offcanvas-start mobile-offcanvas" tabindex="-1" id="offcanvasExample"
     aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header justify-content-end pe-4">
        <button type="button" class="btn-close mt-3 fs-3" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column justify-content-between">
        <a class="d-flex justify-content-end" href="/">
            <?= get_field('logo_footer', 'option'); ?>
        </a>
        <?php
        $locations = get_nav_menu_locations();
        $menu = wp_get_nav_menu_object($locations['headerMenuLocation']);
        if ($menu) :
            wp_nav_menu(array(
                'theme_location' => 'headerMenuLocation',
                'menu_class' => 'navbar-nav flex-wrap mb-auto',
                'container' => false,
                'menu_id' => 'navbarMenuMobile',
                'item_class' => 'nav-item ', // Add 'dropdown' class to top-level menu items
                'link_class' => 'nav-link fs-5 text-secondary', // Add 'nav-link' and 'dropdown-toggle' classes to menu item links
                'depth' => 2,
            ));
        endif;
        ?>
        <div class="d-flex justify-content-center align-items-center gap-3 pb-3">
            <?php
            while (have_rows('social', 'option')): the_row() ?>
                <a href="<?= get_sub_field('link')['url'] ?>">
                    <?= get_sub_field('icon') ?>
                </a>
            <?php
            endwhile; ?>
        </div>
    </div>
</div>