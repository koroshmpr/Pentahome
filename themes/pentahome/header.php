<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <?php
    $focus_keyword = get_post_meta(get_the_ID(), 'rank_math_focus_keyword', true);
    ?>
    <meta name="keywords" content="<?= $focus_keyword ?? get_bloginfo('name'); ?>">
    <meta name="description" content="<?= get_bloginfo('description'); ?>">
    <meta name="author" content="<?= get_bloginfo('author'); ?>">
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head(); ?>
    <?= get_field('scripts', 'option') ?? ''; ?>
</head>
<body <?php body_class(); ?>>
<?php
if (is_front_page()) {
    get_template_part('template-parts/Layout/Header/home_header');
} ?>

<main class="<?= is_front_page() ? 'swiper swiper1 lazy vh-100' : 'd-flex min-vh-100' ?>">
    <?php
    if (!is_front_page()) :
        get_template_part('template-parts/Layout/Header/side_header');?>
        <div class="col-lg-9 col-xl-10  <?= is_singular('post') ? '' : 'overflow-hidden'; ?> min-vh-100 col-12" style="background-color: #f4f4f4;">
    <?php endif; ?>