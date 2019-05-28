<?php

$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;

$job_post_query = array(
	'post_type' => 'job',
	'posts_per_page' => -1,
	'orderby' => 'rand',
	'post__not_in' => array($post->ID)
);

$context['job_posts'] = Timber::get_posts($job_post_query);
$context['introductory_text'] = get_field('job_introductory_text', 14);
$context['footer_text'] = get_field('job_footer_text', 14);

if (post_password_required($post->ID)) {
    Timber::render('single-password.twig', $context);
} else {
    Timber::render(['single-job.twig', 'single-' . $post->post_type . '.twig', 'single.twig'], $context);
}
