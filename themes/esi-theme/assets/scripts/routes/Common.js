import '@fancyapps/fancybox';
import { TweenMax, TimelineMax, Power2 } from 'gsap';
import twitterFetcher from 'twitter-fetcher';
import Headroom from 'headroom.js';
import 'animation.gsap';
import 'debug.addIndicators';
import ScrollMagic from 'scrollmagic';
import CountUp from 'countup.js';
import FastClick from 'fastclick';

let isMobile = false;

export default {
  init() {
    FastClick.attach(document.body);
    const $doc = $(document);
    const $body = $('body');
    const $navTrigger = $('[data-js-nav-trigger]');
    const $navOverlay = $('[data-js-nav-overlay]');

    const $navItems = $navOverlay.find('[data-js-animate-this]');
    const navItemsLength = $navItems.length;

    let $conditionalVideo = $('[data-js-mobile-conditional-video]');
    if ($(window).outerWidth() <= 670) {
      isMobile = true;
      $conditionalVideo.each(function() {
        let $this = $(this);
        $this.css({
          'background-image': `url(${$this.data('fallback-src')})`,
        });
      });
    } else {
      $conditionalVideo.each(function() {
        let $this = $(this);
        let $video = $this.find('video');
        let $source = $this.find('source');
        $source.attr('src', $source.data('video-src'));
        $video[0].load();
        $video[0].play();
      });
    }

    $('[data-js-inline-video]').each(function() {
      let $this = $(this);

      $this[0].load();
      $this[0].play();
    });

    $navTrigger.on('click', (e) => {
      e.preventDefault();

      if (!$navOverlay.hasClass('is-active')) {
        $navTrigger.addClass('is-active');
        $body.addClass('nav-active');

        TweenMax.fromTo($navOverlay, 0.5, {
          opacity: 0,
          scale: 0.975,
        }, {
          opacity: 1.0,
          scale: 1,
          ease: Power2.easeIn,
          onComplete: () => {
            $navItems.each(function(index) {
              let $this = $(this);
              $body.addClass('expanded-nav-width');

              TweenMax.fromTo($this, 0.25, {
                opacity: 0,
                y: '5px',
              }, {
                opacity: 1.0,
                y: '0',
                delay: index * 0.05,
              });
            });

            $navOverlay.addClass('is-active');
          },
        });
      } else {
        $navTrigger.removeClass('is-active');
        $body.removeClass('nav-active');
        $body.removeClass('expanded-nav-width');

        $navItems.each(function(index) {
          let $this = $(this);

          TweenMax.fromTo($this, 0.25, {
            opacity: 1.0,
            y: 0,
          }, {
            opacity: 0.0,
            y: '5px',
            delay: index * 0.05,
            onComplete: () => {
              if (index === navItemsLength - 1) {
                TweenMax.fromTo($navOverlay, 0.5, {
                  opacity: 1.0,
                  scale: 1,
                }, {
                  opacity: 0.0,
                  scale: 0.975,
                  ease: Power2.easeOut,
                  onComplete: () => {
                    $navOverlay.removeClass('is-active');
                  },
                });
              }
            },
          });
        });
      }
    });

    $doc.on('click', '[data-js-filter-trigger]', (e) => {
      let $this = $(e.target);
      let $filterContainer = $this.parents('[data-js-filter]');
      let $filterItems = $filterContainer.find('[data-js-filter-content]');

      if ($filterContainer.hasClass('is-active')) {
        $filterItems.slideUp();
        $filterContainer.removeClass('is-active');
      } else {
        $filterItems.slideDown();
        $filterContainer.addClass('is-active');
      }
    });

    $doc.on('click', '[data-js-tap-link]', function() {
      let $this = $(this);
      let href = $this.data('href');

      window.location.href = href;
    });

    let $shareLinks = $('[data-js-share-links]');

    $doc.on('click', '[data-js-share-trigger]', (e) => {
      e.preventDefault();

      if ($shareLinks.hasClass('active')) {
        $shareLinks.removeClass('links-active');
        setTimeout(() => {
          $shareLinks.removeClass('active');
        }, 200);
      } else {
        $shareLinks.addClass('active');
        setTimeout(() => {
          $shareLinks.addClass('links-active');
        }, 200);
      }
    });

    const $fancyLinks = $('[data-fancybox]');

    $fancyLinks.fancybox({
      arrows : false,
      showCloseButton: true,
      padding: 0,
      margin : 0,
      hash: '',
      baseClass : 'image-overlay',
      buttons : [
        'close',
      ],
    });

    const $fancyGallery = $('[data-fancy-gallery]');

    $fancyGallery.on('click', function(e) {
      e.preventDefault();

      let $this = $(this);
      let gallery = window[$this.data('gallery-target')];
      let targetIndex = $this.data('target-index') ? $this.data('target-index') : 0;

      $.fancybox.open(gallery, {
        loop: true,
        baseClass : 'gallery-overlay',
        margin: [100, 25],
        hash: '',
        buttons : [
          'fullScreen',
          'close',
        ],
        beforeLoad: () => {
          $('.fancybox-caption-wrap').hide().removeClass('show');
        },
        afterShow: () => {
          let $imageWrap = $('.fancybox-slide--current').find('.fancybox-image-wrap');

          if ($imageWrap.length) {
            $('.fancybox-caption-wrap').css({
              'width': `${$imageWrap.width()}px`,
              'bottom': `${$(window).height() - ($imageWrap.position().top + $imageWrap.height())}px`,
            }).show().addClass('show');
          }
        },
      }, targetIndex);
    });

    this.singleTweet();
    this.header();

    if ($('.multi-tweet').length) {
      this.multipleTweets();
    }

    //REMOVE FETCHRSS NOTICE FROM INSTAGRAM OVERLAYS
    $("[data-js-instagram-overlay-content] a").each(function() {
      if($(this).attr("href") == "http://fetchrss.com/") {
        $(this).parent().remove();
      }
    });
  },
  finalize() {
    if ($('[data-js-scroll-page]').length) {
      setTimeout(() => {
        this.scrollInit();
      }, 500);
    }

    if ($('[data-js-animate-page-in]').length) {
      this.animatePageIn();
    }
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
  animateCapabilities() {
    let $dataContainer = $('[data-js-capabilities-data-container]');
    let $logo = $('.capabilities-logo');

    let $capabilities;
    let $firstCapability = $dataContainer.find('.capability-item.first').clone();
    let $secondCapability = $dataContainer.find('.capability-item.second').clone();
    let $lastCapability = $dataContainer.find('.capability-item.last').clone();
    let $randomCapabilities = $dataContainer.find('.capability-item.randomize').clone();

    $randomCapabilities.sort(() => {
      return 0.5 - Math.random();
    });
    $randomCapabilities = $randomCapabilities.slice(0, 4);

    let $capHolder = $('[data-js-cap-holder]');
    $capHolder.html('')
    $capHolder
      .append($logo)
      .append($firstCapability)
      .append($secondCapability)
      .append($randomCapabilities)
      .append($lastCapability);

    $capabilities = $capHolder.find('.capability-item');
    let height = $capabilities.first().height() - 2;

    $capabilities.each(function(index) {
      let $this = $(this);
      switch(index) {
        case 0:
          $this.find('span').addClass('t-red');
          break;
        case 1:
          $this.find('span').addClass('t-yellow');
          break;
        case 2:
          $this.find('span').addClass('t-pale-blue');
          break;
        case 3:
          $this.find('span').addClass('t-gold');
          break;
        case 4:
          $this.find('span').addClass('t-orange');
          break;
        case 5:
          $this.find('span').addClass('t-yellow');
          break;
        default:
          $this.find('span').addClass('t-pale-blue');
          break;
      }
    });

    let tl = new TimelineMax({
      // repeat: -1,
      onComplete: () => {
        this.animateCapabilities();
      },
    });
    tl.pause();

    tl.fromTo($logo, 1.0, {
      // display: 'block',
    }, {
      opacity: 1.0,
      scale: 1.0,
      ease: Power2.easeOut,
    }, '+=1');

    tl.fromTo($logo, 0.8, {
      opacity: 1.0,
      scale: 1.0,
    }, {
      opacity: 0.0,
      scale: 0.95,
      // display: 'none',
      ease: Power2.easeOut,
    }, '+=1');


    $capabilities.each(function() {
      let $this = $(this);

      tl.fromTo($this, 0.4, {
        display: 'none',
        opacity: 0.0,
        y: '5px',
        height: 0,
        // x: '-15px',
      }, {
        opacity: 1.0,
        y: '0',
        height: height,
        // x: '0',
        display: 'block',
        ease: Power2.easeOut,
      }, '+=0.4');
    });

    $capabilities.each(function(index) {
      let $this = $(this);

      tl.fromTo($this, 0.4, {
        // opacity: 1.0,
        // scale: 1.0,
        // x: '-15px',
      }, {
        opacity: 0.0,
        // scale: 0.95,
        // x: '0',
        // display: 'block',
        ease: Power2.easeOut,
      }, (index === 0 ? '+=0.6' : '-=0.25'));
    });

    tl.play();
  },
  buildCapabilities() {

  },
  animatePhases() {
    let tl = new TimelineMax();
    tl.pause();
    let $phases = $('.phase-item:not(.first)');


    $phases.each(function() {
      let $this = $(this);

      tl.fromTo($this, 0.5, {
        opacity: 0.0,
        height: 0,
        y: '5px',
      }, {
        opacity: 1.0,
        height: isMobile ? '25px' : '50px',
        y: '0',
        display: 'block',
        ease: Power2.easeOut,
      }, '+=0.5');
    });

    setTimeout(() => {
      tl.play();
    }, 1000);
  },
  singleTweet() {
    const configList = {
      profile: {
        screenName: 'esidesign',
      },
      maxTweets: 1,
      enableLinks: true,
      showUser: true,
      showTime: true,
      showImages: false,
      lang: 'en',
      customCallback: handleFeed,
      showInteraction: false,
    };

    twitterFetcher.fetch(configList);

    function handleFeed(tweets) {
      if (tweets && tweets.length) {
        $('[data-js-tweet-holder]').html(tweets[0]);
      }
    }
  },
  multipleTweets() {
    const configList = {
      profile: {
        screenName: 'esidesign',
      },
      maxTweets: 3,
      enableLinks: true,
      showUser: true,
      showTime: true,
      showImages: false,
      lang: 'en',
      customCallback: handleFeed,
      showInteraction: false,
    };

    twitterFetcher.fetch(configList);

    function handleFeed(tweets) {
      if (tweets && tweets.length) {
        $('[data-js-multi-tweet]').html(tweets);
      }
    }

    $(document).on('click', '.tweet', function(){
      var $this = $(this);
      var href = $this.next('.timePosted').find('a').attr('href');

      if (href) {
        window.open(href, '_blank');
      }
    });
  },
  header() {
    const $header = $('[data-js-header]');

    $header.each(function() {
      let headroom = new Headroom($(this)[0]);
      headroom.init();

      if ($(document).scrollTop() > 0) {
        $(this).addClass('headroom--unpinned');
      }
    });
  },
  scrollInit() {
    const controller = new ScrollMagic.Controller();
    const $window = $(window);
    const $scrollSection = $('[data-js-scroll-section]');
    let $scrollHeader = $('[data-js-scroll-header]');
    let $scrollHeaderTrigger = $('[data-js-header-trigger]');
    let wWidth = $window.outerWidth(true);
    let that = this;

    if ($scrollHeader.length) {
      let $tweenElement = $scrollHeader.find('.bg-center').length ? $scrollHeader.find('.bg-center') : $scrollHeader;
      new ScrollMagic.Scene({
        triggerElement: $scrollHeaderTrigger[0],
        triggerHook: 0,
        reverse: true,
        offset: 0,
        duration: $scrollHeaderTrigger.outerHeight(),
      })
      // .addIndicators({
      //   name: 'header',
      //   zindex: 1000000,
      // })
      .setTween(TweenMax.fromTo($tweenElement[0], 1, { y: 0, scale: 1 }, { y: -25, scale: 1.2 }))
      .addTo(controller);
    }

    let triggerHook = 0.66;

    if (wWidth >= 1400) {
      triggerHook = 1;
    }

    $scrollSection.each(function() {
      let $this = $(this);
      let $animatedElements = $this.find('[data-js-animate-this]');
      let $capabilities = $this.find('[data-js-capabilities-slider]');
      let $phases = $this.find('[data-js-phases-slider]');
      let animationDuration = $this.outerHeight();
      let aboutMetrics = $this.find('.about-metric');
      let triggerElement = $this.children()[0];

      if (aboutMetrics.length) {
        triggerElement = $animatedElements[0];
      }

      new ScrollMagic.Scene({
        triggerElement,
        triggerHook: triggerHook,
        reverse: false,
        offset: 0,
        duration: animationDuration,
      })
      // .addIndicators({
      //   name: $this[0].id,
      //   zindex: 1000000,
      // })
      .on('start', function () {
        let $countUp = $this.find('[data-js-count-up]');
        if ($countUp.length) {
          $countUp.each(function() {
            let _$this = $(this);
            let start = _$this.data('start');
            let end = _$this.data('end');
            let duration = _$this.data('duration');
            let numAnim = new CountUp(_$this[0], start, end, 0, duration, {
              useEasing: false,
            });
            if (!numAnim.error) {
              numAnim.start();
            }
          });
        }

        let $svgBg = $this.find('.svg-bg');

        if ($svgBg.length) {
          $svgBg.each(function() {
            let _$this = $(this);
            let lineLength = _$this[0].getTotalLength();
            _$this.css('stroke-dasharray', lineLength);
            _$this.css('stroke-dashoffset', lineLength);
            TweenMax.to(_$this[0], 5, {
              strokeDashoffset: 0,
              opacity: 1.0,
            });
          });
        }

        if (aboutMetrics.length) {
          $animatedElements.each(function(index) {
            if (index == 0) {
              TweenMax.fromTo($(this)[0], 1, { opacity: 0.0, x: -50, scale: 0.95 }, { opacity: 1.0, x:0, scale: 1.0, ease: Power2.easeOut, delay: (1 / 10)});
            } else if (index == 1) {
              TweenMax.fromTo($(this)[0], 1, { opacity: 0.0, y: 50, scale: 0.95 }, { opacity: 1.0, y:0, scale: 1.0, ease: Power2.easeOut, delay: (3 / 10)});
            } else {
              TweenMax.fromTo($(this)[0], 1, { opacity: 0.0, x: 50, scale: 0.95 }, { opacity: 1.0, x:0, scale: 1.0, ease: Power2.easeOut, delay: (2 / 10)});
            }
          });
        } else if ($animatedElements.length) {
          $animatedElements.each(function(index) {
            TweenMax.fromTo($(this)[0], 1, { opacity: 0.0, y: 50, scale: 0.95 }, { opacity: 1.0, y:0, scale: 1.0, ease: Power2.easeOut, delay: (index / 10)});
          });
        }

        if ($capabilities.length) {
          that.animateCapabilities();
        }

        if ($phases.length) {
          that.animatePhases();
        }
      })
      // .setTween(timeline)
      .addTo(controller);
    });
  },
  animatePageIn() {
    const $animateInItems = $('[data-js-animate-page-item]');

    $animateInItems.each(function(index) {
      TweenMax.fromTo($(this)[0], 1, { opacity: 0.0, y: 50 }, { opacity: 1.0, y:0, ease: Power2.easeOut, delay: (index / 10)})
    });
  },
};
