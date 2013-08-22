<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 * Template Name: Process New
 */
?>

<?php get_header(); ?>
<div class="process-wrap clearfix">

<div class="process_title">
<h1><?php the_title(); ?></h1>
<h3><?php
		if (get_field('headline') != "") { 
			the_field("headline");
	} ?></h3>
</div>

    	<?php   
        	$id = get_the_ID();
            //attachement loop
            $args = array(
                'orderby' => 'rand',
				'post_type' => 'attachment',
				'post_parent' => 2,
				'post_mime_type' => 'image',
				'post_status' => null,
				'posts_per_page' => -1,
				'order' => 'ASC'
            );
            $attachments = get_posts($args);
			
			//attachments count
			$attachments_count = count($attachments);
			$count = 0;
            //start loop
	            foreach ($attachments as $attachment) :
	            $count++;
	            //get images
	            $grid_thumb = wp_get_attachment_image_src( $attachment->ID, 'grid-thumb');
	            $grid_thumb1 = wp_get_attachment_image_src( $attachment->ID, 'grid-thumb1');
	            $grid_thumb3 = wp_get_attachment_image_src( $attachment->ID, 'grid-thumb3');  ?>
                            
                 <?php if ($count == '1') { ?>   
                 	<div class="process_item7">
                    <img src="<?php echo $grid_thumb3[0]; ?>" alt="<?php echo apply_filters('the_title', $attachment->post_title); ?>" />
                 	</div>
                          

					<?php } ?>
					
					
	    <?php endforeach; ?>
	    
	    <div class="approach_principles">
	    
	    <div class="approach_intro">
	    <?php if (get_field('principle1') != "") { 
							echo '<h2>';
							echo get_field("principle1");
							echo '<h2>';
					} ?>
	    </div>
	          
	                <div class="approach1">
			        <?php			
						if (get_field('module1_img') != "") { 
						$project_thumb = wp_get_attachment_image_src( get_field('module1_img'), 'grid-thumb');
						echo '<article class="left"><img src="'.$project_thumb[0].'"/></article>';
						}

						if (get_field('module1') != "") { 
							echo '<article class="right"><h2>';
							echo get_field("module1_title");
							echo '</h2><h3>';
							echo strip_tags(get_field("module1"));
							echo '</h3></article>';
					} ?>
	                </div>
	                
	                <div class="approach2">
			        <?php
						if (get_field('module2') != "") { 
							echo '<article class="left"><h2>';
							echo get_field("module2_title");
							echo '</h2><h3>';
							echo strip_tags(get_field("module2"));
							echo '</h3></article>';
						} 
					if (get_field('module2_img') != "") { 
						$project_thumb = wp_get_attachment_image_src( get_field('module2_img'), 'grid-thumb1');
							echo '<article class="right"><section class="grid1"><img src="'.$project_thumb[0].'"/></section>';
							echo '<section class="grid"><img src="'.$project_thumb[0].'"/></section>';
							echo '<section class="grid1"><img src="'.$project_thumb[0].'"/></section>';
							echo '<section class="grid"><img src="'.$project_thumb[0].'"/></figure></article>';
							
							}
						?>
	                </div>
	                
	                <div class="approach3">
			        <?php
						if (get_field('module3_img') != "") { 
						$project_thumb = wp_get_attachment_image_src( get_field('module3_img'), 'grid-thumb');
							echo '<article class="left"><img src="'.$project_thumb[0].'"/></article>';
						}
						if (get_field('module3') != "") { 
							echo '<article class="right"><h2>';
							echo get_field("module3_title");
							echo '</h2><h3>';
							echo strip_tags(get_field("module3"));
							echo '</h3></article>';
					} ?>
	                </div>
	                
	               
	               	<div class="approach4">
			        <?php
						if (get_field('module4') != "") { 
							echo '<article class="left"><h2>';
							echo get_field("module4_title");
							echo '</h2><h3>';
							echo strip_tags(get_field("module4"));
							echo '</h3></article>';
						}
						if (get_field('module4_img') != "") { 
						$project_thumb = wp_get_attachment_image_src( get_field('module4_img'), 'grid-thumb');
							echo '<article class="right"><img src="'.$project_thumb[0].'"/></article>';
						}?>
	                </div>
	                
	               <div class="approach5">
			        <?php
						if (get_field('module5_img') != "") { 
						$project_thumb = wp_get_attachment_image_src( get_field('module5_img'), 'grid-thumb');
							echo '<article class="left"><img src="'.$project_thumb[0].'"/></article>';
						}
						if (get_field('module5') != "") { 
							echo '<article class="right"><h2>';
							echo get_field("module5_title");
							echo '</h2><h3>';
							echo strip_tags(get_field("module5"));
							echo '</h3></article>';
					} ?>
	                </div>
	                
	                
	                <div class="approach6">
			        <?php
						if (get_field('module6') != "") { 
							echo '<article class="left"><h2>';
							echo get_field("module6_title");
							echo '</h2><h3>';
							echo strip_tags(get_field("module6"));
							echo '</h3></article>';
						} 
						if (get_field('module6_img') != "") { 
						$project_thumb = wp_get_attachment_image_src( get_field('module6_img'), 'grid-thumb');
							echo '<article class="right"><img src="'.$project_thumb[0].'"/></article>';
						}?>
	                </div>
	                
	                <div class="approach7">
			        <?php
						if (get_field('module7_img') != "") { 
						$project_thumb = wp_get_attachment_image_src( get_field('module7_img'), 'grid-thumb');
							echo '<article class="left"><img src="'.$project_thumb[0].'"/></article>';
						}
						if (get_field('module7') != "") { 
							echo '<article class="right"><h2>';
							echo get_field("module7_title");
							echo '</h2><h3>';
							echo strip_tags(get_field("module7"));
							echo '</h3></article>';
						} 
						?>
	                </div>
	                
	                <div class="approach8">
			        <?php
						if (get_field('module8') != "") { 
							echo '<article class="left"><h2>';
							echo get_field("module8_title");
							echo '</h2><h3>';
							echo strip_tags(get_field("module8"));
							echo '</h3></article>';
						} 
						if (get_field('module8_img') != "") { 
						$project_thumb = wp_get_attachment_image_src( get_field('module8_img'), 'grid-thumb');
							echo '<article class="right"><img src="'.$project_thumb[0].'"/></article>';
						}?>
	                </div>
	                
	                
        </div>
                    
	   
	   
	   

</div>

  		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.accordion.js"></script>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.3.js"></script>


<script type="text/javascript">
		function cyclePrinciples(){
      var active = jQuery('.process_item15 .active');
      var white = jQuery('.white');
      var next = (active.next().length > 0) ? active.next() : jQuery('.process_item15 article:first');
      next.css('z-index',2);//move the next image up the pile
      white.fadeIn(600,function(){//fade out the top image
	  active.css('z-index',1).show().removeClass('active');//reset the z-index and unhide the image
          next.css('z-index',3).addClass('active');//make the next image the top one
          white.fadeOut(600);
      });
    }


jQuery(function($){
    
	$(document).ready(function(){
	    	setTimeout(function(){
  //where we can also call foo
  setInterval('cyclePrinciples()', 9000);
},2000);
	
	$('.process-wrap').fadeIn();
	$('#st-accordion').accordion({
		oneOpenedItem	: true,
		open: 1,
/* 		scrollSpeed: 0 */
	});

jQuery('.textwidget p').unwrap();

var paras = $('div').hide();
	$('div#wrap').show();
	$('div#main').show();
	$('div#logo').show();
	$('.st-content').show();
	$('div.menu-primary-nav-container').show();
	$('div.process-wrap').show();
    i = 3;

// If using jQuery 1.3 or lower, you need to do $(paras[i++] || []) to avoid an "undefined" error
(function() {
  $(paras[i++]).fadeIn(200, arguments.callee);
})();
	$('body').scrollTop(0);

});
});
</script>
<?php get_footer(); ?>