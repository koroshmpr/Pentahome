<section class="py-5 overflow-hidden bg-primary bg-opacity-50">
    <div class="py-4 d-flex flex-column align-items-center text-center">
        <?php
        if (have_rows('products_list')):
        // Loop through rows.
        while (have_rows('products_list')) : the_row(); ?>
        <div class="rounded-circle shadow-sm feature" data-aos-duration="500" data-aos="fade-up"><i
                    class="bi bi-star-fill text-white"></i>
            <div class="position-absolute end-100 top-50 border p-2 translate-middle-y me-5 shadow-sm bg-white"
                 style="width: 500px;">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus culpa cum, doloribus error id itaque
                maxime neque nostrum quam suscipit. Architecto at consequuntur, expedita molestias nesciunt nulla
                pariatur quo voluptatem?
            </div>
        </div>
        <div class="overflow-hidden d-flex">
            <div class="vr mx-auto py-5 bg-primary bg-opacity-50" data-aos="fade-down" data-aos-delay="50"></div>
        </div>

        <?php endwhile; endif; ?>
        <div class="rounded-circle shadow-sm feature" data-aos="fade-up" data-aos-duration="500" data-aos-delay="200">
            <i class="bi bi-star-fill text-white"></i>
            <div class="position-absolute start-100 top-50 border p-2 translate-middle-y ms-5 shadow-sm bg-white"
                 style="width: 500px;">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, adipisci aliquid asperiores cum cupiditate
                ea nesciunt nostrum nulla, quod recusandae sit, soluta velit voluptas. A aspernatur aut commodi facilis
                voluptate?
            </div>
        </div>
        <div class="overflow-hidden d-flex">
            <div class="vr mx-auto py-5 bg-primary bg-opacity-50" data-aos="fade-down" data-aos-delay="150"></div>
        </div>


        <div class="rounded-circle shadow-sm feature" data-aos="fade-up" data-aos-duration="500" data-aos-delay="400">
            <i class="bi bi-star-fill text-white"></i>
            <div class="position-absolute end-100 top-50 border p-2 translate-middle-y me-5 shadow-sm bg-white"
                 style="width: 500px;">
                lorem ipsum dolor
            </div>
        </div>
    </div>
</section>