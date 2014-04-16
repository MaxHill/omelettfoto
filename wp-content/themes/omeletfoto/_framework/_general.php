<?php
    //---------------------------------------------------------------------------------
    //	Clean up WP_head
    //---------------------------------------------------------------------------------
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'parent_post_rel_link', 10, 0);
    remove_action('wp_head', 'start_post_rel_link', 10, 0);
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
    remove_action('wp_head', 'noindex', 1);

    // remove WordPress versions
    function wp_no_generator() { return ''; }
    add_filter('the_generator', 'wp_no_generator');

    // remove injected CSS for recent comments widget
    function remove_wp_widget_recent_comments_style() {
        if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
            remove_filter('wp_head', 'wp_widget_recent_comments_style' );
        }
    }

    // remove WP version from scripts
    function remove_wp_ver_css_js( $src ) {
        if ( strpos( $src, 'ver=' ) )
            $src = remove_query_arg( 'ver', $src );
        return $src;
    }
    function bones_rss_version() { return ''; }
    add_filter( 'style_loader_src', 'remove_wp_ver_css_js', 9999 );
    // remove Wp version from scripts
    add_filter( 'script_loader_src', 'remove_wp_ver_css_js', 9999 );





    //---------------------------------------------------------------------------------
    //	Add appropriate classes to Body depending on browser.
    //	Note: Be careful with this on Cached sites.
    //---------------------------------------------------------------------------------
    function browser_body_class($classes) {
        global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

        if($is_lynx) $classes[] = 'lynx';
        elseif($is_gecko) $classes[] = 'gecko';
        elseif($is_opera) $classes[] = 'opera';
        elseif($is_NS4) $classes[] = 'ns4';
        elseif($is_safari) $classes[] = 'safari';
        elseif($is_chrome) $classes[] = 'chrome';
        elseif($is_IE) $classes[] = 'ie';
        else $classes[] = 'unknown';

        return $classes;
    }
    add_filter('body_class','browser_body_class');





    //---------------------------------------------------------------------------------
    //	Only show update notifications for Admins
    //---------------------------------------------------------------------------------
    global $user_login;
    get_currentuserinfo();
    if (!current_user_can('update_plugins')) { // checks to see if current user can update plugins
        add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
        add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
    }



    //---------------------------------------------------------------------------------
    //	Better SEO title
    //---------------------------------------------------------------------------------
    add_filter( 'wp_title', 'filter_wp_title' );
    function filter_wp_title( $title ) {
        global $page, $paged;

        if ( is_feed() )
        return $title;

        $site_description = get_bloginfo( 'description' );

        $filtered_title = $title . get_bloginfo( 'name' );
        $filtered_title .= ( ! empty( $site_description ) && ( is_home() || is_front_page() ) ) ? ' | ' . $site_description: '';
        $filtered_title .= ( 2 <= $paged || 2 <= $page ) ? ' | ' . sprintf( __( 'Page %s' ), max( $paged, $page ) ) : '';

        return $filtered_title;
        }

        add_filter('post_class','add_worpdresscontent_class',10,1);
        function add_worpdresscontent_class($classes){
        $classes[] = "wordpress-content";
        return $classes;
    }



    //---------------------------------------------------------------------------------
    //	Custom Excerpt
    //	Returns excerpt with given length.
    //---------------------------------------------------------------------------------

    function custom_excerpt($limit) {
        $excerpt = explode(' ', get_the_excerpt(), $limit);
        if (count($excerpt)>=$limit) {
            array_pop($excerpt);
            $readmore_text = _x('Läs mer', 'Nyheter', 'stella');
            $readmore_link = '<a href="' . get_permalink() . '" title="' . get_the_title() . '">'. $readmore_text .' &raquo;</a>';
            $excerpt = implode( " ", $excerpt ).'... ' . $readmore_link;
        } else {
            $excerpt = implode(" ",$excerpt);
        }
        $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
        return $excerpt;
    }