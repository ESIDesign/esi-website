// import Instafeed from 'instafeed.js';

export default {
  init() {

    const $carousel = $('[data-js-carousel]');

    $carousel.slick({
      slide: '[data-js-slide]',
      arrows: false,
      autoplay: true,
      infinite: true,
      speed: 500,
      fade: true,
      dots: false,
      autoplaySpeed: 4000,
    });

    $carousel.on('afterChange', () => {
      $('.slick-slide').find('[data-js-animate-slide]').removeClass('active');
      setTimeout(() => {
        $('.slick-active').find('[data-js-animate-slide]').addClass('active');
      }, 250);
    });

    $.fancybox.defaults.hash = false;

    const $fancyLinks = $('[data-js-fancy-trigger]');
    const $instagramOverlays = $('[data-js-instagram-overlay-content]');

    $fancyLinks.on('click', function(e) {
      e.preventDefault();

      let $this = $(this);
      // let target = $this.attr('href');
      let targetIndex = $this.data('target-index') ? $this.data('target-index') : 0;
      console.log('click');

      $.fancybox.open($instagramOverlays, {
        loop: true,
        smallBtn: false,
        baseClass : 'gallery-overlay',
        margin: [100, 25],
        hash: '',
        buttons : [
          'close',
        ],
      }, targetIndex);
    });
    // const feed = new Instafeed({
    //   get: 'tagged',
    //   tagName: 'esipeople',
    //   userId: '266854171',
    //   clientId: '62bc68e6e83c41e8a6c88959cc3b81b9',
    //   accessToken: '5695088869.ba4c844.98a3a3e9f4c443f99ea734208ae5eeb1',
    //   limit: 3,
    //   resolution: 'standard_resolution',
    //   template: '<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mb3">' +
    //               '<a target="_blank" href="{{link}}"><div style="background-image: url({{image}});" class="aspect-ratio aspect-ratio--1x1 bg-center contain bg-black-80"></div></a>' +
    //             '</div>',
    // });
    //
    // feed.run();
  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};
