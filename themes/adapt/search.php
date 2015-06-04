<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 */
?>
<?php get_header(); ?>
		
<div id="post" class="full-width clearfix">   

<header id="page-heading">
	<h1 id="archive-title"><?php _e('Search results for', 'adapt'); ?> <span class="gray"><?php the_search_query(); ?></span></h1>
</header>

</div>
<?php
$query_string = explode("=", $query_string);
$query_string = $query_string[1];
?>

<div class="search-left">
	<div class="search-careers">
<?php if($query_string == 'jobs' || $query_string == 'careers' || $query_string == 'internships') { ?>
	<?php
$children = get_pages('post_type=careers&post_status=publish');
if( $children ) {
echo '<h2>Current Opportunities</h2>';
			$args = array(  'post_type' => 'careers',
				            'post_status'=> 'publish',
  							'sort_column' => 'post_title',
							'hierarchical' => 0  
 						);
				$mypages = get_pages($args);
				foreach( $mypages as $page ) {    
					echo '<article class="loop-entry clearfix">';
					echo '<a href="'.get_permalink($page->ID).'"><h3>'.$page->post_title.'</h3><p>'.$page->post_excerpt.' </span>  <span class="black"> View Listing→</span></a></p></article>';

				}	
}
else { 
	echo "<h3>There are no opportunities at this time.</h3>";
}
	echo '</div>';
} else { ?>
	
<div class="search-work">
<h2>Work</h2>
<?php
global $post;
$args = array(
	's' => $query_string,
	'post_type' =>'project',
	'orderby' => 'menu_order',
	'order' => 'ASC',
	'posts_per_page' => 4
);
$the_query = new WP_Query($args);
if ( $the_query->have_posts() ) :
while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
  
	<?php $feat_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'grid-thumb'); ?>  
	<?php if($feat_img) { ?>
	<div class="item">
	    	<a href="<?php the_permalink(' ') ?>" class="project-thumbnail"><img src="<?php echo $feat_img[0]; ?>" alt="<?php echo the_title(); ?>" /></a>
		<div class="project-overlay">
			<a href="<?php the_permalink(' ') ?>">
				<?php if (get_field('short') != "") { 
				  	echo "<h4>";
				  	the_field("short");
				  	echo "</h4>";
			  	} else { ?>
					<h4><?php the_title(); ?></h4>		  	
				<?php } ?>
			</a>
		</div>
	</div>
	<?php } ?>
	
	<?php endwhile; ?>                	     
<?php else : ?>
	    <?php _e('No work found for that query.', 'adapt'); ?>
<?php endif; ?>
</div>
<div class="clearfix"></div>


<?php
$query_string = explode("=", $query_string);
$query_string = $query_string[1];
global $post;
$args = array(
	's' => $query_string,
	'post_type' =>'news',
	'orderby' => 'menu_order',
	'order' => 'ASC',
	'posts_per_page' => 4
);
$the_query = new WP_Query($args);
if ( $the_query->have_posts() ) :
echo '<div class="search-news">';
echo '<h2>News</h2>';
while ( $the_query->have_posts() ) : $the_query->the_post(); 
	$id = get_the_id();
	$projects = get_the_terms( $id, 'project' );
	$project_ids = array();
	foreach ($projects as $project) {
		$project_ids[] = $project->term_id;
	} ?>
	<article class="loop-entry clearfix">
		<?php $source_text = get_field('source');
		if($source_text) {
			echo '<p class="date gray">';
			the_field('source');
			echo '</p>';
		} 
		$results = search($sources, 'source', $source_text);
		$logo = $results[0]['logo_id'];
		if($logo) {
			$logo_img = wp_get_attachment_image_src($logo, 'small');
			echo '<img class="logo" src="'.$logo_img[0].'" alt="'.$source_text.'" />';
		} ?>
	<?php $link = get_field('link'); 
		if($link == '') {
			$link = get_field('archive');	
			$link = $link['url'];
		}
	?>
		<h3><a target="_blank" href="<?php echo $link; ?>"> 
		<?php echo the_title(); ?></a></h3>
		<?php $project_title = get_the_title($project_ids[0]); ?>
		<div class="loop-entry-meta">
		<?php if($projects) { ?>
			<a class="all" href="">More on <?php echo $project_title; ?></a>
		<?php } ?>
		</div>
	</article>
	<?php endwhile; 
		echo '</div>';
	?>                	     
<?php else : ?>

<?php endif; ?>	
</div><!-- /search-left  -->
        
        
        
<div class="search-right">
<h2>Blog</h2>
<?php
$query_string = explode("=", $query_string);
$query_string = $query_string[1];
global $post;
$args = array(
	's' => $query_string,
	'post_type' =>'post',
	'orderby' => 'date',
	'order' => 'DESC',
	'posts_per_page' => 6
);
$the_query = new WP_Query($args);
if ( $the_query->have_posts() ) :
while ( $the_query->have_posts() ) : $the_query->the_post(); ?>        

	<article class="loop-entry clearfix">
		<p class="date gray"><?php the_time('F'); ?> <?php the_time('j'); ?>, <?php the_time('Y'); ?></p>
		<h3><a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
		<div class="loop-entry-meta">
	        <p class="date gray"><?php _e('By', 'surplus'); ?> <a href="<?php echo get_site_url(); ?>/people"><?php the_author(); ?></a>
	        <span class="awesome-icon-comments gray"></span> <?php comments_popup_link('0', '1', '%'); ?></p>
	    </div><!-- /loop-entry-meta -->
		<p><?php echo get_excerpt(100); ?></p>
	</article><!-- loop-entry -->

	<?php endwhile; ?>                	     
<?php else : ?>
	    <?php _e('No entry found for that query.', 'adapt'); ?>
<?php endif; ?>
</div><!-- /search-right  -->
<?php } ?>

<?php get_footer(); ?>