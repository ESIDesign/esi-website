<?php 
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1); 

	$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
	require_once( $parse_uri[0] . 'wp-load.php' );
	
    header("Content-Type: application/rss+xml; charset=ISO-8859-1");
    echo '<?xml version="1.0" encoding="ISO-8859-1"?>';
    echo '<rss version="2.0">';
    echo '<channel>';
    echo '<title>Instagram</title>';
    echo '<link>http://www.esidesign.com/wp-content/themes/adapt/instagram.php</link>';
    echo '<description>Built April 5, 2017</description>';
    echo '<language>en-us</language>';
    echo '<copyright>Copyright (C)2017 ESI Design</copyright>';

 ?>

<?php
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
endif;
$hashtags = explode(',', $hashtags);
$token = '';
// var_dump($hashtags);
$rssfeed = '';
$args = array(
	'post_type' => 'insat'
);
$the_query = new WP_Query( $args );
foreach($tokens as $token) {
	foreach($hashtags as $hashtag) {
		$jsonurl = 'https://api.instagram.com/v1/tags/'.$hashtag.'/media/recent/?access_token='.$token.'&count=10';	
		$json = file_get_contents($jsonurl,0,null,null);
		$json_output = json_decode($json, true);
		foreach($json_output['data'] as $item) {
		    if(!in_array('esipeople', $tags)) {
				$tags = $item['tags'];
				$title = str_replace(' & ', ' &amp; ', $item['caption']['text']);
				$link = $item['link'];
				$type = $item['type'];
				$user_id = $item['user']['id'];
				$image = $item['images']['standard_resolution']['url'];  
				$image = substr($image, 0, strpos($image, "?"));
				
				$date = date('m/d/y', strtotime($item['caption']['created_time']));
			    $rssfeed .= 
			    '<item>
			    ';
			    $rssfeed .= '<title>'.$title.'</title><link>'.$link.'</link><id>'.$user_id.'</id>
			    <hashtag>'.$hashtag.'</hashtag>
			    <description><![CDATA[';
			    if($type == 'video') {
					$v_start = strpos($item['videos']['standard_resolution']['url'],"http://distilleryimage");  
					$v_description = substr($item['videos']['standard_resolution']['url'],$v_start,100);  
					$v_length = strpos($v_description,".mp4") + 4; 
					$video = substr($v_description,0,$v_length);  
				    $rssfeed .= '<video id="lab" class="video-js vjs-default-skin" controls width="600" height="600" poster="'.$image.'" data-setup="{}"><source src="'.$video.'" type="video/mp4" /></video><a href="'.$link.'"><img src="'.$image.'" style="display:none;" alt="'.$title.'" width="300" height="300"></a>';
			    } else {
				    $rssfeed .= '<a href="'.$link.'"><img src="'.$image.'" border=0 alt="'.$title.'" width="300" height="300"></a>';
			    }  
			    $rssfeed .= '<p style="margin-top:0px; margin-bottom:0px;"><a href="'.$link.'" title="'.$title.'">'.$title.'</a></p> <p> Posted via <a href="http://instagram.com/esidesign">Instagram</a></p>]]></description>';
			    $rssfeed .= 
			    '
			    </item>
			    ';
			}
	    }
	}
}

echo $rssfeed;
echo '</channel>
</rss>'; ?>