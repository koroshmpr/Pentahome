<?php
/**
 * Enqueue scripts and styles.
 */

require get_theme_file_path('/inc/search-route.php');
function pentahome_scripts()
{
    wp_enqueue_style('font', get_template_directory_uri() . '/public/fonts/Dibaj/fontface.css', array());
    wp_enqueue_style('style', get_stylesheet_directory_uri() . '/public/css/style.css', array());
    wp_enqueue_style('custom style', get_stylesheet_directory_uri() . '/public/css/custom.css', array());
    wp_dequeue_style( 'wp-block-library' );
//    js
    wp_enqueue_script('main-js', get_template_directory_uri() . '/public/js/app.js', array(), null, true);
    wp_enqueue_script('custom-js', get_template_directory_uri() . '/public/js/custom-js.js', array(), null, true); // `true` ensures it's in the footer.
    $home_page_id = get_option('page_on_front');
    $selected_cats = get_field('selected_cats', $home_page_id);
    $terms = get_terms('works_categories', array(
        'parent' => 0, // This will retrieve only top-level categories
    ));

        $svg_data = array();
    foreach ($selected_cats as $category) {
        $id = 'works_categories_' . $category->term_id;
        $svg_label = get_field('svg_label', $id); // Remove $id since you are inside the loop
                if ($svg_label) {
                    $svg_line = $svg_label['svg_line'];
                    $svg_fill = $svg_label['svg_fill'];
                    $svg_data[] = array(
                        'line' => $svg_line,
                        'fill' => $svg_fill,
                    );
        }

        wp_reset_postdata(); // Reset post data
    }

// Pass the SVG data to your JavaScript.
    wp_localize_script('main-js', 'svgData', $svg_data);

    wp_localize_script('main-js', 'jsData', array(
        'root_url' => get_site_url(),
        'nonce' => wp_create_nonce('my-nonce'),
    ));
}

add_action( 'wp_enqueue_scripts', 'pentahome_scripts' );
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function baloochy_setup() {

	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
	register_nav_menu( 'headerMenuLocation', 'منوی اصلی' );
	register_nav_menu( 'footerLocationOne', 'منوی اول فوتر' );
	register_nav_menu( 'footerLocationTwo', 'منوی دوم فوتر' );
}

add_action( 'after_setup_theme', 'baloochy_setup' );

/**
 * Custom template tags for this theme.
 */
//require get_template_directory() . '/inc/template-tags.php';


if ( function_exists( 'acf_add_options_page' ) ) {

    acf_add_options_page( array(
        'page_title' => 'Theme Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug'  => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect'   => false
    ) );
}

function add_menu_link_class( $classes, $item, $args ) {
	if ( isset( $args->link_class ) ) {
		$classes['class'] = $args->link_class;
	}
	return $classes;
}

add_filter( 'nav_menu_link_attributes', 'add_menu_link_class', 1, 3 );
// helper function to find a menu item in an array of items
function wpd_get_menu_item( $field, $object_id, $items ) {
	foreach ( $items as $item ) {
		if ( $item->$field == $object_id ) {
			return $item;
		}
	}

	return false;
}

/**
 * Disable the emoji's
 */
function optimize_site() {
    // Disable Emojis
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', function ( $plugins ) {
        return array_diff( $plugins, [ 'wpemoji' ] );
    } );
    add_filter( 'wp_resource_hints', function ( $urls, $relation_type ) {
        if ( 'dns-prefetch' === $relation_type ) {
            $emoji_url = 'https://s.w.org/images/core/emoji/';
            $urls = array_filter( $urls, function ( $url ) use ( $emoji_url ) {
                return strpos( $url, $emoji_url ) === false;
            } );
        }
        return $urls;
    }, 10, 2 );

    // Remove jQuery Migrate (Not needed for modern themes/plugins)
    add_filter( 'wp_default_scripts', function ( $scripts ) {
        if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
            $scripts->registered['jquery']->deps = array_diff(
                $scripts->registered['jquery']->deps,
                [ 'jquery-migrate' ]
            );
        }
    } );

    // Disable Embeds (Improves speed by removing embed script and related styles)
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );
    remove_action( 'wp_head', 'rest_output_link_wp_head' );
    remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
    add_filter( 'embed_oembed_discover', '__return_false' );
    add_filter( 'tiny_mce_plugins', function ( $plugins ) {
        return array_diff( $plugins, [ 'wpembed' ] );
    } );
    remove_action( 'wp_head', 'wp_generator' ); // Remove WordPress version
    remove_action( 'wp_head', 'wlwmanifest_link' ); // Remove Windows Live Writer link
    remove_action( 'wp_head', 'rsd_link' ); // Remove RSD (Really Simple Discovery) link
    remove_action( 'wp_head', 'feed_links_extra', 3 ); // Remove feed links
    remove_action( 'wp_head', 'feed_links', 2 ); // Remove general feed links

    // Disable Dashicons for non-admins
    if ( ! is_admin() ) {
        add_action( 'wp_enqueue_scripts', function () {
            wp_dequeue_style( 'dashicons' );
        } );
    }
}

add_action( 'init', 'optimize_site' );

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 *
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' == $relation_type ) {
		/** This filter is documented in wp-includes/formatting.php */
		$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

		$urls = array_diff( $urls, array( $emoji_svg_url ) );
	}

	return $urls;
}
function custom_post_type_args($args, $post_type)
{
    // Modify the rewrite rules for specific post types
    $custom_post_types = ['works', 'portfolio'];

    if (in_array($post_type, $custom_post_types, true)) {
        // Ensure the rewrite has the with_front parameter set to false
        if (isset($args['rewrite'])) {
            $args['rewrite']['with_front'] = false;
        } else {
            $args['rewrite'] = ['with_front' => false];
        }
    }

    return $args;
}
add_filter('register_post_type_args', 'custom_post_type_args', 10, 2);

function custom_taxonomy_args($args, $taxonomy)
{
    // Modify the rewrite rules for specific taxonomies
    $custom_taxonomies = [
        'works_categories',     // Replace with the taxonomy slug for works
        'portfolio_categories', // Replace with the taxonomy slug for portfolio
    ];

    if (in_array($taxonomy, $custom_taxonomies, true)) {
        // Ensure the rewrite has the with_front parameter set to false
        if (isset($args['rewrite'])) {
            $args['rewrite']['with_front'] = false;
        } else {
            $args['rewrite'] = ['with_front' => false];
        }
    }

    return $args;
}
add_filter('register_taxonomy_args', 'custom_taxonomy_args', 10, 2);
