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
<ul id="og-grid" class="og-grid og-grid1">
<?php $leadership_ids = array();
if( have_rows('leadership_order', 'option') ):
    while ( have_rows('leadership_order', 'option') ) : the_row();
    $user = get_sub_field('user');
    array_push($leadership_ids, $user['ID']);
    endwhile;
endif;
$args = array(
	'include' => $leadership_ids,
	'orderby' => 'include',
	'role__not_in' => array('Subscriber', 'None')
 );
$user_query = new WP_User_Query( $args );
$authors = $user_query->get_results();
if(!empty($authors)) :
foreach($authors as $author) :

	$curauth = get_userdata($author->ID);

	$user_link = get_author_posts_url($curauth->ID);
	$avatar = 'wavatar'; 
	if($curauth->user_level >= 1) : ?>
	
	<li class="people-grid fadein">
	<?php if($curauth->description) { ?>
		<a data-largesrc="<?php echo esi_get_avatar_url(get_avatar($curauth->ID, '250' )); ?>" data-title="<?php echo $curauth->display_name; ?>" data-position="<?php echo $curauth->position; ?>" data-description="<?php echo $curauth->description; ?>">
	<?php } ?>
	<?php echo get_avatar($curauth->user_email, '170', $avatar); ?> 
		<article class="caption_people">
			<h3 class="name"><?php echo $curauth->display_name; ?></h3>
			<?php echo $curauth->position; ?>
		</article>
	<?php if($curauth->description) { 
		echo '</a>';
	} ?>	
	</li>

<?php endif; endforeach;
endif; wp_reset_query(); ?>


</ul>

<div class="clear"></div>

<div class="info fadein">
	<div class="people_block2"></div>	 
	<div class="people_excerpt"> 
	 <h1><?php the_title(); ?></h1>
	    <h3><?php echo get_the_content(); ?></h3>
	    <h3><a href="<?php echo get_site_url(); ?>/jobs">Join Us</a></h3>
	</div>
</div>

<ul class="og-grid og-grid2 fadein">
<?php                  
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
$count = 0;      

$args = array(
	'exclude' => $leadership_ids,
	'orderby' => 'rand',
	'role__not_in' => array('Subscriber', 'None')
 );
$user_query = new WP_User_Query( $args );
$authors = $user_query->get_results();
if(!empty($authors)) :
foreach($authors as $author) :

	$curauth = get_userdata($author->ID);

	// All current users are editors or higher 
	if($curauth->user_level >= 1 && $curauth->leadership != 'on') :
		
		$count++;
		// Set default avatar (values = default, wavatar, identicon, monsterid)
		$avatar = 'default'; ?>

<li class="people-grid">
<?php if($curauth->description) { ?>
	<a data-largesrc="<?php echo esi_get_avatar_url(get_avatar($curauth->ID, '250' )); ?>" data-title="<?php echo $curauth->display_name; ?>" data-position="<?php echo $curauth->position; ?>" data-description="<?php echo $curauth->description; ?>">
<?php } ?>
	<?php echo get_avatar($curauth->user_email, '170', $avatar); ?>
	<article class="caption_people">
		<h3 class="name"><?php echo $curauth->display_name; ?></h3>
		<?php echo $curauth->position; ?>
	</article>
<?php if($curauth->description) { ?>
	</a>
<?php } ?>
</li>

<?php if ($count % 7 == 0) {   
	if('people' == get_post_type($attachments[$i]->ID)) {
	setup_postdata( $attachments[$i] ); 
	$image_url = wp_get_attachment_image_src(get_post_thumbnail_id($attachments[$i]->ID),'insta', true);
	$site_url = get_site_url();
    $agent = $_SERVER['HTTP_USER_AGENT'];
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<source.+src=[\'"]([^\'"]+)[\'"].*>/i', $attachments[$i]->post_content, $matches);

	$value = get_post_meta($attachments[$i]->ID, 'syndication_permalink', true);
	
	echo '<article class="people_item">';

	if (($output == '1') && (strlen(strstr($agent,"Firefox")) == 0)) {
		$first_vid = $matches[1][0];
		echo '<article class="video-wrapper '.$attachments[$i]->ID.'">
		<video id="esipeople" width="240" >
			<source src="'.$first_vid.'" type="video/mp4">
		</video><span class="awesome-icon-play"></span></article>';
	}

	if (($output != '1') || (strlen(strstr($agent,"Firefox")) > 0)) {	
		echo '<img src="'.$image_url[0].'"/>';
	}
		
	echo '</article>';
}
if('attachment' == get_post_type($attachments[$i]->ID)) {
	$grid_thumb2 = wp_get_attachment_image_src($attachments[$i]->ID, 'grid-thumb'); ?>
	<li class="people_item2">
		<img src="<?php echo $grid_thumb2[0]; ?>" alt="<?php echo apply_filters('the_title', $attachments[$i]->post_title); ?>" /> 
	</li> 
<?php } ?>                    
	
<?php  $i++; } ?>

<?php if ($count ==3 || $count % 12 == 0) { ?>
	<li class="people_block"></li>
<?php } ?>

<?php endif; endforeach;
endif; ?>
</ul>

<div class="clear"></div>
</div>
	
<?php get_footer(); ?>