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



// Pull data from JobScore

$url       = "https://careers.jobscore.com/jobs/esidesign/feed.json?sort=title";
$result    = file_get_contents($url);
$data      = json_decode($result);
$jobs_data = $data->jobs;

$this_job   = [];
$other_jobs = [];

global $params;
$jobscore_id = $params['jobscore_id'];

//print_r($params);

foreach ($jobs_data as $job) {

    $job->title         = str_replace(' - Experience Design Firm', '', $job->title);
    $job->esi_link      = '/jobs/' . $job->url_slug;
    $job->date_readable = date('F j, Y', strtotime($job->created_on));

    if($jobscore_id === $job->url_slug) {
        $this_job = $job;
    } else {
        $other_jobs[] = $job;
    }
}

$context['job'] = $this_job;
$context['other_jobs'] = $other_jobs;

Timber::render(['single-jobscore.twig', 'single.twig'], $context);





//if (post_password_required($post->ID)) {
//    Timber::render('single-password.twig', $context);
//} else {
//    Timber::render(['single-job.twig', 'single-' . $post->post_type . '.twig', 'single.twig'], $context);
//}
