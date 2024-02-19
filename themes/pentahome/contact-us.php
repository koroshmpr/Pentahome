<?php /* Template Name: contact us */
get_header(); ?>
<?php $form = get_field('form_image'); ?>
<?php
$pageBanner = $form['url'];
$args = array(
    'imgUrl' => $pageBanner,
);
get_template_part('template-parts/page_banner', null, $args);
?>
<section class="container-fluid py-5">
        <div class="row align-items-lg-stretch justify-content-center gy-4 pb-4 pb-lg-0">
            <h2 data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200" class="fs-4 text-primary pb-4 col-lg-11">لطفا فرم زیر را پر کنید و یکی از اعضای تیم ما با شما تماس خواهد
                گرفت.</h2>
            <div class="col-lg-11 align-self-start px-4 px-lg-5 d-flex row-cols-2 gap-lg-3 gy-3 flex-wrap"
                 data-aos="fade-up"
                 data-aos-duration="1000" data-aos-delay="200">
                <div class="col-lg-6 col-12">
                    <?php echo do_shortcode('[gravityform id="'. get_field('form_id') .'" title="false" description="false" ajax="true"]'); ?>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var phoneField = document.getElementById('input_1_4'); // Replace 'input_1_4' with the actual ID of your phone number field

                            phoneField.addEventListener('input', function(event) {
                                // Remove any non-numeric characters from the input value
                                var cleanedValue = this.value.replace(/\D/g, '');

                                // Update the field value with the cleaned numeric value
                                this.value = cleanedValue;
                            });
                        });
                    </script>
                </div>
                <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200"
                     class="col-lg-4 col-12 align-self-center px-4 px-lg-5 mx-lg-auto py-5">
                    <h2 class="text-primary">راه‌های ارتباطی</h2>
                    <div class="pt-3 gap-3">
                        <address class="mb-0 text-primary fs-5">
                            <i class="bi bi-geo-alt fs-4 text-primary me-3"></i>
                            <?= get_field('address', 'option'); ?>
                        </address>
                        <?php $phone = get_field('phone', 'option'); ?>
                        <?php $email = get_field('email', 'option'); ?>
                        <a class="d-block" href="tel:<?= $phone; ?>">
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
        </div>
    </section>
<?php get_footer(); ?>