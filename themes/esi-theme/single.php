<?php

$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;
$avatar = get_wp_user_avatar_src($post->post_author);
$context['avatar'] = $avatar;
$related_work_query = 'post_type=post&numberposts=2&order=DESC&taxonomy=category&term=press-releases&exclude=' . $post->ID;
$context['press_posts'] = Timber::get_posts($related_work_query);
// $related_design_thinking = 'post_type=post&numberposts=3&order=DESC&category_name=design-thinking&tag=' . join(',', $post->tags) . '&post__not_in=' . $post->ID;

$related_design_thinking = array(
  'post_type' => 'post',
  'order' => 'DESC',
  'numberposts' => 3,
  'category_name' => 'design-thinking',
  'tag' => join(',', $post->tags),
  'post__not_in' => array($post->ID),
);

$context['related_design_thinking'] = Timber::get_posts($related_design_thinking);

if (post_password_required($post->ID)) {
    Timber::render('single-password.twig', $context);
} else {
    Timber::render(['single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'single.twig'], $context);
}
