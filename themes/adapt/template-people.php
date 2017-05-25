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
$afterDate = date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-3 month" ) );
              
$people_args = array(
	'post_type' => 'insta',
	'post_status' => array('publish'), 
	'orderby' => 'date',
	'order' => 'DESC',
//     'meta_key' => 'hashtag',
//     'meta_value' => 'esipeople',
//     'meta_compare' => '=',
    'posts_per_page' => 10,
    'date_query' => array( 'after' => $afterDate ), 
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

$post_ids = wp_list_pluck( $all_posts, 'ID' );

// Merge of Instas with hashtag esipeople & attachments tagged people
$attachments = get_posts( array(
	'post_type' => array('attachment', 'insta'),
    'post__in' => $post_ids,
    'post_status' => array('inherit','publish'),
    'orderby' => 'rand',
    'numberposts'=> 10
) ); 
            
//people attachments count
$i=0;   
$count = 0;      

//add esi design user to list of excluded ids
array_push($leadership_ids, 1);

$args = array(
	'exclude' => $leadership_ids,
	'orderby' => 'rand',
	'meta_key' => 'wp_user_level',
	'meta_value' => '1',
	'meta_compare' => '>',
 );
$user_query = new WP_User_Query( $args );
$authors = $user_query->get_results();
if(!empty($authors)) :
foreach($authors as $author) :
	$curauth = get_userdata($author->ID);		
		$count++;
		$avatar = 'default';  ?>

<li class="people-grid">
<?php if($curauth->description) { ?>
	<a data-largesrc="<?php echo esi_get_avatar_url(get_avatar($curauth->ID, '250' )); ?>" data-title="<?php echo $curauth->display_name; ?>" data-position="<?php echo $curauth->position; ?>" data-description="<?php echo $curauth->description; ?>">
<?php } ?>
	<?php echo get_avatar($curauth->user_email, '170', $avatar); ?>
	<article class="caption_people">
		<h3 class="name"><?php echo $curauth->display_name; ?></h3>
		<?php echo $curauth->position; ?>
	</article>
<?php if($curauth->description) { echo '</a>'; } ?>
</li>

<?php if ($count % 6 == 0) {   
if('insta' == get_post_type($attachments[$i]->ID)) {
	$image_url = wp_get_attachment_image_src(get_post_thumbnail_id($attachments[$i]->ID),'insta',false);
    $insta_video = get_post_meta($attachments[$i]->ID, 'video', true);
    $value = get_post_meta($attachments[$i]->ID, 'insta_link', true);
    
    if($insta_video != '') {
	    echo '<article class="people_item video-wrapper '.$attachments[$i]->ID.'">
		<video id="esipeople" width="240" poster="'.$image_url[0].'">
			<source src="'.$insta_video.'" type="video/mp4">
		</video><span class="awesome-icon-play"></span></article>';
    } else {
	    echo '<article class="people_item">';
	    echo '<img src="'.$image_url[0].'"/>';
	    echo '</article>';
    }

}
if('attachment' == get_post_type($attachments[$i]->ID)) {
	$grid_thumb2 = wp_get_attachment_image_src($attachments[$i]->ID, 'grid-thumb'); ?>
	<li class="people_item2">
		<img src="<?php echo $grid_thumb2[0]; ?>" alt="<?php echo apply_filters('the_title', $attachments[$i]->post_title); ?>" /> 
	</li> 
<?php } ?>                    
	
<?php  $i++; } ?>

<?php if ($count == 3 || $count % 14 == 0) { ?>
	<li class="people_block"></li>
<?php } ?>

<?php endforeach; endif; ?>
</ul>

<div class="clear"></div>
</div>
	
<?php get_footer(); ?>