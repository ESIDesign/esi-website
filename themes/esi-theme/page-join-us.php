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

// These posts are ones on the ESI site.
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

// Pull data from JobScore
$url       = "https://careers.jobscore.com/jobs/esidesign/feed.json?sort=title";
$result    = file_get_contents($url);
$data      = json_decode($result);
$jobs_data = $data->jobs;
$jobs      = [];

foreach ($jobs_data as $job) {

    // Remove this redundant string from pulled job titles
    $job->title = str_replace(' - Experience Design Firm', '', $job->title);

    // Generate link for viewing job listing on ESI site
    $job->esi_link = '/jobs/' . $job->url_slug;

    foreach($job->custom_fields as $field) {
        if($field->label === 'Excerpt') {
            $job->esi_excerpt = $field->content;
        }
    }

    $jobs[] = $job;
}

$context['jobscore_posts'] = $jobs;


Timber::render(['page-join-us.twig', 'page.twig'], $context);
