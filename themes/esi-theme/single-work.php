<?php

$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;
$news_args = array(
	'post_type' => 'post',
	'meta_query' => array(
		array(
			'key' => 'associated_project', // name of custom field
			'value' => '' . get_the_ID() . '',
			'compare' => 'LIKE'
		)
	),
  'posts_per_page' => 24
);

$awards_args = array(
  'post_type' => 'post',
  'category_name' => 'awards',
  'meta_query' => array(
    array(
      'key' => 'associated_project', // name of custom field
      'value' => '' . get_the_ID() . '',
      'compare' => 'LIKE'
    ),
    array(
      'key' => 'featured',
      'value' => true,
      'compare' => 'LIKE',
    )
  )
);

$context['news_posts'] = Timber::get_posts($news_args);
$work_args = $post->terms('work_industry');
$work_args = strtolower(str_replace(' ', '-', $work_args[0]));
$related_work_query = 'post_type=work&numberposts=3&order=DESC&taxonomy=work_industry&term=' . $work_args;
$context['related_works'] = Timber::get_posts($related_work_query);

$context['featured_awards'] = Timber::get_posts($awards_args);

if (post_password_required($post->ID)) {
    Timber::render('single-password.twig', $context);
} else {
    Timber::render(['single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'single.twig'], $context);
}
