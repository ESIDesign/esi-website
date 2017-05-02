<?php 
    header("Content-Type: application/rss+xml; charset=ISO-8859-1");
    echo '<?xml version="1.0" encoding="ISO-8859-1"?>';
    echo '<rss version="2.0">';
    echo '<channel>';
    echo '<title>#esipeople</title>';
    echo '<link>http://www.esidesign.com/wp-content/themes/adapt/instagram-esipeople.php</link>';
    echo '<description>Built October 22, 2013, Updated December 22, 2016</description>';
    echo '<language>en-us</language>';
    echo '<copyright>Copyright (C) 2016 ESI Design</copyright>';

 ?>

<?php
// $jsonurl = "https://api.instagram.com/v1/users/self/media/recent/?access_token=266854171.7827081.6439a537b65044a7872f1d35af72fda2&count=1";
$jsonurl = "https://api.instagram.com/v1/tags/esipeople/media/recent?access_token=266854171.7827081.6439a537b65044a7872f1d35af72fda2&count=1";	
$json = file_get_contents($jsonurl,0,null,null);
$json_output = json_decode($json, true);

foreach($json_output['data'] as $item) {
	$tags = $item['tags'];
	if(in_array('esipeople', $tags)) {
	    $title = str_replace(' & ', ' &amp; ', $item['caption']['text']);
	    $link = $item['link'];
	    $image = $item['images']['standard_resolution']['url'];  
	    $image = substr($image, 0, strpos($image, "?"));
	    
	    $v_start = strpos($item['videos']['standard_resolution']['url'],"http://distilleryimage");  
	    $v_description = substr($item['videos']['standard_resolution']['url'],$v_start,100);  
	    $v_length = strpos($v_description,".mp4") + 4; 
	    $video = substr($v_description,0,$v_length);  
	    
	    $date = date('m/d/y', strtotime($item['caption']['created_time']));
	    $rssfeed .= '<item>';
	    $rssfeed .= '<title>'.$title.'</title><link>'.$link.'</link><description><![CDATA[';
	    if($video) {
		    $rssfeed .= '<video id="lab" class="video-js vjs-default-skin" controls width="600" height="600"
	      poster="'.$image.'" data-setup="{}">
			<source src="'.$video.'" type="video/mp4" />
			</video><a href="'.$link.'"><img src="'.$image.'" style="display:none;" alt="'.$title.'" width="300" height="300"></a>';
	    }
	    else {
		    $rssfeed .= '<a href="'.$link.'"><img src="'.$image.'" border=0 alt="'.$title.'" width="300" height="300"></a>';
	    }  
	    $rssfeed .= '<p style="margin-top:0px; margin-bottom:0px;"><a href="'.$link.'" title="'.$title.'">'.$title.'</a></p> <p> Posted via <a href="http://instagram.com/esidesign">Instagram</a></p>]]></description>';
	    $rssfeed .= '</item>';
    }
}
 ?>
  
  <?php 
	  echo $rssfeed;
	  echo '</channel>
</rss>';
?>
