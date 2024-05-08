require('./bootstrap');
import $ from 'jquery';
// import 'swiper/css';
import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';
import AOS from 'aos';
import 'aos/dist/aos.css';
import Masonry from 'masonry-layout';
import imagesLoaded from 'imagesloaded';

// Declare masonry outside of the $(document).ready() function
let masonry;

$(document).ready(function () {
    // Initialize Masonry
    let masonryGrid = document.querySelector(".masonry");
    if (masonryGrid) {
        masonry = new Masonry(masonryGrid, {
            itemSelector: ".masonry-item",
            columnWidth: ".masonry-item",
            originLeft: false,
            transitionDuration: '0.8s',
            percentPosition: false,
        });

        // Initialize Masonry after images have loaded
        imagesLoaded(masonryGrid).on("progress", function () {
            masonry.layout();
        });

        // Attach the event handler to filter the items
        $(document).on('change', '.category-filter', function () {
            let selectedCategories = [];
            let isSelectAllChecked = true;

            // Loop through all the checkboxes
            $('.category-filter').each(function () {
                let categoryCheckbox = $(this);
                let categoryLi = categoryCheckbox.closest('li'); // Find the parent <li>

                if (categoryCheckbox.is(':checked')) {
                    var category = categoryCheckbox.val();
                    isSelectAllChecked = category == 'all' ? true : false;
                    if (category != 'all') {
                        selectedCategories.push(category);
                    }
                    // Toggle the 'active' class on the parent <li
                    categoryLi.addClass('active');
                    categoryLi.siblings('li').removeClass('active');
                } else {
                    // Remove the 'active' class
                    categoryLi.removeClass('active');
                }
            });

            // Filter the product list based on selected categories
            $('.product-card').each(function () {
                let productCategories = $(this).attr('data-categories');
                let masonryItem = $(this).closest('.masonry-item');

                if (isSelectAllChecked || selectedCategories.length === 0) {
                    // Show all products when "Select All" is checked or no category is selected
                    masonryItem.attr('data-visible', 'true').show();
                } else {
                    // Filter products based on selected categories
                    if (productCategories) {
                        let categories = productCategories.split(',');
                        let matches = selectedCategories.filter(function (category) {
                            return categories.indexOf(category) != -1;
                        });

                        if (matches.length > 0) {
                            masonryItem.attr('data-visible', 'true').show();
                        } else {
                            masonryItem.attr('data-visible', 'false').hide();
                        }
                    } else {
                        masonryItem.attr('data-visible', 'false').hide();
                    }
                }
            });
            // Layout Masonry after filtering
            masonry.layout();
        });
    }
});
// function homeSwiper() {
//     AOS.init()
let names = [];
$(".swiper1 .swiper-slide section").each(function (i) {
    names.push($(this).data("name"));
});

// aos data attribute looping

// }

document.addEventListener('DOMContentLoaded', function () {
    AOS.init()
    if ($('body').hasClass('home')) {
        const swiper = new Swiper('.swiper1', {
            autoHeight: true, //enable auto height
            hashNavigation: true,
            allowTouchMove: true,
            effect: 'slide',
            speed: 900,
            slidesPerView: 'auto',
            mousewheel: {
                invert: false,
                sensitivity: 3
            },
            keyboard: {
                enabled: true,
                onlyInViewport: true, // Ensures the keyboard control only works when Swiper is in viewport
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
                        </div>`;
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
                            </div>`;
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
                    if (window.innerWidth > 1024) {
                        customPagination.setAttribute('data-aos', 'fade-left');
                    } else if (window.innerWidth <= 1024) {
                        $(customPagination).attr('data-aos', 'fade-top');
                    }
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

    function addCollapse(menuId, iconClass) {
        // Select the menu by its ID
        let menu = $(`#${menuId}`);

        // Find <li> elements with the "menu-item-has-children" class
        menu.find('li.menu-item-has-children').each(function () {
            let listItem = $(this);

            // Find the anchor link
            let anchor = listItem.children('a');

            // Add a button after the anchor link
            anchor.after(`<button type="button" id="" class="btn btn-link ps-3 py-0" data-bs-toggle="collapse" data-bs-target="#${listItem.attr('id')}-submenu"><i id="${listItem.attr('id')}-icon" class="${iconClass} bi bi-plus-lg fs-4"></i></button>`);


            // Set attributes for Bootstrap collapse
            let submenu = listItem.find('ul.sub-menu');
            submenu.attr('id', listItem.attr('id') + '-submenu');
            submenu.addClass('collapse');

            // Prevent the button from following the link
            anchor.next('button').on('click', function (event) {
                event.preventDefault();
                toggleIcon(listItem.attr('id'));
            });

            function toggleIcon(listItemId) {
                const iconElement = $(`#${listItemId}-icon`);
                const submenuElement = $(`#${listItemId}-submenu`);

                if (iconElement.hasClass('bi-plus-lg')) {
                    iconElement.removeClass('bi-plus-lg').addClass('bi-dash-lg');
                    submenuElement.collapse('show');
                } else {
                    iconElement.removeClass('bi-dash-lg').addClass('bi-plus-lg');
                    submenuElement.collapse('hide');
                }
            }
        });
    }


// Call the function with the menu ID you want to modify
    addCollapse('navbarMenu', 'text-secondary');
    addCollapse('navbarMenuMobile', 'text-white');
    addCollapse('navbarHomeMenu', 'text-white');

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
    // function handleResponsive() {
    //     // Check the screen size or viewport dimensions
    //     if (window.innerWidth > 1024) {
    //         homeSwiper();
    //     } else {
    //         $('.home main > div').removeClass('swiper')
    //         $('.home main > div > div').removeClass('swiper-wrapper')
    //         $('.home main > div > div > div').removeClass('swiper-slide')
    //         let disableAnimationElements = document.querySelectorAll('[data-aos-disable]');
    //         disableAnimationElements.forEach(function (element) {
    //             element.removeAttribute('data-aos');
    //             element.removeAttribute('data-aos-duration');
    //         });
    //     }
    // }

// Event listener for the resize event
//     window.addEventListener('resize', handleResponsive);
// Initial call to handleResponsive to execute the code on page load
//     handleResponsive();
    // portfolio slider
    const swiperSilder = new Swiper('.swiper2', {
        direction: 'horizontal',
        speed: 1000,
        effect: 'fade',
        autoplay: {
            delay: 5000,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        keyboard: {
            enabled: true,
            onlyInViewport: true, // Ensures the keyboard control only works when Swiper is in viewport
        },
        on: {
            // slideChange: function () {
            //     $('.heroBg').removeClass('heroIntro');
            //
            //     // Add the 'heroIntro' class to the 'heroBg' element in the active slide
            //     let activeSlide = this.slides[this.activeIndex];
            //     $(activeSlide).find('.heroBg').addClass('heroIntro');
            // },

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
})
