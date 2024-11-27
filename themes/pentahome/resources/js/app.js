require('./bootstrap');
import $ from 'jquery';
import Swiper from 'swiper/bundle';
// import 'swiper/css/bundle';
import AOS from 'aos';
// import 'aos/dist/aos.css';
import Masonry from 'masonry-layout';
import imagesLoaded from 'imagesloaded';
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
                let categoryLi = categoryCheckbox.closest('li');

                if (categoryCheckbox.is(':checked')) {
                    let category = categoryCheckbox.val();
                    isSelectAllChecked = category === 'all';
                    if (category !== 'all') {
                        selectedCategories.push(category);
                    }
                    categoryLi.addClass('active');
                    categoryLi.siblings('li').removeClass('active');
                } else {
                    categoryLi.removeClass('active');
                }
            });

            // Collect items to hide and show
            let itemsToShow = [];
            let itemsToHide = [];

            $('.masonry-item').each(function () {
                let masonryItem = $(this);
                let productCategories = masonryItem.find('.product-card').attr('data-categories');

                if (isSelectAllChecked || selectedCategories.length === 0) {
                    itemsToShow.push(masonryItem);
                } else if (productCategories) {
                    let categories = productCategories.split(',');
                    let matches = selectedCategories.filter(function (category) {
                        return categories.indexOf(category) !== -1;
                    });

                    if (matches.length > 0) {
                        itemsToShow.push(masonryItem);
                    } else {
                        itemsToHide.push(masonryItem);
                    }
                } else {
                    itemsToHide.push(masonryItem);
                }
            });

            // Update visibility and re-layout Masonry
            itemsToHide.forEach((item) => $(item).hide());
            itemsToShow.forEach((item) => $(item).show());

            masonry.layout(); // Recalculate layout
        });
    }
});
document.addEventListener('DOMContentLoaded', function () {
    AOS.init()
    if ($('body').hasClass('home')) {
        let names = [];
        $(".swiper1 .swiper-slide section").each(function (i) {
            names.push($(this).data("name"));
        });
        const hamburgerMenu = document.querySelector("#hamburger-menu");
        hamburgerMenu.addEventListener("click", function () {
            // Toggle: Hamburger Open/Close
            hamburgerMenu.classList.add("active");
            setTimeout(function () {
                    hamburgerMenu.classList.remove("active")
                }, 400)
        });
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
                        customPagination.setAttribute('data-aos', 'fade-right');
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
        const swiperSilder = new Swiper('.swiper2', {
            direction: 'horizontal',
            speed: 1000,
            effect: 'fade',
            autoplay: {
                delay: 10000,
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
    }
    function addCollapse(menuId, iconClass) {
        // Select the menu by its ID
        let menu = $(`#${menuId}`);
        // Find <li> elements with the "menu-item-has-children" class
        menu.find('li.menu-item-has-children').each(function () {
            let listItem = $(this);
            let anchor = listItem.children('a');

            // Add a button after the anchor link with both SVG icons (initially hiding the minus icon)
            anchor.after(`
        <button id="" type="button" aria-label="show submenu" class="btn btn-link ps-3 py-0" data-bs-toggle="collapse" data-bs-target="#${listItem.attr('id')}-submenu">
            <svg id="${listItem.attr('id')}-plus" width="20" height="20" fill="currentColor" class="bi bi-plus-lg fs-4" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
            </svg>
            <svg id="${listItem.attr('id')}-minus" width="20" height="20" fill="currentColor" class="bi bi-dash-lg fs-4 d-none" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2 8a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11A.5.5 0 0 1 2 8"/>
            </svg>
        </button>
    `);

            // Set attributes for Bootstrap collapse
            let submenu = listItem.find('ul.sub-menu');
            submenu.attr('id', listItem.attr('id') + '-submenu');
            submenu.addClass('collapse');

            // Prevent the button from following the link and toggle icons on click
            anchor.next('button').on('click', function (event) {
                event.preventDefault();
                toggleIcon(listItem.attr('id'));
            });

            function toggleIcon(listItemId) {
                const plusIcon = $(`#${listItemId}-plus`);
                const minusIcon = $(`#${listItemId}-minus`);
                const submenuElement = $(`#${listItemId}-submenu`);

                if (submenuElement.hasClass('show')) {
                    plusIcon.toggleClass('d-none');
                    minusIcon.toggleClass('d-none');
                    submenuElement.collapse('hide');
                } else {
                    plusIcon.toggleClass('d-none');
                    minusIcon.toggleClass('d-none');
                    submenuElement.collapse('show');
                }
            }
        });

    }
// Call the function with the menu ID you want to modify
    addCollapse('navbarMenu', 'text-secondary');
    addCollapse('navbarMenuMobile', 'text-white');
    addCollapse('navbarHomeMenu', 'text-white');
})