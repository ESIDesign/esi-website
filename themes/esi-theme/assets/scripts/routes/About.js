import 'slick-carousel';

export default {
  init() {
  },
  finalize() {
    const $carousel = $('[data-js-carousel]');

    $carousel.slick({
      // slide: '[data-js-slide]',
      arrows: false,
      infinite: true,
      speed: 500,
      fade: true,
      cssEase: 'linear',
      dots: false,
      autoplaySpeed: 2000,
    });

    $carousel.slick('play');

    const $carouselPlay = $('[data-js-carousel-buttons]');

    $carouselPlay.slick({
      slide: '[data-js-slide]',
      arrows: false,
      infinite: true,
      speed: 750,
      fade: true,
      cssEase: 'linear',
    });

    $('[data-js-prev]').on('click', () => {
      $carouselPlay.slick('slickPrev');
    });

    $('[data-js-next]').on('click', () => {
      $carouselPlay.slick('slickNext');
    });

    //METRIC COUNTUPS
    var resizeCountup = function() {
      $(".about-metric .countup").each(function() {
        var current = $(this).html();
        $(this).html($(this).data("countup")).css("width", "auto").css("width", $(this).width());
        $(this).html(current);
      });
    };

    var countupOnScroll = function() {
      if($(window).scrollTop() > $(".about-metric .metric-title").offset().top - window.innerHeight + 30 && !$(".about-metric .countup").first().hasClass("activated")) {
        $(".about-metric .countup").addClass("activated").each(function() {
          var $el = $(this);
          $(this).data("interval", setInterval(function() {
            $el.html(parseInt($el.html()) + 1);
            if(parseInt($el.html()) >= $el.data("countup")) {
              clearInterval($el.data("interval"));
            }
          }, 2000 / $(this).data("countup")));
        });
      }
    };

    resizeCountup();
    $(window).on("resize", resizeCountup);

    countupOnScroll();
    $(window).on("scroll", countupOnScroll);

    //LOGO SWITCHING
    var $logos = $(".hidden-logos img");
    if($logos.length != 0) {
      setInterval(function() {
        swapLogos($(".client-block img"), $logos);
      }, 1000);
    }

    var swapLogos = function($logos, $hiddenLogos) {
      var $logo = $logos.eq(Math.floor(Math.random() * $logos.length));
      var $hiddenLogo = $hiddenLogos.eq(Math.floor(Math.random() * $hiddenLogos.length));
      
      $logo.animate({ "opacity" : 0 }, 500, function() {
        var src = $hiddenLogo.attr("src");
        $hiddenLogo.attr("src", $logo.attr("src"));
        $logo.attr("src", src);

        $logo.animate({ "opacity" : 1 }, 500);
      });
    };
  },
};
