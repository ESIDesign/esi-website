<?php

$context = Timber::get_context();
$context['title'] = 'Search results for ' . get_search_query();
$context['search_query'] = get_search_query();
$lower_query = strtolower($context['search_query']);

if (strpos($lower_query, 'job') !== false || strpos($lower_query, 'career') !== false) {
  $context['job_search'] = true;
  $job_post_query = array(
    'post_type' => 'job',
    'posts_per_page' => -1,
    'orderby' => 'DESC'
  );
  $context['posts'] = Timber::get_posts($job_post_query);
} else {
  $context['posts'] = Timber::get_posts();
}



Timber::render(['search.twig', 'archive.twig', 'index.twig'], $context);
