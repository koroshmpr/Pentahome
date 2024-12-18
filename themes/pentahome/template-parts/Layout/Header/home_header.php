<header class="position-fixed z-10 w-100 bg-secondary">
    <nav class="navbar py-0 container d-flex align-items-center justify-content-between">
        <button class="btn p-0 border-0 hamburger-menu" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" id="hamburger-menu"
                aria-label="menu offcanvas">
            <div class="menu-bar1"></div>
            <div class="menu-bar2"></div>
            <div class="menu-bar3"></div>
        </button>
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
    </nav>
</header>
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
            <ul class="list-unstyled mb-0 d-flex flex-column align-items-start justify-content-start">
                <?php
                $textClass = 'text-white';
                $args = array(
                    'textClass' => $textClass,
                );
                get_template_part('template-parts/phones', null, $args);
                ?>
                <li class="d-inline-flex gap-3 text-primary align-items-center">
                    <svg width="25" height="25" fill="currentColor" class="bi bi-envelope"
                         viewBox="0 0 16 16">
                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
                    </svg>
                    <a class="text-white" href="mailto:<?= get_field('email', 'option'); ?>">
                        <?= get_field('email', 'option'); ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>