<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 * Template Name: Approach
 */
?>

<?php get_header(); ?>
<div class="approach-wrap clearfix">

<div class="approach_title">
	<h1><?php the_title(); ?></h1>
	<h3><?php
			if (get_field('headline') != "") { 
				echo get_field("headline");
			} ?>
	</h3>
</div>

<div class="approach_title_imgs">
<?php if (get_field('headline_img1') != "") { 
		$image = wp_get_attachment_image_src( get_field('headline_img1'), 'grid-thumb');
		echo '<img src="'.$image[0].'"/>';
	}
	if (get_field('headline_img2') != "") { 
		$image = wp_get_attachment_image_src( get_field('headline_img2'), 'grid-thumb');
		echo '<img src="'.$image[0].'"/>';
	} ?>
</div>
	        
<div class="approach1">
<?php			
if (get_field('module1_img') != "") { 
	$image = wp_get_attachment_image_src( get_field('module1_img'), 'slider');
	echo '<article class="one"><span class="gradient" style="';
	do_action('gradient', $image[0]);
	echo '">Image</span>';
}
if (get_field('module1') != "") { 
	echo '<div><h1>';
	echo get_field("module1_title");
	echo '</h1><h3>';
	echo strip_tags(get_field("module1"));
	echo '</h3></div></article>';
} ?>
</div>

<div class="approach2">
<?php
if (get_field('module2') != "") { 
	echo '<article class="two"><div><h1>';
	echo get_field("module2_title");
	echo '</h1><h3>';
	echo strip_tags(get_field("module2"));
	echo '</h3></div></article>';
} 
if (get_field('module2_img') != "") { 
	$image = wp_get_attachment_image_src( get_field('module2_img'), 'grid-thumb3');
	echo '<article class="two"><img src="'.$image[0].'"/><span class="bottom-gradient"></span></article>';
} ?>
</div>
	                
<div class="approach3">
<?php			
	if (get_field('module3_img') != "") { 
		$image = wp_get_attachment_image_src( get_field('module3_img'), 'slider');
		echo '<article class="one"><span class="gradient" style="';
		do_action('gradient', $image[0]);
		echo '">Image</span>';
	}
	if (get_field('module3') != "") { 
		echo '<div><h1>';
		echo get_field("module3_title");
		echo '</h1><h3>';
		echo strip_tags(get_field("module3"));
		echo '</h3></div></article>';
	} ?>
</div>
	                
<div class="approach4">
<?php
	if (get_field('module4_img') != "") { 
		$image = wp_get_attachment_image_src( get_field('module4_img'), 'grid-thumb');
		$image2 = wp_get_attachment_image_src( get_field('module4_img3'), 'grid-thumb');
		echo '<article class="three"><img src="'.$image[0].'"/><img src="'.$image2[0].'"/></article>';
	}
	if (get_field('module4') != "") { 
		echo '<article class="three"><div><h1>';
		echo get_field("module4_title");
		echo '</h1><h3>';
		echo strip_tags(get_field("module4"));
		echo '</h3></div></article>';
	}
	if (get_field('module4_img') != "") { 
		$image3 = wp_get_attachment_image_src( get_field('module4_img2'), 'grid-thumb2');
		echo '<article class="three"><img src="'.$image3[0].'"/></article>';
	}?>
</div>
	                
<div class="approach5_6">
	<div class="approach5">
		<?php
			if (get_field('module5_img') != "") { 
			$image = wp_get_attachment_image_src( get_field('module5_img'), 'grid-thumb3');
			echo '<article class="two"><span class="gradient" style="';
			do_action('gradient', $image[0]);
			echo '">Image</span>';
		}
		if (get_field('module5') != "") { 
			echo '<div><h1>';
			echo get_field("module5_title");
			echo '</h1><h3>';
			echo strip_tags(get_field("module5"));
			echo '</h3></div></article>';
		} ?>
	</div>

	<div class="approach6">
		<?php
		if (get_field('module6_img') != "") { 
			$image = wp_get_attachment_image_src( get_field('module6_img'), 'grid-thumb3');
			echo '<article class="two"><span class="gradient" style="';
			do_action('gradient', $image[0]);
			echo '">Image</span>';
		}
		if (get_field('module6') != "") { 
			echo '<div><h1>';
			echo get_field("module6_title");
			echo '</h1><h3>';
			echo strip_tags(get_field("module6"));
			echo '</h3></div></article>';
		} ?>
	</div>
</div>
	                
	                
<div class="approach7">
    <?php
		if (get_field('module7_img') != "") { 
			$project_thumb = wp_get_attachment_image_src( get_field('module7_img'), 'grid-thumb3');
			echo '<article class="two"><img src="'.$project_thumb[0].'"/></article>';
		}
		if (get_field('module7') != "") { 
			echo '<article class="two"><div><h1>';
			echo get_field("module7_title");
			echo '</h1><h3>';
			echo strip_tags(get_field("module7"));
			echo '</h3></div></article>';
		} ?>
</div>
    
<div class="approach8">
<?php
	if (get_field('module8_img') != "") { 
	$image = wp_get_attachment_image_src( get_field('module8_img'), 'slider');
		echo '<article class="one"><span class="gradient" style="';
	do_action('gradient', $image[0]);
	echo '">Image</span>';
	}
	if (get_field('module8') != "") { 
		echo '<div><h1>';
		echo get_field("module8_title");
		echo '</h1><h3>';
		echo strip_tags(get_field("module8"));
		echo '</h3></div></article>';
	} ?>
</div>
             
	                
</div>
                    


<script type="text/javascript">
jQuery(function($){
    
	$(document).ready(function(){

	jQuery('.textwidget p').unwrap();
    $('span').hide().delay(600).fadeIn();
	var paras = $('div').hide();
	$('div#wrap').show();
	$('div#main').show();
	$('div#logo').show();
	$('.st-content').show();
	$('div.menu-primary-nav-container').show();
	$('div.approach-wrap').show();
    i = 3;

// If using jQuery 1.3 or lower, you need to do $(paras[i++] || []) to avoid an "undefined" error
(function() {
  $(paras[i++]).fadeIn(150, arguments.callee);
})();
	});
});
</script>
<?php get_footer(); ?>