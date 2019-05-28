export default {
  finalize() {
    const $carousel = $('[data-js-carousel]');

    $carousel.slick({
      slide: '[data-js-slide]',
      arrows: false,
      infinite: true,
      speed: 750,
      fade: true,
      cssEase: 'linear',
      dots: false,
      autoplaySpeed: 4000,
    });

    $carousel.slick('play');
  },
};
