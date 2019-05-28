// import Instafeed from 'instafeed.js';
// import { TweenMax, Power2 } from 'gsap';

export default {
  init() {
    const $loadInsta = $('[data-js-load-insta]');
    const $morePostsContainer = $('[data-js-more-posts-container]');

    $loadInsta.on('click', () => {
      // feed.next();
      $loadInsta.addClass('is-disabled');
      $morePostsContainer.slideDown();
    });

    $.fancybox.defaults.hash = false;

    const $fancyLinks = $('[data-js-fancy-trigger]');
    const $instagramOverlays = $('[data-js-instagram-overlay-content]');

    $fancyLinks.on('click', function(e) {
      e.preventDefault();

      let $this = $(this);
      let targetIndex = $this.data('target-index') ? $this.data('target-index') : 0;

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

    /*const feed = new Instafeed({
      get: 'tagged',
      tagName: 'esilab',
      clientId: '62bc68e6e83c41e8a6c88959cc3b81b9',
      accessToken: '5695088869.ba4c844.98a3a3e9f4c443f99ea734208ae5eeb1',
      limit: 15,
      resolution: 'standard_resolution',
      template: '<div data-js-animate-this class="col-xs-6 col-sm-4 col-md-4 col-lg-4 mb3">' +
                  '<a data-js-fancy-trigger data-fancybox="instagram-gallery" data-caption="{{caption}} - <a target=\'blank\' href=\'{{link}}\'>{{link}}</a>" href="{{link}}"><div style="background-image: url({{image}});" class="aspect-ratio aspect-ratio--1x1 bg-center contain bg-black-80"></div></a>' +
                '</div>',
      after: function() {
        const $fancyLinks = $('[data-js-fancy-trigger]');

        $fancyLinks.fancybox({
          arrows : true,
          showCloseButton: true,
          margin: [100, 25],
          hash: false,
          baseClass : 'image-overlay',
          buttons : [
            'close',
          ],
        });

        $loadInsta.removeClass('is-disabled');

        $instafeed.find('[data-js-animate-this]').each(function(index) {
          let $this = $(this);

          if (!$this.hasClass('has-triggered')) {
            TweenMax.fromTo($this, 0.1, {
              opacity: 0,
              y: '-15px',
            }, {
              opacity: 1.0,
              y: '0',
              ease: Power2.easeIn,
              delay: index * 0.05,
              onComplete: () => {
                $this.addClass('has-triggered');
              },
            });
          }
        });

        if (!this.hasNext()) {
          $loadInsta.addClass('is-disabled');
        }
      },
    });*/

    

    // feed.run();
  },
};
