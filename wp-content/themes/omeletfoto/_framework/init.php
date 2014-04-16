<?php
    $path = get_template_directory();
    //---------------------------------------------------------------------------------
    //	Run activation tasks on theme activation
    //---------------------------------------------------------------------------------
    global $pagenow; if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) { require_once($path.'/_framework/_activate.php'); }




    //---------------------------------------------------------------------------------
    //	Require Files for Houston (Load with hook to be able to use with child theme)
    //---------------------------------------------------------------------------------
        require_once(get_stylesheet_directory().'/_framework/_general.php');
        require_once(get_stylesheet_directory().'/_framework/_images.php');
        require_once(get_stylesheet_directory().'/_framework/_extras.php');
