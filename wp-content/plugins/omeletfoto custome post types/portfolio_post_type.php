<?php
/*
Plugin Name: Portfolio post type
Plugin URI: http://hilloco.se/
Description: Declares a plugin that will create a custom post type displaying portfolio items.
Version: 1.0
Author: Max Hill
Author http://hilloco.se/
License: GPLv2
*/

#http://wp.tutsplus.com/tutorials/plugins/a-guide-to-wordpress-custom-post-types-creation-display-and-meta-boxes/

add_action( 'init', 'create_image_item' );


function create_image_item() {
    register_post_type( 'image_item',
        array(
            'labels' => array(
                'name' => 'Bilder',
                'singular_name' => 'Bild',
                'add_new' => 'Lägg till Ny',
                'add_new_item' => 'Lägg till Ny bild',
                'edit' => 'Redigera',
                'edit_item' => 'Redigera bild',
                'new_item' => 'Ny bild',
                'view' => 'Visa',
                'view_item' => 'Visa bild',
                'search_items' => 'Sök bild',
                'not_found' => 'Ingen bild found',
                'not_found_in_trash' => 'Ingen bild hittad i papperskorgen'
            ),
 
            'public' => true,
            'menu_position' => 15,
            'supports' => array( 'title', 'thumbnail' ),
            'taxonomies' => array( '' ),
            'menu_icon' => plugins_url( 'images/image.png', __FILE__ ),
            'has_archive' => true
        )
    );
}

function create_my_taxonomies() {
    register_taxonomy(
        'image_category',
        'image_item',
        array(
            'labels' => array(
                'name' => 'Bild kategori',
                'add_new_item' => 'Lägg till ny bild kategori',
                'new_item_name' => "Ny bild kategori"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );
}

add_action( 'init', 'create_my_taxonomies', 0 );