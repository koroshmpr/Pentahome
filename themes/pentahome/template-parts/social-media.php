<?php
if (have_rows('social', 'option')):
    // Loop through rows.
    while (have_rows('social', 'option')) : the_row(); ?>
        <a target="_blank" aria-label="<?= get_sub_field('name', 'option')?>" class="text-primary" href="<?= get_sub_field('link' , 'option')['url']; ?>">
            <?= get_sub_field('icon' , 'option'); ?>
        </a>
    <?php endwhile;
endif; ?>