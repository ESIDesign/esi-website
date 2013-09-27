<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 * Template Name: About Old
 */
?>

<?php get_header(); ?>

<div class="about-wrap clearfix">

<div class="about_item1">
<h1><?php the_title(); ?></h1>
<h3><?php
		if (get_field('headline') != "") { 
			the_field("headline");
	} ?></h3>
</div>

    	<?php   
        	$id = get_the_ID();
            //attachement loop
            $args = array(
                'orderby' => 'rand',
				'post_type' => 'attachment',
				'post_parent' => $id,
				'post_mime_type' => 'image',
				'post_status' => null,
				'posts_per_page' => -1
            );
            $attachments = get_posts($args);
			
			//attachments count
			$attachments_count = count($attachments);
			$count = 0;
            //start loop
	            foreach ($attachments as $attachment) :
	            $count++;
	            //get images
	            $grid_thumb = wp_get_attachment_image_src( $attachment->ID, 'grid-thumb');
	            $grid_thumb1 = wp_get_attachment_image_src( $attachment->ID, 'grid-thumb1');
	            $grid_thumb3 = wp_get_attachment_image_src( $attachment->ID, 'grid-thumb3');  ?>
                            
                 <?php if ($count == '1') { ?>   
                 	<div class="about_item2">
                   <img src="<?php echo $grid_thumb3[0]; ?>" alt="<?php echo apply_filters('the_title', $attachment->post_title); ?>" />
             <!--       <img src="<?php echo get_template_directory_uri(); ?>/images/about_placeholder.jpg" alt="<?php echo apply_filters('the_title', $attachment->post_title); ?>" /> -->
                 	</div>
                 	
                 	                 	
                 <?php } ?>
          
                    <?php if ($count == '2') { ?>                         
                   
<div class="new_about_wrapper">
                    <div class="about_item10">
                    <img src="<?php echo $grid_thumb[0]; ?>" alt="<?php echo apply_filters('the_title', $attachment->post_title); ?>" />
                    </div>
                     <?php } ?>   
                        
					<?php if ($count == '3') { ?>
						        <div class="about_item13">
							<img src="<?php echo $grid_thumb[0]; ?>" alt="<?php echo the_title(); ?>" />
						</div>
		<div id="st-accordion_about">
                 	<ul>
                 	 <?php
			if (get_field('module1') != "") { 
				echo '<li class="about_item8"><a href="#">';
				the_field("module1_title");
				echo '</a><div class="st-content">';
				the_field("module1");
				echo '</div></li>';
		} ?>



<?php
						if (get_field('module2') != "") { 
							echo '<li class="about_item9"><a href="#">';
							the_field("module2_title");
							echo '</a><div class="st-content">';
							the_field("module2");
							echo '</div></li>';
					} ?>

					

					<?php
						if (get_field('module3') != "") { 
							echo '<li class="about_item14"><a href="#">';
							the_field("module3_title");
							echo '</a><div class="st-content">';
							the_field("module3");
							echo '</div></li>';
					} ?>
					
					<?php
						if (get_field('module4') != "") { 
							echo '<li class="about_item14"><a href="#">';
							the_field("module4_title");
							echo '</a><div class="st-content">';
							the_field("module4");
							echo '</div></li>';
					} ?>
					
					<?php
						if (get_field('module5') != "") { 
							echo '<li class="about_item14"><a href="#">';
							the_field("module5_title");
							echo '</a><div class="st-content">';
							the_field("module5");
							echo '</div></li>';
					} ?>
					       
                 	</ul>
		</div>



						   					

					<?php } ?>
					
					<?php if ($count == '4') { ?>
					    <div class="about_item11">
				        <a class="about_item11" href="<?php echo get_site_url(); ?>/careers">Careers</a>
				        </div>
						
						<div class="about_item15">
				         <a class="about_item15" href="<?php echo get_site_url(); ?>/contact">Contact</a>
				        </div>
					
				         <div class="about_item6">
					<img src="<?php echo $grid_thumb[0]; ?>" alt="<?php echo the_title(); ?>" />
        </div>
        
        				       					
        <?php } ?>

        
	    <?php endforeach; ?>

			        <div class="about_item5">
			        <a class="about_item5" href="<?php echo get_site_url(); ?>/people">People</a>
			        </div>
<?php

// Get the authors from the database ordered by user nicename
	global $wpdb;
	$query = "SELECT ID, user_nicename from $wpdb->users ORDER BY rand()";
	$author_ids = $wpdb->get_results($query);
// Loop through each author
	$count2 = 0;
	foreach($author_ids as $author) :

	// Get user data
		$curauth = get_userdata($author->ID);


		// Get link to author page
			$user_link = get_author_posts_url($curauth->ID);

		// Set default avatar (values = default, wavatar, identicon, monsterid)
			$avatar = 'wavatar';

	// If user level is above 0 or login name is "admin", display profile
		if($curauth->user_level > 4 && $curauth->first_name != 'ESI') :
			$count2++;
?>
<?php if ($count2 == '1') { ?>
<div class="about_item4">
<a href="<?php echo get_site_url(); ?>/people"><?php 
	if(userphoto_exists($curauth->ID))
    userphoto($curauth->ID);
    else
	echo get_avatar($curauth->user_email, '116', $avatar); 
	?> </a>
	<a href="<?php echo get_site_url(); ?>/people" class="caption_people"><?php echo $curauth->first_name; ?></a>
</div>
	<? } ?>


<?php if ($count2 == '2') { ?>
<div class="about_item4_2">	
<a href="<?php echo get_site_url(); ?>/people"><?php 
	if(userphoto_exists($curauth->ID))
    userphoto($curauth->ID);
    else
	echo get_avatar($curauth->user_email, '116', $avatar); 
	?> </a>
	<a href="<?php echo get_site_url(); ?>/people" class="caption_people"><?php echo $curauth->first_name; ?></a>
</div>
	
	<? } ?>

	<?php endif; ?>

	     	<?php endforeach; ?>

          <div class="about_item16">
         <span class="awesome-icon-th"></span>
         <a class="about_item16" target="_blank" href="<?php echo get_site_url(); ?>/files/portfolio_2012.pdf"><h2>Download Our Portfolio</h2></a>
        </div>
        
</div>

</div>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.accordion.js"></script>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.3.js"></script>



<script type="text/javascript">
jQuery(function($){
	$(document).ready(function(){
	$('.about-wrap').fadeIn();
	$('#st-accordion_about').accordion({
		oneOpenedItem	: true,
		open: 2,
/* 		scrollSpeed: 0 */
	});

var paras = $('div').hide();
	$('div#wrap').show();
	$('div#main').show();
	$('div#logo').show();
	$('.st-content').show();
	$('div.menu-primary-nav-container').show();
	$('div.about-wrap').show();
    i = 3;

(function() {
  $(paras[i++]).fadeIn(200, arguments.callee);
})();

		jQuery('.about_item4_2').hover(function() {
		
		//Display the caption
				jQuery(this).find('a.caption_people').stop(false,true).animate({opacity:1}).css('background-color', 'rgba(0,0,0,.4)');
	},
	function() {
		//Hide the caption
			jQuery(this).find('a.caption_people').stop(false,true).animate({opacity:.4}).css('background-color', 'transparent');

	
	});
	
			jQuery('.about_item4').hover(function() {
		
		//Display the caption
				jQuery(this).find('a.caption_people').stop(false,true).animate({opacity:1}).css('background-color', 'rgba(0,0,0,.4)');
	},
	function() {
		//Hide the caption
			jQuery(this).find('a.caption_people').stop(false,true).animate({opacity:.4}).css('background-color', 'transparent');

	
	});
	
	$('body').scrollTop(0);
	
	
});
});
</script>

<?php get_footer(); ?>