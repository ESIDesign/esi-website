import { TweenMax, Power2, Elastic } from 'gsap';
import ScrollMagic from 'scrollmagic';
import 'imports?define=>false!scrollmagic/scrollmagic/uncompressed/plugins/animation.gsap'
import 'imports?define=>false!scrollmagic/scrollmagic/uncompressed/plugins/debug.addIndicators'


export default {
  init() {

  },
  finalize() {
    if ($('[data-js-single-case-study]').length) {
      console.log('this');
      setTimeout(() => {
        this.scrollInit();
      }, 1000);
    }
  },
  scrollInit() {
    const controller = new ScrollMagic.Controller();
    const $scrollSection = $('[data-js-scroll-section]');
    const numScrollSections = $scrollSection.length - 1;

    $scrollSection.each(function(index) {
      let $this = $(this);
      let $animatedElements = $this.find('[data-js-animate-this]');
      let animationDuration = $this.outerHeight();
      let timeline = [];



      // let $svgBg = $this.find('.svg-bg-circles');
      // if ($svgBg.length) {
      //   $svgBg.each(function() {
      //     let $this = $(this);
      //     let lineLength = $this[0].getTotalLength();
      //     $this.css('stroke-dasharray', lineLength);
      //     $this.css('stroke-dashoffset', lineLength);
      //     timeline.push(TweenMax.to($this[0], 5, {
      //       strokeDashoffset: 0,
      //       opacity: 0.5,
      //     }));
      //   });
      // }

      let $line = $this.find('[data-js-line]');
      let lineHeight = animationDuration;
      if (index === numScrollSections) {
        lineHeight = animationDuration / 4;
      }

      timeline.push(TweenMax.to($line, 5, {
        height: lineHeight,
      }));

      let triggerHook = 0.5;

      // let $svgLine = $this.find('[data-js-svg-line]');

      // $svgLine.attr('y2', 120);
      // $svgLine.attr('stroke-dasharray', 120);
      // $svgLine.attr('stroke-dashoffset', 120);

      // timeline.push(TweenMax.to($svgLine, 10, { strokeDashoffset: 0 }));


      $animatedElements.each(function(index) {
        let $this = $(this);

        switch($this.data('animate-type')) {
          case 'bubble':
            timeline.push(TweenMax.fromTo($this[0], 3, { opacity: 0.0, scale: 0.0 }, { opacity: 1.0, scale: 1.0, ease: Elastic.easeOut.config(1, 0.8), delay: (index / 10) + 1}));
            break;
          case 'heading':
            timeline.push(TweenMax.fromTo($this[0], 3, { opacity: 0.0, x: -50, scale: 0.95 }, { opacity: 1.0, x:0, scale: 1.0, ease: Power2.easeOut, delay: (index / 10) + 1}));
            break;
          default:
            timeline.push(TweenMax.fromTo($(this)[0], 3, { opacity: 0.0, y: 50, scale: 0.95 }, { opacity: 1.0, y:0, scale: 1.0, ease: Power2.easeOut, delay: (index / 10) + 1}));
            break;
        }
      });

      new ScrollMagic.Scene({
        triggerElement: $this[0],
        triggerHook: triggerHook,
        reverse: false,
        offset: 0,
        duration: animationDuration,
      })
      // .addIndicators({
      //   name: $this[0].id,
      //   zindex: 1000000,
      // })
      .setTween([timeline])
      .addTo(controller);
    });
  },
};
