<?php

/*
 * Template Name: Join Us Page Template
 * Description: A Page Template for the Join Us page.
 */

$context         = Timber::get_context();
$post            = new TimberPost();
$context['post'] = $post;

$job_post_query = [
	'post_type'      => 'job',
	'posts_per_page' => -1,
	'orderby'        => 'DESC'
];

$context['job_posts'] = Timber::get_posts($job_post_query);

$instagram = array(
    'post_type'   => 'instagram',
    'order'       => 'DESC',
    'posts_per_page' => 3,
    'tax_query' => array(
        array(
            'taxonomy' => 'instagram_tag',
            'field'    => 'slug',
            'terms'    => 'esipeople',
        ),
    ),
);

$context['instagram_posts'] = Timber::get_posts($instagram);

Timber::render(['page-join-us.twig', 'page.twig'], $context);
