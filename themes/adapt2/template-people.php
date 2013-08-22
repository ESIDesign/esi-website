<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 * Template Name: People
 */
?>

<?php get_header(); ?>

    <div class="people-wrap">
<!-- LEADERSHIP -->
<ul id="og-grid" class="og-grid">
<?php

// Get the authors from the database ordered by user lastname = (hack to get Ed, Susan, ...)
	global $wpdb;
	$query = "SELECT user_id FROM $wpdb->usermeta WHERE meta_key = 'last_name' ORDER BY meta_value DESC";
	$author_ids = $wpdb->get_results($query);
	$count = 0;
// Loop through each author
	foreach($author_ids as $author) :
	// Get user data
		$curauth = get_userdata($author->user_id);

	// If user level is above 0 or login name is "admin", display profile
		if($curauth->user_level > 4 && $curauth->leadership == 'on' && $curauth->first_name != 'ESI') :
		$count++;
		// Get link to author page
			$user_link = get_author_posts_url($curauth->ID);
			$avatar = 'wavatar';
?>

			<li class="people-grid">
				<a data-largesrc="<?php echo get_avatar_url(get_avatar($curauth->ID, '300' )); ?>" data-title="<?php echo $curauth->display_name; ?>" data-position="<?php echo $curauth->position; ?>" data-description="<?php echo $curauth->description; ?>">
					<?php echo get_avatar($curauth->ID, '200', $avatar); ?> 
					<article class="caption_people">
						<span class="name"><?php echo $curauth->display_name; ?></span><br />
						<?php echo $curauth->position; ?>
					</article>
				</a>
			</li>

		<?php endif; ?>

	<?php endforeach; ?>

<!-- DIRECTORS -->

<?php

// Get the authors from the database ordered by user nicename
	global $wpdb;
	$query = "SELECT ID, user_nicename from $wpdb->users ORDER BY user_nicename";
	$author_ids = $wpdb->get_results($query);
	$count = 0;
// Loop through each author
	foreach($author_ids as $author) :
	
	// Get user data
		$curauth = get_userdata($author->ID);

	// If user level is above 0 or login name is "admin", display profile
		if($curauth->user_level > 4 && $curauth->director == 'on') :
		$count++;
		// Get link to author page
			$user_link = get_author_posts_url($curauth->ID);
?>
		<li class="people-grid">
			<a data-largesrc="<?php echo get_avatar_url(get_avatar($curauth->ID, '200' )); ?>" data-title="<?php echo $curauth->display_name; ?>" data-position="<?php echo $curauth->position; ?>" data-description="<?php echo $curauth->description; ?>">
				<?php echo get_avatar($curauth->user_email, 200);	?> 
					<article class="caption_people">
						<span class="name"><?php echo $curauth->display_name; ?></span><br />
						<?php echo $curauth->position; ?>
					</article>
				</a>
			</li>
	<?php if ($count == '1') { ?>
			<li class="people-grid2"><div class="clear"></div></li>
	<?php } ?>

	<?php if ($count == '3') { ?>
		<li class="people-grid3"><article class="people_block2"></article></li>
	<?php } ?>

	<?php endif; ?>

<?php endforeach; ?>

</ul>

<div class="clear"></div>
<div class="info">

<div class="people_block2"></div>
 
<div class="people_excerpt"> 
 <h1><?php the_title(); ?></h1>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <h3><?php echo get_the_content(); ?></h3>
<?php endwhile; ?>
<?php endif; ?>
</div>

</div>

<div class="lower">
<?php

// Get the authors from the database ordered by user nicename
	global $wpdb;
	$query = "SELECT ID, user_nicename from $wpdb->users ORDER BY rand()";
	$author_ids = $wpdb->get_results($query);
	//lower authors count
	$count = 0;
            
            //people attachments loop
            $id = get_the_ID();
            $args = array(
                'orderby' => 'rand',
				'post_type' => 'attachment',
				'post_parent' => $id,
				'post_mime_type' => 'image',
				'posts_per_page' => 4,
            );
            $attachments = get_posts($args);
            
            //people attachments count
            $i=0;         

// Loop through each author
	foreach($author_ids as $author) :

	// Get user data
		$curauth = get_userdata($author->ID);

	// All current users are editors or higher 
		if($curauth->user_level > 4 && $curauth->leadership != 'on' && $curauth->director != 'on') :
		$count++;
		
		// Get link to author page - not in use
			$user_link = get_author_posts_url($curauth->ID);

		// Set default avatar (values = default, wavatar, identicon, monsterid)
			$avatar = 'default';
?>

<div class="people_item">

	<?php 
	echo get_avatar($curauth->user_email, '200', $avatar); 
	?> 
	<article class="caption_people">
	<p class="name"><?php echo $curauth->display_name; ?></p>
	<p>
		<?php echo $curauth->position; ?>
	</p>
	</article>

</div>

<!-- People Attachment Photos  -->
  <?php if ($count % 8 == 0) {   
	
	$grid_thumb = wp_get_attachment_image_src( $attachments[$i]->ID, 'grid-thumb');?>                       
		<div class="people_item2">
			<a href="<?php echo $grid_thumb[0]; ?>"><img src="<?php echo $grid_thumb[0]; ?>" alt="<?php echo apply_filters('the_title', $attachments[$i]->post_title); ?>" /></a> 
		</div>

	<?php  $i++; } ?>

<!-- lower orange blocks -->
<?php if ($count ==3 || $count % 12 == 0) { ?>
	<div class="people_block"></div>
<?php } ?>


	<?php endif; ?>

<?php endforeach; ?>

</div>

<div class="clear"></div>

<script src="<?php echo get_template_directory_uri(); ?>/js/modernizr.custom.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/grid.js"></script>

<script type="text/javascript">
jQuery(function($){
$(document).ready(function(){
	
	$('.people-wrap').fadeIn();
	$('#footer').hide();
	var paras = $('.lower div').hide();
	var paras = $('.info').hide();
	$('div#wrap').show();
	$('div#main').show();
	$('div#logo').show();
	$('div.menu-primary-nav-container').show();
	
	    i = 3;
		   var li_length = jQuery('#og-grid li').length - 3;
		   var div_length = jQuery('.lower div').length - 1;
	
	$('#og-grid li').each(function(b) {
	  $(this).fadeOut(0).delay(150*b).fadeIn(200, function(){
		  if(li_length == b){
			  	   Grid.init();
		  	   $('.info').fadeIn(300, function(){
					 $('.lower div').each(function(l) {
						   $(this).fadeOut(0).delay(100*l).fadeIn(200, function() {
								   if(div_length == l){
									   $('#footer').fadeIn(400);
								   }
						   });
					});
		  	   });
		   }
	   });  
	});

});
});

</script>
		
<?php get_footer(); ?>