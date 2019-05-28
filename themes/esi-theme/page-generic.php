<?php

/*
 * Template Name: Generic Page Template
 * Description: A Page Template for a generic page.
 */



$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

Timber::render(['page-generic.twig', 'page.twig'], $context);
