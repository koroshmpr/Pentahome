<?php /* Template Name: contact us */
get_header(); ?>
<section class="container-fluid px-0">
    <?php $form = get_field('form_image'); ?>
    <div class="row align-items-lg-stretch justify-content-lg-end justify-content-center gy-4 pb-4 pb-lg-0">
        <div class="col-lg-4 align-self-center mx-lg-auto px-4 px-lg-5 order-last order-lg-first" data-aos="fade-up"
             data-aos-duration="1000" data-aos-delay="200">
            <h1 class="text-dark text-opacity-50">تماس با ما</h1>
            <p>لطفا فرم زیر را پر کنید و یکی از اعضای تیم ما با شما تماس خواهد گرفت.</p>
            <?php echo do_shortcode('[gravityform id="1" title="false" description="false" ajax="true"]'); ?>
        </div>
        <img class="img-fluid col-lg-6 px-0" src="<?= $form['url']; ?>" alt="<?= $form['title']; ?>"
             data-aos="fade-right" data-aos-duration="600">
    </div>
</section>
<section class="container-fluid px-0">
    <?php $contact = get_field('contact_image'); ?>
    <div class="row align-items-lg-stretch justify-content-around gy-4 pb-5 pb-lg-0">
        <img class="img-fluid col-lg-6 me-lg-auto px-0" src="<?= $contact['url']; ?>" alt="<?= $contact['title']; ?>"
             data-aos="fade-left" data-aos-duration="600">
        <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200"
             class="col-lg-5 align-self-center px-4 px-lg-5 mx-lg-auto pb-4 pb-lg-0">
            <h2 class="text-dark text-opacity-50">راه های ارتباطی</h2>
            <div class="pt-4 row gap-3">
                <address class="mb-0 text-primary fs-5">
                    <i class="bi bi-geo-alt fs-4 text-primary me-3"></i>
                    <?= get_field('address', 'option'); ?>
                </address>
                <?php $phone = get_field('phone', 'option'); ?>
                <?php $email = get_field('email', 'option'); ?>
                <a href="tel:<?= $phone; ?>">
                    <i class="bi bi-telephone fs-4 text-primary me-3"></i>
                    <?= $phone; ?>
                </a>
                <a href="mailto:<?= $email; ?>">
                    <i class="bi bi-envelope fs-4 text-primary me-3"></i>
                    <?= $email; ?>
                </a>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>