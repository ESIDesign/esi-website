<?php

$context = Timber::get_context();

$context['title'] = 'Archive';
$context['posts'] = Timber::get_posts();
$context['pagination'] = Timber::get_pagination();

Timber::render(['archive.twig', 'index.twig'], $context);
