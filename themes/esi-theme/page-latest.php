<?php

/*
 * Template Name: Latest Page Template
 * Description: A Page Template for the Latest page.
 */

$context = Timber::get_context();

$args = array(
    'post_type'      => 'post',
    'posts_per_page' => 12,
    'paged'          => $params['paged']
);

$context['categories'] = Timber::get_terms('category');
$context['posts']      = new Timber\PostQuery($args);
$context['page']       = $params['paged'];


//$instagram = array(
//    'post_type'      => 'instagram',
//    'order'          => 'DESC',
//    'posts_per_page' => 3,
//    'tax_query'      => array(
//        array(
//            'taxonomy' => 'instagram_tag',
//            'field'    => 'slug',
//            'terms'    => 'esipeople',
//        ),
//    ),
//);
//
//$context['instagram_posts'] = Timber::get_posts($instagram);


// echo "<pre>";var_dump($context["posts"]);echo "</pre>";die();

Timber::render(['page-latest.twig', 'page.twig'], $context);
