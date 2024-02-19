<?php /* Template Name: customization */
get_header(); ?>

<?php
$pageBanner = get_field('image')['url'];
$args = array(
    'imgUrl' => $pageBanner,
);
get_template_part('template-parts/page_banner', null, $args);
?>
<section class="row justify-content-lg-between justify-content-center gap-4 gap-lg-0 py-5">
    <div class="row justify-content-center align-self-center">
        <div class="col-11 row row-cols-lg-3 text-center">
            <?php while (have_rows('list')): the_row(); ?>
                <p class="text-dark p-3 border-start border-primary fs-4 border-3 fs-5" data-aos="fade-up" data-aos-duration="500"
                   data-aos-delay="<?php the_row_index(); ?>00">
                    <?= get_sub_field('list_item'); ?>
                </p>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<section class="pb-5">
    <div class="row justify-content-center align-items-center h-100 py-5 bg-primary bg-opacity-25 shadow-sm">
        <h2 class="text-center title text-dark fs-1 pt-3 pb-5" data-aos="fade-down"><?= get_the_title(); ?></h2>
        <div class="col-11 col-lg-6 p-lg-4 p-3" data-aos="zoom-in"
             data-aos-duration="500">
            <?php echo do_shortcode('[gravityform id="'. get_field('form_id') .'" title="false" description="false" ajax="true"]'); ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var phoneField = document.getElementById('input_2_5'); // Replace 'input_1_4' with the actual ID of your phone number field

                    phoneField.addEventListener('input', function(event) {
                        // Remove any non-numeric characters from the input value
                        var cleanedValue = this.value.replace(/\D/g, '');

                        // Update the field value with the cleaned numeric value
                        this.value = cleanedValue;
                    });
                });
            </script>
        </div>
    </div>
</section>

<?php get_footer(); ?>
