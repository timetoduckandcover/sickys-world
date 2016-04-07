/*--------------------------------------------------------------
 Custom js
 --------------------------------------------------------------*/

function facewp_abbey_getFrontAjaxUrl(action) {
    return facewp_abbey_params.wc_ajax_url ? facewp_abbey_params.wc_ajax_url.toString().replace("%%endpoint%%", action) : facewp_abbey_params.ajax_url + '?action=' + action;
}

jQuery( document ).ready( function( $ ) {
    'use strict';
    var $window = $(window),
        $header = $('#header');

    // Sticky Header
    if ($header.is('.header-enable-sticky')) {
        $window.on('scroll', function () {
            if ($window.scrollTop() > 0) {
                $header.addClass('header-sticky');
            } else {
                $header.removeClass('header-sticky');
            }
        });
    }

    // Vertical Menu Toggle
    $('.toggle-menu .heading').on('click', function () {
        $('.toggle-menu').toggleClass('open');
    });

    // Tooltip
    $('[data-toggle="tooltip"]').tooltip();

    // Height Home 6
    $('#header.header-06' ).css("height", $( window ).height());

    // Search in menu
    var $search_btn = $( '.header-search > i' ),
        $search_form = $( '.header-search .search-form' );

    $search_btn.on( 'click', function() {
        $search_form.toggleClass( 'open' );
    } );

    if ($.fn.yithautocomplete) {
        var $search = $('#yith-s');

        $search.yithautocomplete({
            minChars: $search.data('minchars'),
            appendTo: '.yith-ajaxsearchform-container',
            serviceUrl: function() {
                var category = $('.yith-ajaxsearchform-container #product_cat').val();
                return woocommerce_params.ajax_url + '?action=yith_ajax_search_products' + (category != '0' && category ? '&product_cat=' + category : '');
            },
            onSearchStart: function(){
                // @todo: Loader here
            },
            onSearchComplete: function(){
                $(this).css('background', 'transparent');
            },
            onSelect: function (suggestion) {
                if( suggestion.id != -1 ) {
                    window.location.href = suggestion.url;
                }
            },
        });
    }

    // Scroll Animation
    var wow = new WOW({
        boxClass:     'wow-animation',
        animateClass: 'animated',
        offset:       0,
        mobile:       true,
        live:         true
    });
    wow.init();

    // Mobile Sidebar
    var snapper = new Snap( {
        element: document.getElementById( 'page' ),
        dragger: document.getElementsByClassName( 'page' ),
        disable: 'right',
        slideIntent: 10
    } );

    // Mobile Menu
    $('.mobile-menu .mobile-menu-toggle').on('click', function () {
        $(this).parent('.menu-item').toggleClass('open');

        return false;
    });

    // Search
    var $searchContainer = $( '.full-screen-search-container ');
    $( '#js-search-overlay' ).on( 'click', function ( evt ) {
        evt.preventDefault();

        $searchContainer.addClass( 'open' );
        $searchContainer.find('.search-field')[0].focus();
    } );
    $searchContainer.on('click', function (evt) {
        if (!$(evt.target).parents('.search-form').length) {
            evt.preventDefault();

            $searchContainer.removeClass( 'open' );
        }
    });

    // Fitvids
    $( ".container" ).fitVids();

    // Post Gallery
    $( ".post-gallery" ).slick({
        dots: true,
        infinite: true,
        arrows: false,
        speed: 500,
        adaptiveHeight: true
    });

    //Masonry for Gallery Post
    var $grid = $( ".post-gallery.masonry" ).masonry( {
        itemSelector: '.thumb-masonry-item',
        columnWidth: '.grid-thumb-sizer',
        percentPosition: true,
        gutter: 3
    } );

    $grid.imagesLoaded().progress( function() {
        $grid.masonry( 'layout' );
    } )

    // WooCommerce Message
    if ($('.woocommerce-message').length) {
        setTimeout(function () {
            $('.woocommerce-message').fadeOut();
        }, 5000);
    }

    // WooCommerce Quick View
    $('body').on('click', '.quick-view', function (evt) {
        evt.preventDefault();
        evt.stopPropagation();

        var $this = $(this);

        $.magnificPopup.open({
            items: {
                src: facewp_abbey_getFrontAjaxUrl('facewp_abbey_wc_quickview') + '&product_id=' + $this.data('product-id')
            },
            type: 'ajax'
        });
    });

    // WooCommerce Product Tabs
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var event = new CustomEvent("resize", {
            bubbles: true,
            cancelable: false
        });
        window.dispatchEvent(event);
    });

    // WooCommerce Products Carousel
    $('.products-carousel, .product-category-list.product-category-list-image.carousel, .cross-sells .products').each(function () {
        var $carousel = $(this),
            showNavigation = $carousel.data('show-navigation'),
            showPagination = $carousel.data('show-pagination'),
            columnslg = $carousel.data('columns-lg'),
            columnsmd = $carousel.data('columns-md'),
            columnsxs = $carousel.data('columns-xs'),
            columnsls = $carousel.data('columns-ls'),
            responsive = [];

        if ( $carousel.find('.product').length <= columnslg ) {
            return;
        }

        if (columnslg) {
            responsive.push({
                breakpoint: 1024,
                settings: {
                    slidesToShow: columnslg,
                    slidesToScroll: columnslg,
                }
            });
        }
        if (columnsmd) {
            responsive.push({
                breakpoint: 768,
                settings: {
                    slidesToShow: columnsmd,
                    slidesToScroll: columnsmd,
                }
            });
        }
        if (columnsxs) {
            responsive.push({
                breakpoint: 481,
                settings: {
                    slidesToShow: columnsxs,
                    slidesToScroll: columnsxs,
                }
            });
        }
        if (columnsls) {
            responsive.push({
                breakpoint: 0,
                settings: {
                    slidesToShow: columnsls,
                    slidesToScroll: columnsls,
                }
            });
        }

        $carousel.slick({
            responsive: responsive,
            dots: showPagination,
            arrows: showNavigation,
            mobileFirst: true,
            prevArrow: '<span class="pe-7s-angle-left slick-arrow-prev"></span>',
            nextArrow: '<span class="pe-7s-angle-right slick-arrow-next"></span>'
        });
    });

    // WooCommerce Countdown
    $('.product-countdown').each(function () {
        var $this = $(this);

        if ($this.data('countdown')) {
            return;
        }

        $this.countdown({
            date: new Date($this.data('sale-year'), $this.data('sale-month'), $this.data('sale-day')),
            render: function(date) {
                return $(this.el).html("<span>"
                    + "<span class='heading-font'>" + date.days + "</span>" + " <div>" + facewp_abbey_params.i18n_days + "</div></span> <span>"
                    + "<span class='heading-font'>" + (this.leadingZeros(date.hours)) + "</span>" + " <div>" + facewp_abbey_params.i18n_hours + "</div></span> <span> "
                    + "<span class='heading-font'>" + (this.leadingZeros(date.min)) + "</span>" + " <div>" + facewp_abbey_params.i18n_mins + "</div></span> <span> "
                    + "<span class='heading-font'>" + (this.leadingZeros(date.sec)) + "</span>" + " <div>" + facewp_abbey_params.i18n_secs + "</div> </span>");
            }
        });
    });

    // Counter
    if ($.fn.waypoint) {
        $('.counter-container').waypoint(function () {
            var $this = $(this);

            if ($this.data('waypoint-run')) {
                return;
            }

            var $counter = $(this).find('.counter'),
                value = $counter.data('value'),
                decimalCount = value.toString().split('.'),
                duration = $counter.data('speed'),
                separator = $counter.data('separator'),
                decimalPoint = $counter.data('decimal');

            if (decimalCount[1]){
                decimalCount = decimalCount[1].length - 1;
            } else {
                decimalCount = 0;
            }

            var counter = new CountUp($counter.attr('id'), 0, value, decimalCount, duration, {
                separator : separator,
                decimal : decimalPoint
            });

            counter.start();

            $this.data('waypoint-run', true);
        }, { offset: '85%' });
    }

    // Testimonial
    $('.testimonial-container').each(function () {
        var $testimonialContainer = $(this);

        $testimonialContainer.find('.testimonials-list').slick({
            slidesToShow: $testimonialContainer.data('items'),
            slidesToScroll: $testimonialContainer.data('items'),
            mobileFirst: true,
            dots: $testimonialContainer.data('dots') ? true : false,
            arrows: $testimonialContainer.data('nav') ? true : false,
            prevArrow: '<span class="pe-7s-angle-left slick-arrow-prev"></span>',
            nextArrow: '<span class="pe-7s-angle-right slick-arrow-next"></span>',
            autoplay: $testimonialContainer.data('autoplay') ? true : false,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: $testimonialContainer.data('items'),
                        slidesToScroll: $testimonialContainer.data('items'),
                    }
                },
                {
                    breakpoint: 0,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                }
            ]
        });
    });

    // Promo Popup
    if (facewp_abbey_params.promo_popup_show == 1) {
        var cookieKey = 'promo_popup_hide',
        hidePopupRegex = new RegExp(cookieKey + '=1');

        if (!hidePopupRegex.test(document.cookie)) {
            $.magnificPopup.open({
                items: {
                    src: '#promo-popup',
                    type: 'inline'
                },
                removalDelay: 300
            });
        }

        $('#promo-popup-checkbox').on('click', function () {
            if ($(this).prop('checked')) {
                document.cookie = cookieKey + '=1;expires=1;path=/';
            } else {
                document.cookie = cookieKey + '=0;expires=1;path=/';
            }
        });
    }

    // Masonry
    $('.masonry').each(function(){
        var $masonry = $(this);

        $masonry.isotope({
            resizable: false,
            itemSelector : 'li',
            layoutMode: 'masonry',
            transitionDuration: '0.6s',
            masonry: {
                gutter: 30
            },
        });
    });
     var $window = $( window );
     // Scroll up
     var $scrollup = $( '.scrollup' );

     $window.scroll( function () {
         if ( $window.scrollTop() > 2500 ) {
             $scrollup.addClass( 'show' );
         } else {
             $scrollup.removeClass( 'show' );
         }
     } );

     $scrollup.on( 'click', function ( evt ) {
         $( "html, body" ).animate( { scrollTop: 0 }, 600 );
         evt.preventDefault();
     } );
} );