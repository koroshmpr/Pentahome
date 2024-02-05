<a class="navbar-brand m-0" href="<?= home_url() ?>">>
    <?php
    $site_logo = get_field('site_logo', 'option');
    if (!empty($site_logo)): ?>
        <?php echo $site_logo; ?>
    <?php endif; ?>
</a>