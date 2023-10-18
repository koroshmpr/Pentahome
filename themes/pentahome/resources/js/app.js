require('./bootstrap');
import $ from 'jquery';
// import 'swiper/css';
import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';
import AOS from 'aos';
import 'aos/dist/aos.css';
import Masonry from 'masonry-layout';
import imagesLoaded from 'imagesloaded';

    function homeSwiper() {
        AOS.init()
        let names = [];
        $(".swiper1 .swiper-slide section").each(function (i) {
            names.push($(this).data("name"));
        });

// aos data attribute looping
        if ($('body').hasClass('home')) {
            const swiper = new Swiper('.swiper1', {
                autoHeight: true, //enable auto height
                hashNavigation: true,
                allowTouchMove: false,
                effect: 'slide',
                speed: 900,
                slidesPerView: 'auto',
                mousewheel: {
                    invert: false,
                    sensitivity: 3
                },
                spaceBetween: 0,
                releaseOnEdges: true,
                direction: 'vertical',
                pagination: {
                    el: '.swiper-pagination-custom',
                    type: 'custom',
                    clickable: true,
                    renderCustom: function (swiper, current, total) {
                        var customPaginationHTML = '';
                        // Add the first pagination item for the slide without SVGs
                        customPaginationHTML += `
            <div class="custom-pagination-item" data-index="0">
                <!-- Render your content for the first slide here -->
            </div>
        `;

                        for (var i = 0; i < total; i++) {
                            if (Array.isArray(svgData) && svgData[i]) {
                                var svg_line = svgData[i].line; // Get SVG line data
                                var svg_fill = svgData[i].fill; // Get SVG fill data
                                var isActive = i === current - 2; // Subtract 1 to start pagination from index 1

                                // Customize the pagination for each slide
                                customPaginationHTML += `
                    <div class="custom-pagination-item ${isActive ? 'active' : ''}" data-index="${i + 1}">
                        <!-- Render your SVG using the data -->
                        ${isActive ? svg_fill : svg_line}
                    </div>
                `;
                            }
                        }

                        // Update the custom pagination container
                        swiper.pagination.el.innerHTML = customPaginationHTML;

                        // Attach click events or other interactions as needed
                        var customPaginationItems = swiper.pagination.el.querySelectorAll('.custom-pagination-item');
                        customPaginationItems.forEach(function (item, index) {
                            item.addEventListener('click', function () {
                                // Handle click events for custom pagination items
                                swiper.slideTo(index); // Go to the corresponding slide, add 1 to index to account for starting at index 1
                            });
                        });
                    },
                },
                on: {
                    init: function () {
                        let customPagination = document.querySelector('.swiper-pagination-custom');
                        var isFirstSlide = this.activeIndex === 0;
                        if (isFirstSlide) {
                            // Do something specific for the first slide
                            customPagination.classList.add('opacity-0');
                        }
                    },
                    afterInit: function () {
                        setTimeout(function () {
                            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
                            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
                        }, 50)
                    },
                    realIndexChange: function () {
                        let customPagination = document.querySelector('.swiper-pagination-custom');
                        let activeSlide = this.realIndex;
                        let slides = this.slides;
                        if (activeSlide === 0) {
                            document.body.classList.remove('scrolled');
                            customPagination.classList.remove('aos-animate')
                        } else {
                            document.body.classList.add('scrolled');
                            customPagination.classList.add('aos-animate');
                            customPagination.classList.add('opacity-100');
                        }
                        setTimeout(function () {
                            slides.forEach(function (slide, index) {
                                let elementsWithAos = slide.querySelectorAll('[data-aos]');
                                elementsWithAos.forEach(function (element) {
                                    if (index === activeSlide) {
                                        element.classList.add('aos-animate');
                                    } else {
                                        element.classList.remove('aos-animate');
                                    }

                                })
                            });
                        }, 400);
                        if (activeSlide === slides.length - 1) {
                            customPagination.classList.remove('aos-animate')
                        }
                    },

                }
            });
        }
    }

document.addEventListener('DOMContentLoaded', function () {
    AOS.init()
    if (!$('body').hasClass('home')) {
        let backToTop = document.getElementById("backToTop");
        backToTop.addEventListener('click', backtoTopHandler)

        function backtoTopHandler() {
            document.body.scrollTop = 0; // For Safari
            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
        }
    }
    if ($('body').hasClass('home')) {
        const hamburgerMenu = document.querySelector("#hamburger-menu");

        function toggleNav() {
            // Toggle: Hamburger Open/Close
            hamburgerMenu.classList.add("active");
            setTimeout(function () {
                    hamburgerMenu.classList.remove("active")
                }
                , 400)
        }

        hamburgerMenu.addEventListener("click", toggleNav);
    }
    function handleResponsive() {
        // Check the screen size or viewport dimensions
        if (window.innerWidth > 1024) {
            homeSwiper();
        } else {
            $('.home main > div').removeClass('swiper')
            $('.home main > div > div').removeClass('swiper-wrapper')
            $('.home main > div > div > div').removeClass('swiper-slide')
            let disableAnimationElements = document.querySelectorAll('[data-aos-disable]');
            disableAnimationElements.forEach(function (element) {
                element.removeAttribute('data-aos');
                element.removeAttribute('data-aos-duration');
            });
        }
    }

// Event listener for the resize event
    window.addEventListener('resize', handleResponsive);
// Initial call to handleResponsive to execute the code on page load
    handleResponsive();
    // portfolio slider
    const swiperSilder = new Swiper('.swiper2', {
        direction: 'horizontal',
        speed: 1000,
        effect: 'fade',
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        on: {
            init: function () {
                let elementsWithNumberGreaterThanOne = document.querySelectorAll('[data-number]:not([data-number="1"])');
                elementsWithNumberGreaterThanOne.forEach(function (element) {
                    element.classList.remove('aos-animate')
                });
            },
            afterInit: function () {
                setTimeout(function () {
                    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
                    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
                }, 50)
            },
            realIndexChange: function () {
                let activeSlide = this.realIndex;
                let slides = this.slides;

                setTimeout(function () {
                    slides.forEach(function (slide, index) {
                        let elementsWithAos = slide.querySelectorAll('[data-aos]');
                        elementsWithAos.forEach(function (element) {
                            if (index === activeSlide) {
                                element.classList.add('aos-animate');
                            } else {
                                element.classList.remove('aos-animate');
                            }

                        })
                    });
                }, 600);
            }
        }
    })
    // paggination color change
    if (Array.isArray(svgData)) {
        svgData.forEach(function (items, index) {
            const productsSlider = new Swiper(`.swiper${index + 3}`, {
                direction: 'horizontal',
                speed: 1000,
                effect: 'fade',
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },

            })
        })
    }
    function initializeMasonry() {
        var masonryGrids = document.querySelectorAll(".masonry");

        // Loop through all masonry grids and initialize Masonry
        masonryGrids.forEach(function (masonryGrid) {
            var masonryItems = masonryGrid.querySelectorAll(".masonry-item");

            var masonry = new Masonry(masonryGrid, {
                itemSelector: ".masonry-item",
                columnWidth: ".masonry-item",
                percentPosition: true,
            });

            // Initialize Masonry after images have loaded
            imagesLoaded(masonryGrid).on("progress", function () {
                masonry.layout();
            });
        });
    }
    initializeMasonry();
})
