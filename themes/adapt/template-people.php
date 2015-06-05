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
// Get the authors from the database ordered by user lastname = (hack to get Ed, Susan, Gideon)
	global $wpdb;
	$query = "SELECT user_id FROM $wpdb->usermeta WHERE meta_key = 'last_name' ORDER BY user_id ASC";
	$author_ids = $wpdb->get_results($query);
	$count = 0;

	foreach($author_ids as $author) :
		// Get user data
		$curauth = get_userdata($author->user_id);

		// If user level is above 0 or login name is "admin", display profile
		if($curauth->user_level > 4 && $curauth->leadership == 'on' && $curauth->first_name != 'ESI') :
		$count++;
		$user_link = get_author_posts_url($curauth->ID);
		$avatar = 'wavatar';
?>
			<li class="people-grid">
				<a data-largesrc="<?php echo esi_get_avatar_url(get_avatar($curauth->ID, '250' )); ?>" data-title="<?php echo $curauth->display_name; ?>" data-position="<?php echo $curauth->position; ?>" data-description="<?php echo $curauth->description; ?>">
					<?php echo get_avatar($curauth->user_email, '170', $avatar); ?> 
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
			<a data-largesrc="<?php echo esi_get_avatar_url(get_avatar($curauth->ID, '250' )); ?>" data-title="<?php echo $curauth->display_name; ?>" data-position="<?php echo $curauth->position; ?>" data-description="<?php echo $curauth->description; ?>">
				<?php echo get_avatar($curauth->user_email, '170', $avatar); ?>
					<article class="caption_people">
						<span class="name"><?php echo $curauth->display_name; ?></span><br />
						<?php echo $curauth->position; ?>
					</article>
				</a>
			</li>

	<?php endif; ?>
<?php endforeach; ?>

</ul><!-- og-grid -->

<div class="clear"></div>

<div class="info">
	<div class="people_block2"></div>	 
	<div class="people_excerpt"> 
	 <h1><?php the_title(); ?></h1>
	    <h3><?php echo get_the_content(); ?></h3>
	    <h3><a href="<?php echo get_site_url(); ?>/careers">Join Us</a></h3>
	</div>
</div>

<ul class="og-grid">
<?php
	global $wpdb;
	$query = "SELECT ID, user_nicename from $wpdb->users ORDER BY rand()";
	$author_ids = $wpdb->get_results($query);

	$count = 0;

    $id = get_the_ID();
                    
$people_args = array(
	'post_type' => 'people' 
);
$people_posts = get_posts( $people_args );

$peoplepage_args = array(
	'orderby' => 'rand',
	'post_type' => 'attachment',
	'tag' => 'people',
	'post_mime_type' => 'image',
	'posts_per_page' => 4
);
$peoplepage_posts = get_posts($peoplepage_args);

$all_posts = array_merge($people_posts, $peoplepage_posts);

$post_ids = wp_list_pluck( $all_posts, 'ID' );//Just get IDs from post objects

// Do a new query with these IDs to get a properly-sorted list of posts
$attachments = get_posts( array(
	'post_type' => array('attachment', 'people'),
    'post__in'    => $post_ids,
    'post_status' => array('inherit','publish'),
    'orderby' => 'rand',
    'numberposts'=> 6
) ); 
            
//people attachments count
$i=0;         

foreach($author_ids as $author) :

	$curauth = get_userdata($author->ID);

	// All current users are editors or higher 
	if($curauth->user_level > 4 && $curauth->leadership != 'on' && $curauth->director != 'on' && $curauth->first_name != 'Rosemary') :
		$count++;

		// Set default avatar (values = default, wavatar, identicon, monsterid)
		$avatar = 'default';
?>

<li class="people-grid">
<!-- 	<a data-largesrc="<?php echo esi_get_avatar_url(get_avatar($curauth->ID, '250' )); ?>" data-title="<?php echo $curauth->display_name; ?>" data-position="<?php echo $curauth->position; ?>" data-description="<?php echo $curauth->description; ?>"> -->
	<?php echo get_avatar($curauth->user_email, '170', $avatar); ?>
	<article class="caption_people">
		<span class="name"><?php echo $curauth->display_name; ?></span><br />
		<?php echo $curauth->position; ?>
	</article>
<!-- 		</a> -->
</li>

<?php if ($count % 7 == 0) {   
	if('people' == get_post_type($attachments[$i]->ID)) {
	setup_postdata( $attachments[$i] ); 

	$image_url = wp_get_attachment_image_src(get_post_thumbnail_id($attachments[$i]->ID),'insta', true);
	$site_url = get_site_url();

	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<source.+src=[\'"]([^\'"]+)[\'"].*>/i', $attachments[$i]->post_content, $matches);
	$first_vid = $matches[1][0];

	$value = get_post_meta($attachments[$i]->ID, 'syndication_permalink', true);
	echo '<article class="people_item">';

    $agent = $_SERVER['HTTP_USER_AGENT'];

	  if (($output == '1') && (strlen(strstr($agent,"Firefox")) == 0)) {

 	 
	  echo '<li class="video-wrapper"><video id="esipeople" width="240" >
		<source src="'.$first_vid.'" type="video/mp4">
		</video><span class="awesome-icon-play"></span></li>';
		}

	  if (($output != '1') || (strlen(strstr($agent,"Firefox")) > 0)) {	
		echo '<img src="'.$image_url[0].'"/>';
		}
		echo '</article>';
	}
	if('attachment' == get_post_type($attachments[$i]->ID)) {
	$grid_thumb2 = wp_get_attachment_image_src($attachments[$i]->ID, 'grid-thumb'); ?>
		<li class="people_item2">
		<div class="crop">
			<img src="<?php echo $grid_thumb2[0]; ?>" alt="<?php echo apply_filters('the_title', $attachments[$i]->post_title); ?>" /> 
		</div>
		</li>
	<?php } ?>                    
	
	<?php  $i++; } ?>

<?php if ($count ==3 || $count % 12 == 0) { ?>
	<li class="people_block"></li>
<?php } ?>

	<?php endif; ?>

<?php endforeach; ?>
</ul>

<div class="clear"></div>
</div>

<script src="<?php echo get_template_directory_uri(); ?>/js/modernizr.custom.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/grid.js"></script>

<script type="text/javascript">
jQuery(function($){
/* $('.people-wrap').show(); */
/* $('#og-grid li, .info, .lower div, .lower li, #footer').hide(); */

	$(document).ready(function(){
		Grid.init();
		/*
var li_length = $('#og-grid li').length - 3;
		var div_length = $('.lower div').length - 1;
		
		$('#og-grid li').each(function(b) {
		  $(this).fadeOut(0).delay(150*(b++)).fadeIn(200, function(){
			   if(li_length == b){
 				   Grid.init(); 
			  	   $('.info').fadeIn(300, function(){
						$('.lower div').each(function(l) {
							$(this).fadeOut(0).delay(100*(l++)).fadeIn(200, function() {
								if(div_length == l){
									
									$('#footer').fadeIn(400);
								}
							});
						});
			  	   });
			    }
			});  
		});
*/
	
		$('.people_item').hover(function() {
			jQuery(this).find('.awesome-icon-play').fadeOut();
			var myVideo = jQuery(this).find('video#esipeople')[0];
			myVideo.play();
		},
		function() {
			$(this).find('.awesome-icon-play').fadeIn();
			var myVideo = jQuery(this).find('video#esipeople')[0];
			myVideo.pause();
		});

	});
});
</script>	
<?php get_footer(); ?>