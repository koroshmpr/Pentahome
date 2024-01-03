<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta name="keywords" content="<?= get_bloginfo('name'); ?>">
    <meta name="description" content="<?= get_bloginfo('description'); ?>">
    <meta name="author" content="<?= get_bloginfo('author'); ?>">
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
    if (is_front_page()) {
        get_template_part('template-parts/Layout/Header/home_header');
    }?>

<main <?php echo !is_front_page()  ? 'class="d-flex min-vh-100"' : ''?>>
<?php
if (!is_front_page()) {
    get_template_part('template-parts/Layout/Header/side_header');
    echo '<div class="col-lg-10 overflow-hidden min-vh-100 col-12" style="background-color: #f4f4f4;">';
} ?>



