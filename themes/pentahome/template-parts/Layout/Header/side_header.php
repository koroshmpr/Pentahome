<header class="col-lg-2 position-fixed top-0 bottom-0 end-0 z-top">
    <button class="btn bg-dark bg-opacity-25 d-lg-none mt-2" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasExample" aria-controls="offcanvasExample" data-aos="fade-right" aria-label="menu offcanvas">
        <div class="hamburger-menu" id="hamburger-menu">
            <div class="menu-bar1 bg-primary"></div>
            <div class="menu-bar2 bg-primary"></div>
            <div class="menu-bar3 bg-primary"></div>
        </div>
    </button>
    <div class="py-2 d-none d-lg-flex flex-column justify-content-between h-100">
        <a class="d-flex justify-content-end" href="<?= home_url() ?>">
            <?= get_field('logo_footer', 'option'); ?>
        </a>
        <?php
        $locations = get_nav_menu_locations();
        $menu = wp_get_nav_menu_object($locations['headerMenuLocation']);
        if ($menu) :
            wp_nav_menu(array(
                'theme_location' => 'headerMenuLocation',
                'menu_class' => 'navbar-nav gap-2 align-items-start flex-wrap mb-auto translate-30-x',
                'container' => false,
                'menu_id' => 'navbarMenu',
                'item_class' => 'nav-item ', // Add 'dropdown' class to top-level menu items
                'link_class' => 'nav-link fs-6 text-dark', // Add 'nav-link' and 'dropdown-toggle' classes to menu item links
                'depth' => 2,
            ));
        endif;
        ?>
        <div class="d-flex justify-content-center align-items-center gap-3 pb-3 flex-wrap">
            <?php if (is_singular('portfolio')) { ?>
                <div class="call-button_container d-flex justify-content-center flex-column align-items-center col-12">
                    <a class="call-button bg-primary text-white rounded-circle d-flex justify-content-center align-items-center"
                       href="tel:<?= get_field('phone', 'option'); ?>">
                        <svg width="30" height="30" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                            <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
                        </svg>
                    </a>
                    <div class="text-center my-3">برای سفارش تماس بگیرید</div>
                </div>
            <?php }
            get_template_part('template-parts/social-media'); ?>
        </div>
    </div>
</header>
<div class="offcanvas offcanvas-start mobile-offcanvas bg-secondary" tabindex="-1" id="offcanvasExample"
     aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header justify-content-end pe-4 align-items-center">
        <h5 class="offcanvas-title mx-auto ps-4" id="offcanvasRightLabel"><?php get_template_part('template-parts/logo_brand');?></h5>
        <button type="button" class="btn-close fs-3 bg-white bg-opacity-50" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column justify-content-between">
        <?php
        $locations = get_nav_menu_locations();
        $menu = wp_get_nav_menu_object($locations['headerMenuLocation']);
        if ($menu) :
            wp_nav_menu(array(
                'theme_location' => 'headerMenuLocation',
                'menu_class' => 'navbar-nav flex-wrap mt-5 mb-auto align-items-center',
                'container' => false,
                'menu_id' => 'navbarMenuMobile',
                'item_class' => 'nav-item ', // Add 'dropdown' class to top-level menu items
                'link_class' => 'nav-link fs-4 text-white', // Add 'nav-link' and 'dropdown-toggle' classes to menu item links
                'depth' => 2,
            ));
        endif;
        ?>
        <div class="d-flex justify-content-center align-items-center gap-3 pb-3">
            <?php get_template_part('template-parts/social-media'); ?>
        </div>
    </div>
</div>