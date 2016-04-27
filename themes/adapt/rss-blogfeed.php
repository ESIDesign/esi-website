<?php
/**
 * Template Name: Custom RSS Template - Blog
 */
$postCount = 5; // The number of posts to show in the feed
$posts = query_posts('showposts=' . $postCount);
header('Content-Type: '.feed_content_type('rss-http').'; charset='.get_option('blog_charset'), true);
echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>';
?>
<rss version="2.0"
        xmlns:content="http://purl.org/rss/1.0/modules/content/"
        xmlns:wfw="http://wellformedweb.org/CommentAPI/"
        xmlns:dc="http://purl.org/dc/elements/1.1/"
        xmlns:atom="http://www.w3.org/2005/Atom"
        xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
        xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
        <?php do_action('rss2_ns'); ?>>
<channel>
        <title><?php bloginfo_rss('name'); ?> - Feed</title>
        <atom:link href="<?php self_link(); ?>" rel="self" type="application/rss+xml" />
        <link><?php bloginfo_rss('url') ?></link>
        <description><?php bloginfo_rss('description') ?></description>
        <lastBuildDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></lastBuildDate>
        <language><?php echo get_option('rss_language'); ?></language>
        <sy:updatePeriod><?php echo apply_filters( 'rss_update_period', 'hourly' ); ?></sy:updatePeriod>
        <sy:updateFrequency><?php echo apply_filters( 'rss_update_frequency', '1' ); ?></sy:updateFrequency>
        <?php do_action('rss2_head'); ?>
        <?php while(have_posts()) : the_post(); ?>
                <item>
                        <title><?php the_title_rss(); ?></title>
                        <link><?php the_permalink_rss(); ?></link>
                        <pubDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_post_time('Y-m-d H:i:s', true), false); ?></pubDate>
                        <dc:creator><?php the_author(); ?></dc:creator>
                        <guid isPermaLink="false"><?php the_guid(); ?></guid>
                        <description><![CDATA[<?php if ( has_post_thumbnail( $post->ID ) ){
echo '<div style="font-size: 12px; display:block; width: 100%;" class="item-entry"><div>' . get_the_post_thumbnail( $post->ID, 'thumbnail', array( 'style' => 'display: inline-block; clear: bottom; float: left; margin-right: 10px !important; width: 100px !important; height: 100px !important; border: 1px solid #CCC;' ) ) . '</div><div style="min-height:100px !important;"><a href="'.get_permalink( $post->ID ).'">' . $post->post_title . '</a><br />'.get_the_time('M d, Y', $post->ID).'</div></div>';
}
 ?>]]></description>
                        <content:encoded><![CDATA[<?php if ( has_post_thumbnail( $post->ID ) ){
echo '<div style="font-size: 12px; display:block; width: 100%;" class="item-entry"><div>' . get_the_post_thumbnail( $post->ID, 'thumbnail', array( 'style' => 'display: inline-block; clear: bottom; float: left; margin-right: 10px !important; width: 100px !important; height: 100px !important; border: 1px solid #CCC;' ) ) . '</div><div style="min-height:100px !important;"><a href="'.get_permalink( $post->ID ).'">' . $post->post_title . '</a><br />'.get_the_time('M d, Y', $post->ID).'</div></div>';
}
 ?>]]></content:encoded>
                        <?php rss_enclosure(); ?>
                        <?php do_action('rss2_item'); ?>
                </item>
        <?php endwhile; ?>
</channel>
</rss>