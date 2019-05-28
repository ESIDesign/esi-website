<?php

// use Roots\Sage\Template;
use Roots\Sage\Asset;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template;

if (!class_exists('Timber')) {
    add_action('admin_notices', function () {
        echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url(admin_url('plugins.php#timber')) . '">' . esc_url(admin_url('plugins.php')) . '</a></p></div>';
    });
    return;
}

Timber::$dirname = ['templates', 'views'];

class SageTwigSite extends TimberSite
{
    function __construct()
    {
        add_filter('timber_context', array($this, 'add_to_context'));
        add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
        add_filter( 'pre_get_posts', array($this, 'custom_work_archive') );
        parent::__construct();
    }

    function add_to_context($context)
    {
        $context['menu'] = new TimberMenu();
        $context['options'] = get_fields('option');
        $context['site'] = $this;
        return $context;
    }

    function get_asset( $filename ) {
      static $manifest;
      isset($manifest) || $manifest = new JsonManifest(get_template_directory() . '/' . Asset::$dist . '/assets.json');
      return (string) new Asset($filename, $manifest);
    }


    function add_to_twig( $twig ) {
        $twig->addExtension( new Twig_Extension_StringLoader() );
        $twig->addFilter('asset', new Twig_SimpleFilter('asset', array($this, 'get_asset')));
        return $twig;
    }

    function custom_work_archive( $query ) {
        if ( !is_admin() && isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'work') {
            // $query->set( 'meta_key', 'featured' );
            // $query->set( 'orderby',  'meta_value' );
            // $query->set( 'order', 'DESC' );
            $query->set( 'orderby',  'menu_order' );
            $query->set( 'order', 'ASC' );
            $query->set( 'post_type', array( 'work' ));
            $query->set( 'posts_per_page', 16);
        } else if (!is_admin() && (is_tax('work_industry') || is_tax('work_project_type'))) {
            // $query->set( 'meta_key', 'featured' );
            // $query->set( 'orderby',  'meta_value' );
            // $query->set( 'order', 'DESC' );
            $query->set( 'orderby',  'menu_order' );
            $query->set( 'order', 'ASC' );
            $query->set( 'post_type', array( 'work' ));
            $query->set( 'posts_per_page', 16);
        }
        return $query;
    }
}

new SageTwigSite();
