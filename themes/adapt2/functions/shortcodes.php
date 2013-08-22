<?php
/******************************************
/* Shortcodes
******************************************/

//Fix Shortcodes
function wpex_fix_shortcodes($content){   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );

    $content = strtr($content, $array);
    return $content;
}
add_filter('the_content', 'wpex_fix_shortcodes');


//highlights
function highlight_shortcode( $atts, $content = null )
{
	extract( shortcode_atts(
	array(
      'color' => 'yellow',
      ),
	  $atts ) );

      return '<span class="text-highlight highlight-' . $color . '">' . $content . '</span>';

}
add_shortcode('highlight', 'highlight_shortcode');

//Break
function line_break_shortcode() {
   return '<br />';
}

add_shortcode( 'br', 'line_break_shortcode' );

//clear
function clear_shortcode() {
   return '<div class="clear"></div>';
}

add_shortcode( 'clear', 'clear_shortcode' );

//Buttons
function button_shortcode( $atts, $content = null )
{
	extract( shortcode_atts( array(
      'color' => 'default',
	  'url' => '',
	  'text' => ''
      ), $atts ) );
	  if($url) {
		return '<a href="' . $url . '" class="button ' . $color . '" target="_blank"><span>' . $text . $content . '</span></a>';
	  } else {
		return '<div class="button ' . $color . '"><span>' . $text . $content . '</span></div>';
	}
}
add_shortcode('button', 'button_shortcode');

//Boxes
function box_shortcode( $atts, $content = null )
{
	extract( shortcode_atts( array(
      'color' => 'orange',
      'size' => 'normal',
      'type' => '',
	  'align' => 'default',
      ), $atts ) );

      return '<div class="box-shortcode box-' . $color . '">' . $content . '</div>';

}
add_shortcode('box', 'box_shortcode');

//Columns
function column_shortcode( $atts, $content = null )
{
	extract( shortcode_atts( array(
	  'offset' =>'',
      'size' => '',
	  'position' =>''
      ), $atts ) );


	  if($offset !='') { $column_offset = $offset; } else { $column_offset ='one'; }
		
      return '<div class="'.$column_offset.'-' . $size . ' column-'.$position.'">' . do_shortcode($content) . '</div>';

}
add_shortcode('column', 'column_shortcode');

/*shortcode filters - alow shortcodes in widgets*/
add_filter('the_content', 'do_shortcode');
add_filter('widget_text', 'do_shortcode');
?>