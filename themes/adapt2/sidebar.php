<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 */
 $options = get_option( 'adapt_theme_settings' );
?>
<aside id="sidebar" class="clearfix">
	
	
	<?php if(is_page(430)) { 
	
	 echo "<div class='sidebar-box'><h3 class='about'>Current Opportunities</h3>";
	 $children = get_pages('post_type=careers&post_status=publish');
	 if( $children ) {
		echo '<ul>';
			$args = array(  'post_type' => careers,
				            'post_status'=> publish,
  							'sort_order' => ASC,
  							'sort_column' => post_title,
							'hierarchical' => 0  
 						);
				$mypages = get_pages($args);
				foreach( $mypages as $page ) {    
						
					echo '<li><a href="'.get_permalink($page->ID).'">'.$page->post_title.'</a></li>';

						}
				echo '</ul>';	

}
			if( $children == null ) { 
			 echo "<p>There are no opportunities at this time.</p>";
			}    
		

	}	?>

</aside>
<!-- /sidebar -->
