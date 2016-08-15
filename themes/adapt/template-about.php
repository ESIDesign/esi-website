<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 * Template Name: About
 */
?>

<?php get_header(); ?>

<div class="about-wrap clearfix">

<div class="photo_headline">
<?php $image = wp_get_attachment_image_src( get_field('headline_img1'), 'slider');
						echo '<span class="gradient" style="';
						do_action('gradient', $image[0]);
						echo '">Image</span>'; ?>
<div class="about_text"><h1><?php the_title(); ?></h1>
<h3><?php
		if (get_field('headline') != "") { 
			the_field("headline");
	} ?></h3></div>
</div>

<div class="about_work"> 
     <div class="about_work_left">
		<?php if (get_field('module1') != "") { 
			echo '<h2>';
			echo get_field("module1_title");
			echo '</h2><h3>';
			echo strip_tags(get_field("module1"));
			echo '</h3><h3 class="red">';
			echo strip_tags(get_field("module1_link"), '<a>');
			echo '</h3>';
		} ?>
    </div>
					
<div class="about_work_right">
 <?php
        global $post;
        $args2 = array(
            'post_type' =>'project',
            'posts_per_page' => 4,
            'meta_query' => array(
                                array('key' => 'featured',
                                      'value' => '1'
                                )
                            ),
            'orderby' => 'rand'
        );
       $projects = get_posts($args2);
						
						//attachments count
		$projects_count = count($projects);
        $count = 0;
                        //start loop
        foreach ($projects as $project) : setup_postdata($post);
            $count++;
	$project_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($project->ID), 'grid-thumb'); ?>

		    <article class="about_work<?php echo $count+1;?>"> 
			  <a href="<?php echo get_permalink($project->ID); ?>"><img src="<?php echo $project_thumb[0]; ?>" alt="<?php echo the_title(); ?>" /></a>
			  <a href="<?php echo get_permalink($project->ID); ?>" class="project-overlay"><?php echo $project->post_title; ?></a>
		    </article>
        				       					
	<?php endforeach; 
	wp_reset_postdata();
	?>
	</div>					
</div><!-- about work -->


<div class="about_phil">
	<?php $image = wp_get_attachment_image_src( get_field('module2_img', $post->ID), 'slider');
	echo '<span class="gradient" style="';
	do_action('gradient', $image[0]);
	echo '">Image</span>'; ?>
	<div class="about_phil_text">
		<?php
		if (get_field('module2') != "") { 
			echo '<h2>';
			echo get_field("module2_title");
			echo '</h2><h3>';
			echo strip_tags(get_field("module2"));
			echo '</h3><h3>';
			echo strip_tags(get_field("module2_link"), '<a>');
			echo '</h3>';
		} ?>
	</div>
</div><!-- about_phil -->

<div class="about_people">

<div class="about_people_left">
	<?php
		if (get_field('module3') != "") { 
			echo '<h2>';
			the_field("module3_title");
			echo '</h2><h3>';
			echo strip_tags(get_field("module3"));
			echo '</h3><h3 class="red">';
			echo strip_tags(get_field("module3_link"), '<a>');
			echo '   |  ';
			echo '   ';
			echo strip_tags(get_field("module4_link"), '<a>');
			echo '</h3>';
	} ?>
</div>		

<div class="about_people_right">
<?php
	// Get the authors from the database ordered by user nicename
	global $wpdb;
	$query = "SELECT ID, user_nicename from $wpdb->users ORDER BY rand() LIMIT 14";
	$author_ids = $wpdb->get_results($query);

	$count2 = 0;
	foreach($author_ids as $author) :

	$curauth = get_userdata($author->ID);
	
	// Get link to author page
	$user_link = get_author_posts_url($curauth->ID);
	
	// Set default avatar (values = default, wavatar, identicon, monsterid)
	$avatar = 'wavatar';

	// If user level is editor or above or login name is not "admin", display profile
	if($curauth->user_level >= 1 && $curauth->first_name != 'ESI' && $curauth->first_name != 'Julie' && $curauth->first_name != 'Tyler' && $curauth->first_name != 'Tarley') :
	$count2++;
?>

<?php if($count2 <= 6) { ?>
	<article>
	<a href="<?php echo get_site_url(); ?>/people"><?php 
		if(userphoto_exists($curauth->ID))
	    userphoto($curauth->ID);
	    else
		echo get_avatar($curauth->user_email, '116', $avatar); 
		?> </a>
		<a href="<?php echo get_site_url(); ?>/people" class="caption_people"><?php echo $curauth->first_name; ?></a>
	</article>
<?php } ?>

<?php endif; ?>

     	<?php endforeach; ?>
    </div><!-- About People -->
</div>


<script type="text/javascript">
jQuery(function($){
	$(document).ready(function(){
	$('.about-wrap').fadeIn();
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
	
	$('body').scrollTop(0);
	
});
});
</script>
<div class="clear clearfix"></div>
<?php get_footer(); ?>