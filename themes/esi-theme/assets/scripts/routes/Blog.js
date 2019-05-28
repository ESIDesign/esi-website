import page from 'page';
import queryString from 'query-string';
import { TweenMax, Power2} from 'gsap';
import Instafeed from 'instafeed.js';
import 'imagesloaded';

export default {
  init() {
    let state = {
      currentFilter: 'all',
      currentPage: 1,
      totalPages: 0,
      urlToQuery: '/latest/',
    };
    let $filterItems = $('[data-js-filter-item]');
    let urlFilter = window.location.search ? queryString.parse(window.location.search)['filter'].split(',') : [];

    const $pageLoader = $('[data-js-page-loader]');
    const $loadMoreButton = $('[data-js-load-more-button]');
    const $currentPostsContainer = $('[data-js-posts-container]');

    $filterItems.on('click', function(e) {
      e.preventDefault();

      let $this = $(this);
      let filterValue = $this.data('filter');

      state.currentPage = 1;

      $filterItems.removeClass('is-active');

      if (urlFilter[0] === '') {
        urlFilter = ['all'];
      }

      if (filterValue === 'all') {
        urlFilter = ['all'];
        page(`/latest/?filter=${urlFilter}`);
      } else {
        if (urlFilter.includes(filterValue)) {
          urlFilter = ['all'];
          page(`/latest/?filter=${urlFilter}`);
        } else {
          urlFilter = [filterValue];
          page(`/latest/?filter=${urlFilter}`);
        }

        if (!urlFilter.length) {
          page(`/latest/?filter=${['all']}`);
        } else {
          page(`/latest/?filter=${urlFilter}`);
        }
      }
    });

    var options = {
      get: 'tagged',
      clientId: '62bc68e6e83c41e8a6c88959cc3b81b9',
      accessToken: '5695088869.ba4c844.98a3a3e9f4c443f99ea734208ae5eeb1',
      sortBy: 'most-recent',
      limit: 5,
      resolution: 'standard_resolution',
      template: '<div data-js-insta-post data-post-filter="[]" data-js-post class="col-xs-12 col-sm-6 col-md-4 col-lg-4 mb3 is-active blog-post" style="display: none;">' +
                  '<a target="_blank" href="{{link}}">' +
                    '<div class="aspect-ratio post-ratio light-gray-bg">' +
                      '<div class="aspect-ratio--object">' +
                      '<div class="absolute left-0 top-0 right-0 dark-blue-bg aspect-ratio--1x1 o-30 z-0"></div>' +
                      '<div class="background-image aspect-ratio--1x1 bg-center cover z-1 relative" style="background-image: url({{image}})"></div>' +
                      '<h6 class="latest-instagram-label ph3 pb2 lh-solid din-condensed t-20 t-label-gray ttu lh-solid no-underline">INSTAGRAM</h6>' +
                    '</div>' +
                  '</a>' +
                '</div>' +
              '</div>',
    };
    var tags = [ "esipeople", "esilab", "esionsite" ];
    tags.forEach((tag) => {
      var args = options;
      args.tagName = tag;
      (new Instafeed(args)).run();
    });

    let baseUrl = window.featureBaseUrl ? window.featureBaseUrl : false;

    if (baseUrl) {
      page.base(baseUrl);
      page('/*', pageLogic);
      page();
    }

    function pageLogic(ctx) {
      let filter = queryString.parse(ctx.querystring) ? queryString.parse(ctx.querystring)['filter'] : false;
      let filterArray = [];

      $filterItems.removeClass('is-active');

      let $posts = $('[data-js-post]');

      if (filter && filter.length) {
        filterArray = filter.split(',');
      }

      if (filterArray[0] !== state.currentFilter) {
        state.currentPage = 1;
      }

      state.currentFilter = filterArray[0];

      $pageLoader.addClass('show');
      $loadMoreButton.addClass('is-disabled');

      if (filterArray[0] !== 'all' && filterArray.length) {
        $(`[data-filter="${filterArray[0]}"]`).addClass('is-active');

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
                fetchPosts(`/category/${state.currentFilter}/page/${state.currentPage}`, state.currentPage);
              }
            },
          });
        });
      } else {
        $(`[data-filter="all"]`).addClass('is-active');
        state.currentFilter = 'all';

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
                fetchPosts(`/latest/${state.currentPage}/`, state.currentPage);
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
        if (state.currentFilter === 'all' || !state.currentFilter) {
          fetchPosts(`/latest/${state.currentPage}/`, state.currentPage);
        } else {
          fetchPosts(`/category/${state.currentFilter}/page/${state.currentPage}`, state.currentPage);
        }
      }
    });

    function fetchPosts(url, pageNumber) {
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

        $currentPostsContainer.append($morePostsContent);
        let $renderedPosts = $currentPostsContainer.find('[data-js-post]');

        if (pageNumber === 1 && state.currentFilter === 'all') {
          let $instaPosts = $('[data-js-insta-post]');

          $instaPosts.each(function(index) {
            let $that = $(this);
            let indexToAppendTo = ((index + 1) * 4) - 2;

            if (indexToAppendTo < $renderedPosts.length) {
              let elToInsertAfter = $renderedPosts[indexToAppendTo];
              $that.clone().insertAfter(elToInsertAfter);
            }
          });
        }

        $pageLoader.removeClass('show');
        $currentPostsContainer.find('[data-js-post]').each(function(index) {
          let $this = $(this);
          $this.imagesLoaded({
            background: '.background-image',
          }, function() {
            $this.find('.background-image').addClass('is-loaded');
          });
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
