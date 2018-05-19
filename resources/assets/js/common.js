$(function() {
  $('header .hamburger').click(function() {
    $('.header__modal').addClass('show');
  });
  $('.header__modal-overlay').click(function() {
    $('.header__modal').removeClass('show');
  });

  function startCarouselHeader() {
    if ($('.header').length > 0) {
      $('.header__bottom-menu').owlCarousel({
        items: 4,
        margin: 0,
        nav: false,
        dots: true,
        responsive: {
          425: {
            items: 5,
          },
          600: {
            items: 7,
          },
          768: {
            items: 8,
          },
          920: {
            items: 9,
          },
          1280: {
            items: 10,
          },
        },
      });
    }
  }
  function stopCarouselHeader() {
    var owl = $('.header__bottom-menu');
    owl.trigger('destroy.owl.carousel');
    owl.addClass('off');
  }
  $(document).ready(function() {
    if ($(window).width() < 1280) {
      startCarouselHeader();
    } else {
      $('.header__bottom-menu').addClass('off');
    }
  });

  $(window).resize(function() {
    if ($(window).width() < 1280) {
      startCarouselHeader();
    } else {
      stopCarouselHeader();
    }
  });

  function productSlider() {
    if ($('.section--product-slider').length > 0) {
      $('.product-slider__tabgroup > div').hide();
      $('.product-slider__tabgroup> div:first-of-type').show();
      $('.product-slider__tabs-list>li>a').click(function(e) {
        e.preventDefault();
        var $this = $(this);
        var tabgroup = '#' + $this.parents('.product-slider__tabs-list').data('tabgroup');
        var others = $this
          .closest('li')
          .siblings()
          .children('a');
        var target = $this.attr('href');
        others.removeClass('active');
        $this.addClass('active');
        $(tabgroup)
          .children('.product-slider__tabgroup-item')
          .hide();
        $(target).show();
      });
    }
  }
  productSlider();

  if ($('.section--product-slider').length > 0) {
    $('.product-slider__tabgroup-item').owlCarousel({
      items: 6,
      margin: 10,
      nav: true,
      dots: true,
      loop: true,
      navText: [
        '<i class="fa fa-angle-left" aria-hidden="true"></i>',
        '<i class="fa fa-angle-right fa-2" aria-hidden="true"></i>',
      ],
      responsive: {
        320: {
          items: 2,
        },
        768: {
          items: 3,
        },
        1280: {
          items: 4,
        },
        1366: {
          items: 5,
        },
        1600: {
          items: 6,
        },
      },
    });
  }

  if ($('.section--banner').length > 0) {
    $('.banner').owlCarousel({
      items: 1,
      margin: 10,
      nav: false,
      dots: true,
      navText: [
        '<i class="fa fa-angle-left" aria-hidden="true"></i>',
        '<i class="fa fa-angle-right fa-2" aria-hidden="true"></i>',
      ],
    });
  }

  function startCarousel() {
    if ($('.section-promo').length > 0) {
      $('.promo').owlCarousel({
        items: 1,
        margin: 10,
        dots: true,
        loop: true,
      });
    }
    if ($('.section--advantage').length > 0) {
      $('.advantage').owlCarousel({
        items: 3,
        margin: 10,
        dots: true,
        loop: true,
      });
    }
  }

  function stopCarousel() {
    var owl = $('.promo, .advantage');
    owl.trigger('destroy.owl.carousel');
    owl.addClass('off');
  }

  $(document).ready(function() {
    if ($(window).width() < 480) {
      startCarousel();
    } else {
      $('.promo, .advantage').addClass('off');
    }
  });

  $(window).resize(function() {
    if ($(window).width() < 480) {
      startCarousel();
    } else {
      stopCarousel();
    }
  });

  if ($('.section--brands').length > 0) {
    $('.brands').owlCarousel({
      items: 3,
      margin: 30,
      nav: true,
      dots: true,
      stagePadding: 0,
      loop: true,
      navText: [
        '<i class="fa fa-angle-left" aria-hidden="true"></i>',
        '<i class="fa fa-angle-right fa-2" aria-hidden="true"></i>',
      ],
      responsive: {
        1280: {
          items: 4,
          stagePadding: 80,
        },
        1366: {
          items: 5,
          margin: 20,
        },
        1600: {
          items: 6,
          margin: 20,
        },
      },
    });
  }
  if ($('.section--instagram').length > 0) {
    $('.instagram').owlCarousel({
      items: 3,
      margin: 15,
      nav: true,
      dots: true,
      stagePadding: 0,
      loop: true,
      navText: [
        '<i class="fa fa-angle-left" aria-hidden="true"></i>',
        '<i class="fa fa-angle-right fa-2" aria-hidden="true"></i>',
      ],
      responsive: {
        480: {
          stagePadding: 20,
        },
        768: {
          items: 4,

          stagePadding: 30,
        },
        1280: {
          items: 4,
          stagePadding: 120,
        },
        1366: {
          items: 5,
          stagePadding: 120,
        },
        1600: {
          items: 6,

          stagePadding: 120,
        },
      },
    });
  }
  if ($('.section--news-review').length > 0) {
    $('.news').owlCarousel({
      items: 1,
      margin: 10,
      nav: true,
      dots: false,
      loop: true,
      navText: [
        '<i class="fa fa-angle-left" aria-hidden="true"></i>',
        '<i class="fa fa-angle-right fa-2" aria-hidden="true"></i>',
      ],
    });
    $('.review').owlCarousel({
      items: 1,
      margin: 10,
      nav: true,
      dots: false,
      loop: true,
      navText: [
        '<i class="fa fa-angle-left" aria-hidden="true"></i>',
        '<i class="fa fa-angle-right fa-2" aria-hidden="true"></i>',
      ],
    });
  }
});
