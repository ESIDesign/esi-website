<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 * Template Name: TEST 2
 */
?>


<?php 
    query_posts('showposts=1&orderby=rand'); 
    the_post();
	$args = $args = array(
            'post_type' =>'project',
            'numberposts' => '1',
            'meta_query' => array(
                                array('key' => 'home',
                                      'value' => '1'
                                )
                            ),
            'orderby' => 'rand'
        );
	$rand_posts = get_posts( $args );
	
?>
<?php
	foreach( $rand_posts as $post ) :  setup_postdata($post);
	 $feat_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'grid-thumb');
        $feat_img2 = wp_get_attachment_image_src(get_post_thumbnail_id(), 'grid-thumb2');
?>

              <a href="<?php the_permalink(); ?>"><img src="<?php echo $feat_img[0]; ?>" height="<?php echo $feat_img[2]; ?>" width="<?php echo $feat_img[1]; ?>" alt="<?php echo the_title(); ?>" />
                 <a href="<?php the_permalink(); ?>" class="project-overlay"><h3> <?php 
	  	if (get_field('short') != "") { 
	  	the_field("short");
	  	}
	  	else { 
	  	the_title();  	
	  	 } ?></h3></a>
                </a>
<?php endforeach; ?>


		<div class="container">	

		<?php echo get_avatar_url(get_avatar( 'deverett-lane@esidesign.com')); ?>
		<?php echo get_avatar_url(get_avatar( 'lgibbons@esidesign.com', '200')); ?>
		<?php echo get_avatar( 'deverett-lane@esidesign.com', '200'); ?>

			<!-- Codrops top bar -->
			<div class="codrops-top clearfix">
				<a href="http://tympanus.net/Tutorials/HexaFlip/"><strong>&laquo; Previous Demo: </strong>HexaFlip</a>
				<span class="right">
					<a href="http://cargocollective.com/jaimemartinez">Illustrations by Jaime Martinez</a>
					<a href="http://tympanus.net/codrops/?p=14530"><strong>Back to the Codrops Article</strong></a>
				</span>
			</div><!--/ Codrops top bar -->
			
			
			<header class="clearfix">
				<h1>Thumbnail Grid <span>with Expanding Preview</span></h1>	
			</header>
			<div class="main">
							<ul id="og-grid" class="og-grid">
	<?php

// Get the authors from the database ordered by user nicename
	global $wpdb;
	$query = "SELECT ID, user_nicename from $wpdb->users ORDER BY ID=14 desc, user_nicename";
	$author_ids = $wpdb->get_results($query);
	$count = 0;
// Loop through each author
	foreach($author_ids as $author) :
	// Get user data
		$curauth = get_userdata($author->ID);

	// If user level is above 0 or login name is "admin", display profile
		if($curauth->user_level > 4 && $curauth->leadership == 'on' && $curauth->first_name != 'ESI') :
		$count++;
		// Get link to author page
			$user_link = get_author_posts_url($curauth->ID);

		// Set default avatar (values = default, wavatar, identicon, monsterid)
			$avatar = 'wavatar';
?>

					<li>
						<a data-largesrc="<?php echo get_avatar_url(get_avatar('lgibbons@esidesign.com', '200' )); ?>" data-title="<?php echo $curauth->display_name; ?>" data-position="<?php echo $curauth->position; ?>" data-description="<?php echo $curauth->description; ?>">
							<?php 
	echo get_avatar($curauth->user_email, '200', $avatar); 
	?> 
						</a>
					</li>


  

<?php endif; ?>

	<?php endforeach; ?>
	


					<li>
						<a href="http://cargocollective.com/jaimemartinez/" data-largesrc="images/2.jpg" data-title="Veggies sunt bona vobis" data-description="Komatsuna prairie turnip wattle seed artichoke mustard horseradish taro rutabaga ricebean carrot black-eyed pea turnip greens beetroot yarrow watercress kombu.">
							<img src="images/thumbs/2.jpg" alt="img02"/>
						</a>
					</li>
					<li>
						<a href="http://cargocollective.com/jaimemartinez/" data-largesrc="images/3.jpg" data-title="Dandelion horseradish" data-description="Cabbage bamboo shoot broccoli rabe chickpea chard sea lettuce lettuce ricebean artichoke earthnut pea aubergine okra brussels sprout avocado tomato.">
							<img src="images/thumbs/3.jpg" alt="img03"/>
						</a>
					</li>
					<li>
						<a href="http://cargocollective.com/jaimemartinez/" data-largesrc="images/1.jpg" data-title="Azuki bean" data-description="Swiss chard pumpkin bunya nuts maize plantain aubergine napa cabbage soko coriander sweet pepper water spinach winter purslane shallot tigernut lentil beetroot.">
							<img src="images/thumbs/1.jpg" alt="img01"/>
						</a>
					</li>
					

				</ul>
				<p>Filler text by <a href="http://veggieipsum.com/">Veggie Ipsum</a></p>
			</div>
		</div><!-- /container -->
		
		<script src="http://www.esidesign.com/new/wp-content/themes/adapt/js/modernizr.custom.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script src="http://www.esidesign.com/new/wp-content/themes/adapt/js/grid.js"></script>
		<script>
			$(function() {
				Grid.init();
			});
		</script>
					
		<link rel="stylesheet" type="text/css" href="http://www.esidesign.com/new/wp-content/themes/adapt/css/default.css" />
				<link rel="stylesheet" type="text/css" href="http://www.esidesign.com/new/wp-content/themes/adapt/css/component.css" />
		
	
	</body>
</html>