<?php

//---------------------------------------------------------------------------------
//	Disable standard widgets
//---------------------------------------------------------------------------------

function stella_disable_default_dashboard_widgets() {

    // remove_meta_box('dashboard_right_now', 'dashboard', 'core');    // Right Now Widget
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'core'); // Comments Widget
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');  // Incoming Links Widget
    remove_meta_box('dashboard_plugins', 'dashboard', 'core');         // Plugins Widget

    // remove_meta_box('dashboard_quick_press', 'dashboard', 'core');  // Quick Press Widget
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');   // Recent Drafts Widget
    remove_meta_box('dashboard_primary', 'dashboard', 'core');         //
    remove_meta_box('dashboard_secondary', 'dashboard', 'core');       //

    // removing plugin dashboard boxes
    remove_meta_box('yoast_db_widget', 'dashboard', 'normal');         // Yoast's SEO Plugin Widget
}

// removing the dashboard widgets
add_action('admin_menu', 'stella_disable_default_dashboard_widgets');



//---------------------------------------------------------------------------------
//	Require Files for Stella
//---------------------------------------------------------------------------------

// Custom Backend Footer
function stella_custom_admin_footer() {
    _e('<span id="footer-thankyou">Developed by <a href="http://www.raketwebbyra.se" target="_blank">Raket webbyrå</a></span>.', 'stella_theme');
}
add_filter('admin_footer_text', 'stella_custom_admin_footer');

// changing the logo link from wordpress.org to your site
function stella_modify_login_url() {  return home_url(); }
add_filter('login_headerurl', 'stella_modify_login_url');