

export default {
  finalize() {
    const $words = $('[data-js-word-item]');

    if ($words.length) {
      let wordIndex = 0;
      setInterval(() => {
        $words.removeClass('active');
        if (wordIndex === $words.length - 1) {
          wordIndex = 0;
        } else {
          wordIndex++;
        }
        $words.eq(wordIndex).addClass('active');
      }, 1000);
    }

    const $awardSlides = $('.award-slide');

    if ($awardSlides.length > 1) {
      let slideIndex = 0;
      setInterval(() => {
        $awardSlides.removeClass('active');
        if (slideIndex === $awardSlides.length - 1) {
          slideIndex = 0;
        } else {
          slideIndex++;
        }
        $awardSlides.eq(slideIndex).addClass('active');
      }, 3000);
    }

    const $metricSlides = $('.metric-slide');

    if ($metricSlides.length > 1) {
      let slideIndex = 0;
      setInterval(() => {
        $metricSlides.removeClass('active');
        if (slideIndex === $metricSlides.length - 1) {
          slideIndex = 0;
        } else {
          slideIndex++;
        }
        $metricSlides.eq(slideIndex).addClass('active');
      }, 3000);
    }

    let initialHeight = 0;
    let totalHeight = 0;
    let $cmsContent = $('.work-cms-content');
    
    let calculateWorkCMSContentHeights = () => {
      initialHeight = 0;
      totalHeight = 0;
      $cmsContent.find('.inner-wrap').find('p, h1, h2, h3').each(function(i) {
        var $this = $(this);

        totalHeight += $this.outerHeight(true);

        if (i < 2 || initialHeight < 100) {
          initialHeight += $this.outerHeight(true);
        }
      });
    }

    let resizeWorkCMSContent = () => {
      if (!$cmsContent.hasClass('expanded')) {
        $cmsContent.find('.inner-wrap').height(initialHeight);
      } else {
        $cmsContent.find('.inner-wrap').height(totalHeight);
      }
    }

    calculateWorkCMSContentHeights();
    resizeWorkCMSContent();
    $(window).on("resize", () => {
      calculateWorkCMSContentHeights();
      resizeWorkCMSContent();
    });

    $('[data-js-expand]').on('click', function() {
      $cmsContent.toggleClass('expanded');
      resizeWorkCMSContent();
    });

    $cmsContent.find('.inner-wrap').addClass('show');

    const $loadMoreButton = $('[data-js-load-more-button]');
    const $morePostsContainer = $('[data-js-more-posts-container]');

    $loadMoreButton.on('click', (e) => {
      e.preventDefault();

      $morePostsContainer.slideDown('slow');
      $loadMoreButton.addClass('is-disabled');
    });
  },
};
