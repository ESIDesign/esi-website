<?php 
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1); 
	$parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME'] );
	require_once( $parse_uri[0] . 'wp-load.php' );
?>

<?php
$insta_ids = array();
	
$hashtags = get_field('hashtags', 'option');
$tokens = array();
if( have_rows('client', 'option') ):
    while ( have_rows('client', 'option') ) : the_row();
		$token = get_sub_field('token');
		array_push($tokens, $token);
		$users = get_field('users');
		if($users) {
			if( have_rows('users') ):
				while ( have_rows('users') ) : the_row();	
					$ids = get_sub_field('ids');
				endwhile;
			endif;
		}	
	endwhile;
	wp_reset_postdata();
endif;
$hashtags = explode(',', $hashtags);
$token = '';

$args = array(
	'post_type' => 'insta',
	'post_status' => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash'),
	'posts_per_page' => 10
);
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		$insta_id = get_post_meta($post->ID, 'insta_id', true);
		array_push($insta_ids, $insta_id);
	}
	wp_reset_postdata();
} else {
	echo 'no';
}

$instas = array();
//cycle through tokens
foreach($tokens as $token) {
	//cycle through hashtags
	foreach($hashtags as $hashtag) {
		$jsonurl = 'https://api.instagram.com/v1/tags/'.$hashtag.'/media/recent/?access_token='.$token.'&count=1';	
		$json = file_get_contents($jsonurl,0,null,null);
		$json_output = json_decode($json, true);
		foreach($json_output['data'] as $item) {
			$id = $item['id'];
			$time = $item['created_time'];
			$title = $item['caption']['text'];
			$link = $item['link'];
			$type = $item['type'];
			$id = $item['id'];
			$user_id = $item['user']['id'];
			$user_name = $item['user']['full_name'];
			$image = $item['images']['standard_resolution']['url']; 
			$image_width = $item['images']['standard_resolution']['width']; 
			$image_height = $item['images']['standard_resolution']['height']; 
			if($type == 'video') {
				$video = $item['videos']['standard_resolution']['url'];
			} else {
				$video = '';
			}
			array_push($instas, array('id' => $id, 'time' => $time, 'token' => $token, 'hashtag' => $hashtag, 'title' => $title, 'link' => $link, 'user_id' => $user_id, 'user_name' => $user_name, 'type' => $type, 'image' => $image, 'image_width' => $image_width, 'image_height' => $image_height, 'video' => $video));
		}
	}
}

usort($instas, function($a, $b) {
    return $b['time'] <=> $a['time'];
});
		

$latest_instas = array();
$content = '';

foreach($hashtags as $hashtag) {
	$key = array_search($hashtag, array_column($instas, 'hashtag'));
// 	echo $key.'<br />';
	array_push($latest_instas, $instas[$key]);
}

foreach($latest_instas as $latest) {
// 	$insta_id = $latest['id'];
// 	$insta_time = $latest['time'];
	$title = str_replace(' & ', ' &amp; ', $latest['title']);
	$short_title = substr($title, 0, 30);
	$image = $latest['image'];
	$width = $latest['image_width'];
	$height = $latest['image_height'];
	$video = $latest['video'];
	$type = $latest['type'];
	
	if($type == 'video') {
		$content = '<a class="insta__media video" href="'.$latest['link'].'" target="_blank"><video id="lab" class="insta__video" controls width="'.$width.'" height="'.$height.'" poster="'.$image.'" data-setup="{}"><source src="'.$video.'" type="video/mp4" /></video><img style="display:none;" src="'.$image.'" alt="'.$short_title.'" width="'.$width.'" height="'.$height.'"></a>';
	} else {
		$content = '<a class="insta__media" href="'.$latest['link'].'" target="_blank"><img src="'.$image.'" alt="'.$short_title.'" width="'.$width.'" height="'.$height.'"></a>';
	}
	
	$content .= '<a href="'.$latest['link'].'" target="_blank">'.$title.'</a>';
	
// 	echo $content;
	
	$author_id = 1;

	if(!in_array($latest['id'], $insta_ids, true)) {

		$post_id = wp_insert_post(
			array(
				'comment_status'	=>	'closed',
				'ping_status'		=>	'closed',
				'post_author'		=>	$author_id,
				'post_name'		=>	$short_title,
				'post_title'		=>	$title,
				'post_content' => $content,
				'post_status'		=>	'pending',
				'post_type'		=>	'insta'
			)
		);
		update_post_meta( $post_id, 'hashtag', $latest['hashtag'] );
		update_post_meta( $post_id, 'token', $latest['token'] );
		update_post_meta( $post_id, 'user_id', $latest['user_id'] );
		update_post_meta( $post_id, 'user_name', $latest['user_name'] );
		update_post_meta( $post_id, 'insta_link', $latest['link'] );
		update_post_meta( $post_id, 'insta_time', $latest['time'] );
		update_post_meta( $post_id, 'insta_id', $latest['id'] );
		update_post_meta( $post_id, 'video', $video );
		update_post_meta( $post_id, 'image', $image );
		
		echo $title.' <strong>added</strong><br />';

	} else {
    	echo $title.' <strong>already in wordpress</strong><br />';
	}
} ?>