<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 */
$options = get_option( 'adapt_theme_settings' );
?>
<!DOCTYPE html>
<html>
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
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
</head>
<body class="author">
		<?php
        if(isset($_GET['author_name'])) :
        $curauth = get_userdatabylogin($author_name);
        else :
        $curauth = get_userdata(intval($author));
        endif;
        ?>
        <?php
        
		// Set default avatar (values = default, wavatar, identicon, monsterid)
		$avatar = 'wavatar';

	if(userphoto_exists($curauth->ID))
    userphoto($curauth->ID);
    else
	echo '<div class="author-img">'.get_avatar($curauth->user_email, '158', $avatar).'</div>'; 
	?> 
        <h1 class="purple"><?php echo $curauth->display_name; ?></h1>		

	<h3><?php echo $curauth->position; ?></h3>
		<p>
		<?php echo $curauth->description; ?>
	</p>

<!-- END #post -->
<script type="text/javascript" src="//use.typekit.net/jrd6ldj.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
</body>
</html>
 