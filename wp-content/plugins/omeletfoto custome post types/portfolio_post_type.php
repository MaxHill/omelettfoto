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
            'supports' => array( 'title'),
            'taxonomies' => array( '' ),
            'menu_icon' => 'dashicons-format-image',
            'has_archive' => true
        )
    );
}



function add_custom_taxonomies() {
    // Add new "Locations" taxonomy to image_item
    register_taxonomy('image_category', 'image_item', array(
        // Hierarchical taxonomy (like categories)
        'hierarchical' => true,
        // This array of options controls the labels displayed in the WordPress Admin UI
        'labels' => array(
            'name' => _x( 'Bild Kategorier', 'taxonomy general name' ),
            'singular_name' => _x( 'Bild Kategorier', 'taxonomy singular name' ),
            'search_items' =>  __( 'Sök Bild Kategorier' ),
            'all_items' => __( 'Alla Bild Kategorier' ),
            'edit_item' => __( 'Redigera kategori' ),
            'update_item' => __( 'Uppdatera kategori' ),
            'add_new_item' => __( 'Lägg till ny kategori' ),
            'new_item_name' => __( 'Ny kategori namn' ),
            'menu_name' => __( 'Bild Kategorier' ),
        ),
        // Control the slugs used for this taxonomy
        'rewrite' => array(
            'slug' => 'bildkategori', // This controls the base slug that will display before each term
            'with_front' => false, // Don't display the category base before "/locations/"
            'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
        ),
    ));
}
add_action( 'init', 'add_custom_taxonomies', 0 );