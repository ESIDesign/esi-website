<?php
// Our include
define('WP_USE_THEMES', false);
require_once('../../../wp-load.php');

// Our variables
$numPosts = (isset($_GET['numPosts'])) ? $_GET['numPosts'] : 0;
// grab the current page number and set to 1 if no page number is set
$page = (isset($_GET['pageNumber'])) ? $_GET['pageNumber'] : 0;


/*
	global $wpdb;
	$query = "SELECT ID, user_nicename from $wpdb->users ORDER BY rand()";
	$author_ids = $wpdb->get_results($query);
	$count = 0;
*/


$count_args = array(
	'fields' => 'all',
	'role' => 'editor',
	'number' => 99999
);

// The Query
$user_count_query = new WP_User_Query( $count_args );
$user_count = $user_count_query->get_results();

// count the number of users found in the query
$total_users = $user_count ? count($user_count) : 1;


// how many users to show per page
$limit = 1;

// calculate the total number of pages.
$total_pages = 1;
$offset = $limit * ($page - 1);
$total_pages = ceil($total_users / $users_per_page);

$randomize_func = create_function( '&$query', '$query->query_orderby = "ORDER BY RAND()";' );  

// Hook pre_user_query 
add_action( 'pre_user_query', $randomize_func ); 
// main user query
$args  = array(
    // search only for Authors role
    'role'      => 'editor',
    // return all fields
    'fields'    => 'all',
    'number'    => $limit,
    'offset'    => $offset // skip the number of users that we have per page  
);

$user_query = new WP_User_Query( $args );
remove_action( 'pre_user_query', $randomize_func );

// User Loop
if ( ! empty( $user_query->results ) ) {
	foreach ( $user_query->results as $user ) :
	// Get user data
		$curauth = get_userdata($user->ID);


		// Get link to author page
			$user_link = get_author_posts_url($user->ID);

		// Set default avatar (values = default, wavatar, identicon, monsterid)
			$avatar = 'wavatar';

	// If user level is above 0 or login name is "admin", display profile
		if($user->first_name != 'ESI') :
		$count++;
?>

<a href="<?php echo get_site_url(); ?>/people"><?php 
	if(userphoto_exists($user->ID))
    userphoto($user->ID);
    else
	echo get_avatar($user->user_email, '116', $avatar); 
	?> 
<p class="caption_people"><?php echo $user->first_name; ?></p>
</a>

	<?php endif; ?>
	<?php endforeach; 
		}
	?>
<!-- <?php wp_reset_query(); ?> -->