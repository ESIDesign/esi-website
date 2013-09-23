<?php
// Our include
define('WP_USE_THEMES', false);
require_once('../../../wp-load.php');

// Our variables
$numPosts = (isset($_GET['numPosts'])) ? $_GET['numPosts'] : 0;
$page = (isset($_GET['pageNumber'])) ? $_GET['pageNumber'] : 0;

/*
echo $numPosts;
echo $page;
*/
?>
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
<a style="opacity:1" href="<?php echo get_site_url(); ?>/people"><?php 
	if(userphoto_exists($curauth->ID))
    userphoto($curauth->ID);
    else
	echo get_avatar($curauth->user_email, '116', $avatar); 
	?> 
<p class="caption_people"><?php echo $curauth->first_name; ?></p>
</a>
<?php } ?>

	<?php endif; ?>
	<?php endforeach; ?>
<?php wp_reset_query(); ?>