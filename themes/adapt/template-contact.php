<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 * Template Name: Contact
 */
?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

         
    	<div class="item0"><div id="map_canvas" style="width:100%; height:353px"></div></div>

    <!-- /page-heading -->
<article class="post clearfix">   

    <h1><?php the_title(); ?></h1>
    <?php the_content(); ?>

</article>
<?php endwhile; ?>
<?php endif; ?>


<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
		<script type="text/javascript">
			function initialize() {
				var latlng = new google.maps.LatLng(40.738716,-73.991444);
				var settings = {
					zoom: 15,
					center: latlng,
					mapTypeControl: false,
					disableAutoPan: true,
					mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
					navigationControl: false,
					navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
					mapTypeId: google.maps.MapTypeId.ROADMAP};
				var map = new google.maps.Map(document.getElementById("map_canvas"), settings);
				var contentString = 
					'<h2>ESI Design</h2>'+
					'<p>111 5th Avenue, 12th Floor<br />New York, NY 10003</p>';
				var infowindow = new google.maps.InfoWindow({
					content: contentString
				});
				
			
	var companyImage = new google.maps.MarkerImage('<?php echo get_template_directory_uri(); ?>/images/map_marker_sm.png',
					new google.maps.Size(100,50),
					new google.maps.Point(0,0),
					new google.maps.Point(50,50)
				);



				var companyShadow = new google.maps.MarkerImage('<?php echo get_template_directory_uri(); ?>/images/logo_shadow.png',
					new google.maps.Size(130,50),
					new google.maps.Point(0,0),
					new google.maps.Point(65, 50));


				var companyPos = new google.maps.LatLng(40.738716,-73.991444);

				var companyMarker = new google.maps.Marker({
					position: companyPos,
					map: map,
					icon: companyImage,
 					shadow: companyShadow,
					title:"ESI Design",
					zIndex: 3});

				google.maps.event.addListener(companyMarker, 'click', function() {
					infowindow.open(map,companyMarker);
				});
			}
			
jQuery(function($){

	$(document).ready(function(){
	initialize();
	});
	});

		</script>
<?php get_sidebar(); ?>		

<?php get_footer(); ?>