<?php 
    header("Content-Type: application/rss+xml; charset=ISO-8859-1");
 
    echo '<?xml version="1.0" encoding="ISO-8859-1"?>';
    echo '<rss version="2.0">';
    echo '<channel>';
    echo '<title>ESIDesign Instagram #esilab #lab #proofofconcept</title>';
    echo '<link>http://www.esidesign.com/test/lab_instagram_new.php</link>';
    echo '<description>Built August 5, 2013</description>';
    echo '<language>en-us</language>';
    echo '<copyright>Copyright (C) 2009 mywebsite.com</copyright>';

 ?>

<?php

$jsonurl = "https://api.instagram.com/v1/users/266854171/media/recent?callback=?&count=1&access_token=4332136.f4e0d9a.707c9fef4c834edda34de2e7d2ac73ba";
$json = file_get_contents($jsonurl,0,null,null);
$json_output = json_decode($json, true);
/* var_dump($json_output); */

foreach($json_output['data'] as $item) {
/* 	echo $item['link']; */
	if( preg_match("/(#)(proofofconcept)/i", $item['caption']['text']) || preg_match("/(#)(esilab)/i", $item['caption']['text']) || preg_match("/(#)(lab)/i", $item['caption']['text']) ) {
    $title = str_replace(' & ', ' &amp; ', $item['caption']['text']);
    $link = $item['link'];
//     $start = strpos($item['images']['standard_resolution']['url'],"http://distilleryimage");  
//     $description = substr($item['images']['standard_resolution']['url'],$start,100);  
//     $length = strpos($description,".jpg") + 4; 
    $image = $item['images']['standard_resolution']['url'];  
    
    $v_start = strpos($item['videos']['standard_resolution']['url'],"http://distilleryimage");  
    $v_description = substr($item['videos']['standard_resolution']['url'],$v_start,100);  
    $v_length = strpos($v_description,".mp4") + 4; 
    $video = substr($v_description,0,$v_length);  
// 	$video = $item['images']['standard_resolution']['url'];  
    
    $date = date('m/d/y', strtotime($item['caption']['created_time']));
    echo '<item><title>'.$title.'</title><link>'.$link.'</link>';
    echo '<description><![CDATA[';
    if($video) {
	    echo '<video id="lab" class="video-js vjs-default-skin" controls width="600" height="600"
      poster="'.$image.'" data-setup="{}">
		<source src="'.$video.'" type="video/mp4" />
		</video><a href="'.$link.'"><img src="'.$image.'" style="display:none;" alt="'.$title.'" width="300" height="300"></a>';
    }
    else {
	    echo '<a href="'.$link.'"><img src="'.$image.'" border=0 alt="'.$title.'" width="300" height="300"></a>';
    }  
    echo '<p style="margin-top:0px; margin-bottom:0px;"><a href="'.$link.'" title="'.$title.'">'.$title.'</a></p><p>Posted via <a href="http://instagram.com/esidesign">Instagram</a></p>]]></description>';
    echo '</item>';
}

}
 ?>
  
  <?php echo '</channel>
</rss>';
?>