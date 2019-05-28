<?php

/*
 * Template Name: People Page Template
 * Description: A Page Template for the People page.
 */

global $params;

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

$authors_query	= array(
		'meta_query' => array(
				'relation' => 'OR',
				'leadership' => array(
					'key' => 'leadership_val',
					'compare' => 'EXISTS',
				),
				'people' => array(
					'key' => 'leadership_val',
					'compare' => 'NOT EXISTS'
				)
		),
		'orderby'	=> 'meta_value_num',
);
$context['authors'] = get_users($authors_query);

Timber::render(['page-people.twig', 'page.twig'], $context);
