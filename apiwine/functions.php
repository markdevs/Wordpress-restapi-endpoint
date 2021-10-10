<?php

require_once get_template_directory() . '/api-wines/api-wines.php';
require_once get_template_directory() . '/api-wines/api-wine.php';
require_once get_template_directory() . '/api-wines/api-tipo.php';

add_action( 'init', 'wine_registerr_post_type', 0);

function wine_registerr_post_type() {
    $post_type = "wines";
    $labels = array(
        'name'                  => _x( 'Wines', 'Post type general name', 'textdomain' ),
        'singular_name'         => _x( 'Wine', 'Post type singular name', 'textdomain' ),
        'menu_name'             => _x( 'Wines', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar'        => _x( 'Book', 'Add New on Toolbar', 'textdomain' ),

    );
    $args = array(
        "labels" => $labels,
        "public" => true,
        "rewrite" => array('slug' => 'wines'),
        "show_in_rest" => true 
    );
    register_post_type( $post_type, $args );
}


