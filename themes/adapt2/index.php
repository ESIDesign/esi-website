<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 */
$options = get_option( 'adapt_theme_settings' );
?>
<?php get_header('home'); ?>
<!-- <div class="white"></div> -->
<div class="home-wrap clearfix">
<!--

    <?php if(get_bloginfo('description')) { ?>
    <aside id="home-tagline">
    	<?php echo bloginfo('description'); ?>
    </aside>

    <?php } ?>
-->

<article class="home_item9">

<img class="active" src="<?php echo get_template_directory_uri(); ?>/images/esi_logo_red.jpg"/>

<img src="<?php echo get_template_directory_uri(); ?>/images/esi_logo_green.jpg"/>
<img src="<?php echo get_template_directory_uri(); ?>/images/esi_logo_gold.jpg"/>
<img src="<?php echo get_template_directory_uri(); ?>/images/esi_logo_blue.jpg"/>

</article>

<article class="home_item9_quote">
<?php 
if (get_field('quote3', 2145) != "") { 
$rand_quote = rand(1,3);
}
if (get_field('quote3', 2145) == "" && get_field('quote2', 2145) != "") { 
$rand_quote = rand(1,2);
}
if (get_field('quote3', 2145) == "" && get_field('quote2', 2145) == "" && get_field('quote1', 2145) != "") { 
$rand_quote = 1;
}
	if (get_field('quote'.$rand_quote, 2145) != "") { 
	echo '<div class="quote">';
		$quote_length = strlen(strval(get_field('quote'.$rand_quote, 2145)));
				if ($quote_length > 100) {
					echo '<h2>';
				}
				if ($quote_length < 99) {
					echo '<h1>';
				}
				the_field('quote'.$rand_quote, 2145);
				if ($quote_length > 100) {
					echo '</h2>';
				}
				if ($quote_length < 99) {
					echo '</h1>';
				}
			echo '</div>';
		  	} ?>
<h3 class="attrib"><?php if (get_field('attrib'.$rand_quote, 2145) != "") { 
							  the_field('attrib'.$rand_quote, 2145);
						  	} ?></h3>
</article>

    <?php
        global $post;
        $args2 = array(
            'post_type' =>'project',
            'meta_query' => array(
		                        array('key' => 'home',
		                              'value' => '1'
		                        ),
		                         array('key' => 'video_placeholder',
		                              'value' => '',
		                              'compare' => '!='
		                        )
	                    ),
            'orderby' => 'rand',
		   
        );
        $video_posts = get_posts($args2);
         $video_ID = array($video_posts[0]->ID);
    ?> 
 <?php
            $count=0;
            foreach($video_posts as $video_post) : setup_postdata($video_post);
            $count++;
           

            ?>
<?php if ($count == '1') { ?>

<div class="home_item1">

<img class="placeholder" src="<?php echo the_field('video_placeholder', $video_post->ID); ?>"/><span class="circle"></span><span id="button" class="awesome-icon-play"></span>
<iframe id="home_player" src="http://player.vimeo.com/video/<?php echo the_field('video', $video_post->ID); ?>?api=1&title=0&byline=0&portrait=0&player_id=home_player" width="590" height="332" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
</div>
<?php } ?>
<?php endforeach; ?>

    <?php
        $args = array(
            'post_type' =>'project',
            'meta_query' => array(
                                array('key' => 'home',
                                      'value' => '1'
                                )
                            ),
/*             'meta_key' => 'video_placeholder', */
			'post__not_in' => $video_ID,
            'orderby' => 'rand',
        );
        $portfolio_posts = get_posts($args);
    ?>
    <?php if($portfolio_posts) { ?>        

            <?php
            $count=0;
            foreach($portfolio_posts as $post) : setup_postdata($post);
            $count++;
            //get portfolio thumbnail
            $feat_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'archive-project');
            $feat_img2 = wp_get_attachment_image_src(get_post_thumbnail_id(), 'grid-thumb2');
            ?>
            
            <?php if ($feat_img) {  ?>

            
            <?php if ($count == '1') { ?>
            <div class="black"></div>
            <div class="home_item3">
              <a href="<?php the_permalink(); ?>"><img src="<?php echo $feat_img[0]; ?>" height="<?php echo $feat_img[2]; ?>" width="<?php echo $feat_img[1]; ?>" alt="<?php echo the_title(); ?>" />
                 <a href="<?php the_permalink(); ?>" class="project-overlay"><h3> <?php 
	  	if (get_field('short') != "") { 
	  	the_field("short");
	  	}
	  	else { 
	  	the_title();  	
	  	 } ?></h3></a>
                </a>
            </div>
            <?php } ?>
           <?php if ($count == '2') { ?>
           <div class="home_item4">
	            <a href="<?php the_permalink(); ?>"><img src="<?php echo $feat_img[0]; ?>" height="<?php echo $feat_img[2]; ?>" width="<?php echo $feat_img[1]; ?>" alt="<?php echo the_title(); ?>" />
                        <a href="<?php the_permalink(); ?>" class="project-overlay"><h3><?php 
	  	if (get_field('short') != "") { 
	  	the_field("short");
	  	}
	  	else { 
	  	the_title();  	
	  	 } ?></h3></a></a>
           </div>

           <?php } ?>
           <?php if ($count == '3') { ?>
           
           
           <!-- People -->
<div class="home_item12">

<?php

// Get the authors from the database ordered by user nicename
	global $wpdb;
	$query = "SELECT ID, user_nicename from $wpdb->users ORDER BY rand()";
	$author_ids = $wpdb->get_results($query);
	$count = 0;
// Loop through each author
	foreach($author_ids as $author) :

	// Get user data
		$curauth = get_userdata($author->ID);


		// Get link to author page
			$user_link = get_author_posts_url($curauth->ID);

		// Set default avatar (values = default, wavatar, identicon, monsterid)
			$avatar = 'wavatar';

	// If user level is above 0 or login name is "admin", display profile
		if($curauth->user_level > 4 && $curauth->first_name != 'ESI') :
		$count++;
?>
<?php if ($count == '1') { ?>
<a class="people_button" href="<?php echo get_site_url(); ?>/people"><img src="<?php echo get_template_directory_uri(); ?>/images/people.png"/></a>
<article class="black1"></article>
<article class="people1">
<a href="<?php echo get_site_url(); ?>/people"><?php 
	echo get_avatar($curauth->ID, '116', $avatar); 
	?> 
<a href="<?php echo get_site_url(); ?>/people" class="caption_people"><?php echo $curauth->first_name; ?></a>
</article>
<?php } ?>

<?php if ($count == '2') { ?>
<article class="people2">
<a href="<?php echo get_site_url(); ?>/people"><?php 
	echo get_avatar($curauth->ID, '116', $avatar); 
	?> 
<a href="<?php echo get_site_url(); ?>/people" class="caption_people"><?php echo $curauth->first_name; ?></a>
</article>
<?php } ?>

<?php if ($count == '3') { ?>
<article class="people3">
<a href="<?php echo get_site_url(); ?>/people"><?php 
	echo get_avatar($curauth->ID, '116', $avatar); 
	?> 
<a href="<?php echo get_site_url(); ?>/people" class="caption_people"><?php echo $curauth->first_name; ?></a>
</article>
<?php } ?>
	<?php endif; ?>
	<?php endforeach; ?>


</div>      
           
 
           <div class="home_item5">
	            <a href="<?php the_permalink(); ?>"><img src="<?php echo $feat_img2[0]; ?>" height="<?php echo $feat_img2[2]; ?>" width="<?php echo $feat_img2[1]; ?>" alt="<?php echo the_title(); ?>" />
                        <a href="<?php the_permalink(); ?>" class="project-overlay"><h3><?php 
	  	if (get_field('short') != "") { 
	  	the_field("short");
	  	}
	  	else { 
	  	the_title();  	
	  	 } ?></h3></a></a>
           </div>
            <?php } ?>


            <?php } ?>
            
            <?php
            endforeach; ?>
  <?php wp_reset_query(); ?>
    <?php } ?>
    


<div class="home_item2" style="height:115px; width: 115px;">

<a href="<?php echo get_site_url(); ?>/work"><img src="<?php echo get_template_directory_uri(); ?>/images/work.png"/></a>

</div>


<div class="home_item6" style="height:115px; width: 115px;">

<a href="<?php echo get_site_url(); ?>/about"><img src="<?php echo get_template_directory_uri(); ?>/images/about.png"/></a>

</div>

<div class="home_item6_blog" style="height:115px; width: 115px;">

<a href="<?php echo get_site_url(); ?>/blog"><img src="<?php echo get_template_directory_uri(); ?>/images/blog.png"/></a>

</div>

<div class="home_item13">
<article class="home_media">
<a target="_blank" href="http://www.twitter.com/esidesign"><img src="<?php echo get_template_directory_uri(); ?>/images/home_twitter.png"/></a>
<a target="_blank" href="http://vimeo.com/channels/esi"><img src="<?php echo get_template_directory_uri(); ?>/images/home_vimeo.png"/></a>
<a target="_blank" href="http://www.linkedin.com/company/esi-design"><img src="<?php echo get_template_directory_uri(); ?>/images/home_in.png"/></a>
</article>
</div>


<div class="home_item7_lab" style="height:115px; width: 115px;">

<a href="<?php echo get_site_url(); ?>/work/lab"><img src="<?php echo get_template_directory_uri(); ?>/images/lab.png"/></a>

</div>
    


<div class="home_item7" style="height:115px; width: 115px;">

<a href="<?php echo get_site_url(); ?>/approach"><img src="<?php echo get_template_directory_uri(); ?>/images/approach.png"/></a>

</div>
    

<div class="home_item11" style="height:115px; width: 115px;">

<a href="<?php echo get_site_url(); ?>/contact"><img src="<?php echo get_template_directory_uri(); ?>/images/contact.png"/></a>

</div>    

	<div class="home_item10">
	
		<!-- <img src="<?php echo get_template_directory_uri(); ?>/images/esi_description.png"/> -->
		<article class="description">
		<h1><a href="<?php echo get_site_url(); ?>/about"> <?php if (get_field('about', 2145) != "") { 
							  the_field('about', 2145);
						  	} ?>  </a></h1>
		</article>
	</div>

            
</div>


<script type="text/javascript" src="http://a.vimeocdn.com/js/froogaloop2.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.cookie.js"></script>
<!-- <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.fittext.js"></script> -->
<script type="text/javascript">
/*

function loadPostsLauren (){
		loadPeople();	
		return false;
	};
*/


jQuery(function($){
	$(document).ready(function(){
/* $(".description h1").fitText(); */
/*
  	setTimeout(function(){
	  	var cycleLogo = setInterval('cycleImages()', 3400);
            if ($('.home_item9 active').attr('src', 'http://www.esidesign.com/new/wp-content/themes/adapt/images/esi_logo_blue.jpg')) {
	          clearInterval(cycleLogo);
          } 
},2000);
*/
/*


setTimeout(function(){
// Initialize interval:
interval = setInterval('cycleImages()', 3400);
},2000);
*/

/*

setTimeout(function(){
  //where we can also call foo
  setInterval('loadPeople()', 2000);
},2000);
*/


// Execute every 5 seconds
/*
loadPeople = function(){
		var options2 = ['.people1', '.people2', '.people3'];
		var toggle2 = options2[Math.floor( Math.random()*options2.length)];
		$.ajax({
			url: "http://www.esidesign.com/refresh",
			beforeSend : function(){
				console.log("TEST PEOPLE BEFORE SEND");
				$(toggle2).animate({opacity:0}, 1200);
			},
			success: function(response){
					$(toggle2).html( response ).animate({opacity:1});
			}
		});	
	};	
*/

// Wrapping, self invoking function prevents globals
(function() {
   // Hide the elements initially
   var lis = $('div').hide();
/*    var left = this.left(); */
	$('div#wrap').show();
	$('div#main').show();
	$('div.home-wrap').show();
	$('div.quote').show();
		 var i = 3;
	
	
	function displayImages() {

         lis.eq(i++).fadeIn(200, displayImages);

      };
      
      	function fastImages() {

         lis.fadeIn(400);

      };
		
		if ( $(window).width() < 767) {
			$('.home_item2').fadeIn(400, function(){
				$('.home_item6').fadeIn(400, function(){
					$('.home_item12').fadeIn(400, function(){
						$('.home_item7').fadeIn(400, function(){
							$('.home_item13').fadeIn(400, function(){
								$('.home_item10').fadeIn(400);
							});
						});
					});
				});
			});
		}
		else {

		// set cookie
		var visited = $.cookie("visited");
		$.cookie('visited', 'yes', { expires: 1, path: '/'});
        if (visited == "yes") {
            setTimeout(function(){
            fastImages();
             $('article.home_item9_quote').css({'opacity':'.5', 'top': '910px'}).fadeIn(400);
            },600);
            }
            else {
		        console.log("Home NOT Visited");
					 $('article.home_item9').fadeIn(600, function(){
					 var $quote = $('.quote').text().length;
				console.log($quote);
				if($quote > 100) {
					var $delay = 2000;
					setTimeout(function(){
				displayImages();
				},6000);
				}	
				if($quote < 100) {
					var $delay = 0;
					setTimeout(function(){
				displayImages();
				},4000);
				}	
				$('article.home_item9_quote').delay(200).fadeIn(400).delay(2000+$delay).animate({'opacity':'.5'}).delay(300).animate({'top': '910'}, 600, 'swing'); 
					 });
            } //cookies
			
		} //window bigger than 767
	
})();
	
  
   });   
  });
  jQuery(function($){

	$(document).ready(function(){
  		var iframe = $('#home_player')[0],
	    player = $f(iframe);

   	$("img.placeholder, .circle, #button").click(function(){
   		player.api('play');
   		$("img.placeholder").fadeOut(200);
   		$(".home_item1 span.circle").fadeOut(200);
   		$('.home_item1 span#button').removeClass('awesome-icon-play');
       $('.home_item1 span#button').addClass('awesome-icon-pause');
/*    		$('.home_item1 a.video-caption h3').text('Pause Video'); */
   	});
	player.addEvent('ready', function() {
	    player.addEvent("pause", function() {
	       $(".placeholder").fadeIn();
	       $(".home_item1 span.circle").fadeIn();
	       $('.home_item1 span#button').removeClass('awesome-icon-pause');
	       $('.home_item1 span#button').addClass('awesome-icon-play');
/* 	       $('.home_item1 a.video-caption h3').text('Play Video'); */
	       
	     });
	    player.addEvent("ended", function() {
	       $(".placeholder").fadeIn();
	       $(".home_item1 span.circle").fadeIn();
	       $('.home_item1 span#button').removeClass('awesome-icon-pause');
	       $('.home_item1 span#button').addClass('play');
/* 	       $('.home_item1 a.video-caption h3').text('Play Video'); */
	    });
	});
	var isPaused = player.api('pause');
	
	if (isPaused == true) {
		$('.home_item1 a.video-caption h3 span#button').removeClass('awesome-icon-pause');
	       $('.home_item1 a.video-caption h3 span#button').addClass('awesome-icon-play');
	}
	if (isPaused == false) {
	$('.home_item1 a.video-caption h3 span#button').removeClass('awesome-icon-play');
	       $('.home_item1 a.video-caption h3 span#button').addClass('awesome-icon-pause');
		$('.home_item1 a.video-caption h3 span#button').text('Pause Video');
	}
	
	   });   
  });
  
</script>

<!-- END home-wrap -->   

</div>
<!-- /main -->

    <div id="home_footer" class="clearfix">
        
	</div>
	<!-- /footer -->
    
</div>
<!-- wrap --> 
<!-- WP Footer -->
<?php wp_footer(); ?>
</body>
</html>
