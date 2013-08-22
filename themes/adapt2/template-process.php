<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 * Template Name: Process
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
				'post_parent' => $id,
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
                 	        <div id="st-accordion" class="st-accordion">
	    <ul>

	    <?php
			if (get_field('module1') != "") { 
				echo '<li class="process_text1"><a href="#">';
				the_field("module1_title");
				echo '</a><div class="st-content">';
				the_field("module1");
				echo '</div></li>';
		} ?>



<?php
						if (get_field('module2') != "") { 
							echo '<li class="process_text2"><a href="#">';
							the_field("module2_title");
							echo '</a><div class="st-content">';
							the_field("module2");
							echo '</div></li>';
					} ?>

					

<?php
						if (get_field('module3') != "") { 
							echo '<li class="process_text3"><a href="#">';
							the_field("module3_title");
							echo '</a><div class="st-content">';
							the_field("module3");
							echo '</div></li>';
					} ?>


	    <?php
						if (get_field('module4') != "") { 
							echo '<li class="process_text4"><a href="#">';
							the_field("module4_title");
							echo '</a><div class="st-content">';
							the_field("module4");
							echo '</div></li>';
		} ?>
	    
	    
    	<?php
				if (get_field('module5') != "") { 
					echo '<li class="process_text5"><a href="#">';
							the_field("module5_title");
							echo '</a><div class="st-content">';
							the_field("module5");
							echo '</div></li>';
			} ?>

       
					</ul>
        </div>
                 <?php } ?>
          
                    <?php if ($count == '2') { ?>                         
                    <div class="process_item8">
                    <img src="<?php echo $grid_thumb[0]; ?>" alt="<?php echo apply_filters('the_title', $attachment->post_title); ?>" /> 
                    </div>
                    
                 
                 	
                     <?php } ?>   
                        
					<?php if ($count == '3') { ?>
						<div class="process_item9">
							<img src="<?php echo $grid_thumb[0]; ?>" alt="<?php echo the_title(); ?>" />
						</div>
                 
                 	
					<?php } ?>
					
			<!--
		<?php if ($count == '4') { ?>
						<div class="process_item10">
							<img src="<?php echo $grid_thumb[0]; ?>" alt="<?php echo the_title(); ?>" />
						</div>

                 
					<?php } ?>
					
					<?php if ($count == '5') { ?>
						<div class="process_item11">
							<img src="<?php echo $grid_thumb[0]; ?>" alt="<?php echo the_title(); ?>" />
						</div>
					
                 
					<?php } ?>
-->
					
					<?php if ($count == '4') { ?>
						<div class="process_item12">
							<img src="<?php echo $grid_thumb[0]; ?>" alt="<?php echo the_title(); ?>" />
						</div>

                

					<?php } ?>
					
					
	    <?php endforeach; ?>
	    
	    
	     <div class="process_item13">
	        <a class="process_item13" href="<?php echo get_site_url(); ?>/contact">Contact</a>
        </div>
        
        <div class="process_item14">
	        <a class="process_item14" href="<?php echo get_site_url(); ?>/people">People</a>
        </div>

        <div class="process_item15">

	        <?php if (get_field('principle1') != "") { 
							echo '<article class="active">';
							the_field("principle1");
							echo '</article>';
		}?>

	        <?php if (get_field('principle2') != "") { 
							echo '<article>';
							the_field("principle2");
							echo '</article>';
		}?>


<?php if (get_field('principle3') != "") { 
							echo '<article>';
							the_field("principle3");
							echo '</article>';
		}?>
		<?php if (get_field('principle4') != "") { 
							echo '<article>';
							the_field("principle4");
							echo '</article>';
		}?>
		<?php if (get_field('principle5') != "") { 
							echo '<article>';
							the_field("principle5");
							echo '</article>';
		}?>

</div>

<article class="white"></article>

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