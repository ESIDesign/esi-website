<?php

$context = Timber::get_context();
$context['posts'] = Timber::get_posts();

Timber::render(['archive-case_study.twig', 'index.twig'], $context);
