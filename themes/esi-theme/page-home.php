<?php

/*
 * Template Name: Home Page Template
 * Description: A Page Template for the home page.
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$sliderLinks = [];

Timber::render(['page-home.twig', 'page.twig'], $context);
