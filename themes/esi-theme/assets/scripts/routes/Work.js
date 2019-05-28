import page from 'page';
import queryString from 'query-string';
import { TweenMax, Power2} from 'gsap';
import 'imagesloaded';

export default {
  init() {
    let state = {
      currentFilter: 'all',
      currentTaxonomy: 'work_industry',
      currentPage: 1,
      totalPages: 0,
      urlToQuery: '/latest/',
    };

    let $filterItems = $('[data-js-filter-item]');
    let urlFilter = window.location.search ? queryString.parse(window.location.search)['filter'] : '';

    const $pageLoader = $('[data-js-page-loader]');
    const $loadMoreButton = $('[data-js-load-more-button]');
    const $currentPostsContainer = $('[data-js-posts-container]');

    state.currentPage = $('[data-js-current-page]').html() ? $('[data-js-current-page]').html() : 1;
    state.totalPages = $('[data-js-total-pages]').html() ? $('[data-js-total-pages]').html() : 1;

    window.addEventListener('popstate', function() {
      // On popstate reset page number to 1.
      state.currentPage = 1;
    }, false);

    $filterItems.on('click', function(e) {
      e.preventDefault();

      let $this = $(this);
      let filterValue = $this.data('filter');
      state.currentTaxonomy = $this.data('taxonomy');

      state.currentPage = 1;

      $filterItems.removeClass('is-active');

      if (filterValue === urlFilter) {
        urlFilter = '';
        page(`/work`);
      } else {
        urlFilter = filterValue;
        page(`/work/?filter=${filterValue}`);
      }
    });

    let baseUrl = window.featureBaseUrl ? window.featureBaseUrl : false;

    if (baseUrl) {
      page.base(baseUrl);
      page('/*', pageLogic);
      page();
    }

    function add1ColClass(el) {
      el.addClass('col-md-12 col-lg-12');
      el.find('.work-item-bg-wrapper').addClass('aspect-ratio--16x9').addClass('work-post-item');
    }
    function add2ColClass(el) {
      el.addClass('col-md-6 col-lg-6');
      el.find('.work-item-bg-wrapper').addClass('aspect-ratio--4x3').addClass('work-post-item');
    }
    function add3ColClass(el) {
      el.addClass('col-md-4 col-lg-4');
      el.find('.work-item-bg-wrapper').addClass('aspect-ratio--4x3').addClass('work-post-item');
    }

    function addGridClass(el, totalCount, secondCount) {
      el.addClass('is-currently-active');
      totalCount++;

      if (totalCount < 3) {
        add2ColClass(el);
      } else if (totalCount === 3) {
        add1ColClass(el);
      } else if (totalCount < 7) {
        add3ColClass(el);
      } else {
        add2ColClass(el);
        // secondCount++;

        // if (secondCount < 5) {
        //   add2ColClass(el);
        // } else if (secondCount < 7) {
        //   add3ColClass(el);
        // } else {
        //   secondCount = 0;
        //   add3ColClass(el);
        // }
      }

      return { totalCount, secondCount };
    }

    function removeGridClass(el) {
      el.removeClass('is-currently-active');
      el.removeClass('col-md-6 col-lg-6 col-md-12 col-lg-12 col-md-4 col-lg-4');
      el.find('.work-item-bg-wrapper').removeClass('aspect-ratio--4x3 aspect-ratio--16x9');
    }

    function pageLogic(ctx) {
      let filter = queryString.parse(ctx.querystring) ? queryString.parse(ctx.querystring)['filter'] : false;
      let filterArray = [];

      let $posts = $('[data-js-post]');
      $filterItems.removeClass('is-active');

      if (filter && filter.length) {
        filterArray = filter.split(',');
      }

      state.currentFilter = filterArray[0];

      $pageLoader.addClass('show');
      $loadMoreButton.addClass('is-disabled');

      if (filterArray.length) {
        let $activeFilter = $(`[data-filter="${filterArray[0]}"]`);
        $activeFilter.addClass('is-active');
        state.currentTaxonomy = $activeFilter.data('taxonomy');

        let postsLength = $posts.length;

        $posts.each(function(index) {
          let $this = $(this);
          TweenMax.to($this, 0.2, {
            opacity: 0,
            y: '50px',
            display: 'none',
            ease: Power2.easeOut,
            onComplete: function() {
              if (index === postsLength - 1) {
                $('[data-js-posts-container]').html('');
                let url = state.currentPage > 1 ? `/${state.currentTaxonomy}/${state.currentFilter}/page/${state.currentPage}` : `/${state.currentTaxonomy}/${state.currentFilter}`;
                fetchPosts(url);
              }
            },
          });
        });
      } else {
        let postsLength = $posts.length;

        $posts.each(function(index) {
          let $this = $(this);
          TweenMax.to($this, 0.2, {
            opacity: 0,
            y: '50px',
            display: 'none',
            ease: Power2.easeOut,
            onComplete: function() {
              if (index === postsLength - 1) {
                $('[data-js-posts-container]').html('');
                fetchPosts(`/work/page/${state.currentPage}`);
              }
            },
          });
        });
      }
    }

    $loadMoreButton.on('click', (e) => {
      e.preventDefault();

      if (!$loadMoreButton.hasClass('is-disabled') && !$loadMoreButton.hasClass('is-loading')) {
        $loadMoreButton.addClass('is-loading');

        let url;
        if (state.currentFilter) {
          url = state.currentPage > 1 ? `/${state.currentTaxonomy}/${state.currentFilter}/page/${state.currentPage}` : `/${state.currentTaxonomy}/${state.currentFilter}`;
        } else {
          url = state.currentPage > 1 ? `/work/page/${state.currentPage}` : `/work/page/`;
        }

        fetchPosts(url);
      }
    });

    function fetchPosts(url) {
      $.ajax(url, {
        dataType: 'html',
        type: 'post',
      }).done((data) => {
        let $data = $(data);
        let $morePostsContent = $data.find('[data-js-posts-container]').find('.blog-post');

        state.currentPage = $data.find('[data-js-current-page]').html() ? $data.find('[data-js-current-page]').html() : 1;
        state.totalPages = $data.find('[data-js-total-pages]').html() ? $data.find('[data-js-total-pages]').html() : 1;

        $loadMoreButton.removeClass('is-loading');

        if (state.currentPage < state.totalPages) {
          $loadMoreButton.removeClass('is-disabled');
        } else {
          $loadMoreButton.addClass('is-disabled');
        }

        // $morePostsContent.sort(() => {
        //   return 0.5 - Math.random();
        // });

        $currentPostsContainer.append($morePostsContent);

        let totalShowCount = 0;
        let secondShowCount = 0;

        $pageLoader.removeClass('show');
        $currentPostsContainer.find('[data-js-post]:not(.has-loaded)').each(function(index) {
          let $this = $(this);
          removeGridClass($this);

          $this.imagesLoaded({
            background: '.background-image',
          }, function() {
            $this.find('.background-image').addClass('is-loaded');
          });

          $this.addClass('has-loaded');

          let newCounts = addGridClass($this, totalShowCount, secondShowCount);

          totalShowCount = newCounts.totalCount;
          secondShowCount = newCounts.secondCount;

          TweenMax.fromTo($this, 0.25, {
            opacity: 0,
            y: '50px',
            display: 'block',
          }, {
            opacity: 1,
            y: '0',
            ease: Power2.easeOut,
            delay: 0.02 * (index + 1),
          });
        });
        state.currentPage++;
      });
    }
  },
  finalize() {
  },
};
