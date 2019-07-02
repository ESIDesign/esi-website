<?php
// Routes::map('latest', function($params) {
//   $query = 'posts_per_page=10&post_type=post';
//   Routes::load('page-latest.php', $params, $query, 200);
// });

// Routes::map('latest/*', function($params) {
  // $query = 'posts_per_page=10&post_type=post';
//   Routes::load('page-latest.php', $params, $query, 200);
// });

Routes::map('latest/:paged', function($params) {
  // $query = 'posts_per_page=-1&post_type=post&category_name=' . $params['category'];
  // $query = 'posts_per_page=10&post_type=post';
  Routes::load('page-latest.php', $params, $query, 200);
});

Routes::map('work', function($params) {
  Routes::load('archive-work.php', $params, $query, 200);
});

Routes::map('corporate', function($params) {
  Routes::load('single-vertical.php', $params, $query, 200);
});

Routes::map('retail', function($params) {
  Routes::load('single-vertical.php', $params, $query, 200);
});

Routes::map('real-estate', function($params) {
  Routes::load('single-vertical.php', $params, $query, 200);
});

Routes::map('cultural', function($params) {
  Routes::load('single-vertical.php', $params, $query, 200);
});

Routes::map('work/industry/:industry', function($params) {
  $params = array();
  $query = 'posts_per_page=-1&post_type=work&taxonomy=work_industry&term=' . $params['industry'];
  Routes::load('archive-work.php', $params, $query, 200);
});

Routes::map('work/project-type/:type', function($params) {
  $params = array();
  $query = 'posts_per_page=-1&post_type=work&taxonomy=work_project_type&term=' . $params['type'];
  Routes::load('archive-work.php', $params, $query, 200);
});

Routes::map('jobs/:jobscore_id', function($params) {
    $query = 'posts_per_page=-1&post_type=single-job';
    Routes::load('single-job.php', $params, $query, 200);
});
