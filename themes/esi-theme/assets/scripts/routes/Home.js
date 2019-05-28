import $ from 'jquery';
import { TweenMax, TimelineLite, Power2 } from 'gsap';
import 'fullpage.js/dist/jquery.fullPage.js';
// import Typed from 'typed.js';
import Words from '../util/words';
import 'slick-carousel';

export default {
  init() {
    const $carousel = $('[data-js-carousel]');
    let isSafari = !!navigator.userAgent.match(/Version\/[\d.]+.*Safari/);


    $carousel.slick({
      // slide: '.slick-slide',
      arrows: false,
      infinite: true,
      speed: 750,
      fade: true,
      dots: true,
      autoplaySpeed: 4000,
    });

    $carousel.on('afterChange', (event, slick, currentSlide) => {
      let $activeSlide = $('.swipe-section.active');
      let $animatedElements = $(`[data-slick-slide-${currentSlide}]`).find('[data-js-animate-this]');
      this.animateItems($activeSlide, $animatedElements);
    });

    $('[data-js-full-page-container]').fullpage({
      sectionSelector: '.swipe-section',
      scrollOverflow: true,
      scrollOverflowOptions: {
        click: true,
      },
      scrollDelay: 1000,
      css3: false,
      afterRender: () => {
        $(document).on('touchstart', '.slick-dots button', function() {
          let targetIndex = $(this).html();
          $carousel.slick('slickGoTo', targetIndex);
        });

        $(document).on('touchstart', '.site-footer a', function() {
          let $this = $(this);

          if (!isSafari) {
            if ($this.attr('target') === '_blank') {
              window.open($this.attr('href'), '_blank');
            } else {
              window.location.href = $this.attr('href');
            }
          } else {
            window.location.href = $this.attr('href');
          }
        });
      },
      afterLoad: () => {
        let $activeSlide = $('.swipe-section.active');
        if ($activeSlide.hasClass('.verticals-module')) {
          let $animatedElements = $activeSlide.find('.h-slide').first().find('[data-js-animate-this]');
          $carousel.slick('play');
          this.animateItems($activeSlide, $animatedElements);
        } else if ($activeSlide.hasClass('home-splash')) {
          if (!$activeSlide.hasClass('has-triggered')) {
            $carousel.slick('pause');
            $activeSlide.addClass('has-triggered');

            let tl = new TimelineLite();
            let $siteLogo = $('[data-js-site-logo]');
            let $splashBg = $('[data-js-spash-bg]');
            let $navTrigger = $('[data-js-nav-trigger-animate]');
            let $splashTitleTop = $('[data-js-splash-title-top]');
            let $splashTitleBottom = $('[data-js-splash-title-bottom]');
            let $downButton = $('[data-js-down-button]');
            let $contactButton = $('[data-js-contact-button]');

            tl.fromTo($siteLogo, 0.8, {
              opacity: 0,
              y: `7px`,
            }, {
              opacity: 1.0,
              y: '7px',
              ease: Power2.easeOut,
            });

            tl.fromTo($splashTitleTop, 0.8, {
              opacity: 0,
              y: `-15px`,
            }, {
              opacity: 1.0,
              y: '0',
              ease: Power2.easeOut,
              onComplete: () => {
                let $typed = $('.typed');
                if ($typed.length && !$typed.hasClass('triggered')) {
                  Words.start();
                  $typed.addClass('triggered');
                }
              },
            }, '+=0.6');

            tl.fromTo($splashTitleBottom, 1.2, {
              opacity: 0,
              y: `-25px`,
            }, {
              opacity: 1.0,
              y: '0',
              ease: Power2.easeOut,
            }, '+=0.2');

            tl.fromTo($splashBg, 1.2, {
              opacity: 0,
            }, {
              opacity: 0.8,
              ease: Power2.easeIn,
            }, '-=2');

            tl.fromTo($navTrigger, 0.8, {
              opacity: 0,
            }, {
              opacity: 1.0,
              ease: Power2.easeOut,
            }, '-=0.6');

            tl.fromTo([$downButton, $contactButton], 1.2, {
              opacity: 0,
            }, {
              opacity: 1.0,
              ease: Power2.easeOut,
            }, '-=0.4');

            tl.play();

          }
        } else {
          $carousel.slick('pause');
          let $animatedElements = $activeSlide.find('[data-js-animate-this]');
          this.animateItems($activeSlide, $animatedElements);
        }

        let $svgBg = $activeSlide.find('.svg-bg');
        if ($svgBg.length && !$svgBg.hasClass('triggered')) {
          TweenMax.to($svgBg, 25, {
            strokeDashoffset: 0,
            opacity: 0.8,
          });
          $svgBg.addClass('triggered');
        }

        let $talk = $activeSlide.find('[data-js-talk-box]');

        if ($talk.length && !$talk.hasClass('triggered')) {
          $talk.addClass('triggered');
        }
      },
    });

    const $moveDown = $('[data-js-move-down]');

    $moveDown.on('click', (e) => {
      e.preventDefault();

      $.fn.fullpage.moveSectionDown();
    });

    //STOP VIDEO FROM PLAYING BEFORE IT'S VISIBLE
    var video = document.getElementsByTagName("video")[0];
    console.log(video);
    console.log("hi");
    var videoInterval = setInterval(function() {
      if(video.paused == false) {
        video.pause();
        setTimeout(function() {
          video.play();
        }, 2000);
        clearInterval(videoInterval);
      }
    }, 5);
  },
  animateItems($activeSlide, $animatedElements) {
    $animatedElements.each(function() {
      let $this = $(this);

      if (!$this.hasClass('has-triggered')) {
        let yOffset = $this.data('y') ? $this.data('y') : 0;
        let delay = $this.data('delay') ? $this.data('delay') : 0;
        let duration = $this.data('duration') ? $this.data('duration') : 1;
        let targetOpacity = $this.data('target-opacity') ? $this.data('target-opacity') : 1.0;

        TweenMax.fromTo($this, duration, {
          opacity: 0,
          y: `${yOffset}px`,
        }, {
          opacity: targetOpacity,
          y: '0',
          ease: Power2.easeOut,
          delay: delay,
          onComplete: () => {
            $this.addClass('has-triggered');
          },
        });
      }
    });
  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};
