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
<!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->

<!-- Meta Tags -->
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<meta name="Description" CONTENT="<?php if (get_field('about', 2145) != "") { 
							  the_field('about', 2145);
						  	} ?>">

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

<!-- Load HTML5 dependancies for IE
================================================== -->
<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<script type="text/javascript" src="//use.typekit.net/ras6pdl.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<!-- WP Head
================================================== -->

<?php wp_head(); ?>
<script type="text/javascript">
jQuery(function($){
	$(document).ready(function(){
	 	
 	});
});

(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-2334506-6', 'esidesign.com');
ga('send', 'pageview');
</script>
</head>
<body class="home">

<div id="wrap" class="clearfix">

<div id="main" class="clearfix">