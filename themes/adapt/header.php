<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 */
$options = get_option( 'adapt_theme_settings' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<!-- Mobile Specific
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- Meta Tags -->
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="description" content="
<?php if (have_posts() && is_single() OR is_page()):while(have_posts()):the_post();
$out_excerpt = str_replace(array("\r\n", "\r", "\n"), "", get_the_excerpt());
echo apply_filters('the_excerpt_rss', $out_excerpt);
endwhile;
endif; ?>" />
<!-- Title Tag
================================================== -->
<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' |'; } ?> <?php bloginfo('name'); ?></title>
    
<?php if(!empty($options['favicon'])) { ?>
<!-- Favicon
================================================== -->
<link rel="icon" type="image/png" href="<?php echo $options['favicon']; ?>" />
<?php } ?>

<!-- Main CSS
================================================== -->
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />

<script src="//use.typekit.net/jrd6ldj.js"></script>
<script>try{Typekit.load();}catch(e){}</script>
<!-- WP Head
================================================== -->
<?php wp_head(); ?>
<?php include('analytics.php'); ?>
</head>
<body <?php body_class(); ?>>

<div id="wrap" class="clearfix">

    <header id="masterhead" class="clearfix">
            <div id="logo">
                <?php
                    if($options['upload_mainlogo'] !='') { ?>
                        <a href="<?php bloginfo( 'url' ); ?>/" title="<?php bloginfo( 'name' ); ?>"><img src="<?php echo $options['upload_mainlogo']; ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
                    <?php } else { ?>
                    <a href="<?php bloginfo( 'url' ); ?>/" title="<?php bloginfo( 'name' ) ?>"><?php bloginfo( 'name' ); ?></a>
                <?php } ?>
                
            </div>
            <!-- END logo -->
            
            <nav id="masternav" class="clearfix">
                <?php wp_nav_menu( array(
                    'theme_location' => 'menu',
                    'sort_column' => 'menu_order',
                    'menu_class' => 'sf-menu',
                    'fallback_cb' => 'default_menu'
                )); ?>
            </nav>
            <!-- /masternav -->
            
            	<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
        <input type="text" value="" name="s" id="s" />
<!--         <div class="search_button"></div> -->
<!--         <input type="submit" id="searchsubmit"/> -->
</form>
                  
    </header><!-- /masterhead -->
    
<div id="main" class="clearfix">