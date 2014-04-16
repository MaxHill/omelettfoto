<?php
define('ondev',true);
//---------------------------------------------------------------------------------
//  Development Mode On / Off
//---------------------------------------------------------------------------------
if(defined('WP_LOCAL_DEV') && WP_LOCAL_DEV){
    add_action('houston_after_footer', function(){
        wp_enqueue_script('livereload', 'http://localhost:35729/livereload.js', '', '', true);
    });
}

//---------------------------------------------------------------------------------
//	Settings
//---------------------------------------------------------------------------------
$theme_path = get_stylesheet_directory();

//---------------------------------------------------------------------------------
//	Require Files and Load up Stella (Load with hook to be able to use with child theme)
//---------------------------------------------------------------------------------
add_action( 'after_setup_theme', 'stella_parent_theme_setup', 9 );
function stella_parent_theme_setup() {

    // init proccess
    require_once(get_stylesheet_directory() .'/_framework/init.php');
    require_once(get_stylesheet_directory() .'/_framework/admin.php');

    // activate core functionality
    add_theme_support('post-thumbnails');
    add_theme_support('menus');

    // register navigation
    register_nav_menus(array(
        'primary_navigation' => __('Primary Navigation','stella_theme'),
        'mobile_primary_navigation' => __('Mobile Primary Navigation', 'stella_theme'),
    ));
}



//---------------------------------------------------------------------------------
//	Remove unneccesarry menu options in the wordpress backend.
//	Note: Be careful with this when cloning sites
//---------------------------------------------------------------------------------
function stella_remove_menus () {
    global $menu;
    $restricted = array(__('Dashboard'), __('Links'), __('Comments'));
    end ($menu);
    while (prev($menu)){
        $value = explode(' ',$menu[key($menu)][0]);
        if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
    }
}
add_action('admin_menu', 'stella_remove_menus');


//---------------------------------------------------------------------------------
//	Override navigational classes for Post Types
//---------------------------------------------------------------------------------
function stella_cpt_nav_class( $classes, $item ){

    //    when = is_page_template('tpl-press.php') || is_tax('press_category') || is_singular('press'))
    //    CPT = Slug for post type
    $post_types = array(
        array(
            'when' => false,
            'cpt' => ''
        )
    );

    foreach ($post_types as $type) {
        if($type['when']) {
            if($item->url == rtrim(get_post_type_archive_link($type['cpt']), '/')) {
                $classes[] = "active";
            }
        }
    }

    return $classes;
}
add_filter('nav_menu_css_class' , 'stella_cpt_nav_class' , 10 , 2);

//---------------------------------------------------------------------------------
//	ACF Settings pages
//---------------------------------------------------------------------------------



//---------------------------------------------------------------------------------
//  Pagination
//---------------------------------------------------------------------------------

function previous_posts_link_class() {
  return 'class="previouspostslink"';
}
add_filter('previous_posts_link_attributes','previous_posts_link_class');

function next_posts_link_class() {
  return 'class="nextpostslink"';
}
add_filter('next_posts_link_attributes','next_posts_link_class');
