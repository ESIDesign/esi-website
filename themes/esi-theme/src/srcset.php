<?php
/**
 * Output inline CSS to simulate srcset for background-images.
 * $image_id: wordpress image id
 * $unique_id: unique identifier (slug or loop index) to be used to target the background-image container by class
 * $unique_class: unique identifier (descriptive class name) to be used to target the background-image container by class
 */
function bg_image_srcset( $image_id, $unique_id, $unique_class, $context ) {
  $image_sources = wp_get_attachment_image_srcset( $image_id, 'full' );

  $sizes = explode( ", ", $image_sources );
  $css = '';

  foreach( $sizes as $key=>$size ) {
    $split = explode( " ", $size );
    if( !isset( $split[0], $split[1] ) )
      continue;

    $width = str_replace( "w", "px", $split[1] );
    $background_css = "." . $unique_class . "-" . $unique_id . " {
      background-image: url(" . esc_url( $split[0] ) . ");
    }";
    if( $key != 0 ) {
      $css .= "\n@media only screen and (max-width: " . $width . ") {";
      $css .= $background_css;
      $css .= "}\n";
    } else {
      $css .= "\n@media only screen and (min-width: 1024px) {";
      $css .= $background_css;
      $css .= "}\n";
    }
  }

  if ( !empty($css) ) {
    echo "<style type='text/css'>\n" . $css . "\n</style>";
  }
}

add_action( 'bg_image_srcset_action', 'bg_image_srcset', 10, 4 );
