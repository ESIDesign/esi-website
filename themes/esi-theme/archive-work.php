<?php

// global $paged;
// if (!isset($paged) || !$paged){
//     $paged = 1;
// }
$context = Timber::get_context();

// global $params;
// $context['posts'] = new Timber\PostQuery();
$context['work_industries'] = Timber::get_terms('work_industry');
$context['work_project_types'] = Timber::get_terms('work_project_type');
$context['wp_title'] = 'Our Work';
// $posts_query = array(
// 	// 'post_type'			=> 'work',
// 	// 'posts_per_page'	=> 10,
// 	// 'meta_key'			=> 'featured',
// 	'orderby'			=> 'rand',
// 	'order'				=> 'DESC',
// 	'paged'				=> $paged
// );
$context['posts'] = new Timber\PostQuery();
$context['pagination'] = Timber::get_pagination();


Timber::render(['archive-work.twig', 'index.twig'], $context);
