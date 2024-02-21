<?php $phones = get_field('phones', 'option'); ?>
    <div class="d-flex gap-1 align-items-center">
        <i class="bi bi-telephone text-primary fs-4 me-3"></i>
        <div class="d-flex gap-1 align-items-center flex-wrap">
            <?php foreach ($phones as $phone) : ?>
                <a class="<?= $args['textClass'] ?? 'text-primary'; ?>" href="tel:<?= $phone['phone']; ?>">
                    <?= $phone['phone']; ?>
                </a>
                <?php if ($phone !== end($phones)) : ?>
                    - <!-- Add hyphen only if it's not the last phone number -->
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
<?php
//$textClass = 'text-white';
//$args = array(
//        'textClass' => $textClass,
//);
//get_template_part('template-parts/phones' , null ,$args);
?>