<?php
function stella_activation_action() {



    //---------------------------------------------------------------------------------
    //	Create default pages and set Home to Front Page
    //---------------------------------------------------------------------------------
    $default_pages = array('Hem', 'Undersida', 'Kontakt');
    $existing_pages = get_pages();
    if(count($existing_pages) < 2 && $existing_pages[0]->ID == 2){
        $temp = array();

        foreach ($existing_pages as $page) {
            $temp[] = $page->post_title;
        }

        $pages_to_create = array_diff($default_pages, $temp);

        foreach ($pages_to_create as $new_page_title) {
            $add_default_pages = array(
                'post_title' => $new_page_title,
                'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consequat, orci ac laoreet cursus, dolor sem luctus lorem, eget consequat magna felis a magna. Aliquam scelerisque condimentum ante, eget facilisis tortor lobortis in. In interdum venenatis justo eget consequat. Morbi commodo rhoncus mi nec pharetra. Aliquam erat volutpat. Mauris non lorem eu dolor hendrerit dapibus. Mauris mollis nisl quis sapien posuere consectetur. Nullam in sapien at nisi ornare bibendum at ut lectus. Pellentesque ut magna mauris. Nam viverra suscipit ligula, sed accumsan enim placerat nec. Cras vitae metus vel dolor ultrices sagittis. Duis venenatis augue sed risus laoreet congue ac ac leo. Donec fermentum accumsan libero sit amet iaculis. Duis tristique dictum enim, ac fringilla risus bibendum in. Nunc ornare, quam sit amet ultricies gravida, tortor mi malesuada urna, quis commodo dui nibh in lacus. Nunc vel tortor mi. Pellentesque vel urna a arcu adipiscing imperdiet vitae sit amet neque. Integer eu lectus et nunc dictum sagittis. Curabitur commodo vulputate fringilla. Sed eleifend, arcu convallis adipiscing congue, dui turpis commodo magna, et vehicula sapien turpis sit amet nisi.',
                'post_status' => 'publish',
                'post_type' => 'page'
            );

            $result = wp_insert_post($add_default_pages);
        }

        $home = get_page_by_title($default_pages[0]);
        update_option('show_on_front', 'page');
        update_option('page_on_front', $home->ID);

        $home_menu_order = array(
            'ID' => $home->ID,
            'menu_order' => -1
        );
        wp_update_post($home_menu_order);
    }



    //---------------------------------------------------------------------------------
    //	Create default permalinks
    //---------------------------------------------------------------------------------
    update_option('permalink_structure', '/%postname%/');
    global $wp_rewrite;
    $wp_rewrite->init();
    $wp_rewrite->flush_rules();


    //---------------------------------------------------------------------------------
    //	Set up default users and roles
    //---------------------------------------------------------------------------------
    $default_users = array(
        "client" => array("user_pass" => "kund", "user_login" => "kund", "role" => "editor"),
        "raket" => array("user_pass" => "raketfart2012", "user_login" => "raket", "role" => "administrator")
    );
    foreach($default_users as $user => $val) {
        if(username_exists($val["user_login"]))
            continue;
        wp_insert_user( array("user_pass" => $val["user_pass"], "user_login" => $val["user_login"], "role" => $val["role"]) ) ;
    }

    //---------------------------------------------------------------------------------
    //	Create default navigation and add existing pages to it.
    //---------------------------------------------------------------------------------
    $theme_nav_theme_mod = false;
    if (!has_nav_menu('primary_navigation')) {
        $primary_nav_id = wp_create_nav_menu('Primary Navigation', array('slug' => 'primary_navigation'));
        $theme_nav_theme_mod['primary_navigation'] = $primary_nav_id;
    }

    if ($theme_nav_theme_mod) {
        set_theme_mod('nav_menu_locations', $theme_nav_theme_mod);
    }

    $primary_nav = wp_get_nav_menu_object('Primary Navigation');
    $primary_nav_term_id = (int) $primary_nav->term_id;
    $menu_items= wp_get_nav_menu_items($primary_nav_term_id);
    if (!$menu_items || empty($menu_items)) {
        $pages = get_pages('sort_column=menu_order');
        foreach($pages as $page) {
            $item = array(
                'menu-item-object-id' => $page->ID,
                'menu-item-object' => 'page',
                'menu-item-type' => 'post_type',
                'menu-item-status' => 'publish'
            );
            wp_update_nav_menu_item($primary_nav_term_id, 0, $item);
        }
    }


    //---------------------------------------------------------------------------------
    //	Activate licenses on plugins like ACF, Gravity Forms etc.
    //---------------------------------------------------------------------------------
    //update_option('acf_repeater_ac', 'QJF7-L4IX-UCNP-RF2W');
    //update_option('acf_flexible_content_ac', 'FC9O-H6VN-E4CL-LT33');
    //update_option('acf_options_page_ac', 'OPN8-FA4J-Y2LW-81LS');
    update_option('rg_gforms_key', '97d4c19d47d303be4591b299c90ce3db');
    update_option('layerslider-purchase-code', '5cf1fa9a-6cf5-4581-b0e7-7d0218ee31d9');


}

add_action('admin_init','stella_activation_action');