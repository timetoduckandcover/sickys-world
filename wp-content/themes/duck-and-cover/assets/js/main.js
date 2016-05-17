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

    // Set parent object that we will bind all data to
    // console.log(location);
    // var Duck = {
    //   base: location.origin
    // };
    //
    // // If is blog page
    // if(location.pathname.indexOf('blog') > -1) {
    //   var splitPath = location.pathname.split('/');
    //   console.log(splitPath);
    //   if(splitPath.length > 3) {
    //     var post = splitPath[2];
    //     console.log(post);
    //   }
    // }
    //
    // function _getProductForBlogPage() {
    //   $.ajax({
    //     url: 'something',
    //     method: 'GET'
    //   })
    // };

} );

/*jshint browser:true */
/*!
* FitVids 1.1
*
* Copyright 2013, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
* Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* Released under the WTFPL license - http://sam.zoy.org/wtfpl/
*
*/

;(function( $ ){

  'use strict';

  $.fn.fitVids = function( options ) {
    var settings = {
      customSelector: null,
      ignore: null
    };

    if(!document.getElementById('fit-vids-style')) {
      // appendStyles: https://github.com/toddmotto/fluidvids/blob/master/dist/fluidvids.js
      var head = document.head || document.getElementsByTagName('head')[0];
      var css = '.fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}';
      var div = document.createElement("div");
      div.innerHTML = '<p>x</p><style id="fit-vids-style">' + css + '</style>';
      head.appendChild(div.childNodes[1]);
    }

    if ( options ) {
      $.extend( settings, options );
    }

    return this.each(function(){
      var selectors = [
        'iframe[src*="player.vimeo.com"]',
        'iframe[src*="youtube.com"]',
        'iframe[src*="youtube-nocookie.com"]',
        'iframe[src*="kickstarter.com"][src*="video.html"]',
        'object',
        'embed'
      ];

      if (settings.customSelector) {
        selectors.push(settings.customSelector);
      }

      var ignoreList = '.fitvidsignore';

      if(settings.ignore) {
        ignoreList = ignoreList + ', ' + settings.ignore;
      }

      var $allVideos = $(this).find(selectors.join(','));
      $allVideos = $allVideos.not('object object'); // SwfObj conflict patch
      $allVideos = $allVideos.not(ignoreList); // Disable FitVids on this video.

      $allVideos.each(function(){
        var $this = $(this);
        if($this.parents(ignoreList).length > 0) {
          return; // Disable FitVids on this video.
        }
        if (this.tagName.toLowerCase() === 'embed' && $this.parent('object').length || $this.parent('.fluid-width-video-wrapper').length) { return; }
        if ((!$this.css('height') && !$this.css('width')) && (isNaN($this.attr('height')) || isNaN($this.attr('width'))))
        {
          $this.attr('height', 9);
          $this.attr('width', 16);
        }
        var height = ( this.tagName.toLowerCase() === 'object' || ($this.attr('height') && !isNaN(parseInt($this.attr('height'), 10))) ) ? parseInt($this.attr('height'), 10) : $this.height(),
            width = !isNaN(parseInt($this.attr('width'), 10)) ? parseInt($this.attr('width'), 10) : $this.width(),
            aspectRatio = height / width;
        if(!$this.attr('name')){
          var videoName = 'fitvid' + $.fn.fitVids._count;
          $this.attr('name', videoName);
          $.fn.fitVids._count++;
        }
        $this.wrap('<div class="fluid-width-video-wrapper"></div>').parent('.fluid-width-video-wrapper').css('padding-top', (aspectRatio * 100)+'%');
        $this.removeAttr('height').removeAttr('width');
      });
    });
  };

  // Internal counter for unique video names.
  $.fn.fitVids._count = 0;

// Works with either jQuery or Zepto
})( window.jQuery || window.Zepto );


// D & C
jQuery( document ).ready( function( $ ) {

  // Fade in CTA
  setTimeout(function() {
    $('#sticky-promo-cta').animate({opacity: 1}, 3000);
  }, 5000);

  // Fitvids
  $('.video-wrapper').fitVids();

  // If product page, replace container class
  if(window.location.href.indexOf('/product/') > -1) {
    $('#container').addClass('container-wide').removeClass('container').css('padding', '0 40px');
  }

  // Scroll events
  var lastScrollTop = 0;
  $(window).scroll(function(e) {

    // Reduce height of header
    var scrollTop = $(this).scrollTop();
    var header = $('#header');
    if(scrollTop > 20) {
      if(!header.hasClass('reduced-header')) {
        $('#header').addClass('reduced-header');
      }
    } else {
      if(header.hasClass('reduced-header')) {
        $('#header').removeClass('reduced-header');
      }
    }

    // Scroll event for home page parallax
    if(window.location.pathname === '/' && window.location.search.indexOf('?s=') === -1) {
      var st = $(this).scrollTop();
      if (st > lastScrollTop){
        if(_isScrolledIntoView('.sunglasses-image-box')) {
          _renderParallax('down');
        } else {
          _resetParallax();
        }
      } else {
        if(_isScrolledIntoView('.sunglasses-image-box')) {
           _renderParallax('up');
        } else {
          _resetParallax();
        }
      }
      lastScrollTop = st;
    }
  });


  function _isScrolledIntoView(elem) {
    var $elem = $(elem);
    var $window = $(window);
    var docViewTop = $window.scrollTop();
    var docViewBottom = docViewTop + $window.height();
    var elemTop = $elem.offset().top;
    var elemBottom = elemTop + $elem.height();
    return ((( elemTop >= docViewTop) && (elemTop <= docViewBottom)) || ((elemBottom >= docViewTop) && (elemBottom <= docViewBottom)));
  };

  var newVal = 0;
  function _renderParallax(dir) {

    if(dir === 'down') {
      // console.log('down', newVal);
      if(newVal > -68) {
        newVal = newVal - 2;
      }
    } else {
      // console.log('up', newVal);
      if(newVal < 100) {
        newVal = newVal + 2;
      }
    }
    $('.sunglasses-image-box').css('top', newVal + 'px');
  };

  function _resetParallax() {
    //$('.sunglasses-image-box').css('top', '0px');
  };

});
