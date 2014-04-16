<?php

//---------------------------------------------------------------------------------
//	Font awesome menu
//---------------------------------------------------------------------------------
function fontawesome_menu( $nav ) {
    $menu = preg_replace_callback(
        '/<li((?:[^>]+)(icon-[^ ]+ )(?:[^>]+))><a[^>]+>(.*)<\/a>/',
        'fontawesome_replace',
        $nav
    );
    print $menu;
}
function fontawesome_replace( $a ) {
    $listitem = $a[0];
    $icon = $a[2];
    $link_text = $a[3];
    $str_noicon = str_replace( $icon, '', $listitem );
    $str = str_replace( $link_text, '<i class="' . trim( $icon ) . '"></i><span class="fontawesome-text"> ' . $link_text . '</span>', $str_noicon );
    return $str;
}
add_filter( 'wp_nav_menu' , 'fontawesome_menu', 10, 2);



//---------------------------------------------------------------------------------
//	Clean up menu output
//---------------------------------------------------------------------------------
//	Reduce nav classes, leaving only 'current-menu-item'
function nav_class_filter( $var ) {
    return is_array($var) ? array_intersect($var, array(
	    'current-menu-item',
	    'current-menu-parent',
	    'current-menu-ancestor',
	    'current-page-ancestor',
	    'current-page-parent'
    )) : '';
}
add_filter('nav_menu_css_class', 'nav_class_filter', 100, 1);
//	Add page slug as nav IDs
function nav_id_filter( $id, $item ) {
    return 'nav-'.cleanname($item->title);
}
add_filter( 'nav_menu_item_id', 'nav_id_filter', 10, 2 );


function cleanname($v) {
    $v = preg_replace('/[^a-zA-Z0-9s]/', '', $v);
    $v = str_replace(' ', '-', $v);
    $v = strtolower($v);
    return $v;
}



//---------------------------------------------------------------------------------
//	Dump'n'Die
//---------------------------------------------------------------------------------

function dd($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    die();
}