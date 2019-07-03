import Instafeed from 'instafeed.js';

export default {
    init() {
        const feed = new Instafeed({
            get: 'user',
            userId: '266854171',
            clientId: '62bc68e6e83c41e8a6c88959cc3b81b9',
            accessToken: '5695088869.ba4c844.98a3a3e9f4c443f99ea734208ae5eeb1',
            limit: 3,
            resolution: 'standard_resolution',
            template: '<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mb3">' +
                '<a target="_blank" href="{{link}}"><div style="background-image: url({{image}});" class="aspect-ratio aspect-ratio--1x1 bg-center contain bg-black-80"></div></a>' +
                '</div>',
        });

        feed.run();

        // $.ajax({
        //     type: 'GET',
        //     url: 'https://careers.jobscore.com/jobs/esidesign/feed.json?sort=title',
        //     data: { get_param: 'value' },
        //     dataType: 'json',
        //     success: function(data) {
        //         $.each(data, function(index, element) {
        //             console.log(data);
        //         });
        //     }
        // });
    },
    finalize() {
        // JavaScript to be fired on the home page, after the init JS
    },
};