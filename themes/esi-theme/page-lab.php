<?php

/*
 * Template Name: Lab Page Template
 * Description: A Page Template for the Lab page.
 */



$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
// $args = 'post_type=post&numberposts=3&orderby=rand&category_name=design-thinking&tag=lab';
$args = 'post_type=post&numberposts=3&category_name=design-thinking&tag=lab';
$context['latest_posts'] = Timber::get_posts($args);
$instagram = array(
    'post_type'   => 'instagram',
    'order'       => 'DESC',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'instagram_tag',
            'field'    => 'slug',
            'terms'    => 'esilab',
        ),
    ),
);

$context['instagram_posts'] = Timber::get_posts($instagram);

Timber::render(['page-lab.twig', 'page.twig'], $context);
