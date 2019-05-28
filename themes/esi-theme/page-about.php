<?php

/*
 * Template Name: About Page Template
 * Description: A Page Template for the about page.
 */



$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

$instagram = array(
    'post_type'   => 'instagram',
    'order'       => 'DESC',
    'posts_per_page' => 3,
    'tax_query' => array(
        array(
            'taxonomy' => 'instagram_tag',
            'field'    => 'slug',
            'terms'    => 'esilab',
        ),
    ),
);

$context['instagram_posts'] = Timber::get_posts($instagram);

Timber::render(['page-about.twig', 'page.twig'], $context);
