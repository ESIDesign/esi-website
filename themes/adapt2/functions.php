<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
*/


// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) 
    $content_width = 980;

/*
update_option('siteurl','http://esidesign.com');
update_option('home','http://esidesign.com');
*/

/*-----------------------------------------------------------------------------------*/
/*	Include functions
/*-----------------------------------------------------------------------------------*/
require('admin/theme-admin.php');
require('functions/pagination.php');
require('functions/shortcodes.php');
require('functions/better-comments.php');
require('functions/meta/meta-box-class.php');
require('functions/meta/meta-box-usage.php');


/*-----------------------------------------------------------------------------------*/
/*	Images
/*-----------------------------------------------------------------------------------*/
if (function_exists( 'add_theme_support')) {
	add_theme_support( 'post-thumbnails');
	
	if ( function_exists('add_image_size')) {
/* 		add_image_size( 'full-size',  9999, 9999, false ); */
/* 		add_image_size( 'full-size',  492, 358, true ); */
		add_image_size( 'slider',  1000, 568, true );
		add_image_size( 'portfolio-single',  600, 400, true );
/* 		add_image_size( 'blog',  240, 9999, false ); */
		add_image_size( 'small-thumb',  50, 50, true );
		add_image_size( 'grid-thumb',  240, 180, true );
		add_image_size( 'grid-thumb1',  115, 115, true );
		add_image_size( 'archive-project',  324, 200, true );
		add_image_size( 'notfeat-project',  656, 410, true );
/* 		add_image_size( 'grid-thumb2',  260, 353, true ); */
		add_image_size( 'grid-thumb2',  240, 370, true );
		add_image_size( 'grid-thumb3',  513, 353, true );
	}
}

add_filter( 'jpeg_quality', 'tgm_image_full_quality' );
add_filter( 'wp_editor_set_quality', 'tgm_image_full_quality' );
/**
 * Filters the image quality for thumbnails to be at the highest ratio possible.
 *
 * Supports the new 'wp_editor_set_quality' filter added in WP 3.5.
 *
 * @since 1.0.0
 *
 * @param int $quality The default quality (90)
 * @return int $quality Amended quality (100)
 */
function tgm_image_full_quality( $quality ) {

    return 100;

}

/*-----------------------------------------------------------------------------------*/
/*	Javascsript
/*-----------------------------------------------------------------------------------*/

add_action('wp_enqueue_scripts','adapt_scripts_function');
function adapt_scripts_function() {
	//get theme options
	global $options;
	
	wp_enqueue_script('jquery');	
	
	// Site wide js
	wp_enqueue_script('hoverIntent', get_template_directory_uri() . '/js/jquery.hoverIntent.minified.js');
	wp_enqueue_script('hoverIntent', get_template_directory_uri() . '/js/modernizr.video.js');
/* 	wp_enqueue_script('superfish', get_template_directory_uri() . '/js/superfish.js'); */
/* 	wp_enqueue_script('easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js'); */
	wp_enqueue_script('flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js');
/* 	wp_enqueue_script('prettyphoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js'); */
	wp_enqueue_script('uniform', get_template_directory_uri() . '/js/jquery.uniform.js');
	wp_enqueue_script('responsify', get_template_directory_uri() . '/js/jquery.responsify.init.js');

	if(is_post_type_archive( 'project' )) {
		wp_enqueue_script('isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js');
		wp_enqueue_script('isotope_init', get_template_directory_uri() . '/js/isotope_init.js');
	}

	if(is_home()) {
		wp_enqueue_script('custom', get_template_directory_uri() . '/js/home.js');
		wp_enqueue_script('custom', get_template_directory_uri() . '/js/jquery.cookie.js');
	}
	else {
		wp_enqueue_script('custom', get_template_directory_uri() . '/js/custom.js');
	}
}


/*-----------------------------------------------------------------------------------*/
/*Enqueue CSS
/*-----------------------------------------------------------------------------------*/
add_action('wp_enqueue_scripts', 'adapt_enqueue_css');
function adapt_enqueue_css() {
	
	//responsive
	wp_enqueue_style('responsive', get_template_directory_uri() . '/css/responsive.css', 'style');
	
	//prettyPhoto
/* 	wp_enqueue_style('prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css', 'style'); */

	//awesome font - icon fonts
	wp_enqueue_style('awesome-font', get_template_directory_uri() . '/css/awesome-font.css', 'style');
	
}


/*-----------------------------------------------------------------------------------*/
/*	Sidebars
/*-----------------------------------------------------------------------------------*/

//Register Sidebars
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Home',
		'id' => 'home',
		'description' => __('Widgets in this area will be shown on the homepage.','adapt'),
		'before_widget' => '<div class="sidebar-box clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h3><span>',
		'after_title' => '</span></h3>',
));

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'About',
		'id' => 'about',
		'description' => __('Widgets in this area will be shown on the about page.','adapt'),
		'before_widget' => '<div class="sidebar-box clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h3><span>',
		'after_title' => '</span></h3>',
));

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Process',
		'id' => 'process',
		'description' => __('Widgets in this area will be shown on the process page.','adapt'),
		'before_widget' => '<div class="process_%1$s">',
		'after_widget'  => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
));

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Sidebar',
		'id' => 'sidebar',
		'description' => __('Widgets in this area will be shown in the sidebar.','adapt'),
		'before_widget' => '<div class="sidebar-box clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h3><span>',
		'after_title' => '</span></h3>',
));
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Footer One',
		'id' => 'footer-one',
		'description' => __('Widgets in this area will be shown in the first footer area.','adapt'),
		'before_widget' => '<div id="links">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
));
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Footer Two',
		'id' => 'footer-two',
		'description' => __('Widgets in this area will be shown in the second footer area.','adapt'),
		'before_widget' => '<div id="social-media">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
));


/*-----------------------------------------------------------------------------------*/
/*	Custom Post Types & Taxonomies
/*-----------------------------------------------------------------------------------*/
add_action('init', 'custom_post_types_register');
function custom_post_types_register() {
 
	$labels = array(
		'name' => _x('Projects', 'post type general name'),
		'singular_name' => _x('Project', 'post type singular name'),
		'add_new' => _x('Add New', 'project'),
		'add_new_item' => __('Add New project'),
		'edit_item' => __('Edit project'),
		'new_item' => __('New project'),
		'view_item' => __('View projects'),
		'search_items' => __('Search projects'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => __('Parent'),
		'parent' => __('Parent')
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
/* 		'menu_icon' => get_stylesheet_directory_uri() . '/article16.png', */
		'rewrite' => true,
		'capability_type' => 'page',
		'hierarchical' => true,
		'menu_position' => null,
		'supports' => array('title', 'author', 'editor','thumbnail', 'page-attributes', 'revisions', 'excerpt'),
		'taxonomies' => array('project_cats'),
		'has_archive' => true,
		'rewrite' => array( 'slug' => 'work' ),
	  ); 
	  flush_rewrite_rules( true );

	register_post_type( 'project' , $args );
	
	
	$careers_labels = array(
		'name' => _x('Careers', 'post type general name'),
		'singular_name' => _x('Career', 'post type singular name'),
		'add_new' => _x('Add New', 'career'),
		'add_new_item' => __('Add New Career'),
		'edit_item' => __('Edit Career'),
		'new_item' => __('New Career'),
		'view_item' => __('View Career'),
		'search_items' => __('Search Careers'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => __('Parent'),
		'parent' => __('Parent')
	);
 
	$careers_args = array(
		'labels' => $careers_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
/* 		'menu_icon' => get_stylesheet_directory_uri() . '/article16.png', */
		'rewrite' => true,
		'capability_type' => 'page',
		'hierarchical' => true,
		'menu_position' => null,
		'supports' => array('title', 'author', 'editor','thumbnail', 'page-attributes', 'revisions', 'excerpt'),
/* 		'taxonomies' => array('post_tag'), */
		'has_archive' => true,
		'rewrite' => array( 'slug' => 'careers' ),
	  ); 
	  flush_rewrite_rules( true );

	register_post_type( 'careers' , $careers_args );

	flush_rewrite_rules( true );
}


// Add taxonomies
add_action( 'init', 'project_create_taxonomies' );
flush_rewrite_rules();
function project_create_taxonomies() {
	
// portfolio taxonomies
	$cat_labels = array(
		'name' => __( 'Project Categories', '' ),
		'singular_name' => __( 'Project Category', '' ),
		'search_items' =>  __( 'Search Project Categories', '' ),
		'all_items' => __( 'All Project Categories', '' ),
		'parent_item' => __( 'Parent Project Category', '' ),
		'parent_item_colon' => __( 'Parent Project Category:', '' ),
		'edit_item' => __( 'Edit Project Category', '' ),
		'update_item' => __( 'Update Project Category', '' ),
		'add_new_item' => __( 'Add New Project Category', '' ),
		'new_item_name' => __( 'New Project Category Name', '' ),
		'choose_from_most_used'	=> __( 'Choose from the most used project categories', '' )
	); 	

	register_taxonomy('project_cats','project',array(
		'hierarchical' => true,
		'labels' => $cat_labels,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'project-category' ),
	));
	
}


/*-----------------------------------------------------------------------------------*/
/*	Portfolio Cat Pagination
/*-----------------------------------------------------------------------------------*/

// Set number of posts per page for taxonomy pages
$option_posts_per_page = get_option( 'posts_per_page' );
add_action( 'init', 'my_modify_posts_per_page', 0);
function my_modify_posts_per_page() {
    add_filter( 'option_posts_per_page', 'my_option_posts_per_page' );
}
function my_option_posts_per_page( $value ) {
	global $option_posts_per_page;
	
    if ( is_tax( 'portfolio_cats') ) {
        return 12;
    }
	else {
        return $option_posts_per_page;
    }
}


/*-----------------------------------------------------------------------------------*/
/*	Other functions
/*-----------------------------------------------------------------------------------*/

add_action( 'init', 'my_add_excerpts_to_pages' );
function my_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}


function kc_attachment_taxonomies() {
	$taxonomies = array( 'post_tag' );
	foreach ( $taxonomies as $tax )
		register_taxonomy_for_object_type( $tax, 'attachment' );
}
add_action( 'init', 'kc_attachment_taxonomies' );

function kc_attachment_fields_to_edit( $fields, $post ) {
	$taxonomies = get_attachment_taxonomies( $post );
	if ( empty($taxonomies) )
		return $fields;

	foreach ( $taxonomies as $tax ) {
		$tax_object = (array) get_taxonomy( $tax );
		if ( !$tax_object['public'] )
			continue;
		if ( empty($tax_object['label']) )
			$tax_object['label'] = $tax;
		if ( empty($t['args']) )
			$tax_object['args'] = array();

		$att_terms = array();
		$post_terms = get_object_term_cache( $post->ID, $tax );
		if ( empty($post_terms) )
			$post_terms = wp_get_object_terms( $post->ID, $tax, $tax_object['args'] );
		if ( !empty($post_terms) )
			foreach ( $post_terms as $post_term )
				$att_terms[$post_term->term_id] = $post_term->name;

		$tax_terms = get_terms( $tax, array('hide_empty' => false) );

		$html = "<ul class='attachment-terms-list'>\n";

		if ( !empty($tax_terms) )
			foreach ( $tax_terms as $term )
				$html .= "\t<li><label><input type='checkbox' name='attachments[{$post->ID}][{$tax}][]' value='{$term->name}' ".checked(array_key_exists($term->term_id, $att_terms), true, false)." /> {$term->name}</label></li>\n";

		$html .= "\t<li><input type='text' name='attachments[{$post->ID}][{$tax}][]' /></label></li>\n";
		$html .= "</ul>\n";


		$fields[$tax]['input'] = 'html';
		$fields[$tax]['html'] = $html;
		$fields[$tax]['helps'] = __( sprintf('Check/uncheck existing %s, or add new one(s), separated by commas.', $fields[$tax]['label']) );
	}

	return $fields;
}
add_filter( 'attachment_fields_to_edit', 'kc_attachment_fields_to_edit', 10, 2 );

function kc_attachment_fields_data() {
	if ( empty($_POST['attachments']) )
		return;

	foreach ( $_POST['attachments'] as $id => $data ) {
		$taxonomies = get_attachment_taxonomies( $id );
		if ( empty($taxonomies) )
			continue;

		foreach ( $taxonomies as $tax )
			if ( isset($data[$tax]) )
				$_POST['attachments'][$id][$tax] = trim( join(',', $data[$tax]) );
	}
}
add_action( 'init', 'kc_attachment_fields_data' );

  


//add feeds
add_theme_support( 'automatic-feed-links' );

// Limit Post Word Count
add_filter('excerpt_length', 'new_excerpt_length');
function new_excerpt_length($length) {
	return 30;
}

//Replace Excerpt Link
add_filter('excerpt_more', 'new_excerpt_more');
function new_excerpt_more($more) {
       global $post;
	return '...';
}

//custom excerpts
function excerpt($limit) {
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'...';
	} else {
		$excerpt = implode(" ",$excerpt);
	}
	$excerpt = preg_replace('`[[^]]*]`','',$excerpt);
	return $excerpt;
}

// Enable Custom Background
add_theme_support( 'custom-background' );

// register navigation menus
register_nav_menus( array( 'menu'=>__('Menu') ) );

/// add home link to menu
add_filter( 'wp_page_menu_args', 'home_page_menu_args' );
function home_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}

/* Remove toolbar */
show_admin_bar(false);

// menu fallback
function default_menu() {
	require_once (get_template_directory() . '/includes/default-menu.php');
}


// Localization Support
load_theme_textdomain( 'adapt', get_template_directory() .'/lang' );

//create featured image column
// GET FEATURED IMAGE
function ST4_get_featured_image($post_ID) {
	$post_thumbnail_id = get_post_thumbnail_id($post_ID);
	if ($post_thumbnail_id) {
		$post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'small-thumb');
		return $post_thumbnail_img[0];
	}
}
// ADD NEW COLUMN
function ST4_columns_head($defaults) {
	$defaults['featured_image'] = 'Featured Image';
	return $defaults;
}

// SHOW THE FEATURED IMAGE
function ST4_columns_content($column_name, $post_ID) {
	if ($column_name == 'featured_image') {
		$post_featured_image = ST4_get_featured_image($post_ID);
		if ($post_featured_image) {
			echo '<img src="' . $post_featured_image . '" />';
		}
	}
}

// Project Columns
function project_columns_head($defaults) {
	$defaults['project_cats'] = 'Project Categories';
	$defaults['year'] = 'Year';
	return $defaults;
}

// Project Columns
function project_columns_content($column_name, $post_ID) {
	if ($column_name == 'project_cats') {
	$terms = get_the_term_list( $post_id , 'project_cats' , '' , ',' , '' );
            if ( is_string( $terms ) ) {
	            echo $terms;
            }
	}
	if ($column_name == 'year') {
	            echo get_field('date', $post_id);
	}
}


add_filter('manage_posts_columns', 'ST4_columns_head');
add_action('manage_posts_custom_column', 'ST4_columns_content', 10, 2);
add_action('manage_project_posts_custom_column', 'ST4_columns_content', 10, 2);

add_filter('manage_project_posts_columns', 'project_columns_head');
add_action('manage_project_posts_custom_column', 'project_columns_content', 10, 2);


add_action( 'admin_menu', 'default_published_wpse_91299' );

function default_published_wpse_91299() 
{
    global $submenu;

    // OTHER POST TYPES
    $cpt = array( 'careers', 'page', 'project' ); // <--- remove or adapt the portfolio post type
    foreach( $cpt as $pt )
    {
        foreach( $submenu[ 'edit.php?post_type=' . $pt ] as $key => $value )
        {
            if( in_array( 'edit.php?post_type=' . $pt, $value ) )
            {
                $submenu[ 'edit.php?post_type='.$pt ][ $key ][2] = 'edit.php?post_status=publish&post_type=' . $pt;
            }
        }   
    }
}



// Change post types for the gallery-metabox plugin
if ( !function_exists( 'custom_be_gallery_metabox_post_types' ) ) :
	function custom_be_gallery_metabox_post_types( $classes ) {
			return array('portfolio', 'services');
	}
	add_filter( 'be_gallery_metabox_post_types', 'custom_be_gallery_metabox_post_types' );
endif;

/* More User Fields */
add_action( 'show_user_profile', 'dept_user_profile_fields' );
add_action( 'edit_user_profile', 'dept_user_profile_fields' );

function dept_user_profile_fields( $user ) { ?>

<table class="form-table">
    <tr>
        <th><label for="dropdown">Department</label></th>
        <td>
            <?php 
            //get dropdown saved value
            $selected = get_the_author_meta( 'dept', $user->ID ); //there was an extra ) here that was not needed 
            ?>
	<select name="dept" id="dept">
		<option value="Administration" <?php echo ($selected == "Administration")?  'selected="selected"' : '' ?>>Administration</option>
		<option value="Creative Strategy" <?php echo ($selected == "Creative Strategy")?  'selected="selected"' : '' ?>>Creative Strategy</option>
		<option value="Marketing" <?php echo ($selected == "Marketing")?  'selected="selected"' : '' ?>>Marketing</option>
		<option value="Physical" <?php echo ($selected == "Physical")?  'selected="selected"' : '' ?>>Physical</option>
		<option value="Project Management" <?php echo ($selected == "Project Management")?  'selected="selected"' : '' ?>>Project Management</option>
		<option value="Technology & Media" <?php echo ($selected == "Technology & Media")?  'selected="selected"' : '' ?>>Technology & Media</option>
		<option value="Visual" <?php echo ($selected == "Visual")?  'selected="selected"' : '' ?>>Visual</option>
		<option value="Writing" <?php echo ($selected == "Writing")?  'selected="selected"' : '' ?>>Writing</option>
	</select>
            <span class="description">What department are you in at ESI?</span>
        </td>
    </tr>
    
        <tr>
        <th><label for="dropdown">Position</label></th>
        <td>
            <input type="text" name="position" id="position" class="regular-text" 
            value="<?php echo esc_attr( get_the_author_meta( 'position', $user->ID ) ); ?>" />
        </td>
    </tr>
    
    <tr>
        <th><label for="check">Director</label></th>
        <td>
        <?php 
            //get dropdown saved value
            $checked = get_the_author_meta( 'director', $user->ID ); //there was an extra ) here that was not needed 
            ?>
        <input type="checkbox" name="director" <?php if ($checked == 'on') { echo 'checked'; } ?>> Director</input>
        </td>
        </tr>
    
    <tr>
        <th><label for="check">Leadership</label></th>
        <td>
        <?php 
            //get dropdown saved value
            $checked = get_the_author_meta( 'leadership', $user->ID ); //there was an extra ) here that was not needed 
            ?>
        <input type="checkbox" name="leadership" <?php if ($checked == 'on') { echo 'checked'; } ?>> Leadership</input>
        </td>
        </tr>
</table>
<?php }

add_action( 'personal_options_update', 'save_dept_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_dept_user_profile_fields' );

function save_dept_user_profile_fields( $user_id ) {

if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }

update_user_meta( $user_id, 'dept', $_POST['dept'] );
update_user_meta( $user_id, 'position', $_POST['position'] );
update_user_meta( $user_id, 'director', $_POST['director'] );
update_user_meta( $user_id, 'leadership', $_POST['leadership'] );

}

function remove_contactmethod( $contactmethods ) {
  unset($contactmethods['aim']);
  unset($contactmethods['jabber']);
  unset($contactmethods['yim']);
  return $contactmethods;
}
add_filter('user_contactmethods','remove_contactmethod',10,1);

/*
 * Corrects count in term_taxonomy table for terms which are are not in published posts
 */

add_action('edited_term_taxonomy','yoursite_edited_term_taxonomy',10,2);
function yoursite_edited_term_taxonomy($term,$taxonomy) {
  global $wpdb,$post;
  //in quick edit mode, $post is an array()
  //in full edit mode $post is an object
  if ( is_array( $post ))
    $posttype=$post['post_type'];
  else
    $posttype=$post->post_type;
  if ($posttype) {
    $DB_prefix=$wpdb->get_blog_prefix(BLOG_ID_CURRENT_SITE);
    $sql = "UPDATE ".$DB_prefix."term_taxonomy tt
          SET count =
          (SELECT count(p.ID) FROM  ".$DB_prefix."term_relationships tr
          LEFT JOIN ".$DB_prefix."posts p
          ON (p.ID = tr.object_id AND p.post_type = '".$posttype."' AND p.post_status = 'publish')
          WHERE tr.term_taxonomy_id = tt.term_taxonomy_id)
          WHERE tt.taxonomy = '".$taxonomy->name."'
      ";
    $wpdb->query($sql);
  }
}

function get_the_category_bytax( $id = false, $tcat = 'category' ) {
    $categories = get_the_terms( $id, $tcat );
    if ( ! $categories )
        $categories = array();

    $categories = array_values( $categories );

    foreach ( array_keys( $categories ) as $key ) {
        _make_cat_compat( $categories[$key] );
    }

    // Filter name is plural because we return alot of categories (possibly more than #13237) not just one
    return apply_filters( 'get_the_categories', $categories );
}


function get_avatar_url($get_avatar){
/*     preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $get_avatar, $matches); */
 	preg_match('/< *img[^>]*src *= *["\']?([^&\']*)/i', $get_avatar, $matches); 
/* @^(?:http://)?([^/]+)@i */
    return $matches[1];
}


function ucc_get_terms( $id = '' ) {
  global $post;
 
  if ( empty( $id ) )
    $id = $post->ID;
 
  if ( !empty( $id ) ) {
    $post_taxonomies = array();
    $post_type = get_post_type( $id );
    $taxonomies = get_object_taxonomies( $post_type , 'names' );
 
    foreach ( $taxonomies as $taxonomy ) {
      $term_links = array();
      $terms = get_the_terms( $id, $taxonomy );
 
      if ( is_wp_error( $terms ) )
        return $terms;
 
      if ( $terms ) {
        foreach ( $terms as $term ) {
          $link = get_term_link( $term, $taxonomy );
          if ( is_wp_error( $link ) )
            return $link;
          $term_links[] = '<a href="' . $link . '" rel="' . $taxonomy . '">' . $term->name . '</a>';
        }
      }
 
      $term_links = apply_filters( "term_links-$taxonomy" , $term_links );
      $post_terms[$taxonomy] = $term_links;
    }
    return $post_terms;
  } else {
    return false;
  }
}

function gradient_function($image) {
/*
	    echo 'background-image: -moz-linear-gradient(top,  rgba(0,0,0,0) 58%, rgba(0,0,0,0.65) 99%), url('.$image.'); '; 
echo 'background-image: background: -webkit-gradient(linear, left top, left bottom, color-stop(58%,rgba(0,0,0,0)), color-stop(99%,rgba(0,0,0,0.65))), url('.$image.'); '; 
echo 'background-image: -webkit-linear-gradient(top,  rgba(0,0,0,0) 58%,rgba(0,0,0,0.65) 99%), url('.$image.'); '; 
echo 'background-image: -o-linear-gradient(top,  rgba(0,0,0,0) 58%,rgba(0,0,0,0.65) 99%), url('.$image.'); '; 
echo 'background-image: -ms-linear-gradient(top,  rgba(0,0,0,0) 58%,rgba(0,0,0,0.65) 99%), url('.$image.'); '; 
echo 'background-image: linear-gradient(to bottom,  rgba(0,0,0,0) 58%,rgba(0,0,0,0.65) 99%), url('.$image.'); '; 
echo 'filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#00000000", endColorstr="#a6000000",GradientType=0 ), url('.$image.'); '; 
*/
/*
	    echo 'background-image: -moz-linear-gradient(top, rgba(0,0,0,0) 15%, rgba(0,0,0,0.65) 99%, rgba(0,0,0,0.65) 100%), url('.$image.'); '; 
echo 'background-image: -webkit-gradient(linear, left top, left bottom, color-stop(15%,rgba(0,0,0,0)), color-stop(99%,rgba(0,0,0,0.65)), color-stop(100%,rgba(0,0,0,0.65))), url('.$image.'); '; 
echo 'background-image: -webkit-linear-gradient(0,0,0,0) 15%,rgba(0,0,0,0.65) 99%,rgba(0,0,0,0.65) 100%), url('.$image.'); '; 
echo 'background-image: -o-linear-gradient(top, rgba(0,0,0,0) 15%,rgba(0,0,0,0.65) 99%,rgba(0,0,0,0.65) 100%), url('.$image.'); '; 
echo 'background-image: -ms-linear-gradient(top, rgba(0,0,0,0) 15%,rgba(0,0,0,0.65) 99%,rgba(0,0,0,0.65) 100%), url('.$image.'); '; 
echo 'background-image: linear-gradient(to bottom, rgba(0,0,0,0) 15%,rgba(0,0,0,0.65) 99%,rgba(0,0,0,0.65) 100%), url('.$image.'); '; 
echo 'filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#00000000", endColorstr="#a6000000",GradientType=0 ), url('.$image.'); '; 
*/
/*
	    echo 'background-image: -moz-linear-gradient(top, rgba(0,0,0,0) 45%, rgba(0,0,0,0.5) 81%, rgba(0,0,0,0.7) 100%), url('.$image.'); '; 
echo 'background-image: -webkit-gradient(linear, left top, left bottom, color-stop(45%,rgba(0,0,0,0)), color-stop(81%,rgba(0,0,0,0.5)), color-stop(100%,rgba(0,0,0,0.7))), url('.$image.'); '; 
echo 'background-image: -webkit-linear-gradient(top, rgba(0,0,0,0) 45%,rgba(0,0,0,0.5) 81%,rgba(0,0,0,0.7) 100%), url('.$image.'); '; 
echo 'background-image: -o-linear-gradient(top, rgba(0,0,0,0) 45%,rgba(0,0,0,0.5) 81%,rgba(0,0,0,0.7) 100%), url('.$image.'); '; 
echo 'background-image: -ms-linear-gradient(top, rgba(0,0,0,0) 45%,rgba(0,0,0,0.5) 81%,rgba(0,0,0,0.7) 100%), url('.$image.'); '; 
echo 'background-image: linear-gradient(to bottom, rgba(0,0,0,0) 45%,rgba(0,0,0,0.5) 81%,rgba(0,0,0,0.7) 100%), url('.$image.'); '; 
echo 'filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#00000000", endColorstr="#a6000000",GradientType=0 ), url('.$image.'); '; 
*/
	    echo 'background-image: -moz-linear-gradient(top, rgba(0,0,0,0) 55%, rgba(0,0,0,0.6) 78%, rgba(0,0,0,0.75) 100%), url('.$image.'); '; 
echo 'background-image: -webkit-gradient(linear, left top, left bottom, color-stop(55%,rgba(0,0,0,0)), color-stop(78%,rgba(0,0,0,0.6)), color-stop(100%,rgba(0,0,0,0.75))), url('.$image.'); '; 
echo 'background-image: -webkit-linear-gradient(top, rgba(0,0,0,0) 55%,rgba(0,0,0,0.6) 78%,rgba(0,0,0,0.75) 100%), url('.$image.'); '; 
echo 'background-image: -o-linear-gradient(top, rgba(0,0,0,0) 55%,rgba(0,0,0,0.6) 78%,rgba(0,0,0,0.75) 100%), url('.$image.'); '; 
echo 'background-image: -ms-linear-gradient(top, rgba(0,0,0,0) 55%,rgba(0,0,0,0.6) 78%,rgba(0,0,0,0.75) 100%), url('.$image.'); '; 
echo 'background-image: linear-gradient(to bottom, rgba(0,0,0,0) 55%,rgba(0,0,0,0.6) 78%,rgba(0,0,0,0.75) 100%), url('.$image.'); '; 
echo 'filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#00000000", endColorstr="#a6000000",GradientType=0 ), url('.$image.'); '; 

	    } 
add_action('gradient', 'gradient_function', 10, 1);	    
 
function ucc_get_terms_list( $id = '' , $echo = true ) {
  global $post;
 
  if ( empty( $id ) )
    $id = $post->ID;
 
  if ( !empty( $id ) ) {
    $my_terms = ucc_get_terms( $id );
    if ( $my_terms ) {
      $my_taxonomies = array();
      foreach ( $my_terms as $taxonomy => $terms ) {
        $my_taxonomy = get_taxonomy( $taxonomy );
        if ( !empty( $terms ) )          $my_taxonomies[] = '<span class="' . $my_taxonomy->name . '-links">' . '<span class="entry-utility-prep entry-utility-prep-' . $my_taxonomy->name . '-links">' . $my_taxonomy->labels->name . ': ' . implode( $terms , ', ' ) . '</span></span>';
      }
 
      if ( !empty( $my_taxonomies ) ) {
        $output = '<ul>' . "\n";
        foreach ( $my_taxonomies as $my_taxonomy ) {
          $output .= '<li>' . $my_taxonomy . '</li>' . "\n";
        }
        $output .= '</ul>' . "\n";
      }
 
      if ( $echo )
        echo $output;
      else
        return $output;
    } else {
      return;
    }
  } else {
    return false;
  } 
} 