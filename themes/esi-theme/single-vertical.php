<?php
global $wp;

$context = Timber::get_context();
$current_url = home_url( $wp->request );
$vertical = end(explode('/', $current_url));
$post_query = array(
	'post_type'			=> 'vertical',
	'post_title'			=> $vertical
);
$verticalIDs = array(
  'corporate' => 143,
  'retail' => 142,
  'real-estate' => 141,
  'cultural' => 140
);

$posts = Timber::get_posts($post_query);

foreach($posts as $struct) {
    if ($verticalIDs[$vertical] == $struct->ID) {
        $post = $struct;
        break;
    }
}

$context['post'] = $post;

$args_two = 'post_type=post&numberposts=3&order=DESC&tag=' . $vertical;
$context['news_posts'] = Timber::get_posts($args_two);

if (post_password_required($post->ID)) {
    Timber::render('single-password.twig', $context);
} else {
    Timber::render(['single-vertical.twig', 'single-' . $post->post_type . '.twig', 'single.twig'], $context);
}
